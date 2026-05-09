<!DOCTYPE html>
<html lang="zh-HK">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Web-19 重送請求的第二答案</title>
</head>
<body>
    <!-- archived id list: last known internal entry #7 -->
    <h1>📡 內部報告查詢</h1>
    <p id="output">正在查詢報告...</p>

    <script>
        fetch('/api/report.php?id=1')
            .then(res => res.json())
            .then(data => {
                document.getElementById('output').textContent = `${data.status}: ${data.message}`;
                if (data.hint) {
                    console.log('[api hint]', data.hint);
                }
            })
            .catch(() => {
                document.getElementById('output').textContent = '查詢失敗';
            });

        console.log('[hint] Same endpoint, different parameters.');
        console.log('[hint] Try modifying both id and view parameters.');
    </script>
</body>
</html>