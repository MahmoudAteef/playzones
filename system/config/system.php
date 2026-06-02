<?php
// ================================================================
// config/system.php
// ================================================================

define('APP_NAME', 'Play Zone');
define('APP_URL', 'http://localhost');
define('APP_VERSION', '2.0.0');
define('SESSION_LIFETIME', 86400 * 30); // 30 يوم

// ابدأ السيشن
if (session_status() === PHP_SESSION_NONE) {
    session_set_cookie_params([
        'lifetime' => SESSION_LIFETIME,
        'path'     => '/',
        'secure'   => false,
        'httponly' => true,
        'samesite' => 'Lax',
    ]);
    session_start();
}

// CORS للـ API
header('X-Content-Type-Options: nosniff');

// دالة مساعدة للرد
function jsonResponse(array $data, int $code = 200): void {
    http_response_code($code);
    echo json_encode($data, JSON_UNESCAPED_UNICODE);
    exit;
}

function jsonSuccess(array $data = [], string $message = ''): void {
    $res = ['success' => true];
    if ($message) $res['message'] = $message;
    jsonResponse(array_merge($res, $data));
}

function jsonError(string $message, int $code = 400, array $extra = []): void {
    jsonResponse(array_merge(['success' => false, 'message' => $message], $extra), $code);
}
