<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description"
    content="the seystem good live ">
  <meta name="author"
    content="ENG.HOSSAM">
  <title>تجديد وترقية الاشتراك - Play Zone  </title>

  <!-- Fonts & Icons -->
  <link rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <link
    href="https://fonts.googleapis.com/css2?family=Cairo:wght@300;400;600;700&display=swap"
    rel="stylesheet">

  <!-- Tailwind CSS -->
  <script src="https://cdn.tailwindcss.com"></script>
  <script>
  (function() {
    try {
      var ls = window.localStorage;
      var val = ls ? ls.getItem('darkMode') : null;
      var shouldBeDark = (val === null) ?
        true : (val === 'true');
      if (shouldBeDark) {
        document.documentElement.style.backgroundColor = '#1a1a2e';
      }
      var applyToBody = function() {
        if (shouldBeDark) {
          document.body.classList.add('dark-mode');
        } else {
          document.body.classList.remove('dark-mode');
        }
      };
      if (document.body) {
        applyToBody();
      } else {
        document.addEventListener('DOMContentLoaded', applyToBody);
      }
    } catch (e) {
      document.documentElement.style.backgroundColor = '#1a1a2e';
      var fallback = function() {
        document.body.classList.add('dark-mode');
      };
      if (document.body) {
        fallback();
      } else {
        document.addEventListener('DOMContentLoaded', fallback);
      }
    }
  })();
  </script>

  <!-- Alpine.js -->
  <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>

  <style>
  * {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: 'Cairo', sans-serif;
  }

  body {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    min-height: 100vh;
    transition: background 0.3s ease;
  }

  body.dark-mode {
    background: linear-gradient(135deg, #1a1a2e 0%, #16213e 100%);
  }

  .container {
    max-width: 1400px;
    margin: 0 auto;
    padding: 20px;
  }

  /* Header Styles */
  .header {
    background: rgba(255, 255, 255, 0.95);
    backdrop-filter: blur(10px);
    border-radius: 15px;
    padding: 15px 25px;
    margin-bottom: 25px;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
    display: flex;
    justify-content: space-between;
    align-items: center;
    flex-wrap: wrap;
    gap: 15px;
  }

  body.dark-mode .header {
    background: rgba(30, 41, 59, 0.95);
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.3);
  }

  .logo {
    font-size: 2rem;
    font-weight: bold;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
    cursor: pointer;
    transition: transform 0.3s ease;
  }

  .logo:hover {
    transform: scale(1.05);
  }

  .header-actions {
    display: flex;
    align-items: center;
    gap: 12px;
    flex-wrap: wrap;
  }

  .dark-mode-toggle {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    border: none;
    width: 40px;
    height: 40px;
    border-radius: 50%;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: all 0.3s ease;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.2);
  }

  .dark-mode-toggle:hover {
    transform: scale(1.1);
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.3);
  }

  body.dark-mode .dark-mode-toggle {
    background: linear-gradient(135deg, #fbbf24 0%, #f59e0b 100%);
  }

  .back-btn {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    border: none;
    padding: 10px 20px;
    border-radius: 25px;
    cursor: pointer;
    display: none;
    align-items: center;
    gap: 8px;
    transition: all 0.3s ease;
    font-weight: 600;
    font-size: 0.95rem;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.2);
  }

  .back-btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(102, 126, 234, 0.4);
  }

  body.dark-mode .back-btn {
    background: linear-gradient(135deg, #4f46e5 0%, #7c3aed 100%);
  }

  /* Show back button only on large screens */
  @media (min-width: 1024px) {
    .back-btn {
      display: inline-flex;
    }
  }

  .user-menu {
    position: relative;
  }

  .user-btn {
    background: white;
    border: 2px solid #e5e7eb;
    padding: 8px 16px;
    border-radius: 25px;
    cursor: pointer;
    display: flex;
    align-items: center;
    gap: 8px;
    transition: all 0.3s ease;
    font-weight: 600;
    color: #374151;
  }

  body.dark-mode .user-btn {
    background: #1e293b;
    border-color: #334155;
    color: #e2e8f0;
  }

  .user-btn:hover {
    border-color: #667eea;
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(102, 126, 234, 0.2);
  }

  /* Main Content */
  .main-content {
    background: rgba(255, 255, 255, 0.95);
    backdrop-filter: blur(10px);
    border-radius: 15px;
    padding: 25px;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
    animation: fadeIn 0.5s ease;
  }

  body.dark-mode .main-content {
    background: rgba(30, 41, 59, 0.95);
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.3);
  }

  .page-title {
    font-size: 2rem;
    font-weight: bold;
    color: #1f2937;
    margin-bottom: 10px;
    display: flex;
    align-items: center;
    gap: 15px;
  }

  body.dark-mode .page-title {
    color: #f9fafb;
  }

  .page-subtitle {
    color: #6b7280;
    margin-bottom: 30px;
    font-size: 1rem;
  }

  body.dark-mode .page-subtitle {
    color: #9ca3af;
  }

  /* Current Subscription Card */
  .subscription-card {
    background: white;
    border-radius: 12px;
    padding: 25px;
    margin-bottom: 30px;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
    border: 2px solid #e5e7eb;
  }

  body.dark-mode .subscription-card {
    background: #1e293b;
    border-color: #334155;
  }

  .subscription-card.trial-notice {
    background: linear-gradient(135deg, rgba(168, 85, 247, 0.1) 0%, rgba(139, 92, 246, 0.05) 100%);
    border: 2px solid rgba(168, 85, 247, 0.3);
  }

  body.dark-mode .subscription-card.trial-notice {
    background: linear-gradient(135deg, rgba(168, 85, 247, 0.15) 0%, rgba(139, 92, 246, 0.1) 100%);
    border-color: rgba(168, 85, 247, 0.4);
  }

  .trial-text {
    color: #6b7280;
  }

  body.dark-mode .trial-text {
    color: #d1d5db;
  }

  .subscription-card-title {
    font-size: 1.5rem;
    font-weight: bold;
    color: #1f2937;
    margin-bottom: 20px;
    display: flex;
    align-items: center;
    gap: 10px;
  }

  body.dark-mode .subscription-card-title {
    color: #f9fafb;
  }

  .subscription-info {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 20px;
  }

  .info-item {
    display: flex;
    flex-direction: column;
    gap: 5px;
  }

  .info-label {
    font-size: 0.875rem;
    color: #6b7280;
    font-weight: 600;
  }

  body.dark-mode .info-label {
    color: #9ca3af;
  }

  .info-value {
    font-size: 1.125rem;
    color: #1f2937;
    font-weight: 700;
  }

  body.dark-mode .info-value {
    color: #f9fafb;
  }

  /* Plans Grid */
  .plans-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
    gap: 25px;
    margin-top: 30px;
  }

  /* Info Note */
  .info-note {
    display: flex;
    align-items: flex-start;
    gap: 14px;
    background: linear-gradient(135deg, rgba(99, 102, 241, .12) 0%, rgba(124, 58, 237, .12) 100%);
    border: 1px solid rgba(99, 102, 241, .35);
    padding: 16px 18px;
    border-radius: 14px;
    margin: 18px 0 8px 0;
    position: relative;
  }

  .info-note .icon {
    width: 40px;
    height: 40px;
    flex-shrink: 0;
    border-radius: 10px;
    background: linear-gradient(135deg, #6366f1 0%, #7c3aed 100%);
    color: #fff;
    display: flex;
    align-items: center;
    justify-content: center;
    box-shadow: 0 6px 18px rgba(99, 102, 241, .35);
  }

  .info-note .title {
    font-weight: 800;
    font-size: 1rem;
    color: #1f2937;
    margin-bottom: 4px;
  }

  .info-note .text {
    color: #374151;
    line-height: 1.9;
  }

  body.dark-mode .info-note {
    background: linear-gradient(135deg, rgba(99, 102, 241, .10) 0%, rgba(124, 58, 237, .10) 100%);
    border-color: rgba(255, 255, 255, .15);
  }

  body.dark-mode .info-note .title {
    color: #f8fafc;
  }

  body.dark-mode .info-note .text {
    color: #e2e8f0;
  }

  /* Close button for info note */
  .info-note-close {
    position: absolute;
    top: 8px;
    left: 8px;
    width: 32px;
    height: 32px;
    border-radius: 8px;
    background: rgba(239, 68, 68, 0.12);
    /* red-500 */
    color: #ef4444;
    border: 1px solid rgba(239, 68, 68, 0.45);
    display: inline-flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    transition: background .2s ease, transform .1s ease;
    z-index: 3;
  }

  .info-note-close:hover {
    background: rgba(239, 68, 68, 0.2);
  }

  .info-note-close:active {
    transform: scale(.96);
  }

  body.dark-mode .info-note-close {
    background: rgba(239, 68, 68, 0.15);
    color: #f87171;
    border-color: rgba(248, 113, 113, 0.45);
  }

  .plan-card {
    background: white;
    border-radius: 12px;
    padding: 30px;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
    border: 2px solid #e5e7eb;
    transition: all 0.3s ease;
    display: flex;
    flex-direction: column;
    position: relative;
    overflow: hidden;
  }

  body.dark-mode .plan-card {
    background: #1e293b;
    border-color: #334155;
  }

  .plan-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 25px rgba(102, 126, 234, 0.3);
    border-color: #667eea;
  }

  .plan-card.current {
    border-color: #10b981;
    background: linear-gradient(135deg, rgba(16, 185, 129, 0.1) 0%, rgba(5, 150, 105, 0.05) 100%);
  }

  body.dark-mode .plan-card.current {
    background: linear-gradient(135deg, rgba(16, 185, 129, 0.15) 0%, rgba(5, 150, 105, 0.1) 100%);
  }

  .current-badge {
    position: absolute;
    top: 15px;
    left: 15px;
    background: #10b981;
    color: white;
    padding: 5px 15px;
    border-radius: 20px;
    font-size: 0.75rem;
    font-weight: bold;
  }

  .popular-badge {
    position: absolute;
    top: 15px;
    left: 15px;
    background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
    color: white;
    padding: 6px 16px;
    border-radius: 20px;
    font-size: 0.8rem;
    font-weight: 700;
    box-shadow: 0 2px 12px rgba(245, 158, 11, 0.5);
    animation: popularPulse 2s ease-in-out infinite;
    z-index: 2;
  }

  @keyframes popularPulse {

    0%,
    100% {
      transform: scale(1);
      box-shadow: 0 2px 12px rgba(245, 158, 11, 0.5);
    }

    50% {
      transform: scale(1.05);
      box-shadow: 0 4px 20px rgba(245, 158, 11, 0.7);
    }
  }

  .plan-name {
    font-size: 1.75rem;
    font-weight: bold;
    color: #1f2937;
    margin-bottom: 15px;
  }

  body.dark-mode .plan-name {
    color: #f9fafb;
  }

  .plan-price {
    font-size: 2.5rem;
    font-weight: bold;
    color: #667eea;
    margin-bottom: 5px;
  }

  .plan-price-currency {
    font-size: 1.25rem;
    color: #6b7280;
  }

  body.dark-mode .plan-price-currency {
    color: #9ca3af;
  }

  .plan-duration {
    color: #6b7280;
    font-size: 0.875rem;
    margin-bottom: 25px;
  }

  body.dark-mode .plan-duration {
    color: #9ca3af;
  }

  .plan-features {
    list-style: none;
    margin-bottom: 25px;
    flex-grow: 1;
  }

  .plan-feature {
    padding: 10px 0;
    color: #374151;
    display: flex;
    align-items: center;
    gap: 10px;
    font-size: 0.95rem;
  }

  body.dark-mode .plan-feature {
    color: #e5e7eb;
  }

  .plan-feature i {
    color: #10b981;
    font-size: 1rem;
  }

  .plan-feature.highlight {
    padding: 12px;
    margin: 6px 0;
    border-radius: 12px;
    background: linear-gradient(135deg, rgba(253, 230, 138, 0.35), rgba(251, 191, 36, 0.2));
    border: 1px solid rgba(251, 191, 36, 0.45);
    box-shadow: 0 8px 18px rgba(251, 191, 36, 0.15);
    position: relative;
    color: #854d0e;
  }

  .plan-feature.highlight i {
    color: #f59e0b;
  }

  .plan-feature .highlight-badge {
    margin-inline-start: auto;
    font-size: 0.75rem;
    font-weight: 600;
    color: #92400e;
    background: rgba(251, 191, 36, 0.3);
    border: 1px solid rgba(245, 158, 11, 0.4);
    padding: 3px 8px;
    border-radius: 999px;
  }

  body.dark-mode .plan-feature.highlight {
    background: linear-gradient(135deg, rgba(120, 53, 15, 0.55), rgba(180, 83, 9, 0.35));
    border-color: rgba(253, 186, 116, 0.45);
    color: #fff7ed;
    box-shadow: 0 10px 24px rgba(180, 83, 9, 0.2);
  }

  body.dark-mode .plan-feature.highlight i {
    color: #fbbf24;
  }

  body.dark-mode .plan-feature .highlight-badge {
    color: #fff7ed;
    background: rgba(253, 186, 116, 0.35);
    border-color: rgba(249, 115, 22, 0.5);
  }

  .plan-btn {
    width: 100%;
    padding: 12px 20px;
    border-radius: 8px;
    font-weight: 600;
    font-size: 1rem;
    cursor: pointer;
    transition: all 0.3s ease;
    border: none;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
  }

  .plan-btn.upgrade {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
  }

  .plan-btn.upgrade:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(102, 126, 234, 0.4);
  }

  .plan-btn.renew {
    background: linear-gradient(135deg, #10b981 0%, #059669 100%);
    color: white;
  }

  .plan-btn.renew:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(16, 185, 129, 0.4);
  }

  .plan-btn:disabled {
    background: #e5e7eb;
    color: #9ca3af;
    cursor: not-allowed;
    transform: none;
  }

  body.dark-mode .plan-btn:disabled {
    background: #374151;
    color: #6b7280;
  }

  /* Animations */
  @keyframes fadeIn {
    from {
      opacity: 0;
      transform: translateY(20px);
    }

    to {
      opacity: 1;
      transform: translateY(0);
    }
  }

  .fade-in {
    animation: fadeIn 0.5s ease;
  }

  /* Loading Spinner */
  .spinner {
    border: 3px solid rgba(255, 255, 255, 0.3);
    border-top: 3px solid white;
    border-radius: 50%;
    width: 20px;
    height: 20px;
    animation: spin 0.8s linear infinite;
  }

  @keyframes spin {
    0% {
      transform: rotate(0deg);
    }

    100% {
      transform: rotate(360deg);
    }
  }

  /* Responsive */
  @media (max-width: 768px) {
    .container {
      padding: 15px;
    }

    .header {
      padding: 12px 15px;
    }

    .logo {
      font-size: 1.5rem;
    }

    .page-title {
      font-size: 1.5rem;
    }

    .plans-grid {
      grid-template-columns: 1fr;
    }

    /* Compact, safe styling for plan buttons on small screens */
    .plan-btn {
      font-size: .95rem;
      /* smaller text */
      padding: 12px 16px;
      /* modest side padding */
      white-space: nowrap;
      /* single line */
      overflow: hidden;
      /* prevent overflow */
      text-overflow: ellipsis;
      /* show ellipsis if needed */
    }

    .plan-btn i {
      font-size: 1rem;
    }

    /* Ensure info note stays readable */
    .info-note {
      padding: 12px 14px;
      padding-left: 52px;
    }

    .info-note .text {
      word-break: break-word;
    }

    .info-note-close {
      width: 28px;
      height: 28px;
      top: 6px;
      left: 6px;
    }

    .info-note .title {
      font-size: 1rem;
    }
  }
  </style>
</head>

<body class="dark-mode">
  
  <div class="container">
    <!-- Header -->
    <div class="header fade-in">
      <div class="logo" onclick="window.location.href='dashboard.php'">
        <i class="fas fa-credit-card"></i>
        Play Zone      </div>

      <div class="header-actions">
        <!-- Back Button (Desktop Only) -->
        <button class="back-btn" onclick="window.location.href='dashboard.php'"
          title="العودة للصفحة الرئيسية">
          <i class="fas fa-arrow-right"></i>
          <span>الصفحة الرئيسية</span>
        </button>

        <!-- Dark Mode Toggle -->
        <button class="dark-mode-toggle" onclick="toggleDarkMode()"
          title="تبديل الوضع الداكن/الساطع">
          <i id="dark-mode-icon"
            class="fas fa-sun"></i>
        </button>

        <!-- User Menu -->
        <div class="user-menu">
          <button class="user-btn" onclick="attemptLogout()">
            <i class="fas fa-user"></i>
            <span>admin_mahmoud_atef</span>
            <i class="fas fa-sign-out-alt"></i>
          </button>
        </div>
      </div>
    </div>

    <!-- Main Content -->
    <div class="main-content fade-in">

          <!-- ═══════════════ WhatsApp Simple-Subscription Card ═══════════════ -->
      <div style="display:flex;align-items:center;justify-content:center;min-height:60vh;padding:2rem 1rem;">
        <div style="
          background:#fff;
          border-radius:24px;
          box-shadow:0 20px 60px rgba(0,0,0,.12);
          max-width:480px;
          width:100%;
          overflow:hidden;
          text-align:center;
          font-family:'Cairo',sans-serif;
        ">

          <!-- Green header strip -->
          <div style="background:linear-gradient(135deg,#25d366 0%,#128c4e 100%);padding:2.5rem 2rem 2rem;">
            <div style="
              width:80px;height:80px;
              background:rgba(255,255,255,.2);
              border-radius:50%;
              margin:0 auto 1rem;
              display:flex;align-items:center;justify-content:center;
            ">
              <i class="fab fa-whatsapp" style="font-size:2.6rem;color:#fff;"></i>
            </div>
            <h2 style="color:#fff;font-size:1.4rem;font-weight:700;margin:0 0 .4rem;">تجديد الاشتراك</h2>
            <p style="color:rgba(255,255,255,.85);font-size:.9rem;margin:0;">
              لتجديد اشتراكك أو الترقية إلى خطة أفضل
            </p>
          </div>

          <!-- Body -->
          <div style="padding:2rem 2rem 2.5rem;">
            <p style="color:#4b5563;font-size:1rem;line-height:1.7;margin:0 0 1.6rem;">
              يسعدنا خدمتك!<br>
              تواصل معنا عبر <strong style="color:#128c4e;">واتساب</strong> لتجديد اشتراكك أو الاستفسار عن الباقات المتاحة.
            </p>

                                        <a href="https://wa.me/201080184668?text=%D9%85%D8%B1%D8%AD%D8%A8%D8%A7%D9%8B%D8%8C%20%D8%A3%D8%B1%D8%BA%D8%A8%20%D9%81%D9%8A%20%D8%AA%D8%AC%D8%AF%D9%8A%D8%AF%20%D8%A7%D8%B4%D8%AA%D8%B1%D8%A7%D9%83%D9%8A%20%D8%A3%D9%88%20%D8%A7%D9%84%D8%A7%D8%B3%D8%AA%D9%81%D8%B3%D8%A7%D8%B1%20%D8%B9%D9%86%20%D8%A7%D9%84%D8%A8%D8%A7%D9%82%D8%A7%D8%AA." target="_blank" rel="noopener noreferrer"
                style="
                  display:inline-flex;align-items:center;gap:.7rem;
                  background:linear-gradient(135deg,#25d366,#128c4e);
                  color:#fff;
                  text-decoration:none;
                  padding:.85rem 2rem;
                  border-radius:50px;
                  font-size:1.05rem;
                  font-weight:700;
                  box-shadow:0 4px 18px rgba(37,211,102,.4);
                  transition:transform .15s,box-shadow .15s;
                "
                onmouseover="this.style.transform='translateY(-2px)';this.style.boxShadow='0 8px 24px rgba(37,211,102,.5)'"
                onmouseout="this.style.transform='';this.style.boxShadow='0 4px 18px rgba(37,211,102,.4)'"
              >
                <i class="fab fa-whatsapp" style="font-size:1.3rem;"></i>
                تواصل عبر واتساب
              </a>
              <p style="color:#9ca3af;font-size:.78rem;margin:1rem 0 0;">
                اضغط على الزر للانتقال مباشرةً إلى المحادثة
              </p>
            
            <hr style="border:none;border-top:1px solid #f3f4f6;margin:1.8rem 0 1.4rem;">

            <a href="dashboard.php" style="color:#6b7280;font-size:.88rem;text-decoration:none;">
              <i class="fas fa-arrow-right ml-1"></i>
              العودة إلى الصفحة الرئيسية
            </a>
          </div>
        </div>
      </div>
      <!-- ════════════════════════════════════════════════════════════════ -->

    </div><!-- /main-content -->
  </div><!-- /container -->

    </body>

</html>