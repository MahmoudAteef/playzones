<?php
require_once __DIR__ . '/config/system.php';
require_once __DIR__ . '/config/database.php';
require_once __DIR__ . '/includes/auth_helper.php';

// لو مسجل دخول خليه يروح dashboard
if (isset($_SESSION['user_id'])) {
    header('Location: dashboard.php');
    exit;
}

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';

    if (!$username || !$password) {
        $error = 'يرجى إدخال اسم المستخدم وكلمة المرور';
    } else {
        $user = login($username, $password);
        if ($user) {
            // تذكرني
            if (!empty($_POST['remember_me'])) {
                session_set_cookie_params(['lifetime' => 86400 * 30]);
            }
            header('Location: dashboard.php');
            exit;
        } else {
            $error = 'اسم المستخدم أو كلمة المرور غير صحيحة';
        }
    }
}
?>
<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>تسجيل الدخول - PLAY ZONE</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <style>
  * { margin:0; padding:0; box-sizing:border-box; }
  body { font-family:'Arial',sans-serif; background:linear-gradient(135deg,#1e3c72 0%,#2a5298 100%); height:100vh; display:flex; justify-content:center; align-items:center; overflow:hidden; position:relative; }
  .background-animation { position:absolute; top:0; left:0; width:100%; height:100%; background:linear-gradient(45deg,#1e3c72,#2a5298,#3b82f6,#1e40af); background-size:400% 400%; animation:gradientShift 8s ease infinite; z-index:-1; }
  @keyframes gradientShift { 0%{background-position:0% 50%} 50%{background-position:100% 50%} 100%{background-position:0% 50%} }
  .overlay { position:absolute; top:0; left:0; width:100%; height:100%; background:rgba(0,0,0,0.1); z-index:0; }
  .login-container { background:rgba(255,255,255,0.1); backdrop-filter:blur(10px); border-radius:20px; padding:40px; box-shadow:0 20px 40px rgba(0,0,0,0.3); border:1px solid rgba(255,255,255,0.2); width:100%; max-width:400px; z-index:1; position:relative; }
  .logo { text-align:center; margin-bottom:30px; }
  .logo h1 { color:#fff; font-size:2.5rem; font-weight:bold; text-shadow:0 0 20px rgba(255,255,255,0.8); animation:glow 2s ease-in-out infinite alternate; }
  @keyframes glow { from{text-shadow:0 0 20px rgba(255,255,255,0.8)} to{text-shadow:0 0 30px rgba(255,255,255,1),0 0 40px rgba(255,255,255,0.8)} }
  .form-group { margin-bottom:20px; }
  .form-group label { display:block; color:#fff; margin-bottom:8px; font-weight:bold; }
  .form-group input[type=text], .form-group input[type=password] { width:100%; padding:12px 15px; border:none; border-radius:10px; background:rgba(255,255,255,0.9); font-size:16px; transition:all .3s ease; }
  .form-group input:focus { outline:none; background:rgba(255,255,255,1); box-shadow:0 0 20px rgba(255,255,255,0.5); }
  .login-btn { width:100%; background:linear-gradient(45deg,#ff6b6b,#ee5a24); color:white; border:none; padding:15px; font-size:16px; font-weight:bold; border-radius:10px; cursor:pointer; transition:all .3s ease; margin-top:10px; }
  .login-btn:hover { transform:translateY(-2px); box-shadow:0 10px 20px rgba(0,0,0,0.3); }
  .error-message { background:rgba(255,0,0,0.2); color:#ff6b6b; padding:10px; border-radius:10px; margin-bottom:20px; text-align:center; border:1px solid rgba(255,0,0,0.3); }
  .back-btn { position:absolute; top:20px; right:20px; background:rgba(255,255,255,0.2); color:white; border:none; padding:10px 15px; border-radius:10px; cursor:pointer; text-decoration:none; transition:all .3s ease; backdrop-filter:blur(5px); border:1px solid rgba(255,255,255,0.3); }
  .back-btn:hover { background:rgba(255,255,255,0.3); transform:translateY(-2px); }
  @media(max-width:768px){.login-container{margin:20px;padding:30px 20px;}}
  </style>
</head>
<body>
  <div class="background-animation"></div>
  <div class="overlay"></div>
  <a href="index.php" class="back-btn">← العودة للرئيسية</a>

  <div class="login-container">
    <div class="logo"><h1>PLAY ZONE</h1></div>

    <?php if ($error): ?>
      <div class="error-message"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>

    <form method="POST" action="">
      <div class="form-group">
        <label for="username">اسم المستخدم:</label>
        <input type="text" id="username" name="username" required value="<?= htmlspecialchars($_POST['username'] ?? '') ?>">
      </div>
      <div class="form-group">
        <label for="password">كلمة المرور:</label>
        <input type="password" id="password" name="password" required>
      </div>
      <div class="form-group" style="display:flex;align-items:center;gap:8px;">
        <input type="checkbox" id="remember_me" name="remember_me" value="1" style="width:auto;height:auto;cursor:pointer;">
        <label for="remember_me" style="margin:0;cursor:pointer;font-size:14px;">تذكرني</label>
      </div>
      <button type="submit" class="login-btn">تسجيل الدخول</button>
    </form>
  </div>

  <script>
  document.addEventListener('DOMContentLoaded', function() {
    const container = document.querySelector('.login-container');
    container.style.opacity = '0';
    container.style.transform = 'translateY(30px)';
    setTimeout(() => {
      container.style.transition = 'all 0.8s ease';
      container.style.opacity = '1';
      container.style.transform = 'translateY(0)';
    }, 200);
  });
  </script>
</body>
</html>
