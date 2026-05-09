<!DOCTYPE html>
<html lang="zh-HK">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Web-12 SessionStorage 的短期記憶</title>
    <style>
        body {
            margin: 0;
            min-height: 100vh;
            display: grid;
            place-items: center;
            font-family: Arial, sans-serif;
            background: linear-gradient(135deg, #ecfeff, #eef2ff);
        }
        .panel {
            width: min(92vw, 560px);
            background: white;
            padding: 2rem;
            border-radius: 16px;
            box-shadow: 0 14px 32px rgba(15, 23, 42, .12);
        }
        code {
            background: #f1f5f9;
            padding: .15rem .35rem;
            border-radius: 6px;
        }
    </style>
</head>
<body>
    <div class="panel">
        <h1>⏳ 工作階段資料同步</h1>
        <p>這個頁面只會在本次瀏覽工作階段暫時保留診斷資料。</p>
        <p>重新開新的工作階段後資料就會消失，請儘快檢查。</p>
        <!-- <p>提示：到 <code>Application → Session Storage</code> 看看。</p> -->
    </div>

    <script>
        sessionStorage.setItem('memo_a', 'ZmxhZ3tzZXNz');
        sessionStorage.setItem('memo_b', 'aW9uX3N0b3Jh');
        sessionStorage.setItem('memo_c', 'Z2VfaXNfc2hvcnRfdGVybX0=');
        sessionStorage.setItem('theme', 'teacher');
        console.log('[hint] Three memo_* keys can be joined in alphabetical order.');
    </script>
</body>
</html>