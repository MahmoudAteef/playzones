<?php
require_once __DIR__ . '/../includes/auth_helper.php';
$user   = requireAuth();
$client = (int)$user['client_id'];
$pdo    = getDB();
$method = $_SERVER['REQUEST_METHOD'];

if ($method === 'GET') {
    $stmt = $pdo->prepare("SELECT currency_symbol FROM clients WHERE id=?");
    $stmt->execute([$client]);
    $row = $stmt->fetch();
    jsonSuccess(['currency_symbol' => $row['currency_symbol'] ?? 'جنيه']);
}

if ($method === 'POST') {
    requireAdmin();
    $body   = json_decode(file_get_contents('php://input'), true) ?? [];
    $symbol = trim($body['currency_symbol'] ?? 'جنيه');
    if (!$symbol) jsonError('رمز العملة مطلوب');
    $pdo->prepare("UPDATE clients SET currency_symbol=? WHERE id=?")->execute([$symbol, $client]);
    jsonSuccess(['message' => 'تم الحفظ']);
}
