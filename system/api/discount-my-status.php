<?php
require_once __DIR__ . '/../includes/auth_helper.php';

$user   = requireAuth();
$client = (int)$user['client_id'];
$pdo    = getDB();

// إعدادات الخصم العامة
$stmt = $pdo->prepare("SELECT * FROM discount_settings WHERE client_id=?");
$stmt->execute([$client]);
$settings = $stmt->fetch();
$globalEnabled = $settings ? (bool)$settings['discount_enabled'] : false;

// صلاحيات المستخدم
if ($user['role'] === 'admin') {
    jsonSuccess([
        'discount_enabled' => $globalEnabled,
        'can_discount'     => true,
        'max_value'        => null,
        'uses_left'        => null,
        'max_uses'         => null,
        'discount_period'  => 'day',
    ]);
}

$canDiscount = $globalEnabled && (bool)$user['perm_discount'];
$maxValue    = $user['max_discount_value'];
$maxUses     = $user['discount_uses_per_day'];

// احسب الاستخدامات اليوم
$usesLeft = null;
if ($maxUses !== null) {
    $stmt2 = $pdo->prepare("SELECT COUNT(*) FROM sessions WHERE user_id=? AND client_id=? AND discount_amount > 0 AND DATE(end_time) = CURDATE()");
    $stmt2->execute([$user['id'], $client]);
    $usedToday = (int)$stmt2->fetchColumn();
    $usesLeft  = max(0, $maxUses - $usedToday);
}

jsonSuccess([
    'discount_enabled' => $globalEnabled,
    'can_discount'     => $canDiscount,
    'max_value'        => $maxValue,
    'uses_left'        => $usesLeft,
    'max_uses'         => $maxUses,
    'discount_period'  => 'day',
]);
