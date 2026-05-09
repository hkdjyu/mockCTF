<!DOCTYPE html>
<html lang="zh-HK">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Web-21 文本檔的編碼祕密</title>
    <style>
        body {
            margin: 0;
            min-height: 100vh;
            display: grid;
            place-items: center;
            font-family: Arial, sans-serif;
            background: #f3f4f6;
        }
        .card {
            width: min(92vw, 560px);
            padding: 2rem;
            background: white;
            border-radius: 16px;
            box-shadow: 0 12px 24px rgba(0, 0, 0, .08);
        }
        a {
            color: #3b82f6;
            text-decoration: none;
        }
        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="card">
        <h1>📄 筆記檔案備份</h1>
        <p>下方是本學期的各種筆記備份檔案。某個檔案可能包含編碼後的資訊。</p>
        <ul>
            <li><a href="/files/notes.txt" download>📥 notes.txt</a></li>
        </ul>
        <p>提示：檢查檔案內容，尋找多層編碼的片段。</p>
    </div>
</body>
</html>
