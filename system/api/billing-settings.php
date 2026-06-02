<?php
require_once __DIR__ . '/../includes/auth_helper.php';
$user   = requireAuth();
$client = (int)$user['client_id'];
$pdo    = getDB();
$method = $_SERVER['REQUEST_METHOD'];

if ($method === 'GET') {
    $stmt = $pdo->prepare("SELECT round_to_nearest_5 FROM clients WHERE id=?");
    $stmt->execute([$client]);
    $row = $stmt->fetch();
    jsonSuccess(['round_to_nearest_5' => (int)($row['round_to_nearest_5'] ?? 0)]);
}

if ($method === 'POST') {
    requireAdmin();
    $body  = json_decode(file_get_contents('php://input'), true) ?? [];
    $round = !empty($body['round_to_nearest_5']) ? 1 : 0;
    $pdo->prepare("UPDATE clients SET round_to_nearest_5=? WHERE id=?")->execute([$round, $client]);
    jsonSuccess(['message' => 'تم الحفظ']);
}
