<!DOCTYPE html>
<html lang="zh-HK">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Web-09 假 API 真線索</title>
</head>
<body>
  <h2>🧪 API 健康檢查</h2>
  <p id="status">讀取中...</p>

  <script>
    fetch('/api/status.php')
      .then(res => res.json())
      .then(data => {
        document.getElementById('status').textContent = `service: ${data.service}, status: ${data.status}`;
      })
      .catch(() => {
        document.getElementById('status').textContent = '讀取失敗';
      });
  </script>
</body>
</html>
