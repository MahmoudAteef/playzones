<?php
require_once __DIR__ . '/../includes/auth_helper.php';

$user   = requirePermission('customers');
$client = (int)$user['client_id'];
$pdo    = getDB();
$method = $_SERVER['REQUEST_METHOD'];

$body   = json_decode(file_get_contents('php://input'), true) ?? [];
$action = $body['action'] ?? $_GET['action'] ?? '';

switch ($action) {

    case 'list':
    case 'get_customers':
        $page  = max(1, (int)($body['page'] ?? $_GET['page'] ?? 1));
        $limit = 30;
        $offset = ($page - 1) * $limit;
        $search = trim($body['search'] ?? $_GET['search'] ?? '');
        $where  = 'WHERE c.client_id = ?';
        $params = [$client];
        if ($search) {
            $where  .= ' AND (c.name LIKE ? OR c.phone LIKE ?)';
            $params[] = "%$search%";
            $params[] = "%$search%";
        }
        $countStmt = $pdo->prepare("SELECT COUNT(*) FROM customers c $where");
        $countStmt->execute($params);
        $total = (int)$countStmt->fetchColumn();

        $stmt = $pdo->prepare("SELECT * FROM customers c $where ORDER BY c.last_visit DESC LIMIT $limit OFFSET $offset");
        $stmt->execute($params);
        jsonSuccess(['customers' => $stmt->fetchAll(), 'total' => $total, 'page' => $page]);

    case 'search_phone':
        $q = trim($_GET['q'] ?? $body['q'] ?? '');
        if (strlen($q) < 2) jsonSuccess(['customers' => []]);
        $stmt = $pdo->prepare("SELECT id, name, phone FROM customers WHERE client_id=? AND phone LIKE ? AND is_active=1 LIMIT 10");
        $stmt->execute([$client, "%$q%"]);
        jsonSuccess(['customers' => $stmt->fetchAll()]);

    case 'get':
        $id = (int)($body['id'] ?? $_GET['id'] ?? 0);
        $stmt = $pdo->prepare("SELECT * FROM customers WHERE id=? AND client_id=?");
        $stmt->execute([$id, $client]);
        $c = $stmt->fetch();
        if (!$c) jsonError('العميل غير موجود', 404);
        // آخر جلسات
        $stmt2 = $pdo->prepare("SELECT s.*, r.name as room_name FROM sessions s JOIN rooms r ON r.id=s.room_id WHERE s.customer_id=? ORDER BY s.created_at DESC LIMIT 10");
        $stmt2->execute([$id]);
        jsonSuccess(['customer' => $c, 'sessions' => $stmt2->fetchAll()]);

    case 'create':
        $name  = trim($body['name'] ?? '');
        $phone = trim($body['phone'] ?? '');
        if (!$name) jsonError('الاسم مطلوب');
        // تحقق من التكرار
        if ($phone) {
            $stmt = $pdo->prepare("SELECT COUNT(*) FROM customers WHERE client_id=? AND phone=?");
            $stmt->execute([$client, $phone]);
            if ($stmt->fetchColumn() > 0) jsonError('رقم الهاتف مسجل مسبقاً');
        }
        $stmt = $pdo->prepare("INSERT INTO customers (client_id, name, phone, notes) VALUES (?,?,?,?)");
        $stmt->execute([$client, $name, $phone, $body['notes'] ?? '']);
        jsonSuccess(['id' => $pdo->lastInsertId(), 'message' => 'تم إضافة العميل']);

    case 'update':
        $id    = (int)($body['id'] ?? 0);
        $name  = trim($body['name'] ?? '');
        $phone = trim($body['phone'] ?? '');
        if (!$id || !$name) jsonError('بيانات غير صحيحة');
        $stmt = $pdo->prepare("UPDATE customers SET name=?, phone=?, notes=?, updated_at=NOW() WHERE id=? AND client_id=?");
        $stmt->execute([$name, $phone, $body['notes'] ?? '', $id, $client]);
        jsonSuccess(['message' => 'تم التعديل']);

    case 'delete':
        requireAdmin();
        $id = (int)($body['id'] ?? 0);
        $stmt = $pdo->prepare("UPDATE customers SET is_active=0 WHERE id=? AND client_id=?");
        $stmt->execute([$id, $client]);
        jsonSuccess(['message' => 'تم الحذف']);

    default:
        jsonError('إجراء غير مدعوم', 400);
}
