<!DOCTYPE html>
<html lang="zh-HK">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Web-39 光譜圖隱寫</title>
  <style>
    :root {
      --bg: #f1f6fd;
      --surface: #ffffff;
      --surface-soft: #f7f9fe;
      --text: #13233f;
      --muted: #506689;
      --accent: #2a64e8;
      --accent-soft: #dde9ff;
      --border: #d4e0f2;
      --shadow: 0 18px 48px rgba(17, 45, 96, 0.12);
    }

    * {
      box-sizing: border-box;
    }

    body {
      margin: 0;
      font-family: "Segoe UI", "Microsoft JhengHei", sans-serif;
      color: var(--text);
      background:
        radial-gradient(circle at 88% 8%, #ffffff 0, #ffffff 10%, transparent 11%),
        linear-gradient(180deg, #f9fbff 0%, var(--bg) 100%);
      line-height: 1.75;
    }

    .page {
      max-width: 1120px;
      margin: 0 auto;
      padding: 28px 20px 44px;
    }

    .hero {
      display: grid;
      grid-template-columns: minmax(0, 1.1fr) minmax(0, 0.9fr);
      gap: 24px;
      margin-bottom: 26px;
    }

    .hero-copy,
    .hero-image {
      background: var(--surface);
      border: 1px solid var(--border);
      border-radius: 24px;
      box-shadow: var(--shadow);
    }

    .hero-copy {
      padding: 28px;
    }

    h1 {
      margin: 0 0 14px;
      font-size: clamp(2rem, 3.8vw, 3.1rem);
      line-height: 1.1;
    }

    .lead {
      margin: 0;
      color: var(--muted);
      font-size: 1.06rem;
    }

    .hero-image {
      overflow: hidden;
      display: flex;
      align-items: center;
      justify-content: center;
      background: var(--surface-soft);
      padding: 14px;
    }

    .hero-image img {
      width: 100%;
      height: auto;
      display: block;
      border-radius: 14px;
      border: 1px solid var(--border);
    }

    .grid {
      display: grid;
      grid-template-columns: repeat(2, minmax(0, 1fr));
      gap: 22px;
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
      margin: 0 0 12px;
      font-size: 1.35rem;
    }

    p {
      margin: 0 0 14px;
    }

    ul {
      margin: 0;
      padding-left: 20px;
    }

    li + li {
      margin-top: 9px;
    }

    .chip-list {
      list-style: none;
      margin: 0;
      padding: 0;
      display: flex;
      flex-wrap: wrap;
      gap: 10px;
    }

    .chip-list li {
      margin: 0;
      background: var(--accent-soft);
      color: var(--accent);
      border-radius: 999px;
      padding: 8px 13px;
      font-weight: 700;
      font-size: 0.95rem;
    }

    .note {
      margin-top: 12px;
      padding: 14px 16px;
      border-radius: 14px;
      background: var(--surface-soft);
      border: 1px solid var(--border);
      color: var(--muted);
    }

    @media (max-width: 900px) {
      .hero,
      .grid {
        grid-template-columns: 1fr;
      }

      .page {
        padding: 18px 14px 30px;
      }

      .hero-copy,
      .card {
        padding: 20px;
      }
    }
  </style>
</head>
<body>
  <main class="page">
    <section class="hero">
      <article class="hero-copy">
        <h1>光譜圖隱寫</h1>
        <p class="lead">在這類題目中，關鍵線索不一定直接出現在波形或檔名，而是藏在「時間-頻率」視角下的圖像資訊。理解 Spectrogram 的閱讀方式，通常就能大幅縮短解題時間。</p>
        <audio controls>
          <source src="/files/rain.mp3" type="audio/mp3">
          您的瀏覽器不支援音訊播放，請下載檔案後使用適當的播放器收聽。
        </audio>
      </article>
      <figure class="hero-image">
        <img src="/files/image.webp" alt="Signal and spectrogram introduction">
      </figure>
    </section>

    <section class="grid">
      <article class="card">
        <h2>甚麼是光譜圖 / 頻譜圖</h2>
        <p>光譜圖（Spectrogram）是把聲音訊號拆成「時間、頻率、能量」三個維度的可視化方式。橫軸是時間，縱軸是頻率，顏色亮度代表該頻率在該時間點上的能量強弱。</p>
        <p>它和一般波形圖最大的差別是：波形主要看振幅如何隨時間變化，光譜圖則能看見各頻率成分如何出現、消失、疊加，因此更容易發現人耳不易直接察覺的規律。</p>
      </article>

      <article class="card">
        <h2>為甚麼光譜圖可以隱寫</h2>
        <p>隱寫者可以把內容轉成特定頻率上的圖樣，埋在短時間片段內。正常聆聽時，這些高頻、短脈衝或低音量變化可能不明顯，但在光譜圖中會形成可視化痕跡，例如文字輪廓、QR 形狀或有規律的條紋。</p>
        <p>換句話說，這種方法利用了「聽覺不敏感但圖像敏感」的特性，將語義訊息從聲音層轉移到視覺層，令資料在播放時不突兀，分析時卻可被還原。</p>
      </article>

      <article class="card">
        <h2>常見的藏法與線索</h2>
        <ul>
          <li>高頻帶中出現不自然幾何線條或字母輪廓。</li>
          <li>固定時間間隔重複的亮點，可能對應二進位節奏。</li>
          <li>左右聲道含有不同圖樣，需分 channel 分析。</li>
          <li>明顯人工切割區塊，常配合 base64 或 Morse 轉換。</li>
          <li>特定區間的能量分布異常平整，像「被畫上去」一樣。</li>
        </ul>
      </article>

      <article class="card">
        <h2>常用分析工具</h2>
        <ul>
          <li><strong>Sonic Visualiser</strong>：適合細看頻譜細節與時間標記。</li>
          <li><strong>Audacity/Wavacity</strong>：可快速切換 spectrogram 視圖、調窗函數與頻率範圍。</li>
          <li><strong>Python + librosa / matplotlib</strong>：可批次產生與調參 spectrogram。</li>
          <li><strong>BoxenTRIQ</strong>：線上工具快速生成 spectrogram。</li>
          <li><strong>CyberChef</strong>：把抽出的字元序列做編碼解碼與格式轉換。</li>
        </ul>
      </article>

      <article class="card card-wide">
        <h2>給學生的解題思路</h2>
        <p>先從「看圖」而不是「聽聲」開始，調整 spectrogram 的顏色映射、對比度、頻率上限與窗長，找出是否存在人造圖樣。再把可疑區段獨立抽出，檢查其時間間距與頻率位置是否具有編碼規律。</p>
        <p>如果看到像字母或符號，記錄其出現順序；如果看到條紋節奏，可嘗試轉成 0/1 後再做 ASCII、Hex、Base64 或 Morse 解析。很多題目不是卡在觀察，而是卡在「看到之後不知道怎樣轉換」，所以一定要把時間軸與編碼邏輯一同記下。</p>
        <div class="note">重點不是只會按工具，而是理解每一次調參（例如窗長、頻率範圍、動態範圍）如何改變你看見的資訊密度。當你能解釋這些選項的影響，就能在不同題型間快速遷移方法。</div>
      </article>

    </section>
  </main>
</body>
</html>