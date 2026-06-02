<?php
require_once __DIR__ . '/../includes/auth_helper.php';
$user   = requireAdmin();
$client = (int)$user['client_id'];
$pdo    = getDB();

$body   = json_decode(file_get_contents('php://input'), true) ?? [];
$action = $body['action'] ?? $_GET['action'] ?? 'list';

switch ($action) {
    case 'list':
    case 'get_types':
        $stmt = $pdo->prepare("SELECT * FROM device_types WHERE client_id=? AND is_active=1 ORDER BY sort_order, name_ar");
        $stmt->execute([$client]);
        jsonSuccess(['types' => $stmt->fetchAll()]);

    case 'create':
        $nameAr = trim($body['name_ar'] ?? '');
        $nameEn = trim($body['name_en'] ?? '');
        $slug   = trim($body['slug'] ?? strtoupper(preg_replace('/\s+/', '', $nameEn)));
        if (!$nameAr || !$slug) jsonError('البيانات غير مكتملة');
        $stmt = $pdo->prepare("INSERT INTO device_types (client_id, name_ar, name_en, slug) VALUES (?,?,?,?)");
        $stmt->execute([$client, $nameAr, $nameEn, $slug]);
        jsonSuccess(['id' => $pdo->lastInsertId(), 'message' => 'تم الإضافة']);

    case 'update':
        $id     = (int)($body['id'] ?? 0);
        $nameAr = trim($body['name_ar'] ?? '');
        $nameEn = trim($body['name_en'] ?? '');
        if (!$id || !$nameAr) jsonError('بيانات غير صحيحة');
        $pdo->prepare("UPDATE device_types SET name_ar=?, name_en=? WHERE id=? AND client_id=?")->execute([$nameAr, $nameEn, $id, $client]);
        jsonSuccess(['message' => 'تم التعديل']);

    case 'delete':
        $id = (int)($body['id'] ?? 0);
        $pdo->prepare("UPDATE device_types SET is_active=0 WHERE id=? AND client_id=?")->execute([$id, $client]);
        jsonSuccess(['message' => 'تم الحذف']);

    default:
        jsonError('إجراء غير معروف');
}
