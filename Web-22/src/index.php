<!DOCTYPE html>
<html lang="zh-HK">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Web-22 試算表隱藏欄</title>
    <style>
        body { margin: 0; min-height: 100vh; display: grid; place-items: center; font-family: Arial, sans-serif; background: #f3f4f6; }
        .card { width: min(92vw, 560px); padding: 2rem; background: white; border-radius: 16px; box-shadow: 0 12px 24px rgba(0, 0, 0, .08); }
        a { color: #3b82f6; text-decoration: none; }
        a:hover { text-decoration: underline; }
    </style>
</head>
<body>
    <div class="card">
        <h1>📊 學生成績表</h1>
        <p>學年度學生成績統計表。表格前四欄是公開顯示，但原始檔案可能有更多欄位。</p>
        <ul>
            <li><a href="/files/students.csv" download>📥 students.csv</a></li>
        </ul>
        <p>提示：用文本編輯器或線上 CSV 查看器檢查所有欄位。</p>
    </div>
</body>
</html>
