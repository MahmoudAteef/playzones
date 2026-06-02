// نظام طابور الإشعارات الاحترافي للجلسات المحدودة
(function () {
  "use strict";

  // حالة النظام
  const NotificationQueue = {
    queue: [],
    isProcessing: false,
    isBusy: false, // حالة مشغول أثناء عرض كارت الإيصال

    // إضافة إشعار للطابور
    addToQueue(sessionData) {
      // تجنب الإشعارات المكررة (بناءً على session ID)
      const exists = this.queue.find(
        (item) => String(item.sessionId) === String(sessionData.id)
      );
      if (exists) {
        return;
      }

      this.queue.push({
        sessionId: sessionData.id,
        sessionData: sessionData,
        timestamp: Date.now(),
        retryCount: 0,
      });

      this.processQueue();
    },

    // معالجة الطابور
    async processQueue() {
      if (this.isProcessing || this.isBusy || this.queue.length === 0) {
        return;
      }

      this.isProcessing = true;

      const notification = this.queue.shift();
      await this.showNotification(notification);

      this.isProcessing = false;

      if (this.queue.length > 0) {
        setTimeout(() => this.processQueue(), 1000);
      }
    },

    // عرض الإشعار
    async showNotification(notification) {
      const { sessionId, sessionData } = notification;

      try {
        // تجميد الجلسة أولاً (الخادم يقرر إن كان سيغلق الشاشة فوراً)
        const pauseResult = await this.freezeSession(sessionId);

        // مرّر معلومة إغلاق الشاشة الفوري لمودال القرار حتى نعكس الوضع للمستخدم
        const dataForModal = Object.assign({}, sessionData, {
          immediate_screen_off: !!(pauseResult && pauseResult.immediate_screen_off),
          screen_closed: !!(pauseResult && pauseResult.screen_closed),
        });

        // عرض نافذة القرارات (مودال مخصّص بهوية النظام)
        await this.showDecisionModal(dataForModal);

        this._notifyShown(sessionId);
      } catch (error) {
        this._notifyFailed(sessionId);
      }
    },

    _notifyShown(sessionId) {
      try {
        if (window.SessionMonitor && typeof window.SessionMonitor.markShown === "function") {
          window.SessionMonitor.markShown(sessionId);
        }
      } catch (e) { /* silent */ }
    },

    _notifyFailed(sessionId) {
      try {
        if (window.SessionMonitor && typeof window.SessionMonitor.markFailed === "function") {
          window.SessionMonitor.markFailed(sessionId);
        }
      } catch (e) { /* silent */ }
    },

    // تجميد الجلسة (وإغلاق الشاشة فوراً لو الخيار مفعّل خادمياً)
    async freezeSession(sessionId) {
      try {
        const controller = new AbortController();
        const timeoutId = setTimeout(() => controller.abort(), 8000);
        let response;
        try {
          response = await fetch("sessions.php", {
            method: "POST",
            headers: {
              "Content-Type": "application/x-www-form-urlencoded",
            },
            credentials: "same-origin",
            signal: controller.signal,
            body: new URLSearchParams({
              action: "pause_on_expire",
              session_id: sessionId,
            }),
          });
        } finally {
          clearTimeout(timeoutId);
        }

        const result = await response.json();
        return result;
      } catch (error) {
        return { success: false, message: error.message };
      }
    },

    // تنسيق وقت انتهاء الجلسة (12 ساعة)
    _formatEndTime(sessionData) {
      try {
        const opts = { hour: "numeric", minute: "2-digit", hour12: true };
        const ms = sessionData?.limited_end_ms;
        if (ms !== undefined && ms !== null && ms !== "") {
          const d = new Date(Number(ms));
          if (!Number.isNaN(d.getTime())) return d.toLocaleTimeString("ar-EG", opts);
        }
        const raw = sessionData?.limited_end_time;
        if (raw) {
          const normalized = String(raw).replace(" ", "T");
          const d = new Date(normalized);
          if (!Number.isNaN(d.getTime())) return d.toLocaleTimeString("ar-EG", opts);
          return String(raw);
        }
      } catch (e) {}
      return "—";
    },

    _escape(str) {
      return String(str ?? "")
        .replace(/&/g, "&amp;")
        .replace(/</g, "&lt;")
        .replace(/>/g, "&gt;")
        .replace(/"/g, "&quot;")
        .replace(/'/g, "&#39;");
    },

    _injectStyles() {
      if (document.getElementById("nq-modal-styles")) return;
      const css = `
        .nq-overlay { position: fixed; inset: 0; z-index: 99999; display: flex; align-items: center; justify-content: center; padding: 12px; background: rgba(2,6,23,.78); backdrop-filter: blur(6px); animation: nqFade .25s ease; }
        .nq-card { width: 100%; max-width: 560px; background: linear-gradient(135deg,#0f172a 0%, #1e293b 50%, #0f172a 100%); border: 1px solid rgba(255,255,255,.08); border-radius: 24px; overflow: hidden; box-shadow: 0 25px 50px -12px rgba(0,0,0,.6); animation: nqPop .35s cubic-bezier(.16,1,.3,1); direction: rtl; }
        .nq-head { position: relative; padding: 18px 20px; background: linear-gradient(135deg, #f59e0b 0%, #f97316 50%, #dc2626 100%); color:#fff; }
        .nq-head::after { content:""; position:absolute; inset:0; background: radial-gradient(circle at 100% 0%, rgba(255,255,255,.18), transparent 50%); pointer-events:none; }
        .nq-head-row { display:flex; align-items:center; gap:14px; position:relative; }
        .nq-head-icon { width:46px; height:46px; border-radius:14px; background: rgba(255,255,255,.18); display:flex; align-items:center; justify-content:center; font-size:22px; flex-shrink:0; }
        .nq-head-title { font-size: 1.05rem; font-weight: 800; line-height: 1.3; }
        .nq-head-sub { font-size: .8rem; opacity: .9; margin-top: 2px; }
        .nq-body { padding: 20px; color: #e2e8f0; }
        .nq-info { display:grid; grid-template-columns: 1fr 1fr; gap:10px; margin-bottom: 16px; }
        .nq-info-card { background: rgba(255,255,255,.04); border: 1px solid rgba(255,255,255,.06); border-radius: 14px; padding: 10px 12px; }
        .nq-info-label { font-size: .72rem; color: #94a3b8; margin-bottom: 4px; display:flex; align-items:center; gap:6px; }
        .nq-info-value { font-size: .95rem; font-weight: 700; color: #fff; }
        .nq-screen-banner { display:flex; align-items:center; gap:10px; padding: 10px 12px; border-radius: 12px; margin-bottom: 14px; font-size: .82rem; font-weight: 600; }
        .nq-screen-banner.off { background: rgba(220,38,38,.12); border: 1px solid rgba(220,38,38,.3); color: #fecaca; }
        .nq-screen-banner i { font-size: 1.05rem; }
        .nq-hint { font-size:.78rem; color:#94a3b8; margin-bottom: 14px; padding: 8px 10px; background: rgba(255,255,255,.03); border-right: 3px solid rgba(148,163,184,.4); border-radius: 8px; }
        .nq-actions { display: grid; grid-template-columns: 1fr 1fr 1fr; gap: 10px; }
        .nq-btn { position:relative; padding: 12px 10px; border-radius: 14px; border: 1px solid rgba(255,255,255,.08); color: #fff; font-weight: 700; cursor: pointer; transition: transform .18s ease, box-shadow .18s ease, filter .18s ease; display:flex; flex-direction:column; align-items:center; gap:6px; font-size: .85rem; }
        .nq-btn:hover { transform: translateY(-2px); filter: brightness(1.07); box-shadow: 0 10px 25px -8px rgba(0,0,0,.55); }
        .nq-btn:active { transform: translateY(0); }
        .nq-btn i { font-size: 1.1rem; }
        .nq-btn .nq-sub { font-size: .65rem; font-weight: 600; opacity:.85; letter-spacing:.5px; text-transform: uppercase; }
        .nq-btn-end { background: linear-gradient(135deg,#ef4444,#b91c1c); }
        .nq-btn-extend { background: linear-gradient(135deg,#f59e0b,#d97706); }
        .nq-btn-continue { background: linear-gradient(135deg,#10b981,#059669); }
        .nq-btn[disabled] { opacity:.6; cursor: not-allowed; transform:none; filter:none; }
        @keyframes nqFade { from { opacity:0 } to { opacity:1 } }
        @keyframes nqPop { 0% { opacity:0; transform: scale(.92) translateY(8px); } 100% { opacity:1; transform: scale(1) translateY(0); } }
        @media (max-width: 480px) {
          .nq-info { grid-template-columns: 1fr; }
          .nq-actions { grid-template-columns: 1fr; }
          .nq-btn { flex-direction: row; justify-content:center; }
        }

        /* مودال تمديد الجلسة */
        .nq-extend-card { max-width: 440px; }
        .nq-extend-head { background: linear-gradient(135deg,#6366f1,#7c3aed); }
        .nq-presets { display:grid; grid-template-columns: repeat(4,1fr); gap: 8px; margin-bottom: 14px; }
        .nq-preset { padding: 10px 6px; border-radius: 12px; border: 1px solid rgba(255,255,255,.1); background: rgba(255,255,255,.04); color:#e2e8f0; font-weight: 700; cursor:pointer; transition: all .18s ease; }
        .nq-preset:hover, .nq-preset.active { background: linear-gradient(135deg,#6366f1,#7c3aed); border-color: transparent; color:#fff; }
        .nq-input-wrap { position: relative; margin-bottom: 14px; }
        .nq-input { width: 100%; padding: 12px 14px; background: rgba(15,23,42,.6); border: 1px solid rgba(255,255,255,.1); border-radius: 12px; color: #fff; font-size: 1rem; font-weight: 700; text-align: center; outline:none; }
        .nq-input:focus { border-color: #a78bfa; box-shadow: 0 0 0 3px rgba(167,139,250,.18); }
        .nq-input-suffix { position:absolute; left: 14px; top: 50%; transform: translateY(-50%); color:#94a3b8; font-size:.85rem; }
        .nq-error { color:#fca5a5; font-size:.78rem; margin-top: -8px; margin-bottom: 12px; display:none; }
        .nq-error.show { display:block; }
        .nq-modal-actions { display:flex; gap:10px; justify-content:flex-end; }
        .nq-modal-actions .nq-btn { flex: 1; max-width: 160px; flex-direction: row; padding: 11px 14px; font-size:.9rem; }
        .nq-btn-cancel { background: rgba(255,255,255,.06); border:1px solid rgba(255,255,255,.12); }
        .nq-btn-confirm { background: linear-gradient(135deg,#6366f1,#7c3aed); }
      `;
      const styleEl = document.createElement("style");
      styleEl.id = "nq-modal-styles";
      styleEl.textContent = css;
      document.head.appendChild(styleEl);
    },

    // نافذة القرارات بمودال مخصّص بهوية النظام
    showDecisionModal(sessionData) {
      return new Promise((resolve) => {
        this._injectStyles();

        const existing = document.getElementById("nqDecisionModal");
        if (existing) existing.remove();

        const overlay = document.createElement("div");
        overlay.id = "nqDecisionModal";
        overlay.className = "nq-overlay";

        const endTimeLabel = this._formatEndTime(sessionData);
        const roomName = this._escape(sessionData?.room_name || "—");
        const screenClosed = !!sessionData.screen_closed;
        const immediateOff = !!sessionData.immediate_screen_off;

        const screenBanner = immediateOff
          ? `<div class="nq-screen-banner off">
              <i class="fas fa-power-off"></i>
              <span>${screenClosed ? "تم إغلاق الشاشة تلقائياً عند انتهاء الوقت." : "خيار الإغلاق الفوري مفعّل لهذه الجلسة."}</span>
            </div>`
          : "";

        overlay.innerHTML = `
          <div class="nq-card" role="dialog" aria-modal="true" aria-labelledby="nqDecisionTitle">
            <div class="nq-head">
              <div class="nq-head-row">
                <div class="nq-head-icon"><i class="fas fa-clock"></i></div>
                <div>
                  <div id="nqDecisionTitle" class="nq-head-title">انتهى الوقت المحدد للجلسة</div>
                  <div class="nq-head-sub">اختر الإجراء المناسب للجلسة</div>
                </div>
              </div>
            </div>
            <div class="nq-body">
              <div class="nq-info">
                <div class="nq-info-card">
                  <div class="nq-info-label"><i class="fas fa-door-open"></i> الغرفة</div>
                  <div class="nq-info-value">${roomName}</div>
                </div>
                <div class="nq-info-card">
                  <div class="nq-info-label"><i class="fas fa-hourglass-end"></i> وقت الانتهاء</div>
                  <div class="nq-info-value">${this._escape(endTimeLabel)}</div>
                </div>
              </div>
              ${screenBanner}
              <div class="nq-hint">
                <i class="fas fa-info-circle"></i>
                <span>الجلسة الآن مجمّدة. اختر إنهاء، تمديد، أو المتابعة كجلسة غير محدودة.</span>
              </div>
              <div class="nq-actions">
                <button type="button" class="nq-btn nq-btn-end" data-action="end">
                  <i class="fas fa-stop-circle"></i>
                  <span>إنهاء الجلسة</span>
                </button>
                <button type="button" class="nq-btn nq-btn-extend" data-action="extend">
                  <i class="fas fa-plus-circle"></i>
                  <span>تمديد الجلسة</span>
                </button>
                <button type="button" class="nq-btn nq-btn-continue" data-action="continue">
                  <i class="fas fa-play-circle"></i>
                  <span>متابعة الجلسة</span>
                  <span class="nq-sub">Open</span>
                </button>
              </div>
            </div>
          </div>
        `;

        document.body.appendChild(overlay);

        const finish = (action) => {
          try { document.removeEventListener("keydown", onKey); } catch (e) {}
          overlay.remove();

          if (action === "continue") {
            this.postAction("resume_unlimited", { session_id: sessionData.id });
          } else if (action === "extend") {
            this.showExtendModal(sessionData.id);
          } else if (action === "end") {
            this.postAction("end_expired_session", { session_id: sessionData.id });
          }
          resolve();
        };

        const onKey = (e) => {
          // لا نسمح بالإغلاق بـ Escape — قرار إجباري
          if (e.key === "Escape") e.preventDefault();
        };
        document.addEventListener("keydown", onKey);

        overlay.querySelectorAll("button[data-action]").forEach((btn) => {
          btn.addEventListener("click", () => {
            overlay.querySelectorAll("button[data-action]").forEach((b) => (b.disabled = true));
            finish(btn.getAttribute("data-action"));
          });
        });
      });
    },

    // نافذة تمديد مخصّصة بهوية النظام
    showExtendModal(sessionId) {
      this._injectStyles();

      const existing = document.getElementById("nqExtendModal");
      if (existing) existing.remove();

      const overlay = document.createElement("div");
      overlay.id = "nqExtendModal";
      overlay.className = "nq-overlay";

      overlay.innerHTML = `
        <div class="nq-card nq-extend-card" role="dialog" aria-modal="true" aria-labelledby="nqExtendTitle">
          <div class="nq-head nq-extend-head">
            <div class="nq-head-row">
              <div class="nq-head-icon"><i class="fas fa-plus-circle"></i></div>
              <div>
                <div id="nqExtendTitle" class="nq-head-title">تمديد الجلسة</div>
                <div class="nq-head-sub">اختر مدة سريعة أو أدخل القيمة يدوياً</div>
              </div>
            </div>
          </div>
          <div class="nq-body">
            <div class="nq-presets">
              <button type="button" class="nq-preset" data-min="5">5 د</button>
              <button type="button" class="nq-preset" data-min="15">15 د</button>
              <button type="button" class="nq-preset" data-min="30">30 د</button>
              <button type="button" class="nq-preset" data-min="60">60 د</button>
            </div>
            <div class="nq-input-wrap">
              <input id="nqExtendInput" type="number" min="5" step="5" value="15" class="nq-input" inputmode="numeric" />
              <span class="nq-input-suffix">دقيقة</span>
            </div>
            <div id="nqExtendError" class="nq-error">الحد الأدنى للتمديد 5 دقائق</div>
            <div class="nq-modal-actions">
              <button type="button" class="nq-btn nq-btn-cancel" data-action="cancel">
                <i class="fas fa-times"></i><span>رجوع</span>
              </button>
              <button type="button" class="nq-btn nq-btn-confirm" data-action="confirm">
                <i class="fas fa-check"></i><span>تأكيد التمديد</span>
              </button>
            </div>
          </div>
        </div>
      `;

      document.body.appendChild(overlay);

      const input = overlay.querySelector("#nqExtendInput");
      const errEl = overlay.querySelector("#nqExtendError");

      overlay.querySelectorAll(".nq-preset").forEach((btn) => {
        btn.addEventListener("click", () => {
          const v = parseInt(btn.getAttribute("data-min"), 10);
          if (!isNaN(v)) {
            input.value = v;
            overlay.querySelectorAll(".nq-preset").forEach((b) => b.classList.remove("active"));
            btn.classList.add("active");
            errEl.classList.remove("show");
          }
        });
      });

      const cleanup = () => overlay.remove();

      overlay.querySelector('button[data-action="cancel"]').addEventListener("click", () => {
        cleanup();
        // عودة لمودال القرار (نفس الجلسة) — نعيد تنفيذ مودال القرار البديهي
        // ولكن لتفادي حلقات، نكتفي بإغلاق المودال — يستطيع المستخدم الانتظار لإعادة الإشعار
      });

      overlay.querySelector('button[data-action="confirm"]').addEventListener("click", () => {
        const v = parseInt(input.value, 10);
        if (isNaN(v) || v < 5) {
          errEl.classList.add("show");
          input.focus();
          return;
        }
        cleanup();
        this.postAction("extend_limited_session", {
          session_id: sessionId,
          additional_minutes: v,
        });
      });

      input.addEventListener("input", () => {
        const v = parseInt(input.value, 10);
        if (!isNaN(v) && v >= 5) errEl.classList.remove("show");
      });

      setTimeout(() => { try { input.focus(); input.select(); } catch (e) {} }, 50);
    },

    // إرسال طلب POST عبر فورم مخفي (يُسبّب إعادة تحميل الصفحة لتطبيق الـ flash message)
    postAction(action, data) {
      const form = document.createElement("form");
      form.method = "POST";
      form.action = "sessions.php";

      const actionInput = document.createElement("input");
      actionInput.type = "hidden";
      actionInput.name = "action";
      actionInput.value = action;
      form.appendChild(actionInput);

      Object.keys(data).forEach((key) => {
        const input = document.createElement("input");
        input.type = "hidden";
        input.name = key;
        input.value = data[key];
        form.appendChild(input);
      });

      document.body.appendChild(form);
      form.submit();
    },

    // تعيين حالة مشغول
    setBusyState(isBusy) {
      this.isBusy = isBusy;
      if (!isBusy && this.queue.length > 0) {
        setTimeout(() => this.processQueue(), 600);
      }
    },

    clearQueue() {
      this.queue = [];
    },
  };

  window.NotificationQueue = NotificationQueue;

  // مراقبة حالة كارت الإيصال (sessions.php)
  const originalCloseSessionSummary = window.closeSessionSummary;

  window.closeSessionSummary = function () {
    NotificationQueue.setBusyState(false);
    if (originalCloseSessionSummary) {
      originalCloseSessionSummary();
    }
    setTimeout(() => NotificationQueue.processQueue(), 500);
  };

  /* silent for production */
})();
