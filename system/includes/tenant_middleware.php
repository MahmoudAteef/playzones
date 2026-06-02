<?php
// includes/tenant_middleware.php
// يتضمن في أول كل صفحة محمية
require_once __DIR__ . '/../config/system.php';
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../includes/auth_helper.php';

$__user = getCurrentUser();
if (!$__user) {
    header('Location: login.php');
    exit;
}
// متاح في كل الصفحات
define('CURRENT_USER',      $__user);
define('CURRENT_CLIENT_ID', (int)$__user['client_id']);
define('CURRENT_ROLE',      $__user['role']);
define('IS_ADMIN',          $__user['role'] === 'admin');
