<!DOCTYPE html>
<html lang="zh-HK">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Web-36 MKV隱寫</title>
</head>

<style>
  body {
    margin: 0;
    min-height: 100vh;
    display: grid;
    place-items: center;
    font-family: Arial, sans-serif;
    background: #f3f4f6;
  }
  video {
    max-width: 100%;
    height: auto;
    border-radius: 8px;
    box-shadow: 0 4px 12px rgba(0, 0, 0, .1);
  }
</style>

<body>
  <h1>Web-36 MKV隱寫</h1>
  <!-- 提供mkv檔案直接播放 -->
  <video controls style="max-width: 100%; height: auto;">
    <source src="/files/file.mkv" type="video/x-matroska">
    您的瀏覽器不支援影片播放，請下載檔案後使用適當的播放器觀看。
  </video>
</body>
</html>