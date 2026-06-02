
<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description"
    content="the seystem good live ">
  <meta name="author"
    content="ENG.HOSSAM">
  <title>إدارة الشيفتات - Play Zone</title>

  <!-- Fonts & Icons -->
  <link rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <link
    href="https://fonts.googleapis.com/css2?family=Cairo:wght@300;400;600;700&display=swap"
    rel="stylesheet">

  <!-- Tailwind CSS -->
  <script src="https://cdn.tailwindcss.com"></script>
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

  <style>
    html { font-size: 90%; }
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      font-family: 'Cairo', sans-serif;
    }

    body {
      background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
      min-height: 100vh;
      transition: background 0.3s ease;
    }

    body.dark-mode {
      background: linear-gradient(135deg, #1a1a2e 0%, #16213e 100%);
    }

    /* Header Wrapper */
    .header-wrapper {
      width: 96%;
      margin: 0 auto;
      padding: 12px 0;
      box-sizing: border-box;
    }

    /* Page Content Wrapper */
    .page-wrapper {
      width: 96%;
      margin: 0 auto;
      padding: 0 0 20px;
      box-sizing: border-box;
    }

    /* Header Styles */
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

    .logo:hover {
      transform: scale(1.05);
    }

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
    }

    .back-btn:hover {
      transform: translateY(-2px);
      box-shadow: 0 4px 12px rgba(102, 126, 234, 0.4);
    }

    body.dark-mode .back-btn {
      background: linear-gradient(135deg, #4f46e5 0%, #7c3aed 100%);
    }

    /* Show back button only on large screens */
    @media (min-width: 1024px) {
      .back-btn {
        display: inline-flex;
      }
    }

    .user-menu {
      position: relative;
    }

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

    /* Main Content */
    .main-content {
      background: white;
      border-radius: 15px;
      padding: 25px;
      box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
      min-height: 500px;
    }

    body.dark-mode .main-content {
      background: #1e293b;
      color: #e2e8f0;
      box-shadow: 0 4px 15px rgba(0, 0, 0, 0.3);
    }

    /* Page Title */
    .page-title {
      font-size: 1.75rem;
      font-weight: bold;
      color: #1f2937;
      margin-bottom: 20px;
      display: flex;
      align-items: center;
      gap: 12px;
    }

    body.dark-mode .page-title {
      color: #f1f5f9;
    }

    .page-title i {
      color: #667eea;
      font-size: 2rem;
    }

    /* Animations */
    @keyframes fadeIn {
      from {
        opacity: 0;
        transform: translateY(10px);
      }

      to {
        opacity: 1;
        transform: translateY(0);
      }
    }

    .fade-in {
      animation: fadeIn 0.5s ease-out forwards;
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

    @keyframes shimmer {
      0% {
        transform: translateX(-100%);
      }

      100% {
        transform: translateX(100%);
      }
    }

    .progress-fill::after {
      content: '';
      position: absolute;
      top: 0;
      left: 0;
      right: 0;
      bottom: 0;
      background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
      animation: shimmer 2s infinite;
    }

    /* Custom scrollbar */
    ::-webkit-scrollbar {
      width: 8px;
      height: 8px;
    }

    ::-webkit-scrollbar-track {
      background: rgba(0, 0, 0, 0.1);
    }

    body.dark-mode ::-webkit-scrollbar-track {
      background: rgba(255, 255, 255, 0.05);
    }

    ::-webkit-scrollbar-thumb {
      background: rgba(0, 0, 0, 0.3);
      border-radius: 10px;
    }

    body.dark-mode ::-webkit-scrollbar-thumb {
      background: rgba(255, 255, 255, 0.2);
    }

    ::-webkit-scrollbar-thumb:hover {
      background: rgba(0, 0, 0, 0.5);
    }

    body.dark-mode ::-webkit-scrollbar-thumb:hover {
      background: rgba(255, 255, 255, 0.3);
    }

    /* Shift Cards & Stats */
    .shift-card {
      background: white;
      transition: all 0.3s ease;
      box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
    }

    body.dark-mode .shift-card {
      background: rgba(30, 41, 59, 0.95);
      box-shadow: 0 4px 15px rgba(0, 0, 0, 0.3);
    }

    .shift-card-title {
      color: #1f2937;
    }

    body.dark-mode .shift-card-title {
      color: #f1f5f9;
    }

    .shift-stat-label {
      color: #6b7280;
    }

    body.dark-mode .shift-stat-label {
      color: #94a3b8;
    }

    .shift-stat-value {
      color: #1f2937;
    }

    body.dark-mode .shift-stat-value {
      color: #f1f5f9;
    }

    /* Admin Section */
    .admin-section-title {
      color: #1f2937;
    }

    body.dark-mode .admin-section-title {
      color: #f1f5f9;
    }

    .shift-card {
      border-color: #e5e7eb !important;
    }

    body.dark-mode .shift-card {
      border-color: rgba(226, 232, 240, 0.2) !important;
    }

    /* Light Mode: Active Shift Card */
    body:not(.dark-mode) .active-shift-card {
      background: linear-gradient(135deg, rgba(255, 255, 255, 0.98) 0%, rgba(249, 250, 251, 0.98) 100%);
      backdrop-filter: blur(10px);
      border: 2px solid rgba(102, 126, 234, 0.2);
      box-shadow: 0 8px 32px rgba(102, 126, 234, 0.15);
    }

    body:not(.dark-mode) .active-shift-card .card-title {
      color: #1f2937;
    }

    body:not(.dark-mode) .active-shift-card .card-label {
      color: #6b7280;
    }

    body:not(.dark-mode) .active-shift-card .card-value {
      color: #1f2937;
    }

    body:not(.dark-mode) .active-shift-card .stat-box {
      background: rgba(102, 126, 234, 0.05);
      border: 1px solid rgba(102, 126, 234, 0.1);
    }

    body:not(.dark-mode) .active-shift-card .stat-box:hover {
      background: rgba(102, 126, 234, 0.08);
      border-color: rgba(102, 126, 234, 0.2);
    }

    /* Light Mode: Start Shift Card */
    body:not(.dark-mode) .start-shift-card {
      background: linear-gradient(135deg, rgba(255, 255, 255, 0.98) 0%, rgba(249, 250, 251, 0.98) 100%);
      backdrop-filter: blur(10px);
      border: 2px solid rgba(16, 185, 129, 0.2);
      box-shadow: 0 8px 32px rgba(16, 185, 129, 0.15);
    }

    body:not(.dark-mode) .start-shift-icon {
      color: #d1d5db;
    }

    body:not(.dark-mode) .start-shift-title {
      color: #1f2937;
    }

    body:not(.dark-mode) .start-shift-desc {
      color: #6b7280;
    }

    /* Light Mode: History Card */
    body:not(.dark-mode) .history-card {
      background: linear-gradient(135deg, rgba(255, 255, 255, 0.98) 0%, rgba(249, 250, 251, 0.98) 100%);
      backdrop-filter: blur(10px);
      border: 2px solid rgba(59, 130, 246, 0.2);
      box-shadow: 0 8px 32px rgba(59, 130, 246, 0.15);
    }

    body:not(.dark-mode) .history-card .card-title {
      color: #1f2937;
    }

    body:not(.dark-mode) .history-table {
      background: transparent;
    }

    body:not(.dark-mode) .history-table thead tr {
      background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    }

    body:not(.dark-mode) .history-table tbody tr {
      border-bottom: 1px solid rgba(229, 231, 235, 0.5);
    }

    body:not(.dark-mode) .history-table tbody tr:hover {
      background: rgba(102, 126, 234, 0.05);
    }

    body:not(.dark-mode) .history-table td {
      color: #374151;
    }

    /* Light Mode: Status badges */
    body:not(.dark-mode) .status-badge-active {
      background: rgba(16, 185, 129, 0.15);
      color: #047857;
      border: 1px solid rgba(16, 185, 129, 0.3);
    }

    body:not(.dark-mode) .status-badge-completed {
      background: rgba(59, 130, 246, 0.15);
      color: #1e40af;
      border: 1px solid rgba(59, 130, 246, 0.3);
    }

    /* Light Mode: Active shift header badge */
    body:not(.dark-mode) .active-status-badge {
      background: rgba(16, 185, 129, 0.15);
      color: #047857;
      border: 1px solid rgba(16, 185, 129, 0.3);
    }

    body:not(.dark-mode) .active-status-badge .pulse-dot {
      background: #10b981;
    }

    /* Light Mode: Progress bar background */
    body:not(.dark-mode) .progress-bg {
      background: rgba(229, 231, 235, 0.5);
    }

    /* Light Mode: Time and date colors */
    body:not(.dark-mode) .time-value {
      color: #059669;
    }

    body:not(.dark-mode) .date-value {
      color: #6b7280;
    }

    /* Light Mode: Stat values */
    body:not(.dark-mode) .stat-sales {
      color: #059669;
    }

    body:not(.dark-mode) .stat-sessions {
      color: #2563eb;
    }

    body:not(.dark-mode) .stat-orders {
      color: #7c3aed;
    }

    .search-input-admin {
      background: rgba(255, 255, 255, 0.06);
      border: 1px solid rgba(255, 255, 255, 0.15);
      color: #e5e7eb;
    }

    body.dark-mode .search-input-admin {
      background: rgba(15, 23, 42, 0.5);
      border-color: #334155;
      color: #e2e8f0;
    }

    .search-input-admin::placeholder {
      color: #9ca3af;
    }

    body.dark-mode .search-input-admin::placeholder {
      color: #6b7280;
    }

    /* Table */
    .admin-table {
      background: white;
    }

    body.dark-mode .admin-table {
      background: #1e293b;
    }

    .admin-table tbody td {
      color: #374151;
    }

    body.dark-mode .admin-table tbody td {
      color: #cbd5e1;
    }

    .employee-row {
      border-color: #e5e7eb;
    }

    body.dark-mode .employee-row {
      border-color: #334155;
    }

    .employee-row:hover {
      background: #f9fafb;
    }

    body.dark-mode .employee-row:hover {
      background: rgba(255, 255, 255, 0.05);
    }

    /* Input Hours */
    .hours-input {
      background: white;
      border: 2px solid #e5e7eb;
      color: #1f2937;
    }

    body.dark-mode .hours-input {
      background: rgba(15, 23, 42, 0.5);
      border-color: #334155;
      color: #e2e8f0;
    }

    /* Responsive */
    @media (max-width: 768px) {
      .header-wrapper,
      .page-wrapper {
        width: 100%;
        padding-left: 12px;
        padding-right: 12px;
      }

      .header {
        padding: 12px 15px;
      }

      .logo {
        font-size: 1.3rem;
      }

      .main-content {
        padding: 18px;
      }
    }

    /* Toolbar sizing */
    .toolbar-btn {
      min-width: 90px;
      height: 40px;
      display: inline-flex;
      align-items: center;
      justify-content: center;
      border-radius: 8px;
      font-weight: 600;
      font-size: 0.85rem;
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
      padding: 0 12px;
    }

    .search-input-admin {
      height: 40px !important;
      font-size: 0.85rem;
    }

    .date-input {
      min-width: 120px;
      width: 100%;
      max-width: 180px;
    }

    .admin-section-title {
      font-size: 1.1rem !important;
    }

    .admin-table {
      font-size: 0.75rem;
      min-width: 1100px;
      /* ensure horizontal scroll shows full table on small screens */
    }

    .admin-table th,
    .admin-table td {
      padding: 8px 6px !important;
      white-space: nowrap;
      text-overflow: ellipsis;
      overflow: hidden;
    }

    /* Hide less important columns on mobile */
    @media (max-width: 640px) {

      /* Do NOT hide columns; allow horizontal scroll to show all */
      .admin-table th,
      .admin-table td {
        display: table-cell !important;
      }

      .admin-table {
        min-width: 1100px;
      }

      /* Allow wrapping on small screens for time cells to avoid clipping */
      .admin-table td:nth-child(6),
      .admin-table td:nth-child(7),
      .admin-table td:nth-child(8),
      .admin-table td:nth-child(9) {
        white-space: normal;
      }
    }

    /* Custom Dropdown Styles */
    .employee-option:hover {
      background: rgba(59, 130, 246, 0.1);
    }

    .employee-option:active {
      transform: scale(0.98);
    }

    body.dark-mode .employee-option:hover {
      background: rgba(100, 116, 139, 0.3);
    }

    #employeeDropdown {
      animation: slideDown 0.2s ease-out;
    }

    @keyframes slideDown {
      from {
        opacity: 0;
        transform: translateY(-10px);
      }

      to {
        opacity: 1;
        transform: translateY(0);
      }
    }

    /* Scrollbar styling */
    #employeeDropdown ::-webkit-scrollbar {
      width: 6px;
    }

    #employeeDropdown ::-webkit-scrollbar-track {
      background: #f1f5f9;
      border-radius: 10px;
    }

    body.dark-mode #employeeDropdown ::-webkit-scrollbar-track {
      background: #1e293b;
    }

    #employeeDropdown ::-webkit-scrollbar-thumb {
      background: #cbd5e1;
      border-radius: 10px;
    }

    body.dark-mode #employeeDropdown ::-webkit-scrollbar-thumb {
      background: #475569;
    }

    #employeeDropdown ::-webkit-scrollbar-thumb:hover {
      background: #94a3b8;
    }
  </style>
</head>

<body class="dark-mode">
    <!-- SheetJS (Excel Export) -->
  <script
    src="https://cdn.sheetjs.com/xlsx-0.20.1/package/dist/xlsx.full.min.js">
  </script>

  <!-- Header - outside page wrapper for full-width alignment -->
  <div class="header-wrapper">
    <div class="header fade-in">
      <div class="logo" onclick="window.location.href='dashboard.php'">
        <i class="fas fa-clock"></i>
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
          <button class="user-btn" onclick="window.location.href='logout.php'">
            <i class="fas fa-user"></i>
            <span>admin_mahmoud_atef</span>
            <i class="fas fa-sign-out-alt"></i>
          </button>
        </div>
      </div>
    </div>
  </div><!-- /header-wrapper -->

  <!-- Page Content -->
  <div class="page-wrapper">
    <!-- Main Content -->
    <div class="main-content fade-in">
      <!-- Page Title -->
      <div class="page-title">
        <i class="fas fa-clock"></i>
        إدارة الشيفتات
      </div>

              <!-- Active Shift Card -->
        <div
          class="active-shift-card bg-white/10 backdrop-blur-md rounded-2xl shadow-xl p-4 sm:p-6 mb-6 slide-up border border-white/20">
          <div class="flex items-center justify-between mb-6">
            <h3
              class="card-title text-xl sm:text-2xl font-bold text-white flex items-center gap-2">
              <i class="fas fa-clock text-emerald-400"></i>
              الشيفت النشط
            </h3>
            <span
              class="active-status-badge px-3 py-1 bg-emerald-500/20 text-emerald-400 rounded-full text-sm font-semibold flex items-center gap-1">
              <span
                class="pulse-dot w-2 h-2 bg-emerald-400 rounded-full animate-pulse"></span>
              نشط
            </span>
          </div>

          <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-6 gap-4 mb-6">
            <!-- Employee Name -->
            <div
              class="stat-box bg-white/5 rounded-xl p-4 hover:bg-white/10 transition-all">
              <div class="card-label text-white/60 text-xs mb-1">الموظف</div>
              <div class="card-value text-white font-bold text-sm truncate">
                admin_mahmoud_atef</div>
            </div>

            <!-- Start Time -->
            <div
              class="stat-box bg-white/5 rounded-xl p-4 hover:bg-white/10 transition-all">
              <div class="card-label text-white/60 text-xs mb-1">وقت البداية</div>
              <div class="time-value text-emerald-400 font-bold text-sm">
                10:46 AM              </div>
              <div class="date-value text-white/50 text-xs">
                2026-06-01              </div>
            </div>

            <!-- Duration -->
            <div
              class="stat-box col-span-2 bg-white/5 rounded-xl p-4 hover:bg-white/10 transition-all">
              <div
                class="card-label text-white/60 text-xs mb-2 flex items-center justify-between">
                <span>مدة العمل</span>
                <span class="text-xs">المطلوب:
                  8                  ساعة</span>
              </div>
              <div class="text-emerald-400 font-bold text-lg mb-2"
                id="work-duration"
                data-start-time="2026-06-01 10:46:04"
                data-required-hours="8">
                0:21:40              </div>
              <div
                class="progress-bg w-full h-2 bg-white/10 rounded-full overflow-hidden">
                <div
                  class="h-full bg-gradient-to-r from-emerald-500 to-green-400 rounded-full progress-fill relative"
                  id="progress-fill" style="width: 0%"></div>
              </div>
            </div>

            <!-- Sales -->
            <div
              class="stat-box bg-white/5 rounded-xl p-4 hover:bg-white/10 transition-all">
              <div class="card-label text-white/60 text-xs mb-1">المبيعات</div>
              <div
                class="stat-sales text-emerald-400 font-bold text-lg sales-value">
                0.00</div>
              <div class="text-white/50 text-xs">جنيه</div>
            </div>

            <!-- Sessions -->
            <div
              class="stat-box bg-white/5 rounded-xl p-4 hover:bg-white/10 transition-all">
              <div class="card-label text-white/60 text-xs mb-1">الجلسات</div>
              <div
                class="stat-sessions text-blue-400 font-bold text-lg sessions-count">
                2</div>
              <div class="text-white/50 text-xs">جلسة</div>
            </div>

            <!-- Orders -->
            <div
              class="stat-box bg-white/5 rounded-xl p-4 hover:bg-white/10 transition-all">
              <div class="card-label text-white/60 text-xs mb-1">الطلبات</div>
              <div
                class="stat-orders text-purple-400 font-bold text-lg orders-count">
                0</div>
              <div class="text-white/50 text-xs">طلب</div>
            </div>
          </div>

          <!-- End Shift Button -->
          <div class="flex justify-center">
            <button onclick="showEndShiftModal()"
              class="px-6 py-3 bg-gradient-to-r from-red-500 to-red-600 hover:from-red-600 hover:to-red-700 text-white rounded-xl font-semibold transition-all hover:scale-105 shadow-lg flex items-center gap-2">
              <i class="fas fa-stop-circle"></i>
              إنهاء الشيفت
            </button>
          </div>
        </div>
      
      <!-- Admin: Employee Management Section -->
              <div class="shift-card rounded-2xl shadow-xl p-4 sm:p-6 mb-6 border"
          style="animation: fadeIn 0.6s ease-out; border-color: rgba(226, 232, 240, 0.5);">
          <div
            class="flex flex-col sm:flex-row items-start sm:items-center justify-between mb-6 gap-4">
            <h3
              class="text-xl sm:text-2xl font-bold flex items-center gap-2 admin-section-title">
              <i class="fas fa-users" style="color: #667eea;"></i>
              إدارة الموظفين والشيفتات
            </h3>

            <!-- Search and Filter - Responsive Layout -->
            <div class="w-full space-y-3 lg:space-y-0">
              <!-- Desktop: All filters on one line, Mobile: Stacked -->
              <div
                class="flex flex-col lg:flex-row lg:items-center gap-2 lg:gap-3 mb-4">
                <!-- Date Filters -->
                <div class="flex flex-wrap items-center gap-2">
                  <input type="date" id="shiftFromDate" placeholder="من تاريخ"
                    class="search-input-admin date-input rounded-lg transition-all text-sm flex-1 min-w-[140px]"
                    value="2026-06-01">
                  <input type="date" id="shiftToDate" placeholder="إلى تاريخ"
                    class="search-input-admin date-input rounded-lg transition-all text-sm flex-1 min-w-[140px]"
                    value="2026-06-01">
                  <button onclick="applyDateFilters()"
                    class="toolbar-btn flex-shrink-0"
                    style="background: linear-gradient(135deg, #0ea5e9 0%, #0284c7 100%); color: white;">
                    <i class="fas fa-calendar-check"></i>
                    <span class="hidden sm:inline mr-1">تصفية</span>
                  </button>
                </div>

                <!-- Quick Ranges -->
                <div class="flex flex-wrap items-center gap-2">
                  <button onclick="setQuickRange('week')"
                    class="toolbar-btn flex-1 sm:flex-initial"
                    style="background: linear-gradient(135deg, #10b981 0%, #059669 100%); color: white;">
                    <i class="fas fa-calendar-week"></i>
                    <span class="mr-1">آخر أسبوع</span>
                  </button>
                  <button onclick="setQuickRange('month')"
                    class="toolbar-btn flex-1 sm:flex-initial"
                    style="background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%); color: white;">
                    <i class="fas fa-calendar-alt"></i>
                    <span class="mr-1">آخر 30 يوم</span>
                  </button>
                </div>
              </div>

              <!-- Row 3: Employee Filter and Actions -->
              <div class="flex flex-wrap items-center gap-2">
                <div class="relative flex-1 min-w-[200px] sm:max-w-[280px]"
                  id="employeeFilterWrapper">
                  <button type="button" onclick="toggleEmployeeDropdown()"
                    class="search-input-admin w-full h-11 px-4 pr-10 rounded-lg transition-all text-sm flex items-center justify-between hover:border-blue-400 focus:outline-none focus:ring-2 focus:ring-blue-500"
                    style="text-align: right;">
                    <span id="selectedEmployeeName" class="truncate">جميع
                      الموظفين</span>
                    <i class="fas fa-chevron-down text-gray-400 transition-transform duration-200"
                      id="dropdownIcon"></i>
                  </button>
                  <i class="fas fa-filter absolute right-3 top-1/2 transform -translate-y-1/2 pointer-events-none"
                    style="color: #9ca3af;"></i>

                  <!-- Dropdown Menu -->
                  <div id="employeeDropdown"
                    class="absolute z-50 w-full mt-2 bg-white dark:bg-slate-800 rounded-lg shadow-2xl border border-gray-200 dark:border-slate-700 hidden overflow-hidden"
                    style="max-height: 200px;">
                    <!-- Search Box -->
                    <div
                      class="p-3 border-b border-gray-200 dark:border-slate-700">
                      <div class="relative">
                        <input type="text" id="employeeSearch"
                          placeholder="ابحث عن موظف..."
                          class="w-full px-4 py-2 pr-10 text-sm border border-gray-300 dark:border-slate-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 dark:bg-slate-700 dark:text-white"
                          oninput="filterEmployeeList()">
                        <i
                          class="fas fa-search absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                      </div>
                    </div>

                    <!-- Employee List -->
                    <div class="overflow-y-auto" style="max-height: 130px;">
                      <button type="button"
                        onclick="selectEmployee('', 'جميع الموظفين')"
                        class="employee-option w-full px-4 py-3 text-right hover:bg-blue-50 dark:hover:bg-slate-700 transition-colors flex items-center gap-3 border-b border-gray-100 dark:border-slate-700"
                        data-name="جميع الموظفين">
                        <div
                          class="w-8 h-8 rounded-full bg-gradient-to-br from-blue-500 to-purple-600 flex items-center justify-center flex-shrink-0">
                          <i class="fas fa-users text-white text-xs"></i>
                        </div>
                        <span class="text-sm font-medium dark:text-white">جميع
                          الموظفين</span>
                      </button>
                      <div id="employeeListContainer"></div>
                    </div>
                  </div>
                </div>
                                                  <button onclick="exportShiftsExcel()"
                    class="toolbar-btn flex-1 sm:flex-initial hover:scale-105"
                    style="background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%); color: white;">
                    <i class="fas fa-file-excel"></i>
                    <span class="mr-1">تصدير</span>
                  </button>
                                <button onclick="refreshEmployeeData()"
                  class="toolbar-btn flex-shrink-0"
                  style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white;"
                  title="تحديث البيانات">
                  <i class="fas fa-sync-alt"></i>
                </button>
              </div>
            </div>
          </div>

          <!-- Employees Table -->
          <div class="overflow-x-auto rounded-lg border"
            style="border-color: #334155; padding-bottom: 12px; -webkit-overflow-scrolling: touch;">
            <table class="w-full admin-table" id="employeesTable">
              <thead
                style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
                <tr>
                  <th class="text-white text-sm font-semibold p-3 text-right">
                    الموظف</th>
                  <th class="text-white text-sm font-semibold p-3 text-right">رقم
                    الهاتف</th>
                  <th class="text-white text-sm font-semibold p-3 text-right">
                    التاريخ</th>
                  <th class="text-white text-sm font-semibold p-3 text-center">
                    الساعات المطلوبة</th>
                  <th class="text-white text-sm font-semibold p-3 text-right">
                    بداية الشيفت</th>
                  <th class="text-white text-sm font-semibold p-3 text-right">
                    نهاية الشيفت</th>
                  <th class="text-white text-sm font-semibold p-3 text-right">
                    الساعات الفعلية</th>
                  <th class="text-white text-sm font-semibold p-3 text-right">
                    المتبقي حتى المطلوب</th>
                  <th class="text-white text-sm font-semibold p-3 text-right">
                    التأخير</th>
                  <th class="text-white text-sm font-semibold p-3 text-right">راتب
                    اليوم</th>
                  <th class="text-white text-sm font-semibold p-3 text-right">
                    المستحق اليوم</th>
                  <th class="text-white text-sm font-semibold p-3 text-right">
                    المبيعات الحالية</th>
                </tr>
              </thead>
              <tbody id="employeesTableBody" style="color: #cbd5e1;">
                <tr>
                  <td colspan="12" class="p-8 text-center"
                    style="color: #94a3b8;">
                    <i class="fas fa-spinner fa-spin text-2xl mb-2"></i>
                    <p>جاري تحميل بيانات الموظفين...</p>
                  </td>
                </tr>
              </tbody>
              <tfoot id="employeesTableFooter" class="hidden">
                <tr
                  class="bg-gradient-to-r from-slate-700/50 to-slate-600/50 border-t-2 border-slate-500">
                  <td colspan="3" class="text-white font-bold p-3 text-right">
                    <i class="fas fa-calculator mr-2"></i>المجموع الكلي:
                  </td>
                  <td id="totalRequiredHours"
                    class="text-emerald-400 font-bold p-3 text-center">-</td>
                  <td id="totalStartTime"
                    class="text-blue-400 font-bold p-3 text-center">-</td>
                  <td id="totalEndTime"
                    class="text-blue-400 font-bold p-3 text-center">-</td>
                  <td id="totalActualHours"
                    class="text-purple-400 font-bold p-3 text-center">-</td>
                  <td id="totalRemainingHours"
                    class="text-orange-400 font-bold p-3 text-center">-</td>
                  <td id="totalLateness"
                    class="text-red-400 font-bold p-3 text-center">-</td>
                  <td id="totalDailyWage"
                    class="text-yellow-400 font-bold p-3 text-center">-</td>
                  <td id="totalPayableAmount"
                    class="text-green-400 font-bold p-3 text-center">-</td>
                  <td id="totalCurrentSales"
                    class="text-cyan-400 font-bold p-3 text-center">-</td>
                </tr>
              </tfoot>
            </table>
          </div>

          <!-- Pagination for Shifts -->
                  </div>
      



    </div>
  </div><!-- /page-wrapper -->

  <!-- End Shift Modal -->
    <div id="endShiftModal"
      class="fixed inset-0 bg-black/50 backdrop-blur-sm z-50 hidden items-center justify-center p-4">
      <div
        class="bg-slate-800 rounded-2xl shadow-2xl max-w-md w-full p-6 fade-in border border-slate-700">
        <h3 class="text-xl font-bold text-white mb-4 flex items-center gap-2">
          <i class="fas fa-stop-circle text-red-400"></i>
          إنهاء الشيفت
        </h3>
        <p class="text-white/70 mb-4">هل أنت متأكد من إنهاء الشيفت؟</p>

        <!-- Notes -->
        <div class="mb-4">
          <label class="block text-white text-sm font-semibold mb-2">
            ملاحظات الشيفت <span class="text-white/50 text-xs">(اختياري)</span>
          </label>
          <textarea id="shiftNotes"
            class="w-full bg-white/5 border border-white/20 rounded-lg px-4 py-3 text-white placeholder-white/50 focus:outline-none focus:ring-2 focus:ring-red-400 resize-none"
            rows="3" maxlength="500"
            placeholder="اكتب أي ملاحظات هنا..."></textarea>
          <div class="text-right text-xs text-white/50 mt-1">
            <span id="charCount">0</span>/500
          </div>
        </div>

        <div class="flex gap-3">
          <button onclick="confirmEndShift()"
            class="flex-1 px-4 py-3 bg-gradient-to-r from-red-500 to-red-600 hover:from-red-600 hover:to-red-700 text-white rounded-lg font-semibold transition-all">
            <i class="fas fa-check mr-1"></i>تأكيد الإنهاء
          </button>
          <button onclick="closeEndShiftModal()"
            class="flex-1 px-4 py-3 bg-white/10 hover:bg-white/20 text-white rounded-lg font-semibold transition-all">
            <i class="fas fa-times mr-1"></i>إلغاء
          </button>
        </div>
      </div>
    </div>

    <!-- Toast Notification -->
    <div id="toast"
      class="fixed top-4 left-1/2 transform -translate-x-1/2 z-50 hidden">
      <div
        class="bg-slate-800 border border-slate-700 rounded-xl shadow-2xl px-6 py-4 flex items-center gap-3 fade-in">
        <i id="toastIcon" class="text-2xl"></i>
        <span id="toastMessage" class="text-white font-semibold"></span>
      </div>
    </div>

    <script>
      function showUpgradeShiftsExportModal() {
        if (document.getElementById('upgradeCustomersOverlay')) return;
        const overlay = document.createElement('div');
        overlay.id = 'upgradeCustomersOverlay';
        overlay.className = 'fixed inset-0 z-[99999] flex items-center justify-center p-4';
        overlay.style.background = 'rgba(0,0,0,.55)';

        const card = document.createElement('div');
        card.className = 'w-full max-w-md rounded-2xl overflow-hidden shadow-2xl';
        card.innerHTML = `
        <div class="bg-gradient-to-r from-indigo-600 to-purple-600 text-white p-5 flex items-center gap-3">
          <div class="w-10 h-10 bg-white/20 rounded-lg flex items-center justify-center">
            <i class="fas fa-rocket"></i>
          </div>
          <h3 class="text-lg font-bold">ترقية مطلوبة لتصدير تقارير الشيفتات</h3>
        </div>
        <div class="bg-white p-6 text-right" dir="rtl">
          <p class="text-gray-700 leading-7 mb-4">للاستفادة من ميزة <strong>تصدير تقارير الشيفتات</strong>، يرجى ترقية خطتك من صفحة الباقات.</p>
          <ul class="text-gray-600 text-sm space-y-2 mb-5">
            <li class="flex items-center gap-2"><i class="fas fa-check text-emerald-500"></i> تصدير Excel لسجل الشيفتات</li>
            <li class="flex items-center gap-2"><i class="fas fa-check text-emerald-500"></i> تتبع الساعات والرواتب</li>
            <li class="flex items-center gap-2"><i class="fas fa-check text-emerald-500"></i> تحليل الأداء</li>
          </ul>
          <div class="flex items-center justify-end gap-3">
            <button onclick="document.getElementById('upgradeCustomersOverlay').remove()" class="px-4 py-2 rounded-lg font-semibold text-white" style="background:#111827;">لاحقاً</button>
            <a href="subscription-upgrade.php" class="px-4 py-2 rounded-lg text-white bg-gradient-to-r from-indigo-600 to-purple-600 hover:opacity-95">الترقية الآن</a>
          </div>
        </div>`;

        overlay.appendChild(card);
        overlay.addEventListener('click', (e) => {
          if (e.target === overlay) overlay.remove();
        });
        document.body.appendChild(overlay);
      }
      // Dark Mode Toggle - Synced across all pages
      function toggleDarkMode() {
        const body = document.body;
        const icon = document.getElementById('dark-mode-icon');

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

        // Save to database (for persistence across devices)
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
          .catch(err => {
            // Error saving dark mode
          });
      }

      // Listen for dark mode changes from other tabs/pages
      window.addEventListener('storage', function(e) {
        if (e.key === 'darkMode' || e.key === 'darkModeChanged') {
          const darkMode = localStorage.getItem('darkMode') === 'true';
          const body = document.body;
          const icon = document.getElementById('dark-mode-icon');

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

      // Initialize Dark Mode from database preference
      document.addEventListener('DOMContentLoaded', function() {
        const icon = document.getElementById('dark-mode-icon');
        const body = document.body;

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
      });

      // Show Toast
      function showToast(message, type = 'success') {
        const toast = document.getElementById('toast');
        const icon = document.getElementById('toastIcon');
        const messageEl = document.getElementById('toastMessage');

        if (type === 'success') {
          icon.className = 'fas fa-check-circle text-emerald-400 text-2xl';
        } else if (type === 'error') {
          icon.className = 'fas fa-times-circle text-red-400 text-2xl';
        } else {
          icon.className = 'fas fa-info-circle text-blue-400 text-2xl';
        }

        messageEl.textContent = message;
        toast.classList.remove('hidden');

        setTimeout(() => {
          toast.classList.add('hidden');
        }, 3000);
      }

      // Start Shift
      async function startShift() {
        try {
          const response = await fetch('api/shift-actions.php', {
            method: 'POST',
            headers: {
              'Content-Type': 'application/json'
            },
            body: JSON.stringify({
              action: 'start_shift'
            })
          });

          const data = await response.json();

          if (data.success) {
            showToast(data.message, 'success');
            setTimeout(() => window.location.reload(), 1500);
          } else {
            showToast(data.message, 'error');
          }
        } catch (error) {
          showToast('حدث خطأ في الاتصال', 'error');
        }
      }

      // Show End Shift Modal
      function showEndShiftModal() {
        document.getElementById('endShiftModal').classList.remove('hidden');
        document.getElementById('endShiftModal').classList.add('flex');
      }

      // Close End Shift Modal
      function closeEndShiftModal() {
        document.getElementById('endShiftModal').classList.add('hidden');
        document.getElementById('endShiftModal').classList.remove('flex');
      }

      // Confirm End Shift
      async function confirmEndShift() {
        const notes = document.getElementById('shiftNotes').value;
        const shiftId = 520;

        try {
          const response = await fetch('api/shift-actions.php', {
            method: 'POST',
            headers: {
              'Content-Type': 'application/json'
            },
            body: JSON.stringify({
              action: 'end_shift',
              shift_id: shiftId,
              notes: notes
            })
          });

          const data = await response.json();

          if (data.success) {
            closeEndShiftModal();
            showToast(data.message + ' - المبيعات: ' + data.total_sales +
              ' ' + CURRENCY_SYMBOL,
              'success');
            setTimeout(() => window.location.reload(), 2000);
          } else {
            showToast(data.message, 'error');
          }
        } catch (error) {
          showToast('حدث خطأ في الاتصال', 'error');
        }
      }

      // Character Counter
      document.getElementById('shiftNotes')?.addEventListener('input',
        function() {
          const count = this.value.length;
          document.getElementById('charCount').textContent = count;
        });

      // Update Work Duration
      function updateWorkDuration() {
        const durationElement = document.getElementById('work-duration');
        const progressFill = document.getElementById('progress-fill');

        if (durationElement) {
          const startTime = new Date(durationElement.dataset.startTime);
          const requiredHours = parseInt(durationElement.dataset.requiredHours);
          const now = new Date();

          const diffMs = now - startTime;
          if (diffMs < 0) {
            durationElement.textContent = '0:00:00';
            if (progressFill) progressFill.style.width = '0%';
            return;
          }

          const diffHours = Math.floor(diffMs / (1000 * 60 * 60));
          const diffMinutes = Math.floor((diffMs % (1000 * 60 * 60)) / (1000 *
            60));
          const diffSeconds = Math.floor((diffMs % (1000 * 60)) / 1000);

          const hours = diffHours.toString().padStart(1, '0');
          const minutes = diffMinutes.toString().padStart(2, '0');
          const seconds = diffSeconds.toString().padStart(2, '0');

          durationElement.textContent = `${hours}:${minutes}:${seconds}`;

          if (progressFill) {
            const progress = Math.min(((diffMs / (1000 * 60 * 60)) /
              requiredHours) * 100, 100);
            progressFill.style.width = progress + '%';
          }
        }
      }

      // Update Stats
      async function updateShiftStats() {
        if (document.getElementById('work-duration')) {
          const shiftId = 520;

          try {
            const response = await fetch('api/shift-actions.php', {
              method: 'POST',
              headers: {
                'Content-Type': 'application/json'
              },
              body: JSON.stringify({
                action: 'update_stats',
                shift_id: shiftId
              })
            });

            const data = await response.json();

            if (data.success) {
              document.querySelector('.sales-value').textContent = data.sales;
              document.querySelector('.sessions-count').textContent = data
                .sessions;
              document.querySelector('.orders-count').textContent = data.orders;
            }
          } catch (error) {
            // Silent fail for stats update
          }
        }
      }

      // ===== Admin: Employee Management Functions =====
      let employeesData = [];
      let currentPage = 1;
      const itemsPerPage = 32;

      // Load employees data
      async function loadEmployeesData() {
        
        try {
          const fromDate = document.getElementById('shiftFromDate') ? document
            .getElementById('shiftFromDate').value : '';
          const toDate = document.getElementById('shiftToDate') ? document
            .getElementById('shiftToDate').value : '';

          const response = await fetch('api/shift-actions.php', {
            method: 'POST',
            headers: {
              'Content-Type': 'application/json'
            },
            body: JSON.stringify({
              action: 'list_employees_shifts',
              from_date: fromDate || '',
              to_date: toDate || ''
            })
          });

          const data = await response.json();

          if (data.success) {
            employeesData = data.employees;
            // Employee data loaded successfully
            renderEmployeesTable();
          }
        } catch (error) {
          document.getElementById('employeesTableBody').innerHTML = `
        <tr><td colspan="12" class="p-8 text-center" style="color: #f87171;">
          <i class="fas fa-exclamation-circle text-2xl mb-2"></i>
          <p>حدث خطأ في تحميل البيانات</p>
        </td></tr>
      `;
        }
      }

      // Toggle employee dropdown
      let selectedEmployeeId = '';

      function toggleEmployeeDropdown() {
        const dropdown = document.getElementById('employeeDropdown');
        const icon = document.getElementById('dropdownIcon');

        if (dropdown.classList.contains('hidden')) {
          dropdown.classList.remove('hidden');
          icon.classList.add('rotate-180');
          document.getElementById('employeeSearch').focus();
        } else {
          dropdown.classList.add('hidden');
          icon.classList.remove('rotate-180');
        }
      }

      // Close dropdown when clicking outside
      document.addEventListener('click', function(event) {
        const wrapper = document.getElementById('employeeFilterWrapper');
        const dropdown = document.getElementById('employeeDropdown');
        if (wrapper && !wrapper.contains(event.target)) {
          dropdown?.classList.add('hidden');
          document.getElementById('dropdownIcon')?.classList.remove(
            'rotate-180');
        }
      });

      // Select employee
      function selectEmployee(employeeId, employeeName) {
        selectedEmployeeId = employeeId;
        document.getElementById('selectedEmployeeName').textContent =
          employeeName;
        document.getElementById('employeeDropdown').classList.add('hidden');
        document.getElementById('dropdownIcon').classList.remove('rotate-180');
        filterByEmployee();
      }

      // Filter employee list in dropdown
      function filterEmployeeList() {
        const searchTerm = document.getElementById('employeeSearch').value
          .toLowerCase();
        const options = document.querySelectorAll('.employee-option');

        options.forEach(option => {
          const name = option.getAttribute('data-name').toLowerCase();
          if (name.includes(searchTerm)) {
            option.classList.remove('hidden');
          } else {
            option.classList.add('hidden');
          }
        });
      }

      // Render employees table
      function renderEmployeesTable() {
        const tbody = document.getElementById('employeesTableBody');
        const listContainer = document.getElementById('employeeListContainer');

        // Update employee filter dropdown
        if (listContainer && employeesData.length > 0) {
          listContainer.innerHTML = employeesData.map(emp => {
            const name = emp.full_name || emp.username;
            const initials = name.split(' ').map(n => n[0]).join('')
              .substring(0, 2).toUpperCase();
            const colors = [
              'from-red-500 to-pink-600',
              'from-green-500 to-teal-600',
              'from-yellow-500 to-orange-600',
              'from-purple-500 to-indigo-600',
              'from-blue-500 to-cyan-600'
            ];
            const colorClass = colors[Math.floor(Math.random() * colors
              .length)];

            return `
            <button type="button"
              onclick="selectEmployee('${emp.employee_id}', '${name}')"
              class="employee-option w-full px-4 py-3 text-right hover:bg-blue-50 dark:hover:bg-slate-700 transition-colors flex items-center gap-3 border-b border-gray-100 dark:border-slate-700"
              data-name="${name}">
              <div class="w-8 h-8 rounded-full bg-gradient-to-br ${colorClass} flex items-center justify-center flex-shrink-0">
                <span class="text-white text-xs font-bold">${initials}</span>
              </div>
              <div class="flex-1 text-right">
                <div class="text-sm font-medium dark:text-white">${name}</div>
              </div>
            </button>
          `;
          }).join('');
        }

        // Filter employees based on selection
        const filteredData = selectedEmployeeId ?
          employeesData.filter(emp => emp.employee_id == selectedEmployeeId) :
          employeesData;

        if (filteredData.length === 0) {
          tbody.innerHTML = `
        <tr><td colspan="12" class="p-8 text-center" style="color: #94a3b8;">
          <i class="fas fa-users-slash text-3xl mb-2"></i>
          <p>لا توجد بيانات للعرض</p>
        </td></tr>
      `;
          return;
        }

        const isDark = document.body.classList.contains('dark-mode');

        tbody.innerHTML = filteredData.map(emp => {
          // Format date and time
          // إذا كان هناك اختيار موظف محدد ومعه شيفتات، اعرض كل الشيفتات الخاصة به
          if (selectedEmployeeId && emp.shifts && emp.shifts.length > 0) {
            return emp.shifts.map(shift => {
              const startDateObj = shift.start_time ? new Date(shift
                .start_time) : null;
              const endDateObj = shift.end_time ? new Date(shift
                .end_time) : null;
              const shiftDate = startDateObj ? startDateObj
                .toLocaleDateString('ar-EG', {
                  year: 'numeric',
                  month: '2-digit',
                  day: '2-digit'
                }) : '-';
              const startTime = startDateObj ? startDateObj
                .toLocaleTimeString('ar-EG', {
                  hour: '2-digit',
                  minute: '2-digit',
                  hour12: true
                }) : '-';
              const endTime = endDateObj ? endDateObj.toLocaleTimeString(
                'ar-EG', {
                  hour: '2-digit',
                  minute: '2-digit',
                  hour12: true
                }) : (shift.status === 'active' ? 'جاري العمل' : '-');

              // حسابات HR لكل شيفت على حدة
              const fixedHours = Number(emp.fixed_hours || 8);
              const fixedMinutes = Math.max(1, Math.min(24, fixedHours)) *
                60;
              const perMinuteRate = fixedMinutes > 0 ? (Number(emp
                .daily_wage || 0) / fixedMinutes) : 0;

              const actualEnd = endDateObj || new Date();
              const actualMs = startDateObj ? Math.max(0, actualEnd
                .getTime() - startDateObj.getTime()) : 0;
              const actualMins = Math.floor(actualMs / 60000);
              const actualH = Math.floor(actualMins / 60);
              const actualM = actualMins % 60;
              const actualTime =
                `${actualH}:${actualM.toString().padStart(2, '0')}`;

              // التأخير
              let latenessMins = 0;
              if (startDateObj && emp.shift_start_time) {
                const yyyy = startDateObj.getFullYear();
                const mm = String(startDateObj.getMonth() + 1).padStart(2,
                  '0');
                const dd = String(startDateObj.getDate()).padStart(2,
                  '0');
                const scheduledIso =
                  `${yyyy}-${mm}-${dd}T${emp.shift_start_time}`;
                const scheduled = new Date(scheduledIso);
                const diff = Math.floor((startDateObj.getTime() -
                  scheduled.getTime()) / 60000);
                latenessMins = diff > 0 ? diff : 0;
              }
              const latenessH = Math.floor(latenessMins / 60);
              const latenessM = latenessMins % 60;
              const latenessTime = latenessMins > 0 ?
                `${latenessH}:${latenessM.toString().padStart(2, '0')}` :
                '0:00';

              const remainingMins = Math.max(0, fixedMinutes -
                actualMins);
              const remainingH = Math.floor(remainingMins / 60);
              const remainingM = remainingMins % 60;
              const remainingTime = remainingMins > 0 ?
                `${remainingH}:${remainingM.toString().padStart(2, '0')}` :
                '0:00';

              const workedMins = Math.max(0, actualMins - latenessMins);
              const payableMins = Math.min(workedMins, fixedMinutes);
              const payableAmount = Math.round(payableMins *
                perMinuteRate * 100) / 100;

              const sales = typeof shift.total_sales !== 'undefined' ?
                Number(shift.total_sales) : 0;

              return `
            <tr class="border-b transition-colors employee-row" data-employee-id="${emp.employee_id}">
              <td class="p-3 text-sm font-semibold">${emp.full_name || emp.username || '-'}</td>
              <td class="p-3 text-sm">${emp.phone || '-'}</td>
              <td class="p-3 text-sm">${shiftDate}</td>
              <td class="p-3 text-center">
                <span class="font-semibold">${emp.fixed_hours || 8}</span>
                <span class="text-xs" style="color: ${isDark ? '#94a3b8' : '#6b7280'};">س</span>
              </td>
              <td class="p-3 text-sm">${startTime}</td>
              <td class="p-3 text-sm">${endTime}</td>
              <td class="p-3 text-sm font-semibold" style="color: ${isDark ? '#60a5fa' : '#2563eb'};">${actualTime}</td>
              <td class="p-3 text-sm font-semibold" style="color: ${isDark ? '#fbbf24' : '#d97706'};">${remainingTime}</td>
              <td class="p-3 text-sm font-semibold" style="color: ${isDark ? '#f87171' : '#dc2626'};">${latenessTime}</td>
              <td class="p-3 text-sm font-semibold">${Number(emp.daily_wage || 0).toFixed(2)} ${CURRENCY_SYMBOL}</td>
              <td class="p-3 text-sm font-bold" style="color: ${isDark ? '#34d399' : '#059669'};">${payableAmount.toFixed(2)} ${CURRENCY_SYMBOL}</td>
              <td class="p-3 text-sm font-bold" style="color: ${isDark ? '#10b981' : '#047857'};">${sales.toFixed(2)} ${CURRENCY_SYMBOL}</td>
            </tr>`;
            }).join('');
          }

          // بدون اختيار موظف محدد: صف واحد تلخيصي لكل موظف (أحدث/نشط)
          let shiftDate = '-';
          let startTime = '-';
          let endTime = '-';
          if (emp.start_time) {
            const d = new Date(emp.start_time);
            shiftDate = d.toLocaleDateString('ar-EG', {
              year: 'numeric',
              month: '2-digit',
              day: '2-digit'
            });
            startTime = d.toLocaleTimeString('ar-EG', {
              hour: '2-digit',
              minute: '2-digit',
              hour12: true
            });
          }
          if (emp.end_time) {
            const d = new Date(emp.end_time);
            endTime = d.toLocaleTimeString('ar-EG', {
              hour: '2-digit',
              minute: '2-digit',
              hour12: true
            });
          } else if (emp.shift_status === 'active') {
            endTime = 'جاري العمل';
          }

          const actualMins = Number(emp.actual_minutes || 0);
          const actualH = Math.floor(actualMins / 60);
          const actualM = actualMins % 60;
          const actualTime =
            `${actualH}:${actualM.toString().padStart(2, '0')}`;

          const remainingMins = Number(emp.remaining_minutes || 0);
          const remainingH = Math.floor(remainingMins / 60);
          const remainingM = remainingMins % 60;
          const remainingTime = remainingMins > 0 ?
            `${remainingH}:${remainingM.toString().padStart(2, '0')}` :
            '0:00';

          const latenessMins = Number(emp.lateness_minutes || 0);
          const latenessH = Math.floor(latenessMins / 60);
          const latenessM = latenessMins % 60;
          const latenessTime = latenessMins > 0 ?
            `${latenessH}:${latenessM.toString().padStart(2, '0')}` : '0:00';

          const sales = Number(emp.current_sales || 0);

          return `
        <tr class="border-b transition-colors employee-row" data-employee-id="${emp.employee_id}">
          <td class="p-3 text-sm font-semibold">${emp.full_name || emp.username || '-'}</td>
          <td class="p-3 text-sm">${emp.phone || '-'}</td>
          <td class="p-3 text-sm">${shiftDate}</td>
          <td class="p-3 text-center">
            <span class="font-semibold">${emp.fixed_hours || 8}</span>
            <span class="text-xs" style="color: ${isDark ? '#94a3b8' : '#6b7280'};">س</span>
          </td>
          <td class="p-3 text-sm">${startTime}</td>
          <td class="p-3 text-sm">${endTime}</td>
          <td class="p-3 text-sm font-semibold" style="color: ${isDark ? '#60a5fa' : '#2563eb'};">${actualTime}</td>
          <td class="p-3 text-sm font-semibold" style="color: ${isDark ? '#fbbf24' : '#d97706'};">${remainingTime}</td>
          <td class="p-3 text-sm font-semibold" style="color: ${isDark ? '#f87171' : '#dc2626'};">${latenessTime}</td>
          <td class="p-3 text-sm font-semibold">${Number(emp.daily_wage || 0).toFixed(2)} ${CURRENCY_SYMBOL}</td>
          <td class="p-3 text-sm font-bold" style="color: ${isDark ? '#34d399' : '#059669'};">${Number(emp.payable_amount || 0).toFixed(2)} ${CURRENCY_SYMBOL}</td>
          <td class="p-3 text-sm font-bold" style="color: ${isDark ? '#10b981' : '#047857'};">${sales.toFixed(2)} ${CURRENCY_SYMBOL}</td>
        </tr>`;
        }).join('');

        // Update totals footer (حساب فعلي حسب الصفوف المعروضة)
        updateTotalsFooterFromDOM();

        // عرض كل شيفتات الموظف المختار ضمن المدة داخل نفس الجدول
      }

      // Update totals footer
      function updateTotalsFooter(filteredData) {
        const footer = document.getElementById('employeesTableFooter');

        if (!filteredData || filteredData.length === 0) {
          footer.classList.add('hidden');
          return;
        }

        footer.classList.remove('hidden');

        let totals = {
          totalRequiredHours: 0,
          totalActualHours: 0,
          totalRemainingHours: 0,
          totalLateness: 0,
          totalDailyWage: 0,
          totalPayableAmount: 0,
          totalCurrentSales: 0,
          activeShifts: 0,
          completedShifts: 0
        };

        filteredData.forEach(emp => {
          const requiredHours = emp.fixed_hours || 8;
          const actualHours = (emp.actual_minutes || 0) / 60;
          const remainingHours = (emp.remaining_minutes || 0) / 60;
          const latenessMinutes = emp.lateness_minutes || 0;
          const dailyWage = emp.daily_wage || 0;
          const payableAmount = emp.payable_amount || 0;
          const currentSales = emp.current_sales || 0;

          totals.totalRequiredHours += requiredHours;
          totals.totalActualHours += actualHours;
          totals.totalRemainingHours += remainingHours;
          totals.totalLateness += latenessMinutes;
          totals.totalDailyWage += dailyWage;
          totals.totalPayableAmount += payableAmount;
          totals.totalCurrentSales += currentSales;

          if (emp.shift_status === 'active') {
            totals.activeShifts++;
          } else if (emp.shift_status === 'completed') {
            totals.completedShifts++;
          }
        });

        document.getElementById('totalRequiredHours').textContent =
          `${totals.totalRequiredHours.toFixed(0)} ساعة`;
        document.getElementById('totalStartTime').textContent =
          `${totals.activeShifts} نشط`;
        document.getElementById('totalEndTime').textContent =
          `${totals.completedShifts} مكتمل`;
        document.getElementById('totalActualHours').textContent =
          `${totals.totalActualHours.toFixed(2)} ساعة`;
        document.getElementById('totalRemainingHours').textContent =
          `${totals.totalRemainingHours.toFixed(2)} ساعة`;
        document.getElementById('totalLateness').textContent =
          `${Math.floor(totals.totalLateness / 60)}:${(totals.totalLateness % 60).toString().padStart(2, '0')}`;
        document.getElementById('totalDailyWage').textContent =
          `${totals.totalDailyWage.toFixed(2)} ${CURRENCY_SYMBOL}`;
        document.getElementById('totalPayableAmount').textContent =
          `${totals.totalPayableAmount.toFixed(2)} ${CURRENCY_SYMBOL}`;
        document.getElementById('totalCurrentSales').textContent =
          `${totals.totalCurrentSales.toFixed(2)} ${CURRENCY_SYMBOL}`;
      }

      // بدقة أعلى: اجمع القيم من الصفوف المعروضة في DOM (يدعم تعدد الشيفتات)
      function updateTotalsFooterFromDOM() {
        const footer = document.getElementById('employeesTableFooter');
        const rows = Array.from(document.querySelectorAll(
          '#employeesTableBody tr'));
        if (rows.length === 0) {
          footer.classList.add('hidden');
          return;
        }
        footer.classList.remove('hidden');

        let totals = {
          requiredHours: 0,
          actualMins: 0,
          remainingMins: 0,
          latenessMins: 0,
          dailyWage: 0,
          payable: 0,
          sales: 0,
          active: 0,
          completed: 0
        };

        rows.forEach(tr => {
          const tds = tr.querySelectorAll('td');
          if (tds.length < 12) return;
          // الترتيب: 0-اسم,1-هاتف,2-تاريخ,3-الساعات_المطلوبة,4-بداية,5-نهاية,6-الفعلية,7-المتبقي,8-التأخير,9-راتب,10-مستحق,11-مبيعات
          const reqText = tds[3].innerText.replace(/[^0-9.]/g, '');
          const actualParts = tds[6].innerText.split(':');
          const remainingParts = tds[7].innerText.split(':');
          const lateParts = tds[8].innerText.split(':');
          const wageText = tds[9].innerText.replace(/[^0-9.]/g, '');
          const payableText = tds[10].innerText.replace(/[^0-9.]/g, '');
          const salesText = tds[11].innerText.replace(/[^0-9.]/g, '');

          const toMins = (arr) => {
            if (!arr || arr.length < 2) return 0;
            const h = parseInt(arr[0] || '0', 10) || 0;
            const m = parseInt(arr[1] || '0', 10) || 0;
            return h * 60 + m;
          };

          totals.requiredHours += parseFloat(reqText || '0') || 0;
          totals.actualMins += toMins(actualParts);
          totals.remainingMins += toMins(remainingParts);
          totals.latenessMins += toMins(lateParts);
          totals.dailyWage += parseFloat(wageText || '0') || 0;
          totals.payable += parseFloat(payableText || '0') || 0;
          totals.sales += parseFloat(salesText || '0') || 0;
        });

        document.getElementById('totalRequiredHours').textContent =
          `${totals.requiredHours.toFixed(0)} ساعة`;
        document.getElementById('totalStartTime').textContent = `-`;
        document.getElementById('totalEndTime').textContent = `-`;
        document.getElementById('totalActualHours').textContent =
          `${(totals.actualMins/60).toFixed(2)} ساعة`;
        document.getElementById('totalRemainingHours').textContent =
          `${(totals.remainingMins/60).toFixed(2)} ساعة`;
        document.getElementById('totalLateness').textContent =
          `${Math.floor(totals.latenessMins/60)}:${(totals.latenessMins%60).toString().padStart(2,'0')}`;
        document.getElementById('totalDailyWage').textContent =
          `${totals.dailyWage.toFixed(2)} ${CURRENCY_SYMBOL}`;
        document.getElementById('totalPayableAmount').textContent =
          `${totals.payable.toFixed(2)} ${CURRENCY_SYMBOL}`;
        document.getElementById('totalCurrentSales').textContent =
          `${totals.sales.toFixed(2)} ${CURRENCY_SYMBOL}`;
      }

      // Update shifts history table
      function updateShiftsHistoryTable(filteredData) {
        const tbody = document.getElementById('shiftsHistoryTableBody');

        if (!filteredData || filteredData.length === 0) {
          tbody.innerHTML = `
          <tr><td colspan="6" class="p-8 text-center" style="color: #94a3b8;">
            <i class="fas fa-history text-2xl mb-2"></i>
            <p>لا توجد شيفتات للعرض</p>
          </td></tr>
        `;
          return;
        }

        let allShifts = [];

        // جمع جميع الشيفتات من جميع الموظفين
        filteredData.forEach(emp => {
          if (emp.shifts && emp.shifts.length > 0) {
            emp.shifts.forEach(shift => {
              allShifts.push({
                employee_name: emp.full_name || emp.username || '-',
                shift_id: shift.shift_id,
                start_time: shift.start_time,
                end_time: shift.end_time,
                status: shift.status
              });
            });
          }
        });

        // ترتيب الشيفتات من الأحدث للأقدم
        allShifts.sort((a, b) => new Date(b.start_time) - new Date(a.start_time));

        if (allShifts.length === 0) {
          tbody.innerHTML = `
          <tr><td colspan="6" class="p-8 text-center" style="color: #94a3b8;">
            <i class="fas fa-history text-2xl mb-2"></i>
            <p>لا توجد شيفتات في الفترة المحددة</p>
          </td></tr>
        `;
          return;
        }

        const isDark = document.body.classList.contains('dark-mode');

        tbody.innerHTML = allShifts.map(shift => {
          // تنسيق التاريخ والوقت
          const startDate = new Date(shift.start_time);
          const shiftDate = startDate.toLocaleDateString('ar-EG', {
            year: 'numeric',
            month: '2-digit',
            day: '2-digit'
          });

          const startTime = startDate.toLocaleTimeString('ar-EG', {
            hour: '2-digit',
            minute: '2-digit',
            hour12: true
          });

          let endTime = '-';
          let duration = '-';

          if (shift.end_time) {
            const endDate = new Date(shift.end_time);
            endTime = endDate.toLocaleTimeString('ar-EG', {
              hour: '2-digit',
              minute: '2-digit',
              hour12: true
            });

            // حساب المدة
            const diffMs = endDate - startDate;
            const diffHours = Math.floor(diffMs / (1000 * 60 * 60));
            const diffMinutes = Math.floor((diffMs % (1000 * 60 * 60)) / (
              1000 * 60));
            duration =
              `${diffHours}:${diffMinutes.toString().padStart(2, '0')}`;
          } else if (shift.status === 'active') {
            endTime = 'جاري العمل';
            duration = 'جاري';
          }

          return `
          <tr class="border-b border-white/5 hover:bg-white/5 transition-colors">
            <td class="p-3 text-sm font-semibold">${shift.employee_name}</td>
            <td class="p-3 text-sm">${shiftDate}</td>
            <td class="p-3 text-sm">${startTime}</td>
            <td class="p-3 text-sm">${endTime}</td>
            <td class="p-3 text-sm font-semibold" style="color: ${isDark ? '#60a5fa' : '#2563eb'};">
              ${duration}
            </td>
            <td class="p-3 text-center">
              ${shift.status === 'active' ?
                '<span class="px-2 py-1 bg-emerald-500/20 text-emerald-400 rounded-full text-xs font-semibold">نشط</span>' :
                '<span class="px-2 py-1 bg-blue-500/20 text-blue-400 rounded-full text-xs font-semibold">مكتمل</span>'
              }
            </td>
          </tr>
        `;
        }).join('');
      }

      // Filter by employee
      function filterByEmployee() {
        renderEmployeesTable();
      }

      // تمت إزالة فلاتر التاريخ بناءً على طلبكم

      // Export to Excel using SheetJS
      function exportShiftsExcel() {
        if (typeof XLSX === 'undefined') {
          showToast('مكتبة التصدير غير محملة', 'error');
          return;
        }

        const rows = [];
        const header = ['الموظف', 'رقم الهاتف', 'التاريخ', 'الساعات المطلوبة',
          'بداية الشيفت', 'نهاية الشيفت', 'الساعات الفعلية', 'المتبقي',
          'التأخير', 'راتب اليوم', 'المستحق اليوم', 'المبيعات الحالية'
        ];
        rows.push(header);

        // Get filtered data
        const filteredData = selectedEmployeeId ?
          employeesData.filter(emp => emp.employee_id == selectedEmployeeId) :
          employeesData;

        // Add data rows
        filteredData.forEach(emp => {
          const shiftDate = emp.start_time ? emp.start_time.split(' ')[0] :
            '-';
          const startTime = emp.start_time ? new Date(emp.start_time)
            .toLocaleString('ar-SA') : '-';
          const endTime = emp.end_time ? new Date(emp.end_time)
            .toLocaleString('ar-SA') : '-';
          const actualHours = (emp.actual_minutes || 0) / 60;
          const remainingHours = (emp.remaining_minutes || 0) / 60;
          const latenessMinutes = emp.lateness_minutes || 0;
          const dailyWage = emp.daily_wage || 0;
          const payableAmount = emp.payable_amount || 0;
          const currentSales = emp.current_sales || 0;
          const requiredHours = emp.fixed_hours || 8;

          rows.push([
            emp.full_name || emp.username || '-',
            emp.phone || '-',
            shiftDate,
            `${requiredHours} ساعة`,
            startTime,
            endTime,
            `${actualHours.toFixed(2)} ساعة`,
            `${remainingHours.toFixed(2)} ساعة`,
            `${latenessMinutes} دقيقة`,
            `${dailyWage.toFixed(2)} ${CURRENCY_SYMBOL}`,
            `${payableAmount.toFixed(2)} ${CURRENCY_SYMBOL}`,
            `${currentSales.toFixed(2)} ${CURRENCY_SYMBOL}`
          ]);
        });

        // Add totals row
        if (filteredData.length > 0) {
          const totals = calculateTotals(filteredData);
          rows.push(['']); // Empty row
          rows.push(['المجموع الكلي', '', '',
            `${totals.totalRequiredHours.toFixed(0)} ساعة`,
            `${totals.activeShifts} نشط`,
            `${totals.completedShifts} مكتمل`,
            `${totals.totalActualHours.toFixed(2)} ساعة`,
            `${totals.totalRemainingHours.toFixed(2)} ساعة`,
            `${Math.floor(totals.totalLateness / 60)}:${(totals.totalLateness % 60).toString().padStart(2, '0')}`,
            `${totals.totalDailyWage.toFixed(2)} ${CURRENCY_SYMBOL}`,
            `${totals.totalPayableAmount.toFixed(2)} ${CURRENCY_SYMBOL}`,
            `${totals.totalCurrentSales.toFixed(2)} ${CURRENCY_SYMBOL}`
          ]);
        }

        const ws = XLSX.utils.aoa_to_sheet(rows);
        const wb = XLSX.utils.book_new();
        XLSX.utils.book_append_sheet(wb, ws, 'الشيفتات');

        // Generate filename with current filters
        const fromDate = document.getElementById('shiftFromDate') ? document
          .getElementById('shiftFromDate').value : '';
        const toDate = document.getElementById('shiftToDate') ? document
          .getElementById('shiftToDate').value : '';
        let filename = 'shifts_export';
        if (fromDate || toDate) {
          filename += `_${fromDate || 'start'}_to_${toDate || 'today'}`;
        } else {
          filename += `_${new Date().toISOString().split('T')[0]}`;
        }

        XLSX.writeFile(wb, `${filename}.xlsx`);
        showToast('تم تصدير البيانات بنجاح', 'success');
      }

      // Calculate totals for export
      function calculateTotals(data) {
        let totals = {
          totalRequiredHours: 0,
          totalActualHours: 0,
          totalRemainingHours: 0,
          totalLateness: 0,
          totalDailyWage: 0,
          totalPayableAmount: 0,
          totalCurrentSales: 0,
          activeShifts: 0,
          completedShifts: 0
        };

        data.forEach(emp => {
          const requiredHours = emp.fixed_hours || 8;
          const actualHours = (emp.actual_minutes || 0) / 60;
          const remainingHours = (emp.remaining_minutes || 0) / 60;
          const latenessMinutes = emp.lateness_minutes || 0;
          const dailyWage = emp.daily_wage || 0;
          const payableAmount = emp.payable_amount || 0;
          const currentSales = emp.current_sales || 0;

          totals.totalRequiredHours += requiredHours;
          totals.totalActualHours += actualHours;
          totals.totalRemainingHours += remainingHours;
          totals.totalLateness += latenessMinutes;
          totals.totalDailyWage += dailyWage;
          totals.totalPayableAmount += payableAmount;
          totals.totalCurrentSales += currentSales;

          if (emp.shift_status === 'active') {
            totals.activeShifts++;
          } else if (emp.shift_status === 'completed') {
            totals.completedShifts++;
          }
        });

        return totals;
      }


      // Refresh employee data
      async function refreshEmployeeData() {
        const btn = event.target.closest('button');
        const icon = btn.querySelector('i');
        icon.classList.add('fa-spin');

        await loadEmployeesData();

        setTimeout(() => {
          icon.classList.remove('fa-spin');
        }, 500);
      }

      // Initialize timers (optimized for server performance)
      setInterval(updateWorkDuration,
        30000); // Every 30 seconds instead of 1 second
      setInterval(updateShiftStats,
        60000); // Every 60 seconds instead of 10 seconds
      setTimeout(updateWorkDuration, 100);
      setTimeout(updateShiftStats, 2000);

              // Load employees data on page load and refresh every 60 seconds for live updates
        loadEmployeesData();
        setInterval(loadEmployeesData,
          60000); // Every 60 seconds instead of 5 seconds
      
      // Quick ranges and apply filters
      function formatDateISO(d) {
        const yyyy = d.getFullYear();
        const mm = String(d.getMonth() + 1).padStart(2, '0');
        const dd = String(d.getDate()).padStart(2, '0');
        return `${yyyy}-${mm}-${dd}`;
      }

      function setQuickRange(type) {
        const to = new Date();
        let from = new Date();
        if (type === 'week') {
          from.setDate(to.getDate() - 7);
        } else if (type === 'month') {
          from.setDate(to.getDate() - 30);
        }
        const fromInput = document.getElementById('shiftFromDate');
        const toInput = document.getElementById('shiftToDate');
        if (fromInput) fromInput.value = formatDateISO(from);
        if (toInput) toInput.value = formatDateISO(to);
        applyDateFilters();
      }

      function applyDateFilters() {
        loadEmployeesData();
      }
    </script>

    <script>
      // Intercept any direct logout links on this page
      document.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('a[href$="logout.php"]').forEach(a => {
          a.addEventListener('click', function(e) {
            e.preventDefault();
            window.location.href = 'logout.php';
          });
        });
      });
    </script>

    <!-- Session Monitor -->
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
</style></body>

</html>