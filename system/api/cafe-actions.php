<?php
require_once __DIR__ . '/../includes/auth_helper.php';

$user   = requireAuth();
$client = (int)$user['client_id'];
$pdo    = getDB();

$body   = json_decode(file_get_contents('php://input'), true) ?? [];
$action = $body['action'] ?? $_GET['action'] ?? '';

switch ($action) {

    // ── قائمة المنيو ──────────────────────────────────
    case 'get_menu':
    case 'list':
    case 'get_items':
        $stmt = $pdo->prepare("SELECT * FROM menu_items WHERE client_id=? AND is_active=1 ORDER BY category, sort_order, name");
        $stmt->execute([$client]);
        $items = $stmt->fetchAll();
        // تجميع حسب الفئة
        $grouped = [];
        foreach ($items as $item) {
            $grouped[$item['category']][] = $item;
        }
        jsonSuccess(['items' => $items, 'grouped' => $grouped]);

    case 'create_item':
        requirePermission('orders');
        $name     = trim($body['name'] ?? '');
        $price    = (float)($body['price'] ?? 0);
        $category = trim($body['category'] ?? 'مشروبات');
        $stock    = isset($body['stock']) ? (int)$body['stock'] : null;
        if (!$name || $price <= 0) jsonError('الاسم والسعر مطلوبان');
        $stmt = $pdo->prepare("INSERT INTO menu_items (client_id, name, price, category, stock) VALUES (?,?,?,?,?)");
        $stmt->execute([$client, $name, $price, $category, $stock]);
        jsonSuccess(['id' => $pdo->lastInsertId(), 'message' => 'تم الإضافة']);

    case 'update_item':
        requirePermission('orders');
        $id    = (int)($body['id'] ?? 0);
        $name  = trim($body['name'] ?? '');
        $price = (float)($body['price'] ?? 0);
        $cat   = trim($body['category'] ?? 'مشروبات');
        $stock = isset($body['stock']) ? (int)$body['stock'] : null;
        if (!$id) jsonError('id مطلوب');
        $stmt = $pdo->prepare("UPDATE menu_items SET name=?, price=?, category=?, stock=?, updated_at=NOW() WHERE id=? AND client_id=?");
        $stmt->execute([$name, $price, $cat, $stock, $id, $client]);
        jsonSuccess(['message' => 'تم التعديل']);

    case 'delete_item':
        requireAdmin();
        $id = (int)($body['id'] ?? 0);
        $pdo->prepare("UPDATE menu_items SET is_active=0 WHERE id=? AND client_id=?")->execute([$id, $client]);
        jsonSuccess(['message' => 'تم الحذف']);

    case 'create_cafe_session':
        // جلسة كافيه بدون غرفة
        jsonError('الجلسات المستقلة للكافيه غير مدعومة حالياً');

    default:
        jsonError('إجراء غير مدعوم', 400);
}
