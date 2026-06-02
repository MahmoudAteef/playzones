
<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description"
    content="the seystem good live ">
  <meta name="author"
    content="ENG.HOSSAM">
  <title>إدارة الطلبات - Play Zone</title>
  <script>const CURRENCY_SYMBOL = 'جنيه';</script>
  <script>
    (function() {
      try {
        var ls = window.localStorage;
        var val = ls ? ls.getItem('darkMode') : null;
        var shouldBeDark = (val === null) ? true : (val === 'true');
        if (shouldBeDark) {
          document.documentElement.style.backgroundColor = '#1a1a2e';
        }
        var applyToBody = function() {
          if (shouldBeDark) {
            document.body.classList.add('dark-mode');
          } else {
            document.body.classList.remove('dark-mode');
          }
        };
        if (document.body) {
          applyToBody();
        } else {
          document.addEventListener('DOMContentLoaded', applyToBody);
        }
      } catch (e) {
        document.documentElement.style.backgroundColor = '#1a1a2e';
        var fallback = function() {
          document.body.classList.add('dark-mode');
        };
        if (document.body) {
          fallback();
        } else {
          document.addEventListener('DOMContentLoaded', fallback);
        }
      }
    })();
  </script>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <style>
    /* تصغير الحجم للشاشات الكبيرة فقط */
    @media (min-width: 1024px) {
      html { font-size: 90%; }
    }
    @keyframes fadeIn {
      from {
        opacity: 0;
        transform: translateY(-10px);
      }

      to {
        opacity: 1;
        transform: translateY(0);
      }
    }

    @keyframes slideUp {
      from {
        opacity: 0;
        transform: translateY(20px);
      }

      to {
        opacity: 1;
        transform: translateY(0);
      }
    }

    @keyframes pulse {

      0%,
      100% {
        transform: scale(1);
      }

      50% {
        transform: scale(1.05);
      }
    }

    @keyframes successPop {
      0% {
        opacity: 0;
        transform: translate(-50%, -50%) scale(0.5);
      }

      50% {
        transform: translate(-50%, -50%) scale(1.1);
      }

      100% {
        opacity: 1;
        transform: translate(-50%, -50%) scale(1);
      }
    }

    @keyframes scaleIn {
      from {
        opacity: 0;
        transform: scale(0.9);
      }

      to {
        opacity: 1;
        transform: scale(1);
      }
    }

    .animate-scaleIn {
      animation: scaleIn 0.3s ease-out;
    }

    .fade-in {
      animation: fadeIn 0.3s ease-out;
    }

    .slide-up {
      animation: slideUp 0.4s ease-out;
    }

    /* Header Wrapper */
    .header-wrapper {
      width: 96%;
      margin: 0 auto;
      padding: 12px 0;
      box-sizing: border-box;
    }

    /* Container - same width as header */
    .page-wrapper {
      width: 96%;
      margin: 0 auto;
      padding: 0 0 20px;
      box-sizing: border-box;
    }

    body {
      background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
      min-height: 100vh;
      transition: background 0.3s ease;
    }

    body.dark-mode {
      background: linear-gradient(135deg, #1a1a2e 0%, #16213e 100%);
    }

    /* Header Styles */
    .header {
      background: rgba(255, 255, 255, 0.95);
      backdrop-filter: blur(10px);
      border-radius: 12px;
      padding: 12px 25px;
      margin-bottom: 0;
      box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
      display: flex;
      justify-content: space-between;
      align-items: center;
      flex-wrap: wrap;
      gap: 15px;
      width: 100%;
      box-sizing: border-box;
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
      display: flex;
      align-items: center;
      gap: 10px;
    }

    .logo:hover {
      transform: scale(1.05);
    }

    .header-actions {
      display: flex;
      align-items: center;
      gap: 12px;
      flex-wrap: wrap;
    }

    .back-btn {
      background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
      color: white;
      border: none;
      padding: 10px 20px;
      border-radius: 10px;
      cursor: pointer;
      display: flex;
      align-items: center;
      gap: 8px;
      font-weight: 600;
      transition: all 0.3s ease;
      box-shadow: 0 2px 8px rgba(102, 126, 234, 0.3);
    }

    .back-btn:hover {
      transform: translateY(-2px);
      box-shadow: 0 4px 12px rgba(102, 126, 234, 0.4);
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
      box-shadow: 0 2px 8px rgba(102, 126, 234, 0.3);
    }

    .dark-mode-toggle:hover {
      transform: translateY(-2px) rotate(15deg);
      box-shadow: 0 4px 12px rgba(102, 126, 234, 0.4);
    }

    .user-menu {
      position: relative;
    }

    .user-btn {
      background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
      color: white;
      border: none;
      padding: 10px 20px;
      border-radius: 10px;
      cursor: pointer;
      display: flex;
      align-items: center;
      gap: 8px;
      font-weight: 600;
      transition: all 0.3s ease;
      box-shadow: 0 2px 8px rgba(245, 158, 11, 0.3);
    }

    .user-btn:hover {
      transform: translateY(-2px);
      box-shadow: 0 4px 12px rgba(245, 158, 11, 0.4);
    }

    /* Custom Select with visible dropdown arrow */
    select {
      appearance: none;
      -webkit-appearance: none;
      -moz-appearance: none;
      background-image: url("data:image/svg+xml;charset=UTF-8,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3e%3cpolyline points='6 9 12 15 18 9'%3e%3c/polyline%3e%3c/svg%3e");
      background-repeat: no-repeat;
      background-position: left 0.75rem center;
      background-size: 1.25em 1.25em;
      padding-left: 2.5rem;
    }

    body.dark-mode select {
      background-image: url("data:image/svg+xml;charset=UTF-8,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='none' stroke='rgba(255,255,255,0.7)' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3e%3cpolyline points='6 9 12 15 18 9'%3e%3c/polyline%3e%3c/svg%3e");
    }

    /* Custom Dropdown Styles */
    [id$="Menu"] {
      z-index: 100 !important;
      position: absolute !important;
      box-shadow: 0 10px 40px rgba(0, 0, 0, 0.5) !important;
      max-height: 15rem !important;
      overflow-y: auto !important;
    }

    /* Cafe Dropdown - Higher z-index for mobile to prevent overlap */
    #cafeDropdownMenu {
      z-index: 10000 !important;
    }

    /* Increase z-index of cafe section when dropdown is open on mobile */
    @media (max-width: 1023px) {
      #cafeDropdown.open~* {
        position: relative;
      }

      .cafe-section-dropdown-open {
        z-index: 50 !important;
        position: relative;
      }
    }

    /* Custom Dropdown Scrollbar */
    [id$="Menu"]::-webkit-scrollbar {
      width: 6px;
    }

    [id$="Menu"]::-webkit-scrollbar-track {
      background: rgba(0, 0, 0, 0.2);
      border-radius: 10px;
    }

    [id$="Menu"]::-webkit-scrollbar-thumb {
      background: rgba(100, 116, 139, 0.5);
      border-radius: 10px;
    }

    [id$="Menu"]::-webkit-scrollbar-thumb:hover {
      background: rgba(100, 116, 139, 0.8);
    }

    /* Search Box Styles */
    .search-box {
      position: relative;
      margin-bottom: 20px;
    }

    .search-input {
      width: 100%;
      padding: 12px 45px 12px 16px;
      background: rgba(255, 255, 255, 0.1);
      border: 1px solid rgba(255, 255, 255, 0.2);
      border-radius: 12px;
      color: white;
      font-size: 14px;
      transition: all 0.3s ease;
    }

    .search-input:focus {
      outline: none;
      background: rgba(255, 255, 255, 0.15);
      border-color: #667eea;
      box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
    }

    .search-input::placeholder {
      color: rgba(255, 255, 255, 0.5);
    }

    body.dark-mode .search-input {
      background: rgba(0, 0, 0, 0.3);
      border-color: rgba(255, 255, 255, 0.1);
      color: #f1f5f9;
    }

    body.dark-mode .search-input:focus {
      background: rgba(0, 0, 0, 0.4);
      border-color: #667eea;
    }

    .search-icon {
      position: absolute;
      left: 15px;
      top: 50%;
      transform: translateY(-50%);
      color: rgba(255, 255, 255, 0.5);
      pointer-events: none;
    }

    body.dark-mode .search-icon {
      color: rgba(255, 255, 255, 0.4);
    }

    /* No results message */
    .no-results-message {
      grid-column: 1 / -1;
      text-align: center;
      padding: 40px 20px;
      animation: fadeIn 0.3s ease-out;
    }

    .no-results-message i {
      display: block;
      margin-bottom: 15px;
      font-size: 3rem;
      color: rgba(255, 255, 255, 0.2);
    }

    .no-results-message p {
      color: rgba(255, 255, 255, 0.6);
      font-size: 1rem;
    }

    body.dark-mode .no-results-message i {
      color: rgba(255, 255, 255, 0.15);
    }

    body.dark-mode .no-results-message p {
      color: rgba(255, 255, 255, 0.5);
    }

    /* Dark Mode Content Styles */
    body.dark-mode .bg-white\/10 {
      background: rgba(0, 0, 0, 0.3) !important;
    }

    body.dark-mode .border-white\/20 {
      border-color: rgba(255, 255, 255, 0.1) !important;
    }

    body.dark-mode .bg-white\/5 {
      background: rgba(0, 0, 0, 0.2) !important;
    }

    body.dark-mode select,
    body.dark-mode input {
      background: rgba(0, 0, 0, 0.3) !important;
      border-color: rgba(255, 255, 255, 0.2) !important;
    }

    body.dark-mode .text-white {
      color: #f1f5f9;
    }

    body.dark-mode .bg-emerald-400 {
      color: #10b981 !important;
    }

    /* Responsive */
    @media (max-width: 768px) {
      .header {
        padding: 12px 15px;
      }

      .logo {
        font-size: 1.5rem;
      }

      .back-btn span {
        display: none;
      }

      .back-btn {
        padding: 10px;
        width: 40px;
        height: 40px;
        justify-content: center;
      }

      .user-btn span {
        display: none;
      }
    }


    /* Custom scrollbar */
    ::-webkit-scrollbar {
      width: 8px;
      height: 8px;
    }

    ::-webkit-scrollbar-track {
      background: rgba(255, 255, 255, 0.1);
    }

    ::-webkit-scrollbar-thumb {
      background: rgba(255, 255, 255, 0.3);
      border-radius: 4px;
    }

    ::-webkit-scrollbar-thumb:hover {
      background: rgba(255, 255, 255, 0.5);
    }

    body.light-mode ::-webkit-scrollbar-track {
      background: rgba(0, 0, 0, 0.05);
    }

    body.light-mode ::-webkit-scrollbar-thumb {
      background: rgba(0, 0, 0, 0.2);
    }

    body.light-mode ::-webkit-scrollbar-thumb:hover {
      background: rgba(0, 0, 0, 0.3);
    }

    /* Success notification */
    .success-notification {
      position: fixed;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
      z-index: 9999;
      animation: successPop 0.4s ease-out;
    }

    /* Mobile optimizations */
    @media (max-width: 640px) {
      .mobile-stack {
        flex-direction: column;
      }

      .mobile-full {
        width: 100% !important;
      }

      .mobile-text-sm {
        font-size: 0.875rem;
      }
    }

    /* Very small screens (350px) */
    @media (max-width: 400px) {
      body {
        font-size: 14px;
      }

      .page-wrapper {
        padding-left: 12px !important;
        padding-right: 12px !important;
      }

      h1 {
        font-size: 1.5rem !important;
      }

      h2,
      h3 {
        font-size: 1.25rem !important;
      }

      .btn {
        padding: 8px 12px !important;
        font-size: 13px !important;
      }
    }
  </style>
</head>

<body class="dark-mode">
  
  <!-- Header - full width, outside container -->
  <div class="header-wrapper">
    <div class="header fade-in">
      <div class="logo" onclick="window.location.href='dashboard.php'">
        <i class="fas fa-utensils"></i>
        Play Zone      </div>

      <div class="header-actions">
        <!-- Back Button (Desktop Only) -->
        <button class="back-btn" onclick="window.location.href='dashboard.php'"
          title="العودة للصفحة الرئيسية">
          <i class="fas fa-arrow-right"></i>
          <span>الصفحة الرئيسية</span>
        </button>

        <!-- Dark Mode Toggle -->
        <button class="dark-mode-toggle" onclick="toggleDarkMode()"
          title="تبديل الوضع الداكن/الساطع">
          <i id="dark-mode-icon"
            class="fas fa-sun"></i>
        </button>

        <!-- User Menu -->
        <div class="user-menu">
          <button class="user-btn" onclick="attemptLogout()">
            <i class="fas fa-user"></i>
            <span>admin_mahmoud_atef</span>
            <i class="fas fa-sign-out-alt"></i>
          </button>
        </div>
      </div>
    </div>
  </div><!-- /header-wrapper -->

  <!-- Content Container -->
  <div class="page-wrapper">
    <div class="py-4 sm:py-6">
      <!-- Page Title -->
      <div class="text-center mb-6 sm:mb-8 fade-in">
        <h2 class="text-3xl sm:text-4xl font-bold text-white mb-2">
          <i class="fas fa-shopping-cart ml-2"></i>
          إدارة الطلبات
        </h2>
        <p class="text-white/80 text-sm sm:text-base">إضافة وإدارة طلبات الطعام
          والمشروبات للجلسات النشطة</p>
      </div>

      <!-- Low Stock Alert Cards -->
              <div id="lowStockAlertsContainer"
          class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6"
          style="display: none;">
          <!-- Low Stock Foods Card -->
          <div
            class="bg-gradient-to-br from-red-500 to-red-600 rounded-2xl shadow-xl p-4 sm:p-6 border-2 border-red-400/50 relative overflow-hidden">
            <div class="absolute top-0 right-0 opacity-10">
              <i class="fas fa-exclamation-triangle text-9xl"></i>
            </div>
            <div class="relative z-10">
              <div class="flex items-center justify-between mb-3">
                <h3
                  class="text-lg sm:text-xl font-bold text-white flex items-center gap-2">
                  <i class="fas fa-utensils"></i>
                  طعام منخفض المخزون
                </h3>
                <span id="lowStockFoodsCount"
                  class="bg-white/30 text-white px-3 py-1 rounded-full text-sm font-bold">0</span>
              </div>
              <p class="text-white/90 text-sm mb-4">بعض الأطعمة أوشكت على النفاد!
              </p>
              <button onclick="scrollToLowStockSection('food')"
                class="bg-white text-red-600 px-4 py-2 rounded-lg font-bold hover:bg-red-50 transition text-sm">
                <i class="fas fa-eye mr-1"></i>عرض القائمة
              </button>
            </div>
          </div>

          <!-- Low Stock Drinks Card -->
          <div
            class="bg-gradient-to-br from-orange-500 to-orange-600 rounded-2xl shadow-xl p-4 sm:p-6 border-2 border-orange-400/50 relative overflow-hidden">
            <div class="absolute top-0 right-0 opacity-10">
              <i class="fas fa-exclamation-triangle text-9xl"></i>
            </div>
            <div class="relative z-10">
              <div class="flex items-center justify-between mb-3">
                <h3
                  class="text-lg sm:text-xl font-bold text-white flex items-center gap-2">
                  <i class="fas fa-glass-cheers"></i>
                  مشروبات منخفض المخزون
                </h3>
                <span id="lowStockDrinksCount"
                  class="bg-white/30 text-white px-3 py-1 rounded-full text-sm font-bold">0</span>
              </div>
              <p class="text-white/90 text-sm mb-4">بعض المشروبات أوشكت على
                النفاد!</p>
              <button onclick="scrollToLowStockSection('drinks')"
                class="bg-white text-orange-600 px-4 py-2 rounded-lg font-bold hover:bg-orange-50 transition text-sm">
                <i class="fas fa-eye mr-1"></i>عرض القائمة
              </button>
            </div>
          </div>
        </div>
      
      <!-- قسم إدارة الطلبات - منفصل للكافيه والجلسات -->
      <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">
        <!-- قسم الكافيه -->
        <div id="cafeSection"
          class="bg-gradient-to-br from-amber-600/20 to-orange-600/20 backdrop-blur-md rounded-2xl shadow-xl p-4 sm:p-6 slide-up border-2 border-amber-300/30 relative z-10">
          <div class="flex items-center justify-between mb-4 flex-wrap gap-2">
            <div class="flex items-center gap-2 flex-wrap">
              <h3 class="text-xl sm:text-2xl font-bold text-white flex items-center gap-2">
                <i class="fas fa-coffee text-amber-300"></i>
                إدارة الكافيه
              </h3>
              <span class="text-amber-200/80 text-xs sm:text-sm font-medium bg-amber-600/30 px-2 py-1 rounded-lg whitespace-nowrap">
                <i class="fas fa-info-circle text-[10px] sm:text-xs"></i>
                طلبات خارجية
              </span>
                                            <span class="bg-white/10 text-white/50 text-xs sm:text-sm font-bold px-2.5 py-1 rounded-full border border-white/10">
                  0
                </span>
                          </div>
                          <button type="button" onclick="showCreateCafeModal()"
                class="bg-gradient-to-r from-amber-500 to-orange-500 hover:from-amber-600 hover:to-orange-600 text-white px-3 py-2 rounded-lg font-bold transition-all shadow-lg hover:shadow-xl flex items-center gap-2 text-sm">
                <i class="fas fa-plus"></i>
                <span class="hidden sm:inline">جلسة جديدة</span>
              </button>
                      </div>

          
          <form method="GET" action="orders.php" id="cafeForm">
            <input type="hidden" name="session_id" id="cafeSessionIdInput"
              value="">
            <div class="relative" id="cafeDropdown">
              <button type="button" onclick="toggleCafeDropdown()"
                class="w-full bg-white/10 border-2 border-amber-300/50 rounded-xl px-4 py-3 text-white focus:outline-none focus:ring-2 focus:ring-amber-400 transition flex items-center justify-between hover:bg-white/15">
                <span id="cafeDropdownText" class="truncate">
                  -- اختر جلسة كافيه --                </span>
                <i class="fas fa-chevron-down transition-transform duration-200"
                  id="cafeDropdownIcon"></i>
              </button>
              <div id="cafeDropdownMenu"
                class="hidden bg-slate-800 border-2 border-amber-300/30 rounded-xl overflow-hidden"
                style="position:absolute;top:calc(100% + 6px);right:0;left:0;min-width:100%;z-index:10000;max-height:400px;overflow-y:auto;">
                <div class="py-1">
                  <button type="button"
                    onclick="selectCafeSession('', '-- اختر جلسة كافيه --')"
                    class="w-full text-right px-4 py-2.5 text-sm text-white/70 hover:bg-amber-600/20 transition-colors">
                    -- اختر جلسة كافيه --
                  </button>
                                      <div class="px-4 py-3 text-center text-white/50 text-sm">
                      <i class="fas fa-coffee mr-1"></i>
                      لا توجد جلسات كافيه نشطة
                    </div>
                                  </div>
              </div>
            </div>
          </form>
                      <p class="text-white/60 text-center mt-4 text-sm">
              <i class="fas fa-coffee mr-1"></i>
              لا توجد جلسات كافيه حالياً
            </p>
                  </div>

        <!-- قسم الجلسات (الألعاب) -->
        <div
          class="bg-gradient-to-br from-emerald-600/20 to-blue-600/20 backdrop-blur-md rounded-2xl shadow-xl p-4 sm:p-6 slide-up border-2 border-emerald-300/30 relative z-10">
          <div class="flex items-center justify-between mb-4">
            <h3
              class="text-xl sm:text-2xl font-bold text-white flex items-center gap-2">
              <i class="fas fa-gamepad text-emerald-300"></i>
              إدارة الجلسات
            </h3>
          </div>

          
          <form method="GET" action="orders.php" id="sessionForm">
            <input type="hidden" name="session_id" id="sessionIdInput"
              value="">
            <div class="relative" id="sessionDropdown">
              <button type="button" onclick="toggleSessionDropdown()"
                class="w-full bg-white/10 border-2 border-emerald-300/50 rounded-xl px-4 py-3 text-white focus:outline-none focus:ring-2 focus:ring-emerald-400 transition flex items-center justify-between hover:bg-white/15">
                <span id="sessionDropdownText" class="truncate">
                  -- اختر جلسة نشطة --                </span>
                <i class="fas fa-chevron-down transition-transform duration-200"
                  id="sessionDropdownIcon"></i>
              </button>
              <div id="sessionDropdownMenu"
                class="hidden bg-slate-800 border-2 border-emerald-300/30 rounded-xl overflow-hidden"
                style="position:absolute;top:calc(100% + 6px);right:0;left:0;min-width:100%;z-index:50;max-height:400px;overflow-y:auto;">
                <div class="py-1">
                  <button type="button"
                    onclick="selectSession('', '-- اختر جلسة نشطة --')"
                    class="w-full text-right px-4 py-2.5 text-sm text-white/70 hover:bg-emerald-600/20 transition-colors">
                    -- اختر جلسة نشطة --
                  </button>
                                                            <button type="button"
                        onclick="selectSession('14589', 'VIP1 (PS4) - 10:49')"
                        class="w-full text-right px-4 py-2.5 text-sm text-white hover:bg-emerald-600/30 transition-colors ">
                        <div class="flex items-center justify-between gap-2">
                          <span class="truncate">VIP1 (PS4) - 10:49</span>
                                                  </div>
                      </button>
                                          <button type="button"
                        onclick="selectSession('14587', 'VIP2 (PS4) - 10:42')"
                        class="w-full text-right px-4 py-2.5 text-sm text-white hover:bg-emerald-600/30 transition-colors ">
                        <div class="flex items-center justify-between gap-2">
                          <span class="truncate">VIP2 (PS4) - 10:42</span>
                                                  </div>
                      </button>
                                                      </div>
              </div>
            </div>
          </form>
                  </div>
      </div>

              <!-- No Session Selected -->
        <div
          class="bg-white/10 backdrop-blur-md rounded-2xl shadow-xl p-8 sm:p-12 text-center slide-up border border-white/20">
          <i class="fas fa-hand-point-up text-6xl text-white/30 mb-4"></i>
          <h3 class="text-2xl font-bold text-white mb-2">اختر جلسة لإدارة الطلبات
          </h3>
          <p class="text-white/70">يرجى اختيار جلسة نشطة من القائمة أعلاه لإضافة
            وإدارة الطلبات</p>
        </div>
      
      <!-- Items Management (Food & Drinks) -->
      <div
        class="bg-white/10 backdrop-blur-md rounded-2xl shadow-xl p-4 sm:p-6 mb-6 slide-up border border-white/20">
        <h3
          class="text-xl sm:text-2xl font-bold text-white mb-4 flex items-center gap-2">
          <i class="fas fa-box-open"></i>
          الأصناف المتاحة
        </h3>

        <!-- Low Stock Detailed Sections (Collapsible) -->
                  <div id="lowStockDetailedSections" style="display: none;">
            <!-- Low Stock Foods Section (Accordion) -->
            <div id="lowStockFoodSection" class="mb-4">
              <div
                class="bg-gradient-to-r from-red-500/20 to-red-600/20 border-2 border-red-500/50 rounded-2xl overflow-hidden">
                <!-- Accordion Header -->
                <button onclick="toggleAccordion('lowStockFoodAccordion')"
                  class="w-full px-4 sm:px-6 py-4 flex items-center justify-between hover:bg-red-500/10 transition-colors">
                  <div class="flex items-center gap-2">
                    <i class="fas fa-exclamation-circle text-red-400"></i>
                    <h3 class="text-lg sm:text-xl font-bold text-white">
                      أطعمة منخفضة المخزون (أقل من <span
                        id="thresholdDisplayFood">5</span>)
                    </h3>
                  </div>
                  <i id="lowStockFoodAccordionIcon"
                    class="fas fa-chevron-down text-white transition-transform duration-300"></i>
                </button>

                <!-- Accordion Content -->
                <div id="lowStockFoodAccordion" class="accordion-content"
                  style="max-height: 0; overflow: hidden; transition: max-height 0.3s ease-out;">
                  <div class="p-4 sm:p-6 border-t border-red-500/30">
                    <div class="search-box mb-4">
                      <input type="text" id="searchLowStockFood"
                        class="search-input"
                        placeholder="ابحث في الأطعمة المنخفضة..."
                        onkeyup="searchLowStockItems('food')">
                      <i class="fas fa-search search-icon"></i>
                    </div>
                    <div id="lowStockFoodList"
                      class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-3">
                      <!-- Will be populated by JavaScript -->
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Low Stock Drinks Section (Accordion) -->
            <div id="lowStockDrinksSection" class="mb-4">
              <div
                class="bg-gradient-to-r from-orange-500/20 to-orange-600/20 border-2 border-orange-500/50 rounded-2xl overflow-hidden">
                <!-- Accordion Header -->
                <button onclick="toggleAccordion('lowStockDrinksAccordion')"
                  class="w-full px-4 sm:px-6 py-4 flex items-center justify-between hover:bg-orange-500/10 transition-colors">
                  <div class="flex items-center gap-2">
                    <i class="fas fa-exclamation-circle text-orange-400"></i>
                    <h3 class="text-lg sm:text-xl font-bold text-white">
                      مشروبات منخفضة المخزون (أقل من <span
                        id="thresholdDisplayDrinks">5</span>)
                    </h3>
                  </div>
                  <i id="lowStockDrinksAccordionIcon"
                    class="fas fa-chevron-down text-white transition-transform duration-300"></i>
                </button>

                <!-- Accordion Content -->
                <div id="lowStockDrinksAccordion" class="accordion-content"
                  style="max-height: 0; overflow: hidden; transition: max-height 0.3s ease-out;">
                  <div class="p-4 sm:p-6 border-t border-orange-500/30">
                    <div class="search-box mb-4">
                      <input type="text" id="searchLowStockDrinks"
                        class="search-input"
                        placeholder="ابحث في المشروبات المنخفضة..."
                        onkeyup="searchLowStockItems('drinks')">
                      <i class="fas fa-search search-icon"></i>
                    </div>
                    <div id="lowStockDrinksList"
                      class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-3">
                      <!-- Will be populated by JavaScript -->
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        
        <!-- Tabs -->
        <div class="flex gap-2 mb-6 overflow-x-auto pb-2">
                      <button onclick="showTab('food')" id="tabFood"
              class="tab-button bg-emerald-500/80 hover:bg-emerald-600 text-white px-4 sm:px-6 py-2 sm:py-3 rounded-xl font-semibold transition transform hover:scale-105 whitespace-nowrap relative">
              <i class="fas fa-pizza-slice mr-1"></i> الطعام
            </button>
                    <button onclick="showTab('drinks')" id="tabDrinks"
            class="tab-button bg-white/10 hover:bg-white/20 text-white px-4 sm:px-6 py-2 sm:py-3 rounded-xl font-semibold transition whitespace-nowrap">
            <i class="fas fa-glass-cheers mr-1"></i> المشروبات
          </button>
        </div>

        <!-- Food Tab -->
        <div id="contentFood" class="tab-content">
                      <!-- Add Food Form -->
                          <div class="bg-white/5 rounded-xl p-4 mb-6 border border-white/10">
                <h4 class="text-lg font-bold text-white mb-3">
                  <i class="fas fa-plus mr-2"></i>إضافة طعام جديد
                </h4>
                <form method="POST" action="orders.php"
                  class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-3">
                  <input type="hidden" name="action" value="add_food_item">
                  <input type="text" name="name" placeholder="اسم الطعام" required
                    class="bg-white/10 border border-white/30 rounded-lg px-3 py-2 text-white placeholder-white/50 focus:outline-none focus:ring-2 focus:ring-emerald-400 text-sm">
                  <input type="number" name="price" placeholder="السعر" step="0.01"
                    min="0" required
                    class="bg-white/10 border border-white/30 rounded-lg px-3 py-2 text-white placeholder-white/50 focus:outline-none focus:ring-2 focus:ring-emerald-400 text-sm">
                  <input type="number" name="stock" placeholder="مخزون" min="0"
                    class="bg-white/10 border border-white/30 rounded-lg px-3 py-2 text-white placeholder-white/50 focus:outline-none focus:ring-2 focus:ring-emerald-400 text-sm">
                  <button type="submit"
                    class="bg-emerald-500 hover:bg-emerald-600 text-white font-bold py-2 px-4 rounded-lg transition transform hover:scale-105 text-sm">
                    <i class="fas fa-plus mr-1"></i>إضافة
                  </button>
                </form>
              </div>
                                
          <!-- Search Box for Food -->
          <div class="search-box">
            <input type="text" id="searchFood" class="search-input"
              placeholder="ابحث عن طعام..." onkeyup="searchItems('food')">
            <i class="fas fa-search search-icon"></i>
          </div>

          <!-- Food Items Grid -->
          <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4"
            id="foodItemsGrid">
                                          <div
                  class="bg-white/10 rounded-xl p-4 hover:bg-white/15 transition border border-white/10">
                  <div class="flex justify-between items-start mb-3">
                    <h5 class="font-bold text-white text-lg">
                      اندومي</h5>
                    <span
                      class="bg-emerald-500/30 text-emerald-200 text-xs px-2 py-1 rounded-full">طعام</span>
                  </div>
                  <div class="space-y-2 mb-3">
                    <p class="text-emerald-400 font-bold text-xl">
                      15.00 جنيه</p>
                                          <p class="text-white/70 text-sm">
                        <i class="fas fa-boxes mr-1"></i>المخزون: <span
                          class="font-semibold ">49</span>
                      </p>
                                      </div>
                                      <div class="flex gap-2">
                                              <button onclick='editFoodItem({"id":193,"name":"\u0627\u0646\u062f\u0648\u0645\u064a","price":"15.00","stock":49})'
                          class="flex-1 bg-blue-500 hover:bg-blue-600 text-white py-2 px-3 rounded-lg transition text-sm font-semibold">
                          <i class="fas fa-edit"></i>
                        </button>
                      
                                              <button onclick="confirmDeleteItem('food', 193)"
                          class="flex-1 bg-red-500 hover:bg-red-600 text-white py-2 px-3 rounded-lg transition text-sm font-semibold">
                          <i class="fas fa-trash"></i>
                        </button>
                                          </div>
                                  </div>
                                    </div>
        </div>

        <!-- Drinks Tab -->
        <div id="contentDrinks" class="tab-content hidden">
          <!-- Add Drink Form -->
                      <div class="bg-white/5 rounded-xl p-4 mb-6 border border-white/10">
              <h4 class="text-lg font-bold text-white mb-3">
                <i class="fas fa-plus mr-2"></i>إضافة مشروب جديد
              </h4>
              <form method="POST" action="orders.php"
                class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-3">
                <input type="hidden" name="action" value="add_drink_item">
                <input type="text" name="name" placeholder="اسم المشروب" required
                  class="bg-white/10 border border-white/30 rounded-lg px-3 py-2 text-white placeholder-white/50 focus:outline-none focus:ring-2 focus:ring-blue-400 text-sm">
                <input type="number" name="price" placeholder="السعر" step="0.01"
                  min="0" required
                  class="bg-white/10 border border-white/30 rounded-lg px-3 py-2 text-white placeholder-white/50 focus:outline-none focus:ring-2 focus:ring-blue-400 text-sm">
                <input type="number" name="stock" placeholder="مخزون" min="0"
                  class="bg-white/10 border border-white/30 rounded-lg px-3 py-2 text-white placeholder-white/50 focus:outline-none focus:ring-2 focus:ring-blue-400 text-sm">
                <select name="drink_type" required
                  class="bg-white/10 border border-white/30 rounded-lg px-3 py-2 text-white focus:outline-none focus:ring-2 focus:ring-blue-400 text-sm">
                  <option value="بارد" class="bg-gray-800">بارد ❄️</option>
                  <option value="ساخن" class="bg-gray-800">ساخن ☕</option>
                </select>
                <button type="submit"
                  class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded-lg transition transform hover:scale-105 text-sm">
                  <i class="fas fa-plus mr-1"></i>إضافة
                </button>
              </form>
            </div>
          
          <!-- Search Box for Drinks -->
          <div class="search-box">
            <input type="text" id="searchDrinks" class="search-input"
              placeholder="ابحث عن مشروب..." onkeyup="searchItems('drinks')">
            <i class="fas fa-search search-icon"></i>
          </div>

          <!-- Drinks Grid -->
          <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4"
            id="drinksItemsGrid">
                          <div class="col-span-full text-center py-8">
                <i class="fas fa-inbox text-4xl text-white/20 mb-2"></i>
                <p class="text-white/60">لا توجد مشروبات متاحة</p>
              </div>
                      </div>
        </div>
      </div>
    </div>

    <script>
      // ✅ متغيرات الصلاحيات
      const canManage = true;
      const canViewAdd = true;
      const canViewInventory = true;
      const canManageInventory = true;
      async function attemptLogout() {
        try {
          const shiftRes = await fetch(
            'api/shift-actions.php?action=employee_active_shift', {
              credentials: 'same-origin'
            });
          const shiftData = await shiftRes.json();
          if (shiftData && shiftData.success && shiftData.active) {
            showShiftBlockModal();
            return;
          }
        } catch (e) {}
        window.location.href = 'logout.php';
      }

      function showShiftBlockModal() {
        if (document.getElementById('shiftBlockOverlay')) return;
        const overlay = document.createElement('div');
        overlay.id = 'shiftBlockOverlay';
        overlay.style =
          'position:fixed;inset:0;background:rgba(0,0,0,0.6);z-index:99999;display:flex;align-items:center;justify-content:center;padding:16px;';
        const card = document.createElement('div');
        card.style =
          'background:linear-gradient(135deg,#0f172a,#1f2937);color:#fff;border-radius:16px;width:100%;max-width:520px;box-shadow:0 20px 60px rgba(0,0,0,.5);overflow:hidden;';
        card.innerHTML = `
          <div style=\"padding:22px 24px;text-align:center\">
            <div style=\"font-size:38px;margin-bottom:12px\">⚠️</div>
            <h3 style=\"font-size:20px;font-weight:700;margin-bottom:8px\">لا يمكن تسجيل الخروج</h3>
            <p style=\"font-size:14px;color:#cbd5e1;line-height:1.8;margin-bottom:18px\">
              لديك شيفت نشط حالياً. يجب إنهاء الشيفت قبل تسجيل الخروج.
            </p>
            <a href=\"shifts.php\" style=\"display:inline-block;background:linear-gradient(135deg,#10b981,#059669);color:#fff;padding:10px 18px;border:none;border-radius:10px;font-weight:700;cursor:pointer;text-decoration:none\">الانتقال إلى إنهاء الشيفت</a>
          </div>`;
        overlay.appendChild(card);
        overlay.addEventListener('click', (e) => {
          if (e.target === overlay) overlay.remove();
        });
        document.body.appendChild(overlay);
      }

      // Safety: intercept any plain logout links
      document.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('a[href$="logout.php"]').forEach(a => {
          a.addEventListener('click', function(e) {
            e.preventDefault();
            attemptLogout();
          });
        });
      });
      const canEdit = true;
      const canDelete = true;

      // Toggle item type in add order form
      // Custom Dropdown Functions
      function toggleDropdown(type) {
        const menu = document.getElementById(type + 'Menu');
        const icon = document.getElementById(type + 'Icon');
        const addOrderCard = document.getElementById('addOrderCard');

        // Close all other dropdowns
        document.querySelectorAll('[id$="Menu"]').forEach(m => {
          if (m.id !== type + 'Menu') m.classList.add('hidden');
        });
        document.querySelectorAll('[id$="Icon"]').forEach(i => {
          if (i.id !== type + 'Icon') i.classList.remove('rotate-180');
        });

        // Toggle current dropdown (position is handled via inline styles on the menu)
        menu.classList.toggle('hidden');
        if (icon) icon.classList.toggle('rotate-180');

        // ارفع كارت إضافة الطلب فوق "الطلبات الحالية" أثناء فتح القائمة
        if (addOrderCard) {
          addOrderCard.style.zIndex = menu.classList.contains('hidden') ? '80' : '200';
          addOrderCard.style.overflow = 'visible';
        }
      }

      // Close dropdowns when clicking outside
      document.addEventListener('click', function(event) {
        const cafeDropdown = document.getElementById('cafeDropdown');
        const isClickInsideCafe = cafeDropdown && cafeDropdown.contains(event.target);

        if (!event.target.closest('.relative')) {
          document.querySelectorAll('[id$="Menu"]').forEach(m => m.classList
            .add('hidden'));
          document.querySelectorAll('[id$="Icon"]').forEach(i => {
            i.classList.remove('rotate-180');
            i.style.transform = 'rotate(0deg)';
          });

          // إعادة z-index لقسم الكافيه عند إغلاق القائمة
          const addOrderCard = document.getElementById('addOrderCard');
          if (addOrderCard) {
            addOrderCard.style.zIndex = '80';
            addOrderCard.style.overflow = 'visible';
          }

          const cafeSection = document.getElementById('cafeSection');
          if (cafeSection) {
            cafeSection.classList.remove('cafe-section-dropdown-open');
            cafeSection.style.zIndex = '';
          }
        }
      });

      // Session Dropdown
      // دوال الكافيه
      function toggleCafeDropdown() {
        const menu = document.getElementById('cafeDropdownMenu');
        const icon = document.getElementById('cafeDropdownIcon');
        const cafeSection = document.getElementById('cafeSection');
        const isHidden = menu.classList.contains('hidden');

        // إغلاق منيو الجلسات إذا كان مفتوحاً
        const sessionMenu = document.getElementById('sessionDropdownMenu');
        if (sessionMenu && !sessionMenu.classList.contains('hidden')) {
          sessionMenu.classList.add('hidden');
          document.getElementById('sessionDropdownIcon').style.transform =
            'rotate(0deg)';
        }

        if (isHidden) {
          menu.classList.remove('hidden');
          icon.style.transform = 'rotate(180deg)';
          // زيادة z-index للقسم عند فتح القائمة على الشاشات الصغيرة
          if (cafeSection && window.innerWidth < 1024) {
            cafeSection.classList.add('cafe-section-dropdown-open');
            cafeSection.style.zIndex = '50';
          }
        } else {
          menu.classList.add('hidden');
          icon.style.transform = 'rotate(0deg)';
          // إعادة z-index عند إغلاق القائمة
          if (cafeSection) {
            cafeSection.classList.remove('cafe-section-dropdown-open');
            cafeSection.style.zIndex = '';
          }
        }
      }

      function selectCafeSession(id, text) {
        document.getElementById('cafeSessionIdInput').value = id;
        document.getElementById('cafeDropdownText').textContent = text;
        toggleCafeDropdown();
        document.getElementById('cafeForm').submit();
      }

      function toggleSessionDropdown() {
        const menu = document.getElementById('sessionDropdownMenu');
        const icon = document.getElementById('sessionDropdownIcon');
        const isHidden = menu.classList.contains('hidden');

        // إغلاق منيو الكافيه إذا كان مفتوحاً
        const cafeMenu = document.getElementById('cafeDropdownMenu');
        const cafeSection = document.getElementById('cafeSection');
        if (cafeMenu && !cafeMenu.classList.contains('hidden')) {
          cafeMenu.classList.add('hidden');
          document.getElementById('cafeDropdownIcon').style.transform =
            'rotate(0deg)';
          // إعادة z-index لقسم الكافيه
          if (cafeSection) {
            cafeSection.classList.remove('cafe-section-dropdown-open');
            cafeSection.style.zIndex = '';
          }
        }

        if (isHidden) {
          menu.classList.remove('hidden');
          icon.style.transform = 'rotate(180deg)';
        } else {
          menu.classList.add('hidden');
          icon.style.transform = 'rotate(0deg)';
        }
      }

      function selectSession(id, text) {
        document.getElementById('sessionIdInput').value = id;
        document.getElementById('sessionDropdownText').textContent = text;
        toggleSessionDropdown(); // إغلاق القائمة
        document.getElementById('sessionForm').submit();
      }

      // Item Type Dropdown
      function selectItemType(value, text) {
        document.getElementById('itemTypeInput').value = value;
        document.getElementById('itemTypeText').textContent = text;
        document.getElementById('itemTypeText').classList.remove('text-white/70');
        document.getElementById('itemTypeText').classList.add('text-white');
        toggleDropdown('itemType');

        // Show/hide sections
        const drinkSection = document.getElementById('drinkSection');
        const foodSection = document.getElementById('foodSection');
        const drinkTypeSection = document.getElementById('drinkTypeSection');

        drinkSection.style.display = 'none';
        foodSection.style.display = 'none';
        drinkTypeSection.style.display = 'none';

        if (value === 'drink') {
          drinkSection.style.display = 'block';
          drinkTypeSection.style.display = 'block';
          document.getElementById('drinkIdInput').required = true;
          document.getElementById('foodIdInput').required = false;
        } else if (value === 'food') {
          foodSection.style.display = 'block';
          document.getElementById('foodIdInput').required = true;
          document.getElementById('drinkIdInput').required = false;
        }
      }

      // Drink Dropdown
      function selectDrink(id, name, price, stock) {
        document.getElementById('drinkIdInput').value = id;
        document.getElementById('drinkText').textContent = name + ' - ' +
          parseFloat(price).toFixed(2) + ' ' + CURRENCY_SYMBOL;
        document.getElementById('drinkText').classList.remove('text-white/70');
        document.getElementById('drinkText').classList.add('text-white');
        toggleDropdown('drink');
      }

      // Food Dropdown
      function selectFood(id, name, price, stock) {
        document.getElementById('foodIdInput').value = id;
        document.getElementById('foodText').textContent = name + ' - ' +
          parseFloat(price).toFixed(2) + ' ' + CURRENCY_SYMBOL;
        document.getElementById('foodText').classList.remove('text-white/70');
        document.getElementById('foodText').classList.add('text-white');
        toggleDropdown('food');
      }

      // Drink Type Dropdown
      function selectDrinkType(value, text) {
        document.getElementById('drinkTypeInput').value = value;
        document.getElementById('drinkTypeText').textContent = text;
        document.getElementById('drinkTypeText').classList.remove(
          'text-white/70');
        document.getElementById('drinkTypeText').classList.add('text-white');
        toggleDropdown('drinkType');
      }

      // Show tab
      function showTab(tab) {
        // Hide all tabs
        document.querySelectorAll('.tab-content').forEach(el => el.classList.add(
          'hidden'));
        document.querySelectorAll('.tab-button').forEach(btn => {
          btn.classList.remove('bg-emerald-500/80', 'bg-blue-500');
          btn.classList.add('bg-white/10');
        });

        // Show selected tab
        if (tab === 'food') {
          document.getElementById('contentFood').classList.remove('hidden');
          document.getElementById('tabFood').classList.add('bg-emerald-500/80');
          document.getElementById('tabFood').classList.remove('bg-white/10');
        } else {
          document.getElementById('contentDrinks').classList.remove('hidden');
          document.getElementById('tabDrinks').classList.add('bg-blue-500');
          document.getElementById('tabDrinks').classList.remove('bg-white/10');
        }
      }

      // Search items function
      function searchItems(type) {
        const searchInput = type === 'food' ? document.getElementById(
          'searchFood') : document.getElementById('searchDrinks');
        const grid = type === 'food' ? document.getElementById('foodItemsGrid') :
          document.getElementById('drinksItemsGrid');
        const searchTerm = searchInput.value.toLowerCase().trim();
        const items = grid.querySelectorAll('.bg-white\\/10.rounded-xl');

        items.forEach(item => {
          const itemName = item.querySelector('h5').textContent.toLowerCase();
          const itemPrice = item.textContent.toLowerCase();

          if (itemName.includes(searchTerm) || itemPrice.includes(
              searchTerm)) {
            item.style.display = '';
            item.style.animation = 'fadeIn 0.3s ease-out';
          } else {
            item.style.display = 'none';
          }
        });

        // Show "no results" message if needed
        const visibleItems = Array.from(items).filter(item => item.style
          .display !== 'none');
        const existingNoResults = grid.querySelector('.no-results-message');

        if (visibleItems.length === 0 && !existingNoResults) {
          const noResultsMsg = document.createElement('div');
          noResultsMsg.className =
            'no-results-message col-span-full text-center py-8';
          noResultsMsg.innerHTML = `
          <i class="fas fa-search text-4xl text-white/20 mb-2"></i>
          <p class="text-white/60">لا توجد نتائج للبحث عن "${searchTerm}"</p>
        `;
          grid.appendChild(noResultsMsg);
        } else if (visibleItems.length > 0 && existingNoResults) {
          existingNoResults.remove();
        }
      }

      // Confirm delete order (custom modal)
      function confirmDeleteOrder(orderId) {
        showConfirmModal(
          'حذف الطلب',
          'هل أنت متأكد من حذف هذا الطلب؟ سيتم إرجاع الكمية إلى المخزون.',
          () => {
            const form = document.createElement('form');
            form.method = 'POST';
            form.action = 'orders.php?session_id=0';
            form.innerHTML = `
            <input type="hidden" name="action" value="delete_order">
            <input type="hidden" name="order_id" value="${orderId}">
          `;
            document.body.appendChild(form);
            form.submit();
          }
        );
      }

      // Confirm delete item
      function confirmDeleteItem(type, itemId) {
        const itemName = type === 'food' ? 'الطعام' : 'المشروب';
        showConfirmModal(
          `حذف ${itemName}`,
          `هل أنت متأكد من حذف هذا ${itemName}؟`,
          () => {
            const form = document.createElement('form');
            form.method = 'POST';
            form.action = 'orders.php';
            form.innerHTML = `
            <input type="hidden" name="action" value="delete_${type}_item">
            <input type="hidden" name="item_id" value="${itemId}">
          `;
            document.body.appendChild(form);
            form.submit();
          }
        );
      }

      // Edit food item
      function editFoodItem(item) {
        const modal = document.createElement('div');
        modal.className =
          'fixed inset-0 bg-black/60 backdrop-blur-sm flex items-center justify-center z-50 p-4';

        // ✅ إخفاء حقل المخزون إذا لم يكن لديه صلاحية إدارة المخزون
        const stockField = canManageInventory ? `
        <div>
          <label class="block text-white font-semibold mb-2 text-sm">المخزون:</label>
          <input type="number" name="stock" value="${item.stock}" min="0" class="w-full bg-white/10 border border-white/30 rounded-lg px-4 py-2 text-white focus:outline-none focus:ring-2 focus:ring-emerald-400">
        </div>
      ` : `<input type="hidden" name="stock" value="${item.stock}">`;

        modal.innerHTML = `
        <div class="bg-gradient-to-br from-blue-900 to-indigo-900 rounded-2xl p-6 max-w-md w-full shadow-2xl border border-white/20 transform transition-all" style="animation: slideUp 0.3s ease-out;">
          <h3 class="text-2xl font-bold text-white mb-4"><i class="fas fa-edit mr-2"></i>تعديل الطعام</h3>
          <form method="POST" action="orders.php">
            <input type="hidden" name="action" value="edit_food_item">
            <input type="hidden" name="item_id" value="${item.id}">
            <div class="space-y-4">
              <div>
                <label class="block text-white font-semibold mb-2 text-sm">اسم الطعام:</label>
                <input type="text" name="name" value="${item.name}" required class="w-full bg-white/10 border border-white/30 rounded-lg px-4 py-2 text-white focus:outline-none focus:ring-2 focus:ring-emerald-400">
              </div>
              <div>
                <label class="block text-white font-semibold mb-2 text-sm">السعر (جنيه):</label>
                <input type="number" name="price" value="${item.price}" step="0.01" min="0" required class="w-full bg-white/10 border border-white/30 rounded-lg px-4 py-2 text-white focus:outline-none focus:ring-2 focus:ring-emerald-400">
              </div>
              ${stockField}
            </div>
            <div class="flex gap-3 mt-6">
              <button type="submit" class="flex-1 bg-emerald-500 hover:bg-emerald-600 text-white font-bold py-3 px-4 rounded-lg transition">
                <i class="fas fa-check mr-1"></i>حفظ
              </button>
              <button type="button" onclick="this.closest('.fixed').remove()" class="flex-1 bg-red-500 hover:bg-red-600 text-white font-bold py-3 px-4 rounded-lg transition">
                <i class="fas fa-times mr-1"></i>إلغاء
              </button>
            </div>
          </form>
        </div>
      `;
        document.body.appendChild(modal);
        modal.addEventListener('click', (e) => {
          if (e.target === modal) modal.remove();
        });
      }

      // Edit drink item
      function editDrinkItem(item) {
        const modal = document.createElement('div');
        modal.className =
          'fixed inset-0 bg-black/60 backdrop-blur-sm flex items-center justify-center z-50 p-4';

        // ✅ إخفاء حقل المخزون إذا لم يكن لديه صلاحية إدارة المخزون
        const stockField = canManageInventory ? `
        <div>
          <label class="block text-white font-semibold mb-2 text-sm">المخزون:</label>
          <input type="number" name="stock" value="${item.stock}" min="0" class="w-full bg-white/10 border border-white/30 rounded-lg px-4 py-2 text-white focus:outline-none focus:ring-2 focus:ring-blue-400">
        </div>
      ` : `<input type="hidden" name="stock" value="${item.stock}">`;

        modal.innerHTML = `
        <div class="bg-gradient-to-br from-blue-900 to-indigo-900 rounded-2xl p-6 max-w-md w-full shadow-2xl border border-white/20 transform transition-all" style="animation: slideUp 0.3s ease-out;">
          <h3 class="text-2xl font-bold text-white mb-4"><i class="fas fa-edit mr-2"></i>تعديل المشروب</h3>
          <form method="POST" action="orders.php">
            <input type="hidden" name="action" value="edit_drink_item">
            <input type="hidden" name="item_id" value="${item.id}">
            <div class="space-y-4">
              <div>
                <label class="block text-white font-semibold mb-2 text-sm">اسم المشروب:</label>
                <input type="text" name="name" value="${item.name}" required class="w-full bg-white/10 border border-white/30 rounded-lg px-4 py-2 text-white focus:outline-none focus:ring-2 focus:ring-blue-400">
              </div>
              <div>
                <label class="block text-white font-semibold mb-2 text-sm">السعر (جنيه):</label>
                <input type="number" name="price" value="${item.price}" step="0.01" min="0" required class="w-full bg-white/10 border border-white/30 rounded-lg px-4 py-2 text-white focus:outline-none focus:ring-2 focus:ring-blue-400">
              </div>
              ${stockField}
              <div>
                <label class="block text-white font-semibold mb-2 text-sm">النوع:</label>
                <select name="drink_type" required class="w-full bg-white/10 border border-white/30 rounded-lg px-4 py-2 text-white focus:outline-none focus:ring-2 focus:ring-blue-400">
                  <option value="بارد" ${item.type === 'بارد' ? 'selected' : ''} class="bg-gray-800">بارد ❄️</option>
                  <option value="ساخن" ${item.type === 'ساخن' ? 'selected' : ''} class="bg-gray-800">ساخن ☕</option>
                </select>
              </div>
            </div>
            <div class="flex gap-3 mt-6">
              <button type="submit" class="flex-1 bg-blue-500 hover:bg-blue-600 text-white font-bold py-3 px-4 rounded-lg transition">
                <i class="fas fa-check mr-1"></i>حفظ
              </button>
              <button type="button" onclick="this.closest('.fixed').remove()" class="flex-1 bg-red-500 hover:bg-red-600 text-white font-bold py-3 px-4 rounded-lg transition">
                <i class="fas fa-times mr-1"></i>إلغاء
              </button>
            </div>
          </form>
        </div>
      `;
        document.body.appendChild(modal);
        modal.addEventListener('click', (e) => {
          if (e.target === modal) modal.remove();
        });
      }

      // Custom confirm modal
      function showConfirmModal(title, message, onConfirm) {
        const modal = document.createElement('div');
        modal.className =
          'fixed inset-0 bg-black/60 backdrop-blur-sm flex items-center justify-center z-50 p-4';
        modal.innerHTML = `
        <div class="bg-gradient-to-br from-red-900 to-red-800 rounded-2xl p-6 max-w-md w-full shadow-2xl border border-red-500/50 transform transition-all" style="animation: pulse 0.5s ease-out;">
          <div class="text-center mb-4">
            <i class="fas fa-exclamation-triangle text-6xl text-yellow-400 mb-2"></i>
            <h3 class="text-2xl font-bold text-white">${title}</h3>
          </div>
          <p class="text-white/90 text-center mb-6">${message}</p>
          <div class="flex gap-3">
            <button onclick="this.closest('.fixed').remove()" class="flex-1 bg-gray-600 hover:bg-gray-700 text-white font-bold py-3 px-4 rounded-lg transition">
              <i class="fas fa-times mr-1"></i>إلغاء
            </button>
            <button id="confirmBtn" class="flex-1 bg-red-600 hover:bg-red-700 text-white font-bold py-3 px-4 rounded-lg transition">
              <i class="fas fa-check mr-1"></i>تأكيد
            </button>
          </div>
        </div>
      `;
        document.body.appendChild(modal);

        modal.querySelector('#confirmBtn').addEventListener('click', () => {
          modal.remove();
          onConfirm();
        });

        modal.addEventListener('click', (e) => {
          if (e.target === modal) modal.remove();
        });

        // Escape key
        const escHandler = (e) => {
          if (e.key === 'Escape') {
            modal.remove();
            document.removeEventListener('keydown', escHandler);
          }
        };
        document.addEventListener('keydown', escHandler);
      }

      // ==================== Dark Mode Toggle - Synced ====================
      function toggleDarkMode() {
        const body = document.body;
        const icon = document.getElementById('darkModeIcon');

        const isDarkMode = body.classList.contains('dark-mode');
        const newMode = !isDarkMode;

        // Update body class
        if (newMode) {
          body.classList.remove('light-mode');
          body.classList.add('dark-mode');
          if (icon) icon.className = 'fas fa-moon';
        } else {
          body.classList.remove('dark-mode');
          body.classList.add('light-mode');
          if (icon) icon.className = 'fas fa-sun';
        }

        // Save to localStorage (for immediate sync)
        localStorage.setItem('darkMode', newMode ? 'true' : 'false');

        // Save to database (for persistence)
        fetch('api/user-preferences.php', {
            method: 'POST',
            headers: {
              'Content-Type': 'application/json'
            },
            body: JSON.stringify({
              dark_mode: newMode
            })
          }).then(response => response.json())
          .then(data => {
            if (data.success) {
              // Broadcast change to other tabs
              localStorage.setItem('darkModeChanged', Date.now().toString());
            }
          })
          .catch(err => console.error('Error saving dark mode:', err));
      }

      // Listen for dark mode changes from other tabs/pages
      window.addEventListener('storage', function(e) {
        if (e.key === 'darkMode' || e.key === 'darkModeChanged') {
          const darkMode = localStorage.getItem('darkMode') === 'true';
          const body = document.body;
          const icon = document.getElementById('darkModeIcon');

          if (darkMode && !body.classList.contains('dark-mode')) {
            body.classList.remove('light-mode');
            body.classList.add('dark-mode');
            if (icon) icon.className = 'fas fa-moon';
          } else if (!darkMode && body.classList.contains('dark-mode')) {
            body.classList.remove('dark-mode');
            body.classList.add('light-mode');
            if (icon) icon.className = 'fas fa-sun';
          }
        }
      });

      // Load saved theme and sync
      document.addEventListener('DOMContentLoaded', () => {
        const body = document.body;
        const icon = document.getElementById('darkModeIcon');

        // Sync with localStorage on page load
        const localDarkMode = localStorage.getItem('darkMode');
        const bodyHasDarkMode = body.classList.contains('dark-mode');

        // If localStorage exists and differs from body class, update body
        if (localDarkMode !== null) {
          const shouldBeDark = localDarkMode === 'true';
          if (shouldBeDark && !bodyHasDarkMode) {
            body.classList.remove('light-mode');
            body.classList.add('dark-mode');
          } else if (!shouldBeDark && bodyHasDarkMode) {
            body.classList.remove('dark-mode');
            body.classList.add('light-mode');
          }
        } else {
          // Save current state to localStorage
          localStorage.setItem('darkMode', bodyHasDarkMode ? 'true' :
            'false');
        }

        // Update icon
        if (icon) {
          if (body.classList.contains('dark-mode')) {
            icon.className = 'fas fa-moon';
          } else {
            icon.className = 'fas fa-sun';
          }
        }

        // Show success/error messages
        
              });

      // Load low stock data on page load (only if allowed)
      if (canViewInventory) {
        loadLowStockData();
        // Refresh low stock data every 60 seconds
        setInterval(loadLowStockData, 60000);
      }

      // Load low stock data from API
      function loadLowStockData() {
        fetch('api/inventory-status.php?action=low_stock_count')
          .then(response => response.json())
          .then(data => {
            console.log('📊 [Low Stock Count] API Response:', data);
            if (data.success) {
              console.log('📊 [Low Stock Count] Foods:', data.foodsCount,
                'Drinks:', data.drinksCount, 'Total:', data.total);

              // Update alert cards counts
              document.getElementById('lowStockFoodsCount').textContent = data
                .foodsCount;
              document.getElementById('lowStockDrinksCount').textContent = data
                .drinksCount;
              document.getElementById('thresholdDisplayFood').textContent = data
                .threshold;
              document.getElementById('thresholdDisplayDrinks').textContent =
                data.threshold;

              // Show/hide alert cards
              const alertsContainer = document.getElementById(
                'lowStockAlertsContainer');
              if (data.total > 0) {
                alertsContainer.style.display = 'grid';
                console.log('✅ [Low Stock Count] Alert cards displayed');
              } else {
                alertsContainer.style.display = 'none';
                console.log(
                  '⚠️ [Low Stock Count] Alert cards hidden (total = 0)');
              }
            }
          })
          .catch(err => console.error('❌ [Low Stock Count] Error:', err));

        // Load detailed lists
        fetch('api/inventory-status.php?action=low_stock_lists')
          .then(response => response.json())
          .then(data => {
            console.log('📋 [Low Stock Lists] API Response:', data);
            if (data.success) {
              console.log('📋 [Low Stock Lists] Foods count:', data.foods
                .length, 'Drinks count:', data.drinks.length);
              console.log('📋 [Low Stock Lists] Foods items:', data.foods);
              console.log('📋 [Low Stock Lists] Drinks items:', data.drinks);

              renderLowStockList('food', data.foods);
              renderLowStockList('drinks', data.drinks);

              // Show/hide detailed sections
              const detailedSections = document.getElementById(
                'lowStockDetailedSections');
              if (data.foods.length > 0 || data.drinks.length > 0) {
                detailedSections.style.display = 'block';
                console.log('✅ [Low Stock Lists] Detailed sections displayed');
              } else {
                detailedSections.style.display = 'none';
                console.log(
                  '⚠️ [Low Stock Lists] Detailed sections hidden (no items)');
              }
            }
          })
          .catch(err => console.error('❌ [Low Stock Lists] Error:', err));
      }

      // Render low stock list
      function renderLowStockList(type, items) {
        const listId = type === 'food' ? 'lowStockFoodList' :
          'lowStockDrinksList';
        const list = document.getElementById(listId);

        if (items.length === 0) {
          list.innerHTML =
            '<div class="col-span-full text-center py-8 text-white/60"><i class="fas fa-check-circle text-4xl mb-2"></i><p>جميع الأصناف متوفرة بكميات كافية!</p></div>';
          return;
        }

        list.innerHTML = items.map(item => `
          <div class="bg-white/10 rounded-xl p-4 border border-white/20 hover:bg-white/15 transition low-stock-item">
            <div class="flex justify-between items-start mb-3">
              <h5 class="font-bold text-white text-base item-name">${item.name}</h5>
              <span class="bg-red-500 text-white px-2 py-1 rounded text-xs font-bold">${item.stock || 0}</span>
            </div>
            <p class="text-white/70 text-sm mb-3">السعر: ${parseFloat(item.price).toFixed(2)} ${CURRENCY_SYMBOL}</p>
            ${item.drink_type ? `<p class=\"text-white/70 text-xs mb-3\">${item.drink_type}</p>` : ''}
            ${canManageInventory ? `
              <button onclick=\"openStockModal('${type}', ${item.id}, '${item.name.replace(/'/g, "\\'")}', ${item.stock || 0})\"
                class=\"w-full bg-gradient-to-r from-blue-500 to-blue-600 hover:from-blue-600 hover:to-blue-700 text-white font-bold py-2 px-3 rounded-lg transition text-sm\">
                <i class=\"fas fa-plus mr-1\"></i>توريد
            </button>
            ` : ''}
          </div>
        `).join('');
      }

      // Search low stock items
      function searchLowStockItems(type) {
        const searchInputId = type === 'food' ? 'searchLowStockFood' :
          'searchLowStockDrinks';
        const listId = type === 'food' ? 'lowStockFoodList' :
          'lowStockDrinksList';

        const searchTerm = document.getElementById(searchInputId).value
          .toLowerCase().trim();
        const items = document.querySelectorAll(`#${listId} .low-stock-item`);

        items.forEach(item => {
          const itemName = item.querySelector('.item-name').textContent
            .toLowerCase();
          if (itemName.includes(searchTerm)) {
            item.style.display = '';
          } else {
            item.style.display = 'none';
          }
        });
      }

      // Scroll to low stock section
      function scrollToLowStockSection(type) {
        const sectionId = type === 'food' ? 'lowStockFoodSection' :
          'lowStockDrinksSection';
        const section = document.getElementById(sectionId);
        section.scrollIntoView({
          behavior: 'smooth',
          block: 'start'
        });
      }

      // Open stock update modal
      function openStockModal(type, itemId, itemName, currentStock) {
        if (!canManageInventory) {
          showSuccessNotification('ليس لديك صلاحية إدارة المخزون', 'error');
          return;
        }
        const modal = document.getElementById('stockUpdateModal');
        document.getElementById('modalItemType').value = type;
        document.getElementById('modalItemId').value = itemId;
        document.getElementById('modalItemName').textContent = itemName;
        document.getElementById('modalCurrentStock').textContent = currentStock;
        document.getElementById('newStockInput').value = currentStock;
        modal.style.display = 'flex';
      }

      // Close stock modal
      function closeStockModal() {
        document.getElementById('stockUpdateModal').style.display = 'none';
      }

      // Update stock
      function updateStock() {
        const type = document.getElementById('modalItemType').value;
        const itemId = parseInt(document.getElementById('modalItemId').value);
        const newStock = parseInt(document.getElementById('newStockInput').value);

        if (newStock < 0) {
          showSuccessNotification('الكمية يجب أن تكون صفر أو أكبر', 'error');
          return;
        }

        fetch('api/inventory-status.php?action=update_stock', {
            method: 'POST',
            headers: {
              'Content-Type': 'application/json'
            },
            body: JSON.stringify({
              item_type: type === 'drinks' ? 'drink' : type,
              item_id: itemId,
              new_stock: newStock
            })
          })
          .then(response => response.json())
          .then(data => {
            if (data.success) {
              showSuccessNotification(data.message);
              closeStockModal();
              // Reload low stock data
              setTimeout(loadLowStockData, 500);
            } else {
              showSuccessNotification(data.error || 'حدث خطأ أثناء التحديث',
                'error');
            }
          })
          .catch(err => {
            showSuccessNotification('حدث خطأ في الاتصال', 'error');
          });
      }

      // Toggle Accordion for Low Stock Sections
      function toggleAccordion(accordionId) {
        const accordion = document.getElementById(accordionId);
        const icon = document.getElementById(accordionId + 'Icon');

        if (accordion.style.maxHeight && accordion.style.maxHeight !== '0px') {
          // Close
          accordion.style.maxHeight = '0px';
          icon.style.transform = 'rotate(0deg)';
        } else {
          // Open
          accordion.style.maxHeight = accordion.scrollHeight + 'px';
          icon.style.transform = 'rotate(180deg)';
        }
      }

      // دالة عرض كارت إنشاء جلسة كافيه
      function showCreateCafeModal() {
        const modal = document.createElement('div');
        modal.id = 'createCafeModal';
        modal.className =
          'fixed inset-0 bg-black/70 backdrop-blur-sm z-50 flex items-center justify-center p-4';
        modal.style.display = 'flex';
        modal.onclick = function(e) {
          if (e.target === modal) {
            closeCreateCafeModal();
          }
        };

        modal.innerHTML = `
          <div class="bg-gradient-to-br from-amber-50 via-orange-50 to-yellow-50 rounded-3xl shadow-2xl w-full max-w-md transform transition-all duration-300 scale-100 animate-scaleIn border-2 border-amber-200">
            <div class="bg-gradient-to-r from-amber-500 to-orange-500 text-white p-6 rounded-t-3xl relative overflow-hidden">
              <div class="absolute inset-0 bg-black/10"></div>
              <div class="relative z-10 flex items-center justify-between">
                <div class="flex items-center gap-3">
                  <div class="w-12 h-12 bg-white/25 rounded-full flex items-center justify-center backdrop-blur-sm">
                    <i class="fas fa-coffee text-2xl"></i>
                  </div>
                  <div>
                    <h3 class="text-2xl font-bold">إنشاء جلسة كافيه جديدة</h3>
                    <p class="text-amber-100 text-sm">ابدأ جلسة كافيه جديدة للطلبات</p>
                  </div>
                </div>
                <button onclick="closeCreateCafeModal()" class="text-white hover:text-amber-200 transition-all hover:scale-110">
                  <i class="fas fa-times text-xl"></i>
                </button>
              </div>
            </div>

            <div class="p-6">
              <div class="bg-white/80 rounded-2xl p-6 mb-4 border border-amber-200">
                <div class="flex items-center gap-3 mb-4">
                  <i class="fas fa-info-circle text-amber-500 text-xl"></i>
                  <p class="text-gray-700 font-semibold">هل تريد إنشاء جلسة كافيه جديدة؟</p>
                </div>
                <p class="text-gray-600 text-sm">سيتم إنشاء جلسة كافيه بدون ربط بغرفة، ويمكنك إضافة طلبات مباشرة.</p>
              </div>

              <div class="flex gap-3">
                <button onclick="closeCreateCafeModal()"
                  class="flex-1 bg-gray-200 hover:bg-gray-300 text-gray-700 font-bold py-3 px-6 rounded-xl transition-all transform hover:scale-105">
                  <i class="fas fa-times ml-2"></i>إلغاء
                </button>
                <button onclick="confirmCreateCafe()"
                  class="flex-1 bg-gradient-to-r from-amber-500 to-orange-500 hover:from-amber-600 hover:to-orange-600 text-white font-bold py-3 px-6 rounded-xl transition-all transform hover:scale-105 shadow-lg">
                  <i class="fas fa-check ml-2"></i>تأكيد
                </button>
              </div>
            </div>
          </div>
        `;

        document.body.appendChild(modal);

        // إضافة animation
        setTimeout(() => {
          modal.querySelector('.animate-scaleIn').style.animation =
            'scaleIn 0.3s ease-out';
        }, 10);
      }

      function closeCreateCafeModal() {
        const modal = document.getElementById('createCafeModal');
        if (modal) {
          modal.style.opacity = '0';
          modal.style.transform = 'scale(0.9)';
          setTimeout(() => modal.remove(), 300);
        }
      }

      // دالة تأكيد إنشاء جلسة كافيه
      function confirmCreateCafe() {
        closeCreateCafeModal();
        // عرض كارت إدخال اسم الكافيه
        setTimeout(() => showCafeNameForm(), 300);
      }

      // دالة عرض كارت إدخال اسم الكافيه
      function showCafeNameForm() {
        const modal = document.createElement('div');
        modal.id = 'cafeNameModal';
        modal.className =
          'fixed inset-0 bg-black/70 backdrop-blur-sm z-50 flex items-center justify-center p-4';
        modal.style.display = 'flex';
        modal.onclick = function(e) {
          if (e.target === modal) {
            closeCafeNameModal();
          }
        };

        modal.innerHTML = `
          <div class="bg-gradient-to-br from-amber-50 via-orange-50 to-yellow-50 rounded-3xl shadow-2xl w-full max-w-md transform transition-all duration-300 scale-100 animate-scaleIn border-2 border-amber-200">
            <div class="bg-gradient-to-r from-amber-500 to-orange-500 text-white p-6 rounded-t-3xl relative overflow-hidden">
              <div class="absolute inset-0 bg-black/10"></div>
              <div class="relative z-10 flex items-center justify-between">
                <div class="flex items-center gap-3">
                  <div class="w-12 h-12 bg-white/25 rounded-full flex items-center justify-center backdrop-blur-sm">
                    <i class="fas fa-user text-2xl"></i>
                  </div>
                  <div>
                    <h3 class="text-2xl font-bold">إدخال اسم العميل</h3>
                    <p class="text-amber-100 text-sm">(اختياري - يمكنك تخطي هذا)</p>
                  </div>
                </div>
                <button onclick="closeCafeNameModal()" class="text-white hover:text-amber-200 transition-all hover:scale-110">
                  <i class="fas fa-times text-xl"></i>
                </button>
              </div>
            </div>

            <form id="cafeNameForm" onsubmit="submitCafeName(event)" class="p-6">
              <div class="mb-4">
                <label class="block text-gray-700 font-semibold mb-2">
                  <i class="fas fa-user text-amber-500 ml-2"></i>
                  اسم العميل (اختياري)
                </label>
                <input type="text"
                  id="cafeCustomerName"
                  name="customer_name"
                  placeholder="أدخل اسم العميل أو اتركه فارغاً"
                  class="w-full bg-white border-2 border-amber-200 rounded-xl px-4 py-3 text-gray-700 focus:outline-none focus:ring-2 focus:ring-amber-500 focus:border-transparent transition-all"
                  autocomplete="off">
                <p class="text-gray-500 text-xs mt-2">
                  <i class="fas fa-info-circle ml-1"></i>
                  يمكنك تخطي هذا الحقل وإنشاء جلسة بدون اسم عميل
                </p>
              </div>

              <div class="flex gap-3">
                <button type="button" onclick="closeCafeNameModal()"
                  class="flex-1 bg-gray-200 hover:bg-gray-300 text-gray-700 font-bold py-3 px-6 rounded-xl transition-all transform hover:scale-105">
                  <i class="fas fa-times ml-2"></i>إلغاء
                </button>
                <button type="button" onclick="createCafeSessionWithoutName()"
                  class="flex-1 bg-gray-300 hover:bg-gray-400 text-gray-700 font-bold py-3 px-6 rounded-xl transition-all transform hover:scale-105">
                  <i class="fas fa-forward ml-2"></i>تخطي
                </button>
                <button type="submit"
                  class="flex-1 bg-gradient-to-r from-amber-500 to-orange-500 hover:from-amber-600 hover:to-orange-600 text-white font-bold py-3 px-6 rounded-xl transition-all transform hover:scale-105 shadow-lg">
                  <i class="fas fa-check ml-2"></i>إنشاء
                </button>
              </div>
            </form>
          </div>
        `;

        document.body.appendChild(modal);

        // Focus على حقل الإدخال
        setTimeout(() => {
          document.getElementById('cafeCustomerName').focus();
        }, 100);
      }

      function closeCafeNameModal() {
        const modal = document.getElementById('cafeNameModal');
        if (modal) {
          modal.style.opacity = '0';
          modal.style.transform = 'scale(0.9)';
          setTimeout(() => modal.remove(), 300);
        }
      }

      // دالة إنشاء جلسة كافيه بدون اسم
      async function createCafeSessionWithoutName() {
        await createCafeSession(null);
      }

      // دالة إرسال فورم اسم الكافيه
      async function submitCafeName(event) {
        event.preventDefault();
        const customerName = document.getElementById('cafeCustomerName').value
          .trim();

        // إذا لم يتم إدخال اسم، إنشاء جلسة بدون عميل
        if (!customerName) {
          await createCafeSession(null);
          return;
        }

        // البحث عن customer_id من الاسم (اختياري - يمكن تخطيه)
        let customer_id = null;
        try {
          // محاولة البحث عن عميل موجود أو إنشاء جديد
          // إذا لم يكن API موجوداً، سنستخدم null (بدون عميل)
          try {
            const searchResponse = await fetch(
              'api/customers.php?action=search&name=' + encodeURIComponent(
                customerName));
            if (searchResponse.ok) {
              const searchData = await searchResponse.json();
              if (searchData.success && searchData.customers && searchData
                .customers.length > 0) {
                customer_id = searchData.customers[0].id;
              } else {
                // محاولة إنشاء عميل جديد
                const createResponse = await fetch('api/customers.php', {
                  method: 'POST',
                  headers: {
                    'Content-Type': 'application/json'
                  },
                  body: JSON.stringify({
                    action: 'create',
                    name: customerName
                  })
                });
                if (createResponse.ok) {
                  const createData = await createResponse.json();
                  if (createData.success && createData.customer_id) {
                    customer_id = createData.customer_id;
                  }
                }
              }
            }
          } catch (apiError) {
            console.log(
              'Customer API not available, proceeding without customer ID');
            // المتابعة بدون customer_id إذا لم يكن API موجوداً
          }
        } catch (e) {
          console.error('Error handling customer:', e);
          // المتابعة بدون عميل إذا فشل البحث
        }

        await createCafeSession(customer_id);
      }

      // دالة إنشاء جلسة كافيه
      async function createCafeSession(customer_id) {
        closeCafeNameModal();

        try {
          const response = await fetch('api/cafe-actions.php', {
            method: 'POST',
            headers: {
              'Content-Type': 'application/json'
            },
            body: JSON.stringify({
              action: 'create_cafe_session',
              customer_id: customer_id
            })
          });

          const result = await response.json();

          if (result.success) {
            showSuccessNotification('تم إنشاء جلسة الكافيه بنجاح!', 'success');
            // إعادة تحميل الصفحة بعد ثانية
            setTimeout(() => {
              window.location.href = 'orders.php?session_id=' + result
                .session_id;
            }, 1000);
          } else {
            console.error('Cafe session creation failed:', result);
            const errorMsg = result.error || result.details || 'فشل في إنشاء جلسة الكافيه';
            showSuccessNotification(errorMsg, 'error');
          }
        } catch (error) {
          console.error('Error creating cafe session:', error);
          showSuccessNotification('حدث خطأ أثناء إنشاء جلسة الكافيه: ' + error.message,
            'error');
        }
      }

      // Custom success notification
      function showSuccessNotification(message, type = 'success') {
        const notification = document.createElement('div');
        notification.className = 'success-notification';

        const bgColor = type === 'success' ? 'from-emerald-500 to-green-600' :
          'from-red-500 to-red-600';
        const icon = type === 'success' ? 'fa-check-circle' :
          'fa-exclamation-circle';

        notification.innerHTML = `
        <div class="bg-gradient-to-r ${bgColor} text-white px-8 py-6 rounded-2xl shadow-2xl border-2 border-white/30 backdrop-blur-md min-w-[300px] max-w-[90vw]">
          <div class="flex items-center gap-4">
            <i class="fas ${icon} text-4xl"></i>
            <div>
              <p class="font-bold text-lg mb-1">${type === 'success' ? 'نجاح!' : 'خطأ!'}</p>
              <p class="text-sm">${message}</p>
            </div>
          </div>
        </div>
      `;

        document.body.appendChild(notification);

        setTimeout(() => {
          notification.style.opacity = '0';
          notification.style.transform = 'translate(-50%, -50%) scale(0.8)';
          notification.style.transition = 'all 0.3s ease-out';
          setTimeout(() => notification.remove(), 300);
        }, 2000);
      }

      /**
       * يدمج خصم الفاتورة من حقل الصفحة في بيانات المعاينة (المودال كان يعرض إجمالي الخادم فقط بدون خصم).
       */
      function mergeCafeClientDiscountPreview(sessionData) {
        const inp = document.getElementById('cafeDiscountInput');
        const raw = inp ? parseFloat(inp.value) : 0;
        const inputVal = (isNaN(raw) || raw < 0) ? 0 : raw;
        const base = parseFloat(
          sessionData.total_amount != null ? sessionData.total_amount : (sessionData.orders_cost || 0)
        );
        let dtype = (typeof _cafeDiscountType !== 'undefined')
          ? _cafeDiscountType
          : (window.__cafeDiscountTypeGlobal || 'percentage');
        let discAmt = 0;
        if (inputVal > 0 && base > 0) {
          if (dtype === 'percentage') {
            discAmt = base * (inputVal / 100);
          } else {
            discAmt = Math.min(inputVal, base);
          }
        }
        discAmt = Math.round(discAmt * 100) / 100;
        const finalT = Math.max(0, Math.round((base - discAmt) * 100) / 100);
        const oc = sessionData.orders_cost != null ? parseFloat(sessionData.orders_cost) : base;
        if (inputVal <= 0 || discAmt <= 0) {
          return {
            ...sessionData,
            base_total: base,
            orders_cost: oc
          };
        }
        return {
          ...sessionData,
          base_total: base,
          total_amount: finalT,
          discount_input: inputVal,
          discount_amount: discAmt,
          discount_type: dtype,
          orders_cost: oc
        };
      }

      // دالة إنهاء جلسة الكافيه
      async function endCafeSession(sessionId) {
        if (!sessionId) {
          showSuccessNotification('خطأ: لم يتم العثور على معرف الجلسة',
            'error');
          return;
        }

        // تأكيد من المستخدم
        const confirmed = await Swal.fire({
          title: 'إنهاء جلسة الكافيه',
          text: 'هل تريد إنهاء جلسة الكافيه وطباعة الإيصال؟',
          icon: 'question',
          showCancelButton: true,
          confirmButtonText: 'نعم، أنهي الجلسة',
          cancelButtonText: 'إلغاء',
          confirmButtonColor: '#f59e0b',
          cancelButtonColor: '#6b7280'
        });

        if (!confirmed.isConfirmed) {
          return;
        }

        try {
          // عرض معاينة إنهاء الجلسة
          const previewResponse = await fetch('api/session-actions.php', {
            method: 'POST',
            headers: {
              'Content-Type': 'application/json'
            },
            body: JSON.stringify({
              action: 'preview_end_session',
              session_id: sessionId
            })
          });

          const previewResult = await previewResponse.json();

          if (!previewResult.success) {
            showSuccessNotification(previewResult.message ||
              'فشل في معاينة جلسة الكافيه', 'error');
            return;
          }

          // تحضير البيانات للإيصال (استخدام البيانات من previewResult)
          let sessionDataForReceipt = {
            ...previewResult,
            session_id: sessionId,
            is_cafe: true,
            session_category: 'cafe',
            room_name: 'كافيه',
            start_time: previewResult.start_time || new Date().toISOString(),
            end_time: new Date().toISOString(),
            orders: previewResult.orders || [],
            orders_details: previewResult.orders || [],
            customer_name: previewResult.customer_name || 'عميل',
            // إضافة حقول إضافية قد تكون مطلوبة
            duration_hours: 0,
            duration_minutes: 0,
            hourly_rate: 0,
            current_amount: 0,
            session_amount: 0,
            accumulated_amount: 0
          };

          sessionDataForReceipt = mergeCafeClientDiscountPreview(sessionDataForReceipt);

          // عرض الإيصال الكامل (مع الخصم كما في شريط إجمالي الطلبات)
          showCafeSessionSummaryCard(sessionDataForReceipt, sessionId);
        } catch (error) {
          console.error('Error ending cafe session:', error);
          showSuccessNotification('حدث خطأ أثناء إنهاء الجلسة: ' + error
            .message, 'error');
        }
      }

      // دالة عرض إيصال جلسة الكافيه الكامل (مطابق لإيصال sessions.php)
      function showCafeSessionSummaryCard(sessionData, sessionId) {
        // إشعار نظام الطابور بأن النظام مشغول
        if (window.NotificationQueue) {
          window.NotificationQueue.setBusyState(true);
        }

        // تحديد نوع الجلسة
        const isCafe = sessionData.is_cafe ||
          (sessionData.session_category === 'cafe') ||
          (sessionData.room_name === 'كافيه');

        // تحضير تفاصيل الطلبات
        const ordersArray = sessionData.orders || sessionData.orders_details || [];
        let ordersDetailsHtml = '';

        if (ordersArray.length > 0) {
          ordersDetailsHtml = `
            <div class="mt-6">
              <h4 class="text-lg font-bold text-gray-800 mb-4 flex items-center">
                <i class="fas fa-list-alt text-purple-500 mr-2"></i>
                تفاصيل الطلبات
              </h4>
              <div class="space-y-3">
                ${ordersArray.map(order => {
                  const itemName = order.item_name_full || order.order_name || order.item_name || order.name || 'طلب';
                  const itemType = order.item_type || 'food';
                  const itemTypeName = order.item_type_name || (itemType === 'food' ? 'طعام' : 'مشروب');
                  const quantity = parseInt(order.quantity || 1);
                  const price = parseFloat(order.price || 0);
                  const total = price * quantity;
                  const drinkType = order.drink_type || '';

                  return `
                    <div class="bg-gray-50 rounded-lg p-4 border border-gray-200">
                      <div class="flex justify-between items-start">
                        <div class="flex-1">
                          <div class="flex items-center mb-2 flex-wrap gap-2">
                            <span class="font-medium text-gray-800">${itemName}</span>
                            <span class="bg-blue-100 text-blue-800 text-xs px-2 py-1 rounded-full">
                              ${itemTypeName}
                            </span>
                            ${drinkType ? `
                              <span class="bg-green-100 text-green-800 text-xs px-2 py-1 rounded-full">
                                ${drinkType}
                              </span>
                            ` : ''}
                          </div>
                          <div class="text-sm text-gray-600">
                            الكمية: <span class="font-medium">${quantity}</span>
                          </div>
                        </div>
                        <div class="text-right">
                          <div class="text-lg font-bold text-green-600">
                            ${total.toFixed(2)} ${CURRENCY_SYMBOL}
                          </div>
                          <div class="text-sm text-gray-500">
                            ${price.toFixed(2)} ${CURRENCY_SYMBOL} للوحدة
                          </div>
                        </div>
                      </div>
                    </div>
                  `;
                }).join('')}
              </div>
            </div>
          `;
        }

        // إنشاء HTML للكارت
        const cardHTML = `
          <div class="fixed inset-0 bg-black bg-opacity-60 flex items-center justify-center z-50 p-4" id="cafeSessionSummaryModal" data-session-id="${sessionId}" style="position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.6); display: flex; align-items: center; justify-content: center; z-index: 20000;">
            <div class="bg-white rounded-3xl shadow-2xl w-full max-w-4xl max-h-[90vh] overflow-hidden transform transition-all duration-300 scale-100 animate-scaleIn flex flex-col" style="background: white; border-radius: 24px; box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25); width: 100%; max-width: 896px; max-height: 90vh; overflow: hidden; transform: scale(1); transition: all 0.3s; display: flex; flex-direction: column;">
              <!-- Header -->
              <div class="bg-gradient-to-br from-amber-500 via-orange-500 to-yellow-500 text-white p-6 sm:p-8 relative overflow-hidden flex-shrink-0">
                <div class="absolute inset-0 bg-black bg-opacity-10"></div>
                <div class="relative z-10">
                  <div class="flex items-center justify-between">
                    <div class="flex items-center space-x-4 space-x-reverse flex-1 min-w-0">
                      <div class="w-12 h-12 sm:w-16 sm:h-16 bg-white bg-opacity-25 rounded-full flex items-center justify-center backdrop-blur-sm flex-shrink-0">
                        <i class="fas fa-coffee text-2xl sm:text-3xl text-white"></i>
                      </div>
                      <div class="min-w-0">
                        <h2 class="text-xl sm:text-2xl md:text-3xl font-bold mb-1 sm:mb-2 truncate">تم إنهاء جلسة الكافيه بنجاح</h2>
                        <p class="text-amber-100 text-sm sm:text-lg truncate">تفاصيل جلسة الكافيه المكتملة</p>
                      </div>
                    </div>
                    <button onclick="closeCafeSessionSummary(event)" type="button" class="text-white hover:text-gray-200 transition-all duration-300 hover:scale-110 bg-red-500 hover:bg-red-600 rounded-full p-2 sm:p-3 backdrop-blur-sm flex-shrink-0 ml-2" style="background-color: #ef4444; cursor: pointer;" title="إغلاق">
                      <i class="fas fa-times text-lg sm:text-xl"></i>
                    </button>
                  </div>
                </div>
                <!-- Decorative elements -->
                <div class="absolute top-0 right-0 w-32 h-32 bg-white bg-opacity-10 rounded-full -translate-y-16 translate-x-16"></div>
                <div class="absolute bottom-0 left-0 w-24 h-24 bg-white bg-opacity-10 rounded-full translate-y-12 -translate-x-12"></div>
              </div>

              <!-- Content - Scrollable -->
              <div class="p-4 sm:p-8 overflow-y-auto flex-1" style="overflow-y: auto; -webkit-overflow-scrolling: touch;">
                <!-- معلومات الجلسة -->
                <div class="bg-gradient-to-br from-amber-50 to-orange-100 rounded-2xl p-6 border border-amber-200 shadow-lg mb-8">
                  <div class="flex items-center mb-4">
                    <div class="w-10 h-10 bg-amber-500 rounded-full flex items-center justify-center mr-3">
                      <i class="fas fa-coffee text-white"></i>
                    </div>
                    <h3 class="text-lg font-bold text-gray-800">معلومات جلسة الكافيه</h3>
                  </div>
                  <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                    <div class="text-center">
                      <div class="text-sm text-gray-600 mb-1">رقم الجلسة</div>
                      <div class="font-bold text-blue-600">#${sessionId}</div>
                    </div>
                    <div class="text-center">
                      <div class="text-sm text-gray-600 mb-1">النوع</div>
                      <div class="font-bold text-gray-800">${sessionData.room_name || 'كافيه'}</div>
                    </div>
                    <div class="text-center">
                      <div class="text-sm text-gray-600 mb-1">العميل</div>
                      <div class="font-bold text-gray-800">${sessionData.customer_name || 'عميل'}</div>
                    </div>
                    <div class="text-center">
                      <div class="text-sm text-gray-600 mb-1">وقت البداية</div>
                      <div class="font-bold text-gray-800">${sessionData.start_time ? new Date(sessionData.start_time).toLocaleTimeString('ar-EG', {hour: '2-digit', minute: '2-digit'}) : '-'}</div>
                    </div>
                    <div class="text-center">
                      <div class="text-sm text-gray-600 mb-1">وقت الانتهاء</div>
                      <div class="font-bold text-gray-800">${new Date().toLocaleTimeString('ar-EG', {hour: '2-digit', minute: '2-digit'})}</div>
                    </div>
                  </div>
                </div>

                <!-- تفاصيل الحساب -->
                <div class="bg-gradient-to-br from-purple-50 via-pink-50 to-rose-50 rounded-2xl p-8 mb-8 border border-purple-200 shadow-lg">
                  <div class="flex items-center justify-center mb-6">
                    <div class="w-12 h-12 bg-gradient-to-r from-purple-500 to-pink-500 rounded-full flex items-center justify-center mr-3">
                      <i class="fas fa-calculator text-white text-xl"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-800">تفاصيل الحساب</h3>
                  </div>
                  <div class="space-y-4">
                    ${(sessionData.orders_cost || 0) > 0 ? `
                    <div class="flex justify-between items-center py-4 bg-green-50 rounded-lg px-4">
                      <div class="flex items-center">
                        <i class="fas fa-coffee text-green-500 mr-3"></i>
                        <span class="text-gray-700 font-medium">إجمالي الطلبات:</span>
                      </div>
                      <span class="text-green-600 font-bold text-xl">${parseFloat(sessionData.orders_cost || 0).toFixed(2)} ${CURRENCY_SYMBOL}</span>
                    </div>
                    ` : ''}
                    ${ordersDetailsHtml}
                  </div>
                </div>

                <!-- الإجمالي النهائي -->
                <div class="bg-gradient-to-br from-emerald-500 via-teal-500 to-cyan-600 text-white rounded-2xl p-8 text-center relative overflow-hidden shadow-2xl">
                  <div class="absolute inset-0 bg-black bg-opacity-10"></div>
                  <div class="relative z-10">
                    <div class="flex items-center justify-center mb-4">
                      <div class="w-16 h-16 bg-white bg-opacity-25 rounded-full flex items-center justify-center backdrop-blur-sm">
                        <i class="fas fa-money-bill-wave text-3xl"></i>
                      </div>
                    </div>
                    <h3 class="text-2xl font-bold mb-4">الإجمالي النهائي</h3>
                    <div id="cafeModalDiscountSection" style="${(parseFloat(sessionData.discount_amount || 0) > 0) ? '' : 'display:none;'}">
                      <div id="cafeModalBaseLine" style="font-size:1rem; margin-bottom:8px; color:#fde68a; display:flex; align-items:center; justify-content:center; gap:8px;">
                        <i class="fas fa-tag"></i>
                        <span>قبل الخصم: <span id="cafeModalBaseTotal">${parseFloat(sessionData.base_total || sessionData.total_amount).toFixed(2)}</span> ${CURRENCY_SYMBOL}</span>
                      </div>
                      <div style="font-size:1.05rem; margin-bottom:10px; background:rgba(255,255,255,0.15); border-radius:10px; padding:5px 14px; display:inline-block;">
                        <i class="fas fa-minus-circle" style="color:#fca5a5;"></i>
                        <span id="cafeModalDiscountLine">خصم: <span id="cafeModalDiscountAmount">${parseFloat(sessionData.discount_amount || 0).toFixed(2)}</span> ${CURRENCY_SYMBOL}<span id="cafeModalDiscountPct">${sessionData.discount_type === 'percentage' && sessionData.discount_input ? ` (${sessionData.discount_input}%)` : ''}</span></span>
                      </div>
                    </div>
                    <div id="cafeModalFinalTotal" class="text-4xl font-bold mb-4 text-shadow-lg">${parseFloat(sessionData.total_amount || 0).toFixed(2)} ${CURRENCY_SYMBOL}</div>
                    <p class="text-emerald-100 text-xl">شكراً لاستخدامك خدماتنا</p>
                  </div>
                  <!-- Decorative elements -->
                  <div class="absolute top-0 right-0 w-40 h-40 bg-white bg-opacity-10 rounded-full -translate-y-20 translate-x-20"></div>
                  <div class="absolute bottom-0 left-0 w-32 h-32 bg-white bg-opacity-10 rounded-full translate-y-16 -translate-x-16"></div>
                </div>
              </div>

              <!-- Footer - Fixed at bottom -->
              <div style="padding-top: 6px;" class="bg-gradient-to-r from-gray-50 to-gray-100 px-3 sm:px-6 py-3 sm:py-4 border-t border-gray-200 flex-shrink-0" style="position: sticky; bottom: 0; background: linear-gradient(to right, #f9fafb, #f3f4f6); border-top: 1px solid #e5e7eb; z-index: 10;">
                <!-- Grid Layout للأزرار - responsive -->
                <div class="grid grid-cols-3 gap-2 sm:gap-3">
                  <!-- زر التراجع عن الإنتهاء (X) -->
                  <button onclick="revertCafeSessionEnding()" id="btnRevertCafeSession" class="px-2 sm:px-4 md:px-6 py-2 sm:py-2.5 md:py-3 bg-red-500 text-white rounded-lg sm:rounded-xl hover:bg-red-600 transition-all duration-300 hover:scale-105 shadow-lg font-medium text-xs sm:text-sm md:text-base flex items-center justify-center">
                    <i class="fas fa-times ml-1 sm:ml-2"></i>
                    <span class="hidden sm:inline">تراجع</span>
                  </button>

                  <!-- زر الطباعة -->
                  <button onclick="showCafePrintOptionsModal()" class="px-2 sm:px-4 md:px-6 py-2 sm:py-2.5 md:py-3 bg-gradient-to-r from-blue-500 to-blue-600 text-white rounded-lg sm:rounded-xl hover:from-blue-600 hover:to-blue-700 transition-all duration-300 hover:scale-105 shadow-lg font-medium text-xs sm:text-sm md:text-base flex items-center justify-center">
                    <i class="fas fa-print ml-1 sm:ml-2"></i>
                    <span class="hidden sm:inline">طباعة</span>
                  </button>

                  <!-- زر تأكيد الإنتهاء -->
                  <button onclick="confirmAndFinalizeCafeSession()" id="btnFinalizeCafeSession" class="px-2 sm:px-4 md:px-6 py-2 sm:py-2.5 md:py-3 bg-gradient-to-r from-emerald-500 to-emerald-600 text-white rounded-lg sm:rounded-xl hover:from-emerald-600 hover:to-emerald-700 transition-all duration-300 hover:scale-105 shadow-lg font-medium text-xs sm:text-sm md:text-base flex items-center justify-center">
                    <i class="fas fa-check-circle ml-1 sm:ml-2"></i>
                    <span class="hidden sm:inline">تأكيد</span>
                    <span class="sm:hidden">✓</span>
                  </button>
                </div>
              </div>
            </div>
          </div>
        `;

        // حفظ sessionId وبيانات الجلسة في متغيرات عامة
        window.currentCafeSessionId = sessionId;
        window.currentCafeSessionData = sessionData;

        // إضافة CSS للكارت
        const style = document.createElement('style');
        style.textContent = `
          #cafeSessionSummaryModal {
            position: fixed !important;
            top: 0 !important;
            left: 0 !important;
            width: 100% !important;
            height: 100% !important;
            background: rgba(0,0,0,0.6) !important;
            display: flex !important;
            align-items: center !important;
            justify-content: center !important;
            z-index: 20000 !important;
            padding: 1rem !important;
          }
          #cafeSessionSummaryModal > div {
            display: flex !important;
            flex-direction: column !important;
            max-height: 90vh !important;
          }
          .swal2-container {
            z-index: 19999 !important;
          }
          .swal2-backdrop {
            z-index: 19998 !important;
          }
          #cafeSessionSummaryModal * {
            z-index: 20001 !important;
          }
          /* تحسين التمرير على الأجهزة المحمولة */
          @media (max-width: 640px) {
            #cafeSessionSummaryModal {
              padding: 0.5rem !important;
            }
            #cafeSessionSummaryModal > div {
              max-height: 95vh !important;
            }
          }
        `;
        document.head.appendChild(style);

        // إضافة الكارت إلى الصفحة
        document.body.insertAdjacentHTML('beforeend', cardHTML);

        // التحقق من وجود الكارت
        const modal = document.getElementById('cafeSessionSummaryModal');
        if (modal) {
          modal.style.display = 'flex';
        }
      }

      // دالة التراجع عن إنهاء جلسة الكافيه (X)
      async function revertCafeSessionEnding() {
        const sessionId = window.currentCafeSessionId;

        if (!sessionId) {
          showSuccessNotification('خطأ: لم يتم العثور على معرف الجلسة',
            'error');
          return;
        }

        // تعطيل الزر لمنع النقر المزدوج
        const btn = document.getElementById('btnRevertCafeSession');
        if (btn) {
          btn.disabled = true;
          btn.innerHTML = '<i class="fas fa-spinner fa-spin ml-1 sm:ml-2"></i><span class="hidden sm:inline">جاري التراجع...</span>';
        }

        // إعادة تفعيل الجلسة مباشرة
        try {
          const response = await fetch('api/session-actions.php', {
            method: 'POST',
            headers: {
              'Content-Type': 'application/json'
            },
            body: JSON.stringify({
              action: 'resume_session_after_preview',
              session_id: sessionId
            })
          });

          const result = await response.json();

          if (result.success) {
            showSuccessNotification('✅ تم التراجع عن إنهاء جلسة الكافيه بنجاح',
              'success');

            // إغلاق المودال وإعادة تحميل الصفحة
            const modal = document.getElementById('cafeSessionSummaryModal');
            if (modal) {
              modal.style.opacity = '0';
              modal.style.transform = 'scale(0.9)';
              setTimeout(() => {
                modal.remove();
                if (window.NotificationQueue) {
                  window.NotificationQueue.setBusyState(false);
                }
                // إعادة تحميل الصفحة بدون parameters
                window.location.href = window.location.pathname;
              }, 300);
            }
          } else {
            throw new Error(result.message || 'فشل في التراجع عن إنهاء الجلسة');
          }
        } catch (error) {
          showSuccessNotification('خطأ: ' + error.message, 'error');
          console.error('Revert error:', error);

          // إعادة تفعيل الزر عند حدوث خطأ
          if (btn) {
            btn.disabled = false;
            btn.innerHTML = '<i class="fas fa-times ml-1 sm:ml-2"></i><span class="hidden sm:inline">تراجع</span>';
          }
        }
      }

      // دالة إغلاق إيصال الكافيه (للأزرار الأخرى مثل X في الـ header)
      function closeCafeSessionSummary(event) {
        if (event) {
          event.preventDefault();
          event.stopPropagation();
        }
        const modal = document.getElementById('cafeSessionSummaryModal');
        if (modal) {
          modal.style.opacity = '0';
          modal.style.transition = 'opacity 0.3s ease, transform 0.3s ease';
          modal.style.transform = 'scale(0.9)';
          setTimeout(() => {
            modal.remove();
            if (window.NotificationQueue) {
              window.NotificationQueue.setBusyState(false);
            }
          }, 300);
        }
      }

      /** تحديث مودال الإيصال بعد التثبيت النهائي (المبالغ كما أعادها الخادم) */
      function applyCafeFinalizeToModal(result) {
        if (!result) return;
        const finalEl = document.getElementById('cafeModalFinalTotal');
        if (finalEl) {
          finalEl.textContent = parseFloat(result.total_amount || 0).toFixed(2) + ' ' + CURRENCY_SYMBOL;
        }
        const section = document.getElementById('cafeModalDiscountSection');
        const disc = parseFloat(result.discount_amount || 0);
        if (section) {
          if (disc > 0) {
            section.style.display = '';
            const baseEl = document.getElementById('cafeModalBaseTotal');
            const discAmtEl = document.getElementById('cafeModalDiscountAmount');
            const pctEl = document.getElementById('cafeModalDiscountPct');
            const base = parseFloat(result.base_total != null ? result.base_total : (result.total_amount || 0) + disc);
            if (baseEl) baseEl.textContent = base.toFixed(2);
            if (discAmtEl) discAmtEl.textContent = disc.toFixed(2);
            if (pctEl) {
              pctEl.textContent = (result.discount_type === 'percentage' && result.discount_input != null)
                ? ' (' + result.discount_input + '%)' : '';
            }
          } else {
            section.style.display = 'none';
          }
        }
      }

      // دالة تأكيد وإنهاء جلسة الكافيه نهائياً
      async function confirmAndFinalizeCafeSession() {
        const sessionId = window.currentCafeSessionId;
        const sessionData = window.currentCafeSessionData;

        if (!sessionId) {
          showSuccessNotification('خطأ: لم يتم العثور على معرف الجلسة',
            'error');
          return;
        }

        // تعطيل الزر لمنع النقر المزدوج
        const btn = document.getElementById('btnFinalizeCafeSession');
        if (btn) {
          btn.disabled = true;
          btn.innerHTML =
            '<i class="fas fa-spinner fa-spin ml-2"></i>جاري التثبيت...';
        }

        // قيمة الخصم من الحقل
        const cafeDiscountEl = document.getElementById('cafeDiscountInput');
        const cafeDiscountVal = cafeDiscountEl ? parseFloat(cafeDiscountEl.value) || 0 : 0;

        try {
          const response = await fetch('api/session-actions.php', {
            method: 'POST',
            headers: {
              'Content-Type': 'application/json'
            },
            body: JSON.stringify({
              action: 'finalize_end_session',
              session_id: sessionId,
              discount_input: cafeDiscountVal
            })
          });

          const result = await response.json();

          // النجاح: finalized صريح؛ success قد يُستدعى من معاينة قديمة بدون المفتاح
          if (result.finalized && result.success !== false) {
            // تحديث sessionData بالخصم الفعلي من الـ API (للمودال والطباعة)
            if (window.currentCafeSessionData) {
              window.currentCafeSessionData.total_amount    = result.total_amount != null ? parseFloat(result.total_amount) : window.currentCafeSessionData.total_amount;
              window.currentCafeSessionData.base_total      = result.base_total != null ? parseFloat(result.base_total) : (parseFloat(result.total_amount) + parseFloat(result.discount_amount || 0));
              window.currentCafeSessionData.discount_amount = result.discount_amount != null ? parseFloat(result.discount_amount) : 0;
              window.currentCafeSessionData.discount_input  = result.discount_input != null ? parseFloat(result.discount_input) : 0;
              window.currentCafeSessionData.discount_type   = result.discount_type   || 'percentage';
              if (result.orders_cost != null) {
                window.currentCafeSessionData.orders_cost = parseFloat(result.orders_cost);
              }
            }
            applyCafeFinalizeToModal(result);

            // تم التثبيت بنجاح
            const discountNote = result.discount_amount > 0
              ? ` (خصم: ${parseFloat(result.discount_amount).toFixed(2)} ${CURRENCY_SYMBOL})`
              : '';
            showSuccessNotification(
              '✅ تم إنهاء جلسة الكافيه وتسجيلها بنجاح!\nالمبلغ: ' +
              parseFloat(result.total_amount || 0).toFixed(2) + ' ' + CURRENCY_SYMBOL + discountNote,
              'success');

            // حفظ البيانات في sessionStorage للاستخدام في sessions.php
            sessionStorage.setItem('cafe_session_summary', JSON.stringify(
              result));

            // إغلاق الكارت بعد ثانيتين والانتقال إلى sessions.php
            setTimeout(() => {
              const modal = document.getElementById(
                'cafeSessionSummaryModal');
              if (modal) {
                modal.style.opacity = '0';
                modal.style.transform = 'scale(0.9)';
                setTimeout(() => {
                  modal.remove();
                  if (window.NotificationQueue) {
                    window.NotificationQueue.setBusyState(false);
                  }
                  // البقاء في نفس الصفحة بدلاً من التوجه إلى sessions.php
                  window.location.reload();
                }, 300);
              } else {
                // البقاء في نفس الصفحة بدلاً من التوجه إلى sessions.php
                window.location.reload();
              }
            }, 2000);
          } else {
            throw new Error(result.message || result.error ||
              'فشل في إنهاء جلسة الكافيه');
          }
        } catch (error) {
          showSuccessNotification('خطأ: ' + error.message, 'error');
          console.error('Finalize error:', error);

          // إعادة تفعيل الزر
          if (btn) {
            btn.disabled = false;
            btn.innerHTML =
              '<i class="fas fa-check-circle ml-2"></i>تأكيد وإنهاء نهائياً';
          }
        }
      }

      // ===== دوال الطباعة للكافيه =====

      // دالة عرض modal خيارات الطباعة للكافيه
      function showCafePrintOptionsModal() {
        const modal = document.getElementById('cafePrintOptionsModal');
        if (modal) {
          modal.style.display = 'flex';
          const firstButton = modal.querySelector('button');
          if (firstButton) {
            firstButton.focus();
          }
        }
      }

      function closeCafePrintOptionsModal() {
        const modal = document.getElementById('cafePrintOptionsModal');
        if (modal) {
          modal.style.display = 'none';
        }
      }

      // دالة بناء بيانات الإيصال الموحدة للكافيه
      function buildCafeReceiptData(sessionData) {
        const ordersCost = parseFloat(sessionData.orders_cost || 0);
        const discAmt = parseFloat(sessionData.discount_amount || 0);
        const baseParsed = sessionData.base_total != null ? parseFloat(sessionData.base_total) : NaN;
        let baseTotalFixed = !isNaN(baseParsed) ? baseParsed : ordersCost;
        if (isNaN(baseTotalFixed)) {
          baseTotalFixed = parseFloat(sessionData.total_amount || 0) + discAmt;
        }
        if (isNaN(baseTotalFixed)) baseTotalFixed = ordersCost;
        const finalTotal = parseFloat(sessionData.total_amount != null ? sessionData.total_amount : (baseTotalFixed - discAmt));
        const data = {
          session: {
            id: sessionData.session_id || 0,
            room_name: sessionData.room_name || 'كافيه',
            session_type: 'individual',
            session_category: 'cafe',
            is_cafe: true,
            players_count: 0,
            duration_hours: 0,
            duration_minutes_remainder: 0,
            total_duration_minutes: 0,
            hourly_rate: 0,
            cashier: 'admin_mahmoud_atef'
          },
          amounts: {
            accumulated_amount: 0,
            current_amount: 0,
            session_amount: 0,
            group_session_total: 0,
            orders_cost: ordersCost,
            base_total: baseTotalFixed,
            discount_amount: discAmt,
            discount_input: parseFloat(sessionData.discount_input || 0),
            discount_type: sessionData.discount_type || 'fixed',
            total_amount: isNaN(finalTotal) ? ordersCost : finalTotal
          },
          orders: []
        };

        // معالجة الطلبات
        const ordersArray = sessionData.orders || sessionData.orders_details || [];
        if (ordersArray && ordersArray.length > 0) {
          const grouped = {};
          ordersArray.forEach(order => {
            const name = order.order_name || order.item_name || order.name ||
              'طلب';
            const price = parseFloat(order.price || order.unit_price || 0);
            const qty = parseInt(order.quantity || 1);
            const key = name + '_' + price.toFixed(2);

            if (grouped[key]) {
              grouped[key].qty += qty;
              grouped[key].subtotal += (price * qty);
            } else {
              grouped[key] = {
                name: name,
                unit_price: price,
                qty: qty,
                subtotal: (price * qty)
              };
            }
          });
          data.orders = Object.values(grouped);
        }

        return data;
      }

      // دالة الطباعة الحرارية للكافيه
      function printCafeThermalReceipt(width = '80mm') {
        closeCafePrintOptionsModal();
        const sessionData = window.currentCafeSessionData;
        const sessionId = window.currentCafeSessionId;

        if (!sessionData || !sessionId) {
          showSuccessNotification('لا توجد بيانات للطباعة', 'error');
          return;
        }

        // بناء البيانات الموحدة
        const receiptData = buildCafeReceiptData(sessionData);

        // إنشاء نافذة طباعة
        const printWindow = window.open('', '_blank', 'width=302,height=600');
        const is58mm = width === '58mm';

        // تنسيق التاريخ والوقت
        const now = new Date();
        const dateStr = now.toLocaleDateString('ar-EG', {
          year: 'numeric',
          month: '2-digit',
          day: '2-digit'
        });
        const timeStr = now.toLocaleTimeString('ar-EG', {
          hour: '2-digit',
          minute: '2-digit',
          hour12: true
        });

        // بناء قائمة الطلبات
        const maxItems = is58mm ? 10 : 15;
        const displayOrders = receiptData.orders.slice(0, maxItems);
        const hiddenCount = Math.max(0, receiptData.orders.length - maxItems);
        let totalItems = receiptData.orders.reduce((sum, order) => sum + order
          .qty, 0);

        let ordersHTML = '';
        if (displayOrders.length > 0) {
          displayOrders.forEach(order => {
            const shortName = order.name.length > (is58mm ? 15 : 20) ? order
              .name.substring(0, is58mm ? 15 : 20) + '…' : order.name;
            ordersHTML += '<div class="receipt-item">';
            ordersHTML += '<span class="receipt-item-name">' + shortName +
              '</span>';
            ordersHTML += '<span class="receipt-item-details">×' + order.qty +
              ' | ' + order.unit_price.toFixed(2) + ' ' + CURRENCY_SYMBOL + '</span>';
            ordersHTML += '<span class="receipt-item-price">' + order.subtotal
              .toFixed(2) + ' ' + CURRENCY_SYMBOL + '</span>';
            ordersHTML += '</div>';
          });

          if (hiddenCount > 0) {
            ordersHTML += '<div class="receipt-item-more">… و ' + hiddenCount +
              ' بنود أخرى</div>';
          }
        } else {
          ordersHTML = '<div class="receipt-no-items">لا توجد طلبات</div>';
        }

        const ordersTotal = receiptData.amounts.orders_cost;
        const discAmtPrint = parseFloat(receiptData.amounts.discount_amount || 0);
        const baseBeforeDisc = receiptData.amounts.base_total != null ? parseFloat(receiptData.amounts.base_total) : ordersTotal;
        const grandTotal = receiptData.amounts.total_amount;

        // CSS للطباعة الحرارية
        let thermalCSS = '@page { size: ' + width + ' auto; margin: 0; }';
        thermalCSS += '* { margin: 0; padding: 0; box-sizing: border-box; }';
        thermalCSS +=
          'body { font-family: "Courier New", "Arial", monospace; font-size: ' + (
            is58mm ? '10px' : '11px') +
          '; line-height: 1.3; background: white; color: #000; margin: 0; padding: 0; display: flex; justify-content: center; align-items: flex-start; min-height: 100vh; }';
        thermalCSS += '.receipt-container { width: ' + width + '; padding: ' + (
          is58mm ? '6px' : '8px') + '; margin: 0 auto; }';
        thermalCSS +=
          '.receipt-header { text-align: center; border-bottom: 2px dashed #000; padding-bottom: 6px; margin-bottom: 6px; }';
        thermalCSS += '.receipt-logo { font-size: ' + (is58mm ? '20px' : '24px') +
          '; margin-bottom: 2px; }';
        thermalCSS += '.receipt-date { font-size: ' + (is58mm ? '9px' : '10px') +
          '; color: #000; }';
        thermalCSS +=
          '.receipt-section { border-bottom: 1px dashed #000; padding: 5px 0; margin: 5px 0; }';
        thermalCSS +=
          '.receipt-row { display: flex; justify-content: space-between; margin: 2px 0; font-size: ' +
          (is58mm ? '9px' : '10px') + '; line-height: 1.4; }';
        thermalCSS += '.receipt-label { font-weight: bold; flex: 0 0 ' + (is58mm ?
          '50%' : '55%') + '; }';
        thermalCSS += '.receipt-value { text-align: left; flex: 1; }';
        thermalCSS += '.receipt-session-type { font-size: ' + (is58mm ? '10px' :
            '11px') +
          '; font-weight: bold; text-align: center; padding: 4px; border: 1px solid #000; margin: 4px 0; }';
        thermalCSS +=
          '.receipt-items-header { font-weight: bold; text-align: center; border-top: 2px solid #000; border-bottom: 1px solid #000; padding: 3px 0; margin: 5px 0; font-size: ' +
          (is58mm ? '10px' : '11px') + '; }';
        thermalCSS +=
          '.receipt-item { display: flex; justify-content: space-between; margin: 2px 0; font-size: ' +
          (is58mm ? '8px' : '9px') + '; line-height: 1.4; }';
        thermalCSS += '.receipt-item-name { flex: 1; min-width: 0; }';
        thermalCSS += '.receipt-item-details { flex: 0 0 ' + (is58mm ? '32%' :
          '28%') + '; text-align: center; font-size: ' + (is58mm ? '7px' :
          '8px') + '; }';
        thermalCSS += '.receipt-item-price { flex: 0 0 ' + (is58mm ? '22%' :
          '20%') + '; text-align: left; font-weight: bold; }';
        thermalCSS +=
          '.receipt-item-more { text-align: center; font-style: italic; color: #000; margin: 2px 0; font-size: ' +
          (is58mm ? '8px' : '9px') + '; }';
        thermalCSS +=
          '.receipt-no-items { text-align: center; color: #000; padding: 3px 0; font-size: ' +
          (is58mm ? '9px' : '10px') + '; }';
        thermalCSS +=
          '.receipt-totals { border-top: 2px solid #000; padding-top: 5px; margin-top: 5px; }';
        thermalCSS +=
          '.receipt-total-row { display: flex; justify-content: space-between; margin: 2px 0; font-size: ' +
          (is58mm ? '9px' : '10px') + '; }';
        thermalCSS +=
          '.receipt-total-row.final { font-weight: bold; font-size: ' + (is58mm ?
            '11px' : '12px') +
          '; margin-top: 5px; padding-top: 5px; border-top: 1px dashed #000; }';
        thermalCSS +=
          '.receipt-footer { text-align: center; border-top: 2px dashed #000; padding-top: 6px; margin-top: 6px; }';
        thermalCSS +=
          '.receipt-thanks { font-weight: bold; margin-bottom: 2px; font-size: ' +
          (is58mm ? '10px' : '11px') + '; }';
        thermalCSS += '.receipt-note { font-size: ' + (is58mm ? '8px' : '9px') +
          '; color: #000; }';
        thermalCSS += '.money { font-weight: bold; }';

        // بناء HTML
        let html = '<!DOCTYPE html>';
        html += '<html dir="rtl" lang="ar"><head>';
        html += '<meta charset="UTF-8">';
        html +=
          '<meta name="viewport" content="width=device-width,initial-scale=1.0">';
        html += '<title>إيصال كافيه #' + sessionId + '</title>';
        html += '<style>' + thermalCSS + '</style>';
        html += '</head><body>';
        html += '<div class="receipt-container">';

        // Header
        html += '<div class="receipt-header">';
        html += '<div class="receipt-logo">☕</div>';
        html += '<div class="receipt-date">' + dateStr + ' - ' + timeStr +
          '</div>';
        html += '</div>';

        // معلومات أساسية
        html += '<div class="receipt-section">';
        html +=
          '<div class="receipt-row"><span class="receipt-label">رقم الجلسة:</span><span class="receipt-value">#' +
          sessionId + '</span></div>';
        html +=
          '<div class="receipt-row"><span class="receipt-label">النوع:</span><span class="receipt-value">كافيه</span></div>';
        html +=
          '<div class="receipt-row"><span class="receipt-label">الكاشير:</span><span class="receipt-value">' +
          receiptData.session.cashier + '</span></div>';
        if (sessionData.customer_name && sessionData.customer_name !== 'عميل') {
          html +=
            '<div class="receipt-row"><span class="receipt-label">العميل:</span><span class="receipt-value">' +
            sessionData.customer_name + '</span></div>';
        }
        html += '</div>';

        // نوع الجلسة
        html += '<div class="receipt-session-type">☕ جلسة كافيه</div>';

        // الطلبات
        html += '<div class="receipt-items-header">الطلبات (' + totalItems +
          ' قطعة)</div>';
        html += ordersHTML;

        // الإجماليات
        html += '<div class="receipt-totals">';
        if (ordersTotal > 0) {
          html += '<div class="receipt-total-row">';
          html += '<span class="receipt-label">إجمالي الطلبات:</span>';
          html += '<span class="receipt-value money">' + ordersTotal.toFixed(2) +
            ' ' + CURRENCY_SYMBOL + '</span>';
          html += '</div>';
        }
        if (discAmtPrint > 0) {
          html += '<div class="receipt-total-row">';
          html += '<span class="receipt-label">المجموع قبل الخصم:</span>';
          html += '<span class="receipt-value">' + baseBeforeDisc.toFixed(2) + ' ' + CURRENCY_SYMBOL + '</span>';
          html += '</div>';
          html += '<div class="receipt-total-row">';
          html += '<span class="receipt-label">خصم' + (receiptData.amounts.discount_type === 'percentage' && receiptData.amounts.discount_input ? ' (' + receiptData.amounts.discount_input + '%)' : '') + ':</span>';
          html += '<span class="receipt-value">-' + discAmtPrint.toFixed(2) + ' ' + CURRENCY_SYMBOL + '</span>';
          html += '</div>';
        }
        html += '<div class="receipt-total-row final">';
        html += '<span class="receipt-label">الإجمالي النهائي:</span>';
        html += '<span class="receipt-value money">' + grandTotal.toFixed(2) +
          ' ' + CURRENCY_SYMBOL + '</span>';
        html += '</div>';
        html += '</div>';

        // Footer
        html += '<div class="receipt-footer">';
        html += '<div class="receipt-thanks">شكراً لزيارتكم ❤️</div>';
        html += '<div class="receipt-note">نتمنى لكم تجربة ممتعة</div>';
        html += '</div>';

        html += '</div>';

        // Script
        html += '<script>';
        html += 'window.addEventListener("load", function() {';
        html += '  setTimeout(function() { window.print(); }, 500);';
        html += '});';
        html += 'window.onafterprint = function() {';
        html += '  setTimeout(function() { window.close(); }, 100);';
        html += '};';
        html += '<\/script>';
        html += '</body></html>';

        printWindow.document.write(html);
        printWindow.document.close();
      }

      // دالة الطباعة العادية للكافيه
      function printCafeSessionSummary() {
        closeCafePrintOptionsModal();
        const modal = document.getElementById('cafeSessionSummaryModal');
        if (!modal) {
          showSuccessNotification('لا يوجد إيصال للطباعة', 'error');
          return;
        }

        const content = modal.querySelector('.p-8');
        if (!content) {
          showSuccessNotification('لا يوجد محتوى للطباعة', 'error');
          return;
        }

        const printWindow = window.open('', '_blank', 'width=800,height=600');
        printWindow.document.write(`
          <!DOCTYPE html>
          <html dir="rtl" lang="ar">
          <head>
            <meta charset="UTF-8">
            <title>إيصال جلسة كافيه</title>
            <style>
              @media print {
                body { margin: 0; padding: 20px; }
                .no-print { display: none !important; }
              }
              body { font-family: Arial, sans-serif; direction: rtl; }
            </style>
          </head>
          <body>
            <div class="print-content">
              ${content.innerHTML}
            </div>
          </body>
          </html>
        `);
        printWindow.document.close();
        printWindow.print();
      }
    </script>

    <!-- Print Options Modal for Cafe -->
    <div id="cafePrintOptionsModal" class="print-options-overlay"
      style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.6); z-index: 30000; display: none; align-items: center; justify-content: center;">
      <div class="print-options-modal"
        style="background: white; border-radius: 16px; padding: 24px; max-width: 500px; width: 90%; box-shadow: 0 10px 40px rgba(0,0,0,0.3);">
        <div class="print-options-header"
          style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px; border-bottom: 2px solid #e5e7eb; padding-bottom: 16px;">
          <h3
            style="margin: 0; font-size: 20px; font-weight: bold; color: #1f2937;">
            <i class="fas fa-print" style="margin-left: 8px;"></i> اختر نوع
            الطباعة
          </h3>
          <button onclick="closeCafePrintOptionsModal()" class="print-close-btn"
            style="background: #ef4444; color: white; border: none; border-radius: 8px; width: 32px; height: 32px; cursor: pointer; font-size: 18px;">
            <i class="fas fa-times"></i>
          </button>
        </div>
        <div class="print-options-content"
          style="display: flex; flex-direction: column; gap: 12px;">
          <button onclick="printCafeThermalReceipt('80mm')"
            class="print-option-btn thermal-80"
            style="display: flex; align-items: center; gap: 16px; padding: 16px; background: #f3f4f6; border: 2px solid #d1d5db; border-radius: 12px; cursor: pointer; transition: all 0.3s; text-align: right; width: 100%;">
            <i class="fas fa-receipt"
              style="font-size: 24px; color: #059669;"></i>
            <div style="flex: 1;">
              <span class="print-option-title"
                style="display: block; font-weight: bold; font-size: 16px; color: #1f2937; margin-bottom: 4px;">طباعة
                حرارية 80mm</span>
              <span class="print-option-desc"
                style="display: block; font-size: 14px; color: #6b7280;">الأكثر
                انتشاراً</span>
            </div>
          </button>
          <button onclick="printCafeThermalReceipt('58mm')"
            class="print-option-btn thermal-58"
            style="display: flex; align-items: center; gap: 16px; padding: 16px; background: #f3f4f6; border: 2px solid #d1d5db; border-radius: 12px; cursor: pointer; transition: all 0.3s; text-align: right; width: 100%;">
            <i class="fas fa-receipt"
              style="font-size: 24px; color: #059669;"></i>
            <div style="flex: 1;">
              <span class="print-option-title"
                style="display: block; font-weight: bold; font-size: 16px; color: #1f2937; margin-bottom: 4px;">طباعة
                حرارية 58mm</span>
              <span class="print-option-desc"
                style="display: block; font-size: 14px; color: #6b7280;">حجم
                صغير</span>
            </div>
          </button>
          <button
            onclick="printCafeSessionSummary(); closeCafePrintOptionsModal();"
            class="print-option-btn normal-print"
            style="display: flex; align-items: center; gap: 16px; padding: 16px; background: #f3f4f6; border: 2px solid #d1d5db; border-radius: 12px; cursor: pointer; transition: all 0.3s; text-align: right; width: 100%;">
            <i class="fas fa-print"
              style="font-size: 24px; color: #3b82f6;"></i>
            <div style="flex: 1;">
              <span class="print-option-title"
                style="display: block; font-weight: bold; font-size: 16px; color: #1f2937; margin-bottom: 4px;">طباعة
                عادية A4</span>
              <span class="print-option-desc"
                style="display: block; font-size: 14px; color: #6b7280;">ورق
                عادي</span>
            </div>
          </button>
        </div>
      </div>
    </div>

    <style>
      .print-options-overlay {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.6);
        backdrop-filter: blur(4px);
        z-index: 30000;
        display: flex;
        align-items: center;
        justify-content: center;
      }

      .print-options-modal {
        background: white;
        border-radius: 16px;
        padding: 24px;
        max-width: 500px;
        width: 90%;
        box-shadow: 0 10px 40px rgba(0, 0, 0, 0.3);
      }

      .print-option-btn:hover {
        background: #e5e7eb !important;
        border-color: #9ca3af !important;
        transform: scale(1.02);
      }
    </style>

    <!-- Session Monitor & Notification System -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="js/notification-queue.js?v=1779207315"></script>
    <script src="js/session-monitor.js?v=1771422103"></script>

    <!-- Footer -->
    
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
</style>    <!-- Stock Update Modal -->
    <div id="stockUpdateModal"
      class="fixed inset-0 bg-black/70 backdrop-blur-sm z-50 flex items-center justify-center p-4"
      style="display: none;"
      onclick="if(event.target === this) closeStockModal()">
      <div
        class="bg-gradient-to-br from-blue-900 to-indigo-900 rounded-2xl shadow-2xl max-w-md w-full p-6 border-2 border-blue-400/30"
        onclick="event.stopPropagation()">
        <div class="flex justify-between items-center mb-4">
          <h3 class="text-2xl font-bold text-white flex items-center gap-2">
            <i class="fas fa-box"></i>
            تحديث المخزون
          </h3>
          <button onclick="closeStockModal()"
            class="text-white/70 hover:text-white transition">
            <i class="fas fa-times text-2xl"></i>
          </button>
        </div>

        <input type="hidden" id="modalItemType">
        <input type="hidden" id="modalItemId">

        <div class="bg-white/10 rounded-xl p-4 mb-4 border border-white/20">
          <p class="text-white/70 text-sm mb-2">الصنف:</p>
          <p class="text-white font-bold text-lg" id="modalItemName"></p>
        </div>

        <div class="bg-white/10 rounded-xl p-4 mb-4 border border-white/20">
          <p class="text-white/70 text-sm mb-2">المخزون الحالي:</p>
          <p class="text-white font-bold text-2xl" id="modalCurrentStock"></p>
        </div>

        <div class="mb-6">
          <label class="block text-white font-semibold mb-2">المخزون
            الجديد:</label>
          <input type="number" id="newStockInput" min="0"
            class="w-full bg-white/10 border-2 border-white/30 rounded-xl px-4 py-3 text-white text-lg font-bold focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-blue-400 transition">
        </div>

        <div class="flex gap-3">
          <button onclick="updateStock()"
            class="flex-1 bg-gradient-to-r from-emerald-500 to-emerald-600 hover:from-emerald-600 hover:to-emerald-700 text-white font-bold py-3 px-6 rounded-xl transition transform hover:scale-105">
            <i class="fas fa-check mr-2"></i>تحديث
          </button>
          <button onclick="closeStockModal()"
            class="flex-1 bg-white/10 hover:bg-white/20 text-white font-bold py-3 px-6 rounded-xl transition">
            <i class="fas fa-times mr-2"></i>إلغاء
          </button>
        </div>
      </div>
    </div>

<!-- ══════════════════════════════════════════════════════════════════
     مودال نقل جلسة الكافيه إلى غرفة — متعدد الخطوات
══════════════════════════════════════════════════════════════════ -->
<div id="transferToRoomModal"
  class="fixed inset-0 z-[99999] flex items-end sm:items-center justify-center bg-black/60 backdrop-blur-sm hidden"
  onclick="handleTransferOverlayClick(event)">
  <div class="transfer-modal-card bg-slate-900 border border-white/10 rounded-t-3xl sm:rounded-3xl shadow-2xl w-full sm:max-w-lg max-h-[92dvh] overflow-hidden flex flex-col"
    onclick="event.stopPropagation()">

    <!-- Header -->
    <div class="flex items-center justify-between px-5 py-4 border-b border-white/10 bg-gradient-to-r from-emerald-600/20 to-green-600/20 flex-shrink-0">
      <div class="flex items-center gap-3">
        <div class="w-9 h-9 bg-emerald-500/20 rounded-xl flex items-center justify-center">
          <i class="fas fa-door-open text-emerald-400"></i>
        </div>
        <div>
          <h3 class="text-white font-bold text-base">نقل إلى غرفة</h3>
          <p id="transferModalSubtitle" class="text-white/50 text-xs">اختر الغرفة المناسبة</p>
        </div>
      </div>
      <button onclick="closeTransferToRoomModal()"
        class="w-8 h-8 bg-white/10 hover:bg-white/20 rounded-full flex items-center justify-center text-white/60 hover:text-white transition-all">
        <i class="fas fa-times text-sm"></i>
      </button>
    </div>

    <!-- مؤشر الخطوات -->
    <div class="flex items-center justify-center gap-2 px-5 py-3 bg-white/5 flex-shrink-0">
            <div class="flex items-center gap-2">
        <div id="transferStepIndicator1"
          class="w-8 h-8 rounded-full flex items-center justify-center text-sm font-bold transition-all duration-300 bg-emerald-500 text-white ring-4 ring-emerald-400/30">
          1        </div>
        <span id="transferStepLabel1"
          class="text-xs hidden sm:block transition-all text-emerald-400 font-semibold">
          الغرفة        </span>
      </div>
              <div class="w-8 h-px bg-white/10 flex-shrink-0"></div>
                  <div class="flex items-center gap-2">
        <div id="transferStepIndicator2"
          class="w-8 h-8 rounded-full flex items-center justify-center text-sm font-bold transition-all duration-300 bg-white/10 text-white/40">
          2        </div>
        <span id="transferStepLabel2"
          class="text-xs hidden sm:block transition-all text-white/30">
          الجلسة        </span>
      </div>
              <div class="w-8 h-px bg-white/10 flex-shrink-0"></div>
                  <div class="flex items-center gap-2">
        <div id="transferStepIndicator3"
          class="w-8 h-8 rounded-full flex items-center justify-center text-sm font-bold transition-all duration-300 bg-white/10 text-white/40">
          3        </div>
        <span id="transferStepLabel3"
          class="text-xs hidden sm:block transition-all text-white/30">
          تأكيد        </span>
      </div>
                </div>

    <!-- ═══ الخطوة 1: اختيار الغرفة ═══ -->
    <div id="transferStep1" class="flex-1 overflow-y-auto p-5">
      <p class="text-white/60 text-sm mb-4">اختر الغرفة التي ستنقل إليها الطلبات والجلسة:</p>
      <div id="transferRoomsGrid" class="grid grid-cols-2 gap-3">
        <!-- تُملأ بـ JavaScript -->
        <div class="col-span-2 text-center text-white/50 py-8">
          <i class="fas fa-spinner fa-spin text-2xl mb-2"></i>
          <p class="text-sm">جاري التحميل...</p>
        </div>
      </div>
    </div>

    <!-- ═══ الخطوة 2: إعداد الجلسة ═══ -->
    <div id="transferStep2" class="flex-1 overflow-y-auto p-5 hidden">
      <div class="bg-emerald-500/10 border border-emerald-400/20 rounded-xl p-3 mb-4 flex items-center gap-2">
        <i class="fas fa-door-open text-emerald-400 text-sm"></i>
        <span class="text-white text-sm">الغرفة: <strong id="transferStep2RoomName" class="text-emerald-400"></strong></span>
      </div>

      <!-- نوع الجلسة: فردي / جماعي -->
      <p class="text-white/70 text-sm font-semibold mb-2">نوع الجلسة <span class="text-amber-400">*</span></p>
      <div class="grid grid-cols-2 gap-3 mb-5">
        <label class="transfer-type-btn cursor-pointer">
          <input type="radio" name="transferSessionType" value="individual" class="sr-only">
          <div class="bg-white/10 hover:bg-blue-500/20 border-2 border-white/10 hover:border-blue-400/50 rounded-xl p-4 text-center transition-all transfer-type-option">
            <i class="fas fa-user text-blue-400 text-xl mb-2 block"></i>
            <span class="text-white font-semibold text-sm">فردي</span>
          </div>
        </label>
        <label class="transfer-type-btn cursor-pointer">
          <input type="radio" name="transferSessionType" value="group" class="sr-only">
          <div class="bg-white/10 hover:bg-purple-500/20 border-2 border-white/10 hover:border-purple-400/50 rounded-xl p-4 text-center transition-all transfer-type-option">
            <i class="fas fa-users text-purple-400 text-xl mb-2 block"></i>
            <span class="text-white font-semibold text-sm">جماعي</span>
          </div>
        </label>
      </div>

      <!-- مدة الجلسة: مفتوحة / محدودة -->
      <p class="text-white/70 text-sm font-semibold mb-2">مدة الجلسة</p>
      <div class="grid grid-cols-2 gap-3 mb-4">
        <label class="transfer-mode-btn cursor-pointer">
          <input type="radio" name="transferIsLimited" value="open" class="sr-only" checked>
          <div class="bg-white/10 hover:bg-emerald-500/20 border-2 border-emerald-400 hover:border-emerald-400/50 rounded-xl p-4 text-center transition-all transfer-mode-option selected-mode">
            <i class="fas fa-infinity text-emerald-400 text-xl mb-2 block"></i>
            <span class="text-white font-semibold text-sm">مفتوحة</span>
            <p class="text-white/40 text-xs mt-1">تُحسب حسب الوقت</p>
          </div>
        </label>
        <label class="transfer-mode-btn cursor-pointer">
          <input type="radio" name="transferIsLimited" value="limited" class="sr-only">
          <div class="bg-white/10 hover:bg-amber-500/20 border-2 border-white/10 hover:border-amber-400/50 rounded-xl p-4 text-center transition-all transfer-mode-option">
            <i class="fas fa-clock text-amber-400 text-xl mb-2 block"></i>
            <span class="text-white font-semibold text-sm">محدودة</span>
            <p class="text-white/40 text-xs mt-1">وقت محدد</p>
          </div>
        </label>
      </div>

      <!-- حقل المدة — يظهر عند اختيار محدودة -->
      <div id="transferDurationRow" class="hidden mb-5">
        <label class="text-white/70 text-sm font-semibold mb-2 block">المدة (بالدقائق)</label>
        <input type="number" id="transferDurationMinutes" min="1" max="480" value="60"
          class="w-full bg-white/10 border border-white/20 rounded-xl px-4 py-2.5 text-white text-sm focus:outline-none focus:ring-2 focus:ring-amber-400">
      </div>
    </div>

    <!-- ═══ الخطوة 3: تأكيد ═══ -->
    <div id="transferStep3" class="flex-1 overflow-y-auto p-5 hidden">
      <div class="bg-white/5 rounded-2xl p-4 space-y-3 mb-5">
        <h4 class="text-white font-bold text-sm mb-3 flex items-center gap-2">
          <i class="fas fa-clipboard-check text-emerald-400"></i> ملخص الجلسة الجديدة
        </h4>
        <div class="flex justify-between items-center py-2 border-b border-white/5">
          <span class="text-white/50 text-sm">الغرفة</span>
          <span id="transferSummaryRoom" class="text-white font-semibold text-sm"></span>
        </div>
        <div class="flex justify-between items-center py-2 border-b border-white/5">
          <span class="text-white/50 text-sm">الجهاز</span>
          <span id="transferSummaryDevice" class="text-white font-semibold text-sm"></span>
        </div>
        <div class="flex justify-between items-center py-2 border-b border-white/5">
          <span class="text-white/50 text-sm">نوع الجلسة</span>
          <span id="transferSummaryType" class="text-white font-semibold text-sm"></span>
        </div>
        <div class="flex justify-between items-center py-2 border-b border-white/5">
          <span class="text-white/50 text-sm">المدة</span>
          <span id="transferSummaryMode" class="text-white font-semibold text-sm"></span>
        </div>
        <div class="flex justify-between items-center py-2 border-b border-white/5">
          <span class="text-white/50 text-sm">سعر الساعة</span>
          <span id="transferSummaryRate" class="text-emerald-400 font-bold text-sm"></span>
        </div>
      </div>

      <div class="bg-amber-500/10 border border-amber-400/20 rounded-xl p-3 flex items-start gap-2 text-sm">
        <i class="fas fa-info-circle text-amber-400 mt-0.5 flex-shrink-0"></i>
        <p class="text-amber-200/80">سيتم نقل جميع الطلبات تلقائياً من جلسة الكافيه إلى هذه الجلسة.</p>
      </div>
    </div>

    <!-- Footer Buttons -->
    <div class="flex-shrink-0 px-5 py-4 border-t border-white/10 bg-white/5">
      <!-- الخطوة 1: لا يوجد زر تالي — الاختيار يقدم تلقائياً -->
      <div id="transferFooter1" class="flex justify-end">
        <button onclick="closeTransferToRoomModal()"
          class="px-5 py-2.5 bg-white/10 hover:bg-white/20 text-white/70 rounded-xl text-sm font-medium transition-all">
          إلغاء
        </button>
      </div>

      <!-- الخطوة 2 -->
      <div id="transferFooter2" class="hidden flex items-center justify-between gap-3">
        <button onclick="showTransferStep(1)"
          class="flex items-center gap-2 px-4 py-2.5 bg-white/10 hover:bg-white/20 text-white/70 rounded-xl text-sm font-medium transition-all">
          <i class="fas fa-arrow-right text-xs"></i> رجوع
        </button>
        <button id="transferProceedBtn" onclick="transferProceedToConfirm()" disabled
          class="flex items-center gap-2 px-6 py-2.5 bg-white/10 text-white/40 rounded-xl text-sm font-bold cursor-not-allowed transition-all transfer-proceed-btn-disabled">
          متابعة <i class="fas fa-arrow-left text-xs"></i>
        </button>
      </div>

      <!-- الخطوة 3 -->
      <div id="transferFooter3" class="hidden flex items-center justify-between gap-3">
        <button onclick="showTransferStep(2)"
          class="flex items-center gap-2 px-4 py-2.5 bg-white/10 hover:bg-white/20 text-white/70 rounded-xl text-sm font-medium transition-all">
          <i class="fas fa-arrow-right text-xs"></i> رجوع
        </button>
        <button id="transferConfirmBtn" onclick="confirmTransferToRoom()"
          class="flex items-center gap-2 px-6 py-2.5 bg-gradient-to-r from-emerald-500 to-green-600 hover:from-emerald-600 hover:to-green-700 text-white font-bold rounded-xl text-sm transition-all shadow-lg">
          <i class="fas fa-check"></i> تأكيد ونقل
        </button>
      </div>
    </div>
  </div>
</div>

<script>
// ══════════════════════════════════════════════════════════════════
//  Transfer to Room — Multi-Step Modal Logic
// ══════════════════════════════════════════════════════════════════
(function () {
  let _sid        = null;   // cafe session id
  let _step       = 1;
  let _roomData   = null;
  let _config     = null;

  const subtitles = ['اختر الغرفة المناسبة', 'إعداد الجلسة', 'تأكيد النقل'];

  /* ── open ── */
  window.showTransferToRoomModal = async function (sessionId) {
    _sid    = sessionId;
    _step   = 1;
    _roomData = null;
    _config   = null;

    document.getElementById('transferToRoomModal').classList.remove('hidden');
    showTransferStep(1);
    await loadAvailableRooms();
  };

  /* ── overlay click ── */
  window.handleTransferOverlayClick = function (e) {
    if (e.target === document.getElementById('transferToRoomModal')) {
      closeTransferToRoomModal();
    }
  };

  /* ── close ── */
  window.closeTransferToRoomModal = function () {
    document.getElementById('transferToRoomModal').classList.add('hidden');
    _sid = null; _roomData = null; _config = null;
  };

  /* ── step navigation ── */
  window.showTransferStep = function (step) {
    _step = step;
    if (step === 2) updateTransferProceedBtn();

    [1, 2, 3].forEach(s => {
      document.getElementById(`transferStep${s}`).classList.toggle('hidden', s !== step);
      document.getElementById(`transferFooter${s}`).classList.toggle('hidden', s !== step);

      const ind   = document.getElementById(`transferStepIndicator${s}`);
      const label = document.getElementById(`transferStepLabel${s}`);
      if (s < step) {
        ind.className = 'w-8 h-8 rounded-full flex items-center justify-center text-sm font-bold transition-all duration-300 bg-emerald-500 text-white';
        ind.innerHTML = '<i class="fas fa-check text-xs"></i>';
        label.className = 'text-xs hidden sm:block text-white/40';
      } else if (s === step) {
        ind.className = 'w-8 h-8 rounded-full flex items-center justify-center text-sm font-bold transition-all duration-300 bg-emerald-500 text-white ring-4 ring-emerald-400/30';
        ind.textContent = s;
        label.className = 'text-xs hidden sm:block text-emerald-400 font-semibold';
      } else {
        ind.className = 'w-8 h-8 rounded-full flex items-center justify-center text-sm font-bold transition-all duration-300 bg-white/10 text-white/40';
        ind.textContent = s;
        label.className = 'text-xs hidden sm:block text-white/30';
      }
    });

    document.getElementById('transferModalSubtitle').textContent = subtitles[step - 1];
  };

  /* ── load rooms ── */
  async function loadAvailableRooms() {
    const grid = document.getElementById('transferRoomsGrid');
    grid.innerHTML = `<div class="col-span-2 text-center text-white/50 py-8">
      <i class="fas fa-spinner fa-spin text-2xl mb-2 block"></i>
      <p class="text-sm">جاري تحميل الغرف المتاحة...</p></div>`;
    try {
      const res  = await fetch('api/cafe-actions.php', {
        method: 'POST',
        headers: {'Content-Type': 'application/json'},
        body: JSON.stringify({action: 'get_available_rooms'})
      });
      const data = await res.json();
      if (data.success && data.rooms && data.rooms.length > 0) {
        grid.innerHTML = data.rooms.map(r => {
          const rate = Number(r.hourly_rate || 0);
          const gRate = Number(r.group_hourly_rate || rate);
          return `<button type="button"
            class="transfer-room-card bg-white/10 hover:bg-emerald-500/20 border-2 border-white/10 hover:border-emerald-400/50 rounded-2xl p-4 text-center transition-all cursor-pointer group text-right"
            data-room-id="${r.id}"
            onclick='selectTransferRoom(${JSON.stringify(r).replace(/'/g,"\\'")})'  >
            <div class="w-11 h-11 bg-emerald-500/20 rounded-xl flex items-center justify-center mx-auto mb-2 group-hover:bg-emerald-500/40 transition-all">
              <i class="fas fa-gamepad text-emerald-400 text-lg"></i>
            </div>
            <p class="text-white font-bold text-sm mb-0.5 truncate">${r.name}</p>
            <p class="text-white/40 text-xs truncate">${r.device_type || ''}</p>
            <p class="text-emerald-400 text-xs font-bold mt-2">${rate} ${CURRENCY_SYMBOL}/ساعة</p>
          </button>`;
        }).join('');
      } else {
        grid.innerHTML = `<div class="col-span-2 text-center text-white/50 py-10">
          <i class="fas fa-door-closed text-3xl text-red-400/60 mb-3 block"></i>
          <p class="font-semibold text-sm">لا توجد غرف متاحة حالياً</p>
          <p class="text-xs mt-1">جميع الغرف مشغولة</p></div>`;
      }
    } catch (e) {
      grid.innerHTML = `<div class="col-span-2 text-center text-red-400 py-8">
        <i class="fas fa-exclamation-circle text-2xl mb-2 block"></i>
        <p class="text-sm">حدث خطأ في تحميل الغرف</p></div>`;
    }
  }

  /* ── select room ── */
  window.selectTransferRoom = function (room) {
    if (typeof room === 'string') room = JSON.parse(room);
    _roomData = room;

    document.querySelectorAll('.transfer-room-card').forEach(el => {
      el.classList.remove('!border-emerald-400', '!bg-emerald-500/30');
    });
    const card = document.querySelector(`.transfer-room-card[data-room-id="${room.id}"]`);
    if (card) card.classList.add('!border-emerald-400', '!bg-emerald-500/30');

    document.getElementById('transferStep2RoomName').textContent = room.name;
    showTransferStep(2);
  };

  /* ── تفعيل زر متابعة عند اختيار نوع الجلسة ── */
  function updateTransferProceedBtn() {
    const btn  = document.getElementById('transferProceedBtn');
    if (!btn) return;
    const sType = document.querySelector('input[name="transferSessionType"]:checked')?.value;
    const selected = !!sType;
    btn.disabled = !selected;
    btn.classList.toggle('cursor-not-allowed', !selected);
    btn.classList.toggle('transfer-proceed-btn-disabled', !selected);
    if (selected) {
      btn.classList.remove('bg-white/10', 'text-white/40');
      btn.classList.add('bg-gradient-to-r', 'from-emerald-500', 'to-green-600', 'hover:from-emerald-600', 'hover:to-green-700', 'text-white', 'shadow-lg', 'cursor-pointer');
    } else {
      btn.classList.add('bg-white/10', 'text-white/40');
      btn.classList.remove('bg-gradient-to-r', 'from-emerald-500', 'to-green-600', 'hover:from-emerald-600', 'hover:to-green-700', 'text-white', 'shadow-lg', 'cursor-pointer');
    }
  }

  /* ── session type radios ── */
  document.addEventListener('change', function (e) {
    if (e.target.name === 'transferSessionType') {
      document.querySelectorAll('.transfer-type-option').forEach(el => el.classList.remove('selected-type', '!border-blue-400', '!bg-blue-500/30', '!border-purple-400', '!bg-purple-500/30'));
      const parent = e.target.closest('label').querySelector('.transfer-type-option');
      parent.classList.add('selected-type');
      if (e.target.value === 'group') {
        parent.classList.add('!border-purple-400', '!bg-purple-500/30');
      } else {
        parent.classList.add('!border-blue-400', '!bg-blue-500/30');
      }
      updateTransferProceedBtn();
    }
    if (e.target.name === 'transferIsLimited') {
      document.querySelectorAll('.transfer-mode-option').forEach(el => {
        el.classList.remove('selected-mode', '!border-emerald-400', '!bg-emerald-500/30', '!border-amber-400', '!bg-amber-500/30', 'border-emerald-400', 'border-amber-400');
        el.classList.add('border-white/10');
      });
      const parent = e.target.closest('label').querySelector('.transfer-mode-option');
      parent.classList.add('selected-mode');
      parent.classList.remove('border-white/10');
      const isLtd = e.target.value === 'limited';
      document.getElementById('transferDurationRow').classList.toggle('hidden', !isLtd);
      if (isLtd) {
        parent.classList.add('border-amber-400', 'bg-amber-500/30');
      } else {
        parent.classList.add('border-emerald-400');
      }
    }
  });

  /* ── step 2 → 3 ── */
  window.transferProceedToConfirm = function () {
    const sType  = document.querySelector('input[name="transferSessionType"]:checked')?.value;
    const isLtd  = document.querySelector('input[name="transferIsLimited"]:checked')?.value === 'limited';
    const durMin = parseInt(document.getElementById('transferDurationMinutes')?.value || 0);

    if (!sType) { alert('يرجى اختيار نوع الجلسة'); return; }
    if (isLtd && durMin < 1) { alert('يرجى إدخال مدة صحيحة (دقيقة واحدة على الأقل)'); return; }

    _config = { session_type: sType, is_limited: isLtd, duration_minutes: isLtd ? durMin : null, players_count: sType === 'group' ? 2 : 1 };

    // ملء ملخص الخطوة 3
    const rate = _config.session_type === 'group'
      ? Number(_roomData.group_hourly_rate || _roomData.hourly_rate || 0)
      : Number(_roomData.hourly_rate || 0);

    document.getElementById('transferSummaryRoom').textContent    = _roomData.name;
    document.getElementById('transferSummaryDevice').textContent  = _roomData.device_type || '—';
    document.getElementById('transferSummaryType').textContent    = _config.session_type === 'group' ? 'جماعي' : 'فردي';
    document.getElementById('transferSummaryMode').textContent    = _config.is_limited ? `محدودة — ${_config.duration_minutes} دقيقة` : 'مفتوحة';
    document.getElementById('transferSummaryRate').textContent    = rate + ' ' + CURRENCY_SYMBOL + '/ساعة';

    showTransferStep(3);
  };

  /* ── confirm ── */
  window.confirmTransferToRoom = async function () {
    const btn = document.getElementById('transferConfirmBtn');
    btn.disabled = true;
    btn.innerHTML = '<i class="fas fa-spinner fa-spin ml-2"></i> جاري النقل...';

    try {
      const payload = {
        action:           'transfer_to_room',
        session_id:       _sid,
        room_id:          _roomData.id,
        session_type:     _config.session_type,
        is_limited:       _config.is_limited,
        duration_minutes: _config.duration_minutes,
        players_count:    _config.players_count
      };

      const res  = await fetch('api/cafe-actions.php', {
        method:  'POST',
        headers: {'Content-Type': 'application/json'},
        body:    JSON.stringify(payload)
      });
      const data = await res.json();

      if (data.success) {
        closeTransferToRoomModal();
        window.location.href = 'sessions.php#s' + data.new_session_id;
      } else {
        alert('❌ فشل النقل: ' + (data.error || 'حدث خطأ غير متوقع'));
        btn.disabled = false;
        btn.innerHTML = '<i class="fas fa-check ml-1"></i> تأكيد ونقل';
      }
    } catch (e) {
      alert('❌ حدث خطأ في الاتصال بالخادم');
      btn.disabled = false;
      btn.innerHTML = '<i class="fas fa-check ml-1"></i> تأكيد ونقل';
    }
  };

  /* ── ESC to close ── */
  document.addEventListener('keydown', function (e) {
    if (e.key === 'Escape' && !document.getElementById('transferToRoomModal').classList.contains('hidden')) {
      closeTransferToRoomModal();
    }
  });
})();
</script>

    </div><!-- /py-4 -->
  </div><!-- /container -->

</body>

</html>