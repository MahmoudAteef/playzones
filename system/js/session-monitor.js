// ================================================================
// نظام مراقبة الجلسات المحدودة - محسّن للأداء
// Session Monitoring System - Performance Optimized
// ================================================================

(function () {
  "use strict";

  // ================================================================
  // نظام مزامنة الوقت مع السيرفر
  // ================================================================
  let serverTimeOffset = 0;
  let isTimeSynced = false;

  function getCorrectTime() {
    return Date.now() + serverTimeOffset;
  }

  async function syncServerTime() {
    try {
      const startRequest = Date.now();
      const response = await fetch('api/get-server-time.php', {
        method: 'GET',
        cache: 'no-cache'
      });
      const endRequest = Date.now();
      const roundTripTime = endRequest - startRequest;

      if (!response.ok) throw new Error('Sync failed');

      const data = await response.json();

      if (data.success) {
        const networkDelay = roundTripTime / 2;
        const adjustedServerTime = data.server_time + networkDelay;
        serverTimeOffset = adjustedServerTime - Date.now();
        isTimeSynced = true;
      }
    } catch (error) {
      serverTimeOffset = 0;
      isTimeSynced = true;
    }
  }

  // مزامنة أولية
  syncServerTime();
  // إعادة المزامنة كل 5 دقائق
  setInterval(syncServerTime, 300000);

  // ================================================================
  // نظام المراقبة
  // ================================================================

  // notified  = جلسات تم عرض المودال لها بنجاح وتفاعل المستخدم معه
  // inQueue   = جلسات في الطابور أو يجري معالجتها الآن
  // الفصل بين الحالتين يضمن:
  //  - عدم التكرار بينما المودال مفتوح (inQueue)
  //  - إعادة المحاولة إذا فشل عرض المودال (تُحذف من inQueue، تبقى خارج notified)
  const notified = new Set();
  const inQueue  = new Set();

  function toBoolish(value) {
    if (value === true || value === 1) return true;
    if (value === false || value === 0) return false;
    const s = String(value).trim();
    return s === "1" || s.toLowerCase() === "true";
  }

  function getEndTimeMs(session) {
    const ms = session?.limited_end_ms;
    if (ms !== undefined && ms !== null && ms !== "") {
      const n = Number(ms);
      if (!Number.isNaN(n) && n > 0) return n;
    }

    const raw = session?.limited_end_time;
    if (!raw) return null;
    const normalized = String(raw).replace(" ", "T");
    const t = new Date(normalized).getTime();
    if (!Number.isNaN(t)) return t;
    return null;
  }

  // ================================================================
  // واجهة عامة تستخدمها notification-queue.js للإبلاغ عن نتيجة المودال
  // ================================================================
  window.SessionMonitor = {
    // استُدعي بعد عرض المودال بنجاح وتفاعل المستخدم
    markShown: function (sessionId) {
      const key = String(sessionId);
      inQueue.delete(key);
      notified.add(key);
    },
    // استُدعي إذا فشل عرض المودال (Swal غير محمّل، خطأ شبكة، ...)
    // يُتيح إعادة المحاولة في الاستطلاع التالي
    markFailed: function (sessionId) {
      inQueue.delete(key); // bug-guard: تأكد من مسح الحالة للسماح بالإعادة
    }
  };

  // تصحيح خطأ مرجعي في markFailed (key غير معرّف) — نُعيد التعريف بشكل صحيح
  window.SessionMonitor.markFailed = function (sessionId) {
    const key = String(sessionId);
    inQueue.delete(key);
  };

  // ================================================================
  // إعدادات الأداء المحسّنة
  // ================================================================
  const POLLING_CONFIG = {
    ACTIVE_INTERVAL: 5000,   // 5 ثوانٍ (عند وجود جلسات محدودة نشطة)
    NORMAL_INTERVAL: 15000,  // 15 ثانية (طبيعي)
    IDLE_INTERVAL:   30000,  // 30 ثانية (عند عدم وجود جلسات)
    HIDDEN_INTERVAL: 60000,  // 60 ثانية (عند إخفاء التاب)
    MAX_RETRIES: 3,           // عدد محاولات إعادة الاتصال
  };

  let currentInterval = POLLING_CONFIG.NORMAL_INTERVAL;
  let intervalId = null;
  let consecutiveErrors = 0;
  let hasActiveSessions = false;

  // دالة فحص الجلسات المحدودة
  async function checkSessions() {
    // انتظار المزامنة الأولية
    if (!isTimeSynced) {
      return;
    }

    // إيقاف الفحص إذا تجاوز عدد الأخطاء الحد المسموح
    if (consecutiveErrors >= POLLING_CONFIG.MAX_RETRIES) {
      // إعادة المحاولة بعد 5 دقائق
      if (intervalId) {
        clearInterval(intervalId);
        setTimeout(restartMonitoring, 300000);
      }
      return;
    }

    try {
      // Timeout compatible across browsers (AbortSignal.timeout not supported everywhere)
      const controller = new AbortController();
      const timeoutId = setTimeout(() => controller.abort(), 10000);

      let response;
      try {
        response = await fetch(
          "api/session-actions.php?action=get_limited_sessions",
          {
            method: "GET",
            credentials: "same-origin",
            signal: controller.signal,
          }
        );
      } finally {
        clearTimeout(timeoutId);
      }

      if (!response.ok) {
        consecutiveErrors++;
        return;
      }

      const sessions = await response.json();

      if (!sessions.success) {
        consecutiveErrors++;
        return;
      }

      // إعادة تعيين عداد الأخطاء عند النجاح
      consecutiveErrors = 0;

      // استخدام الوقت المصحح من السيرفر
      const now = getCorrectTime();
      let activeSessionsFound = false;

      sessions.data.forEach((session) => {
        const isLimited = toBoolish(session?.is_limited);
        if (!isLimited) return;

        const endTime = getEndTimeMs(session);
        if (!endTime) return;

        const isPaused = toBoolish(session?.is_paused);
        const isExpired = now >= endTime;

        if (!isExpired && !isPaused) {
          activeSessionsFound = true;
        }

        const sessionKey = String(session?.id ?? "");
        if (!sessionKey) return;

        // عرض الإشعار فقط إذا:
        //  - الجلسة منتهية
        //  - لم يُعرض المودال بنجاح من قبل (notified)
        //  - لا يوجد إشعار في الطابور أو قيد المعالجة (inQueue)
        if (isExpired && !notified.has(sessionKey) && !inQueue.has(sessionKey)) {
          inQueue.add(sessionKey); // احجز المكان فوراً لمنع التكرار

          // تحديث DOM فوراً - إضافة علامة "مجمد"
          updateSessionCardUI(sessionKey, true);

          // استخدام نظام الطابور
          if (window.NotificationQueue) {
            window.NotificationQueue.addToQueue(session);
          } else {
            // NotificationQueue غير محمّل بعد — أعد للطابور لاحقاً
            inQueue.delete(sessionKey);
          }
        }
      });

      // تحديث الحالة وتعديل فترة الفحص
      hasActiveSessions = activeSessionsFound;
      adjustPollingInterval();
    } catch (error) {
      consecutiveErrors++;
      /* silent for production */
    }
  }

  // تعديل فترة الفحص بناءً على الحالة (محسّن)
  function adjustPollingInterval() {
    let newInterval;

    // إذا التاب مخفي، قلل الفحص بشكل كبير
    if (document.hidden) {
      newInterval = POLLING_CONFIG.HIDDEN_INTERVAL;
    }
    // إذا يوجد جلسات محدودة نشطة، فحص سريع
    else if (hasActiveSessions) {
      newInterval = POLLING_CONFIG.ACTIVE_INTERVAL;
    }
    // إذا لم يكن هناك جلسات نشطة، فحص متوسط
    else {
      newInterval = POLLING_CONFIG.IDLE_INTERVAL;
    }

    // إعادة تشغيل الفحص بالفترة الجديدة إذا تغيرت
    if (newInterval !== currentInterval) {
      currentInterval = newInterval;
      restartMonitoring();
    }
  }

  // تحديث واجهة المستخدم (DOM) عند انتهاء الجلسة
  function updateSessionCardUI(sessionId, isFrozen) {
    // البحث عن كارت الجلسة
    const sessionCard = document.querySelector(
      `.session-card[data-session-id="${sessionId}"]`
    );

    if (!sessionCard) return;

    // تحديث الخاصية data-is-paused
    sessionCard.setAttribute('data-is-paused', isFrozen ? '1' : '0');

    // البحث عن منطقة اسم الغرفة
    const roomNameDiv = sessionCard.closest('.session-details-wrapper')
      ?.previousElementSibling
      ?.querySelector('.session-room-name');

    if (!roomNameDiv) return;

    if (isFrozen) {
      // إضافة علامة "مجمد" إذا لم تكن موجودة
      let frozenBadge = roomNameDiv.querySelector('.frozen-badge');
      if (!frozenBadge) {
        frozenBadge = document.createElement('span');
        frozenBadge.className = 'frozen-badge';
        frozenBadge.style.cssText = 'background: #f44336; color: white; padding: 2px 8px; border-radius: 12px; font-size: 0.8rem; margin-right: 8px; animation: pulse 2s infinite;';
        frozenBadge.innerHTML = '⏸️ مجمد';
        roomNameDiv.appendChild(frozenBadge);
      }
    } else {
      // إزالة علامة "مجمد" إذا كانت موجودة
      const frozenBadge = roomNameDiv.querySelector('.frozen-badge');
      if (frozenBadge) {
        frozenBadge.remove();
      }
    }
  }

  // إعادة تشغيل المراقبة
  function restartMonitoring() {
    if (intervalId) {
      clearInterval(intervalId);
    }
    intervalId = setInterval(checkSessions, currentInterval);
    consecutiveErrors = 0; // إعادة تعيين عداد الأخطاء
  }

  // مراقبة حالة رؤية التاب (Visibility API)
  // عند إعادة ظهور التاب، نُطلق فحصاً فورياً لالتقاط أي جلسة انتهت أثناء الغياب
  document.addEventListener("visibilitychange", () => {
    if (!document.hidden) {
      checkSessions();
    }
    adjustPollingInterval();
  });

  // مراقبة حالة الاتصال بالإنترنت
  window.addEventListener("online", () => {
    consecutiveErrors = 0;
    restartMonitoring();
    checkSessions(); // فحص فوري عند عودة الاتصال
  });

  window.addEventListener("offline", () => {
    if (intervalId) {
      clearInterval(intervalId);
    }
  });

  // بدء المراقبة
  intervalId = setInterval(checkSessions, currentInterval);
  checkSessions(); // فحص فوري عند التحميل

  // تنظيف عند إغلاق الصفحة
  window.addEventListener("beforeunload", () => {
    if (intervalId) {
      clearInterval(intervalId);
    }
  });
})();
