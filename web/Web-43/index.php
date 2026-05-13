<?php
$seedUsers = [
    ['username' => 'student', 'password' => 'welcome2026', 'role' => 'student'],
    ['username' => 'admin', 'password' => 'N0tForStudents', 'role' => 'admin'],
    ['username' => 'teacher', 'password' => 'faculty123', 'role' => 'staff'],
];

function buildDb($users)
{
    $db = new SQLite3(':memory:');
    $db->exec('CREATE TABLE members (username TEXT, password TEXT, role TEXT)');

    $stmt = $db->prepare('INSERT INTO members (username, password, role) VALUES (:username, :password, :role)');
    foreach ($users as $user) {
        $stmt->bindValue(':username', $user['username'], SQLITE3_TEXT);
        $stmt->bindValue(':password', $user['password'], SQLITE3_TEXT);
        $stmt->bindValue(':role', $user['role'], SQLITE3_TEXT);
        $stmt->execute();
    }

    return $db;
}

function preprocessMySqlStyleComments($sql)
{
    // 模擬 MySQL `#` 單行註解，方便教學比較不同資料庫語法。
    $processedSql = preg_replace('/#.*$/m', '', $sql);
    return ($processedSql !== null) ? $processedSql : $sql;
}

$submittedUsername = '';
$submittedPassword = '';
$queryPreview = 'SELECT username, role FROM members WHERE username = "" AND password = "" LIMIT 1;';
$message = '提示：開發者把輸入直接串進 SQL，觀察行尾註解對查詢的影響。';
$messageClass = 'hint';
$loginResult = null;
$sqlError = '';
$flag = 'flag{line_comment_login_bypass}';

if (!class_exists('SQLite3')) {
    $message = '伺服器未啟用 SQLite3 擴充，無法執行此題。';
    $messageClass = 'error';
} elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $submittedUsername = isset($_POST['username']) ? trim((string) $_POST['username']) : '';
    $submittedPassword = isset($_POST['password']) ? trim((string) $_POST['password']) : '';

    $queryPreview = sprintf(
      'SELECT username, role FROM members WHERE username = "%s" AND password = "%s" LIMIT 1;',
        $submittedUsername,
        $submittedPassword
    );

    if (preg_match('/--/', $submittedUsername . $submittedPassword) === 1) {
        $message = '系統已阻擋 `--` 語法，請改用其他註解方式。';
        $messageClass = 'error';
    } else {
        $db = buildDb($seedUsers);
        $executionSql = preprocessMySqlStyleComments($queryPreview);
        $result = @$db->query($executionSql);

        if ($result === false) {
            $sqlError = $db->lastErrorMsg();
            $message = 'SQL 執行失敗，請檢查注入語法是否可被解析。';
            $messageClass = 'error';
        } else {
            $row = $result->fetchArray(SQLITE3_ASSOC);
            if ($row !== false) {
                $loginResult = $row;
                if ($row['role'] === 'admin') {
                    $message = '登入成功：你已取得 admin 權限。';
                    $messageClass = 'success';
                } else {
                    $message = '登入成功，但不是 admin。';
                    $messageClass = 'notice';
                }
            } else {
                $message = '登入失敗。試試看在注入後使用行尾註解截斷密碼條件。';
                $messageClass = 'error';
            }
        }

        $db->close();
    }
}
?><!DOCTYPE html>
<html lang="zh-HK">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Web-43 註釋？不了。</title>
  <style>
    :root {
      --bg: #f6efe9;
      --panel: #fffdfb;
      --text: #2f231a;
      --muted: #6f5a49;
      --accent: #8b4f22;
      --border: #e5d4c4;
      --ok: #246b46;
      --warn: #946200;
      --bad: #b23737;
    }
    * { box-sizing: border-box; }
    body {
      margin: 0;
      min-height: 100vh;
      font-family: "Segoe UI", "Microsoft JhengHei", sans-serif;
      color: var(--text);
      background: linear-gradient(180deg, #fbf7f2 0%, var(--bg) 100%);
    }
    .page { max-width: 1000px; margin: 0 auto; padding: 26px 16px 40px; }
    .hero, .panel {
      background: var(--panel);
      border: 1px solid var(--border);
      border-radius: 14px;
      padding: 18px;
    }
    .hero { margin-bottom: 14px; }
    .hero h1 { margin: 0 0 8px; }
    .hero p { margin: 0; color: var(--muted); line-height: 1.65; }
    .grid { display: grid; grid-template-columns: 1fr 1fr; gap: 14px; }
    h2 { margin: 0 0 12px; font-size: 1.08rem; }
    form { display: grid; gap: 10px; }
    label { display: grid; gap: 5px; font-weight: 600; }
    input {
      width: 100%;
      border: 1px solid var(--border);
      border-radius: 9px;
      padding: 9px 11px;
      font-size: 1rem;
    }
    button {
      border: 0;
      border-radius: 9px;
      padding: 10px 12px;
      font-weight: 700;
      color: #fff;
      background: linear-gradient(120deg, #7f451d, #9e6339);
      cursor: pointer;
    }
    .status {
      margin-top: 12px;
      border: 1px solid var(--border);
      border-radius: 10px;
      background: #f8f2eb;
      padding: 10px 12px;
      line-height: 1.55;
    }
    .status.success { border-color: #b9dcc8; background: #eaf8f1; color: var(--ok); }
    .status.notice { border-color: #e4d4a9; background: #fbf5e4; color: var(--warn); }
    .status.error { border-color: #edc6c6; background: #fff0f0; color: var(--bad); }
    .flag {
      margin-top: 10px;
      border: 1px solid #b9dcc8;
      border-radius: 10px;
      background: #eaf8f1;
      color: var(--ok);
      font-weight: 700;
      padding: 10px 12px;
    }
    .query {
      margin: 0;
      background: #131110;
      color: #e7ddd5;
      border-radius: 10px;
      padding: 11px;
      line-height: 1.6;
      white-space: pre-wrap;
      word-break: break-word;
    }
    ul { margin: 12px 0 0; padding-left: 20px; color: var(--muted); line-height: 1.65; }
    code { background: #f3e9df; border: 1px solid #e5d4c4; border-radius: 6px; padding: 1px 5px; }
    @media (max-width: 860px) { .grid { grid-template-columns: 1fr; } }
  </style>
</head>
<body>
  <main class="page">
    <section class="hero">
      <h1>Web-43：行尾註解繞過登入</h1>
      <p>目標是在未知密碼下登入 admin。請觀察 username 輸入如何改寫 SQL，並利用行尾註解忽略後半段密碼條件。</p>
    </section>

    <section class="grid">
      <article class="panel">
        <h2>登入區</h2>
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

        <?php if ($sqlError !== ''): ?>
          <div class="status error" style="margin-top: 10px;">
            SQL Error: <?= htmlspecialchars($sqlError, ENT_QUOTES, 'UTF-8') ?>
          </div>
        <?php endif; ?>

        <?php if ($loginResult !== null && $loginResult['role'] === 'admin'): ?>
          <div class="flag">Admin panel unlocked: <?= htmlspecialchars($flag, ENT_QUOTES, 'UTF-8') ?></div>
        <?php endif; ?>
      </article>

      <aside class="panel">
        <h2>查詢預覽</h2>
        <p class="query"><?= htmlspecialchars($queryPreview, ENT_QUOTES, 'UTF-8') ?></p>

        <h2 style="margin-top: 14px;">提示</h2>
        <ul>
          <li>行尾註解可以讓後半段條件失效，例如密碼驗證。</li>
          <li>雖然<code>--</code>很常見，但有些資料庫不支援這種註解語法。</li>
          <li>重點是看懂查詢怎樣被改寫，不是猜密碼。</li>
        </ul>
      </aside>
    </section>
  </main>
</body>
</html>

