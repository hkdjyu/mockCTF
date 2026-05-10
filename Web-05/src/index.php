<!DOCTYPE html>
<html lang="zh-HK">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Web-05 LocalStorage 的秘密</title>
</head>
<body>
  <h2>🗂️ 設定頁（Beta）</h2>
  <div style="display: flex; flex-direction: column; gap: 1rem; margin-top: 1rem;">
    <label>
      <input type="range" id="fontSizeSlider" min="12" max="24" value="16">
      字體大小
    </label>
    <label>
      <input type="checkbox" id="darkModeToggle">
      啟用深色模式
    </label>
  </div>
  <p>設定會儲存在本機。</p>

  <script>
    const darkModeToggle = document.getElementById('darkModeToggle');
    const savedTheme = localStorage.getItem('theme');

    const fontSizeSlider = document.getElementById('fontSizeSlider');
    const savedFontSize = localStorage.getItem('fontSize');

    if (savedTheme === 'dark') {
      document.body.style.backgroundColor = '#1e293b';
      document.body.style.color = 'white';
      darkModeToggle.checked = true;
    } else {
      document.body.style.backgroundColor = '';
      document.body.style.color = '';
      darkModeToggle.checked = false;
    }

    darkModeToggle.addEventListener('change', () => {
      if (darkModeToggle.checked) {
        document.body.style.backgroundColor = '#1e293b';
        document.body.style.color = 'white';
        localStorage.setItem('theme', 'dark');
      } else {
        document.body.style.backgroundColor = '';
        document.body.style.color = '';
        localStorage.setItem('theme', 'light');
      }
    });

    if (savedFontSize) {
      document.body.style.fontSize = savedFontSize + 'px';
      fontSizeSlider.value = savedFontSize;
    } else {
      document.body.style.fontSize = 16 + 'px';
    }

    fontSizeSlider.addEventListener('input', () => {
      const fontSize = fontSizeSlider.value;
      document.body.style.fontSize = fontSize + 'px';
      localStorage.setItem('fontSize', fontSize);
    });

    localStorage.setItem('debug_token', 'ZmxhZ3tsb2NhbHN0b3JhZ2VfaXNfcHVibGljfQ==');
    console.log('Settings saved.');
  </script>
</body>
</html>
