<!DOCTYPE html>
<html lang="zh-HK">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Web-16 JWT 自白書</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            min-height: 100vh;
            display: grid;
            place-items: center;
            background: linear-gradient(135deg, #ede9fe, #f8fafc);
        }
        .card {
            width: min(92vw, 580px);
            padding: 2rem;
            background: white;
            border-radius: 16px;
            box-shadow: 0 12px 32px rgba(30, 41, 59, .12);
        }
        code {
            background: #f1f5f9;
            padding: .15rem .35rem;
            border-radius: 6px;
        }
    </style>
</head>
<body>
    <div class="card">
        <h1>🎫 單一登入測試頁</h1>
        <p>頁面已暫時建立訪客登入狀態，方便前端測試流程。</p>
        <p>提示：檢查 <code>Application → Local Storage</code>。</p>
    </div>

    <script>
        localStorage.setItem(
            'portal.jwt',
            'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJ1c2VyIjoic3R1ZGVudCIsInJvbGUiOiJndWVzdCIsIm5vdGUiOiJkZWNvZGVfbWUiLCJmbGFnIjoiZmxhZ3tqd3RfcGF5bG9hZHNfYXJlX3B1YmxpY30ifQ.signature_placeholder'
        );
        console.log('[hint] Read the payload, do not forge the token.');
    </script>
</body>
</html>