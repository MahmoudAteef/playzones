<?php
// ================================================================
// includes/auth_helper.php
// ================================================================

require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../config/system.php';

function getCurrentUser(): ?array {
    if (!isset($_SESSION['user_id'])) return null;
    $pdo = getDB();
    $stmt = $pdo->prepare("SELECT u.*, c.currency_symbol, c.round_to_nearest_5, c.plan_id, c.is_active as client_active FROM users u JOIN clients c ON u.client_id = c.id WHERE u.id = ? AND u.is_active = 1");
    $stmt->execute([$_SESSION['user_id']]);
    return $stmt->fetch() ?: null;
}

function requireAuth(): array {
    $user = getCurrentUser();
    if (!$user) {
        jsonError('غير مصرح', 401);
    }
    return $user;
}

function requireAdmin(): array {
    $user = requireAuth();
    if ($user['role'] !== 'admin') {
        jsonError('غير مصرح لك بالوصول إلى هذا المورد', 403);
    }
    return $user;
}

function requirePermission(string $perm): array {
    $user = requireAuth();
    if ($user['role'] === 'admin') return $user;
    $key = 'perm_' . $perm;
    if (empty($user[$key])) {
        jsonError('غير مصرح لك بالوصول إلى هذا المورد', 403);
    }
    return $user;
}

function login(string $username, string $password): ?array {
    $pdo = getDB();
    $stmt = $pdo->prepare("SELECT u.*, c.is_active as client_active FROM users u JOIN clients c ON u.client_id = c.id WHERE u.username = ? AND u.is_active = 1 LIMIT 1");
    $stmt->execute([$username]);
    $user = $stmt->fetch();
    if (!$user) return null;
    if (!password_verify($password, $user['password'])) return null;
    $_SESSION['user_id']   = $user['id'];
    $_SESSION['client_id'] = $user['client_id'];
    $_SESSION['role']      = $user['role'];
    return $user;
}

function logout(): void {
    session_destroy();
}
