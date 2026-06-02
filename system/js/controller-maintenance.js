/**
 * Controller Maintenance Module - Stage 4 Enhancements
 */
(function() {
  'use strict';

  if (!window.controllerMaintenance) {
    console.warn('[ControllerMaintenance] البيانات الأولية غير متوفرة بعد.');
    return;
  }

  const BUTTON_LABELS = [
    'X', 'دائرة', 'مربع', 'مثلث', 'L1', 'R1', 'L2', 'R2',
    'Share', 'Options', 'L3', 'R3', 'اتجاه ↑', 'اتجاه ↓',
    'اتجاه ←', 'اتجاه →', 'PS', 'Touchpad'
  ];
  const ANALOG_AXIS_LABELS = [
    'المحور X - العصا اليسرى',
    'المحور Y - العصا اليسرى',
    'المحور X - العصا اليمنى',
    'المحور Y - العصا اليمنى',
    'محور إضافي 5',
    'محور إضافي 6',
    'محور إضافي 7',
    'محور إضافي 8'
  ];
  const AXIS_DIRECTION_LABELS = [
    { positive: 'يمين', negative: 'يسار' },
    { positive: 'أسفل', negative: 'أعلى' },
    { positive: 'يمين', negative: 'يسار' },
    { positive: 'أسفل', negative: 'أعلى' }
  ];

  /**
   * Threshold configuration for dynamic health evaluation.
   * يمكن تعديل هذه القيم لاحقاً من الإعدادات أو من قاعدة البيانات إذا لزم الأمر.
   */
  const HEALTH_THRESHOLDS = {
    axes: {
      excellent: 0.05, // الانحراف في الوضع المحايد ممتاز إذا ≤5%
      good: 0.10,      // جيد حتى 10%
      acceptable: 0.18,// مقبول حتى 18%
      warn: 0.25,      // أكثر من ذلك خلل بسيط
      neutralActive: 0.35, // أعلى من ذلك يعتبر حركة نشطة وليست قياساً للانحراف
      maxTest: 0.4,        // يجب أن يتجاوز هذا الحد أثناء الاختبار ليُعدّ اختباراً فعلياً
      maxExpected: 0.95    // القيمة المثالية القصوى المتوقعة
    },
    buttons: {
      idle: 0.05,      // ≤0.05 قيمة في الوضع الساكن تعتبر سليمة
      drift: 0.15,     // >0.15 مؤشر خلل بسيط
      stuck: 0.30      // ≥0.30 يعتبر زر عالق بشدة
    }
  };

  const HEALTH_RATINGS = {
    excellent: { label: 'ممتاز', score: 1.0, tone: 'success' },
    good: { label: 'جيد', score: 0.9, tone: 'success' },
    acceptable: { label: 'مقبول', score: 0.75, tone: 'info' },
    minor: { label: 'خلل بسيط', score: 0.5, tone: 'warning' },
    major: { label: 'خلل كبير', score: 0.25, tone: 'danger' }
  };

  const STATUS_TONES = {
    ok: 'calm',
    needs_attention: 'warn',
    faulty: 'error',
    in_progress: 'info'
  };

  const STATUS_BADGE_CLASS = {
    calm: 'bg-sky-500/25 text-sky-200 border border-sky-400/30',
    warn: 'bg-amber-500/25 text-amber-200 border border-amber-400/40',
    error: 'bg-rose-500/25 text-rose-100 border border-rose-500/40',
    info: 'bg-indigo-500/25 text-indigo-200 border border-indigo-400/40',
    default: 'bg-slate-500/20 text-slate-200 border border-slate-500/30'
  };

  const RATING_PRIORITY = ['major', 'minor', 'acceptable', 'good', 'excellent'];
  const AXIS_NEUTRAL_THRESHOLD = 0.12;
  const AXIS_NEUTRAL_REQUIRED = 5;
  const AXIS_ACTIVE_THRESHOLD = 0.35;
  const AXIS_EXPECTED_MAX = 0.95;
  const AXIS_MINOR_MAX = 0.85;
  const TONE_CLASS_MAP = {
    success: 'bg-emerald-500 text-white',
    info: 'bg-sky-500 text-white',
    warning: 'bg-amber-400 text-slate-900',
    danger: 'bg-rose-600 text-white'
  };

  function ratingInfo(key) {
    return HEALTH_RATINGS[key] || HEALTH_RATINGS.acceptable;
  }

  function mergeRatings(current, candidate) {
    if (!candidate) return current || 'excellent';
    if (!current) return candidate;
    const currentIndex = RATING_PRIORITY.indexOf(current);
    const candidateIndex = RATING_PRIORITY.indexOf(candidate);
    if (candidateIndex === -1) {
      return current;
    }
    if (currentIndex === -1 || candidateIndex < currentIndex) {
      return candidate;
    }
    return current;
  }

  function classifyAxis(absValue) {
    if (absValue <= HEALTH_THRESHOLDS.axes.excellent) return 'excellent';
    if (absValue <= HEALTH_THRESHOLDS.axes.good) return 'good';
    if (absValue <= HEALTH_THRESHOLDS.axes.acceptable) return 'acceptable';
    if (absValue <= HEALTH_THRESHOLDS.axes.warn) return 'minor';
    return 'major';
  }

  function classifyButton(value) {
    const abs = Math.abs(value);
    if (abs <= HEALTH_THRESHOLDS.buttons.idle) return 'excellent';
    if (abs <= HEALTH_THRESHOLDS.buttons.drift) return 'minor';
    if (abs <= HEALTH_THRESHOLDS.buttons.stuck) return 'major';
    return 'major';
  }

  function classifyRange(maxValue) {
    if (maxValue >= AXIS_EXPECTED_MAX) return null;
    if (maxValue >= AXIS_MINOR_MAX) return 'minor';
    return 'major';
  }

  function evaluateAxes(axes, monitor = [], axisMetrics = []) {
    const driftItems = [];
    const rangeItems = [];
    const activeAxes = [];
    let rating = 'excellent';
    const coverage = {
      total: axes.length,
      tested: 0,
      fullRange: 0,
      partialRange: 0,
      missing: 0
    };

    axes.forEach(function(value, index) {
      const mon = monitor[index];
      const metric = axisMetrics[index] || {};
      const abs = Math.abs(value);
      const directionPositive = getAxisDirectionText(index, true);
      const directionNegative = getAxisDirectionText(index, false);
      const maxMagnitude = Math.max(
        Math.abs(metric.maxPositive || 0),
        Math.abs(metric.maxNegative || 0)
      );

      if (maxMagnitude >= AXIS_ACTIVE_THRESHOLD) {
        coverage.tested += 1;
        if (maxMagnitude >= AXIS_EXPECTED_MAX) {
          coverage.fullRange += 1;
        } else {
          coverage.partialRange += 1;
        }
      } else {
        coverage.missing += 1;
      }

      if (abs >= AXIS_ACTIVE_THRESHOLD) {
        activeAxes.push({
          index,
          axis: index + 1,
          percent: Math.round(abs * 100),
          direction: value >= 0 ? directionPositive : directionNegative,
          ratingKey: 'excellent'
        });
      }

      if (!mon) {
        const classification = classifyAxis(abs);
        rating = mergeRatings(rating, classification);
        if (classification !== 'excellent' && classification !== 'good') {
          driftItems.push({
            index,
            axis: index + 1,
            value,
            percent: Math.round(abs * 100),
            direction: value >= 0 ? directionPositive : directionNegative,
            ratingKey: classification
          });
        }
        return;
      }

      if (mon.neutralReady) {
        if (!mon.driftReported) {
          const classification = classifyAxis(mon.lastValue);
          rating = mergeRatings(rating, classification);
          if (classification !== 'excellent' && classification !== 'good') {
            driftItems.push({
              index,
              axis: index + 1,
              value: mon.lastValue,
              percent: Math.round(Math.abs(mon.lastValue) * 100),
              direction: mon.lastValue >= 0 ? directionPositive : directionNegative,
              ratingKey: classification
            });
          }
          mon.driftReported = true;
        }

        if (mon.maxPositive >= AXIS_ACTIVE_THRESHOLD) {
          const rangeClass = classifyRange(mon.maxPositive);
          if (rangeClass) {
            rating = mergeRatings(rating, rangeClass);
            rangeItems.push({
              index,
              axis: index + 1,
              percent: Math.round(mon.maxPositive * 100),
              direction: directionPositive,
              ratingKey: rangeClass
            });
          }
        }

        if (mon.maxNegative >= AXIS_ACTIVE_THRESHOLD) {
          const rangeClass = classifyRange(mon.maxNegative);
          if (rangeClass) {
            rating = mergeRatings(rating, rangeClass);
            rangeItems.push({
              index,
              axis: index + 1,
              percent: Math.round(mon.maxNegative * 100),
              direction: directionNegative,
              ratingKey: rangeClass
            });
          }
        }

        mon.maxPositive = 0;
        mon.maxNegative = 0;
        mon.neutralReady = false;
      }

      const persistentDrift = mon && !mon.driftReported && mon.offCenterFrames >= AXIS_DRIFT_PERSIST_FRAMES;
      if (persistentDrift) {
        const driftValue = mon.lastValue;
        const absDrift = Math.abs(driftValue);
        const classification = classifyAxis(absDrift);
        rating = mergeRatings(rating, classification);
        if (classification !== 'excellent' && classification !== 'good') {
          driftItems.push({
            index,
            axis: index + 1,
            value: driftValue,
            percent: Math.round(absDrift * 100),
            direction: driftValue >= 0 ? directionPositive : directionNegative,
            ratingKey: classification
          });
        }
        mon.driftReported = true;
      }
    });

    return { drift: driftItems, range: rangeItems, active: activeAxes, ratingKey: rating, coverage };
  }

  function evaluateButtons(buttons, buttonMetrics = []) {
    const issues = [];
    const pressed = [];
    let rating = 'excellent';
    const coverage = {
      total: buttons.length,
      tested: 0,
      fullPress: 0,
      weak: 0,
      missing: 0
    };

    buttons.forEach(function(btn, index) {
      const metric = buttonMetrics[index] || {};
      const liveValue = Number(btn?.value || 0);
      const maxValue = Math.max(liveValue, Number(metric.maxValue || 0));
      const pressCount = Number(metric.pressedCount || 0);
      const label = BUTTON_LABELS[index] || `زر ${index}`;

      if (btn.pressed || liveValue > 0.4) {
        pressed.push({
          index,
          label,
          value: Number(liveValue.toFixed(2))
        });
      }

      if (maxValue >= 0.4) {
        coverage.tested += 1;
        if (maxValue >= 0.9) {
          coverage.fullPress += 1;
        } else {
          coverage.weak += 1;
        }
      } else {
        coverage.missing += 1;
      }

      if (maxValue < 0.2) {
        rating = mergeRatings(rating, 'major');
        issues.push({
          index,
          label,
          value: Number(maxValue.toFixed(2)),
          ratingKey: 'major',
          status: pressCount > 0 ? 'no-response' : 'untested'
        });
        return;
      }

      if (maxValue < 0.4) {
        rating = mergeRatings(rating, 'minor');
        issues.push({
          index,
          label,
          value: Number(maxValue.toFixed(2)),
          ratingKey: 'minor',
          status: 'weak'
        });
        return;
      }

      if (maxValue < 0.9) {
        rating = mergeRatings(rating, 'acceptable');
        issues.push({
          index,
          label,
          value: Number(maxValue.toFixed(2)),
          ratingKey: 'acceptable',
          status: 'partial'
        });
      }
    });

    return { items: issues, ratingKey: rating, pressed, coverage };
  }

  function buildAxisSummary(axesEval) {
    const lines = [];

    if (axesEval.drift.length) {
      axesEval.drift.forEach(function(item) {
        const info = ratingInfo(item.ratingKey);
        lines.push(`محور ${item.axis}: انحراف ${item.percent}% ${item.direction} – ${info.label}`);
      });
    }

    if (axesEval.range.length) {
      axesEval.range.forEach(function(item) {
        const info = ratingInfo(item.ratingKey);
        lines.push(`محور ${item.axis}: أقصى استجابة ${item.percent}% ${item.direction} – ${info.label}`);
      });
    }

    if (!axesEval.drift.length && !axesEval.range.length) {
      lines.push('الأنالوج في الوضع الطبيعي.');
    }

    if (axesEval.active.length) {
      axesEval.active.forEach(function(item) {
        const info = ratingInfo(item.ratingKey || 'excellent');
        lines.push(`محور ${item.axis} قيد الاختبار (${item.percent}% نحو ${item.direction}) – ${info.label}.`);
      });
    }

    return lines;
  }

  function buildButtonSummary(buttonIssues, pressed) {
    const lines = [];
    if (buttonIssues.length) {
      buttonIssues.forEach(function(issue) {
        const info = ratingInfo(issue.ratingKey);
        lines.push(`الزر ${issue.label}: قيمة ${issue.value.toFixed(2)} – ${info.label}`);
      });
    } else {
      lines.push('الأزرار سليمة (بدون ضغط).');
    }

    if (pressed.length) {
      const pressedNames = pressed.map(function(p) {
        return `${p.label} (${p.value.toFixed(2)})`;
      }).join('، ');
      lines.push(`أزرار قيد الاختبار حالياً: ${pressedNames}.`);
    }

    return lines;
  }

  function analyzeSnapshot(snapshot, axisMonitor = []) {
    const axisMetrics = Array.isArray(snapshot.metrics?.axes) ? snapshot.metrics.axes : [];
    const buttonMetrics = Array.isArray(snapshot.metrics?.buttons) ? snapshot.metrics.buttons : [];

    const axesEval = evaluateAxes(snapshot.axes || [], axisMonitor, axisMetrics);
    const buttonsEval = evaluateButtons(snapshot.buttons || [], buttonMetrics);

    const buttonCoverageRatio = buttonsEval.coverage.total
      ? buttonsEval.coverage.tested / buttonsEval.coverage.total
      : 1;
    const axisCoverageRatio = axesEval.coverage.total
      ? axesEval.coverage.tested / axesEval.coverage.total
      : 1;

    let coverageRating = 'excellent';
    if (buttonCoverageRatio < 0.6 || axisCoverageRatio < 0.6) {
      coverageRating = 'major';
    } else if (buttonCoverageRatio < 0.8 || axisCoverageRatio < 0.8) {
      coverageRating = 'minor';
    } else if (buttonCoverageRatio < 0.95 || axisCoverageRatio < 0.95) {
      coverageRating = 'acceptable';
    }

    if (buttonsEval.coverage.missing > 0) {
      coverageRating = mergeRatings(coverageRating, 'major');
    } else if (buttonsEval.coverage.weak > 0) {
      coverageRating = mergeRatings(coverageRating, 'minor');
    }

    let overallRating = 'excellent';
    overallRating = mergeRatings(overallRating, axesEval.ratingKey);
    overallRating = mergeRatings(overallRating, buttonsEval.ratingKey);
    overallRating = mergeRatings(overallRating, coverageRating);

    const summaryLines = [
      `<strong>التقييم العام:</strong> ${ratingInfo(overallRating).label}`
    ];

    summaryLines.push(...buildAxisSummary(axesEval));
    summaryLines.push(...buildButtonSummary(buttonsEval.items, buttonsEval.pressed));

    const coverageLineButtons = `تغطية الأزرار: ${buttonsEval.coverage.tested}/${buttonsEval.coverage.total} (${Math.round(buttonCoverageRatio * 100)}%).`;
    const coverageLineAxes = `تغطية المحاور: ${axesEval.coverage.tested}/${axesEval.coverage.total} (${Math.round(axisCoverageRatio * 100)}%).`;
    summaryLines.push(coverageLineButtons);
    summaryLines.push(coverageLineAxes);

    const payload = {
      axes: {
        drift: axesEval.drift.map(function(item) {
          return {
            index: item.index,
            axis: item.axis,
            percent: item.percent,
            direction: item.direction,
            rating: item.ratingKey
          };
        }),
        range: axesEval.range.map(function(item) {
          return {
            index: item.index,
            axis: item.axis,
            percent: item.percent,
            direction: item.direction,
            rating: item.ratingKey
          };
        }),
        active: axesEval.active.map(function(item) {
          return {
            index: item.index,
            axis: item.axis,
            percent: item.percent,
            direction: item.direction,
            rating: item.ratingKey || 'excellent'
          };
        })
      },
      buttons: buttonsEval.items.map(function(item) {
        return {
          index: item.index,
          label: item.label,
          value: item.value,
          rating: item.ratingKey,
          status: item.status || null
        };
      }),
      pressed: buttonsEval.pressed.map(function(item) {
        return {
          index: item.index,
          label: item.label,
          value: item.value
        };
      }),
      coverage: {
        buttons: Object.assign({}, buttonsEval.coverage, { ratio: buttonCoverageRatio }),
        axes: Object.assign({}, axesEval.coverage, { ratio: axisCoverageRatio })
      },
      overallRating,
      overallLabel: ratingInfo(overallRating).label
    };

    return {
      axes: axesEval,
      buttons: buttonsEval,
      coverage: payload.coverage,
      ratingKey: overallRating,
      overall: ratingInfo(overallRating),
      summaryLines,
      payload
    };
  }

  const state = {
    apiUrl: 'api/controller-maintenance.php',
    stage: window.controllerMaintenance.stage || 'interactive',
    clientId: window.controllerMaintenance.clientId || null,
    controllers: [],
    checks: [],
    summaryTouched: false,
    isCreateControllerOpen: false,
    editControllerId: null,
    deleteControllerId: null,
    editCheckId: null,
    deleteCheckIds: [],
    selectedCheckIds: new Set(),
    buttonMetrics: [],
    axisMetrics: [],
    activeGamepadIndex: null,
    gamepadLoopId: null,
    lastSnapshot: null,
    axisMonitor: [],
    lastAnalysis: null,
    lastSummaryText: '',
    currentAxes: [],
    currentPressedButtons: [],
    generatedIssues: {},
    successToastTimer: null,
    controllerFilters: {
      search: '',
      controller_status: ''
    },
    checkFilters: {
      status: '',
      controller_id: '',
      date_from: '',
      date_to: ''
    },
    checkPagination: {
      page: 1,
      perPage: 15,
      total: 0,
      totalPages: 1
    }
  };

  const dom = {
    controllersTable: document.getElementById('controllers-table'),
    controllersEmpty: document.getElementById('controllers-empty'),
    controllersContainer: document.querySelector('[data-role="controllers-container"]'),
    controllerFilterForm: document.querySelector('[data-role="controller-filter-form"]'),
    checksEmpty: document.getElementById('checks-empty'),
    checksContainer: document.querySelector('[data-role="checks-container"]'),
    checksFilterForm: document.querySelector('[data-role="checks-filter-form"]'),
    checksControllerFilter: document.querySelector('[data-role="checks-controller-filter"]'),
    checksBulkBar: document.querySelector('[data-role="checks-bulk-bar"]'),
    selectAllChecks: document.querySelector('[data-role="select-all-checks"]'),
    selectedChecksInfo: document.querySelector('[data-role="selected-checks-info"]'),
    selectedChecksCount: document.querySelector('[data-role="selected-checks-count"]'),
    checksDateFrom: document.querySelector('[data-role="checks-date-from"]'),
    checksDateTo: document.querySelector('[data-role="checks-date-to"]'),
    pagination: document.querySelector('[data-role="checks-pagination"]'),
    actions: document.querySelectorAll('[data-action]'),
    controllerSelect: document.querySelector('[data-role="controller-select"]'),
    checkForm: document.querySelector('[data-role="check-form"]'),
    saveButton: document.querySelector('[data-action="saveCheck"]'),
    summaryField: document.querySelector('[name="issues_summary"]'),
    summaryBadges: document.querySelector('[data-role="summary-badges"]'),
    summarySyncState: document.querySelector('[data-role="summary-sync-state"]'),
    gamepadBadge: document.getElementById('gamepad-status-badge'),
    gamepadConnectionLabel: document.getElementById('gamepad-connection-label'),
    gamepadSupportMessage: document.getElementById('gamepad-support-message'),
    gamepadPanels: document.getElementById('gamepad-panels'),
    controllerVisual: document.querySelector('[data-role="controller-visual"]'),
    buttonGrid: document.querySelector('[data-role="button-grid"]'),
    buttonReadings: document.querySelector('[data-role="button-readings"]'),
    axisList: document.querySelector('[data-role="axis-list"]'),
    autoSummary: document.querySelector('[data-role="auto-summary"]'),
    detailModal: document.getElementById('check-detail-modal'),
    detailMeta: document.querySelector('[data-role="detail-meta"]'),
    detailSummary: document.querySelector('[data-role="detail-summary"]'),
    detailNotes: document.querySelector('[data-role="detail-notes"]'),
    detailAnalysis: document.querySelector('[data-role="detail-analysis"]'),
    detailRaw: document.querySelector('[data-role="detail-raw"]'),
    editCheckModal: document.getElementById('edit-check-modal'),
    editCheckForm: document.querySelector('[data-role="edit-check-form"]'),
    editCheckSuccess: document.querySelector('[data-role="edit-check-success"]'),
    deleteCheckModal: document.getElementById('delete-check-modal'),
    deleteCheckMessage: document.querySelector('[data-role="delete-check-message"]'),
    deleteCheckConfirm: document.querySelector('[data-action="confirmDeleteCheck"]'),
    createControllerModal: document.getElementById('create-controller-modal'),
    createControllerForm: document.querySelector('[data-role="create-controller-form"]'),
    createControllerSuccess: document.querySelector('[data-role="create-controller-success"]'),
    createControllerSubmit: document.querySelector('#create-controller-modal button[type="submit"]'),
    controllerDetailModal: document.getElementById('controller-detail-modal'),
    controllerDetailFields: {
      name: document.querySelector('[data-role="controller-detail-name"]'),
      type: document.querySelector('[data-role="controller-detail-type"]'),
      connection: document.querySelector('[data-role="controller-detail-connection"]'),
      uid: document.querySelector('[data-role="controller-detail-uid"]'),
      status: document.querySelector('[data-role="controller-detail-status"]'),
      updated: document.querySelector('[data-role="controller-detail-updated"]'),
      notes: document.querySelector('[data-role="controller-detail-notes"]')
    },
    deleteControllerModal: document.getElementById('delete-controller-modal'),
    deleteControllerName: document.querySelector('[data-role="delete-controller-name"]'),
    deleteControllerConfirm: document.querySelector('[data-action="confirmDeleteController"]'),
    successToast: document.getElementById('check-success-toast'),
    successToastMessage: document.querySelector('[data-role="success-toast-message"]'),
    successToastClose: document.querySelector('[data-action="closeSuccessToast"]'),
    limitModal: document.getElementById('check-limit-modal'),
    limitModalMessage: document.querySelector('[data-role="limit-modal-message"]'),
    limitModalClose: document.querySelector('[data-action="closeLimitModal"]')
  };

  const padElements = {
    buttonSpans: [],
    axisItems: [],
    controllerButtons: {},
    analogThumbs: []
  };

  function setLoading(element, isLoading) {
    if (!element) return;
    element.dataset.loading = isLoading ? '1' : '0';
    element.classList.toggle('opacity-60', !!isLoading);
  }

  function setSummarySyncState(mode) {
    if (!dom.summarySyncState) return;
    const el = dom.summarySyncState;
    el.classList.remove('text-slate-500', 'text-emerald-400', 'text-amber-400', 'text-rose-400');
    let message = '';
    let toneClass = 'text-slate-500';
    switch (mode) {
      case 'auto':
        message = 'الملخص متزامن تلقائياً مع آخر قراءة. يمكنك تعديله عند الحاجة.';
        toneClass = 'text-emerald-400';
        break;
      case 'manual':
        message = 'تم تعديل الملخص يدوياً. استخدم زر "إدراج الملخص التلقائي" لإعادة المزامنة.';
        toneClass = 'text-amber-400';
        break;
      default:
        message = 'في انتظار القراءات لتوليد ملخص تلقائي.';
        toneClass = 'text-slate-500';
    }
    el.classList.add(toneClass);
    el.textContent = message;
  }

  function renderSummaryBadge(text, tone, icon) {
    const toneClass = TONE_CLASS_MAP[tone] || 'bg-slate-600 text-white';
    const safeText = escapeHtml(text);
    const iconHtml = icon ? `<i class="${icon} text-[10px]"></i>` : '';
    return `<span class="inline-flex items-center gap-1 rounded-full px-3 py-1 text-[11px] font-semibold shadow-sm ${toneClass}">${iconHtml}<span>${safeText}</span></span>`;
  }

  function updateSummaryAssist(analysis) {
    if (!dom.summaryBadges) return;
    const badges = [];
    const overallInfo = analysis.overall || ratingInfo(analysis.ratingKey);
    badges.push(renderSummaryBadge(`التقييم العام: ${overallInfo.label}`, overallInfo.tone, 'fa-solid fa-gauge-high'));

    if (analysis.axes) {
      const hasAxisIssues = (analysis.axes.drift && analysis.axes.drift.length) || (analysis.axes.range && analysis.axes.range.length);
      if (analysis.axes.drift && analysis.axes.drift.length) {
        analysis.axes.drift.forEach(function(item) {
          const info = ratingInfo(item.ratingKey);
          const text = `محور ${item.axis}: انحراف ${item.percent}% ${item.direction} – ${info.label}`;
          badges.push(renderSummaryBadge(text, info.tone, 'fa-solid fa-compass'));
        });
      }
      if (analysis.axes.range && analysis.axes.range.length) {
        analysis.axes.range.forEach(function(item) {
          const info = ratingInfo(item.ratingKey);
          const text = `محور ${item.axis}: أقصى استجابة ${item.percent}% ${item.direction} – ${info.label}`;
          badges.push(renderSummaryBadge(text, info.tone, 'fa-solid fa-arrows-left-right'));
        });
      }
      if (!hasAxisIssues) {
        badges.push(renderSummaryBadge('الأنالوج مستقر في الوضع الطبيعي.', 'success', 'fa-solid fa-circle-check'));
      }
      if (analysis.axes.active && analysis.axes.active.length) {
        analysis.axes.active.forEach(function(item) {
          const info = ratingInfo(item.ratingKey || 'excellent');
          const text = `محور ${item.axis} قيد الاختبار (${item.percent}% نحو ${item.direction}) – ${info.label}`;
          badges.push(renderSummaryBadge(text, info.tone, 'fa-solid fa-person-running'));
        });
      }
    }

    if (analysis.buttons) {
      if (analysis.buttons.items && analysis.buttons.items.length) {
        analysis.buttons.items.forEach(function(item) {
          const info = ratingInfo(item.ratingKey);
          const text = `الزر ${item.label}: قراءة ${item.value.toFixed(2)} – ${info.label}`;
          badges.push(renderSummaryBadge(text, info.tone, 'fa-solid fa-circle-dot'));
        });
      } else {
        badges.push(renderSummaryBadge('الأزرار سليمة بدون ضغط.', 'success', 'fa-solid fa-circle-check'));
      }
      if (analysis.buttons.pressed && analysis.buttons.pressed.length) {
        const pressedText = analysis.buttons.pressed.map(function(item) {
          return `${item.label} (${item.value.toFixed(2)})`;
        }).join('، ');
        badges.push(renderSummaryBadge(`أزرار قيد الاختبار: ${pressedText}`, 'info', 'fa-solid fa-hand-pointer'));
      }
    }

    if (analysis.coverage) {
      if (analysis.coverage.buttons) {
        const btnCov = analysis.coverage.buttons;
        const btnPct = Math.round((btnCov.ratio || 0) * 100);
        const tone = btnPct >= 95 ? 'success' : btnPct >= 80 ? 'info' : btnPct >= 60 ? 'warning' : 'danger';
        badges.push(renderSummaryBadge(`تغطية الأزرار ${btnPct}% (${btnCov.tested}/${btnCov.total})`, tone, 'fa-solid fa-pen-to-square'));
        if (btnCov.missing > 0) {
          badges.push(renderSummaryBadge(`أزرار لم تُختبر: ${btnCov.missing}`, 'danger', 'fa-solid fa-triangle-exclamation'));
        }
      }
      if (analysis.coverage.axes) {
        const axisCov = analysis.coverage.axes;
        const axisPct = Math.round((axisCov.ratio || 0) * 100);
        const tone = axisPct >= 95 ? 'success' : axisPct >= 80 ? 'info' : axisPct >= 60 ? 'warning' : 'danger';
        badges.push(renderSummaryBadge(`تغطية المحاور ${axisPct}% (${axisCov.tested}/${axisCov.total})`, tone, 'fa-solid fa-bullseye'));
      }
    }

    dom.summaryBadges.innerHTML = badges.join('');
  }

  function refreshSummaryPanel() {
    if (state.lastAnalysis) {
      renderAutoSummary(state.lastAnalysis);
    } else {
      setSummarySyncState('idle');
      if (dom.summaryBadges) {
        dom.summaryBadges.innerHTML = '<span class="rounded-full bg-slate-200 px-3 py-1 text-slate-600 dark:bg-slate-700 dark:text-slate-200">لا توجد قراءات لتوليد شارات.</span>';
      }
    }
  }

  function applyAutoSummary() {
    if (!dom.summaryField) return;
    if (!state.lastSummaryText) {
      setSummarySyncState('idle');
      return;
    }
    dom.summaryField.value = state.lastSummaryText;
    state.summaryTouched = false;
    setSummarySyncState('auto');
  }

  function resetSummaryField() {
    if (!dom.summaryField) return;
    dom.summaryField.value = '';
    state.summaryTouched = true;
    setSummarySyncState('manual');
  }

  function buildQuery(params) {
    const query = new URLSearchParams();
    Object.keys(params || {}).forEach(function(key) {
      const value = params[key];
      if (value !== undefined && value !== null && String(value).trim() !== '') {
        query.append(key, value);
      }
    });
    return query.toString() ? '?' + query.toString() : '';
  }

  function handleActionClick(event) {
    const action = event.currentTarget.dataset.action;
    if (!action) return;

    switch (action) {
      case 'refreshControllers':
        fetchControllers();
        break;
      case 'refreshChecks':
        fetchChecks();
        break;
      case 'openCreateController':
        openCreateControllerModal();
        break;
      case 'closeCreateControllerModal':
        closeCreateControllerModal();
        break;
      case 'closeControllerDetail':
        closeControllerDetailModal();
        break;
      case 'closeDeleteControllerModal':
        closeDeleteControllerModal();
        break;
      case 'confirmDeleteController':
        confirmDeleteController();
        break;
      case 'closeEditCheckModal':
        closeEditCheckModal();
        break;
      case 'closeDeleteCheckModal':
        closeDeleteCheckModal();
        break;
      case 'confirmDeleteCheck':
        confirmDeleteCheck();
        break;
      case 'forceScanGamepad':
        manualScanForGamepads();
        break;
      case 'refreshSummaryPanel':
        refreshSummaryPanel();
        break;
      case 'applyAutoSummary':
        applyAutoSummary();
        break;
      case 'resetSummaryField':
        resetSummaryField();
        break;
      case 'closeDetailModal':
        closeDetailModal();
        break;
      case 'bulkDeleteChecks':
        bulkDeleteSelectedChecks();
        break;
      case 'clearDateFilters':
        clearDateFilters();
        break;
      case 'resetCheckFilters':
        resetCheckFilters();
        break;
      default:
        console.warn('[ControllerMaintenance] أمر غير معروف:', action);
    }
  }

  async function fetchControllers(overrides) {
    if (!dom.controllersContainer) return;
    try {
      const filters = Object.assign({}, state.controllerFilters, overrides || {});
      const query = buildQuery(filters);
      setLoading(dom.controllersTable?.closest('div'), true);
      const response = await fetch(state.apiUrl + query, { credentials: 'include' });
      if (!response.ok) throw new Error('فشل تحميل الدراعات');
      const payload = await response.json();
      const controllers = (payload.data?.controllers || []).map(function(controller) {
        return Object.assign({}, controller, {
          is_active: Number(controller.is_active) === 1 ? 1 : 0
        });
      });
      state.controllers = controllers;
      renderControllerSelect(controllers);
      populateChecksControllerFilter(controllers);
      renderControllers(controllers);
    } catch (error) {
      console.error(error);
      state.controllers = [];
      renderControllerSelect([]);
      populateChecksControllerFilter([]);
      renderControllers([]);
    } finally {
      setLoading(dom.controllersTable?.closest('div'), false);
    }
  }

  function renderControllerSelect(controllers) {
    if (!dom.controllerSelect) return;
    const selected = dom.controllerSelect.value;
    const options = ['<option value="">ذراع غير مسجل</option>'];
    controllers.forEach(function(controller) {
      options.push(
        `<option value="${controller.id}">${escapeHtml(controller.name || 'ذراع بدون اسم')} (${controller.controller_type?.toUpperCase() || 'PS'})</option>`
      );
    });
    dom.controllerSelect.innerHTML = options.join('');
    if (selected) {
      dom.controllerSelect.value = selected;
    }
  }

  function populateChecksControllerFilter(controllers) {
    if (!dom.checksControllerFilter) return;
    const selected = dom.checksControllerFilter.value;
    const options = ['<option value="">كل الدراعات</option>'];
    controllers.forEach(function(controller) {
      options.push(`<option value="${controller.id}">${escapeHtml(controller.name || 'ذراع')}</option>`);
    });
    dom.checksControllerFilter.innerHTML = options.join('');
    if (selected) {
      dom.checksControllerFilter.value = selected;
    }
  }

  function renderControllers(controllers) {
    if (!dom.controllersContainer || !dom.controllersTable || !dom.controllersEmpty) return;

    if (!Array.isArray(controllers) || controllers.length === 0) {
      dom.controllersTable.classList.add('hidden');
      dom.controllersEmpty.classList.remove('hidden');
      dom.controllersContainer.innerHTML = '';
      return;
    }

    dom.controllersEmpty.classList.add('hidden');
    dom.controllersTable.classList.remove('hidden');

    dom.controllersContainer.innerHTML = controllers.map(function(controller) {
      const isActive = Number(controller.is_active) === 1;
      const statusLabel = isActive ? 'فعال' : 'غير مفعل';
      const typeLabel = controller.controller_type === 'ps4'
        ? 'PS4'
        : controller.controller_type === 'ps5'
          ? 'PS5'
          : 'غير محدد';
      const connectionLabel = controller.connection_type === 'other'
        ? 'أخرى'
        : 'USB';
      const updatedAt = controller.updated_at ? new Date(controller.updated_at).toLocaleString('ar-EG') : '-';
      const statusClass = isActive
        ? 'bg-emerald-500/15 text-emerald-400 border border-emerald-400/30'
        : 'bg-rose-500/15 text-rose-300 border border-rose-400/30';
      const hardwareUid = controller.hardware_uid ? escapeHtml(controller.hardware_uid) : 'غير مسجل';

      return (
        '<tr>' +
        `<td class="px-4 py-3 text-slate-700 dark:text-slate-200">${escapeHtml(controller.name || '-')}</td>` +
        `<td class="px-4 py-3 text-slate-700 dark:text-slate-200">${typeLabel}</td>` +
        `<td class="px-4 py-3 text-slate-700 dark:text-slate-200">${connectionLabel}</td>` +
        `<td class="px-4 py-3 text-slate-700 dark:text-slate-200">${hardwareUid}</td>` +
        `<td class="px-4 py-3"><span class="inline-flex items-center rounded-full px-3 py-1 text-xs font-semibold ${statusClass}">${statusLabel}</span></td>` +
        `<td class="px-4 py-3 text-slate-700 dark:text-slate-200">${updatedAt}</td>` +
        `<td class="px-4 py-3">
          <div class="flex items-center gap-2 text-xs">
            <button class="inline-flex items-center gap-1 rounded-lg border border-slate-300 px-2.5 py-1 text-slate-600 hover:bg-slate-100 dark:border-slate-600 dark:text-slate-200 dark:hover:bg-slate-800"
              data-controller-action="view" data-controller-id="${controller.id}">
              <i class="fa-solid fa-eye"></i> مشاهدة
            </button>
            <button class="inline-flex items-center gap-1 rounded-lg border border-indigo-400 px-2.5 py-1 text-indigo-600 hover:bg-indigo-500 hover:text-white dark:border-indigo-500 dark:text-indigo-200 dark:hover:bg-indigo-500"
              data-controller-action="edit" data-controller-id="${controller.id}">
              <i class="fa-solid fa-pen-to-square"></i> تعديل
            </button>
            <button class="inline-flex items-center gap-1 rounded-lg border border-rose-400 px-2.5 py-1 text-rose-500 hover:bg-rose-500 hover:text-white dark:border-rose-500 dark:text-rose-300 dark:hover:bg-rose-500"
              data-controller-action="delete" data-controller-id="${controller.id}">
              <i class="fa-solid fa-trash-can"></i> حذف
            </button>
          </div>
        </td>` +
        '</tr>'
      );
    }).join('');
  }

  async function fetchChecks(overrides) {
    if (!dom.checksContainer) return;
    try {
      const overridesObj = overrides || {};
      if (typeof overridesObj.page === 'number') {
        state.checkPagination.page = overridesObj.page;
      }
      const requestPage = state.checkPagination.page || 1;
      const filters = Object.assign({}, state.checkFilters, {
        checks: 1,
        page: requestPage,
        limit: state.checkPagination.perPage
      }, overridesObj);
      const query = buildQuery(filters);
      setLoading(dom.checksContainer, true);
      const response = await fetch(state.apiUrl + query, { credentials: 'include' });
      if (!response.ok) throw new Error('فشل تحميل سجلات الفحص');
      const payload = await response.json();
      const checks = Array.isArray(payload.data?.checks) ? payload.data.checks : [];
      const pagination = payload.data?.pagination || {};
      state.checks = checks;
      state.selectedCheckIds.clear();
      state.checkPagination.total = Number(pagination.total || 0);
      state.checkPagination.totalPages = Math.max(1, Number(pagination.total_pages || 1));
      state.checkPagination.page = Math.min(
        Math.max(1, Number(pagination.page || requestPage)),
        state.checkPagination.totalPages
      );
      pruneSelectedChecks(checks);
      renderChecks(checks);
      renderChecksPagination();
      const requestedPage = Number(filters.page || requestPage);
      if (state.checkPagination.page !== requestedPage) {
        // إذا تم تعديل الصفحة من الخادم، قم بإعادة التحميل لضمان التزامن
        fetchChecks({ page: state.checkPagination.page });
      }
    } catch (error) {
      console.error(error);
      state.checks = [];
      state.selectedCheckIds.clear();
      renderChecks([]);
      renderChecksPagination();
    } finally {
      setLoading(dom.checksContainer, false);
    }
  }

  function getStatusTone(status) {
    const normalized = (status || '').toString().toLowerCase();
    switch (normalized) {
      case 'needs_attention':
        return STATUS_TONES.needs_attention;
      case 'faulty':
        return STATUS_TONES.faulty;
      case 'in_progress':
        return STATUS_TONES.in_progress;
      case 'ok':
        return STATUS_TONES.ok;
      default:
        return STATUS_TONES.ok;
    }
  }

  function getStatusLabel(status) {
    const normalized = (status || '').toString().toLowerCase();
    switch (normalized) {
      case 'needs_attention':
        return 'بحاجة متابعة';
      case 'faulty':
        return 'به عطل';
      case 'in_progress':
        return 'جارٍ الفحص';
      default:
        return 'سليم';
    }
  }

  function getSelectedCheckIds() {
    return Array.from(state.selectedCheckIds).map(function(id) { return Number(id); });
  }

  function pruneSelectedChecks(checks) {
    if (!state.selectedCheckIds || state.selectedCheckIds.size === 0) return;
    const validIds = new Set(
      (Array.isArray(checks) ? checks : []).map(function(item) { return Number(item.id); })
    );
    Array.from(state.selectedCheckIds).forEach(function(id) {
      if (!validIds.has(Number(id))) {
        state.selectedCheckIds.delete(Number(id));
      }
    });
    updateBulkSelectionView();
  }

  function syncSelectAllCheckbox() {
    if (!dom.selectAllChecks) return;
    const total = Array.isArray(state.checks) ? state.checks.length : 0;
    const selected = getSelectedCheckIds().filter(function(id) {
      return (state.checks || []).some(function(item) {
        return Number(item.id) === Number(id);
      });
    }).length;

    dom.selectAllChecks.indeterminate = false;
    dom.selectAllChecks.checked = false;
    dom.selectAllChecks.disabled = total === 0;

    if (total === 0) return;
    if (selected === 0) {
      dom.selectAllChecks.checked = false;
    } else if (selected === total) {
      dom.selectAllChecks.checked = true;
    } else {
      dom.selectAllChecks.indeterminate = true;
    }
  }

  function updateBulkSelectionView() {
    const count = state.selectedCheckIds.size;
    if (dom.selectedChecksInfo) {
      if (count > 0) {
        dom.selectedChecksInfo.classList.remove('hidden');
        if (dom.selectedChecksCount) {
          dom.selectedChecksCount.textContent = count;
        }
      } else {
        dom.selectedChecksInfo.classList.add('hidden');
      }
    }
    if (dom.checksBulkBar) {
      if ((state.checks || []).length) {
        dom.checksBulkBar.classList.remove('hidden');
      } else {
        dom.checksBulkBar.classList.add('hidden');
      }
    }
    if (dom.selectAllChecks) {
      dom.selectAllChecks.disabled = (state.checks || []).length === 0;
    }
    if (dom.actions) {
      const bulkButton = Array.from(dom.actions).find(function(btn) {
        return btn.dataset && btn.dataset.action === 'bulkDeleteChecks';
      });
      if (bulkButton) {
        bulkButton.disabled = count === 0;
        bulkButton.classList.toggle('opacity-40', count === 0);
        bulkButton.classList.toggle('cursor-not-allowed', count === 0);
      }
    }
  }

  function setCheckSelected(checkId, isSelected) {
    if (!checkId) return;
    if (isSelected) {
      state.selectedCheckIds.add(Number(checkId));
    } else {
      state.selectedCheckIds.delete(Number(checkId));
    }
    updateBulkSelectionView();
    syncSelectAllCheckbox();
  }

  function handleSelectAllToggle(isChecked) {
    if (!Array.isArray(state.checks) || state.checks.length === 0) {
      state.selectedCheckIds.clear();
      updateBulkSelectionView();
      syncSelectAllCheckbox();
      return;
    }
    if (isChecked) {
      state.checks.forEach(function(item) {
        state.selectedCheckIds.add(Number(item.id));
      });
    } else {
      state.checks.forEach(function(item) {
        state.selectedCheckIds.delete(Number(item.id));
      });
    }
    updateBulkSelectionView();
    syncSelectAllCheckbox();
    if (dom.checksContainer) {
      Array.from(dom.checksContainer.querySelectorAll('[data-role="check-select"]')).forEach(function(input) {
        input.checked = isChecked;
      });
    }
  }

  async function bulkDeleteSelectedChecks() {
    const ids = getSelectedCheckIds();
    if (!ids.length) return;
    await openDeleteCheckModal(ids);
  }

  function clearDateFilters() {
    state.checkFilters.date_from = '';
    state.checkFilters.date_to = '';
    state.checkPagination.page = 1;
    if (dom.checksDateFrom) dom.checksDateFrom.value = '';
    if (dom.checksDateTo) dom.checksDateTo.value = '';
    fetchChecks();
  }

  function resetCheckFilters() {
    state.checkFilters = {
      status: '',
      controller_id: '',
      date_from: '',
      date_to: ''
    };
    state.checkPagination.page = 1;
    if (dom.checksFilterForm) {
      dom.checksFilterForm.reset();
    }
    if (dom.checksControllerFilter) dom.checksControllerFilter.value = '';
    if (dom.checksDateFrom) dom.checksDateFrom.value = '';
    if (dom.checksDateTo) dom.checksDateTo.value = '';
    if (dom.selectAllChecks) dom.selectAllChecks.checked = false;
    fetchChecks();
  }

  function closeSuccessToast() {
    if (state.successToastTimer) {
      clearTimeout(state.successToastTimer);
      state.successToastTimer = null;
    }
    if (!dom.successToast) return;
    dom.successToast.classList.add('hidden');
    dom.successToast.classList.remove('flex');
  }

  function showSuccessToast(message) {
    if (!dom.successToast) return;
    if (dom.successToastMessage) {
      dom.successToastMessage.textContent = message || 'تم حفظ نتيجة الفحص بنجاح.';
    }
    dom.successToast.classList.remove('hidden');
    dom.successToast.classList.add('flex');
    if (state.successToastTimer) {
      clearTimeout(state.successToastTimer);
    }
    state.successToastTimer = setTimeout(function() {
      closeSuccessToast();
    }, 3200);
  }

  function closeLimitModal() {
    if (!dom.limitModal) return;
    dom.limitModal.classList.add('hidden');
    dom.limitModal.classList.remove('flex');
  }

  function showLimitModal(details) {
    if (!dom.limitModal) return;
    const limit = Number(details?.limit || 300);
    const count = Number(details?.count || limit);
    const remaining = Math.max(0, limit - count);
    if (dom.limitModalMessage) {
      dom.limitModalMessage.innerHTML = `
        لقد وصلت للحد الأقصى لسجلات الفحص <span class="font-semibold text-rose-500">${count}/${limit}</span>.<br>
        الرجاء حذف بعض السجلات القديمة (${remaining} متاحة بعد التنظيف) ثم حاول مرة أخرى.
      `;
    }
    dom.limitModal.classList.remove('hidden');
    dom.limitModal.classList.add('flex');
  }

  function goToPage(page) {
    const totalPages = state.checkPagination.totalPages || 1;
    const target = Math.max(1, Math.min(page, totalPages));
    if (target === state.checkPagination.page) return;
    state.checkPagination.page = target;
    fetchChecks({ page: target });
  }

  function renderChecks(checks) {
    if (!dom.checksContainer || !dom.checksEmpty) return;

    if (!Array.isArray(checks) || checks.length === 0) {
      dom.checksEmpty.classList.remove('hidden');
      dom.checksContainer.innerHTML = '';
      updateBulkSelectionView();
      syncSelectAllCheckbox();
      renderChecksPagination();
      return;
    }

    dom.checksEmpty.classList.add('hidden');
    dom.checksContainer.innerHTML = checks.map(function(check) {
      const controllerName = check.controller_name || 'ذراع غير مسجل';
      const statusLabel = getStatusLabel(check.status);
      const statusTone = getStatusTone(check.status);
      const badgeClass = STATUS_BADGE_CLASS[statusTone] || STATUS_BADGE_CLASS.default;
      const performer = check.performed_by_name ? `بواسطة ${escapeHtml(check.performed_by_name)}` : '';
      const startedAt = check.started_at ? new Date(check.started_at).toLocaleString('ar-EG') : '-';
      const summary = check.issues_summary ? escapeHtml(check.issues_summary) : 'لا توجد ملاحظات';
      const isSelected = state.selectedCheckIds.has(Number(check.id));

      return (
        `<div class="flex items-start gap-3" data-check-wrapper="${check.id}">` +
        `<label class="mt-1 inline-flex items-center justify-center">
          <input type="checkbox" class="h-4 w-4 rounded border-slate-300 text-indigo-500 focus:ring-indigo-500 dark:border-slate-600 dark:bg-slate-800 dark:focus:ring-indigo-400"
            data-role="check-select" data-check-id="${check.id}" ${isSelected ? 'checked' : ''}>
        </label>` +
        `<article class="flex-1 rounded-xl border border-slate-200 bg-white/80 p-4 transition hover:border-indigo-400 hover:shadow dark:border-slate-700 dark:bg-slate-800/70 cursor-pointer" data-check-id="${check.id}">` +
        `<header class="mb-2 flex items-center justify-between gap-4">` +
        `<div>` +
        `<h3 class="text-base font-semibold text-slate-800 dark:text-slate-100">${escapeHtml(controllerName)}</h3>` +
        `<p class="text-xs text-slate-500 dark:text-slate-300">${startedAt} ${performer}</p>` +
        `</div>` +
        `<div class="flex items-center gap-2">
          <span class="inline-flex items-center rounded-full px-3 py-1 text-xs font-semibold ${badgeClass}">${statusLabel}</span>
          <div class="flex items-center gap-1 text-[11px] font-semibold text-slate-400">
            <button class="inline-flex items-center gap-1 rounded-lg border border-slate-300 px-2 py-1 hover:bg-slate-100 dark:border-slate-600 dark:text-slate-200 dark:hover:bg-slate-800"
              data-check-action="view" data-check-id="${check.id}">
              <i class="fa-solid fa-eye"></i>
            </button>
            <button class="inline-flex items-center gap-1 rounded-lg border border-indigo-400 px-2 py-1 text-indigo-500 hover:bg-indigo-500 hover:text-white dark:border-indigo-500 dark:text-indigo-200 dark:hover:bg-indigo-500"
              data-check-action="edit" data-check-id="${check.id}">
              <i class="fa-solid fa-pen-to-square"></i>
            </button>
            <button class="inline-flex items-center gap-1 rounded-lg border border-rose-400 px-2 py-1 text-rose-500 hover:bg-rose-500 hover:text-white dark:border-rose-500 dark:text-rose-300 dark:hover:bg-rose-500"
              data-check-action="delete" data-check-id="${check.id}">
              <i class="fa-solid fa-trash-can"></i>
            </button>
          </div>
        </div>` +
        `</header>` +
        `<p class="text-sm leading-relaxed text-slate-600 dark:text-slate-200">${summary}</p>` +
        `</article>` +
        `</div>`
      );
    }).join('');

    const actionButtons = Array.from(dom.checksContainer.querySelectorAll('[data-check-action]'));
    actionButtons.forEach(function(button) {
      button.addEventListener('click', async function(event) {
        event.preventDefault();
        event.stopPropagation();
        const checkId = Number(button.dataset.checkId);
        if (!checkId) return;
        const action = button.dataset.checkAction;
        const record = (state.checks || []).find(function(item) {
          return Number(item.id) === checkId;
        });
        switch (action) {
          case 'view':
            await openCheckDetail(checkId);
            break;
          case 'edit':
            await openEditCheckModal(checkId);
            break;
          case 'delete':
            await openDeleteCheckModal(checkId, record);
            break;
          default:
            console.warn('[ControllerMaintenance] إجراء غير معروف للفحص:', action);
        }
      });
    });

    Array.from(dom.checksContainer.querySelectorAll('[data-role="check-select"]')).forEach(function(input) {
      input.addEventListener('click', function(event) {
        event.stopPropagation();
      });
      input.addEventListener('change', function(event) {
        const selected = event.currentTarget.checked;
        const checkId = Number(event.currentTarget.dataset.checkId);
        setCheckSelected(checkId, selected);
      });
    });

    Array.from(dom.checksContainer.querySelectorAll('[data-check-id]')).forEach(function(card) {
      card.addEventListener('click', function(event) {
        if (event.target.closest('[data-check-action]')) return;
        if (event.target.closest('[data-role="check-select"]')) return;
        const id = Number(card.getAttribute('data-check-id'));
        if (!id) return;
        openCheckDetail(id);
      });
    });

    updateBulkSelectionView();
    syncSelectAllCheckbox();
  }

  function renderChecksPagination() {
    if (!dom.pagination) return;
    const totalPages = state.checkPagination.totalPages || 1;
    const currentPage = state.checkPagination.page || 1;
    if (totalPages <= 1 || (state.checks || []).length === 0) {
      dom.pagination.classList.add('hidden');
      dom.pagination.innerHTML = '';
      return;
    }

    dom.pagination.classList.remove('hidden');

    const buttons = [];
    const disablePrev = currentPage <= 1;
    const disableNext = currentPage >= totalPages;

    buttons.push(
      `<button type="button" class="inline-flex items-center gap-2 rounded-lg border border-slate-700 px-3 py-1.5 text-xs font-semibold text-slate-300 transition ${disablePrev ? 'opacity-40 cursor-not-allowed' : 'hover:bg-slate-800'}"
        data-page-action="prev" ${disablePrev ? 'disabled' : ''}>
        <i class="fa-solid fa-angle-right"></i>
        السابق
      </button>`
    );

    const pageButtons = [];
    for (let page = 1; page <= totalPages; page++) {
      const isActive = page === currentPage;
      pageButtons.push(
        `<button type="button" class="min-w-[40px] rounded-lg border px-3 py-1.5 text-xs font-semibold transition ${isActive
          ? 'border-indigo-500 bg-indigo-500 text-white shadow'
          : 'border-slate-700 text-slate-300 hover:bg-slate-800'}"
          data-page-action="goto" data-page="${page}">
          ${page}
        </button>`
      );
    }

    buttons.push(
      `<div class="flex items-center gap-1">${pageButtons.join('')}</div>`
    );

    buttons.push(
      `<button type="button" class="inline-flex items-center gap-2 rounded-lg border border-slate-700 px-3 py-1.5 text-xs font-semibold text-slate-300 transition ${disableNext ? 'opacity-40 cursor-not-allowed' : 'hover:bg-slate-800'}"
        data-page-action="next" ${disableNext ? 'disabled' : ''}>
        التالي
        <i class="fa-solid fa-angle-left"></i>
      </button>`
    );

    dom.pagination.innerHTML = `<div class="flex flex-wrap items-center justify-between gap-3">${buttons.join('')}</div>`;
  }

  function escapeHtml(text) {
    if (text === null || text === undefined) return '';
    return String(text)
      .replace(/&/g, '&amp;')
      .replace(/</g, '&lt;')
      .replace(/>/g, '&gt;')
      .replace(/"/g, '&quot;')
      .replace(/'/g, '&#039;');
  }

  function openCreateControllerModal(controller) {
    if (!dom.createControllerModal) return;
    dom.createControllerModal.classList.remove('hidden');
    dom.createControllerModal.classList.add('flex');
    state.isCreateControllerOpen = true;
    state.editControllerId = controller ? controller.id : null;
    document.body.classList.add('overflow-hidden');

    if (dom.createControllerForm) {
      dom.createControllerForm.reset();
      if (dom.createControllerForm.elements.is_active) {
        dom.createControllerForm.elements.is_active.value = '1';
      }
      if (controller) {
        if (dom.createControllerForm.elements.name) dom.createControllerForm.elements.name.value = controller.name || '';
        if (dom.createControllerForm.elements.controller_type) dom.createControllerForm.elements.controller_type.value = controller.controller_type || 'unknown';
        if (dom.createControllerForm.elements.connection_type) dom.createControllerForm.elements.connection_type.value = controller.connection_type || 'usb';
        if (dom.createControllerForm.elements.hardware_uid) dom.createControllerForm.elements.hardware_uid.value = controller.hardware_uid || '';
        if (dom.createControllerForm.elements.notes) dom.createControllerForm.elements.notes.value = controller.notes || '';
        if (dom.createControllerForm.elements.is_active) dom.createControllerForm.elements.is_active.value = Number(controller.is_active) === 1 ? '1' : '0';
      }
      const nameField = dom.createControllerForm.querySelector('[name="name"]');
      if (nameField) {
        setTimeout(function() {
          nameField.focus();
        }, 60);
      }
    }
    if (dom.createControllerSuccess) dom.createControllerSuccess.classList.add('hidden');
  }

  function closeCreateControllerModal() {
    if (!dom.createControllerModal) return;
    dom.createControllerModal.classList.add('hidden');
    dom.createControllerModal.classList.remove('flex');
    state.isCreateControllerOpen = false;
    state.editControllerId = null;
    document.body.classList.remove('overflow-hidden');
  }

  async function handleCreateControllerSubmit(event) {
    event.preventDefault();
    if (!dom.createControllerForm) return;

    const formData = new FormData(dom.createControllerForm);
    const payload = {
      action: state.editControllerId ? 'update_controller' : 'create_controller',
      name: (formData.get('name') || '').trim(),
      controller_type: (formData.get('controller_type') || 'unknown').toLowerCase(),
      connection_type: (formData.get('connection_type') || 'usb').toLowerCase(),
      hardware_uid: (formData.get('hardware_uid') || '').trim(),
      notes: (formData.get('notes') || '').trim(),
      is_active: formData.get('is_active') === '0' ? 0 : 1
    };
    if (state.editControllerId) {
      payload.id = state.editControllerId;
    }

    if (!payload.name) {
      alert('يرجى إدخال اسم الذراع.');
      return;
    }
    payload.hardware_uid = payload.hardware_uid || null;
    payload.notes = payload.notes || null;

    if (dom.createControllerSubmit) {
      dom.createControllerSubmit.disabled = true;
      dom.createControllerSubmit.classList.add('opacity-60');
    }

    try {
      const response = await fetch(state.apiUrl, {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        credentials: 'include',
        body: JSON.stringify(payload)
      });
      const result = await response.json();
      if (!response.ok || !result.success) {
        alert(result.error || 'تعذر إنشاء الذراع.');
        return;
      }

      if (dom.createControllerSuccess) {
        dom.createControllerSuccess.textContent = state.editControllerId ? 'تم تحديث الذراع بنجاح' : 'تم الحفظ بنجاح';
        dom.createControllerSuccess.classList.remove('hidden');
      }
      fetchControllers();
      setTimeout(function() {
        closeCreateControllerModal();
      }, 600);
    } catch (error) {
      console.error(error);
      alert('حدث خطأ أثناء إنشاء الذراع.');
    } finally {
      if (dom.createControllerSubmit) {
        dom.createControllerSubmit.disabled = false;
        dom.createControllerSubmit.classList.remove('opacity-60');
      }
    }
  }

  async function openEditCheckModal(checkId) {
    try {
      const record = await fetchCheckDetail(checkId);
      if (!record) {
        alert('لم يتم العثور على الفحص.');
        return;
      }
      state.editCheckId = checkId;
      if (dom.editCheckForm) {
        dom.editCheckForm.reset();
        if (dom.editCheckForm.elements.status) dom.editCheckForm.elements.status.value = record.status || 'ok';
        if (dom.editCheckForm.elements.issues_summary) dom.editCheckForm.elements.issues_summary.value = record.issues_summary || '';
        if (dom.editCheckForm.elements.notes) dom.editCheckForm.elements.notes.value = record.notes || '';
      }
      if (dom.editCheckSuccess) dom.editCheckSuccess.classList.add('hidden');
      if (dom.editCheckModal) {
        dom.editCheckModal.classList.remove('hidden');
        dom.editCheckModal.classList.add('flex');
      }
    } catch (error) {
      console.error(error);
      alert('تعذر جلب بيانات الفحص للتعديل.');
    }
  }

  function closeEditCheckModal() {
    if (!dom.editCheckModal) return;
    dom.editCheckModal.classList.add('hidden');
    dom.editCheckModal.classList.remove('flex');
    state.editCheckId = null;
  }

  async function handleEditCheckSubmit(event) {
    event.preventDefault();
    if (!dom.editCheckForm || !state.editCheckId) return;

    const formData = new FormData(dom.editCheckForm);
    const payload = {
      action: 'update_check',
      id: state.editCheckId,
      status: (formData.get('status') || 'ok').toString().toLowerCase(),
      issues_summary: (formData.get('issues_summary') || '').trim(),
      notes: (formData.get('notes') || '').trim()
    };

    try {
      if (dom.editCheckSuccess) dom.editCheckSuccess.classList.add('hidden');
      const response = await fetch(state.apiUrl, {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        credentials: 'include',
        body: JSON.stringify(payload)
      });
      const result = await response.json();
      if (!response.ok || !result.success) {
        alert(result.error || 'تعذر تحديث الفحص.');
        return;
      }
      if (dom.editCheckSuccess) dom.editCheckSuccess.classList.remove('hidden');
      fetchChecks();
      setTimeout(function() {
        closeEditCheckModal();
      }, 500);
    } catch (error) {
      console.error(error);
      alert('حدث خطأ أثناء تحديث الفحص.');
    }
  }

  async function openDeleteCheckModal(checkIds, record) {
    const ids = Array.isArray(checkIds) ? checkIds.map(Number).filter(Boolean) : [Number(checkIds)];
    if (!ids.length) return;
    state.deleteCheckIds = ids;

    let records = [];
    if (ids.length === 1) {
      if (!record) {
        try {
          const fetched = await fetchCheckDetail(ids[0]);
          if (fetched) records = [fetched];
        } catch (error) {
          console.error(error);
        }
      } else {
        records = [record];
      }
    } else {
      records = ids.map(function(id) {
        return (state.checks || []).find(function(item) {
          return Number(item.id) === Number(id);
        });
      }).filter(Boolean);
    }

    const isBulk = ids.length > 1;
    const firstName = records[0]?.controller_name || `#${ids[0]}`;
    if (dom.deleteCheckMessage) {
      if (isBulk) {
        dom.deleteCheckMessage.innerHTML = `سيتم حذف <strong>${ids.length}</strong> من سجلات الفحص المحددة. لا يمكن التراجع عن هذه العملية.`;
      } else {
        dom.deleteCheckMessage.innerHTML = `هل أنت متأكد أنك تريد حذف سجل فحص الذراع <strong>${escapeHtml(firstName)}</strong>؟ سيتم إزالة السجل نهائياً من القائمة.`;
      }
    }
    if (dom.deleteCheckConfirm) {
      dom.deleteCheckConfirm.textContent = isBulk ? 'حذف السجلات المحددة' : 'حذف السجل';
    }
    if (dom.deleteCheckModal) {
      dom.deleteCheckModal.classList.remove('hidden');
      dom.deleteCheckModal.classList.add('flex');
    }
  }

  function closeDeleteCheckModal() {
    if (!dom.deleteCheckModal) return;
    dom.deleteCheckModal.classList.add('hidden');
    dom.deleteCheckModal.classList.remove('flex');
    state.deleteCheckIds = [];
    if (dom.deleteCheckConfirm) {
      dom.deleteCheckConfirm.disabled = false;
      dom.deleteCheckConfirm.classList.remove('opacity-60');
    }
  }

  async function confirmDeleteCheck() {
    const ids = Array.isArray(state.deleteCheckIds) ? state.deleteCheckIds.slice() : [];
    if (!ids.length) return;
    if (dom.deleteCheckConfirm) {
      dom.deleteCheckConfirm.disabled = true;
      dom.deleteCheckConfirm.classList.add('opacity-60');
    }
    try {
      for (const checkId of ids) {
        const response = await fetch(state.apiUrl, {
          method: 'POST',
          headers: { 'Content-Type': 'application/json' },
          credentials: 'include',
          body: JSON.stringify({
            action: 'delete_check',
            id: checkId
          })
        });
        const result = await response.json();
        if (!response.ok || !result.success) {
          throw new Error(result.error || 'تعذر حذف الفحص.');
        }
        state.selectedCheckIds.delete(Number(checkId));
      }
      closeDeleteCheckModal();
      fetchChecks();
    } catch (error) {
      console.error(error);
      alert(error.message || 'حدث خطأ أثناء حذف الفحوصات.');
    } finally {
      if (dom.deleteCheckConfirm) {
        dom.deleteCheckConfirm.disabled = false;
        dom.deleteCheckConfirm.classList.remove('opacity-60');
      }
    }
  }

  function openControllerDetailModal(controller) {
    if (!dom.controllerDetailModal || !controller) return;
    const typeLabel = controller.controller_type === 'ps4' ? 'PS4' : controller.controller_type === 'ps5' ? 'PS5' : 'غير محدد';
    const connectionLabel = controller.connection_type === 'other'
      ? 'أخرى'
      : 'USB';
    const isActive = Number(controller.is_active) === 1;
    const statusLabel = isActive ? 'فعال' : 'غير مفعل';
    const updatedAt = controller.updated_at ? new Date(controller.updated_at).toLocaleString('ar-EG') : '-';

    if (dom.controllerDetailFields.name) dom.controllerDetailFields.name.textContent = controller.name || '-';
    if (dom.controllerDetailFields.type) dom.controllerDetailFields.type.textContent = typeLabel;
    if (dom.controllerDetailFields.connection) dom.controllerDetailFields.connection.textContent = connectionLabel;
    if (dom.controllerDetailFields.uid) dom.controllerDetailFields.uid.textContent = controller.hardware_uid || 'غير مسجل';
    if (dom.controllerDetailFields.status) dom.controllerDetailFields.status.textContent = statusLabel;
    if (dom.controllerDetailFields.updated) dom.controllerDetailFields.updated.textContent = updatedAt;
    if (dom.controllerDetailFields.notes) dom.controllerDetailFields.notes.textContent = controller.notes || 'لا توجد ملاحظات';

    dom.controllerDetailModal.classList.remove('hidden');
    dom.controllerDetailModal.classList.add('flex');
  }

  function closeControllerDetailModal() {
    if (!dom.controllerDetailModal) return;
    dom.controllerDetailModal.classList.add('hidden');
    dom.controllerDetailModal.classList.remove('flex');
  }

  function openDeleteControllerModal(controller) {
    if (!dom.deleteControllerModal || !controller) return;
    state.deleteControllerId = controller.id;
    if (dom.deleteControllerName) dom.deleteControllerName.textContent = controller.name || 'بدون اسم';
    dom.deleteControllerModal.classList.remove('hidden');
    dom.deleteControllerModal.classList.add('flex');
  }

  function closeDeleteControllerModal() {
    if (!dom.deleteControllerModal) return;
    dom.deleteControllerModal.classList.add('hidden');
    dom.deleteControllerModal.classList.remove('flex');
    state.deleteControllerId = null;
  }

  async function confirmDeleteController() {
    if (!state.deleteControllerId) return;
    if (dom.deleteControllerConfirm) {
      dom.deleteControllerConfirm.disabled = true;
      dom.deleteControllerConfirm.classList.add('opacity-60');
    }
    try {
      const response = await fetch(state.apiUrl, {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        credentials: 'include',
        body: JSON.stringify({
          action: 'delete_controller',
          id: state.deleteControllerId
        })
      });
      const result = await response.json();
      if (!response.ok || !result.success) {
        alert(result.error || 'تعذر حذف الذراع.');
        return;
      }
      closeDeleteControllerModal();
      fetchControllers();
    } catch (error) {
      console.error(error);
      alert('حدث خطأ أثناء حذف الذراع.');
    } finally {
      if (dom.deleteControllerConfirm) {
        dom.deleteControllerConfirm.disabled = false;
        dom.deleteControllerConfirm.classList.remove('opacity-60');
      }
    }
  }

  function setupGamepadSupport() {
    if (typeof navigator === 'undefined' || typeof navigator.getGamepads !== 'function') {
      if (dom.gamepadSupportMessage) dom.gamepadSupportMessage.removeAttribute('hidden');
      if (dom.saveButton) dom.saveButton.disabled = true;
      return;
    }

    if (dom.gamepadSupportMessage) dom.gamepadSupportMessage.setAttribute('hidden', 'hidden');

    window.addEventListener('gamepadconnected', handleGamepadConnected);
    window.addEventListener('gamepaddisconnected', handleGamepadDisconnected);

    manualScanForGamepads();
  }

  function manualScanForGamepads() {
    const pads = navigator.getGamepads ? Array.from(navigator.getGamepads()).filter(Boolean) : [];
    if (pads.length > 0) {
      handleGamepadConnected({ gamepad: pads[0] });
    } else {
      updateGamepadBadge(null);
      stopGamepadLoop();
    }
  }

  function handleGamepadConnected(event) {
    const gamepad = event.gamepad;
    if (!gamepad) return;

    state.activeGamepadIndex = gamepad.index;
    resetMeasurementState();
    updateGamepadBadge(gamepad);
    if (dom.gamepadConnectionLabel) dom.gamepadConnectionLabel.textContent = `تم اكتشاف ${gamepad.id}`;
    if (dom.gamepadPanels) dom.gamepadPanels.removeAttribute('hidden');
    if (dom.saveButton) dom.saveButton.disabled = false;

    if (dom.controllerVisual) {
      dom.controllerVisual.removeAttribute('hidden');
      padElements.controllerButtons = {};
      dom.controllerVisual.querySelectorAll('[data-button-node]').forEach(function(node) {
        var idx = Number(node.dataset.buttonNode);
        if (!Number.isNaN(idx)) {
          padElements.controllerButtons[idx] = node;
        }
      });
      padElements.analogThumbs = Array.from(dom.controllerVisual.querySelectorAll('[data-analog-thumb]'));
    }

    buildButtonGrid(gamepad.buttons.length);
    buildAxisList(gamepad.axes.length);

    startGamepadLoop();
  }

  function handleGamepadDisconnected(event) {
    if (state.activeGamepadIndex === null) return;

    if (event.gamepad.index === state.activeGamepadIndex) {
      state.activeGamepadIndex = null;
      state.axisMonitor = [];
      stopGamepadLoop();
      updateGamepadBadge(null);
      if (dom.gamepadConnectionLabel) dom.gamepadConnectionLabel.textContent = 'تم فصل الذراع. يرجى توصيله مرة أخرى.';
      if (dom.saveButton) dom.saveButton.disabled = true;
      if (dom.controllerVisual) dom.controllerVisual.setAttribute('hidden', 'hidden');
    }
  }

  function updateGamepadBadge(gamepad) {
    if (!dom.gamepadBadge) return;
    if (!gamepad) {
      dom.gamepadBadge.className = 'inline-flex items-center gap-2 rounded-full bg-slate-100 px-3 py-1 text-xs font-semibold text-slate-600 dark:bg-slate-800 dark:text-slate-200';
      dom.gamepadBadge.innerHTML = '<i class="fa-solid fa-plug-circle-xmark text-slate-500"></i> لا يوجد جهاز متصل';
      return;
    }

    dom.gamepadBadge.className = 'inline-flex items-center gap-2 rounded-full bg-emerald-100 px-3 py-1 text-xs font-semibold text-emerald-700 dark:bg-emerald-500/20 dark:text-emerald-200';
    dom.gamepadBadge.innerHTML = '<i class="fa-solid fa-circle-check"></i> جهاز متصل';
  }

  function buildButtonGrid(count) {
    if (!dom.buttonGrid) return;
    const total = Math.max(count, BUTTON_LABELS.length);
    padElements.buttonSpans = [];
    const fragments = [];
    for (let i = 0; i < total; i++) {
      const label = BUTTON_LABELS[i] || `زر ${i}`;
      fragments.push(
        `<span data-button-index="${i}" class="rounded-lg border border-slate-300 bg-white px-2 py-2 text-center text-[11px] font-semibold text-slate-600 shadow-sm transition dark:border-slate-600 dark:bg-slate-800 dark:text-slate-200">${label}</span>`
      );
    }
    dom.buttonGrid.innerHTML = fragments.join('');
    padElements.buttonSpans = Array.from(dom.buttonGrid.querySelectorAll('[data-button-index]'));
  }

  function buildAxisList(count) {
    if (!dom.axisList) return;
    padElements.axisItems = [];
    const fragments = [];
    for (let i = 0; i < count; i++) {
      fragments.push(
        `<div class="space-y-1" data-axis-index="${i}">
          <div class="flex items-center justify-between text-[11px] font-semibold text-slate-500 dark:text-slate-200">
            <span>محور ${i + 1}</span>
            <span data-axis-value="${i}">0.00</span>
          </div>
          <div class="h-2 w-full overflow-hidden rounded-full bg-slate-200 dark:bg-slate-700">
            <div data-axis-bar="${i}" class="h-full rounded-full bg-indigo-500 transition-all duration-150" style="width:50%"></div>
          </div>
        </div>`
      );
    }
    dom.axisList.innerHTML = fragments.join('');
    padElements.axisItems = Array.from(dom.axisList.querySelectorAll('[data-axis-index]'));
  }

  function startGamepadLoop() {
    stopGamepadLoop();
    const loop = () => {
      updateGamepadState();
      state.gamepadLoopId = window.requestAnimationFrame(loop);
    };
    loop();
  }

  function stopGamepadLoop() {
    if (state.gamepadLoopId) {
      window.cancelAnimationFrame(state.gamepadLoopId);
      state.gamepadLoopId = null;
    }
    state.lastSnapshot = null;
    state.buttonMetrics = [];
    state.axisMetrics = [];
    if (dom.autoSummary) dom.autoSummary.textContent = 'لا توجد قراءات بعد.';
    if (dom.buttonReadings) dom.buttonReadings.innerHTML = '';
  }

  function updateGamepadState() {
    if (state.activeGamepadIndex === null) return;
    const pads = navigator.getGamepads ? navigator.getGamepads() : [];
    const gamepad = pads[state.activeGamepadIndex];
    if (!gamepad) {
      handleGamepadDisconnected({ gamepad: { index: state.activeGamepadIndex } });
      return;
    }

    const snapshot = {
      timestamp: Date.now(),
      id: gamepad.id,
      buttons: gamepad.buttons.map(btn => ({
        pressed: btn.pressed,
        value: Number(btn.value.toFixed(3))
      })),
      axes: gamepad.axes.map(axis => Number(axis.toFixed(3)))
    };

    if (!state.buttonMetrics.length || state.buttonMetrics.length !== snapshot.buttons.length) {
      state.buttonMetrics = snapshot.buttons.map(function() {
        return { maxValue: 0, pressedCount: 0, lastValue: 0 };
      });
    }
    if (!state.axisMetrics.length || state.axisMetrics.length !== snapshot.axes.length) {
      state.axisMetrics = snapshot.axes.map(function() {
        return { maxPositive: 0, maxNegative: 0, lastValue: 0 };
      });
    }

    snapshot.buttons.forEach(function(btn, index) {
      const metric = state.buttonMetrics[index];
      metric.lastValue = btn.value;
      if (btn.value > metric.maxValue) {
        metric.maxValue = btn.value;
      }
      if (btn.pressed || btn.value > 0.15) {
        metric.pressedCount += 1;
      }
    });

    snapshot.axes.forEach(function(value, index) {
      const metric = state.axisMetrics[index];
      metric.lastValue = value;
      if (value > metric.maxPositive) {
        metric.maxPositive = value;
      }
      if (value < metric.maxNegative) {
        metric.maxNegative = value;
      }
    });

    const metricsSnapshot = {
      buttons: state.buttonMetrics.map(function(metric) {
        return {
          maxValue: metric.maxValue,
          pressedCount: metric.pressedCount,
          lastValue: metric.lastValue
        };
      }),
      axes: state.axisMetrics.map(function(metric) {
        return {
          maxPositive: metric.maxPositive,
          maxNegative: metric.maxNegative,
          lastValue: metric.lastValue
        };
      })
    };

    snapshot.metrics = metricsSnapshot;

    if (!state.axisMonitor.length || state.axisMonitor.length !== snapshot.axes.length) {
      state.axisMonitor = snapshot.axes.map(() => ({
        maxPositive: 0,
        maxNegative: 0,
        neutralStreak: 0,
        neutralReady: false,
        driftReported: false,
        offCenterFrames: 0,
        lastValue: 0
      }));
    }

    snapshot.axes.forEach(function(value, index) {
      const monitor = state.axisMonitor[index];
      if (!monitor) return;
      if (value > monitor.maxPositive) monitor.maxPositive = value;
      if (-value > monitor.maxNegative) monitor.maxNegative = -value;
      const abs = Math.abs(value);
      if (abs <= AXIS_NEUTRAL_THRESHOLD) {
        if (monitor.neutralStreak < AXIS_NEUTRAL_REQUIRED) {
          monitor.neutralStreak++;
          if (monitor.neutralStreak >= AXIS_NEUTRAL_REQUIRED) {
            monitor.neutralReady = true;
          }
        }
        monitor.offCenterFrames = 0;
      } else {
        monitor.neutralStreak = 0;
        monitor.neutralReady = false;
        monitor.driftReported = false;
        monitor.offCenterFrames = Math.min(monitor.offCenterFrames + 1, AXIS_DRIFT_PERSIST_FRAMES + 10);
      }
      monitor.lastValue = value;
    });

    const analysis = analyzeSnapshot(snapshot, state.axisMonitor);

    state.lastSnapshot = snapshot;
    state.lastAnalysis = analysis;
    state.generatedIssues = analysis.payload;

    renderButtonStates(snapshot.buttons);
    renderAxisStates(snapshot.axes);
    renderAutoSummary(analysis);
  }

  function renderButtonStates(buttons) {
    if (!dom.buttonReadings || !padElements.buttonSpans.length) return;
    const pressed = [];
    const readings = [];
    buttons.forEach(function(btn, index) {
      const element = padElements.buttonSpans[index];
      const isActive = btn.pressed || btn.value > 0.15;
      if (element) {
        if (isActive) {
          element.classList.add('bg-indigo-600', 'text-white', 'border-indigo-500', 'shadow-lg', 'dark:bg-indigo-500', 'dark:text-white');
          element.classList.remove('bg-white', 'text-slate-600', 'border-slate-300', 'shadow-sm', 'dark:bg-slate-800', 'dark:text-slate-200');
        } else {
          element.classList.add('bg-white', 'text-slate-600', 'border-slate-300', 'shadow-sm', 'dark:bg-slate-800', 'dark:text-slate-200');
          element.classList.remove('bg-indigo-600', 'text-white', 'border-indigo-500', 'shadow-lg', 'dark:bg-indigo-500', 'dark:text-white');
        }
      }
      if (padElements.controllerButtons[index]) {
      if (padElements.controllerButtons[index]) {
        padElements.controllerButtons[index].classList.toggle('active', isActive);
      }
      }
      if (btn.pressed || btn.value > 0.1) {
        pressed.push(BUTTON_LABELS[index] || `زر ${index}`);
        readings.push(`<li>${BUTTON_LABELS[index] || ('زر ' + index)}: ${btn.value.toFixed(2)}</li>`);
      }
    });

    dom.buttonReadings.innerHTML = readings.join('') || '<li class="text-slate-400 dark:text-slate-500">لا يوجد أزرار مضغوطة</li>';
    state.currentPressedButtons = pressed;
  }

  function renderAxisStates(axes) {
    if (!padElements.axisItems.length) return;
    axes.forEach(function(value, index) {
      const bar = dom.axisList.querySelector(`[data-axis-bar="${index}"]`);
      const label = dom.axisList.querySelector(`[data-axis-value="${index}"]`);
      if (!bar || !label) return;
      const normalized = (value + 1) / 2;
      bar.style.width = `${Math.round(normalized * 100)}%`;
      label.textContent = value.toFixed(2);
    });
    state.currentAxes = axes;

    if (padElements.analogThumbs.length) {
      const leftX = axes[0] || 0;
      const leftY = axes[1] || 0;
      const rightX = axes[2] || 0;
      const rightY = axes[3] || 0;
      if (padElements.analogThumbs[0]) {
        padElements.analogThumbs[0].style.transform = `translate(${leftX * 10}px, ${leftY * 10}px)`;
      }
      if (padElements.analogThumbs[1]) {
        padElements.analogThumbs[1].style.transform = `translate(${rightX * 10}px, ${rightY * 10}px)`;
      }
    }
  }

  function renderAutoSummary(analysis) {
    if (!dom.autoSummary) return;
    const fragments = [];
    const plainSegments = [];

    const overallInfo = analysis.overall || ratingInfo(analysis.ratingKey);
    const overallTone = TONE_CLASS_MAP[overallInfo.tone] || 'bg-slate-600 text-white';
    fragments.push(
      `<div class="flex items-center gap-2 text-sm font-semibold text-slate-200">
        <span>التقييم العام:</span>
        <span class="inline-flex items-center rounded-full px-3 py-1 text-xs font-bold ${overallTone}">${overallInfo.label}</span>
      </div>`
    );
    plainSegments.push(`التقييم العام: ${overallInfo.label}`);

  const axesEval = analysis.axes || { drift: [], range: [], active: [] };
  const axisIssueItems = [];

  axesEval.drift.forEach(function(item) {
    const info = ratingInfo(item.ratingKey);
    const toneClass = TONE_CLASS_MAP[info.tone] || 'bg-slate-600 text-white';
    plainSegments.push(`محور ${item.axis}: انحراف ${item.percent}% ${item.direction} – ${info.label}`);
    axisIssueItems.push(
      `<li class="flex items-center justify-between gap-2 rounded-lg bg-slate-800/60 px-3 py-2 text-xs text-slate-200">
        <span>محور ${item.axis}</span>
        <span class="text-slate-300">${item.percent}% ${item.direction}</span>
        <span class="inline-flex items-center rounded-full px-2 py-0.5 text-[11px] font-semibold ${toneClass}">${info.label}</span>
      </li>`
    );
  });

  axesEval.range.forEach(function(item) {
    const info = ratingInfo(item.ratingKey);
    const toneClass = TONE_CLASS_MAP[info.tone] || 'bg-slate-600 text-white';
    plainSegments.push(`محور ${item.axis}: أقصى استجابة ${item.percent}% ${item.direction} – ${info.label}`);
    axisIssueItems.push(
      `<li class="flex items-center justify-between gap-2 rounded-lg bg-slate-800/60 px-3 py-2 text-xs text-slate-200">
        <span>محور ${item.axis}</span>
        <span class="text-slate-300">أقصى استجابة ${item.percent}% ${item.direction}</span>
        <span class="inline-flex items-center rounded-full px-2 py-0.5 text-[11px] font-semibold ${toneClass}">${info.label}</span>
      </li>`
    );
  });

  if (axisIssueItems.length) {
    fragments.push(
      `<div class="mt-3 text-xs font-semibold text-slate-300">ملخص الأنالوج:</div>
       <ul class="mt-1 space-y-1">${axisIssueItems.join('')}</ul>`
    );
  } else {
    const axesCoverageRatio = analysis.coverage?.axes?.ratio ?? 0;
    if (axesCoverageRatio >= 0.8) {
      fragments.push('<div class="mt-3 text-xs text-emerald-300">الأنالوج في الوضع الطبيعي.</div>');
      plainSegments.push('الأنالوج في الوضع الطبيعي.');
    } else {
      fragments.push('<div class="mt-3 text-xs text-amber-300">ملاحظة: لم يتم اختبار المحاور بالكامل بعد.</div>');
      plainSegments.push('المحاور لم تُختبر بالكامل بعد.');
    }
  }

  if (axesEval.active.length) {
    const activeList = axesEval.active.map(function(item) {
      const info = ratingInfo(item.ratingKey || 'excellent');
      const toneClass = TONE_CLASS_MAP[info.tone] || 'bg-slate-600 text-white';
      const line = `محور ${item.axis} قيد الاختبار (${item.percent}% نحو ${item.direction}) – ${info.label}.`;
      plainSegments.push(line);
      return `<li class="flex items-center justify-between gap-2 rounded-lg bg-slate-800/30 px-3 py-2 text-xs text-slate-200">
        <span>محور ${item.axis}</span>
        <span class="text-slate-300">قيد الاختبار (${item.percent}% نحو ${item.direction})</span>
        <span class="inline-flex items-center rounded-full px-2 py-0.5 text-[11px] font-semibold ${toneClass}">${info.label}</span>
      </li>`;
    }).join('');
    fragments.push(
      `<div class="mt-3 text-xs font-semibold text-slate-300">محاور قيد الاختبار:</div>
       <ul class="mt-1 space-y-1">${activeList}</ul>`
    );
  }

    if (analysis.buttons.items.length) {
      const buttonList = analysis.buttons.items.map(function(item) {
        const info = ratingInfo(item.ratingKey);
        const toneClass = TONE_CLASS_MAP[info.tone] || 'bg-slate-600 text-white';
        plainSegments.push(`الزر ${item.label}: قيمة ${item.value.toFixed(2)} – ${info.label}`);
        return `<li class="flex items-center justify-between gap-2 rounded-lg bg-slate-800/60 px-3 py-2 text-xs text-slate-200">
            <span>${item.label}</span>
            <span class="text-slate-300">${item.value.toFixed(2)}</span>
            <span class="inline-flex items-center rounded-full px-2 py-0.5 text-[11px] font-semibold ${toneClass}">${info.label}</span>
          </li>`;
      }).join('');
      fragments.push(
        `<div class="mt-3 text-xs font-semibold text-slate-300">ملخص الأزرار:</div>
         <ul class="mt-1 space-y-1">${buttonList}</ul>`
      );
    } else {
      fragments.push('<div class="mt-3 text-xs text-emerald-300">الأزرار سليمة (بدون ضغط).</div>');
      plainSegments.push('الأزرار سليمة (بدون ضغط).');
    }

    if (analysis.buttons.pressed && analysis.buttons.pressed.length) {
      const pressedNames = analysis.buttons.pressed.map(function(item) {
        return `${item.label} (${item.value.toFixed(2)})`;
      }).join('، ');
      fragments.push(`<div class="mt-3 text-xs text-slate-400">أزرار قيد الاختبار: ${pressedNames}.</div>`);
      plainSegments.push(`أزرار قيد الاختبار: ${pressedNames}`);
    }

    const coverageSection = [];
    if (analysis.coverage) {
      if (analysis.coverage.axes) {
        const axesCov = analysis.coverage.axes;
        const axesRatio = Math.round((axesCov.ratio || 0) * 100);
        const toneClass = axesRatio >= 95
          ? 'text-emerald-300'
          : axesRatio >= 80
            ? 'text-amber-300'
            : 'text-rose-300';
        const text = `تغطية المحاور: ${axesCov.tested}/${axesCov.total} (${axesRatio}% تم اختبارها)`;
        coverageSection.push(`<li class="flex items-center justify-between gap-2 rounded-lg bg-slate-800/30 px-3 py-2 text-xs text-slate-200">
          <span>المحاور</span>
          <span class="${toneClass}">${text}</span>
        </li>`);
        plainSegments.push(text);
      }
      if (analysis.coverage.buttons) {
        const btnCov = analysis.coverage.buttons;
        const btnRatio = Math.round((btnCov.ratio || 0) * 100);
        const toneClass = btnRatio >= 95
          ? 'text-emerald-300'
          : btnRatio >= 80
            ? 'text-amber-300'
            : 'text-rose-300';
        const text = `تغطية الأزرار: ${btnCov.tested}/${btnCov.total} (${btnRatio}% تم اختبارها)`;
        coverageSection.push(`<li class="flex items-center justify-between gap-2 rounded-lg bg-slate-800/30 px-3 py-2 text-xs text-slate-200">
          <span>الأزرار</span>
          <span class="${toneClass}">${text}</span>
        </li>`);
        plainSegments.push(text);
        if (btnCov.missing > 0) {
          plainSegments.push(`أزرار لم تُضغط: ${btnCov.missing}`);
        }
      }
    }

    if (coverageSection.length) {
      fragments.push(
        `<div class="mt-3 text-xs font-semibold text-slate-300">تغطية الاختبار:</div>
         <ul class="mt-1 space-y-1">${coverageSection.join('')}</ul>`
      );
    }

    dom.autoSummary.innerHTML = fragments.join('');

    state.lastSummaryText = plainSegments.join(' | ');
    updateSummaryAssist(analysis);

    if (!state.summaryTouched && dom.summaryField) {
      dom.summaryField.value = state.lastSummaryText;
    }

    setSummarySyncState(state.summaryTouched ? 'manual' : 'auto');
  }

  async function submitCheck(event) {
    event.preventDefault();
    if (!dom.saveButton) return;
    if (!state.lastSnapshot) {
      alert('قم بتوصيل الذراع وتحريك الأزرار أولاً قبل الحفظ.');
      return;
    }

    dom.saveButton.disabled = true;
    dom.saveButton.classList.add('opacity-70');

    try {
      const formData = new FormData(dom.checkForm);
      const payload = {
        action: 'log_check',
        controller_id: formData.get('controller_id') || null,
        performed_by_name: (formData.get('performed_by_name') || '').trim(),
        status: formData.get('status') || 'ok',
        issues_summary: (formData.get('issues_summary') || '').trim(),
        notes: (formData.get('notes') || '').trim(),
        issues: state.generatedIssues || {},
        raw_snapshot: state.lastSnapshot
      };

      const response = await fetch(state.apiUrl, {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        credentials: 'include',
        body: JSON.stringify(payload)
      });
      const result = await response.json();

      if (!response.ok || !result.success) {
        if (result?.limit_reached) {
          showLimitModal(result.data || {});
        } else {
          alert(result.error || 'تعذر حفظ نتيجة الفحص.');
        }
        return;
      }

      dom.checkForm.reset();
      resetMeasurementState();
      state.summaryTouched = false;
      if (dom.autoSummary) dom.autoSummary.textContent = 'لا توجد قراءات بعد.';
      fetchChecks();
      showSuccessToast('تم حفظ نتيجة الفحص بنجاح.');
    } catch (error) {
      console.error(error);
      alert('حدث خطأ أثناء حفظ نتيجة الفحص.');
    } finally {
      dom.saveButton.disabled = false;
      dom.saveButton.classList.remove('opacity-70');
    }
  }

  async function fetchCheckDetail(checkId) {
    if (!checkId) return null;
    const query = buildQuery({ checks: 1, check_id: checkId });
    const response = await fetch(state.apiUrl + query, { credentials: 'include' });
    const payload = await response.json();
    if (!response.ok || !payload.success) {
      throw new Error(payload.error || 'تعذر تحميل تفاصيل الفحص.');
    }
    return payload.data?.check || null;
  }

  async function openCheckDetail(checkId) {
    try {
      const record = await fetchCheckDetail(checkId);
      if (!record) {
        alert('لم يتم العثور على الفحص.');
        return;
      }

      if (dom.detailMeta) {
        const controllerName = record.controller_name || 'ذراع غير مسجل';
        const statusLabel = getStatusLabel(record.status);
        const performer = record.performed_by_name ? `بواسطة ${record.performed_by_name}` : '';
        const date = record.started_at ? new Date(record.started_at).toLocaleString('ar-EG') : '';
        dom.detailMeta.textContent = `${controllerName} • ${statusLabel} • ${date} ${performer}`;
      }

      if (dom.detailSummary) {
        dom.detailSummary.innerHTML = `<strong>ملخص:</strong><br>${escapeHtml(record.issues_summary || 'لا يوجد ملخص')}`;
      }

      if (dom.detailNotes) {
        dom.detailNotes.innerHTML = `<strong>ملاحظات:</strong><br>${escapeHtml(record.notes || 'لا توجد ملاحظات إضافية')}`;
      }

      if (dom.detailAnalysis) {
        let analysisHtml = 'لا توجد بيانات تحليل إضافية.';
        try {
          const sections = [];
          const issuesPayload = record.issues_json
            ? (typeof record.issues_json === 'string' ? JSON.parse(record.issues_json) : record.issues_json)
            : null;

          const axesPayload = issuesPayload?.axes || {};
          const driftPayload = Array.isArray(axesPayload.drift) ? axesPayload.drift : [];
          const rangePayload = Array.isArray(axesPayload.range) ? axesPayload.range : [];

          const buttonsPayload = Array.isArray(issuesPayload?.buttons)
            ? issuesPayload.buttons
            : (issuesPayload?.buttons?.drift || issuesPayload?.buttons || []);

          if (issuesPayload && (driftPayload.length || rangePayload.length || buttonsPayload.length)) {
            const parts = [];

            if (issuesPayload.overallRating) {
              const info = ratingInfo(issuesPayload.overallRating);
              const toneClass = TONE_CLASS_MAP[info.tone] || 'bg-slate-600 text-white';
              const label = issuesPayload.overallLabel || info.label;
              parts.push(
                `<div class="flex items-center gap-2 text-sm font-semibold text-slate-200">
                  <span>التقييم الآلي:</span>
                  <span class="inline-flex items-center rounded-full px-3 py-1 text-xs font-bold ${toneClass}">${label}</span>
                </div>`
              );
            }

            if (driftPayload.length || rangePayload.length) {
              const axisParts = [];

              if (driftPayload.length) {
                const driftList = driftPayload.map(function(axis) {
                  const info = ratingInfo(axis.rating);
                  const toneClass = TONE_CLASS_MAP[info.tone] || 'bg-slate-600 text-white';
                  return `<li class="flex items-center justify-between gap-2 rounded-lg bg-slate-800/60 px-3 py-2 text-xs text-slate-200">
                      <span>محور ${axis.axis || axis.index + 1}</span>
                      <span class="text-slate-300">انحراف ${axis.percent}% ${axis.direction || ''}</span>
                      <span class="inline-flex items-center rounded-full px-2 py-0.5 text-[11px] font-semibold ${toneClass}">${info.label}</span>
                    </li>`;
                }).join('');
                axisParts.push(
                  `<div class="text-xs font-semibold text-slate-300">انحراف المحاور:</div>
                   <ul class="mt-1 space-y-1">${driftList}</ul>`
                );
              }

              if (rangePayload.length) {
                const rangeList = rangePayload.map(function(axis) {
                  const info = ratingInfo(axis.rating);
                  const toneClass = TONE_CLASS_MAP[info.tone] || 'bg-slate-600 text-white';
                  return `<li class="flex items-center justify-between gap-2 rounded-lg bg-slate-800/60 px-3 py-2 text-xs text-slate-200">
                      <span>محور ${axis.axis || axis.index + 1}</span>
                      <span class="text-slate-300">أقصى استجابة ${axis.percent}% ${axis.direction || ''}</span>
                      <span class="inline-flex items-center rounded-full px-2 py-0.5 text-[11px] font-semibold ${toneClass}">${info.label}</span>
                    </li>`;
                }).join('');
                axisParts.push(
                  `<div class="text-xs font-semibold text-slate-300 mt-3">نطاق الحركة:</div>
                   <ul class="mt-1 space-y-1">${rangeList}</ul>`
                );
              }

              parts.push(
                `<div class="mt-3 space-y-2">
                  <div class="text-xs font-semibold text-slate-300">التحليل الآلي للأنالوج:</div>
                  <div class="space-y-2">${axisParts.join('')}</div>
                </div>`
              );
            }

            if (buttonsPayload.length) {
              const buttonList = buttonsPayload.map(function(button) {
                const info = ratingInfo(button.rating);
                const toneClass = TONE_CLASS_MAP[info.tone] || 'bg-slate-600 text-white';
                return `<li class="flex items-center justify-between gap-2 rounded-lg bg-slate-800/60 px-3 py-2 text-xs text-slate-200">
                    <span>${button.label || ('زر ' + button.index)}</span>
                    <span class="text-slate-300">${Number(button.value).toFixed(2)}</span>
                    <span class="inline-flex items-center rounded-full px-2 py-0.5 text-[11px] font-semibold ${toneClass}">${info.label}</span>
                  </li>`;
              }).join('');
              parts.push(
                `<div class="mt-3 text-xs font-semibold text-slate-300">الأزرار:</div>
                 <ul class="mt-1 space-y-1">${buttonList}</ul>`
              );
            }

            if (issuesPayload?.pressed?.length) {
              const pressedNames = issuesPayload.pressed.map(function(item) {
                return `${item.label || ('زر ' + item.index)} (${Number(item.value).toFixed(2)})`;
              }).join('، ');
              parts.push(`<div class="mt-3 text-xs text-slate-400">أزرار قيد الاختبار أثناء الفحص: ${pressedNames}.</div>`);
            }

            sections.push(parts.join(''));
          }

          let rawSnapshot = null;
          if (record.raw_snapshot) {
            try {
              rawSnapshot = typeof record.raw_snapshot === 'string'
                ? JSON.parse(record.raw_snapshot)
                : record.raw_snapshot;
            } catch (error) {
              console.warn('[ControllerMaintenance] تعذر قراءة البيانات الخام', error);
            }
          }

          if (rawSnapshot) {
            const summary = buildSnapshotSummary(rawSnapshot, issuesPayload?.axes);
            const axesHtml = summary.axes.length
              ? `<ul class="mt-2 space-y-1 text-[11px] text-slate-200">
                  ${summary.axes.map(function(axis) {
                    const highlight = axis.percent || 0;
                    const toneClass = highlight === 0
                      ? 'text-slate-400'
                      : highlight >= 90
                        ? 'text-emerald-300'
                        : 'text-amber-300';
                    const currentText = axis.currentPercent === 0
                      ? 'القيمة الحالية: في الوضع المحايد'
                      : `القيمة الحالية: ${(axis.currentPercent >= 0 ? '+' : '') + axis.currentPercent}% (${axis.currentPercent >= 0 ? axis.directionLabels.positive : axis.directionLabels.negative})`;
                    const positiveText = `${axis.positivePercent > 0 ? '+' + axis.positivePercent : '0'}% ${axis.directionLabels.positive}`;
                    const negativeText = `${axis.negativePercent > 0 ? '+' + axis.negativePercent : '0'}% ${axis.directionLabels.negative}`;
                    const maxText = `أقصى استجابة: ${positiveText} / ${negativeText}`;
                    const driftLine = axis.driftPercent !== null
                      ? `<div class="text-[10px] text-amber-300">انحراف راكد: ${axis.driftPercent}% ${axis.driftDirection || axis.highlightDirection}</div>`
                      : '';
                    return `<li class="flex flex-col gap-1 rounded-lg bg-slate-800/40 px-3 py-1">
                      <div class="flex items-center justify-between gap-2">
                        <span>${axis.label}</span>
                        <span class="${toneClass}">${maxText}</span>
                      </div>
                      <div class="text-[10px] text-slate-400">${currentText}</div>
                      ${driftLine}
                    </li>`;
                  }).join('')}
                </ul>`
              : '<div class="text-[11px] text-slate-400">لم يتم تسجيل قيم للمحاور.</div>';

            const buttonsHtml = summary.buttons.length
              ? `<ul class="mt-2 space-y-1 text-[11px] text-slate-200">
                  ${summary.buttons.map(function(btn) {
                    const state = buttonStatusInfo(btn);
                    const toneClass = state.tone === 'success'
                      ? 'bg-emerald-500/20 text-emerald-200 border border-emerald-500/40'
                      : state.tone === 'info'
                        ? 'bg-sky-500/20 text-sky-200 border border-sky-400/40'
                        : state.tone === 'warn'
                          ? 'bg-amber-500/20 text-amber-200 border border-amber-400/40'
                          : 'bg-rose-500/20 text-rose-200 border border-rose-400/40';
                    const currentText = `القيمة الحالية: ${state.current.toFixed(2)}`;
                    const maxText = state.max !== state.current
                      ? `، أقصى استجابة: ${state.max.toFixed(2)}`
                      : '';
                    return `<li class="flex flex-col gap-1 rounded-lg bg-slate-800/40 px-3 py-1">
                      <div class="flex items-center justify-between gap-2">
                        <span>${btn.label}</span>
                        <span class="inline-flex items-center rounded-full px-2 py-0.5 text-[10px] font-semibold ${toneClass}">${state.label}</span>
                      </div>
                      <div class="text-[10px] text-slate-400">${currentText}${maxText}</div>
                    </li>`;
                  }).join('')}
                </ul>`
              : '<div class="text-[11px] text-slate-400">لم يتم تسجيل أزرار.</div>';

            const deviceInfo = summary.meta.id
              ? `<div class="text-[11px] text-slate-400">المعرّف: ${escapeHtml(summary.meta.id)}</div>`
              : '';
            const capturedAt = summary.meta.timestamp
              ? `<div class="text-[11px] text-slate-400">التوقيت: ${new Date(summary.meta.timestamp).toLocaleString('ar-EG')}</div>`
              : '';

            sections.push(
              `<div class="mt-4 rounded-lg border border-slate-700/60 bg-slate-900/50 p-3 text-xs text-slate-200">
                <div class="text-xs font-semibold text-slate-100">القراءة اللحظية أثناء الاختبار:</div>
                <div class="mt-2 flex flex-col gap-3">
                  <div>
                    <div class="text-[11px] font-semibold text-slate-300">المحاور (Analog)</div>
                    ${axesHtml}
                  </div>
                  <div>
                    <div class="text-[11px] font-semibold text-slate-300">الأزرار</div>
                    ${buttonsHtml}
                  </div>
                  <div class="flex flex-col gap-1">${deviceInfo}${capturedAt}</div>
                </div>
              </div>`
            );
          }

          if (sections.length) {
            analysisHtml = sections.join('');
          }
        } catch (error) {
          analysisHtml = 'تعذر قراءة بيانات التحليل.';
        }

        dom.detailAnalysis.innerHTML = analysisHtml;
      }

      if (dom.detailRaw) {
        let snapshotHtml = '<div class="text-xs text-slate-400">لا توجد بيانات خام مسجلة.</div>';
        dom.detailRaw.innerHTML = snapshotHtml;
      }

      if (dom.detailModal) {
        dom.detailModal.classList.remove('hidden');
        dom.detailModal.classList.add('flex');
      }
    } catch (error) {
      console.error(error);
      alert('حدث خطأ أثناء تحميل التفاصيل.');
    }
  }

  function closeDetailModal() {
    if (!dom.detailModal) return;
    dom.detailModal.classList.add('hidden');
    dom.detailModal.classList.remove('flex');
  }

  function init() {
    dom.actions.forEach(function(btn) {
      btn.addEventListener('click', handleActionClick);
    });

    if (dom.checkForm) dom.checkForm.addEventListener('submit', submitCheck);
    if (dom.editCheckForm) dom.editCheckForm.addEventListener('submit', handleEditCheckSubmit);
    if (dom.createControllerForm) dom.createControllerForm.addEventListener('submit', handleCreateControllerSubmit);
    if (dom.summaryField) {
      dom.summaryField.addEventListener('input', function() {
        state.summaryTouched = true;
        setSummarySyncState('manual');
      });
    }
    setSummarySyncState('idle');
    if (dom.editCheckModal) {
      dom.editCheckModal.addEventListener('click', function(event) {
        if (event.target === dom.editCheckModal) closeEditCheckModal();
      });
    }
    if (dom.deleteCheckModal) {
      dom.deleteCheckModal.addEventListener('click', function(event) {
        if (event.target === dom.deleteCheckModal) closeDeleteCheckModal();
      });
    }
    if (dom.createControllerModal) {
      dom.createControllerModal.addEventListener('click', function(event) {
        if (event.target === dom.createControllerModal) {
          closeCreateControllerModal();
        }
      });
    }
    if (dom.controllerFilterForm) {
      dom.controllerFilterForm.addEventListener('submit', function(event) {
        event.preventDefault();
        const formData = new FormData(dom.controllerFilterForm);
        state.controllerFilters.search = (formData.get('search') || '').trim();
        state.controllerFilters.controller_status = formData.get('controller_status') || '';
        fetchControllers();
      });
    }
    if (dom.checksFilterForm) {
      dom.checksFilterForm.addEventListener('submit', function(event) {
        event.preventDefault();
        state.checkPagination.page = 1;
        const formData = new FormData(dom.checksFilterForm);
        state.checkFilters.controller_id = (formData.get('controller_id') || '').trim();
        state.checkFilters.status = (formData.get('status') || '').trim();
        let dateFrom = (formData.get('date_from') || '').trim();
        let dateTo = (formData.get('date_to') || '').trim();
        if (dateFrom && !/^\d{4}-\d{2}-\d{2}$/.test(dateFrom)) {
          dateFrom = '';
        }
        if (dateTo && !/^\d{4}-\d{2}-\d{2}$/.test(dateTo)) {
          dateTo = '';
        }
        if (dateFrom && dateTo && dateTo < dateFrom) {
          const temp = dateFrom;
          dateFrom = dateTo;
          dateTo = temp;
        }
        state.checkFilters.date_from = dateFrom;
        state.checkFilters.date_to = dateTo;
        if (dom.checksDateFrom && dom.checksDateFrom.value !== dateFrom) {
          dom.checksDateFrom.value = dateFrom;
        }
        if (dom.checksDateTo && dom.checksDateTo.value !== dateTo) {
          dom.checksDateTo.value = dateTo;
        }
        fetchChecks();
      });
    }
    if (dom.selectAllChecks) {
      dom.selectAllChecks.addEventListener('change', function(event) {
        handleSelectAllToggle(event.currentTarget.checked);
      });
    }
    if (dom.controllerDetailModal) {
      dom.controllerDetailModal.addEventListener('click', function(event) {
        if (event.target === dom.controllerDetailModal) closeControllerDetailModal();
      });
    }
    if (dom.deleteControllerModal) {
      dom.deleteControllerModal.addEventListener('click', function(event) {
        if (event.target === dom.deleteControllerModal) closeDeleteControllerModal();
      });
    }
    if (dom.controllersContainer) {
      dom.controllersContainer.addEventListener('click', function(event) {
        const button = event.target.closest('[data-controller-action]');
        if (!button) return;
        const controllerId = Number(button.dataset.controllerId);
        if (!controllerId) return;
        const controller = state.controllers.find(function(item) {
          return item.id == controllerId;
        });
        if (!controller) return;
        switch (button.dataset.controllerAction) {
          case 'view':
            openControllerDetailModal(controller);
            break;
          case 'edit':
            openCreateControllerModal(controller);
            break;
          case 'delete':
            openDeleteControllerModal(controller);
            break;
          default:
            break;
        }
      });
    }
    if (dom.detailModal) {
      dom.detailModal.addEventListener('click', function(event) {
        if (event.target === dom.detailModal) closeDetailModal();
      });
    }
    if (dom.successToast) {
      dom.successToast.addEventListener('click', function(event) {
        if (event.target === dom.successToast) {
          closeSuccessToast();
        }
      });
    }
    if (dom.successToastClose) {
      dom.successToastClose.addEventListener('click', function() {
        closeSuccessToast();
      });
    }
    if (dom.limitModal) {
      dom.limitModal.addEventListener('click', function(event) {
        if (event.target === dom.limitModal) {
          closeLimitModal();
        }
      });
    }
    if (dom.limitModalClose) {
      dom.limitModalClose.addEventListener('click', function() {
        closeLimitModal();
      });
    }
    if (dom.pagination) {
      dom.pagination.addEventListener('click', function(event) {
        const button = event.target.closest('[data-page-action]');
        if (!button) return;
        const action = button.dataset.pageAction;
        if (button.disabled) return;
        switch (action) {
          case 'prev':
            goToPage(state.checkPagination.page - 1);
            break;
          case 'next':
            goToPage(state.checkPagination.page + 1);
            break;
          case 'goto':
            goToPage(Number(button.dataset.page || state.checkPagination.page));
            break;
          default:
            break;
        }
      });
    }
    document.addEventListener('keydown', function(event) {
      if (event.key === 'Escape') {
        if (dom.successToast && dom.successToast.classList.contains('flex')) {
          closeSuccessToast();
          return;
        }
        if (dom.limitModal && dom.limitModal.classList.contains('flex')) {
          closeLimitModal();
          return;
        }
        if (dom.detailModal && !dom.detailModal.classList.contains('hidden')) {
          closeDetailModal();
          return;
        }
        if (state.isCreateControllerOpen) {
          closeCreateControllerModal();
          return;
        }
        if (dom.controllerDetailModal && dom.controllerDetailModal.classList.contains('flex')) {
          closeControllerDetailModal();
          return;
        }
        if (state.deleteControllerId) {
          closeDeleteControllerModal();
        }
      }
    });

    fetchControllers();
    fetchChecks();
    setupGamepadSupport();

    console.info('[ControllerMaintenance] المرحلة الحالية:', state.stage);
  }

  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', init);
  } else {
    init();
  }

  function normalizeSnapshotAxisValue(value) {
    const numeric = Number(value || 0);
    if (!Number.isFinite(numeric)) return 0;
    return Math.max(-1, Math.min(1, numeric));
  }

  function buildAxisEntries(snapshot, analysisAxes) {
    const axes = Array.isArray(snapshot?.axes) ? snapshot.axes : [];
    const axisMetrics = Array.isArray(snapshot?.metrics?.axes) ? snapshot.metrics.axes : [];
    const rangeData = Array.isArray(analysisAxes?.range) ? analysisAxes.range : [];
    const driftData = Array.isArray(analysisAxes?.drift) ? analysisAxes.drift : [];
    const activeData = Array.isArray(analysisAxes?.active) ? analysisAxes.active : [];

    return axes.map(function(value, index) {
      const labels = getAxisDirectionLabels(index);
      const metric = axisMetrics[index] || {};
      const positiveValue = normalizeSnapshotAxisValue(metric.maxPositive || 0);
      const negativeValue = Math.abs(normalizeSnapshotAxisValue(metric.maxNegative || 0));
      let positivePercent = Math.round(Math.max(0, positiveValue) * 100);
      let negativePercent = Math.round(Math.max(0, negativeValue) * 100);

      let rangePositive = null;
      let rangeNegative = null;
      rangeData
        .filter(function(entry) {
          return Number(entry.index) === index || Number(entry.axis) === index + 1;
        })
        .forEach(function(entry) {
          const absPercent = Math.round(Math.abs(entry.percent || 0));
          if (directionMatches(entry.direction, labels.positive)) {
            rangePositive = absPercent;
          }
          if (directionMatches(entry.direction, labels.negative)) {
            rangeNegative = absPercent;
          }
        });

      if (rangePositive !== null) positivePercent = rangePositive;
      if (rangeNegative !== null) negativePercent = rangeNegative;

      const activeMatch = activeData
        .filter(function(entry) {
          return Number(entry.index) === index || Number(entry.axis) === index + 1;
        })
        .reduce(function(prev, current) {
          const currAbs = Math.abs(current.percent || 0);
          const prevAbs = Math.abs(prev.percent || 0);
          if (!currAbs) return prev;
          if (!prevAbs) return current;
          return currAbs < prevAbs ? current : prev;
        }, { percent: 0, direction: null });

      if (activeMatch && Math.abs(activeMatch.percent || 0) > 0) {
        const absPercent = Math.round(Math.abs(activeMatch.percent));
        if (directionMatches(activeMatch.direction, labels.positive)) {
          positivePercent = Math.min(positivePercent || absPercent, absPercent) || absPercent;
        }
        if (directionMatches(activeMatch.direction, labels.negative)) {
          negativePercent = Math.min(negativePercent || absPercent, absPercent) || absPercent;
        }
      }

      const nonZeroPercents = [positivePercent, negativePercent].filter(function(p) { return p > 0; });
      let highlightPercent = 0;
      let highlightDirection = 'لم يتم تحريك المحور';
      if (nonZeroPercents.length) {
        highlightPercent = Math.min.apply(null, nonZeroPercents);
        if (highlightPercent === positivePercent && highlightPercent !== negativePercent) {
          highlightDirection = labels.positive;
        } else if (highlightPercent === negativePercent && highlightPercent !== positivePercent) {
          highlightDirection = labels.negative;
        } else {
          highlightDirection = labels.positive + ' / ' + labels.negative;
        }
      }

      const driftMatch = driftData.find(function(entry) {
        return Number(entry.index) === index || Number(entry.axis) === index + 1;
      });

      const currentPercent = Math.round(normalizeSnapshotAxisValue(value) * 100);

      return {
        index,
        label: ANALOG_AXIS_LABELS[index] || `محور ${index + 1}`,
        value: normalizeSnapshotAxisValue(value),
        percent: highlightPercent,
        highlightDirection,
        currentPercent,
        directionLabels: labels,
        positivePercent,
        negativePercent,
        driftPercent: driftMatch ? Math.round(Math.abs(Number(driftMatch.percent || 0))) : null,
        driftDirection: driftMatch ? (driftMatch.direction || highlightDirection) : null
      };
    });
  }

  function buildButtonEntries(snapshot) {
    const buttons = Array.isArray(snapshot?.buttons) ? snapshot.buttons : [];
    const buttonMetrics = Array.isArray(snapshot?.metrics?.buttons) ? snapshot.metrics.buttons : [];
    return buttons.map(function(btn, index) {
      const value = Number(btn?.value || 0);
      const metric = buttonMetrics[index] || {};
      const maxValue = Number(metric.maxValue ?? value ?? 0);
      const pressedCount = Number(metric.pressedCount ?? 0);
      return {
        index,
        label: BUTTON_LABELS[index] || `زر ${index}`,
        pressed: !!btn?.pressed,
        value,
        maxValue,
        pressedCount,
        significant: !!btn?.pressed || maxValue > 0.15
      };
    });
  }

  function buildSnapshotSummary(snapshot, analysisAxes) {
    if (!snapshot || typeof snapshot !== 'object') {
      return { axes: [], buttons: [], meta: {} };
    }
    const axes = buildAxisEntries(snapshot, analysisAxes);
    const buttons = buildButtonEntries(snapshot);
    const significantButtons = buttons.filter(function(btn) { return btn.significant; });
    return {
      axes,
      buttons,
      significantButtons,
      meta: {
        id: snapshot.id || null,
        timestamp: snapshot.timestamp ? Number(snapshot.timestamp) : null
      }
    };
  }

  function buttonStatusInfo(entry) {
    const currentValue = Number(entry?.value ?? 0);
    const maxValue = Number(entry?.maxValue ?? currentValue);
    const pressedCount = Number(entry?.pressedCount ?? 0);
    const effective = Math.max(currentValue, maxValue);

    if (effective >= 0.9) {
      return {
        label: 'ضغط كامل',
        tone: 'success',
        current: currentValue,
        max: maxValue
      };
    }

    if (effective >= 0.4) {
      return {
        label: 'ضغط جزئي',
        tone: 'info',
        current: currentValue,
        max: maxValue
      };
    }

    if (pressedCount > 0 || effective > 0.1) {
      return {
        label: 'استجابة ضعيفة',
        tone: 'warn',
        current: currentValue,
        max: maxValue
      };
    }

    return {
      label: 'لم يتم الضغط / يرجى التحقق',
      tone: 'danger',
      current: currentValue,
      max: maxValue
    };
  }

  function resetMeasurementState() {
    state.buttonMetrics = [];
    state.axisMetrics = [];
    state.axisMonitor = [];
    state.lastSnapshot = null;
    state.lastAnalysis = null;
    state.generatedIssues = {};
    state.currentAxes = [];
    state.currentPressedButtons = [];
    state.lastSummaryText = '';
    if (dom.autoSummary) {
      dom.autoSummary.textContent = 'لا توجد قراءات بعد.';
    }
    setSummarySyncState('idle');
  }

  function getAxisDirectionLabels(index) {
    return AXIS_DIRECTION_LABELS[index] || { positive: 'الاتجاه +', negative: 'الاتجاه -' };
  }

  function normalizeDirectionText(text) {
    return (text || '')
      .replace(/إلى/gi, '')
      .replace(/[\s/]/g, '')
      .trim();
  }

  function directionMatches(directionText, label) {
    if (!directionText || !label) return false;
    const normalized = normalizeDirectionText(directionText);
    const normalizedLabel = normalizeDirectionText(label);
    return normalized.includes(normalizedLabel) || normalized.includes('ال' + normalizedLabel);
  }

  const AXIS_DRIFT_PERSIST_FRAMES = 20;

  function getAxisDirectionText(index, isPositive, withPrefix = true) {
    const labels = getAxisDirectionLabels(index);
    const word = isPositive ? labels.positive : labels.negative;
    return withPrefix ? `إلى ${word}` : word;
  }
})();

