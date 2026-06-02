<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>PLAY ZONE - إدارة محل بلايستيشن</title>
  <link rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <style>
  * {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
  }

  body {
    font-family: 'Arial', sans-serif;
    background: linear-gradient(135deg, #1e3c72 0%, #2a5298 100%);
    height: 100vh;
    display: flex;
    justify-content: center;
    align-items: center;
    overflow: hidden;
    position: relative;
  }

  /* خلفية متحركة */
  .background-animation {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: linear-gradient(45deg, #1e3c72, #2a5298, #3b82f6, #1e40af);
    background-size: 400% 400%;
    animation: gradientShift 8s ease infinite;
    z-index: -1;
  }

  @keyframes gradientShift {
    0% {
      background-position: 0% 50%;
    }

    50% {
      background-position: 100% 50%;
    }

    100% {
      background-position: 0% 50%;
    }
  }

  /* طبقة إضافية للعمق */
  .overlay {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.1);
    z-index: 0;
  }

  .container {
    text-align: center;
    z-index: 1;
    position: relative;
    background: rgba(255, 255, 255, 0.1);
    backdrop-filter: blur(10px);
    border-radius: 20px;
    padding: 60px 40px;
    box-shadow: 0 20px 40px rgba(0, 0, 0, 0.3);
    border: 1px solid rgba(255, 255, 255, 0.2);
    max-width: 500px;
    width: 90%;
  }

  .logo {
    font-size: 4rem;
    font-weight: bold;
    color: #fff;
    text-shadow: 0 0 20px rgba(255, 255, 255, 0.8);
    margin-bottom: 30px;
    animation: glow 2s ease-in-out infinite alternate;
    letter-spacing: 3px;
  }

  @keyframes glow {
    from {
      text-shadow: 0 0 20px rgba(255, 255, 255, 0.8), 0 0 30px rgba(255, 255, 255, 0.6);
    }

    to {
      text-shadow: 0 0 30px rgba(255, 255, 255, 1), 0 0 40px rgba(255, 255, 255, 0.8), 0 0 50px rgba(255, 255, 255, 0.6);
    }
  }

  .welcome-text {
    color: #fff;
    font-size: 1.2rem;
    margin-bottom: 40px;
    opacity: 0.9;
    line-height: 1.6;
  }

  .enter-btn {
    background: linear-gradient(45deg, #ff6b6b, #ee5a24);
    color: white;
    border: none;
    padding: 15px 40px;
    font-size: 1.1rem;
    font-weight: bold;
    border-radius: 50px;
    cursor: pointer;
    transition: all 0.3s ease;
    box-shadow: 0 10px 20px rgba(0, 0, 0, 0.3);
    text-decoration: none;
    display: inline-block;
    position: relative;
    overflow: hidden;
  }

  .enter-btn:hover {
    transform: translateY(-3px);
    box-shadow: 0 15px 30px rgba(0, 0, 0, 0.4);
    background: linear-gradient(45deg, #ff5252, #d63031);
  }

  .enter-btn:active {
    transform: translateY(-1px);
  }

  .enter-btn::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
    transition: left 0.5s;
  }

  .enter-btn:hover::before {
    left: 100%;
  }

  .website-btn {
    position: absolute;
    top: 20px;
    left: 20px;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    border: none;
    padding: 12px 20px;
    border-radius: 10px;
    cursor: pointer;
    text-decoration: none;
    transition: all 0.3s ease;
    backdrop-filter: blur(5px);
    border: 1px solid rgba(255, 255, 255, 0.3);
    font-weight: 600;
    display: flex;
    align-items: center;
    gap: 8px;
    box-shadow: 0 4px 15px rgba(102, 126, 234, 0.4);
    z-index: 10;
  }

  .website-btn:hover {
    background: linear-gradient(135deg, #764ba2 0%, #667eea 100%);
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(102, 126, 234, 0.6);
  }

  .website-btn i {
    font-size: 16px;
  }

  /* تأثيرات إضافية */
  .floating-elements {
    position: absolute;
    width: 100%;
    height: 100%;
    overflow: hidden;
    z-index: -1;
  }

  .floating-element {
    position: absolute;
    background: rgba(255, 255, 255, 0.1);
    border-radius: 50%;
    animation: float 6s ease-in-out infinite;
  }

  .floating-element:nth-child(1) {
    width: 80px;
    height: 80px;
    top: 20%;
    left: 10%;
    animation-delay: 0s;
  }

  .floating-element:nth-child(2) {
    width: 120px;
    height: 120px;
    top: 60%;
    right: 15%;
    animation-delay: 2s;
  }

  .floating-element:nth-child(3) {
    width: 60px;
    height: 60px;
    bottom: 20%;
    left: 20%;
    animation-delay: 4s;
  }

  @keyframes float {

    0%,
    100% {
      transform: translateY(0px) rotate(0deg);
    }

    50% {
      transform: translateY(-20px) rotate(180deg);
    }
  }

  /* تأثير النبض للعنصر الرئيسي */
  .container {
    animation: pulse 4s ease-in-out infinite;
  }

  @keyframes pulse {

    0%,
    100% {
      transform: scale(1);
    }

    50% {
      transform: scale(1.02);
    }
  }

  /* تصميم متجاوب */
  @media (max-width: 768px) {
    .logo {
      font-size: 3rem;
    }

    .container {
      padding: 40px 20px;
      margin: 20px;
    }

    .welcome-text {
      font-size: 1rem;
    }
  }
  </style>
</head>

<body>
  <div class="background-animation"></div>
  <div class="overlay"></div>

  <a href="https://playzones.cloud/" class="website-btn">
    <i class="fas fa-globe"></i>
    الموقع الإلكتروني
  </a>

  <div class="floating-elements">
    <div class="floating-element"></div>
    <div class="floating-element"></div>
    <div class="floating-element"></div>
  </div>

  <div class="container">
    <h1 class="logo">PLAY ZONE</h1>
    <p class="welcome-text">
      مرحباً بك في نظام إدارة محل بلايستيشن<br>
      نظام متكامل لإدارة المبيعات والمخزون والعملاء
    </p>
    <a href="login.php" class="enter-btn">الدخول إلى النظام</a>
  </div>

  <script>
  // تأثير إضافي للتفاعل
  document.addEventListener('DOMContentLoaded', function() {
    const container = document.querySelector('.container');
    const logo = document.querySelector('.logo');

    // تأثير عند تحميل الصفحة
    container.style.opacity = '0';
    container.style.transform = 'translateY(50px)';

    setTimeout(() => {
      container.style.transition = 'all 1s ease';
      container.style.opacity = '1';
      container.style.transform = 'translateY(0)';
    }, 300);

    // تأثير عند التمرير فوق الشعار
    logo.addEventListener('mouseenter', function() {
      this.style.transform = 'scale(1.1)';
      this.style.transition = 'transform 0.3s ease';
    });

    logo.addEventListener('mouseleave', function() {
      this.style.transform = 'scale(1)';
    });
  });
  </script>

  <!-- نظام الإشعارات للجلسات المنتهية -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

  <!-- نظام طابور الإشعارات -->
  <script src="js/notification-queue.js?v=1779207315"></script>

  <!-- نظام مراقبة الجلسات المحدودة -->
  <script src="js/session-monitor.js?v=1771422103"></script>
</body>

</html>