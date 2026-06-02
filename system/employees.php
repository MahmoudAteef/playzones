
<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description"
    content="the seystem good live ">
  <meta name="author"
    content="ENG.HOSSAM">
  <title>إدارة الموظفين - Play Zone</title>

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

    /* Cards */
    .card {
      background: white;
      border-radius: 12px;
      padding: 20px;
      box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
      transition: all 0.3s ease;
      margin-bottom: 20px;
    }

    body.dark-mode .card {
      background: #334155;
      box-shadow: 0 2px 8px rgba(0, 0, 0, 0.3);
    }

    .card:hover {
      box-shadow: 0 4px 16px rgba(0, 0, 0, 0.12);
    }

    /* Form Styles */
    .form-label {
      display: block;
      font-weight: 600;
      margin-bottom: 8px;
      color: #374151;
    }

    body.dark-mode .form-label {
      color: #e2e8f0;
    }

    .form-input,
    .form-select {
      width: 100%;
      padding: 10px 12px;
      border: 2px solid #e5e7eb;
      border-radius: 8px;
      font-size: 0.95rem;
      transition: all 0.3s ease;
      background: white;
      color: #1f2937;
    }

    body.dark-mode .form-input,
    body.dark-mode .form-select {
      background: #1e293b;
      border-color: #475569;
      color: #e2e8f0;
    }

    .form-input:focus,
    .form-select:focus {
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
    }

    .btn-primary {
      background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
      color: white;
      box-shadow: 0 2px 8px rgba(102, 126, 234, 0.3);
    }

    .btn-primary:hover {
      transform: translateY(-2px);
      box-shadow: 0 4px 12px rgba(102, 126, 234, 0.4);
    }

    .btn-success {
      background: linear-gradient(135deg, #10b981 0%, #059669 100%);
      color: white;
    }

    .btn-success:hover {
      transform: translateY(-2px);
      box-shadow: 0 4px 12px rgba(16, 185, 129, 0.4);
    }

    .btn-warning {
      background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
      color: white;
    }

    .btn-warning:hover {
      transform: translateY(-2px);
      box-shadow: 0 4px 12px rgba(245, 158, 11, 0.4);
    }

    .btn-danger {
      background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
      color: white;
    }

    .btn-danger:hover {
      transform: translateY(-2px);
      box-shadow: 0 4px 12px rgba(239, 68, 68, 0.4);
    }

    .btn-info {
      background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);
      color: white;
    }

    .btn-info:hover {
      transform: translateY(-2px);
      box-shadow: 0 4px 12px rgba(59, 130, 246, 0.4);
    }

    /* Table Styles */
    .table-container {
      overflow-x: auto;
      border-radius: 12px;
    }

    .data-table {
      width: 100%;
      border-collapse: collapse;
    }

    .data-table thead {
      background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    }

    .data-table th {
      padding: 12px 16px;
      text-align: right;
      color: white;
      font-weight: 600;
      font-size: 0.9rem;
    }

    .data-table td {
      padding: 12px 16px;
      border-bottom: 1px solid #e5e7eb;
      color: #374151;
    }

    body.dark-mode .data-table td {
      border-bottom-color: #475569;
      color: #cbd5e1;
    }

    .data-table tbody tr {
      transition: background 0.2s ease;
    }

    .data-table tbody tr:hover {
      background: rgba(102, 126, 234, 0.05);
    }

    body.dark-mode .data-table tbody tr:hover {
      background: rgba(102, 126, 234, 0.1);
    }

    /* Badges */
    .badge {
      display: inline-flex;
      align-items: center;
      padding: 4px 12px;
      border-radius: 12px;
      font-size: 0.85rem;
      font-weight: 600;
    }

    .badge-success {
      background: #d1fae5;
      color: #065f46;
    }

    body.dark-mode .badge-success {
      background: rgba(16, 185, 129, 0.2);
      color: #6ee7b7;
    }

    .badge-danger {
      background: #fee2e2;
      color: #991b1b;
    }

    body.dark-mode .badge-danger {
      background: rgba(239, 68, 68, 0.2);
      color: #fca5a5;
    }

    /* Checkbox Styles */
    .checkbox-group {
      display: flex;
      align-items: center;
      gap: 8px;
      margin-bottom: 8px;
    }

    .checkbox-input {
      width: 18px;
      height: 18px;
      cursor: pointer;
    }

    .checkbox-label {
      cursor: pointer;
      font-size: 0.9rem;
      color: #374151;
    }

    body.dark-mode .checkbox-label {
      color: #cbd5e1;
    }

    /* Permission Cards */
    .permission-card {
      border: 2px solid #e5e7eb;
      border-radius: 12px;
      overflow: hidden;
      background: white;
      transition: all 0.3s ease;
      box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
    }

    .permission-card:hover {
      transform: translateY(-4px);
      box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
    }

    .permission-card-header {
      padding: 12px 16px;
      color: white;
      font-weight: 700;
      font-size: 1rem;
      display: flex;
      align-items: center;
      gap: 10px;
    }

    .permission-card-header i {
      font-size: 1.2rem;
    }

    .permission-card-body {
      padding: 16px;
      display: flex;
      flex-direction: column;
      gap: 10px;
    }

    .permission-item {
      display: flex;
      align-items: center;
      gap: 10px;
      padding: 8px;
      border-radius: 6px;
      transition: background 0.2s ease;
    }

    .permission-item:hover {
      background: #f3f4f6;
    }

    .permission-checkbox {
      width: 18px;
      height: 18px;
      cursor: pointer;
      accent-color: #667eea;
    }

    .permission-label {
      cursor: pointer;
      color: #374151;
      font-size: 0.9rem;
      font-weight: 500;
      display: flex;
      align-items: center;
      gap: 8px;
      margin: 0;
      user-select: none;
      flex: 1;
    }

    .permission-label i {
      font-size: 0.85rem;
      color: #667eea;
    }

    /* Dark Mode - Permission Cards */
    body.dark-mode .permission-card {
      background: #1f2937;
      border-color: #374151;
    }

    body.dark-mode .permission-item:hover {
      background: #374151;
    }

    body.dark-mode .permission-label {
      color: #e5e7eb;
    }

    body.dark-mode .permission-label i {
      color: #a78bfa;
    }

    /* Permissions Grid layout */
    .permissions-grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
      gap: 16px;
    }

    /* Responsive Permission Cards */
    @media (max-width: 768px) {

      /* Center cards and make one column on small screens */
      .permissions-grid {
        grid-template-columns: 1fr;
        justify-items: center;
      }

      .permissions-grid .permission-card {
        width: 100%;
        max-width: 480px;
        margin: 0 auto;
      }

      .permission-card-header {
        font-size: 0.9rem;
        padding: 10px 12px;
      }

      .permission-card-body {
        padding: 12px;
        gap: 8px;
      }

      .permission-item {
        padding: 6px;
      }

      .permission-label {
        font-size: 0.85rem;
      }

      .permission-checkbox {
        width: 16px;
        height: 16px;
      }
    }

    @media (max-width: 480px) {
      .permission-card-header {
        font-size: 0.85rem;
        padding: 8px 10px;
      }

      .permission-card-header i {
        font-size: 1rem;
      }

      .permission-label {
        font-size: 0.8rem;
      }

      .permission-label i {
        font-size: 0.75rem;
      }
    }

    /* Modal Styles */
    .modal {
      position: fixed;
      inset: 0;
      background: rgba(0, 0, 0, 0.6);
      backdrop-filter: blur(4px);
      z-index: 1000;
      display: none;
      align-items: center;
      justify-content: center;
      padding: 20px;
    }

    .modal.active {
      display: flex;
    }

    .modal-content {
      background: white;
      border-radius: 16px;
      box-shadow: 0 10px 40px rgba(0, 0, 0, 0.3);
      max-width: 800px;
      width: 100%;
      max-height: 90vh;
      overflow-y: auto;
    }

    body.dark-mode .modal-content {
      background: #1e293b;
    }

    .modal-header {
      background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
      padding: 20px 24px;
      border-radius: 16px 16px 0 0;
      display: flex;
      justify-content: space-between;
      align-items: center;
    }

    .modal-title {
      color: white;
      font-size: 1.5rem;
      font-weight: 700;
    }

    .modal-close {
      background: none;
      border: none;
      color: white;
      font-size: 1.75rem;
      cursor: pointer;
      width: 32px;
      height: 32px;
      display: flex;
      align-items: center;
      justify-content: center;
      border-radius: 8px;
      transition: background 0.2s;
    }

    .modal-close:hover {
      background: rgba(255, 255, 255, 0.2);
    }

    .modal-body {
      padding: 24px;
    }

    /* Alert Styles */
    .alert {
      padding: 12px 16px;
      border-radius: 8px;
      margin-bottom: 20px;
      display: flex;
      align-items: center;
      gap: 10px;
      font-weight: 500;
    }

    .alert-success {
      background: #d1fae5;
      color: #065f46;
      border: 1px solid #6ee7b7;
    }

    body.dark-mode .alert-success {
      background: rgba(16, 185, 129, 0.2);
      color: #6ee7b7;
      border-color: #10b981;
    }

    .alert-error {
      background: #fee2e2;
      color: #991b1b;
      border: 1px solid #fca5a5;
    }

    body.dark-mode .alert-error {
      background: rgba(239, 68, 68, 0.2);
      color: #fca5a5;
      border-color: #ef4444;
    }

    /* Scrollbar */
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

    /* Hours Input Highlight */
    .hours-input-wrapper {
      display: flex;
      align-items: center;
      gap: 8px;
      padding: 4px;
      border-radius: 8px;
      transition: all 0.3s ease;
    }

    .hours-input-wrapper:hover {
      background: rgba(102, 126, 234, 0.1);
    }

    .hours-input-wrapper input:focus {
      border-color: #667eea;
      box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.15);
    }

    body.dark-mode .hours-input-wrapper .form-input {
      background: #0f172a;
    }

    /* Info Banner Styles */
    .info-banner {
      margin-bottom: 24px;
      padding: 16px 20px;
      background: linear-gradient(135deg, rgba(59, 130, 246, 0.1) 0%, rgba(99, 102, 241, 0.1) 100%);
      border: 2px solid rgba(59, 130, 246, 0.3);
      border-radius: 12px;
      display: flex;
      align-items: center;
      gap: 16px;
    }

    body.dark-mode .info-banner {
      background: linear-gradient(135deg, rgba(59, 130, 246, 0.15) 0%, rgba(99, 102, 241, 0.15) 100%);
      border-color: rgba(59, 130, 246, 0.4);
    }

    body.dark-mode .info-banner h3 {
      color: #f1f5f9 !important;
    }

    body.dark-mode .info-banner p {
      color: #cbd5e1 !important;
    }

    body.dark-mode .info-banner a {
      color: #60a5fa !important;
      border-bottom-color: #60a5fa !important;
    }

    /* Tab Styles */
    .tab-btn {
      background: none;
      border: none;
      padding: 12px 20px;
      font-size: 1rem;
      font-weight: 600;
      color: #6b7280;
      cursor: pointer;
      border-bottom: 3px solid transparent;
      transition: all 0.3s ease;
      display: flex;
      align-items: center;
      gap: 8px;
    }

    .tab-btn:hover {
      color: #667eea;
    }

    .tab-btn.active {
      color: #667eea;
      border-bottom-color: #667eea;
    }

    body.dark-mode .tab-btn {
      color: #9ca3af;
    }

    body.dark-mode .tab-btn.active {
      color: #a78bfa;
      border-bottom-color: #a78bfa;
    }

    .tab-content {
      display: none;
      animation: fadeIn 0.3s ease;
    }

    .tab-content.active {
      display: block;
    }

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

    /* ========== Custom Modal Notification System ========== */

    /* Modal Overlay */
    .custom-modal-overlay {
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background: rgba(0, 0, 0, 0.5);
      backdrop-filter: blur(4px);
      display: flex;
      align-items: center;
      justify-content: center;
      z-index: 9999;
      opacity: 0;
      animation: fadeIn 0.2s ease forwards;
    }

    body.dark-mode .custom-modal-overlay {
      background: rgba(0, 0, 0, 0.7);
    }

    @keyframes fadeIn {
      to {
        opacity: 1;
      }
    }

    /* Modal Container */
    .custom-modal {
      background: white;
      border-radius: 16px;
      box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
      max-width: 500px;
      width: 90%;
      padding: 2rem;
      position: relative;
      transform: scale(0.9);
      opacity: 0;
      animation: modalZoomIn 0.3s ease forwards;
    }

    body.dark-mode .custom-modal {
      background: #1f2937;
      box-shadow: 0 20px 60px rgba(0, 0, 0, 0.6);
    }

    @keyframes modalZoomIn {
      to {
        transform: scale(1);
        opacity: 1;
      }
    }

    /* Close Button */
    .modal-close-btn {
      position: absolute;
      top: 1rem;
      right: 1rem;
      background: transparent;
      border: none;
      font-size: 1.5rem;
      color: #9ca3af;
      cursor: pointer;
      transition: all 0.2s ease;
      width: 32px;
      height: 32px;
      display: flex;
      align-items: center;
      justify-content: center;
      border-radius: 8px;
    }

    .modal-close-btn:hover {
      color: #ef4444;
      background: rgba(239, 68, 68, 0.1);
      transform: rotate(90deg);
    }

    body.dark-mode .modal-close-btn {
      color: #d1d5db;
    }

    body.dark-mode .modal-close-btn:hover {
      color: #f87171;
      background: rgba(248, 113, 113, 0.15);
    }

    /* Modal Icon */
    .modal-icon {
      width: 64px;
      height: 64px;
      margin: 0 auto 1.5rem;
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 2rem;
    }

    .modal-icon.success {
      background: linear-gradient(135deg, #10b981 0%, #059669 100%);
      color: white;
      box-shadow: 0 8px 24px rgba(16, 185, 129, 0.4);
    }

    .modal-icon.error {
      background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
      color: white;
      box-shadow: 0 8px 24px rgba(239, 68, 68, 0.4);
    }

    .modal-icon.warning {
      background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
      color: white;
      box-shadow: 0 8px 24px rgba(245, 158, 11, 0.4);
    }

    /* Modal Content */
    .modal-title {
      font-size: 1.5rem;
      font-weight: 700;
      color: #1f2937;
      text-align: center;
      margin-bottom: 1rem;
    }

    body.dark-mode .modal-title {
      color: #f9fafb;
    }

    .modal-message {
      font-size: 1rem;
      line-height: 1.6;
      color: #4b5563;
      text-align: center;
      margin-bottom: 2rem;
    }

    body.dark-mode .modal-message {
      color: #d1d5db;
    }

    /* Modal Actions */
    .modal-actions {
      display: flex;
      gap: 12px;
      justify-content: center;
    }

    .modal-btn {
      padding: 12px 24px;
      font-size: 1rem;
      font-weight: 600;
      border-radius: 8px;
      border: none;
      cursor: pointer;
      transition: all 0.2s ease;
      display: flex;
      align-items: center;
      gap: 8px;
      min-width: 120px;
      justify-content: center;
    }

    .modal-btn-confirm {
      background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
      color: white;
      box-shadow: 0 4px 12px rgba(245, 158, 11, 0.4);
    }

    .modal-btn-confirm:hover {
      transform: translateY(-2px);
      box-shadow: 0 6px 16px rgba(245, 158, 11, 0.5);
    }

    .modal-btn-cancel {
      background: #6b7280;
      color: white;
      box-shadow: 0 4px 12px rgba(107, 114, 128, 0.3);
    }

    .modal-btn-cancel:hover {
      background: #4b5563;
      transform: translateY(-2px);
      box-shadow: 0 6px 16px rgba(107, 114, 128, 0.4);
    }

    .modal-btn-success {
      background: linear-gradient(135deg, #10b981 0%, #059669 100%);
      color: white;
      box-shadow: 0 4px 12px rgba(16, 185, 129, 0.4);
    }

    .modal-btn-success:hover {
      transform: translateY(-2px);
      box-shadow: 0 6px 16px rgba(16, 185, 129, 0.5);
    }

    .modal-btn-error {
      background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
      color: white;
      box-shadow: 0 4px 12px rgba(239, 68, 68, 0.4);
    }

    .modal-btn-error:hover {
      transform: translateY(-2px);
      box-shadow: 0 6px 16px rgba(239, 68, 68, 0.5);
    }

    /* Responsive */
    @media (max-width: 640px) {
      .custom-modal {
        width: 95%;
        padding: 1.5rem;
      }

      .modal-title {
        font-size: 1.2rem;
      }

      .modal-message {
        font-size: 0.9rem;
      }

      .modal-actions {
        flex-direction: column;
        gap: 8px;
      }

      .modal-btn {
        width: 100%;
      }

      .modal-icon {
        width: 56px;
        height: 56px;
        font-size: 1.75rem;
      }
    }

    /* National ID Cell */
    .nid-cell {
      font-size: 0.8rem;
      direction: ltr;
      display: inline-block;
      font-family: 'Courier New', monospace;
      letter-spacing: 0.5px;
      color: #6b7280;
      font-weight: 500;
      font-feature-settings: 'tnum' 1;
    }

    body.dark-mode .nid-cell {
      color: #9ca3af;
    }

    /* National ID Hint */
    .nid-hint {
      display: block;
      margin-top: 6px;
      font-size: 0.8rem;
      font-weight: 500;
    }

    .nid-hint.error {
      color: #ef4444;
    }

    .nid-hint.success {
      color: #10b981;
    }

    .form-input.nid-error {
      border-color: #ef4444 !important;
      box-shadow: 0 0 0 3px rgba(239, 68, 68, 0.1) !important;
    }

    .form-input.nid-success {
      border-color: #10b981 !important;
      box-shadow: 0 0 0 3px rgba(16, 185, 129, 0.1) !important;
    }

    /* Currency Symbol - Dynamic */
    :root { --currency-symbol: 'جنيه'; }

    /* Currency - Egyptian Pound */
    .currency-egp {
      font-weight: 600;
      color: #10b981;
      display: inline-flex;
      align-items: center;
      gap: 4px;
    }

    .currency-egp::after {
      content: var(--currency-symbol, 'جنيه');
      font-size: 0.85rem;
      font-weight: 500;
      opacity: 0.9;
    }

    body.dark-mode .currency-egp {
      color: #34d399;
    }

    /* Responsive */
    @media (max-width: 640px) {
      .currency-egp::after {
        content: var(--currency-symbol, 'جنيه');
      }
    }

    /* Actions Group - 2x2 Grid Layout */
    .actions-group {
      display: grid;
      grid-template-columns: repeat(2, minmax(110px, 140px));
      gap: 8px;
      justify-content: start;
      width: fit-content;
    }

    .btn-fixed {
      width: 100%;
      height: 38px;
      padding: 6px 10px;
      display: inline-flex;
      align-items: center;
      justify-content: center;
      gap: 5px;
      font-size: 0.85rem;
      white-space: nowrap;
      min-width: 0;
      overflow: hidden;
      text-overflow: ellipsis;
    }

    .btn-fixed i {
      flex-shrink: 0;
      font-size: 0.9rem;
    }

    /* Responsive for Mobile */
    @media (max-width: 768px) {
      .actions-group {
        grid-template-columns: repeat(2, 1fr);
        gap: 6px;
        width: 100%;
      }

      .btn-fixed {
        height: 36px;
        font-size: 0.75rem;
        padding: 4px 6px;
        gap: 4px;
      }

      .btn-fixed i {
        font-size: 0.85rem;
      }

      .btn-fixed span {
        display: inline;
      }
    }

    @media (max-width: 480px) {
      .btn-fixed {
        font-size: 0.7rem;
        height: 34px;
        padding: 4px 4px;
        gap: 3px;
      }

      .btn-fixed i {
        font-size: 0.8rem;
      }
    }

    /* Permission Category Titles */
    .category-title {
      color: #667eea !important;
      font-weight: 700;
      font-size: 1.1rem;
      margin-bottom: 12px;
      padding-bottom: 8px;
      border-bottom: 2px solid #e5e7eb;
    }

    body.dark-mode .category-title {
      color: #a78bfa !important;
      border-bottom-color: #475569;
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
        padding: 12px 18px;
      }

      .logo {
        font-size: 1.5rem;
      }

      .main-content {
        padding: 18px;
      }

      .page-title {
        font-size: 1.5rem;
      }

      .data-table {
        font-size: 0.8rem;
      }

      .data-table th,
      .data-table td {
        padding: 8px 6px;
      }

      .data-table th {
        font-size: 0.75rem;
      }

      /* Make table scrollable on mobile */
      .table-container {
        overflow-x: auto;
        -webkit-overflow-scrolling: touch;
      }

      .data-table {
        min-width: 800px;
      }
    }

    @media (max-width: 480px) {
      .data-table {
        font-size: 0.75rem;
        min-width: 900px;
      }

      .data-table th,
      .data-table td {
        padding: 6px 4px;
      }

      .nid-cell {
        font-size: 0.7rem;
      }

      .currency-egp {
        font-size: 0.75rem;
      }

      .badge {
        font-size: 0.7rem;
        padding: 3px 8px;
      }
    }

    /* ====== Room Limit Alert Styles (copied to employees) ====== */
    .room-limit-alert {
      background: linear-gradient(135deg, #fef3c7 0%, #fde68a 100%);
      border: 1px solid #f59e0b;
      border-radius: 12px;
      padding: 16px;
      margin-bottom: 16px;
      box-shadow: 0 4px 12px rgba(245, 158, 11, 0.15);
      animation: slideInDown 0.4s ease-out;
      position: relative;
      z-index: 10;
    }

    body.dark-mode .room-limit-alert {
      background: linear-gradient(135deg, #451a03 0%, #78350f 100%);
      border-color: #f59e0b;
      box-shadow: 0 4px 12px rgba(245, 158, 11, 0.25);
    }

    .alert-content {
      display: flex;
      align-items: center;
      gap: 16px;
    }

    .alert-icon {
      flex-shrink: 0;
      width: 48px;
      height: 48px;
      border-radius: 50%;
      background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
      color: #fff;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 20px;
      box-shadow: 0 2px 8px rgba(245, 158, 11, 0.3);
    }

    body.dark-mode .alert-icon {
      box-shadow: 0 2px 8px rgba(245, 158, 11, 0.4);
    }

    .alert-text {
      flex: 1;
      min-width: 0;
    }

    .alert-text h4 {
      margin: 0 0 4px 0;
      font-size: 1.1rem;
      font-weight: 700;
      color: #92400e;
      line-height: 1.3;
    }

    body.dark-mode .alert-text h4 {
      color: #fbbf24;
    }

    .alert-text p {
      margin: 0;
      font-size: 0.9rem;
      color: #a16207;
      line-height: 1.4;
    }

    body.dark-mode .alert-text p {
      color: #fcd34d;
    }

    .alert-actions {
      flex-shrink: 0;
      display: flex;
      gap: 8px;
      flex-wrap: wrap;
    }

    .btn-outline-primary {
      background: transparent;
      border: 2px solid #3b82f6;
      color: #3b82f6;
      padding: 8px 16px;
      border-radius: 8px;
      font-size: 0.85rem;
      font-weight: 600;
      cursor: pointer;
      transition: all 0.3s ease;
      display: inline-flex;
      align-items: center;
      gap: 6px;
    }

    .btn-outline-primary:hover {
      background: #3b82f6;
      color: white;
      transform: translateY(-1px);
      box-shadow: 0 4px 12px rgba(59, 130, 246, 0.3);
    }

    body.dark-mode .btn-outline-primary {
      border-color: #60a5fa;
      color: #60a5fa;
    }

    body.dark-mode .btn-outline-primary:hover {
      background: #60a5fa;
      color: #1e293b;
      box-shadow: 0 4px 12px rgba(96, 165, 250, 0.3);
    }

    .btn-outline-success {
      background: transparent;
      border: 2px solid #10b981;
      color: #10b981;
      padding: 8px 16px;
      border-radius: 8px;
      font-size: 0.85rem;
      font-weight: 600;
      cursor: pointer;
      transition: all 0.3s ease;
      display: inline-flex;
      align-items: center;
      gap: 6px;
    }

    .btn-outline-success:hover {
      background: #10b981;
      color: white;
      transform: translateY(-1px);
      box-shadow: 0 4px 12px rgba(16, 185, 129, 0.3);
    }

    body.dark-mode .btn-outline-success {
      border-color: #34d399;
      color: #34d399;
    }

    body.dark-mode .btn-outline-success:hover {
      background: #34d399;
      color: #064e3b;
      box-shadow: 0 4px 12px rgba(52, 211, 153, 0.3);
    }

    @keyframes slideInDown {
      from {
        opacity: 0;
        transform: translateY(-20px);
      }

      to {
        opacity: 1;
        transform: translateY(0);
      }
    }

    @keyframes fadeOut {
      from {
        opacity: 1;
        transform: translateY(0);
      }

      to {
        opacity: 0;
        transform: translateY(-20px);
      }
    }

    /* Responsive adjustments for alert card */
    @media (max-width: 768px) {
      .alert-content {
        flex-direction: column;
        text-align: center;
        gap: 12px;
      }

      .alert-icon {
        width: 40px;
        height: 40px;
        font-size: 18px;
      }

      .alert-text h4 {
        font-size: 1rem;
      }

      .alert-text p {
        font-size: 0.85rem;
      }

      .alert-actions {
        width: 100%;
        justify-content: center;
      }

      .alert-actions .btn-outline-primary,
      .alert-actions .btn-outline-success {
        width: 100%;
        justify-content: center;
      }
    }

    @media (max-width: 480px) {
      .room-limit-alert {
        padding: 12px;
        margin-bottom: 12px;
      }

      .alert-content {
        gap: 10px;
      }

      .alert-icon {
        width: 36px;
        height: 36px;
        font-size: 16px;
      }
    }

    /* فترة إعادة الاحتساب — أزرار عصرية متجاوبة */
    .discount-period-picker {
      position: relative;
      width: 100%;
    }
    .discount-period-picker__native {
      position: absolute;
      width: 1px;
      height: 1px;
      padding: 0;
      margin: -1px;
      overflow: hidden;
      clip: rect(0, 0, 0, 0);
      white-space: nowrap;
      border: 0;
    }
    .discount-period-picker__buttons {
      display: flex;
      flex-wrap: wrap;
      gap: 8px;
      width: 100%;
    }
    .discount-period-picker__btn {
      flex: 1 1 calc(33.333% - 6px);
      min-width: 92px;
      min-height: 44px;
      padding: 10px 12px;
      border: 2px solid #c4b5fd;
      border-radius: 12px;
      background: #fff;
      color: #5b21b6;
      font-size: clamp(0.8rem, 2.8vw, 0.95rem);
      font-weight: 600;
      font-family: inherit;
      cursor: pointer;
      transition: transform 0.15s ease, box-shadow 0.2s ease, border-color 0.2s ease, background 0.2s ease, color 0.2s ease;
      -webkit-tap-highlight-color: transparent;
      touch-action: manipulation;
    }
    .discount-period-picker__btn:hover {
      border-color: #8b5cf6;
      box-shadow: 0 2px 10px rgba(139, 92, 246, 0.2);
    }
    .discount-period-picker__btn.is-active {
      background: linear-gradient(135deg, #8b5cf6 0%, #6d28d9 100%);
      color: #fff;
      border-color: transparent;
      box-shadow: 0 4px 16px rgba(109, 40, 217, 0.4);
    }
    .discount-period-picker__btn:focus-visible {
      outline: 2px solid #8b5cf6;
      outline-offset: 2px;
    }
    body.dark-mode .discount-period-picker__btn {
      background: rgba(30, 41, 59, 0.6);
      color: #e9d5ff;
      border-color: rgba(139, 92, 246, 0.5);
    }
    body.dark-mode .discount-period-picker__btn:hover {
      background: rgba(30, 41, 59, 0.9);
    }
    body.dark-mode .discount-period-picker__btn.is-active {
      background: linear-gradient(135deg, #8b5cf6 0%, #6d28d9 100%);
      color: #fff;
    }
    @media (max-width: 520px) {
      .discount-period-picker__btn {
        flex: 1 1 100%;
        min-height: 48px;
        font-size: 1rem;
      }
    }
  </style>
</head>

<body class="dark-mode">
  
  <!-- Header - outside page wrapper for full-width alignment -->
  <div class="header-wrapper">
    <div class="header fade-in">
      <div class="logo" onclick="window.location.href='dashboard.php'">
        <i class="fas fa-users"></i>
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
        <i class="fas fa-users-cog"></i>
        إدارة الموظفين
      </div>

      <!-- Messages: Handled by SweetAlert2 modals now -->

      <!-- Add Employee Card -->
      <div class="card">
        <h2
          style="font-size: 1.25rem; font-weight: 700; margin-bottom: 20px; color: #667eea;">
          <i class="fas fa-user-plus"></i> إضافة موظف جديد
        </h2>
        <form id="addEmployeeForm" method="POST"
          onsubmit="submitCreateEmployee(event); return false;">
          <input type="hidden" name="action" value="create_employee">

          <div
            style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 16px; margin-bottom: 16px;">
            <div>
              <label class="form-label">اسم المستخدم <span
                  style="color: #ef4444;">*</span></label>
              <input type="text" name="username" required class="form-input"
                placeholder="أدخل اسم المستخدم">
            </div>
            <div>
              <label class="form-label">كلمة المرور <span
                  style="color: #ef4444;">*</span></label>
              <input type="password" name="password" required class="form-input"
                placeholder="أدخل كلمة المرور">
            </div>
            <div>
              <label class="form-label">الاسم الكامل</label>
              <input type="text" name="full_name" class="form-input"
                placeholder="أدخل الاسم الكامل (اختياري)">
            </div>
            <div>
              <label class="form-label">رقم الهوية الوطنية (14 رقم)</label>
              <input type="text" name="national_id" id="national_id_add"
                class="form-input" placeholder="أدخل رقم الهوية (14 رقم)"
                maxlength="14" inputmode="numeric" pattern="\d{14}"
                oninput="validateNationalId(this, 'hint_add')">
              <small id="hint_add" class="nid-hint"
                style="display: none;"></small>
            </div>
            <div>
              <label class="form-label">رقم الهاتف</label>
              <input type="text" name="phone" class="form-input"
                placeholder="أدخل رقم الهاتف (اختياري)">
            </div>
            <div>
              <label class="form-label">البريد الإلكتروني</label>
              <input type="email" name="email" class="form-input"
                placeholder="أدخل البريد الإلكتروني (اختياري)">
            </div>
            <div>
              <label class="form-label">
                <i class="fas fa-clock"></i> ساعات العمل اليومية <span
                  style="color: #ef4444;">*</span>
              </label>
              <input type="number" name="fixed_hours" min="1" max="24" value="8"
                required class="form-input" placeholder="عدد الساعات (1-24)"
                title="عدد ساعات العمل المطلوبة يومياً">
            </div>
            <div>
              <label class="form-label">
                <i class="fas fa-money-bill-wave"></i> راتب اليوم الواحد <span
                  style="color: #ef4444;">*</span>
              </label>
              <input type="number" name="daily_wage" min="0" step="0.01"
                required class="form-input"
                placeholder="أدخل راتب اليوم (جنيه)"
                title="راتب اليوم الواحد للموظف بالعملة المحددة">
            </div>
            <div>
              <label class="form-label">
                <i class="fas fa-clock"></i> وقت بداية العمل
                <span
                  style="font-size: 0.75rem; color: #6b7280;">(اختياري)</span>
              </label>
              <input type="time" name="shift_start_time" class="form-input"
                placeholder="اختر وقت البداية"
                title="وقت بداية الشيفت للموظف (اختياري)">
            </div>
          </div>

          <!-- Permissions -->
          <div style="margin-bottom: 20px;">
            <label class="form-label"
              style="font-size: 1.1rem; font-weight: 600; color: #667eea; display: block; margin-bottom: 16px;">
              <i class="fas fa-lock"></i> صلاحيات الموظف
              <span
                style="font-size: 0.85rem; color: #10b981; font-weight: 600;">
                (اختياري - بدون اختيار = جميع الصلاحيات تلقائياً ماعدا إدارة
                الموظفين)
              </span>
            </label>

            <!-- Permission Cards Grid -->
            <div class="permissions-grid">

              <!-- الغرف -->
              <div class="permission-card">
                <div class="permission-card-header"
                  style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
                  <i class="fas fa-door-open"></i>
                  <span>الغرف</span>
                </div>
                <div class="permission-card-body">
                  <div class="permission-item">
                    <input type="checkbox" name="permissions[]"
                      value="manage_rooms" id="manage_rooms"
                      class="permission-checkbox">
                    <label for="manage_rooms" class="permission-label">
                      <i class="fas fa-user-shield"></i> إدارة كاملة
                    </label>
                  </div>
                  <div class="permission-item">
                    <input type="checkbox" name="permissions[]"
                      value="view_rooms" id="view_rooms"
                      class="permission-checkbox">
                    <label for="view_rooms" class="permission-label">
                      <i class="fas fa-eye"></i> اطلاع فقط (مشاهدة)
                    </label>
                  </div>
                  <div class="permission-item">
                    <input type="checkbox" name="permissions[]"
                      value="add_rooms" id="add_rooms"
                      class="permission-checkbox">
                    <label for="add_rooms" class="permission-label">
                      <i class="fas fa-plus-circle"></i> إضافة غرف
                    </label>
                  </div>
                  <div class="permission-item">
                    <input type="checkbox" name="permissions[]"
                      value="edit_rooms" id="edit_rooms"
                      class="permission-checkbox">
                    <label for="edit_rooms" class="permission-label">
                      <i class="fas fa-edit"></i> تعديل الغرف
                    </label>
                  </div>
                  <div class="permission-item">
                    <input type="checkbox" name="permissions[]"
                      value="delete_rooms" id="delete_rooms"
                      class="permission-checkbox">
                    <label for="delete_rooms" class="permission-label">
                      <i class="fas fa-trash-alt"></i> حذف الغرف
                    </label>
                  </div>
                </div>
              </div>

              <!-- الجلسات - ديناميكي من getPermissionCategories -->
                              <div class="permission-card">
                  <div class="permission-card-header"
                    style="background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);">
                    <i class="fas fa-gamepad"></i>
                    <span>الجلسات</span>
                  </div>
                  <div class="permission-card-body">
                                          <div class="permission-item">
                        <input type="checkbox" name="permissions[]"
                          value="manage_sessions" id="manage_sessions"
                          class="permission-checkbox">
                        <label for="manage_sessions" class="permission-label">
                                                    <i class="fas fa-shield-alt"></i> إدارة الجلسات (كاملة)                        </label>
                      </div>
                                          <div class="permission-item">
                        <input type="checkbox" name="permissions[]"
                          value="view_sessions" id="view_sessions"
                          class="permission-checkbox">
                        <label for="view_sessions" class="permission-label">
                                                    <i class="fas fa-eye"></i> اطلاع فقط (مشاهدة)                        </label>
                      </div>
                                          <div class="permission-item">
                        <input type="checkbox" name="permissions[]"
                          value="start_end_sessions" id="start_end_sessions"
                          class="permission-checkbox">
                        <label for="start_end_sessions" class="permission-label">
                                                    <i class="fas fa-play-circle"></i> بدء الجلسات وإنهائها                        </label>
                      </div>
                                          <div class="permission-item">
                        <input type="checkbox" name="permissions[]"
                          value="extend_sessions" id="extend_sessions"
                          class="permission-checkbox">
                        <label for="extend_sessions" class="permission-label">
                                                    <i class="fas fa-clock"></i> تمديد الجلسات                        </label>
                      </div>
                                          <div class="permission-item">
                        <input type="checkbox" name="permissions[]"
                          value="continue_sessions" id="continue_sessions"
                          class="permission-checkbox">
                        <label for="continue_sessions" class="permission-label">
                                                    <i class="fas fa-redo"></i> استكمال الجلسات                        </label>
                      </div>
                                          <div class="permission-item">
                        <input type="checkbox" name="permissions[]"
                          value="view_session_logs" id="view_session_logs"
                          class="permission-checkbox">
                        <label for="view_session_logs" class="permission-label">
                                                    <i class="fas fa-eye"></i> اطلاع على سجل التغييرات فقط                        </label>
                      </div>
                                          <div class="permission-item">
                        <input type="checkbox" name="permissions[]"
                          value="manage_session_logs" id="manage_session_logs"
                          class="permission-checkbox">
                        <label for="manage_session_logs" class="permission-label">
                                                    <i class="fas fa-history"></i> اطلاع وحذف سجل التغييرات                        </label>
                      </div>
                                      </div>
                </div>
              
              <!-- العملاء - ديناميكي من getPermissionCategories -->
                              <div class="permission-card">
                  <div class="permission-card-header"
                    style="background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);">
                    <i class="fas fa-users"></i>
                    <span>العملاء</span>
                  </div>
                  <div class="permission-card-body">
                                          <div class="permission-item">
                        <input type="checkbox" name="permissions[]"
                          value="manage_customers" id="manage_customers"
                          class="permission-checkbox">
                        <label for="manage_customers" class="permission-label">
                                                    <i class="fas fa-user-shield"></i> إدارة كاملة                        </label>
                      </div>
                                          <div class="permission-item">
                        <input type="checkbox" name="permissions[]"
                          value="view_search_customers" id="view_search_customers"
                          class="permission-checkbox">
                        <label for="view_search_customers" class="permission-label">
                                                    <i class="fas fa-eye"></i> مشاهدة وبحث فقط                        </label>
                      </div>
                                          <div class="permission-item">
                        <input type="checkbox" name="permissions[]"
                          value="crud_customers_no_finance" id="crud_customers_no_finance"
                          class="permission-checkbox">
                        <label for="crud_customers_no_finance" class="permission-label">
                                                    <i class="fas fa-edit"></i> إضافة وحذف وتعديل (بدون حالة مالية)                        </label>
                      </div>
                                          <div class="permission-item">
                        <input type="checkbox" name="permissions[]"
                          value="export_customers" id="export_customers"
                          class="permission-checkbox">
                        <label for="export_customers" class="permission-label">
                                                    <i class="fas fa-file-export"></i> تصدير بيانات                        </label>
                      </div>
                                          <div class="permission-item">
                        <input type="checkbox" name="permissions[]"
                          value="view_customer_finance" id="view_customer_finance"
                          class="permission-checkbox">
                        <label for="view_customer_finance" class="permission-label">
                                                    <i class="fas fa-dollar-sign"></i> عرض الحالة المالية                        </label>
                      </div>
                                      </div>
                </div>
              
              <!-- الطلبات (الطعام والمشروبات) - ديناميكي من getPermissionCategories -->
                              <div class="permission-card">
                  <div class="permission-card-header"
                    style="background: linear-gradient(135deg, #fa709a 0%, #fee140 100%);">
                    <i class="fas fa-utensils"></i>
                    <span>الطلبات (الطعام والمشروبات)</span>
                  </div>
                  <div class="permission-card-body">
                                          <div class="permission-item">
                        <input type="checkbox" name="permissions[]"
                          value="manage_orders" id="manage_orders"
                          class="permission-checkbox">
                        <label for="manage_orders" class="permission-label">
                                                    <i class="fas fa-clipboard-check"></i> إدارة كاملة                        </label>
                      </div>
                                          <div class="permission-item">
                        <input type="checkbox" name="permissions[]"
                          value="view_add_orders" id="view_add_orders"
                          class="permission-checkbox">
                        <label for="view_add_orders" class="permission-label">
                                                    <i class="fas fa-plus-circle"></i> مشاهدة وإضافة فقط                        </label>
                      </div>
                                          <div class="permission-item">
                        <input type="checkbox" name="permissions[]"
                          value="view_inventory_notifications" id="view_inventory_notifications"
                          class="permission-checkbox">
                        <label for="view_inventory_notifications" class="permission-label">
                                                    <i class="fas fa-boxes"></i> متابعة ومشاهدة المخزون والإشعارات                        </label>
                      </div>
                                          <div class="permission-item">
                        <input type="checkbox" name="permissions[]"
                          value="manage_inventory" id="manage_inventory"
                          class="permission-checkbox">
                        <label for="manage_inventory" class="permission-label">
                                                    <i class="fas fa-warehouse"></i> التحكم والاضافه في الاصناف                        </label>
                      </div>
                                          <div class="permission-item">
                        <input type="checkbox" name="permissions[]"
                          value="manage_cafe" id="manage_cafe"
                          class="permission-checkbox">
                        <label for="manage_cafe" class="permission-label">
                                                    <i class="fas fa-shield-alt"></i> إدارة جلسات الكافيه الخارجية                        </label>
                      </div>
                                      </div>
                </div>
              
              <!-- تفاصيل الخطة (الاشتراك) والتحكم في النظام -->
              <div class="permission-card">
                <div class="permission-card-header"
                  style="background: linear-gradient(135deg, #30cfd0 0%, #330867 100%);">
                  <i class="fas fa-receipt"></i>
                  <span>تفاصيل الخطة (الاشتراك) والتحكم في النظام</span>
                </div>
                <div class="permission-card-body">
                  <div class="permission-item">
                    <input type="checkbox" name="permissions[]"
                      value="view_subscription_details"
                      id="view_subscription_details"
                      class="permission-checkbox">
                    <label for="view_subscription_details"
                      class="permission-label">
                      <i class="fas fa-eye"></i> عرض تفاصيل الاشتراك (الهيدر +
                      لوحة التحكم)
                    </label>
                  </div>
                  <div class="permission-item">
                    <input type="checkbox" name="permissions[]"
                      value="manage_billing_payments"
                      id="manage_billing_payments"
                      class="permission-checkbox">
                    <label for="manage_billing_payments"
                      class="permission-label">
                      <i class="fas fa-credit-card"></i> التحكم في التجديد والدفع
                    </label>
                  </div>
                  <div class="permission-item">
                    <input type="checkbox" name="permissions[]"
                      value="allow_multiple_employee_logins"
                      id="allow_multiple_employee_logins"
                      class="permission-checkbox">
                    <label for="allow_multiple_employee_logins"
                      class="permission-label">
                      <i class="fas fa-users"></i> السماح بتسجيل دخول عدة موظفين
                    </label>
                  </div>
                </div>
              </div>

              <!-- التقارير -->
              <div class="permission-card">
                <div class="permission-card-header"
                  style="background: linear-gradient(135deg, #a8edea 0%, #fed6e3 100%);">
                  <i class="fas fa-chart-bar"></i>
                  <span>التقارير</span>
                </div>
                <div class="permission-card-body">
                  <div class="permission-item">
                    <input type="checkbox" name="permissions[]"
                      value="manage_reports" id="manage_reports"
                      class="permission-checkbox">
                    <label for="manage_reports" class="permission-label">
                      <i class="fas fa-shield-alt"></i> إدارة كاملة
                    </label>
                  </div>
                </div>
              </div>

              <!-- فواتير الـ SMS — يظهر فقط إذا كانت ميزة SMS مفعّلة في باقة العميل -->
                            <div class="permission-card">
                <div class="permission-card-header"
                  style="background: linear-gradient(135deg, #ec4899 0%, #be185d 100%);">
                  <i class="fas fa-sms"></i>
                  <span>فواتير الـ SMS</span>
                </div>
                <div class="permission-card-body">
                  <div class="permission-item">
                    <input type="checkbox" name="permissions[]"
                      value="send_sms_invoice" id="send_sms_invoice"
                      class="permission-checkbox">
                    <label for="send_sms_invoice" class="permission-label">
                      <i class="fas fa-paper-plane"></i> إرسال فاتورة SMS للعميل
                    </label>
                  </div>
                  <div class="permission-item">
                    <input type="checkbox" name="permissions[]"
                      value="skip_sms_invoice" id="skip_sms_invoice"
                      class="permission-checkbox">
                    <label for="skip_sms_invoice" class="permission-label">
                      <i class="fas fa-forward"></i> تخطي إرسال الفاتورة (إنهاء بدون رقم)
                    </label>
                  </div>
                </div>
              </div>
              
              <!-- ── كارت الخصومات ── يظهر فقط إذا كان النظام مفعّلاً -->
              
              <!-- ── كارت التحكم الآلي بالشاشة (eWeLink) ── يظهر فقط إذا كانت الميزة مسموحة للمحل -->
              
            </div>
          </div>

          <!-- Employees limit alert (same design as rooms) - visible عند تجاوز الحد -->
          <div class="room-limit-alert" id="employeeLimitAlert" style="display: none; margin-top: 8px;">
            <div class="alert-content">
              <div class="alert-icon">
                <i class="fas fa-exclamation-triangle"></i>
              </div>
              <div class="alert-text">
                <h4>تم الوصول للحد الأقصى</h4>
                <p id="employeeLimitMessage"></p>
              </div>
              <div class="alert-actions">
                <button type="button" class="btn-outline-primary btn-sm" onclick="window.location.href='subscription-upgrade.php'">
                  <i class="fas fa-arrow-up"></i>
                  ترقية الخطة
                </button>
                <button type="button" class="btn-outline-success btn-sm" onclick="dismissEmployeeLimitAlert()">
                  <i class="fas fa-times"></i>
                  إلغاء
                </button>
              </div>
            </div>
          </div>

          <button type="submit" class="btn btn-primary" style="margin-top: 8px;">
            <i class="fas fa-plus"></i> إضافة الموظف
          </button>
        </form>
      </div>

      <!-- Employees List -->
      <div class="card">
        <h2
          style="font-size: 1.25rem; font-weight: 700; margin-bottom: 20px; color: #667eea;">
          <i class="fas fa-list"></i> قائمة الموظفين
          <span
            style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; padding: 2px 12px; border-radius: 12px; font-size: 0.85rem; margin-right: 8px;">
            0          </span>
        </h2>

                  <div style="text-align: center; padding: 40px; color: #9ca3af;">
            <i class="fas fa-users-slash"
              style="font-size: 3rem; margin-bottom: 16px;"></i>
            <p style="font-size: 1.1rem;">لا يوجد موظفين مسجلين حتى الآن</p>
          </div>
              </div>

    </div>
  </div>

  <!-- Edit Employee Modal -->
  <div id="editEmployeeModal" class="modal">
    <div class="modal-content">
      <div class="modal-header">
        <h2 class="modal-title">
          <i class="fas fa-user-edit"></i> تعديل بيانات الموظف
        </h2>
        <button type="button" class="modal-close" onclick="closeEditModal()">
          <i class="fas fa-times"></i>
        </button>
      </div>

      <div class="modal-body">
        <!-- Tabs -->
        <div
          style="display: flex; gap: 12px; margin-bottom: 24px; border-bottom: 2px solid #e5e7eb; padding-bottom: 0;">
          <button type="button" class="tab-btn active"
            onclick="switchTab('profile')" id="profileTab">
            <i class="fas fa-user-circle"></i> معلومات الحساب
          </button>
          <button type="button" class="tab-btn" onclick="switchTab('password')"
            id="passwordTab">
            <i class="fas fa-key"></i> تغيير كلمة المرور
          </button>
        </div>

        <!-- Profile Tab -->
        <div id="profileTabContent" class="tab-content active">
          <form id="editProfileForm" onsubmit="submitEditProfile(event)">
            <input type="hidden" id="edit_emp_id" name="employee_id">

            <div
              style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 16px; margin-bottom: 16px;">
              <div>
                <label class="form-label">اسم المستخدم <span
                    style="color: #ef4444;">*</span></label>
                <input type="text" id="edit_username" name="username" required
                  class="form-input" placeholder="اسم المستخدم">
              </div>
              <div>
                <label class="form-label">رقم الهاتف</label>
                <input type="text" id="edit_phone" name="phone"
                  class="form-input" placeholder="رقم الهاتف">
              </div>
              <div>
                <label class="form-label">
                  <i class="fas fa-clock"></i> ساعات العمل اليومية <span
                    style="color: #ef4444;">*</span>
                </label>
                <input type="number" id="edit_fixed_hours" name="fixed_hours"
                  min="1" max="24" required class="form-input"
                  placeholder="عدد الساعات (1-24)">
              </div>
              <div>
                <label class="form-label">
                  <i class="fas fa-money-bill-wave"></i> راتب اليوم الواحد <span
                    style="color: #ef4444;">*</span>
                </label>
                <input type="number" id="edit_daily_wage" name="daily_wage"
                  min="0" step="0.01" required class="form-input"
                  placeholder="راتب اليوم (جنيه)">
              </div>
              <div>
                <label class="form-label">
                  <i class="fas fa-clock"></i> وقت بداية العمل
                  <span
                    style="font-size: 0.75rem; color: #6b7280;">(اختياري)</span>
                </label>
                <input type="time" id="edit_shift_start_time"
                  name="shift_start_time" class="form-input"
                  placeholder="اختر وقت البداية">
              </div>
            </div>

            <div
              style="display: flex; gap: 12px; justify-content: center; margin-top: 24px;">
              <button type="submit" class="btn btn-success">
                <i class="fas fa-save"></i> حفظ التغييرات
              </button>
              <button type="button" onclick="closeEditModal()"
                class="btn btn-danger">
                <i class="fas fa-times"></i> إلغاء
              </button>
            </div>
          </form>
        </div>

        <!-- Password Tab -->
        <div id="passwordTabContent" class="tab-content">
          <form id="editPasswordForm" onsubmit="submitPasswordChange(event)">
            <input type="hidden" id="pass_emp_id" name="employee_id">

            <div
              style="display: grid; grid-template-columns: 1fr; gap: 16px; margin-bottom: 16px; max-width: 500px; margin-right: auto; margin-left: auto;">
              <div>
                <label class="form-label">كلمة المرور الجديدة <span
                    style="color: #ef4444;">*</span></label>
                <input type="password" id="new_password" name="new_password"
                  required class="form-input"
                  placeholder="أدخل كلمة المرور الجديدة" minlength="6">
              </div>
              <div>
                <label class="form-label">تأكيد كلمة المرور <span
                    style="color: #ef4444;">*</span></label>
                <input type="password" id="confirm_password"
                  name="confirm_password" required class="form-input"
                  placeholder="أعد إدخال كلمة المرور" minlength="6">
              </div>
            </div>

            <div
              style="display: flex; gap: 12px; justify-content: center; margin-top: 24px;">
              <button type="submit" class="btn btn-success">
                <i class="fas fa-key"></i> تحديث كلمة المرور
              </button>
              <button type="button" onclick="closeEditModal()"
                class="btn btn-danger">
                <i class="fas fa-times"></i> إلغاء
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

  <!-- Permissions Modal -->
  <div id="permissionsModal" class="modal">
    <div class="modal-content">
      <div class="modal-header">
        <h2 class="modal-title">
          <i class="fas fa-shield-alt"></i> تعديل صلاحيات الموظف
        </h2>
        <button type="button" class="modal-close"
          onclick="closePermissionsModal()">
          <i class="fas fa-times"></i>
        </button>
      </div>

      <div class="modal-body">
        <form id="permissionsForm" onsubmit="submitPermissions(event)">
          <input type="hidden" id="edit_employee_id">

          <div style="margin-bottom: 20px;">
            <label class="form-label">اسم الموظف:</label>
            <input type="text" id="edit_employee_name" readonly
              class="form-input">
          </div>

          <div style="margin-bottom: 20px;">
            <label class="form-label"
              style="font-size: 1.1rem; margin-bottom: 16px;">
              <i class="fas fa-shield-alt"></i> الصلاحيات
            </label>
            <div
              style="display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 20px;">
                                              <div class="permission-category">
                  <div class="category-title">
                    <i class="fas fa-folder"></i> الغرف                  </div>
                                      <div class="checkbox-group">
                      <input type="checkbox" name="permissions[]"
                        value="manage_rooms"
                        id="edit_manage_rooms" class="checkbox-input">
                      <label for="edit_manage_rooms"
                        class="checkbox-label">إدارة كاملة</label>
                    </div>
                                      <div class="checkbox-group">
                      <input type="checkbox" name="permissions[]"
                        value="view_rooms"
                        id="edit_view_rooms" class="checkbox-input">
                      <label for="edit_view_rooms"
                        class="checkbox-label">اطلاع فقط (مشاهدة)</label>
                    </div>
                                      <div class="checkbox-group">
                      <input type="checkbox" name="permissions[]"
                        value="add_rooms"
                        id="edit_add_rooms" class="checkbox-input">
                      <label for="edit_add_rooms"
                        class="checkbox-label">إضافة غرف</label>
                    </div>
                                      <div class="checkbox-group">
                      <input type="checkbox" name="permissions[]"
                        value="edit_rooms"
                        id="edit_edit_rooms" class="checkbox-input">
                      <label for="edit_edit_rooms"
                        class="checkbox-label">تعديل</label>
                    </div>
                                      <div class="checkbox-group">
                      <input type="checkbox" name="permissions[]"
                        value="delete_rooms"
                        id="edit_delete_rooms" class="checkbox-input">
                      <label for="edit_delete_rooms"
                        class="checkbox-label">حذف</label>
                    </div>
                                  </div>
                                              <div class="permission-category">
                  <div class="category-title">
                    <i class="fas fa-folder"></i> الجلسات                  </div>
                                      <div class="checkbox-group">
                      <input type="checkbox" name="permissions[]"
                        value="manage_sessions"
                        id="edit_manage_sessions" class="checkbox-input">
                      <label for="edit_manage_sessions"
                        class="checkbox-label">إدارة الجلسات (كاملة)</label>
                    </div>
                                      <div class="checkbox-group">
                      <input type="checkbox" name="permissions[]"
                        value="view_sessions"
                        id="edit_view_sessions" class="checkbox-input">
                      <label for="edit_view_sessions"
                        class="checkbox-label">اطلاع فقط (مشاهدة)</label>
                    </div>
                                      <div class="checkbox-group">
                      <input type="checkbox" name="permissions[]"
                        value="start_end_sessions"
                        id="edit_start_end_sessions" class="checkbox-input">
                      <label for="edit_start_end_sessions"
                        class="checkbox-label">بدء الجلسات وإنهائها</label>
                    </div>
                                      <div class="checkbox-group">
                      <input type="checkbox" name="permissions[]"
                        value="extend_sessions"
                        id="edit_extend_sessions" class="checkbox-input">
                      <label for="edit_extend_sessions"
                        class="checkbox-label">تمديد الجلسات</label>
                    </div>
                                      <div class="checkbox-group">
                      <input type="checkbox" name="permissions[]"
                        value="continue_sessions"
                        id="edit_continue_sessions" class="checkbox-input">
                      <label for="edit_continue_sessions"
                        class="checkbox-label">استكمال الجلسات</label>
                    </div>
                                      <div class="checkbox-group">
                      <input type="checkbox" name="permissions[]"
                        value="view_session_logs"
                        id="edit_view_session_logs" class="checkbox-input">
                      <label for="edit_view_session_logs"
                        class="checkbox-label">اطلاع على سجل التغييرات فقط</label>
                    </div>
                                      <div class="checkbox-group">
                      <input type="checkbox" name="permissions[]"
                        value="manage_session_logs"
                        id="edit_manage_session_logs" class="checkbox-input">
                      <label for="edit_manage_session_logs"
                        class="checkbox-label">اطلاع وحذف سجل التغييرات</label>
                    </div>
                                  </div>
                                              <div class="permission-category">
                  <div class="category-title">
                    <i class="fas fa-folder"></i> العملاء                  </div>
                                      <div class="checkbox-group">
                      <input type="checkbox" name="permissions[]"
                        value="manage_customers"
                        id="edit_manage_customers" class="checkbox-input">
                      <label for="edit_manage_customers"
                        class="checkbox-label">إدارة كاملة</label>
                    </div>
                                      <div class="checkbox-group">
                      <input type="checkbox" name="permissions[]"
                        value="view_search_customers"
                        id="edit_view_search_customers" class="checkbox-input">
                      <label for="edit_view_search_customers"
                        class="checkbox-label">مشاهدة وبحث فقط</label>
                    </div>
                                      <div class="checkbox-group">
                      <input type="checkbox" name="permissions[]"
                        value="crud_customers_no_finance"
                        id="edit_crud_customers_no_finance" class="checkbox-input">
                      <label for="edit_crud_customers_no_finance"
                        class="checkbox-label">إضافة وحذف وتعديل (بدون حالة مالية)</label>
                    </div>
                                      <div class="checkbox-group">
                      <input type="checkbox" name="permissions[]"
                        value="export_customers"
                        id="edit_export_customers" class="checkbox-input">
                      <label for="edit_export_customers"
                        class="checkbox-label">تصدير بيانات</label>
                    </div>
                                      <div class="checkbox-group">
                      <input type="checkbox" name="permissions[]"
                        value="view_customer_finance"
                        id="edit_view_customer_finance" class="checkbox-input">
                      <label for="edit_view_customer_finance"
                        class="checkbox-label">عرض الحالة المالية</label>
                    </div>
                                  </div>
                                              <div class="permission-category">
                  <div class="category-title">
                    <i class="fas fa-folder"></i> الطلبات (الطعام والمشروبات)                  </div>
                                      <div class="checkbox-group">
                      <input type="checkbox" name="permissions[]"
                        value="manage_orders"
                        id="edit_manage_orders" class="checkbox-input">
                      <label for="edit_manage_orders"
                        class="checkbox-label">إدارة كاملة</label>
                    </div>
                                      <div class="checkbox-group">
                      <input type="checkbox" name="permissions[]"
                        value="view_add_orders"
                        id="edit_view_add_orders" class="checkbox-input">
                      <label for="edit_view_add_orders"
                        class="checkbox-label">مشاهدة وإضافة فقط</label>
                    </div>
                                      <div class="checkbox-group">
                      <input type="checkbox" name="permissions[]"
                        value="view_inventory_notifications"
                        id="edit_view_inventory_notifications" class="checkbox-input">
                      <label for="edit_view_inventory_notifications"
                        class="checkbox-label">متابعة ومشاهدة المخزون والإشعارات</label>
                    </div>
                                      <div class="checkbox-group">
                      <input type="checkbox" name="permissions[]"
                        value="manage_inventory"
                        id="edit_manage_inventory" class="checkbox-input">
                      <label for="edit_manage_inventory"
                        class="checkbox-label">التحكم والاضافه في الاصناف</label>
                    </div>
                                      <div class="checkbox-group">
                      <input type="checkbox" name="permissions[]"
                        value="manage_cafe"
                        id="edit_manage_cafe" class="checkbox-input">
                      <label for="edit_manage_cafe"
                        class="checkbox-label">إدارة جلسات الكافيه الخارجية</label>
                    </div>
                                  </div>
                                              <div class="permission-category">
                  <div class="category-title">
                    <i class="fas fa-folder"></i> تفاصيل الخطة (الاشتراك) والتحكم في النظام                  </div>
                                      <div class="checkbox-group">
                      <input type="checkbox" name="permissions[]"
                        value="view_subscription_details"
                        id="edit_view_subscription_details" class="checkbox-input">
                      <label for="edit_view_subscription_details"
                        class="checkbox-label">عرض تفاصيل الخطة (الهيدر + لوحة التحكم)</label>
                    </div>
                                  </div>
                                              <div class="permission-category">
                  <div class="category-title">
                    <i class="fas fa-folder"></i> الدخول                  </div>
                                      <div class="checkbox-group">
                      <input type="checkbox" name="permissions[]"
                        value="allow_multiple_employee_logins"
                        id="edit_allow_multiple_employee_logins" class="checkbox-input">
                      <label for="edit_allow_multiple_employee_logins"
                        class="checkbox-label">السماح بتسجيل دخول عدة موظفين في نفس الوقت</label>
                    </div>
                                  </div>
                                              <div class="permission-category">
                  <div class="category-title">
                    <i class="fas fa-folder"></i> التقارير                  </div>
                                      <div class="checkbox-group">
                      <input type="checkbox" name="permissions[]"
                        value="manage_reports"
                        id="edit_manage_reports" class="checkbox-input">
                      <label for="edit_manage_reports"
                        class="checkbox-label">إدارة كاملة</label>
                    </div>
                                  </div>
                                              <div class="permission-category">
                  <div class="category-title">
                    <i class="fas fa-folder"></i> فواتير الـ SMS                  </div>
                                      <div class="checkbox-group">
                      <input type="checkbox" name="permissions[]"
                        value="send_sms_invoice"
                        id="edit_send_sms_invoice" class="checkbox-input">
                      <label for="edit_send_sms_invoice"
                        class="checkbox-label">إرسال فاتورة SMS للعميل عند إنهاء الجلسة</label>
                    </div>
                                      <div class="checkbox-group">
                      <input type="checkbox" name="permissions[]"
                        value="skip_sms_invoice"
                        id="edit_skip_sms_invoice" class="checkbox-input">
                      <label for="edit_skip_sms_invoice"
                        class="checkbox-label">تخطي إرسال فاتورة SMS (إنهاء الجلسة بدون رقم)</label>
                    </div>
                                  </div>
                          </div>
          </div>

          
          
          <div style="display: flex; gap: 12px; justify-content: center;">
            <button type="submit" class="btn btn-success">
              <i class="fas fa-save"></i> حفظ التغييرات
            </button>
            <button type="button" onclick="closePermissionsModal()"
              class="btn btn-danger">
              <i class="fas fa-times"></i> إلغاء
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>
  </div><!-- /page-wrapper -->

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

    // Intercept any direct logout links in this page
    document.addEventListener('DOMContentLoaded', function() {
      document.querySelectorAll('a[href$="logout.php"]').forEach(a => {
        a.addEventListener('click', function(e) {
          e.preventDefault();
          attemptLogout();
        });
      });
    });
    // CSRF token helper (fallback-safe)
    const csrfToken = (function() {
      const meta = document.querySelector('meta[name="csrf-token"]');
      if (meta && meta.content) return meta.content;
      // fallback to server-provided PHP session token if available later
      return (window.CSRF_TOKEN || '');
    })();
    // Dark Mode Toggle - Synced
    function toggleDarkMode() {
      const body = document.body;
      const icon = document.getElementById('dark-mode-icon');

      const isDarkMode = body.classList.contains('dark-mode');
      const newMode = !isDarkMode;

      // Update body class
      if (newMode) {
        body.classList.remove('light-mode');
        body.classList.add('dark-mode');
        if (icon) icon.className = 'fas fa-sun';
      } else {
        body.classList.remove('dark-mode');
        body.classList.add('light-mode');
        if (icon) icon.className = 'fas fa-moon';
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
        const icon = document.getElementById('dark-mode-icon');

        if (darkMode && !body.classList.contains('dark-mode')) {
          body.classList.remove('light-mode');
          body.classList.add('dark-mode');
          if (icon) icon.className = 'fas fa-sun';
        } else if (!darkMode && body.classList.contains('dark-mode')) {
          body.classList.remove('dark-mode');
          body.classList.add('light-mode');
          if (icon) icon.className = 'fas fa-moon';
        }
      }
    });

    // Initialize Dark Mode from localStorage
    document.addEventListener('DOMContentLoaded', function() {
      const body = document.body;
      const icon = document.getElementById('dark-mode-icon');

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
        localStorage.setItem('darkMode', bodyHasDarkMode ? 'true' : 'false');
      }

      // Update icon
      if (icon) {
        if (body.classList.contains('dark-mode')) {
          icon.className = 'fas fa-sun';
        } else {
          icon.className = 'fas fa-moon';
        }
      }
    });

    /** مزامنة أزرار «فترة إعادة الاحتساب» مع الـ select المخفي (نفس القيمة للحفظ عبر API) */
    function syncDiscountPeriodFromSelect(selectId) {
      const sel = document.getElementById(selectId);
      if (!sel) return;
      const wrap = document.querySelector('.discount-period-picker[data-period-select="' + selectId + '"]');
      if (!wrap) return;
      const val = sel.value;
      wrap.querySelectorAll('.discount-period-picker__btn').forEach(function(btn) {
        const on = btn.getAttribute('data-value') === val;
        btn.classList.toggle('is-active', on);
        btn.setAttribute('aria-pressed', on ? 'true' : 'false');
      });
    }

    function initDiscountPeriodPickers() {
      document.querySelectorAll('.discount-period-picker').forEach(function(wrap) {
        const id = wrap.getAttribute('data-period-select');
        const sel = id ? document.getElementById(id) : null;
        if (!sel) return;
        wrap.querySelectorAll('.discount-period-picker__btn').forEach(function(btn) {
          btn.addEventListener('click', function() {
            const v = btn.getAttribute('data-value');
            if (!v) return;
            sel.value = v;
            syncDiscountPeriodFromSelect(id);
            sel.dispatchEvent(new Event('change', { bubbles: true }));
          });
        });
        syncDiscountPeriodFromSelect(id);
      });
    }

    // Edit Permissions Modal
    async function editPermissions(employeeId, username, permissions, ewelinkControl) {
      document.getElementById('edit_employee_id').value = employeeId;
      document.getElementById('edit_employee_name').value = username;

      // Clear all checkboxes
      const checkboxes = document.querySelectorAll(
        '#permissionsModal input[type="checkbox"]');
      checkboxes.forEach(checkbox => { checkbox.checked = false; });

      const ewelinkCb = document.getElementById('permModal_ewelink_cb');
      if (ewelinkCb) {
        ewelinkCb.checked = (ewelinkControl === undefined || ewelinkControl === null)
          ? true
          : (String(ewelinkControl) === '1' || ewelinkControl === true);
      }

      // Check current permissions
      if (permissions && permissions !== 'null' && permissions !== '') {
        try {
          const permissionsArray = JSON.parse(permissions);
          permissionsArray.forEach(permission => {
            const checkbox = document.getElementById('edit_' + permission);
            if (checkbox) checkbox.checked = true;
          });
        } catch (e) {
          console.error('Error parsing permissions:', e);
        }
      }

      // تحميل إعدادات الخصم — من مودال الصلاحيات فقط (permModal_*)
      const discountCbModal = document.getElementById('permModal_discount_cb');
      if (discountCbModal) {
        try {
          const res  = await fetch(`api/discount-employee.php?action=get&employee_id=${employeeId}`, {credentials:'same-origin'});
          const data = await res.json();
          if (data.success) {
            discountCbModal.checked = !!data.discount_permission;
            togglePermModalDiscountUI(!!data.discount_permission);
            const maxValEl  = document.getElementById('permModal_discount_max_value_input');
            const maxUseEl  = document.getElementById('permModal_discount_max_uses_input');
            const periodEl  = document.getElementById('permModal_discount_period_select');
            if (maxValEl)  maxValEl.value  = data.discount_max_value  ?? '';
            if (maxUseEl)  maxUseEl.value  = data.discount_max_uses   ?? '';
            if (periodEl)  periodEl.value  = data.discount_period || 'day';
            syncDiscountPeriodFromSelect('permModal_discount_period_select');
          }
        } catch(e) { console.error('Discount load error:', e); }
      }

      document.getElementById('permissionsModal').classList.add('active');
    }

    // Close Permissions Modal
    function closePermissionsModal() {
      document.getElementById('permissionsModal').classList.remove('active');
    }

    // Submit Permissions Form
    async function submitPermissions(event) {
      event.preventDefault();

      const employeeId = document.getElementById('edit_employee_id').value;
      // جمع الصلاحيات العادية (بدون checkbox الخصم)
      const checkboxes  = document.querySelectorAll(
        '#permissionsForm input[name="permissions[]"]:checked');
      const permissions = Array.from(checkboxes).map(cb => cb.value);

      const ewelinkCb = document.getElementById('permModal_ewelink_cb');
      const ewelinkControl = ewelinkCb ? (ewelinkCb.checked ? 1 : 0) : null;

      try {
        // 1) حفظ الصلاحيات العادية + سويتش eWeLink
        const payload = {
          action: 'update_permissions',
          employee_id: employeeId,
          permissions: permissions
        };
        if (ewelinkControl !== null) {
          payload.ewelink_control_enabled = ewelinkControl;
        }
        const response = await fetch('api/employee-actions.php', {
          method: 'POST',
          headers: { 'Content-Type': 'application/json' },
          body: JSON.stringify(payload)
        });
        const result = await response.json();
        if (!result.success) {
          showError(result.message || 'فشل تحديث الصلاحيات');
          return;
        }

        // 2) حفظ إعدادات الخصم من مودال الصلاحيات (permModal_*)
        const discountCbModal = document.getElementById('permModal_discount_cb');
        if (discountCbModal) {
          const maxValEl = document.getElementById('permModal_discount_max_value_input');
          const maxUseEl = document.getElementById('permModal_discount_max_uses_input');
          const periodEl = document.getElementById('permModal_discount_period_select');
          const discForm = new FormData();
          discForm.append('action',              'save');
          discForm.append('employee_id',         employeeId);
          discForm.append('discount_permission', discountCbModal.checked ? '1' : '0');
          discForm.append('discount_max_value',  maxValEl  ? maxValEl.value  : '');
          discForm.append('discount_max_uses',   maxUseEl  ? maxUseEl.value  : '');
          discForm.append('discount_period',     periodEl  ? periodEl.value  : 'day');
          await fetch('api/discount-employee.php', {
            method: 'POST', body: discForm, credentials: 'same-origin'
          });
        }

        showSuccess(result.message || 'تم تحديث الصلاحيات بنجاح');
        setTimeout(() => location.reload(), 1200);

      } catch (error) {
        console.error('Error:', error);
        showError('حدث خطأ أثناء تحديث الصلاحيات');
      }
    }

    // وظائف واجهة الخصم (نموذج إضافة موظف)
    function toggleDiscountLimitsUI(enabled) {
      const ui = document.getElementById('discountLimitsUI');
      if (ui) ui.style.display = enabled ? 'block' : 'none';
    }
    // واجهة الخصم داخل مودال تعديل الصلاحيات
    function togglePermModalDiscountUI(enabled) {
      const ui = document.getElementById('permModal_discountLimitsUI');
      if (ui) ui.style.display = enabled ? 'block' : 'none';
    }

    // Close modal on outside click
    window.onclick = function(event) {
      const modal = document.getElementById('permissionsModal');
      if (event.target == modal) {
        closePermissionsModal();
      }
    }

    // ==================== Custom Modal System (No Dependencies) ====================

    // Create Modal Overlay
    function createModal(type, title, message, buttons) {
      const overlay = document.createElement('div');
      overlay.className = 'custom-modal-overlay';

      const modal = document.createElement('div');
      modal.className = 'custom-modal';

      // Icon mapping
      const icons = {
        success: '<i class="fas fa-check-circle"></i>',
        error: '<i class="fas fa-times-circle"></i>',
        warning: '<i class="fas fa-exclamation-triangle"></i>'
      };

      modal.innerHTML = `
        <button class="modal-close-btn" onclick="this.closest('.custom-modal-overlay').remove()">
          <i class="fas fa-times"></i>
        </button>
        <div class="modal-icon ${type}">
          ${icons[type] || icons.warning}
        </div>
        <h3 class="modal-title">${title}</h3>
        <p class="modal-message">${message}</p>
        <div class="modal-actions">
          ${buttons}
        </div>
      `;

      overlay.appendChild(modal);
      document.body.appendChild(overlay);

      // Close on overlay click
      overlay.addEventListener('click', (e) => {
        if (e.target === overlay) {
          overlay.remove();
        }
      });

      // Close on ESC key
      const escHandler = (e) => {
        if (e.key === 'Escape') {
          overlay.remove();
          document.removeEventListener('keydown', escHandler);
        }
      };
      document.addEventListener('keydown', escHandler);

      return overlay;
    }

    // Show Success Modal
    function showSuccess(message) {
      const buttons = `
        <button class="modal-btn modal-btn-success" onclick="location.reload()">
          <i class="fas fa-check"></i>
          حسناً
        </button>
      `;
      createModal('success', '✓ نجحت العملية', message, buttons);
    }

    // Show Error Modal
    function showError(message) {
      const buttons = `
        <button class="modal-btn modal-btn-error" onclick="this.closest('.custom-modal-overlay').remove()">
          <i class="fas fa-times"></i>
          حسناً
        </button>
      `;
      createModal('error', '✗ حدث خطأ', message, buttons);
    }

    // Show Confirm Modal
    async function showConfirm(title, message) {
      return new Promise((resolve) => {
        const buttons = `
          <button class="modal-btn modal-btn-confirm" data-action="confirm">
            <i class="fas fa-check"></i>
            نعم، تأكيد
          </button>
          <button class="modal-btn modal-btn-cancel" data-action="cancel">
            <i class="fas fa-times"></i>
            إلغاء
          </button>
        `;

        const modal = createModal('warning', title, message, buttons);

        // Handle button clicks
        modal.addEventListener('click', (e) => {
          const action = e.target.closest('[data-action]')?.dataset
            .action;

          if (action === 'confirm') {
            modal.remove();
            resolve({
              isConfirmed: true,
              isDismissed: false
            });
          } else if (action === 'cancel') {
            modal.remove();
            resolve({
              isConfirmed: false,
              isDismissed: true
            });
          }
        });

        // Handle overlay/ESC close
        const observer = new MutationObserver((mutations) => {
          mutations.forEach((mutation) => {
            if (mutation.removedNodes.length) {
              mutation.removedNodes.forEach((node) => {
                if (node === modal && !modal._resolved) {
                  modal._resolved = true;
                  resolve({
                    isConfirmed: false,
                    isDismissed: true
                  });
                  observer.disconnect();
                }
              });
            }
          });
        });

        observer.observe(document.body, {
          childList: true
        });
      });
    }

    // ==================== Validate National ID ====================
    function validateNationalId(input, hintId) {
      const value = input.value.replace(/\D/g, ''); // حذف غير الأرقام
      input.value = value; // تحديث القيمة

      const hint = document.getElementById(hintId);
      const length = value.length;

      if (length === 0) {
        hint.style.display = 'none';
        input.classList.remove('nid-error', 'nid-success');
      } else if (length < 14) {
        hint.style.display = 'block';
        hint.className = 'nid-hint error';
        hint.innerHTML =
          `<i class="fas fa-exclamation-circle"></i> تم إدخال ${length} رقم فقط. المطلوب 14 رقم.`;
        input.classList.add('nid-error');
        input.classList.remove('nid-success');
      } else if (length === 14) {
        hint.style.display = 'block';
        hint.className = 'nid-hint success';
        hint.innerHTML = `<i class="fas fa-check-circle"></i> رقم الهوية مكتمل ✓`;
        input.classList.add('nid-success');
        input.classList.remove('nid-error');
      }
    }

    // ==================== Submit Create Employee Form ====================
    async function submitCreateEmployee(event) {
      event.preventDefault();

      const form = event.target;
      const formData = new FormData(form);

      // Get selected permissions
      const selectedPermissions = [];
      const permissionCheckboxes = form.querySelectorAll(
        'input[name="permissions[]"]:checked');
      permissionCheckboxes.forEach(cb => selectedPermissions.push(cb.value));

      // ✅ إذا لم يتم اختيار أي صلاحيات، اعرض رسالة تأكيد
      if (selectedPermissions.length === 0) {
        const result = await showConfirm(
          'تأكيد الصلاحيات',
          'لم تقم بتحديد أي صلاحيات للموظف. سيتم منحه جميع الصلاحيات تلقائياً عدا إدارة الموظفين. هل تريد المتابعة؟'
        );

        if (!result.isConfirmed) {
          return; // المستخدم ضغط "إلغاء"
        }
      }

      // Validate National ID
      const nationalId = formData.get('national_id');
      if (nationalId && nationalId.length > 0) {
        if (nationalId.length !== 14) {
          showError('رقم الهوية الوطنية يجب أن يكون 14 رقم بالضبط');
          return;
        }
        if (!/^\d+$/.test(nationalId)) {
          showError('رقم الهوية الوطنية يجب أن يحتوي على أرقام فقط');
          return;
        }
      }

      // ضمان إرسال قيمة سويتش التحكم بالشاشة (0 لو غير محدد - FormData لا يرسل checkbox غير محدد)
      const ewelinkCb = form.querySelector('input[name="ewelink_control_enabled"]');
      if (ewelinkCb) {
        formData.set('ewelink_control_enabled', ewelinkCb.checked ? '1' : '0');
      }

      try {
        const response = await fetch('api/employee-actions.php', {
          method: 'POST',
          body: formData
        });

        const data = await response.json();

        if (data.success) {
          showSuccess(data.message || 'تم إضافة الموظف بنجاح');
        } else {
          if (data.message && data.message.includes('تم الوصول للحد الأقصى')) {
            const alertDiv = document.getElementById('employeeLimitAlert');
            const msg = document.getElementById('employeeLimitMessage');
            if (msg) msg.textContent = data.message;
            if (alertDiv) alertDiv.style.display = 'block';
            setTimeout(() => alertDiv.scrollIntoView({
              behavior: 'smooth',
              block: 'start'
            }), 100);
          } else {
            showError(data.message || 'فشل إضافة الموظف');
          }
        }
      } catch (error) {
        console.error('Error:', error);
        showError('حدث خطأ أثناء إضافة الموظف');
      }
    }

    // ==================== Edit Employee Modal ====================
    let currentEditEmployeeId = null;

    function openEditModal(id, username, phone, hours, wage, shiftStart) {
      currentEditEmployeeId = id;
      document.getElementById('edit_emp_id').value = id;
      document.getElementById('pass_emp_id').value = id;
      document.getElementById('edit_username').value = username;
      document.getElementById('edit_phone').value = phone;
      document.getElementById('edit_fixed_hours').value = hours;
      document.getElementById('edit_daily_wage').value = wage;
      document.getElementById('edit_shift_start_time').value = shiftStart || '';

      // Reset tabs
      switchTab('profile');

      // Reset password fields
      document.getElementById('new_password').value = '';
      document.getElementById('confirm_password').value = '';

      document.getElementById('editEmployeeModal').classList.add('active');
    }

    // Event listeners للأزرار (آمن من XSS)
    document.addEventListener('DOMContentLoaded', function() {
      initDiscountPeriodPickers();

      // أزرار التعديل
      document.querySelectorAll('.btn-edit-employee').forEach(btn => {
        btn.addEventListener('click', function() {
          const id = this.dataset.id;
          const username = this.dataset.username;
          const phone = this.dataset.phone;
          const hours = this.dataset.hours;
          const wage = this.dataset.wage;
          const shiftStart = this.dataset.shiftStart;
          openEditModal(id, username, phone, hours, wage, shiftStart);
        });
      });

      // أزرار الصلاحيات
      document.querySelectorAll('.btn-edit-permissions').forEach(btn => {
        btn.addEventListener('click', function() {
          const id = this.dataset.id;
          const username = this.dataset.username;
          const permissions = this.dataset.permissions;
          const ewelink = this.dataset.ewelink;
          editPermissions(id, username, permissions, ewelink);
        });
      });

      // أزرار تبديل الحالة
      document.querySelectorAll('.btn-toggle-status').forEach(btn => {
        btn.addEventListener('click', function() {
          const id = this.dataset.id;
          const status = this.dataset.status === '1';
          toggleEmployeeStatus(id, status);
        });
      });

      // أزرار الحذف
      document.querySelectorAll('.btn-delete-employee').forEach(btn => {
        btn.addEventListener('click', function() {
          const id = this.dataset.id;
          const username = this.dataset.username;
          deleteEmployee(id, username);
        });
      });
    });

    function closeEditModal() {
      document.getElementById('editEmployeeModal').classList.remove('active');
      currentEditEmployeeId = null;
    }

    function switchTab(tabName) {
      // Update buttons
      document.querySelectorAll('.tab-btn').forEach(btn => btn.classList.remove(
        'active'));
      document.querySelectorAll('.tab-content').forEach(content => content
        .classList.remove('active'));

      if (tabName === 'profile') {
        document.getElementById('profileTab').classList.add('active');
        document.getElementById('profileTabContent').classList.add('active');
      } else if (tabName === 'password') {
        document.getElementById('passwordTab').classList.add('active');
        document.getElementById('passwordTabContent').classList.add('active');
      }
    }

    // ==================== Submit Profile Edit ====================
    async function submitEditProfile(event) {
      event.preventDefault();

      const data = {
        action: 'update_employee_profile',
        employee_id: parseInt(document.getElementById('edit_emp_id').value),
        username: document.getElementById('edit_username').value,
        phone: document.getElementById('edit_phone').value,
        fixed_hours: parseInt(document.getElementById('edit_fixed_hours')
          .value),
        daily_wage: parseFloat(document.getElementById('edit_daily_wage')
          .value),
        shift_start_time: document.getElementById('edit_shift_start_time')
          .value,
        csrf_token: csrfToken
      };

      try {
        const response = await fetch('api/employee-actions.php', {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': csrfToken
          },
          body: JSON.stringify(data)
        });

        const result = await response.json();

        if (result.success) {
          closeEditModal();
          showSuccess(result.message);
        } else {
          showError(result.message);
        }
      } catch (error) {
        showError('حدث خطأ في الاتصال بالخادم');
      }
    }

    // ==================== Submit Password Change ====================
    async function submitPasswordChange(event) {
      event.preventDefault();

      const newPassword = document.getElementById('new_password').value;
      const confirmPassword = document.getElementById('confirm_password').value;

      if (newPassword !== confirmPassword) {
        showError('كلمة المرور وتأكيد كلمة المرور غير متطابقين');
        return;
      }

      const data = {
        action: 'update_employee_password',
        employee_id: parseInt(document.getElementById('pass_emp_id').value),
        new_password: newPassword,
        confirm_password: confirmPassword,
        csrf_token: csrfToken
      };

      try {
        const response = await fetch('api/employee-actions.php', {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': csrfToken
          },
          body: JSON.stringify(data)
        });

        const result = await response.json();

        if (result.success) {
          closeEditModal();
          showSuccess(result.message);
        } else {
          showError(result.message);
        }
      } catch (error) {
        showError('حدث خطأ في الاتصال بالخادم');
      }
    }

    // ==================== Toggle Employee Status ====================
    async function toggleEmployeeStatus(id, currentStatus) {
      const action = currentStatus ? 'إيقاف' : 'تفعيل';
      const result = await showConfirm(
        `${action} الموظف`,
        `هل أنت متأكد من ${action} هذا الموظف؟`
      );

      if (!result.isConfirmed) return;

      try {
        const response = await fetch('api/employee-actions.php', {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': csrfToken
          },
          body: JSON.stringify({
            action: 'toggle_employee_status',
            employee_id: id,
            csrf_token: csrfToken
          })
        });

        const data = await response.json();

        if (data.success) {
          showSuccess(data.message);
        } else {
          showError(data.message);
        }
      } catch (error) {
        showError('حدث خطأ في الاتصال بالخادم');
      }
    }

    // ==================== Delete Employee ====================
    async function deleteEmployee(id, username) {
      const result = await showConfirm(
        'حذف الموظف',
        `هل أنت متأكد من حذف الموظف <strong>${username}</strong>؟<br>هذا الإجراء لا يمكن التراجع عنه.`
      );

      if (!result.isConfirmed) return;

      try {
        const response = await fetch('api/employee-actions.php', {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': csrfToken
          },
          body: JSON.stringify({
            action: 'delete_employee',
            employee_id: id,
            csrf_token: csrfToken
          })
        });

        const data = await response.json();

        if (data.success) {
          showSuccess(data.message);
        } else {
          showError(data.message);
        }
      } catch (error) {
        showError('حدث خطأ في الاتصال بالخادم');
      }
    }

    // Dismiss employees limit alert
    function dismissEmployeeLimitAlert() {
      const alert = document.getElementById('employeeLimitAlert');
      if (!alert) return;
      alert.style.animation = 'fadeOut 0.3s ease-out forwards';
      setTimeout(() => {
        alert.style.display = 'none';
        alert.style.animation = '';
      }, 300);
    }

    // Close modals on outside click
    window.onclick = function(event) {
      const editModal = document.getElementById('editEmployeeModal');
      const permModal = document.getElementById('permissionsModal');

      if (event.target == editModal) {
        closeEditModal();
      }
      if (event.target == permModal) {
        closePermissionsModal();
      }
    }
  </script>

  <!-- Session Monitor -->
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