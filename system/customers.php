
<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description"
    content="the seystem good live ">
  <meta name="author"
    content="ENG.HOSSAM">
  <title>إدارة العملاء - Play Zone</title>

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

  <!-- SheetJS Library for Excel Export -->
  <script
    src="https://cdn.sheetjs.com/xlsx-0.20.1/package/dist/xlsx.full.min.js">
  </script>

  <!-- jsPDF for PDF Export -->
  <script
    src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js">
  </script>
  <script
    src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.31/jspdf.plugin.autotable.min.js">
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

    /* Header Styles - نسخة طبق الأصل من rooms.php */
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

    /* Stats Cards */
    .stats-grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
      gap: 20px;
      margin-bottom: 25px;
    }

    .stat-card {
      background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
      border-radius: 15px;
      padding: 25px;
      color: white;
      box-shadow: 0 4px 15px rgba(102, 126, 234, 0.3);
      transition: all 0.3s ease;
    }

    .stat-card:hover {
      transform: translateY(-5px);
      box-shadow: 0 8px 25px rgba(102, 126, 234, 0.4);
    }

    .stat-card.debtors {
      background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
      box-shadow: 0 4px 15px rgba(239, 68, 68, 0.3);
    }

    .stat-card.debtors:hover {
      box-shadow: 0 8px 25px rgba(239, 68, 68, 0.4);
    }

    .stat-card-header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 15px;
    }

    .stat-card-icon {
      font-size: 2.5rem;
      opacity: 0.9;
    }

    .stat-card-content h3 {
      font-size: 0.95rem;
      opacity: 0.9;
      margin-bottom: 8px;
    }

    .stat-card-content .value {
      font-size: 2.5rem;
      font-weight: bold;
    }

    /* Toolbar */
    .toolbar {
      display: flex;
      justify-content: space-between;
      align-items: center;
      gap: 15px;
      margin-bottom: 25px;
      flex-wrap: wrap;
    }

    .toolbar-left {
      display: flex;
      gap: 10px;
      flex-wrap: wrap;
      flex: 1;
    }

    .toolbar-right {
      display: flex;
      gap: 10px;
      flex-wrap: wrap;
    }

    .btn {
      padding: 10px 20px;
      border-radius: 8px;
      border: none;
      cursor: pointer;
      font-weight: 600;
      transition: all 0.3s ease;
      display: inline-flex;
      align-items: center;
      gap: 8px;
      font-size: 0.95rem;
    }

    .btn-primary {
      background: linear-gradient(135deg, #10b981 0%, #059669 100%);
      color: white;
      box-shadow: 0 2px 8px rgba(16, 185, 129, 0.3);
    }

    .btn-primary:hover {
      transform: translateY(-2px);
      box-shadow: 0 4px 12px rgba(16, 185, 129, 0.4);
    }

    .btn-secondary {
      background: white;
      color: #374151;
      border: 2px solid #e5e7eb;
    }

    body.dark-mode .btn-secondary {
      background: #334155;
      color: #e2e8f0;
      border-color: #475569;
    }

    .btn-secondary:hover {
      border-color: #667eea;
      transform: translateY(-2px);
    }

    /* Search Box */
    .search-box {
      position: relative;
      flex: 1;
      min-width: 250px;
      max-width: 400px;
    }

    .search-box input {
      width: 100%;
      padding: 10px 40px 10px 15px;
      border: 2px solid #e5e7eb;
      border-radius: 8px;
      font-size: 0.95rem;
      transition: all 0.3s ease;
    }

    body.dark-mode .search-box input {
      background: #334155;
      border-color: #475569;
      color: #e2e8f0;
    }

    .search-box input:focus {
      outline: none;
      border-color: #667eea;
      box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
    }

    .search-box i {
      position: absolute;
      left: 15px;
      top: 50%;
      transform: translateY(-50%);
      color: #9ca3af;
    }

    /* Table Styles */
    .table-wrapper {
      overflow-x: auto;
      border-radius: 10px;
      box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
    }

    .customers-table {
      width: 100%;
      border-collapse: collapse;
      min-width: 900px;
    }

    .customers-table thead {
      background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    }

    .customers-table thead th {
      padding: 15px;
      text-align: right;
      color: white;
      font-weight: 600;
      font-size: 0.95rem;
    }

    .customers-table tbody tr {
      border-bottom: 1px solid #e5e7eb;
      transition: all 0.2s ease;
    }

    body.dark-mode .customers-table tbody tr {
      border-bottom-color: #334155;
    }

    .customers-table tbody tr:hover {
      background: rgba(102, 126, 234, 0.05);
    }

    body.dark-mode .customers-table tbody tr:hover {
      background: rgba(102, 126, 234, 0.1);
    }

    .customers-table tbody td {
      padding: 15px;
      color: #374151;
    }

    body.dark-mode .customers-table tbody td {
      color: #e2e8f0;
    }

    .badge {
      display: inline-block;
      padding: 6px 14px;
      border-radius: 6px;
      font-size: 0.85rem;
      font-weight: 700;
    }

    .badge.debtor {
      background: #e53e3e;
      color: white;
    }

    .badge.not-debtor {
      background: #38a169;
      color: white;
    }

    body.dark-mode .badge.debtor {
      background: #c53030;
      color: white;
    }

    body.dark-mode .badge.not-debtor {
      background: #2f855a;
      color: white;
    }

    .table-actions {
      display: flex;
      gap: 8px;
    }

    .btn-sm {
      padding: 6px 12px;
      font-size: 0.85rem;
      border-radius: 6px;
    }

    .btn-warning {
      background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
      color: white;
      box-shadow: 0 2px 6px rgba(245, 158, 11, 0.3);
    }

    .btn-warning:hover {
      transform: translateY(-2px);
      box-shadow: 0 4px 10px rgba(245, 158, 11, 0.4);
    }

    .btn-danger {
      background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
      color: white;
      box-shadow: 0 2px 6px rgba(239, 68, 68, 0.3);
    }

    .btn-danger:hover {
      transform: translateY(-2px);
      box-shadow: 0 4px 10px rgba(239, 68, 68, 0.4);
    }

    /* Mobile Cards */
    .customers-cards {
      display: none;
    }

    @media (max-width: 768px) {
      .table-wrapper {
        display: none;
      }

      .customers-cards {
        display: grid;
        grid-template-columns: 1fr;
        gap: 15px;
      }

      .customer-card {
        background: #3b4556;
        border-radius: 15px;
        padding: 20px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
        border: 1px solid rgba(255, 255, 255, 0.1);
      }

      body.dark-mode .customer-card {
        background: #2d3748;
        border-color: rgba(255, 255, 255, 0.05);
      }

      .customer-card-header {
        display: flex;
        justify-content: space-between;
        align-items: start;
        margin-bottom: 15px;
        padding-bottom: 15px;
        border-bottom: 1px solid rgba(255, 255, 255, 0.1);
      }

      body.dark-mode .customer-card-header {
        border-bottom-color: rgba(255, 255, 255, 0.05);
      }

      .customer-card-name {
        font-size: 1.25rem;
        font-weight: bold;
        color: #8b9dc3;
        margin-bottom: 8px;
      }

      body.dark-mode .customer-card-name {
        color: #a0aec0;
      }

      .customer-card-info {
        display: grid;
        gap: 12px;
        margin-bottom: 18px;
      }

      .info-row {
        display: flex;
        align-items: center;
        gap: 12px;
        font-size: 0.95rem;
        color: #cbd5e0;
        padding: 8px 0;
      }

      body.dark-mode .info-row {
        color: #a0aec0;
      }

      .info-row i {
        width: 24px;
        color: #5a9fd4;
        font-size: 1.1rem;
      }

      body.dark-mode .info-row i {
        color: #63b3ed;
      }

      body.dark-mode .customer-card-info .info-row[style*="rgba(239, 68, 68"] {
        background: rgba(239, 68, 68, 0.1) !important;
      }

      body.dark-mode .customer-card-info .info-row span[style*="color: #ef4444"] {
        color: #fca5a5 !important;
      }

      .customer-card-actions {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 12px;
        margin-top: 15px;
      }

      .customer-card-actions .btn {
        width: 100%;
        justify-content: center;
        padding: 14px 16px;
        font-size: 0.95rem;
        font-weight: 600;
        border-radius: 10px;
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.2);
      }

      .customer-card-actions .btn i {
        font-size: 1.1rem;
      }
    }

    /* Modal Styles */
    .modal {
      display: none;
      position: fixed;
      z-index: 1000;
      left: 0;
      top: 0;
      width: 100%;
      height: 100%;
      background: rgba(0, 0, 0, 0.6);
      backdrop-filter: blur(5px);
    }

    .modal-content {
      background: white;
      margin: 5% auto;
      padding: 0;
      border-radius: 15px;
      width: 90%;
      max-width: 600px;
      box-shadow: 0 20px 60px rgba(0, 0, 0, 0.4);
      animation: slideDown 0.3s ease;
    }

    body.dark-mode .modal-content {
      background: #1e293b;
    }

    @keyframes slideDown {
      from {
        opacity: 0;
        transform: translateY(-50px);
      }

      to {
        opacity: 1;
        transform: translateY(0);
      }
    }

    .modal-header {
      background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
      padding: 20px 25px;
      border-radius: 15px 15px 0 0;
      display: flex;
      justify-content: space-between;
      align-items: center;
    }

    .modal-title {
      color: white;
      font-size: 1.25rem;
      font-weight: bold;
    }

    .close {
      color: white;
      font-size: 28px;
      font-weight: bold;
      cursor: pointer;
      width: 35px;
      height: 35px;
      display: flex;
      align-items: center;
      justify-content: center;
      border-radius: 50%;
      transition: all 0.3s ease;
    }

    .close:hover {
      background: rgba(255, 255, 255, 0.2);
      transform: rotate(90deg);
    }

    .modal-body {
      padding: 25px;
    }

    .form-grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
      gap: 20px;
      margin-bottom: 20px;
    }

    .form-group {
      display: flex;
      flex-direction: column;
    }

    .form-group label {
      color: #374151;
      margin-bottom: 8px;
      font-weight: 600;
      font-size: 0.95rem;
    }

    body.dark-mode .form-group label {
      color: #e2e8f0;
    }

    .form-group input,
    .form-group select {
      padding: 10px 15px;
      border: 2px solid #e5e7eb;
      border-radius: 8px;
      font-size: 0.95rem;
      transition: all 0.3s ease;
    }

    body.dark-mode .form-group input,
    body.dark-mode .form-group select {
      background: #334155;
      border-color: #475569;
      color: #e2e8f0;
    }

    .form-group input:focus,
    .form-group select:focus {
      outline: none;
      border-color: #667eea;
      box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
    }

    .modal-footer {
      display: flex;
      gap: 10px;
      justify-content: center;
      padding: 20px 25px;
      border-top: 1px solid #e5e7eb;
    }

    body.dark-mode .modal-footer {
      border-top-color: #334155;
    }

    /* Notice Card */
    .notice-card {
      position: fixed;
      top: 80px;
      left: 50%;
      transform: translateX(-50%) translateY(-20px);
      background: white;
      padding: 20px 30px;
      border-radius: 12px;
      box-shadow: 0 10px 40px rgba(0, 0, 0, 0.2);
      z-index: 10000;
      opacity: 0;
      pointer-events: none;
      transition: all 0.3s ease;
      min-width: 300px;
      max-width: 500px;
    }

    body.dark-mode .notice-card {
      background: #1e293b;
    }

    .notice-card.show {
      opacity: 1;
      transform: translateX(-50%) translateY(0);
      pointer-events: auto;
    }

    .notice-card.success {
      border-right: 5px solid #10b981;
    }

    .notice-card.error {
      border-right: 5px solid #ef4444;
    }

    .notice-content {
      display: flex;
      align-items: center;
      gap: 15px;
    }

    .notice-icon {
      font-size: 1.5rem;
      flex-shrink: 0;
    }

    .notice-card.success .notice-icon {
      color: #10b981;
    }

    .notice-card.error .notice-icon {
      color: #ef4444;
    }

    .notice-text {
      color: #1f2937;
      font-weight: 600;
      font-size: 0.95rem;
    }

    body.dark-mode .notice-text {
      color: #e2e8f0;
    }

    /* Export Menu Styles */
    #exportMenu button:hover {
      background: rgba(102, 126, 234, 0.05) !important;
    }

    body.dark-mode #exportMenu {
      background: #334155 !important;
      border: 1px solid #475569;
    }

    body.dark-mode #exportMenu button {
      color: #e2e8f0 !important;
    }

    body.dark-mode #exportMenu button:hover {
      background: rgba(148, 163, 184, 0.1) !important;
    }

    /* Responsive */
    @media (max-width: 480px) {
      .stats-grid {
        grid-template-columns: 1fr;
      }

      .toolbar {
        flex-direction: column;
        align-items: stretch;
      }

      .search-box {
        max-width: 100%;
      }

      .form-grid {
        grid-template-columns: 1fr;
      }

      /* Pagination Styles */
      .pagination-container {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-top: 30px;
        padding: 20px;
        background: white;
        border-radius: 12px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
      }

      body.dark-mode .pagination-container {
        background: #1e293b;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.3);
      }

      .pagination-info {
        color: #6b7280;
        font-size: 0.9rem;
        font-weight: 500;
      }

      body.dark-mode .pagination-info {
        color: #9ca3af;
      }

      .pagination {
        display: flex;
        gap: 8px;
        align-items: center;
      }

      .pagination-btn {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 40px;
        height: 40px;
        border: 2px solid #e5e7eb;
        border-radius: 8px;
        color: #6b7280;
        text-decoration: none;
        font-weight: 600;
        transition: all 0.3s ease;
        background: white;
      }

      body.dark-mode .pagination-btn {
        background: #1e293b;
        border-color: #374151;
        color: #9ca3af;
      }

      .pagination-btn:hover {
        border-color: #667eea;
        color: #667eea;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(102, 126, 234, 0.2);
      }

      .pagination-btn.active {
        background: #667eea;
        border-color: #667eea;
        color: white;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(102, 126, 234, 0.3);
      }

      .pagination-btn.disabled {
        opacity: 0.5;
        cursor: not-allowed;
        pointer-events: none;
      }

      .pagination-btn i {
        font-size: 0.9rem;
      }

      /* Mobile Responsive */
      @media (max-width: 768px) {
        .pagination-container {
          flex-direction: column;
          gap: 15px;
          text-align: center;
        }

        .pagination {
          flex-wrap: wrap;
          justify-content: center;
        }

        .pagination-btn {
          width: 35px;
          height: 35px;
          font-size: 0.85rem;
        }
      }
    }
  </style>
</head>

<body class="dark-mode">
  
  <!-- Header - outside page wrapper for full-width alignment -->
  <div class="header-wrapper">
    <div class="header">
      <div class="logo" onclick="window.location.href='dashboard.php'">
        <i class="fas fa-gamepad"></i>
        Play Zone      </div>

      <div class="header-actions">
        <!-- Back Button (Desktop Only) -->
        <button class="back-btn" onclick="window.location.href='dashboard.php'">
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

  <!-- Page Content -->
  <div class="page-wrapper">
    <!-- Main Content -->
    <div class="main-content">
            <!-- Page Title -->
      <div class="page-title">
        <i class="fas fa-users"></i>
        إدارة العملاء
      </div>

      <!-- Stats Cards - بطاقتان فقط -->
      <div class="stats-grid">
        <div class="stat-card">
          <div class="stat-card-header">
            <div class="stat-card-content">
              <h3>إجمالي العملاء</h3>
              <div class="value">1</div>
            </div>
            <div class="stat-card-icon">
              <i class="fas fa-users"></i>
            </div>
          </div>
        </div>

        <div class="stat-card debtors">
          <div class="stat-card-header">
            <div class="stat-card-content">
              <h3>عملاء مَدينون</h3>
              <div class="value">0</div>
            </div>
            <div class="stat-card-icon">
              <i class="fas fa-hand-holding-usd"></i>
            </div>
          </div>
        </div>
      </div>

      <!-- Toolbar -->
      <div class="toolbar">
        <div class="toolbar-left">
                      <button class="btn btn-primary" onclick="openAddModal()">
              <i class="fas fa-user-plus"></i>
              إضافة عميل جديد
            </button>
          
          <button class="btn btn-secondary" onclick="refreshCustomers()">
            <i class="fas fa-sync-alt"></i>
            تحديث
          </button>

          <!-- Export Dropdown -->
                      <div style="position: relative; display: inline-block;">
              <button class="btn btn-secondary" onclick="toggleExportMenu()"
                id="exportBtn">
                <i class="fas fa-file-export"></i>
                تصدير إدارة العملاء
                <i class="fas fa-chevron-down"
                  style="font-size: 0.8rem; margin-right: 5px;"></i>
              </button>
              <div id="exportMenu"
                style="display: none; position: absolute; top: 100%; right: 0; background: white; border-radius: 8px; box-shadow: 0 4px 12px rgba(0,0,0,0.15); min-width: 180px; z-index: 1000; margin-top: 5px;">
                <button onclick="exportToExcel()"
                  style="width: 100%; text-align: right; padding: 12px 16px; border: none; background: transparent; cursor: pointer; display: flex; align-items: center; gap: 10px; transition: all 0.2s; color: #374151; font-weight: 600; border-radius: 8px 8px 0 0;">
                  <i class="fas fa-file-excel"
                    style="color: #10b981; font-size: 1.1rem;"></i>
                  <span>تصدير Excel</span>
                </button>
                <button onclick="exportToPDF()"
                  style="width: 100%; text-align: right; padding: 12px 16px; border: none; background: transparent; cursor: pointer; display: flex; align-items: center; gap: 10px; transition: all 0.2s; color: #374151; font-weight: 600; border-radius: 0 0 8px 8px;">
                  <i class="fas fa-file-pdf"
                    style="color: #ef4444; font-size: 1.1rem;"></i>
                  <span>تصدير PDF</span>
                </button>
              </div>
            </div>
                  </div>
        <div class="search-box">
          <input type="text" id="searchInput" placeholder="ابحث عن عميل..."
            oninput="searchCustomers()">
          <i class="fas fa-search"></i>
        </div>
      </div>

      <!-- Desktop Table -->
      <div class="table-wrapper">
        <table class="customers-table">
          <thead>
            <tr>
              <th>#</th>
              <th>اسم العميل</th>
              <th>رقم الهاتف</th>
              <th>البريد الإلكتروني</th>
                              <th>الحالة المالية</th>
                <th>المبلغ المستحق</th>
                            <th>الإجراءات</th>
            </tr>
          </thead>
          <tbody id="customersTableBody">
                                          <tr>
                  <td>1</td>
                  <td style="font-weight: 600; color: #667eea;">
                    MZ</td>
                  <td>0105689897</td>
                  <td>mahzah@gmail.com</td>
                                      <td>
                      <span
                        class="badge not-debtor">
                        غير مدين                      </span>
                    </td>
                    <td>
                                              <span style="color: #10b981; font-weight: 600;">-</span>
                                          </td>
                                    <td>
                    <div class="table-actions">
                                              <button class="btn btn-warning btn-sm"
                          onclick='editCustomer({"id":204,"client_id":314,"name":"MZ","phone":"0105689897","email":"mahzah@gmail.com","national_id":"","address":null,"notes":null,"loyalty_points":0,"total_sessions":0,"total_spent":"0.00","is_blocked":0,"is_debtor":0,"debt_amount":"0.00","block_reason":null,"created_at":"2026-06-01 10:43:38","updated_at":"2026-06-01 10:44:09"})'>
                          <i class="fas fa-edit"></i>
                          تعديل
                        </button>
                      
                                              <button class="btn btn-danger btn-sm"
                          onclick="deleteCustomer(204, 'MZ')">
                          <i class="fas fa-trash"></i>
                          حذف
                        </button>
                                          </div>
                  </td>
                </tr>
                                    </tbody>
        </table>
      </div>

      <!-- Mobile Cards -->
      <div class="customers-cards" id="customersCards">
                  <div class="customer-card">
            <div class="customer-card-header">
              <div>
                <div class="customer-card-name">
                  MZ</div>
                                  <span
                    class="badge not-debtor">
                    غير مدين                  </span>
                              </div>
            </div>

            <div class="customer-card-info">
                              <div class="info-row">
                  <i class="fas fa-phone"></i>
                  <span>0105689897</span>
                </div>
                                            <div class="info-row">
                  <i class="fas fa-envelope"></i>
                  <span>mahzah@gmail.com</span>
                </div>
                                                      </div>

            <div class="customer-card-actions">
                              <button class="btn btn-warning"
                  onclick='editCustomer({"id":204,"client_id":314,"name":"MZ","phone":"0105689897","email":"mahzah@gmail.com","national_id":"","address":null,"notes":null,"loyalty_points":0,"total_sessions":0,"total_spent":"0.00","is_blocked":0,"is_debtor":0,"debt_amount":"0.00","block_reason":null,"created_at":"2026-06-01 10:43:38","updated_at":"2026-06-01 10:44:09"})'>
                  <i class="fas fa-edit"></i>
                  تعديل
                </button>
              
                              <button class="btn btn-danger"
                  onclick="deleteCustomer(204, 'MZ')">
                  <i class="fas fa-trash"></i>
                  حذف
                </button>
                          </div>
          </div>
              </div>

      <!-- Pagination -->
              <div class="pagination-container">
          <div class="pagination-info">
            عرض 1 -
            1 من
            1 عميل
          </div>
          <div class="pagination">
                        <a href="javascript:void(0)"
              class="pagination-btn first disabled">
              <i class="fas fa-angle-double-right"></i>
            </a>
            <a href="javascript:void(0)"
              class="pagination-btn prev disabled">
              <i class="fas fa-angle-right"></i>
            </a>

            
            <a href="javascript:void(0)"
              class="pagination-btn next disabled">
              <i class="fas fa-angle-left"></i>
            </a>
            <a href="javascript:void(0)"
              class="pagination-btn last disabled">
              <i class="fas fa-angle-double-left"></i>
            </a>
          </div>
        </div>
          </div>
  </div>

  <!-- Add/Edit Modal -->
  <div id="customerModal" class="modal">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title" id="modalTitle">إضافة عميل جديد</h3>
        <span class="close" onclick="closeModal()">&times;</span>
      </div>
      <div class="modal-body">
        <form method="POST" action="" id="customerForm">
          <input type="hidden" name="action" id="formAction"
            value="add_customer">
          <input type="hidden" name="customer_id" id="customerId">
          <div class="form-grid">
            <div class="form-group">
              <label for="customerName">اسم العميل *</label>
              <input type="text" id="customerName" name="name" required>
            </div>
            <div class="form-group">
              <label for="customerPhone">رقم الهاتف</label>
              <input type="text" id="customerPhone" name="phone">
            </div>
            <div class="form-group">
              <label for="customerEmail">البريد الإلكتروني</label>
              <input type="email" id="customerEmail" name="email">
            </div>
            <div class="form-group">
              <label for="customerNationalId">رقم الهوية الوطنية</label>
              <input type="text" id="customerNationalId" name="national_id">
            </div>

                          <div class="form-group">
                <label for="customerIsDebtor">الحالة المالية</label>
                <select id="customerIsDebtor" name="is_debtor">
                  <option value="0">غير مدين</option>
                  <option value="1">مدين</option>
                </select>
              </div>
              <div class="form-group">
                <label for="customerDebtAmount">المبلغ المستحق (إن وجد)</label>
                <input type="number" id="customerDebtAmount" name="debt_amount"
                  step="0.01" min="0" value="0">
              </div>
                      </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-primary">
              <i class="fas fa-save"></i>
              حفظ
            </button>
            <button type="button" onclick="closeModal()"
              class="btn btn-secondary">
              <i class="fas fa-times"></i>
              إلغاء
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <!-- Notice Card -->
  <div id="noticeCard" class="notice-card">
    <div class="notice-content">
      <i class="notice-icon fas"></i>
      <span class="notice-text"></span>
    </div>
  </div>

  <!-- Scripts -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="js/notification-queue.js?v=1779207315"></script>
  <script src="js/session-monitor.js?v=1771422103"></script>

  <script>
    async function attemptLogout() {
      window.location.href = 'logout.php';
    }
    // ✅ متغيرات الصلاحيات
    const canManage = true;
    const canViewSearch = true;
    const canAdd = true;
    const canEdit = true;
    const canDelete = true;
    const canExport = true;
    const canViewFinance = true;

    // ✅ Dark Mode - Synced with Dashboard (Parent)
    function initDarkMode() {
      const darkMode = localStorage.getItem('darkMode') === 'true';
      const body = document.body;
      const icon = document.getElementById('dark-mode-icon');

      if (darkMode) {
        body.classList.add('dark-mode');
        if (icon) icon.className = 'fas fa-sun';
      } else {
        body.classList.remove('dark-mode');
        if (icon) icon.className = 'fas fa-moon';
      }
    }

    function toggleDarkMode() {
      const body = document.body;
      const isDark = body.classList.toggle('dark-mode');
      const icon = document.getElementById('dark-mode-icon');

      if (icon) icon.className = isDark ? 'fas fa-sun' : 'fas fa-moon';

      // Save to localStorage
      localStorage.setItem('darkMode', isDark);

      // Save to database
      fetch('api/user-preferences.php', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
        },
        credentials: 'same-origin',
        body: JSON.stringify({
          dark_mode: isDark
        })
      }).catch(err => {
        // Error saving dark mode
      });
    }

    // Listen for dark mode changes from other tabs (cross-tab sync)
    window.addEventListener('storage', function(e) {
      if (e.key === 'darkMode') {
        const darkMode = e.newValue === 'true';
        const body = document.body;
        const icon = document.getElementById('dark-mode-icon');

        if (darkMode) {
          body.classList.add('dark-mode');
          if (icon) icon.className = 'fas fa-sun';
        } else {
          body.classList.remove('dark-mode');
          if (icon) icon.className = 'fas fa-moon';
        }
      }
    });

    // Initialize dark mode on page load
    initDarkMode();

    // Show Notice
    function showNotice(message, type = 'success') {
      const notice = document.getElementById('noticeCard');
      const icon = notice.querySelector('.notice-icon');
      const text = notice.querySelector('.notice-text');

      notice.className = `notice-card ${type} show`;
      icon.className =
        `notice-icon fas ${type === 'success' ? 'fa-check-circle' : 'fa-exclamation-circle'}`;
      text.textContent = message;

      setTimeout(() => {
        notice.classList.remove('show');
      }, 3500);
    }

    // Show Flash Message
    
    // Upgrade modal (same design used on dashboard)
    function showUpgradeCustomersModal() {
      if (document.getElementById('upgradeCustomersOverlay')) return;
      const overlay = document.createElement('div');
      overlay.id = 'upgradeCustomersOverlay';
      overlay.className =
        'fixed inset-0 z-[99999] flex items-center justify-center p-4';
      overlay.style.background = 'rgba(0,0,0,.55)';

      const card = document.createElement('div');
      card.className = 'w-full max-w-md rounded-2xl overflow-hidden shadow-2xl';
      card.innerHTML = `
      <div class="bg-gradient-to-r from-indigo-600 to-purple-600 text-white p-5 flex items-center gap-3">
        <div class="w-10 h-10 bg-white/20 rounded-lg flex items-center justify-center">
          <i class="fas fa-rocket"></i>
        </div>
        <h3 class="text-lg font-bold">ترقية مطلوبة لإدارة العملاء</h3>
      </div>
      <div class="bg-white p-6 text-right" dir="rtl">
        <p class="text-gray-700 leading-7 mb-4">
          للاستفادة من ميزة <strong>إدارة العملاء</strong>، يرجى ترقية خطتك من صفحة الباقات.
        </p>
        <ul class="text-gray-600 text-sm space-y-2 mb-5">
          <li class="flex items-center gap-2"><i class="fas fa-check text-emerald-500"></i> الوصول الكامل لكارت وصفحة إدارة العملاء</li>
          <li class="flex items-center gap-2"><i class="fas fa-check text-emerald-500"></i> تحكم أفضل بعملائك وسجلاتهم</li>
          <li class="flex items-center gap-2"><i class="fas fa-check text-emerald-500"></i> أدوات بحث وفرز متقدمة</li>
        </ul>
        <div class="flex items-center justify-end gap-3">
          <button onclick="document.getElementById('upgradeCustomersOverlay').remove()" class="px-4 py-2 rounded-lg font-semibold text-white" style="background:#111827;">لاحقاً</button>
          <a href="subscription-upgrade.php" class="px-4 py-2 rounded-lg text-white bg-gradient-to-r from-indigo-600 to-purple-600 hover:opacity-95">الترقية الآن</a>
        </div>
      </div>
    `;

      overlay.appendChild(card);
      overlay.addEventListener('click', (e) => {
        if (e.target === overlay) overlay.remove();
      });
      document.body.appendChild(overlay);
    }

    // Open Add Modal
    function openAddModal() {
      document.getElementById('modalTitle').textContent = 'إضافة عميل جديد';
      document.getElementById('formAction').value = 'add_customer';
      document.getElementById('customerForm').reset();
      document.getElementById('customerId').value = '';
      document.getElementById('customerModal').style.display = 'block';
    }

    // Edit Customer
    function editCustomer(customer) {
      document.getElementById('modalTitle').textContent = 'تعديل العميل';
      document.getElementById('formAction').value = 'update_customer';
      document.getElementById('customerId').value = customer.id;
      document.getElementById('customerName').value = customer.name;
      document.getElementById('customerPhone').value = customer.phone || '';
      document.getElementById('customerEmail').value = customer.email || '';
      document.getElementById('customerNationalId').value = customer
        .national_id || '';
      document.getElementById('customerIsDebtor').value = customer.is_debtor || 0;
      document.getElementById('customerDebtAmount').value = customer
        .debt_amount || 0;
      document.getElementById('customerModal').style.display = 'block';
    }

    // Close Modal
    function closeModal() {
      document.getElementById('customerModal').style.display = 'none';
    }

    // Delete Customer
    function deleteCustomer(id, name) {
      Swal.fire({
        title: 'تأكيد الحذف',
        html: `هل أنت متأكد من حذف العميل <strong>${name}</strong>؟<br>لن تتمكن من التراجع عن هذا الإجراء.`,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#ef4444',
        cancelButtonColor: '#6b7280',
        confirmButtonText: 'نعم، احذف',
        cancelButtonText: 'إلغاء'
      }).then((result) => {
        if (result.isConfirmed) {
          const form = document.createElement('form');
          form.method = 'POST';
          form.innerHTML = `
                        <input type="hidden" name="action" value="delete_customer">
                        <input type="hidden" name="customer_id" value="${id}">
                    `;
          document.body.appendChild(form);
          form.submit();
        }
      });
    }

    // Search Customers
    function searchCustomers() {
      const searchValue = document.getElementById('searchInput').value
        .toLowerCase();
      const tableRows = document.querySelectorAll('#customersTableBody tr');
      const cards = document.querySelectorAll('.customer-card');

      // Filter table rows
      tableRows.forEach(row => {
        const text = row.textContent.toLowerCase();
        row.style.display = text.includes(searchValue) ? '' : 'none';
      });

      // Filter cards
      cards.forEach(card => {
        const text = card.textContent.toLowerCase();
        card.style.display = text.includes(searchValue) ? '' : 'none';
      });
    }

    // Refresh Customers
    function refreshCustomers() {
      window.location.reload();
    }

    // Close modal on outside click
    window.onclick = function(event) {
      const modal = document.getElementById('customerModal');
      if (event.target == modal) {
        closeModal();
      }
    }

    // Close modal on Escape key
    document.addEventListener('keydown', function(event) {
      if (event.key === 'Escape') {
        closeModal();
      }
    });

    // ==================== Export Functions ====================

    // Toggle Export Menu
    function toggleExportMenu() {
      const menu = document.getElementById('exportMenu');
      menu.style.display = menu.style.display === 'none' ? 'block' : 'none';
    }

    // Close export menu when clicking outside
    document.addEventListener('click', function(event) {
      const exportBtn = document.getElementById('exportBtn');
      const exportMenu = document.getElementById('exportMenu');

      if (exportBtn && exportMenu && !exportBtn.contains(event.target) && !
        exportMenu.contains(event.target)) {
        exportMenu.style.display = 'none';
      }
    });

    // Get customers data for export
    function getCustomersData() {
      const customers = [{"id":204,"client_id":314,"name":"MZ","phone":"0105689897","email":"mahzah@gmail.com","national_id":"","address":null,"notes":null,"loyalty_points":0,"total_sessions":0,"total_spent":"0.00","is_blocked":0,"is_debtor":0,"debt_amount":"0.00","block_reason":null,"created_at":"2026-06-01 10:43:38","updated_at":"2026-06-01 10:44:09"}];
      return customers.map((customer, index) => ({
        '#': index + 1,
        'اسم العميل': customer.name,
        'رقم الهاتف': customer.phone || '-',
        'البريد الإلكتروني': customer.email || '-',
        'رقم الهوية': customer.national_id || '-',
        'الحالة المالية': customer.is_debtor == 1 ? 'مدين' : 'غير مدين',
        'المبلغ المستحق': customer.is_debtor == 1 && customer.debt_amount >
          0 ? parseFloat(customer.debt_amount).toFixed(2) + ' ' + CURRENCY_SYMBOL : '-'
      }));
    }

    // Export to Excel using SheetJS
    function exportToExcel() {
      try {
        const data = getCustomersData();

        // Create worksheet
        const ws = XLSX.utils.json_to_sheet(data);

        // Set column widths
        const wscols = [{
            wch: 5
          }, // #
          {
            wch: 20
          }, // اسم العميل
          {
            wch: 15
          }, // رقم الهاتف
          {
            wch: 25
          }, // البريد الإلكتروني
          {
            wch: 15
          }, // رقم الهوية
          {
            wch: 15
          }, // الحالة المالية
          {
            wch: 18
          } // المبلغ المستحق
        ];
        ws['!cols'] = wscols;

        // Create workbook
        const wb = XLSX.utils.book_new();
        XLSX.utils.book_append_sheet(wb, ws, 'العملاء');

        // Generate filename with current date
        const date = new Date();
        const filename =
          `customers_${date.getFullYear()}-${String(date.getMonth() + 1).padStart(2, '0')}-${String(date.getDate()).padStart(2, '0')}.xlsx`;

        // Save file
        XLSX.writeFile(wb, filename);

        // Close menu and show success message
        document.getElementById('exportMenu').style.display = 'none';
        showNotice('تم تصدير البيانات إلى Excel بنجاح', 'success');
      } catch (error) {
        // Export error occurred
        showNotice('حدث خطأ أثناء التصدير', 'error');
      }
    }

    // Export to PDF using jsPDF
    function exportToPDF() {
      try {
        const {
          jsPDF
        } = window.jspdf;
        const doc = new jsPDF('p', 'mm', 'a4');

        // Add Arabic font support (using default font for now)
        doc.setLanguage('ar');

        // Add title
        doc.setFontSize(18);
        doc.text('Customer List - قائمة العملاء', 105, 15, {
          align: 'center'
        });

        // Get data
        const data = getCustomersData();

        // Prepare table data
        const tableData = data.map(row => [
          row['#'],
          row['اسم العميل'],
          row['رقم الهاتف'],
          row['البريد الإلكتروني'],
          row['الحالة المالية'],
          row['المبلغ المستحق']
        ]);

        // Add table
        doc.autoTable({
          head: [
            ['#', 'Name', 'Phone', 'Email', 'Status', 'Amount']
          ],
          body: tableData,
          startY: 25,
          theme: 'grid',
          styles: {
            font: 'helvetica',
            fontSize: 9,
            cellPadding: 3
          },
          headStyles: {
            fillColor: [102, 126, 234],
            textColor: 255,
            fontStyle: 'bold'
          },
          alternateRowStyles: {
            fillColor: [245, 245, 245]
          },
          margin: {
            top: 25,
            right: 10,
            bottom: 10,
            left: 10
          }
        });

        // Add footer with date
        const pageCount = doc.internal.getNumberOfPages();
        for (let i = 1; i <= pageCount; i++) {
          doc.setPage(i);
          doc.setFontSize(8);
          doc.text(
            `Page ${i} of ${pageCount} - Generated: ${new Date().toLocaleDateString('ar-EG')}`,
            105,
            doc.internal.pageSize.height - 10, {
              align: 'center'
            }
          );
        }

        // Generate filename with current date
        const date = new Date();
        const filename =
          `customers_${date.getFullYear()}-${String(date.getMonth() + 1).padStart(2, '0')}-${String(date.getDate()).padStart(2, '0')}.pdf`;

        // Save file
        doc.save(filename);

        // Close menu and show success message
        document.getElementById('exportMenu').style.display = 'none';
        showNotice('تم تصدير البيانات إلى PDF بنجاح', 'success');
      } catch (error) {
        // Export error occurred
        showNotice('حدث خطأ أثناء التصدير', 'error');
      }
    }
  </script>

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