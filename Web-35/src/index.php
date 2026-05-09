<!DOCTYPE html>
<html lang="zh-HK">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Web-35 WAV LSB隱寫</title>
  <style>
    body {
      font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', 'Microsoft YaHei', sans-serif;
      max-width: 800px;
      margin: 40px auto;
      padding: 20px;
      background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
      color: #333;
    }

    h1 {
      color: white;
      text-align: center;
      margin-bottom: 30px;
    }

    .content {
      background: white;
      border-radius: 12px;
      padding: 30px;
      box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
    }

    audio {
      width: 100%;
      margin: 20px 0;
      border-radius: 8px;
    }

    p {
      color: #555;
      line-height: 1.6;
    }

    ul {
      list-style: none;
      padding: 0;
    }

    li {
      margin: 10px 0;
    }

    a {
      color: #667eea;
      text-decoration: none;
      font-weight: 500;
    }

    a:hover {
      text-decoration: underline;
    }
  </style>
</head>
<body>
  <h1>Web-35 WAV LSB隱寫</h1>
  <div class="content">
    <audio controls>
      <source src="/files/bell.wav" type="audio/wav">
      Your browser does not support the audio element.
    </audio>
    <ul>
      <li><a href="/files/bell.wav" download>bell.wav</a></li>
    </ul>
    <p>聽説，這段鐘聲的最低有效位元，隱藏了重要的資訊</p>
  </div>
</body>
</html>