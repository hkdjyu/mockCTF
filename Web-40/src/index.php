<!DOCTYPE html>
<html lang="zh-HK">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Web-40 Speech</title>
  <style>
    :root {
      --bg: #eef2f9;
      --surface: #ffffff;
      --surface-soft: #f5f8ff;
      --text: #1c2740;
      --muted: #5e7096;
      --accent: #2f67eb;
      --border: #d8e2f4;
      --shadow: 0 14px 34px rgba(25, 49, 99, 0.12);
      --ok: #198754;
      --warn: #8a6d1d;
    }

    * {
      box-sizing: border-box;
    }

    body {
      margin: 0;
      font-family: "Segoe UI", "Microsoft JhengHei", sans-serif;
      color: var(--text);
      background: linear-gradient(180deg, #f9fbff 0%, var(--bg) 100%);
      min-height: 100vh;
      line-height: 1.7;
    }

    .wrap {
      max-width: 900px;
      margin: 0 auto;
      padding: 28px 16px 40px;
    }

    .card {
      background: var(--surface);
      border: 1px solid var(--border);
      border-radius: 20px;
      box-shadow: var(--shadow);
      padding: 24px;
    }

    h1 {
      margin: 0 0 8px;
      font-size: clamp(2rem, 4vw, 2.8rem);
      line-height: 1.1;
    }

    .subtitle {
      margin: 0 0 18px;
      color: var(--muted);
    }

    .actions {
      display: flex;
      flex-wrap: wrap;
      gap: 10px;
      margin-bottom: 14px;
    }

    button,
    a.btn {
      border: 1px solid transparent;
      border-radius: 12px;
      padding: 10px 14px;
      font-size: 0.95rem;
      font-weight: 700;
      text-decoration: none;
      cursor: pointer;
      transition: transform 0.15s ease, opacity 0.15s ease;
    }

    button:hover,
    a.btn:hover {
      transform: translateY(-1px);
      opacity: 0.95;
    }

    #copyBtn {
      background: var(--accent);
      color: #fff;
    }

    #reloadBtn {
      background: #eef3ff;
      border-color: #cfddff;
      color: #204cae;
    }

    a.btn {
      background: #f0f5ff;
      border-color: #d7e3ff;
      color: #224da8;
    }

    .panel {
      background: var(--surface-soft);
      border: 1px solid var(--border);
      border-radius: 14px;
      padding: 12px;
    }

    textarea {
      width: 100%;
      min-height: 280px;
      border: 1px solid #cfdaf0;
      border-radius: 10px;
      padding: 12px;
      resize: vertical;
      font-size: 0.96rem;
      font-family: Consolas, "Courier New", monospace;
      color: #1f2b44;
      background: #fff;
    }

    .tips {
      margin-top: 14px;
      background: #fff7df;
      border: 1px solid #f2dd9c;
      border-radius: 12px;
      padding: 12px;
      color: var(--warn);
      font-size: 0.95rem;
    }

    .status {
      margin-top: 10px;
      min-height: 22px;
      color: var(--muted);
      font-size: 0.92rem;
    }

    .status.ok {
      color: var(--ok);
      font-weight: 600;
    }

    .status.err {
      color: #a03131;
      font-weight: 600;
    }

    @media (max-width: 640px) {
      .card {
        padding: 18px;
      }

      textarea {
        min-height: 220px;
      }
    }
  </style>
</head>
<body>
  <main class="wrap">
    <section class="card">
      <h1>Speech</h1>
      <p class="subtitle">請打開 F12 的 Network 下載原始檔案。</p>

      <div class="actions">
        <button id="reloadBtn" type="button">重新讀取檔案</button>
        <a id="directDownloadBtn" class="btn" href="/files/speech.dat" download>直接下載</a>
      </div>

      <div class="panel">
        <textarea id="datContent" spellcheck="false" readonly>正在讀取 /files/speech.dat ...</textarea>
      </div>
      <div id="statusText" class="status"></div>

      <div class="tips">
        點解Speech只有文字而冇<strong>聲音</strong>？
      </div>
    </section>
  </main>

  <script>
    const textarea = document.getElementById("datContent");
    const statusText = document.getElementById("statusText");
    const reloadBtn = document.getElementById("reloadBtn");
    const directDownloadBtn = document.getElementById("directDownloadBtn");

    async function loadDatText() {
      statusText.textContent = "讀取中...";
      statusText.className = "status";

      try {
        const response = await fetch("/files/speech.dat", { cache: "no-store" });
        if (!response.ok) {
          throw new Error("HTTP " + response.status);
        }

        const text = await response.text();
        textarea.value = text;
        statusText.textContent = "已成功載入內容。";
        statusText.className = "status ok";
      } catch (error) {
        textarea.value = "";
        statusText.textContent = "讀取失敗：" + error.message;
        statusText.className = "status err";
      }
    }

    reloadBtn.addEventListener("click", loadDatText);
    directDownloadBtn.addEventListener("click", function (event) {
      event.preventDefault();
      alert("下載失敗");
    });

    document.addEventListener("contextmenu", function (event) {
      event.preventDefault();
    });

    document.addEventListener("keydown", function (event) {
      const key = event.key ? event.key.toLowerCase() : "";
      if ((event.ctrlKey || event.metaKey) && key === "c") {
        event.preventDefault();
      }
    });

    loadDatText();
  </script>
</body>
</html>