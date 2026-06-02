<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
<meta charset="UTF-8">
<title>تثبيت PlayZones</title>
<style>
*{margin:0;padding:0;box-sizing:border-box}
body{font-family:Arial,sans-serif;background:#0f172a;color:#e2e8f0;display:flex;justify-content:center;align-items:center;min-height:100vh;padding:20px}
.card{background:#1e293b;border-radius:16px;padding:32px;max-width:600px;width:100%;border:1px solid #334155}
h1{color:#38bdf8;font-size:24px;margin-bottom:8px}
p{color:#94a3b8;margin-bottom:24px;font-size:14px}
.step{padding:12px 16px;border-radius:8px;margin-bottom:8px;font-size:14px;display:flex;align-items:center;gap:10px}
.step.ok{background:rgba(34,197,94,0.1);border:1px solid rgba(34,197,94,0.3);color:#86efac}
.step.err{background:rgba(239,68,68,0.1);border:1px solid rgba(239,68,68,0.3);color:#fca5a5}
.step.info{background:rgba(59,130,246,0.1);border:1px solid rgba(59,130,246,0.3);color:#93c5fd}
.btn{display:block;width:100%;padding:14px;background:#3b82f6;color:#fff;border:none;border-radius:10px;font-size:16px;font-weight:bold;cursor:pointer;margin-top:20px;text-decoration:none;text-align:center}
.btn:hover{background:#2563eb}
label{display:block;color:#94a3b8;font-size:13px;margin-bottom:4px;margin-top:12px}
input{width:100%;padding:10px;background:#0f172a;border:1px solid #334155;border-radius:8px;color:#e2e8f0;font-size:14px}
input:focus{outline:none;border-color:#3b82f6}
</style>
</head>
<body>
<div class="card">
  <h1>🎮 تثبيت PlayZones</h1>
  <p>سيتم إنشاء قاعدة البيانات وإعداد النظام</p>

<?php
$installed = false;
$steps     = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $host   = $_POST['db_host']   ?? 'localhost';
    $name   = $_POST['db_name']   ?? 'playzones';
    $user   = $_POST['db_user']   ?? 'root';
    $pass   = $_POST['db_pass']   ?? '';
    $admin  = $_POST['admin_user'] ?? 'admin';
    $apass  = $_POST['admin_pass'] ?? '';

    // 1. اتصال بـ MySQL
    try {
        $pdo = new PDO("mysql:host=$host;charset=utf8mb4", $user, $pass, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
        $steps[] = ['ok', 'اتصال MySQL ناجح'];
    } catch (Exception $e) {
        $steps[] = ['err', 'فشل الاتصال: ' . $e->getMessage()];
        goto show_steps;
    }

    // 2. إنشاء قاعدة البيانات
    try {
        $pdo->exec("CREATE DATABASE IF NOT EXISTS `$name` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci");
        $pdo->exec("USE `$name`");
        $steps[] = ['ok', "تم إنشاء قاعدة البيانات: $name"];
    } catch (Exception $e) {
        $steps[] = ['err', 'فشل إنشاء DB: ' . $e->getMessage()];
        goto show_steps;
    }

    // 3. تنفيذ SQL
    $sqlFile = __DIR__ . '/database.sql';
    if (file_exists($sqlFile)) {
        try {
            $sql = file_get_contents($sqlFile);
            // نفّذ كل statement منفصل
            $pdo->exec("USE `$name`");
            foreach (array_filter(array_map('trim', explode(';', $sql))) as $stmt) {
                if ($stmt) $pdo->exec($stmt);
            }
            $steps[] = ['ok', 'تم تنفيذ ملف قاعدة البيانات'];
        } catch (Exception $e) {
            $steps[] = ['err', 'خطأ في SQL: ' . $e->getMessage()];
        }
    } else {
        $steps[] = ['err', 'ملف database.sql غير موجود'];
    }

    // 4. تحديث config
    $configContent = "<?php\ndefine('DB_HOST', '$host');\ndefine('DB_NAME', '$name');\ndefine('DB_USER', '$user');\ndefine('DB_PASS', '$pass');\ndefine('DB_CHARSET', 'utf8mb4');\n\nfunction getDB(): PDO {\n    static \$pdo = null;\n    if (\$pdo === null) {\n        try {\n            \$dsn = \"mysql:host=\" . DB_HOST . \";dbname=\" . DB_NAME . \";charset=\" . DB_CHARSET;\n            \$pdo = new PDO(\$dsn, DB_USER, DB_PASS, [\n                PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,\n                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,\n                PDO::ATTR_EMULATE_PREPARES   => false,\n            ]);\n        } catch (PDOException \$e) {\n            http_response_code(500);\n            die(json_encode(['success' => false, 'message' => 'Database connection failed']));\n        }\n    }\n    return \$pdo;\n}\n";
    file_put_contents(__DIR__ . '/config/database.php', $configContent);
    $steps[] = ['ok', 'تم تحديث config/database.php'];

    // 5. إنشاء admin جديد
    if ($admin && $apass) {
        try {
            $hash = password_hash($apass, PASSWORD_DEFAULT);
            $stmt = $pdo->prepare("UPDATE users SET username=?, password=? WHERE id=1");
            $stmt->execute([$admin, $hash]);
            $steps[] = ['ok', "تم إنشاء المدير: $admin"];
        } catch (Exception $e) {
            $steps[] = ['err', 'خطأ في إنشاء المدير: ' . $e->getMessage()];
        }
    }

    $installed = true;
    show_steps:
}
?>

<?php if (!empty($steps)): ?>
  <?php foreach ($steps as [$type, $msg]): ?>
    <div class="step <?= $type ?>">
      <?= $type === 'ok' ? '✅' : ($type === 'err' ? '❌' : 'ℹ️') ?>
      <?= htmlspecialchars($msg) ?>
    </div>
  <?php endforeach; ?>

  <?php if ($installed && !in_array('err', array_column($steps, 0))): ?>
    <div class="step ok">🎉 التثبيت مكتمل! يمكنك الآن تسجيل الدخول</div>
    <a href="system/login.php" class="btn">الذهاب لصفحة تسجيل الدخول</a>
    <p style="margin-top:12px;color:#ef4444;font-size:12px;">⚠️ احذف ملف setup.php بعد التثبيت</p>
  <?php endif; ?>

<?php else: ?>

<form method="POST">
  <label>MySQL Host</label>
  <input name="db_host" value="localhost">
  <label>اسم قاعدة البيانات</label>
  <input name="db_name" value="playzones">
  <label>اسم المستخدم MySQL</label>
  <input name="db_user" value="root">
  <label>كلمة مرور MySQL</label>
  <input name="db_pass" type="password" placeholder="اتركه فارغاً لو Laragon">
  <hr style="border-color:#334155;margin:20px 0">
  <label>اسم مستخدم المدير</label>
  <input name="admin_user" value="admin">
  <label>كلمة مرور المدير</label>
  <input name="admin_pass" type="password" placeholder="اختر كلمة مرور قوية">
  <button type="submit" class="btn">🚀 بدء التثبيت</button>
</form>

<?php endif; ?>
</div>
</body>
</html>
