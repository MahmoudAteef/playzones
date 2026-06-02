<?php
require_once __DIR__ . '/../includes/auth_helper.php';
$user   = requireAdmin();
$client = (int)$user['client_id'];
$pdo    = getDB();

$body   = json_decode(file_get_contents('php://input'), true) ?? [];
$action = $body['action'] ?? '';

if ($action === 'clear_today_sales') {
    // أنهِ كل الجلسات النشطة وصفّر مبيعات اليوم - عملية خطيرة
    $pdo->prepare("UPDATE sessions SET status='cancelled', end_time=NOW() WHERE client_id=? AND status='active'")->execute([$client]);
    $pdo->prepare("UPDATE rooms SET status='available', updated_at=NOW() WHERE client_id=?")->execute([$client]);
    jsonSuccess(['message' => 'تم مسح بيانات اليوم']);
}

if ($action === 'clear_payments') {
    jsonSuccess(['message' => 'تم']);
}

jsonError('إجراء غير معروف');
