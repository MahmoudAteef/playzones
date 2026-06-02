<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>صيانة الدراعات - Play Zone</title>
  <link rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <style>
  body {
    margin: 0;
    min-height: 100vh;
    background: radial-gradient(circle at top, #0f172a 0%, #020617 70%);
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #e2e8f0;
  }

  .card {
    width: min(90%, 420px);
    background: linear-gradient(160deg, rgba(20, 184, 166, 0.92) 0%, rgba(59, 130, 246, 0.95) 40%, rgba(168, 85, 247, 0.95) 100%);
    padding: 1px;
    border-radius: 28px;
    box-shadow: 0 25px 60px rgba(15, 23, 42, 0.45);
  }

  .card-inner {
    background: rgba(5, 10, 25, 0.9);
    border-radius: 26px;
    padding: 32px 26px;
    backdrop-filter: blur(14px);
  }

  .icon {
    width: 80px;
    height: 80px;
    border-radius: 24px;
    background: linear-gradient(145deg, rgba(255, 255, 255, 0.15), rgba(148, 163, 184, 0.05));
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 20px;
    color: #f8fafc;
    font-size: 36px;
  }

  h1 {
    font-size: 22px;
    font-weight: 800;
    text-align: center;
    margin-bottom: 16px;
    color: #f1f5f9;
    letter-spacing: 0.5px;
  }

  p {
    font-size: 14px;
    text-align: center;
    line-height: 1.8;
    margin: 0;
    color: #cbd5f5;
  }

  p span {
    color: #95ff8d;
    font-weight: 700;
  }

  .actions {
    display: flex;
    flex-direction: column;
    gap: 12px;
    margin-top: 28px;
  }

  .btn {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 10px;
    font-size: 13px;
    font-weight: 600;
    padding: 12px 18px;
    border-radius: 18px;
    border: 1px solid rgba(148, 163, 184, 0.25);
    color: #e2e8f0;
    background: rgba(15, 23, 42, 0.65);
    text-decoration: none;
    transition: all 0.25s ease;
  }

  .btn:hover {
    background: rgba(15, 23, 42, 0.8);
    border-color: rgba(148, 163, 184, 0.45);
  }

  .btn.primary {
    background: rgba(148, 255, 141, 0.15);
    border-color: rgba(148, 255, 141, 0.5);
    color: #f8fafc;
  }

  .btn.primary:hover {
    background: rgba(148, 255, 141, 0.25);
    border-color: rgba(148, 255, 141, 0.7);
  }
  </style>
</head>

<body>
  <div class="card">
    <div class="card-inner">
      <div class="icon">
        <i class="fa-solid fa-desktop"></i>
      </div>
      <h1>هذه الصفحة متاحة على الكمبيوتر فقط</h1>
      <p>يجب فتح سيستم <span>Play Zone</span> على جهاز كمبيوتر لكي تتمكن من
        إجراء الفحص والاختبار
        بطريقة سليمة واحترافية.</p>
      <div class="actions">
        <a class="btn primary" href="dashboard.php">
          <i class="fa-solid fa-gauge"></i>
          العودة إلى لوحة التحكم
        </a>
        <button class="btn" type="button"
          onclick="if(window.history.length > 1){ history.back(); } else { window.location.href='dashboard.php'; }">
          <i class="fa-solid fa-arrow-rotate-left"></i>
          الرجوع للصفحة السابقة
        </button>
      </div>
    </div>
  </div>
</body>

</html>
