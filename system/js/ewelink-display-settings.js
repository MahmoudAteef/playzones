/* Display settings frontend logic */
(function () {
  'use strict';

  const API = 'api/ewelink-client.php';
  const OAUTH_START = 'api/ewelink-oauth-start.php';

  let currentStatus = null;
  let devices = [];
  let mappings = [];
  let saveTimers = {};

  function $(id) { return document.getElementById(id); }

  function escapeHtml(value) {
    return String(value == null ? '' : value).replace(/[&<>"']/g, ch => ({
      '&': '&amp;', '<': '&lt;', '>': '&gt;', '"': '&quot;', "'": '&#039;'
    }[ch]));
  }

  function fmtDateTime(value) {
    if (!value) return '-';
    return String(value).replace('T', ' ').replace(/\.\d+Z?$/, '');
  }

  // ========================== Custom EW Select ==========================
  let _ewSelectGlobalBound = false;
  function bindGlobalCloseEwSelect() {
    if (_ewSelectGlobalBound) return;
    _ewSelectGlobalBound = true;
    document.addEventListener('click', (e) => {
      if (e.target.closest('.ew-select')) return;
      document.querySelectorAll('.ew-select[data-open="true"]').forEach(el => {
        el.dataset.open = 'false';
      });
    });
    document.addEventListener('keydown', (e) => {
      if (e.key === 'Escape') {
        document.querySelectorAll('.ew-select[data-open="true"]').forEach(el => {
          el.dataset.open = 'false';
        });
      }
    });
  }

  function enhanceSelect(selectEl) {
    if (!selectEl || selectEl.dataset.ewEnhanced === '1') return null;
    selectEl.dataset.ewEnhanced = '1';
    selectEl.classList.add('ew-select-native');

    const wrapper = document.createElement('div');
    wrapper.className = 'ew-select';
    wrapper.dataset.open = 'false';

    const parent = selectEl.parentNode;
    parent.insertBefore(wrapper, selectEl);
    wrapper.appendChild(selectEl);

    const trigger = document.createElement('button');
    trigger.type = 'button';
    trigger.className = 'ew-select-trigger';
    trigger.innerHTML = '<span class="ew-select-label placeholder"></span><i class="fas fa-chevron-down ew-chev"></i>';
    wrapper.appendChild(trigger);

    const menu = document.createElement('div');
    menu.className = 'ew-select-menu';
    menu.setAttribute('role', 'listbox');
    wrapper.appendChild(menu);

    function render() {
      const options = Array.from(selectEl.options);
      const current = selectEl.value;
      const labelEl = trigger.querySelector('.ew-select-label');

      let labelText = '';
      let isPlaceholder = false;
      const selectedOpt = options.find(o => o.value === current);

      if (selectedOpt && selectedOpt.value !== '') {
        labelText = selectedOpt.textContent;
      } else if (options.length) {
        labelText = options[0].textContent;
        isPlaceholder = true;
      }

      labelEl.textContent = labelText;
      labelEl.classList.toggle('placeholder', isPlaceholder);

      menu.innerHTML = options.map(o => `
        <button type="button" class="ew-select-option"
          data-value="${escapeHtml(o.value)}"
          data-selected="${o.value === current ? 'true' : 'false'}"
          data-disabled="${o.disabled ? 'true' : 'false'}">
          <span class="ew-select-option-text">${escapeHtml(o.textContent)}</span>
          <i class="fas fa-check ew-check"></i>
        </button>
      `).join('');

      menu.querySelectorAll('.ew-select-option').forEach(btn => {
        btn.addEventListener('click', (ev) => {
          ev.stopPropagation();
          if (btn.dataset.disabled === 'true') return;
          const val = btn.dataset.value;
          if (selectEl.value !== val) {
            selectEl.value = val;
            selectEl.dispatchEvent(new Event('change', { bubbles: true }));
          }
          wrapper.dataset.open = 'false';
          render();
        });
      });
    }

    trigger.addEventListener('click', (e) => {
      e.stopPropagation();
      const isOpen = wrapper.dataset.open === 'true';
      document.querySelectorAll('.ew-select[data-open="true"]').forEach(el => {
        if (el !== wrapper) el.dataset.open = 'false';
      });
      wrapper.dataset.open = isOpen ? 'false' : 'true';
    });

    selectEl.addEventListener('change', render);
    render();
    bindGlobalCloseEwSelect();
    return wrapper;
  }

  function refreshSelect(selectEl) {
    if (!selectEl) return;
    selectEl.dispatchEvent(new Event('change', { bubbles: false }));
  }

  // ========================== Modal & Toast ==========================

  function showModal({ type = 'info', title = '', message = '', actions = [{ label: 'حسناً', kind: 'confirm', value: true }], dismissible = true }) {
    return new Promise(resolve => {
      const root = $('ewModalRoot');
      const iconEl = $('ewModalIcon');
      const iconMap = {
        success: 'fa-circle-check',
        error: 'fa-circle-xmark',
        warning: 'fa-triangle-exclamation',
        info: 'fa-circle-info'
      };
      iconEl.className = 'ew-modal-icon ' + (type || 'info');
      iconEl.innerHTML = '<i class="fas ' + (iconMap[type] || 'fa-circle-info') + '"></i>';
      $('ewModalTitle').textContent = title || '';
      $('ewModalMessage').innerHTML = message || '';

      const actionsRoot = $('ewModalActions');
      actionsRoot.innerHTML = '';
      const safeActions = actions && actions.length ? actions : [{ label: 'حسناً', kind: 'confirm', value: true }];

      safeActions.forEach(act => {
        const btn = document.createElement('button');
        btn.type = 'button';
        btn.textContent = act.label || 'موافق';
        btn.className = act.kind === 'cancel' ? 'modal-cancel' : 'modal-confirm';
        btn.addEventListener('click', () => {
          root.classList.remove('active');
          resolve(act.value);
        });
        actionsRoot.appendChild(btn);
      });

      root.classList.add('active');

      function onOverlay(e) {
        if (!dismissible) return;
        if (e.target === root) {
          root.classList.remove('active');
          root.removeEventListener('click', onOverlay);
          resolve(null);
        }
      }
      root.addEventListener('click', onOverlay);
    });
  }

  function showAlert(type, title, message) {
    return showModal({ type, title, message, actions: [{ label: 'تم', kind: 'confirm', value: true }] });
  }

  function showConfirm(title, message) {
    return showModal({
      type: 'warning',
      title,
      message,
      actions: [
        { label: 'تأكيد', kind: 'confirm', value: true },
        { label: 'إلغاء', kind: 'cancel', value: false }
      ],
      dismissible: false
    });
  }

  function ensureToast() {
    let el = document.getElementById('ewToastEl');
    if (el) return el;
    el = document.createElement('div');
    el.id = 'ewToastEl';
    el.className = 'toast';
    el.style.cssText = 'position:fixed;bottom:20px;right:20px;z-index:9999;min-width:240px;max-width:90vw;padding:12px 16px;border-radius:12px;color:#fff;font-weight:600;box-shadow:0 12px 32px rgba(0,0,0,0.25);transform:translateY(20px);opacity:0;transition:all 0.25s;';
    document.body.appendChild(el);
    return el;
  }

  function toast(message, type) {
    const el = ensureToast();
    el.textContent = message;
    el.style.background = type === 'error' ? '#dc2626' : (type === 'warning' ? '#d97706' : '#059669');
    requestAnimationFrame(() => {
      el.style.transform = 'translateY(0)';
      el.style.opacity = '1';
    });
    clearTimeout(el._hideTimer);
    el._hideTimer = setTimeout(() => {
      el.style.transform = 'translateY(20px)';
      el.style.opacity = '0';
    }, 3000);
  }

  // ========================== API helpers ==========================

  async function apiGet(action) {
    try {
      const res = await fetch(`${API}?action=${encodeURIComponent(action)}`, { credentials: 'same-origin' });
      return await res.json();
    } catch (e) {
      return { success: false, message: 'تعذر الاتصال بالخادم' };
    }
  }

  async function apiPost(action, data = {}) {
    try {
      const res = await fetch(`${API}?action=${encodeURIComponent(action)}`, {
        method: 'POST',
        credentials: 'same-origin',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify(data)
      });
      return await res.json();
    } catch (e) {
      return { success: false, message: 'تعذر الاتصال بالخادم' };
    }
  }

  // ========================== Status & protection ==========================

  function updateConnectionUi(data) {
    currentStatus = data;
    const connection = data.connection || {};
    const protection = data.protection || {};
    const buttonAccess = data.connection_button_access || {};
    const connected = !!data.connected;
    const configured = !!data.configured;

    const badge = $('connectionBadge');
    const connectBtn = $('connectBtn');
    const connectLabel = $('connectBtnLabel');
    const disconnectBtn = $('disconnectBtn');
    const notCfg = $('notConfiguredBox');

    notCfg.style.display = configured ? 'none' : 'block';
    if (connected) {
      badge.textContent = 'مربوط';
      badge.className = 'badge badge-on';
    } else if (configured) {
      badge.textContent = 'غير مربوط';
      badge.className = 'badge badge-off';
    } else {
      badge.textContent = 'بانتظار إعداد المطور';
      badge.className = 'badge badge-warn';
    }

    $('connectedAccount').textContent = connection.email || connection.phone || '-';
    $('connectedRegion').textContent = data.region || '-';
    $('tokenExpiresAt').textContent = fmtDateTime(connection.token_expires_at);
    $('lastSyncAt').textContent = fmtDateTime(connection.last_devices_sync_at);

    const locked = connected && !buttonAccess.allowed;
    connectBtn.disabled = !configured;
    connectBtn.dataset.locked = locked ? '1' : '0';
    connectBtn.classList.toggle('is-locked', locked);
    connectBtn.title = locked ? 'هذا الزر مقفول. اضغط لإرسال طلب للسوبر أدمن.' : '';
    connectLabel.textContent = connected ? 'إعادة ربط الحساب' : 'ربط الحساب';
    disconnectBtn.style.display = connected ? 'inline-flex' : 'none';
    disconnectBtn.disabled = false;
    disconnectBtn.dataset.locked = locked ? '1' : '0';
    disconnectBtn.classList.toggle('is-locked', locked);
    disconnectBtn.title = locked ? 'هذا الزر مقفول. اضغط لإرسال طلب للسوبر أدمن.' : '';

    const oldNotice = $('connectionAccessNotice');
    if (oldNotice) oldNotice.remove();

    setSwitchValue('masterEnabledSwitch', protection.master_enabled);
    setSwitchValue('ownerSelfExcludedSwitch', protection.owner_self_excluded);
    setInputValue('debounceSecondsInput', protection.debounce_seconds);
    setInputValue('cooldownMaxInput', protection.cooldown_max_commands);
    setInputValue('cooldownWindowInput', protection.cooldown_window_minutes);
    setInputValue('cooldownPauseInput', protection.cooldown_pause_minutes);

    const cdBox = $('cooldownActiveBox');
    const cdBtn = $('clearCooldownBtn');
    if (protection.cooldown_active_until && new Date(protection.cooldown_active_until) > new Date()) {
      cdBox.style.display = 'block';
      cdBtn.style.display = 'inline-flex';
      $('cooldownActiveUntil').textContent = fmtDateTime(protection.cooldown_active_until);
    } else {
      cdBox.style.display = 'none';
      cdBtn.style.display = 'none';
    }
  }

  function setSwitchValue(id, value) {
    const el = $(id);
    if (!el) return;
    el.checked = !!value;
  }

  function setInputValue(id, value) {
    const el = $(id);
    if (!el) return;
    if (document.activeElement === el) return;
    el.value = (value === undefined || value === null) ? '' : value;
  }

  async function loadStatus() {
    const data = await apiGet('status');
    if (!data || !data.success) {
      toast(data && data.message ? data.message : 'فشل تحميل الحالة', 'error');
      return null;
    }
    updateConnectionUi(data);
    return data;
  }

  // ========================== OAuth ==========================

  async function startOAuth() {
    if (!currentStatus || !currentStatus.configured) {
      showAlert('warning', 'إعدادات المطور غير مكتملة', 'بعد موافقة dev.ewelink.cc يضع السوبر أدمن App ID وSecret وRedirect URI ثم يمكنك الربط.');
      return;
    }
    if (currentStatus.connected && $('connectBtn') && $('connectBtn').dataset.locked === '1') {
      await requestConnectionAccess('connect');
      return;
    }
    try {
      const res = await fetch(OAUTH_START, { credentials: 'same-origin' });
      const data = await res.json();
      if (!data || !data.success) {
        showAlert('error', 'فشل بدء الربط', data && data.message ? data.message : 'حدث خطأ أثناء توليد رابط الربط');
        return;
      }
      window.location.href = data.url;
    } catch (e) {
      showAlert('error', 'فشل بدء الربط', 'تعذر الاتصال بالخادم.');
    }
  }

  async function disconnectAccount() {
    if ($('disconnectBtn') && $('disconnectBtn').dataset.locked === '1') {
      await requestConnectionAccess('disconnect');
      return;
    }
    const ok = await showConfirm('فصل الحساب', 'سيتم حذف بيانات الربط من النظام. هل تريد المتابعة؟');
    if (!ok) return;
    const data = await apiPost('disconnect');
    if (!data.success) {
      showAlert('error', 'فشل فصل الحساب', data.message || 'حاول مرة أخرى');
      return;
    }
    toast('تم فصل الحساب');
    await loadStatus();
  }

  async function requestConnectionAccess(buttonAction) {
    const data = await apiPost('request_connection_access', { button_action: buttonAction });
    if (!data.success) {
      showAlert('warning', 'طلب صلاحية الربط', data.message || 'تم تسجيل الطلب للسوبر أدمن.');
      await loadStatus();
      return;
    }
    showAlert('success', 'تم إرسال الطلب', data.message || 'تم إرسال طلبك إلى الإدارة.');
    await loadStatus();
  }

  // ========================== Auto-save ==========================

  function debouncedSave(key, getValue, delay = 500) {
    return function () {
      clearTimeout(saveTimers[key]);
      saveTimers[key] = setTimeout(async () => {
        const payload = {};
        payload[key] = getValue();
        const data = await apiPost('update_settings', payload);
        if (!data.success) {
          toast(data.message || 'فشل الحفظ', 'error');
          return;
        }
        toast('تم الحفظ');
        if (data.protection) {
          const cdBox = $('cooldownActiveBox');
          const cdBtn = $('clearCooldownBtn');
          if (data.protection.cooldown_active_until && new Date(data.protection.cooldown_active_until) > new Date()) {
            cdBox.style.display = 'block';
            cdBtn.style.display = 'inline-flex';
          }
        }
      }, delay);
    };
  }

  function bindSwitch(id, key) {
    const el = $(id);
    if (!el) return;
    const handler = debouncedSave(key, () => el.checked ? 1 : 0, 0);
    el.addEventListener('change', handler);
  }

  function bindNumberInput(id, key) {
    const el = $(id);
    if (!el) return;
    const handler = debouncedSave(key, () => Number(el.value || 0), 600);
    el.addEventListener('input', handler);
    el.addEventListener('blur', handler);
  }

  async function clearCooldown() {
    const ok = await showConfirm('إنهاء التهدئة', 'هل تريد إنهاء فترة التهدئة الحالية الآن؟');
    if (!ok) return;
    const data = await apiPost('clear_cooldown');
    if (!data.success) {
      toast(data.message || 'فشل الإنهاء', 'error');
      return;
    }
    toast('تم إنهاء التهدئة');
    await loadStatus();
  }

  // ========================== Devices & Mappings ==========================

  async function loadDevices(silent) {
    if (!currentStatus || !currentStatus.connected) {
      if (!silent) {
        showAlert('warning', 'الحساب غير مربوط', 'اربط الحساب أولاً ثم جرّب جلب الأجهزة.');
      }
      return;
    }

    const box = $('devicesList');
    if (!silent) box.innerHTML = '<div>جاري الجلب...</div>';
    const data = await apiGet('devices');
    if (!data.success) {
      if (!silent) box.innerHTML = '<div style="color:#dc2626">' + escapeHtml(data.message || 'فشل جلب الأجهزة') + '</div>';
      return;
    }

    devices = data.devices || [];
    if (!devices.length) {
      box.innerHTML = '<div>لا توجد أجهزة مرتبطة.</div>';
      renderMappings();
      return;
    }

    box.innerHTML = devices.map(d => `
      <div style="background:#f8fafc;border:1px solid #e2e8f0;border-radius:10px;padding:10px 12px;margin-bottom:6px;">
        <div style="font-weight:700;color:#0f172a;">${escapeHtml(d.name || d.device_id)}</div>
        <div style="font-size:0.78rem;color:#64748b;margin-top:2px;">
          ${escapeHtml(d.device_id)} · ${d.channel_count} قناة · ${d.online ? 'Online' : 'Offline'}
        </div>
      </div>
    `).join('');

    renderMappings();
    if (!silent) toast('تم جلب الأجهزة');
  }

  async function loadMappings() {
    const data = await apiGet('mappings');
    if (!data.success) {
      $('mappingsContainer').innerHTML = '<div style="grid-column:1 / -1;padding:20px;text-align:center;color:#dc2626">' + escapeHtml(data.message || 'فشل تحميل الغرف') + '</div>';
      return;
    }
    mappings = data.rooms || [];
    renderMappings();
  }

  /**
   * يُعيد Set لكل القنوات (outlets) المستخدمة على جهاز معيّن من بقية الغرف،
   * مع استثناء roomId الحالي (لأن قناتها المحفوظة يجب أن تظل متاحة في قائمتها).
   */
  function getUsedOutlets(deviceId, excludeRoomId) {
    const used = new Set();
    if (!deviceId) return used;
    for (const r of mappings) {
      if (Number(r.id) === Number(excludeRoomId)) continue;
      if (!r.device_id || r.device_id !== deviceId) continue;
      if (Number(r.enabled == null ? 1 : r.enabled) !== 1) continue;
      if (r.outlet == null || r.outlet === '') continue;
      used.add(Number(r.outlet));
    }
    return used;
  }

  function deviceOptions(selectedId, roomId) {
    if (!devices.length) {
      const fallback = selectedId
        ? `<option value="${escapeHtml(selectedId)}" selected>${escapeHtml(selectedId)} (لم تُجلب الأجهزة)</option>`
        : '';
      return `<option value="">اختر الجهاز</option>` + fallback;
    }

    const list = devices.map(d => {
      const used = getUsedOutlets(d.device_id, roomId);
      const total = Math.max(1, d.channel_count || 4);
      const isFull = used.size >= total;
      const isSelected = d.device_id === selectedId;
      const disabledAttr = (isFull && !isSelected) ? 'disabled' : '';
      const remaining = Math.max(0, total - used.size);
      const suffix = isFull
        ? ' (مكتمل)'
        : (used.size > 0 ? ` (${remaining} قنوات متاحة)` : '');
      return `<option value="${escapeHtml(d.device_id)}"
        data-name="${escapeHtml(d.name || '')}"
        data-channels="${d.channel_count}"
        ${isSelected ? 'selected' : ''} ${disabledAttr}>${escapeHtml(d.name || d.device_id)}${suffix}</option>`;
    }).join('');

    return `<option value="">اختر الجهاز</option>` + list;
  }

  function outletOptions(selectedOutlet, deviceId, roomId) {
    const dev = devices.find(d => d.device_id === deviceId);
    const count = dev ? Math.max(1, dev.channel_count || 4) : 4;
    const used = getUsedOutlets(deviceId, roomId);
    const sel = (selectedOutlet === null || selectedOutlet === undefined || selectedOutlet === '') ? null : Number(selectedOutlet);

    // لو القيمة المختارة محجوزة فعلياً (نظري) أو لم تُحدد، نختار أول قناة متاحة
    const optionsHtml = [];
    let firstAvailable = null;
    for (let i = 0; i < count; i++) {
      const isSelected = sel === i;
      const isUsed = used.has(i) && !isSelected;
      if (firstAvailable === null && !isUsed) firstAvailable = i;
      optionsHtml.push(`<option value="${i}" ${isSelected ? 'selected' : ''} ${isUsed ? 'disabled' : ''}>قناة ${i + 1}${isUsed ? ' (محجوزة)' : ''}</option>`);
    }

    // لو لا قناة محددة ولا متاحة (كل القنوات محجوزة): نُبقي الخيارات معطّلة كما هي
    return optionsHtml.join('');
  }

  function renderMappings() {
    const root = $('mappingsContainer');
    if (!mappings.length) {
      root.innerHTML = '<div style="grid-column:1 / -1;padding:30px;text-align:center;color:#64748b;">لا توجد غرف.</div>';
      return;
    }

    root.innerHTML = mappings.map(room => {
      const selDev = room.device_id || '';
      const enabled = Number(room.enabled == null ? 1 : room.enabled) === 1;
      return `
        <div class="room-card" data-room-id="${room.id}">
          <div class="room-card-head">
            <div>
              <div class="room-card-title">${escapeHtml(room.name)}</div>
              <div class="room-card-sub">${escapeHtml(room.device_type || '')}</div>
            </div>
            <label class="switch" title="تشغيل/إيقاف الربط لهذه الغرفة">
              <input type="checkbox" class="row-enabled" ${enabled ? 'checked' : ''}>
              <span class="slider"></span>
            </label>
          </div>

          <div class="field-block">
            <div class="field-label">الجهاز</div>
            <select class="ew-input row-device">${deviceOptions(selDev, room.id)}</select>
          </div>

          <div class="field-block">
            <div class="field-label">القناة</div>
            <select class="ew-input row-outlet">${outletOptions(room.outlet == null ? null : room.outlet, selDev, room.id)}</select>
          </div>

          ${room.last_tested_at ? `<div class="card-subtitle">آخر اختبار: ${escapeHtml(fmtDateTime(room.last_tested_at))}</div>` : ''}

          <div class="room-actions">
            <button type="button" class="btn-save" data-act="save"><i class="fas fa-save"></i> حفظ</button>
            <button type="button" class="btn-on" data-act="on">ON</button>
            <button type="button" class="btn-off" data-act="off">OFF</button>
            <button type="button" class="btn-del" data-act="del"><i class="fas fa-trash"></i></button>
          </div>
        </div>
      `;
    }).join('');

    root.querySelectorAll('.room-card').forEach(card => {
      const roomId = Number(card.dataset.roomId);
      const devSel = card.querySelector('.row-device');
      const outSel = card.querySelector('.row-outlet');

      devSel.addEventListener('change', () => {
        const selectedId = devSel.value;
        // عند تبديل الجهاز نختار أول قناة متاحة (null = بدون قيمة محددة مسبقاً)
        outSel.innerHTML = outletOptions(null, selectedId, roomId);
        // لو ما فيش option selected، اختر أول option غير معطّل
        const firstEnabled = Array.from(outSel.options).find(o => !o.disabled);
        if (firstEnabled) outSel.value = firstEnabled.value;
        refreshSelect(outSel);
      });

      enhanceSelect(devSel);
      enhanceSelect(outSel);

      card.querySelectorAll('button[data-act]').forEach(btn => {
        const act = btn.dataset.act;
        btn.addEventListener('click', () => handleRoomAction(roomId, act, card));
      });
    });
  }

  async function handleRoomAction(roomId, act, card) {
    if (act === 'save') return saveMapping(roomId, card);
    if (act === 'del') return deleteMapping(roomId);
    if (act === 'on' || act === 'off') return testChannel(roomId, act);
  }

  async function saveMapping(roomId, card) {
    const devSel = card.querySelector('.row-device');
    const outSel = card.querySelector('.row-outlet');
    const enableEl = card.querySelector('.row-enabled');
    const deviceId = devSel.value;

    if (!deviceId) {
      showAlert('warning', 'اختر جهازاً', 'يجب اختيار جهاز قبل حفظ ربط هذه الغرفة.');
      return;
    }

    const outletOpt = outSel.options[outSel.selectedIndex];
    if (outletOpt && outletOpt.disabled) {
      showAlert('warning', 'القناة محجوزة', 'هذه القناة مستخدمة بالفعل في غرفة أخرى على نفس الجهاز. اختر قناة أخرى متاحة.');
      return;
    }

    const opt = devSel.options[devSel.selectedIndex];
    const data = await apiPost('save_mapping', {
      room_id: roomId,
      device_id: deviceId,
      device_name: opt && opt.dataset.name ? opt.dataset.name : '',
      outlet: Number(outSel.value || 0),
      enabled: enableEl && enableEl.checked ? 1 : 0
    });

    if (!data.success) {
      showAlert('error', 'فشل الحفظ', data.message || '');
      return;
    }
    toast('تم حفظ الربط');
    loadMappings();
  }

  async function deleteMapping(roomId) {
    const ok = await showConfirm('حذف ربط الغرفة', 'سيتم حذف ربط هذه الغرفة. هل أنت متأكد؟');
    if (!ok) return;
    const data = await apiPost('delete_mapping', { room_id: roomId });
    if (!data.success) {
      showAlert('error', 'فشل الحذف', data.message || '');
      return;
    }
    toast('تم الحذف');
    loadMappings();
  }

  async function testChannel(roomId, sw) {
    const data = await apiPost('test_channel', { room_id: roomId, switch: sw });
    if (!data.success) {
      const reasonMap = {
        master_off: { type: 'warning', title: 'السويتش الرئيسي مغلق' },
        cooldown: { type: 'warning', title: 'فترة تهدئة نشطة' },
        cooldown_started: { type: 'warning', title: 'تم تجاوز عدد الأوامر' },
        debounce: { type: 'info', title: 'يجب الانتظار قليلاً' }
      };
      const cfg = data.throttled && reasonMap[data.reason] ? reasonMap[data.reason] : null;
      if (cfg) {
        showAlert(cfg.type, cfg.title, escapeHtml(data.message || ''));
      } else {
        showAlert('error', 'فشل اختبار القناة', data.message || '');
      }
      if (data.throttled) loadStatus();
      return;
    }
    toast(sw === 'on' ? 'تم تشغيل القناة' : 'تم إيقاف القناة');
    loadMappings();
    loadStatus();
  }

  // ========================== Init ==========================

  function bindEvents() {
    $('connectBtn') && $('connectBtn').addEventListener('click', startOAuth);
    $('disconnectBtn') && $('disconnectBtn').addEventListener('click', disconnectAccount);
    $('loadDevicesBtn') && $('loadDevicesBtn').addEventListener('click', loadDevices);
    $('loadMappingsBtn') && $('loadMappingsBtn').addEventListener('click', loadMappings);
    $('clearCooldownBtn') && $('clearCooldownBtn').addEventListener('click', clearCooldown);

    bindSwitch('masterEnabledSwitch', 'master_enabled');
    bindSwitch('ownerSelfExcludedSwitch', 'owner_self_excluded');
    bindNumberInput('debounceSecondsInput', 'debounce_seconds');
    bindNumberInput('cooldownMaxInput', 'cooldown_max_commands');
    bindNumberInput('cooldownWindowInput', 'cooldown_window_minutes');
    bindNumberInput('cooldownPauseInput', 'cooldown_pause_minutes');
  }

  async function init() {
    if (!$('mappingsContainer')) return;
    bindEvents();
    await loadStatus();
    await loadMappings();

    // auto-load للأجهزة لو الحساب مربوط حتى تظهر القوائم بدون ضغط يدوي
    if (currentStatus && currentStatus.connected) {
      try { await loadDevices(true); } catch (e) { /* ignore */ }
    }

    const params = new URLSearchParams(window.location.search);
    const ewStatus = params.get('ewelink');
    const ewMessage = params.get('message');
    if (ewStatus === 'connected') {
      showAlert('success', 'تم الربط بنجاح', escapeHtml(ewMessage || 'تم ربط الحساب بنجاح.'));
      params.delete('ewelink');
      params.delete('message');
      const newUrl = window.location.pathname + (params.toString() ? ('?' + params.toString()) : '');
      window.history.replaceState({}, '', newUrl);
    } else if (ewStatus === 'error') {
      showAlert('error', 'تعذّر إكمال الربط', escapeHtml(ewMessage || 'حدث خطأ أثناء ربط الحساب.'));
      params.delete('ewelink');
      params.delete('message');
      const newUrl = window.location.pathname + (params.toString() ? ('?' + params.toString()) : '');
      window.history.replaceState({}, '', newUrl);
    }
  }

  document.addEventListener('DOMContentLoaded', init);
})();
