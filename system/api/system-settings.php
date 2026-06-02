<?php
require_once __DIR__ . '/../includes/auth_helper.php';
$user   = requireAdmin();
$client = (int)$user['client_id'];
$pdo    = getDB();
$method = $_SERVER['REQUEST_METHOD'];
$body   = json_decode(file_get_contents('php://input'), true) ?? [];
$action = $body['action'] ?? $_GET['action'] ?? 'get';

function getSetting(PDO $pdo, int $client, string $key, $default = null) {
    $stmt = $pdo->prepare("SELECT setting_value FROM system_settings WHERE client_id=? AND setting_key=?");
    $stmt->execute([$client, $key]);
    $row = $stmt->fetch();
    return $row ? $row['setting_value'] : $default;
}

function setSetting(PDO $pdo, int $client, string $key, $value): void {
    $stmt = $pdo->prepare("INSERT INTO system_settings (client_id, setting_key, setting_value) VALUES (?,?,?) ON DUPLICATE KEY UPDATE setting_value=?");
    $stmt->execute([$client, $key, $value, $value]);
}

switch ($action) {
    case 'get':
        $stmt = $pdo->prepare("SELECT setting_key, setting_value FROM system_settings WHERE client_id=?");
        $stmt->execute([$client]);
        $settings = [];
        foreach ($stmt->fetchAll() as $row) {
            $settings[$row['setting_key']] = $row['setting_value'];
        }
        // إعدادات العميل
        $clientStmt = $pdo->prepare("SELECT name, currency_symbol, round_to_nearest_5 FROM clients WHERE id=?");
        $clientStmt->execute([$client]);
        $clientData = $clientStmt->fetch();
        jsonSuccess(array_merge($settings, $clientData ?: []));

    case 'update':
        $allowed = ['shop_name','phone','address','receipt_note','footer_text'];
        foreach ($allowed as $key) {
            if (isset($body[$key])) {
                setSetting($pdo, $client, $key, $body[$key]);
            }
        }
        // تحديث اسم المحل في جدول clients
        if (isset($body['shop_name'])) {
            $pdo->prepare("UPDATE clients SET name=? WHERE id=?")->execute([$body['shop_name'], $client]);
        }
        jsonSuccess(['message' => 'تم حفظ الإعدادات']);

    default:
        jsonError('إجراء غير معروف');
}
