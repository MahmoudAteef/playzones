<?php
require_once __DIR__ . '/../includes/auth_helper.php';

$user   = requireAuth();
$client = (int)$user['client_id'];
$pdo    = getDB();

$period = $_GET['period'] ?? 'today';

// تحديد نطاق التاريخ
switch ($period) {
    case 'week':
        $from = date('Y-m-d 00:00:00', strtotime('-7 days'));
        break;
    case 'month':
        $from = date('Y-m-01 00:00:00');
        break;
    case 'yesterday':
        $from = date('Y-m-d 00:00:00', strtotime('-1 day'));
        $to   = date('Y-m-d 23:59:59', strtotime('-1 day'));
        break;
    default: // today
        $from = date('Y-m-d 00:00:00');
        break;
}
$to = $to ?? date('Y-m-d 23:59:59');

// إجمالي المبيعات
$stmt = $pdo->prepare("SELECT COALESCE(SUM(total_amount),0) FROM sessions WHERE client_id=? AND status='ended' AND end_time BETWEEN ? AND ?");
$stmt->execute([$client, $from, $to]);
$totalSales = (float)$stmt->fetchColumn();

// آخر جلسة
$stmt2 = $pdo->prepare("SELECT s.id, s.total_amount as amount, u.username, s.created_at FROM sessions s JOIN users u ON u.id=s.user_id WHERE s.client_id=? AND s.status='ended' ORDER BY s.end_time DESC LIMIT 1");
$stmt2->execute([$client]);
$lastSession = $stmt2->fetch() ?: null;

// عدد الجلسات
$stmt3 = $pdo->prepare("SELECT COUNT(*) FROM sessions WHERE client_id=? AND status='ended' AND end_time BETWEEN ? AND ?");
$stmt3->execute([$client, $from, $to]);
$sessionCount = (int)$stmt3->fetchColumn();

// جلسات نشطة الآن
$stmt4 = $pdo->prepare("SELECT COUNT(*) FROM sessions WHERE client_id=? AND status='active'");
$stmt4->execute([$client]);
$activeSessions = (int)$stmt4->fetchColumn();

jsonSuccess([
    'today_sales'     => number_format($totalSales, 2, '.', ''),
    'session_count'   => $sessionCount,
    'active_sessions' => $activeSessions,
    'last_session'    => $lastSession,
    'period'          => $period,
    'from'            => $from,
    'to'              => $to,
]);
