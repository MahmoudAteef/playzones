<?php
require_once __DIR__ . '/../includes/auth_helper.php';

$user   = requireAuth();
$client = (int)$user['client_id'];
$pdo    = getDB();

$body   = json_decode(file_get_contents('php://input'), true) ?? [];
$action = $body['action'] ?? $_GET['action'] ?? '';

switch ($action) {

    case 'list':
    case 'get_employees':
        $stmt = $pdo->prepare("SELECT id, username, full_name, role, is_active, created_at FROM users WHERE client_id = ? ORDER BY role DESC, full_name");
        $stmt->execute([$client]);
        jsonSuccess(['employees' => $stmt->fetchAll()]);

    case 'get':
        $id = (int)($body['employee_id'] ?? $_GET['employee_id'] ?? 0);
        if (!$id) jsonError('id مطلوب');
        $stmt = $pdo->prepare("SELECT id, username, full_name, role, is_active, perm_sessions, perm_orders, perm_customers, perm_reports, perm_employees, perm_rooms, perm_shifts, perm_settings, perm_discount, max_discount_value, discount_uses_per_day FROM users WHERE id=? AND client_id=?");
        $stmt->execute([$id, $client]);
        $emp = $stmt->fetch();
        if (!$emp) jsonError('الموظف غير موجود', 404);
        jsonSuccess(['employee' => $emp]);

    case 'create':
        requireAdmin();
        $username  = trim($body['username'] ?? '');
        $password  = $body['password'] ?? '';
        $fullName  = trim($body['full_name'] ?? '');
        if (!$username || !$password) jsonError('اسم المستخدم وكلمة المرور مطلوبان');

        // تحقق من التكرار
        $stmt = $pdo->prepare("SELECT COUNT(*) FROM users WHERE client_id=? AND username=?");
        $stmt->execute([$client, $username]);
        if ($stmt->fetchColumn() > 0) jsonError('اسم المستخدم موجود بالفعل');

        // check max employees
        $stmt2 = $pdo->prepare("SELECT COUNT(*) FROM users WHERE client_id=? AND role='employee' AND is_active=1");
        $stmt2->execute([$client]);
        $empCount = (int)$stmt2->fetchColumn();
        $stmt3 = $pdo->prepare("SELECT p.max_employees FROM plans p JOIN clients c ON c.plan_id=p.id WHERE c.id=?");
        $stmt3->execute([$client]);
        $maxEmp = (int)$stmt3->fetchColumn();
        if ($empCount >= $maxEmp) jsonError("وصلت للحد الأقصى ($maxEmp موظفين) في باقتك");

        $hash = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $pdo->prepare("INSERT INTO users (client_id, username, password, full_name, role) VALUES (?,?,?,?,'employee')");
        $stmt->execute([$client, $username, $hash, $fullName]);
        jsonSuccess(['id' => $pdo->lastInsertId(), 'message' => 'تم إضافة الموظف']);

    case 'update_employee_profile':
        $id       = (int)($body['employee_id'] ?? 0);
        $fullName = trim($body['full_name'] ?? '');
        if (!$id) jsonError('id مطلوب');
        if ($user['role'] !== 'admin' && $user['id'] !== $id) jsonError('غير مصرح', 403);
        $stmt = $pdo->prepare("UPDATE users SET full_name=?, updated_at=NOW() WHERE id=? AND client_id=?");
        $stmt->execute([$fullName, $id, $client]);
        jsonSuccess(['message' => 'تم التعديل']);

    case 'update_employee_password':
        $id      = (int)($body['employee_id'] ?? 0);
        $newPass = $body['new_password'] ?? '';
        if (!$id || !$newPass) jsonError('بيانات غير صحيحة');
        if ($user['role'] !== 'admin' && $user['id'] !== $id) jsonError('غير مصرح', 403);
        $hash = password_hash($newPass, PASSWORD_DEFAULT);
        $stmt = $pdo->prepare("UPDATE users SET password=?, updated_at=NOW() WHERE id=? AND client_id=?");
        $stmt->execute([$hash, $id, $client]);
        jsonSuccess(['message' => 'تم تغيير كلمة المرور']);

    case 'toggle_employee_status':
        requireAdmin();
        $id = (int)($body['employee_id'] ?? 0);
        if (!$id) jsonError('id مطلوب');
        $stmt = $pdo->prepare("UPDATE users SET is_active = 1 - is_active, updated_at=NOW() WHERE id=? AND client_id=? AND role='employee'");
        $stmt->execute([$id, $client]);
        jsonSuccess(['message' => 'تم تحديث حالة الموظف']);

    case 'delete_employee':
        requireAdmin();
        $id = (int)($body['employee_id'] ?? 0);
        if (!$id) jsonError('id مطلوب');
        $stmt = $pdo->prepare("UPDATE users SET is_active=0, updated_at=NOW() WHERE id=? AND client_id=? AND role='employee'");
        $stmt->execute([$id, $client]);
        jsonSuccess(['message' => 'تم حذف الموظف']);

    case 'update_permissions':
        requireAdmin();
        $id = (int)($body['employee_id'] ?? 0);
        if (!$id) jsonError('id مطلوب');
        $perms = [
            'perm_sessions'          => (int)!empty($body['perm_sessions']),
            'perm_orders'            => (int)!empty($body['perm_orders']),
            'perm_customers'         => (int)!empty($body['perm_customers']),
            'perm_reports'           => (int)!empty($body['perm_reports']),
            'perm_employees'         => (int)!empty($body['perm_employees']),
            'perm_rooms'             => (int)!empty($body['perm_rooms']),
            'perm_shifts'            => (int)!empty($body['perm_shifts']),
            'perm_settings'          => (int)!empty($body['perm_settings']),
            'perm_discount'          => (int)!empty($body['perm_discount']),
            'max_discount_value'     => isset($body['max_discount_value']) ? (float)$body['max_discount_value'] : null,
            'discount_uses_per_day'  => isset($body['discount_uses_per_day']) ? (int)$body['discount_uses_per_day'] : null,
        ];
        $set = implode(', ', array_map(fn($k) => "$k=?", array_keys($perms)));
        $stmt = $pdo->prepare("UPDATE users SET $set, updated_at=NOW() WHERE id=? AND client_id=?");
        $stmt->execute([...array_values($perms), $id, $client]);
        jsonSuccess(['message' => 'تم تحديث الصلاحيات']);

    default:
        jsonError('إجراء غير معروف');
}
