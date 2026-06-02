<?php
require_once __DIR__ . '/../includes/auth_helper.php';

$user   = requireAuth();
$client = (int)$user['client_id'];
$pdo    = getDB();
$method = $_SERVER['REQUEST_METHOD'];

// ================================================================
// GET - جيب الغرف
// ================================================================
if ($method === 'GET') {
    $id = isset($_GET['id']) ? (int)$_GET['id'] : null;

    if ($id) {
        $stmt = $pdo->prepare("
            SELECT r.*, dt.name_ar as device_type_name_ar, dt.name_en as device_type_name_en
            FROM rooms r
            LEFT JOIN device_types dt ON dt.slug = r.device_type AND dt.client_id = r.client_id
            WHERE r.id = ? AND r.client_id = ?
        ");
        $stmt->execute([$id, $client]);
        $room = $stmt->fetch();
        if (!$room) jsonError('الغرفة غير موجودة', 404);
        jsonSuccess(['room' => $room]);
    }

    $whereActive = isset($_GET['include_inactive']) ? '' : 'AND r.is_active = 1';
    $stmt = $pdo->prepare("
        SELECT r.*, dt.name_ar as device_type_name_ar, dt.name_en as device_type_name_en
        FROM rooms r
        LEFT JOIN device_types dt ON dt.slug = r.device_type AND dt.client_id = r.client_id
        WHERE r.client_id = ? $whereActive
        ORDER BY r.sort_order, r.name
    ");
    $stmt->execute([$client]);
    $rooms = $stmt->fetchAll();

    // جيب max_rooms من الباقة
    $stmt2 = $pdo->prepare("SELECT p.max_rooms FROM plans p JOIN clients c ON c.plan_id = p.id WHERE c.id = ?");
    $stmt2->execute([$client]);
    $maxRooms = (int)$stmt2->fetchColumn();

    jsonSuccess(['rooms' => $rooms, 'count' => count($rooms), 'max_rooms' => $maxRooms]);
}

// ================================================================
// POST - إضافة/تعديل/حذف (القديم - للتوافق مع أي كود تاني)
// ================================================================
if ($method === 'POST') {
    $user = requirePermission('rooms');
    $body = json_decode(file_get_contents('php://input'), true) ?? [];
    $action = $body['action'] ?? $_POST['action'] ?? '';

    switch ($action) {
        case 'create':
        case '':
            // لو مفيش action معناه POST مباشر من rooms.php
            $name    = trim($body['name'] ?? '');
            $type    = trim($body['device_type'] ?? '');
            $rate    = (float)($body['hourly_rate'] ?? 0);
            $grpRate = isset($body['group_hourly_rate']) && $body['group_hourly_rate'] !== ''
                       ? (float)$body['group_hourly_rate'] : null;
            $status  = $body['status'] ?? 'available';

            if (!$name || !$type) jsonError('اسم الغرفة ونوع الجهاز مطلوبان');

            // check max rooms
            $stmt = $pdo->prepare("SELECT COUNT(*) FROM rooms WHERE client_id = ? AND is_active = 1");
            $stmt->execute([$client]);
            $count = (int)$stmt->fetchColumn();

            $stmt2 = $pdo->prepare("SELECT p.max_rooms FROM plans p JOIN clients c ON c.plan_id = p.id WHERE c.id = ?");
            $stmt2->execute([$client]);
            $maxRooms = (int)$stmt2->fetchColumn();

            if ($maxRooms > 0 && $count >= $maxRooms) {
                jsonError("تم بلوغ الحد الأقصى ($maxRooms غرف) في باقتك الحالية");
            }

            $sortStmt = $pdo->prepare("SELECT COALESCE(MAX(sort_order), 0) + 1 FROM rooms WHERE client_id = ?");
            $sortStmt->execute([$client]);
            $sortOrder = (int)$sortStmt->fetchColumn();

            $stmt = $pdo->prepare("INSERT INTO rooms (client_id, name, device_type, hourly_rate, group_hourly_rate, status, sort_order) VALUES (?,?,?,?,?,?,?)");
            $stmt->execute([$client, $name, $type, $rate, $grpRate, $status, $sortOrder]);
            $newId = $pdo->lastInsertId();
            jsonSuccess(['id' => $newId, 'message' => 'تم إضافة الغرفة']);

        case 'update':
            $id      = (int)($body['id'] ?? 0);
            $name    = trim($body['name'] ?? '');
            $rate    = (float)($body['hourly_rate'] ?? 0);
            $grpRate = isset($body['group_hourly_rate']) ? (float)$body['group_hourly_rate'] : null;
            $type    = trim($body['device_type'] ?? '');
            $status  = $body['status'] ?? 'available';
            if (!$id) jsonError('id مطلوب');

            $stmt = $pdo->prepare("UPDATE rooms SET name=?, device_type=?, hourly_rate=?, group_hourly_rate=?, status=?, updated_at=NOW() WHERE id=? AND client_id=?");
            $stmt->execute([$name, $type, $rate, $grpRate, $status, $id, $client]);
            jsonSuccess(['message' => 'تم تعديل الغرفة']);

        case 'delete':
            $id = (int)($body['id'] ?? 0);
            if (!$id) jsonError('id مطلوب');
            $stmt = $pdo->prepare("SELECT COUNT(*) FROM sessions WHERE room_id=? AND status='active'");
            $stmt->execute([$id]);
            if ($stmt->fetchColumn() > 0) jsonError('لا يمكن حذف غرفة بها جلسة نشطة');
            $stmt = $pdo->prepare("UPDATE rooms SET is_active=0 WHERE id=? AND client_id=?");
            $stmt->execute([$id, $client]);
            jsonSuccess(['message' => 'تم حذف الغرفة']);

        case 'update_status':
            $id      = (int)($body['id'] ?? 0);
            $status  = $body['status'] ?? '';
            $allowed = ['available', 'occupied', 'maintenance', 'offline'];
            if (!$id || !in_array($status, $allowed)) jsonError('بيانات غير صحيحة');
            $stmt = $pdo->prepare("UPDATE rooms SET status=?, updated_at=NOW() WHERE id=? AND client_id=?");
            $stmt->execute([$status, $id, $client]);
            jsonSuccess(['message' => 'تم تحديث حالة الغرفة']);

        case 'get_available_rooms':
            $stmt = $pdo->prepare("
                SELECT r.*, dt.name_ar as device_type_name_ar, dt.name_en as device_type_name_en
                FROM rooms r
                LEFT JOIN device_types dt ON dt.slug = r.device_type AND dt.client_id = r.client_id
                WHERE r.client_id = ? AND r.status = 'available' AND r.is_active = 1
                ORDER BY r.name
            ");
            $stmt->execute([$client]);
            jsonSuccess(['rooms' => $stmt->fetchAll()]);

        default:
            jsonError('إجراء غير مدعوم', 400);
    }
}

// ================================================================
// PUT - تعديل غرفة (مستخدم من rooms.php الصفحة)
// ================================================================
if ($method === 'PUT') {
    $user = requirePermission('rooms');
    $id   = (int)($_GET['id'] ?? 0);
    if (!$id) jsonError('id مطلوب');

    $body    = json_decode(file_get_contents('php://input'), true) ?? [];
    $name    = trim($body['name'] ?? '');
    $type    = trim($body['device_type'] ?? '');
    $rate    = (float)($body['hourly_rate'] ?? 0);
    $grpRate = isset($body['group_hourly_rate']) && $body['group_hourly_rate'] !== ''
               ? (float)$body['group_hourly_rate'] : null;
    $status  = $body['status'] ?? 'available';

    if (!$name) jsonError('اسم الغرفة مطلوب');
    if (!in_array($status, ['available', 'occupied', 'maintenance', 'offline'])) {
        $status = 'available';
    }

    // تأكد إن الغرفة تبع نفس العميل
    $check = $pdo->prepare("SELECT id FROM rooms WHERE id = ? AND client_id = ?");
    $check->execute([$id, $client]);
    if (!$check->fetch()) jsonError('الغرفة غير موجودة', 404);

    $stmt = $pdo->prepare("
        UPDATE rooms 
        SET name=?, device_type=?, hourly_rate=?, group_hourly_rate=?, status=?, updated_at=NOW()
        WHERE id=? AND client_id=?
    ");
    $stmt->execute([$name, $type, $rate, $grpRate, $status, $id, $client]);
    jsonSuccess(['message' => 'تم تحديث الغرفة بنجاح']);
}

// ================================================================
// DELETE - حذف غرفة (مستخدم من rooms.php الصفحة)
// ================================================================
if ($method === 'DELETE') {
    $user = requirePermission('rooms');
    $id   = (int)($_GET['id'] ?? 0);
    if (!$id) jsonError('id مطلوب');

    // تأكد إن الغرفة تبع نفس العميل
    $check = $pdo->prepare("SELECT id FROM rooms WHERE id = ? AND client_id = ?");
    $check->execute([$id, $client]);
    if (!$check->fetch()) jsonError('الغرفة غير موجودة', 404);

    // تحقق مافيش جلسة نشطة
    $stmt = $pdo->prepare("SELECT COUNT(*) FROM sessions WHERE room_id = ? AND status = 'active'");
    $stmt->execute([$id]);
    if ((int)$stmt->fetchColumn() > 0) jsonError('لا يمكن حذف غرفة بها جلسة نشطة');

    // soft delete
    $stmt = $pdo->prepare("UPDATE rooms SET is_active=0, updated_at=NOW() WHERE id=? AND client_id=?");
    $stmt->execute([$id, $client]);
    jsonSuccess(['message' => 'تم حذف الغرفة بنجاح']);
}

// Method not allowed
http_response_code(405);
jsonError('Method not allowed', 405);