<!DOCTYPE html>
<html lang="zh-HK">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Web-33 GIF 幀訊息</title>
  <style>
    :root {
      --bg-primary: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
      --bg-secondary: white;
      --text-primary: #333;
      --text-secondary: #555;
      --text-tertiary: #666;
      --accent-color: #667eea;
      --accent-dark: #764ba2;
      --border-color: #e9ecef;
      --shadow-color: rgba(0, 0, 0, 0.08);
      --hero-shadow: rgba(102, 126, 234, 0.3);
      --code-bg: #f0f4ff;
      --code-color: #764ba2;
    }

    body.dark-mode {
      --bg-primary: linear-gradient(135deg, #1a1a2e 0%, #16213e 100%);
      --bg-secondary: #0f3460;
      --text-primary: #e0e0e0;
      --text-secondary: #b0b0b0;
      --text-tertiary: #909090;
      --accent-color: #8fa3ff;
      --accent-dark: #9d84d9;
      --border-color: #2a3f5f;
      --shadow-color: rgba(0, 0, 0, 0.3);
      --hero-shadow: rgba(139, 163, 255, 0.3);
      --code-bg: #1a2f5a;
      --code-color: #a9d5ff;
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
    }

    /* Content Section */
    .content {
      background: var(--bg-secondary);
      border-radius: 12px;
      padding: 40px;
      margin-bottom: 30px;
      box-shadow: 0 4px 20px var(--shadow-color);
      transition: background 0.3s ease;
    }

    .content h2 {
      color: var(--accent-color);
      font-size: 1.8em;
      margin-bottom: 20px;
      padding-bottom: 15px;
      border-bottom: 3px solid var(--accent-color);
    }

    .content p {
      margin-bottom: 20px;
      font-size: 1.05em;
      line-height: 1.8;
      color: var(--text-secondary);
    }

    .content code {
      background: var(--code-bg);
      color: var(--code-color);
      padding: 4px 8px;
      border-radius: 4px;
      font-family: 'Courier New', monospace;
      font-weight: 500;
    }

    /* Files Grid */
    .files-grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
      gap: 25px;
      margin: 30px 0;
    }

    .file-card {
      background: var(--bg-secondary);
      border: 2px solid var(--border-color);
      border-radius: 12px;
      padding: 25px;
      text-align: center;
      transition: all 0.3s ease;
    }

    body.dark-mode .file-card {
      background: #1e2d42;
    }

    .file-card:hover {
      transform: translateY(-5px);
      border-color: var(--accent-color);
      box-shadow: 0 8px 25px var(--hero-shadow);
    }

    .file-card .icon {
      font-size: 3em;
      margin-bottom: 15px;
    }

    .file-card h3 {
      color: var(--accent-color);
      font-size: 1.3em;
      margin-bottom: 10px;
    }

    .file-card p {
      font-size: 0.95em;
      color: var(--text-tertiary);
      margin-bottom: 20px;
    }

    /* Download Button */
    .download-btn {
      display: inline-block;
      background: linear-gradient(135deg, var(--accent-color) 0%, var(--accent-dark) 100%);
      color: white;
      padding: 12px 30px;
      border: none;
      border-radius: 8px;
      font-size: 1em;
      font-weight: 600;
      cursor: pointer;
      text-decoration: none;
      transition: all 0.3s ease;
      box-shadow: 0 4px 15px var(--hero-shadow);
    }

    .download-btn:hover {
      transform: translateY(-2px);
      box-shadow: 0 6px 20px var(--hero-shadow);
    }

    .download-btn:active {
      transform: translateY(0);
    }

    /* Info Box */
    .info-box {
      background: linear-gradient(135deg, #e3f2fd 0%, #f3e5f5 100%);
      border-left: 5px solid var(--accent-color);
      padding: 20px;
      border-radius: 8px;
      margin: 30px 0;
    }

    body.dark-mode .info-box {
      background: linear-gradient(135deg, #1a2f5a 0%, #3a2d4a 100%);
    }

    .info-box p {
      margin: 0;
      color: var(--text-primary);
      font-weight: 500;
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

      .files-grid {
        grid-template-columns: 1fr;
      }
    }
  </style>
</head>
<body>
  <!-- Theme Toggle Button -->
  <button id="themeToggle" class="theme-toggle" title="切換深色/淺色模式">🌙</button>

  <div class="container">
    <!-- Hero Section -->
    <div class="hero">
      <h1>🎞️ GIF 幀訊息</h1>
      <p>探索動態影像格式的秘密</p>
    </div>

    <!-- Main Content -->
    <div class="content">
      <h2>什麼是 GIF？</h2>
      <p>
        GIF（圖形交換格式）是一種被廣泛應用於互聯網的圖像文件格式。全名為 Graphics Interchange Format，由 CompuServe 公司於 1987 年開發。GIF 檔案可以存儲一個或多個影像，因此可以用來製作簡單的動畫。
      </p>

      <p>
        GIF 檔案的特點是具有高度的可壓縮性，並且可以在不損失圖像質量的情況下保存。GIF 格式支持透明背景和動畫幀，使其成為製作網頁動畫的流行選擇。每一幀之間可以設定延遲時間，形成動態效果。
      </p>

      <h2 style="margin-top: 50px;">GIF 格式詳情</h2>
      <div class="info-box">
        <p>💡 <strong>提示：</strong>GIF 檔案可能在 header、comment extension 或 frame metadata 中包含隱藏信息。可以使用 hex editor 或 metadata 工具來檢查這些資訊。</p>
      </div>

      <p>
        GIF 文件結構包括多個部分：
      </p>
      <ul style="margin: 20px 0 20px 40px; color: var(--text-secondary);">
        <li><strong>Logical Screen Descriptor</strong> — 定義影像的寬度和高度</li>
        <li><strong>Global Color Table</strong> — 全局色彩表</li>
        <li><strong>Image Data</strong> — 逐幀的影像數據</li>
        <li><strong>Comment Extension</strong> — 可能包含隱藏的註釋或訊息</li>
        <li><strong>Trailer</strong> — 標記 GIF 文件的結尾</li>
      </ul>

      <h2 style="margin-top: 50px;">下載 GIF 檔案</h2>
      <p>
        以下是可用的 GIF 檔案。下載並使用適當的工具（如 hexed.it、HxD 或線上 metadata 查看器）來檢查檔案內容，找出隱藏的訊息。
      </p>

      <div class="files-grid">
        <div class="file-card">
          <div class="icon">🐵</div>
          <h3>awkwardmonkeypuppet.gif</h3>
          <p>一個表情怪異的猴子木偶</p>
          <a href="./files/AwkwardMonkeyPuppet.gif" download class="download-btn">📥 下載</a>
        </div>
        <div class="file-card">
          <div class="icon">😺</div>
          <h3>huhcat.gif</h3>
          <p>一隻困惑的貓咪</p>
          <a href="./files/HuhCat.gif" download class="download-btn">📥 下載</a>
        </div>
      </div>
    </div>

    <!-- Footer -->
    <div class="info-box" style="text-align: center;">
      <p>💡 試試點擊右上角的按鈕切換主題，體驗 <strong>Light / Dark Mode</strong> 的轉變！</p>
    </div>
  </div>

  <script>
    // Theme Toggle Functionality
    const themeToggle = document.getElementById('themeToggle');

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
</body>
</html>
