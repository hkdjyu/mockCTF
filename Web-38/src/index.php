<!DOCTYPE html>
<html lang="zh-HK">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Web-38 LSB Steganography</title>
  <style>
    :root {
      --bg: #eef3fb;
      --surface: #ffffff;
      --surface-soft: #f6f8fc;
      --text: #1f2a44;
      --muted: #5f6f8f;
      --accent: #2f6fed;
      --accent-soft: #dfe9ff;
      --border: #d8e2f1;
      --shadow: 0 18px 50px rgba(28, 54, 110, 0.12);
    }

    * {
      box-sizing: border-box;
    }

    body {
      margin: 0;
      font-family: "Segoe UI", "Microsoft JhengHei", sans-serif;
      color: var(--text);
      background:
        radial-gradient(circle at top left, #ffffff 0, #ffffff 12%, transparent 12%),
        linear-gradient(180deg, #f7faff 0%, var(--bg) 100%);
      line-height: 1.75;
    }

    .page {
      max-width: 1120px;
      margin: 0 auto;
      padding: 32px 20px 48px;
    }

    .hero {
      margin-bottom: 28px;
    }

    .hero-banner {
      min-height: 184px;
      border-radius: 24px;
      overflow: hidden;
      background: var(--surface);
      border: 1px solid var(--border);
      box-shadow: var(--shadow);
    }

    .hero-banner {
      display: flex;
      align-items: stretch;
      justify-content: flex-start;
      width: 100%;
    }

    .hero-banner img {
      width: 100%;
      height: 100%;
      object-fit: cover;
      object-position: left center;
      display: block;
    }

    .intro {
      background: var(--surface);
      border: 1px solid var(--border);
      border-radius: 24px;
      padding: 28px;
      box-shadow: var(--shadow);
      margin-bottom: 24px;
    }

    h1 {
      margin: 0 0 12px;
      font-size: clamp(2rem, 4vw, 3.2rem);
      line-height: 1.1;
    }

    .lead {
      margin: 0;
      font-size: 1.08rem;
      color: var(--muted);
    }

    .grid {
      display: grid;
      grid-template-columns: repeat(2, minmax(0, 1fr));
      gap: 24px;
    }

    .card {
      background: var(--surface);
      border: 1px solid var(--border);
      border-radius: 22px;
      padding: 24px;
      box-shadow: var(--shadow);
    }

    .card-wide {
      grid-column: 1 / -1;
    }

    h2 {
      margin: 0 0 14px;
      font-size: 1.4rem;
    }

    p {
      margin: 0 0 14px;
    }

    ul {
      margin: 0;
      padding-left: 20px;
    }

    li + li {
      margin-top: 10px;
    }

    .pill-list {
      display: flex;
      flex-wrap: wrap;
      gap: 10px;
      padding: 0;
      margin: 0;
      list-style: none;
    }

    .pill-list li {
      margin: 0;
      padding: 9px 14px;
      border-radius: 999px;
      background: var(--accent-soft);
      color: var(--accent);
      font-weight: 600;
    }

    .download-box {
      display: flex;
      flex-wrap: wrap;
      gap: 14px;
      align-items: center;
      margin-top: 18px;
      padding: 18px;
      border-radius: 18px;
      background: var(--surface-soft);
      border: 1px solid var(--border);
    }

    .download-box a {
      display: inline-flex;
      align-items: center;
      justify-content: center;
      min-width: 180px;
      padding: 12px 18px;
      border-radius: 14px;
      background: var(--accent);
      color: #fff;
      text-decoration: none;
      font-weight: 700;
    }

    .download-box span {
      color: var(--muted);
    }

    code {
      padding: 2px 8px;
      border-radius: 999px;
      background: var(--surface-soft);
      border: 1px solid var(--border);
      font-family: Consolas, monospace;
      font-size: 0.95em;
    }

    /* Comment: ZmxhZ+S4jeWcqOmAmeijj++8jOimgeaqouafpUxTQg== */

    @media (max-width: 860px) {
      .grid {
        grid-template-columns: 1fr;
      }

      .hero-banner {
        min-height: 150px;
      }

      .page {
        padding: 18px 14px 32px;
      }

      .intro,
      .card {
        padding: 20px;
      }
    }
  </style>
</head>
<body>
  <main class="page">
    <section class="hero">
      <div class="hero-banner">
        <img src="/files/image.jpeg" alt="LSB steganography banner">
      </div>
    </section>

    <section class="intro">
      <h1>LSB Steganography</h1>
      <p class="lead">這張圖片看起來很普通，但旗標就藏在其中。要理解這題，先要知道甚麼是 LSB、它為甚麼能藏資料，以及分析時應該從哪些方向下手。</p>

      <div class="download-box">
        <a href="/files/image.jpeg" download>下載 image.jpeg</a>
        <span>建議先保留原始檔，再用不同工具比對分析結果。</span>
      </div>
    </section>

    <section class="grid">
      <article class="card">
        <h2>甚麼是 LSB</h2>
        <p>LSB 是 Least Significant Bit 的縮寫，即「最低有效位元」。在一個位元組裡，最右邊那一位對整體數值影響最小。例如像素某個色彩通道的數值由 <code>10110110</code> 改成 <code>10110111</code>，只差 1，肉眼通常難以察覺。</p>
        <p>隱寫術會利用這個特性，把秘密訊息一點一點塞進大量像素、聲音樣本，甚至其他數位資料的最低位元。單一位置變化很小，但累積起來就足以藏下一段文字、檔案簽名，甚至整份壓縮內容。</p>
      </article>

      <article class="card">
        <h2>LSB 為甚麼可以隱寫</h2>
        <p>因為最低位元對原始資料的視覺或聽覺影響極小。對圖片而言，一個像素紅綠藍通道各改動 1 個最低位元，通常不會令圖像產生明顯失真；對音訊而言，微小樣本變化也往往不易被耳朵辨識。</p>
        <p>這種方法的核心不是「加密」，而是「不顯眼」。換言之，檔案外觀看起來仍然正常，但實際上已被重新安排部分 bit。只要接收者知道嵌入規則，例如讀取每個像素的最低位元、每三個像素取一組字元，便能還原出訊息。</p>
      </article>

      <article class="card">
        <h2>常見使用 LSB 的檔案格式</h2>
        <ul>
          <li><strong>BMP</strong>：未壓縮、結構直接，最常見於教學與入門題。</li>
          <li><strong>PNG</strong>：無損壓縮，適合保留 bit 級變化，CTF 很常見。</li>
          <li><strong>WAV</strong>：可把訊息藏進音訊樣本的最低位元。</li>
          <li><strong>RAW 或未壓縮像素資料</strong>：便於直接控制每個 bit。</li>
          <li><strong>部分 JPEG 題目</strong>：嚴格來說 JPEG 通常更常見的是 DCT 或其他層面的隱寫，不是最典型的純 LSB，但題目設計者有時仍會把秘密先藏入像素後再輸出。</li>
        </ul>
      </article>

      <article class="card">
        <h2>CTF 技巧</h2>
        <p> 由於LSB隱寫比較麻煩，建議先檢查DevTools的基本資訊，然後查閲多媒體檔案的metadata（EXIF、RIFF chunk、Vorbis comment等），有時候出題者會在那裡放一些提示或直接的flag。接著再用簡單的工具（如https://futureboy.us/stegano/）測試，最後才自己寫腳本來提取LSB資料。</p>
        <p>如果是圖片，還可以嘗試把它轉成BMP或RAW格式，因為這些格式的結構更簡單，直接對應到像素資料，提取LSB會更方便。</p>
      </article>

    </section>
  </main>
</body>
</html>