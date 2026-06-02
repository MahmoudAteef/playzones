<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description"
    content="the seystem good live ">
  <meta name="author"
    content="ENG.HOSSAM">
  <title>إدارة الجلسات - Play Zone</title>
  <link rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
  <script src="https://cdn.tailwindcss.com"></script>
  <style>
    /* تصغير الحجم للشاشات الكبيرة فقط */
    @media (min-width: 1024px) {
      html { font-size: 88%; }
    }
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body {
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
      min-height: 100vh;
      transition: background 0.3s ease, color 0.3s ease;
    }

    body.dark-mode {
      background: linear-gradient(135deg, #1a1a2e 0%, #16213e 100%);
    }

    /* Header Wrapper */
    .header-wrapper {
      width: 96%;
      margin: 0 auto;
      padding: 20px 0 0;
      box-sizing: border-box;
    }

    /* Page Content Wrapper */
    .page-wrapper {
      width: 96%;
      margin: 0 auto;
      padding: 20px 0;
      box-sizing: border-box;
    }

    /* Gradient backgrounds */
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

    .btn {
      padding: 10px 20px;
      border-radius: 10px;
      border: none;
      cursor: pointer;
      font-weight: 600;
      transition: all 0.3s ease;
      display: inline-flex;
      align-items: center;
      gap: 8px;
      text-decoration: none;
      font-size: 14px;
    }

    .btn-primary {
      background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
      color: white;
    }

    .btn-primary:hover {
      transform: translateY(-2px);
      box-shadow: 0 5px 15px rgba(102, 126, 234, 0.4);
    }

    body.dark-mode .btn-primary {
      background: linear-gradient(135deg, #7c8cff 0%, #9068c7 100%);
    }

    .btn-secondary {
      background: rgba(108, 117, 125, 0.1);
      color: #495057;
      border: 1px solid rgba(108, 117, 125, 0.2);
    }

    body.dark-mode .btn-secondary {
      background: rgba(108, 117, 125, 0.2);
      color: #cbd5e1;
      border-color: rgba(203, 213, 225, 0.2);
    }

    .btn-secondary:hover {
      background: rgba(108, 117, 125, 0.2);
    }

    .page-title {
      text-align: center;
      margin-bottom: 30px;
      color: #fff;
    }

    .page-title h1 {
      font-size: 2.5rem;
      margin-bottom: 10px;
      text-shadow: 0 0 20px rgba(255, 255, 255, 0.5);
    }

    body.dark-mode .page-title {
      color: #e2e8f0;
    }

    .page-title p {
      font-size: 1.2rem;
      opacity: 0.9;
    }

    .message {
      padding: 15px 20px;
      border-radius: 10px;
      margin-bottom: 20px;
      font-weight: bold;
      text-align: center;
    }

    .message.success {
      background: rgba(76, 175, 80, 0.2);
      color: #4CAF50;
      border: 1px solid #4CAF50;
    }

    body.dark-mode .message.success {
      background: rgba(76, 175, 80, 0.3);
      color: #66bb6a;
    }

    .message.error {
      background: rgba(244, 67, 54, 0.2);
      color: #f44336;
      border: 1px solid #f44336;
    }

    body.dark-mode .message.error {
      background: rgba(244, 67, 54, 0.3);
      color: #ef5350;
    }

    .message.shift_required {
      background: transparent;
      border: none;
      padding: 0;
      margin: 0;
    }

    .message.shift_required a:hover {
      transform: translateY(-2px);
      box-shadow: 0 6px 20px rgba(0, 0, 0, 0.3);
    }

    /* تأثيرات إخفاء رسائل الحالة */
    .message:not(.shift_required) {
      transition: opacity 0.5s ease-out, transform 0.5s ease-out;
    }

    .message.fade-out {
      opacity: 0;
      transform: translateY(-10px);
    }

    /* Modal للجلسة المحدودة */
    .modal {
      position: fixed;
      z-index: 1000;
      left: 0;
      top: 0;
      width: 100%;
      height: 100%;
      background-color: rgba(0, 0, 0, 0.5);
      backdrop-filter: blur(5px);
    }

    .modal-content {
      background: linear-gradient(135deg, #1e3c72, #2a5298);
      margin: 5% auto;
      padding: 0;
      border-radius: 15px;
      width: 90%;
      max-width: 500px;
      box-shadow: 0 20px 40px rgba(0, 0, 0, 0.3);
      animation: modalSlideIn 0.3s ease-out;
    }

    @keyframes modalSlideIn {
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
      background: rgba(255, 255, 255, 0.1);
      padding: 20px;
      border-radius: 15px 15px 0 0;
      display: flex;
      justify-content: space-between;
      align-items: center;
    }

    .modal-header h3 {
      color: white;
      margin: 0;
      font-size: 1.5rem;
    }

    .close {
      color: white;
      font-size: 28px;
      font-weight: bold;
      cursor: pointer;
      transition: color 0.3s ease;
    }

    .close:hover {
      color: #ff6b6b;
    }

    .modal-body {
      padding: 30px;
    }

    .form-group {
      margin-bottom: 20px;
    }

    .form-group label {
      display: block;
      color: white;
      margin-bottom: 8px;
      font-weight: bold;
    }

    .form-group input {
      width: 100%;
      padding: 12px;
      border: 2px solid rgba(255, 255, 255, 0.2);
      border-radius: 8px;
      background: rgba(255, 255, 255, 0.1);
      color: white;
      font-size: 16px;
      transition: all 0.3s ease;
    }

    .form-group input:focus {
      outline: none;
      border-color: #4CAF50;
      background: rgba(255, 255, 255, 0.2);
    }

    .form-group small {
      color: rgba(255, 255, 255, 0.7);
      font-size: 0.9rem;
      margin-top: 5px;
      display: block;
    }

    .duration-preview {
      background: rgba(255, 255, 255, 0.1);
      padding: 15px;
      border-radius: 8px;
      margin-bottom: 20px;
      text-align: center;
    }

    .duration-preview p {
      color: white;
      margin: 0;
      font-size: 1.1rem;
      font-weight: bold;
    }

    .modal-actions {
      display: flex;
      gap: 15px;
      justify-content: flex-end;
    }

    .btn-secondary {
      background: rgba(255, 255, 255, 0.2);
      color: white;
      border: 2px solid rgba(255, 255, 255, 0.3);
      padding: 12px 24px;
      border-radius: 8px;
      cursor: pointer;
      transition: all 0.3s ease;
    }

    .btn-secondary:hover {
      background: rgba(255, 255, 255, 0.3);
    }

    .btn-primary {
      background: linear-gradient(135deg, #4CAF50, #45a049);
      color: white;
      border: none;
      padding: 12px 24px;
      border-radius: 8px;
      cursor: pointer;
      font-weight: bold;
      transition: all 0.3s ease;
    }

    .btn-primary:hover {
      background: linear-gradient(135deg, #45a049, #4CAF50);
      transform: translateY(-2px);
      box-shadow: 0 5px 15px rgba(76, 175, 80, 0.4);
    }

    /* CSS للجلسات المنتهية */
    .expired-session-info {
      text-align: center;
    }

    .session-details {
      background: rgba(255, 255, 255, 0.1);
      padding: 20px;
      border-radius: 10px;
      margin-bottom: 20px;
    }

    .session-details p {
      color: white;
      margin: 10px 0;
      font-size: 1.1rem;
    }

    .action-buttons {
      display: flex;
      gap: 15px;
      justify-content: center;
      flex-wrap: wrap;
    }

    .btn-danger {
      background: linear-gradient(135deg, #f44336, #d32f2f);
      color: white;
      border: none;
      padding: 12px 24px;
      border-radius: 8px;
      cursor: pointer;
      font-weight: bold;
      transition: all 0.3s ease;
    }

    .btn-danger:hover {
      background: linear-gradient(135deg, #d32f2f, #f44336);
      transform: translateY(-2px);
      box-shadow: 0 5px 15px rgba(244, 67, 54, 0.4);
    }

    /* تحسينات إضافية للكارت */
    .text-shadow-lg {
      text-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
    }

    .backdrop-blur-sm {
      backdrop-filter: blur(4px);
    }

    /* تأثيرات الحركة */
    @keyframes fadeInUp {
      from {
        opacity: 0;
        transform: translateY(30px);
      }

      to {
        opacity: 1;
        transform: translateY(0);
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

    .animate-fadeInUp {
      animation: fadeInUp 0.5s ease-out;
    }

    .animate-scaleIn {
      animation: scaleIn 0.3s ease-out;
    }

    /* Logs Accordion Styles */
    body.dark-mode .accordion-header {
      border-bottom-color: rgba(255, 255, 255, 0.1);
    }

    .accordion-header:hover {
      background: linear-gradient(135deg, rgba(102, 126, 234, 0.08), rgba(118, 75, 162, 0.08));
    }

    body.dark-mode .accordion-header:hover {
      background: linear-gradient(135deg, rgba(124, 140, 255, 0.1), rgba(144, 104, 199, 0.1));
    }

    /* تحسينات للاستجابة */
    @media (max-width: 768px) {
      .header-wrapper,
      .page-wrapper {
        width: 100%;
        padding-left: 12px;
        padding-right: 12px;
      }

      .text-6xl {
        font-size: 3rem;
      }

      .text-3xl {
        font-size: 1.5rem;
      }

      .p-8 {
        padding: 1rem;
      }

      .grid-cols-1 {
        grid-template-columns: repeat(1, minmax(0, 1fr));
      }
    }

    @media (max-width: 640px) {
      .text-6xl {
        font-size: 2.5rem;
      }

      .max-w-4xl {
        max-width: 95%;
      }

      .p-4 {
        padding: 0.5rem;
      }
    }

    .sections-grid {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 20px;
      margin-bottom: 30px;
    }

    .card {
      background: #ffffff;
      backdrop-filter: blur(10px);
      border-radius: 14px;
      padding: 20px;
      box-shadow: 0 4px 20px rgba(0, 0, 0, 0.15);
      border: 1px solid rgba(0, 0, 0, 0.08);
    }

    body.dark-mode .card {
      background: rgba(30, 30, 46, 0.95);
      box-shadow: 0 8px 32px rgba(0, 0, 0, 0.3);
      border-color: rgba(255, 255, 255, 0.1);
    }

    .card h3 {
      color: #1f2937;
      margin-bottom: 15px;
      font-size: 1.25rem;
      text-align: center;
      font-weight: 700;
    }

    body.dark-mode .card h3 {
      color: #e2e8f0;
    }

    .room-card,
    .session-card {
      background: #f7fafc;
      padding: 15px 16px;
      border-radius: 11px;
      margin-bottom: 12px;
      border: 1px solid #e5e7eb;
      box-shadow: 0 2px 10px rgba(0, 0, 0, 0.07);
      transition: all 0.3s ease;
    }

    body.dark-mode .room-card,
    body.dark-mode .session-card {
      background: rgba(45, 55, 72, 0.6);
      box-shadow: 0 2px 8px rgba(0, 0, 0, 0.2);
      border-color: rgba(255, 255, 255, 0.1);
    }

    .room-card:hover,
    .session-card:hover {
      transform: translateY(-3px);
      box-shadow: 0 8px 24px rgba(102, 126, 234, 0.2);
      border-color: #667eea;
    }

    .room-card:last-child,
    .session-card:last-child {
      margin-bottom: 0;
    }

    /* Accordion Sections */
    .accordion-section {
      background: #ffffff;
      backdrop-filter: blur(10px);
      border-radius: 15px;
      margin-bottom: 20px;
      box-shadow: 0 4px 20px rgba(0, 0, 0, 0.12);
      border: 1px solid rgba(0, 0, 0, 0.08);
      overflow: hidden;
      transition: all 0.3s ease;
    }

    body.dark-mode .accordion-section {
      background: rgba(30, 30, 46, 0.95);
      box-shadow: 0 8px 32px rgba(0, 0, 0, 0.3);
      border-color: rgba(255, 255, 255, 0.1);
    }

    .accordion-header {
      padding: 15px 20px;
      cursor: pointer;
      display: flex;
      justify-content: space-between;
      align-items: center;
      background: linear-gradient(135deg, rgba(102, 126, 234, 0.1), rgba(118, 75, 162, 0.1));
      transition: all 0.3s ease;
      user-select: none;
    }

    body.dark-mode .accordion-header {
      background: linear-gradient(135deg, rgba(124, 140, 255, 0.15), rgba(144, 104, 199, 0.15));
    }

    .accordion-header:hover {
      background: linear-gradient(135deg, rgba(102, 126, 234, 0.15), rgba(118, 75, 162, 0.15));
    }

    body.dark-mode .accordion-header:hover {
      background: linear-gradient(135deg, rgba(124, 140, 255, 0.2), rgba(144, 104, 199, 0.2));
    }

    .accordion-title {
      display: flex;
      align-items: center;
      gap: 10px;
      font-size: 17px;
      font-weight: 700;
      color: #1f2937;
    }

    body.dark-mode .accordion-title {
      color: #e2e8f0;
    }

    .accordion-title i {
      font-size: 20px;
      color: #667eea;
    }

    body.dark-mode .accordion-title i {
      color: #7c8cff;
    }

    .accordion-badge {
      background: linear-gradient(135deg, #667eea, #764ba2);
      color: white;
      padding: 4px 12px;
      border-radius: 20px;
      font-size: 13px;
      font-weight: 600;
      margin-left: 10px;
    }

    .accordion-toggle {
      width: 34px;
      height: 34px;
      border-radius: 9px;
      background: rgba(102, 126, 234, 0.1);
      display: flex;
      align-items: center;
      justify-content: center;
      transition: all 0.3s ease;
    }

    body.dark-mode .accordion-toggle {
      background: rgba(124, 140, 255, 0.15);
    }

    .accordion-toggle i {
      color: #667eea;
      font-size: 17px;
      transition: transform 0.3s ease;
    }

    body.dark-mode .accordion-toggle i {
      color: #7c8cff;
    }

    .accordion-section.active .accordion-toggle i {
      transform: rotate(180deg);
    }

    .accordion-content {
      max-height: 0;
      overflow: hidden;
      transition: max-height 0.4s ease, opacity 0.3s ease, padding 0.3s ease;
      opacity: 0;
    }

    .accordion-section.active .accordion-content {
      max-height: 10000px;
      opacity: 1;
      padding: 20px;
    }

    /* Collapsible Session Card */
    .session-card-wrapper {
      margin-bottom: 12px;
      border-radius: 11px;
      overflow: hidden;
      background: #f7fafc;
      border: 1px solid #e5e7eb;
      box-shadow: 0 2px 10px rgba(0, 0, 0, 0.07);
      transition: all 0.3s ease;
    }

    body.dark-mode .session-card-wrapper {
      background: rgba(45, 55, 72, 0.6);
      box-shadow: 0 2px 8px rgba(0, 0, 0, 0.2);
      border-color: rgba(255, 255, 255, 0.1);
    }

    .session-card-wrapper:hover {
      box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
      border-color: #667eea;
    }

    .session-card-wrapper.expanded {
      box-shadow: 0 8px 24px rgba(102, 126, 234, 0.15);
    }

    .session-summary {
      padding: 12px 16px;
      cursor: pointer;
      display: flex;
      align-items: center;
      justify-content: space-between;
      gap: 12px;
      background: rgba(255, 255, 255, 0.6);
      transition: all 0.3s ease;
      user-select: none;
      position: relative;
    }

    body.dark-mode .session-summary {
      background: rgba(45, 55, 72, 0.4);
    }

    .session-summary:hover {
      background: rgba(102, 126, 234, 0.05);
    }

    body.dark-mode .session-summary:hover {
      background: rgba(124, 140, 255, 0.1);
    }

    .session-summary:focus {
      outline: 2px solid #667eea;
      outline-offset: -2px;
    }

    .session-summary-info {
      flex: 1;
      display: flex;
      align-items: center;
      gap: 12px;
      flex-wrap: wrap;
    }

    .session-room-name {
      font-weight: 700;
      font-size: 16px;
      color: #1f2937;
      display: flex;
      align-items: center;
      gap: 8px;
    }

    body.dark-mode .session-room-name {
      color: #e2e8f0;
    }

    .session-badges {
      display: flex;
      gap: 6px;
      flex-wrap: wrap;
    }

    .session-badge {
      padding: 3px 10px;
      border-radius: 12px;
      font-size: 11px;
      font-weight: 600;
      display: inline-flex;
      align-items: center;
      gap: 4px;
    }

    .badge-limited {
      background: #fef3c7;
      color: #92400e;
    }

    body.dark-mode .badge-limited {
      background: rgba(251, 191, 36, 0.2);
      color: #fbbf24;
    }

    .badge-frozen {
      background: #dbeafe;
      color: #1e40af;
      animation: pulse 2s infinite;
    }

    body.dark-mode .badge-frozen {
      background: rgba(59, 130, 246, 0.2);
      color: #60a5fa;
    }

    .badge-device {
      background: linear-gradient(135deg, #667eea, #764ba2);
      color: white;
    }

    .session-summary-amount {
      font-weight: 700;
      font-size: 16px;
      color: #10b981;
      font-family: 'Courier New', monospace;
    }

    body.dark-mode .session-summary-amount {
      color: #34d399;
    }

    .session-expand-btn {
      width: 32px;
      height: 32px;
      border-radius: 7px;
      background: rgba(102, 126, 234, 0.1);
      display: flex;
      align-items: center;
      justify-content: center;
      transition: all 0.3s ease;
      flex-shrink: 0;
    }

    body.dark-mode .session-expand-btn {
      background: rgba(124, 140, 255, 0.15);
    }

    .session-expand-btn i {
      color: #667eea;
      transition: transform 0.3s ease;
    }

    body.dark-mode .session-expand-btn i {
      color: #7c8cff;
    }

    .session-card-wrapper.expanded .session-expand-btn i {
      transform: rotate(180deg);
    }

    .session-toggle-icon {
      font-size: 1.2rem;
      color: #667eea;
      transition: transform 0.35s ease;
      min-width: 30px;
      text-align: center;
    }

    body.dark-mode .session-toggle-icon {
      color: #9ca3af;
    }

    .session-card-wrapper.expanded .session-toggle-icon {
      transform: rotate(180deg);
    }

    .session-details-wrapper {
      max-height: 0;
      overflow: hidden;
      transition: max-height 0.35s cubic-bezier(0.4, 0, 0.2, 1), opacity 0.25s ease;
      opacity: 0;
    }

    .session-card-wrapper.expanded .session-details-wrapper {
      opacity: 1;
    }

    .session-details-content {
      padding: 15px 16px;
      border-top: 1px solid rgba(0, 0, 0, 0.05);
    }

    body.dark-mode .session-details-content {
      border-top-color: rgba(255, 255, 255, 0.05);
    }

    .session-header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 15px;
    }

    .session-room {
      font-weight: bold;
      color: #1f2937;
      font-size: 1.2rem;
    }

    body.dark-mode .session-room {
      color: #f3f4f6;
    }

    .session-timer {
      text-align: center;
      margin: 12px 0;
    }

    .timer-display {
      font-size: 1.65rem;
      font-weight: bold;
      color: #4CAF50;
      font-family: 'Courier New', monospace;
    }

    .session-details {
      display: flex;
      flex-direction: column;
      gap: 8px;
      margin: 15px 0;
    }

    .session-detail {
      display: flex;
      justify-content: space-between;
      padding: 8px 0;
      border-bottom: 1px solid rgba(0, 0, 0, 0.06);
    }

    body.dark-mode .session-detail {
      border-bottom-color: rgba(255, 255, 255, 0.1);
    }

    .session-detail span:first-child {
      color: #6b7280;
    }

    body.dark-mode .session-detail span:first-child {
      color: #9ca3af;
    }

    .session-detail span:last-child {
      color: #111827;
      font-weight: bold;
    }

    body.dark-mode .session-detail span:last-child {
      color: #f3f4f6;
    }

    .current-amount {
      color: #4CAF50;
      font-weight: bold;
    }

    .current-amount.updating {
      color: #ff9800;
    }

    .session-actions {
      display: flex;
      gap: 10px;
      flex-wrap: wrap;
      margin-top: 15px;
      align-items: center;
    }

    /* تحسين الأزرار في الجلسات */
    .session-actions .btn {
      flex: 1 1 auto;
      min-width: fit-content;
      white-space: nowrap;
      font-size: 0.85rem;
      padding: 9px 14px;
      border-radius: 8px;
      font-weight: 600;
      transition: all 0.3s ease;
      box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
    }

    body.dark-mode .session-actions .btn {
      box-shadow: 0 2px 6px rgba(0, 0, 0, 0.3);
    }

    .session-actions .btn:hover {
      transform: translateY(-2px);
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
    }

    .session-actions form {
      display: inline-block;
      flex: 1 1 auto;
      min-width: fit-content;
    }

    /* تنسيق قائمة تبديل الغرفة */
    .switch-room-dropdown {
      position: fixed;
      background: white;
      border-radius: 12px;
      box-shadow: 0 8px 32px rgba(0, 0, 0, 0.15);
      /* أقل من أي مودال/Overlay (SweetAlert/Receipts/Type Picker) */
      z-index: 30000;
      min-width: 280px;
      max-width: 90vw;
      max-height: 60vh;
      overflow: hidden;
      animation: fadeInScale 0.2s ease;
    }

    body.dark-mode .switch-room-dropdown {
      background: #2d3748;
      box-shadow: 0 8px 32px rgba(0, 0, 0, 0.4);
    }

    .dropdown-header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 12px 16px;
      background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
      color: white;
      font-weight: 600;
      font-size: 0.95rem;
      border-bottom: 1px solid rgba(255, 255, 255, 0.1);
    }

    .dropdown-close {
      background: rgba(255, 255, 255, 0.2);
      border: none;
      color: white;
      width: 28px;
      height: 28px;
      border-radius: 50%;
      cursor: pointer;
      display: flex;
      align-items: center;
      justify-content: center;
      transition: all 0.2s;
      font-size: 0.9rem;
    }

    .dropdown-close:hover {
      background: rgba(255, 255, 255, 0.3);
      transform: rotate(90deg);
    }

    .dropdown-content {
      max-height: calc(60vh - 50px);
      overflow-y: auto;
      padding: 8px;
    }

    .dropdown-item {
      width: 100%;
      display: flex;
      align-items: center;
      gap: 12px;
      padding: 12px 14px;
      background: #f7fafc;
      border: 1px solid #e5e7eb;
      border-radius: 8px;
      margin-bottom: 8px;
      cursor: pointer;
      transition: all 0.2s;
      text-align: right;
      font-size: 0.95rem;
    }

    body.dark-mode .dropdown-item {
      background: #1a202c;
      border-color: #4a5568;
      color: #e2e8f0;
    }

    .dropdown-item:hover {
      background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
      border-color: #667eea;
      color: white;
      transform: translateX(-4px);
      box-shadow: 0 4px 12px rgba(102, 126, 234, 0.3);
    }

    body.dark-mode .dropdown-item:hover {
      box-shadow: 0 4px 12px rgba(102, 126, 234, 0.5);
    }

    .dropdown-item:last-child {
      margin-bottom: 0;
    }

    .dropdown-item i {
      color: #667eea;
      font-size: 1.2rem;
      min-width: 24px;
    }

    .dropdown-item:hover i {
      color: white;
    }

    .room-info {
      display: flex;
      flex-direction: column;
      gap: 4px;
      flex: 1;
    }

    .room-name {
      font-weight: 600;
      font-size: 1rem;
    }

    .room-type {
      font-size: 0.85rem;
      opacity: 0.8;
    }

    .room-price {
      font-size: 0.85rem;
      opacity: 0.9;
      font-weight: 500;
    }

    @keyframes fadeInScale {
      from {
        opacity: 0;
        transform: scale(0.95);
      }

      to {
        opacity: 1;
        transform: scale(1);
      }
    }

    /* تنسيق قسم الطلبات */
    .session-orders {
      margin-top: 15px;
      padding: 15px;
      background: rgba(0, 0, 0, 0.02);
      border-radius: 8px;
      border: 1px solid rgba(0, 0, 0, 0.08);
    }

    body.dark-mode .session-orders {
      background: rgba(255, 255, 255, 0.05);
      border-color: rgba(255, 255, 255, 0.1);
    }

    .session-orders h4 {
      margin: 0 0 10px 0;
      color: #4CAF50;
      font-size: 14px;
      font-weight: bold;
    }

    .orders-list {
      max-height: 150px;
      overflow-y: auto;
    }

    .order-item {
      background: rgba(0, 0, 0, 0.03);
      padding: 8px;
      margin-bottom: 5px;
      border-radius: 5px;
      border-left: 3px solid #4CAF50;
      border: 1px solid rgba(0, 0, 0, 0.06);
    }

    body.dark-mode .order-item {
      background: rgba(255, 255, 255, 0.08);
      border-color: rgba(255, 255, 255, 0.1);
    }

    .order-name {
      font-weight: bold;
      color: #1f2937;
      font-size: 13px;
      margin-bottom: 3px;
    }

    body.dark-mode .order-name {
      color: #f3f4f6;
    }

    .order-type {
      color: #4CAF50;
      font-size: 11px;
      font-weight: normal;
    }

    .order-details {
      color: #6b7280;
      font-size: 11px;
    }

    body.dark-mode .order-details {
      color: rgba(255, 255, 255, 0.7);
    }

    .no-orders {
      text-align: center;
      color: #6b7280;
      font-style: italic;
      font-size: 12px;
      margin: 10px 0;
    }

    body.dark-mode .no-orders {
      color: rgba(255, 255, 255, 0.5);
    }

    /* تنسيق قسم تكلفة الطلبات */
    .session-orders-cost {
      margin-top: 15px;
      padding: 15px;
      background: rgba(76, 175, 80, 0.08);
      border-radius: 10px;
      border: 2px solid rgba(76, 175, 80, 0.25);
    }

    body.dark-mode .session-orders-cost {
      background: linear-gradient(135deg, rgba(76, 175, 80, 0.1), rgba(76, 175, 80, 0.05));
      border-color: rgba(76, 175, 80, 0.4);
    }

    .cost-details {
      display: flex;
      flex-direction: column;
      gap: 8px;
    }

    .cost-item {
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 8px 12px;
      background: rgba(255, 255, 255, 0.05);
      border-radius: 6px;
      border-left: 4px solid #4CAF50;
    }

    .cost-item.total-cost {
      background: linear-gradient(135deg, rgba(76, 175, 80, 0.2), rgba(76, 175, 80, 0.1));
      border-left: 4px solid #4CAF50;
      border: 2px solid rgba(76, 175, 80, 0.4);
      margin-top: 5px;
    }

    .cost-label {
      font-weight: bold;
      color: #1f2937;
      font-size: 14px;
    }

    body.dark-mode .cost-label {
      color: #f3f4f6;
    }

    .cost-value {
      font-weight: bold;
      font-size: 14px;
      color: #1f2937;
    }

    body.dark-mode .cost-value {
      color: #f3f4f6;
    }

    .orders-cost {
      color: #FF9800;
    }

    .session-cost {
      color: #2196F3;
    }

    .total-amount {
      color: #4CAF50;
      font-size: 18px;
      font-weight: 900;
      text-shadow: 0 0 10px rgba(76, 175, 80, 0.5);
    }

    .btn {
      padding: 10px 20px;
      border: none;
      border-radius: 8px;
      cursor: pointer;
      font-weight: bold;
      text-decoration: none;
      display: inline-block;
      transition: all 0.3s ease;
      color: white;
    }

    .btn:hover {
      transform: translateY(-2px);
      box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
    }

    .btn-danger {
      background: linear-gradient(45deg, #f44336, #d32f2f);
    }

    .btn-pause {
      background: linear-gradient(45deg, #ffb74d, #ff9800);
      color: white;
      border: none;
      padding: 8px 16px;
      border-radius: 8px;
      cursor: pointer;
      font-size: 14px;
      font-weight: bold;
      transition: all 0.3s ease;
    }

    .btn-pause:hover {
      background: linear-gradient(45deg, #ff9800, #f57c00);
      transform: translateY(-2px);
      box-shadow: 0 4px 8px rgba(255, 183, 77, 0.3);
    }

    .btn-pause.resumed {
      background: linear-gradient(45deg, #4CAF50, #388E3C);
    }

    .btn-pause.resumed:hover {
      background: linear-gradient(45deg, #388E3C, #2E7D32);
      box-shadow: 0 4px 8px rgba(76, 175, 80, 0.3);
    }

    /* تنسيق العداد والمبلغ المتوقف */
    .timer-display.paused {
      color: #ffb74d;
      opacity: 0.8;
      animation: pulse-paused 2s infinite;
    }

    .current-amount.paused {
      color: #ffb74d;
      opacity: 0.8;
      animation: pulse-paused 2s infinite;
    }

    @keyframes pulse-paused {
      0% {
        opacity: 0.8;
      }

      50% {
        opacity: 0.6;
      }

      100% {
        opacity: 0.8;
      }
    }

    /* تأثيرات التجميد */
    .session-card[data-is-paused="1"] {
      border: 2px solid #f44336;
      background: linear-gradient(135deg, rgba(244, 67, 54, 0.1), rgba(244, 67, 54, 0.05));
      animation: pulse-frozen 2s infinite;
    }

    .session-card[data-is-paused="1"] .timer-display {
      color: #f44336;
      opacity: 0.7;
    }

    .session-card[data-is-paused="1"] .current-amount {
      color: #f44336;
      opacity: 0.7;
    }

    .session-breakdown {
      display: flex;
      flex-direction: column;
      gap: 6px;
    }

    .session-breakdown-list {
      margin-top: 8px;
      display: grid;
      gap: 8px;
      max-height: 310px;
      overflow-y: auto;
      padding-left: 6px;
    }

    .session-breakdown-list::-webkit-scrollbar {
      width: 8px;
    }

    .session-breakdown-list::-webkit-scrollbar-track {
      background: rgba(148, 163, 184, 0.2);
      border-radius: 999px;
    }

    .session-breakdown-list::-webkit-scrollbar-thumb {
      background: rgba(249, 115, 22, 0.6);
      border-radius: 999px;
    }

    body.dark-mode .session-breakdown-list::-webkit-scrollbar-track {
      background: rgba(71, 85, 105, 0.4);
    }

    body.dark-mode .session-breakdown-list::-webkit-scrollbar-thumb {
      background: rgba(251, 191, 36, 0.8);
    }

    .session-breakdown-card {
      background: rgba(254, 215, 170, 0.35);
      border-left: 3px solid #fb923c;
      border-radius: 10px;
      padding: 8px 12px;
      transition: background 0.2s ease, border-color 0.2s ease;
    }

    body.dark-mode .session-breakdown-card {
      background: rgba(251, 191, 36, 0.15);
      border-color: #fbbf24;
    }

    .session-breakdown-content {
      display: flex;
      flex-wrap: wrap;
      gap: 6px 12px;
      align-items: center;
      font-size: 0.92rem;
      color: #4b5563;
    }

    body.dark-mode .session-breakdown-content {
      color: #e2e8f0;
    }

    .session-breakdown-content strong {
      color: #c2410c;
      font-weight: 700;
    }

    body.dark-mode .session-breakdown-content strong {
      color: #fbbf24;
    }

    .session-breakdown-content .amount {
      color: #c2410c;
      font-weight: 600;
    }

    body.dark-mode .session-breakdown-content .amount {
      color: #f87171;
    }

    @keyframes pulse-frozen {
      0% {
        box-shadow: 0 0 0 0 rgba(244, 67, 54, 0.7);
      }

      70% {
        box-shadow: 0 0 0 10px rgba(244, 67, 54, 0);
      }

      100% {
        box-shadow: 0 0 0 0 rgba(244, 67, 54, 0);
      }
    }

    /* تنسيق العداد والمبلغ عند الاستكمال */
    .timer-display.resumed {
      color: #4CAF50;
      opacity: 1;
      animation: pulse-resumed 2s infinite;
    }

    .current-amount.resumed {
      color: #4CAF50;
      opacity: 1;
      animation: pulse-resumed 2s infinite;
    }

    @keyframes pulse-resumed {
      0% {
        opacity: 1;
      }

      50% {
        opacity: 0.8;
      }

      100% {
        opacity: 1;
      }
    }

    .btn-warning {
      background: linear-gradient(45deg, #ff9800, #f57c00);
    }

    .btn-info {
      background: linear-gradient(45deg, #2196F3, #1976D2);
    }

    .btn-success {
      background: linear-gradient(45deg, #4CAF50, #388E3C);
    }

    .room-name {
      font-weight: bold;
      color: #1f2937;
      margin-bottom: 10px;
    }

    body.dark-mode .room-name {
      color: #f3f4f6;
    }

    .room-details {
      color: #6b7280;
      margin-bottom: 15px;
      font-size: 0.9rem;
    }

    body.dark-mode .room-details {
      color: #9ca3af;
    }

    .room-actions {
      text-align: center;
    }

    .logs-container {
      border: 1px solid rgba(0, 0, 0, 0.08);
      background: rgba(0, 0, 0, 0.02);
      box-shadow: inset 0 2px 4px rgba(0, 0, 0, 0.05);
      scrollbar-color: #4CAF50 #e5e7eb;
    }

    body.dark-mode .logs-container {
      border-color: #333;
      background: rgba(0, 0, 0, 0.1);
      box-shadow: inset 0 2px 4px rgba(0, 0, 0, 0.3);
      scrollbar-color: #4CAF50 #333;
    }

    .log-item {
      background: rgba(0, 0, 0, 0.03);
      padding: 15px;
      border-radius: 8px;
      margin-bottom: 10px;
      border-left: 3px solid #4CAF50;
      border: 1px solid rgba(0, 0, 0, 0.08);
    }

    body.dark-mode .log-item {
      background: rgba(255, 255, 255, 0.05);
      border-color: rgba(255, 255, 255, 0.1);
    }

    .log-time {
      color: #6b7280;
      font-size: 0.8rem;
      margin-bottom: 5px;
    }

    body.dark-mode .log-time {
      color: #9ca3af;
    }

    .log-action {
      color: #1f2937;
      font-weight: bold;
      margin-bottom: 5px;
    }

    body.dark-mode .log-action {
      color: #f3f4f6;
    }

    .log-details {
      color: #6b7280;
      font-size: 0.9rem;
    }

    body.dark-mode .log-details {
      color: #9ca3af;
    }

    .empty-message {
      color: #6b7280;
      font-size: 0.95rem;
      padding: 20px;
    }

    body.dark-mode .empty-message {
      color: #9ca3af;
    }

    @media (max-width: 768px) {
      .header {
        padding: 12px 18px;
      }

      .logo {
        font-size: 1.5rem;
      }

      .sections-grid {
        grid-template-columns: 1fr;
      }

      .session-details {
        grid-template-columns: 1fr;
      }

      /* إزالة padding من card على الموبايل */
      .card {
        padding: 0;
        border-radius: 12px;
      }

      /* إعادة padding لعنوان الكارت فقط */
      .card h3 {
        padding: 20px 15px;
        margin-bottom: 0;
        background: rgba(102, 126, 234, 0.05);
        border-radius: 12px 12px 0 0;
      }

      body.dark-mode .card h3 {
        background: rgba(124, 140, 255, 0.1);
      }

      /* إضافة padding داخلي لبطاقات الجلسات */
      .session-card-wrapper {
        margin: 0 12px 15px 12px;
      }

      /* مسافة صغيرة أعلى أول بطاقة جلسة لتجنب الالتصاق بالعنوان */
      .session-card-wrapper:first-of-type {
        margin-top: 8px;
      }

      .session-summary {
        padding: 15px;
      }

      .session-details-content {
        padding: 15px;
      }

      /* تحسين الأزرار على الموبايل */
      .session-actions {
        flex-direction: column;
        gap: 8px;
      }

      .session-actions .btn {
        width: 100%;
        flex: 1 1 100%;
        padding: 12px 16px;
        font-size: 1rem;
        justify-content: center;
        display: flex;
        align-items: center;
        gap: 8px;
      }

      .session-actions form {
        width: 100%;
        flex: 1 1 100%;
      }

      /* تحسين مساحة اللمس على الموبايل */
      .session-actions .btn {
        min-height: 48px;
        touch-action: manipulation;
      }

      /* أيقونات أكبر على الموبايل */
      .session-actions .btn i {
        font-size: 1.1rem;
      }

      /* تحسين قائمة تبديل الغرفة على الموبايل */
      .switch-room-dropdown {
        min-width: 90vw;
        max-width: 95vw;
      }

      .dropdown-item {
        padding: 14px 12px;
        font-size: 1rem;
        min-height: 56px;
      }

      .dropdown-item i {
        font-size: 1.4rem;
      }

      .room-name {
        font-size: 1.05rem;
      }

      .room-type,
      .room-price {
        font-size: 0.9rem;
      }

      /* تحسين رأس سجل التغييرات على الموبايل */
      .accordion-header h3 {
        font-size: 1rem !important;
      }

      .accordion-toggle {
        font-size: 1.2rem !important;
      }

      /* أزرار التحكم داخل المحتوى */
      #logsContent > div:first-child {
        flex-direction: column !important;
        align-items: stretch !important;
        gap: 10px !important;
      }

      #logsContent > div:first-child > div {
        flex-direction: column !important;
        text-align: center;
        gap: 5px !important;
      }

      #logsContent .btn-danger {
        width: 100% !important;
        padding: 10px 16px !important;
      }
    }

    /* تنسيق إيصال إنهاء الجلسة للتابلت والموبايل */
    @media (max-width: 1024px) {

      /* إخفاء زر التراجع في الهيدر */
      .header-undo {
        display: none !important;
      }

      /* إظهار زر التراجع في الفوتر */
      .receipt-undo-mobile {
        display: inline-flex !important;
      }

      /* جعل الفوتر ثابت ومرن */
      .receipt-actions {
        position: sticky !important;
        bottom: 0 !important;
        background: rgba(249, 250, 251, 0.98) !important;
        backdrop-filter: blur(8px) !important;
        padding: 12px 16px !important;
        display: flex !important;
        flex-wrap: wrap !important;
        gap: 10px !important;
        z-index: 10 !important;
        border-top: 2px solid rgba(102, 126, 234, 0.2) !important;
        box-shadow: 0 -4px 12px rgba(0, 0, 0, 0.08) !important;
      }

      body.dark-mode .receipt-actions {
        background: rgba(30, 30, 46, 0.98) !important;
        border-top-color: rgba(124, 140, 255, 0.3) !important;
        box-shadow: 0 -4px 12px rgba(0, 0, 0, 0.3) !important;
      }

      .receipt-actions>div:last-child {
        display: flex !important;
        flex-wrap: nowrap !important;
        gap: 8px !important;
        width: 100% !important;
        justify-content: space-between !important;
      }

      .receipt-actions .px-6,
      .receipt-actions .px-4 {
        flex: 1 1 0 !important;
        min-width: auto !important;
        max-width: none !important;
        min-height: 48px !important;
        font-size: 0.95rem !important;
        padding: 12px 16px !important;
        display: inline-flex !important;
        justify-content: center !important;
        align-items: center !important;
        gap: 6px !important;
        touch-action: manipulation !important;
      }

      .receipt-actions .px-4 {
        font-size: 0.85rem !important;
        padding: 12px 12px !important;
      }

      /* تقليل حجم أقسام الإيصال على الموبايل/تابلت */
      #sessionSummaryModal h2 {
        font-size: 1.5rem !important;
      }

      #sessionSummaryModal h3 {
        font-size: 1.1rem !important;
      }

      #sessionSummaryModal .p-8 {
        padding: 1rem !important;
      }

      #sessionSummaryModal .grid-cols-2,
      #sessionSummaryModal .md\\:grid-cols-3,
      #sessionSummaryModal .lg\\:grid-cols-6 {
        grid-template-columns: repeat(2, 1fr) !important;
        gap: 10px !important;
      }

      #sessionSummaryModal .text-4xl {
        font-size: 2rem !important;
      }

      #sessionSummaryModal .text-3xl {
        font-size: 1.5rem !important;
      }

      #sessionSummaryModal .text-2xl {
        font-size: 1.25rem !important;
      }

      #sessionSummaryModal .text-xl {
        font-size: 1rem !important;
      }

      #sessionSummaryModal .text-lg {
        font-size: 0.95rem !important;
      }
    }

    @media (max-width: 480px) {
      .logo {
        font-size: 1.3rem;
      }

      .user-btn span {
        display: none;
      }

      /* تحسين إضافي للأزرار على الشاشات الصغيرة جداً */
      .session-actions .btn {
        font-size: 0.95rem;
        padding: 14px 12px;
        min-height: 52px;
      }

      /* تحسين الإيصال على الشاشات الصغيرة جداً */
      .receipt-actions .px-6,
      .receipt-actions .px-4 {
        min-width: auto !important;
        max-width: none !important;
        font-size: 0.85rem !important;
        padding: 10px 12px !important;
        gap: 4px !important;
      }

      .receipt-actions .px-4 {
        font-size: 0.75rem !important;
        padding: 10px 8px !important;
      }

      .receipt-actions>div:last-child {
        gap: 6px !important;
      }

      #sessionSummaryModal h2 {
        font-size: 1.25rem !important;
      }

      #sessionSummaryModal h3 {
        font-size: 1rem !important;
      }

      #sessionSummaryModal .grid-cols-2 {
        grid-template-columns: 1fr !important;
      }

      #sessionSummaryModal .text-center>div:first-child {
        font-size: 0.8rem !important;
      }

      #sessionSummaryModal .text-center>div:last-child {
        font-size: 0.9rem !important;
      }

      /* تقليل حجم الهيدر والأزرار الدائرية في الإيصال */
      #sessionSummaryModal .bg-gradient-to-br.from-emerald-500 {
        padding: 1.5rem 1rem !important;
      }

      #sessionSummaryModal .w-16.h-16 {
        width: 3rem !important;
        height: 3rem !important;
      }

      #sessionSummaryModal .w-16.h-16 i {
        font-size: 1.5rem !important;
      }

      #sessionSummaryModal .rounded-full.p-3 {
        padding: 0.5rem !important;
      }

      #sessionSummaryModal .rounded-full.p-3 i {
        font-size: 1rem !important;
      }
    }

    @media (max-width: 360px) {

      /* تحسين للشاشات الصغيرة جداً (350px) */
      .session-actions .btn {
        font-size: 0.9rem;
        padding: 12px 10px;
        border-radius: 6px;
      }

      /* تحسينات إضافية للإيصال على الشاشات الصغيرة جداً */
      .receipt-actions .px-6,
      .receipt-actions .px-4 {
        min-width: auto !important;
        font-size: 0.8rem !important;
        padding: 10px 8px !important;
        gap: 3px !important;
      }

      .receipt-actions .px-4 {
        font-size: 0.7rem !important;
        padding: 10px 6px !important;
      }

      .receipt-actions>div:last-child {
        gap: 5px !important;
      }

      .receipt-actions .px-6 i,
      .receipt-actions .px-4 i {
        font-size: 0.9rem !important;
      }

    }
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

  <div class="page-wrapper">

    


    <!-- Modal للجلسة المحدودة -->
    <div id="limitedSessionModal" class="modal" style="display: none;">
      <div class="modal-content">
        <div class="modal-header">
          <h3>جلسة محدودة</h3>
          <span class="close"
            onclick="closeLimitedSessionModal()">&times;</span>
        </div>
        <div class="modal-body">
          <form id="limitedSessionForm" method="POST" action="">
            <input type="hidden" name="action" value="start_limited_session">
            <input type="hidden" name="room_id" id="limitedRoomId">
            <input type="hidden" name="session_type" id="limitedSessionType" value="individual">

            <div class="form-group">
              <label for="duration">مدة الجلسة (بالدقائق):</label>
              <input type="number" id="duration" name="duration_minutes" min="1"
                max="480" value="1" required>
              <small>الحد الأدنى: دقيقة واحدة</small>
            </div>

            <div class="duration-preview">
              <p id="durationText">المدة: دقيقة واحدة</p>
            </div>

            
            <div class="modal-actions limited-session-modal-actions">
              <button type="button" onclick="closeLimitedSessionModal()"
                class="btn btn-secondary">إلغاء</button>
              <button type="submit" class="btn btn-primary">بدء الجلسة
                المحدودة</button>
            </div>
          </form>
        </div>
      </div>
    </div>

    <style>
      /* مسافة بين كارت الإغلاق الفوري وأزرار المودال */
      #limitedSessionModal .limited-session-modal-actions {
        margin-top: 8px;
        padding-top: 4px;
      }

      /* Toggle Switch لخيار الإغلاق الفوري داخل مودال الجلسة المحدودة */
      .limited-switch { position: relative; display: inline-block; width: 46px; height: 26px; flex-shrink: 0; }
      .limited-switch input { opacity: 0; width: 0; height: 0; position: absolute; }
      .limited-switch-track {
        position: absolute; inset: 0; background: #cbd5e1; border-radius: 999px;
        transition: background .25s ease;
      }
      .limited-switch-thumb {
        position: absolute; top: 3px; right: 3px; width: 20px; height: 20px; background: #fff;
        border-radius: 50%; box-shadow: 0 2px 6px rgba(0,0,0,.2); transition: transform .25s ease, right .25s ease;
      }
      .limited-switch input:checked + .limited-switch-track { background: linear-gradient(135deg,#6366f1,#a855f7); }
      .limited-switch input:checked + .limited-switch-track .limited-switch-thumb { right: 23px; }
      /* حالة مقفولة (مفروضة من الإدارة على الموظف) */
      .limited-switch.is-locked { cursor: not-allowed; pointer-events: none; }
      .limited-switch.is-locked .limited-switch-track { background: linear-gradient(135deg,#6366f1,#a855f7) !important; opacity: .92; }
      .limited-switch.is-locked .limited-switch-thumb { box-shadow: 0 2px 6px rgba(0,0,0,.25), 0 0 0 2px rgba(255,255,255,.15) inset; }
      .limited-immediate-off.is-locked { box-shadow: inset 0 0 0 1px rgba(168,85,247,0.4); }
      body.dark-mode .limited-immediate-off { background: linear-gradient(135deg, rgba(99,102,241,0.18), rgba(168,85,247,0.18)) !important; border-color: rgba(168,85,247,0.35) !important; }
      body.dark-mode .limited-immediate-off label > div > div > div:first-child { color: #f1f5f9 !important; }
      body.dark-mode .limited-immediate-off label > div > div > div:last-child { color: #cbd5e1 !important; }
    </style>
    <div class="sections-grid">
      <!-- الغرف المتاحة -->
      <div class="card">
        <h3>الغرف المتاحة للتبديل</h3>
                  <p class="empty-message" style="text-align: center;">لا توجد غرف متاحة
            للتبديل
          </p>
          <p
            style="text-align: center; color: #999; font-size: 0.9rem; margin-top: 10px;">
            جميع الغرف مشغولة أو في جلسات نشطة
          </p>
              </div>

      <!-- الجلسات النشطة -->
      <div class="card">
        <h3 style="display: flex; align-items: center; gap: 12px;">
          الجلسات النشطة
          <span style="background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%); color: white; padding: 4px 12px; border-radius: 12px; font-size: 0.9rem; font-weight: 600; box-shadow: 0 2px 8px rgba(245, 158, 11, 0.3);">
            2          </span>
        </h3>
                              <!-- Session Card Wrapper -->
            <div class="session-card-wrapper"
              data-session-id="14589">

              <!-- Session Summary (Always Visible) -->
              <div class="session-summary" role="button" tabindex="0"
                aria-expanded="false"
                aria-controls="session-details-14589"
                aria-label="تفاصيل جلسة VIP1"
                onclick="toggleSessionCard(this.parentElement)">

                <div class="session-summary-info">
                  <div class="session-room-name">
                    <i class="fas fa-door-open"
                      style="margin-left: 8px; color: #667eea;"></i>
                    VIP1                                                                              </div>
                </div>

                <!-- Toggle Icon -->
                <div class="session-toggle-icon">
                  <i class="fas fa-chevron-down"></i>
                </div>
              </div>

              <!-- Session Details (Collapsible) -->
              <div class="session-details-wrapper"
                id="session-details-14589">
                <div class="session-details-content">
                  <div class="session-card"
                    data-session-id="14589"
                    data-is-limited="0"
                    data-is-paused="0"
                    >

                    <div class="session-timer">
                      <div class="timer-display"
                        data-start-time="1780300170000"
                        data-status="active">
                        <span class="timer-hours">00</span>:<span
                          class="timer-minutes">00</span>:<span
                          class="timer-seconds">00</span>
                      </div>
                    </div>

                    <div class="session-details">
                      
                      <div class="session-detail">
                        <span>نوع الجهاز:</span>
                        <span>PS4</span>
                      </div>

                      <!-- أزرار التبديل بين الوضع الفردي والجماعي -->
                      <div class="session-detail">
                        <span>نوع الجلسة:</span>
                        <div
                          style="display: flex; gap: 8px; flex-wrap: wrap; margin-top: 5px;">
                          <form method="POST" action="" style="display: inline;">
                            <input type="hidden" name="action"
                              value="switch_session_type">
                            <input type="hidden" name="session_id"
                              value="14589">
                            <input type="hidden" name="session_type"
                              value="individual">
                            <button type="submit"
                              style="background: #4CAF50;
                           color: white;
                           border: none; padding: 6px 12px; border-radius: 4px; font-size: 12px; cursor: pointer;"
                              disabled>
                              فردي
                            </button>
                          </form>

                          <form method="POST" action="" style="display: inline;">
                            <input type="hidden" name="action"
                              value="switch_session_type">
                            <input type="hidden" name="session_id"
                              value="14589">
                            <input type="hidden" name="session_type" value="group">
                            <button type="submit"
                              style="background: #E0E0E0;
                           color: #666;
                           border: none; padding: 6px 12px; border-radius: 4px; font-size: 12px; cursor: pointer;"
                              >
                              جماعي
                            </button>
                          </form>
                        </div>
                      </div>

                      <div class="session-detail">
                        <span>السعر بالساعة
                          (فردي):</span>
                        <span>30.00                          جنيه</span>
                      </div>

                      <!-- إضافة سطرين منفصلين للسعر الجماعي والفردي -->
                      <div class="session-detail">
                        <span>إجمالي سعر المدة الجماعية:</span>
                        <span id="group-price-14589"
                          style="color: #FF9800; font-weight: bold;"
                          data-group-accumulated="0.00">
                          0.00 جنيه                        </span>
                      </div>

                      <div class="session-detail">
                        <span>إجمالي سعر المدة الفردية:</span>
                        <span id="individual-price-14589"
                          style="color: #2196F3; font-weight: bold;"
                          data-individual-accumulated="0.00">
                          7.50 جنيه                        </span>
                      </div>
                      <div class="session-detail">
                        <span>المبلغ الحالي:</span>
                        <span class="current-amount"
                          data-hourly-rate="30.00"
                          data-group-hourly-rate="30.00"
                          data-session-type="individual"
                          data-start-time="1780300170000"
                          data-status="active"
                          data-accumulated="0.00">
                          7.50                          جنيه                        </span>
                      </div>
                                                                                        <div class="session-detail">
                        <span>بدء الجلسة:</span>
                        <span>10:49 AM</span>
                      </div>
                    </div>

                    <!-- قسم الطلبات -->
                    <div class="session-orders">
                      <div class="flex items-center justify-between gap-3 mb-2">
                        <h4 class="m-0">الطلبات الحالية</h4>
                                                  <button type="button"
                            class="bg-gradient-to-r from-emerald-500 to-green-600 hover:from-emerald-600 hover:to-green-700 text-white text-sm font-bold px-3 py-2 rounded-xl shadow-lg transition flex items-center gap-2"
                            onclick="openSessionAddOrderModal(14589)"
                            aria-label="إضافة طلب للجلسة">
                            <i class="fas fa-plus"></i>
                            <span class="hidden sm:inline">إضافة طلب</span>
                          </button>
                                              </div>
                                                <p class="no-orders" id="orders-empty-14589">لا توجد طلبات حالية</p>
                                                                  </div>

                    <!-- قسم تكلفة الطلبات -->
                    <div class="session-orders-cost">
                      
                      <div class="cost-details">
                        <div class="cost-item">
                          <span class="cost-label">تكلفة الطلبات:</span>
                          <span class="cost-value orders-cost"
                            id="orders-cost-14589">0.00                            جنيه</span>
                        </div>

                        <div class="cost-item">
                          <span class="cost-label">تكلفة الجلسة:</span>
                          <span class="cost-value session-cost"
                            id="session-cost-14589">7.50                            جنيه</span>
                        </div>

                        <div class="cost-item total-cost">
                          <span class="cost-label">إجمالي السعر:</span>
                          <span class="cost-value total-amount"
                            id="total-cost-14589">7.50                            جنيه</span>
                        </div>
                      </div>
                    </div>

                    <div class="session-actions">
                      <!-- تبديل الغرفة -->
                      <div style="display: inline-block; position: relative;">
                        <button type="button" class="btn btn-info switch-room-btn"
                          onclick="toggleSwitchRoomDropdown(14589, this)"
                          data-session-id="14589"
                          aria-haspopup="true" aria-expanded="false"
                          style="background: #2196F3; color: white; border: none;">
                          <i class="fas fa-sync-alt"></i>
                          تبديل الغرفة
                        </button>

                        <div id="switchRoomDropdown_14589"
                          class="switch-room-dropdown" style="display: none;"
                          role="menu" aria-label="قائمة الغرف المتاحة">
                          <div class="dropdown-header">
                            <span>اختر الغرفة الجديدة</span>
                            <button type="button" class="dropdown-close"
                              onclick="closeSwitchRoomDropdown(14589)"
                              aria-label="إغلاق">
                              <i class="fas fa-times"></i>
                            </button>
                          </div>
                          <div class="dropdown-content">
                                                      </div>
                        </div>
                      </div>

                      <!-- زر تغيير نوع الجلسة -->


                      <!-- زر التوقف المؤقت -->
                      <button type="button" class="btn btn-pause"
                        onclick="togglePause(this)"
                        data-session-id="14589">
                        <i class="fas fa-pause"></i>
                        توقف مؤقت
                      </button>

                      
                                              <form id="endSessionForm_14589"
                          method="POST" action="" style="display: inline;">
                          <input type="hidden" name="action" value="end_session">
                          <input type="hidden" name="session_id"
                            value="14589">
                          <button type="button"
                            onclick="confirmEndSession(14589)"
                            class="btn btn-danger">
                            <i class="fas fa-stop"></i>
                            إنهاء الجلسة
                          </button>
                        </form>
                                          </div>
                  </div><!-- /.session-card -->
                </div><!-- /.session-details-content -->
              </div><!-- /.session-details-wrapper -->
            </div><!-- /.session-card-wrapper -->
                      <!-- Session Card Wrapper -->
            <div class="session-card-wrapper"
              data-session-id="14587">

              <!-- Session Summary (Always Visible) -->
              <div class="session-summary" role="button" tabindex="0"
                aria-expanded="false"
                aria-controls="session-details-14587"
                aria-label="تفاصيل جلسة VIP2"
                onclick="toggleSessionCard(this.parentElement)">

                <div class="session-summary-info">
                  <div class="session-room-name">
                    <i class="fas fa-door-open"
                      style="margin-left: 8px; color: #667eea;"></i>
                    VIP2                                          <span
                        style="background: #FF9800; color: white; padding: 2px 8px; border-radius: 12px; font-size: 0.8rem; margin-right: 8px;">
                        محدودة
                      </span>
                                                                              </div>
                </div>

                <!-- Toggle Icon -->
                <div class="session-toggle-icon">
                  <i class="fas fa-chevron-down"></i>
                </div>
              </div>

              <!-- Session Details (Collapsible) -->
              <div class="session-details-wrapper"
                id="session-details-14587">
                <div class="session-details-content">
                  <div class="session-card"
                    data-session-id="14587"
                    data-is-limited="1"
                    data-is-paused="0"
                                        data-limited-end="2026-06-01 11:33:07"
                    data-limited-end-ms="1780302787000"
                    >

                    <div class="session-timer">
                      <div class="timer-display"
                        data-start-time="1780299732000"
                        data-status="active">
                        <span class="timer-hours">00</span>:<span
                          class="timer-minutes">00</span>:<span
                          class="timer-seconds">00</span>
                      </div>
                    </div>

                    <div class="session-details">
                                              <div class="session-detail"
                          style="background: rgba(255, 152, 0, 0.1); padding: 8px; border-radius: 8px; border-left: 3px solid #FF9800;">
                          <span style="color: #FF9800; font-weight: bold;">مدة الجلسة
                            المحدودة:</span>
                          <span style="color: #FF9800; font-weight: bold;"
                            data-duration="60">60                            دقيقة</span>
                        </div>
                        <div class="session-detail"
                          style="background: rgba(255, 152, 0, 0.1); padding: 8px; border-radius: 8px; border-left: 3px solid #FF9800;">
                          <span style="color: #FF9800; font-weight: bold;">وقت
                            الانتهاء
                            المحدد:</span>
                          <span style="color: #FF9800; font-weight: bold;">
                            11:33 AM                          </span>
                        </div>
                        <div class="session-detail"
                          style="background: rgba(255, 152, 0, 0.1); padding: 8px; border-radius: 8px; border-left: 3px solid #FF9800;">
                          <span style="color: #FF9800; font-weight: bold;">المدة
                            المتبقية:</span>
                          <span style="color: #FF9800; font-weight: bold;"
                            id="remaining-time-14587"
                            data-end-time="1780302787000"
                            data-session-id="14587">
                            0 ساعة 27 دقيقة                          </span>
                        </div>
                      
                      <div class="session-detail">
                        <span>نوع الجهاز:</span>
                        <span>PS4</span>
                      </div>

                      <!-- أزرار التبديل بين الوضع الفردي والجماعي -->
                      <div class="session-detail">
                        <span>نوع الجلسة:</span>
                        <div
                          style="display: flex; gap: 8px; flex-wrap: wrap; margin-top: 5px;">
                          <form method="POST" action="" style="display: inline;">
                            <input type="hidden" name="action"
                              value="switch_session_type">
                            <input type="hidden" name="session_id"
                              value="14587">
                            <input type="hidden" name="session_type"
                              value="individual">
                            <button type="submit"
                              style="background: #4CAF50;
                           color: white;
                           border: none; padding: 6px 12px; border-radius: 4px; font-size: 12px; cursor: pointer;"
                              disabled>
                              فردي
                            </button>
                          </form>

                          <form method="POST" action="" style="display: inline;">
                            <input type="hidden" name="action"
                              value="switch_session_type">
                            <input type="hidden" name="session_id"
                              value="14587">
                            <input type="hidden" name="session_type" value="group">
                            <button type="submit"
                              style="background: #E0E0E0;
                           color: #666;
                           border: none; padding: 6px 12px; border-radius: 4px; font-size: 12px; cursor: pointer;"
                              >
                              جماعي
                            </button>
                          </form>
                        </div>
                      </div>

                      <div class="session-detail">
                        <span>السعر بالساعة
                          (فردي):</span>
                        <span>30.00                          جنيه</span>
                      </div>

                      <!-- إضافة سطرين منفصلين للسعر الجماعي والفردي -->
                      <div class="session-detail">
                        <span>إجمالي سعر المدة الجماعية:</span>
                        <span id="group-price-14587"
                          style="color: #FF9800; font-weight: bold;"
                          data-group-accumulated="0.00">
                          0.00 جنيه                        </span>
                      </div>

                      <div class="session-detail">
                        <span>إجمالي سعر المدة الفردية:</span>
                        <span id="individual-price-14587"
                          style="color: #2196F3; font-weight: bold;"
                          data-individual-accumulated="0.00">
                          11.50 جنيه                        </span>
                      </div>
                      <div class="session-detail">
                        <span>المبلغ الحالي:</span>
                        <span class="current-amount"
                          data-hourly-rate="30.00"
                          data-group-hourly-rate="30.00"
                          data-session-type="individual"
                          data-start-time="1780299732000"
                          data-status="active"
                          data-accumulated="4.00">
                          15.50                          جنيه                        </span>
                      </div>
                                              <div class="session-detail">
                          <span>المبلغ التراكمي (الغرف السابقة):</span>
                          <span style="color: #ff9800; font-weight: bold;"
                            id="accumulated-amount-14587">
                            4.00                            جنيه                          </span>
                        </div>
                                                                                          <div class="session-detail session-breakdown">
                          <span>تفاصيل المبلغ التراكمي:</span>
                          <div class="session-breakdown-list" style="max-height: inherit;">
                                                                                        <div class="session-breakdown-card">
                                <div class="session-breakdown-content">
                                  <strong>VIP1</strong>
                                  <span>نوع: جماعي</span>
                                  <span>مدة: 8 دقيقة</span>
                                  <span>من 10:33 AM إلى 10:42 AM</span>
                                  <span class="amount">مبلغ: 4.00 جنيه</span>
                                </div>
                              </div>
                                                      </div>
                        </div>
                                            <div class="session-detail">
                        <span>بدء الجلسة:</span>
                        <span>10:42 AM</span>
                      </div>
                    </div>

                    <!-- قسم الطلبات -->
                    <div class="session-orders">
                      <div class="flex items-center justify-between gap-3 mb-2">
                        <h4 class="m-0">الطلبات الحالية</h4>
                                                  <button type="button"
                            class="bg-gradient-to-r from-emerald-500 to-green-600 hover:from-emerald-600 hover:to-green-700 text-white text-sm font-bold px-3 py-2 rounded-xl shadow-lg transition flex items-center gap-2"
                            onclick="openSessionAddOrderModal(14587)"
                            aria-label="إضافة طلب للجلسة">
                            <i class="fas fa-plus"></i>
                            <span class="hidden sm:inline">إضافة طلب</span>
                          </button>
                                              </div>
                                                <div class="orders-list" id="orders-list-14587">
                                                          <div class="order-item">
                                <div class="order-name">
                                  اندومي                                                                  </div>
                                <div class="order-details">
                                  الكمية: 1 |
                                  السعر:
                                  15.00                                  جنيه                                </div>
                              </div>
                                                      </div>
                                                                  </div>

                    <!-- قسم تكلفة الطلبات -->
                    <div class="session-orders-cost">
                      
                      <div class="cost-details">
                        <div class="cost-item">
                          <span class="cost-label">تكلفة الطلبات:</span>
                          <span class="cost-value orders-cost"
                            id="orders-cost-14587">15.00                            جنيه</span>
                        </div>

                        <div class="cost-item">
                          <span class="cost-label">تكلفة الجلسة:</span>
                          <span class="cost-value session-cost"
                            id="session-cost-14587">15.50                            جنيه</span>
                        </div>

                        <div class="cost-item total-cost">
                          <span class="cost-label">إجمالي السعر:</span>
                          <span class="cost-value total-amount"
                            id="total-cost-14587">30.50                            جنيه</span>
                        </div>
                      </div>
                    </div>

                    <div class="session-actions">
                      <!-- تبديل الغرفة -->
                      <div style="display: inline-block; position: relative;">
                        <button type="button" class="btn btn-info switch-room-btn"
                          onclick="toggleSwitchRoomDropdown(14587, this)"
                          data-session-id="14587"
                          aria-haspopup="true" aria-expanded="false"
                          style="background: #2196F3; color: white; border: none;">
                          <i class="fas fa-sync-alt"></i>
                          تبديل الغرفة
                        </button>

                        <div id="switchRoomDropdown_14587"
                          class="switch-room-dropdown" style="display: none;"
                          role="menu" aria-label="قائمة الغرف المتاحة">
                          <div class="dropdown-header">
                            <span>اختر الغرفة الجديدة</span>
                            <button type="button" class="dropdown-close"
                              onclick="closeSwitchRoomDropdown(14587)"
                              aria-label="إغلاق">
                              <i class="fas fa-times"></i>
                            </button>
                          </div>
                          <div class="dropdown-content">
                                                      </div>
                        </div>
                      </div>

                      <!-- زر تغيير نوع الجلسة -->


                      <!-- زر التوقف المؤقت -->
                      <button type="button" class="btn btn-pause"
                        onclick="togglePause(this)"
                        data-session-id="14587">
                        <i class="fas fa-pause"></i>
                        توقف مؤقت
                      </button>

                      
                                              <form id="endSessionForm_14587"
                          method="POST" action="" style="display: inline;">
                          <input type="hidden" name="action" value="end_session">
                          <input type="hidden" name="session_id"
                            value="14587">
                          <button type="button"
                            onclick="confirmEndSession(14587)"
                            class="btn btn-danger">
                            <i class="fas fa-stop"></i>
                            إنهاء الجلسة
                          </button>
                        </form>
                                          </div>
                  </div><!-- /.session-card -->
                </div><!-- /.session-details-content -->
              </div><!-- /.session-details-wrapper -->
            </div><!-- /.session-card-wrapper -->
                        </div>
    </div>

    <!-- سجل التغييرات -->
          <div class="card">
        <!-- Header قابل للنقر -->
        <div class="accordion-header" onclick="toggleLogsAccordion()" style="cursor: pointer; display: flex; justify-content: space-between; align-items: center; padding: 15px 0; border-bottom: 2px solid #e5e7eb; margin-bottom: 0;">
          <h3 style="margin: 0; display: flex; align-items: center; gap: 8px;">
            <i class="fas fa-history" style="color: #4CAF50;"></i>
            سجل التغييرات
          </h3>
          <button type="button" class="accordion-toggle" id="logsToggle" style="background: none; border: none; color: #667eea; font-size: 1.5rem; cursor: pointer; transition: transform 0.3s ease; transform: rotate(0deg);">
            <i class="fas fa-chevron-down"></i>
          </button>
        </div>

        <!-- المحتوى - مخفي بشكل افتراضي -->
        <div id="logsContent" style="max-height: 0; overflow: hidden; opacity: 0; transition: max-height 0.4s ease, opacity 0.3s ease, margin-top 0.3s ease;"">
          <!-- معلومات وأزرار التحكم -->
          <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px; padding: 0 5px;">
            <div style="display: flex; gap: 10px; align-items: center;">
              <small style="color: #888;">يتم تحديث السجل تلقائياً كل 24 ساعة</small>
              <small style="color: #4CAF50; font-weight: bold;">(جميع التغييرات - 5 تغيير)</small>
            </div>
                          <form id="clearLogsForm" method="POST" action="" style="display: inline;">
                <input type="hidden" name="action" value="clear_logs">
                <button type="button" onclick="confirmClearLogs()"
                  class="btn btn-danger btn-small">
                  <i class="fas fa-trash"></i>
                  حذف السجل
                </button>
              </form>
                      </div>

                  <!-- حاوية التمرير لسجل التغييرات -->
          <div class="logs-container"
            style="max-height: 500px; overflow-y: auto; border-radius: 8px; padding: 15px; scrollbar-width: thin;">
            <style>
              /* تخصيص شريط التمرير المحسن */
              div::-webkit-scrollbar {
                width: 10px;
              }

              div::-webkit-scrollbar-track {
                background: #2a2a2a;
                border-radius: 5px;
                border: 1px solid #444;
              }

              div::-webkit-scrollbar-thumb {
                background: linear-gradient(45deg, #4CAF50, #45a049);
                border-radius: 5px;
                border: 1px solid #333;
              }

              div::-webkit-scrollbar-thumb:hover {
                background: linear-gradient(45deg, #45a049, #3d8b40);
                box-shadow: 0 0 5px rgba(76, 175, 80, 0.5);
              }

              div::-webkit-scrollbar-corner {
                background: #2a2a2a;
              }
            </style>
                          <div class="log-item"
                style="border-radius: 8px; padding: 15px; margin-bottom: 10px; border-left: 4px solid #4CAF50;">
                <div
                  style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 8px;">
                  <div class="log-time" style="color: #4CAF50; font-weight: bold;">
                    2026-06-01 10:49:30                  </div>
                  <div class="log-user" style="color: #2196F3; font-size: 0.9em;">
                    admin_mahmoud_atef                  </div>
                </div>

                <div class="log-action"
                  style="font-weight: bold; margin-bottom: 8px;">
                  بدء جلسة                </div>

                <div class="log-details" style="font-size: 0.9em;">
                  <div style="margin-bottom: 5px;">
                    <strong>الغرفة:</strong>
                    VIP1                  </div>

                  
                                  </div>
              </div>
                          <div class="log-item"
                style="border-radius: 8px; padding: 15px; margin-bottom: 10px; border-left: 4px solid #4CAF50;">
                <div
                  style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 8px;">
                  <div class="log-time" style="color: #4CAF50; font-weight: bold;">
                    2026-06-01 10:42:12                  </div>
                  <div class="log-user" style="color: #2196F3; font-size: 0.9em;">
                    admin_mahmoud_atef                  </div>
                </div>

                <div class="log-action"
                  style="font-weight: bold; margin-bottom: 8px;">
                  تبديل غرفة                </div>

                <div class="log-details" style="font-size: 0.9em;">
                  <div style="margin-bottom: 5px;">
                    <strong>الغرفة:</strong>
                    VIP2                  </div>

                  
                                      <div style="margin-top: 8px;">
                      <strong>التغيير:</strong> من
                      الغرفة 471 (سعر: 30.00 جنيه/ساعة)                      إلى الغرفة 472 (سعر: 30.00 جنيه/ساعة) - نوع الجلسة: فردي - المبلغ التراكمي: 4.00 جنيه                    </div>
                                  </div>
              </div>
                          <div class="log-item"
                style="border-radius: 8px; padding: 15px; margin-bottom: 10px; border-left: 4px solid #4CAF50;">
                <div
                  style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 8px;">
                  <div class="log-time" style="color: #4CAF50; font-weight: bold;">
                    2026-06-01 10:33:37                  </div>
                  <div class="log-user" style="color: #2196F3; font-size: 0.9em;">
                    admin_mahmoud_atef                  </div>
                </div>

                <div class="log-action"
                  style="font-weight: bold; margin-bottom: 8px;">
                  order_add_food                </div>

                <div class="log-details" style="font-size: 0.9em;">
                  <div style="margin-bottom: 5px;">
                    <strong>الغرفة:</strong>
                    VIP2                  </div>

                  
                                  </div>
              </div>
                          <div class="log-item"
                style="border-radius: 8px; padding: 15px; margin-bottom: 10px; border-left: 4px solid #4CAF50;">
                <div
                  style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 8px;">
                  <div class="log-time" style="color: #4CAF50; font-weight: bold;">
                    2026-06-01 10:33:13                  </div>
                  <div class="log-user" style="color: #2196F3; font-size: 0.9em;">
                    admin_mahmoud_atef                  </div>
                </div>

                <div class="log-action"
                  style="font-weight: bold; margin-bottom: 8px;">
                  تغيير نوع الجلسة                </div>

                <div class="log-details" style="font-size: 0.9em;">
                  <div style="margin-bottom: 5px;">
                    <strong>الغرفة:</strong>
                    VIP2                  </div>

                  
                                      <div style="margin-top: 8px;">
                      <strong>التغيير:</strong> من
                      الوضع فردي (سعر: 30.00 جنيه/ساعة)                      إلى الوضع جماعي (سعر: 30.00 جنيه/ساعة) - المبلغ التراكمي: 0.00 جنيه                    </div>
                                  </div>
              </div>
                          <div class="log-item"
                style="border-radius: 8px; padding: 15px; margin-bottom: 10px; border-left: 4px solid #4CAF50;">
                <div
                  style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 8px;">
                  <div class="log-time" style="color: #4CAF50; font-weight: bold;">
                    2026-06-01 10:33:07                  </div>
                  <div class="log-user" style="color: #2196F3; font-size: 0.9em;">
                    admin_mahmoud_atef                  </div>
                </div>

                <div class="log-action"
                  style="font-weight: bold; margin-bottom: 8px;">
                  بدء جلسة                </div>

                <div class="log-details" style="font-size: 0.9em;">
                  <div style="margin-bottom: 5px;">
                    <strong>الغرفة:</strong>
                    VIP2                  </div>

                  
                                  </div>
              </div>
                      </div> <!-- إغلاق حاوية التمرير -->
                </div> <!-- إغلاق logsContent -->
      </div>
      </div>
  </div><!-- /page-wrapper -->

  <script>
    const CURRENCY_SYMBOL = 'جنيه';

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

    // اعتراض روابط الخروج المباشرة
    document.addEventListener('DOMContentLoaded', function() {
      document.querySelectorAll('a[href$="logout.php"]').forEach(a => {
        a.addEventListener('click', function(e) {
          e.preventDefault();
          attemptLogout();
        });
      });
    });
    // ✅ متغيرات الصلاحيات
    const canView = true;
    const canStartEnd = true;
    const canExtend = true;
    const canContinue = true;
    const canViewLogs = true;
    const canDeleteLogs = true;

    // دالة تغيير حالة الزر
    function togglePause(button) {
      const sessionId = button.getAttribute('data-session-id');
      const sessionCard = button.closest('.session-card');
      const timerDisplay = sessionCard.querySelector('.timer-display');
      const currentAmount = sessionCard.querySelector('.current-amount');

      if (!button.classList.contains('resumed')) {
        // الحالة: نشطة → توقف مؤقت
        button.innerHTML = '<i class="fas fa-stop"></i> تكلمه الجلسه';
        button.classList.add('resumed');

        // تعليق العداد والمبلغ
        timerDisplay.classList.add('paused');
        currentAmount.classList.add('paused');

        // حفظ وقت التوقف الحالي (ms مطلقة من السيرفر - مستقل عن المنطقة الزمنية)
        localStorage.setItem('pause_time_' + sessionId, getCorrectTime().toString());

        // حفظ الحالة في localStorage
        localStorage.setItem('pause_state_' + sessionId, 'paused');
      } else {
        button.innerHTML = '<i class="fas fa-pause"></i> توقف مؤقت';
        button.classList.remove('resumed');

        // إلغاء تعليق العداد والمبلغ
        timerDisplay.classList.remove('paused');
        currentAmount.classList.remove('paused');

        // ✅ اقرأ وقت التوقف أولاً قبل مسحه ثم أرسله للدالة مباشرة
        const savedPauseTime = localStorage.getItem('pause_time_' + sessionId);
        localStorage.removeItem('pause_time_' + sessionId);
        localStorage.setItem('pause_state_' + sessionId, 'active');

        resumeCalculation(timerDisplay, currentAmount, savedPauseTime);
      }
    }

    // دالة استكمال الاحتساب — تستقبل pauseTimeRaw مباشرة لتجنب مشكلة المسح المبكر
    function resumeCalculation(timerDisplay, currentAmount, pauseTimeRaw) {
      if (!pauseTimeRaw) return;

      // دعم القيم القديمة (ISO string) والجديدة (ms رقم)
      const pauseTimeMs = isNaN(Number(pauseTimeRaw))
        ? new Date(pauseTimeRaw).getTime()
        : parseInt(pauseTimeRaw);

      // وقت البداية الأصلي للجلسة
      const oldStartTime = parseInt(timerDisplay.dataset.startTime);

      // المدة الحقيقية حتى لحظة التوقف
      const elapsedAtPause = pauseTimeMs - oldStartTime;

      // ✅ وقت البداية الجديد = الآن - المدة حتى التوقف
      // النتيجة: setInterval سيحسب الفرق الصحيح بدون إضافة مدة التوقف
      const newStartTime = getCorrectTime() - elapsedAtPause;
      timerDisplay.dataset.startTime = newStartTime.toString();
      currentAmount.dataset.startTime = newStartTime.toString();

      // عرض الوقت الصحيح فوراً (نفس ما كان قبل التوقف)
      const h = Math.floor(elapsedAtPause / (1000 * 60 * 60));
      const m = Math.floor((elapsedAtPause % (1000 * 60 * 60)) / (1000 * 60));
      const s = Math.floor((elapsedAtPause % (1000 * 60)) / 1000);
      timerDisplay.querySelector('.timer-hours').textContent   = h.toString().padStart(2, '0');
      timerDisplay.querySelector('.timer-minutes').textContent = m.toString().padStart(2, '0');
      timerDisplay.querySelector('.timer-seconds').textContent = s.toString().padStart(2, '0');

      // عرض المبلغ الصحيح فوراً (نفس ما كان قبل التوقف)
      const hourlyRate = parseFloat(currentAmount.dataset.hourlyRate);
      const accumulated = parseFloat(currentAmount.dataset.accumulated) || 0;
      const currentAmountValue = (elapsedAtPause / (1000 * 60 * 60)) * hourlyRate;
      currentAmount.textContent = (accumulated + currentAmountValue).toFixed(2) + ' ' + CURRENCY_SYMBOL;

      // تأثير بصري للاستئناف
      timerDisplay.classList.add('resumed');
      currentAmount.classList.add('resumed');
      setTimeout(() => {
        timerDisplay.classList.remove('resumed');
        currentAmount.classList.remove('resumed');
      }, 3000);
    }

    // دالة استعادة حالة الزر
    function restorePauseState(button) {
      const sessionId = button.getAttribute('data-session-id');
      const savedState = localStorage.getItem('pause_state_' + sessionId);
      const sessionCard = button.closest('.session-card');
      const timerDisplay = sessionCard.querySelector('.timer-display');
      const currentAmount = sessionCard.querySelector('.current-amount');

      if (savedState === 'paused') {
        button.innerHTML = '<i class="fas fa-stop"></i> تكلمه الجلسه';
        button.classList.add('resumed');
        timerDisplay.classList.add('paused');
        currentAmount.classList.add('paused');

        // استعادة وقت التوقف
        const pauseTime = localStorage.getItem('pause_time_' + sessionId);
        if (pauseTime) {
          // حساب الوقت المنقضي حتى لحظة التوقف (ms مطلقة - مستقل عن المنطقة الزمنية)
          const startTime = parseInt(timerDisplay.dataset.startTime);
          const pauseTimeDate = isNaN(Number(pauseTime)) ? new Date(pauseTime).getTime() : parseInt(pauseTime);
          const diff = pauseTimeDate - startTime;

          // تحديث العداد بالوقت المحفوظ
          const hours = Math.floor(diff / (1000 * 60 * 60));
          const minutes = Math.floor((diff % (1000 * 60 * 60)) / (1000 * 60));
          const seconds = Math.floor((diff % (1000 * 60)) / 1000);

          timerDisplay.querySelector('.timer-hours').textContent = hours
            .toString().padStart(2, '0');
          timerDisplay.querySelector('.timer-minutes').textContent = minutes
            .toString().padStart(2, '0');
          timerDisplay.querySelector('.timer-seconds').textContent = seconds
            .toString().padStart(2, '0');

          // تحديث المبلغ المحفوظ
          const hourlyRate = parseFloat(currentAmount.dataset.hourlyRate);
          const accumulated = parseFloat(currentAmount.dataset.accumulated) || 0;
          const diffMinutes = diff / (1000 * 60);
          const currentAmountValue = (diffMinutes / 60) * hourlyRate;
          const totalAmount = accumulated + currentAmountValue;

          currentAmount.textContent = totalAmount.toFixed(2) + ' ' + CURRENCY_SYMBOL;
        }
      } else {
        button.innerHTML = '<i class="fas fa-pause"></i> توقف مؤقت';
        button.classList.remove('resumed');
        timerDisplay.classList.remove('paused');
        currentAmount.classList.remove('paused');
      }
    }

    // ================================================================
    // نظام مزامنة الوقت مع السيرفر (Server Time Synchronization)
    // ================================================================
    let serverTimeOffset = 0; // الفرق بين وقت السيرفر والجهاز
    let isTimeSynced = false;

    // دالة الحصول على الوقت الصحيح (المصحح)
    function getCorrectTime() {
      return Date.now() + serverTimeOffset;
    }

    // تأثيرات تفاعلية
    document.addEventListener('DOMContentLoaded', function() {
      const cards = document.querySelectorAll(
        '.room-card, .session-card, .log-item');
      cards.forEach((card, index) => {
        card.style.opacity = '0';
        card.style.transform = 'translateY(30px)';

        setTimeout(() => {
          card.style.transition = 'all 0.6s ease';
          card.style.opacity = '1';
          card.style.transform = 'translateY(0)';
        }, index * 100);
      });

      // استعادة حالة أزرار التوقف المؤقت
      const pauseButtons = document.querySelectorAll('.btn-pause');
      pauseButtons.forEach(button => {
        restorePauseState(button);
      });

      // مزامنة وقت السيرفر
      async function syncServerTime() {
        try {
          const startRequest = Date.now();

          const response = await fetch('api/get-server-time.php', {
            method: 'GET',
            cache: 'no-cache'
          });

          const endRequest = Date.now();
          const roundTripTime = endRequest - startRequest;

          if (!response.ok) {
            throw new Error('Sync failed');
          }

          const data = await response.json();

          if (data.success) {
            // حساب الـ offset مع تعويض زمن الشبكة
            const networkDelay = roundTripTime / 2;
            const adjustedServerTime = data.server_time + networkDelay;
            serverTimeOffset = adjustedServerTime - Date.now();
            isTimeSynced = true;
          }
        } catch (error) {
          // Fallback: استخدام الوقت المحلي
          serverTimeOffset = 0;
          isTimeSynced = true;
        }
      }

      // إعادة المزامنة كل 5 دقائق لضمان الدقة
      setInterval(syncServerTime, 300000); // 5 دقائق

      // عداد الوقت المباشر (محسّن بالمزامنة)
      function updateTimers() {
        const timers = document.querySelectorAll('.timer-display');
        timers.forEach(timer => {
          // تخطي العدادات المتوقفة
          if (timer.classList.contains('paused')) {
            return;
          }

          // التحقق من وجود كلمة "مجمد" في الكارت
          const sessionCard = timer.closest('.session-card');
          if (sessionCard) {
            if (sessionCard.dataset.previewFinalizePending === '1') {
              return;
            }
            const frozenIndicator = sessionCard.querySelector(
              'span[style*="background: #f44336"]');
            if (frozenIndicator && frozenIndicator.textContent.includes(
                'مجمد')) {
              // تجميد العداد عند وجود كلمة "مجمد"
              return;
            }
          }

          const startTime = parseInt(timer.dataset.startTime); // ms منذ epoch (مستقل عن المنطقة الزمنية)
          const status = timer.dataset.status;

          // استخدام الوقت المصحح من السيرفر (ms مطلقة)
          const now = getCorrectTime();

          const diff = now - startTime;
          const hours = Math.floor(diff / (1000 * 60 * 60));
          const minutes = Math.floor((diff % (1000 * 60 * 60)) / (1000 *
            60));
          const seconds = Math.floor((diff % (1000 * 60)) / 1000);

          timer.querySelector('.timer-hours').textContent = hours
            .toString().padStart(2, '0');
          timer.querySelector('.timer-minutes').textContent = minutes
            .toString().padStart(2, '0');
          timer.querySelector('.timer-seconds').textContent = seconds
            .toString().padStart(2, '0');
        });
      }

      // تحديث المبلغ تلقائياً (كل ثانية)
      function updateAmounts() {
        const amounts = document.querySelectorAll('.current-amount');
        amounts.forEach(amount => {
          // تخطي المبالغ المتوقفة
          if (amount.classList.contains('paused')) {
            return;
          }

          // التحقق من وجود كلمة "مجمد" في الكارت
          const sessionCard = amount.closest('.session-card');
          if (sessionCard) {
            if (sessionCard.dataset.previewFinalizePending === '1') {
              return;
            }
            const frozenIndicator = sessionCard.querySelector(
              'span[style*="background: #f44336"]');
            if (frozenIndicator && frozenIndicator.textContent.includes(
                'مجمد')) {
              // تجميد عداد السعر عند وجود كلمة "مجمد"
              return;
            }
          }

          const startTime = parseInt(amount.dataset.startTime); // ms مطلقة
          const sessionType = amount.dataset.sessionType;
          const hourlyRate = parseFloat(amount.dataset.hourlyRate);
          const groupHourlyRate = parseFloat(amount.dataset
            .groupHourlyRate);
          const rate = sessionType === 'group' ? groupHourlyRate :
            hourlyRate;
          const accumulated = parseFloat(amount.dataset.accumulated) || 0;

          // استخدام الوقت المصحح من السيرفر (ms مطلقة)
          const now = getCorrectTime();

          // حساب الفرق بالساعات (بدقة عالية)
          const diffHours = (now - startTime) / (1000 * 60 * 60);
          const currentAmount = diffHours * rate;
          const totalAmount = accumulated + currentAmount;

          // تحديث فوري بدون تأثيرات بصرية
          amount.textContent = totalAmount.toFixed(2) + ' ' + CURRENCY_SYMBOL;

          // تحديث البيانات المخزنة للاستخدام في دوال أخرى
          amount.dataset.currentAmount = currentAmount.toFixed(2);
          amount.dataset.totalAmount = totalAmount.toFixed(2);
        });
      }

      // دالة تحديث التكلفة تلقائياً (كل ثانية)
      function updateSessionCosts() {
        const sessionCards = document.querySelectorAll('.session-card');
        sessionCards.forEach(card => {
          const sessionId = card.querySelector('.btn-pause')
            ?.getAttribute('data-session-id');
          if (!sessionId) return;

          if (card.dataset.previewFinalizePending === '1') {
            return;
          }

          // التحقق من وجود كلمة "مجمد" في الكارت
          const frozenIndicator = card.querySelector(
            'span[style*="background: #f44336"]');
          if (frozenIndicator && frozenIndicator.textContent.includes(
              'مجمد')) {
            // تجميد تحديث التكلفة عند وجود كلمة "مجمد"
            return;
          }

          const currentAmountElement = card.querySelector(
            '.current-amount');
          const sessionCostElement = card.querySelector(
            `#session-cost-${sessionId}`);
          const totalCostElement = card.querySelector(
            `#total-cost-${sessionId}`);

          if (currentAmountElement && sessionCostElement &&
            totalCostElement) {
            // استخدام البيانات المحدثة من updateAmounts
            const currentAmount = parseFloat(currentAmountElement.dataset
              .currentAmount) || 0;
            const accumulated = parseFloat(currentAmountElement.dataset
              .accumulated) || 0;
            const sessionCost = currentAmount + accumulated;

            // تحديث تكلفة الجلسة بدون تأثيرات بصرية
            sessionCostElement.textContent = sessionCost.toFixed(2) +
              ' ' + CURRENCY_SYMBOL;

            // الحصول على تكلفة الطلبات (إذا كانت موجودة)
            const ordersCostElement = card.querySelector(
              `#orders-cost-${sessionId}`);
            const ordersCost = ordersCostElement ? parseFloat(
                ordersCostElement.textContent.replace(/[^\d.]/g, '')) ||
              0 : 0;

            // حساب الإجمالي
            const totalCost = sessionCost + ordersCost;

            // تحديث الإجمالي بدون تأثيرات بصرية
            totalCostElement.textContent = totalCost.toFixed(2) + ' ' + CURRENCY_SYMBOL;
          }
        });
      }

      // حفظ نوع الجلسة في localStorage لمنع فقدان البيانات عند إعادة التحميل
      function saveSessionType(sessionId, sessionType) {
        localStorage.setItem(`session_type_${sessionId}`, sessionType);
      }

      function getSessionType(sessionId) {
        return localStorage.getItem(`session_type_${sessionId}`);
      }

      // استعادة نوع الجلسة عند إعادة التحميل
      function restoreSessionTypes() {
        const sessionCards = document.querySelectorAll('.session-card');
        sessionCards.forEach(card => {
          const sessionId = card.querySelector('.btn-pause')
            ?.getAttribute('data-session-id');
          if (!sessionId) return;

          const savedType = getSessionType(sessionId);
          if (savedType) {
            // تحديث نوع الجلسة في الواجهة
            const currentAmountElement = card.querySelector(
              '.current-amount');
            if (currentAmountElement) {
              currentAmountElement.dataset.sessionType = savedType;
            }
          }
        });
      }

      // إضافة مستمعي الأحداث لأزرار التبديل
      document.addEventListener('DOMContentLoaded', function() {
        // إضافة مستمعي الأحداث لأزرار التبديل
        const switchButtons = document.querySelectorAll(
          'button[type="submit"]');
        switchButtons.forEach(button => {
          const form = button.closest('form');
          if (form && form.querySelector(
              'input[name="action"][value="switch_session_type"]')) {
            button.addEventListener('click', function() {
              const sessionId = form.querySelector(
                'input[name="session_id"]').value;
              const sessionType = form.querySelector(
                'input[name="session_type"]').value;
              saveSessionType(sessionId, sessionType);
            });
          }
        });
      });

      // تحديث السعر الجماعي والفردي
      function updateSessionPrices() {
        const sessionCards = document.querySelectorAll('.session-card');
        sessionCards.forEach(card => {
          const sessionId = card.querySelector('.btn-pause')
            ?.getAttribute('data-session-id');
          if (!sessionId) return;

          if (card.dataset.previewFinalizePending === '1') {
            return;
          }

          // التحقق من وجود كلمة "مجمد" في الكارت
          const frozenIndicator = card.querySelector(
            'span[style*="background: #f44336"]');
          if (frozenIndicator && frozenIndicator.textContent.includes(
              'مجمد')) {
            // تجميد تحديث الأسعار عند وجود كلمة "مجمد"
            return;
          }

          const currentAmountElement = card.querySelector(
            '.current-amount');
          if (!currentAmountElement) return;

          const sessionType = currentAmountElement.dataset.sessionType;
          const startTime = parseInt(currentAmountElement.dataset
            .startTime); // ms مطلقة
          const hourlyRate = parseFloat(currentAmountElement.dataset
            .hourlyRate);
          const groupHourlyRate = parseFloat(currentAmountElement.dataset
            .groupHourlyRate);

          // استخدام الوقت المصحح من السيرفر (ms مطلقة)
          const now = getCorrectTime();
          const diffHours = (now - startTime) / (1000 * 60 * 60);

          // حساب السعر الحالي
          const currentPrice = diffHours * (sessionType === 'group' ?
            groupHourlyRate : hourlyRate);

          // تحديث السعر الجماعي (السعر التراكمي + السعر الحالي)
          const groupPriceElement = document.getElementById(
            `group-price-${sessionId}`);
          if (groupPriceElement) {
            const groupAccumulated = parseFloat(groupPriceElement.dataset
              .groupAccumulated) || 0;
            const groupCurrent = sessionType === 'group' ? currentPrice :
              0;
            const groupTotal = groupAccumulated + groupCurrent;
            groupPriceElement.textContent = groupTotal.toFixed(2) +
              ' ' + CURRENCY_SYMBOL;
          }

          // تحديث السعر الفردي (السعر التراكمي + السعر الحالي)
          const individualPriceElement = document.getElementById(
            `individual-price-${sessionId}`);
          if (individualPriceElement) {
            const individualAccumulated = parseFloat(
              individualPriceElement.dataset.individualAccumulated) || 0;
            const individualCurrent = sessionType === 'individual' ?
              currentPrice : 0;
            const individualTotal = individualAccumulated +
              individualCurrent;
            individualPriceElement.textContent = individualTotal.toFixed(
              2) + ' ' + CURRENCY_SYMBOL;
          }
        });
      }

      // ================================================================
      // تهيئة نظام الوقت
      // ================================================================

      // مزامنة أولية مع السيرفر
      syncServerTime().then(() => {
        // بعد المزامنة، تشغيل فوري للعدادات
        updateTimers();
        updateAmounts();
        updateSessionCosts();
        updateSessionPrices();
      });

      // تحديث العدادات والسعر كل ثانية
      setInterval(() => {
        // فحص إذا كان العداد متوقف
        if (window.countersPaused) {
          return;
        }

        // انتظار المزامنة الأولية
        if (!isTimeSynced) {
          return;
        }

        updateTimers();
        updateAmounts();
        updateSessionCosts();
        updateSessionPrices();
      }, 1000);

      // استعادة أنواع الجلسات
      restoreSessionTypes();

      // ================================================================
      // تحديث المدة المتبقية للجلسات المحدودة (محسّن ومتزامن مع السيرفر)
      // ================================================================
      function updateRemainingTime() {
        try {
          const remainingElements = document.querySelectorAll(
            '[id^="remaining-time-"]');

          // إذا لم يوجد عناصر، لا تفعل شيئاً
          if (!remainingElements || remainingElements.length === 0) {
            return;
          }

          remainingElements.forEach(element => {
            const sessionId = element.id.replace('remaining-time-', '');

            const previewCard = document.querySelector(
              '.session-card[data-session-id="' + sessionId + '"]');
            if (previewCard && previewCard.dataset.previewFinalizePending === '1') {
              return;
            }

            // الحصول على وقت الانتهاء من الـ data attribute (بصيغة timestamp)
            const endTimeStr = element.dataset.endTime;
            if (!endTimeStr) return; // تخطي إذا لم يوجد وقت انتهاء

            // ms مطلقة (مستقل عن المنطقة الزمنية)
            const endTime = parseInt(endTimeStr);

            // استخدام الوقت المصحح من السيرفر (متزامن)
            const now = getCorrectTime();

            if (endTime > now) {
              const diff = endTime - now;
              const hours = Math.floor(diff / (1000 * 60 * 60));
              const minutes = Math.floor((diff % (1000 * 60 * 60)) / (
                1000 * 60));
              const seconds = Math.floor((diff % (1000 * 60)) / 1000);

              let timeText = '';
              if (hours > 0) {
                timeText += hours + ' ساعة ';
              }
              if (minutes > 0 || hours > 0) {
                timeText += minutes + ' دقيقة ';
              }
              // إضافة الثواني للدقة الأعلى
              if (hours === 0 && minutes < 5) {
                timeText += seconds + ' ثانية';
              }

              element.textContent = timeText.trim();

              // تغيير اللون حسب الوقت المتبقي
              if (hours === 0 && minutes < 1) {
                element.style.color =
                  '#f44336'; // أحمر قوي (أقل من دقيقة)
              } else if (hours === 0 && minutes <= 5) {
                element.style.color = '#ff6b6b'; // أحمر للوقت القليل
              } else if (hours === 0 && minutes <= 15) {
                element.style.color = '#ffa726'; // برتقالي للتحذير
              } else {
                element.style.color = '#FF9800'; // برتقالي عادي
              }
            } else {
              element.textContent = 'انتهت';
              element.style.color = '#f44336';
              element.style.fontWeight = 'bold';
            }
          });
        } catch (error) {
          // تجاهل الأخطاء بصمت لعدم تعطيل باقي الأكواد
        }
      }

      // تحديث المدة المتبقية كل ثانية (عداد تنازلي حي)
      setInterval(() => {
        // فحص إذا كان العداد متوقف
        if (window.countersPaused) {
          return;
        }

        // انتظار المزامنة الأولية (مع حماية)
        if (typeof isTimeSynced !== 'undefined' && !isTimeSynced) {
          return;
        }

        updateRemainingTime();
      }, 1000); // كل ثانية بدلاً من دقيقة

      // تشغيل فوري (بعد تأخير صغير للتأكد من تهيئة الصفحة)
      setTimeout(() => {
        updateRemainingTime();
      }, 100);
    });

    // ===== اختيار نوع الجلسة (فردي / جماعي) قبل البدء / التبديل =====
    function openSessionTypePicker({
      title = 'اختر نوع الجلسة',
      subtitle = 'حدد فردي أو جماعي قبل المتابعة',
      defaultType = 'individual'
    } = {}) {
      return new Promise((resolve) => {
        const existing = document.getElementById('sessionTypePickerModal');
        if (existing) existing.remove();

        const overlay = document.createElement('div');
        overlay.id = 'sessionTypePickerModal';
        overlay.className =
          'fixed inset-0 z-[99999] bg-black/70 backdrop-blur-sm flex items-center justify-center p-3 sm:p-4';

        const close = (result = null) => {
          try {
            document.removeEventListener('keydown', onKeyDown);
          } catch (e) {}
          overlay.remove();
          resolve(result);
        };

        const onKeyDown = (e) => {
          if (e.key === 'Escape') close(null);
        };
        document.addEventListener('keydown', onKeyDown);

        overlay.addEventListener('click', (e) => {
          if (e.target === overlay) close(null);
        });

        const isInd = defaultType !== 'group';
        overlay.innerHTML = `
          <div class="w-full max-w-md bg-gradient-to-br from-slate-900 via-slate-800 to-slate-900 border border-white/10 rounded-3xl shadow-2xl overflow-hidden">
            <div class="p-3 sm:p-4 bg-gradient-to-r from-emerald-600 to-green-700 text-white">
              <div class="flex items-center justify-between gap-3">
                <div class="min-w-0">
                  <div class="text-base sm:text-lg font-extrabold leading-tight">${title}</div>
                  <div class="text-white/80 text-xs sm:text-sm mt-1">${subtitle}</div>
                </div>
                <button type="button" class="w-8 h-8 sm:w-9 sm:h-9 rounded-full bg-white/15 hover:bg-white/20 transition flex items-center justify-center flex-shrink-0" aria-label="إغلاق">
                  <i class="fas fa-times text-sm"></i>
                </button>
              </div>
            </div>
            <div class="p-3 sm:p-4">
              <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                <button type="button" data-type="individual"
                  class="p-4 rounded-2xl border border-white/10 ${isInd ? 'bg-emerald-500/15 ring-2 ring-emerald-400/40' : 'bg-white/5 hover:bg-white/10'} transition text-right">
                  <div class="flex items-center justify-between gap-3">
                    <div class="min-w-0">
                      <div class="text-white font-extrabold text-base">فردي</div>
                      <div class="text-white/60 text-xs mt-1">سنجل</div>
                    </div>
                    <div class="w-10 h-10 rounded-2xl bg-emerald-500/15 flex items-center justify-center text-emerald-300 flex-shrink-0">
                      <i class="fas fa-user text-lg"></i>
                    </div>
                  </div>
                </button>
                <button type="button" data-type="group"
                  class="p-4 rounded-2xl border border-white/10 ${!isInd ? 'bg-sky-500/15 ring-2 ring-sky-400/40' : 'bg-white/5 hover:bg-white/10'} transition text-right">
                  <div class="flex items-center justify-between gap-3">
                    <div class="min-w-0">
                      <div class="text-white font-extrabold text-base">جماعي</div>
                      <div class="text-white/60 text-xs mt-1">مالتي</div>
                    </div>
                    <div class="w-10 h-10 rounded-2xl bg-sky-500/15 flex items-center justify-center text-sky-300 flex-shrink-0">
                      <i class="fas fa-users text-lg"></i>
                    </div>
                  </div>
                </button>
              </div>
              <div class="text-white/40 text-[11px] sm:text-xs mt-3">
                يمكنك تغيير النوع لاحقاً من داخل الجلسة أيضاً
              </div>
            </div>
          </div>
        `;

        document.body.appendChild(overlay);

        const closeBtn = overlay.querySelector('button[aria-label="إغلاق"]');
        if (closeBtn) closeBtn.addEventListener('click', () => close(null));

        overlay.querySelectorAll('button[data-type]').forEach((btn) => {
          btn.addEventListener('click', () => {
            const t = btn.getAttribute('data-type');
            close(t === 'group' ? 'group' : 'individual');
          });
        });
      });
    }

    function ensureHiddenSessionTypeInput(formEl) {
      if (!formEl) return null;
      let inp = formEl.querySelector('input[name="session_type"]');
      if (!inp) {
        inp = document.createElement('input');
        inp.type = 'hidden';
        inp.name = 'session_type';
        formEl.appendChild(inp);
      }
      return inp;
    }

    function startSessionWithType(formEl) {
      if (!formEl) return;
      openSessionTypePicker({
        title: 'قبل بدء الجلسة',
        subtitle: 'اختر (فردي / جماعي) ثم ابدأ الجلسة',
        defaultType: 'individual'
      }).then((type) => {
        if (!type) return;
        const inp = ensureHiddenSessionTypeInput(formEl);
        if (inp) inp.value = type;
        formEl.submit();
      });
    }

    function switchRoomWithType(formEl, currentType = 'individual') {
      if (!formEl) return;
      const def = (currentType === 'group') ? 'group' : 'individual';

      // اغلق قائمة تبديل الغرفة فوراً حتى لا تظهر فوق/خلف مودال اختيار النوع
      try {
        const sid = formEl.querySelector('input[name="session_id"]')?.value;
        if (sid) closeSwitchRoomDropdown(parseInt(sid, 10));
      } catch (e) {}

      openSessionTypePicker({
        title: 'قبل تبديل الغرفة',
        subtitle: 'اختر (فردي / جماعي) للغرفة الجديدة',
        defaultType: def
      }).then((type) => {
        if (!type) return;
        const inp = ensureHiddenSessionTypeInput(formEl);
        if (inp) inp.value = type;
        formEl.submit();
      });
    }

    // إدارة الجلسة المحدودة
    function openLimitedSessionModal(roomId) {
      openSessionTypePicker({
        title: 'قبل بدء الجلسة المحدودة',
        subtitle: 'اختر (فردي / جماعي) ثم حدّد المدة',
        defaultType: 'individual'
      }).then((type) => {
        if (!type) return;
        const roomEl = document.getElementById('limitedRoomId');
        const typeEl = document.getElementById('limitedSessionType');
        if (roomEl) roomEl.value = roomId;
        if (typeEl) typeEl.value = type;
      document.getElementById('limitedSessionModal').style.display = 'block';
      updateDurationPreview();
      });
    }

    function closeLimitedSessionModal() {
      document.getElementById('limitedSessionModal').style.display = 'none';
      const __sw = document.getElementById('immediateScreenOff');
      // إذا كان السويتش مُقفلاً (موظف)، نتركه كما هو — قيمته تُرسَل عبر الحقل المخفي
      if (__sw && !__sw.disabled) __sw.checked = false;
    }

    function updateDurationPreview() {
      const duration = document.getElementById('duration').value;
      const durationText = document.getElementById('durationText');

      if (duration < 1) {
        durationText.textContent = 'الحد الأدنى: دقيقة واحدة';
        durationText.style.color = '#ff6b6b';
      } else {
        const hours = Math.floor(duration / 60);
        const minutes = duration % 60;
        let text = '';

        if (hours > 0) {
          text += hours + ' ساعة ';
        }
        if (minutes > 0) {
          text += minutes + ' دقيقة';
        }

        durationText.textContent = 'المدة: ' + text;
        durationText.style.color = '#4CAF50';
      }
    }

    // تحديث معاينة المدة عند تغيير القيمة
    document.addEventListener('DOMContentLoaded', function() {
      const durationInput = document.getElementById('duration');
      if (durationInput) {
        durationInput.addEventListener('input', updateDurationPreview);
      }
    });

    // إغلاق Modal عند النقر خارجها
    window.onclick = function(event) {
      const modal = document.getElementById('limitedSessionModal');
      if (event.target == modal) {
        closeLimitedSessionModal();
      }
    }

    // إظهار كارت تفاصيل الجلسة الاحترافي
    function showSessionSummaryCard(sessionData, sessionId) {
      /* debug removed for production */

      // إشعار نظام الطابور بأن النظام مشغول
      if (window.NotificationQueue) {
        window.NotificationQueue.setBusyState(true);
      }

      const segments = (Array.isArray(sessionData.room_segments) ? sessionData.room_segments : [])
        .filter(segment => parseInt(segment.duration_minutes ?? 0, 10) >= 1);
      const formatSegmentTime = (value) => {
        if (!value) return '-';
        try {
          const normalized = value.replace(' ', 'T');
          const date = new Date(normalized);
          if (Number.isNaN(date.getTime())) {
            return value;
          }
          return date.toLocaleTimeString('ar-EG', {
            hour: '2-digit',
            minute: '2-digit'
          });
        } catch (error) {
          return value;
        }
      };
      const roomSegmentsHtml = segments.map(segment => {
        const roomName = segment.room_name_snapshot || (segment.room_id ? `الغرفة #${segment.room_id}` : 'غير معروفة');
        const typeLabel = segment.session_type === 'group' ? 'جماعي' : 'فردي';
        const duration = parseInt(segment.duration_minutes ?? 0, 10) || 0;
        const amount = Number(segment.amount ?? 0).toFixed(2);
        const startTime = formatSegmentTime(segment.start_time);
        const endTime = formatSegmentTime(segment.end_time);
        return `
          <div class="bg-orange-50 border border-orange-100 rounded-lg px-4 py-3 shadow-sm">
            <div class="flex flex-wrap gap-2 text-sm text-gray-600">
              <span class="font-bold text-orange-700">${roomName}</span>
              <span>نوع: ${typeLabel}</span>
              <span>مدة: ${duration} دقيقة</span>
              <span>من ${startTime} إلى ${endTime}</span>
              <span class="font-semibold text-orange-700">مبلغ: ${amount} ${CURRENCY_SYMBOL}</span>
            </div>
          </div>
        `;
      }).join('');

      // إنشاء HTML للكارت
      const cardHTML = `
      <div class="fixed inset-0 bg-black bg-opacity-60 flex items-center justify-center z-50 p-4" id="sessionSummaryModal" data-session-id="${sessionId}" style="position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.6); display: flex; align-items: center; justify-content: center; z-index: 20000;">
        <div class="bg-white rounded-3xl shadow-2xl w-full max-w-4xl max-h-[90vh] overflow-hidden transform transition-all duration-300 scale-100 animate-scaleIn" style="background: white; border-radius: 24px; box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25); width: 100%; max-width: 896px; max-height: 90vh; overflow: hidden; transform: scale(1); transition: all 0.3s;">
          <!-- Header -->
          <div class="bg-gradient-to-br from-emerald-500 via-teal-500 to-cyan-600 text-white p-8 relative overflow-hidden">
            <div class="absolute inset-0 bg-black bg-opacity-10"></div>
            <div class="relative z-10">
              <div class="flex items-center justify-between">
                <div class="flex items-center space-x-4 space-x-reverse">
                  <div class="w-16 h-16 bg-white bg-opacity-25 rounded-full flex items-center justify-center backdrop-blur-sm">
                    <i class="fas fa-check-circle text-3xl text-white"></i>
                  </div>
                  <div>
                    <h2 class="text-3xl font-bold mb-2">تم إنهاء الجلسة بنجاح</h2>
                    <p class="text-emerald-100 text-lg">تفاصيل الجلسة المكتملة</p>
                  </div>
                </div>
                <button onclick="closeSessionSummary()" class="text-white hover:text-gray-200 transition-all duration-300 hover:scale-110 bg-white bg-opacity-20 rounded-full p-3 backdrop-blur-sm">
                  <i class="fas fa-times text-xl"></i>
                </button>
              </div>
            </div>
            <!-- Decorative elements -->
            <div class="absolute top-0 right-0 w-32 h-32 bg-white bg-opacity-10 rounded-full -translate-y-16 translate-x-16"></div>
            <div class="absolute bottom-0 left-0 w-24 h-24 bg-white bg-opacity-10 rounded-full translate-y-12 -translate-x-12"></div>
          </div>

          <!-- Content -->
          <div class="p-8 overflow-y-auto max-h-[calc(90vh-200px)]">
            <!-- معلومات الجلسة والمدة -->
            <div class="bg-gradient-to-br ${isCafe ? 'from-amber-50 to-orange-100' : 'from-blue-50 to-indigo-100'} rounded-2xl p-6 border ${isCafe ? 'border-amber-200' : 'border-blue-200'} shadow-lg mb-8">
              <div class="flex items-center mb-4">
                <div class="w-10 h-10 ${isCafe ? 'bg-amber-500' : 'bg-blue-500'} rounded-full flex items-center justify-center mr-3">
                  <i class="fas ${isCafe ? 'fa-coffee' : 'fa-info-circle'} text-white"></i>
                </div>
                <h3 class="text-lg font-bold text-gray-800">${isCafe ? 'معلومات جلسة الكافيه' : 'معلومات الجلسة والمدة'}</h3>
              </div>
              <div class="grid grid-cols-2 md:grid-cols-3 ${isCafe ? 'lg:grid-cols-4' : 'lg:grid-cols-6'} gap-4">
                <div class="text-center">
                  <div class="text-sm text-gray-600 mb-1">رقم الجلسة</div>
                  <div class="font-bold text-blue-600">#${sessionId}</div>
                </div>
                <div class="text-center">
                  <div class="text-sm text-gray-600 mb-1">${isCafe ? 'النوع' : 'الغرفة'}</div>
                  <div class="font-bold text-gray-800">${sessionData.room_name || (isCafe ? 'كافيه' : 'غرفة ' + sessionId)}</div>
                </div>
                ${!isCafe ? `
                <div class="text-center">
                  <div class="text-sm text-gray-600 mb-1">نوع الجلسة</div>
                  <div class="font-bold text-purple-600">${sessionData.session_type === 'group' ? 'جماعي' : 'فردي'}</div>
                </div>
                <div class="text-center">
                  <div class="text-sm text-gray-600 mb-1">المدة</div>
                  <div class="font-bold text-green-600">${Math.round(sessionData.duration_hours || 0)}س ${Math.round((sessionData.duration_minutes || 0) % 60)}د</div>
                </div>
                <div class="text-center">
                  <div class="text-sm text-gray-600 mb-1">سعر الساعة</div>
                  <div class="font-bold text-blue-600">${Math.round(sessionData.hourly_rate || 0)} ${CURRENCY_SYMBOL}</div>
                </div>
                <div class="text-center">
                  <div class="text-sm text-gray-600 mb-1">الوقت</div>
                  <div class="font-bold text-gray-800">${new Date().toLocaleTimeString('ar-EG', {hour: '2-digit', minute: '2-digit'})}</div>
                </div>
                ` : `
                <div class="text-center">
                  <div class="text-sm text-gray-600 mb-1">وقت البداية</div>
                  <div class="font-bold text-gray-800">${sessionData.start_time ? new Date(sessionData.start_time).toLocaleTimeString('ar-EG', {hour: '2-digit', minute: '2-digit'}) : '-'}</div>
                </div>
                <div class="text-center">
                  <div class="text-sm text-gray-600 mb-1">وقت الانتهاء</div>
                  <div class="font-bold text-gray-800">${new Date().toLocaleTimeString('ar-EG', {hour: '2-digit', minute: '2-digit'})}</div>
                </div>
                `}
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
                ${!isCafe && sessionData.accumulated_amount > 0 ? `
                <div class="flex justify-between items-center py-4 border-b border-purple-200 bg-orange-50 rounded-lg px-4">
                  <div class="flex items-center">
                    <i class="fas fa-history text-orange-500 mr-3"></i>
                    <span class="text-gray-700 font-medium">المبلغ التراكمي (الغرف السابقة):</span>
                  </div>
                  <span class="text-orange-600 font-bold text-xl">${sessionData.accumulated_amount.toFixed(2)} ${CURRENCY_SYMBOL}</span>
                </div>
                ` : ''}

                ${!isCafe && roomSegmentsHtml ? `
                <div class="space-y-3 bg-white/70 rounded-xl border border-orange-200 px-4 py-4">
                  <div class="flex items-center gap-2 text-orange-600 font-semibold">
                    <i class="fas fa-list-alt"></i>
                    <span>تفاصيل المقاطع التراكمية:</span>
                  </div>
                  <div class="space-y-2">
                    ${roomSegmentsHtml}
                  </div>
                </div>
                ` : ''}

                ${!isCafe ? `
                <div class="flex justify-between items-center py-4 border-b border-purple-200 bg-blue-50 rounded-lg px-4">
                  <div class="flex items-center">
                    <i class="fas fa-clock text-blue-500 mr-3"></i>
                    <span class="text-gray-700 font-medium">مبلغ الجلسة الحالية:</span>
                  </div>
                  <span class="text-blue-600 font-bold text-xl">${(sessionData.current_amount || 0).toFixed(2)} ${CURRENCY_SYMBOL}</span>
                </div>

                <div class="flex justify-between items-center py-4 border-b border-purple-200 bg-purple-50 rounded-lg px-4">
                  <div class="flex items-center">
                    <i class="fas fa-plus-circle text-purple-500 mr-3"></i>
                    <span class="text-gray-700 font-medium">إجمالي مبلغ الجلسة:</span>
                    ${sessionData.discount_amount > 0 ? `
                      <span style="display:flex;margin-right:8px;background:#f3e8ff;color:#7c3aed;padding:4px 10px;border-radius:8px;font-size:0.8rem;font-weight:600;align-items:center;gap:4px;">
                        <i class="fas fa-tag" style="font-size:0.75rem;"></i>
                        <span>خصم ${sessionData.discount_type === 'percentage' ? sessionData.discount_input + '%' : sessionData.discount_amount.toFixed(2) + ' ' + CURRENCY_SYMBOL}</span>
                      </span>
                    ` : ''}
                  </div>
                  <span class="text-purple-600 font-bold text-xl">${(sessionData.session_amount || 0).toFixed(2)} ${CURRENCY_SYMBOL}</span>
                </div>
                ` : ''}

                ${(sessionData.orders_cost || 0) > 0 ? `
                <div class="flex justify-between items-center py-4 bg-green-50 rounded-lg px-4">
                  <div class="flex items-center">
                    <i class="fas ${isCafe ? 'fa-coffee' : 'fa-shopping-cart'} text-green-500 mr-3"></i>
                    <span class="text-gray-700 font-medium">${isCafe ? 'إجمالي الطلبات' : 'تكلفة الطلبات'}:</span>
                  </div>
                  <span class="text-green-600 font-bold text-xl">${sessionData.orders_cost.toFixed(2)} ${CURRENCY_SYMBOL}</span>
                </div>
                ` : ''}
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
                <h3 class="text-2xl font-bold mb-4">
                  ${sessionData.discount_amount > 0 ? '<i class="fas fa-tag mr-2"></i>الإجمالي النهائي بعد الخصم' : 'الإجمالي النهائي'}
                </h3>
                ${sessionData.discount_amount > 0 ? `
                  <div style="font-size:1rem; margin-bottom:6px; color:#fde68a; display:flex; align-items:center; justify-content:center; gap:6px; opacity:0.75;">
                    <span style="text-decoration:line-through; font-weight:400; font-size:0.95rem;">
                      ${sessionData.base_total ? sessionData.base_total.toFixed(2) : sessionData.total_amount.toFixed(2)} ${CURRENCY_SYMBOL}
                    </span>
                  </div>
                ` : ''}
                <div class="text-5xl font-bold mb-3 text-shadow-lg">${sessionData.total_amount.toFixed(2)} ${CURRENCY_SYMBOL}</div>
                ${sessionData.discount_amount > 0 ? `
                  <div style="font-size:0.9rem; margin-top:8px; background:rgba(255,255,255,0.2); border-radius:12px; padding:6px 16px; display:flex; align-items:center; justify-content:center; gap:8px; border:1px solid rgba(255,255,255,0.3);">
                    <i class="fas fa-tag" style="color:#fef08a; font-size:0.85rem;"></i>
                    <span style="color:#fef08a; font-weight:600;">
                      خصم: ${sessionData.discount_amount.toFixed(2)} ${CURRENCY_SYMBOL}
                      ${sessionData.discount_type === 'percentage' ? ` (${sessionData.discount_input}%)` : ''}
                    </span>
                  </div>
                ` : ''}
                <p class="text-emerald-100 text-xl">شكراً لاستخدامك خدماتنا</p>
              </div>
              <!-- Decorative elements -->
              <div class="absolute top-0 right-0 w-40 h-40 bg-white bg-opacity-10 rounded-full -translate-y-20 translate-x-20"></div>
              <div class="absolute bottom-0 left-0 w-32 h-32 bg-white bg-opacity-10 rounded-full translate-y-16 -translate-x-16"></div>
            </div>
          </div>

          <!-- Footer -->
          <div style="padding-top: 6px;" class="bg-gradient-to-r from-gray-50 to-gray-100 px-3 sm:px-8 py-4 sm:py-6 border-t border-gray-200 mb-4">
            <!-- Grid Layout للأزرار - responsive (3 أزرار) -->
            <div class="grid grid-cols-3 gap-2 sm:gap-3">
              <!-- زر التراجع عن الإنتهاء (X) -->
              <button onclick="revertSessionEnding()" id="btnRevertSession" class="px-3 sm:px-6 py-2.5 sm:py-3 bg-red-500 text-white rounded-lg sm:rounded-xl hover:bg-red-600 transition-all duration-300 hover:scale-105 shadow-lg font-medium text-sm sm:text-base flex items-center justify-center">
                <i class="fas fa-times ml-1 sm:ml-2"></i>
                <span class="hidden xs:inline">تراجع</span>
              </button>

              <!-- زر الطباعة -->
                            <button onclick="showPrintOptionsModal()" class="px-3 sm:px-6 py-2.5 sm:py-3 bg-gradient-to-r from-blue-500 to-blue-600 text-white rounded-lg sm:rounded-xl hover:from-blue-600 hover:to-blue-700 transition-all duration-300 hover:scale-105 shadow-lg font-medium text-sm sm:text-base flex items-center justify-center">
                <i class="fas fa-print ml-1 sm:ml-2"></i>
                <span class="hidden xs:inline">طباعة</span>
              </button>
              
              <!-- زر تأكيد الإنتهاء -->
              <button onclick="confirmAndFinalizeSession()" id="btnFinalizeSession" class="px-3 sm:px-6 py-2.5 sm:py-3 bg-gradient-to-r from-emerald-500 to-emerald-600 text-white rounded-lg sm:rounded-xl hover:from-emerald-600 hover:to-emerald-700 transition-all duration-300 hover:scale-105 shadow-lg font-medium text-sm sm:text-base flex items-center justify-center">
                <i class="fas fa-check-circle ml-1 sm:ml-2"></i>
                <span class="hidden xs:inline">تأكيد الإنتهاء</span>
                <span class="xs:hidden">تأكيد</span>
              </button>
            </div>
          </div>
        </div>
      </div>
    `;

      // حفظ sessionId وبيانات الجلسة في متغيرات عامة
      window.currentSessionId = sessionId;
      window.sessionSummaryData = sessionData;
      /* debug removed for production */

      // إضافة CSS للكارت
      const style = document.createElement('style');
      style.textContent = `
      #sessionSummaryModal {
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
      }

      /* إصلاح z-index لـ SweetAlert2 */
      .swal2-container {
        z-index: 19999 !important;
      }

      .swal2-backdrop {
        z-index: 19998 !important;
      }

      /* التأكد من أن كارت الإيصال أعلى من SweetAlert */
      #sessionSummaryModal {
        z-index: 20000 !important;
      }

      #sessionSummaryModal * {
        z-index: 20001 !important;
      }
      #sessionSummaryModal .modal-content {
        background: white !important;
        border-radius: 24px !important;
        box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25) !important;
        width: 100% !important;
        max-width: 896px !important;
        max-height: 90vh !important;
        overflow: hidden !important;
        transform: scale(1) !important;
        transition: all 0.3s !important;
      }
    `;
      document.head.appendChild(style);

      // إضافة الكارت إلى الصفحة
      document.body.insertAdjacentHTML('beforeend', cardHTML);

      /* debug removed for production */

      // التحقق من وجود الكارت
      const modal = document.getElementById('sessionSummaryModal');
      if (modal) {
        /* debug removed for production */
        modal.style.display = 'flex';
      } else {
        /* debug removed for production */
      }

    }



    // إدارة كارت تفاصيل انهاء الجلسة
    // تأكيد وتثبيت الإنهاء النهائي للجلسة
    async function confirmAndFinalizeSession() {
      const sessionId = window.currentSessionId;
      const sessionData = window.sessionSummaryData;

      if (!sessionId) {
        showNotice({
          type: 'error',
          message: 'خطأ: لم يتم العثور على معرف الجلسة'
        });
        return;
      }

      // إظهار تأكيد من المستخدم
      const confirmed = await confirmAction({
        title: 'تأكيد إنهاء الجلسة نهائياً',
        message: 'هل أنت متأكد من إنهاء الجلسة وتسجيلها في قاعدة البيانات؟\n⚠️ لا يمكن التراجع بعد التأكيد.',
        confirmText: 'تأكيد الإنهاء',
        cancelText: 'إلغاء',
        icon: 'fa-check-circle'
      });

      if (!confirmed) return;

      // تعطيل الزر لمنع النقر المزدوج
      const btn = document.getElementById('btnFinalizeSession');
      if (btn) {
        btn.disabled = true;
        btn.innerHTML =
          '<i class="fas fa-spinner fa-spin ml-2"></i>جاري التثبيت...';
      }

      // قراءة قيمة الخصم ونوعه من sessionStorage
      const discountVal = parseFloat(sessionStorage.getItem('pendingDiscount_' + sessionId) || '0') || 0;
      sessionStorage.removeItem('pendingDiscount_' + sessionId);
      sessionStorage.removeItem('pendingDiscountType_' + sessionId);

      try {
        const response = await fetch('api/session-actions.php', {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json'
          },
          body: JSON.stringify({
            action: 'finalize_end_session',
            session_id: sessionId,
            discount_input: discountVal
          })
        });

        const result = await response.json();

        if (result.finalized && result.success !== false) {
          // تحديث بيانات الإيصال بالخصم من الـ API
          if (window.sessionSummaryData) {
            window.sessionSummaryData.total_amount    = result.total_amount;
            window.sessionSummaryData.base_total      = result.base_total      || result.total_amount;
            window.sessionSummaryData.discount_amount = result.discount_amount || 0;
            window.sessionSummaryData.discount_input  = result.discount_input  || 0;
            window.sessionSummaryData.discount_type   = result.discount_type   || 'percentage';
          }

          // ── تحديث عناصر الرسيت ديناميكياً ──
          const discAmt   = parseFloat(result.discount_amount || 0);
          const baseTotal = parseFloat(result.base_total  || result.total_amount || 0);
          const finalTotal= parseFloat(result.total_amount || 0);

          if (discAmt > 0) {
            // أسطر "تفاصيل الحساب" — المبالغ الأساسية
            const baseTotalRow   = document.getElementById('receiptBaseTotalRow');
            const discountRow    = document.getElementById('receiptDiscountRow');
            const baseTotalVal   = document.getElementById('receiptBaseTotalVal');
            const discountVal    = document.getElementById('receiptDiscountVal');
            if (baseTotalVal)  baseTotalVal.textContent  = baseTotal.toFixed(2) + ' ' + CURRENCY_SYMBOL;
            if (discountVal)   discountVal.textContent   = '−' + discAmt.toFixed(2) + ' ' + CURRENCY_SYMBOL;
            if (baseTotalRow)  baseTotalRow.style.display = 'flex';
            if (discountRow)   discountRow.style.display  = 'flex';

            // إضافة الخصم في قسم "إجمالي تكلفة الوقت"
            const timeCostBadge = document.getElementById('receiptTimeCostDiscountBadge');
            const timeCostText  = document.getElementById('receiptTimeCostDiscountText');
            if (timeCostBadge && timeCostText) {
              const discTypeDisplay = (result.discount_type === 'percentage' && result.discount_input)
                ? `${parseFloat(result.discount_input)}%`
                : `${discAmt.toFixed(2)} ${CURRENCY_SYMBOL}`;
              timeCostText.textContent = `خصم ${discTypeDisplay}`;
              timeCostBadge.style.display = 'flex';
            }

            // قسم "الإجمالي النهائي" — تفصيل الخصم
            const beforeDiscLine = document.getElementById('receiptBeforeDiscountLine');
            const discLine       = document.getElementById('receiptDiscountLine');
            const baseTotalAmt2  = document.getElementById('receiptBaseTotalAmt2');
            const discLineText   = document.getElementById('receiptDiscountLineText');
            const finalTotalAmt  = document.getElementById('receiptFinalTotalAmt');
            const finalTotalTitle = document.getElementById('receiptFinalTotalTitle');
            const thanksMsg      = document.getElementById('receiptThanksMsg');

            // تغيير عنوان الإجمالي النهائي
            if (finalTotalTitle) {
              finalTotalTitle.innerHTML = '<i class="fas fa-tag mr-2"></i>الإجمالي النهائي بعد الخصم';
            }

            if (baseTotalAmt2)  baseTotalAmt2.textContent = baseTotal.toFixed(2) + ' ' + CURRENCY_SYMBOL;
            if (discLineText) {
              const discTypeSuffix = (result.discount_type === 'percentage' && result.discount_input)
                ? ` (${parseFloat(result.discount_input)}%)`
                : '';
              discLineText.textContent = `خصم: ${discAmt.toFixed(2)} ${CURRENCY_SYMBOL}${discTypeSuffix}`;
            }
            if (finalTotalAmt) finalTotalAmt.textContent = finalTotal.toFixed(2) + ' ' + CURRENCY_SYMBOL;
            if (beforeDiscLine) beforeDiscLine.style.display = 'flex';
            if (discLine)       discLine.style.display       = 'flex';
            if (thanksMsg) thanksMsg.innerHTML = `شكراً لاستخدامك خدماتنا <span style="display:block;font-size:.85rem;opacity:.85;margin-top:4px">💚 وفّرت ${discAmt.toFixed(2)} ${CURRENCY_SYMBOL}</span>`;
          }

          // تم التثبيت بنجاح
          const discNote = discAmt > 0
            ? ` (خصم: ${discAmt.toFixed(2)} ${CURRENCY_SYMBOL})`
            : '';
          showNotice({
            type: 'success',
            message: '✅ تم إنهاء الجلسة وتسجيلها بنجاح!\nالمبلغ: ' + finalTotal.toFixed(2) + ' ' + CURRENCY_SYMBOL + discNote,
            duration: discAmt > 0 ? 5000 : 4000
          });

          // ── إرسال SMS تلقائياً ──
          await sendPendingSmsAfterFinalize(sessionId);

          // إغلاق الكارت تلقائياً: 4 ثوانٍ عند الخصم / 2 ثوانٍ بدونه
          setTimeout(() => {
            window.location.reload();
          }, discAmt > 0 ? 4000 : 2000);

        } else {
          throw new Error(result.message || 'فشل التثبيت');
        }

      } catch (error) {
        showNotice({
          type: 'error',
          message: 'خطأ: ' + error.message
        });

        // إعادة تفعيل الزر
        if (btn) {
          btn.disabled = false;
          btn.innerHTML =
            '<i class="fas fa-check-circle ml-2"></i>تأكيد وإنهاء نهائياً';
        }
      }
    }

    // ── SMS Helpers (Standalone) ───────────────────────────────────────────
    const __isAdmin      = true;
    const __canSkipSms   = true;
    const __csrfToken    = 'e1ab6cb2e7704f94108c77337c13471466d79fe0e709e11a25bf89d7612b9bc7';

    function __smsPendingKey(sessionId) {
      return `pending_sms_end_${sessionId}`;
    }

    function setPendingSms(sessionId, phone, saveCustomer) {
      try {
        const payload = {
          phone: String(phone || '').trim(),
          saveCustomer: !!saveCustomer
        };
        if (!payload.phone) {
          sessionStorage.removeItem(__smsPendingKey(sessionId));
          return;
        }
        sessionStorage.setItem(__smsPendingKey(sessionId), JSON.stringify(payload));
      } catch (_) {}
    }

    function getPendingSms(sessionId) {
      try {
        const raw = sessionStorage.getItem(__smsPendingKey(sessionId));
        if (!raw) return null;
        const obj = JSON.parse(raw);
        if (!obj || !obj.phone) return null;
        return {
          phone: String(obj.phone || '').trim(),
          saveCustomer: !!obj.saveCustomer
        };
      } catch (_) {
        return null;
      }
    }

    function clearPendingSms(sessionId) {
      try {
        sessionStorage.removeItem(__smsPendingKey(sessionId));
      } catch (_) {}
    }

    async function fetchSmsStatus() {
      try {
        const res = await fetch('api/sms-actions.php?action=get_sms_status', {
          credentials: 'same-origin'
        });
        return await res.json();
      } catch (_) {
        return {
          success: false,
          allowed: false,
          reason: 'تعذّر التحقق من حالة SMS'
        };
      }
    }

    async function enqueueSmsForSession(sessionId, phone, saveCustomer) {
      const form = new FormData();
      // ① CSRF token مع كل طلب
      form.append('_csrf', __csrfToken);
      // ② session_id كرقم صحيح فقط
      const sid = parseInt(sessionId, 10);
      if (!sid || sid <= 0) return { success: false, message: 'معرّف جلسة غير صالح' };
      form.append('session_id', String(sid));
      // ③ رقم الهاتف — أرقام فقط، حدّ 11 رقماً
      const cleanPhone = String(phone || '').replace(/[^0-9]/g, '').slice(0, 11);
      form.append('to_phone', cleanPhone);
      // ④ save_customer — ثنائي صارم
      form.append('save_customer', saveCustomer ? '1' : '0');

      const res = await fetch('api/sms-actions.php?action=enqueue_sms', {
        method: 'POST',
        body: form,
        credentials: 'same-origin'
      });
      if (!res.ok) return { success: false, message: 'خطأ في الشبكة (' + res.status + ')' };
      return await res.json();
    }

    async function sendPendingSmsAfterFinalize(sessionId) {
      const pending = getPendingSms(sessionId);
      if (!pending || !pending.phone) return;

      try {
        const status = await fetchSmsStatus();
        if (!status.success || !status.allowed) {
          clearPendingSms(sessionId);
          return;
        }

        const out = await enqueueSmsForSession(sessionId, pending.phone, pending.saveCustomer);
        if (out && out.success) {
          showNotice({
            type: 'success',
            message: '✅ تم إرسال/جدولة SMS بنجاح',
            duration: 2500
          });
        } else {
          showNotice({
            type: 'warning',
            message: '⚠️ تعذّر إرسال SMS: ' + (out.message || 'غير معروف'),
            duration: 3500
          });
        }
      } catch (_) {
        showNotice({
          type: 'warning',
          message: '⚠️ تعذّر إرسال SMS',
          duration: 3000
        });
      } finally {
        clearPendingSms(sessionId);
      }
    }
    // ─────────────────────────────────────────────────────────

    async function resumeSessionAfterPreview(showMessage = false) {
      if (!window.currentSessionId) return false;
      try {
        const response = await fetch('api/session-actions.php', {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json'
          },
          body: JSON.stringify({
            action: 'resume_session_after_preview',
            session_id: window.currentSessionId
          })
        });
        const data = await response.json();
        if (data && data.success) {
          if (showMessage) {
            showNotice({
              type: 'success',
              message: data.message || 'تم استكمال الجلسة',
              duration: 1800
            });
            setTimeout(() => window.location.reload(), 1000);
          } else {
            window.location.reload();
          }
          return true;
        }
      } catch (error) {
        console.error('resumeSessionAfterPreview error', error);
      }
      return false;
    }

    async function closeSessionSummary() {
      const modal = document.getElementById('sessionSummaryModal');
      if (modal) {
        // جلب المبلغ الإجمالي قبل إغلاق المودال
        const totalAmount = modal.getAttribute('data-total-amount') || '0.00';

        modal.style.display = 'none';
        /* debug removed for production */

        // إشعار نظام الطابور بأن النظام لم يعد مشغولاً
        if (window.NotificationQueue) {
          window.NotificationQueue.setBusyState(false);
        }

        // عرض رسالة نجاح بالمبلغ الإجمالي (معاينة فقط - لم يتم التثبيت)
        showNotice({
          type: 'info',
          message: `تم إغلاق المعاينة\nℹ️ لم يتم تسجيل الجلسة - لا تزال نشطة`,
          duration: 3500
        });

        await resumeSessionAfterPreview(false);
      }
    }

    // التراجع عن إنهاء الجلسة (X) - فوري بدون تأكيد
    async function revertSessionEnding() {
      const sessionId = window.currentSessionId;
      if (!sessionId) {
        showNotice({
          type: 'error',
          message: 'خطأ: لم يتم العثور على معرف الجلسة'
        });
        return;
      }

      const resumed = await resumeSessionAfterPreview(true);
      if (resumed) {
        return;
      }

      // إذا لم ينجح resumeSessionAfterPreview، حاول مرة أخرى
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
          showNotice({
            type: 'success',
            message: '✅ تم التراجع عن إنهاء الجلسة بنجاح'
          });
          setTimeout(() => {
            window.location.reload();
          }, 1500);
        } else {
          throw new Error(result.message || 'فشل في التراجع');
        }
      } catch (error) {
        showNotice({
          type: 'error',
          message: 'خطأ: ' + error.message
        });
      }
    }

    // إلغاء إنهاء الجلسة والتراجع (للتوافق مع الكود القديم)
    async function cancelSessionEnding() {
      await revertSessionEnding();

      if (confirmed) {
        // إرسال طلب لإلغاء إنهاء الجلسة
        const form = document.createElement('form');
        form.method = 'POST';
        form.action = 'sessions.php';

        const actionInput = document.createElement('input');
        actionInput.type = 'hidden';
        actionInput.name = 'action';
        actionInput.value = 'revert_session_ending';
        form.appendChild(actionInput);

        const sessionInput = document.createElement('input');
        sessionInput.type = 'hidden';
        sessionInput.name = 'session_id';
        sessionInput.value = sessionId;
        form.appendChild(sessionInput);

        document.body.appendChild(form);
        form.submit();
      }
    }

    function printSessionSummary() {
      // إنشاء نافذة طباعة
      const printWindow = window.open('', '_blank');
      const modal = document.getElementById('sessionSummaryModal');
      const content = modal.querySelector('.bg-white');

      printWindow.document.write(`
      <html>
        <head>
          <title>تفاصيل الجلسة</title>
          <style>
            body { font-family: Arial, sans-serif; margin: 20px; direction: rtl; }
            .print-content { max-width: 800px; margin: 0 auto; }
            .header { background: linear-gradient(135deg, #10b981, #3b82f6); color: white; padding: 20px; border-radius: 10px; margin-bottom: 20px; }
            .section { background: #f9fafb; padding: 15px; margin: 10px 0; border-radius: 8px; }
            .total { background: linear-gradient(135deg, #10b981, #3b82f6); color: white; padding: 20px; border-radius: 10px; text-align: center; margin: 20px 0; }
            .total-amount { font-size: 2.5rem; font-weight: bold; }
            .flex { display: flex; justify-content: space-between; margin: 8px 0; }
            .font-bold { font-weight: bold; }
            .text-lg { font-size: 1.125rem; }
            .text-xl { font-size: 1.25rem; }
            .text-2xl { font-size: 1.5rem; }
            .text-4xl { font-size: 2.25rem; }
            .text-center { text-align: center; }
            .mb-2 { margin-bottom: 0.5rem; }
            .mb-4 { margin-bottom: 1rem; }
            .mb-6 { margin-bottom: 1.5rem; }
            .p-4 { padding: 1rem; }
            .p-6 { padding: 1.5rem; }
            .rounded-lg { border-radius: 0.5rem; }
            .space-y-2 > * + * { margin-top: 0.5rem; }
            .space-y-3 > * + * { margin-top: 0.75rem; }
            .border-b { border-bottom: 1px solid #e5e7eb; }
            .border-gray-200 { border-color: #e5e7eb; }
            .text-gray-600 { color: #4b5563; }
            .text-gray-700 { color: #374151; }
            .text-gray-800 { color: #1f2937; }
            .text-orange-600 { color: #ea580c; }
            .text-blue-600 { color: #2563eb; }
            .text-purple-600 { color: #9333ea; }
            .text-green-600 { color: #16a34a; }
            .text-green-100 { color: #dcfce7; }
            .font-semibold { font-weight: 600; }
            .font-bold { font-weight: 700; }
            .py-2 { padding-top: 0.5rem; padding-bottom: 0.5rem; }
            .grid { display: grid; }
            .grid-cols-1 { grid-template-columns: repeat(1, minmax(0, 1fr)); }
            .gap-6 { gap: 1.5rem; }
            @media (min-width: 768px) {
              .md\\:grid-cols-2 { grid-template-columns: repeat(2, minmax(0, 1fr)); }
            }
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

    // ===== دالة إظهار modal خيارات الطباعة =====
    function showPrintOptionsModal() {
      const modal = document.getElementById('printOptionsModal');
      if (modal) {
        modal.style.display = 'flex';
        // Trap focus
        const firstButton = modal.querySelector('button');
        if (firstButton) {
          firstButton.focus();
        }
      }
    }

    function closePrintOptionsModal() {
      const modal = document.getElementById('printOptionsModal');
      if (modal) {
        modal.style.display = 'none';
      }
    }

    // إغلاق modal عند النقر خارجه
    document.addEventListener('DOMContentLoaded', function() {
      const printModal = document.getElementById('printOptionsModal');
      if (printModal) {
        printModal.addEventListener('click', function(e) {
          if (e.target === printModal) {
            closePrintOptionsModal();
          }
        });
      }

      // إغلاق مع مفتاح Escape
      document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
          const printModal = document.getElementById('printOptionsModal');
          if (printModal && printModal.style.display === 'flex') {
            closePrintOptionsModal();
          }
        }
      });
    });

    // ===== دالة بناء بيانات الإيصال الموحدة =====
    function buildReceiptData(sessionData) {
      // حساب المدة بالدقائق
      const durationHours = parseFloat(sessionData.duration_hours || 0);
      const durationMinutesRemainder = parseFloat(sessionData.duration_minutes ||
        0);
      const totalDurationMinutes = (durationHours * 60) +
        durationMinutesRemainder;

      const data = {
        session: {
          id: sessionData.session_id || 0,
          room_name: sessionData.room_name || '-',
          session_type: sessionData.session_type || 'individual',
          session_category: sessionData.session_category || 'gaming',
          is_cafe: sessionData.is_cafe || (sessionData.session_category === 'cafe') || (sessionData.room_name === 'كافيه'),
          players_count: parseInt(sessionData.players_count || 0),
          duration_hours: durationHours,
          duration_minutes_remainder: durationMinutesRemainder,
          total_duration_minutes: totalDurationMinutes,
          hourly_rate: parseFloat(sessionData.hourly_rate || 0),
          cashier: 'admin_mahmoud_atef'
        },
        amounts: {
          accumulated_amount: parseFloat(sessionData.accumulated_amount || 0),
          current_amount: parseFloat(sessionData.current_amount || 0),
          session_amount: parseFloat(sessionData.session_amount || 0),
          group_session_total: parseFloat(sessionData.group_session_total || 0),
          orders_cost: parseFloat(sessionData.orders_cost || 0),
          total_amount: parseFloat(sessionData.total_amount || 0),
          discount_amount: parseFloat(sessionData.discount_amount || 0),
          discount_type: sessionData.discount_type || 'percentage',
          discount_input: parseFloat(sessionData.discount_input || 0),
          base_total: parseFloat(sessionData.base_total || 0)
        },
        orders: []
      };

      // معالجة الطلبات (دعم أسماء متعددة للحقل)
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
    // ===== دالة الطباعة الحرارية المحسّنة والكاملة =====
    function printThermalReceipt(width = '80mm') {
      closePrintOptionsModal();
      const sessionData = window.sessionSummaryData;
      const sessionId = window.currentSessionId;

      if (!sessionData || !sessionId) {
        showNotice('error', 'لا توجد بيانات للطباعة');
        return;
      }

      // Processing session data for receipt generation

      // بناء البيانات الموحدة
      const receiptData = buildReceiptData(sessionData);
      // Receipt data prepared successfully

      // تحديد نوع الجلسة
      const isCafe = receiptData.session.is_cafe ||
        (receiptData.session.session_category === 'cafe') ||
        (receiptData.session.room_name === 'كافيه');

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

      // تنسيق المدة (فقط للجلسات العادية)
      let durationStr = '';
      if (!isCafe) {
        const hours = Math.floor(receiptData.session.duration_hours || 0);
        const minutes = Math.floor(receiptData.session.duration_minutes_remainder || 0);
        durationStr = hours > 0 ? (hours + ' ساعة ' + minutes + ' دقيقة') : (
        minutes + ' دقيقة');
      }

      // بناء قائمة الطلبات من البيانات الموحدة
      const maxItems = is58mm ? 10 : 15;
      const displayOrders = receiptData.orders.slice(0, maxItems);
      const hiddenCount = Math.max(0, receiptData.orders.length - maxItems);
      let totalItems = receiptData.orders.reduce((sum, order) => sum + order.qty,
        0);

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

      // استخدام البيانات الموحدة
      const currentAmount = receiptData.amounts.current_amount;
      const accumulatedAmount = receiptData.amounts.accumulated_amount;
      const sessionAmount = receiptData.amounts.session_amount;
      const ordersTotal = receiptData.amounts.orders_cost;
      const grandTotal = receiptData.amounts.total_amount;
      const playersCount = receiptData.session.players_count;
      const groupSessionTotal = receiptData.amounts.group_session_total;

      // CSS محسّن للطباعة الحرارية - منسق في الوسط
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
      thermalCSS += '.receipt-total-row.final { font-weight: bold; font-size: ' +
        (is58mm ? '11px' : '12px') +
        '; margin-top: 5px; padding-top: 5px; border-top: 1px dashed #000; }';
      thermalCSS +=
        '.receipt-footer { text-align: center; border-top: 2px dashed #000; padding-top: 6px; margin-top: 6px; }';
      thermalCSS +=
        '.receipt-thanks { font-weight: bold; margin-bottom: 2px; font-size: ' + (
          is58mm ? '10px' : '11px') + '; }';
      thermalCSS += '.receipt-note { font-size: ' + (is58mm ? '8px' : '9px') +
        '; color: #000; }';
      thermalCSS += '.money { font-weight: bold; }';

      // بناء HTML
      let html = '<!DOCTYPE html>';
      html += '<html dir="rtl" lang="ar"><head>';
      html += '<meta charset="UTF-8">';
      html +=
        '<meta name="viewport" content="width=device-width,initial-scale=1.0">';
      html += '<title>إيصال #' + sessionId + '</title>';
      html += '<style>' + thermalCSS + '</style>';
      html += '</head><body>';
      html += '<div class="receipt-container">';

      // Header
      html += '<div class="receipt-header">';
      html += '<div class="receipt-logo">⚡</div>';
      html += '<div class="receipt-date">' + dateStr + ' - ' + timeStr + '</div>';
      html += '</div>';

      // معلومات أساسية
      html += '<div class="receipt-section">';
      html +=
        '<div class="receipt-row"><span class="receipt-label">رقم الجلسة:</span><span class="receipt-value">#' +
        sessionId + '</span></div>';
      html +=
        '<div class="receipt-row"><span class="receipt-label">' + (isCafe ? 'النوع' : 'الغرفة') + ':</span><span class="receipt-value">' +
        receiptData.session.room_name + '</span></div>';
      html +=
        '<div class="receipt-row"><span class="receipt-label">الكاشير:</span><span class="receipt-value">' +
        receiptData.session.cashier + '</span></div>';
      html += '</div>';

      // نوع الجلسة
      if (!isCafe) {
      html += '<div class="receipt-session-type">';
      html += receiptData.session.session_type === 'group' ? '🎮 جلسة جماعية' :
        '👤 جلسة فردية';
      if (playersCount > 1) {
        html += ' (' + playersCount + ' أفراد)';
      }
      html += '</div>';
      } else {
        html += '<div class="receipt-session-type">☕ جلسة كافيه</div>';
      }

      // تفاصيل الجلسة الكاملة (فقط للجلسات العادية)
      if (!isCafe && durationStr) {
      html += '<div class="receipt-section">';
      html +=
        '<div class="receipt-row"><span class="receipt-label">المدة:</span><span class="receipt-value">' +
        durationStr + '</span></div>';
        if (receiptData.session.hourly_rate > 0) {
      html +=
        '<div class="receipt-row"><span class="receipt-label">سعر الساعة:</span><span class="receipt-value money">' +
        receiptData.session.hourly_rate.toFixed(2) + ' ' + CURRENCY_SYMBOL + '</span></div>';
        }
      html += '</div>';
      }

      // قسم المبالغ (فقط للجلسات العادية)
      if (!isCafe) {
      html += '<div class="receipt-section">';

      // المبلغ التراكمي (إن وجد)
      if (accumulatedAmount > 0) {
        html +=
          '<div class="receipt-row"><span class="receipt-label">المبلغ التراكمي (السابق):</span><span class="receipt-value money">+' +
          accumulatedAmount.toFixed(2) + ' ' + CURRENCY_SYMBOL + '</span></div>';
      }

      // مبلغ الجلسة الحالية
        if (currentAmount > 0) {
      html +=
        '<div class="receipt-row"><span class="receipt-label">مبلغ الجلسة الحالية:</span><span class="receipt-value money">' +
        currentAmount.toFixed(2) + ' ' + CURRENCY_SYMBOL + '</span></div>';
        }

      // إجمالي الجلسة حسب النوع
      if (receiptData.session.session_type === 'group') {
        if (groupSessionTotal > 0) {
          html +=
            '<div class="receipt-row"><span class="receipt-label">إجمالي سعر الجلسة الجماعية:</span><span class="receipt-value money">' +
            groupSessionTotal.toFixed(2) + ' ' + CURRENCY_SYMBOL + '</span></div>';
        }
      } else {
          if (sessionAmount > 0) {
        html +=
          '<div class="receipt-row"><span class="receipt-label">إجمالي سعر الجلسة الفردية:</span><span class="receipt-value money">' +
          sessionAmount.toFixed(2) + ' ' + CURRENCY_SYMBOL + '</span></div>';
          }
      }
      html += '</div>';
      }

      // الطلبات
      html += '<div class="receipt-items-header">الطلبات (' + totalItems +
        ' قطعة)</div>';
      html += ordersHTML;

      // الإجماليات
      html += '<div class="receipt-totals">';

      // إجمالي الطلبات (إن وجدت)
      if (ordersTotal > 0) {
        html += '<div class="receipt-total-row">';
        html += '<span class="receipt-label">تكلفة الطلبات:</span>';
        html += '<span class="receipt-value money">' + ordersTotal.toFixed(2) +
          ' ' + CURRENCY_SYMBOL + '</span>';
        html += '</div>';
      }

      // عرض الخصم إن وجد
      const discountAmount = receiptData.amounts.discount_amount || 0;
      const discountType = receiptData.amounts.discount_type || 'percentage';
      const discountInput = receiptData.amounts.discount_input || 0;
      const baseTotal = receiptData.amounts.base_total || grandTotal;
      
      if (discountAmount > 0) {
        html += '<div class="receipt-total-row">';
        html += '<span class="receipt-label">الإجمالي قبل الخصم:</span>';
        html += '<span class="receipt-value money" style="text-decoration:line-through;">' + baseTotal.toFixed(2) +
          ' ' + CURRENCY_SYMBOL + '</span>';
        html += '</div>';
        
        html += '<div class="receipt-total-row">';
        html += '<span class="receipt-label">الخصم' + 
          (discountType === 'percentage' ? ' (' + discountInput + '%)' : '') + ':</span>';
        html += '<span class="receipt-value money">-' + discountAmount.toFixed(2) +
          ' ' + CURRENCY_SYMBOL + '</span>';
        html += '</div>';
      }

      // الإجمالي النهائي الكامل
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



    // إغلاق الكارت عند النقر خارجها
    document.addEventListener('click', function(event) {
      const modal = document.getElementById('sessionSummaryModal');
      if (event.target === modal) {
        closeSessionSummary();
      }
    });


    // تخزين sessionId في متغير عام
    window.currentSessionId =
      null;
    window.sessionSummaryData =
      null;

    // ── عرض الخصم المعلّق في الرسيت فوراً (بدون تثبيت — التثبيت يتم عند الضغط على "تأكيد") ──
    (function previewPendingDiscount() {
      const sid = window.currentSessionId;
      if (!sid) return;

      const pendingKey  = 'pendingDiscount_' + sid;
      const pendingType = 'pendingDiscountType_' + sid;
      const discountVal = parseFloat(sessionStorage.getItem(pendingKey) || '0') || 0;
      if (discountVal <= 0) return;

      // نوع الخصم محفوظ في sessionStorage من مودال الخصم
      const discType = sessionStorage.getItem(pendingType) || 'percentage';

      // احسب الخصم من بيانات الجلسة المتاحة
      const rawTotal = parseFloat(window.sessionSummaryData?.total_amount || 0);
      if (rawTotal <= 0) return;

      const discAmt    = discType === 'percentage'
        ? rawTotal * discountVal / 100
        : Math.min(discountVal, rawTotal);
      const finalTotal = Math.max(0, rawTotal - discAmt);

      if (discAmt <= 0) return;

      // --- تحديث سطر "إجمالي تكلفة الوقت" ---
      const timeCostBadge = document.getElementById('receiptTimeCostDiscountBadge');
      const timeCostText  = document.getElementById('receiptTimeCostDiscountText');
      if (timeCostBadge && timeCostText) {
        const discDisplay = discType === 'percentage'
          ? `${discountVal}%`
          : `${discAmt.toFixed(2)} ${CURRENCY_SYMBOL}`;
        timeCostText.textContent = `خصم ${discDisplay}`;
        timeCostBadge.style.display = 'flex';
      }

      // --- تحديث الإجمالي النهائي ---
      const finalTotalTitle = document.getElementById('receiptFinalTotalTitle');
      const finalTotalAmt   = document.getElementById('receiptFinalTotalAmt');
      const beforeDiscLine  = document.getElementById('receiptBeforeDiscountLine');
      const discLine        = document.getElementById('receiptDiscountLine');
      const baseTotalAmt2   = document.getElementById('receiptBaseTotalAmt2');
      const discLineText    = document.getElementById('receiptDiscountLineText');

      if (finalTotalTitle) {
        finalTotalTitle.innerHTML = '<i class="fas fa-tag mr-2"></i>الإجمالي النهائي بعد الخصم';
      }
      if (baseTotalAmt2) baseTotalAmt2.textContent = rawTotal.toFixed(2) + ' ' + CURRENCY_SYMBOL;
      if (discLineText) {
        const suffix = discType === 'percentage' ? ` (${discountVal}%)` : '';
        discLineText.textContent = `خصم: ${discAmt.toFixed(2)} ${CURRENCY_SYMBOL}${suffix}`;
      }
      if (finalTotalAmt)  finalTotalAmt.textContent = finalTotal.toFixed(2) + ' ' + CURRENCY_SYMBOL;
      if (beforeDiscLine) beforeDiscLine.style.display = 'flex';
      if (discLine)       discLine.style.display = 'flex';

      // --- تحديث أسطر تفاصيل الخصم ---
      const baseTotalRow = document.getElementById('receiptBaseTotalRow');
      const discountRow  = document.getElementById('receiptDiscountRow');
      const baseTotalVal = document.getElementById('receiptBaseTotalVal');
      const discountValEl= document.getElementById('receiptDiscountVal');
      if (baseTotalVal)  baseTotalVal.textContent  = rawTotal.toFixed(2) + ' ' + CURRENCY_SYMBOL;
      if (discountValEl) discountValEl.textContent = '−' + discAmt.toFixed(2) + ' ' + CURRENCY_SYMBOL;
      if (baseTotalRow)  baseTotalRow.style.display = 'flex';
      if (discountRow)   discountRow.style.display  = 'flex';
    })();

    // معالجة جلسة الكافيه من sessionStorage
    if (!window.sessionSummaryData && sessionStorage.getItem('cafe_session_summary')) {
      try {
        const cafeData = JSON.parse(sessionStorage.getItem('cafe_session_summary'));
        window.sessionSummaryData = cafeData;
        window.currentSessionId = cafeData.session_id;

        // عرض الإيصال تلقائياً
        if (typeof showSessionSummaryCard === 'function') {
          showSessionSummaryCard(cafeData, cafeData.session_id);
        }

        // مسح البيانات من sessionStorage
        sessionStorage.removeItem('cafe_session_summary');
      } catch (e) {
        console.error('Error loading cafe session summary:', e);
      }
    }
    /* debug removed for production */

    // إغلاق الكارت بمفتاح Escape
    document.addEventListener('keydown', function(event) {
      if (event.key === 'Escape') {
        closeSessionSummary();
      }
    });

    // إخفاء رسائل الحالة تلقائياً بعد ثانيتين
    function autoHideStatusMessages() {
      const statusMessages = document.querySelectorAll('.message');
      statusMessages.forEach(message => {
        // التأكد من أن الرسالة ليست رسيت ولا رسالة الشيفت
        if (!message.closest('#sessionSummaryModal') &&
          !message.classList.contains('shift_required') &&
          !message.classList.contains('session_data')) {

          // إضافة تأثير fade out
          setTimeout(() => {
            message.classList.add('fade-out');

            setTimeout(() => {
              message.style.display = 'none';
            }, 500);
          }, 2000); // 2 ثانية
        }
      });
    }

    // تشغيل إخفاء الرسائل عند تحميل الصفحة
    document.addEventListener('DOMContentLoaded', function() {
      autoHideStatusMessages();
    });

    // مراقبة الرسائل الجديدة التي تظهر بعد تحميل الصفحة
    function observeNewMessages() {
      const observer = new MutationObserver(function(mutations) {
        mutations.forEach(function(mutation) {
          mutation.addedNodes.forEach(function(node) {
            if (node.nodeType === 1 && node.classList && node
              .classList.contains('message')) {
              // التأكد من أن الرسالة ليست رسيت ولا رسالة الشيفت
              if (!node.closest('#sessionSummaryModal') &&
                !node.classList.contains('shift_required') &&
                !node.classList.contains('session_data')) {

                // إخفاء الرسالة الجديدة بعد ثانيتين
                setTimeout(() => {
                  node.classList.add('fade-out');

                  setTimeout(() => {
                    node.style.display = 'none';
                  }, 500);
                }, 2000);
              }
            }
          });
        });
      });

      // مراقبة التغييرات في body
      observer.observe(document.body, {
        childList: true,
        subtree: true
      });
    }

    // دالة تمديد الجلسة المجمدة
    function extendFrozenSession(sessionId) {
      // طلب المدة الإضافية من المستخدم
      Swal.fire({
        title: 'تمديد الجلسة',
        text: 'كم دقيقة إضافية تريد إضافتها؟',
        input: 'number',
        inputValue: 30,
        inputAttributes: {
          min: 5,
          max: 300,
          step: 5
        },
        showCancelButton: true,
        confirmButtonText: 'تمديد',
        cancelButtonText: 'إلغاء',
        confirmButtonColor: '#FF9800',
        inputValidator: (value) => {
          if (!value || value < 5) {
            return 'الحد الأدنى هو 5 دقائق';
          }
          if (value > 300) {
            return 'الحد الأقصى هو 300 دقيقة';
          }
        }
      }).then((result) => {
        if (result.isConfirmed) {
          const additionalMinutes = parseInt(result.value);

          // إرسال طلب تمديد الجلسة
          const formData = new FormData();
          formData.append('action', 'extend_limited_session');
          formData.append('session_id', sessionId);
          formData.append('additional_minutes', additionalMinutes);

          // إظهار مؤشر التحميل
          Swal.fire({
            title: 'جاري التمديد...',
            text: 'يرجى الانتظار',
            allowOutsideClick: false,
            showConfirmButton: false,
            didOpen: () => {
              Swal.showLoading();
            }
          });

          // إرسال الطلب
          fetch('', {
              method: 'POST',
              body: formData
            })
            .then(response => response.text())
            .then(data => {
              // إخفاء مؤشر التحميل
              Swal.close();

              // التحقق من نجاح العملية
              if (data.includes('تم تمديد الجلسة بنجاح')) {
                Swal.fire({
                  title: 'تم التمديد بنجاح!',
                  text: `تم تمديد الجلسة لمدة ${additionalMinutes} دقيقة إضافية`,
                  icon: 'success',
                  confirmButtonText: 'حسناً',
                  confirmButtonColor: '#4CAF50'
                }).then(() => {
                  // إعادة تحميل الصفحة لعرض التحديثات
                  window.location.reload();
                });
              } else {
                // استخراج رسالة الخطأ
                const errorMatch = data.match(
                  /<div class="alert alert-error" [^>]*>([^<]+)< /);
                const
                  errorMessage = errorMatch ? errorMatch[1] :
                  'حدث خطأ غير متوقع';
                Swal.fire({
                  title: 'فشل التمديد',
                  text: errorMessage,
                  icon: 'error',
                  confirmButtonText: 'حسناً',
                  confirmButtonColor: '#f44336'
                });
              }
            })
            .catch(error => {
              Swal.close();
              Swal.fire({
                title: 'خطأ في الاتصال',
                text: 'حدث خطأ أثناء إرسال الطلب',
                icon: 'error',
                confirmButtonText: 'حسناً',
                confirmButtonColor: '#f44336'
              });
            });
        }
      });
    }

    // بدء مراقبة الرسائل الجديدة
    document.addEventListener('DOMContentLoaded', function() {
      observeNewMessages();

      // فحص وجود كارت الإيصال عند التحميل
      const modal = document.getElementById('sessionSummaryModal');
      if (modal && modal.style.display !== 'none') {
        /* debug removed for production */
        if (window.NotificationQueue) {
          window.NotificationQueue.setBusyState(true);
        }
      }
    });
  </script>

  <!-- نظام الإشعارات للجلسات المنتهية -->
  <!-- تحميل المكتبات الاحترافية -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js">
  </script>

  <!-- نظام طابور الإشعارات -->
  <script src="js/notification-queue.js?v=1779207315"></script>

  <!-- نظام مراقبة الجلسات المحدودة -->
  <script src="js/session-monitor.js?v=1771422103"></script>

  <!-- Quick Add Order Wizard (from session card) -->
  <script>
    const canAddOrders = true;

    // ===================== إضافة طلب سريع من كارت الجلسة =====================
    let __sessOrderWizard = {
      sessionId: null,
      step: 1,
      type: null, // food | drink
      item: null, // selected item object
      items: [],
      search: '',
      quantity: 1,
      drinkType: 'بارد'
    };

    function openSessionAddOrderModal(sessionId) {
      if (!canAddOrders) {
        Swal.fire({
          icon: 'error',
          title: 'غير مسموح',
          text: 'ليس لديك صلاحية لإضافة الطلبات'
        });
        return;
      }

      __sessOrderWizard = {
        sessionId,
        step: 1,
        type: null,
        item: null,
        items: [],
        search: '',
        quantity: 1,
        drinkType: 'بارد'
      };

      const existing = document.getElementById('sessionAddOrderModal');
      if (existing) existing.remove();

      const overlay = document.createElement('div');
      overlay.id = 'sessionAddOrderModal';
      overlay.className =
        'fixed inset-0 z-[99999] bg-black/70 backdrop-blur-sm flex items-center justify-center p-3 sm:p-4';
      overlay.addEventListener('click', (e) => {
        if (e.target === overlay) closeSessionAddOrderModal();
      });

      overlay.innerHTML = `
        <div class="w-full max-w-2xl max-h-[92vh] bg-gradient-to-br from-slate-900 via-slate-800 to-slate-900 border border-white/10 rounded-3xl shadow-2xl overflow-hidden flex flex-col">
          <div class="p-3 sm:p-4 bg-gradient-to-r from-emerald-600 to-green-700 text-white shrink-0">
            <div class="flex items-center justify-between gap-3">
              <div class="flex items-center gap-2 sm:gap-3 min-w-0">
                <div class="w-9 h-9 sm:w-10 sm:h-10 rounded-xl bg-white/15 flex items-center justify-center flex-shrink-0">
                  <i class="fas fa-cart-plus text-lg sm:text-xl"></i>
                </div>
                <h3 class="text-base sm:text-xl font-extrabold leading-tight">إضافة طلب للجلسة</h3>
              </div>
              <button type="button" class="w-8 h-8 sm:w-9 sm:h-9 rounded-full bg-white/15 hover:bg-white/20 transition flex items-center justify-center flex-shrink-0" onclick="closeSessionAddOrderModal()" aria-label="إغلاق">
                <i class="fas fa-times text-sm"></i>
              </button>
            </div>
          </div>

          <!-- مهم: لا سكرول في الكارت الأب. السكرول فقط داخل قائمة الأصناف -->
          <div class="p-3 sm:p-5">
            <div class="flex items-center justify-between gap-2 sm:gap-3 mb-3">
              <div id="sessWizardMetaLeft" class="flex flex-wrap items-center gap-2 text-white/80 text-xs sm:text-sm min-w-0">
                <span id="sessWizardTypePill" class="hidden px-2.5 py-1 rounded-full bg-white/10 border border-white/10 font-extrabold"></span>
                <span class="px-2.5 py-1 rounded-full bg-white/10 border border-white/10">خطوة <span id="sessWizardStep">1</span>/3</span>
                <span class="px-2.5 py-1 rounded-full bg-white/5 border border-white/10">جلسة #<span id="sessWizardSessionId">${sessionId}</span></span>
                <span id="sessWizardBreadcrumb" class="text-white/70 text-[11px] sm:text-xs truncate max-w-[50vw] sm:max-w-[280px] md:max-w-[380px]"></span>
              </div>
              <div id="sessWizardTopRight" class="flex items-center gap-2 flex-shrink-0"></div>
            </div>

            <div id="sessWizardBody"></div>
          </div>
        </div>
      `;

      document.body.appendChild(overlay);
      renderSessWizard();
    }

    function closeSessionAddOrderModal() {
      const el = document.getElementById('sessionAddOrderModal');
      if (el) el.remove();
    }

    function setSessWizardStep(step) {
      __sessOrderWizard.step = step;
      renderSessWizard();
    }

    function renderSessWizard() {
      const stepEl = document.getElementById('sessWizardStep');
      const bodyEl = document.getElementById('sessWizardBody');
      const bcEl = document.getElementById('sessWizardBreadcrumb');
      const typePillEl = document.getElementById('sessWizardTypePill');
      const topRightEl = document.getElementById('sessWizardTopRight');
      if (!stepEl || !bodyEl) return;

      stepEl.textContent = String(__sessOrderWizard.step);

      const parts = [];
      if (__sessOrderWizard.type) parts.push(__sessOrderWizard.type === 'food' ? 'طعام' : 'مشروبات');
      if (__sessOrderWizard.item) parts.push(__sessOrderWizard.item.name);

      // نوع الطلب بجانب المعلومات (يسار)
      if (typePillEl) {
        if (__sessOrderWizard.type) {
          typePillEl.textContent = __sessOrderWizard.type === 'food' ? 'طعام' : 'مشروبات';
          typePillEl.classList.remove('hidden');
        } else {
          typePillEl.textContent = '';
          typePillEl.classList.add('hidden');
        }
      }

      // Breadcrumb (اختياري)
      if (bcEl) bcEl.textContent = parts.length ? parts.join(' / ') : '';

      // زر رجوع في نفس سطر المعلومات (يمين) لتوفير مساحة
      if (topRightEl) {
        if (__sessOrderWizard.step > 1) {
          const backTo = __sessOrderWizard.step === 2 ? 1 : 2;
          topRightEl.innerHTML = `
            <button type="button"
              onclick="setSessWizardStep(${backTo})"
              class="px-3 py-2 rounded-xl bg-white/10 hover:bg-white/15 text-white text-sm font-bold transition flex items-center gap-2">
              <span class="hidden sm:inline">رجوع</span>
              <i class="fas fa-arrow-right"></i>
            </button>
          `;
        } else {
          topRightEl.innerHTML = '';
        }
      }

      if (__sessOrderWizard.step === 1) {
        bodyEl.innerHTML = `
          <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
            <button type="button" onclick="sessChooseType('food')" class="p-4 sm:p-5 rounded-2xl border border-white/10 bg-white/5 hover:bg-white/10 transition text-right">
              <div class="flex items-center justify-between gap-3">
                <div class="min-w-0">
                  <div class="text-white font-extrabold text-lg">طعام</div>
                  <div class="text-white/60 text-sm mt-1">اختر صنف طعام من المنيو</div>
                </div>
                <div class="w-12 h-12 rounded-2xl bg-emerald-500/15 flex items-center justify-center text-emerald-300 flex-shrink-0">
                  <i class="fas fa-hamburger text-xl"></i>
                </div>
              </div>
            </button>
            <button type="button" onclick="sessChooseType('drink')" class="p-4 sm:p-5 rounded-2xl border border-white/10 bg-white/5 hover:bg-white/10 transition text-right">
              <div class="flex items-center justify-between gap-3">
                <div class="min-w-0">
                  <div class="text-white font-extrabold text-lg">مشروبات</div>
                  <div class="text-white/60 text-sm mt-1">اختر مشروب (بارد/ساخن)</div>
                </div>
                <div class="w-12 h-12 rounded-2xl bg-sky-500/15 flex items-center justify-center text-sky-300 flex-shrink-0">
                  <i class="fas fa-mug-hot text-xl"></i>
                </div>
              </div>
            </button>
          </div>
        `;
        return;
      }

      if (__sessOrderWizard.step === 2) {
        bodyEl.innerHTML = `
          <div class="bg-white/5 border border-white/10 rounded-2xl p-3 sm:p-4">
            <div class="flex items-center justify-between gap-3 mb-2 sm:mb-3">
              <div class="flex items-center gap-2 sm:gap-3 min-w-0">
                <div class="w-9 h-9 rounded-xl bg-white/10 flex items-center justify-center text-white/80 flex-shrink-0">
                  <i class="fas fa-list text-sm"></i>
                </div>
                <div class="min-w-0">
                  <div class="text-white font-extrabold text-sm sm:text-base">اختر الصنف</div>
                  <div class="text-white/60 text-xs sm:text-sm hidden sm:block">ابحث واختر الصنف المطلوب</div>
                </div>
              </div>
              <button id="sessNextBtn" type="button" onclick="sessGoToQtyStep()" class="flex-shrink-0 px-3 sm:px-4 py-2 sm:py-2.5 rounded-xl bg-gradient-to-r from-emerald-500 to-green-600 hover:from-emerald-600 hover:to-green-700 text-white font-extrabold shadow-lg transition disabled:opacity-50 disabled:cursor-not-allowed text-xs sm:text-sm" disabled>
                التالي <i class="fas fa-arrow-left mr-1 sm:mr-2"></i>
              </button>
            </div>

            <input id="sessItemSearch" type="text" placeholder="بحث..." value="${escapeHtml(__sessOrderWizard.search)}"
              class="w-full bg-slate-900/60 border border-white/10 rounded-xl px-3 sm:px-4 py-2 sm:py-2.5 text-white text-sm placeholder-white/40 focus:outline-none focus:ring-2 focus:ring-emerald-400/60">

            <div id="sessItemsContainer" class="mt-2 sm:mt-3 h-[32vh] sm:h-[34vh] md:h-[38vh] lg:h-[42vh] overflow-y-auto overflow-x-hidden rounded-xl border border-white/10"></div>
          </div>
        `;

        const searchEl = document.getElementById('sessItemSearch');
        if (searchEl) {
          searchEl.addEventListener('input', (e) => {
            __sessOrderWizard.search = e.target.value || '';
            renderSessItems();
          });
          setTimeout(() => searchEl.focus(), 50);
        }

        if (!__sessOrderWizard.items || __sessOrderWizard.items.length === 0) {
          loadSessItems(__sessOrderWizard.type);
        } else {
          renderSessItems();
        }
        return;
      }

      // step 3
      const item = __sessOrderWizard.item;
      bodyEl.innerHTML = `
        <div class="flex flex-col gap-3">
          <div class="bg-white/5 border border-white/10 rounded-2xl p-3 sm:p-4">
            <div class="flex items-start justify-between gap-3">
              <div class="min-w-0">
                <div class="text-white font-extrabold text-base sm:text-lg break-words">${escapeHtml(item?.name || '')}</div>
                <div class="text-white/60 text-xs sm:text-sm mt-1">السعر: <span class="text-white font-bold">${formatMoney(item?.price || 0)}</span> ${CURRENCY_SYMBOL}</div>
                <div class="text-white/50 text-xs mt-1">المخزون: ${Number(item?.stock ?? 0)}</div>
              </div>
              <div class="w-10 h-10 sm:w-12 sm:h-12 rounded-2xl bg-white/10 flex items-center justify-center text-white/80 flex-shrink-0">
                <i class="fas fa-tag text-base sm:text-lg"></i>
              </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 mt-3 sm:mt-4">
              <div>
                <label class="block text-white/80 text-xs sm:text-sm mb-2 font-bold">الكمية</label>
                <input id="sessQty" type="number" min="1" value="${__sessOrderWizard.quantity}"
                  class="w-full bg-slate-900/60 border border-white/10 rounded-xl px-3 sm:px-4 py-2 sm:py-2.5 text-white text-sm focus:outline-none focus:ring-2 focus:ring-emerald-400/60">
              </div>
              <div id="sessDrinkTypeWrap" class="${__sessOrderWizard.type === 'drink' ? '' : 'hidden'}">
                <label class="block text-white/80 text-xs sm:text-sm mb-2 font-bold">النوع</label>
                <div class="grid grid-cols-2 gap-2">
                  <button type="button" onclick="sessSetDrinkType('بارد')" class="px-3 sm:px-4 py-2 sm:py-2.5 rounded-xl border border-white/10 ${__sessOrderWizard.drinkType === 'بارد' ? 'bg-sky-500/25 text-sky-200' : 'bg-white/5 text-white/80 hover:bg-white/10'} font-bold transition text-xs sm:text-sm">بارد</button>
                  <button type="button" onclick="sessSetDrinkType('ساخن')" class="px-3 sm:px-4 py-2 sm:py-2.5 rounded-xl border border-white/10 ${__sessOrderWizard.drinkType === 'ساخن' ? 'bg-amber-500/25 text-amber-200' : 'bg-white/5 text-white/80 hover:bg-white/10'} font-bold transition text-xs sm:text-sm">ساخن</button>
                </div>
                <p class="text-white/40 text-xs mt-2">يظهر هذا الخيار للمشروبات فقط</p>
              </div>
            </div>
          </div>

          <div class="pt-1">
            <div class="flex flex-col sm:flex-row items-stretch sm:items-center justify-between gap-2 sm:gap-3">
              <button type="button" onclick="closeSessionAddOrderModal()" class="w-full sm:w-auto px-4 py-2.5 sm:py-3 rounded-2xl bg-white/10 hover:bg-white/15 text-white font-bold transition text-sm">
                إلغاء
              </button>
              <button id="sessConfirmBtn" type="button" onclick="sessConfirmAddOrder()" class="w-full sm:w-auto px-4 sm:px-5 py-2.5 sm:py-3 rounded-2xl bg-gradient-to-r from-emerald-500 to-green-600 hover:from-emerald-600 hover:to-green-700 text-white font-extrabold shadow-lg transition flex items-center justify-center gap-2 text-sm sm:text-base">
                <i class="fas fa-check"></i>
                تأكيد الإضافة
              </button>
            </div>
          </div>
        </div>
      `;

      const qtyEl = document.getElementById('sessQty');
      if (qtyEl) {
        qtyEl.addEventListener('input', (e) => {
          const v = parseInt(e.target.value || '1', 10);
          __sessOrderWizard.quantity = isNaN(v) ? 1 : Math.max(1, v);
        });
        // تحديد النص بالكامل عند النقر أو focus لتسهيل الاستبدال السريع
        qtyEl.addEventListener('focus', (e) => {
          e.target.select();
        });
        qtyEl.addEventListener('click', (e) => {
          e.target.select();
        });
        // تحديد النص بالكامل عند فتح input
        setTimeout(() => {
          qtyEl.focus();
          qtyEl.select();
        }, 50);
      }
    }

    function sessChooseType(type) {
      __sessOrderWizard.type = type;
      __sessOrderWizard.item = null;
      __sessOrderWizard.items = [];
      __sessOrderWizard.search = '';
      __sessOrderWizard.quantity = 1;
      __sessOrderWizard.drinkType = 'بارد';
      setSessWizardStep(2);
    }

    async function loadSessItems(type) {
      const container = document.getElementById('sessItemsContainer');
      if (container) {
        container.innerHTML = `<div class="p-4 text-white/60 text-sm">جاري تحميل الأصناف...</div>`;
      }
      try {
        const res = await fetch(
          `api/session-order-actions.php?action=list_items&type=${encodeURIComponent(type)}`, {
            credentials: 'same-origin'
          });
        const data = await res.json();
        if (!data || !data.success) {
          throw new Error(data?.error || 'فشل تحميل الأصناف');
        }
        __sessOrderWizard.items = Array.isArray(data.items) ? data.items : [];
        renderSessItems();
      } catch (e) {
        if (container) {
          container.innerHTML =
            `<div class="p-4 text-red-200 text-sm">تعذر تحميل الأصناف: ${escapeHtml(e.message || '')}</div>`;
        }
      }
    }

    function renderSessItems() {
      const container = document.getElementById('sessItemsContainer');
      const nextBtn = document.getElementById('sessNextBtn');
      if (!container) return;

      const q = (__sessOrderWizard.search || '').trim().toLowerCase();
      const items = (__sessOrderWizard.items || []).filter(it => {
        const name = String(it.name || '').toLowerCase();
        return !q || name.includes(q);
      });

      if (items.length === 0) {
        container.innerHTML = `<div class="p-4 text-white/60 text-sm">لا توجد أصناف مطابقة.</div>`;
        if (nextBtn) nextBtn.disabled = true;
        return;
      }

      const selectedId = __sessOrderWizard.item?.id;
      container.innerHTML = `
        <div class="divide-y divide-white/10">
          ${items.map(it => {
            const isSel = selectedId === it.id;
            const stock = Number(it.stock ?? 0);
            const disabled = stock <= 0;
            const baseCls = disabled ? 'opacity-50 cursor-not-allowed' : 'cursor-pointer hover:bg-white/5';
            const selCls = isSel ? 'bg-emerald-500/15' : '';
            const badge = disabled ? `<span class="text-xs px-2 py-1 rounded-full bg-red-500/15 text-red-200 border border-red-500/20">نفد</span>` :
              `<span class="text-xs px-2 py-1 rounded-full bg-white/5 text-white/70 border border-white/10">متاح: ${stock}</span>`;
            return `
              <div class="p-3 sm:p-4 flex items-center justify-between gap-3 ${baseCls} ${selCls}" ${disabled ? '' : `onclick="sessSelectItem(${it.id})"`}>
                <div class="min-w-0">
                  <div class="text-white font-bold truncate">${escapeHtml(it.name || '')}</div>
                  <div class="text-white/60 text-sm mt-1">السعر: <span class="text-white font-bold">${formatMoney(it.price || 0)}</span> ${CURRENCY_SYMBOL}</div>
                </div>
                <div class="flex items-center gap-2 flex-shrink-0">
                  ${badge}
                  ${isSel ? `<span class="w-8 h-8 rounded-full bg-emerald-500/20 text-emerald-200 flex items-center justify-center border border-emerald-500/30"><i class="fas fa-check"></i></span>` : ''}
                </div>
              </div>
            `;
          }).join('')}
        </div>
      `;

      if (nextBtn) nextBtn.disabled = !__sessOrderWizard.item;
    }

    function sessSelectItem(id) {
      const item = (__sessOrderWizard.items || []).find(x => Number(x.id) === Number(id));
      if (!item) return;
      __sessOrderWizard.item = item;
      if (__sessOrderWizard.type === 'drink') {
        const dbType = String(item.type || '').trim();
        if (dbType === 'بارد' || dbType === 'ساخن') {
          __sessOrderWizard.drinkType = dbType;
        }
      }
      renderSessItems();
    }

    function sessGoToQtyStep() {
      if (!__sessOrderWizard.item) return;
      setSessWizardStep(3);
    }

    function sessSetDrinkType(t) {
      __sessOrderWizard.drinkType = t;
      renderSessWizard();
    }

    async function sessConfirmAddOrder() {
      const btn = document.getElementById('sessConfirmBtn');
      if (!__sessOrderWizard.sessionId || !__sessOrderWizard.item) return;
      const qty = Math.max(1, parseInt(__sessOrderWizard.quantity || 1, 10));
      const payload = {
        action: 'add_order',
        session_id: __sessOrderWizard.sessionId,
        item_type: __sessOrderWizard.type,
        item_id: __sessOrderWizard.item.id,
        quantity: qty,
        drink_type: __sessOrderWizard.type === 'drink' ? __sessOrderWizard.drinkType : null
      };

      try {
        if (btn) {
          btn.disabled = true;
          btn.innerHTML = `<i class="fas fa-spinner fa-spin"></i> جاري الإضافة...`;
        }

        const res = await fetch('api/session-order-actions.php', {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json'
          },
          credentials: 'same-origin',
          body: JSON.stringify(payload)
        });
        const data = await res.json();
        if (!data || !data.success) {
          throw new Error(data?.error || 'فشل إضافة الطلب');
        }

        applySessionOrderUIUpdate(__sessOrderWizard.sessionId, data.order, data.totals);
        closeSessionAddOrderModal();
        Swal.fire({
          toast: true,
          position: 'top-start',
          timer: 2200,
          showConfirmButton: false,
          icon: 'success',
          title: 'تمت إضافة الطلب بنجاح'
        });
      } catch (e) {
        Swal.fire({
          icon: 'error',
          title: 'خطأ',
          text: e.message || 'حدث خطأ أثناء إضافة الطلب'
        });
      } finally {
        if (btn) {
          btn.disabled = false;
          btn.innerHTML = `<i class="fas fa-check"></i> تأكيد الإضافة`;
        }
      }
    }

    function applySessionOrderUIUpdate(sessionId, order, totals) {
      const emptyEl = document.getElementById(`orders-empty-${sessionId}`);
      const listEl = document.getElementById(`orders-list-${sessionId}`);
      const ordersCostEl = document.getElementById(`orders-cost-${sessionId}`);
      const totalCostEl = document.getElementById(`total-cost-${sessionId}`);

      let targetList = listEl;
      if (!targetList && emptyEl && emptyEl.parentElement) {
        targetList = document.createElement('div');
        targetList.className = 'orders-list';
        targetList.id = `orders-list-${sessionId}`;
        emptyEl.parentElement.insertBefore(targetList, emptyEl);
      }

      if (emptyEl) emptyEl.remove();

      if (targetList) {
        const div = document.createElement('div');
        div.className = 'order-item';
        const typeLabel = (order?.item_type === 'drink' && order?.drink_type) ?
          `<span class="order-type">(${escapeHtml(order.drink_type)})</span>` : '';
        div.innerHTML = `
          <div class="order-name">
            ${escapeHtml(order?.item_name || '')}
            ${typeLabel}
          </div>
          <div class="order-details">
            الكمية: ${Number(order?.quantity || 0)} |
            السعر: ${formatMoney(order?.unit_price || 0)} ${CURRENCY_SYMBOL}
          </div>
        `;
        targetList.prepend(div);
      }

      if (ordersCostEl && totals && typeof totals.orders_cost !== 'undefined') {
        ordersCostEl.textContent = `${formatMoney(totals.orders_cost)} ${CURRENCY_SYMBOL}`;
      }
      if (totalCostEl && totals && typeof totals.total_cost !== 'undefined') {
        totalCostEl.textContent = `${formatMoney(totals.total_cost)} ${CURRENCY_SYMBOL}`;
      }
    }

    function formatMoney(v) {
      const n = Number(v || 0);
      return n.toFixed(2);
    }

    function escapeHtml(str) {
      return String(str ?? '')
        .replace(/&/g, '&amp;')
        .replace(/</g, '&lt;')
        .replace(/>/g, '&gt;')
        .replace(/"/g, '&quot;')
        .replace(/'/g, '&#039;');
    }
  </script>

  <script>
    function showUpgradePrintModal() {
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
        <h3 class="text-lg font-bold">ترقية مطلوبة لطباعة الريسيت</h3>
      </div>
      <div class="bg-white p-6 text-right" dir="rtl">
        <p class="text-gray-700 leading-7 mb-4">للاستفادة من ميزة <strong>طباعة الريسيت</strong> يرجى ترقية خطتك.</p>
        <ul class="text-gray-600 text-sm space-y-2 mb-5">
          <li class="flex items-center gap-2"><i class="fas fa-check text-emerald-500"></i> طباعة حرارية 80mm</li>
          <li class="flex items-center gap-2"><i class="fas fa-check text-emerald-500"></i> طباعة حرارية 58mm</li>
          <li class="flex items-center gap-2"><i class="fas fa-check text-emerald-500"></i> طباعة ورقية عادية (A4)</li>
        </ul>
        <div class="flex items-center justify-end gap-3">
          <button onclick="document.getElementById('upgradeCustomersOverlay').remove()" class="px-4 py-2 rounded-lg font-semibold text-white" style="background:#111827;">لاحقاً</button>
          <button onclick="window.location.href='subscription-upgrade.php'" class="px-4 py-2 rounded-lg text-white bg-gradient-to-r from-indigo-600 to-purple-600 hover:opacity-95 cursor-pointer border-0">الترقية الآن</button>
        </div>
      </div>`;

      overlay.appendChild(card);
      overlay.addEventListener('click', (e) => {
        if (e.target === overlay) overlay.remove();
      });
      document.body.appendChild(overlay);
    }
    // تم نقل نظام الإشعارات إلى ملفات منفصلة
    /* debug removed for production */
  </script>

  <!-- Accordion & Collapse Scripts -->
  <script>
    // Toggle Accordion Section
    function toggleAccordion(sectionId) {
      const section = document.getElementById(sectionId);
      if (section) {
        section.classList.toggle('active');
      }
    }

    // Toggle Session Card Details
    function toggleSessionCard(sessionId) {
      const card = document.querySelector(
        `[data-session-card="${sessionId}"]`);
      if (card) {
        card.classList.toggle('expanded');
      }
    }

    // Auto-open first section on desktop
    document.addEventListener('DOMContentLoaded', function() {
      // On desktop, open active sessions by default
      if (window.innerWidth >= 1024) {
        const firstSection = document.querySelector('.accordion-section');
        if (firstSection) {
          firstSection.classList.add('active');
        }
      }
    });
  </script>

  <!-- Session Card Accordion Script -->
  <script>
    /** Helper: Collapse a given session card wrapper safely */
    function collapseSessionCard(wrapperEl) {
      if (!wrapperEl || !wrapperEl.classList.contains('expanded')) return;
      const detailsWrapper = wrapperEl.querySelector(
        '.session-details-wrapper');
      const summaryBtn = wrapperEl.querySelector('.session-summary');
      const icon = wrapperEl.querySelector('.session-toggle-icon i');
      const sid = wrapperEl.dataset.sessionId;

      if (detailsWrapper) {
        detailsWrapper.style.maxHeight = detailsWrapper.scrollHeight + 'px';
        requestAnimationFrame(() => {
          detailsWrapper.style.maxHeight = '0px';
        });
      }
      wrapperEl.classList.remove('expanded');
      if (summaryBtn) summaryBtn.setAttribute('aria-expanded', 'false');
      if (icon) icon.className = 'fas fa-chevron-down';
      if (sid) localStorage.setItem(`sessionCard:expanded:${sid}`, 'false');
    }

    /**
     * Toggle Session Card Accordion
     * @param {HTMLElement} wrapperEl - The session-card-wrapper element
     */
    function toggleSessionCard(wrapperEl) {
      const detailsWrapper = wrapperEl.querySelector(
        '.session-details-wrapper');
      const summaryBtn = wrapperEl.querySelector('.session-summary');
      const icon = wrapperEl.querySelector('.session-toggle-icon i');
      const sessionId = wrapperEl.dataset.sessionId;

      const isExpanded = wrapperEl.classList.contains('expanded');

      if (isExpanded) {
        // Collapse current
        collapseSessionCard(wrapperEl);
        // If this was the last expanded, clear the single-open tracker
        const last = localStorage.getItem('sessionCard:lastExpanded');
        if (last && last === sessionId) localStorage.removeItem(
          'sessionCard:lastExpanded');
        return;
      }

      // Before expanding current, collapse any other expanded cards
      const openCards = document.querySelectorAll(
        '.session-card-wrapper.expanded');
      openCards.forEach(card => {
        if (card !== wrapperEl) collapseSessionCard(card);
      });

      // Expand current
      if (detailsWrapper) {
        detailsWrapper.style.maxHeight = detailsWrapper.scrollHeight + 'px';
      }
      wrapperEl.classList.add('expanded');
      if (summaryBtn) summaryBtn.setAttribute('aria-expanded', 'true');
      if (icon) icon.className = 'fas fa-chevron-up';

      // Persist state: mark this as the only expanded card
      localStorage.setItem('sessionCard:lastExpanded', sessionId || '');
      localStorage.setItem(`sessionCard:expanded:${sessionId}`, 'true');

      // Remove max-height after transition for dynamic content
      setTimeout(() => {
        if (wrapperEl.classList.contains('expanded') && detailsWrapper) {
          detailsWrapper.style.maxHeight = 'none';
        }
      }, 350);
    }

    // Keyboard support for session summary
    document.addEventListener('keydown', function(e) {
      if (e.target.classList.contains('session-summary')) {
        if (e.key === 'Enter' || e.key === ' ') {
          e.preventDefault();
          toggleSessionCard(e.target.parentElement);
        } else if (e.key === 'Escape') {
          const wrapper = e.target.parentElement;
          if (wrapper.classList.contains('expanded')) {
            toggleSessionCard(wrapper);
          }
        }
      }
    });

    // Restore single-open state on page load
    document.addEventListener('DOMContentLoaded', function() {
      const wrappers = Array.from(document.querySelectorAll(
        '.session-card-wrapper'));
      const hash = window.location.hash || '';
      let targetId = '';
      if (hash.startsWith('#s')) {
        targetId = hash.replace('#s', '');
      } else {
        targetId = localStorage.getItem('sessionCard:lastExpanded') || '';
      }

      // Close all first
      wrappers.forEach(w => collapseSessionCard(w));

      // Open the target if exists
      if (targetId) {
        const target = wrappers.find(w => w.dataset.sessionId ===
          targetId);
        if (target) {
          // call toggle to open (it will ensure single-open semantics)
          toggleSessionCard(target);
        }
      }
    });
  </script>
  <!-- Dark Mode Script - Synced with dashboard.php -->
  <script>
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

      // Save to DB
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
        /* debug removed for production */
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

    // Load Dark Mode preference on page load (if not set by PHP)
    document.addEventListener('DOMContentLoaded', async function() {
      const body = document.body;
      const icon = document.getElementById('dark-mode-icon');

      // Update icon based on current state
      if (body.classList.contains('dark-mode')) {
        icon.className = 'fas fa-sun';
      }

      // معالجة نتيجة تبديل الغرفة (PRG Pattern)
      const urlParams = new URLSearchParams(window.location.search);

      if (urlParams.has('sw') && urlParams.get('sw') === '1') {
        const accumulated = urlParams.get('acc') || '0.00';
        showNotice('success',
          `تم تبديل الغرفة بنجاح\nالمبلغ التراكمي: ${accumulated} ${CURRENCY_SYMBOL}`,
          3500);

        // إزالة الباراميترات من URL بدون إعادة تحميل
        const cleanUrl = window.location.pathname + window.location
          .hash;
        window.history.replaceState({}, document.title, cleanUrl);
      } else if (urlParams.has('sw_err')) {
        const errorType = urlParams.get('sw_err');
        let errorMessage = 'حدث خطأ في تبديل الغرفة';

        switch (errorType) {
          case 'not_available':
            errorMessage =
              'الغرفة الجديدة غير متاحة\nيرجى اختيار غرفة أخرى';
            break;
          case 'not_found':
            errorMessage = 'حدث خطأ غير متوقع';
            break;
          case 'exception':
            errorMessage = 'حدث خطأ غير متوقع\nيرجى المحاولة مرة أخرى';
            break;
        }

        showNotice('error', errorMessage, 3500);

        // إزالة الباراميترات من URL
        const cleanUrl = window.location.pathname + window.location
          .hash;
        window.history.replaceState({}, document.title, cleanUrl);
      }
    });

    // ===== دوال إدارة قائمة تبديل الغرفة =====
    let currentOpenDropdown = null;
    let currentTriggerButton = null;

    function toggleSwitchRoomDropdown(sessionId, triggerBtn) {
      const dropdown = document.getElementById(
        `switchRoomDropdown_${sessionId}`);

      // إذا كانت القائمة مفتوحة بالفعل، أغلقها
      if (dropdown.style.display === 'block') {
        closeSwitchRoomDropdown(sessionId);
        return;
      }

      // أغلق أي قائمة مفتوحة أخرى
      if (currentOpenDropdown && currentOpenDropdown !== dropdown) {
        currentOpenDropdown.style.display = 'none';
        if (currentTriggerButton) {
          currentTriggerButton.setAttribute('aria-expanded', 'false');
        }
      }

      // افتح القائمة الحالية
      dropdown.style.display = 'block';
      triggerBtn.setAttribute('aria-expanded', 'true');

      // نقل القائمة إلى body (Portal Pattern)
      if (dropdown.parentElement !== document.body) {
        document.body.appendChild(dropdown);
      }

      // احسب الموضع وطبّقه
      positionDropdown(triggerBtn, dropdown);

      // حفظ المرجع
      currentOpenDropdown = dropdown;
      currentTriggerButton = triggerBtn;

      // Trap focus
      trapFocus(dropdown);

      // أضف event listeners للإغلاق
      setTimeout(() => {
        document.addEventListener('click', handleOutsideClick);
        document.addEventListener('keydown', handleEscapeKey);
        window.addEventListener('scroll', handleScrollOrResize, true);
        window.addEventListener('resize', handleScrollOrResize);
      }, 10);
    }

    function closeSwitchRoomDropdown(sessionId) {
      const dropdown = document.getElementById(
        `switchRoomDropdown_${sessionId}`);
      if (dropdown) {
        dropdown.style.display = 'none';
        if (currentTriggerButton) {
          currentTriggerButton.setAttribute('aria-expanded', 'false');
          currentTriggerButton.focus();
        }
      }

      // أزل event listeners
      document.removeEventListener('click', handleOutsideClick);
      document.removeEventListener('keydown', handleEscapeKey);
      window.removeEventListener('scroll', handleScrollOrResize, true);
      window.removeEventListener('resize', handleScrollOrResize);

      currentOpenDropdown = null;
      currentTriggerButton = null;
    }

    function positionDropdown(triggerEl, dropdown) {
      const triggerRect = triggerEl.getBoundingClientRect();
      const dropdownRect = dropdown.getBoundingClientRect();
      const viewportWidth = window.innerWidth;
      const viewportHeight = window.innerHeight;

      let top, left;

      // تحديد أين نعرض القائمة (أسفل أو أعلى الزر)
      const spaceBelow = viewportHeight - triggerRect.bottom;
      const spaceAbove = triggerRect.top;
      const dropdownHeight = Math.min(dropdownRect.height, viewportHeight *
        0.6);

      if (spaceBelow >= dropdownHeight || spaceBelow > spaceAbove) {
        // عرض أسفل الزر
        top = triggerRect.bottom + 8;
      } else {
        // عرض أعلى الزر
        top = triggerRect.top - dropdownHeight - 8;
      }

      // للموبايل: على الشاشات الصغيرة، اجعل القائمة بعرض كامل تقريباً
      if (viewportWidth < 400) {
        dropdown.style.width = '95vw';
        dropdown.style.maxWidth = '95vw';
        left = (viewportWidth - (viewportWidth * 0.95)) / 2;
      } else {
        // احسب left بحيث تكون القائمة ضمن حدود الشاشة
        // RTL: نبدأ من اليمين
        const isRTL = document.dir === 'rtl' || document.documentElement
          .dir === 'rtl';

        if (isRTL) {
          // في RTL، نحاول محاذاة الحافة اليمنى للقائمة مع الحافة اليمنى للزر
          left = triggerRect.right - dropdown.offsetWidth;
        } else {
          // في LTR، نحاذي الحافة اليسرى
          left = triggerRect.left;
        }

        // تأكد من أن القائمة لا تخرج من الشاشة
        const dropdownWidth = dropdown.offsetWidth;
        const minLeft = 8;
        const maxLeft = viewportWidth - dropdownWidth - 8;

        left = Math.max(minLeft, Math.min(left, maxLeft));
      }

      // Clamp top
      top = Math.max(8, Math.min(top, viewportHeight - dropdownHeight - 8));

      dropdown.style.top = `${top}px`;
      dropdown.style.left = `${left}px`;
    }

    function handleOutsideClick(e) {
      if (!currentOpenDropdown) return;

      const dropdown = currentOpenDropdown;
      const triggerBtn = currentTriggerButton;

      if (!dropdown.contains(e.target) && e.target !== triggerBtn && !
        triggerBtn.contains(e.target)) {
        const sessionId = dropdown.id.replace('switchRoomDropdown_', '');
        closeSwitchRoomDropdown(sessionId);
      }
    }

    function handleEscapeKey(e) {
      if (e.key === 'Escape' && currentOpenDropdown) {
        const sessionId = currentOpenDropdown.id.replace(
          'switchRoomDropdown_', '');
        closeSwitchRoomDropdown(sessionId);
      }
    }

    function handleScrollOrResize() {
      if (currentOpenDropdown && currentTriggerButton) {
        positionDropdown(currentTriggerButton, currentOpenDropdown);
      }
    }

    function trapFocus(element) {
      const focusableElements = element.querySelectorAll(
        'button, [href], input, select, textarea, [tabindex]:not([tabindex="-1"])'
      );
      const firstFocusable = focusableElements[0];
      const lastFocusable = focusableElements[focusableElements.length - 1];

      if (firstFocusable) {
        firstFocusable.focus();
      }

      element.addEventListener('keydown', function(e) {
        if (e.key === 'Tab') {
          if (e.shiftKey) {
            if (document.activeElement === firstFocusable) {
              e.preventDefault();
              lastFocusable.focus();
            }
          } else {
            if (document.activeElement === lastFocusable) {
              e.preventDefault();
              firstFocusable.focus();
            }
          }
        }
      });
    }

    // دعم لوحة المفاتيح للقائمة
    document.addEventListener('keydown', function(e) {
      if (!currentOpenDropdown) return;

      const items = currentOpenDropdown.querySelectorAll(
        '.dropdown-item');
      const currentIndex = Array.from(items).findIndex(item => item ===
        document.activeElement);

      if (e.key === 'ArrowDown') {
        e.preventDefault();
        const nextIndex = (currentIndex + 1) % items.length;
        items[nextIndex].focus();
      } else if (e.key === 'ArrowUp') {
        e.preventDefault();
        const prevIndex = (currentIndex - 1 + items.length) % items
          .length;
        items[prevIndex].focus();
      } else if (e.key === 'Enter' && currentIndex >= 0) {
        e.preventDefault();
        items[currentIndex].click();
      }
    });
  </script>

  <!-- Confirm Card Modal (Reusable) -->
  <div id="confirmCard" class="confirm-card-overlay" style="display: none;">
    <div class="confirm-card">
      <div class="confirm-card-header">
        <i id="confirmIcon" class="fas fa-question-circle"></i>
        <h3 id="confirmTitle">تأكيد الإجراء</h3>
      </div>
      <div class="confirm-card-body">
        <p id="confirmMessage">هل أنت متأكد من هذا الإجراء؟</p>
      </div>
      <div class="confirm-card-footer">
        <button id="confirmCancelBtn" class="confirm-btn confirm-btn-cancel">
          <i class="fas fa-times"></i>
          <span>إلغاء</span>
        </button>
        <button id="confirmOkBtn" class="confirm-btn confirm-btn-ok">
          <i class="fas fa-check"></i>
          <span>تأكيد</span>
        </button>
      </div>
    </div>
  </div>

  <!-- Notice Card (for quick messages) -->
  <div id="noticeCard" class="notice-card" style="display: none;">
    <div class="notice-content">
      <i id="noticeIcon" class="fas fa-info-circle"></i>
      <span id="noticeMessage">رسالة</span>
    </div>
  </div>

  <!-- Print Options Modal -->
  <div id="printOptionsModal" class="print-options-overlay"
    style="display: none;">
    <div class="print-options-modal">
      <div class="print-options-header">
        <h3><i class="fas fa-print"></i> اختر نوع الطباعة</h3>
        <button onclick="closePrintOptionsModal()" class="print-close-btn">
          <i class="fas fa-times"></i>
        </button>
      </div>
      <div class="print-options-content">
        <button onclick="printThermalReceipt('80mm')"
          class="print-option-btn thermal-80">
          <i class="fas fa-receipt"></i>
          <div>
            <span class="print-option-title">طباعة حرارية 80mm</span>
            <span class="print-option-desc">الأكثر انتشاراً</span>
          </div>
        </button>
        <button onclick="printThermalReceipt('58mm')"
          class="print-option-btn thermal-58">
          <i class="fas fa-receipt"></i>
          <div>
            <span class="print-option-title">طباعة حرارية 58mm</span>
            <span class="print-option-desc">حجم صغير</span>
          </div>
        </button>
        <button onclick="printSessionSummary(); closePrintOptionsModal();"
          class="print-option-btn normal-print">
          <i class="fas fa-print"></i>
          <div>
            <span class="print-option-title">طباعة عادية A4</span>
            <span class="print-option-desc">ورق عادي</span>
          </div>
        </button>
      </div>
    </div>
  </div>
  <style>
    /* Confirm Card Overlay */
    .confirm-card-overlay {
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background: rgba(0, 0, 0, 0.6);
      backdrop-filter: blur(4px);
      display: flex;
      justify-content: center;
      align-items: center;
      z-index: 30000;
      opacity: 0;
      transition: opacity 0.3s ease;
    }

    .confirm-card-overlay.show {
      opacity: 1;
    }

    .confirm-card {
      background: #ffffff;
      border-radius: 16px;
      box-shadow: 0 10px 40px rgba(0, 0, 0, 0.3);
      width: 90%;
      max-width: 450px;
      transform: scale(0.9);
      transition: transform 0.3s ease;
      overflow: hidden;
    }

    body.dark-mode .confirm-card {
      background: #1e1e2e;
      box-shadow: 0 10px 40px rgba(0, 0, 0, 0.6);
    }

    .confirm-card-overlay.show .confirm-card {
      transform: scale(1);
    }

    .confirm-card-header {
      background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
      color: white;
      padding: 20px;
      text-align: center;
    }

    .confirm-card-header i {
      font-size: 3rem;
      margin-bottom: 10px;
      display: block;
    }

    .confirm-card-header h3 {
      margin: 0;
      font-size: 1.5rem;
      font-weight: 600;
    }

    .confirm-card-body {
      padding: 30px 20px;
      text-align: center;
    }

    .confirm-card-body p {
      margin: 0;
      font-size: 1.1rem;
      color: #333;
      line-height: 1.6;
    }

    body.dark-mode .confirm-card-body p {
      color: #e0e0e0;
    }

    .confirm-card-footer {
      padding: 15px 20px 20px;
      display: flex;
      gap: 12px;
      justify-content: center;
    }

    .confirm-btn {
      flex: 1;
      padding: 12px 24px;
      border: none;
      border-radius: 10px;
      font-size: 1rem;
      font-weight: 600;
      cursor: pointer;
      transition: all 0.3s ease;
      display: flex;
      align-items: center;
      justify-content: center;
      gap: 8px;
    }

    .confirm-btn-cancel {
      background: #6c757d;
      color: white;
    }

    .confirm-btn-cancel:hover {
      background: #5a6268;
      transform: translateY(-2px);
      box-shadow: 0 4px 12px rgba(108, 117, 125, 0.3);
    }

    .confirm-btn-ok {
      background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
      color: white;
    }

    .confirm-btn-ok:hover {
      background: linear-gradient(135deg, #5568d3 0%, #6a3d8f 100%);
      transform: translateY(-2px);
      box-shadow: 0 4px 12px rgba(102, 126, 234, 0.4);
    }

    /* Notice Card */
    .notice-card {
      position: fixed;
      top: 80px;
      left: 50%;
      transform: translateX(-50%) translateY(-120%);
      background: #ffffff;
      border-radius: 12px;
      box-shadow: 0 8px 24px rgba(0, 0, 0, 0.2);
      padding: 16px 24px;
      z-index: 29000;
      min-width: 300px;
      max-width: 500px;
      transition: transform 0.4s cubic-bezier(0.68, -0.55, 0.265, 1.55);
    }

    body.dark-mode .notice-card {
      background: #2a2a3e;
      box-shadow: 0 8px 24px rgba(0, 0, 0, 0.5);
    }

    .notice-card.show {
      transform: translateX(-50%) translateY(0);
    }

    .notice-content {
      display: flex;
      align-items: center;
      gap: 12px;
      font-size: 1rem;
      color: #333;
    }

    body.dark-mode .notice-content {
      color: #e0e0e0;
    }

    .notice-content i {
      font-size: 1.5rem;
      flex-shrink: 0;
    }

    .notice-content span {
      white-space: pre-line;
      line-height: 1.5;
    }

    .notice-card.error .notice-content i {
      color: #e74c3c;
    }

    .notice-card.success .notice-content i {
      color: #2ecc71;
    }

    .notice-card.info .notice-content i {
      color: #3498db;
    }

    /* Print Options Modal */
    .print-options-overlay {
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background: rgba(0, 0, 0, 0.6);
      display: flex;
      align-items: center;
      justify-content: center;
      z-index: 99999;
      backdrop-filter: blur(4px);
      animation: fadeIn 0.2s ease;
    }

    .print-options-modal {
      background: white;
      border-radius: 16px;
      box-shadow: 0 10px 40px rgba(0, 0, 0, 0.3);
      width: 90%;
      max-width: 450px;
      animation: slideUp 0.3s ease;
      overflow: hidden;
    }

    body.dark-mode .print-options-modal {
      background: #2d3748;
      box-shadow: 0 10px 40px rgba(0, 0, 0, 0.6);
    }

    .print-options-header {
      background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
      color: white;
      padding: 20px;
      display: flex;
      justify-content: space-between;
      align-items: center;
    }

    .print-options-header h3 {
      margin: 0;
      font-size: 1.25rem;
      font-weight: 600;
      display: flex;
      align-items: center;
      gap: 10px;
    }

    .print-close-btn {
      background: rgba(255, 255, 255, 0.2);
      border: none;
      color: white;
      width: 36px;
      height: 36px;
      border-radius: 50%;
      cursor: pointer;
      display: flex;
      align-items: center;
      justify-content: center;
      transition: all 0.2s;
      font-size: 1.1rem;
    }

    .print-close-btn:hover {
      background: rgba(255, 255, 255, 0.3);
      transform: rotate(90deg);
    }

    .print-options-content {
      padding: 24px;
      display: flex;
      flex-direction: column;
      gap: 12px;
    }

    .print-option-btn {
      width: 100%;
      padding: 18px 20px;
      border: 2px solid #e5e7eb;
      border-radius: 12px;
      background: white;
      cursor: pointer;
      transition: all 0.3s;
      display: flex;
      align-items: center;
      gap: 16px;
      text-align: right;
    }

    body.dark-mode .print-option-btn {
      background: #1a202c;
      border-color: #4a5568;
      color: #e2e8f0;
    }

    .print-option-btn:hover {
      transform: translateY(-2px);
      box-shadow: 0 6px 20px rgba(0, 0, 0, 0.15);
    }

    body.dark-mode .print-option-btn:hover {
      box-shadow: 0 6px 20px rgba(0, 0, 0, 0.4);
    }

    .print-option-btn.thermal-80 {
      border-color: #10b981;
      background: linear-gradient(135deg, rgba(16, 185, 129, 0.05) 0%, rgba(5, 150, 105, 0.05) 100%);
    }

    .print-option-btn.thermal-80:hover {
      border-color: #059669;
      background: linear-gradient(135deg, rgba(16, 185, 129, 0.15) 0%, rgba(5, 150, 105, 0.15) 100%);
    }

    .print-option-btn.thermal-58 {
      border-color: #14b8a6;
      background: linear-gradient(135deg, rgba(20, 184, 166, 0.05) 0%, rgba(13, 148, 136, 0.05) 100%);
    }

    .print-option-btn.thermal-58:hover {
      border-color: #0d9488;
      background: linear-gradient(135deg, rgba(20, 184, 166, 0.15) 0%, rgba(13, 148, 136, 0.15) 100%);
    }

    .print-option-btn.normal-print {
      border-color: #3b82f6;
      background: linear-gradient(135deg, rgba(59, 130, 246, 0.05) 0%, rgba(37, 99, 235, 0.05) 100%);
    }

    .print-option-btn.normal-print:hover {
      border-color: #2563eb;
      background: linear-gradient(135deg, rgba(59, 130, 246, 0.15) 0%, rgba(37, 99, 235, 0.15) 100%);
    }

    .print-option-btn i {
      font-size: 2rem;
      min-width: 40px;
      text-align: center;
    }

    .print-option-btn.thermal-80 i {
      color: #10b981;
    }

    .print-option-btn.thermal-58 i {
      color: #14b8a6;
    }

    .print-option-btn.normal-print i {
      color: #3b82f6;
    }

    .print-option-btn>div {
      display: flex;
      flex-direction: column;
      gap: 4px;
      flex: 1;
    }

    .print-option-title {
      font-size: 1.1rem;
      font-weight: 600;
      color: #1f2937;
      display: block;
    }

    body.dark-mode .print-option-title {
      color: #f3f4f6;
    }

    .print-option-desc {
      font-size: 0.875rem;
      color: #6b7280;
      display: block;
    }

    body.dark-mode .print-option-desc {
      color: #9ca3af;
    }

    @keyframes fadeIn {
      from {
        opacity: 0;
      }

      to {
        opacity: 1;
      }
    }

    @keyframes slideUp {
      from {
        opacity: 0;
        transform: translateY(30px);
      }

      to {
        opacity: 1;
        transform: translateY(0);
      }
    }

    /* Responsive للطباعة Modal */
    @media (max-width: 768px) {
      .print-options-modal {
        max-width: 95%;
      }

      .print-options-header h3 {
        font-size: 1.1rem;
      }

      .print-options-content {
        padding: 18px;
      }

      .print-option-btn {
        padding: 16px 18px;
        gap: 12px;
      }

      .print-option-btn i {
        font-size: 1.75rem;
        min-width: 36px;
      }

      .print-option-title {
        font-size: 1rem;
      }

      .print-option-desc {
        font-size: 0.8rem;
      }
    }

    @media (max-width: 480px) {
      .print-options-header {
        padding: 16px;
      }

      .print-options-header h3 {
        font-size: 1rem;
      }

      .print-close-btn {
        width: 32px;
        height: 32px;
        font-size: 1rem;
      }

      .print-options-content {
        padding: 16px;
        gap: 10px;
      }

      .print-option-btn {
        padding: 14px 16px;
        gap: 10px;
      }

      .print-option-btn i {
        font-size: 1.5rem;
        min-width: 32px;
      }

      .print-option-title {
        font-size: 0.95rem;
      }

      .print-option-desc {
        font-size: 0.75rem;
      }
    }

    /* Responsive */
    @media (max-width: 480px) {
      .confirm-card {
        width: 95%;
        max-width: none;
      }

      .confirm-card-header h3 {
        font-size: 1.2rem;
      }

      .confirm-card-body p {
        font-size: 1rem;
      }

      .confirm-btn {
        font-size: 0.95rem;
        padding: 10px 20px;
      }

      .notice-card {
        width: 90%;
        min-width: auto;
        padding: 14px 18px;
      }

      .notice-content {
        font-size: 0.9rem;
        gap: 10px;
      }

      .notice-content i {
        font-size: 1.3rem;
      }

      .notice-content span {
        font-size: 0.9rem;
        line-height: 1.4;
      }
    }
  </style>

  <script>
    // Confirm Card System
    let confirmResolve = null;

    function confirmAction({
      title = 'تأكيد الإجراء',
      message = 'هل أنت متأكد؟',
      confirmText = 'تأكيد',
      cancelText = 'إلغاء',
      icon = 'fa-question-circle'
    } = {}) {
      return new Promise((resolve) => {
        confirmResolve = resolve;

        const overlay = document.getElementById('confirmCard');
        const titleEl = document.getElementById('confirmTitle');
        const messageEl = document.getElementById('confirmMessage');
        const iconEl = document.getElementById('confirmIcon');
        const okBtn = document.getElementById('confirmOkBtn');
        const cancelBtn = document.getElementById('confirmCancelBtn');

        titleEl.textContent = title;
        messageEl.textContent = message;
        iconEl.className = `fas ${icon}`;
        okBtn.querySelector('span').textContent = confirmText;
        cancelBtn.querySelector('span').textContent = cancelText;

        overlay.style.display = 'flex';
        setTimeout(() => overlay.classList.add('show'), 10);

        // Focus on OK button
        okBtn.focus();
      });
    }

    function closeConfirmCard(result) {
      const overlay = document.getElementById('confirmCard');
      overlay.classList.remove('show');
      setTimeout(() => {
        overlay.style.display = 'none';
        if (confirmResolve) {
          confirmResolve(result);
          confirmResolve = null;
        }
      }, 300);
    }

    document.getElementById('confirmOkBtn').addEventListener('click', () =>
      closeConfirmCard(true));
    document.getElementById('confirmCancelBtn').addEventListener('click',
      () =>
      closeConfirmCard(false));

    // Close on overlay click
    document.getElementById('confirmCard').addEventListener('click', (e) => {
      if (e.target.id === 'confirmCard') {
        closeConfirmCard(false);
      }
    });

    // Close on Escape key
    document.addEventListener('keydown', (e) => {
      if (e.key === 'Escape' && document.getElementById('confirmCard')
        .style
        .display === 'flex') {
        closeConfirmCard(false);
      }
    });

    // Notice Card System
    function showNotice({
      type = 'info',
      message = 'رسالة',
      duration = 3000
    } = {}) {
      const noticeCard = document.getElementById('noticeCard');
      const noticeIcon = document.getElementById('noticeIcon');
      const noticeMessage = document.getElementById('noticeMessage');

      // Set icon based on type
      const icons = {
        error: 'fa-exclamation-circle',
        success: 'fa-check-circle',
        info: 'fa-info-circle',
        warning: 'fa-exclamation-triangle'
      };

      noticeCard.className = `notice-card ${type}`;
      noticeIcon.className = `fas ${icons[type] || icons.info}`;
      noticeMessage.textContent = message;

      noticeCard.style.display = 'block';
      setTimeout(() => noticeCard.classList.add('show'), 10);

      setTimeout(() => {
        noticeCard.classList.remove('show');
        setTimeout(() => {
          noticeCard.style.display = 'none';
        }, 400);
      }, duration);
    }

    // Clear Logs with Confirm
    async function confirmClearLogs() {
      const confirmed = await confirmAction({
        title: 'حذف سجل التغييرات',
        message: 'هل أنت متأكد من حذف جميع سجلات التغييرات؟ هذا الإجراء لا يمكن التراجع عنه.',
        confirmText: 'حذف',
        cancelText: 'إلغاء',
        icon: 'fa-trash-alt'
      });

      if (confirmed) {
        document.getElementById('clearLogsForm').submit();
      }
    }

    // Toggle Logs Accordion
    function toggleLogsAccordion() {
      const content = document.getElementById('logsContent');
      const toggle = document.getElementById('logsToggle');

      if (content.style.maxHeight === '0px' || content.style.maxHeight === '') {
        content.style.maxHeight = '600px';
        content.style.opacity = '1';
        content.style.marginTop = '20px';
        toggle.style.transform = 'rotate(180deg)';
      } else {
        content.style.maxHeight = '0';
        content.style.opacity = '0';
        content.style.marginTop = '0';
        toggle.style.transform = 'rotate(0deg)';
      }
    }

    // ══════════════════════════════════════════════════════════════
    //  ESP Modal — End Session Phone Modal (مودال مخصص احترافي)
    // ══════════════════════════════════════════════════════════════
    (function() {
      const PHONE_RE = /^01[0125][0-9]{8}$/;
      let _sid = null,
        _allowed = false,
        _isAdm = false,
        _timer = null;

      /* ── inject CSS once ── */
      function injectCSS() {
        if (document.getElementById('espStyle')) return;
        const s = document.createElement('style');
        s.id = 'espStyle';
        s.textContent = `
          .esp-overlay{position:fixed;inset:0;background:rgba(15,10,40,.55);z-index:999999;
            display:flex;align-items:center;justify-content:center;
            backdrop-filter:blur(3px);animation:espFIn .18s ease}
          @keyframes espFIn{from{opacity:0}to{opacity:1}}
          .esp-card{background:#fff;border-radius:22px;width:92%;max-width:430px;
            box-shadow:0 24px 64px rgba(109,40,217,.22),0 4px 20px rgba(0,0,0,.12);
            overflow:hidden;animation:espSUp .22s cubic-bezier(.34,1.56,.64,1);
            font-family:'Segoe UI',Tahoma,'Arial',sans-serif;direction:rtl}
          @keyframes espSUp{from{transform:translateY(28px) scale(.96);opacity:0}to{transform:translateY(0) scale(1);opacity:1}}
          .esp-hdr{background:linear-gradient(135deg,#6d28d9 0%,#9333ea 100%);
            padding:18px 20px;display:flex;align-items:center;justify-content:space-between}
          .esp-hdr-title{color:#fff;font-weight:800;font-size:1.05rem;display:flex;align-items:center;gap:8px}
          .esp-hdr-close{background:rgba(255,255,255,.2);border:none;border-radius:50%;width:30px;height:30px;
            cursor:pointer;color:#fff;font-size:.9rem;display:flex;align-items:center;justify-content:center;
            transition:background .2s;flex-shrink:0}
          .esp-hdr-close:hover{background:rgba(255,255,255,.38)}
          .esp-body{padding:18px 20px 10px}
          .esp-subtitle{color:#374151;font-size:.88rem;text-align:center;padding:9px 14px;
            background:#f3f4f6;border-radius:10px;margin-bottom:14px;line-height:1.5}
          /* phone card */
          .esp-phone-card{background:linear-gradient(135deg,#faf5ff,#f3e8ff);
            border:1.5px solid #ddd6fe;border-radius:14px;padding:14px}
          .esp-phone-lbl{font-weight:700;color:#6d28d9;font-size:.88rem;margin-bottom:10px;
            display:flex;align-items:center;gap:6px}
          .esp-inp-wrap{position:relative}
          .esp-inp{width:100%;border:2px solid #ddd6fe;border-radius:10px;padding:11px 14px;
            font-size:1rem;outline:none;background:#fff;color:#111827;direction:ltr;
            transition:border-color .2s,box-shadow .2s;box-sizing:border-box;letter-spacing:.05em}
          .esp-inp:focus{border-color:#7c3aed;box-shadow:0 0 0 3px rgba(124,58,237,.15)}
          .esp-inp.valid{border-color:#10b981;box-shadow:0 0 0 3px rgba(16,185,129,.13)}
          .esp-inp.invalid{border-color:#ef4444;box-shadow:0 0 0 3px rgba(239,68,68,.13)}
          /* counter */
          .esp-ctr-row{display:flex;align-items:center;justify-content:space-between;
            margin-top:6px;min-height:22px;gap:8px}
          .esp-ctr{font-size:.78rem;font-weight:700;padding:2px 9px;border-radius:20px;white-space:nowrap;direction:ltr;unicode-bidi:isolate}
          .esp-ctr.c-empty{color:#9ca3af;background:#f3f4f6}
          .esp-ctr.c-ok{color:#059669;background:#d1fae5}
          .esp-ctr.c-partial{color:#d97706;background:#fef3c7}
          .esp-ctr.c-bad{color:#dc2626;background:#fee2e2}
          .esp-ctr-msg{font-size:.77rem;flex:1;text-align:right}
          .esp-ctr-msg.m-ok{color:#059669}.esp-ctr-msg.m-partial{color:#d97706}.esp-ctr-msg.m-bad{color:#dc2626}
          /* autocomplete */
          .esp-ac{position:absolute;top:calc(100% + 4px);left:0;right:0;z-index:50;
            background:#fff;border:1.5px solid #ddd6fe;border-radius:12px;
            box-shadow:0 10px 28px rgba(109,40,217,.15);max-height:210px;overflow-y:auto;display:none}
          .esp-ac-hdr{padding:6px 12px;font-size:.72rem;color:#9ca3af;border-bottom:1px solid #f3f4f6;
            font-weight:600;letter-spacing:.03em}
          .esp-ac-item{display:flex;align-items:center;justify-content:space-between;
            padding:9px 13px;cursor:pointer;transition:background .12s;border-bottom:1px solid #f9f5ff}
          .esp-ac-item:last-child{border-bottom:none}
          .esp-ac-item:hover{background:#faf5ff}
          .esp-ac-name{font-weight:600;color:#374151;font-size:.86rem}
          .esp-ac-ph{color:#7c3aed;font-size:.84rem;font-family:monospace;direction:ltr;letter-spacing:.04em}
          /* save */
          .esp-save{display:flex;align-items:center;gap:8px;margin-top:12px;cursor:pointer;
            color:#4b5563;font-size:.84rem;user-select:none}
          .esp-save input{width:16px;height:16px;accent-color:#7c3aed;flex-shrink:0}
          .esp-note{margin-top:8px;font-size:.74rem;color:#a78bfa;text-align:center;
            display:flex;align-items:center;justify-content:center;gap:4px}
          /* warning */
          .esp-warn{background:#fff7ed;border:1px solid #fdba74;border-radius:10px;
            padding:10px 14px;color:#9a3412;font-size:.82rem;margin-top:2px}
          /* footer */
          .esp-ftr{display:flex;gap:10px;padding:14px 20px 18px;border-top:1px solid #f3f4f6}
          .esp-btn-cancel{flex:1;padding:11px;border:1.5px solid #e5e7eb;border-radius:11px;
            background:#fff;color:#374151;font-size:.9rem;font-weight:600;cursor:pointer;transition:all .2s}
          .esp-btn-cancel:hover{background:#f9fafb;border-color:#c4b5fd}
          .esp-btn-ok{flex:1;padding:11px;border:none;border-radius:11px;
            background:linear-gradient(135deg,#6d28d9,#9333ea);color:#fff;
            font-size:.9rem;font-weight:700;cursor:pointer;transition:all .2s;
            box-shadow:0 4px 14px rgba(109,40,217,.32)}
          .esp-btn-ok:hover:not(:disabled){transform:translateY(-1px);box-shadow:0 6px 18px rgba(109,40,217,.42)}
          .esp-btn-ok:disabled{background:#e5e7eb;color:#9ca3af;cursor:not-allowed;box-shadow:none;transform:none}
          /* skip button — admin only — same row & size */
          .esp-btn-skip{flex:1;padding:11px;border:1.5px solid #e5e7eb;border-radius:11px;
            background:#fff;color:#6b7280;font-size:.9rem;font-weight:600;cursor:pointer;transition:all .2s;
            display:flex;align-items:center;justify-content:center;gap:5px}
          .esp-btn-skip:hover{background:#f9fafb;border-color:#9ca3af;color:#374151}
        `;
        document.head.appendChild(s);
      }

      /* ── inject HTML once ── */
      function injectHTML() {
        if (document.getElementById('espModal')) return;
        const d = document.createElement('div');
        d.id = 'espModal';
        d.className = 'esp-overlay';
        d.style.display = 'none';
        d.innerHTML = `
          <div class="esp-card" role="dialog" aria-modal="true">
            <div class="esp-hdr">
              <div class="esp-hdr-title"><span>🎮</span><span>إنهاء الجلسة</span></div>
              <button class="esp-hdr-close" id="espCloseBtn" aria-label="إغلاق">✕</button>
            </div>
            <div class="esp-body">
              <p class="esp-subtitle">هل تريد إنهاء هذه الجلسة؟ سيتم حساب التكلفة النهائية.</p>

              <!-- قسم الـ SMS -->
              <div id="espPhoneSection" class="esp-phone-card">
                <div class="esp-phone-lbl">📱 رقم هاتف العميل <span style="color:#ef4444;font-size:.85rem;font-weight:700">*</span></div>
                <div class="esp-inp-wrap">
                  <input id="espPhoneInp" type="tel" class="esp-inp" placeholder="مثال: 01012345678"
                    dir="ltr" maxlength="11" autocomplete="off" autocorrect="off"
                    autocapitalize="none" spellcheck="false"
                    inputmode="numeric" pattern="[0-9]*">
                  <div id="espAC" class="esp-ac">
                    <div class="esp-ac-hdr">📋 عملاء مسجلون — اختر أو أكمل الكتابة</div>
                  </div>
                </div>
                <div class="esp-ctr-row">
                  <span id="espCtr" class="esp-ctr c-empty">0 / 11</span>
                  <span id="espCtrMsg" class="esp-ctr-msg"></span>
                </div>
                <label class="esp-save">
                  <input type="checkbox" id="espSaveChk">
                  حفظ الرقم في قائمة العملاء
                </label>

              </div>

              <div id="espWarn" class="esp-warn" style="display:none"></div>
            </div>
            <div class="esp-ftr">
              <button id="espCancelBtn" class="esp-btn-cancel">إلغاء</button>
              <button id="espSkipBtn" class="esp-btn-skip" style="display:none">⏭️ تخطي</button>
              <button id="espOkBtn" class="esp-btn-ok">تأكيد</button>
            </div>
          </div>`;
        document.body.appendChild(d);
        bindEvents();
      }

      /* ── events ── */
      function bindEvents() {
        document.getElementById('espCloseBtn').onclick = hide;
        document.getElementById('espCancelBtn').onclick = hide;
        document.getElementById('espOkBtn').onclick = confirm;
        document.getElementById('espSkipBtn').onclick = skip; // ← زر التخطي
        document.getElementById('espModal').addEventListener('click', e => {
          if (e.target.id === 'espModal') hide();
        });
        document.getElementById('espPhoneInp').addEventListener('input', onInput);
        // ← تطهير اللصق: أرقام فقط، حدّ 11
        document.getElementById('espPhoneInp').addEventListener('paste', e => {
          e.preventDefault();
          const pasted = (e.clipboardData || window.clipboardData).getData('text');
          const digits = pasted.replace(/[^0-9]/g, '').slice(0, 11);
          e.target.value = digits;
          onInput({ target: e.target });
        });
        // ← منع السحب والإفلات (drag-and-drop) للنص غير المُرشَّح
        document.getElementById('espPhoneInp').addEventListener('drop', e => {
          e.preventDefault();
          const pasted = e.dataTransfer?.getData('text') || '';
          const digits = pasted.replace(/[^0-9]/g, '').slice(0, 11);
          e.target.value = digits;
          onInput({ target: e.target });
        });
        document.getElementById('espPhoneInp').addEventListener('keydown', e => {
          if (e.key === 'Enter' && !document.getElementById('espOkBtn').disabled) confirm();
          if (e.key === 'Escape') hide();
        });
        document.addEventListener('keydown', e => {
          if (e.key === 'Escape' && document.getElementById('espModal').style.display !== 'none') hide();
        });
        document.addEventListener('click', e => {
          const ac = document.getElementById('espAC');
          if (ac && !ac.contains(e.target) && e.target.id !== 'espPhoneInp') hideAC();
        });
      }

      /* ── show ── */
      function show(sid, allowed, isAdm, reason) {
        injectCSS();
        injectHTML();
        _sid = sid;
        _allowed = allowed;
        _isAdm = isAdm;

        // Reset fields
        document.getElementById('espPhoneInp').value = '';
        document.getElementById('espSaveChk').checked = false;
        hideAC();
        updateCounter('');

        // زر التخطي — يظهر للأدمن أو من لديه صلاحية skip_sms_invoice
        const skipBtn = document.getElementById('espSkipBtn');
        if (skipBtn) skipBtn.style.display = (allowed && (isAdm || __canSkipSms)) ? 'flex' : 'none';

        const ps = document.getElementById('espPhoneSection');
        const wn = document.getElementById('espWarn');
        if (allowed) {
          ps.style.display = 'block';
          wn.style.display = 'none';
        } else if (isAdm) {
          ps.style.display = 'none';
          wn.style.display = 'block';
          wn.textContent = '⚠️ SMS غير متاح حالياً' + (reason ? ': ' + reason : ' — يمكن تفعيله من الإعدادات');
        } else {
          ps.style.display = 'none';
          wn.style.display = 'none';
        }

        document.getElementById('espModal').style.display = 'flex';
        setTimeout(() => {
          const i = document.getElementById('espPhoneInp');
          if (i) i.focus();
        }, 120);
      }

      function hide(opts) {
        const fromConfirm = opts && opts.fromConfirm === true;
        const fromSkip = opts && opts.fromSkip === true;
        const m = document.getElementById('espModal');
        const wasSid = _sid;
        if (m) m.style.display = 'none';
        _sid = null;
        if (wasSid && !fromConfirm && !fromSkip) {
          fetch('api/session-actions.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ action: 'resume_session_after_preview', session_id: wasSid })
          }).catch(function() {});
          if (typeof window.clearSessionPreviewFreeze === 'function') {
            window.clearSessionPreviewFreeze(wasSid);
          }
        }
      }

      let _confirming = false; // منع الضغط المزدوج
      async function confirm() {
        if (!_sid || _confirming) return;
        _confirming = true;

        const sid = _sid; // ← احفظ قبل hide() تصفّره

        // ← تطهير الرقم من الـ DOM
        const rawPhone = (document.getElementById('espPhoneInp')?.value || '');
        const phone    = rawPhone.replace(/[^0-9]/g, '').slice(0, 11);
        const save     = !!(document.getElementById('espSaveChk')?.checked);

        // ← التحقق الصارم من الصيغة
        if (_allowed && phone && !PHONE_RE.test(phone)) {
          _confirming = false;
          return;
        }
        // ← رفض الإرسال إذا SMS مفعَّل ولم يُدخَل رقم
        if (_allowed && !phone) {
          _confirming = false;
          return;
        }

        if (_allowed && phone) setPendingSms(sid, phone, save);
        else clearPendingSms(sid);

        hide({ fromConfirm: true });
        const f = document.getElementById('endSessionForm_' + sid);
        if (f) f.submit();
        // لا نعيد _confirming = false لأن الصفحة ستُعاد تحميلها بعد submit()
      }

      /* ── skip (admin only) — تخطي الرقم وإنهاء الجلسة مباشرةً ── */
      function skip() {
        if (!_sid || !_isAdm) return; // حماية إضافية: الأدمن فقط
        const sid = _sid;
        clearPendingSms(sid); // لا رقم → لا SMS
        hide({ fromSkip: true });
        const f = document.getElementById('endSessionForm_' + sid);
        if (f) f.submit();
      }

      /* ── phone input handler ── */
      function onInput(e) {
        const raw = e.target.value.replace(/[^0-9]/g, '').slice(0, 11);
        e.target.value = raw;
        updateCounter(raw);
        hideAC();
        clearTimeout(_timer);
        if (_allowed && raw.length >= 6 && raw.length < 11) {
          _timer = setTimeout(() => searchPhone(raw), 320);
        }
      }

      /* ── counter ── */
      function updateCounter(val) {
        const len = val.length;
        const ctr = document.getElementById('espCtr');
        const msg = document.getElementById('espCtrMsg');
        const btn = document.getElementById('espOkBtn');
        const inp = document.getElementById('espPhoneInp');
        ctr.textContent = len + ' / 11';

        if (len === 0) {
          ctr.className = 'esp-ctr c-empty';
          msg.textContent = _allowed ? 'يجب إدخال رقم الهاتف للمتابعة' : '';
          msg.className = _allowed ? 'esp-ctr-msg m-bad' : 'esp-ctr-msg';
          inp.className = 'esp-inp';
          btn.disabled = _allowed; // ← معطَّل عند الفراغ إذا كان SMS مفعَّلاً
        } else if (len === 11 && PHONE_RE.test(val)) {
          ctr.className = 'esp-ctr c-ok';
          msg.textContent = '✓ رقم صحيح';
          msg.className = 'esp-ctr-msg m-ok';
          inp.className = 'esp-inp valid';
          btn.disabled = false;
        } else if (len === 11) {
          ctr.className = 'esp-ctr c-bad';
          msg.textContent = 'تنسيق غير صحيح (يبدأ بـ 010، 011، 012، أو 015)';
          msg.className = 'esp-ctr-msg m-bad';
          inp.className = 'esp-inp invalid';
          btn.disabled = true;
        } else {
          const rem = 11 - len;
          ctr.className = 'esp-ctr c-partial';
          msg.textContent = 'متبقي ' + rem + ' ' + (rem === 1 ? 'رقم' : 'أرقام');
          msg.className = 'esp-ctr-msg m-partial';
          inp.className = 'esp-inp';
          btn.disabled = true;
        }
      }

      /* ── autocomplete ── */
      async function searchPhone(prefix) {
        try {
          const res = await fetch('api/customers.php?action=search_phone&q=' + encodeURIComponent(prefix));
          const data = await res.json();
          if (data.success && data.customers && data.customers.length) showAC(data.customers);
          else hideAC();
        } catch {
          hideAC();
        }
      }

      function showAC(list) {
        const ac = document.getElementById('espAC');
        // keep header, remove old items
        const hdr = ac.querySelector('.esp-ac-hdr');
        ac.innerHTML = '';
        if (hdr) ac.appendChild(hdr);
        list.forEach(c => {
          const item = document.createElement('div');
          item.className = 'esp-ac-item';
          item.innerHTML = `<span class="esp-ac-name">${escHtml(c.name || 'بدون اسم')}</span>
                            <span class="esp-ac-ph">${escHtml(c.phone || '')}</span>`;
          item.addEventListener('mousedown', ev => {
            ev.preventDefault();
            // ← تطهير رقم العميل من قائمة الـ Autocomplete قبل وضعه في الحقل
            const safePhone = (c.phone || '').replace(/[^0-9]/g, '').slice(0, 11);
            document.getElementById('espPhoneInp').value = safePhone;
            updateCounter(safePhone);
            hideAC();
          });
          ac.appendChild(item);
        });
        ac.style.display = 'block';
      }

      function hideAC() {
        const ac = document.getElementById('espAC');
        if (!ac) return;
        const hdr = ac.querySelector('.esp-ac-hdr');
        ac.innerHTML = '';
        if (hdr) ac.appendChild(hdr);
        ac.style.display = 'none';
      }

      function escHtml(s) {
        return String(s).replace(/&/g, '&amp;').replace(/</g, '&lt;').replace(/>/g, '&gt;').replace(/"/g, '&quot;');
      }

      window.espShow = show;
    })();

    // ── إعدادات الخصم (Front-end) — يُحدَّث الحد/المتبقي عبر refreshMyDiscountQuota عند إنهاء الجلسة
    const _discountType      = "percentage";
    const _discountScope     = "both";
    let _maxDiscountValue    = null;
    const _discountEnabled   = false;
    let _canDiscount         = false;
    let _usesLeft            = null;

    async function refreshMyDiscountQuota() {
      try {
        const res = await fetch('api/discount-my-status.php', { credentials: 'same-origin' });
        const d = await res.json();
        if (!d || !d.success) return;
        if (Object.prototype.hasOwnProperty.call(d, 'max_value')) _maxDiscountValue = d.max_value;
        if (Object.prototype.hasOwnProperty.call(d, 'uses_left')) _usesLeft = d.uses_left;
        if (typeof d.can_discount === 'boolean') _canDiscount = d.can_discount;
      } catch (_) {}
    }


    // ─────────────────────────────────────────────────────────────
    //  مودال الخصم  (Discount Pre-Finalize Modal)
    // ─────────────────────────────────────────────────────────────
    (() => {
      let _dmSid        = null;
      let _dmPreview    = null;
      let _dmConfirming = false;

      /* ── CSS ── */
      function injectDmCSS() {
        if (document.getElementById('dmStyle')) return;
        const s = document.createElement('style');
        s.id = 'dmStyle';
        s.textContent = `
          .dm-overlay{position:fixed;inset:0;background:rgba(0,0,0,.55);z-index:9900;
            display:none;align-items:center;justify-content:center;padding:16px}
          .dm-card{background:#fff;border-radius:20px;width:100%;max-width:420px;
            box-shadow:0 20px 60px rgba(0,0,0,.22);overflow:hidden;
            animation:dmPop .22s cubic-bezier(.34,1.56,.64,1)}
          @keyframes dmPop{from{opacity:0;transform:scale(.88)}to{opacity:1;transform:scale(1)}}
          .dm-hdr{background:linear-gradient(135deg,#6d28d9,#9333ea);
            padding:18px 20px;display:flex;align-items:center;justify-content:space-between}
          .dm-hdr-title{color:#fff;font-weight:700;font-size:1rem;display:flex;align-items:center;gap:8px}
          .dm-hdr-close{background:rgba(255,255,255,.18);border:none;border-radius:50%;
            width:30px;height:30px;color:#fff;font-size:.85rem;cursor:pointer;
            display:flex;align-items:center;justify-content:center;transition:background .15s}
          .dm-hdr-close:hover{background:rgba(255,255,255,.32)}
          .dm-body{padding:20px}
          .dm-summary{background:#f8f7ff;border:1.5px solid #ede9fe;border-radius:14px;
            padding:14px 16px;margin-bottom:16px}
          .dm-summary-row{display:flex;justify-content:space-between;align-items:center;
            font-size:.88rem;color:#374151;padding:3px 0}
          .dm-summary-row.total{font-weight:700;font-size:1rem;color:#4c1d95;
            border-top:1px solid #ede9fe;padding-top:8px;margin-top:5px}
          .dm-summary-val{font-weight:600;color:#6d28d9}
          .dm-discount-box{background:#fdf4ff;border:1.5px solid #e9d5ff;border-radius:14px;
            padding:14px 16px;margin-bottom:16px}
          .dm-discount-lbl{font-size:.85rem;font-weight:600;color:#7c3aed;margin-bottom:8px;
            display:flex;align-items:center;gap:6px}
          .dm-discount-row{display:flex;align-items:center;gap:8px}
          .dm-discount-inp{flex:1;padding:9px 12px;border:1.5px solid #c4b5fd;border-radius:10px;
            font-size:.95rem;text-align:center;color:#1f2937;outline:none;transition:border-color .15s}
          .dm-discount-inp:focus{border-color:#7c3aed;box-shadow:0 0 0 3px rgba(124,58,237,.12)}
          .dm-discount-inp.dm-inp-err{border-color:#dc2626}
          .dm-discount-inp:disabled{opacity:.55;background:#f3f4f6;border-color:#e5e7eb;
            color:#9ca3af;cursor:not-allowed;-webkit-text-fill-color:#9ca3af}
          .dm-discount-title-opt{color:#7c3aed;font-weight:600}
          .dm-discount-dead{color:#b91c1c;font-weight:700}
          .dm-discount-box.dm-exhausted .dm-discount-lbl{color:#6b7280}
          .dm-discount-unit{font-size:.85rem;font-weight:700;color:#6d28d9;white-space:nowrap}
          .dm-discount-hint{font-size:.76rem;color:#7c3aed;margin-top:6px}
          .dm-discount-err{font-size:.76rem;color:#dc2626;margin-top:5px;display:none}
          .dm-preview-row{display:flex;justify-content:space-between;align-items:center;
            font-size:.85rem;color:#059669;padding-top:8px;margin-top:6px;
            border-top:1px dashed #a7f3d0}
          .dm-ftr{padding:14px 20px;display:flex;gap:10px;border-top:1px solid #f3f4f6}
          .dm-btn-cancel{flex:0 0 auto;padding:10px 18px;border:1.5px solid #e5e7eb;
            border-radius:11px;background:#fff;color:#6b7280;font-size:.88rem;
            font-weight:600;cursor:pointer;transition:all .15s}
          .dm-btn-cancel:hover{background:#f9fafb;border-color:#9ca3af}
          .dm-btn-ok{flex:1;padding:11px;border:none;border-radius:11px;
            background:linear-gradient(135deg,#6d28d9,#9333ea);color:#fff;
            font-size:.9rem;font-weight:700;cursor:pointer;transition:all .2s;
            box-shadow:0 4px 14px rgba(109,40,217,.3)}
          .dm-btn-ok:hover:not(:disabled){transform:translateY(-1px);
            box-shadow:0 6px 18px rgba(109,40,217,.4)}
          .dm-btn-ok:disabled{opacity:.55;background:#d1d5db;color:#6b7280;cursor:not-allowed;
            box-shadow:none;transform:none;pointer-events:none}
          .dm-spinner{display:inline-block;width:14px;height:14px;
            border:2px solid rgba(255,255,255,.4);border-top-color:#fff;
            border-radius:50%;animation:dmSpin .6s linear infinite;margin-right:6px}
          @keyframes dmSpin{to{transform:rotate(360deg)}}
        `;
        document.head.appendChild(s);
      }

      /* ── HTML ── */
      function injectDmHTML() {
        if (document.getElementById('dmModal')) return;
        const d = document.createElement('div');
        d.id = 'dmModal';
        d.className = 'dm-overlay';
        d.innerHTML = `
          <div class="dm-card" role="dialog" aria-modal="true">
            <div class="dm-hdr">
              <div class="dm-hdr-title"><span>🎮</span><span>إنهاء الجلسة</span></div>
              <button class="dm-hdr-close" id="dmCloseBtn" aria-label="إغلاق">✕</button>
            </div>
            <div class="dm-body">
              <div class="dm-summary" id="dmSummary"></div>
              <div class="dm-discount-box" id="dmDiscountBox" style="display:none">
                <div class="dm-discount-lbl">
                  <i class="fas fa-tag"></i>
                  <span>تطبيق خصم <span id="dmDiscountTitleSuffix" class="dm-discount-title-opt">(اختياري)</span></span>
                </div>
                <div class="dm-discount-row">
                  <input type="number" id="dmDiscountInp" class="dm-discount-inp"
                    min="0" step="0.01" placeholder="0" inputmode="decimal">
                  <span class="dm-discount-unit" id="dmDiscountUnit"></span>
                </div>
                <div class="dm-discount-hint" id="dmDiscountHint"></div>
                <div class="dm-discount-err"  id="dmDiscountErr"></div>
                <div class="dm-preview-row"   id="dmAfterRow" style="display:none">
                  <span>💰 الإجمالي بعد الخصم</span>
                  <span id="dmAfterVal" style="font-weight:700"></span>
                </div>
              </div>
            </div>
            <div class="dm-ftr">
              <button class="dm-btn-cancel" id="dmCancelBtn">إلغاء</button>
              <button class="dm-btn-ok"     id="dmOkBtn">تأكيد وإنهاء</button>
            </div>
          </div>`;
        document.body.appendChild(d);
        document.getElementById('dmCloseBtn').onclick  = dmCancel;
        document.getElementById('dmCancelBtn').onclick = dmCancel;
        document.getElementById('dmOkBtn').onclick     = dmConfirm;
        document.getElementById('dmModal').addEventListener('click', e => {
          if (e.target.id === 'dmModal') dmCancel();
        });
        document.getElementById('dmDiscountInp').addEventListener('input', dmOnInput);
        document.addEventListener('keydown', e => {
          if (e.key === 'Escape' && document.getElementById('dmModal')?.style.display !== 'none') dmCancel();
        });
      }

      /* ── ملخص الجلسة ── */
      function buildSummary(p) {
        const fmt = v => parseFloat(v || 0).toFixed(2) + ' ' + CURRENCY_SYMBOL;
        let rows = '';
        if (!p.is_cafe) {
          if ((p.session_amount || 0) > 0)
            rows += `<div class="dm-summary-row"><span>🎮 تكلفة الوقت</span><span class="dm-summary-val">${fmt(p.session_amount)}</span></div>`;
        }
        if ((p.orders_cost || 0) > 0)
          rows += `<div class="dm-summary-row"><span>🛒 الطلبات</span><span class="dm-summary-val">${fmt(p.orders_cost)}</span></div>`;
        rows += `<div class="dm-summary-row total"><span>الإجمالي</span><span>${fmt(p.total_amount)}</span></div>`;
        return rows;
      }

      /* ── show ── */
      function dmShow(sid, previewData) {
        injectDmCSS();
        injectDmHTML();
        _dmSid        = sid;
        _dmPreview    = previewData;
        _dmConfirming = false;

        document.getElementById('dmSummary').innerHTML = buildSummary(previewData);

        const canDiscount = _discountEnabled && _canDiscount;
        document.getElementById('dmDiscountBox').style.display = canDiscount ? 'block' : 'none';

        if (canDiscount) {
          const box  = document.getElementById('dmDiscountBox');
          const inp  = document.getElementById('dmDiscountInp');
          const suff = document.getElementById('dmDiscountTitleSuffix');
          const hintEl = document.getElementById('dmDiscountHint');
          inp.value  = '';
          inp.max    = _discountType === 'percentage' ? '100' : '9999999';
          document.getElementById('dmDiscountUnit').textContent = _discountType === 'percentage' ? '%' : CURRENCY_SYMBOL;
          document.getElementById('dmDiscountErr').style.display  = 'none';
          document.getElementById('dmAfterRow').style.display     = 'none';
          inp.classList.remove('dm-inp-err');
          const hints = [];
          if (_maxDiscountValue !== null) {
            const u = _discountType === 'percentage' ? '%' : ' ' + CURRENCY_SYMBOL;
            hints.push(`الحد الأقصى: ${_maxDiscountValue}${u}`);
          }
          if (_usesLeft !== null) hints.push(`متبقي: ${_usesLeft} استخدام`);

          const usesExhausted = (_usesLeft !== null && Number(_usesLeft) === 0);
          if (usesExhausted) {
            box.classList.add('dm-exhausted');
            inp.disabled = true;
            inp.setAttribute('aria-disabled', 'true');
            inp.setAttribute('title', 'لا توجد مرات خصم متبقية في هذه الفترة');
            if (suff) {
              suff.textContent = '(منتهي)';
              suff.className = 'dm-discount-dead';
            }
            hintEl.textContent = '';
            const line = hints.join('  •  ');
            hintEl.appendChild(document.createTextNode(line));
            hintEl.appendChild(document.createTextNode(' '));
            const sp = document.createElement('span');
            sp.className = 'dm-discount-dead';
            sp.textContent = '• منتهي';
            hintEl.appendChild(sp);
          } else {
            box.classList.remove('dm-exhausted');
            inp.disabled = false;
            inp.removeAttribute('aria-disabled');
            inp.removeAttribute('title');
            if (suff) {
              suff.textContent = '(اختياري)';
              suff.className = 'dm-discount-title-opt';
            }
            hintEl.textContent = hints.join('  •  ');
          }
        }

        const okBtn = document.getElementById('dmOkBtn');
        okBtn.disabled  = false;
        okBtn.setAttribute('aria-disabled', 'false');
        okBtn.innerHTML = 'تأكيد وإنهاء';
        document.getElementById('dmModal').style.display = 'flex';
        if (canDiscount) {
          dmSyncOkButtonFromDiscount();
          const inpFocus = document.getElementById('dmDiscountInp');
          if (inpFocus && !inpFocus.disabled) {
            setTimeout(() => inpFocus.focus(), 150);
          }
        }
      }

      /* ── live preview while typing + تعطيل «تأكيد وإنهاء» عند قيمة خصم غير صالحة ── */
      function dmSyncOkButtonFromDiscount() {
        const okBtn = document.getElementById('dmOkBtn');
        const inp   = document.getElementById('dmDiscountInp');
        if (!okBtn || !inp) return;
        if (okBtn.innerHTML.includes('dm-spinner') || /جاري/.test(okBtn.innerHTML)) return;
        if (inp.disabled) {
          okBtn.disabled = false;
          okBtn.setAttribute('aria-disabled', 'false');
          return;
        }
        if (!_discountEnabled || !_canDiscount) {
          okBtn.disabled = false;
          okBtn.setAttribute('aria-disabled', 'false');
          return;
        }
        const raw = inp.value.trim();
        const val = parseFloat(inp.value);
        if (!raw || isNaN(val) || val <= 0) {
          okBtn.disabled = false;
          okBtn.setAttribute('aria-disabled', 'false');
          return;
        }
        let invalid = false;
        if (_discountType === 'percentage' && val > 100) invalid = true;
        if (_maxDiscountValue !== null && val > _maxDiscountValue) invalid = true;
        okBtn.disabled = invalid;
        okBtn.setAttribute('aria-disabled', invalid ? 'true' : 'false');
      }

      function dmOnInput() {
        const inp  = document.getElementById('dmDiscountInp');
        const err  = document.getElementById('dmDiscountErr');
        const after= document.getElementById('dmAfterRow');
        const afterVal = document.getElementById('dmAfterVal');
        if (inp.disabled) return;
        const raw  = inp.value.trim();
        const val  = parseFloat(inp.value);

        err.style.display  = 'none';
        after.style.display= 'none';
        inp.classList.remove('dm-inp-err');
        if (!raw || isNaN(val) || val <= 0) {
          dmSyncOkButtonFromDiscount();
          return;
        }

        if (_discountType === 'percentage' && val > 100) {
          err.textContent = 'النسبة لا تتجاوز 100%';
          err.style.display = 'block';
          inp.classList.add('dm-inp-err');
          dmSyncOkButtonFromDiscount();
          return;
        }
        if (_maxDiscountValue !== null && val > _maxDiscountValue) {
          const u = _discountType === 'percentage' ? '%' : ' ' + CURRENCY_SYMBOL;
          err.textContent = `الحد الأقصى المسموح لك: ${_maxDiscountValue}${u}`;
          err.style.display = 'block';
          inp.classList.add('dm-inp-err');
          dmSyncOkButtonFromDiscount();
          return;
        }
        const base = parseFloat(_dmPreview?.total_amount || 0);
        const discAmt = _discountType === 'percentage' ? base * val / 100 : Math.min(val, base);
        afterVal.textContent = Math.max(0, base - discAmt).toFixed(2) + ' ' + CURRENCY_SYMBOL;
        after.style.display = 'flex';
        dmSyncOkButtonFromDiscount();
      }

      /* ── validation ── */
      function dmValidate() {
        if (!_discountEnabled || !_canDiscount) return true;
        const inp = document.getElementById('dmDiscountInp');
        const err = document.getElementById('dmDiscountErr');
        if (inp.disabled) return true;
        const val = parseFloat(inp.value);
        if (!inp.value.trim() || isNaN(val) || val <= 0) return true;
        if (_discountType === 'percentage' && val > 100) {
          err.textContent = 'النسبة لا تتجاوز 100%';
          err.style.display = 'block'; inp.classList.add('dm-inp-err');
          return false;
        }
        if (_maxDiscountValue !== null && val > _maxDiscountValue) {
          const u = _discountType === 'percentage' ? '%' : ' ' + CURRENCY_SYMBOL;
          err.textContent = `الحد الأقصى المسموح لك: ${_maxDiscountValue}${u}`;
          err.style.display = 'block'; inp.classList.add('dm-inp-err');
          return false;
        }
        return true;
      }

      /* ── cancel → استئناف الجلسة المجمدة ── */
      async function dmCancel() {
        const sid = _dmSid;
        document.getElementById('dmModal').style.display = 'none';
        _dmSid = null; _dmPreview = null;
        if (!sid) return;
        // مسح الخصم المعلق عند الإلغاء
        sessionStorage.removeItem('pendingDiscount_' + sid);
        sessionStorage.removeItem('pendingDiscountType_' + sid);
        try {
          await fetch('api/session-actions.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ action: 'resume_session_after_preview', session_id: sid })
          });
        } catch (_) {}
        if (typeof window.clearSessionPreviewFreeze === 'function') {
          window.clearSessionPreviewFreeze(sid);
        }
      }

      /* ── confirm ── */
      async function dmConfirm() {
        if (!_dmSid || _dmConfirming) return;
        if (!dmValidate()) return;
        _dmConfirming = true;
        const sid = _dmSid;

        const discountVal = parseFloat(document.getElementById('dmDiscountInp')?.value || '0') || 0;
        if (discountVal > 0) {
          sessionStorage.setItem('pendingDiscount_' + sid, String(discountVal));
          sessionStorage.setItem('pendingDiscountType_' + sid, _discountType || 'percentage');
        } else {
          sessionStorage.removeItem('pendingDiscount_' + sid);
          sessionStorage.removeItem('pendingDiscountType_' + sid);
        }

        const btn = document.getElementById('dmOkBtn');
        btn.disabled = true;
        btn.innerHTML = '<span class="dm-spinner"></span> جاري المعالجة...';

        document.getElementById('dmModal').style.display = 'none';
        _dmSid = null;

        const formEl = document.getElementById('endSessionForm_' + sid);
        if (!formEl) { _dmConfirming = false; return; }

        let smsAllowed = false, smsReason = '';
        try {
          const st = await fetchSmsStatus();
          smsAllowed = !!(st && st.success && st.allowed);
          smsReason  = (st && st.reason) ? String(st.reason) : '';
        } catch (_) {}

        if (smsAllowed) {
          espShow(sid, smsAllowed, !!(__isAdmin || __canSkipSms), smsReason);
        } else {
          clearPendingSms(sid);
          formEl.submit();
        }
      }

      window.dmShow   = dmShow;
      window.dmCancel = dmCancel;
    })();

    /** تجميد العداد والسعر في الواجهة أثناء مودال إنهاء الجلسة / الخصم (يتزامن مع freezeSessionSnapshot في السيرفر) */
    window.applySessionPreviewFreeze = function(sessionId) {
      const sid = String(sessionId);
      const card = document.querySelector('.session-card[data-session-id="' + sid + '"]');
      if (!card) return;
      card.dataset.previewFinalizePending = '1';
      card.querySelectorAll('.timer-display').forEach(function(el) { el.classList.add('paused'); });
      card.querySelectorAll('.current-amount').forEach(function(el) { el.classList.add('paused'); });
    };
    window.clearSessionPreviewFreeze = function(sessionId) {
      const sid = String(sessionId);
      const card = document.querySelector('.session-card[data-session-id="' + sid + '"]');
      if (!card) return;
      delete card.dataset.previewFinalizePending;
      card.querySelectorAll('.timer-display').forEach(function(el) { el.classList.remove('paused'); });
      card.querySelectorAll('.current-amount').forEach(function(el) { el.classList.remove('paused'); });
    };

    // ─────────────────────────────────────────────────────────────
    //  confirmEndSession (نقطة الدخول الجديدة)
    // ─────────────────────────────────────────────────────────────
    async function confirmEndSession(sessionId) {
      const formEl = document.getElementById('endSessionForm_' + sessionId);
      if (!formEl) return;

      // تجميد الجلسة واسترجاع بيانات اللحظة الحالية
      let preview = null;
      try {
        const res = await fetch('api/session-actions.php', {
          method: 'POST',
          headers: { 'Content-Type': 'application/json' },
          body: JSON.stringify({ action: 'preview_end_session', session_id: sessionId })
        });
        preview = await res.json();
      } catch (e) {
        showNotice({ type: 'error', message: 'تعذّر تجميد الجلسة: ' + e.message });
        return;
      }
      if (!preview || !preview.success) {
        showNotice({ type: 'error', message: preview?.message || 'خطأ في معاينة الجلسة' });
        return;
      }

      if (typeof window.applySessionPreviewFreeze === 'function') {
        window.applySessionPreviewFreeze(sessionId);
      }

      /** مزامنة حد الخصم وعدد المرات المتبقية من السيرفر (بعد تعديل الأدمن مباشرة دون إعادة تحميل الصفحة) */
      await refreshMyDiscountQuota();

      /** نفس شرط إظهار كارت الخصم في المودال */
      const needDiscountUi = _discountEnabled && _canDiscount;

      let st = null;
      try {
        st = await fetchSmsStatus();
      } catch (_) {}
      const smsAllowed = !!(st && st.success && st.allowed);
      const smsReason = (st && st.reason) ? String(st.reason) : '';

      // لا صلاحية خصم للموظف ولا مسار SMS — تخطّي مودال الملخص والانتقال مباشرة لإنهاء الجلسة (الإيصال)
      if (!needDiscountUi && !smsAllowed) {
        clearPendingSms(sessionId);
        sessionStorage.removeItem('pendingDiscount_' + sessionId);
        sessionStorage.removeItem('pendingDiscountType_' + sessionId);
        formEl.submit();
        return;
      }

      // SMS مفعّل ولا يوجد خصم — كارت رقم العميل فقط (بدون مودال الملخص)
      if (!needDiscountUi && smsAllowed && typeof window.espShow === 'function') {
        clearPendingSms(sessionId);
        sessionStorage.removeItem('pendingDiscount_' + sessionId);
        sessionStorage.removeItem('pendingDiscountType_' + sessionId);
        window.espShow(sessionId, smsAllowed, !!(__isAdmin || __canSkipSms), smsReason);
        return;
      }

      // يوجد خصم (أو يُفضّل المودال) — ملخص + خصم اختياري ثم SMS أو إرسال النموذج
      dmShow(sessionId, preview);
    }
  </script>

  <!-- Footer - Dynamic Branding -->
  
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

</html>