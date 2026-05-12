<!DOCTYPE html>
<html lang="zh-HK">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Web-17 manifest.json 說太多了</title>
    <link rel="manifest" href="./manifest.json">
    <meta name="theme-color" content="#0f172a">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            min-height: 100vh;
            display: grid;
            place-items: center;
            background: #0f172a;
            color: white;
        }
        .card {
            width: min(92vw, 560px);
            padding: 2rem;
            border-radius: 16px;
            background: rgba(15, 23, 42, .8);
            border: 1px solid rgba(148, 163, 184, .22);
        }
        .card p {
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }
    </style>
</head>
<body>
    <div class="card">
        <h1>📱 校園助手 PWA</h1>
        <p>這是一個簡化版的校園行事曆入口。請從前端設定中找出多餘資訊。</p>
        <p>I8hkJQjtgotF7Y69NPRCHcB2pxrttax1NOa02sOUt7dy79cc0UzWZrAN8eaNc5G1XPcC7jjXnJXlveZNwdjjbLMxPNAYlrA/5lLsvEbmtyWEvWgzsSRNarZwNIRjrW44ffgkrCQnOMm3AUL/va7VSp4Hjro366WgLjWrVuJNtmI= </p>
    </div>
</body>
</html>
