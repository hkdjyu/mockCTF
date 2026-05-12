<!DOCTYPE html>
<html lang="zh-HK">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Web-32 甚麼是PNG</title>
  <style>
    :root {
      --bg-primary: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
      --bg-secondary: white;
      --text-primary: #333;
      --text-secondary: #555;
      --text-tertiary: #666;
      --accent-color: #667eea;
      --accent-dark: #764ba2;
      --accent-light: #ffecd2;
      --accent-border: #ff9f43;
      --border-color: #e9ecef;
      --shadow-color: rgba(0, 0, 0, 0.08);
      --hero-shadow: rgba(102, 126, 234, 0.3);
      --code-bg: #f0f4ff;
      --code-color: #764ba2;
      --image-bg: #f8f9fa;
      --highlight-from: #ffecd2;
      --highlight-to: #fcb69f;
    }

    body.dark-mode {
      --bg-primary: linear-gradient(135deg, #1a1a2e 0%, #16213e 100%);
      --bg-secondary: #0f3460;
      --text-primary: #e0e0e0;
      --text-secondary: #b0b0b0;
      --text-tertiary: #909090;
      --accent-color: #8fa3ff;
      --accent-dark: #9d84d9;
      --accent-light: #3a2d4a;
      --accent-border: #ff6b35;
      --border-color: #2a3f5f;
      --shadow-color: rgba(0, 0, 0, 0.3);
      --hero-shadow: rgba(139, 163, 255, 0.3);
      --code-bg: #1a2f5a;
      --code-color: #a9d5ff;
      --image-bg: #1e2d42;
      --highlight-from: #3a2d4a;
      --highlight-to: #3d2820;
    }

    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body {
      font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', 'Microsoft YaHei', sans-serif;
      line-height: 1.6;
      color: var(--text-primary);
      background: var(--bg-primary);
      min-height: 100vh;
      padding: 20px;
      transition: background 0.3s ease, color 0.3s ease;
    }

    .container {
      max-width: 1000px;
      margin: 0 auto;
    }

    /* Theme Toggle Button */
    .theme-toggle {
      position: fixed;
      top: 20px;
      right: 20px;
      background: var(--accent-color);
      color: white;
      border: none;
      border-radius: 50%;
      width: 50px;
      height: 50px;
      font-size: 24px;
      cursor: pointer;
      display: flex;
      align-items: center;
      justify-content: center;
      box-shadow: 0 4px 15px var(--hero-shadow);
      transition: all 0.3s ease;
      z-index: 1000;
    }

    .theme-toggle:hover {
      transform: scale(1.1);
      box-shadow: 0 6px 20px var(--hero-shadow);
    }

    .theme-toggle:active {
      transform: scale(0.95);
    }

    /* Hero Section */
    .hero {
      background: linear-gradient(135deg, var(--accent-color) 0%, var(--accent-dark) 100%);
      color: white;
      padding: 60px 40px;
      border-radius: 16px;
      margin-bottom: 40px;
      box-shadow: 0 10px 40px var(--hero-shadow);
      text-align: center;
      transition: box-shadow 0.3s ease;
    }

    .hero h1 {
      font-size: 3em;
      font-weight: 700;
      margin-bottom: 15px;
      text-shadow: 2px 2px 4px rgba(0,0,0,0.2);
    }

    .hero p {
      font-size: 1.1em;
      opacity: 0.95;
      max-width: 600px;
      margin: 0 auto;
    }

    /* Content Section */
    .content {
      background: var(--bg-secondary);
      border-radius: 12px;
      padding: 40px;
      margin-bottom: 30px;
      box-shadow: 0 4px 20px var(--shadow-color);
      transition: background 0.3s ease, box-shadow 0.3s ease;
    }

    .content h2 {
      color: var(--accent-color);
      font-size: 1.8em;
      margin-bottom: 20px;
      padding-bottom: 15px;
      border-bottom: 3px solid var(--accent-color);
      transition: color 0.3s ease;
    }

    .content p {
      margin-bottom: 20px;
      font-size: 1.05em;
      line-height: 1.8;
      color: var(--text-secondary);
      transition: color 0.3s ease;
    }

    .content code {
      background: var(--code-bg);
      color: var(--code-color);
      padding: 4px 8px;
      border-radius: 4px;
      font-family: 'Courier New', monospace;
      font-weight: 500;
      transition: background 0.3s ease, color 0.3s ease;
    }

    /* Images Section */
    .images-container {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 30px;
      margin: 40px 0;
    }

    .image-card {
      background: var(--image-bg);
      border-radius: 12px;
      padding: 20px;
      text-align: center;
      transition: all 0.3s ease;
      border: 2px solid var(--border-color);
    }

    .image-card:hover {
      transform: translateY(-5px);
      box-shadow: 0 8px 25px var(--hero-shadow);
      border-color: var(--accent-color);
    }

    .image-card h3 {
      color: var(--accent-color);
      margin-bottom: 15px;
      font-size: 1.3em;
      transition: color 0.3s ease;
    }

    .image-card img {
      max-width: 100%;
      height: auto;
      border-radius: 8px;
      margin-bottom: 15px;
      background: var(--bg-secondary);
      padding: 10px;
      border: 1px solid var(--border-color);
      transition: background 0.3s ease, border-color 0.3s ease;
    }

    .image-card p {
      font-size: 0.95em;
      color: var(--text-tertiary);
      margin: 0;
      transition: color 0.3s ease;
    }

    /* Highlight Box */
    .highlight-box {
      background: linear-gradient(135deg, var(--highlight-from) 0%, var(--highlight-to) 100%);
      border-left: 5px solid var(--accent-border);
      padding: 20px;
      border-radius: 8px;
      margin: 30px 0;
      transition: all 0.3s ease;
    }

    .highlight-box p {
      margin: 0;
      color: var(--text-primary);
      font-weight: 500;
      transition: color 0.3s ease;
    }

    /* Responsive */
    @media (max-width: 768px) {
      .theme-toggle {
        width: 45px;
        height: 45px;
        font-size: 20px;
        top: 15px;
        right: 15px;
      }

      .hero {
        padding: 40px 20px;
      }

      .hero h1 {
        font-size: 2em;
      }

      .content {
        padding: 20px;
      }

      .images-container {
        grid-template-columns: 1fr;
        gap: 20px;
      }

      .hero p {
        font-size: 1em;
      }
    }

    /* Footer note */
    .footer-note {
      text-align: center;
      color: var(--text-tertiary);
      font-size: 0.95em;
      margin-top: 40px;
      padding: 20px;
      background: var(--bg-secondary);
      border-radius: 12px;
      box-shadow: 0 2px 10px var(--shadow-color);
      transition: background 0.3s ease, color 0.3s ease;
    }

    .footer-note p {
      margin: 0;
    }

    .footer-note strong {
      color: var(--accent-color);
      transition: color 0.3s ease;
    }
  </style>
</head>
<body>
  <!-- Theme Toggle Button -->
  <button id="themeToggle" class="theme-toggle" title="切換深色/淺色模式">🌙</button>

  <div class="container">
    <!-- Hero Section -->
    <div class="hero">
      <h1>🖼️ 甚麼是PNG</h1>
      <p>探索可攜式網路圖形格式的奧祕</p>
    </div>

    <!-- Main Content -->
    <div class="content">
      <h2>PNG 格式介紹</h2>
      <p>
        PNG 的全名為可攜式網路圖形 (Portable Network Graphic)，是一種點陣影像檔案。因為 PNG 檔案類型能夠處理有透明或半透明背景的圖形，因此特別受到網頁設計師的喜愛。此檔案格式未申請專利，因此可使用任何影像編輯軟體開啟與編輯 PNG 檔案，而無需取得授權。PNG 檔案的副檔名是 <code>.png</code>，可處理 1,600 萬種色彩，「勢必」 能從眾多競爭者中脫穎而出。
      </p>

      <!-- Images Section -->
      <h2 style="margin-top: 50px;">PNG 圖片對比</h2>
      <p>
        這裡有兩張 PNG 圖片，分別是 <code>PNG.png</code> 和 <code>fake.png</code>。其中一個檔案是真正的 PNG 圖片，而另一個則是偽裝成 PNG 的檔案。
      </p>

      <div class="images-container">
        <div class="image-card">
          <h3>📄 PNG.png</h3>
          <img src="./files/PNG.png" alt="真的png圖片">
          <p>真正的 PNG 圖片</p>
        </div>
        <div class="image-card">
          <h3>❓ fake.png</h3>
          <img src="./files/fake.png" alt="假的png圖片">
          <p>偽裝成 PNG 的檔案</p>
        </div>
      </div>

      <!-- Highlight Box -->
      <div class="highlight-box">
        <p>💡 <strong>提示：</strong>網絡上搜尋 PNG 圖片時，有時候會見到背景是灰色白色形成的棋盤格，這是因為 PNG 圖片的透明背景在某些瀏覽器或圖片查看器中會以這種方式顯示。</p>
      </div>

      <p>
        不過，有一些棋盤格圖案的 PNG 圖片的背景並不是真的透明，而是被設計成看起來像透明的棋盤格。這些圖片可能會用於測試或示範目的，或者是為了欺騙用户下載它們。這些圖片雖然是PNG格式，但背景並不是真正的透明。
      </p>
    </div>

    <!-- Footer -->
    <div class="footer-note">
      <p>💡 試試點擊右上角的按鈕切換主題，體驗 <strong>Light / Dark Mode</strong> 的轉變！</p>
    </div>
  </div>

  <script>
    // Theme Toggle Functionality
    const themeToggle = document.getElementById('themeToggle');
    const htmlElement = document.documentElement;

    // Check for saved theme preference or default to 'light'
    const currentTheme = localStorage.getItem('theme') || 'light';
    if (currentTheme === 'dark') {
      document.body.classList.add('dark-mode');
      themeToggle.textContent = '☀️';
    } else {
      document.body.classList.remove('dark-mode');
      themeToggle.textContent = '🌙';
    }

    // Theme toggle button click handler
    themeToggle.addEventListener('click', () => {
      document.body.classList.toggle('dark-mode');
      const newTheme = document.body.classList.contains('dark-mode') ? 'dark' : 'light';
      localStorage.setItem('theme', newTheme);
      
      // Update button icon
      themeToggle.textContent = newTheme === 'dark' ? '☀️' : '🌙';
    });
  </script>
