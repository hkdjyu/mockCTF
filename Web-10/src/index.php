<!DOCTYPE html>
<html lang="zh-HK">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Web-10 終極偵測題</title>
</head>
<body>
  <h2>🏁 終極偵測挑戰</h2>
  <p id="hint">讀取中...</p>

  <script>
    // 從 localStorage 取第一段
    localStorage.setItem('flag_part1', 'flag{');
    localStorage.setItem('theme', 'dark');
    localStorage.setItem('lang', 'zh');

    // 從 sessionStorage 取最後一段
    sessionStorage.setItem('flag_part3', 'ultimate_dev_detective}');

    // 發起 fetch 取第二段
    fetch('/api/hint.php')
      .then(res => res.json())
      .then(data => {
        // part2隱藏在 data.debug_xyz 欄位
        document.getElementById('hint').textContent = `Status: ${data.status}`;
      });

    console.log('[HINT] Check Storage tabs for fragments');
  </script>
</body>
</html>
