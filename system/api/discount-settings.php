<?php
require_once __DIR__ . '/../includes/auth_helper.php';

$user   = requireAuth();
$client = (int)$user['client_id'];
$pdo    = getDB();

$body   = json_decode(file_get_contents('php://input'), true) ?? [];
$action = $body['action'] ?? $_GET['action'] ?? 'get';
$method = $_SERVER['REQUEST_METHOD'];

// GET - إعدادات الخصم
if ($method === 'GET' || $action === 'get') {
    $stmt = $pdo->prepare("SELECT * FROM discount_settings WHERE client_id=?");
    $stmt->execute([$client]);
    $settings = $stmt->fetch();
    if (!$settings) {
        $settings = ['discount_enabled' => 0, 'discount_type' => 'percentage', 'discount_scope' => 'both'];
    }
    jsonSuccess([
        'discount_enabled' => (bool)$settings['discount_enabled'],
        'discount_type'    => $settings['discount_type'],
        'discount_scope'   => $settings['discount_scope'],
    ]);
}

// POST - تحديث
if ($method === 'POST') {
    requireAdmin();
    $enabled = !empty($body['discount_enabled']) ? 1 : 0;
    $type    = in_array($body['discount_type'] ?? '', ['percentage','fixed']) ? $body['discount_type'] : 'percentage';
    $scope   = in_array($body['discount_scope'] ?? '', ['sessions','orders','both']) ? $body['discount_scope'] : 'both';

    $stmt = $pdo->prepare("INSERT INTO discount_settings (client_id, discount_enabled, discount_type, discount_scope)
        VALUES (?,?,?,?) ON DUPLICATE KEY UPDATE discount_enabled=?, discount_type=?, discount_scope=?");
    $stmt->execute([$client, $enabled, $type, $scope, $enabled, $type, $scope]);
    jsonSuccess(['message' => 'تم حفظ إعدادات الخصم']);
}
