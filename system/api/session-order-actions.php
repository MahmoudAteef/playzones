<?php
require_once __DIR__ . '/../includes/auth_helper.php';

$user   = requireAuth();
$client = (int)$user['client_id'];
$pdo    = getDB();

$body   = json_decode(file_get_contents('php://input'), true) ?? [];
$action = $body['action'] ?? $_GET['action'] ?? '';

switch ($action) {

    case 'list_items':
    case 'get_orders':
        $sessionId = (int)($body['session_id'] ?? $_GET['session_id'] ?? 0);
        $type      = $body['type'] ?? $_GET['type'] ?? null; // category filter
        if (!$sessionId) jsonError('session_id مطلوب');
        $where  = 'WHERE o.session_id=? AND o.client_id=?';
        $params = [$sessionId, $client];
        if ($type) { $where .= ' AND mi.category=?'; $params[] = $type; }
        $stmt = $pdo->prepare("SELECT o.*, mi.category FROM orders o JOIN menu_items mi ON mi.id=o.item_id $where ORDER BY o.created_at DESC");
        $stmt->execute($params);
        jsonSuccess(['orders' => $stmt->fetchAll()]);

    case 'add_order':
        $sessionId = (int)($body['session_id'] ?? 0);
        $itemId    = (int)($body['item_id'] ?? 0);
        $qty       = max(1, (int)($body['quantity'] ?? 1));
        if (!$sessionId || !$itemId) jsonError('بيانات غير صحيحة');

        // تأكد الجلسة نشطة
        $stmt = $pdo->prepare("SELECT id FROM sessions WHERE id=? AND client_id=? AND status='active'");
        $stmt->execute([$sessionId, $client]);
        if (!$stmt->fetch()) jsonError('الجلسة غير نشطة');

        // جيب الآيتم
        $stmt2 = $pdo->prepare("SELECT * FROM menu_items WHERE id=? AND client_id=? AND is_active=1");
        $stmt2->execute([$itemId, $client]);
        $item = $stmt2->fetch();
        if (!$item) jsonError('العنصر غير موجود');

        // تحقق من المخزون
        if ($item['stock'] !== null && $item['stock'] < $qty) {
            jsonError('المخزون غير كافٍ (متاح: ' . $item['stock'] . ')');
        }

        $total = $item['price'] * $qty;
        $stmt3 = $pdo->prepare("INSERT INTO orders (client_id, session_id, user_id, item_id, item_name, quantity, unit_price, total_price) VALUES (?,?,?,?,?,?,?,?)");
        $stmt3->execute([$client, $sessionId, $user['id'], $itemId, $item['name'], $qty, $item['price'], $total]);

        // خصم من المخزون
        if ($item['stock'] !== null) {
            $pdo->prepare("UPDATE menu_items SET stock=stock-? WHERE id=?")->execute([$qty, $itemId]);
        }

        // تحديث orders_amount في الجلسة
        $pdo->prepare("UPDATE sessions SET orders_amount=orders_amount+?, updated_at=NOW() WHERE id=?")->execute([$total, $sessionId]);

        jsonSuccess(['order_id' => $pdo->lastInsertId(), 'message' => 'تم إضافة الطلب']);

    case 'cancel_order':
        $orderId = (int)($body['order_id'] ?? 0);
        $stmt = $pdo->prepare("SELECT * FROM orders WHERE id=? AND client_id=?");
        $stmt->execute([$orderId, $client]);
        $order = $stmt->fetch();
        if (!$order) jsonError('الطلب غير موجود');

        $pdo->prepare("UPDATE orders SET status='cancelled' WHERE id=?")->execute([$orderId]);
        // إرجاع المبلغ من الجلسة
        $pdo->prepare("UPDATE sessions SET orders_amount=GREATEST(0, orders_amount-?), updated_at=NOW() WHERE id=?")->execute([$order['total_price'], $order['session_id']]);
        // إرجاع المخزون
        $pdo->prepare("UPDATE menu_items SET stock=stock+? WHERE id=? AND stock IS NOT NULL")->execute([$order['quantity'], $order['item_id']]);

        jsonSuccess(['message' => 'تم إلغاء الطلب']);

    case 'update_stock':
        requirePermission('orders');
        $itemId = (int)($body['item_id'] ?? 0);
        $stock  = (int)($body['stock'] ?? 0);
        $stmt = $pdo->prepare("UPDATE menu_items SET stock=? WHERE id=? AND client_id=?");
        $stmt->execute([$stock, $itemId, $client]);
        jsonSuccess(['message' => 'تم تحديث المخزون']);

    // جلب حالة المخزون
    case 'low_stock_count':
        $stmt = $pdo->prepare("SELECT COUNT(*) FROM menu_items WHERE client_id=? AND stock IS NOT NULL AND stock <= low_stock_threshold AND is_active=1");
        $stmt->execute([$client]);
        jsonSuccess(['count' => (int)$stmt->fetchColumn()]);

    case 'low_stock_lists':
        $stmt = $pdo->prepare("SELECT * FROM menu_items WHERE client_id=? AND stock IS NOT NULL AND stock <= low_stock_threshold AND is_active=1");
        $stmt->execute([$client]);
        jsonSuccess(['items' => $stmt->fetchAll()]);

    default:
        jsonError('إجراء غير مدعوم', 400);
}
