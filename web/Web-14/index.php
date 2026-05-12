<!DOCTYPE html>
<html lang="zh-HK">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Web-14 被快取的舊秘密</title>
</head>
<body>
    <h1>🗃️ 靜態資源版本測試</h1>
    <p>目前系統已更新到最新版資源。若仍看到舊資訊，請清除快取。</p>
    <p id="status">正在檢查快取狀態...</p>

    <script>
        (async () => {
            const cache = await caches.open('web14-static-v1');
            await cache.add('/legacy/app.v1.js');
            document.getElementById('status').textContent = '新版資源已載入。';
        })().catch(() => {
            document.getElementById('status').textContent = '快取初始化失敗';
        });
    </script>
    <script src="./assets/app.v2.js"></script>
</body>
</html>
