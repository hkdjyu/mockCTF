  <?php
  $seedAccounts = [
    ['username' => 'guest1', 'pin' => 7391, 'role' => 'guest'],
    ['username' => 'admin', 'pin' => 7391, 'role' => 'admin'],
    ['username' => 'student', 'pin' => 3141, 'role' => 'student'],
    ['username' => 'guest2', 'pin' => 0, 'role' => 'guest'],
  ];

  function buildInMemoryDb($accounts)
  {
    $db = new SQLite3(':memory:');
    $db->exec('CREATE TABLE accounts (username TEXT, pin INTEGER, role TEXT)');

    $stmt = $db->prepare('INSERT INTO accounts (username, pin, role) VALUES (:username, :pin, :role)');
    foreach ($accounts as $account) {
      $stmt->bindValue(':username', $account['username'], SQLITE3_TEXT);
      $stmt->bindValue(':pin', (int) $account['pin'], SQLITE3_INTEGER);
      $stmt->bindValue(':role', $account['role'], SQLITE3_TEXT);
      $stmt->execute();
    }

    return $db;
  }

  $submittedUsername = '';
  $submittedPin = '';
  $queryPreview = "SELECT username, role FROM accounts WHERE username = '' AND pin = 0;";
  $message = '提示：此舊系統只對 username 做了簡單單引號轉義，但 pin 直接拼進 SQL。';
  $messageClass = 'hint';
  $loginResult = null;
  $flag = 'flag{numeric_pin_sqli_bypass}';
  $sqlError = '';

  if (!class_exists('SQLite3')) {
    $message = '伺服器未啟用 SQLite3 擴充，無法執行此練習。';
    $messageClass = 'error';
  } elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $submittedUsername = isset($_POST['username']) ? trim((string) $_POST['username']) : '';
    $submittedPin = isset($_POST['pin']) ? trim((string) $_POST['pin']) : '';

    $db = buildInMemoryDb($seedAccounts);

    // 模擬常見錯誤：只處理字串欄位，誤以為數值欄位必然安全。
    $usernameEscaped = str_replace("'", "''", $submittedUsername);
    $pinExpression = $submittedPin === '' ? '0' : $submittedPin;

    $queryPreview = sprintf(
      "SELECT username, role FROM accounts WHERE username = '%s' AND pin = %s;",
      $usernameEscaped,
      $pinExpression
    );

    $result = @$db->query($queryPreview);
    if ($result === false) {
      $sqlError = $db->lastErrorMsg();
      $message = 'SQL 執行失敗，請檢查輸入語法是否可被資料庫解析。';
      $messageClass = 'error';
    } else {
      $firstRow = null;
      $matchedUsernameRow = null;

      while (($row = $result->fetchArray(SQLITE3_ASSOC)) !== false) {
        if ($firstRow === null) {
          $firstRow = $row;
        }

        if (strcasecmp($row['username'], $submittedUsername) === 0) {
          $matchedUsernameRow = $row;
          break;
        }
      }

      if ($matchedUsernameRow !== null || $firstRow !== null) {
        // 現實系統常以使用者輸入帳號作為主體，優先取同名帳號資料。
        $loginResult = ($matchedUsernameRow !== null) ? $matchedUsernameRow : $firstRow;
        if ($loginResult['role'] === 'admin') {
          $message = '登入成功：系統將你識別為 admin。';
          $messageClass = 'success';
        } else {
          $message = '登入成功，但目前不是 admin 權限。';
          $messageClass = 'notice';
        }
      } else {
        $message = '登入失敗。觀察查詢預覽，找出哪個欄位仍可改寫邏輯。';
        $messageClass = 'error';
      }
    }

    $db->close();
  }
  ?><!DOCTYPE html>
  <html lang="zh-HK">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Web-42 舊系統登入與數值型 SQL Injection</title>
    <style>
      :root {
        --bg: #f3f6ef;
        --panel: #ffffff;
        --soft: #edf3e6;
        --text: #1f2a1d;
        --muted: #5a6858;
        --accent: #436632;
        --accent-soft: #dae9cc;
        --border: #d6e2cb;
        --shadow: 0 16px 36px rgba(32, 54, 23, 0.12);
        --ok: #1f6b42;
        --warn: #8f6500;
        --bad: #9e2f2f;
      }

      * {
        box-sizing: border-box;
      }

      body {
        margin: 0;
        min-height: 100vh;
        font-family: "Segoe UI", "Microsoft JhengHei", sans-serif;
        color: var(--text);
        background:
          radial-gradient(circle at 12% -8%, #ffffff 0%, #ffffff 22%, transparent 23%),
          linear-gradient(180deg, #f7fbf3 0%, var(--bg) 100%);
      }

      .page {
        max-width: 1040px;
        margin: 0 auto;
        padding: 28px 16px 40px;
      }

      .hero,
      .panel {
        background: var(--panel);
        border: 1px solid var(--border);
        border-radius: 16px;
        box-shadow: var(--shadow);
      }

      .hero {
        padding: 22px;
        margin-bottom: 18px;
      }

      .hero h1 {
        margin: 0 0 8px;
        font-size: clamp(1.45rem, 2.8vw, 2rem);
      }

      .hero p {
        margin: 0;
        color: var(--muted);
        line-height: 1.65;
      }

      .grid {
        display: grid;
        grid-template-columns: 1.08fr 0.92fr;
        gap: 16px;
      }

      .panel {
        padding: 20px;
      }

      h2 {
        margin: 0 0 14px;
        font-size: 1.12rem;
      }

      form {
        display: grid;
        gap: 12px;
      }

      label {
        display: grid;
        gap: 6px;
        font-weight: 600;
        font-size: 0.95rem;
      }

      input {
        width: 100%;
        border: 1px solid var(--border);
        border-radius: 10px;
        padding: 10px 12px;
        font-size: 1rem;
        background: #fff;
        color: var(--text);
      }

      input:focus {
        outline: none;
        border-color: var(--accent);
        box-shadow: 0 0 0 3px rgba(67, 102, 50, 0.18);
      }

      button {
        appearance: none;
        border: 0;
        border-radius: 10px;
        padding: 10px 14px;
        font-weight: 700;
        font-size: 1rem;
        color: #fff;
        background: linear-gradient(120deg, #3d5f2d, #597f43);
        cursor: pointer;
      }

      button:hover {
        filter: brightness(1.04);
      }

      .status {
        margin-top: 14px;
        border-radius: 10px;
        border: 1px solid var(--border);
        background: var(--soft);
        padding: 11px 12px;
        line-height: 1.55;
      }

      .status.success {
        border-color: #b8dbc6;
        background: #eaf8f1;
        color: var(--ok);
      }

      .status.notice {
        border-color: #dfd3a7;
        background: #fbf5e2;
        color: var(--warn);
      }

      .status.error {
        border-color: #ecc2c2;
        background: #feeeee;
        color: var(--bad);
      }

      .flag {
        margin-top: 12px;
        border-radius: 10px;
        border: 1px solid #b8dbc6;
        background: #eaf8f1;
        color: var(--ok);
        padding: 11px 12px;
        font-weight: 700;
        word-break: break-word;
      }

      .query {
        margin: 0;
        padding: 12px;
        background: #101411;
        border-radius: 10px;
        color: #dce8d8;
        font-size: 0.9rem;
        line-height: 1.6;
        white-space: pre-wrap;
        word-break: break-word;
      }

      ul {
        margin: 12px 0 0;
        padding-left: 20px;
        color: var(--muted);
        line-height: 1.65;
      }

      code {
        background: #eef4e7;
        border: 1px solid #d8e4ce;
        border-radius: 6px;
        padding: 1px 5px;
        font-family: Consolas, "Courier New", monospace;
        font-size: 0.9em;
      }

      @media (max-width: 860px) {
        .grid {
          grid-template-columns: 1fr;
        }

        .hero,
        .panel {
          padding: 16px;
        }
      }
    </style>
  </head>
  <body>
    <main class="page">
      <section class="hero">
        <h1>舊版財務登入系統</h1>
        <p>維護人員修補過 <strong>username</strong> 的單引號問題，但仍把 <strong>pin</strong> 直接拼進 SQL。請證明你可以在未知 PIN 下取得 admin 權限。</p>
      </section>

      <section class="grid">
        <article class="panel">
          <h2>登入測試</h2>
          <form method="post" action="">
            <label>
              使用者名稱
              <input type="text" name="username" value="<?= htmlspecialchars($submittedUsername, ENT_QUOTES, 'UTF-8') ?>" autocomplete="off">
            </label>

            <label>
              PIN
              <input type="text" name="pin" value="<?= htmlspecialchars($submittedPin, ENT_QUOTES, 'UTF-8') ?>" autocomplete="off">
            </label>

            <button type="submit">登入</button>
          </form>

          <div class="status <?= htmlspecialchars($messageClass, ENT_QUOTES, 'UTF-8') ?>">
            <?= htmlspecialchars($message, ENT_QUOTES, 'UTF-8') ?>
          </div>

          <?php if ($sqlError !== ''): ?>
            <div class="status error" style="margin-top: 10px;">
              SQL Error: <?= htmlspecialchars($sqlError, ENT_QUOTES, 'UTF-8') ?>
            </div>
          <?php endif; ?>

          <?php if ($loginResult !== null && $loginResult['role'] === 'admin'): ?>
            <div class="flag">
              已解鎖管理員保險庫：<?= htmlspecialchars($flag, ENT_QUOTES, 'UTF-8') ?>
            </div>
          <?php endif; ?>
        </article>

        <aside class="panel">
          <h2>後端查詢預覽</h2>
          <p class="query"><?= htmlspecialchars($queryPreview, ENT_QUOTES, 'UTF-8') ?></p>

          <h2 style="margin-top: 16px;">提示</h2>
          <ul>
            <li>此系統曾經修補過 `username`，但修補範圍不完整。</li>
            <li>`pin` 不是以參數化方式處理，而是直接拼接。</li>
            <li>想想 <code>AND</code> 與 <code>OR</code> 的優先順序如何影響最終條件。</li>
            <li>在現實系統中，這種漏洞通常出現在「趕時程的局部修補」。</li>
          </ul>
        </aside>
      </section>
    </main>
  </body>
  </html>

