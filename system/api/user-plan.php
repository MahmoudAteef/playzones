<?php
require_once __DIR__ . '/../includes/auth_helper.php';
$user   = requireAuth();
$client = (int)$user['client_id'];
$pdo    = getDB();

$stmt = $pdo->prepare("
    SELECT p.*, c.plan_expires_at
    FROM plans p
    JOIN clients c ON c.plan_id = p.id
    WHERE c.id = ?
");
$stmt->execute([$client]);
$plan = $stmt->fetch();
if (!$plan) jsonError('الباقة غير موجودة', 404);

$isPro = (bool)$plan['manage_employees'];
jsonSuccess([
    'plan'            => $plan['slug'],
    'plan_name'       => $plan['name_ar'],
    'plan_id'         => (int)$plan['id'],
    'is_professional' => $isPro,
    'expires_at'      => $plan['plan_expires_at'],
    'features'        => [
        'print_receipt'           => (bool)$plan['print_receipt'],
        'manage_customers'        => (bool)$plan['manage_customers'],
        'export_customers'        => (bool)$plan['export_customers'],
        'manage_orders'           => (bool)$plan['manage_orders'],
        'manage_food'             => (bool)$plan['manage_food'],
        'manage_shifts'           => (bool)$plan['manage_shifts'],
        'export_shifts'           => (bool)$plan['export_shifts'],
        'reports'                 => (bool)$plan['reports'],
        'export_detailed'         => (bool)$plan['export_detailed'],
        'manage_employees'        => (bool)$plan['manage_employees'],
        'pwa_install'             => (bool)$plan['pwa_install'],
        'controller_maintenance'  => (bool)$plan['controller_maintenance'],
        'client_settings'         => (bool)$plan['client_settings'],
        'sms_invoices_enabled'    => (bool)$plan['sms_invoices_enabled'],
        'email_reports_enabled'   => (bool)$plan['email_reports_enabled'],
    ],
    'limits' => [
        'max_rooms'     => (int)$plan['max_rooms'],
        'max_employees' => (int)$plan['max_employees'],
    ],
]);
