
<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>حسابك غير نشط - SENSE</title>
  <style>
    html { zoom: 0.9; }
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body {
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
      min-height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
      color: #333;
    }

    .error-container {
      background: white;
      border-radius: 20px;
      padding: 3rem;
      text-align: center;
      box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
      max-width: 500px;
      width: 90%;
      animation: slideUp 0.8s ease-out;
    }

    .error-icon {
      font-size: 4rem;
      margin-bottom: 1.5rem;
      animation: bounce 2s infinite;
    }

    .error-title {
      font-size: 2.5rem;
      font-weight: bold;
      margin-bottom: 1rem;
      color: #f39c12;
    }

    .error-message {
      font-size: 1.1rem;
      line-height: 1.6;
      margin-bottom: 2rem;
      color: #666;
    }

    .error-actions {
      display: flex;
      gap: 1rem;
      justify-content: center;
      flex-wrap: wrap;
    }

    .btn {
      padding: 12px 24px;
      border: none;
      border-radius: 10px;
      font-size: 1rem;
      font-weight: bold;
      cursor: pointer;
      text-decoration: none;
      display: inline-block;
      transition: all 0.3s ease;
      min-width: 120px;
    }

    .btn-primary {
      background: linear-gradient(135deg, #3498db, #2980b9);
      color: white;
    }

    .btn-secondary {
      background: linear-gradient(135deg, #95a5a6, #7f8c8d);
      color: white;
    }

    .btn:hover {
      transform: translateY(-2px);
      box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
    }


    @keyframes slideUp {
      from {
        opacity: 0;
        transform: translateY(50px);
      }

      to {
        opacity: 1;
        transform: translateY(0);
      }
    }

    @keyframes bounce {

      0%,
      20%,
      50%,
      80%,
      100% {
        transform: translateY(0);
      }

      40% {
        transform: translateY(-10px);
      }

      60% {
        transform: translateY(-5px);
      }
    }

    @media (max-width: 640px) {
      .error-container {
        padding: 2rem;
        margin: 1rem;
      }

      .error-title {
        font-size: 2rem;
      }

      .error-icon {
        font-size: 3rem;
      }

      .error-actions {
        flex-direction: column;
      }

      .btn {
        width: 100%;
      }
    }
  </style>
</head>

<body>
  <div class="error-container">
    <div class="error-icon">⏸️</div>
    <h1 class="error-title">حسابك غير نشط</h1>
    <p class="error-message">عذراً، حسابك غير نشط حالياً. يرجى التواصل مع الإدارة لتفعيل حسابك.</p>

    <div class="error-actions">
              <a href="login.php" class="btn btn-primary">تسجيل الدخول</a>
        <a href="dashboard.php" class="btn btn-secondary">الصفحة الرئيسية</a>
          </div>

    
  </div>

  <script>
    // تأثير عند تحميل الصفحة
    document.addEventListener('DOMContentLoaded', function() {
      const container = document.querySelector('.error-container');
      container.style.opacity = '0';
      container.style.transform = 'translateY(30px)';

      setTimeout(() => {
        container.style.transition = 'all 0.8s ease';
        container.style.opacity = '1';
        container.style.transform = 'translateY(0)';
      }, 100);
    });
  </script>
</body>

</html>