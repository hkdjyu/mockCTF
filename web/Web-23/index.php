<!DOCTYPE html>
<html lang="zh-HK">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Web-23 PDF 元數據洩漏</title>
    <style>
        body { margin: 0; min-height: 100vh; font-family: Arial, sans-serif; background: #f3f4f6; padding: 1rem; }
        .container { max-width: 900px; margin: 0 auto; }
        h1 { color: #1f2937; margin-top: 0; }
        p { color: #4b5563; line-height: 1.6; }
        .pdf-viewer { width: 100%; height: 70vh; border-radius: 8px; box-shadow: 0 4px 12px rgba(0, 0, 0, .1); }
        a { color: #3b82f6; text-decoration: none; }
        a:hover { text-decoration: underline; }
    </style>
</head>
<body>
    <div class="container">
        <h1>📋 靈糧堂劉梅軒中學校訊</h1>
        <p>這是校訊 PDF 檔案。</p>
        <!-- <p>提示：使用 PDF 檢視器右側的工具列下載檔案，然後使用線上 PDF 元數據檢查工具或 <a href="https://exif.tools/" target="_blank">https://exif.tools/</a>。</p> -->
        <embed src="./files/file.pdf" class="pdf-viewer" type="application/pdf">
    </div>
</body>
</html>

