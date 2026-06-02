<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
  <meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="سيستم لاداره محلات البلايستيشن">
<meta name="keywords" content="PS Management,نظام لاداره محلات البلايستيشن,سيستم,نظام,اداره بلايستيشن,بلايستيشن">
<meta name="robots" content="index, follow">
<link rel="icon" href="https://system.playzones.cloud/uploads/system-seo/favicon_1762007257_eaf22b44.png?v=1780301778" type="image/x-icon">
<link rel="shortcut icon" href="https://system.playzones.cloud/uploads/system-seo/favicon_1762007257_eaf22b44.png?v=1780301778">
<meta property="og:type" content="website">
<meta property="og:title" content="الإعدادات - Play Zone">
<meta property="og:description" content="سيستم لاداره محلات البلايستيشن">
<meta property="og:url" content="https://system.playzones.cloud/client-settings.php">
<meta property="og:image" content="https://system.playzones.cloud/uploads/system-seo/test_1762004814.jpg?v=1780301778">
<meta property="og:image:width" content="1200">
<meta property="og:image:height" content="630">
<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:title" content="الإعدادات - Play Zone">
<meta name="twitter:description" content="سيستم لاداره محلات البلايستيشن">
<meta name="twitter:image" content="https://system.playzones.cloud/uploads/system-seo/test_1762004814.jpg?v=1780301778">
<title>الإعدادات - Play Zone</title>
<style>html{zoom:0.9;-webkit-text-size-adjust:100%;text-size-adjust:100%;}*{-webkit-font-smoothing:antialiased;-moz-osx-font-smoothing:grayscale;}</style>
  <script>
    (function(){
      try {
        var v = localStorage.getItem('darkMode');
        var dark = (v === null) ? true : (v === 'true');
        if (dark) { document.documentElement.style.backgroundColor = '#1a1a2e'; }
        document.addEventListener('DOMContentLoaded', function(){
          if (dark) document.body.classList.add('dark-mode');
        });
      } catch(e) {
        document.documentElement.style.backgroundColor = '#1a1a2e';
        document.addEventListener('DOMContentLoaded', function(){ document.body.classList.add('dark-mode'); });
      }
    })();
  </script>

  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

  <style>
    body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; }

    /* ── Dark Mode ── */
    body.dark-mode { background: linear-gradient(135deg, #0f0f1a 0%, #1a1a2e 100%); color: #e2e8f0; }
    body.dark-mode .cs-card  { background: #1e1e30; border-color: #2d2d45; box-shadow: 0 4px 20px rgba(0,0,0,.4); }
    body.dark-mode .cs-card-inner { background: #252538; border-color: #3a3a55; }
    body.dark-mode .cs-label { color: #cbd5e1; }
    body.dark-mode .cs-input { background: #1a1a2e; border-color: #3a3a55; color: #e2e8f0; }
    body.dark-mode .cs-input:focus { border-color: #ec4899; background: #16162a; }
    body.dark-mode .cs-stat  { background: #1a1a2e; border-color: #2d2d45; }
    body.dark-mode .cs-stat-label { color: #94a3b8; }
    body.dark-mode .cs-divider { border-color: #2d2d45; }
    body.dark-mode #cs-save-row { border-top-color: #2d2d45 !important; }
    body.dark-mode .cs-warn  { background: #2d2010; border-color: #92400e; }
    body.dark-mode .cs-warn p { color: #fcd34d; }
    body.dark-mode .cs-section-title { color: #e2e8f0; }
    body.dark-mode .cs-section-sub   { color: #94a3b8; }
    body.dark-mode .cs-toggle-label  { color: #cbd5e1; }
    body.dark-mode .cs-toggle-sub    { color: #64748b; }

    /* ── Gradient SMS ── */
    .gradient-sms { background: linear-gradient(135deg, #ec4899 0%, #be185d 100%); }

    /* ── Header (Sessions Style) ── */
    .header {
      background: rgba(255, 255, 255, 0.95);
      backdrop-filter: blur(10px);
      border-radius: 15px;
      padding: 15px 25px;
      margin-bottom: 25px;
      box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
      display: flex;
      justify-content: space-between;
      align-items: center;
      flex-wrap: wrap;
      gap: 15px;
    }
    body.dark-mode .header {
      background: rgba(30, 41, 59, 0.95);
      box-shadow: 0 4px 15px rgba(0, 0, 0, 0.3);
    }
    .logo {
      font-size: 2rem;
      font-weight: bold;
      background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
      background-clip: text;
      cursor: pointer;
      transition: transform 0.3s ease;
    }
    .logo:hover { transform: scale(1.05); }
    .header-actions {
      display: flex;
      align-items: center;
      gap: 12px;
      flex-wrap: wrap;
    }
    .dark-mode-toggle {
      background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
      color: white;
      border: none;
      width: 40px;
      height: 40px;
      border-radius: 50%;
      cursor: pointer;
      display: flex;
      align-items: center;
      justify-content: center;
      transition: all 0.3s ease;
      box-shadow: 0 2px 8px rgba(0, 0, 0, 0.2);
    }
    .dark-mode-toggle:hover {
      transform: scale(1.1);
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.3);
    }
    body.dark-mode .dark-mode-toggle {
      background: linear-gradient(135deg, #fbbf24 0%, #f59e0b 100%);
    }
    .back-btn {
      background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
      color: white;
      border: none;
      padding: 10px 20px;
      border-radius: 25px;
      cursor: pointer;
      display: none;
      align-items: center;
      gap: 8px;
      transition: all 0.3s ease;
      font-weight: 600;
      font-size: 0.95rem;
      box-shadow: 0 2px 8px rgba(0, 0, 0, 0.2);
      text-decoration: none;
    }
    .back-btn:hover {
      transform: translateY(-2px);
      box-shadow: 0 4px 12px rgba(102, 126, 234, 0.4);
    }
    body.dark-mode .back-btn {
      background: linear-gradient(135deg, #4f46e5 0%, #7c3aed 100%);
    }
    @media (min-width: 1024px) {
      .back-btn { display: inline-flex; }
    }
    .user-menu { position: relative; }
    .user-btn {
      background: white;
      border: 2px solid #e5e7eb;
      padding: 8px 16px;
      border-radius: 25px;
      cursor: pointer;
      display: flex;
      align-items: center;
      gap: 8px;
      transition: all 0.3s ease;
      font-weight: 600;
      color: #374151;
    }
    body.dark-mode .user-btn {
      background: #1e293b;
      border-color: #334155;
      color: #e2e8f0;
    }
    .user-btn:hover {
      border-color: #667eea;
      transform: translateY(-2px);
      box-shadow: 0 4px 12px rgba(102, 126, 234, 0.2);
    }

    /* ── Page Layout ── */
    .cs-page { min-height: calc(100vh - 65px); }
    .cs-sidebar {
      width: 260px; flex-shrink: 0;
      background: #fff; border-radius: 16px;
      box-shadow: 0 4px 20px rgba(0,0,0,.08);
      padding: 20px 0; height: fit-content;
      position: sticky; top: 85px;
    }
    body.dark-mode .cs-sidebar { background: #1e1e30; box-shadow: 0 4px 20px rgba(0,0,0,.4); }

    .cs-nav-item {
      display: flex; align-items: center; gap: 12px;
      padding: 11px 20px; cursor: pointer;
      font-size: .9rem; font-weight: 500;
      color: #6b7280; transition: all .18s;
      border-right: 3px solid transparent;
    }
    .cs-nav-item:hover { background: #fdf2f8; color: #be185d; }
    .cs-nav-item.active {
      background: #fdf2f8; color: #be185d;
      border-right-color: #ec4899; font-weight: 700;
    }
    body.dark-mode .cs-nav-item { color: #94a3b8; }
    body.dark-mode .cs-nav-item:hover, body.dark-mode .cs-nav-item.active {
      background: #2d1b2e; color: #f472b6;
    }
    body.dark-mode .cs-nav-item.active { border-right-color: #ec4899; }

    /* ── Cards ── */
    .cs-card {
      background: #fff; border-radius: 16px;
      box-shadow: 0 4px 20px rgba(0,0,0,.07);
      border: 1px solid #f1f5f9;
      overflow: hidden;
    }
    .cs-card-header {
      padding: 20px 24px; border-bottom: 1px solid #f1f5f9;
      display: flex; align-items: center; gap: 12px;
    }
    body.dark-mode .cs-card-header { border-color: #2d2d45; }
    .cs-card-body { padding: 24px; }
    .cs-card-inner {
      background: #fafafa; border: 1px solid #f1f5f9;
      border-radius: 12px; padding: 16px; margin-bottom: 16px;
    }
    .cs-label {
      display: block; font-size: .83rem; font-weight: 600;
      color: #374151; margin-bottom: 6px;
    }
    .cs-input {
      width: 100%; border: 1.5px solid #e5e7eb; border-radius: 10px;
      padding: 10px 14px; font-size: .9rem; color: #1f2937;
      transition: all .18s; background: #fff; outline: none;
    }
    .cs-input:focus { border-color: #ec4899; box-shadow: 0 0 0 3px rgba(236,72,153,.12); }

    /* ── Toggle Switch ── */
    .cs-toggle-wrap { display: flex; align-items: center; justify-content: space-between; }
    .cs-toggle-label { font-size: .9rem; font-weight: 600; color: #1f2937; }
    .cs-toggle-sub   { font-size: .78rem; color: #6b7280; margin-top: 2px; }
    .toggle-track {
      position: relative; width: 48px; height: 26px;
      background: #d1d5db; border-radius: 99px;
      cursor: pointer; transition: background .2s; flex-shrink: 0;
    }
    .toggle-track.on { background: #ec4899; }
    .toggle-track.on-blue { background: #3b82f6; }
    .toggle-thumb {
      position: absolute; top: 3px; right: 3px;
      width: 20px; height: 20px; background: #fff;
      border-radius: 50%; transition: transform .2s;
      box-shadow: 0 1px 4px rgba(0,0,0,.2);
    }
    .toggle-track.on .toggle-thumb,
    .toggle-track.on-blue .toggle-thumb { transform: translateX(-22px); }

    /* ── Stats Row ── */
    .cs-stat {
      background: #fff; border: 1px solid #f1f5f9; border-radius: 12px;
      padding: 14px 18px; display: flex; align-items: center;
      justify-content: space-between;
    }
    .cs-stat-label { font-size: .83rem; color: #6b7280; }
    .cs-stat-val   { font-size: 1.4rem; font-weight: 800; color: #ec4899; }

    /* ── Warn Banner ── */
    .cs-warn {
      background: #fffbeb; border: 1px solid #fcd34d;
      border-radius: 10px; padding: 12px 16px; margin-top: 12px;
    }
    .cs-warn p { font-size: .82rem; color: #92400e; }

    /* ── Lock Overlay ── */
    .cs-lock-banner {
      display: flex; align-items: flex-start; gap: 14px;
      background: linear-gradient(135deg, #fef3c7 0%, #fffbeb 100%);
      border: 1.5px solid #f59e0b;
      border-radius: 14px; padding: 16px 20px; margin-bottom: 20px;
    }
    body.dark-mode .cs-lock-banner {
      background: linear-gradient(135deg, #2d1b00 0%, #1c1000 100%);
      border-color: #b45309;
    }
    .cs-lock-icon {
      width: 40px; height: 40px; border-radius: 10px; flex-shrink: 0;
      background: #f59e0b; display: flex; align-items: center; justify-content: center;
    }
    body.dark-mode .cs-lock-icon { background: #b45309; }
    .cs-lock-title { font-size: .9rem; font-weight: 700; color: #92400e; margin-bottom: 4px; }
    body.dark-mode .cs-lock-title { color: #fcd34d; }
    .cs-lock-sub   { font-size: .78rem; color: #a16207; line-height: 1.5; }
    body.dark-mode .cs-lock-sub   { color: #d97706; }

    /* تعتيم الحقول المقفلة */
    .cs-fields-locked .cs-card-inner,
    .cs-fields-locked #cs-save-row { opacity: .45; pointer-events: none; filter: grayscale(60%); }
    .cs-fields-locked .toggle-track { cursor: not-allowed !important; }

    /* ── Upgrade Card (NEW) ── */
    .cs-upgrade-card {
      background: linear-gradient(145deg, #fef3c7 0%, #fef9e3 100%);
      border: 2px solid #fbbf24;
      border-radius: 16px;
      padding: 24px;
      margin-bottom: 20px;
      box-shadow: 0 8px 24px rgba(251, 191, 36, 0.15);
      animation: fadeInUpgrade 0.5s ease-out;
    }
    @keyframes fadeInUpgrade {
      from { opacity: 0; transform: translateY(10px); }
      to { opacity: 1; transform: translateY(0); }
    }
    body.dark-mode .cs-upgrade-card {
      background: linear-gradient(145deg, #2d2010 0%, #3a2715 100%);
      border-color: #d97706;
      box-shadow: 0 8px 24px rgba(217, 119, 6, 0.2);
    }
    .cs-upgrade-header {
      display: flex;
      align-items: center;
      gap: 12px;
      margin-bottom: 16px;
    }
    .cs-upgrade-icon {
      width: 48px;
      height: 48px;
      background: linear-gradient(135deg, #fbbf24 0%, #f59e0b 100%);
      border-radius: 12px;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 24px;
      flex-shrink: 0;
      box-shadow: 0 4px 12px rgba(251, 191, 36, 0.3);
    }
    .cs-upgrade-title {
      font-size: 1.1rem;
      font-weight: 800;
      color: #92400e;
      margin: 0;
    }
    body.dark-mode .cs-upgrade-title { color: #fbbf24; }
    .cs-upgrade-badge {
      display: inline-block;
      background: #fbbf24;
      color: #78350f;
      font-size: 0.7rem;
      font-weight: 700;
      padding: 4px 10px;
      border-radius: 20px;
      margin-right: 8px;
      text-transform: uppercase;
      letter-spacing: 0.5px;
    }
    body.dark-mode .cs-upgrade-badge {
      background: #d97706;
      color: #fef3c7;
    }
    .cs-upgrade-desc {
      font-size: 0.9rem;
      color: #78350f;
      line-height: 1.6;
      margin-bottom: 20px;
    }
    body.dark-mode .cs-upgrade-desc { color: #fde68a; }
    .cs-upgrade-btn {
      display: inline-flex;
      align-items: center;
      gap: 10px;
      background: linear-gradient(135deg, #10b981 0%, #059669 100%);
      color: white;
      font-size: 0.95rem;
      font-weight: 700;
      padding: 14px 28px;
      border-radius: 12px;
      border: none;
      cursor: pointer;
      transition: all 0.3s ease;
      box-shadow: 0 4px 16px rgba(16, 185, 129, 0.3);
      text-decoration: none;
    }
    .cs-upgrade-btn:hover {
      transform: translateY(-2px);
      box-shadow: 0 6px 20px rgba(16, 185, 129, 0.4);
    }
    .cs-upgrade-btn i {
      font-size: 1.2rem;
    }

    /* ── Save Button ── */
    .cs-save-btn {
      display: inline-flex; align-items: center; gap: 8px;
      padding: 12px 28px; font-size: .93rem; font-weight: 700;
      color: #fff; border: none; border-radius: 12px; cursor: pointer;
      transition: all .2s;
    }
    .cs-save-btn:disabled { opacity: .6; cursor: not-allowed; }
    .cs-save-btn:not(:disabled):hover { transform: translateY(-1px); box-shadow: 0 6px 18px rgba(236,72,153,.4); }

    /* ── Section panels (hidden by default) ── */
    .cs-panel { display: none; }
    .cs-panel.active { display: block; }

    /* ── Mobile Nav ── */
    .cs-mobile-nav {
      display: none; overflow-x: auto; gap: 8px;
      padding: 0 4px 12px; scrollbar-width: none;
      -webkit-overflow-scrolling: touch;
    }
    .cs-mobile-nav::-webkit-scrollbar { display: none; }
    .cs-mobile-tab {
      flex-shrink: 0; display: flex; flex-direction: column; align-items: center; gap: 4px;
      padding: 10px 16px; border-radius: 12px; font-size: .75rem; font-weight: 600;
      color: #6b7280; background: #fff; border: 1.5px solid #e5e7eb; cursor: pointer;
      transition: all .18s; white-space: nowrap;
    }
    body.dark-mode .cs-mobile-tab { background: #1e1e30; border-color: #2d2d45; color: #94a3b8; }
    .cs-mobile-tab.active { color: #be185d; background: #fdf2f8; border-color: #f9a8d4; }
    body.dark-mode .cs-mobile-tab.active { background: #2d1b2e; border-color: #ec4899; color: #f472b6; }

    @media (max-width: 767px) {
      .cs-sidebar { display: none; }
      .cs-mobile-nav { display: flex; }
      .cs-card-body { padding: 16px; }
      .cs-card-header { padding: 14px 16px; }
    }

    /* ── Page background & text (dark mode overrides for Tailwind classes) ── */
    body { background: linear-gradient(135deg, #f9fafb 0%, #f3f4f6 100%); }
    body.dark-mode { background: linear-gradient(135deg, #0f0f1a 0%, #1a1a2e 100%) !important; }
    body.dark-mode .page-title    { color: #e2e8f0; }
    body.dark-mode .page-subtitle { color: #94a3b8; }
    .page-title    { color: #1f2937; }
    .page-subtitle { color: #6b7280; }

    /* Container */
    /* تصغير الحجم للشاشات الكبيرة فقط */
    @media (min-width: 1024px) {
      html { font-size: 90%; }
    }

    /* Header Wrapper */
    .header-wrapper {
      width: 96%;
      margin: 0 auto;
      padding: 12px 0;
      box-sizing: border-box;
    }

    /* Page Content Container */
    .cs-container {
      width: 96%;
      max-width: 80rem;
      margin: 0 auto;
      padding: 0 0 40px;
      box-sizing: border-box;
    }

    @media (max-width: 768px) {
      .header-wrapper,
      .cs-container {
        width: 100%;
        padding-left: 12px;
        padding-right: 12px;
      }
    }

    /* Fade-in animation */
    .fade-in { animation: fadeIn .4s ease both; }
    @keyframes fadeIn { from { opacity:0; transform:translateY(-8px); } to { opacity:1; transform:translateY(0); } }

    /* ── Discount Type / Scope Selector ── */
    .discount-type-option,
    .discount-scope-option {
      cursor: pointer;
      flex: 1; min-width: 130px;
    }
    .discount-type-option input,
    .discount-scope-option input { display: none; }
    .discount-type-label,
    .discount-scope-label {
      display: flex; align-items: center; gap: 8px;
      padding: 10px 14px; border-radius: 10px;
      border: 2px solid #e5e7eb; background: #f9fafb;
      font-size: 0.85rem; font-weight: 600; color: #4b5563;
      transition: all .2s; cursor: pointer; user-select: none;
    }
    .discount-type-option input:checked + .discount-type-label,
    .discount-scope-option input:checked + .discount-scope-label {
      border-color: #6d28d9;
      background: linear-gradient(135deg, #8b5cf6 0%, #6d28d9 100%);
      color: #fff;
      box-shadow: 0 4px 14px rgba(109, 40, 217, 0.35);
    }
    .discount-type-label i, .discount-scope-label i { color: #6b7280; }
    .discount-type-option input:checked + .discount-type-label i,
    .discount-scope-option input:checked + .discount-scope-label i {
      color: #fff;
    }
    .discount-default-badge {
      font-size: 0.7rem;
      font-weight: 700;
      background: #8b5cf6;
      color: #fff;
      padding: 1px 6px;
      border-radius: 8px;
      margin-right: 4px;
    }
    .discount-scope-option input:checked + .discount-scope-label .discount-default-badge {
      background: rgba(255, 255, 255, 0.95);
      color: #5b21b6;
    }
    body.dark-mode .discount-type-label,
    body.dark-mode .discount-scope-label {
      background: #252538;
      border-color: #3d3d55;
      color: #e2e8f0;
    }
    body.dark-mode .discount-type-label i,
    body.dark-mode .discount-scope-label i { color: #94a3b8; }
    body.dark-mode .discount-type-option input:checked + .discount-type-label,
    body.dark-mode .discount-scope-option input:checked + .discount-scope-label {
      border-color: #7c3aed;
      background: linear-gradient(135deg, #8b5cf6 0%, #6d28d9 100%);
      color: #fff;
    }
    body.dark-mode .discount-type-option input:checked + .discount-type-label i,
    body.dark-mode .discount-scope-option input:checked + .discount-scope-label i {
      color: #fff;
    }
    body.dark-mode .discount-scope-option input:checked + .discount-scope-label .discount-default-badge {
      background: rgba(255, 255, 255, 0.95);
      color: #5b21b6;
    }
    .toggle-track.on-purple { background: #8b5cf6; }
  </style>
</head>
<body class="dark-mode">

  <!-- Header -->
  <div class="header-wrapper">
    <div class="header fade-in">
    <div class="logo" onclick="window.location.href='dashboard.php'">
      <i class="fas fa-gamepad"></i>
      Play Zone    </div>

    <div class="header-actions">
      <!-- Back Button (Desktop Only) -->
      <a class="back-btn" href="dashboard.php" title="العودة للصفحة الرئيسية">
        <i class="fas fa-arrow-right"></i>
        <span>الصفحة الرئيسية</span>
      </a>

      <!-- Dark Mode Toggle -->
      <button class="dark-mode-toggle" onclick="toggleDarkMode()" title="تبديل الوضع الداكن/الساطع">
        <i id="dark-mode-icon" class="fas fa-sun"></i>
      </button>

      <!-- User Menu -->
      <div class="user-menu">
        <button class="user-btn" onclick="window.location.href='logout.php'">
          <i class="fas fa-user"></i>
          <span>admin_mahmoud_atef</span>
          <i class="fas fa-sign-out-alt"></i>
        </button>
      </div>
    </div>
  </div>
  </div><!-- /header-wrapper -->

  <!-- ══ Page Content ══ -->
  <main class="cs-container" style="padding-top:24px;">

    <!-- Page Title -->
    <div class="mb-6 fade-in">
      <h2 class="page-title text-2xl font-bold flex items-center gap-3">
        <span class="w-10 h-10 gradient-sms rounded-xl flex items-center justify-center">
          <i class="fas fa-sliders-h text-white text-lg"></i>
        </span>
        إعدادات الحساب
      </h2>
      <p class="page-subtitle text-sm mt-1" style="margin-right:52px">تحكم في جميع إعدادات حسابك من مكان واحد</p>
    </div>

    <!-- Mobile Tabs -->
    <div class="cs-mobile-nav mb-4" id="mobileTabs">
      <button type="button" id="mobile-tab-billing" class="cs-mobile-tab active" onclick="switchTab('billing', this)">
        <i class="fas fa-coins text-lg"></i> الحساب
      </button>
      <button type="button" id="mobile-tab-discounts" class="cs-mobile-tab" onclick="switchTab('discounts', this)">
        <i class="fas fa-tag text-lg"></i> الخصومات
      </button>
      <button type="button" id="mobile-tab-currency" class="cs-mobile-tab" onclick="switchTab('currency', this)">
        <i class="fas fa-money-bill-wave text-lg"></i> العملة
      </button>
      <button type="button" id="mobile-tab-sms" class="cs-mobile-tab" onclick="switchTab('sms', this)">
        <i class="fas fa-sms text-lg"></i> SMS
      </button>
      <button type="button" id="mobile-tab-email-reports" class="cs-mobile-tab" onclick="switchTab('email-reports', this)">
        <i class="fas fa-envelope text-lg"></i> التقارير
      </button>
    </div>

    <div class="flex gap-6 cs-page">

      <!-- ══ Sidebar ══ -->
      <nav class="cs-sidebar">
        <div class="px-5 pb-3 mb-2" style="border-bottom:1px solid #f1f5f9">
          <p class="text-xs font-bold text-gray-400 uppercase tracking-widest">القائمة</p>
        </div>
        <div class="cs-nav-item active" id="nav-billing" onclick="switchTab('billing', this)">
          <i class="fas fa-coins w-5 text-center"></i> الحساب
        </div>
        <div class="cs-nav-item" id="nav-discounts" onclick="switchTab('discounts', this)">
          <i class="fas fa-tag w-5 text-center"></i> الخصومات
        </div>
        <div class="cs-nav-item" id="nav-currency" onclick="switchTab('currency', this)">
          <i class="fas fa-money-bill-wave w-5 text-center"></i> العملة
        </div>
        <div class="cs-nav-item" id="nav-sms" onclick="switchTab('sms', this)">
          <i class="fas fa-sms w-5 text-center"></i> إعدادات SMS
        </div>
        <div class="cs-nav-item" id="nav-email-reports" onclick="switchTab('email-reports', this)">
          <i class="fas fa-envelope w-5 text-center"></i> التقارير البريدية
        </div>
      </nav>

      <!-- ══ Panels ══ -->
      <div class="flex-1 min-w-0">

        <!-- ▶ Billing Panel -->
        <div class="cs-panel active" id="panel-billing">
          <div class="cs-card">
            <div class="cs-card-header">
              <span class="w-9 h-9 rounded-lg flex items-center justify-center flex-shrink-0" style="background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);">
                <i class="fas fa-coins text-white"></i>
              </span>
              <div>
                <h3 class="font-bold text-gray-800 cs-section-title text-sm sm:text-base">إعدادات الحساب</h3>
                <p class="text-xs text-gray-400 cs-section-sub">التحكم في طريقة حساب إجمالي الجلسات</p>
              </div>
            </div>
            <div class="cs-card-body">
              <!-- Toggle for Rounding -->
              <div class="cs-card-inner">
                <div class="cs-toggle-wrap">
                  <div>
                    <p class="cs-toggle-label">تقريب حساب الجلسة لأقرب 5 جنيه</p>
                    <p class="cs-toggle-sub">عند التفعيل، يتم تقريب إجمالي الجلسة للأعلى (مثال: 22 → 25، 54 → 55)</p>
                  </div>
                  <div id="roundingToggle" class="toggle-track" onclick="toggleRounding()" title="تبديل التقريب">
                    <div class="toggle-thumb"></div>
                  </div>
                </div>
              </div>

              <!-- Info Banner -->
              <div class="p-3 bg-blue-50 rounded-lg border border-blue-200" style="margin-bottom: 16px;">
                <p class="text-xs text-blue-800">
                  <i class="fas fa-info-circle mr-1"></i>
                  <strong>ملاحظة:</strong> التقريب يُطبَّق على حساب الوقت فقط، ولا يؤثر على أسعار الطلبات (الطعام والمشروبات).
                </p>
              </div>

              <!-- Save Button -->
              <div class="flex items-center justify-between flex-wrap gap-3 pt-4" style="border-top:1px solid #f1f5f9">
                <p class="text-xs text-gray-400 cs-section-sub flex items-center gap-1">
                  <i class="fas fa-check-circle"></i>
                  التغييرات تُطبَّق على الجلسات الجديدة فور الحفظ
                </p>
                <button id="saveBillingBtn" onclick="saveBillingSettings()" class="cs-save-btn" style="background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);">
                  <i class="fas fa-save"></i> حفظ الإعدادات
                </button>
              </div>
            </div>
          </div>
        </div>

        <!-- ▶ Discounts Panel -->
        <div class="cs-panel" id="panel-discounts">
          <div class="cs-card">
            <div class="cs-card-header">
              <span class="w-9 h-9 rounded-lg flex items-center justify-center flex-shrink-0" style="background: linear-gradient(135deg, #8b5cf6 0%, #6d28d9 100%);">
                <i class="fas fa-tag text-white"></i>
              </span>
              <div>
                <h3 class="font-bold text-gray-800 cs-section-title text-sm sm:text-base">نظام الخصومات</h3>
                <p class="text-xs text-gray-400 cs-section-sub">التحكم في تفعيل الخصومات وطريقة تطبيقها على الفواتير</p>
              </div>
            </div>
            <div class="cs-card-body">

              <!-- Toggle تفعيل النظام -->
              <div class="cs-card-inner" style="margin-bottom:16px;">
                <div class="cs-toggle-wrap">
                  <div>
                    <p class="cs-toggle-label">تفعيل نظام الخصومات</p>
                    <p class="cs-toggle-sub">عند التفعيل، يظهر حقل الخصم للمستخدمين الذين لديهم الصلاحية</p>
                  </div>
                  <div id="discountEnabledToggle" class="toggle-track" onclick="toggleDiscountEnabled()" title="تبديل الخصومات">
                    <div class="toggle-thumb"></div>
                  </div>
                </div>
              </div>

              <!-- خيارات تظهر فقط عند التفعيل -->
              <div id="discountOptionsPanel" style="display:none;">

                <!-- نوع الخصم -->
                <div class="cs-card-inner" style="margin-bottom:16px;">
                  <p class="cs-toggle-label" style="margin-bottom:10px;">
                    <i class="fas fa-percent" style="color:#8b5cf6; margin-left:6px;"></i>
                    طريقة الخصم
                  </p>
                  <div style="display:flex; gap:12px; flex-wrap:wrap;">
                    <label class="discount-type-option" id="dtOpt_percentage">
                      <input type="radio" name="discount_type_radio" value="percentage" onchange="selectDiscountType('percentage')">
                      <span class="discount-type-label">
                        <i class="fas fa-percent"></i>
                        نسبة مئوية (%)
                      </span>
                    </label>
                    <label class="discount-type-option" id="dtOpt_fixed">
                      <input type="radio" name="discount_type_radio" value="fixed" onchange="selectDiscountType('fixed')">
                      <span class="discount-type-label">
                        <i class="fas fa-coins"></i>
                        مبلغ ثابت (جنيه)
                      </span>
                    </label>
                  </div>
                </div>

                <!-- نطاق الخصم -->
                <div class="cs-card-inner" style="margin-bottom:16px;">
                  <p class="cs-toggle-label" style="margin-bottom:10px;">
                    <i class="fas fa-crosshairs" style="color:#8b5cf6; margin-left:6px;"></i>
                    نطاق تطبيق الخصم
                  </p>
                  <div style="display:flex; gap:12px; flex-wrap:wrap;">
                    <label class="discount-scope-option" id="dsOpt_sessions">
                      <input type="radio" name="discount_scope_radio" value="sessions" onchange="selectDiscountScope('sessions')">
                      <span class="discount-scope-label">
                        <i class="fas fa-gamepad"></i>
                        الجلسات فقط
                      </span>
                    </label>
                    <label class="discount-scope-option" id="dsOpt_cafe">
                      <input type="radio" name="discount_scope_radio" value="cafe" onchange="selectDiscountScope('cafe')">
                      <span class="discount-scope-label">
                        <i class="fas fa-coffee"></i>
                        الكافيه فقط
                      </span>
                    </label>
                    <label class="discount-scope-option active" id="dsOpt_both">
                      <input type="radio" name="discount_scope_radio" value="both" checked onchange="selectDiscountScope('both')">
                      <span class="discount-scope-label">
                        <i class="fas fa-layer-group"></i>
                        الجلسات والكافيه
                        <span class="discount-default-badge">افتراضي</span>
                      </span>
                    </label>
                  </div>
                </div>

                <!-- بانر توضيحي -->
                <div class="p-3 rounded-lg border" style="background:#f5f3ff; border-color:#ddd6fe; margin-bottom:16px;">
                  <p class="text-xs" style="color:#5b21b6;">
                    <i class="fas fa-info-circle" style="margin-left:4px;"></i>
                    <strong>تنبيه:</strong> الخصم يُطبَّق على إجمالي الفاتورة النهائية حسب النطاق المحدد. خصم واحد فقط لكل عملية إنهاء. صلاحيات وحدود كل موظف تُضبط من <strong>إدارة الموظفين</strong>.
                  </p>
                </div>

              </div><!-- /discountOptionsPanel -->

              <!-- Save Button -->
              <div class="flex items-center justify-between flex-wrap gap-3 pt-4" style="border-top:1px solid #f1f5f9">
                <p class="text-xs text-gray-400 cs-section-sub flex items-center gap-1">
                  <i class="fas fa-check-circle"></i>
                  التغييرات تُطبَّق فور الحفظ
                </p>
                <button id="saveDiscountBtn" onclick="saveDiscountSettings()" class="cs-save-btn" style="background: linear-gradient(135deg, #8b5cf6 0%, #6d28d9 100%);">
                  <i class="fas fa-save"></i> حفظ إعدادات الخصم
                </button>
              </div>
            </div>
          </div>
        </div><!-- /panel-discounts -->

        <!-- ▶ Currency Panel -->
        <div class="cs-panel" id="panel-currency">
          <div class="cs-card">
            <div class="cs-card-header">
              <span class="w-9 h-9 rounded-lg flex items-center justify-center flex-shrink-0" style="background: linear-gradient(135deg, #10b981 0%, #059669 100%);">
                <i class="fas fa-money-bill-wave text-white"></i>
              </span>
              <div>
                <h3 class="font-bold text-gray-800 cs-section-title text-sm sm:text-base">إعدادات العملة</h3>
                <p class="text-xs text-gray-400 cs-section-sub">اختر العملة التي تستخدمها في منشأتك</p>
              </div>
            </div>
            <div class="cs-card-body">
              <!-- Currency Select (Modern Tailwind-style dropdown) -->
              <div class="cs-card-inner">
                <label class="block text-sm font-semibold text-gray-200 mb-2">
                  <i class="fas fa-coins mr-1 text-green-400"></i>
                  العملة الافتراضية
                </label>

                <!-- Custom dropdown -->
                <div id="currencyDropdown" class="relative">
                  <!-- Visible trigger -->
                  <button
                    id="currencyDropdownButton"
                    type="button"
                    class="w-full flex items-center justify-between px-4 py-3 rounded-lg border border-slate-700 bg-slate-900/80 text-slate-50 text-sm shadow-sm transition focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500"
                  >
                    <span id="currencyDropdownLabel" class="truncate opacity-70 text-xs">
                      جاري التحميل...
                    </span>
                    <span class="flex items-center gap-2">
                      <span id="currencyDropdownSymbol" class="text-emerald-400 text-sm font-semibold"></span>
                      <i class="fas fa-chevron-down text-xs opacity-60"></i>
                    </span>
                  </button>

                  <!-- Options list -->
                  <div
                    id="currencyDropdownList"
                    class="absolute z-20 mt-2 w-full max-h-56 overflow-auto rounded-lg border border-slate-700 bg-slate-900/95 shadow-xl backdrop-blur-sm hidden"
                  >
                    <!-- يتم ملؤها ديناميكياً من JavaScript -->
                  </div>
                </div>

                <p class="text-xs text-slate-400 mt-2">
                  <i class="fas fa-info-circle mr-1"></i>
                  ستظهر العملة المختارة في جميع صفحات النظام (الجلسات، التقارير، الطلبات، إلخ)
                </p>
              </div>

              <!-- Preview Card -->
              <div class="p-4 bg-gradient-to-br from-green-50 to-emerald-50 rounded-xl border border-green-200">
                <p class="text-xs text-green-800 font-semibold mb-2">
                  <i class="fas fa-eye mr-1"></i>
                  معاينة العرض
                </p>
                <div class="flex items-center justify-between bg-white p-3 rounded-lg shadow-sm">
                  <span class="text-sm text-gray-600">مثال: سعر الساعة</span>
                  <span class="text-lg font-bold text-green-600" id="currencyPreview">50 جنيه</span>
                </div>
              </div>

              <!-- Save Button -->
              <div class="flex items-center justify-between flex-wrap gap-3 pt-4" style="border-top:1px solid #f1f5f9">
                <p class="text-xs text-gray-400 cs-section-sub flex items-center gap-1">
                  <i class="fas fa-sync-alt"></i>
                  التغييرات تُطبَّق فوراً في جميع الصفحات
                </p>
                <button id="saveCurrencyBtn" onclick="saveCurrencySettings()" class="cs-save-btn" style="background: linear-gradient(135deg, #10b981 0%, #059669 100%);">
                  <i class="fas fa-save"></i> حفظ العملة
                </button>
              </div>
            </div>
          </div>
        </div>

        <!-- ▶ SMS Panel -->
        <div class="cs-panel" id="panel-sms">

          <!-- Row: Status + Stats -->
          <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 mb-5">

            <!-- Status Card -->
            <div class="cs-card sm:col-span-2">
              <div class="cs-card-header">
                <span class="w-9 h-9 gradient-sms rounded-lg flex items-center justify-center flex-shrink-0">
                  <i class="fas fa-sms text-white"></i>
                </span>
                <div>
                  <h3 class="font-bold text-gray-800 cs-section-title text-sm sm:text-base">رسائل SMS</h3>
                  <p class="text-xs text-gray-400 cs-section-sub">إرسال تفاصيل الجلسة للعملاء فور الانتهاء</p>
                </div>
                <!-- Status Badge (dynamic) -->
                <span id="smsBadgeStatus" class="mr-auto text-xs font-bold px-3 py-1 rounded-full hidden"></span>
              </div>
              <div class="cs-card-body" id="smsPanelBody">

                <!-- Lock Banner (hidden by default, shown when plan/SA blocks) -->
                <div id="smsLockBanner" class="cs-lock-banner hidden">
                  <div class="cs-lock-icon">
                    <i class="fas fa-lock text-white text-base"></i>
                  </div>
                  <div>
                    <p class="cs-lock-title">الميزة غير متاحة في باقتك الحالية</p>
                    <p class="cs-lock-sub" id="smsLockReason">تواصل مع الدعم لترقية باقتك وتفعيل ميزة SMS.</p>
                  </div>
                </div>

                <!-- Upgrade Card (shown when plan blocks SMS invoices feature) -->
                <div id="smsUpgradeCard" class="cs-upgrade-card hidden">
                  <div class="cs-upgrade-header">
                    <div class="cs-upgrade-icon">
                      <i class="fas fa-crown" style="color: #fff;"></i>
                    </div>
                    <div style="flex: 1;">
                      <span class="cs-upgrade-badge">ترقية</span>
                      <h3 class="cs-upgrade-title">فواتير SMS للعملاء</h3>
                    </div>
                  </div>
                  <p class="cs-upgrade-desc">
                    <strong>ميزة فواتير SMS</strong> تتيح لك إرسال تفاصيل كاملة لجلسات العملاء عبر الرسائل النصية فور الانتهاء، مما يوفر تجربة احترافية ويعزز ثقة عملائك في خدماتك. كما تمنع تلاعب الموظفين في الحسابات بنسبة 100%.
                  </p>
                  <a href="#" id="smsUpgradeWhatsAppBtn" class="cs-upgrade-btn" target="_blank" rel="noopener noreferrer">
                    <i class="fab fa-whatsapp"></i>
                    تواصل مع الإدارة لتفعيل الميزة
                  </a>
                </div>

                <!-- Fields wrapper (يُضاف إليه cs-fields-locked عند القفل) -->
                <div id="smsFieldsWrap">

                <!-- Toggle -->
                <div class="cs-card-inner">
                  <div class="cs-toggle-wrap">
                    <div>
                      <p class="cs-toggle-label">تفعيل ميزة SMS</p>
                      <p class="cs-toggle-sub">إرسال رسائل SMS للعملاء عند إنهاء الجلسة</p>
                    </div>
                    <div id="smsToggle" class="toggle-track" onclick="toggleSms()" title="تبديل تفعيل SMS">
                      <div class="toggle-thumb"></div>
                    </div>
                  </div>
                </div>

                <!-- Shop Name -->
                <div class="cs-card-inner">
                  <label class="cs-label" for="shopNameInp">
                    🏪 اسم المحل
                    <span class="font-normal text-gray-400 text-xs">(يظهر في رسائل SMS للعملاء)</span>
                  </label>
                  <input id="shopNameInp" type="text" class="cs-input" maxlength="100"
                    placeholder="مثال: كافيه النجوم"
                    autocomplete="off" spellcheck="false">
                </div>

                <!-- Complaint Phone -->
                <div class="cs-card-inner">
                  <label class="cs-label" for="complaintPhoneInp">
                    📞 رقم هاتف الشكاوي
                    <span class="font-normal text-gray-400 text-xs">(يُضاف تلقائياً في نهاية رسالة SMS للعميل)</span>
                  </label>
                  <input id="complaintPhoneInp" type="tel" class="cs-input" maxlength="11"
                    placeholder="مثال: 01012345678" dir="ltr"
                    autocomplete="off" autocorrect="off" autocapitalize="none"
                    spellcheck="false" inputmode="numeric" pattern="[0-9]*">
                  <div class="flex items-center gap-3 mt-1" style="font-size:.78rem">
                    <span id="cphCtr" style="color:#9ca3af;font-variant-numeric:tabular-nums;direction:ltr">0 / 11</span>
                    <span id="cphMsg" style="color:#9ca3af"></span>
                  </div>
                </div>

                <!-- Warning if blocked -->
                <div id="smsBlockedBanner" class="cs-warn hidden">
                  <p class="flex items-start gap-2">
                    <i class="fas fa-exclamation-triangle mt-0.5 flex-shrink-0"></i>
                    <span id="smsBlockedTxt">ميزة SMS غير متاحة في باقتك الحالية.</span>
                  </p>
                </div>

                <!-- Save Button (inside card) -->
                <div class="flex items-center justify-between flex-wrap gap-3 mt-4 pt-4" style="border-top:1px solid #f1f5f9" id="cs-save-row">
                  <p class="text-xs text-gray-400 cs-section-sub flex items-center gap-1">
                    <i class="fas fa-info-circle"></i>
                    الإعدادات المحفوظة تُطبَّق فوراً على جميع الجلسات القادمة
                  </p>
                  <button id="saveBtn" onclick="saveSettings()" class="cs-save-btn gradient-sms">
                    <i class="fas fa-save"></i> حفظ الإعدادات
                  </button>
                </div>

                </div><!-- /smsFieldsWrap -->
              </div>
            </div>

            <!-- Stats Card -->
            <div class="flex flex-col gap-4">
              <!-- Monthly Usage -->
              <div class="cs-card flex-1">
                <div class="cs-card-body flex flex-col items-center justify-center text-center py-6">
                  <div class="w-14 h-14 rounded-2xl gradient-sms flex items-center justify-center mb-3">
                    <i class="fas fa-chart-bar text-white text-xl"></i>
                  </div>
                  <div id="statMonthly" class="text-4xl font-black text-pink-600 mb-1">—</div>
                  <p class="text-xs text-gray-400 cs-section-sub">رسالة هذا الشهر</p>
                </div>
              </div>

              <!-- Allowed -->
              <div class="cs-card">
                <div class="cs-card-body py-4">
                  <p class="text-xs text-gray-400 cs-section-sub mb-1">حالة الإرسال</p>
                  <div id="statAllowed" class="flex items-center gap-2 font-bold text-sm">
                    <i class="fas fa-spinner fa-spin text-gray-400"></i>
                    <span class="text-gray-400">جاري التحقق...</span>
                  </div>
                </div>
              </div>
            </div>

          </div><!-- /Row -->


        </div><!-- /SMS Panel -->

        <!-- ▶ Email Reports Panel -->
        <div class="cs-panel" id="panel-email-reports">

          <div class="cs-card">
            <div class="cs-card-header">
              <span class="w-9 h-9 rounded-lg flex items-center justify-center flex-shrink-0" style="background: linear-gradient(135deg, #3b82f6 0%, #1d4ed8 100%);">
                <i class="fas fa-envelope text-white"></i>
              </span>
              <div>
                <h3 class="font-bold text-gray-800 cs-section-title text-sm sm:text-base">التقارير البريدية الدورية</h3>
                <p class="text-xs text-gray-400 cs-section-sub">استقبل تقارير تفصيلية عن أداء منشأتك مباشرة على بريدك الإلكتروني</p>
              </div>
            </div>

            <div class="cs-card-body">

              <!-- Upgrade Card — تظهر عند عدم دعم الباقة -->
              <div id="emailReportsUpgradeCard" class="cs-upgrade-card hidden">
                <div class="cs-upgrade-header">
                  <div class="cs-upgrade-icon">
                    <i class="fas fa-crown" style="color:#fff;"></i>
                  </div>
                  <div style="flex:1">
                    <span class="cs-upgrade-badge">ترقية</span>
                    <h3 class="cs-upgrade-title">التقارير البريدية الدورية</h3>
                  </div>
                </div>
                <p class="cs-upgrade-desc">
                  <strong>ميزة التقارير البريدية</strong> تتيح لك استقبال تقارير أسبوعية أو شهرية شاملة تتضمن: إجمالي الجلسات والطلبات، أداء الموظفين، أكثر المنتجات مبيعاً، ومقارنة بالفترة السابقة. كل ذلك مباشرة على بريدك الإلكتروني.
                </p>
                <a href="#" id="emailReportsUpgradeBtn" class="cs-upgrade-btn" target="_blank" rel="noopener noreferrer">
                  <i class="fab fa-whatsapp"></i>
                  تواصل مع الإدارة لتفعيل الميزة
                </a>
              </div>

              <!-- Lock Banner — تظهر عند إيقاف الميزة على مستوى النظام -->
              <div id="emailReportsLockBanner" class="cs-lock-banner hidden">
                <div class="cs-lock-icon">
                  <i class="fas fa-lock text-white text-base"></i>
                </div>
                <div>
                  <p class="cs-lock-title">الميزة غير متاحة حالياً</p>
                  <p class="cs-lock-sub" id="emailReportsLockReason">تواصل مع الدعم للاستفسار عن تفعيل ميزة التقارير البريدية.</p>
                </div>
              </div>

              <!-- الحقول الفعلية — تظهر عند توفر الصلاحية -->
              <div id="emailReportsFieldsWrap">

                <!-- Toggle -->
                <div class="cs-card-inner">
                  <div class="cs-toggle-wrap">
                    <div>
                      <p class="cs-toggle-label">تفعيل التقارير البريدية</p>
                      <p class="cs-toggle-sub">استقبال تقارير دورية على بريدك الإلكتروني</p>
                    </div>
                    <div id="emailReportsToggle" class="toggle-track toggle-blue" onclick="toggleEmailReports()" title="تبديل التقارير البريدية">
                      <div class="toggle-thumb"></div>
                    </div>
                  </div>
                </div>

                <!-- Email Input -->
                <div class="cs-card-inner">
                  <label class="cs-label" for="reportEmailInp">
                    <i class="fas fa-at text-blue-500 mr-1"></i> البريد الإلكتروني
                    <span class="font-normal text-gray-400 text-xs">(يُرسل إليه التقرير)</span>
                  </label>
                  <input id="reportEmailInp" type="email" class="cs-input" dir="ltr"
                    placeholder="example@domain.com"
                    autocomplete="email">
                </div>

                <!-- Frequency -->
                <div class="cs-card-inner">
                  <p class="cs-label mb-3">
                    <i class="fas fa-calendar-alt text-blue-500 mr-1"></i> تكرار الإرسال
                  </p>
                  <div id="frequencyOptionsContainer" class="grid grid-cols-1 md:grid-cols-2 gap-3">
                    <!-- يتم ملؤها ديناميكياً من JavaScript -->
                    <div class="col-span-full text-center py-4 text-gray-400">
                      <i class="fas fa-spinner fa-spin mr-2"></i> جاري التحميل...
                    </div>
                  </div>
                </div>

                <!-- Save Button -->
                <div class="cs-card-inner border-t pt-4">
                  <button id="saveEmailReportsBtn" onclick="saveEmailReportsSettings()" class="w-full py-3 rounded-xl text-white font-bold text-sm transition" style="background:linear-gradient(135deg,#3b82f6,#1d4ed8)">
                    <i class="fas fa-save mr-1"></i> حفظ إعدادات التقارير
                  </button>
                </div>

              </div><!-- /emailReportsFieldsWrap -->

            </div><!-- /cs-card-body -->
          </div><!-- /cs-card -->

        </div><!-- /Email Reports Panel -->

      </div><!-- /Panels -->
    </div><!-- /flex -->
  </main>

  <!-- ══ Toast ══ -->
  <div id="csToast"
    class="fixed bottom-5 left-1/2 -translate-x-1/2 z-[9999] px-5 py-3 rounded-xl text-white text-sm font-bold shadow-xl
           flex items-center gap-3 transition-all duration-300 opacity-0 pointer-events-none"
    style="min-width:220px; max-width:90vw">
    <i id="csToastIco" class="fas fa-check-circle text-lg"></i>
    <span id="csToastMsg"></span>
  </div>

  
<!-- Branded Footer -->
<div class="branded-footer gradient-blue" style="backdrop-filter: blur(8px); border-top: 1px solid rgba(255,255,255,0.1); padding: 12px 0; margin-top: 30px;">
  <div style="max-width: 1200px; margin: 0 auto; padding: 0 20px; text-align: center;">
    <div style="display: flex; flex-direction: column; gap: 6px; align-items: center;">
      <!-- Copyright -->
      <p style="margin: 0; font-size: 13px; color: rgba(255,255,255,0.9); font-weight: 500;">
        © 2026 Play Zone      </p>

      <!-- Contact Email -->
              <p style="margin: 0; font-size: 12px; color: rgba(255,255,255,0.8); display: flex; align-items: center; gap: 5px;">
          <span style="font-size: 14px;">📧</span>
          <span>للدعم والتواصل:</span>
          <a href="mailto:info.playzones.cloud" class="footer-link" style="color: inherit; text-decoration: none; border-bottom: 1px dashed rgba(255,255,255,0.3); transition: all 0.3s;" onmouseover="this.style.borderBottomStyle='solid'; this.style.opacity='1'" onmouseout="this.style.borderBottomStyle='dashed'; this.style.opacity='0.8'">info.playzones.cloud</a>        </p>
      
      <!-- Development Credit -->
              <p style="margin: 4px 0 0 0; font-size: 11px; color: rgba(255,255,255,0.7);">
          تم التطوير بواسطة <span style="color: #10b981; font-weight: 600;">ENG.HOSSAM</span>
        </p>
          </div>
  </div>
</div>

<style>
  /* Footer gradient background */
  .gradient-blue {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
  }

  /* Footer links styling */
  .branded-footer .footer-link {
    color: rgba(255, 255, 255, 0.9) !important;
    border-bottom-color: rgba(255, 255, 255, 0.5) !important;
  }

  .branded-footer .footer-link:hover {
    border-bottom-style: solid !important;
    opacity: 1 !important;
  }

  /* Dark mode footer adjustments */
  body.dark-mode .branded-footer {
    background: linear-gradient(135deg, #1a1a2e 0%, #16213e 100%) !important;
    border-top-color: rgba(255, 255, 255, 0.05) !important;
  }

  /* Responsive adjustments for footer */
  @media (max-width: 640px) {
    .branded-footer {
      padding: 10px 0 !important;
      margin-top: 20px !important;
    }

    .branded-footer p {
      font-size: 11px !important;
    }

    .branded-footer .footer-link {
      font-size: 10px !important;
    }
  }
</style>
</body>

<script>
// ══════════════════════════════════════════════
//  Client Settings Page — JS (Secured)
// ══════════════════════════════════════════════

/* ── ثابت العملة (مُحقن من PHP) ── */
const SMS_ALLOWED_BY_CURRENCY = true;

/* ── CSRF token (injected from PHP session) ── */
const __csrfToken = 'e1ab6cb2e7704f94108c77337c13471466d79fe0e709e11a25bf89d7612b9bc7';

/* ── XSS-safe HTML escape ── */
function escHtml(s) {
  return String(s)
    .replace(/&/g, '&amp;')
    .replace(/</g, '&lt;')
    .replace(/>/g, '&gt;')
    .replace(/"/g, '&quot;')
    .replace(/'/g, '&#39;');
}

/* ── Tab switching ── */
function switchTab(id, el) {
  document.querySelectorAll('.cs-panel').forEach(p => p.classList.remove('active'));
  document.querySelectorAll('.cs-nav-item').forEach(n => n.classList.remove('active'));
  document.querySelectorAll('.cs-mobile-tab').forEach(t => t.classList.remove('active'));
  const panel   = document.getElementById('panel-'  + id);
  const navItem = document.getElementById('nav-'    + id);
  if (panel)   panel.classList.add('active');
  if (navItem) navItem.classList.add('active');
  const mobileBtn = el || document.getElementById('mobile-tab-' + id);
  if (mobileBtn) mobileBtn.classList.add('active');
}

/* ── Toggle SMS switch ── */
let _smsEnabled = false;
function updateBadgeByToggle(enabled) {
  const badge = document.getElementById('smsBadgeStatus');
  if (!badge) return;
  if (enabled) {
    badge.textContent = '✓ نشط';
    badge.className = 'mr-auto text-xs font-bold px-3 py-1 rounded-full bg-green-100 text-green-700';
  } else {
    badge.textContent = '✗ معطل';
    badge.className = 'mr-auto text-xs font-bold px-3 py-1 rounded-full bg-red-100 text-red-600';
  }
  badge.classList.remove('hidden');
}

let _uiLocked = false;
function toggleSms() {
  if (!SMS_ALLOWED_BY_CURRENCY) return;
  if (_uiLocked) return;
  _smsEnabled = !_smsEnabled;
  const track = document.getElementById('smsToggle');
  if (_smsEnabled) track.classList.add('on');
  else             track.classList.remove('on');
  updateBadgeByToggle(_smsEnabled);
}
function setSmsToggle(val) {
  _smsEnabled = !!val;
  const track = document.getElementById('smsToggle');
  if (_smsEnabled) track.classList.add('on');
  else             track.classList.remove('on');
}

/* ── Toggle Rounding ── */
let _roundingEnabled = false;
function toggleRounding() {
  _roundingEnabled = !_roundingEnabled;
  const track = document.getElementById('roundingToggle');
  if (_roundingEnabled) track.classList.add('on');
  else                  track.classList.remove('on');
}
function setRoundingToggle(val) {
  _roundingEnabled = !!val;
  const track = document.getElementById('roundingToggle');
  if (_roundingEnabled) track.classList.add('on');
  else                  track.classList.remove('on');
}

/* ── Load settings on page ready ── */
document.addEventListener('DOMContentLoaded', () => { 
  loadAll(); 
  loadBillingSettings(); 
  bindInputGuards();
  try {
    const lastTab = localStorage.getItem('client_settings_active_tab');
    if (lastTab && lastTab !== 'billing') {
      switchTab(lastTab);
    }
    // امسح القيمة فوراً حتى لا يظل محفوظاً للزيارات القادمة
    localStorage.removeItem('client_settings_active_tab');
  } catch (e) {}
});

/* ── Input Guards: تطهير الحقول من المدخلات الخطرة ── */
function bindInputGuards() {
  /* ① اسم المحل: لا يقبل < > & " وحدّ 100 حرف */
  const shopInp = document.getElementById('shopNameInp');
  if (shopInp) {
    const cleanShop = e => {
      let v = e.target.value.replace(/[<>"'&]/g, '').slice(0, 100);
      if (v !== e.target.value) e.target.value = v;
    };
    shopInp.addEventListener('input', cleanShop);
    shopInp.addEventListener('paste', ev => {
      ev.preventDefault();
      const pasted = (ev.clipboardData || window.clipboardData).getData('text');
      shopInp.value = pasted.replace(/[<>"'&]/g, '').slice(0, 100);
    });
    shopInp.addEventListener('drop', ev => {
      ev.preventDefault();
      const txt = ev.dataTransfer?.getData('text') || '';
      shopInp.value = txt.replace(/[<>"'&]/g, '').slice(0, 100);
    });
  }

  /* ② رقم الشكاوي: أرقام فقط + 0xx، حدّ 11 */
  const phoneInp  = document.getElementById('complaintPhoneInp');
  const phoneCtr  = document.getElementById('cphCtr');   // عداد
  const phoneMsg  = document.getElementById('cphMsg');   // رسالة
  const PHONE_RE  = /^01[0125][0-9]{8}$/;

  function updatePhoneCtr(val) {
    if (!phoneCtr) return;
    const len = val.length;
    phoneCtr.textContent = len + ' / 11';
    if (len === 0) {
      phoneCtr.style.color = '#9ca3af';
      if (phoneMsg) phoneMsg.textContent = '';
    } else if (len === 11 && PHONE_RE.test(val)) {
      phoneCtr.style.color = '#16a34a';
      if (phoneMsg) { phoneMsg.textContent = '✓ رقم صحيح'; phoneMsg.style.color = '#16a34a'; }
    } else if (len === 11) {
      phoneCtr.style.color = '#ef4444';
      if (phoneMsg) { phoneMsg.textContent = 'تنسيق غير صحيح (يبدأ بـ 010, 011, 012, 015)'; phoneMsg.style.color = '#ef4444'; }
    } else {
      phoneCtr.style.color = '#f59e0b';
      if (phoneMsg) { phoneMsg.textContent = 'متبقي ' + (11 - len) + ' أرقام'; phoneMsg.style.color = '#f59e0b'; }
    }
  }

  if (phoneInp) {
    const cleanPhone = e => {
      const digits = e.target.value.replace(/[^0-9]/g, '').slice(0, 11);
      e.target.value = digits;
      updatePhoneCtr(digits);
    };
    phoneInp.addEventListener('input', cleanPhone);
    phoneInp.addEventListener('paste', ev => {
      ev.preventDefault();
      const pasted = (ev.clipboardData || window.clipboardData).getData('text');
      const digits = pasted.replace(/[^0-9]/g, '').slice(0, 11);
      phoneInp.value = digits;
      updatePhoneCtr(digits);
    });
    phoneInp.addEventListener('drop', ev => {
      ev.preventDefault();
      const txt    = ev.dataTransfer?.getData('text') || '';
      const digits = txt.replace(/[^0-9]/g, '').slice(0, 11);
      phoneInp.value = digits;
      updatePhoneCtr(digits);
    });
  }
}

async function loadAll() {
  try {
    const [settRes, statRes, statusRes] = await Promise.all([
      fetch('api/sms-actions.php?action=get_settings',      { credentials: 'same-origin' }),
      fetch('api/sms-actions.php?action=get_monthly_stats', { credentials: 'same-origin' }),
      fetch('api/sms-actions.php?action=get_sms_status',    { credentials: 'same-origin' }),
    ]);
    const sett   = await settRes.json();
    const stats  = await statRes.json();
    const status = await statusRes.json();

    /* Shop name, complaint phone & toggle */
    const isClientEnabled = sett.success && sett.data && sett.data.is_enabled == 1;
    if (sett.success && sett.data) {
      document.getElementById('shopNameInp').value       = sett.data.shop_name       || '';
      document.getElementById('complaintPhoneInp').value = sett.data.complaint_phone || '';
      setSmsToggle(isClientEnabled);
    }

    /* Monthly stat */
    if (stats.success) {
      document.getElementById('statMonthly').textContent = stats.sent ?? 0;
    }

    /* ── UI Lock ── */
    const uiLocked   = !!(status && status.ui_locked);
    _uiLocked = uiLocked;
    const lockReason = (status && status.lock_reason) ? status.lock_reason : 'ميزة SMS غير متاحة في باقتك الحالية.';
    const override   = (status && status.override !== undefined) ? status.override : 0;

    const lockBanner   = document.getElementById('smsLockBanner');
    const lockReasonEl = document.getElementById('smsLockReason');
    const upgradeCard  = document.getElementById('smsUpgradeCard');
    const fieldsWrap   = document.getElementById('smsFieldsWrap');

    if (uiLocked) {
      lockBanner.classList.remove('hidden');
      lockReasonEl.textContent = lockReason;        // ← textContent (XSS-safe)
      fieldsWrap.classList.add('cs-fields-locked');
      const toggleEl = document.getElementById('smsToggle');
      if (toggleEl) toggleEl.onclick = null;
      const saveBtn = document.getElementById('saveBtn');
      if (saveBtn) saveBtn.disabled = true;
      const badge = document.getElementById('smsBadgeStatus');
      if (override === -1) {
        badge.textContent = '🔒 مقفول بواسطة الإدارة';
        badge.className   = 'mr-auto text-xs font-bold px-3 py-1 rounded-full bg-gray-200 text-gray-600';
        // عند القفل من الإدارة لا نظهر كارت الترقية
        upgradeCard.classList.add('hidden');
      } else {
        badge.textContent = '🔒 غير متاح في الباقة';
        badge.className   = 'mr-auto text-xs font-bold px-3 py-1 rounded-full bg-orange-100 text-orange-700';
        // عند القفل من الباقة نظهر كارت الترقية
        upgradeCard.classList.remove('hidden');
        // ربط زر الواتساب من استجابة get_sms_status
        const waNum = (status && status.whatsapp_support) ? String(status.whatsapp_support).trim() : '';
        if (waNum) {
          const cleanNum = waNum.replace(/[^0-9]/g, '');
          const waMsg = encodeURIComponent('مرحباً، أرغب في تفعيل ميزة فواتير SMS على حسابي.');
          const waLink = 'https://wa.me/' + cleanNum + '?text=' + waMsg;
          const btn = document.getElementById('smsUpgradeWhatsAppBtn');
          if (btn) btn.href = waLink;
        }
      }
      badge.classList.remove('hidden');
    } else if (!SMS_ALLOWED_BY_CURRENCY) {
      // ── قفل بسبب عملة غير مصرية ──────────────────────────────
      _uiLocked = true;
      lockBanner.classList.remove('hidden');
      if (lockReasonEl) lockReasonEl.textContent = 'ميزة SMS للفواتير متاحة فقط للعملاء الذين يستخدمون الجنيه المصري.';
      fieldsWrap.classList.add('cs-fields-locked');
      upgradeCard.classList.add('hidden');
      const toggleEl = document.getElementById('smsToggle');
      if (toggleEl) { toggleEl.classList.remove('on'); toggleEl.onclick = null; }
      const saveBtn = document.getElementById('saveBtn');
      if (saveBtn) saveBtn.disabled = true;
      const badge = document.getElementById('smsBadgeStatus');
      badge.textContent = '🌍 غير مفعلة في هذا البلد';
      badge.className   = 'mr-auto text-xs font-bold px-3 py-1 rounded-full bg-yellow-100 text-yellow-700';
      badge.classList.remove('hidden');
    } else {
      lockBanner.classList.add('hidden');
      upgradeCard.classList.add('hidden');
      fieldsWrap.classList.remove('cs-fields-locked');
      document.getElementById('smsToggle').onclick = toggleSms;
      document.getElementById('saveBtn').disabled = false;
      updateBadgeByToggle(isClientEnabled);
    }

    /* حالة الإرسال — XSS-safe بـ textContent بدل innerHTML */
    const allowedEl = document.getElementById('statAllowed');
    if (!SMS_ALLOWED_BY_CURRENCY) {
      // حالة الإرسال: مقفول بالعملة
      allowedEl.innerHTML = '';
      const ico = document.createElement('i');
      ico.className = 'fas fa-globe text-yellow-500';
      const sp  = document.createElement('span');
      sp.className   = 'text-yellow-600';
      sp.textContent = 'الميزة غير مفعلة في هذا البلد';
      allowedEl.appendChild(ico);
      allowedEl.appendChild(sp);
      document.getElementById('smsBlockedBanner').classList.add('hidden');
    } else if (status && status.allowed) {
      // آمن: نبني الـ DOM يدوياً
      allowedEl.innerHTML = '';
      const ico = document.createElement('i');
      ico.className = 'fas fa-check-circle text-green-500';
      const sp  = document.createElement('span');
      sp.className   = 'text-green-600';
      sp.textContent = 'الإرسال متاح';
      allowedEl.appendChild(ico);
      allowedEl.appendChild(sp);
      document.getElementById('smsBlockedBanner').classList.add('hidden');
    } else {
      const reason = (status && status.reason) ? status.reason : 'ميزة SMS غير متاحة حالياً.';
      allowedEl.innerHTML = '';
      const ico = document.createElement('i');
      ico.className = 'fas fa-times-circle text-red-400';
      const sp  = document.createElement('span');
      sp.className   = 'text-red-500';
      sp.textContent = reason;               // ← textContent (XSS-safe)
      allowedEl.appendChild(ico);
      allowedEl.appendChild(sp);
      if (!uiLocked && isClientEnabled) {
        document.getElementById('smsBlockedBanner').classList.remove('hidden');
        document.getElementById('smsBlockedTxt').textContent = reason;   // ← XSS-safe
      } else {
        document.getElementById('smsBlockedBanner').classList.add('hidden');
      }
    }
  } catch(e) {
    console.error('Settings load error:', e);
    showToast('خطأ في تحميل الإعدادات', 'error');
  }
}

/* ── Save ── */
let _saving = false; // منع الحفظ المتكرر
async function saveSettings() {
  if (!SMS_ALLOWED_BY_CURRENCY) { showToast('ميزة SMS غير مفعلة في هذا البلد', 'error'); return; }
  if (_uiLocked) { showToast('ميزة SMS غير متاحة في باقتك', 'error'); return; }
  if (_saving)   return;
  _saving = true;

  const btn = document.getElementById('saveBtn');
  btn.disabled = true;
  btn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> جاري الحفظ...';

  try {
    /* ── تطهير القيم قبل الإرسال ── */
    const shopRaw     = document.getElementById('shopNameInp').value.trim();
    const shopClean   = shopRaw.replace(/[<>"'&]/g, '').slice(0, 100);

    const phoneRaw    = document.getElementById('complaintPhoneInp').value.trim();
    const phoneClean  = phoneRaw.replace(/[^0-9]/g, '').slice(0, 11);

    // التحقق: رقم الشكاوي إما فارغ أو صحيح
    const PHONE_RE = /^01[0125][0-9]{8}$/;
    if (phoneClean.length > 0 && !PHONE_RE.test(phoneClean)) {
      showToast('رقم الشكاوي غير صحيح — يجب أن يبدأ بـ 010/011/012/015', 'error');
      btn.disabled  = false;
      btn.innerHTML = '<i class="fas fa-save"></i> حفظ الإعدادات';
      _saving = false;
      return;
    }

    const form = new FormData();
    form.append('_csrf',           __csrfToken);     // ① CSRF
    form.append('shop_name',       shopClean);
    form.append('complaint_phone', phoneClean);
    form.append('is_enabled',      _smsEnabled ? '1' : '0');

    const res  = await fetch('api/sms-actions.php?action=save_settings', {
      method: 'POST', body: form, credentials: 'same-origin'
    });
    if (!res.ok) throw new Error('HTTP ' + res.status);
    const data = await res.json();

    if (data.success) {
      showToast('تم حفظ الإعدادات بنجاح ✓', 'success');
      btn.innerHTML = '<i class="fas fa-check"></i> تم الحفظ!';
      setTimeout(() => {
        btn.disabled = false;
        btn.innerHTML = '<i class="fas fa-save"></i> حفظ الإعدادات';
        _saving = false;
        loadAll();
      }, 1600);
    } else {
      showToast(data.message || 'فشل الحفظ', 'error');
      btn.disabled  = false;
      btn.innerHTML = '<i class="fas fa-save"></i> حفظ الإعدادات';
      _saving = false;
    }
  } catch(e) {
    showToast('خطأ في الاتصال: ' + e.message, 'error');
    btn.disabled  = false;
    btn.innerHTML = '<i class="fas fa-save"></i> حفظ الإعدادات';
    _saving = false;
  }
}

/* ── Dark Mode Toggle ── */
async function toggleDarkMode() {
  const body = document.body;
  const icon = document.getElementById('dark-mode-icon');
  body.classList.toggle('dark-mode');
  const isDark = body.classList.contains('dark-mode');
  if (icon) icon.className = isDark ? 'fas fa-sun' : 'fas fa-moon';
  localStorage.setItem('darkMode', isDark);
  try {
    await fetch('api/user-preferences.php', {
      method: 'POST',
      headers: { 'Content-Type': 'application/json' },
      credentials: 'same-origin',
      body: JSON.stringify({ dark_mode: isDark })
    });
  } catch(e) { /* silent */ }
}

/* ── Toast ── */
let _toastTimer = null;
function showToast(msg, type = 'success') {
  const t   = document.getElementById('csToast');
  const ico = document.getElementById('csToastIco');
  const txt = document.getElementById('csToastMsg');
  txt.textContent = msg;
  t.className = t.className
    .replace(/bg-\S+/g, '')
    .replace('opacity-0 pointer-events-none', '');
  if (type === 'success') {
    t.classList.add('bg-green-600');
    ico.className = 'fas fa-check-circle text-lg';
  } else {
    t.classList.add('bg-red-500');
    ico.className = 'fas fa-exclamation-circle text-lg';
  }
  t.classList.remove('opacity-0', 'pointer-events-none');
  t.classList.add('opacity-100');
  clearTimeout(_toastTimer);
  _toastTimer = setTimeout(() => {
    t.classList.add('opacity-0', 'pointer-events-none');
    t.classList.remove('opacity-100');
  }, 3200);
}

/* ── Load Billing Settings ── */
async function loadBillingSettings() {
  try {
    const res = await fetch('api/billing-settings.php?action=get', { credentials: 'same-origin' });
    const data = await res.json();
    if (data.success) {
      setRoundingToggle(data.round_to_nearest_5 == 1);
    }
  } catch(e) {
    console.error('Failed to load billing settings:', e);
  }
}

/* ── Save Billing Settings ── */
let _savingBilling = false;
async function saveBillingSettings() {
  if (_savingBilling) return;
  _savingBilling = true;

  const btn = document.getElementById('saveBillingBtn');
  btn.disabled = true;
  btn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> جاري الحفظ...';

  try {
    const form = new FormData();
    form.append('_csrf', __csrfToken);
    form.append('action', 'save');
    form.append('round_to_nearest_5', _roundingEnabled ? '1' : '0');

    const res = await fetch('api/billing-settings.php', {
      method: 'POST',
      body: form,
      credentials: 'same-origin'
    });

    if (!res.ok) throw new Error('HTTP ' + res.status);
    const data = await res.json();

    if (data.success) {
      showToast('تم حفظ الإعدادات بنجاح', 'success');
    } else {
      showToast(data.message || 'فشل الحفظ', 'error');
    }
  } catch(e) {
    console.error('Save billing error:', e);
    showToast('خطأ في الحفظ', 'error');
  } finally {
    btn.disabled = false;
    btn.innerHTML = '<i class="fas fa-save"></i> حفظ الإعدادات';
    _savingBilling = false;
  }
}
/* ══════════════════════════════════════════════
   Email Reports Section
   ══════════════════════════════════════════════ */
let _emailReportsActive = false;
let _emailReportsSaving = false;

async function loadEmailReportsStatus() {
  try {
    const res  = await fetch('api/email-report-actions.php?action=get_status', {credentials:'same-origin'});
    const data = await res.json();
    if (!data.success) return;

    const upgradeCard  = document.getElementById('emailReportsUpgradeCard');
    const lockBanner   = document.getElementById('emailReportsLockBanner');
    const fieldsWrap   = document.getElementById('emailReportsFieldsWrap');
    const lockReason   = document.getElementById('emailReportsLockReason');
    const upgradeBtn   = document.getElementById('emailReportsUpgradeBtn');

    // إعداد رابط الواتساب للترقية
    if (upgradeBtn && data.whatsapp_support) {
      const cleanNum = data.whatsapp_support.replace(/\D/g, '');
      const waMsg = encodeURIComponent('مرحباً، أرغب في تفعيل ميزة التقارير البريدية على حسابي.');
      const waLink = 'https://wa.me/' + cleanNum + '?text=' + waMsg;
      upgradeBtn.href = waLink;
    }

    // إذا الباقة لا تدعم الميزة → عرض بطاقة الترقية
    if (!data.plan_ok) {
      if (upgradeCard) upgradeCard.classList.remove('hidden');
      if (lockBanner)  lockBanner.classList.add('hidden');
      if (fieldsWrap)  fieldsWrap.classList.add('cs-fields-locked');
      return;
    }

    if (upgradeCard) upgradeCard.classList.add('hidden');

    // إذا النظام أوقف الميزة → عرض banner القفل
    if (!data.system_enabled) {
      if (lockBanner) lockBanner.classList.remove('hidden');
      if (lockReason) lockReason.textContent = data.lock_reason || 'الميزة غير متاحة حالياً';
      if (fieldsWrap) fieldsWrap.classList.add('cs-fields-locked');
      return;
    }

    if (lockBanner) lockBanner.classList.add('hidden');
    if (fieldsWrap) fieldsWrap.classList.remove('cs-fields-locked');

    // تحميل الخيارات المتاحة ديناميكياً
    await loadAvailableFrequencies();

    // تعبئة البيانات الحالية
    const s = data.setting;
    if (s) {
      _emailReportsActive = s.is_active == 1;
      const toggle = document.getElementById('emailReportsToggle');
      if (toggle) {
        toggle.classList.toggle('on-blue', _emailReportsActive);
      }
      const emailInp = document.getElementById('reportEmailInp');
      if (emailInp) emailInp.value = s.email || '';

      const freq = s.frequency || 'monthly';
      selectFrequency(freq, false); // تحديث الـ UI بدون trigger event
    } else {
      // افتراضي: شهري
      selectFrequency('monthly', false);
    }

  } catch(e) { console.error('loadEmailReportsStatus error:', e); }
}

async function loadAvailableFrequencies() {
  try {
    const res = await fetch('api/email-report-actions.php?action=get_available_frequencies', {credentials:'same-origin'});
    const data = await res.json();
    if (!data.success) return;

    const freqContainer = document.getElementById('frequencyOptionsContainer');
    if (!freqContainer) return;

    const opts = data.options || {};
    const weeklyDay = data.weekly_day || '1';
    const monthlyDay = data.monthly_day || '1';

    // أسماء الأيام
    const dayNames = {
      '1': 'الإثنين', '2': 'الثلاثاء', '3': 'الأربعاء', '4': 'الخميس',
      '5': 'الجمعة', '6': 'السبت', '7': 'الأحد'
    };

    let html = '';

    // يومي
    if (opts.daily) {
      html += `
        <label id="freqDailyCard" class="flex items-center gap-3 p-3 border-2 rounded-lg cursor-pointer transition hover:border-green-400" style="border-color:#e5e7eb" onclick="selectFrequency('daily')">
          <input type="radio" name="reportFrequency" value="daily" id="freqDaily" class="hidden">
          <span class="w-8 h-8 rounded-lg flex items-center justify-center text-white text-sm flex-shrink-0" style="background:linear-gradient(135deg,#10b981,#059669)">
            <i class="fas fa-calendar-day"></i>
          </span>
          <div>
            <p class="text-sm font-semibold text-gray-800">يومي</p>
            <p class="text-xs text-gray-400">كل يوم</p>
          </div>
        </label>
      `;
    }

    // أسبوعي
    if (opts.weekly) {
      html += `
        <label id="freqWeeklyCard" class="flex items-center gap-3 p-3 border-2 rounded-lg cursor-pointer transition hover:border-purple-400" style="border-color:#e5e7eb" onclick="selectFrequency('weekly')">
          <input type="radio" name="reportFrequency" value="weekly" id="freqWeekly" class="hidden">
          <span class="w-8 h-8 rounded-lg flex items-center justify-center text-white text-sm flex-shrink-0" style="background:linear-gradient(135deg,#8b5cf6,#6d28d9)">
            <i class="fas fa-calendar-week"></i>
          </span>
          <div>
            <p class="text-sm font-semibold text-gray-800">أسبوعي</p>
            <p class="text-xs text-gray-400">كل ${dayNames[weeklyDay] || 'إثنين'}</p>
          </div>
        </label>
      `;
    }

    // شهري
    if (opts.monthly) {
      const dayLabel = monthlyDay === '1' ? 'أول الشهر' : `يوم ${monthlyDay} من الشهر`;
      html += `
        <label id="freqMonthlyCard" class="flex items-center gap-3 p-3 border-2 rounded-lg cursor-pointer transition hover:border-blue-400" style="border-color:#e5e7eb" onclick="selectFrequency('monthly')">
          <input type="radio" name="reportFrequency" value="monthly" id="freqMonthly" class="hidden">
          <span class="w-8 h-8 rounded-lg flex items-center justify-center text-white text-sm flex-shrink-0" style="background:linear-gradient(135deg,#3b82f6,#1d4ed8)">
            <i class="fas fa-calendar-alt"></i>
          </span>
          <div>
            <p class="text-sm font-semibold text-gray-800">شهري</p>
            <p class="text-xs text-gray-400">${dayLabel}</p>
          </div>
        </label>
      `;
    }

    freqContainer.innerHTML = html;

  } catch(e) { console.error('loadAvailableFrequencies error:', e); }
}

function toggleEmailReports() {
  _emailReportsActive = !_emailReportsActive;
  const toggle = document.getElementById('emailReportsToggle');
  if (toggle) toggle.classList.toggle('on-blue', _emailReportsActive);
}

function selectFrequency(freq, updateRadio = true) {
  const dailyCard   = document.getElementById('freqDailyCard');
  const weeklyCard  = document.getElementById('freqWeeklyCard');
  const monthlyCard = document.getElementById('freqMonthlyCard');
  const dailyRadio  = document.getElementById('freqDaily');
  const weeklyRadio = document.getElementById('freqWeekly');
  const monthlyRadio = document.getElementById('freqMonthly');

  // إزالة التنشيط من الكل
  [dailyCard, weeklyCard, monthlyCard].forEach(card => {
    if (card) {
      card.style.borderColor = '#e5e7eb';
      card.style.background = 'transparent';
    }
  });

  // تنشيط المختار
  if (freq === 'daily' && dailyCard) {
    dailyCard.style.borderColor = '#10b981';
    dailyCard.style.background = 'rgba(16,185,129,0.05)';
    if (updateRadio && dailyRadio) dailyRadio.checked = true;
  } else if (freq === 'weekly' && weeklyCard) {
    weeklyCard.style.borderColor = '#8b5cf6';
    weeklyCard.style.background = 'rgba(139,92,246,0.05)';
    if (updateRadio && weeklyRadio) weeklyRadio.checked = true;
  } else if (monthlyCard) {
    monthlyCard.style.borderColor = '#3b82f6';
    monthlyCard.style.background = 'rgba(59,130,246,0.05)';
    if (updateRadio && monthlyRadio) monthlyRadio.checked = true;
  }
}

async function saveEmailReportsSettings() {
  if (_emailReportsSaving) return;
  _emailReportsSaving = true;

  const btn = document.getElementById('saveEmailReportsBtn');
  if (btn) { btn.disabled = true; btn.innerHTML = '<i class="fas fa-spinner fa-spin mr-1"></i> جاري الحفظ...'; }

  const email = (document.getElementById('reportEmailInp')?.value || '').trim();
  const freqEl = document.querySelector('input[name="reportFrequency"]:checked');
  const frequency = freqEl ? freqEl.value : 'monthly';

  try {
    const res  = await fetch('api/email-report-actions.php?action=save_settings', {
      method: 'POST',
      headers: { 'Content-Type': 'application/json' },
      credentials: 'same-origin',
      body: JSON.stringify({ email, frequency, is_active: _emailReportsActive ? 1 : 0 })
    });
    const data = await res.json();
    if (data.success) {
      showToast('تم حفظ إعدادات التقارير بنجاح ✓', 'success');
      if (btn) {
        btn.innerHTML = '<i class="fas fa-check mr-1"></i> تم الحفظ!';
        setTimeout(() => {
          if (btn) btn.innerHTML = '<i class="fas fa-save mr-1"></i> حفظ إعدادات التقارير';
        }, 1500);
      }
    } else {
      showToast(data.message || 'فشل الحفظ', 'error');
    }
  } catch(e) {
    showToast('خطأ في الاتصال', 'error');
    console.error('saveEmailReportsSettings error:', e);
  } finally {
    _emailReportsSaving = false;
    if (btn) btn.disabled = false;
  }
}

// تحميل تلقائي عند فتح التاب
document.addEventListener('DOMContentLoaded', function() {
  const navBtn = document.getElementById('nav-email-reports');
  if (navBtn) navBtn.addEventListener('click', () => setTimeout(loadEmailReportsStatus, 100));
  
  const mobileBtn = Array.from(document.querySelectorAll('.cs-mobile-tab')).find(b => b.textContent.includes('التقارير'));
  if (mobileBtn) mobileBtn.addEventListener('click', () => setTimeout(loadEmailReportsStatus, 100));
});

// ══════════════════════════════════════════════════
// Currency Settings (modern dropdown)
// ══════════════════════════════════════════════════

let currentCurrency = null;
let availableCurrencies = {};
let selectedCurrencyCode = null;

function closeCurrencyDropdown() {
  const list = document.getElementById('currencyDropdownList');
  if (list) list.classList.add('hidden');
}

function openCurrencyDropdown() {
  const list = document.getElementById('currencyDropdownList');
  if (list) list.classList.remove('hidden');
}

function toggleCurrencyDropdown() {
  const list = document.getElementById('currencyDropdownList');
  if (!list) return;
  list.classList.toggle('hidden');
}

async function loadCurrencySettings() {
  try {
    const res = await fetch('api/currency-settings.php?action=get_currency', {
      credentials: 'same-origin'
    });
    const data = await res.json();
    
    if (!data.success) return;

    currentCurrency = data.currency;
    availableCurrencies = data.available_currencies || {};
    selectedCurrencyCode = currentCurrency?.code || null;

    const dropdown = document.getElementById('currencyDropdown');
    const button = document.getElementById('currencyDropdownButton');
    const labelEl = document.getElementById('currencyDropdownLabel');
    const symbolEl = document.getElementById('currencyDropdownSymbol');
    const list = document.getElementById('currencyDropdownList');

    if (!dropdown || !button || !labelEl || !symbolEl || !list) return;

    // ملء القائمة المنسدلة
    list.innerHTML = '';
    Object.values(availableCurrencies).forEach(curr => {
      const optionBtn = document.createElement('button');
      optionBtn.type = 'button';
      optionBtn.className =
        'w-full flex items-center justify-between px-4 py-2.5 text-sm text-slate-100 hover:bg-emerald-500/10 hover:text-emerald-300 transition border-b border-slate-800/40 last:border-b-0';
      optionBtn.dataset.code = curr.code;
      optionBtn.innerHTML = `
        <span class="flex flex-col text-right">
          <span class="font-semibold">${curr.name}</span>
          <span class="text-[11px] text-slate-400">${curr.symbol}</span>
        </span>
        <span class="text-emerald-400 text-sm font-semibold">${curr.symbol}</span>
      `;

      optionBtn.addEventListener('click', () => {
        selectedCurrencyCode = curr.code;
        labelEl.textContent = `${curr.name} (${curr.symbol})`;
        symbolEl.textContent = curr.symbol;
        updateCurrencyPreview();
        closeCurrencyDropdown();
      });

      list.appendChild(optionBtn);
    });

    // ضبط القيمة الحالية
    if (selectedCurrencyCode && availableCurrencies[selectedCurrencyCode]) {
      const curr = availableCurrencies[selectedCurrencyCode];
      labelEl.textContent = `${curr.name} (${curr.symbol})`;
      symbolEl.textContent = curr.symbol;
    } else {
      labelEl.textContent = 'اختر العملة';
      symbolEl.textContent = '';
    }

    // ربط زر الفتح/الإغلاق
    button.addEventListener('click', (e) => {
      e.stopPropagation();
      toggleCurrencyDropdown();
    });

    // إغلاق عند الضغط خارج القائمة
    document.addEventListener('click', (e) => {
      if (!dropdown.contains(e.target)) {
        closeCurrencyDropdown();
      }
    });

    // تحديث المعاينة
    updateCurrencyPreview();
  } catch (e) {
    console.error('خطأ في تحميل إعدادات العملة:', e);
  }
}

function updateCurrencyPreview() {
  const preview = document.getElementById('currencyPreview');
  if (!preview) return;

  const code = selectedCurrencyCode;
  const curr = availableCurrencies[code];
  
  if (curr) {
    preview.textContent = `50 ${curr.symbol}`;
  }
}

async function saveCurrencySettings() {
  const btn = document.getElementById('saveCurrencyBtn');
  const code = selectedCurrencyCode;
  
  if (!code) {
    showToast('اختر العملة أولاً', 'error');
    return;
  }
  
  btn.disabled = true;
  btn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> جاري الحفظ...';
  
  try {
    const res = await fetch('api/currency-settings.php?action=save_currency', {
      method: 'POST',
      headers: { 'Content-Type': 'application/json' },
      credentials: 'same-origin',
      body: JSON.stringify({ currency: code })
    });
    const data = await res.json();
    
    if (data.success) {
      currentCurrency = data.currency;
      showToast('تم حفظ العملة بنجاح! ستظهر التغييرات في جميع الصفحات', 'success');
      
      // إبقاء المستخدم في تبويب العملة بعد إعادة التحميل
      try {
        localStorage.setItem('client_settings_active_tab', 'currency');
      } catch (e) {}
      setTimeout(() => window.location.reload(), 1500);
    } else {
      showToast(data.message || 'فشل الحفظ', 'error');
    }
  } catch (e) {
    showToast('خطأ في الاتصال', 'error');
    console.error(e);
  } finally {
    btn.disabled = false;
    btn.innerHTML = '<i class="fas fa-save"></i> حفظ العملة';
  }
}

// تحميل عند فتح التاب
document.addEventListener('DOMContentLoaded', function() {
  const navBtn = document.getElementById('nav-currency');
  if (navBtn) navBtn.addEventListener('click', () => setTimeout(loadCurrencySettings, 100));
  
  const mobileBtn = Array.from(document.querySelectorAll('.cs-mobile-tab')).find(b => b.textContent.includes('العملة'));
  if (mobileBtn) mobileBtn.addEventListener('click', () => setTimeout(loadCurrencySettings, 100));

  // تحميل إعدادات الخصومات عند فتح التاب
  const discountNavBtn = document.getElementById('nav-discounts');
  if (discountNavBtn) discountNavBtn.addEventListener('click', () => setTimeout(loadDiscountSettings, 100));

  // تحميل تلقائي إذا كان التاب نشطاً عند الفتح
  loadDiscountSettings();
});

/* ══════════════════════════════════════════════
   Discount Settings Section
   ══════════════════════════════════════════════ */
let _discountEnabled = false;
let _discountType    = 'percentage';
let _discountScope   = 'both';
let _savingDiscount  = false;

function toggleDiscountEnabled() {
  _discountEnabled = !_discountEnabled;
  const track = document.getElementById('discountEnabledToggle');
  if (_discountEnabled) {
    track.classList.add('on-purple');
    document.getElementById('discountOptionsPanel').style.display = 'block';
  } else {
    track.classList.remove('on-purple');
    document.getElementById('discountOptionsPanel').style.display = 'none';
  }
}

function setDiscountEnabledUI(val) {
  _discountEnabled = !!val;
  const track = document.getElementById('discountEnabledToggle');
  if (_discountEnabled) {
    track.classList.add('on-purple');
    document.getElementById('discountOptionsPanel').style.display = 'block';
  } else {
    track.classList.remove('on-purple');
    document.getElementById('discountOptionsPanel').style.display = 'none';
  }
}

function selectDiscountType(type) {
  _discountType = type;
  document.querySelector(`input[name="discount_type_radio"][value="${type}"]`).checked = true;
}

function selectDiscountScope(scope) {
  _discountScope = scope;
  document.querySelector(`input[name="discount_scope_radio"][value="${scope}"]`).checked = true;
}

async function loadDiscountSettings() {
  try {
    const res  = await fetch('api/discount-settings.php?action=get', { credentials: 'same-origin' });
    const data = await res.json();
    if (!data.success) return;

    setDiscountEnabledUI(data.discount_enabled == 1);
    selectDiscountType(data.discount_type  || 'percentage');
    selectDiscountScope(data.discount_scope || 'both');
  } catch(e) {
    console.error('Failed to load discount settings:', e);
  }
}

async function saveDiscountSettings() {
  if (_savingDiscount) return;
  _savingDiscount = true;

  const btn = document.getElementById('saveDiscountBtn');
  btn.disabled = true;
  btn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> جاري الحفظ...';

  try {
    const form = new FormData();
    form.append('_csrf',             __csrfToken);
    form.append('action',            'save');
    form.append('discount_enabled',  _discountEnabled ? '1' : '0');
    form.append('discount_type',     _discountType);
    form.append('discount_scope',    _discountScope);

    const res = await fetch('api/discount-settings.php', {
      method: 'POST', body: form, credentials: 'same-origin'
    });
    if (!res.ok) throw new Error('HTTP ' + res.status);
    const data = await res.json();

    if (data.success) {
      showToast('تم حفظ إعدادات الخصم بنجاح', 'success');
    } else {
      showToast(data.message || 'فشل الحفظ', 'error');
    }
  } catch(e) {
    console.error('Save discount error:', e);
    showToast('خطأ في الحفظ', 'error');
  } finally {
    btn.disabled = false;
    btn.innerHTML = '<i class="fas fa-save"></i> حفظ إعدادات الخصم';
    _savingDiscount = false;
  }
}
</script>
</html>

