<?php
require_once __DIR__ . '/../includes/auth_helper.php';

$user   = requireAuth();
$client = (int)$user['client_id'];
$pdo    = getDB();

$body   = json_decode(file_get_contents('php://input'), true) ?? [];
$action = $body['action'] ?? $_GET['action'] ?? '';

switch ($action) {

    case 'list':
    case 'get_inventory':
        $stmt = $pdo->prepare("SELECT * FROM menu_items WHERE client_id=? AND is_active=1 ORDER BY category, name");
        $stmt->execute([$client]);
        jsonSuccess(['items' => $stmt->fetchAll()]);

    case 'low_stock_count':
        $stmt = $pdo->prepare("SELECT COUNT(*) FROM menu_items WHERE client_id=? AND stock IS NOT NULL AND stock <= low_stock_threshold AND is_active=1");
        $stmt->execute([$client]);
        jsonSuccess(['count' => (int)$stmt->fetchColumn()]);

    case 'low_stock_lists':
        $stmt = $pdo->prepare("SELECT * FROM menu_items WHERE client_id=? AND stock IS NOT NULL AND stock <= low_stock_threshold AND is_active=1");
        $stmt->execute([$client]);
        jsonSuccess(['items' => $stmt->fetchAll()]);

    case 'update_stock':
        requirePermission('orders');
        $itemId = (int)($body['item_id'] ?? 0);
        $stock  = (int)($body['stock'] ?? 0);
        if (!$itemId) jsonError('item_id مطلوب');
        $stmt = $pdo->prepare("UPDATE menu_items SET stock=?, updated_at=NOW() WHERE id=? AND client_id=?");
        $stmt->execute([$stock, $itemId, $client]);
        jsonSuccess(['message' => 'تم تحديث المخزون']);

    default:
        jsonError('إجراء غير صالح', 400);
}
