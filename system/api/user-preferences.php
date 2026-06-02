<?php
// api/user-preferences.php
require_once __DIR__ . '/../includes/auth_helper.php';
$user = requireAuth();
$pdo  = getDB();
$method = $_SERVER['REQUEST_METHOD'];

if ($method === 'GET') {
    $stmt = $pdo->prepare("SELECT dark_mode FROM user_preferences WHERE user_id=?");
    $stmt->execute([$user['id']]);
    $prefs = $stmt->fetch();
    jsonSuccess(['dark_mode' => $prefs ? (bool)$prefs['dark_mode'] : true]);
}

if ($method === 'POST') {
    $body    = json_decode(file_get_contents('php://input'), true) ?? [];
    $darkMode = isset($body['dark_mode']) ? (int)(bool)$body['dark_mode'] : 1;
    $stmt = $pdo->prepare("INSERT INTO user_preferences (user_id, dark_mode) VALUES (?,?) ON DUPLICATE KEY UPDATE dark_mode=?");
    $stmt->execute([$user['id'], $darkMode, $darkMode]);
    jsonSuccess(['message' => 'تم الحفظ']);
}
