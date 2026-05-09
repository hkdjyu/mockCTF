<!DOCTYPE html>
<html lang="zh-HK">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Web-18 Service Worker 的假畫面</title>
</head>
<body>
    <h1>🛰️ 每日公告中心</h1>
    <p id="status">正在註冊 Service Worker...</p>
    <pre id="message">讀取中...</pre>

    <script>
        async function boot() {
            if ('serviceWorker' in navigator) {
                await navigator.serviceWorker.register('/sw.js');
                await navigator.serviceWorker.ready;
                document.getElementById('status').textContent = 'Service Worker 已啟用';
            }

            const res = await fetch('/daily-message.txt');
            const text = await res.text();
            document.getElementById('message').textContent = text;
        }

        boot().catch(() => {
            document.getElementById('status').textContent = '初始化失敗';
        });
    </script>
</body>
</html>