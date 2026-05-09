<!DOCTYPE html>
<html lang="zh-HK">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Web-30 最終檔案迷宮</title>
    <style>
        body { margin: 0; min-height: 100vh; display: grid; place-items: center; font-family: Arial, sans-serif; background: #f3f4f6; }
        .card { width: min(92vw, 560px); padding: 2rem; background: white; border-radius: 16px; box-shadow: 0 12px 24px rgba(0, 0, 0, .08); }
        a { color: #3b82f6; }
        li { margin: 0.5rem 0; }
    </style>
</head>
<body>
    <div class="card">
        <h1>🏁 檔案迷宮</h1>
        <p>最後的挑戰結合了多種格式的檔案。線索分散在各處，需要收集並組合。</p>
        <h3>下載所需檔案：</h3>
        <ul>
            <li><a href="/files/part1.txt" download>📥 part1.txt</a></li>
            <li><a href="/files/part2.csv" download>📥 part2.csv</a></li>
            <li><a href="/files/part3.png" download>📥 part3.png</a></li>
            <li><a href="/files/part4.mp3" download>📥 part4.mp3</a></li>
        </ul>
        <p>提示：依照文件類型提取資訊，再依照指定顺序 (1→2→3→4) 拼接，最後多層解碼。</p>
        <p>Console hint: <code>Order: TXT hex + CSV base64 + PNG metadata + MP3 comments</code></p>
    </div>

    <script>
        console.log('[+] Order: Part1_HEX + Part2_BASE64 + Part3_PNG_METADATA + Part4_ID3');
        console.log('[+] Final decode: URL_DECODE -> BASE64 -> HEX');
    </script>
</body>
</html>
