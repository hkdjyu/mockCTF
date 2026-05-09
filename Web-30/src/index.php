<!DOCTYPE html>
<html lang="zh-HK">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Web-30 壓縮檔迷宮</title>
    <style>
        body { margin: 0; min-height: 100vh; display: grid; place-items: center; font-family: Arial, sans-serif; background: #f3f4f6; }
        .card { width: min(92vw, 560px); padding: 2rem; background: white; border-radius: 16px; box-shadow: 0 12px 24px rgba(0, 0, 0, .08); }
        a { color: #3b82f6; }
        li { margin: 0.5rem 0; }
    </style>
</head>
<body>
    <div class="card">
        <h1>🏁 壓縮檔迷宮</h1>
        <p>最後的挑戰把多種格式的線索收進同一個壓縮檔中。你需要先解壓，再逐一分析裡面的檔案內容。</p>
        <h3>下載所需檔案：</h3>
        <ul>
            <li><a href="/files/compress.zip" download>📥 compress.zip</a></li>
        </ul>
        <p>提示：壓縮檔內含多個不同格式的檔案。請依照檔案類型提取資訊，再按指定順序 (1→2→3→4) 拼接。</p>
        <p>Console hint: <code>Unzip first, then solve in order: TXT hex + CSV base64 + PNG metadata + MP3 comments</code></p>
    </div>

    <script>
        console.log('[+] Start with compress.zip');
        console.log('[+] Order: Part1_HEX + Part2_BASE64 + Part3_PNG_METADATA + Part4_ID3');
        console.log('[+] Unzip first, then combine in the given order');
    </script>
</body>
</html>
