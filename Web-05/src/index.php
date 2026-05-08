<!DOCTYPE html>
<html lang="zh-HK">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Web-05 LocalStorage 的秘密</title>
</head>
<body>
  <h2>🗂️ 設定頁（Beta）</h2>
  <p>此頁會在本機儲存偏好設定。</p>

  <script>
    localStorage.setItem('theme', 'light');
    localStorage.setItem('fontSize', '16');
    localStorage.setItem('debug_token', 'ZmxhZ3tsb2NhbHN0b3JhZ2VfaXNfcHVibGljfQ==');
    console.log('Settings saved.');
  </script>
</body>
</html>
