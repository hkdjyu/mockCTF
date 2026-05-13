<?php
$users = [
    ['username' => 'student', 'password' => '12345678', 'role' => 'student'],
    ['username' => 'guest', 'password' => 'welcome123', 'role' => 'guest'],
    ['username' => 'admin', 'password' => 'super-secret-admin-password', 'role' => 'admin'],
];

function normalizeInput(string $value): string
{
    $value = strtolower(trim($value));
    $value = preg_replace('/--.*/', '', $value);
    $value = str_replace(['#', '/*', '*/'], '', $value);

    return $value;
}

function containsText(string $haystack, string $needle): bool
{
    return strpos($haystack, $needle) !== false;
}

function looksLikeTautology(string $value): bool
{
    $normalized = normalizeInput($value);

    return containsText($normalized, "' or 1=1")
      || containsText($normalized, '" or 1=1')
      || containsText($normalized, "' or '1'='1")
      || containsText($normalized, '" or "1"="1')
      || containsText($normalized, "or 'a'='a")
      || containsText($normalized, 'or "a"="a');
}

function findUser(array $users, string $username, string $password): ?array
{
    foreach ($users as $user) {
        if ($user['username'] === $username && $user['password'] === $password) {
            return $user;
        }
    }

    return null;
}

$submittedUsername = '';
$submittedPassword = '';
$queryPreview = "SELECT * FROM users WHERE username = '' AND password = '' LIMIT 1;";
$message = '提示：老師說只要成功以 admin 身分登入，就可以看到旗標。';
$messageClass = 'hint';
$loginResult = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $submittedUsername = isset($_POST['username']) ? trim((string) $_POST['username']) : '';
    $submittedPassword = isset($_POST['password']) ? trim((string) $_POST['password']) : '';

    $queryPreview = sprintf(
        "SELECT * FROM users WHERE username = '%s' AND password = '%s' LIMIT 1;",
        $submittedUsername,
        $submittedPassword
    );

    if (looksLikeTautology($submittedUsername) || looksLikeTautology($submittedPassword)) {
        $loginResult = ['username' => 'admin', 'role' => 'admin'];
        $message = '登入成功。系統誤以為你是 admin。';
        $messageClass = 'success';
    } else {
        $loginResult = findUser($users, $submittedUsername, $submittedPassword);

        if ($loginResult !== null) {
            $message = '登入成功，但目前不是 admin 權限。';
            $messageClass = 'notice';
        } else {
            $message = '帳號或密碼錯誤。注意觀察查詢語句的組成方式。';
            $messageClass = 'error';
        }
    }
}

$flag = 'flag{sqli_login_bypass}';
?><!DOCTYPE html>
<html lang="zh-HK">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Web-41 SQL Injection Login</title>
  <style>
    :root {
      --bg: #f4efe8;
      --panel: #fffdf9;
      --soft: #f8f2ea;
      --text: #2d241c;
      --muted: #6d5d4d;
      --accent: #9b5b2e;
      --accent-soft: #f0dfd1;
      --border: #e3d3c4;
      --shadow: 0 18px 40px rgba(82, 51, 28, 0.14);
      --success: #276749;
      --error: #b83232;
      --notice: #946200;
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
        radial-gradient(circle at top right, #fff6ec 0, #fff6ec 12%, transparent 13%),
        linear-gradient(180deg, #fbf8f3 0%, var(--bg) 100%);
    }

    .page {
      max-width: 1080px;
      margin: 0 auto;
      padding: 28px 16px 40px;
    }

    .hero,
    .panel {
      background: var(--panel);
      border: 1px solid var(--border);
      border-radius: 24px;
      box-shadow: var(--shadow);
    }

    .hero {
      padding: 28px;
      margin-bottom: 22px;
    }

    h1,
    h2 {
      margin-top: 0;
      line-height: 1.15;
    }

    h1 {
      margin-bottom: 10px;
      font-size: clamp(2rem, 4vw, 3rem);
    }

    p {
      line-height: 1.7;
    }

    .subtitle {
      margin: 0;
      color: var(--muted);
      font-size: 1.03rem;
    }

    .grid {
      display: grid;
      grid-template-columns: minmax(0, 1.15fr) minmax(320px, 0.85fr);
      gap: 22px;
    }

    .panel {
      padding: 22px;
    }

    .query-box,
    .flag-box,
    .tip-box {
      border-radius: 18px;
      padding: 16px;
    }

    .query-box {
      background: #241d17;
      color: #f8efe4;
      font-family: Consolas, "Courier New", monospace;
      overflow-x: auto;
    }

    .flag-box {
      margin-top: 16px;
      background: #eff8f1;
      border: 1px solid #bfdcca;
      color: var(--success);
      font-weight: 700;
    }

    .tip-box {
      background: var(--soft);
      border: 1px solid var(--border);
      color: var(--muted);
    }

    .status {
      margin: 16px 0;
      border-radius: 16px;
      padding: 14px 16px;
      font-weight: 600;
    }

    .status.hint {
      background: #f5efe6;
      color: var(--muted);
    }

    .status.success {
      background: #eef9f0;
      color: var(--success);
      border: 1px solid #c7e5cf;
    }

    .status.error {
      background: #fff1f1;
      color: var(--error);
      border: 1px solid #f1c0c0;
    }

    .status.notice {
      background: #fff7de;
      color: var(--notice);
      border: 1px solid #ebd28a;
    }

    form {
      display: grid;
      gap: 14px;
    }

    label {
      display: grid;
      gap: 6px;
      font-weight: 700;
    }

    input {
      width: 100%;
      border: 1px solid #d5c3b4;
      border-radius: 14px;
      padding: 12px 14px;
      font-size: 1rem;
      background: #fff;
      color: var(--text);
    }

    button {
      border: 0;
      border-radius: 14px;
      padding: 12px 16px;
      background: var(--accent);
      color: #fff;
      font-size: 1rem;
      font-weight: 700;
      cursor: pointer;
    }

    ul {
      margin: 0;
      padding-left: 20px;
      color: var(--muted);
      line-height: 1.7;
    }

    code {
      font-family: Consolas, "Courier New", monospace;
    }

    @media (max-width: 840px) {
      .grid {
        grid-template-columns: 1fr;
      }

      .hero,
      .panel {
        padding: 18px;
      }
    }
  </style>
</head>
<body>
  <main class="page">
    <section class="hero">
      <h1>Student Portal Login</h1>
      <p class="subtitle">校內圖書館系統剛升級，但老師懷疑登入頁直接把你輸入的內容串進 SQL。請想辦法以 <strong>admin</strong> 身分登入並取出旗標。</p>
    </section>

    <section class="grid">
      <article class="panel">
        <h2>登入測試</h2>
        <form method="post" action="">
          <label>
            Username
            <input type="text" name="username" value="<?= htmlspecialchars($submittedUsername, ENT_QUOTES, 'UTF-8') ?>" autocomplete="off">
          </label>

          <label>
            Password
            <input type="text" name="password" value="<?= htmlspecialchars($submittedPassword, ENT_QUOTES, 'UTF-8') ?>" autocomplete="off">
          </label>

          <button type="submit">Login</button>
        </form>

        <div class="status <?= htmlspecialchars($messageClass, ENT_QUOTES, 'UTF-8') ?>">
          <?= htmlspecialchars($message, ENT_QUOTES, 'UTF-8') ?>
        </div>

        <?php if ($loginResult !== null && $loginResult['role'] === 'admin'): ?>
          <div class="flag-box">
            Admin panel unlocked: <?= htmlspecialchars($flag, ENT_QUOTES, 'UTF-8') ?>
          </div>
        <?php endif; ?>
      </article>

      <aside class="panel">
        <h2>開發者備忘</h2>
        <div class="query-box"><?= htmlspecialchars($queryPreview, ENT_QUOTES, 'UTF-8') ?></div>
        <div class="tip-box" style="margin-top: 16px;">
          <p><strong>Hint 1:</strong> 如果輸入內容直接進入查詢語句，單引號、邏輯運算子與註解可能會改變原本的判斷。</p>
          <p><strong>Hint 2:</strong> 不一定要知道真正密碼；想一想怎樣令條件永遠成立。</p>
        </div>

        <h2 style="margin-top: 18px;">觀察重點</h2>
        <ul>
          <li>系統會把你輸入的值直接放進 <code>WHERE</code> 子句。</li>
          <li>目標不是登入任何帳號。</li>
        </ul>
      </aside>
    </section>
  </main>
</body>
</html>

