
<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description"
    content="the seystem good live ">
  <meta name="author"
    content="ENG.HOSSAM">
  <title>التقارير - Play Zone</title>

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
    /* تصغير الحجم للشاشات الكبيرة فقط */
    @media (min-width: 1024px) {
      html { font-size: 90%; }
    }
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

    /* Filters Section */
    .filters-section {
      background: white;
      border-radius: 12px;
      padding: 20px;
      margin-bottom: 25px;
      box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
      border: 1px solid #e5e7eb;
    }

    body.dark-mode .filters-section {
      background: #0f172a;
      border-color: #334155;
    }

    .filters-row {
      display: flex;
      gap: 15px;
      align-items: end;
      flex-wrap: wrap;
    }

    .filter-group {
      display: flex;
      flex-direction: column;
      gap: 6px;
      min-width: 150px;
    }

    /* تخصيص للأزرار لتكون جنب بعض */
    .filter-group[style*="display: flex"] {
      flex-direction: row !important;
      align-items: center;
      min-width: auto;
    }

    .filter-group label {
      color: #374151;
      font-weight: 600;
      font-size: 0.875rem;
    }

    body.dark-mode .filter-group label {
      color: #cbd5e1;
    }

    .filter-group input,
    .filter-group select {
      padding: 8px 12px;
      border: 2px solid #e5e7eb;
      border-radius: 8px;
      background: white;
      color: #374151;
      font-size: 0.875rem;
      transition: all 0.3s ease;
      font-family: 'Cairo', sans-serif;
    }

    body.dark-mode .filter-group input,
    body.dark-mode .filter-group select {
      background: #1e293b;
      border-color: #334155;
      color: #e2e8f0;
    }

    .filter-group input:focus,
    .filter-group select:focus {
      outline: none;
      border-color: #667eea;
      box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
    }

    /* Buttons */
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
      text-decoration: none;
    }

    .btn-primary {
      background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
      color: white;
      box-shadow: 0 2px 8px rgba(102, 126, 234, 0.3);
    }

    .btn-primary:hover:not(:disabled) {
      transform: translateY(-2px);
      box-shadow: 0 4px 12px rgba(102, 126, 234, 0.4);
    }

    .btn-secondary {
      background: #f3f4f6;
      color: #374151;
    }

    body.dark-mode .btn-secondary {
      background: #334155;
      color: #cbd5e1;
    }

    .btn-secondary:hover {
      background: #e5e7eb;
    }

    body.dark-mode .btn-secondary:hover {
      background: #475569;
    }

    /* Stats Grid */
    .stats-grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
      gap: 20px;
      margin-bottom: 25px;
    }

    .stat-card {
      background: white;
      border-radius: 12px;
      padding: 20px;
      text-align: center;
      box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
      border: 1px solid #e5e7eb;
      transition: all 0.3s ease;
    }

    body.dark-mode .stat-card {
      background: #0f172a;
      border-color: #334155;
    }

    .stat-card:hover {
      transform: translateY(-3px);
      box-shadow: 0 4px 15px rgba(0, 0, 0, 0.15);
    }

    body.dark-mode .stat-card:hover {
      box-shadow: 0 4px 15px rgba(0, 0, 0, 0.3);
    }

    .stat-number {
      font-size: 2rem;
      font-weight: bold;
      color: #667eea;
      margin-bottom: 8px;
    }

    body.dark-mode .stat-number {
      color: #8b5cf6;
    }

    .stat-label {
      font-size: 0.9rem;
      color: #6b7280;
      font-weight: 600;
    }

    body.dark-mode .stat-label {
      color: #94a3b8;
    }

    /* Reports Section */
    .reports-section {
      background: white;
      border-radius: 12px;
      padding: 20px;
      margin-bottom: 20px;
      box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
      border: 1px solid #e5e7eb;
    }

    body.dark-mode .reports-section {
      background: #0f172a;
      border-color: #334155;
    }

    .reports-section h2 {
      color: #1f2937;
      margin-bottom: 15px;
      font-size: 1.25rem;
      font-weight: 700;
      border-bottom: 2px solid #e5e7eb;
      padding-bottom: 8px;
    }

    body.dark-mode .reports-section h2 {
      color: #f1f5f9;
      border-bottom-color: #334155;
    }

    .report-item {
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 12px 15px;
      background: #f9fafb;
      border-radius: 8px;
      margin-bottom: 8px;
      color: #374151;
      transition: all 0.3s ease;
      border: 1px solid #e5e7eb;
    }

    body.dark-mode .report-item {
      background: #1e293b;
      color: #e2e8f0;
      border-color: #334155;
    }

    .report-item:hover {
      background: #f3f4f6;
      transform: translateX(-2px);
    }

    body.dark-mode .report-item:hover {
      background: #334155;
    }

    .report-item:last-child {
      margin-bottom: 0;
    }

    .report-name {
      font-weight: 600;
      font-size: 0.9rem;
    }

    .report-count {
      background: #d1fae5;
      color: #065f46;
      padding: 4px 12px;
      border-radius: 20px;
      font-weight: 600;
      font-size: 0.8rem;
    }

    /* جدول التقارير المفصلة */
    .table-container {
      overflow-x: auto;
      border-radius: 12px;
      border: 1px solid #e5e7eb;
      background: #ffffff;
      margin-top: 20px;
    }

    body.dark-mode .table-container {
      background: #1e293b;
      border-color: #334155;
    }

    .reports-table {
      width: 100%;
      border-collapse: collapse;
      font-size: 0.9em;
    }

    .reports-table th {
      background: #3b82f6;
      color: white;
      padding: 16px 12px;
      text-align: right;
      font-weight: 600;
      border-bottom: 2px solid #2563eb;
      white-space: nowrap;
    }

    .reports-table td {
      padding: 12px;
      border-bottom: 1px solid #e5e7eb;
      vertical-align: top;
      text-align: right;
      color: #374151;
    }

    body.dark-mode .reports-table td {
      color: #e2e8f0;
      border-color: #334155;
    }

    .reports-table tr:hover {
      background: #f9fafb;
    }

    body.dark-mode .reports-table tr:hover {
      background: #334155;
    }

    .reports-table tr:last-child td {
      border-bottom: none;
    }

    .orders-details {
      min-width: 150px;
    }

    .orders-count {
      font-weight: 600;
      color: #3b82f6;
      margin-bottom: 4px;
    }

    .orders-quantity {
      font-size: 0.85em;
      color: #6b7280;
      margin-bottom: 8px;
    }

    body.dark-mode .orders-quantity {
      color: #94a3b8;
    }

    .orders-list {
      max-height: 100px;
      overflow-y: auto;
    }

    .order-item {
      font-size: 0.8em;
      padding: 2px 0;
      color: #6b7280;
      border-bottom: 1px solid #e5e7eb;
    }

    body.dark-mode .order-item {
      color: #94a3b8;
      border-color: #334155;
    }

    .order-item:last-child {
      border-bottom: none;
    }

    .no-orders {
      color: #9ca3af;
      font-style: italic;
    }

    body.dark-mode .no-orders {
      color: #64748b;
    }

    .total-amount {
      font-weight: 700;
      color: #059669;
      background: #d1fae5;
      border-radius: 6px;
      padding: 4px 8px;
    }

    body.dark-mode .total-amount {
      color: #10b981;
      background: #064e3b;
    }

    /* Pagination styles */
    .pagination .page-btn:hover {
      background: var(--hover-bg);
    }

    .pagination {
      min-width: 100%;
      white-space: nowrap;
    }

    .pagination .page-btn {
      flex-shrink: 0;
      min-width: 40px;
      text-align: center;
    }

    .pagination .page-btn.current {
      background: var(--primary-color) !important;
      color: white !important;
      font-weight: bold;
    }

    .pagination.simple-pagination {
      min-width: unset;
      display: inline-flex;
      align-items: center;
      gap: 12px;
    }

    .pagination.simple-pagination .pagination-btn.simple {
      min-width: auto;
      padding: 10px 18px;
      font-size: 14px;
      font-weight: 600;
    }

    .pagination.simple-pagination .pagination-btn.simple.disabled {
      cursor: not-allowed;
      opacity: 0.45;
      filter: grayscale(20%);
      pointer-events: none;
    }

    .pagination-status {
      font-size: 14px;
      font-weight: 600;
      color: #374151;
    }

    body.dark-mode .pagination-status {
      color: #d1d5db;
    }

    body.dark-mode .report-count {
      background: rgba(16, 185, 129, 0.2);
      color: #6ee7b7;
    }

    .report-value {
      background: #dbeafe;
      color: #1e40af;
      padding: 4px 12px;
      border-radius: 20px;
      font-weight: 600;
      font-size: 0.8rem;
    }

    body.dark-mode .report-value {
      background: rgba(59, 130, 246, 0.2);
      color: #93c5fd;
    }

    /* Chart Container */
    .chart-container {
      background: white;
      border-radius: 12px;
      padding: 20px;
      margin-bottom: 20px;
      box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
      border: 1px solid #e5e7eb;
    }

    body.dark-mode .chart-container {
      background: #0f172a;
      border-color: #334155;
    }

    .chart-container h2 {
      color: #1f2937;
      margin-bottom: 15px;
      font-size: 1.25rem;
      font-weight: 700;
      text-align: center;
    }

    body.dark-mode .chart-container h2 {
      color: #f1f5f9;
    }

    .chart-wrapper {
      position: relative;
      height: 350px;
    }

    /* Table Container */
    .table-container {
      overflow-x: auto;
      margin-top: 15px;
      border-radius: 8px;
      border: 1px solid #e5e7eb;
    }

    body.dark-mode .table-container {
      border-color: #334155;
    }

    .data-table {
      width: 100%;
      border-collapse: collapse;
      background: white;
    }

    body.dark-mode .data-table {
      background: #0f172a;
    }

    .data-table th,
    .data-table td {
      padding: 12px;
      text-align: right;
      border-bottom: 1px solid #e5e7eb;
      color: #374151;
    }

    body.dark-mode .data-table th,
    body.dark-mode .data-table td {
      border-bottom-color: #334155;
      color: #e2e8f0;
    }

    .data-table th {
      background: #f9fafb;
      font-weight: 600;
      font-size: 0.875rem;
    }

    body.dark-mode .data-table th {
      background: #1e293b;
    }

    .data-table tr:hover {
      background: #f9fafb;
    }

    body.dark-mode .data-table tr:hover {
      background: #1e293b;
    }

    /* Messages */
    .message {
      padding: 12px 16px;
      border-radius: 8px;
      margin-bottom: 20px;
      text-align: center;
      font-weight: 600;
      font-size: 0.9rem;
    }

    .message.success {
      background: #d1fae5;
      color: #065f46;
      border: 1px solid #a7f3d0;
    }

    body.dark-mode .message.success {
      background: rgba(16, 185, 129, 0.2);
      color: #6ee7b7;
      border-color: rgba(16, 185, 129, 0.3);
    }

    .message.error {
      background: #fee2e2;
      color: #991b1b;
      border: 1px solid #fca5a5;
    }

    body.dark-mode .message.error {
      background: rgba(239, 68, 68, 0.2);
      color: #fca5a5;
      border-color: rgba(239, 68, 68, 0.3);
    }

    /* Tabs */
    .tabs {
      display: flex;
      gap: 8px;
      margin-bottom: 20px;
      flex-wrap: wrap;
      background: #f9fafb;
      padding: 4px;
      border-radius: 12px;
    }

    body.dark-mode .tabs {
      background: #1e293b;
    }

    .tab {
      padding: 8px 16px;
      background: transparent;
      color: #6b7280;
      border: none;
      border-radius: 8px;
      cursor: pointer;
      transition: all 0.3s ease;
      font-weight: 600;
      font-size: 0.875rem;
    }

    body.dark-mode .tab {
      color: #94a3b8;
    }

    .tab.active {
      background: white;
      color: #667eea;
      box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    body.dark-mode .tab.active {
      background: #0f172a;
      color: #8b5cf6;
    }

    .tab:hover:not(.active) {
      background: #e5e7eb;
      color: #374151;
    }

    body.dark-mode .tab:hover:not(.active) {
      background: #334155;
      color: #e2e8f0;
    }

    .tab-content {
      display: none;
    }

    .tab-content.active {
      display: block;
    }

    /* تحسينات لوحة الفلتر العصرية */
    .filter-panel {
      backdrop-filter: blur(20px) saturate(180%);
      transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
      position: relative;
      overflow: visible;
    }

    /* تنسيق القوائم المنسدلة المخصصة */
    .user-dropdown-item {
      transition: all 0.2s ease;
    }

    .user-dropdown-item:active {
      transform: scale(0.98);
    }

    #userOptionsList::-webkit-scrollbar {
      width: 8px;
    }

    #userOptionsList::-webkit-scrollbar-track {
      background: #f1f5f9;
    }

    body.dark-mode #userOptionsList::-webkit-scrollbar-track {
      background: #1e293b;
    }

    #userOptionsList::-webkit-scrollbar-thumb {
      background: linear-gradient(180deg, #10b981, #059669);
      border-radius: 10px;
    }

    body.dark-mode #userOptionsList::-webkit-scrollbar-thumb {
      background: linear-gradient(180deg, #34d399, #10b981);
    }

    .filter-panel::before {
      content: '';
      position: absolute;
      inset: -2px;
      background: linear-gradient(135deg, #3b82f6, #8b5cf6, #ec4899);
      border-radius: inherit;
      opacity: 0;
      transition: opacity 0.4s;
      z-index: -1;
      filter: blur(8px);
    }

    .filter-panel:hover::before {
      opacity: 0.3;
    }

    .filter-panel:hover {
      box-shadow: 0 20px 40px rgba(0, 0, 0, 0.2) !important;
      transform: translateY(-3px);
    }


    .filter-panel label {
      font-weight: 700;
      text-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
      letter-spacing: 0.3px;
    }

    .filter-panel button {
      font-weight: 800;
      letter-spacing: 0.5px;
      box-shadow: 0 6px 16px rgba(0, 0, 0, 0.2);
      position: relative;
      overflow: hidden;
    }

    .filter-panel button::before {
      content: '';
      position: absolute;
      top: 50%;
      left: 50%;
      width: 0;
      height: 0;
      background: rgba(255, 255, 255, 0.3);
      border-radius: 50%;
      transform: translate(-50%, -50%);
      transition: width 0.6s, height 0.6s;
    }

    .filter-panel button:hover::before {
      width: 300px;
      height: 300px;
    }

    .filter-panel button:active {
      transform: translateY(0) scale(0.95) !important;
      box-shadow: 0 3px 8px rgba(0, 0, 0, 0.2) !important;
    }


    /* تأثير الـ Loading للأزرار */
    .filter-panel button .fa-spinner {
      animation: spin 1s linear infinite;
    }

    @keyframes spin {
      0% {
        transform: rotate(0deg);
      }

      100% {
        transform: rotate(360deg);
      }
    }

    /* Badges للـ Icons */
    .filter-panel label i {
      display: inline-block;
      width: 20px;
      height: 20px;
      text-align: center;
      line-height: 20px;
      border-radius: 50%;
      background: rgba(59, 130, 246, 0.1);
      padding: 2px;
    }

    .filter-panel label .fa-users {
      background: rgba(59, 130, 246, 0.15);
    }

    .filter-panel label .fa-user {
      background: rgba(16, 185, 129, 0.15);
    }

    /* تحسين أزرار فلاتر التحليلات */
    .analytics-period-btn {
      white-space: nowrap;
    }

    /* تحسين القوائم المنسدلة للجوال */
    @media (max-width: 640px) {
      .filter-panel {
        flex-direction: column !important;
        width: 100% !important;
        padding: 16px 12px !important;
        gap: 12px !important;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15) !important;
      }

      /* تحسينات أزرار فلاتر التحليلات للجوال */
      .analytics-period-btn {
        font-size: 12px !important;
        padding: 8px 12px !important;
        gap: 6px !important;
      }

      .analytics-period-btn i {
        font-size: 11px !important;
      }

      .analytics-period-btn span {
        font-size: 11px !important;
      }

      .filter-panel>div {
        width: 100% !important;
      }

      .filter-panel .relative.flex-col {
        width: 100% !important;
        gap: 8px !important;
        min-width: 100% !important;
      }

      .filter-panel .flex-col {
        width: 100% !important;
        gap: 8px !important;
      }

      /* Custom dropdown buttons */
      #userTypeDropdownBtn,
      #userDropdownBtn {
        width: 100% !important;
        padding: 10px 12px !important;
        font-size: 13px !important;
        min-height: 44px !important;
      }

      /* Dropdown menus positioning */
      #userTypeDropdown,
      #userDropdown {
        position: fixed !important;
        left: 50% !important;
        transform: translateX(-50%) !important;
        width: 90vw !important;
        max-width: 400px !important;
        margin-top: 4px !important;
        max-height: 70vh !important;
        z-index: 9999 !important;
      }

      /* Search box in user dropdown */
      #userSearchInput {
        font-size: 14px !important;
        padding: 10px 12px !important;
        padding-right: 36px !important;
      }

      /* Dropdown options */
      .user-dropdown-item {
        padding: 12px 12px !important;
        font-size: 13px !important;
      }

      .user-dropdown-item span.text-lg {
        font-size: 18px !important;
      }

      .user-dropdown-item .text-xs {
        font-size: 11px !important;
      }

      /* User options list */
      #userOptionsList {
        max-height: 50vh !important;
      }

      /* Labels */
      .filter-panel label {
        font-size: 12px !important;
        padding: 0 4px !important;
      }


      .filter-panel .flex.items-end {
        width: 100% !important;
        flex-direction: column;
        gap: 10px !important;
      }

      .filter-panel button {
        width: 100% !important;
        justify-content: center !important;
        padding: 12px 16px !important;
        font-size: 14px !important;
        min-height: 44px !important;
      }

      .filter-panel button i {
        font-size: 14px !important;
      }

      .filter-panel label {
        font-size: 12px !important;
        padding: 0 4px !important;
      }

      .filter-panel label i {
        font-size: 12px !important;
        width: 16px !important;
        height: 16px !important;
      }

      .filter-panel .hidden.sm\\:block {
        display: none !important;
      }

      /* Overlay للقوائم المفتوحة */
      #userTypeDropdown:not(.hidden)::before,
      #userDropdown:not(.hidden)::before {
        content: '';
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: rgba(0, 0, 0, 0.3);
        z-index: -1;
      }
    }

    /* شاشات صغيرة جداً */
    @media (max-width: 380px) {
      .filter-panel {
        padding: 12px 8px !important;
        gap: 10px !important;
      }

      #userTypeDropdownBtn,
      #userDropdownBtn {
        font-size: 12px !important;
        padding: 8px 10px !important;
        min-height: 40px !important;
      }

      #userTypeDropdown,
      #userDropdown {
        width: 95vw !important;
        max-height: 65vh !important;
      }

      .user-dropdown-item {
        padding: 10px 10px !important;
        font-size: 12px !important;
      }

      .filter-panel button {
        padding: 10px 12px !important;
        font-size: 13px !important;
        min-height: 40px !important;
      }

      .filter-panel label {
        font-size: 11px !important;
      }

      #userSearchInput {
        font-size: 13px !important;
        padding: 8px 10px !important;
        padding-right: 32px !important;
      }
    }

    /* تحسينات إضافية للشاشات المتوسطة (تابلت) */
    @media (max-width: 1024px) and (min-width: 641px) {
      .filter-panel {
        gap: 12px !important;
        padding: 16px !important;
      }

      #userTypeDropdownBtn,
      #userDropdownBtn {
        min-height: 44px !important;
        padding: 12px 16px !important;
        font-size: 13px !important;
      }

      .user-dropdown-item {
        padding: 12px 14px !important;
        font-size: 13px !important;
      }

      .filter-panel button {
        padding: 12px 20px !important;
        font-size: 13px !important;
      }
    }

    /* Responsive Design */
    @media (max-width: 768px) {
      .header-wrapper,
      .page-wrapper {
        width: 100%;
        padding-left: 12px;
        padding-right: 12px;
      }

      .header {
        padding: 12px 18px;
      }

      .logo {
        font-size: 1.5rem;
      }

      .main-content {
        padding: 18px;
      }

      .page-title {
        font-size: 1.4rem;
      }

      .filters-row {
        flex-direction: column;
        align-items: stretch;
      }

      .filter-group {
        min-width: auto;
      }

      .stats-grid {
        grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
        gap: 15px;
      }

      .chart-wrapper {
        height: 300px;
      }

      .tabs {
        flex-direction: column;
        gap: 4px;
      }

      .tab {
        text-align: center;
      }
    }

    @media (max-width: 350px) {
      .logo {
        font-size: 1.3rem;
      }

      .page-title {
        font-size: 1.2rem;
      }

      .page-title i {
        font-size: 1.5rem;
      }

      .btn {
        padding: 8px 16px;
        font-size: 0.85rem;
      }
    }

    /* Fade In Animation */
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

    /* Pagination Styles */
    .pagination-container {
      margin-top: 20px;
      display: flex;
      justify-content: space-between;
      align-items: center;
      flex-wrap: wrap;
      gap: 10px;
    }

    .pagination-info {
      color: #6b7280;
      font-size: 14px;
      font-weight: 500;
    }

    .pagination {
      display: flex;
      gap: 5px;
      align-items: center;
    }

    .pagination-btn {
      padding: 8px 12px;
      background: #e5e7eb;
      color: #374151;
      text-decoration: none;
      border-radius: 6px;
      font-size: 14px;
      transition: all 0.2s ease;
      font-weight: 500;
      border: 1px solid transparent;
      display: flex;
      align-items: center;
      justify-content: center;
      min-width: 40px;
      height: 40px;
    }

    .pagination-btn:hover {
      background: #d1d5db;
      color: #1f2937;
      transform: translateY(-1px);
      box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    .pagination-btn.active {
      background: #1f2937;
      color: white;
      font-weight: bold;
      box-shadow: 0 2px 8px rgba(31, 41, 55, 0.3);
    }

    .pagination-btn.active:hover {
      background: #111827;
      transform: translateY(-1px);
    }

    /* Dark mode pagination */
    body.dark-mode .pagination-info {
      color: #9ca3af;
    }

    body.dark-mode .pagination-btn {
      background: #374151;
      color: #d1d5db;
      border-color: #4b5563;
    }

    body.dark-mode .pagination-btn:hover {
      background: #4b5563;
      color: #f3f4f6;
    }

    body.dark-mode .pagination-btn.active {
      background: #3b82f6;
      color: white;
    }

    body.dark-mode .pagination-btn.active:hover {
      background: #2563eb;
    }

    /* Responsive pagination */
    @media (max-width: 640px) {
      .pagination-container {
        flex-direction: column;
        gap: 15px;
      }

      .pagination {
        flex-wrap: wrap;
        justify-content: center;
      }

      .pagination-btn {
        padding: 6px 10px;
        font-size: 12px;
        min-width: 35px;
        height: 35px;
      }
    }
  </style>
  <!-- SheetJS CDN -->
  <script src="https://cdn.jsdelivr.net/npm/xlsx@0.18.5/dist/xlsx.full.min.js">
  </script>

  <script>
    // تصدير الجدول باستخدام SheetJS أو PDF عبر jsPDF
    function tableToCSV(table) {
      const rows = Array.from(table.querySelectorAll('tr'));
      return rows.map(row => Array.from(row.querySelectorAll('th,td'))
        .map(cell => '"' + (cell.innerText || '').replaceAll('"', '""') + '"')
        .join(',')).join('\n');
    }
    document.addEventListener('DOMContentLoaded', function() {
      const btnExcel = document.getElementById('exportDetailedExcel');
      if (btnExcel) {
        btnExcel.addEventListener('click', function() {
          const table = document.getElementById('detailedReportsTable');
          if (!table) return;
          // تحقق ميزة الخطة لتصدير التقارير المفصلة
          const canExportDetailed =
            true;
          if (!canExportDetailed) {
            // إظهار نفس نافذة الترقية المستخدمة سابقاً
            if (document.getElementById('upgradeCustomersOverlay'))
              return;
            const overlay = document.createElement('div');
            overlay.id = 'upgradeCustomersOverlay';
            overlay.className =
              'fixed inset-0 z-[99999] flex items-center justify-center p-4';
            overlay.style.background = 'rgba(0,0,0,.55)';
            const card = document.createElement('div');
            card.className =
              'w-full max-w-md rounded-2xl overflow-hidden shadow-2xl';
            card.innerHTML = `
            <div class="bg-gradient-to-r from-indigo-600 to-purple-600 text-white p-5 flex items-center gap-3">
              <div class="w-10 h-10 bg-white/20 rounded-lg flex items-center justify-center">
                <i class="fas fa-rocket"></i>
              </div>
              <h3 class="text-lg font-bold">ترقية مطلوبة لتصدير التقارير المفصلة</h3>
            </div>
            <div class="bg-white p-6 text-right" dir="rtl">
              <p class="text-gray-700 leading-7 mb-4">للاستفادة من ميزة <strong>تصدير للتقارير المفصلة</strong>، يرجى ترقية خطتك من صفحة الباقات.</p>
              <ul class="text-gray-600 text-sm space-y-2 mb-5">
                <li class="flex items-center gap-2"><i class="fas fa-check text-emerald-500"></i> تصدير Excel للتقارير التفصيلية</li>
                <li class="flex items-center gap-2"><i class="fas fa-check text-emerald-500"></i> تحليلات وتصفية متقدمة</li>
              </ul>
              <div class="flex items-center justify-end gap-3">
                <button onclick="document.getElementById('upgradeCustomersOverlay').remove()" class="px-4 py-2 rounded-lg border border-gray-300 dark:border-gray-600 hover:bg-gray-50 dark:hover:bg-gray-700 font-medium" style="color:#111827;">لاحقاً</button>
                <a href="subscription-upgrade.php" class="px-4 py-2 rounded-lg text-white bg-gradient-to-r from-indigo-600 to-purple-600 hover:opacity-95">الترقية الآن</a>
              </div>
            </div>`;
            overlay.appendChild(card);
            overlay.addEventListener('click', (e) => {
              if (e.target === overlay) overlay.remove();
            });
            document.body.appendChild(overlay);
            return;
          }
          // Excel via SheetJS
          if (window.XLSX && XLSX.utils && XLSX.writeFile) {
            const wb = XLSX.utils.table_to_book(table, {
              sheet: 'Detailed'
            });
            XLSX.writeFile(wb, 'detailed_reports.xlsx');
          } else {
            // Fallback CSV
            const csv = tableToCSV(table);
            const blob = new Blob([csv], {
              type: 'text/csv;charset=utf-8;'
            });
            const url = URL.createObjectURL(blob);
            const a = document.createElement('a');
            a.href = url;
            a.download = 'detailed_reports.csv';
            document.body.appendChild(a);
            a.click();
            document.body.removeChild(a);
            URL.revokeObjectURL(url);
          }
        });
      }
      // تمت إزالة PDF بالكامل

      // ========== تحديث الإجماليات ديناميكياً ==========
      function updateDetailedTotals(totals) {
        if (!totals) return;

        // البحث عن عناصر الإجماليات بناء على النص
        const allThs = document.querySelectorAll('.reports-table tfoot th');

        allThs.forEach(th => {
          const content = th.textContent.trim();

          // اجمالي الطلبات
          if (content.includes('اجمالي الطلبات')) {
            const formatted = Number(totals.orders || 0).toLocaleString(
              'ar-EG', {
                minimumFractionDigits: 2,
                maximumFractionDigits: 2
              });
            th.innerHTML = '<p>اجمالي الطلبات</p>' + formatted + ' ' + CURRENCY_SYMBOL;
          }

          // اجمالي الجلسات
          if (content.includes('اجمالي الجلسات')) {
            const formatted = Number(totals.time_cost || 0)
              .toLocaleString('ar-EG', {
                minimumFractionDigits: 2,
                maximumFractionDigits: 2
              });
            th.innerHTML = '<p>اجمالي الجلسات</p>' + formatted + ' ' + CURRENCY_SYMBOL;
          }

          // المجموع الكلي
          if (content.includes('المجموع الكلي')) {
            const formatted = Number(totals.room || 0).toLocaleString(
              'ar-EG', {
                minimumFractionDigits: 2,
                maximumFractionDigits: 2
              });
            th.innerHTML = '<p>المجموع الكلي </p>' + formatted + ' ' + CURRENCY_SYMBOL;
          }
        });
      }

      // ========== نظام فلترة احترافي بدون إعادة تحميل ==========
      window.applyDetailedFilters = async function() {
        const typeSelect = document.getElementById('filterUserType');
        const userSelect = document.getElementById('filterUser');
        const tbody = document.querySelector(
          '#detailedReportsTable tbody');
        const applyBtn = document.querySelector(
          '[onclick="applyDetailedFilters()"]');

        if (!typeSelect || !userSelect || !tbody) return;

        const type = typeSelect.value || 'all';
        const user = userSelect.value || 'all';

        // مؤشر التحميل
        const originalBtnText = applyBtn ? applyBtn.innerHTML : '';
        if (applyBtn) {
          applyBtn.disabled = true;
          applyBtn.innerHTML =
            '<i class="fas fa-spinner fa-spin"></i> جاري التحميل...';
        }
        tbody.style.opacity = '0.5';

        try {
          const url = new URL(window.location);
          url.searchParams.set('user_type', type);
          url.searchParams.set('user', user);
          url.searchParams.set('page', '1');
          url.searchParams.set('ajax', 'detailed_tbody');

          const res = await fetch(url.toString(), {
            credentials: 'same-origin',
            headers: {
              'X-Requested-With': 'XMLHttpRequest'
            }
          });

          if (!res.ok) throw new Error('فشل تحميل البيانات');

          const data = await res.json();
          tbody.innerHTML = data.html;

          // تحديث الإجماليات
          updateDetailedTotals(data.totals);

          url.searchParams.delete('ajax');
          if (history.replaceState) {
            history.replaceState({}, document.title, url.toString());
          }

        } catch (error) {
          // Filter error occurred
          tbody.innerHTML =
            '<tr><td colspan="10" style="text-align:center; padding:20px; color:#ef4444;">حدث خطأ أثناء تحميل البيانات</td></tr>';
        } finally {
          if (applyBtn) {
            applyBtn.disabled = false;
            applyBtn.innerHTML = originalBtnText;
          }
          tbody.style.opacity = '1';
        }
      };

      window.resetDetailedFilters = async function() {
        const typeSelect = document.getElementById('filterUserType');
        const userSelect = document.getElementById('filterUser');
        const tbody = document.querySelector(
          '#detailedReportsTable tbody');
        const resetBtn = document.querySelector(
          '[onclick="resetDetailedFilters()"]');

        if (!typeSelect || !userSelect || !tbody) return;

        const originalBtnText = resetBtn ? resetBtn.innerHTML : '';
        if (resetBtn) {
          resetBtn.disabled = true;
          resetBtn.innerHTML =
            '<i class="fas fa-spinner fa-spin"></i> جاري الإعادة...';
        }
        tbody.style.opacity = '0.5';

        try {
          typeSelect.value = 'all';
          userSelect.value = 'all';

          const url = new URL(window.location);
          url.searchParams.delete('user_type');
          url.searchParams.delete('user');
          url.searchParams.set('page', '1');
          url.searchParams.set('ajax', 'detailed_tbody');

          const res = await fetch(url.toString(), {
            credentials: 'same-origin',
            headers: {
              'X-Requested-With': 'XMLHttpRequest'
            }
          });

          if (!res.ok) throw new Error('فشل إعادة تحميل البيانات');

          const data = await res.json();
          tbody.innerHTML = data.html;

          // تحديث الإجماليات
          updateDetailedTotals(data.totals);

          url.searchParams.delete('ajax');
          if (history.replaceState) {
            history.replaceState({}, document.title, url.toString());
          }

        } catch (error) {
          // Reset error occurred
        } finally {
          if (resetBtn) {
            resetBtn.disabled = false;
            resetBtn.innerHTML = originalBtnText;
          }
          tbody.style.opacity = '1';
        }
      };

      // ========== دوال القوائم المنسدلة المخصصة ==========

      // Toggle dropdown
      window.toggleDropdown = function(type) {
        const dropdown = document.getElementById(type + 'Dropdown');
        const arrow = document.getElementById(type + 'Arrow');
        const otherType = type === 'userType' ? 'user' : 'userType';
        const otherDropdown = document.getElementById(otherType +
          'Dropdown');

        // Close other dropdown
        if (otherDropdown && !otherDropdown.classList.contains('hidden')) {
          otherDropdown.classList.add('hidden');
          const otherArrow = document.getElementById(otherType + 'Arrow');
          if (otherArrow) otherArrow.classList.remove('rotate-180');
        }

        // Toggle current dropdown
        dropdown.classList.toggle('hidden');
        arrow.classList.toggle('rotate-180');

        // Focus search input if user dropdown
        if (type === 'user' && !dropdown.classList.contains('hidden')) {
          const searchInput = document.getElementById('userSearchInput');
          if (searchInput) {
            setTimeout(() => searchInput.focus(), 100);
          }
        }
      };

      // Select user type
      window.selectUserType = function(value, icon, text) {
        document.getElementById('filterUserType').value = value;
        document.getElementById('userTypeSelected').innerHTML =
          '<span>' + icon + '</span><span>' + text + '</span>';
        document.getElementById('userTypeDropdown').classList.add('hidden');
        document.getElementById('userTypeArrow').classList.remove(
          'rotate-180');

        // Update user list based on selected type
        filterUsersByType(value);
      };

      // Filter users by type
      function filterUsersByType(type) {
        const userItems = document.querySelectorAll(
          '.user-dropdown-item[data-user-type]');
        userItems.forEach(item => {
          const itemType = item.getAttribute('data-user-type');
          if (type === 'all' || itemType === type) {
            item.style.display = 'flex';
          } else {
            item.style.display = 'none';
          }
        });
      }

      // Select user
      window.selectUser = function(value, icon, text) {
        document.getElementById('filterUser').value = value;
        document.getElementById('userSelected').innerHTML =
          '<span>' + icon + '</span><span class="truncate">' + text +
          '</span>';
        document.getElementById('userDropdown').classList.add('hidden');
        document.getElementById('userArrow').classList.remove('rotate-180');
        document.getElementById('userSearchInput').value = '';

        // Reset search filter
        const userItems = document.querySelectorAll('.user-dropdown-item');
        userItems.forEach(item => {
          item.style.display = 'flex';
        });
      };

      // Filter user dropdown by search
      window.filterUserDropdown = function(searchText) {
        const searchLower = searchText.toLowerCase().trim();
        const userItems = document.querySelectorAll('.user-dropdown-item');
        const userType = document.getElementById('filterUserType').value;

        userItems.forEach(item => {
          const itemSearch = item.getAttribute('data-user-search') ||
            '';
          const itemType = item.getAttribute('data-user-type');
          const matchesSearch = itemSearch.includes(searchLower);
          const matchesType = !itemType || userType === 'all' ||
            itemType === userType;

          if (matchesSearch && matchesType) {
            item.style.display = 'flex';
          } else {
            item.style.display = 'none';
          }
        });
      };

      // Close dropdowns when clicking outside
      document.addEventListener('click', function(e) {
        const userTypeBtn = document.getElementById(
          'userTypeDropdownBtn');
        const userTypeDropdown = document.getElementById(
          'userTypeDropdown');
        const userBtn = document.getElementById('userDropdownBtn');
        const userDropdown = document.getElementById('userDropdown');

        if (userTypeBtn && userTypeDropdown &&
          !userTypeBtn.contains(e.target) && !userTypeDropdown.contains(e
            .target)) {
          userTypeDropdown.classList.add('hidden');
          document.getElementById('userTypeArrow').classList.remove(
            'rotate-180');
        }

        if (userBtn && userDropdown &&
          !userBtn.contains(e.target) && !userDropdown.contains(e.target)
        ) {
          userDropdown.classList.add('hidden');
          document.getElementById('userArrow').classList.remove(
            'rotate-180');
        }
      });

      // Close dropdowns on Escape key
      document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
          const userTypeDropdown = document.getElementById(
            'userTypeDropdown');
          const userDropdown = document.getElementById('userDropdown');
          if (userTypeDropdown && !userTypeDropdown.classList.contains(
              'hidden')) {
            userTypeDropdown.classList.add('hidden');
            document.getElementById('userTypeArrow').classList.remove(
              'rotate-180');
          }
          if (userDropdown && !userDropdown.classList.contains(
              'hidden')) {
            userDropdown.classList.add('hidden');
            document.getElementById('userArrow').classList.remove(
              'rotate-180');
          }
        }
      });

      // Initialize: filter users based on initial user type
      (function() {
        const initialType = document.getElementById('filterUserType')
          ?.value || 'all';
        if (initialType) {
          filterUsersByType(initialType);
        }
      })();

      // تحويل روابط الصفحات لاستخدام AJAX
      (function initPaginationAjax() {
        document.addEventListener('click', async function(e) {
          const link = e.target.closest('.pagination .page-btn');
          if (!link || link.getAttribute('href') === '#') return;

          e.preventDefault();
          const tbody = document.querySelector(
            '#detailedReportsTable tbody');
          if (!tbody) return;

          tbody.style.opacity = '0.5';

          try {
            const url = new URL(link.href, window.location.origin);
            url.searchParams.set('ajax', 'detailed_tbody');

            const res = await fetch(url.toString(), {
              credentials: 'same-origin',
              headers: {
                'X-Requested-With': 'XMLHttpRequest'
              }
            });

            if (!res.ok) throw new Error('فشل تحميل الصفحة');

            const data = await res.json();
            tbody.innerHTML = data.html;

            // تحديث الإجماليات
            updateDetailedTotals(data.totals);

            // تحديث الرابط
            url.searchParams.delete('ajax');
            if (history.pushState) {
              history.pushState({}, document.title, url.toString());
            }

            // التمرير للجدول
            const table = document.getElementById(
              'detailedReportsTable');
            if (table) table.scrollIntoView({
              behavior: 'smooth',
              block: 'start'
            });

          } catch (error) {
            // Navigation error occurred
            window.location.href = link.href;
          } finally {
            tbody.style.opacity = '1';
          }
        });
      })();

      // تصدير "الطلبات الأكثر مبيعاً" للصفحة الحالية باستخدام SheetJS
      (function initExportTopItems() {
        const btn = document.getElementById('exportTopItemsExcel');
        if (!btn) return;
        btn.addEventListener('click', function() {
          const rows = [
            ['الصنف', 'النوع', 'الكمية', 'القيمة']
          ];
          document.querySelectorAll('#topItemsList .report-item')
            .forEach(function(card) {
              const nameEl = card.querySelector('.report-name');
              const name = nameEl ? nameEl.childNodes[0].textContent
                .trim() : '';
              const type = nameEl && nameEl.querySelector('small') ?
                nameEl.querySelector('small').textContent.trim() : '';
              const qty = card.querySelector('.report-count') ? card
                .querySelector('.report-count').textContent.replace(
                  'قطعة', '').trim() : '';
              const value = card.querySelector('.report-value') ? card
                .querySelector('.report-value').textContent.replace(
                  CURRENCY_SYMBOL, '').trim() : '';
              rows.push([name, type, qty, value]);
            });
          if (window.XLSX && XLSX.utils && XLSX.writeFile) {
            const ws = XLSX.utils.aoa_to_sheet(rows);
            const wb = XLSX.utils.book_new();
            XLSX.utils.book_append_sheet(wb, ws, 'Top Items');
            XLSX.writeFile(wb, 'top_items_page.xlsx');
          } else {
            alert('مكتبة SheetJS غير متاحة');
          }
        });
      })();
    });
  </script>
</head>

<body class="dark-mode">
  
  <!-- Header - outside page wrapper for full-width alignment -->
  <div class="header-wrapper">
    <div class="header fade-in">
      <div class="logo" onclick="window.location.href='dashboard.php'">
        <i class="fas fa-chart-line"></i>
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

  <!-- Page Content -->
  <div class="page-wrapper">
    <!-- Main Content -->
    <div class="main-content fade-in">
      <!-- Page Title -->
      <div class="page-title">
        <i class="fas fa-chart-line"></i>
        التقارير والإحصائيات
      </div>

      
      <!-- فلاتر الفترة الزمنية الثابتة -->
      <div
        class="mb-6 bg-white dark:bg-gray-800 rounded-xl shadow-lg border border-gray-200 dark:border-gray-700 p-5">
        <div class="flex flex-wrap items-center justify-between gap-4">
          <div class="flex items-center gap-2">
            <i class="fas fa-filter text-indigo-500 text-lg"></i>
            <h3 class="text-lg font-bold text-gray-800 dark:text-white m-0">
              فلترة البيانات حسب الفترة</h3>
          </div>
          <div class="flex flex-wrap items-center gap-3">
            <!-- أزرار الفترات السريعة -->
            <button type="button" onclick="setAnalyticsPeriod('today')"
              class="analytics-period-btn px-4 py-2 bg-gradient-to-r from-blue-500 to-blue-600 hover:from-blue-600 hover:to-blue-700 text-white rounded-lg font-semibold text-sm transition-all duration-300 shadow-md hover:shadow-lg border-none cursor-pointer flex items-center gap-2">
              <i class="fas fa-calendar-day"></i>
              <span>اليوم</span>
            </button>
            <button type="button" onclick="setAnalyticsPeriod('week')"
              class="analytics-period-btn px-4 py-2 bg-gradient-to-r from-emerald-500 to-emerald-600 hover:from-emerald-600 hover:to-emerald-700 text-white rounded-lg font-semibold text-sm transition-all duration-300 shadow-md hover:shadow-lg border-none cursor-pointer flex items-center gap-2">
              <i class="fas fa-calendar-week"></i>
              <span>هذا الأسبوع</span>
            </button>
            <button type="button" onclick="setAnalyticsPeriod('month')"
              class="analytics-period-btn px-4 py-2 bg-gradient-to-r from-purple-500 to-purple-600 hover:from-purple-600 hover:to-purple-700 text-white rounded-lg font-semibold text-sm transition-all duration-300 shadow-md hover:shadow-lg border-none cursor-pointer flex items-center gap-2">
              <i class="fas fa-calendar-alt"></i>
              <span>هذا الشهر</span>
            </button>
            <button type="button" onclick="setAnalyticsPeriod('last30')"
              class="analytics-period-btn px-4 py-2 bg-gradient-to-r from-amber-500 to-amber-600 hover:from-amber-600 hover:to-amber-700 text-white rounded-lg font-semibold text-sm transition-all duration-300 shadow-md hover:shadow-lg border-none cursor-pointer flex items-center gap-2">
              <i class="fas fa-calendar"></i>
              <span>آخر 30 يوم</span>
            </button>
            <button type="button" onclick="toggleCustomDateRange()"
              id="customDateBtn"
              class="analytics-period-btn px-4 py-2 bg-gradient-to-r from-gray-600 to-gray-700 hover:from-gray-700 hover:to-gray-800 text-white rounded-lg font-semibold text-sm transition-all duration-300 shadow-md hover:shadow-lg border-none cursor-pointer flex items-center gap-2">
              <i class="fas fa-sliders-h"></i>
              <span>فترة مخصصة</span>
            </button>
          </div>
        </div>

        <!-- قسم الفترة المخصصة (مخفي بشكل افتراضي) -->
        <div id="customDateRangePanel"
          class="hidden mt-4 pt-4 border-t border-gray-200 dark:border-gray-700">
          <div class="flex flex-wrap items-end gap-4">
            <div class="flex-1 min-w-[200px]">
              <label
                class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                <i class="fas fa-calendar-check text-indigo-500 mr-1"></i>
                تاريخ البداية
              </label>
              <input type="date" id="customStartDate"
                value="2026-06-01"
                class="w-full px-4 py-2.5 bg-gray-50 dark:bg-gray-700 border-2 border-gray-300 dark:border-gray-600 text-gray-900 dark:text-white rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all">
            </div>
            <div class="flex-1 min-w-[200px]">
              <label
                class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                <i class="fas fa-calendar-check text-indigo-500 mr-1"></i>
                تاريخ النهاية
              </label>
              <input type="date" id="customEndDate"
                value="2026-06-01"
                class="w-full px-4 py-2.5 bg-gray-50 dark:bg-gray-700 border-2 border-gray-300 dark:border-gray-600 text-gray-900 dark:text-white rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all">
            </div>
            <button type="button" onclick="applyCustomDateRange()"
              class="px-6 py-2.5 bg-gradient-to-r from-indigo-500 to-indigo-600 hover:from-indigo-600 hover:to-indigo-700 text-white rounded-lg font-bold transition-all duration-300 shadow-md hover:shadow-lg border-none cursor-pointer flex items-center gap-2">
              <i class="fas fa-check"></i>
              <span>تطبيق</span>
            </button>
            <button type="button" onclick="toggleCustomDateRange()"
              class="px-6 py-2.5 bg-gray-500 hover:bg-gray-600 text-white rounded-lg font-bold transition-all duration-300 border-none cursor-pointer flex items-center gap-2">
              <i class="fas fa-times"></i>
              <span>إلغاء</span>
            </button>
          </div>
        </div>
      </div>

      <!-- تبويبات التقارير -->
      <div class="tabs">
        <button class="tab active" onclick="showTab('overview')">نظرة
          عامة</button>
        <button class="tab" onclick="showTab('revenue')">الإيرادات</button>
        <button class="tab" onclick="showTab('inventory')">المخزون</button>
        <button class="tab" onclick="showTab('analytics')">التحليلات</button>
      </div>

      <!-- تبويب النظرة العامة -->
      <div id="overview" class="tab-content active">
        <!-- الإحصائيات التراكمية العامة -->
        <div class="stats-grid">
          <div class="stat-card">
            <div class="stat-number">0            </div>
            <div class="stat-label">الغرف المتاحة</div>
          </div>
          <div class="stat-card">
            <div class="stat-number">2            </div>
            <div class="stat-label">الغرف المحجوزة</div>
          </div>
          <div class="stat-card">
            <div class="stat-number">
              3            </div>
            <div class="stat-label">الجلسات النشطة حالياً</div>
          </div>
          <div class="stat-card">
            <div class="stat-number">
              0</div>
            <div class="stat-label">جلسات الفترة المحددة</div>
          </div>
          <div class="stat-card">
            <div class="stat-number">
              0</div>
            <div class="stat-label">إيرادات الفترة (جنيه)</div>
          </div>
          <div class="stat-card">
            <div class="stat-number">
              0</div>
            <div class="stat-label">إيرادات الشهر (جنيه)</div>
          </div>
          <div class="stat-card">
            <div class="stat-number">
              1 ساعة 13 دقيقة            </div>
            <div class="stat-label">ساعات اللعب اليوم</div>
          </div>
          <div class="stat-card">
            <div class="stat-number">
              1 ساعة 4 دقيقة            </div>
            <div class="stat-label">إجمالي ساعات اللعب للفترة</div>
          </div>
        </div>


        <!-- أكثر الألعاب شعبية -->
        
        <!-- تقارير مفصلة -->
        <div class="reports-section">
          <h2>
            تقارير مفصلة
            <span
              class="flex flex-wrap items-center gap-2 sm:gap-3 mt-2 sm:mt-0 sm:inline-flex">
              <!-- لوحة فلترة احترافية بتصميم عصري -->
              <div
                class="filter-panel inline-flex flex-wrap items-stretch gap-3 p-4 bg-gradient-to-br from-white via-gray-50 to-white dark:from-gray-800 dark:via-gray-850 dark:to-gray-900 rounded-2xl shadow-2xl border-2 border-gray-200 dark:border-gray-700 backdrop-blur-sm">

                <!-- نوع المستخدم - Custom Dropdown -->
                <div class="relative flex flex-col gap-1.5">
                  <label
                    class="text-xs font-bold text-gray-700 dark:text-gray-300 px-1">
                    <i class="fas fa-users text-blue-500 mr-1"></i>
                    النوع
                  </label>
                  <div class="relative">
                    <button type="button" id="userTypeDropdownBtn"
                      class="w-full min-w-[140px] px-4 py-3 text-sm font-bold bg-white dark:bg-gray-700 border-2 border-blue-300 dark:border-blue-600 text-gray-900 dark:text-white rounded-xl transition-all duration-300 hover:shadow-xl hover:border-blue-500 focus:outline-none focus:ring-4 focus:ring-blue-400 flex items-center justify-between gap-2"
                      onclick="toggleDropdown('userType')">
                      <span id="userTypeSelected"
                        class="flex items-center gap-2">
                        <span>📊</span><span>الكل</span>                      </span>
                      <i class="fas fa-chevron-down text-xs transition-transform duration-300"
                        id="userTypeArrow"></i>
                    </button>
                    <div id="userTypeDropdown"
                      class="absolute z-50 hidden w-full mt-2 bg-white dark:bg-gray-800 border-2 border-blue-200 dark:border-blue-600 rounded-xl shadow-2xl overflow-hidden max-h-60 overflow-y-auto">
                      <div class="py-1">
                        <button type="button"
                          onclick="selectUserType('all', '📊', 'الكل')"
                          class="w-full px-4 py-3 text-right text-sm font-semibold text-gray-700 dark:text-gray-200 hover:bg-blue-50 dark:hover:bg-blue-900/30 transition-colors flex items-center gap-3 bg-blue-100 dark:bg-blue-900/50">
                          <span class="text-lg">📊</span>
                          <span class="flex-1">الكل</span>
                                                      <i
                              class="fas fa-check text-blue-600 dark:text-blue-400"></i>
                                                  </button>
                        <button type="button"
                          onclick="selectUserType('employee', '👷', 'الموظفون')"
                          class="w-full px-4 py-3 text-right text-sm font-semibold text-gray-700 dark:text-gray-200 hover:bg-blue-50 dark:hover:bg-blue-900/30 transition-colors flex items-center gap-3 ">
                          <span class="text-lg">👷</span>
                          <span class="flex-1">الموظفون</span>
                                                  </button>
                        <button type="button"
                          onclick="selectUserType('admin', '👨‍💼', 'الإداريون')"
                          class="w-full px-4 py-3 text-right text-sm font-semibold text-gray-700 dark:text-gray-200 hover:bg-blue-50 dark:hover:bg-blue-900/30 transition-colors flex items-center gap-3 ">
                          <span class="text-lg">👨‍💼</span>
                          <span class="flex-1">الإداريون</span>
                                                  </button>
                      </div>
                    </div>
                  </div>
                  <input type="hidden" id="filterUserType"
                    value="all">
                </div>

                <!-- المستخدم المحدد - Custom Dropdown with Search -->
                <div
                  class="relative flex flex-col gap-1.5 flex-1 min-w-[220px]">
                  <label
                    class="text-xs font-bold text-gray-700 dark:text-gray-300 px-1">
                    <i class="fas fa-user text-green-500 mr-1"></i>
                    المستخدم
                  </label>
                  <div class="relative">
                    <button type="button" id="userDropdownBtn"
                      class="w-full px-4 py-3 text-sm font-bold bg-white dark:bg-gray-700 border-2 border-green-300 dark:border-green-600 text-gray-900 dark:text-white rounded-xl transition-all duration-300 hover:shadow-xl hover:border-green-500 focus:outline-none focus:ring-4 focus:ring-green-400 flex items-center justify-between gap-2"
                      onclick="toggleDropdown('user')">
                      <span id="userSelected"
                        class="flex items-center gap-2 truncate">
                        <span>👥</span><span>جميع المستخدمين</span>                      </span>
                      <i class="fas fa-chevron-down text-xs transition-transform duration-300 flex-shrink-0"
                        id="userArrow"></i>
                    </button>
                    <div id="userDropdown"
                      class="absolute z-50 hidden w-full mt-2 bg-white dark:bg-gray-800 border-2 border-green-200 dark:border-green-600 rounded-xl shadow-2xl overflow-hidden">
                      <!-- Search Box -->
                      <div
                        class="p-3 border-b border-gray-200 dark:border-gray-700">
                        <div class="relative">
                          <i
                            class="fas fa-search absolute right-3 top-1/2 -translate-y-1/2 text-gray-400"></i>
                          <input type="text" id="userSearchInput"
                            class="w-full pr-10 pl-3 py-2 text-sm bg-gray-50 dark:bg-gray-900 border border-gray-300 dark:border-gray-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-400 text-gray-900 dark:text-white"
                            placeholder="ابحث عن مستخدم..."
                            oninput="filterUserDropdown(this.value)">
                        </div>
                      </div>
                      <!-- Options List -->
                      <div class="max-h-60 overflow-y-auto"
                        id="userOptionsList">
                        <button type="button"
                          onclick="selectUser('all', '👥', 'جميع المستخدمين')"
                          data-user-search="جميع المستخدمين"
                          class="user-dropdown-item w-full px-4 py-3 text-right text-sm font-semibold text-gray-700 dark:text-gray-200 hover:bg-green-50 dark:hover:bg-green-900/30 transition-colors flex items-center gap-3 bg-green-100 dark:bg-green-900/50">
                          <span class="text-lg">👥</span>
                          <span class="flex-1 truncate">جميع المستخدمين</span>
                                                      <i
                              class="fas fa-check text-green-600 dark:text-green-400 flex-shrink-0"></i>
                                                  </button>
                                                  <button type="button"
                            onclick="selectUser('350', '👨‍💼', 'admin_mahmoud_atef')"
                            data-user-type="admin"
                            data-user-search="admin_mahmoud_atef إداري"
                            class="user-dropdown-item w-full px-4 py-3 text-right text-sm font-semibold text-gray-700 dark:text-gray-200 hover:bg-green-50 dark:hover:bg-green-900/30 transition-colors flex items-center gap-3 ">
                            <span class="text-lg">👨‍💼</span>
                            <span class="flex-1 text-right">
                              <span
                                class="block truncate">admin_mahmoud_atef</span>
                              <span
                                class="text-xs text-gray-500 dark:text-gray-400">إداري</span>
                            </span>
                                                      </button>
                                              </div>
                    </div>
                  </div>
                  <input type="hidden" id="filterUser"
                    value="all">
                </div>

                <!-- فاصل عمودي -->
                <div
                  class="hidden sm:block w-px bg-gradient-to-b from-transparent via-gray-300 dark:via-gray-600 to-transparent my-2">
                </div>

                <!-- أزرار التحكم -->
                <div class="flex items-end gap-2">
                  <button type="button" onclick="applyDetailedFilters()"
                    class="inline-flex items-center justify-center gap-2 px-6 py-3 text-sm font-bold text-white bg-gradient-to-r from-blue-600 via-blue-700 to-blue-800 hover:from-blue-700 hover:via-blue-800 hover:to-blue-900 rounded-xl shadow-xl hover:shadow-2xl transform hover:-translate-y-1 hover:scale-105 transition-all duration-300 border-none cursor-pointer focus:ring-4 focus:ring-blue-400 active:scale-95">
                    <i class="fas fa-check-circle text-lg"></i>
                    <span>تطبيق</span>
                  </button>
                  <button type="button" onclick="resetDetailedFilters()"
                    class="inline-flex items-center justify-center gap-2 px-6 py-3 text-sm font-bold text-gray-700 dark:text-gray-200 bg-gradient-to-r from-gray-100 via-gray-200 to-gray-300 dark:from-gray-600 dark:via-gray-700 dark:to-gray-800 hover:from-gray-200 hover:via-gray-300 hover:to-gray-400 dark:hover:from-gray-700 dark:hover:via-gray-800 dark:hover:to-gray-900 rounded-xl shadow-xl hover:shadow-2xl transform hover:-translate-y-1 hover:scale-105 transition-all duration-300 border-2 border-gray-300 dark:border-gray-600 cursor-pointer focus:ring-4 focus:ring-gray-400 active:scale-95">
                    <i class="fas fa-redo-alt text-lg"></i>
                    <span>إعادة ضبط</span>
                  </button>
                </div>
              </div>
                                            <button id="exportDetailedExcel"
                  class="px-3 py-2 text-xs sm:text-sm font-medium text-white bg-emerald-600 hover:bg-emerald-700 rounded-lg border-none cursor-pointer transition-colors duration-200 whitespace-nowrap">
                  تصدير Excel
                </button>
                          </span>
          </h2>
          <div class="table-container">
            <table id="detailedReportsTable" class="reports-table">
              <thead>
                <tr>
                  <th>اسم المستخدم</th>
                  <th>وقت البداية</th>
                  <th>وقت النهاية</th>
                  <th>التاريخ</th>
                  <th>اسم الغرفة</th>
                  <th>المدة</th>
                  <th>الطلبات</th>
                  <th>تكلفة الطلبات</th>
                  <th>تكلفة الجلسة</th>
                  <th>إجمالي الغرفة</th>
                </tr>
              </thead>
              <tbody>
                                  <tr>
                    <td colspan="10"
                      style="text-align:center; padding: 16px; color: #94a3b8;">
                      لا توجد بيانات لعرضها ضمن النطاق المحدد
                    </td>
                  </tr>
                      </div>

      <!-- تبويب الإيرادات -->
      <div id="revenue" class="tab-content">
        <div class="stats-grid">
          <div class="stat-card">
            <div class="stat-number">0            </div>
            <div class="stat-label">عدد الجلسات</div>
          </div>
          <div class="stat-card">
            <div class="stat-number">
              0</div>
            <div class="stat-label">إجمالي الإيرادات (جنيه)</div>
          </div>
          <div class="stat-card">
            <div class="stat-number">1            </div>
            <div class="stat-label">عدد الطلبات</div>
          </div>
          <div class="stat-card">
            <div class="stat-number">
              15            </div>
            <div class="stat-label">قيمة الطلبات (جنيه)</div>
          </div>
        </div>

        <!-- مخطط الإيرادات اليومية -->
        
        <!-- جدول الإحصائيات اليومية -->
                        </tbody>
              </table>
            </div>

            <!-- الباجينيشن -->
                          <div
                style="text-align: center; color: #6b7280; font-style: italic; margin-top: 20px;">
                لا توجد بيانات للإيرادات اليومية في الفترة المحددة
              </div>
                      </div>
      </div>



      <!-- تبويب المخزون -->
      <div id="inventory" class="tab-content">
        <!-- الطلبات الأكثر مبيعاً -->
        <div class="reports-section">
          <div
            style="display:flex; align-items:center; justify-content:space-between; gap:12px; flex-wrap:wrap;">
            <h2 style="margin:0;">الطلبات الأكثر مبيعاً</h2>
            <button id="exportTopItemsExcel"
              class="px-3 py-2 text-xs sm:text-sm font-medium text-white bg-emerald-600 hover:bg-emerald-700 rounded-lg border-none cursor-pointer transition-colors duration-200 whitespace-nowrap">
              تصدير Excel
            </button>
          </div>
                      <div id="topItemsList">
                              <div class="report-item">
                  <div class="report-name">
                    اندومي                    <br><small>طعام</small>
                  </div>
                  <div style="display: flex; gap: 10px;">
                    <div class="report-count">1                      قطعة</div>
                    <div class="report-value">
                      15 جنيه                    </div>
                  </div>
                </div>
                          </div>

                        <div class="pagination-container" style="margin-top:20px;">
              <div class="pagination-info">
                عرض 0 - 0 من 0 نتيجة
                              </div>
              <div class="pagination simple-pagination">
                <a class="pagination-btn simple disabled"
                  href="javascript:void(0);"
                  title="الصفحة السابقة" aria-disabled="true">
                  <i class="fas fa-angle-right" aria-hidden="true"></i>
                  <span style="margin-inline-start:6px;">السابق</span>
                </a>
                <span class="pagination-status">
                  الصفحة 1 من 1                </span>
                <a class="pagination-btn simple disabled"
                  href="javascript:void(0);"
                  title="الصفحة التالية" aria-disabled="true">
                  <span style="margin-inline-end:6px;">التالي</span>
                  <i class="fas fa-angle-left" aria-hidden="true"></i>
                </a>
              </div>
            </div>

            <!-- CSS للهوفر والتفاعلية -->
            <style>
              .pagination-btn:not(.disabled):not(.active):hover {
                background: linear-gradient(135deg, #6366f1, #8b5cf6) !important;
                color: #fff !important;
                border-color: transparent !important;
                transform: translateY(-2px);
                box-shadow: 0 6px 16px rgba(99, 102, 241, 0.3) !important;
              }

              .pagination-btn.disabled {
                pointer-events: none;
              }

              body.dark-mode .pagination-btn:not(.active):not(.disabled) {
                background: #1e293b !important;
                color: #cbd5e1 !important;
                border-color: #334155 !important;
              }

              body.dark-mode .top-items-pagination-container {
                background: linear-gradient(135deg, rgba(99, 102, 241, 0.1), rgba(168, 85, 247, 0.1)) !important;
                border-color: rgba(99, 102, 241, 0.2) !important;
              }

              @media (max-width: 640px) {
                .top-items-pagination-container>div {
                  flex-direction: column;
                  gap: 12px;
                }

                .pagination-info {
                  width: 100%;
                  justify-content: center;
                }

                .pagination-controls {
                  width: 100%;
                  justify-content: center;
                  flex-wrap: wrap;
                }
              }
            </style>
                  </div>

        <!-- المخزون المنخفض - الطعام -->
        
        <!-- المخزون المنخفض - المشروبات -->
              </div>

      <!-- تبويب التحليلات - تصميم احترافي -->
      <div id="analytics" class="tab-content">
        <!-- ترويسة التحليلات مع أيقونة -->
        <div
          class="flex items-center justify-between mb-6 p-4 bg-gradient-to-r from-indigo-50 to-purple-50 dark:from-indigo-900/20 dark:to-purple-900/20 rounded-xl border-2 border-indigo-200 dark:border-indigo-700">
          <div class="flex items-center gap-3">
            <div
              class="w-12 h-12 bg-gradient-to-br from-indigo-500 to-purple-600 rounded-xl flex items-center justify-center shadow-lg">
              <i class="fas fa-chart-line text-white text-xl"></i>
            </div>
            <div>
              <h2 class="text-2xl font-bold text-gray-800 dark:text-white m-0">
                لوحة التحليلات المتقدمة</h2>
              <p class="text-sm text-gray-600 dark:text-gray-400 m-0">تحليلات
                شاملة للأداء والإيرادات</p>
            </div>
          </div>
          <div class="flex items-center gap-2">
            <span
              class="px-3 py-1 bg-green-100 dark:bg-green-900/30 text-green-700 dark:text-green-300 rounded-lg text-sm font-semibold">
              <i class="fas fa-calendar-alt mr-1"></i>
              01/06/2026 -
              01/06/2026            </span>
          </div>
        </div>

        <!-- كروت KPI الرئيسية -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
          <!-- إجمالي الإيرادات -->
          <div
            class="bg-gradient-to-br from-blue-500 to-blue-600 rounded-xl p-5 shadow-xl transform hover:scale-105 transition-all duration-300">
            <div class="flex items-center justify-between">
              <div class="flex-1">
                <p class="text-blue-100 text-sm font-semibold mb-1">إجمالي
                  الإيرادات</p>
                <h3 class="text-white text-3xl font-bold mb-1">
                  0</h3>
                <p class="text-blue-200 text-xs">جنيه</p>
              </div>
              <div
                class="w-14 h-14 bg-white/20 rounded-lg flex items-center justify-center">
                <i class="fas fa-coins text-white text-2xl"></i>
              </div>
            </div>
          </div>

          <!-- عدد الجلسات -->
          <div
            class="bg-gradient-to-br from-emerald-500 to-emerald-600 rounded-xl p-5 shadow-xl transform hover:scale-105 transition-all duration-300">
            <div class="flex items-center justify-between">
              <div class="flex-1">
                <p class="text-emerald-100 text-sm font-semibold mb-1">عدد
                  الجلسات</p>
                <h3 class="text-white text-3xl font-bold mb-1">
                  0                </h3>
                <p class="text-emerald-200 text-xs">جلسة مكتملة</p>
              </div>
              <div
                class="w-14 h-14 bg-white/20 rounded-lg flex items-center justify-center">
                <i class="fas fa-gamepad text-white text-2xl"></i>
              </div>
            </div>
          </div>

          <!-- متوسط الإيراد -->
          <div
            class="bg-gradient-to-br from-purple-500 to-purple-600 rounded-xl p-5 shadow-xl transform hover:scale-105 transition-all duration-300">
            <div class="flex items-center justify-between">
              <div class="flex-1">
                <p class="text-purple-100 text-sm font-semibold mb-1">متوسط
                  إيراد الجلسة</p>
                <h3 class="text-white text-3xl font-bold mb-1">
                  0                </h3>
                <p class="text-purple-200 text-xs">جنيه / جلسة</p>
              </div>
              <div
                class="w-14 h-14 bg-white/20 rounded-lg flex items-center justify-center">
                <i class="fas fa-chart-bar text-white text-2xl"></i>
              </div>
            </div>
          </div>

          <!-- ساعات اللعب -->
          <div
            class="bg-gradient-to-br from-amber-500 to-amber-600 rounded-xl p-5 shadow-xl transform hover:scale-105 transition-all duration-300">
            <div class="flex items-center justify-between">
              <div class="flex-1">
                <p class="text-amber-100 text-sm font-semibold mb-1">ساعات اللعب
                </p>
                <h3 class="text-white text-3xl font-bold mb-1">
                  1                </h3>
                <p class="text-amber-200 text-xs">ساعة إجمالية</p>
              </div>
              <div
                class="w-14 h-14 bg-white/20 rounded-lg flex items-center justify-center">
                <i class="fas fa-clock text-white text-2xl"></i>
              </div>
            </div>
          </div>
        </div>

        <!-- شبكة الرسوم البيانية -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
          <!-- مخطط الإيرادات اليومية -->
          
          <!-- مخطط الإيرادات الأسبوعية -->
          
          <!-- مخطط الإيرادات الشهرية -->
          
          <!-- مخطط عدد الجلسات اليومية -->
                  </div>

        <!-- جدول ملخص الإحصائيات -->
              </div>
    </div>
  </div><!-- /page-wrapper -->

  <!-- نظام الإشعارات للجلسات المنتهية -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@3.9.1/dist/chart.min.js">
    </script>

    <!-- نظام طابور الإشعارات -->
    <script src="js/notification-queue.js?v=1779207315"></script>

    <!-- نظام مراقبة الجلسات المحدودة -->
    <script src="js/session-monitor.js?v=1771422103"></script>

    <script>
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

      // Intercept plain logout links for safety
      document.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('a[href$="logout.php"]').forEach(a => {
          a.addEventListener('click', function(e) {
            e.preventDefault();
            attemptLogout();
          });
        });
      });
      // ==================== Dark Mode Synchronization ====================

      // Initialize Dark Mode from localStorage on page load
      function initDarkMode() {
        const darkMode = localStorage.getItem('darkMode');
        const body = document.body;
        const icon = document.getElementById('dark-mode-icon');

        if (darkMode === 'true') {
          body.classList.add('dark-mode');
          if (icon) icon.className = 'fas fa-sun';
        } else {
          body.classList.remove('dark-mode');
          if (icon) icon.className = 'fas fa-moon';
        }
      }

      // Dark Mode Toggle - Synced with localStorage
      async function toggleDarkMode() {
        const body = document.body;
        const icon = document.getElementById('dark-mode-icon');

        body.classList.toggle('dark-mode');
        const isDark = body.classList.contains('dark-mode');

        // Update icon
        if (icon) {
          icon.className = isDark ? 'fas fa-sun' : 'fas fa-moon';
        }

        // Store in localStorage for cross-page sync
        localStorage.setItem('darkMode', isDark);

        // Save to database
        try {
          await fetch('api/user-preferences.php', {
            method: 'POST',
            headers: {
              'Content-Type': 'application/json'
            },
            credentials: 'same-origin',
            body: JSON.stringify({
              dark_mode: isDark
            })
          });
        } catch (error) {
          // Error saving dark mode preference
        }
      }

      // Listen for localStorage changes (cross-tab synchronization)
      window.addEventListener('storage', (e) => {
        if (e.key === 'darkMode') {
          const body = document.body;
          const icon = document.getElementById('dark-mode-icon');
          const isDark = e.newValue === 'true';

          if (isDark) {
            body.classList.add('dark-mode');
            if (icon) icon.className = 'fas fa-sun';
          } else {
            body.classList.remove('dark-mode');
            if (icon) icon.className = 'fas fa-moon';
          }
        }
      });

      // Initialize dark mode from localStorage when DOM loads
      if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', initDarkMode);
      } else {
        initDarkMode();
      }

      // نظام التبويبات
      function showTab(tabName) {
        // إخفاء جميع التبويبات
        const tabs = document.querySelectorAll('.tab-content');
        tabs.forEach(tab => tab.classList.remove('active'));

        // إزالة التفعيل من جميع أزرار التبويب
        const tabButtons = document.querySelectorAll('.tab');
        tabButtons.forEach(button => button.classList.remove('active'));

        // إظهار التبويب المحدد
        document.getElementById(tabName).classList.add('active');

        // تفعيل زر التبويب المحدد
        event.target.classList.add('active');

        // رسم المخططات عند الحاجة
        if (tabName === 'revenue' || tabName === 'analytics') {
          setTimeout(() => {
            drawCharts();
          }, 100);
        }
      }

      // تهيئة Chart.js الموحدة - دعم Dark/Light Mode
      Chart.defaults.font.family = "'Cairo', 'Segoe UI', Tahoma, sans-serif";
      Chart.defaults.font.size = 13;

      // دالة للكشف عن Dark Mode
      function isDarkMode() {
        return document.documentElement.classList.contains('dark') ||
          window.matchMedia('(prefers-color-scheme: dark)').matches;
      }

      // دالة للحصول على ألوان ديناميكية بناءً على الوضع
      function getChartColors() {
        const dark = isDarkMode();
        return {
          gridColor: dark ? 'rgba(75, 85, 99, 0.2)' : 'rgba(156, 163, 175, 0.2)',
          tickColor: dark ? '#d1d5db' : '#374151',
          legendColor: dark ? '#e5e7eb' : '#1f2937',
          tooltipBg: dark ? '#1f2937' : '#ffffff',
          tooltipText: dark ? '#f3f4f6' : '#111827',
          tooltipBorder: dark ? '#374151' : '#d1d5db'
        };
      }

      // خيارات Chart.js الافتراضية الموحدة
      function getDefaultChartOptions(customOptions = {}) {
        const colors = getChartColors();
        return {
          responsive: true,
          maintainAspectRatio: false,
          interaction: {
            mode: 'index',
            intersect: false
          },
          plugins: {
            legend: {
              display: true,
              position: 'top',
              labels: {
                color: colors.legendColor,
                padding: 15,
                font: {
                  size: 12,
                  weight: '600'
                },
                usePointStyle: true,
                pointStyle: 'circle'
              }
            },
            tooltip: {
              backgroundColor: colors.tooltipBg,
              titleColor: colors.tooltipText,
              bodyColor: colors.tooltipText,
              borderColor: colors.tooltipBorder,
              borderWidth: 1,
              padding: 12,
              displayColors: true,
              callbacks: {
                label: function(context) {
                  let label = context.dataset.label || '';
                  if (label) {
                    label += ': ';
                  }
                  label += new Intl.NumberFormat('ar-EG', {
                    style: 'decimal',
                    minimumFractionDigits: 0,
                    maximumFractionDigits: 0
                  }).format(context.parsed.y || context.parsed);
                  label += ' ' + CURRENCY_SYMBOL;
                  return label;
                }
              }
            }
          },
          scales: {
            y: {
              beginAtZero: true,
              ticks: {
                color: colors.tickColor,
                font: {
                  size: 11
                },
                callback: function(value) {
                  return new Intl.NumberFormat('ar-EG', {
                    notation: 'compact',
                    compactDisplay: 'short'
                  }).format(value);
                }
              },
              grid: {
                color: colors.gridColor,
                drawBorder: false
              }
            },
            x: {
              ticks: {
                color: colors.tickColor,
                font: {
                  size: 11
                },
                maxRotation: 45,
                minRotation: 0
              },
              grid: {
                color: colors.gridColor,
                drawBorder: false,
                display: false
              }
            }
          },
          ...customOptions
        };
      }

      // رسم المخططات
      function drawCharts() {
        // مخطط الإيرادات اليومية
        
        // مخطط الإيرادات الأسبوعية
        
        // مخطط الإيرادات الشهرية
        
        // مخطط عدد الجلسات اليومية
              }

      // إعادة رسم المخططات عند تبديل Dark Mode
      let chartInstances = [];

      function redrawChartsOnThemeChange() {
        chartInstances.forEach(chart => chart.destroy());
        chartInstances = [];
        drawCharts();
      }

      // مراقبة تغيير Dark Mode
      const darkModeObserver = new MutationObserver((mutations) => {
        mutations.forEach((mutation) => {
          if (mutation.attributeName === 'class') {
            redrawChartsOnThemeChange();
          }
        });
      });

      if (document.body) {
        darkModeObserver.observe(document.body, {
          attributes: true,
          attributeFilter: ['class']
        });
      }

      // دالة مساعدة لتنسيق التاريخ بصيغة YYYY-MM-DD
      function formatDate(date) {
        const year = date.getFullYear();
        const month = String(date.getMonth() + 1).padStart(2, '0');
        const day = String(date.getDate()).padStart(2, '0');
        return `${year}-${month}-${day}`;
      }

      // وظائف فلاتر الفترة الزمنية
      function setAnalyticsPeriod(period) {
        const today = new Date();
        let startDate, endDate;

        switch (period) {
          case 'today':
            startDate = endDate = formatDate(today);
            break;

          case 'week':
            // أول الأسبوع (السبت في التقويم العربي)
            const dayOfWeek = today.getDay();
            const diff = dayOfWeek === 6 ? 0 : (dayOfWeek + 1); // 6 = Saturday
            const startOfWeek = new Date(today);
            startOfWeek.setDate(today.getDate() - diff);
            startDate = formatDate(startOfWeek);
            endDate = formatDate(today);
            break;

          case 'month':
            // أول الشهر
            const startOfMonth = new Date(today.getFullYear(), today.getMonth(),
              1);
            startDate = formatDate(startOfMonth);
            endDate = formatDate(today);
            break;

          case 'last30':
            // آخر 30 يوم
            const last30 = new Date(today);
            last30.setDate(today.getDate() - 30);
            startDate = formatDate(last30);
            endDate = formatDate(today);
            break;
        }

        // تحديث URL وإعادة تحميل الصفحة مع الفلاتر الجديدة
        const url = new URL(window.location.href);
        url.searchParams.set('start_date', startDate);
        url.searchParams.set('end_date', endDate);
        window.location.href = url.toString();
      }

      function toggleCustomDateRange() {
        const panel = document.getElementById('customDateRangePanel');
        if (panel) {
          panel.classList.toggle('hidden');
        }
      }

      function applyCustomDateRange() {
        const startDate = document.getElementById('customStartDate').value;
        const endDate = document.getElementById('customEndDate').value;

        if (!startDate || !endDate) {
          alert('الرجاء اختيار تاريخ البداية والنهاية');
          return;
        }

        if (new Date(startDate) > new Date(endDate)) {
          alert('تاريخ البداية يجب أن يكون قبل تاريخ النهاية');
          return;
        }

        // تحديث URL وإعادة تحميل الصفحة
        const url = new URL(window.location.href);
        url.searchParams.set('start_date', startDate);
        url.searchParams.set('end_date', endDate);
        window.location.href = url.toString();
      }

      // رسم المخططات عند تحميل الصفحة
      document.addEventListener('DOMContentLoaded', function() {
        drawCharts();
      });
    </script>

    
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
</style>    </body>

</html>