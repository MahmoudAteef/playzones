<?php
// ================================================================
// ضع هذا الملف في system/ وضمّنه في أول dashboard.php
// ================================================================
require_once __DIR__ . '/config/database.php';
require_once __DIR__ . '/config/system.php';
require_once __DIR__ . '/includes/auth_helper.php';
require_once __DIR__ . '/includes/tenant_middleware.php';

$pdo    = getDB();
$user   = CURRENT_USER;
$client = CURRENT_CLIENT_ID;

// ── إحصائيات الغرف ──────────────────────────────────
$stmt = $pdo->prepare("SELECT status, COUNT(*) as cnt FROM rooms WHERE client_id=? AND is_active=1 GROUP BY status");
$stmt->execute([$client]);
$roomStats = [];
foreach ($stmt->fetchAll() as $row) {
    $roomStats[$row['status']] = (int)$row['cnt'];
}
$availableRooms = $roomStats['available'] ?? 0;
$occupiedRooms  = $roomStats['occupied']  ?? 0;
$totalRooms     = array_sum($roomStats);
$occupancyRate  = $totalRooms > 0 ? round(($occupiedRooms / $totalRooms) * 100) : 0;

// ── جلسات نشطة ───────────────────────────────────────
$stmt2 = $pdo->prepare("SELECT COUNT(*) FROM sessions WHERE client_id=? AND status='active'");
$stmt2->execute([$client]);
$activeSessions = (int)$stmt2->fetchColumn();

// ── مبيعات اليوم ────────────────────────────────────
$stmt3 = $pdo->prepare("SELECT COALESCE(SUM(total_amount),0) FROM sessions WHERE client_id=? AND status='ended' AND DATE(end_time)=CURDATE()");
$stmt3->execute([$client]);
$todaySales = number_format((float)$stmt3->fetchColumn(), 2);

// ── الجلسات النشطة التفصيلية ─────────────────────────
$stmt4 = $pdo->prepare("
    SELECT s.*, r.name as room_name, u.username,
           TIMESTAMPDIFF(MINUTE, s.start_time, NOW()) as duration_mins
    FROM sessions s
    JOIN rooms r ON r.id = s.room_id
    JOIN users u ON u.id = s.user_id
    WHERE s.client_id=? AND s.status='active'
    ORDER BY s.start_time DESC
    LIMIT 10
");
$stmt4->execute([$client]);
$activeSessList = $stmt4->fetchAll();

// ── آخر المدفوعات ────────────────────────────────────
$stmt5 = $pdo->prepare("
    SELECT s.*, r.name as room_name, u.username
    FROM sessions s
    JOIN rooms r ON r.id = s.room_id
    JOIN users u ON u.id = s.user_id
    WHERE s.client_id=? AND s.status='ended'
    ORDER BY s.end_time DESC
    LIMIT 10
");
$stmt5->execute([$client]);
$recentPayments = $stmt5->fetchAll();

// ── بيانات الاشتراك ──────────────────────────────────
$stmt6 = $pdo->prepare("SELECT c.*, p.name_ar as plan_name, p.slug as plan_slug FROM clients c JOIN plans p ON p.id=c.plan_id WHERE c.id=?");
$stmt6->execute([$client]);
$clientData = $stmt6->fetch();

// حساب حالة الاشتراك
$now        = new DateTime();
$expiresAt  = $clientData['plan_expires_at'] ? new DateTime($clientData['plan_expires_at']) : null;
$createdAt  = new DateTime($clientData['created_at']);

if (!$expiresAt) {
    // مفتوح بدون انتهاء
    $subscriptionStatus = 'monthly_active';
    $effectiveEnd       = null;
    $trialDays          = null;
} else {
    $diff      = $now->diff($expiresAt);
    $daysLeft  = (int)$expiresAt->diff($now)->days * ($expiresAt > $now ? 1 : -1);
    $totalDays = (int)$createdAt->diff($expiresAt)->days;

    // تحديد نوع الاشتراك (trial إذا أقل من 7 أيام من الإنشاء)
    $isTrial = $totalDays <= 7;

    if ($expiresAt <= $now) {
        $subscriptionStatus = $isTrial ? 'trial_expired' : 'expired';
    } elseif ($daysLeft <= 3) {
        $subscriptionStatus = 'expiring_soon';
    } else {
        $subscriptionStatus = $isTrial ? 'trial_active' : 'monthly_active';
    }
    $effectiveEnd = $expiresAt->format('Y-m-d H:i:s');
    $trialDays    = $isTrial ? $totalDays : null;
}

$subscriptionMeta = json_encode([
    'effective_status'        => $subscriptionStatus,
    'effective_start_at'      => $clientData['created_at'],
    'effective_end_at'        => $effectiveEnd,
    'activation_mode'         => $trialDays ? 'trial_only' : 'subscription',
    'trial_duration_value'    => $trialDays,
    'trial_duration_unit'     => 'days',
    'monthly_duration_months' => 1,
]);

$currencySymbol = $clientData['currency_symbol'] ?? 'جنيه';
$shopName       = $clientData['name'] ?? 'Play Zone';
$userRole       = $user['role'] === 'admin' ? 'مدير النظام' : 'موظف';

// دالة مساعدة لتنسيق مدة الجلسة
function formatDuration(int $mins): string {
    $h = intdiv($mins, 60);
    $m = $mins % 60;
    return "{$h} ساعة {$m} دقيقة";
}
?>

<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
  <meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="سيستم لاداره محلات البلايستيشن">
<meta name="keywords" content="PS Management,نظام لاداره محلات البلايستيشن,سيستم,نظام,اداره بلايستيشن,بلايستيشن">
<meta name="robots" content="index, follow">
<link rel="icon" href="https://system.playzones.cloud/uploads/system-seo/favicon_1762007257_eaf22b44.png?v=1780300350" type="image/x-icon">
<link rel="shortcut icon" href="https://system.playzones.cloud/uploads/system-seo/favicon_1762007257_eaf22b44.png?v=1780300350">
<meta property="og:type" content="website">
<meta property="og:title" content="لوحة التحكم - Play Zone">
<meta property="og:description" content="سيستم لاداره محلات البلايستيشن">
<meta property="og:url" content="https://system.playzones.cloud/dashboard.php">
<meta property="og:image" content="https://system.playzones.cloud/uploads/system-seo/test_1762004814.jpg?v=1780300350">
<meta property="og:image:width" content="1200">
<meta property="og:image:height" content="630">
<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:title" content="لوحة التحكم - Play Zone">
<meta name="twitter:description" content="سيستم لاداره محلات البلايستيشن">
<meta name="twitter:image" content="https://system.playzones.cloud/uploads/system-seo/test_1762004814.jpg?v=1780300350">
<title>لوحة التحكم - Play Zone</title>
<style>html{zoom:0.9;-webkit-text-size-adjust:100%;text-size-adjust:100%;}*{-webkit-font-smoothing:antialiased;-moz-osx-font-smoothing:grayscale;}</style>
  <script>
    (function() {
      try {
        var ls = window.localStorage;
        var val = ls ? ls.getItem('darkMode') : null;
        var shouldBeDark = (val === null) ? true : (val === 'true');
        document.documentElement.style.backgroundColor = shouldBeDark ? '#1a1a2e' : '#f3f4f6';
      } catch (e) {
        document.documentElement.style.backgroundColor = '#f3f4f6';
      }
    })();
  </script>

  <!-- Tailwind CSS -->
  <script src="https://cdn.tailwindcss.com"></script>

  <!-- Font Awesome -->
  <link rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

  <!-- PWA Manifest (cache-busting) -->
    <link rel="manifest" href="/manifest.json?v=1763995215">
    <script>
    window.__PWA_ENABLED__ = true;
  const CURRENCY_SYMBOL = '<?php echo htmlspecialchars($currencySymbol); ?>';
  </script>
  <meta name="theme-color" content="#667eea">

  <style>
    /* تصغير الحجم للشاشات الكبيرة فقط */
    @media (min-width: 1024px) {
      html { font-size: 90%; }
    }
    
    body {
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    /* Dashboard Container Override */
    header > div.max-w-7xl,
    main.max-w-7xl {
      max-width: none !important;
      width: 96% !important;
    }

    @media (max-width: 768px) {
      header > div.max-w-7xl,
      main.max-w-7xl {
        width: 100% !important;
      }
    }

    /* Custom animations */
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
      animation: fadeIn 0.4s ease-out;
    }

    /* Gradient backgrounds */
    .gradient-blue {
      background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    }

    .gradient-green {
      background: linear-gradient(135deg, #10b981 0%, #059669 100%);
    }

    .gradient-orange {
      background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
    }

    .gradient-red {
      background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
    }

    .gradient-purple {
      background: linear-gradient(135deg, #8b5cf6 0%, #7c3aed 100%);
    }

    .gradient-teal {
      background: linear-gradient(135deg, #06b6d4 0%, #0ea5a3 100%);
    }

    .gradient-controller {
      background: linear-gradient(135deg, #22c55e 0%, #0ea5e9 100%);
    }

    .gradient-shifts {
      background: linear-gradient(135deg, #f97316 0%, #fb7185 50%, #a855f7 100%);
    }

    .gradient-sms {
      background: linear-gradient(135deg, #ec4899 0%, #be185d 100%);
    }

    /* Custom scrollbar */
    .custom-scroll::-webkit-scrollbar {
      width: 6px;
      height: 6px;
    }

    .custom-scroll::-webkit-scrollbar-track {
      background: #f1f1f1;
      border-radius: 10px;
    }

    .custom-scroll::-webkit-scrollbar-thumb {
      background: #888;
      border-radius: 10px;
    }

    .custom-scroll::-webkit-scrollbar-thumb:hover {
      background: #555;
    }

    /* Dark Mode Styles */
    body.dark-mode {
      background: linear-gradient(135deg, #1a1a2e 0%, #16213e 100%);
    }

    body.dark-mode .bg-white {
      background-color: #1e293b !important;
    }

    body.dark-mode .text-gray-800 {
      color: #e2e8f0 !important;
    }

    body.dark-mode .text-gray-700 {
      color: #cbd5e1 !important;
    }

    body.dark-mode .text-gray-600 {
      color: #94a3b8 !important;
    }

    body.dark-mode .text-gray-500 {
      color: #64748b !important;
    }

    body.dark-mode .bg-gray-50 {
      background-color: #0f172a !important;
    }

    body.dark-mode .bg-gray-100 {
      background-color: #1e293b !important;
    }

    body.dark-mode .border-gray-200 {
      border-color: #334155 !important;
    }

    body.dark-mode .border-gray-100 {
      border-color: #1e293b !important;
    }

    body.dark-mode .shadow-md,
    body.dark-mode .shadow-lg {
      box-shadow: 0 10px 30px rgba(0, 0, 0, 0.5) !important;
    }

    body.dark-mode .custom-scroll::-webkit-scrollbar-track {
      background: #1e293b;
    }

    body.dark-mode .custom-scroll::-webkit-scrollbar-thumb {
      background: #475569;
    }

    body.dark-mode .custom-scroll::-webkit-scrollbar-thumb:hover {
      background: #64748b;
    }

    /* Dark Mode Toggle Button */
    .dark-mode-toggle {
      background: rgba(255, 255, 255, 0.2);
      border: none;
      border-radius: 50%;
      width: 36px;
      height: 36px;
      display: flex;
      align-items: center;
      justify-content: center;
      color: #fff;
      cursor: pointer;
      transition: all 0.3s ease;
      backdrop-filter: blur(10px);
    }

    .dark-mode-toggle:hover {
      background: rgba(255, 255, 255, 0.3);
      transform: scale(1.1);
    }

    .dark-mode-toggle:active {
      transform: scale(0.95);
    }

    .dark-mode-toggle i {
      font-size: 1.1rem;
      transition: transform 0.3s ease;
    }

    .dark-mode-toggle:hover i {
      transform: rotate(20deg);
    }

    /* Dark Mode - Additional Styling */
    body.dark-mode .bg-green-50 {
      background-color: rgba(16, 185, 129, 0.1) !important;
    }

    body.dark-mode .bg-red-50 {
      background-color: rgba(239, 68, 68, 0.1) !important;
    }

    body.dark-mode .bg-blue-50 {
      background-color: rgba(59, 130, 246, 0.1) !important;
    }

    body.dark-mode .bg-orange-50 {
      background-color: rgba(245, 158, 11, 0.1) !important;
    }

    body.dark-mode .bg-purple-50 {
      background-color: rgba(139, 92, 246, 0.1) !important;
    }

    body.dark-mode .text-green-700 {
      color: #4ade80 !important;
    }

    body.dark-mode .text-red-700 {
      color: #f87171 !important;
    }

    body.dark-mode .text-blue-700 {
      color: #60a5fa !important;
    }

    body.dark-mode .text-blue-600 {
      color: #3b82f6 !important;
    }

    body.dark-mode .text-green-600 {
      color: #10b981 !important;
    }

    body.dark-mode .bg-green-100 {
      background-color: rgba(16, 185, 129, 0.15) !important;
    }

    body.dark-mode .bg-blue-100 {
      background-color: rgba(59, 130, 246, 0.15) !important;
    }

    body.dark-mode .border-green-500 {
      border-color: #10b981 !important;
    }

    body.dark-mode .hover\:bg-gray-50:hover {
      background-color: #0f172a !important;
    }

    body.dark-mode .hover\:bg-gray-100:hover {
      background-color: #1e293b !important;
    }

    /* Actions Drawer Styles */
    #actions-drawer {
      scrollbar-width: thin;
      scrollbar-color: rgba(0, 0, 0, 0.2) transparent;
    }

    #actions-drawer::-webkit-scrollbar {
      width: 6px;
    }

    #actions-drawer::-webkit-scrollbar-track {
      background: transparent;
    }

    #actions-drawer::-webkit-scrollbar-thumb {
      background: rgba(0, 0, 0, 0.2);
      border-radius: 3px;
    }

    /* Dark Mode Drawer */
    body.dark-mode #actions-drawer {
      background-color: #1e293b;
      border-left: 1px solid rgba(255, 255, 255, 0.1);
    }

    body.dark-mode #actions-drawer::-webkit-scrollbar-thumb {
      background: rgba(255, 255, 255, 0.2);
    }

    /* Floating Action Button Animation */
    @keyframes fab-pulse {

      0%,
      100% {
        transform: scale(1);
        box-shadow: 0 4px 14px 0 rgba(102, 126, 234, 0.4);
      }

      50% {
        transform: scale(1.05);
        box-shadow: 0 6px 20px 0 rgba(102, 126, 234, 0.6);
      }
    }

    #actions-fab {
      animation: fab-pulse 2s ease-in-out infinite;
    }

    #actions-fab:hover {
      animation: none;
    }

    #actions-fab:active {
      transform: scale(0.95) !important;
      animation: none;
    }

    /* Drawer Item Hover Effect */
    .drawer-action-item {
      position: relative;
      overflow: hidden;
    }

    .drawer-action-item::before {
      content: '';
      position: absolute;
      top: 0;
      right: -100%;
      width: 100%;
      height: 100%;
      background: rgba(255, 255, 255, 0.1);
      transition: right 0.3s ease;
    }

    .drawer-action-item:hover::before {
      right: 0;
    }

    /* Subscription Widget Styles */
    .subscription-widget {
      display: flex;
      align-items: center;
      gap: 12px;
      background: rgba(255, 255, 255, 0.1);
      backdrop-filter: blur(10px);
      padding: 8px 16px;
      border-radius: 25px;
      border: 1px solid rgba(255, 255, 255, 0.2);
      transition: all 0.3s ease;
    }

    .subscription-widget:hover {
      background: rgba(255, 255, 255, 0.15);
      border-color: rgba(255, 255, 255, 0.3);
    }

    .subscription-details {
      display: flex;
      flex-direction: column;
      gap: 6px;
      min-width: 200px;
      transition: all 0.3s ease;
      opacity: 1;
      max-height: 100px;
      overflow: hidden;
    }

    .subscription-info {
      display: flex;
      align-items: center;
      gap: 8px;
      flex-wrap: nowrap;
    }

    .subscription-badge {
      font-size: 0.85rem;
      font-weight: 600;
      color: #fff;
      padding: 4px 10px;
      border-radius: 12px;
      display: inline-flex;
      align-items: center;
      gap: 6px;
      white-space: nowrap;
      text-shadow: 0 1px 2px rgba(0, 0, 0, 0.3);
      flex-shrink: 0;
    }

    /* ألوان الشارات */
    .subscription-badge.trial_active {
      background: linear-gradient(135deg, #f39c12, #e67e22);
    }

    .subscription-badge.monthly_active {
      background: linear-gradient(135deg, #27ae60, #2ecc71);
    }

    .subscription-badge.expiring_soon {
      background: linear-gradient(135deg, #f39c12, #d35400);
      animation: pulse 2s ease-in-out infinite;
    }

    .subscription-badge.expired {
      background: linear-gradient(135deg, #e74c3c, #c0392b);
    }

    .subscription-badge.inactive,
    .subscription-badge.suspended {
      background: linear-gradient(135deg, #95a5a6, #7f8c8d);
    }

    @keyframes pulse {

      0%,
      100% {
        opacity: 1;
      }

      50% {
        opacity: 0.7;
      }
    }

    .subscription-countdown {
      font-size: 0.8rem;
      color: rgba(255, 255, 255, 0.95);
      font-weight: 400;
      white-space: nowrap;
    }

    .subscription-progress-bar {
      width: 100%;
      height: 4px;
      background: rgba(255, 255, 255, 0.2);
      border-radius: 2px;
      overflow: hidden;
      position: relative;
    }

    .subscription-progress-fill {
      height: 100%;
      border-radius: 2px;
      transition: width 1s linear, background-color 0.5s ease;
      position: relative;
    }

    /* ألوان شريط التقدم حسب النسبة المستهلكة */
    .subscription-progress-fill.progress-green {
      background: linear-gradient(90deg, #27ae60, #2ecc71);
    }

    .subscription-progress-fill.progress-orange {
      background: linear-gradient(90deg, #f39c12, #e67e22);
    }

    .subscription-progress-fill.progress-yellow {
      background: linear-gradient(90deg, #f1c40f, #f39c12);
    }

    .subscription-progress-fill.progress-red {
      background: linear-gradient(90deg, #e74c3c, #c0392b);
    }

    /* تأثير الوميض للشريط عند الاقتراب من الانتهاء */
    .subscription-progress-fill.progress-red::after {
      content: '';
      position: absolute;
      top: 0;
      left: 0;
      right: 0;
      bottom: 0;
      background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
      animation: shimmer 2s ease-in-out infinite;
    }

    @keyframes shimmer {
      0% {
        transform: translateX(-100%);
      }

      100% {
        transform: translateX(100%);
      }
    }

    /* Eye toggle & Timer toggle buttons */
    .eye-toggle-btn,
    .timer-toggle-btn,
    .clear-sales-btn {
      background: rgba(102, 126, 234, 0.8);
      border: 1px solid rgba(255, 255, 255, 0.3);
      border-radius: 50%;
      width: 32px;
      height: 32px;
      display: flex;
      align-items: center;
      justify-content: center;
      color: #fff;
      cursor: pointer;
      transition: all 0.3s ease;
      backdrop-filter: blur(10px);
      box-shadow: 0 2px 8px rgba(0, 0, 0, 0.2);
    }

    .clear-sales-btn {
      background: rgba(239, 68, 68, 0.8);
    }

    .clear-sales-btn:hover {
      background: rgba(220, 38, 38, 0.9);
      transform: scale(1.1);
      box-shadow: 0 4px 12px rgba(239, 68, 68, 0.4);
    }


    .eye-toggle-btn:hover,
    .timer-toggle-btn:hover {
      background: rgba(118, 75, 162, 0.9);
      transform: scale(1.1);
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.3);
    }

    .timer-toggle-btn {
      width: 28px;
      height: 28px;
      font-size: 0.75rem;
    }

    /* Dark mode adjustments for buttons */
    body.dark-mode .eye-toggle-btn,
    body.dark-mode .timer-toggle-btn {
      background: rgba(255, 255, 255, 0.15);
      border-color: rgba(255, 255, 255, 0.2);
    }

    body.dark-mode .eye-toggle-btn:hover,
    body.dark-mode .timer-toggle-btn:hover {
      background: rgba(255, 255, 255, 0.25);
    }

    body.dark-mode .clear-sales-btn {
      background: rgba(239, 68, 68, 0.7);
      border-color: rgba(239, 68, 68, 0.3);
    }

    body.dark-mode .clear-sales-btn:hover {
      background: rgba(239, 68, 68, 0.9);
    }

    /* Clear Sales Modal Styles */
    #clear-sales-modal {
      backdrop-filter: blur(4px);
    }

    #clear-sales-modal .modal-content {
      animation: modalSlideIn 0.3s ease-out;
    }

    @keyframes modalSlideIn {
      from {
        opacity: 0;
        transform: scale(0.9) translateY(-20px);
      }

      to {
        opacity: 1;
        transform: scale(1) translateY(0);
      }
    }

    /* Modal responsive adjustments */
    @media (max-width: 480px) {
      #clear-sales-modal .modal-content {
        margin: 1rem;
        max-width: calc(100vw - 2rem);
      }

      #clear-sales-modal .modal-header,
      #clear-sales-modal .modal-content,
      #clear-sales-modal .modal-actions {
        padding: 1rem;
      }
    }

    /* Timer dropdown */
    .timer-dropdown {
      position: fixed;
      bottom: auto;
      left: auto;
      background: rgba(0, 0, 0, 0.95);
      backdrop-filter: blur(15px);
      border-radius: 12px;
      padding: 8px 0;
      min-width: 160px;
      max-width: 200px;
      box-shadow: 0 10px 30px rgba(0, 0, 0, 0.5);
      border: 1px solid rgba(255, 255, 255, 0.15);
      z-index: 999999;
      opacity: 0;
      transform: scale(0.9);
      transition: all 0.3s ease;
      pointer-events: none;
      will-change: transform, opacity;
    }

    .timer-dropdown.show {
      opacity: 1;
      transform: scale(1);
      pointer-events: auto;
    }

    /* تأكيد ظهور القائمة فوق كل شيء */
    body>.timer-dropdown {
      z-index: 999999 !important;
    }

    .timer-option {
      padding: 8px 16px;
      color: #fff;
      cursor: pointer;
      transition: all 0.2s ease;
      font-size: 0.85rem;
      border-bottom: 1px solid rgba(255, 255, 255, 0.1);
    }

    .timer-option:last-child {
      border-bottom: none;
    }

    .timer-option:hover {
      background: rgba(255, 255, 255, 0.1);
    }

    .timer-option.active {
      background: rgba(59, 130, 246, 0.3);
      color: #60a5fa;
    }

    /* Responsive للهواتف */
    @media (max-width: 768px) {
      .subscription-widget {
        padding: 3px 8px;
        gap: 4px;
        max-width: 160px;
        border-radius: 16px;
      }

      .subscription-details {
        min-width: 0;
        gap: 3px;
      }

      .subscription-info {
        gap: 3px;
        flex-wrap: nowrap;
      }

      .subscription-badge {
        font-size: 0.6rem;
        padding: 2px 5px;
        gap: 2px;
        border-radius: 8px;
      }

      /* إخفاء الإيموجي وإبقاء النص فقط في الهاتف */
      .subscription-badge span:first-child {
        display: none;
      }

      .subscription-badge span {
        font-size: 0.6rem;
      }

      /* في الهاتف: أخفِ النص الكامل وأظهر المختصر عبر data-short */
      .subscription-countdown {
        font-size: 0;
        white-space: nowrap;
      }

      .subscription-countdown::before {
        content: attr(data-short);
        font-size: 0.55rem;
        color: rgba(255, 255, 255, 0.95);
      }

      .subscription-progress-bar {
        height: 2px;
      }

      /* Sales buttons responsive */
      .eye-toggle-btn,
      .timer-toggle-btn,
      .clear-sales-btn {
        width: 30px;
        height: 30px;
      }

      .timer-toggle-btn,
      .clear-sales-btn {
        width: 26px;
        height: 26px;
      }
    }

    @media (max-width: 480px) {
      .subscription-widget {
        padding: 3px 6px;
        gap: 3px;
        max-width: 120px;
        border-radius: 12px;
      }

      .subscription-details {
        min-width: 0;
        gap: 2px;
      }

      .subscription-badge {
        font-size: 0.55rem;
        padding: 1px 4px;
        gap: 1px;
      }

      .subscription-countdown {
        font-size: 0;
      }

      .subscription-countdown::before {
        content: attr(data-short);
        font-size: 0.5rem;
        color: rgba(255, 255, 255, 0.95);
      }

      .subscription-progress-bar {
        height: 2px;
      }

      /* Sales buttons - smaller on mobile */
      .eye-toggle-btn {
        width: 28px;
        height: 28px;
      }

      .timer-toggle-btn,
      .clear-sales-btn {
        width: 24px;
        height: 24px;
      }
    }
  </style>
</head>

<body class="bg-gradient-to-br from-gray-50 to-gray-100 min-h-screen">
  <script>
    (function() {
      try {
        var val = localStorage.getItem('darkMode');
        var shouldBeDark = (val === null) ? true : (val === 'true');
        if (shouldBeDark) {
          document.body.classList.add('dark-mode');
        } else {
          document.body.classList.remove('dark-mode');
        }
      } catch (e) {}
    })();
  </script>

  <!-- Maintenance Banner for Super Admin -->
  
  <!-- Header - Sticky -->
  <header class="sticky top-0 z-40 gradient-blue shadow-lg">
    <div class="max-w-7xl mx-auto px-3 sm:px-4 lg:px-6 py-3 sm:py-4">
      <div class="flex items-center justify-between">
        <!-- Logo -->
        <div class="flex items-center gap-2 sm:gap-3">
          <div
            class="w-8 h-8 sm:w-10 sm:h-10 bg-white/20 rounded-lg flex items-center justify-center">
            <i class="fas fa-gamepad text-white text-lg sm:text-xl"></i>
          </div>
          <h1 class="text-white font-bold text-base sm:text-lg lg:text-xl">
            <?php echo htmlspecialchars($shopName); ?>          </h1>
        </div>

        <!-- User Info & Subscription Widget -->
        <div class="flex items-center gap-2 sm:gap-4">
          <!-- PWA Install Button (يظهر فقط إذا كانت الميزة مفعلة في الباقة) -->
                      <button id="pwa-install-btn" onclick="installPWA()"
              class="bg-white/20 hover:bg-white/30 text-white px-3 py-2 rounded-lg transition text-sm flex items-center gap-2 hidden"
              title="تثبيت التطبيق">
              <i class="fas fa-download"></i>
              <span class="hidden sm:inline">تثبيت</span>
            </button>
          
          <!-- Dark Mode Toggle Button -->
          <button id="dark-mode-toggle" class="dark-mode-toggle"
            onclick="toggleDarkMode()" title="تبديل الوضع الداكن/الفاتح">
            <i class="fas fa-moon" id="dark-mode-icon"></i>
          </button>

          <div class="hidden sm:flex flex-col items-end">
            <span class="text-white text-xs sm:text-sm font-medium">
              <?php echo htmlspecialchars($user['username']); ?>            </span>
            <span class="text-white/70 text-[10px] sm:text-xs">
              <?php echo $userRole; ?>            </span>
          </div>

                      <!-- عنصر الاشتراك (نص + شريط التقدم) -->
            <div class="subscription-widget" id="subscription-widget">
              <div class="subscription-details" id="subscription-details">
                <div class="subscription-info">
                  <span class="subscription-badge" id="subscription-badge"></span>
                  <span class="subscription-countdown"
                    id="subscription-countdown"></span>
                </div>
                <div class="subscription-progress-bar">
                  <div class="subscription-progress-fill"
                    id="subscription-progress-fill"></div>
                </div>
              </div>
            </div>

            <!-- تمرير بيانات الاشتراك لـ JavaScript -->
            <script type="application/json" id="subscription-meta">
              <?php echo $subscriptionMeta; ?>            </script>
          
          <a href="#" onclick="attemptLogout()"
            class="bg-white/20 hover:bg-white/30 text-white px-2 py-1.5 sm:px-3 sm:py-2 rounded-lg transition text-xs sm:text-sm flex items-center gap-1.5">
            <i class="fas fa-sign-out-alt"></i>
            <span class="hidden sm:inline">خروج</span>
          </a>
        </div>
      </div>
    </div>
  </header>

  <!-- Main Content -->
  <main class="max-w-7xl mx-auto px-3 sm:px-4 lg:px-6 py-4 sm:py-6">

    <!-- Error Message -->
    
    <!-- Toast Notifications -->
    
    
    <!-- Welcome Section -->
    <div class="mb-6 fade-in">
      <div class="relative flex items-center justify-center mb-2"
        style="min-height: 3.5rem;">
                <h2
          class="text-xl sm:text-2xl lg:text-3xl font-bold text-gray-800 text-center w-full">
          لوحة التحكم الرئيسية
        </h2>
      </div>
      <p class="text-sm sm:text-base text-gray-600 text-center">
        مرحباً بك في نظام إدارة محل بلايستيشن
      </p>
    </div>

    <!-- KPIs Grid -->
    <div
      class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-3 sm:gap-4 mb-4 sm:mb-6">

      <!-- Available Rooms -->
      <a href="sessions.php"
        class="block bg-white rounded-xl shadow-md p-3 sm:p-4 hover:shadow-lg transition fade-in cursor-pointer focus:outline-none focus:ring-2 focus:ring-green-400 focus:ring-offset-2"
        title="الانتقال إلى إدارة الجلسات">
        <div class="flex items-center justify-between mb-2">
          <div
            class="w-10 h-10 sm:w-12 sm:h-12 gradient-green rounded-lg flex items-center justify-center">
            <i class="fas fa-door-open text-white text-lg sm:text-xl"></i>
          </div>
          <span
            class="text-[10px] sm:text-xs text-gray-500 bg-green-50 px-2 py-0.5 rounded-full">متاحة</span>
        </div>
        <div class="text-2xl sm:text-3xl font-bold text-gray-800">
          <?php echo $availableRooms; ?>        </div>
        <div class="text-[10px] sm:text-xs text-gray-600 mt-1">غرفة متاحة</div>
      </a>

      <!-- Occupied Rooms -->
      <a href="sessions.php"
        class="block bg-white rounded-xl shadow-md p-3 sm:p-4 hover:shadow-lg transition fade-in cursor-pointer focus:outline-none focus:ring-2 focus:ring-red-400 focus:ring-offset-2"
        title="الانتقال إلى إدارة الجلسات"
        style="animation-delay: 0.1s">
        <div class="flex items-center justify-between mb-2">
          <div
            class="w-10 h-10 sm:w-12 sm:h-12 gradient-red rounded-lg flex items-center justify-center">
            <i class="fas fa-door-closed text-white text-lg sm:text-xl"></i>
          </div>
          <span
            class="text-[10px] sm:text-xs text-gray-500 bg-red-50 px-2 py-0.5 rounded-full">مشغولة</span>
        </div>
        <div class="text-2xl sm:text-3xl font-bold text-gray-800">
          <?php echo $occupiedRooms; ?>        </div>
        <div class="text-[10px] sm:text-xs text-gray-600 mt-1">غرفة مشغولة</div>
      </a>

      <!-- Active Sessions -->
      <a href="sessions.php"
        class="block bg-white rounded-xl shadow-md p-3 sm:p-4 hover:shadow-lg transition fade-in cursor-pointer focus:outline-none focus:ring-2 focus:ring-blue-400 focus:ring-offset-2"
        title="الانتقال إلى إدارة الجلسات"
        style="animation-delay: 0.2s">
        <div class="flex items-center justify-between mb-2">
          <div
            class="w-10 h-10 sm:w-12 sm:h-12 gradient-blue rounded-lg flex items-center justify-center">
            <i class="fas fa-gamepad text-white text-lg sm:text-xl"></i>
          </div>
          <span
            class="text-[10px] sm:text-xs text-gray-500 bg-blue-50 px-2 py-0.5 rounded-full">نشطة</span>
        </div>
        <div class="text-2xl sm:text-3xl font-bold text-gray-800">
          <?php echo $activeSessions; ?>        </div>
        <div class="text-[10px] sm:text-xs text-gray-600 mt-1">جلسة نشطة</div>
      </a>

      <!-- Today Sales with Eye Toggle & Timer -->
      <div
        class="bg-white rounded-xl shadow-md p-3 sm:p-4 hover:shadow-lg transition fade-in relative"
        style="animation-delay: 0.3s" id="sales-card">
        <div class="flex items-center justify-between mb-2">
          <div
            class="w-10 h-10 sm:w-12 sm:h-12 gradient-orange rounded-lg flex items-center justify-center">
            <i class="fas fa-dollar-sign text-white text-lg sm:text-xl"></i>
          </div>
          <span
            class="text-[10px] sm:text-xs text-gray-500 bg-orange-50 px-2 py-0.5 rounded-full">اليوم</span>
        </div>
        <div class="text-xl sm:text-2xl font-bold text-gray-800"
          id="sales-amount">
          <?php echo $todaySales; ?>        </div>
        <div class="text-[10px] sm:text-xs text-gray-600 mt-1"><?php echo $currencySymbol; ?> مبيعات</div>

        <!-- Eye Toggle & Timer Buttons - Bottom Left -->
        <div
          class="absolute bottom-2 left-2 sm:bottom-3 sm:left-3 flex gap-1 sm:gap-2">
          <!-- Eye Toggle Button -->
          <button id="toggle-sales-visibility" class="eye-toggle-btn"
            onclick="toggleSalesVisibility()" title="إخفاء/إظهار المبلغ">
            <svg class="w-3 h-3 sm:w-4 sm:h-4" fill="none" stroke="currentColor"
              viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round"
                stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
              <path stroke-linecap="round" stroke-linejoin="round"
                stroke-width="2"
                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
              </path>
            </svg>
          </button>

                      <!-- Timer Settings Button -->
            <button id="timer-settings-btn" class="timer-toggle-btn"
              onclick="toggleTimerSettings(event)" title="إعدادات المؤقت">
              <svg class="w-3 h-3" fill="none" stroke="currentColor"
                viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round"
                  stroke-width="2"
                  d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
              </svg>
            </button>

            <!-- Clear Sales Button (Trash Icon) -->
            <button id="clear-sales-btn" class="clear-sales-btn"
              onclick="confirmClearSales()" title="تصفير مبيعات اليوم">
              <svg class="w-3 h-3" fill="none" stroke="currentColor"
                viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round"
                  stroke-width="2"
                  d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                </path>
              </svg>
            </button>
                  </div>

        <!-- Timer Dropdown - Fixed positioning -->
        <div id="timer-dropdown" class="timer-dropdown">
          <div class="timer-option" data-duration="8"
            onclick="setTimerDuration(8, '8 ساعات')">8 ساعات</div>
          <div class="timer-option" data-duration="12"
            onclick="setTimerDuration(12, '12 ساعة')">12 ساعة</div>
          <div class="timer-option" data-duration="24"
            onclick="setTimerDuration(24, 'يوم')">يوم</div>
          <div class="timer-option" data-duration="48"
            onclick="setTimerDuration(48, 'يومان')">يومان</div>
          <div class="timer-option" data-duration="168"
            onclick="setTimerDuration(168, 'أسبوع')">أسبوع</div>
          <div class="timer-option" data-duration="720"
            onclick="setTimerDuration(720, 'شهر')">شهر</div>
        </div>
      </div>

      <!-- Occupancy Rate -->
      <div
        class="bg-white rounded-xl shadow-md p-3 sm:p-4 hover:shadow-lg transition fade-in"
        style="animation-delay: 0.4s">
        <div class="flex items-center justify-between mb-2">
          <div
            class="w-10 h-10 sm:w-12 sm:h-12 gradient-purple rounded-lg flex items-center justify-center">
            <i class="fas fa-chart-pie text-white text-lg sm:text-xl"></i>
          </div>
          <span
            class="text-[10px] sm:text-xs text-gray-500 bg-purple-50 px-2 py-0.5 rounded-full">إشغال</span>
        </div>
        <div class="text-2xl sm:text-3xl font-bold text-gray-800">
          <?php echo $occupancyRate; ?>%
        </div>
        <div class="text-[10px] sm:text-xs text-gray-600 mt-1">نسبة الإشغال
        </div>
      </div>

    </div>



    <!-- Content Grid: Active Sessions & Recent Payments -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-4 sm:gap-6 mb-4 sm:mb-6">

      <!-- Active Sessions Section -->
      <div class="bg-white rounded-xl shadow-md p-4 sm:p-5 fade-in cursor-pointer hover:shadow-lg transition"
        onclick="window.location.href='sessions.php'"
        role="link"
        tabindex="0"
        onkeydown="if (event.key === 'Enter' || event.key === ' ') { event.preventDefault(); window.location.href='sessions.php'; }"
        title="الانتقال إلى إدارة الجلسات">
        <div class="flex items-center justify-between mb-4">
          <h2
            class="text-base sm:text-lg font-bold text-gray-800 flex items-center gap-2">
            <i class="fas fa-play-circle text-blue-500"></i>
            الجلسات النشطة
          </h2>
          <a href="sessions.php"
            onclick="event.stopPropagation()"
            class="text-xs sm:text-sm text-blue-600 hover:text-blue-700 font-medium">
            عرض الكل <i class="fas fa-arrow-left mr-1"></i>
          </a>
        </div>

        <div class="custom-scroll" style="max-height: 300px; overflow-y: auto;">
                <?php if (empty($activeSessList)): ?>
                <div class="text-center py-8">
                  <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-3">
                    <i class="fas fa-gamepad text-gray-400 text-2xl"></i>
                  </div>
                  <p class="text-gray-600 text-sm">لا توجد جلسات نشطة</p>
                </div>
                <?php else: foreach ($activeSessList as $ses): ?>
                <div class="bg-gray-50 border-r-4 border-green-500 rounded-lg p-3 mb-3 last:mb-0 hover:bg-gray-100 transition cursor-pointer"
                  title="عرض هذه الجلسة في إدارة الجلسات">
                  <div class="flex items-center justify-between mb-2">
                    <span class="font-semibold text-sm text-gray-800">
                      🏠 <?php echo htmlspecialchars($ses['room_name']); ?>
                    </span>
                    <span class="bg-green-100 text-green-700 text-xs px-2 py-0.5 rounded-full">نشط</span>
                  </div>
                  <div class="text-xs text-gray-600 space-y-1">
                    <div><i class="fas fa-user w-4"></i> <?php echo htmlspecialchars($ses['username']); ?></div>
                    <div><i class="fas fa-clock w-4"></i> بدأت في: <?php echo date('h:i A', strtotime($ses['start_time'])); ?></div>
                    <?php if ($ses['is_limited'] && $ses['limited_end_time']): ?>
                    <div class="text-orange-600 font-semibold">
                      <i class="fas fa-stopwatch w-4"></i>
                      تنتهي في: <?php echo date('h:i A', strtotime($ses['limited_end_time'])); ?>
                      <small class="text-gray-500">(محددة)</small>
                    </div>
                    <?php endif; ?>
                    <div><i class="fas fa-hourglass-half w-4"></i> المدة: <?php echo formatDuration((int)$ses['duration_mins']); ?></div>
                  </div>
                </div>
                <?php endforeach; endif; ?>
              </div>
      </div>

      <!-- Recent Payments Section -->
      <div class="bg-white rounded-xl shadow-md p-4 sm:p-5 fade-in">
        <div class="flex items-center justify-between mb-4 flex-wrap gap-2">
          <h2
            class="text-base sm:text-lg font-bold text-gray-800 flex items-center gap-2">
            <i class="fas fa-receipt text-green-500"></i>
            آخر المدفوعات
          </h2>
                      <div class="flex gap-2">
              <button onclick="showAutoClearModal()"
                class="bg-blue-500 hover:bg-blue-600 text-white px-2 py-1 sm:px-3 sm:py-2 rounded-lg text-[10px] sm:text-xs font-medium transition-all duration-200 flex items-center gap-1 shadow-lg hover:shadow-xl transform hover:scale-105">
                <i class="fas fa-clock text-xs"></i>
                <span class="hidden sm:inline">تنظيف تلقائي</span>
              </button>
              <button onclick="clearPayments()"
                class="bg-red-500 hover:bg-red-600 text-white px-2 py-1 sm:px-3 sm:py-2 rounded-lg text-[10px] sm:text-xs font-medium transition-all duration-200 flex items-center gap-1 shadow-lg hover:shadow-xl transform hover:scale-105">
                <i class="fas fa-trash text-xs"></i>
                <span class="hidden sm:inline">تنظيف فوري</span>
              </button>
            </div>
                  </div>

        <div class="custom-scroll" style="max-height: 300px; overflow-y: auto;">
                <?php if (empty($recentPayments)): ?>
              <div class="text-center py-8">
                <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-3">
                  <i class="fas fa-receipt text-gray-400 text-2xl"></i>
                </div>
                <p class="text-gray-600 text-sm">لا توجد مدفوعات حديثة</p>
              </div>
              <?php else: foreach ($recentPayments as $pay): ?>
              <div class="bg-gray-50 rounded-lg p-3 mb-2 last:mb-0 flex items-center justify-between">
                <div class="text-xs text-gray-600">
                  <div class="font-semibold text-gray-800"><?php echo htmlspecialchars($pay['room_name']); ?></div>
                  <div><?php echo date('h:i A', strtotime($pay['end_time'])); ?> · <?php echo htmlspecialchars($pay['username']); ?></div>
                </div>
                <div class="font-bold text-green-600 text-sm"><?php echo number_format($pay['total_amount'], 2); ?> <?php echo $currencySymbol; ?></div>
              </div>
              <?php endforeach; endif; ?>
            </div>
      </div>

    </div>

    
    <!-- Quick Actions Section - Desktop Only -->
    <div
      class="hidden lg:block bg-white rounded-xl shadow-md p-4 sm:p-5 fade-in">
      <h2
        class="text-base sm:text-lg font-bold text-gray-800 mb-4 flex items-center gap-2">
        <i class="fas fa-bolt text-yellow-500"></i>
        إجراءات سريعة
      </h2>
      <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-3">
                  <a href="rooms.php" class="gradient-green text-white px-4 py-3 rounded-lg hover:shadow-lg transition text-center"><i class="fas fa-door-open text-2xl mb-2 block"></i><span class="text-xs sm:text-sm font-medium">إدارة الغرف</span></a>        
                  <a href="sessions.php" class="gradient-blue text-white px-4 py-3 rounded-lg hover:shadow-lg transition text-center"><i class="fas fa-gamepad text-2xl mb-2 block"></i><span class="text-xs sm:text-sm font-medium">إدارة الجلسات</span></a>        
                                                      <a href="customers.php"
                class="gradient-purple text-white px-4 py-3 rounded-lg hover:shadow-lg transition text-center">
                <i class="fas fa-users text-2xl mb-2 block"></i>
                <span class="text-xs sm:text-sm font-medium">
                  إدارة العملاء                </span>
              </a>
                              


                                                      <a href="orders.php"
                class="gradient-orange text-white px-4 py-3 rounded-lg hover:shadow-lg transition text-center relative">
                <i class="fas fa-shopping-cart text-2xl mb-2 block"></i>
                <span class="text-xs sm:text-sm font-medium">إدارة الطلبات</span>
                                  <div id="low-stock-bell-desktop" class="absolute top-2 left-2"
                    style="display: none;">
                    <i class="fas fa-bell text-red-500 text-lg"></i>
                  </div>
                              </a>
                              
                                      <a href="shifts.php"
              class="gradient-shifts text-white px-4 py-3 rounded-lg hover:shadow-lg transition text-center">
              <i class="fas fa-business-time text-2xl mb-2 block"></i>
              <span class="text-xs sm:text-sm font-medium">إدارة الشيفتات</span>
            </a>
                  
                                                      <a href="reports.php"
                class="gradient-purple text-white px-4 py-3 rounded-lg hover:shadow-lg transition text-center">
                <i class="fas fa-chart-bar text-2xl mb-2 block"></i>
                <span class="text-xs sm:text-sm font-medium">التقارير</span>
              </a>
                              
                                                      <a href="controllers-maintenance.php"
                class="gradient-controller text-white px-4 py-3 rounded-lg hover:shadow-lg transition text-center">
                <i class="fas fa-screwdriver-wrench text-2xl mb-2 block"></i>
                <span class="text-xs sm:text-sm font-medium">صيانة - اختبار
                  الدراعات</span>
              </a>
                              
                                                      <a href="employees.php"
                class="gradient-red text-white px-4 py-3 rounded-lg hover:shadow-lg transition text-center">
                <i class="fas fa-user-tie text-2xl mb-2 block"></i>
                <span class="text-xs sm:text-sm font-medium">إدارة الموظفين</span>
              </a>
                              
                  <a href="subscription-upgrade.php" id="renewUpgradeAction"
            class="gradient-teal text-white px-4 py-3 rounded-lg hover:shadow-lg transition text-center">
            <i class="fas fa-arrow-up text-2xl mb-2 block"></i>
            <span class="text-xs sm:text-sm font-medium">تجديد / ترقيه
              الاشتراك</span>
          </a>
        
                          <a href="client-settings.php"
            class="gradient-sms text-white px-4 py-3 rounded-lg hover:shadow-lg transition text-center">
            <i class="fas fa-cog text-2xl mb-2 block"></i>
            <span class="text-xs sm:text-sm font-medium">الإعدادات</span>
          </a>
        
              </div>
    </div>

  </main>

  <script>
    function showUpgradeEmployeesModal() {
      if (document.getElementById('upgradeCustomersOverlay')) return;
      const overlay = document.createElement('div');
      overlay.id = 'upgradeCustomersOverlay';
      overlay.className =
        'fixed inset-0 z-[99999] flex items-center justify-center p-4';
      overlay.style.background = 'rgba(0,0,0,.55)';

      const card = document.createElement('div');
      card.className = 'w-full max-w-md rounded-2xl overflow-hidden shadow-2xl';
      card.innerHTML =
        `
      <div class=\"bg-gradient-to-r from-indigo-600 to-purple-600 text-white p-5 flex items-center gap-3\">\n        <div class=\"w-10 h-10 bg-white/20 rounded-lg flex items-center justify-center\">\n          <i class=\"fas fa-rocket\"></i>\n        </div>\n        <h3 class=\"text-lg font-bold\">ترقية مطلوبة لإدارة الموظفين</h3>\n      </div>\n      <div class=\"bg-white p-6 text-right\" dir=\"rtl\">\n        <p class=\"text-gray-700 leading-7 mb-4\">للاستفادة من ميزة <strong>إدارة الموظفين</strong>، يرجى ترقية خطتك من صفحة الباقات.</p>\n        <ul class=\"text-gray-600 text-sm space-y-2 mb-5\">\n          <li class=\"flex items-center gap-2\"><i class=\"fas fa-check text-emerald-500\"></i> إضافة وتعديل الموظفين</li>\n          <li class=\"flex items-center gap-2\"><i class=\"fas fa-check text-emerald-500\"></i> ضبط الصلاحيات والأدوار</li>\n          <li class=\"flex items-center gap-2\"><i class=\"fas fa-check text-emerald-500\"></i> متابعة الرواتب والشيفتات</li>\n        </ul>\n        <div class=\"flex items-center justify-end gap-3\">\n          <button onclick=\"document.getElementById('upgradeCustomersOverlay').remove()\" class=\"px-4 py-2 rounded-lg border border-gray-300 dark:border-gray-600 hover:bg-gray-50 dark:hover:bg-gray-700 text-gray-700 dark:text-white font-medium\">لاحقاً</button>\n          <button onclick=\"window.location.href='subscription-upgrade.php'\" class=\"px-4 py-2 rounded-lg text-white bg-gradient-to-r from-indigo-600 to-purple-600 hover:opacity-95 cursor-pointer border-0\">الترقية الآن</button>\n        </div>\n      </div>`;

      overlay.appendChild(card);
      overlay.addEventListener('click', (e) => {
        if (e.target === overlay) overlay.remove();
      });
      document.body.appendChild(overlay);
    }

    function showUpgradeControllerMaintenanceModal() {
      if (document.getElementById('upgradeCustomersOverlay')) return;
      const overlay = document.createElement('div');
      overlay.id = 'upgradeCustomersOverlay';
      overlay.className =
        'fixed inset-0 z-[99999] flex items-center justify-center p-4';
      overlay.style.background = 'rgba(0,0,0,.55)';

      const card = document.createElement('div');
      card.className = 'w-full max-w-md rounded-2xl overflow-hidden shadow-2xl';
      card.innerHTML =
        `
      <div class="bg-gradient-to-r from-emerald-500 via-sky-500 to-indigo-500 text-white p-5 flex items-center gap-3">
        <div class="w-10 h-10 bg-white/20 rounded-lg flex items-center justify-center">
          <i class="fas fa-screwdriver-wrench"></i>
        </div>
        <h3 class="text-lg font-bold">ترقية مطلوبة لصيانة الدراعات</h3>
      </div>
      <div class="bg-white p-6 text-right" dir="rtl">
        <p class="text-gray-700 leading-7 mb-4">
          للاستفادة من ميزة <strong>صيانة - اختبار الدراعات</strong>، يرجى ترقية خطتك من صفحة الباقات للحصول على أدوات التشخيص الاحترافية.
        </p>
        <ul class="text-gray-600 text-sm space-y-2 mb-5">
          <li class="flex items-center gap-2"><i class="fas fa-check text-emerald-500"></i> اختبار تفاعلي للأزرار والأنالوج</li>
          <li class="flex items-center gap-2"><i class="fas fa-check text-emerald-500"></i> حفظ سجلات الصيانة وتتبع الأعطال</li>
          <li class="flex items-center gap-2"><i class="fas fa-check text-emerald-500"></i> تقارير ذكية لحالة كل دراع</li>
        </ul>
        <div class="flex items-center justify-end gap-3">
          <button onclick="document.getElementById('upgradeCustomersOverlay').remove()" class="px-4 py-2 rounded-lg border border-gray-300 dark:border-gray-600 hover:bg-gray-50 dark:hover:bg-gray-700 text-gray-700 dark:text-white font-medium">لاحقاً</button>
          <button onclick="window.location.href='subscription-upgrade.php'" class="px-4 py-2 rounded-lg text-white bg-gradient-to-r from-emerald-500 via-sky-500 to-indigo-500 hover:opacity-95 cursor-pointer border-0">الترقية الآن</button>
        </div>
      </div>`;

      overlay.appendChild(card);
      overlay.addEventListener('click', (e) => {
        if (e.target === overlay) overlay.remove();
      });
      document.body.appendChild(overlay);
    }

    function showUpgradeOrdersModal() {
      if (document.getElementById('upgradeCustomersOverlay'))
        return showUpgradeCustomersModal();
      // reuse same modal as customers but with text for orders
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
        <h3 class="text-lg font-bold">ترقية مطلوبة لإدارة الطلبات</h3>
      </div>
      <div class="bg-white p-6 text-right" dir="rtl">
        <p class="text-gray-700 leading-7 mb-4">
          للاستفادة من ميزة <strong>إدارة الطلبات</strong>، يرجى ترقية خطتك من صفحة الباقات.
        </p>
        <ul class="text-gray-600 text-sm space-y-2 mb-5">
          <li class="flex items-center gap-2"><i class="fas fa-check text-emerald-500"></i> إنشاء وإدارة الطلبات داخل الجلسات</li>
          <li class="flex items-center gap-2"><i class="fas fa-check text-emerald-500"></i> تنبيهات المخزون المنخفض</li>
          <li class="flex items-center gap-2"><i class="fas fa-check text-emerald-500"></i> تتبع المبيعات المرتبطة بالجلسات</li>
        </ul>
        <div class="flex items-center justify-end gap-3">
          <button onclick="document.getElementById('upgradeCustomersOverlay').remove()" class="px-4 py-2 rounded-lg font-semibold text-white" style="background:#111827;">لاحقاً</button>
          <button onclick="window.location.href='subscription-upgrade.php'" class="px-4 py-2 rounded-lg text-white bg-gradient-to-r from-indigo-600 to-purple-600 hover:opacity-95 cursor-pointer border-0">الترقية الآن</button>
        </div>
      </div>
    `;

      overlay.appendChild(card);
      overlay.addEventListener('click', (e) => {
        if (e.target === overlay) overlay.remove();
      });
      document.body.appendChild(overlay);
    }

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
          <button onclick="document.getElementById('upgradeCustomersOverlay').remove()" class="px-4 py-2 rounded-lg border border-gray-300 dark:border-gray-600 hover:bg-gray-50 dark:hover:bg-gray-700 text-gray-700 dark:text-white font-medium">لاحقاً</button>
          <button onclick="window.location.href='subscription-upgrade.php'" class="px-4 py-2 rounded-lg text-white bg-gradient-to-r from-indigo-600 to-purple-600 hover:opacity-95 cursor-pointer border-0">الترقية الآن</button>
        </div>
      </div>
    `;

      overlay.appendChild(card);
      overlay.addEventListener('click', (e) => {
        if (e.target === overlay) overlay.remove();
      });
      document.body.appendChild(overlay);
    }
  </script>

  <!-- Floating Action Button - Mobile/Tablet Only -->
  <button id="actions-fab"
    class="lg:hidden fixed top-20 right-4 w-12 h-12 gradient-blue rounded-full shadow-lg flex items-center justify-center text-white z-50 hover:scale-110 transition-transform duration-300"
    onclick="openActionsDrawer()" aria-label="الصفحة الرئيسية - إجراءات سريعة"
    aria-controls="actions-drawer" aria-expanded="false">
    <i class="fas fa-home text-lg"></i>
  </button>

  <!-- Actions Drawer - Mobile/Tablet -->
  <div id="actions-drawer-overlay"
    class="fixed inset-0 bg-black bg-opacity-50 z-[9998] hidden transition-opacity duration-300"
    onclick="closeActionsDrawer()">
  </div>

  <div id="actions-drawer"
    class="fixed top-0 right-0 h-full w-[90vw] sm:w-[70vw] max-w-[420px] bg-white shadow-2xl z-[9999] transform translate-x-full transition-transform duration-300 overflow-y-auto"
    role="dialog" aria-labelledby="drawer-title" aria-modal="true">

    <!-- Drawer Header -->
    <div
      class="sticky top-0 gradient-blue px-6 py-4 flex items-center justify-between z-10">
      <h3 id="drawer-title"
        class="text-lg font-bold text-white flex items-center gap-2">
        <i class="fas fa-home"></i>
        الصفحة الرئيسية
      </h3>
      <button onclick="closeActionsDrawer()"
        class="w-10 h-10 bg-white/20 hover:bg-white/30 rounded-full flex items-center justify-center transition"
        aria-label="إغلاق القائمة">
        <i class="fas fa-times text-white text-xl"></i>
      </button>
    </div>

    <!-- Drawer Content -->
    <div class="p-4 space-y-3">
              <a href="rooms.php"
          class="block gradient-green text-white px-6 py-4 rounded-xl hover:shadow-lg transition drawer-action-item"
          onclick="closeActionsDrawer()">
          <div class="flex items-center gap-4">
            <div
              class="w-12 h-12 bg-white/20 rounded-lg flex items-center justify-center flex-shrink-0">
              <i class="fas fa-door-open text-2xl"></i>
            </div>
            <span
              class="text-base font-medium">إدارة الغرف</span>
          </div>
        </a>
      
              <a href="sessions.php"
          class="block gradient-blue text-white px-6 py-4 rounded-xl hover:shadow-lg transition drawer-action-item"
          onclick="closeActionsDrawer()">
          <div class="flex items-center gap-4">
            <div
              class="w-12 h-12 bg-white/20 rounded-lg flex items-center justify-center flex-shrink-0">
              <i class="fas fa-gamepad text-2xl"></i>
            </div>
            <span class="text-base font-medium">إدارة الجلسات</span>
          </div>
        </a>
      
                                <a href="customers.php"
            class="block gradient-purple text-white px-6 py-4 rounded-xl hover:shadow-lg transition drawer-action-item"
            onclick="closeActionsDrawer()">
            <div class="flex items-center gap-4">
              <div
                class="w-12 h-12 bg-white/20 rounded-lg flex items-center justify-center flex-shrink-0">
                <i class="fas fa-users text-2xl"></i>
              </div>
              <span class="text-base font-medium">إدارة العملاء</span>
            </div>
          </a>
              
                                <a href="orders.php"
            class="block gradient-orange text-white px-6 py-4 rounded-xl hover:shadow-lg transition drawer-action-item relative"
            onclick="closeActionsDrawer()">
            <div class="flex items-center gap-4">
              <div
                class="w-12 h-12 bg-white/20 rounded-lg flex items-center justify-center flex-shrink-0 relative">
                <i class="fas fa-shopping-cart text-2xl"></i>
                <!-- Bell notification in top-left of icon box - hidden by default -->
                <div id="low-stock-bell-mobile" class="absolute -top-1 -left-1"
                  style="display: none;">
                  <i class="fas fa-bell text-red-500 text-sm"></i>
                </div>
              </div>
              <span class="text-base font-medium">إدارة الطلبات</span>
            </div>
          </a>
              
                    <a href="shifts.php"
          class="block gradient-shifts text-white px-6 py-4 rounded-xl hover:shadow-lg transition drawer-action-item"
          onclick="closeActionsDrawer()">
          <div class="flex items-center gap-4">
            <div
              class="w-12 h-12 bg-white/20 rounded-lg flex items-center justify-center flex-shrink-0">
              <i class="fas fa-business-time text-2xl"></i>
            </div>
            <span class="text-base font-medium">إدارة الشيفتات</span>
          </div>
        </a>
      
                                <a href="reports.php"
            class="block gradient-purple text-white px-6 py-4 rounded-xl hover:shadow-lg transition drawer-action-item"
            onclick="closeActionsDrawer()">
            <div class="flex items-center gap-4">
              <div
                class="w-12 h-12 bg-white/20 rounded-lg flex items-center justify-center flex-shrink-0">
                <i class="fas fa-chart-bar text-2xl"></i>
              </div>
              <span class="text-base font-medium">التقارير</span>
            </div>
          </a>
              
                                <a href="employees.php"
            class="block gradient-red text-white px-6 py-4 rounded-xl hover:shadow-lg transition drawer-action-item"
            onclick="closeActionsDrawer()">
            <div class="flex items-center gap-4">
              <div
                class="w-12 h-12 bg-white/20 rounded-lg flex items-center justify-center flex-shrink-0">
                <i class="fas fa-user-tie text-2xl"></i>
              </div>
              <span class="text-base font-medium">إدارة الموظفين</span>
            </div>
          </a>
              
                                <a href="controllers-maintenance.php"
            class="block gradient-controller text-white px-6 py-4 rounded-xl hover:shadow-lg transition drawer-action-item"
            onclick="closeActionsDrawer()">
            <div class="flex items-center gap-4">
              <div
                class="w-12 h-12 bg-white/20 rounded-lg flex items-center justify-center flex-shrink-0">
                <i class="fas fa-screwdriver-wrench text-2xl"></i>
              </div>
              <span class="text-base font-medium">صيانة - اختبار الدراعات</span>
            </div>
          </a>
              
              <a href="subscription-upgrade.php"
          class="block gradient-teal text-white px-6 py-4 rounded-xl hover:shadow-lg transition drawer-action-item"
          onclick="closeActionsDrawer()">
          <div class="flex items-center gap-4">
            <div
              class="w-12 h-12 bg-white/20 rounded-lg flex items-center justify-center flex-shrink-0">
              <i class="fas fa-arrow-up text-2xl"></i>
            </div>
            <span class="text-base font-medium">تجديد / ترقيه الاشتراك</span>
          </div>
        </a>
      
              <a href="client-settings.php"
          class="block gradient-sms text-white px-6 py-4 rounded-xl hover:shadow-lg transition drawer-action-item">
          <div class="flex items-center gap-4">
            <div class="w-12 h-12 bg-white/20 rounded-lg flex items-center justify-center flex-shrink-0">
              <i class="fas fa-cog text-2xl"></i>
            </div>
            <span class="text-base font-medium">الإعدادات</span>
          </div>
        </a>
      
          </div>
  </div>

  <!-- Modal: Clear Payments Confirmation -->
  <div id="clearModal"
    class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden px-4">
    <div
      class="bg-white rounded-2xl shadow-2xl max-w-md w-full transform transition-all duration-300 scale-95 opacity-0"
      id="modalContent">
      <div class="p-6">
        <!-- Warning Icon -->
        <div class="flex justify-center mb-4">
          <div
            class="w-16 h-16 bg-red-100 rounded-full flex items-center justify-center">
            <i class="fas fa-exclamation-triangle text-red-600 text-3xl"></i>
          </div>
        </div>

        <!-- Title -->
        <h3 class="text-xl font-bold text-gray-900 text-center mb-2">تأكيد
          التنظيف</h3>

        <!-- Message -->
        <p class="text-gray-600 text-center mb-6 leading-relaxed">
          هل أنت متأكد من تنظيف خانة آخر المدفوعات؟<br>
          <span class="text-red-600 font-semibold">سيتم حذف جميع الجلسات
            المكتملة نهائياً!</span>
        </p>

        <!-- Buttons -->
        <div class="flex gap-3">
          <button onclick="closeClearModal()"
            class="flex-1 bg-gray-300 hover:bg-gray-400 text-gray-900 font-bold py-3 px-4 rounded-lg transition-all duration-200 shadow-md hover:shadow-lg transform hover:scale-105">
            إلغاء
          </button>
          <button onclick="confirmClear()"
            class="flex-1 bg-red-500 hover:bg-red-600 text-white font-bold py-3 px-4 rounded-lg transition-all duration-200 shadow-md hover:shadow-lg transform hover:scale-105">
            تأكيد الحذف
          </button>
        </div>
      </div>
    </div>
  </div>

  <!-- Modal: Auto Clear Settings -->
  <div id="autoClearModal"
    class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden px-4">
    <div
      class="bg-white rounded-2xl shadow-2xl max-w-md w-full transform transition-all duration-300 scale-95 opacity-0"
      id="autoClearModalContent">
      <div class="p-6">
        <!-- Clock Icon -->
        <div class="flex justify-center mb-4">
          <div
            class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center">
            <i class="fas fa-clock text-blue-600 text-3xl"></i>
          </div>
        </div>

        <!-- Title -->
        <h3 class="text-xl font-bold text-gray-900 text-center mb-2">إعداد
          التنظيف التلقائي</h3>

        <!-- Message -->
        <p class="text-gray-600 text-center mb-6 leading-relaxed">
          حدد عدد الأيام بعدها سيتم حذف الجلسات المكتملة تلقائياً
        </p>

        <!-- Form -->
        <form id="autoClearForm" onsubmit="handleAutoClearSubmit(event)">
          <input type="hidden" name="action" value="set_auto_clear">
          <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700 mb-2">عدد
              الأيام:</label>
            <select name="auto_clear_days" id="autoClearDays"
              class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
              <option value="1">يوم واحد</option>
              <option value="3">3 أيام</option>
              <option value="7" selected>أسبوع</option>
              <option value="15">أسبوعين</option>
              <option value="30">شهر</option>
            </select>
          </div>

          <!-- Buttons -->
          <div class="flex gap-3">
            <button type="button" onclick="closeAutoClearModal()"
              class="flex-1 bg-gray-300 hover:bg-gray-400 text-gray-900 font-bold py-3 px-4 rounded-lg transition-all duration-200 shadow-md hover:shadow-lg transform hover:scale-105">
              إلغاء
            </button>
            <button type="submit"
              class="flex-1 bg-blue-500 hover:bg-blue-600 text-white font-bold py-3 px-4 rounded-lg transition-all duration-200 shadow-md hover:shadow-lg transform hover:scale-105">
              حفظ الإعداد
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>

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
          تم التطوير بواسطة <span style="color: #10b981; font-weight: 600;">MAHMOUD ZAHRAN</span>
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
  <!-- Scripts -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
  <script src="js/notification-queue.js?v=1779207315"></script>
  <script src="js/session-monitor.js?v=1771422103"></script>

  <script>
    function showUpgradeReportsModal() {
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
        <h3 class="text-lg font-bold">ترقية مطلوبة للوصول للتقارير</h3>
      </div>
      <div class="bg-white p-6 text-right" dir="rtl">
        <p class="text-gray-700 leading-7 mb-4">للاستفادة من ميزة <strong>التقارير</strong>، يرجى ترقية خطتك من صفحة الباقات.</p>
        <ul class="text-gray-600 text-sm space-y-2 mb-5">
          <li class="flex items-center gap-2"><i class="fas fa-check text-emerald-500"></i> تقارير أداء وملخصات</li>
          <li class="flex items-center gap-2"><i class="fas fa-check text-emerald-500"></i> تصدير وعرض تاريخي</li>
          <li class="flex items-center gap-2"><i class="fas fa-check text-emerald-500"></i> تحليلات مرئية</li>
        </ul>
        <div class="flex items-center justify-end gap-3">
          <button onclick="document.getElementById('upgradeCustomersOverlay').remove()" class="px-4 py-2 rounded-lg border border-gray-300 dark:border-gray-600 hover:bg-gray-50 dark:hover:bg-gray-700 text-gray-700 dark:text-white font-medium">لاحقاً</button>
          <button onclick="window.location.href='subscription-upgrade.php'" class="px-4 py-2 rounded-lg text-white bg-gradient-to-r from-indigo-600 to-purple-600 hover:opacity-95 cursor-pointer border-0">الترقية الآن</button>
        </div>
      </div>`;

      overlay.appendChild(card);
      overlay.addEventListener('click', (e) => {
        if (e.target === overlay) overlay.remove();
      });
      document.body.appendChild(overlay);
    }

    function showUpgradeShiftsModal() {
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
        <h3 class="text-lg font-bold">ترقية مطلوبة لإدارة الشيفتات</h3>
      </div>
      <div class="bg-white p-6 text-right" dir="rtl">
        <p class="text-gray-700 leading-7 mb-4">للاستفادة من ميزة <strong>إدارة الشيفتات</strong>، يرجى ترقية خطتك من صفحة الباقات.</p>
        <ul class="text-gray-600 text-sm space-y-2 mb-5">
          <li class="flex items-center gap-2"><i class="fas fa-check text-emerald-500"></i> إضافة/إنهاء الشيفتات</li>
          <li class="flex items-center gap-2"><i class="fas fa-check text-emerald-500"></i> تتبع دوام الموظفين</li>
          <li class="flex items-center gap-2"><i class="fas fa-check text-emerald-500"></i> تقارير الشيفتات</li>
        </ul>
        <div class="flex items-center justify-end gap-3">
          <button onclick="document.getElementById('upgradeCustomersOverlay').remove()" class="px-4 py-2 rounded-lg border border-gray-300 dark:border-gray-600 hover:bg-gray-50 dark:hover:bg-gray-700 text-gray-700 dark:text-white font-medium">لاحقاً</button>
          <button onclick="window.location.href='subscription-upgrade.php'" class="px-4 py-2 rounded-lg text-white bg-gradient-to-r from-indigo-600 to-purple-600 hover:opacity-95 cursor-pointer border-0">الترقية الآن</button>
        </div>
      </div>`;

      overlay.appendChild(card);
      overlay.addEventListener('click', (e) => {
        if (e.target === overlay) overlay.remove();
      });
      document.body.appendChild(overlay);
    }
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

    // Intercept any plain logout links (extra safety)
    document.addEventListener('DOMContentLoaded', function() {
      // عودة من logout.php برسالة منع
      const params = new URLSearchParams(window.location.search);
      document.querySelectorAll('a[href$="logout.php"]').forEach(a => {
        a.addEventListener('click', function(e) {
          e.preventDefault();
          attemptLogout();
        });
      });
    });
    // ==================== Actions Drawer Management ====================
    let drawerOpen = false;
    let lastFocusedElement = null;

    function openActionsDrawer() {
      const drawer = document.getElementById('actions-drawer');
      const overlay = document.getElementById('actions-drawer-overlay');
      const fab = document.getElementById('actions-fab');

      // حفظ العنصر المركّز عليه حالياً
      lastFocusedElement = document.activeElement;

      // إظهار Overlay
      overlay.classList.remove('hidden');

      // فتح Drawer
      setTimeout(() => {
        drawer.classList.remove('translate-x-full');
        overlay.classList.add('opacity-100');
        drawerOpen = true;

        // تحديث ARIA
        fab.setAttribute('aria-expanded', 'true');

        // منع تمرير الخلفية
        document.body.style.overflow = 'hidden';

        // Focus على أول عنصر قابل للتركيز
        const firstLink = drawer.querySelector('.drawer-action-item');
        if (firstLink) {
          firstLink.focus();
        }
      }, 10);
    }

    function closeActionsDrawer() {
      const drawer = document.getElementById('actions-drawer');
      const overlay = document.getElementById('actions-drawer-overlay');
      const fab = document.getElementById('actions-fab');

      // إغلاق Drawer
      drawer.classList.add('translate-x-full');
      overlay.classList.remove('opacity-100');
      drawerOpen = false;

      // تحديث ARIA
      fab.setAttribute('aria-expanded', 'false');

      // إعادة التمرير
      document.body.style.overflow = '';

      // إخفاء Overlay بعد انتهاء الانتقال
      setTimeout(() => {
        overlay.classList.add('hidden');

        // إعادة Focus للعنصر السابق
        if (lastFocusedElement) {
          lastFocusedElement.focus();
        }
      }, 300);
    }

    // إغلاق بمفتاح Escape
    document.addEventListener('keydown', function(e) {
      if (e.key === 'Escape' && drawerOpen) {
        closeActionsDrawer();
      }
    });

    // Trap Focus داخل الـ Drawer
    document.addEventListener('keydown', function(e) {
      if (!drawerOpen || e.key !== 'Tab') return;

      const drawer = document.getElementById('actions-drawer');
      const focusableElements = drawer.querySelectorAll('button, a');
      const firstElement = focusableElements[0];
      const lastElement = focusableElements[focusableElements.length - 1];

      if (e.shiftKey) {
        // Shift + Tab
        if (document.activeElement === firstElement) {
          e.preventDefault();
          lastElement.focus();
        }
      } else {
        // Tab
        if (document.activeElement === lastElement) {
          e.preventDefault();
          firstElement.focus();
        }
      }
    });

    // إغلاق عند تغيير حجم الشاشة لـ Desktop
    window.addEventListener('resize', function() {
      if (window.innerWidth >= 1024 && drawerOpen) {
        closeActionsDrawer();
      }
    });

    // ==================== Dark Mode Toggle - MASTER CONTROLLER ====================
    async function toggleDarkMode() {
      const body = document.body;
      const icon = document.getElementById('dark-mode-icon');

      body.classList.toggle('dark-mode');

      const isDarkMode = body.classList.contains('dark-mode');

      // Update icon
      if (isDarkMode) {
        icon.classList.remove('fa-moon');
        icon.classList.add('fa-sun');
      } else {
        icon.classList.remove('fa-sun');
        icon.classList.add('fa-moon');
      }

      // حفظ في localStorage (مفتاح موحد للنظام كله)
      localStorage.setItem('darkMode', isDarkMode ? 'true' : 'false');

      // حفظ التفضيل في قاعدة البيانات
      try {
        const response = await fetch('api/user-preferences.php', {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json',
          },
          body: JSON.stringify({
            dark_mode: isDarkMode
          })
        });

        const data = await response.json();

        if (data.success) {
          // إرسال إشارة broadcast لجميع التبويبات المفتوحة
          localStorage.setItem('darkModeChanged', Date.now().toString());
          // Dark Mode preference saved successfully
        } else {
          // Failed to save Dark Mode preference
        }
      } catch (error) {
        // Error saving Dark Mode preference
      }
    }

    // Listen for dark mode changes from other tabs (slave mode)
    window.addEventListener('storage', function(e) {
      if (e.key === 'darkMode' || e.key === 'darkModeChanged') {
        const darkMode = localStorage.getItem('darkMode') === 'true';
        const body = document.body;
        const icon = document.getElementById('dark-mode-icon');

        if (darkMode && !body.classList.contains('dark-mode')) {
          body.classList.add('dark-mode');
          icon.classList.remove('fa-moon');
          icon.classList.add('fa-sun');
          // Synced to Dark Mode from other page
        } else if (!darkMode && body.classList.contains('dark-mode')) {
          body.classList.remove('dark-mode');
          icon.classList.remove('fa-sun');
          icon.classList.add('fa-moon');
          // Synced to Light Mode from other page
        }
      }
    });

    // مزامنة أيقونة الوضع الليلي فقط — class على body يُطبَّق قبل أول رسم (سكربت أول الصفحة)
    document.addEventListener('DOMContentLoaded', function() {
      const body = document.body;
      const icon = document.getElementById('dark-mode-icon');
      if (!icon) return;

      if (localStorage.getItem('darkMode') === null) {
        localStorage.setItem('darkMode', body.classList.contains('dark-mode') ? 'true' : 'false');
      }

      if (body.classList.contains('dark-mode')) {
        icon.classList.remove('fa-moon');
        icon.classList.add('fa-sun');
      } else {
        icon.classList.remove('fa-sun');
        icon.classList.add('fa-moon');
      }
    });

    // ==================== Sales Visibility Toggle ====================
    function toggleSalesVisibility() {
      const salesAmount = document.getElementById('sales-amount');
      const toggleBtn = document.getElementById('toggle-sales-visibility');
      const isHidden = salesAmount.textContent.includes('*');

      if (isHidden) {
        // إظهار السعر الحقيقي
        salesAmount.textContent =
          '0.00';
        toggleBtn.innerHTML = `
        <svg class="w-3 h-3 sm:w-4 sm:h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
        </svg>
      `;
        localStorage.setItem('salesVisibility', 'visible');
      } else {
        // إخفاء السعر
        salesAmount.textContent = '******';
        toggleBtn.innerHTML = `
        <svg class="w-3 h-3 sm:w-4 sm:h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.878 9.878L3 3m6.878 6.878L21 21"></path>
        </svg>
      `;
        localStorage.setItem('salesVisibility', 'hidden');
      }
    }

    // استعادة حالة السعر عند تحميل الصفحة
    document.addEventListener('DOMContentLoaded', function() {
      const savedVisibility = localStorage.getItem('salesVisibility');
      if (savedVisibility === 'hidden') {
        const salesAmount = document.getElementById('sales-amount');
        const toggleBtn = document.getElementById('toggle-sales-visibility');

        salesAmount.textContent = '******';
        toggleBtn.innerHTML = `
        <svg class="w-3 h-3 sm:w-4 sm:h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.878 9.878L3 3m6.878 6.878L21 21"></path>
        </svg>
      `;
      }

      // بدء التحديث الفوري للمبيعات
      startSalesMonitoring();

      // تحميل إعدادات المؤقت
      loadTimerSettings();
    });

    // ==================== Sales Monitoring System ====================
    function startSalesMonitoring() {
      let currentSales = '0.00';
      let isHidden = localStorage.getItem('salesVisibility') === 'hidden';
      let monitoringInterval = null;

      // بدء المراقبة
      function startMonitoring() {
        if (monitoringInterval) return;

        monitoringInterval = setInterval(async function() {
          try {
            const response = await fetch('api/get-sales.php');
            const data = await response.json();

            if (data.success) {
              const newSales = data.today_sales;

              if (newSales !== currentSales) {
                currentSales = newSales;

                if (parseFloat(newSales) > 0) {
                  startTimerOnSales();
                }

                if (!isHidden) {
                  const salesAmount = document.getElementById(
                    'sales-amount');
                  salesAmount.textContent = newSales;

                  salesAmount.style.transform = 'scale(1.1)';
                  salesAmount.style.color = '#10b981';
                  setTimeout(() => {
                    salesAmount.style.transform = 'scale(1)';
                    salesAmount.style.color = '';
                  }, 500);
                }

                if (data.last_session) {
                  showSalesUpdateNotification(data.last_session);
                }
              }
            }
          } catch (error) {
            // Error updating sales
          }
        }, 60000); // Update every 60 seconds (optimized for server performance)
      }

      const savedDuration = localStorage.getItem('timerDuration');
      if (savedDuration || parseFloat(currentSales.replace(/,/g, '')) > 0) {
        startMonitoring();
      }
    }

    function showSalesUpdateNotification(session) {
      const notification = document.createElement('div');
      notification.className =
        'fixed top-4 right-4 bg-green-500 text-white px-4 py-3 rounded-lg shadow-lg z-50 transform translate-x-full transition-transform duration-300';
      notification.innerHTML = `
      <div class="flex items-center gap-2">
        <i class="fas fa-dollar-sign text-xl"></i>
        <div>
          <div class="font-semibold">مبيعات جديدة!</div>
          <div class="text-sm">${session.room_name} - ${session.total_amount} ${CURRENCY_SYMBOL}</div>
        </div>
      </div>
    `;

      document.body.appendChild(notification);

      setTimeout(() => {
        notification.style.transform = 'translateX(0)';
      }, 100);

      setTimeout(() => {
        notification.style.transform = 'translateX(100%)';
        setTimeout(() => notification.remove(), 300);
      }, 3000);
    }

    // ==================== Timer System ====================
    let timerInterval = null;
    let timerStartTime = null;
    let timerDuration = null;
    let timerActive = false;

    function toggleTimerSettings(event) {
      const dropdown = document.getElementById('timer-dropdown');
      const timerBtn = document.getElementById('timer-settings-btn');

      const isShowing = dropdown.classList.contains('show');
      dropdown.classList.toggle('show');

      // نقل القائمة إلى body إذا لم تكن منقولة بعد (portal pattern)
      if (!dropdown.parentElement || dropdown.parentElement.id !==
        'body-portal') {
        document.body.appendChild(dropdown);
      }

      // تحديد موقع القائمة بناءً على موقع الزر
      if (!isShowing) {
        const btnRect = timerBtn.getBoundingClientRect();
        const dropdownHeight = 280; // ارتفاع تقريبي للقائمة
        const dropdownWidth = 160;
        const viewportHeight = window.innerHeight;
        const viewportWidth = window.innerWidth;

        // حساب المساحة المتاحة
        const spaceBelow = viewportHeight - btnRect.bottom;
        const spaceAbove = btnRect.top;
        const spaceLeft = btnRect.left;
        const spaceRight = viewportWidth - btnRect.right;

        // تحديد الموقع العمودي
        let top, bottom;
        if (spaceBelow >= dropdownHeight || spaceBelow >= spaceAbove) {
          // إظهار أسفل الزر
          top = btnRect.bottom + 8;
          bottom = 'auto';
        } else {
          // إظهار أعلى الزر
          top = 'auto';
          bottom = viewportHeight - btnRect.top + 8;
        }

        // تحديد الموقع الأفقي (RTL support)
        let left, right;
        // محاولة محاذاة من اليسار أولاً
        left = btnRect.left - 60;

        // التأكد من عدم خروج القائمة من حدود الشاشة
        if (left < 10) {
          left = 10; // حد أدنى من اليسار
        }
        if (left + dropdownWidth > viewportWidth - 10) {
          left = viewportWidth - dropdownWidth - 10; // حد أقصى من اليمين
        }

        // تطبيق الموقع
        dropdown.style.top = typeof top === 'number' ? top + 'px' : top;
        dropdown.style.bottom = typeof bottom === 'number' ? bottom + 'px' :
          bottom;
        dropdown.style.left = left + 'px';
        dropdown.style.right = 'auto';
      }
    }

    document.addEventListener('click', function(e) {
      const dropdown = document.getElementById('timer-dropdown');
      const timerBtn = document.getElementById('timer-settings-btn');

      if (!dropdown.contains(e.target) && !timerBtn.contains(e.target)) {
        dropdown.classList.remove('show');
      }
    });

    // إغلاق القائمة عند التمرير
    window.addEventListener('scroll', function() {
      const dropdown = document.getElementById('timer-dropdown');
      if (dropdown && dropdown.classList.contains('show')) {
        dropdown.classList.remove('show');
      }
    }, true);

    // إغلاق القائمة عند تغيير حجم النافذة
    window.addEventListener('resize', function() {
      const dropdown = document.getElementById('timer-dropdown');
      if (dropdown && dropdown.classList.contains('show')) {
        dropdown.classList.remove('show');
      }
    });

    function setTimerDuration(hours, label) {
      timerDuration = hours;
      timerActive = false;

      localStorage.setItem('timerDuration', hours);
      localStorage.removeItem('timerStartTime');
      localStorage.removeItem('timerActive');

      timerStartTime = null;
      if (timerInterval) {
        clearInterval(timerInterval);
        timerInterval = null;
      }

      updateTimerOptions();
      document.getElementById('timer-dropdown').classList.remove('show');

      setTimeout(() => checkCurrentSalesAndStartTimer(), 1000);
    }

    function startTimerOnSales() {
      if (!timerDuration || timerActive) return;

      const savedDuration = localStorage.getItem('timerDuration');
      if (!savedDuration) return;

      timerDuration = parseFloat(savedDuration);
      timerStartTime = new Date().getTime();
      timerActive = true;

      localStorage.setItem('timerStartTime', timerStartTime);
      localStorage.setItem('timerActive', 'true');

      startTimer();
    }

    function checkCurrentSalesAndStartTimer() {
      const salesAmount = document.getElementById('sales-amount');
      const currentAmount = parseFloat(salesAmount.textContent.replace(/[,\s]/g,
        ''));

      if (currentAmount > 0 && timerDuration && !timerActive) {
        startTimerOnSales();
      }
    }

    function startTimer() {
      if (timerInterval) clearInterval(timerInterval);
      timerInterval = setInterval(() => checkTimerExpiry(), 1000);
    }

    function checkTimerExpiry() {
      if (!timerStartTime || !timerDuration) return;

      const now = new Date().getTime();
      const elapsedHours = (now - timerStartTime) / (1000 * 60 * 60);

      if (elapsedHours >= timerDuration) {
        clearSalesFromDatabase();
        clearInterval(timerInterval);
        timerInterval = null;
        timerActive = false;
        showTimerExpiredNotification();
      }
    }

    async function clearSalesFromDatabase() {
      try {
        const response = await fetch('api/clear-sales.php', {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json',
          },
          body: JSON.stringify({
            action: 'clear_today_sales'
          })
        });

        if (!response.ok) {
          const errorText = await response.text();
          throw new Error(`HTTP error! status: ${response.status}`);
        }

        const data = await response.json();

        if (data.success) {
          const salesAmount = document.getElementById('sales-amount');
          salesAmount.textContent = '0.00';

          localStorage.removeItem('timerDuration');
          localStorage.removeItem('timerStartTime');
          localStorage.removeItem('timerActive');
          localStorage.removeItem('savedSalesAmount');

          timerDuration = null;
          timerStartTime = null;
          timerActive = false;

          return true;
        } else {
          alert('فشل التصفير: ' + (data.message || 'خطأ غير معروف'));
          return false;
        }
      } catch (error) {
        alert('حدث خطأ أثناء التصفير. يرجى المحاولة مرة أخرى.');
        return false;
      }
    }

    // دالة جديدة لتصفير مبيعات اليوم من زر السلة
    async function confirmClearSales() {
      showClearSalesModal();
    }

    // دالة إظهار مودال التصفير
    function showClearSalesModal() {
      // إنشاء المودال
      const modal = document.createElement('div');
      modal.id = 'clear-sales-modal';
      modal.className = 'fixed inset-0 z-50 flex items-center justify-center p-4';
      modal.innerHTML = `
      <div class="fixed inset-0 bg-black bg-opacity-50 transition-opacity" onclick="hideClearSalesModal()"></div>
      <div class="relative bg-white dark:bg-gray-800 rounded-2xl shadow-2xl max-w-md w-full mx-4 transform transition-all duration-300 scale-95 opacity-0" id="modal-content">
        <!-- Header -->
        <div class="flex items-center justify-between p-6 border-b border-gray-200 dark:border-gray-700">
          <div class="flex items-center space-x-3 rtl:space-x-reverse">
            <div class="w-10 h-10 bg-red-100 dark:bg-red-900 rounded-full flex items-center justify-center">
              <svg class="w-6 h-6 text-red-600 dark:text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
              </svg>
            </div>
            <h3 class="text-lg font-semibold text-gray-900 dark:text-white">تصفير مبيعات اليوم</h3>
          </div>
          <button onclick="hideClearSalesModal()" class="text-gray-400 hover:text-gray-600 dark:hover:text-gray-300 transition-colors">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
            </svg>
          </button>
        </div>

        <!-- Content -->
        <div class="p-6">
          <p class="text-gray-700 dark:text-gray-300 mb-4 text-right">
            هل أنت متأكد من تصفير عرض مبيعات اليوم؟
          </p>

        </div>

        <!-- Actions -->
        <div class="flex items-center justify-end space-x-3 rtl:space-x-reverse p-6 border-t border-gray-200 dark:border-gray-700">
          <button onclick="hideClearSalesModal()" class="px-6 py-2.5 text-sm font-medium text-gray-700 dark:text-gray-300 bg-gray-100 dark:bg-gray-700 hover:bg-gray-200 dark:hover:bg-gray-600 rounded-lg transition-colors">
            إلغاء
          </button>
          <button onclick="executeClearSales()" class="px-6 py-2.5 text-sm font-medium text-white bg-red-600 hover:bg-red-700 rounded-lg transition-colors flex items-center space-x-2 rtl:space-x-reverse">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
            </svg>
            <span>تصفير</span>
          </button>
        </div>
      </div>
    `;

      // إضافة المودال للصفحة
      document.body.appendChild(modal);

      // إظهار المودال مع أنيميشن
      setTimeout(() => {
        const content = document.getElementById('modal-content');
        content.classList.remove('scale-95', 'opacity-0');
        content.classList.add('scale-100', 'opacity-100');
      }, 10);

      // منع التمرير في الخلفية
      document.body.style.overflow = 'hidden';
    }

    // دالة إخفاء المودال
    function hideClearSalesModal() {
      const modal = document.getElementById('clear-sales-modal');
      if (modal) {
        const content = document.getElementById('modal-content');
        content.classList.remove('scale-100', 'opacity-100');
        content.classList.add('scale-95', 'opacity-0');

        setTimeout(() => {
          modal.remove();
          document.body.style.overflow = '';
        }, 300);
      }
    }

    // دالة تنفيذ التصفير
    async function executeClearSales() {
      hideClearSalesModal();

      const success = await clearSalesFromDatabase();

      if (success) {
        // إعادة تحميل الصفحة لتحديث المبيعات
        setTimeout(() => {
          window.location.reload();
        }, 1000);
      }
    }

    function updateTimerOptions() {
      const options = document.querySelectorAll('.timer-option');
      options.forEach(option => {
        option.classList.remove('active');
        if (Math.abs(parseFloat(option.dataset.duration) - Number(
            timerDuration)) < 1e-6) {
          option.classList.add('active');
        }
      });
    }

    function loadTimerSettings() {
      const savedDuration = localStorage.getItem('timerDuration');
      const savedStartTime = localStorage.getItem('timerStartTime');
      const savedActive = localStorage.getItem('timerActive');

      if (savedDuration && savedStartTime && savedActive === 'true') {
        timerDuration = parseFloat(savedDuration);
        timerStartTime = parseInt(savedStartTime);
        timerActive = true;

        const now = new Date().getTime();
        const elapsedHours = (now - timerStartTime) / (1000 * 60 * 60);

        if (elapsedHours < timerDuration) {
          startTimer();
          updateTimerOptions();
        } else {
          clearSalesFromDatabase();
        }
      } else if (savedDuration) {
        timerDuration = parseFloat(savedDuration);
        updateTimerOptions();
        checkCurrentSalesAndStartTimer();
      }
    }

    function showTimerExpiredNotification() {
      const notification = document.createElement('div');
      notification.className =
        'fixed top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 z-50 bg-red-500 text-white px-6 py-4 rounded-xl shadow-2xl flex items-center gap-3';
      notification.innerHTML = `
      <i class="fas fa-clock text-2xl"></i>
      <span class="font-semibold text-lg">انتهى المؤقت - تم تنظيف العرض فقط (لا حذف للبيانات)</span>
    `;

      document.body.appendChild(notification);

      setTimeout(() => {
        notification.style.opacity = '0';
        notification.style.transform = 'translate(-50%, -50%) scale(0.8)';
        setTimeout(() => notification.remove(), 300);
      }, 3000);
    }

    // ==================== Modal Functions ====================
    function clearPayments() {
      const modal = document.getElementById('clearModal');
      const modalContent = document.getElementById('modalContent');
      modal.classList.remove('hidden');
      setTimeout(() => {
        modalContent.classList.remove('scale-95', 'opacity-0');
        modalContent.classList.add('scale-100', 'opacity-100');
      }, 10);
    }

    function closeClearModal() {
      const modal = document.getElementById('clearModal');
      const modalContent = document.getElementById('modalContent');
      modalContent.classList.remove('scale-100', 'opacity-100');
      modalContent.classList.add('scale-95', 'opacity-0');
      setTimeout(() => modal.classList.add('hidden'), 300);
    }

    function confirmClear() {
      closeClearModal();

      // إرسال الطلب عبر fetch
      fetch('dashboard.php', {
          method: 'POST',
          headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
          },
          body: 'action=clear_payments'
        })
        .then(response => {
          if (response.ok) {
            showSuccessMessage(
              'تم تنظيف السجل الظاهري بنجاح (لا حذف للبيانات)');
            // تحديث الصفحة بعد 2 ثانية
            setTimeout(() => {
              window.location.reload();
            }, 2000);
          }
        })
        .catch(error => {
          // Error occurred
          showSuccessMessage('حدث خطأ أثناء الحذف', 'error');
        });
    }

    // دالة عرض رسالة النجاح
    function showSuccessMessage(message, type = 'success') {
      const notification = document.createElement('div');
      const isMobile = window.innerWidth < 640;

      notification.style.cssText = `
      position: fixed;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%) scale(0.8);
      background: ${type === 'success' ? 'linear-gradient(135deg, #10b981 0%, #059669 100%)' : 'linear-gradient(135deg, #ef4444 0%, #dc2626 100%)'};
      color: white;
      padding: ${isMobile ? '20px 30px' : '30px 50px'};
      border-radius: 20px;
      box-shadow: 0 20px 60px rgba(0, 0, 0, 0.4);
      z-index: 99999;
      opacity: 0;
      transition: all 0.3s ease;
      display: flex;
      align-items: center;
      justify-content: center;
      text-align: center;
      gap: ${isMobile ? '15px' : '20px'};
      min-width: ${isMobile ? '280px' : '300px'};
      max-width: ${isMobile ? '90%' : '500px'};
    `;

      notification.innerHTML = `
      <i class="fas ${type === 'success' ? 'fa-check-circle' : 'fa-exclamation-circle'}" style="font-size: ${isMobile ? '2rem' : '2.5rem'};"></i>
      <span style="font-weight: bold; font-size: ${isMobile ? '1rem' : '1.25rem'};">${message}</span>
    `;

      document.body.appendChild(notification);

      // تفعيل الأنيميشن
      setTimeout(() => {
        notification.style.opacity = '1';
        notification.style.transform = 'translate(-50%, -50%) scale(1)';
      }, 10);

      // إخفاء الرسالة بعد 2 ثانية
      setTimeout(() => {
        notification.style.opacity = '0';
        notification.style.transform = 'translate(-50%, -50%) scale(0.8)';
        setTimeout(() => notification.remove(), 300);
      }, 2000);
    }

    // معالجة إرسال form التنظيف التلقائي
    function handleAutoClearSubmit(event) {
      event.preventDefault();
      closeAutoClearModal();

      const formData = new FormData(event.target);
      const days = formData.get('auto_clear_days');

      fetch('dashboard.php', {
          method: 'POST',
          body: formData
        })
        .then(response => {
          if (response.ok) {
            const daysText = days == 1 ? 'يوم واحد' : days == 3 ? '3 أيام' :
              days == 7 ? 'أسبوع' : days == 15 ? 'أسبوعين' : 'شهر';
            showSuccessMessage(`تم تفعيل التنظيف التلقائي كل ${daysText}`);
            // تحديث الصفحة بعد 2 ثانية
            setTimeout(() => {
              window.location.reload();
            }, 2000);
          }
        })
        .catch(error => {
          // Error occurred
          showSuccessMessage('حدث خطأ أثناء حفظ الإعدادات', 'error');
        });
    }

    function showAutoClearModal() {
      const modal = document.getElementById('autoClearModal');
      const modalContent = document.getElementById('autoClearModalContent');
      modal.classList.remove('hidden');
      setTimeout(() => {
        modalContent.classList.remove('scale-95', 'opacity-0');
        modalContent.classList.add('scale-100', 'opacity-100');
      }, 10);
    }

    function closeAutoClearModal() {
      const modal = document.getElementById('autoClearModal');
      const modalContent = document.getElementById('autoClearModalContent');
      modalContent.classList.remove('scale-100', 'opacity-100');
      modalContent.classList.add('scale-95', 'opacity-0');
      setTimeout(() => modal.classList.add('hidden'), 300);
    }

    // إغلاق Modal عند النقر خارجه أو Escape
    document.getElementById('clearModal').addEventListener('click', function(e) {
      if (e.target === this) closeClearModal();
    });

    document.getElementById('autoClearModal').addEventListener('click', function(
      e) {
      if (e.target === this) closeAutoClearModal();
    });

    document.addEventListener('keydown', function(e) {
      if (e.key === 'Escape') {
        closeClearModal();
        closeAutoClearModal();
      }
    });

    // ==================== Subscription Widget Script ====================
    (function() {
      const subscriptionMetaEl = document.getElementById('subscription-meta');
      if (!subscriptionMetaEl) return;

      const subscriptionData = JSON.parse(subscriptionMetaEl.textContent);
      const {
        effective_status,
        effective_start_at,
        effective_end_at,
        activation_mode
      } = subscriptionData;

      const badgeEl = document.getElementById('subscription-badge');
      const countdownEl = document.getElementById('subscription-countdown');
      const progressFillEl = document.getElementById(
        'subscription-progress-fill');
      if (!badgeEl || !countdownEl || !progressFillEl) return;

      const statusConfig = {
        trial_active: {
          text: 'تجريبي نشط',
          icon: '🧪'
        },
        monthly_active: {
          text: 'شهري نشط',
          icon: '📅'
        },
        expiring_soon: {
          text: 'ينتهي قريباً',
          icon: '⏰'
        },
        expired: {
          text: 'منتهي',
          icon: '⚠️'
        },
        trial_expired: {
          text: 'تجربة منتهية',
          icon: '🧪'
        },
        suspended: {
          text: 'معلق',
          icon: '🚫'
        },
        inactive: {
          text: 'غير نشط',
          icon: '⏸️'
        }
      };

      const config = statusConfig[effective_status] || {
        text: 'غير معروف',
        icon: '❓'
      };
      badgeEl.className = `subscription-badge ${effective_status}`;
      badgeEl.innerHTML =
        `<span>${config.icon}</span><span>${config.text}</span>`;

      function updateCountdownAndProgress() {
        if (!effective_end_at) {
          countdownEl.textContent = 'لا يوجد تاريخ انتهاء';
          progressFillEl.style.width = '0%';
          return;
        }

        const now = new Date();
        const end = new Date(effective_end_at);
        const start = effective_start_at ? new Date(effective_start_at) : null;

        const diffMs = end - now;

        if (diffMs <= 0) {
          countdownEl.textContent = 'انتهى الاشتراك';
          progressFillEl.style.width = '100%';
          progressFillEl.className = 'subscription-progress-fill progress-red';

          badgeEl.className = 'subscription-badge expired';
          badgeEl.innerHTML = '<span>⚠️</span><span>منتهي</span>';
          return;
        }

        const diffMins = Math.floor(diffMs / (1000 * 60));
        const diffHours = Math.floor(diffMs / (1000 * 60 * 60));
        // توحيد منطق التقريب مع صفحة إدارة العملاء: تقريب إلى أقرب يوم
        const diffDaysPrecise = diffMs / (1000 * 60 * 60 * 24);
        const diffDays = Math.round(diffDaysPrecise);

        let countdownFull = '';
        let countdownShort = '';
        if (diffMins < 60) {
          countdownFull = `ينتهي خلال ${diffMins} دقيقة`;
          countdownShort = `ينتهي (${diffMins}د)`;
        } else if (diffHours < 24) {
          countdownFull = `ينتهي خلال ${diffHours} ساعة`;
          countdownShort = `ينتهي (${diffHours}س)`;
        } else {
          countdownFull = `ينتهي خلال ${diffDays} يوم`;
          countdownShort = `ينتهي (${diffDays})`;
        }
        countdownEl.textContent = countdownFull;
        countdownEl.setAttribute('data-short', countdownShort);

        let percentUsed = 0;
        if (start) {
          const totalDuration = end - start;
          const elapsed = now - start;
          percentUsed = Math.min(Math.max((elapsed / totalDuration) * 100, 0),
            100);
        } else {
          if (diffDays <= 1) percentUsed = 90;
          else if (diffDays <= 3) percentUsed = 75;
          else if (diffDays <= 7) percentUsed = 50;
          else percentUsed = 25;
        }

        let progressClass = 'progress-green';
        if (percentUsed >= 75) progressClass = 'progress-red';
        else if (percentUsed >= 50) progressClass = 'progress-yellow';
        else if (percentUsed >= 25) progressClass = 'progress-orange';

        progressFillEl.style.width = percentUsed + '%';
        progressFillEl.className =
          `subscription-progress-fill ${progressClass}`;
      }

      updateCountdownAndProgress();

      const updateInterval = (effective_status === 'trial_active') ? 1000 :
        30000;
      setInterval(updateCountdownAndProgress, updateInterval);

    })();

    // Dynamic Low Stock Bell - Show/Hide based on inventory count
    (function() {
      function updateLowStockBellVisibility() {
        // Checking inventory status
        const controller = new AbortController();
        const timeoutId = setTimeout(() => controller.abort(),
          5000); // 5 second timeout

        fetch('api/inventory-status.php?action=low_stock_count&t=' + Date
            .now(), {
              signal: controller.signal,
              cache: 'no-cache'
            })
          .then(response => response.json())
          .then(data => {
            clearTimeout(timeoutId);
            // API Response received

            if (data.success) {
              const total = parseInt(data.total) || 0;
              const desktopBell = document.getElementById(
                'low-stock-bell-desktop');
              const mobileBell = document.getElementById(
                'low-stock-bell-mobile');

              // Update bell visibility based on total count

              // Show or hide bell based on count
              const displayValue = total > 0 ? 'block' : 'none';

              if (desktopBell) {
                desktopBell.style.display = displayValue;
                // Desktop bell updated
              }

              if (mobileBell) {
                mobileBell.style.display = displayValue;
                // Mobile bell updated
              }
            }
          })
          .catch(err => {
            clearTimeout(timeoutId);
            // Error occurred - silent fail
          });
      }

      // Update immediately on page load
      // Initializing low stock bell
      updateLowStockBellVisibility();

      // Then update every 5 minutes (optimized for server performance)
      setInterval(updateLowStockBellVisibility, 300000);
    })();

    // ================================================================
    // Welcome Banner System
    // ================================================================
    (function() {
      // Get banner settings from PHP
      const bannerEnabled =
        true;
      const bannerImageUrl =
        "uploads\/branding\/banner_1779212837_6a0ca225e8456.jpg";
      const bannerRepeatSeconds =
        43200;
      const bannerCloseMode =
        "auto";
      const bannerAutoCloseSeconds =
        3;
      const bannerShowTo =
        "all_except_super";
      const userId = 350;
      const userType = "admin";
      const isSuperAdmin =
        false;

      // Check if banner should be shown
      function shouldShowBanner() {
        // Banner must be enabled and have an image
        if (!bannerEnabled || !bannerImageUrl) {
          return false;
        }

        // Check user type
        if (isSuperAdmin) {
          return false; // Never show to super admin
        }

        if (bannerShowTo === 'admin_only' && userType !== 'admin') {
          return false; // Show only to admin
        }

        // Check last shown time from localStorage
        const storageKey = `welcomeBannerLastShown_${userId}`;
        const lastShown = localStorage.getItem(storageKey);

        if (!lastShown) {
          return true; // First time showing
        }

        // Check if enough time has passed
        const lastShownTime = new Date(lastShown).getTime();
        const now = new Date().getTime();
        const secondsPassed = Math.floor((now - lastShownTime) / 1000);
        return secondsPassed >= bannerRepeatSeconds;
      }

      // Create and show banner
      function showWelcomeBanner() {
        // Create modal overlay
        const modal = document.createElement('div');
        modal.id = 'welcomeBannerModal';
        modal.style.cssText = `
          position: fixed;
          top: 0;
          left: 0;
          width: 100%;
          height: 100%;
          background-color: rgba(0, 0, 0, 0.75);
          display: flex;
          align-items: center;
          justify-content: center;
          z-index: 9999;
          padding: 20px;
          opacity: 0;
          transition: opacity 0.3s ease;
        `;

        // Create modal content
        const modalContent = document.createElement('div');
        modalContent.style.cssText = `
          position: relative;
          max-width: 90vw;
          max-height: 90vh;
          background: white;
          border-radius: 16px;
          overflow: hidden;
          box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5);
          transform: scale(0.9);
          transition: transform 0.3s ease;
        `;

        // Create close button if manual mode or allow manual close
        if (bannerCloseMode === 'manual') {
          const closeBtn = document.createElement('button');
          closeBtn.innerHTML = '&times;';
          closeBtn.style.cssText = `
            position: absolute;
            top: 12px;
            right: 12px;
            background: rgba(255, 255, 255, 0.9);
            border: none;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            font-size: 28px;
            line-height: 1;
            cursor: pointer;
            color: #333;
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 10;
            transition: all 0.2s ease;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.15);
          `;
          closeBtn.onmouseover = () => {
            closeBtn.style.background = 'rgba(239, 68, 68, 0.9)';
            closeBtn.style.color = 'white';
            closeBtn.style.transform = 'scale(1.1)';
          };
          closeBtn.onmouseout = () => {
            closeBtn.style.background = 'rgba(255, 255, 255, 0.9)';
            closeBtn.style.color = '#333';
            closeBtn.style.transform = 'scale(1)';
          };
          closeBtn.onclick = closeBanner;
          modalContent.appendChild(closeBtn);
        }

        // Create image
        const img = document.createElement('img');
        img.src = bannerImageUrl;
        img.alt = 'مرحباً بك';
        img.style.cssText = `
          display: block;
          width: 100%;
          height: auto;
          max-height: 85vh;
          object-fit: contain;
        `;
        img.onerror = () => {
          closeBanner();
        };

        modalContent.appendChild(img);
        modal.appendChild(modalContent);
        document.body.appendChild(modal);

        // Animate in
        requestAnimationFrame(() => {
          modal.style.opacity = '1';
          modalContent.style.transform = 'scale(1)';
        });

        // Close on escape key
        const handleEscape = (e) => {
          if (e.key === 'Escape') {
            closeBanner();
          }
        };
        document.addEventListener('keydown', handleEscape);

        // Close on overlay click
        modal.addEventListener('click', (e) => {
          if (e.target === modal) {
            closeBanner();
          }
        });

        // Auto close if enabled
        let autoCloseTimer = null;
        if (bannerCloseMode === 'auto' && bannerAutoCloseSeconds > 0) {
          autoCloseTimer = setTimeout(() => {
            closeBanner();
          }, bannerAutoCloseSeconds * 1000);
        }

        // Close banner function
        function closeBanner() {
          // Clear auto close timer
          if (autoCloseTimer) {
            clearTimeout(autoCloseTimer);
          }

          // Remove escape key listener
          document.removeEventListener('keydown', handleEscape);

          // Animate out
          modal.style.opacity = '0';
          modalContent.style.transform = 'scale(0.9)';

          setTimeout(() => {
            if (modal.parentNode) {
              modal.parentNode.removeChild(modal);
            }
          }, 300);

          // Update last shown time
          const storageKey = `welcomeBannerLastShown_${userId}`;
          localStorage.setItem(storageKey, new Date().toISOString());
        }
      }

      // Initialize banner
      if (shouldShowBanner()) {
        // Delay showing banner slightly to let page load
        setTimeout(() => {
          showWelcomeBanner();
        }, 500);
      }
    })();

    // ✨ مودال انتهاء الاشتراك
    function showExpiredModal() {
      const isTrial =
        false;
      const modal = document.createElement('div');
      modal.id = 'expiredModal';
      modal.className =
        'fixed inset-0 bg-black/50 backdrop-blur-sm z-[9999] flex items-center justify-center p-4';
      modal.style.opacity = '0';
      modal.style.transition = 'opacity 0.3s ease';

      modal.innerHTML = `
      <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-2xl max-w-md w-full transform scale-95 transition-all duration-300" style="animation: slideIn 0.3s ease-out forwards;">
        <div class="bg-gradient-to-r from-red-500 to-orange-500 rounded-t-2xl p-6 text-center">
          <div class="w-20 h-20 bg-white/20 rounded-full flex items-center justify-center mx-auto mb-4">
            <i class="fas fa-exclamation-triangle text-4xl text-white"></i>
          </div>
          <h3 class="text-2xl font-bold text-white">
            ${isTrial ? 'انتهت فترة التجربة' : 'اشتراكك منتهي'}
          </h3>
        </div>
        <div class="p-6">
          <p class="text-gray-700 dark:text-gray-300 text-center mb-6 leading-relaxed">
            ${isTrial
              ? 'انتهت فترة التجربة المجانية. للوصول إلى هذه الميزة، يرجى الاشتراك في إحدى الباقات.'
              : 'انتهت صلاحية اشتراكك. جميع الميزات معطلة مؤقتاً. يرجى تجديد الاشتراك للمتابعة.'
            }
          </p>
          <div class="space-y-3">
            <a href="subscription-upgrade.php"
               class="block w-full text-center px-6 py-3 bg-gradient-to-r from-green-600 to-teal-600 text-white font-bold rounded-lg hover:from-green-700 hover:to-teal-700 transition-all shadow-md hover:shadow-lg">
              <i class="fas fa-rocket ml-2"></i>
              ${isTrial ? 'اشترك الآن' : 'جدد الاشتراك'}
            </a>
            <button onclick="document.getElementById('expiredModal').remove()"
                    class="block w-full text-center px-6 py-3 bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-gray-300 font-semibold rounded-lg hover:bg-gray-300 dark:hover:bg-gray-600 transition-all">
              <i class="fas fa-times ml-2"></i>
              لاحقاً
            </button>
          </div>
        </div>
      </div>
    `;

      document.body.appendChild(modal);
      requestAnimationFrame(() => {
        modal.style.opacity = '1';
      });

      // إغلاق عند النقر خارج المودال
      modal.addEventListener('click', (e) => {
        if (e.target === modal) {
          modal.style.opacity = '0';
          setTimeout(() => modal.remove(), 300);
        }
      });
    }

    // CSS Animation
    const style = document.createElement('style');
    style.textContent = `
    @keyframes slideIn {
      from {
        transform: scale(0.95) translateY(-20px);
        opacity: 0;
      }
      to {
        transform: scale(1) translateY(0);
        opacity: 1;
      }
    }
  `;
    document.head.appendChild(style);
  </script>

  <!-- Tutorial Video Modal -->
  <script>
    function openTutorialVideo() {
      const videoUrl =
        "";
      if (!videoUrl) {
        alert('لم يتم إعداد رابط الفيديو بعد');
        return;
      }

      // Convert YouTube URL to embed format
      let embedUrl = '';
      if (videoUrl.includes('youtube.com/watch?v=')) {
        const videoId = videoUrl.split('v=')[1]?.split('&')[0];
        embedUrl = `https://www.youtube.com/embed/${videoId}`;
      } else if (videoUrl.includes('youtu.be/')) {
        const videoId = videoUrl.split('youtu.be/')[1]?.split('?')[0];
        embedUrl = `https://www.youtube.com/embed/${videoId}`;
      } else if (videoUrl.includes('youtube.com/embed/')) {
        embedUrl = videoUrl;
      } else {
        alert('رابط يوتيوب غير صحيح');
        return;
      }

      // Create modal
      const modal = document.createElement('div');
      modal.id = 'tutorialVideoModal';
      modal.className =
        'fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-75 transition-opacity duration-300 p-4';
      modal.style.opacity = '0';
      modal.innerHTML = `
        <div class="relative bg-white rounded-xl shadow-2xl overflow-hidden flex flex-col" style="width: 100%; max-width: 854px; max-height: 90vh;">
          <!-- Header -->
          <div class="flex items-center justify-between p-4 bg-gradient-to-r from-indigo-600 to-purple-600" style="flex-shrink: 0; z-index: 10;">
            <h3 class="text-lg sm:text-xl font-bold text-white flex items-center gap-2">
              <i class="fas fa-video"></i>
              <span>شرح النظام</span>
            </h3>
            <button
              onclick="closeTutorialVideo()"
              class="text-white hover:text-gray-200 transition-colors p-2 rounded-lg hover:bg-white/20 cursor-pointer z-20"
              title="إغلاق">
              <i class="fas fa-times text-xl"></i>
            </button>
          </div>
          <!-- Video Container - YouTube Standard Size (854x480) -->
          <div class="relative bg-black" style="width: 100%; padding-bottom: 56.25%; height: 0; overflow: hidden;">
            <iframe
              src="${embedUrl}?autoplay=1&rel=0"
              frameborder="0"
              allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
              allowfullscreen
              style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; border: none;">
            </iframe>
          </div>
        </div>
      `;

      document.body.appendChild(modal);
      document.body.style.overflow = 'hidden';

      // Animate in
      requestAnimationFrame(() => {
        modal.style.opacity = '1';
      });

      // Close on background click
      modal.addEventListener('click', (e) => {
        if (e.target === modal) {
          closeTutorialVideo();
        }
      });

      // Close on Escape key
      const escapeHandler = (e) => {
        if (e.key === 'Escape') {
          closeTutorialVideo();
          document.removeEventListener('keydown', escapeHandler);
        }
      };
      document.addEventListener('keydown', escapeHandler);
    }

    function closeTutorialVideo() {
      const modal = document.getElementById('tutorialVideoModal');
      if (modal) {
        modal.style.opacity = '0';
        const content = modal.querySelector('div');
        if (content) {
          content.style.transform = 'scale(0.95)';
        }
        setTimeout(() => {
          modal.remove();
          document.body.style.overflow = '';
        }, 300);
      }
    }
  </script>

  <!-- PWA Manager -->
  <script src="/js/pwa-manager.js"></script>

  <!-- ══════════════════════════════════════════════════════
       كارت الإعدادات — نافذة إعدادات SMS للأدمن
       ══════════════════════════════════════════════════════ -->
  <!-- Modal Overlay -->

</body>

</html>