<!DOCTYPE html>
<html lang="zh-HK">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Web-20 最終拼圖</title>
    <style>
        body {
            margin: 0;
            min-height: 100vh;
            display: grid;
            place-items: center;
            font-family: Arial, sans-serif;
            background: linear-gradient(135deg, #111827, #1e293b);
            color: white;
        }
        .card {
            width: min(92vw, 640px);
            padding: 2rem;
            border-radius: 18px;
            background: rgba(15, 23, 42, .82);
            border: 1px solid rgba(148, 163, 184, .25);
        }
        .seal {
            margin-top: 1rem;
            padding: 1rem;
            border-radius: 10px;
            background: rgba(30, 41, 59, .8);
        }
    </style>
</head>
<body>
    <!-- source piece: ZWN0c19hbGx9 -->
    <div class="card">
        <h1>🏁 最終拼圖</h1>
        <p>線索不只在一個地方。請收集全部碎片，再自行還原。</p>
        <div class="seal" id="seal" data-piece="Z3tk">DOM seal loaded.</div>
        <p id="status">正在取得遠端片段...</p>
    </div>

    <script>
        localStorage.setItem('piece_local', 'Zmxh');
        sessionStorage.setItem('piece_session', 'c19jb2xs');
        console.log('[hint] Order: local -> DOM -> API -> session -> source');

        fetch('/api/piece.php')
            .then(res => res.json())
            .then(data => {
                document.getElementById('status').textContent = `API 狀態：${data.status}`;
            })
            .catch(() => {
                document.getElementById('status').textContent = '無法取得 API 片段';
            });
    </script>
</body>
</html>