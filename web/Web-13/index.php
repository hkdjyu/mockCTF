<?php
if (isset($_GET['route']) && $_GET['route'] === 'staff-preview') {
    header('Content-Type: application/json; charset=UTF-8');
    echo json_encode([
        'message' => 'ZmxhZ3toYXNoX3JvdXRlc19jYW5faGlkZV9wYXRoc30='
    ], JSON_UNESCAPED_UNICODE);
    exit;
}
?><!DOCTYPE html>
<html lang="zh-HK">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Web-13 Hash Fragment 的密語</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #0f172a;
            color: #e2e8f0;
            margin: 0;
            min-height: 100vh;
            display: grid;
            place-items: center;
        }
        .box {
            width: min(92vw, 620px);
            padding: 2rem;
            background: rgba(15, 23, 42, .75);
            border: 1px solid rgba(148, 163, 184, .25);
            border-radius: 16px;
        }
        .result {
            margin-top: 1rem;
            padding: 1rem;
            border-radius: 10px;
            background: #111827;
            word-break: break-all;
        }
    </style>
</head>
<body>
    <div class="box">
        <h1>🔖 內部公告檢視器</h1>
        <p>目前沒有可顯示的公告。請確認網址片段是否正確。</p>
        <div class="result" id="result">等待路由片段...</div>
    </div>

    <script>
        const routes = {
            '#notice': '公開資訊：本頁沒有旗標。'
        };

        async function render() {
            const hash = window.location.hash || '#none';
            const result = document.getElementById('result');

            if (hash === '#staff-preview') {
                result.textContent = '正在載入內部片段...';
                try {
                    const resp = await fetch('?route=staff-preview', { cache: 'no-store' });
                    if (!resp.ok) {
                        result.textContent = '載入失敗。';
                        return;
                    }

                    const data = await resp.json();
                    result.textContent = data.message || '找不到對應片段。';
                } catch (error) {
                    result.textContent = '載入失敗。';
                }
                return;
            }

            result.textContent = routes[hash] || '找不到對應片段。';
        }

        window.addEventListener('hashchange', render);
        render();
    </script>
</body>
</html>