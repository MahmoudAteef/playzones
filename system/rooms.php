<?php
require_once __DIR__ . '/config/system.php';
require_once __DIR__ . '/config/database.php';
require_once __DIR__ . '/includes/auth_helper.php';

$user = getCurrentUser();
if (!$user) {
    header('Location: login.php');
    exit;
}

$displayName    = htmlspecialchars($user['full_name'] ?: $user['username']);
$currencySymbol = htmlspecialchars($user['currency_symbol'] ?? 'جنيه');
$clientId       = (int)$user['client_id'];
$userRole       = $user['role'];
$isAdmin        = $userRole === 'admin';
$canAdd         = $isAdmin || !empty($user['perm_rooms']);
$canEdit        = $isAdmin || !empty($user['perm_rooms']);
$canDelete      = $isAdmin;

// جيب أنواع الأجهزة من الداتابيز
$pdo = getDB();
$dtStmt = $pdo->prepare("SELECT slug, name_ar, name_en FROM device_types WHERE client_id = ? AND is_active = 1 ORDER BY sort_order");
$dtStmt->execute([$clientId]);
$deviceTypes = $dtStmt->fetchAll();
?>
<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>إدارة الغرف - Play Zone</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@300;400;600;700&display=swap" rel="stylesheet">
  <script src="https://cdn.tailwindcss.com"></script>
  <style>html{-webkit-text-size-adjust:100%;text-size-adjust:100%;}*{-webkit-font-smoothing:antialiased;-moz-osx-font-smoothing:grayscale;}</style>

  <!-- العملة من الداتابيز -->
  <script>const CURRENCY_SYMBOL = '<?= $currencySymbol ?>';</script>

  <script>
    (function() {
      try {
        var ls = window.localStorage;
        var val = ls ? ls.getItem('darkMode') : null;
        var shouldBeDark = (val === null) ? true : (val === 'true');
        if (shouldBeDark) document.documentElement.style.backgroundColor = '#1a1a2e';
        var applyToBody = function() {
          if (shouldBeDark) document.body.classList.add('dark-mode');
          else document.body.classList.remove('dark-mode');
        };
        if (document.body) applyToBody();
        else document.addEventListener('DOMContentLoaded', applyToBody);
      } catch (e) {
        document.documentElement.style.backgroundColor = '#1a1a2e';
        var fallback = function() { document.body.classList.add('dark-mode'); };
        if (document.body) fallback();
        else document.addEventListener('DOMContentLoaded', fallback);
      }
    })();
  </script>

  <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>

  <style>
    @media (min-width: 1024px) { html { font-size: 90%; } }
    * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Cairo', sans-serif; }
    body { background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); min-height: 100vh; transition: background 0.3s ease; }
    body.dark-mode { background: linear-gradient(135deg, #1a1a2e 0%, #16213e 100%); }
    .header-wrapper { width: 96%; margin: 0 auto; padding: 12px 0; box-sizing: border-box; }
    .page-wrapper { width: 96%; margin: 0 auto; padding: 0 0 20px; box-sizing: border-box; }
    .header { background: rgba(255,255,255,0.95); backdrop-filter: blur(10px); border-radius: 15px; padding: 15px 25px; margin-bottom: 25px; box-shadow: 0 4px 15px rgba(0,0,0,0.1); display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 15px; }
    body.dark-mode .header { background: rgba(30,41,59,0.95); box-shadow: 0 4px 15px rgba(0,0,0,0.3); }
    .logo { font-size: 2rem; font-weight: bold; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text; cursor: pointer; transition: transform 0.3s ease; }
    .logo:hover { transform: scale(1.05); }
    .header-actions { display: flex; align-items: center; gap: 12px; flex-wrap: wrap; }
    .dark-mode-toggle { background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; border: none; width: 40px; height: 40px; border-radius: 50%; cursor: pointer; display: flex; align-items: center; justify-content: center; transition: all 0.3s ease; box-shadow: 0 2px 8px rgba(0,0,0,0.2); }
    .dark-mode-toggle:hover { transform: scale(1.1); }
    body.dark-mode .dark-mode-toggle { background: linear-gradient(135deg, #fbbf24 0%, #f59e0b 100%); }
    .back-btn { background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; border: none; padding: 10px 20px; border-radius: 25px; cursor: pointer; display: none; align-items: center; gap: 8px; transition: all 0.3s ease; font-weight: 600; font-size: 0.95rem; box-shadow: 0 2px 8px rgba(0,0,0,0.2); }
    .back-btn:hover { transform: translateY(-2px); }
    body.dark-mode .back-btn { background: linear-gradient(135deg, #4f46e5 0%, #7c3aed 100%); }
    @media (min-width: 1024px) { .back-btn { display: inline-flex; } }
    .user-menu { position: relative; }
    .user-btn { background: white; border: 2px solid #e5e7eb; padding: 8px 16px; border-radius: 25px; cursor: pointer; display: flex; align-items: center; gap: 8px; transition: all 0.3s ease; font-weight: 600; color: #374151; }
    body.dark-mode .user-btn { background: #1e293b; border-color: #334155; color: #e2e8f0; }
    .user-btn:hover { border-color: #667eea; transform: translateY(-2px); }
    .main-content { background: white; border-radius: 15px; padding: 25px; box-shadow: 0 4px 15px rgba(0,0,0,0.1); min-height: 500px; }
    body.dark-mode .main-content { background: #1e293b; color: #e2e8f0; }
    .page-title { font-size: 1.75rem; font-weight: bold; color: #1f2937; margin-bottom: 20px; display: flex; align-items: center; gap: 12px; }
    body.dark-mode .page-title { color: #f1f5f9; }
    .page-title i { color: #667eea; font-size: 2rem; }
    .toolbar { display: flex; justify-content: space-between; align-items: center; gap: 15px; margin-bottom: 25px; flex-wrap: wrap; }
    .toolbar-left { display: flex; gap: 10px; flex-wrap: wrap; flex: 1; }
    .toolbar-right { display: flex; gap: 10px; flex-wrap: wrap; }
    .btn { padding: 10px 20px; border-radius: 8px; border: none; cursor: pointer; font-weight: 600; transition: all 0.3s ease; display: inline-flex; align-items: center; gap: 8px; font-size: 0.95rem; }
    .btn-primary { background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; box-shadow: 0 2px 8px rgba(102,126,234,0.3); }
    .btn-primary:hover:not(:disabled) { transform: translateY(-2px); }
    .btn-primary:disabled { opacity: 0.5; cursor: not-allowed; }
    .btn-secondary { background: #f3f4f6; color: #374151; }
    body.dark-mode .btn-secondary { background: #334155; color: #cbd5e1; }
    .btn-secondary:hover { background: #e5e7eb; }
    body.dark-mode .btn-secondary:hover { background: #475569; }
    .search-box { flex: 1; min-width: 250px; max-width: 400px; position: relative; }
    .search-input { width: 100%; padding: 10px 40px 10px 15px; border: 2px solid #e5e7eb; border-radius: 8px; font-size: 0.95rem; transition: all 0.3s ease; }
    body.dark-mode .search-input { background: #0f172a; border-color: #334155; color: #e2e8f0; }
    .search-input:focus { outline: none; border-color: #667eea; box-shadow: 0 0 0 3px rgba(102,126,234,0.1); }
    .search-icon { position: absolute; left: 12px; top: 50%; transform: translateY(-50%); color: #9ca3af; pointer-events: none; }
    .filter-btn { background: white; border: 2px solid #e5e7eb; padding: 10px 16px; border-radius: 8px; cursor: pointer; display: flex; align-items: center; gap: 8px; font-weight: 600; color: #374151; transition: all 0.3s ease; }
    body.dark-mode .filter-btn { background: #0f172a; border-color: #334155; color: #e2e8f0; }
    .filter-btn:hover { border-color: #667eea; }
    .table-container { overflow-x: auto; border-radius: 12px; border: 1px solid #e5e7eb; }
    body.dark-mode .table-container { border-color: #334155; }
    .rooms-table { width: 100%; border-collapse: collapse; min-width: 800px; }
    .rooms-table thead { background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; }
    .rooms-table th { padding: 15px 12px; text-align: right; font-weight: 600; font-size: 0.95rem; white-space: nowrap; }
    .rooms-table tbody tr { border-bottom: 1px solid #e5e7eb; transition: background 0.2s ease; }
    body.dark-mode .rooms-table tbody tr { border-bottom-color: #334155; }
    .rooms-table tbody tr:hover { background: #f9fafb; }
    body.dark-mode .rooms-table tbody tr:hover { background: #0f172a; }
    .rooms-table td { padding: 12px; color: #374151; font-size: 0.9rem; }
    body.dark-mode .rooms-table td { color: #cbd5e1; }
    .status-badge { display: inline-flex; align-items: center; gap: 6px; padding: 4px 12px; border-radius: 20px; font-size: 0.85rem; font-weight: 600; }
    .status-active { background: #d1fae5; color: #065f46; }
    .status-inactive { background: #fee2e2; color: #991b1b; }
    .status-maintenance { background: #fef3c7; color: #92400e; }
    body.dark-mode .status-active { background: rgba(16,185,129,0.2); color: #6ee7b7; }
    body.dark-mode .status-inactive { background: rgba(239,68,68,0.2); color: #fca5a5; }
    body.dark-mode .status-maintenance { background: rgba(245,158,11,0.2); color: #fcd34d; }
    .action-btns { display: flex; gap: 6px; justify-content: center; }
    .action-btn { width: 32px; height: 32px; border-radius: 6px; border: none; cursor: pointer; display: flex; align-items: center; justify-content: center; transition: all 0.2s ease; font-size: 0.9rem; }
    .action-btn-view { background: #dbeafe; color: #1e40af; }
    .action-btn-view:hover { background: #3b82f6; color: white; transform: translateY(-2px); }
    .action-btn-edit { background: #fef3c7; color: #92400e; }
    .action-btn-edit:hover { background: #f59e0b; color: white; transform: translateY(-2px); }
    .action-btn-delete { background: #fee2e2; color: #991b1b; }
    .action-btn-delete:hover { background: #ef4444; color: white; transform: translateY(-2px); }
    .room-cards { display: none; }
    @media (max-width: 1023px) {
      .table-container { display: none; }
      .room-cards { display: block; }
      .room-card { background: white; border: 1px solid #e5e7eb; border-radius: 12px; padding: 16px; margin-bottom: 12px; transition: all 0.3s ease; }
      body.dark-mode .room-card { background: #0f172a; border-color: #334155; }
      .room-card:hover { box-shadow: 0 4px 12px rgba(0,0,0,0.1); transform: translateY(-2px); }
      .room-card-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 12px; padding-bottom: 12px; border-bottom: 1px solid #e5e7eb; }
      body.dark-mode .room-card-header { border-bottom-color: #334155; }
      .room-card-title { font-size: 1.1rem; font-weight: 700; color: #1f2937; display: flex; align-items: center; gap: 8px; }
      body.dark-mode .room-card-title { color: #f1f5f9; }
      .room-card-body { display: grid; grid-template-columns: 1fr 1fr; gap: 10px; margin-bottom: 12px; }
      .room-card-field { display: flex; flex-direction: column; gap: 4px; }
      .room-card-label { font-size: 0.75rem; color: #6b7280; font-weight: 600; }
      body.dark-mode .room-card-label { color: #94a3b8; }
      .room-card-value { font-size: 0.9rem; color: #111827; font-weight: 600; }
      body.dark-mode .room-card-value { color: #e2e8f0; }
      .room-card-actions { display: flex; gap: 8px; padding-top: 12px; border-top: 1px solid #e5e7eb; }
      body.dark-mode .room-card-actions { border-top-color: #334155; }
      .room-card-actions .action-btn { flex: 1; height: 38px; }
    }
    .empty-state { text-align: center; padding: 60px 20px; color: #6b7280; }
    body.dark-mode .empty-state { color: #94a3b8; }
    .empty-state i { font-size: 4rem; margin-bottom: 20px; opacity: 0.3; }
    .empty-state h3 { font-size: 1.5rem; margin-bottom: 10px; color: #374151; }
    body.dark-mode .empty-state h3 { color: #cbd5e1; }
    .modal { display: none; position: fixed; inset: 0; background: rgba(0,0,0,0.5); z-index: 9999; padding: 20px; overflow-y: auto; align-items: center; justify-content: center; }
    .modal.active { display: flex; }
    .modal-content { background: white; border-radius: 12px; max-width: 520px; width: 100%; box-shadow: 0 10px 40px rgba(0,0,0,0.2); transform: scale(0.9); opacity: 0; transition: all 0.3s ease; }
    body.dark-mode .modal-content { background: #1e293b; }
    .modal.active .modal-content { transform: scale(1); opacity: 1; }
    .modal-header { padding: 14px 18px; border-bottom: 1px solid #e5e7eb; display: flex; justify-content: space-between; align-items: center; }
    body.dark-mode .modal-header { border-bottom-color: #334155; }
    .modal-title { font-size: 1.25rem; font-weight: 700; color: #1f2937; display: flex; align-items: center; gap: 8px; }
    body.dark-mode .modal-title { color: #f1f5f9; }
    .modal-close { width: 32px; height: 32px; border-radius: 50%; border: none; background: #f3f4f6; color: #6b7280; cursor: pointer; display: flex; align-items: center; justify-content: center; transition: all 0.2s ease; font-size: 1.1rem; }
    body.dark-mode .modal-close { background: #334155; color: #94a3b8; }
    .modal-close:hover { background: #ef4444; color: white; transform: rotate(90deg); }
    .modal-body { padding: 18px; }
    .form-group { margin-bottom: 14px; }
    .form-label { display: block; margin-bottom: 6px; font-weight: 600; color: #374151; font-size: 0.875rem; }
    body.dark-mode .form-label { color: #cbd5e1; }
    .form-input, .form-select { width: 100%; padding: 8px 12px; border: 2px solid #e5e7eb; border-radius: 7px; font-size: 0.875rem; transition: all 0.3s ease; font-family: 'Cairo', sans-serif; height: 38px; }
    body.dark-mode .form-input, body.dark-mode .form-select { background: #0f172a; border-color: #334155; color: #e2e8f0; }
    .form-input:focus, .form-select:focus { outline: none; border-color: #667eea; box-shadow: 0 0 0 3px rgba(102,126,234,0.1); }
    .modal-footer { padding: 14px 18px; border-top: 1px solid #e5e7eb; display: flex; gap: 8px; justify-content: flex-end; }
    body.dark-mode .modal-footer { border-top-color: #334155; }
    .modal-footer .btn { padding: 8px 16px; font-size: 0.875rem; }
    .room-limit-alert { background: linear-gradient(135deg, #fef3c7 0%, #fde68a 100%); border: 1px solid #f59e0b; border-radius: 12px; padding: 16px; margin-bottom: 16px; box-shadow: 0 4px 12px rgba(245,158,11,0.15); position: relative; z-index: 10; }
    body.dark-mode .room-limit-alert { background: linear-gradient(135deg, #451a03 0%, #78350f 100%); border-color: #f59e0b; }
    .alert-content { display: flex; align-items: center; gap: 16px; }
    .alert-icon { flex-shrink: 0; width: 48px; height: 48px; background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%); border-radius: 50%; display: flex; align-items: center; justify-content: center; color: white; font-size: 20px; }
    .alert-text { flex: 1; min-width: 0; }
    .alert-text h4 { margin: 0 0 4px 0; font-size: 1.1rem; font-weight: 700; color: #92400e; }
    body.dark-mode .alert-text h4 { color: #fbbf24; }
    .alert-text p { margin: 0; font-size: 0.9rem; color: #a16207; }
    body.dark-mode .alert-text p { color: #fcd34d; }
    .alert-actions { flex-shrink: 0; display: flex; gap: 8px; flex-wrap: wrap; }
    .btn-outline-primary { background: transparent; border: 2px solid #3b82f6; color: #3b82f6; padding: 8px 16px; border-radius: 8px; font-size: 0.85rem; font-weight: 600; cursor: pointer; transition: all 0.3s ease; display: inline-flex; align-items: center; gap: 6px; }
    .btn-outline-primary:hover { background: #3b82f6; color: white; transform: translateY(-1px); }
    .btn-outline-success { background: transparent; border: 2px solid #10b981; color: #10b981; padding: 8px 16px; border-radius: 8px; font-size: 0.85rem; font-weight: 600; cursor: pointer; transition: all 0.3s ease; display: inline-flex; align-items: center; gap: 6px; }
    .btn-outline-success:hover { background: #10b981; color: white; transform: translateY(-1px); }
    .btn-sm { padding: 6px 12px; font-size: 0.8rem; }
    .spinner { border: 3px solid #f3f4f6; border-top: 3px solid #667eea; border-radius: 50%; width: 40px; height: 40px; animation: spin 1s linear infinite; margin: 20px auto; }
    @keyframes spin { 0% { transform: rotate(0deg); } 100% { transform: rotate(360deg); } }
    @keyframes fadeIn { from { opacity: 0; transform: translateY(10px); } to { opacity: 1; transform: translateY(0); } }
    @keyframes fadeOut { from { opacity: 1; transform: translateY(0); } to { opacity: 0; transform: translateY(-20px); } }
    @keyframes slideInDown { from { opacity: 0; transform: translateY(-20px); } to { opacity: 1; transform: translateY(0); } }
    .fade-in { animation: fadeIn 0.5s ease-out forwards; }
    @media (max-width: 768px) {
      .header-wrapper, .page-wrapper { width: 100%; padding-left: 12px; padding-right: 12px; }
      .header { padding: 12px 18px; }
      .logo { font-size: 1.5rem; }
      .main-content { padding: 18px; }
      .page-title { font-size: 1.4rem; }
      .toolbar { flex-direction: column; align-items: stretch; }
      .toolbar-left, .toolbar-right { width: 100%; }
      .search-box { max-width: 100%; }
      .btn { width: 100%; justify-content: center; }
      .modal-content { margin: 10px; }
      .alert-content { flex-direction: column; text-align: center; gap: 12px; }
      .btn-outline-primary { width: 100%; justify-content: center; }
    }
  </style>
</head>

<body class="dark-mode">

  <div class="header-wrapper">
    <div class="header fade-in">
      <div class="logo" onclick="window.location.href='dashboard.php'">
        <i class="fas fa-gamepad"></i>
        Play Zone
      </div>
      <div class="header-actions">
        <button class="back-btn" onclick="window.location.href='dashboard.php'" title="العودة للصفحة الرئيسية">
          <i class="fas fa-arrow-right"></i>
          <span>الصفحة الرئيسية</span>
        </button>
        <button class="dark-mode-toggle" onclick="toggleDarkMode()" title="تبديل الوضع الداكن/الساطع">
          <i id="dark-mode-icon" class="fas fa-sun"></i>
        </button>
        <div class="user-menu">
          <button class="user-btn" onclick="attemptLogout()">
            <i class="fas fa-user"></i>
            <!-- اسم المستخدم من الداتابيز -->
            <span><?= $displayName ?></span>
            <i class="fas fa-sign-out-alt"></i>
          </button>
        </div>
      </div>
    </div>
  </div>

  <div class="page-wrapper">
    <div class="main-content fade-in">
      <div class="page-title">
        <i class="fas fa-door-open"></i>
        إدارة الغرف
        <span id="roomsCountBadge" style="font-size: 1rem; font-weight: normal; color: #6b7280; margin-right: auto;"></span>
      </div>

      <div class="toolbar">
        <div class="toolbar-left">
          <?php if ($canAdd): ?>
          <button class="btn btn-primary" id="addRoomBtn" onclick="openAddRoomModal()">
            <i class="fas fa-plus"></i>
            إضافة غرفة جديدة
          </button>
          <?php endif; ?>

          <div class="room-limit-alert" id="roomLimitAlert" style="display: none;">
            <div class="alert-content">
              <div class="alert-icon"><i class="fas fa-exclamation-triangle"></i></div>
              <div class="alert-text">
                <h4>تم الوصول للحد الأقصى</h4>
                <p id="limitMessage"></p>
              </div>
              <div class="alert-actions">
                <button class="btn btn-outline-primary btn-sm" onclick="window.location.href='subscription-upgrade.php'">
                  <i class="fas fa-arrow-up"></i> ترقية الخطة
                </button>
                <button class="btn btn-outline-success btn-sm" onclick="dismissLimitAlert()">
                  <i class="fas fa-times"></i> إلغاء
                </button>
              </div>
            </div>
          </div>

          <div class="search-box">
            <input type="text" class="search-input" id="searchInput" placeholder="بحث عن غرفة..." onkeyup="searchRooms()">
            <i class="fas fa-search search-icon"></i>
          </div>
        </div>

        <div class="toolbar-right">
          <div class="filter-dropdown">
            <button class="filter-btn" onclick="toggleFilterMenu()">
              <i class="fas fa-filter"></i> تصفية
              <i class="fas fa-chevron-down" style="font-size: 0.8rem;"></i>
            </button>
          </div>
          <button class="btn btn-secondary" onclick="loadRooms()" title="تحديث">
            <i class="fas fa-sync-alt"></i>
          </button>
        </div>
      </div>

      <!-- Desktop Table -->
      <div class="table-container">
        <table class="rooms-table">
          <thead>
            <tr>
              <th>#</th>
              <th>اسم الغرفة</th>
              <th>نوع الجهاز</th>
              <th>الحالة</th>
              <th>سعر فردي</th>
              <th>سعر جماعي</th>
              <th>الإجراءات</th>
            </tr>
          </thead>
          <tbody id="roomsTableBody">
            <tr>
              <td colspan="7" style="text-align: center; padding: 40px;">
                <div class="spinner"></div>
                <p style="margin-top: 15px; color: #6b7280;">جاري تحميل البيانات...</p>
              </td>
            </tr>
          </tbody>
        </table>
      </div>

      <!-- Mobile Cards -->
      <div class="room-cards" id="roomCardsContainer">
        <div style="text-align: center; padding: 40px;">
          <div class="spinner"></div>
          <p style="margin-top: 15px; color: #6b7280;">جاري تحميل البيانات...</p>
        </div>
      </div>
    </div>
  </div>

  <!-- Modal إضافة/تعديل غرفة -->
  <div class="modal" id="roomModal">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title">
          <i class="fas fa-door-open"></i>
          <span id="modalTitle">إضافة غرفة جديدة</span>
        </h3>
        <button class="modal-close" onclick="closeRoomModal()"><i class="fas fa-times"></i></button>
      </div>

      <form id="roomForm" onsubmit="saveRoom(event)">
        <div class="modal-body">
          <input type="hidden" id="roomId" name="room_id">

          <div class="form-group">
            <label class="form-label">اسم الغرفة <span style="color: #ef4444;">*</span></label>
            <input type="text" class="form-input" id="roomName" name="room_name" required placeholder="مثال: غرفة VIP 1">
          </div>

          <div class="form-group">
            <label class="form-label">نوع الجهاز <span style="color: #ef4444;">*</span></label>
            <!-- قائمة أنواع الأجهزة من الداتابيز -->
            <div class="relative" x-data="{ open: false, selected: '', search: '' }" x-init="$watch('open', value => { if (value) { $nextTick(() => $refs.searchInput.focus()); } });">
              <input type="hidden" id="roomDeviceType" name="device_type" x-model="selected" required>
              <button type="button" @click="open = !open"
                class="w-full px-3 py-3 sm:px-4 text-right bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-600 rounded-lg shadow-sm text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200 hover:border-gray-400 touch-manipulation"
                :class="{ 'ring-2 ring-blue-500 border-blue-500': open }">
                <div class="flex items-center justify-between">
                  <span x-text="selected ? deviceTypeLabel(selected) : 'اختر نوع الجهاز'" class="text-gray-500 dark:text-gray-400" :class="{ 'text-gray-900 dark:text-white': selected }"></span>
                  <svg class="w-5 h-5 text-gray-400 transition-transform duration-200" :class="{ 'rotate-180': open }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                  </svg>
                </div>
              </button>
              <div x-show="open" @click.away="open = false"
                x-transition:enter="transition ease-out duration-100" x-transition:enter-start="transform opacity-0 scale-95" x-transition:enter-end="transform opacity-100 scale-100"
                x-transition:leave="transition ease-in duration-75" x-transition:leave-start="transform opacity-100 scale-100" x-transition:leave-end="transform opacity-0 scale-95"
                class="absolute z-50 w-full mt-1 bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-600 rounded-lg shadow-lg max-h-48 overflow-hidden" style="display: none;">
                <div class="p-2 border-b border-gray-200 dark:border-gray-700">
                  <input type="text" x-ref="searchInput" x-model="search" placeholder="ابحث..."
                    class="w-full px-3 py-2 text-sm text-right bg-gray-50 dark:bg-gray-700 border border-gray-200 dark:border-gray-600 rounded-md focus:ring-2 focus:ring-blue-500 text-gray-900 dark:text-white">
                </div>
                <div class="max-h-40 overflow-y-auto">
                  <?php foreach ($deviceTypes as $dt): ?>
                  <button type="button"
                    @click="selected = '<?= htmlspecialchars($dt['slug']) ?>'; open = false;"
                    class="w-full px-3 py-3 text-right text-sm text-gray-900 dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 focus:outline-none transition-colors duration-150 min-h-[44px]"
                    x-show="!search || '<?= addslashes($dt['name_ar']) ?>'.toLowerCase().includes(search.toLowerCase()) || '<?= addslashes($dt['name_en']) ?>'.toLowerCase().includes(search.toLowerCase())">
                    <div class="flex items-center justify-between">
                      <span><?= htmlspecialchars($dt['name_ar']) ?></span>
                      <svg x-show="selected === '<?= htmlspecialchars($dt['slug']) ?>'" class="w-4 h-4 text-blue-500" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                      </svg>
                    </div>
                  </button>
                  <?php endforeach; ?>
                </div>
              </div>
            </div>
          </div>

          <div class="form-group">
            <label class="form-label">السعر/ساعة (فردي) - <?= $currencySymbol ?> <span style="color: #ef4444;">*</span></label>
            <input type="number" class="form-input" id="roomHourlyRate" name="hourly_rate" min="0" step="0.01" value="15.00" required placeholder="15.00">
          </div>

          <div class="form-group">
            <label class="form-label">السعر/ساعة (جماعي) - <?= $currencySymbol ?> <span style="color: #ef4444;">*</span></label>
            <input type="number" class="form-input" id="roomGroupRate" name="group_hourly_rate" min="0" step="0.01" value="20.00" required placeholder="20.00">
          </div>

          <div class="form-group">
            <label class="form-label">الحالة</label>
            <div class="relative" x-data="roomStatusListbox()">
              <button type="button" @click="toggle()"
                :class="open ? 'ring-2 ring-blue-500 border-blue-500' : 'border-gray-300 dark:border-gray-600'"
                class="relative w-full bg-white dark:bg-gray-800 border rounded-lg shadow-sm pl-3 pr-10 py-2 text-right cursor-pointer focus:outline-none focus:ring-2 focus:ring-blue-500 sm:text-sm text-gray-900 dark:text-white">
                <span class="block truncate" x-text="selectedStatus ? selectedStatus.name : 'اختر الحالة'"></span>
                <span class="absolute inset-y-0 right-0 flex items-center pr-2 pointer-events-none">
                  <svg class="w-5 h-5 text-gray-400" :class="open ? 'transform rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                  </svg>
                </span>
              </button>
              <div x-show="open" @click.away="close()"
                x-transition:enter="transition ease-out duration-100" x-transition:enter-start="transform opacity-0 scale-95" x-transition:enter-end="transform opacity-100 scale-100"
                x-transition:leave="transition ease-in duration-75" x-transition:leave-start="transform opacity-100 scale-100" x-transition:leave-end="transform opacity-0 scale-95"
                class="absolute z-50 mt-1 w-full bg-white dark:bg-gray-800 shadow-lg max-h-60 rounded-md py-1 text-base ring-1 ring-black ring-opacity-5 overflow-auto sm:text-sm">
                <div @click="selectStatus('available', 'متاحة')" class="cursor-pointer select-none relative py-2 pl-3 pr-9 hover:bg-blue-50 dark:hover:bg-blue-900" :class="selectedStatus && selectedStatus.value === 'available' ? 'bg-blue-100 dark:bg-blue-800 text-blue-900 dark:text-blue-100' : 'text-gray-900 dark:text-white'">
                  <span class="block truncate">متاحة</span>
                  <span x-show="selectedStatus && selectedStatus.value === 'available'" class="absolute inset-y-0 right-0 flex items-center pr-4">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path></svg>
                  </span>
                </div>
                <div @click="selectStatus('occupied', 'محجوزة')" class="cursor-pointer select-none relative py-2 pl-3 pr-9 hover:bg-blue-50 dark:hover:bg-blue-900" :class="selectedStatus && selectedStatus.value === 'occupied' ? 'bg-blue-100 dark:bg-blue-800 text-blue-900 dark:text-blue-100' : 'text-gray-900 dark:text-white'">
                  <span class="block truncate">محجوزة</span>
                  <span x-show="selectedStatus && selectedStatus.value === 'occupied'" class="absolute inset-y-0 right-0 flex items-center pr-4">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path></svg>
                  </span>
                </div>
                <div @click="selectStatus('maintenance', 'في صيانة')" class="cursor-pointer select-none relative py-2 pl-3 pr-9 hover:bg-blue-50 dark:hover:bg-blue-900" :class="selectedStatus && selectedStatus.value === 'maintenance' ? 'bg-blue-100 dark:bg-blue-800 text-blue-900 dark:text-blue-100' : 'text-gray-900 dark:text-white'">
                  <span class="block truncate">في صيانة</span>
                  <span x-show="selectedStatus && selectedStatus.value === 'maintenance'" class="absolute inset-y-0 right-0 flex items-center pr-4">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path></svg>
                  </span>
                </div>
              </div>
              <input type="hidden" id="roomStatus" name="status" value="available">
            </div>
          </div>
        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" onclick="closeRoomModal()">
            <i class="fas fa-times"></i> إلغاء
          </button>
          <button type="submit" class="btn btn-primary" id="saveRoomBtn">
            <i class="fas fa-save"></i> حفظ
          </button>
        </div>
      </form>
    </div>
  </div>

  <!-- Footer -->
  <div style="backdrop-filter: blur(8px); border-top: 1px solid rgba(255,255,255,0.1); padding: 12px 0; margin-top: 30px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
    <div style="max-width: 1200px; margin: 0 auto; padding: 0 20px; text-align: center;">
      <p style="margin: 0; font-size: 13px; color: rgba(255,255,255,0.9); font-weight: 500;">© <?= date('Y') ?> Play Zone</p>
      <p style="margin: 4px 0 0 0; font-size: 11px; color: rgba(255,255,255,0.7);">
        تم التطوير بواسطة <span style="color: #10b981; font-weight: 600;">MAHMOUD ZAHRAN</span>
      </p>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
  <script src="js/notification-queue.js?v=<?= time() ?>"></script>
  <script src="js/session-monitor.js?v=<?= time() ?>"></script>

  <script>
    // ======================================================
    // المتغيرات من PHP (من الداتابيز والسيشن)
    // ======================================================
    let allRooms = [];
    const clientId    = <?= $clientId ?>;
    const canAdd      = <?= $canAdd ? 'true' : 'false' ?>;
    const canEdit     = <?= $canEdit ? 'true' : 'false' ?>;
    const canDelete   = <?= $canDelete ? 'true' : 'false' ?>;
    const canView     = true;

    // أنواع الأجهزة من الداتابيز (لعرض الاسم بالعربي في الجدول)
    const deviceTypesMap = {
      <?php foreach ($deviceTypes as $dt): ?>
      '<?= htmlspecialchars($dt['slug']) ?>': '<?= addslashes($dt['name_ar']) ?>',
      <?php endforeach; ?>
    };

    function deviceTypeLabel(slug) {
      return deviceTypesMap[slug] || slug;
    }

    // ======================================================
    // Logout
    // ======================================================
    async function attemptLogout() {
      try {
        const shiftRes = await fetch('api/shift-actions.php?action=employee_active_shift', { credentials: 'same-origin' });
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
      overlay.style = 'position:fixed;inset:0;background:rgba(0,0,0,0.6);z-index:99999;display:flex;align-items:center;justify-content:center;padding:16px;';
      const card = document.createElement('div');
      card.style = 'background:linear-gradient(135deg,#0f172a,#1f2937);color:#fff;border-radius:16px;width:100%;max-width:520px;box-shadow:0 20px 60px rgba(0,0,0,.5);overflow:hidden;';
      card.innerHTML = `<div style="padding:22px 24px;text-align:center">
        <div style="font-size:38px;margin-bottom:12px">⚠️</div>
        <h3 style="font-size:20px;font-weight:700;margin-bottom:8px">لا يمكن تسجيل الخروج</h3>
        <p style="font-size:14px;color:#cbd5e1;line-height:1.8;margin-bottom:18px">لديك شيفت نشط حالياً. يجب إنهاء الشيفت قبل تسجيل الخروج.</p>
        <a href="shifts.php" style="display:inline-block;background:linear-gradient(135deg,#10b981,#059669);color:#fff;padding:10px 18px;border:none;border-radius:10px;font-weight:700;cursor:pointer;text-decoration:none">الانتقال إلى إنهاء الشيفت</a>
      </div>`;
      overlay.appendChild(card);
      overlay.addEventListener('click', (e) => { if (e.target === overlay) overlay.remove(); });
      document.body.appendChild(overlay);
    }

    document.addEventListener('DOMContentLoaded', function() {
      document.querySelectorAll('a[href$="logout.php"]').forEach(a => {
        a.addEventListener('click', function(e) { e.preventDefault(); attemptLogout(); });
      });
    });

    // ======================================================
    // Dark Mode
    // ======================================================
    function initDarkMode() {
      const darkMode = localStorage.getItem('darkMode');
      const body = document.body;
      const icon = document.getElementById('dark-mode-icon');
      if (darkMode === 'true') { body.classList.add('dark-mode'); if (icon) icon.className = 'fas fa-sun'; }
      else { body.classList.remove('dark-mode'); if (icon) icon.className = 'fas fa-moon'; }
    }

    async function toggleDarkMode() {
      const body = document.body;
      const icon = document.getElementById('dark-mode-icon');
      body.classList.toggle('dark-mode');
      const isDark = body.classList.contains('dark-mode');
      if (icon) icon.className = isDark ? 'fas fa-sun' : 'fas fa-moon';
      localStorage.setItem('darkMode', isDark);
      try {
        await fetch('api/user-preferences.php', { method: 'POST', headers: { 'Content-Type': 'application/json' }, credentials: 'same-origin', body: JSON.stringify({ dark_mode: isDark }) });
      } catch (e) {}
    }

    window.addEventListener('storage', (e) => {
      if (e.key === 'darkMode') {
        const isDark = e.newValue === 'true';
        document.body.classList.toggle('dark-mode', isDark);
        const icon = document.getElementById('dark-mode-icon');
        if (icon) icon.className = isDark ? 'fas fa-sun' : 'fas fa-moon';
      }
    });

    if (document.readyState === 'loading') document.addEventListener('DOMContentLoaded', initDarkMode);
    else initDarkMode();

    // ======================================================
    // Load Rooms
    // ======================================================
    async function loadRooms() {
      try {
        const response = await fetch('api/rooms.php');
        if (!response.ok) {
          if (response.status === 401) { showError('انتهت جلستك. يرجى تسجيل الدخول مرة أخرى'); setTimeout(() => window.location.href = 'login.php', 2000); return; }
          if (response.status === 403) { const e = await response.json().catch(() => ({})); showError(e.error || 'ليس لديك صلاحية الوصول'); return; }
          throw new Error(`HTTP ${response.status}`);
        }
        const data = await response.json();
        if (data.success) {
          allRooms = data.rooms || [];
          // تحديث عداد الغرف
          const badge = document.getElementById('roomsCountBadge');
          if (badge) badge.textContent = `(${data.count || allRooms.length})`;
          displayRooms(allRooms);
        } else {
          showError('فشل تحميل البيانات: ' + (data.error || 'خطأ غير معروف'));
        }
      } catch (error) {
        console.error('Error loading rooms:', error);
        showError('حدث خطأ أثناء تحميل البيانات');
      }
    }

    function getStatusText(status) {
      const map = { 'available': 'متاحة', 'occupied': 'محجوزة', 'maintenance': 'في صيانة', 'offline': 'غير متاحة' };
      return map[status] || status;
    }

    function getStatusClass(status) {
      if (status === 'available') return 'status-active';
      if (status === 'maintenance') return 'status-maintenance';
      return 'status-inactive';
    }

    // ======================================================
    // Display Rooms
    // ======================================================
    function displayRooms(rooms) {
      const tableBody = document.getElementById('roomsTableBody');
      const cardsContainer = document.getElementById('roomCardsContainer');

      if (!rooms || rooms.length === 0) {
        const emptyState = `<div class="empty-state"><i class="fas fa-door-open"></i><h3>لا توجد غرف</h3><p>قم بإضافة غرفة جديدة للبدء</p></div>`;
        tableBody.innerHTML = `<tr><td colspan="7">${emptyState}</td></tr>`;
        cardsContainer.innerHTML = emptyState;
        return;
      }

      tableBody.innerHTML = rooms.map((room, index) => `
        <tr>
          <td>${index + 1}</td>
          <td><strong>${escapeHtml(room.name)}</strong></td>
          <td>${escapeHtml(room.device_type_name_ar || deviceTypeLabel(room.device_type) || '-')}</td>
          <td><span class="status-badge ${getStatusClass(room.status)}"><i class="fas fa-circle" style="font-size: 0.5rem;"></i> ${getStatusText(room.status)}</span></td>
          <td>${room.hourly_rate ? parseFloat(room.hourly_rate).toFixed(2) + ' ' + CURRENCY_SYMBOL : '-'}</td>
          <td>${room.group_hourly_rate ? parseFloat(room.group_hourly_rate).toFixed(2) + ' ' + CURRENCY_SYMBOL : '-'}</td>
          <td>
            <div class="action-btns">
              ${canView ? `<button class="action-btn action-btn-view" onclick="viewRoom(${room.id})" title="عرض"><i class="fas fa-eye"></i></button>` : ''}
              ${canEdit ? `<button class="action-btn action-btn-edit" onclick="editRoom(${room.id})" title="تعديل"><i class="fas fa-edit"></i></button>` : ''}
              ${canDelete ? `<button class="action-btn action-btn-delete" onclick="deleteRoom(${room.id})" title="حذف"><i class="fas fa-trash"></i></button>` : ''}
            </div>
          </td>
        </tr>
      `).join('');

      cardsContainer.innerHTML = rooms.map(room => `
        <div class="room-card">
          <div class="room-card-header">
            <div class="room-card-title"><i class="fas fa-door-open" style="color: #667eea;"></i> ${escapeHtml(room.name)}</div>
            <span class="status-badge ${getStatusClass(room.status)}"><i class="fas fa-circle" style="font-size: 0.5rem;"></i> ${getStatusText(room.status)}</span>
          </div>
          <div class="room-card-body">
            <div class="room-card-field"><span class="room-card-label">نوع الجهاز</span><span class="room-card-value">${escapeHtml(room.device_type_name_ar || deviceTypeLabel(room.device_type) || '-')}</span></div>
            <div class="room-card-field"><span class="room-card-label">سعر فردي</span><span class="room-card-value">${room.hourly_rate ? parseFloat(room.hourly_rate).toFixed(2) + ' ' + CURRENCY_SYMBOL : '-'}</span></div>
            <div class="room-card-field"><span class="room-card-label">سعر جماعي</span><span class="room-card-value">${room.group_hourly_rate ? parseFloat(room.group_hourly_rate).toFixed(2) + ' ' + CURRENCY_SYMBOL : '-'}</span></div>
          </div>
          <div class="room-card-actions">
            ${canView ? `<button class="action-btn action-btn-view" onclick="viewRoom(${room.id})"><i class="fas fa-eye"></i></button>` : ''}
            ${canEdit ? `<button class="action-btn action-btn-edit" onclick="editRoom(${room.id})"><i class="fas fa-edit"></i></button>` : ''}
            ${canDelete ? `<button class="action-btn action-btn-delete" onclick="deleteRoom(${room.id})"><i class="fas fa-trash"></i></button>` : ''}
          </div>
        </div>
      `).join('');
    }

    // ======================================================
    // Search
    // ======================================================
    function searchRooms() {
      const term = document.getElementById('searchInput').value.toLowerCase().trim();
      if (!term) { displayRooms(allRooms); return; }
      displayRooms(allRooms.filter(r =>
        r.name.toLowerCase().includes(term) ||
        (r.device_type_name_ar && r.device_type_name_ar.toLowerCase().includes(term)) ||
        (r.device_type && r.device_type.toLowerCase().includes(term))
      ));
    }

    // ======================================================
    // Modal
    // ======================================================
    function openAddRoomModal() {
      if (!canAdd) { showError('ليس لديك صلاحية إضافة غرف'); return; }
      document.getElementById('modalTitle').textContent = 'إضافة غرفة جديدة';
      document.getElementById('roomForm').reset();
      document.getElementById('roomId').value = '';
      document.getElementById('roomStatus').value = 'available';
      resetDeviceTypeListbox();
      resetStatusListbox();
      document.getElementById('roomModal').classList.add('active');
      document.body.style.overflow = 'hidden';
    }

    function closeRoomModal() {
      document.getElementById('roomModal').classList.remove('active');
      document.body.style.overflow = '';
    }

    // ======================================================
    // View Room
    // ======================================================
    async function viewRoom(roomId) {
      const room = allRooms.find(r => r.id == roomId);
      if (!room) return;
      const colorMap = { available: '#10b981', occupied: '#ef4444', maintenance: '#f59e0b', offline: '#6b7280' };
      await Swal.fire({
        title: '<i class="fas fa-door-open"></i> ' + escapeHtml(room.name),
        html: `<div style="text-align: right; padding: 15px;">
          <p style="margin: 10px 0;"><strong>نوع الجهاز:</strong> ${escapeHtml(room.device_type_name_ar || deviceTypeLabel(room.device_type) || '-')}</p>
          <p style="margin: 10px 0;"><strong>الحالة:</strong> <span style="color: ${colorMap[room.status] || '#6b7280'};">${getStatusText(room.status)}</span></p>
          <p style="margin: 10px 0;"><strong>السعر/ساعة (فردي):</strong> ${room.hourly_rate ? parseFloat(room.hourly_rate).toFixed(2) + ' ' + CURRENCY_SYMBOL : '-'}</p>
          <p style="margin: 10px 0;"><strong>السعر/ساعة (جماعي):</strong> ${room.group_hourly_rate ? parseFloat(room.group_hourly_rate).toFixed(2) + ' ' + CURRENCY_SYMBOL : '-'}</p>
          <p style="margin: 10px 0; font-size: 0.85rem; color: #6b7280;"><strong>تاريخ الإنشاء:</strong> ${room.created_at || '-'}</p>
        </div>`,
        confirmButtonText: 'حسناً',
        confirmButtonColor: '#667eea'
      });
    }

    // ======================================================
    // Edit Room
    // ======================================================
    async function editRoom(roomId) {
      if (!canEdit) { showError('ليس لديك صلاحية تعديل الغرف'); return; }
      const room = allRooms.find(r => r.id == roomId);
      if (!room) return;

      document.getElementById('modalTitle').textContent = 'تعديل الغرفة';
      document.getElementById('roomId').value = room.id;
      document.getElementById('roomName').value = room.name;
      document.getElementById('roomHourlyRate').value = room.hourly_rate || '15.00';
      document.getElementById('roomGroupRate').value = room.group_hourly_rate || '20.00';
      document.getElementById('roomStatus').value = room.status || 'available';

      // ضبط قائمة نوع الجهاز
      const listboxContainer = document.querySelector('[x-data*="open: false, selected"]');
      if (listboxContainer && listboxContainer._x_dataStack) {
        const alpineData = listboxContainer._x_dataStack[0];
        if (alpineData) { alpineData.selected = room.device_type || ''; alpineData.search = ''; alpineData.open = false; }
      }

      // ضبط قائمة الحالة
      setTimeout(() => {
        const statusContainer = document.querySelector('[x-data="roomStatusListbox()"]');
        if (statusContainer && statusContainer._x_dataStack) {
          const alpineData = statusContainer._x_dataStack[0];
          if (alpineData) alpineData.selectedStatus = { value: room.status || 'available', name: getStatusText(room.status || 'available') };
        }
      }, 100);

      document.getElementById('roomModal').classList.add('active');
      document.body.style.overflow = 'hidden';
    }

    // ======================================================
    // Save Room
    // ======================================================
    async function saveRoom(event) {
      event.preventDefault();
      const roomId = document.getElementById('roomId').value;
      const formData = {
        name: document.getElementById('roomName').value.trim(),
        device_type: document.getElementById('roomDeviceType').value,
        hourly_rate: document.getElementById('roomHourlyRate').value,
        group_hourly_rate: document.getElementById('roomGroupRate').value,
        status: document.getElementById('roomStatus').value
      };

      if (!formData.name) { showError('يرجى إدخال اسم الغرفة'); return; }
      if (!formData.device_type) { showError('يرجى اختيار نوع الجهاز'); return; }
      if (!formData.hourly_rate || !formData.group_hourly_rate) { showError('يرجى إدخال الأسعار'); return; }

      const saveBtn = document.getElementById('saveRoomBtn');
      const originalText = saveBtn.innerHTML;
      saveBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> جاري الحفظ...';
      saveBtn.disabled = true;

      try {
        const url    = roomId ? `api/rooms.php?id=${roomId}` : 'api/rooms.php';
        const method = roomId ? 'PUT' : 'POST';
        const response = await fetch(url, { method, headers: { 'Content-Type': 'application/json' }, credentials: 'same-origin', body: JSON.stringify(formData) });
        const data = await response.json();

        if (data.success) {
          showSuccess(roomId ? 'تم تحديث الغرفة بنجاح' : 'تم إضافة الغرفة بنجاح');
          closeRoomModal();
          loadRooms();
          if (!roomId) setTimeout(() => location.reload(), 1500);
        } else {
          if (data.error && data.error.includes('الحد الأقصى')) {
            const alertDiv = document.getElementById('roomLimitAlert');
            const msg = document.getElementById('limitMessage');
            if (msg) msg.textContent = data.error;
            if (alertDiv) alertDiv.style.display = 'block';
            const addBtn = document.getElementById('addRoomBtn');
            if (addBtn) addBtn.style.display = 'none';
          } else {
            showError(data.error || 'فشل حفظ البيانات');
          }
        }
      } catch (error) {
        showError('حدث خطأ أثناء حفظ البيانات');
      } finally {
        saveBtn.innerHTML = originalText;
        saveBtn.disabled = false;
      }
    }

    // ======================================================
    // Delete Room
    // ======================================================
    async function deleteRoom(roomId) {
      if (!canDelete) { showError('ليس لديك صلاحية حذف الغرف'); return; }
      const result = await Swal.fire({
        title: 'تأكيد الحذف', text: 'هل أنت متأكد من حذف هذه الغرفة؟ لا يمكن التراجع عن هذا الإجراء',
        icon: 'warning', showCancelButton: true, confirmButtonColor: '#ef4444', cancelButtonColor: '#6b7280',
        confirmButtonText: 'نعم، احذف', cancelButtonText: 'إلغاء'
      });
      if (!result.isConfirmed) return;

      try {
        const response = await fetch(`api/rooms.php?id=${roomId}`, { method: 'DELETE', credentials: 'same-origin' });
        const data = await response.json();
        if (data.success) { showSuccess('تم حذف الغرفة بنجاح'); loadRooms(); setTimeout(() => location.reload(), 1500); }
        else showError(data.error || 'فشل حذف الغرفة');
      } catch (error) {
        showError('حدث خطأ أثناء حذف الغرفة');
      }
    }

    // ======================================================
    // Helpers
    // ======================================================
    function escapeHtml(text) {
      const div = document.createElement('div');
      div.textContent = text;
      return div.innerHTML;
    }

    function showSuccess(message) {
      Swal.fire({ icon: 'success', title: 'نجح', text: message, timer: 2000, showConfirmButton: false });
    }

    function showError(message) {
      Swal.fire({ icon: 'error', title: 'خطأ', text: message, confirmButtonColor: '#667eea' });
    }

    function toggleFilterMenu() {
      showError('قريباً: سيتم إضافة خيارات التصفية');
    }

    function dismissLimitAlert() {
      const alert = document.getElementById('roomLimitAlert');
      if (alert) {
        alert.style.animation = 'fadeOut 0.3s ease-out forwards';
        setTimeout(() => { alert.style.display = 'none'; const addBtn = document.getElementById('addRoomBtn'); if (addBtn) addBtn.style.display = ''; }, 300);
      }
    }

    // Alpine.js components
    function roomStatusListbox() {
      return {
        open: false,
        selectedStatus: { value: 'available', name: 'متاحة' },
        toggle() { this.open = !this.open; },
        close() { this.open = false; },
        selectStatus(value, name) {
          this.selectedStatus = { value, name };
          const input = document.getElementById('roomStatus');
          if (input) input.value = value;
          this.close();
        },
        reset() {
          this.selectedStatus = { value: 'available', name: 'متاحة' };
          const input = document.getElementById('roomStatus');
          if (input) input.value = 'available';
          this.open = false;
        }
      }
    }

    function resetDeviceTypeListbox() {
      const container = document.querySelector('[x-data*="open: false, selected"]');
      if (container && container._x_dataStack) {
        const data = container._x_dataStack[0];
        if (data) { data.selected = ''; data.search = ''; data.open = false; }
      }
    }

    function resetStatusListbox() {
      setTimeout(() => {
        const container = document.querySelector('[x-data="roomStatusListbox()"]');
        if (container && container._x_dataStack) {
          const data = container._x_dataStack[0];
          if (data) data.reset();
        }
      }, 100);
    }

    // Modal close handlers
    document.addEventListener('keydown', (e) => { if (e.key === 'Escape') closeRoomModal(); });
    document.getElementById('roomModal').addEventListener('click', (e) => { if (e.target.id === 'roomModal') closeRoomModal(); });

    // Initial load
    document.addEventListener('DOMContentLoaded', () => { loadRooms(); });
  </script>
</body>
</html>