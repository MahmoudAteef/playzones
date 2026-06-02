<?php
require_once __DIR__ . '/../config/system.php';
$ms = round(microtime(true) * 1000);
jsonSuccess([
    'server_time' => $ms,
    'server_date' => date('Y-m-d H:i:s'),
    'timezone'    => 'UTC',
    'timestamp'   => time(),
]);
