<?php
require_once __DIR__ . '/../includes/auth_helper.php';

$user   = requireAuth();
$client = (int)$user['client_id'];
$pdo    = getDB();
$method = $_SERVER['REQUEST_METHOD'];

// GET actions
if ($method === 'GET') {
    $action = $_GET['action'] ?? '';
    if ($action === 'get_limited_sessions') {
        $stmt = $pdo->prepare("
            SELECT s.*, r.name as room_name
            FROM sessions s
            JOIN rooms r ON r.id = s.room_id
            WHERE s.client_id = ? AND s.status = 'active' AND s.is_limited = 1
        ");
        $stmt->execute([$client]);
        jsonSuccess(['data' => $stmt->fetchAll()]);
    }
    jsonError('إجراء غير معروف');
}

// POST actions
$body   = json_decode(file_get_contents('php://input'), true) ?? [];
$action = $body['action'] ?? '';

switch ($action) {

    // ================================================================
    // بدء جلسة جديدة
    // ================================================================
    case 'start_session':
        $roomId     = (int)($body['room_id'] ?? 0);
        $type       = $body['session_type'] ?? 'single'; // single / group
        $isLimited  = !empty($body['is_limited']);
        $minutes    = isset($body['limited_minutes']) ? (int)$body['limited_minutes'] : null;
        $customerId = isset($body['customer_id']) ? (int)$body['customer_id'] : null;

        if (!$roomId) jsonError('الغرفة مطلوبة');

        // تأكد الغرفة متاحة
        $stmt = $pdo->prepare("SELECT * FROM rooms WHERE id=? AND client_id=? AND status='available' AND is_active=1");
        $stmt->execute([$roomId, $client]);
        $room = $stmt->fetch();
        if (!$room) jsonError('الغرفة غير متاحة');

        $now        = new DateTime();
        $endTime    = null;
        $endMs      = null;

        if ($isLimited && $minutes) {
            $endDt   = clone $now;
            $endDt->modify("+{$minutes} minutes");
            $endTime = $endDt->format('Y-m-d H:i:s');
            $endMs   = $endDt->getTimestamp() * 1000;
        }

        $rate = ($type === 'group' && $room['group_hourly_rate']) ? $room['group_hourly_rate'] : $room['hourly_rate'];

        $stmt = $pdo->prepare("
            INSERT INTO sessions (client_id, room_id, user_id, customer_id, type, is_limited,
                limited_minutes, limited_end_time, limited_end_ms, status, start_time)
            VALUES (?,?,?,?,?,?,?,?,?,'active',NOW())
        ");
        $stmt->execute([$client, $roomId, $user['id'], $customerId, $type, $isLimited ? 1 : 0, $minutes, $endTime, $endMs]);
        $sessionId = $pdo->lastInsertId();

        // غيّر حالة الغرفة
        $pdo->prepare("UPDATE rooms SET status='occupied', updated_at=NOW() WHERE id=?")->execute([$roomId]);

        jsonSuccess(['session_id' => $sessionId, 'message' => 'تم بدء الجلسة']);

    // ================================================================
    // معاينة إنهاء الجلسة (حساب المبلغ)
    // ================================================================
    case 'preview_end_session':
        $sessionId = (int)($body['session_id'] ?? 0);
        if (!$sessionId) jsonError('بيانات غير صحيحة', 200);

        $stmt = $pdo->prepare("
            SELECT s.*, r.hourly_rate, r.group_hourly_rate, r.name as room_name
            FROM sessions s JOIN rooms r ON r.id=s.room_id
            WHERE s.id=? AND s.client_id=? AND s.status='active'
        ");
        $stmt->execute([$sessionId, $client]);
        $session = $stmt->fetch();
        if (!$session) jsonError('الجلسة غير موجودة أو منتهية');

        $start    = new DateTime($session['start_time']);
        $end      = new DateTime();
        $diffSecs = $end->getTimestamp() - $start->getTimestamp();
        $diffMins = max(1, ceil($diffSecs / 60));

        $rate     = ($session['type'] === 'group' && $session['group_hourly_rate'])
                    ? (float)$session['group_hourly_rate']
                    : (float)$session['hourly_rate'];

        $baseAmount = ($diffMins / 60) * $rate;

        // حساب الطلبات
        $stmt2 = $pdo->prepare("SELECT COALESCE(SUM(total_price),0) FROM orders WHERE session_id=? AND status != 'cancelled'");
        $stmt2->execute([$sessionId]);
        $ordersAmount = (float)$stmt2->fetchColumn();

        $total = $baseAmount + $ordersAmount;

        // تقريب لأقرب 5 لو مفعّل
        $stmt3 = $pdo->prepare("SELECT round_to_nearest_5 FROM clients WHERE id=?");
        $stmt3->execute([$client]);
        $roundTo5 = (bool)$stmt3->fetchColumn();
        if ($roundTo5) {
            $total = round($total / 5) * 5;
        }

        jsonSuccess([
            'session'       => $session,
            'duration_mins' => $diffMins,
            'base_amount'   => round($baseAmount, 2),
            'orders_amount' => round($ordersAmount, 2),
            'total_amount'  => round($total, 2),
            'rate'          => $rate,
        ]);

    // ================================================================
    // إنهاء الجلسة نهائياً
    // ================================================================
    case 'finalize_end_session':
        $sessionId     = (int)($body['session_id'] ?? 0);
        $paymentMethod = $body['payment_method'] ?? 'cash';
        $discountAmt   = (float)($body['discount_amount'] ?? 0);

        if (!$sessionId) jsonError('بيانات غير صحيحة', 200);

        $stmt = $pdo->prepare("
            SELECT s.*, r.hourly_rate, r.group_hourly_rate, r.name as room_name
            FROM sessions s JOIN rooms r ON r.id=s.room_id
            WHERE s.id=? AND s.client_id=? AND s.status='active'
        ");
        $stmt->execute([$sessionId, $client]);
        $session = $stmt->fetch();
        if (!$session) jsonError('الجلسة غير موجودة');

        $start    = new DateTime($session['start_time']);
        $end      = new DateTime();
        $diffSecs = $end->getTimestamp() - $start->getTimestamp();
        $diffMins = max(1, ceil($diffSecs / 60));

        $rate        = ($session['type'] === 'group' && $session['group_hourly_rate'])
                       ? (float)$session['group_hourly_rate']
                       : (float)$session['hourly_rate'];
        $baseAmount  = ($diffMins / 60) * $rate;

        $stmt2 = $pdo->prepare("SELECT COALESCE(SUM(total_price),0) FROM orders WHERE session_id=? AND status != 'cancelled'");
        $stmt2->execute([$sessionId]);
        $ordersAmount = (float)$stmt2->fetchColumn();

        $total = $baseAmount + $ordersAmount - $discountAmt;
        $stmt3 = $pdo->prepare("SELECT round_to_nearest_5 FROM clients WHERE id=?");
        $stmt3->execute([$client]);
        if ((bool)$stmt3->fetchColumn()) {
            $total = round($total / 5) * 5;
        }
        $total = max(0, $total);

        // حدّث الجلسة
        $stmt = $pdo->prepare("
            UPDATE sessions SET status='ended', end_time=NOW(), duration_minutes=?,
            base_amount=?, discount_amount=?, orders_amount=?, total_amount=?, payment_method=?, updated_at=NOW()
            WHERE id=?
        ");
        $stmt->execute([$diffMins, round($baseAmount,2), $discountAmt, round($ordersAmount,2), round($total,2), $paymentMethod, $sessionId]);

        // أرجع الغرفة لـ available
        $pdo->prepare("UPDATE rooms SET status='available', updated_at=NOW() WHERE id=?")->execute([$session['room_id']]);

        // تحديث إحصائيات العميل لو موجود
        if ($session['customer_id']) {
            $pdo->prepare("UPDATE customers SET total_sessions=total_sessions+1, total_spent=total_spent+?, last_visit=NOW() WHERE id=?")->execute([round($total,2), $session['customer_id']]);
        }

        jsonSuccess(['total_amount' => round($total,2), 'message' => 'تم إنهاء الجلسة']);

    // ================================================================
    // إيقاف مؤقت / استئناف
    // ================================================================
    case 'pause_session':
        $sessionId = (int)($body['session_id'] ?? 0);
        $stmt = $pdo->prepare("SELECT * FROM sessions WHERE id=? AND client_id=? AND status='active' AND is_limited=1");
        $stmt->execute([$sessionId, $client]);
        $session = $stmt->fetch();
        if (!$session) jsonError('الجلسة غير موجودة');

        $now   = time() * 1000;
        $remaining = max(0, (int)$session['limited_end_ms'] - $now);
        $pdo->prepare("UPDATE sessions SET is_paused=1, paused_at=NOW(), paused_remaining_ms=? WHERE id=?")->execute([$remaining, $sessionId]);
        jsonSuccess(['message' => 'تم إيقاف الجلسة مؤقتاً']);

    case 'resume_session_after_preview':
        $sessionId = (int)($body['session_id'] ?? 0);
        $stmt = $pdo->prepare("SELECT * FROM sessions WHERE id=? AND client_id=? AND status='active' AND is_paused=1");
        $stmt->execute([$sessionId, $client]);
        $session = $stmt->fetch();
        if (!$session) jsonError('الجلسة غير موجودة');

        $newEndMs   = round(microtime(true) * 1000) + (int)$session['paused_remaining_ms'];
        $newEndTime = date('Y-m-d H:i:s', intval($newEndMs / 1000));
        $pdo->prepare("UPDATE sessions SET is_paused=0, paused_at=NULL, paused_remaining_ms=NULL, limited_end_ms=?, limited_end_time=? WHERE id=?")->execute([$newEndMs, $newEndTime, $sessionId]);
        jsonSuccess(['message' => 'تم استئناف الجلسة', 'limited_end_ms' => $newEndMs]);

    // ================================================================
    // نقل الجلسة لغرفة أخرى
    // ================================================================
    case 'transfer_to_room':
        $sessionId  = (int)($body['session_id'] ?? 0);
        $newRoomId  = (int)($body['new_room_id'] ?? 0);
        if (!$sessionId || !$newRoomId) jsonError('بيانات غير صحيحة');

        $stmt = $pdo->prepare("SELECT * FROM sessions WHERE id=? AND client_id=? AND status='active'");
        $stmt->execute([$sessionId, $client]);
        $session = $stmt->fetch();
        if (!$session) jsonError('الجلسة غير موجودة');

        $stmt2 = $pdo->prepare("SELECT * FROM rooms WHERE id=? AND client_id=? AND status='available'");
        $stmt2->execute([$newRoomId, $client]);
        if (!$stmt2->fetch()) jsonError('الغرفة المطلوبة غير متاحة');

        $pdo->prepare("UPDATE rooms SET status='available', updated_at=NOW() WHERE id=?")->execute([$session['room_id']]);
        $pdo->prepare("UPDATE rooms SET status='occupied', updated_at=NOW() WHERE id=?")->execute([$newRoomId]);
        $pdo->prepare("UPDATE sessions SET room_id=?, updated_at=NOW() WHERE id=?")->execute([$newRoomId, $sessionId]);

        jsonSuccess(['message' => 'تم نقل الجلسة']);

    // ================================================================
    // التعديل على الجلسة (manipulation)
    // ================================================================
    case 'manipulation':
        $sessionId = (int)($body['session_id'] ?? 0);
        $subAction = $body['sub_action'] ?? '';
        $stmt = $pdo->prepare("SELECT * FROM sessions WHERE id=? AND client_id=? AND status='active'");
        $stmt->execute([$sessionId, $client]);
        $session = $stmt->fetch();
        if (!$session) jsonError('الجلسة غير موجودة');

        if ($subAction === 'extend_time') {
            $addMins = (int)($body['minutes'] ?? 0);
            if ($addMins <= 0) jsonError('الدقائق غير صحيحة');
            if (!$session['is_limited']) jsonError('الجلسة غير محدودة الوقت');
            $newEndMs   = (int)$session['limited_end_ms'] + ($addMins * 60 * 1000);
            $newEndTime = date('Y-m-d H:i:s', intval($newEndMs / 1000));
            $pdo->prepare("UPDATE sessions SET limited_end_ms=?, limited_end_time=? WHERE id=?")->execute([$newEndMs, $newEndTime, $sessionId]);
            jsonSuccess(['message' => "تم تمديد الجلسة بـ {$addMins} دقيقة"]);
        }
        jsonError('إجراء فرعي غير معروف');

    default:
        jsonError('بيانات غير صحيحة', 200);
}
