<?php
require_once __DIR__ . '/../includes/auth_helper.php';

$user   = requireAuth();
$client = (int)$user['client_id'];
$pdo    = getDB();

$body   = json_decode(file_get_contents('php://input'), true) ?? [];
$action = $body['action'] ?? $_GET['action'] ?? '';

switch ($action) {

    case 'employee_active_shift':
        $stmt = $pdo->prepare("SELECT * FROM shifts WHERE user_id=? AND client_id=? AND status='active' ORDER BY id DESC LIMIT 1");
        $stmt->execute([$user['id'], $client]);
        $shift = $stmt->fetch();
        jsonSuccess(['shift' => $shift ?: null, 'has_active' => (bool)$shift]);

    case 'start_shift':
        // تأكد مافيش شيفت نشط
        $stmt = $pdo->prepare("SELECT COUNT(*) FROM shifts WHERE user_id=? AND client_id=? AND status='active'");
        $stmt->execute([$user['id'], $client]);
        if ($stmt->fetchColumn() > 0) jsonError('عندك شيفت نشط بالفعل');

        $openingCash = (float)($body['opening_cash'] ?? 0);
        $stmt = $pdo->prepare("INSERT INTO shifts (client_id, user_id, start_time, opening_cash) VALUES (?,?,NOW(),?)");
        $stmt->execute([$client, $user['id'], $openingCash]);
        jsonSuccess(['shift_id' => $pdo->lastInsertId(), 'message' => 'تم بدء الشيفت']);

    case 'end_shift':
        $shiftId     = (int)($body['shift_id'] ?? 0);
        $closingCash = (float)($body['closing_cash'] ?? 0);
        $notes       = $body['notes'] ?? '';

        $stmt = $pdo->prepare("SELECT * FROM shifts WHERE id=? AND client_id=? AND user_id=? AND status='active'");
        $stmt->execute([$shiftId, $client, $user['id']]);
        $shift = $stmt->fetch();
        if (!$shift) jsonError('الشيفت غير موجود');

        // احسب إجمالي المبيعات في الشيفت
        $stmt2 = $pdo->prepare("SELECT COUNT(*), COALESCE(SUM(total_amount),0) FROM sessions WHERE client_id=? AND user_id=? AND status='ended' AND start_time >= ?");
        $stmt2->execute([$client, $user['id'], $shift['start_time']]);
        [$totalSessions, $totalSales] = $stmt2->fetch(PDO::FETCH_NUM);

        $stmt = $pdo->prepare("UPDATE shifts SET status='ended', end_time=NOW(), closing_cash=?, total_sessions=?, total_sales=?, notes=? WHERE id=?");
        $stmt->execute([$closingCash, $totalSessions, $totalSales, $notes, $shiftId]);
        jsonSuccess(['message' => 'تم إنهاء الشيفت', 'total_sales' => $totalSales, 'total_sessions' => $totalSessions]);

    case 'update_stats':
        // تحديث إحصائيات الشيفت النشط
        $stmt = $pdo->prepare("SELECT * FROM shifts WHERE user_id=? AND client_id=? AND status='active' ORDER BY id DESC LIMIT 1");
        $stmt->execute([$user['id'], $client]);
        $shift = $stmt->fetch();
        if (!$shift) jsonSuccess(['message' => 'لا يوجد شيفت نشط']);

        $stmt2 = $pdo->prepare("SELECT COUNT(*), COALESCE(SUM(total_amount),0) FROM sessions WHERE client_id=? AND user_id=? AND status='ended' AND start_time >= ?");
        $stmt2->execute([$client, $user['id'], $shift['start_time']]);
        [$totalSessions, $totalSales] = $stmt2->fetch(PDO::FETCH_NUM);

        $pdo->prepare("UPDATE shifts SET total_sessions=?, total_sales=? WHERE id=?")->execute([$totalSessions, $totalSales, $shift['id']]);
        jsonSuccess(['total_sessions' => $totalSessions, 'total_sales' => $totalSales]);

    case 'list_employees_shifts':
        requirePermission('shifts');
        $page  = max(1, (int)($body['page'] ?? 1));
        $limit = 20;
        $offset = ($page - 1) * $limit;
        $stmt = $pdo->prepare("
            SELECT sh.*, u.full_name, u.username
            FROM shifts sh JOIN users u ON u.id = sh.user_id
            WHERE sh.client_id = ?
            ORDER BY sh.created_at DESC
            LIMIT $limit OFFSET $offset
        ");
        $stmt->execute([$client]);
        $shifts = $stmt->fetchAll();

        $countStmt = $pdo->prepare("SELECT COUNT(*) FROM shifts WHERE client_id=?");
        $countStmt->execute([$client]);
        jsonSuccess(['shifts' => $shifts, 'total' => (int)$countStmt->fetchColumn(), 'page' => $page]);

    default:
        jsonError('إجراء غير صالح');
}
