<?php
function buildEmployeeDb(): SQLite3
{
  $db = new SQLite3(':memory:');
  $db->exec('CREATE TABLE employees (id INTEGER, employee_id TEXT, name TEXT, dept TEXT, title TEXT, authorized INTEGER)');
  $stmt = $db->prepare('INSERT INTO employees (id, employee_id, name, dept, title, authorized) VALUES (:id, :employee_id, :name, :dept, :title, :authorized)');

  $data = [
    [1, 'E1024', 'Chan Wing', 'IT', 'Support Engineer', 0],
    [2, 'E3042', 'Lee Ka Ming', 'IT', 'System Analyst', 0],
    [3, 'E9001', 'Admin Account', 'Security', 'Director', 1],
  ];

  foreach ($data as $row) {
    $stmt->bindValue(':id', (int) $row[0], SQLITE3_INTEGER);
    $stmt->bindValue(':employee_id', $row[1], SQLITE3_TEXT);
    $stmt->bindValue(':name', $row[2], SQLITE3_TEXT);
    $stmt->bindValue(':dept', $row[3], SQLITE3_TEXT);
    $stmt->bindValue(':title', $row[4], SQLITE3_TEXT);
    $stmt->bindValue(':authorized', (int) $row[5], SQLITE3_INTEGER);
    $stmt->execute();
  }

  return $db;
}

$submittedEmployeeId = '';
$queryPreview = "SELECT employee_id, name, dept, title FROM employees WHERE authorized = 0 AND employee_id = 'E1024';";
$message = '請輸入員工id查詢資料。';
$messageClass = 'hint';
$resultRow = null;
$flag = 'flag{inline_comment_condition_bypass}';

if (!class_exists('SQLite3')) {
  $message = '伺服器未啟用 SQLite3 擴充，無法執行此題。';
  $messageClass = 'error';
} elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $submittedEmployeeId = isset($_POST['employee_id']) ? trim((string) $_POST['employee_id']) : '';
  $employeeId = $submittedEmployeeId === '' ? 'E1024' : $submittedEmployeeId;
  $requestedEmployeeId = null;

  if (preg_match('/^([A-Z]\d{4})/i', $employeeId, $matches) === 1) {
    $requestedEmployeeId = strtoupper($matches[1]);
  }

  // 模擬常見但脆弱的黑名單：只擋「空白 + OR + 空白」，可被 /**/ 繞過。
  if (preg_match('/\sor\s/i', $employeeId) === 1) {
    $message = '員工id錯誤或權限不足';
    $messageClass = 'error';
  } else {
    $queryPreview = sprintf(
      "SELECT employee_id, name, dept, title FROM employees WHERE authorized = 0 AND employee_id = '%s';",
      $employeeId
    );

    $db = buildEmployeeDb();
    $result = @$db->query($queryPreview);

    if ($result !== false) {
      $matchedRequestedRow = null;

      while (($row = $result->fetchArray(SQLITE3_ASSOC)) !== false) {
        if ($requestedEmployeeId !== null && strtoupper($row['employee_id']) === $requestedEmployeeId) {
          $matchedRequestedRow = $row;
          break;
        }
      }

      if ($matchedRequestedRow !== null) {
        $resultRow = $matchedRequestedRow;
        if ($matchedRequestedRow['employee_id'] === 'E9001') {
          $message = '成功繞過限制，已讀取高權限員工資料。';
          $messageClass = 'success';
        } else {
          $message = '查詢成功。';
          $messageClass = 'notice';
        }
      } else {
        $message = '員工id錯誤或權限不足';
        $messageClass = 'error';
      }
    } else {
      $message = '員工id錯誤或權限不足';
      $messageClass = 'error';
    }

    $db->close();
  }
}
?>
<!DOCTYPE html>
<html lang="zh-HK">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Web-45 Employee ID Inline Comment Bypass</title>
  <style>
    :root {
      --bg: #eff6f2;
      --panel: #ffffff;
      --text: #1e2a22;
      --muted: #5b6a61;
      --border: #d4e3d9;
      --accent: #2c6a49;
      --ok: #1f6b42;
      --warn: #8f6500;
      --bad: #a93434;
    }
    * { box-sizing: border-box; }
    body {
      margin: 0;
      min-height: 100vh;
      font-family: "Segoe UI", "Microsoft JhengHei", sans-serif;
      color: var(--text);
      background: linear-gradient(180deg, #f9fcfa 0%, var(--bg) 100%);
    }
    .page { max-width: 1040px; margin: 0 auto; padding: 26px 16px 40px; }
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
    .meta {
      margin: 10px 0 0;
      border: 1px solid var(--border);
      border-radius: 10px;
      background: #f3f9f5;
      padding: 10px 12px;
      line-height: 1.6;
    }
    form { display: grid; gap: 10px; }
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
      background: linear-gradient(120deg, #245a3d, #2f7650);
      cursor: pointer;
    }
    .status {
      margin-top: 12px;
      border: 1px solid var(--border);
      border-radius: 10px;
      background: #edf5f0;
      padding: 10px 12px;
      line-height: 1.55;
    }
    .status.success { border-color: #b9dcc8; background: #eaf8f1; color: var(--ok); }
    .status.notice { border-color: #e4d5aa; background: #fbf6e8; color: var(--warn); }
    .status.error { border-color: #edc6c6; background: #fff0f0; color: var(--bad); }
    .query {
      margin: 0;
      background: #101913;
      color: #d8e8df;
      border-radius: 10px;
      padding: 11px;
      line-height: 1.6;
      white-space: pre-wrap;
      word-break: break-word;
    }
    .flag {
      margin-top: 10px;
      border: 1px solid #b9dcc8;
      border-radius: 10px;
      background: #eaf8f1;
      color: var(--ok);
      font-weight: 700;
      padding: 10px 12px;
    }
    ul { margin: 12px 0 0; padding-left: 20px; color: var(--muted); line-height: 1.65; }
    code { background: #eaf4ee; border: 1px solid #d3e4da; border-radius: 6px; padding: 1px 5px; }
    @media (max-width: 860px) { .grid { grid-template-columns: 1fr; } }
  </style>
</head>
<body>
  <main class="page">
    <section class="hero">
      <h1>Web-45：員工資料查詢繞過</h1>
      <p>在未經授權的情況下，查詢員工id=<code>E9001</code>的資料。</p>
    </section>

    <section class="grid">
      <article class="panel">
        <h2>員工資料查詢</h2>
        <form method="post" action="">
          <label for="employee_id">員工id</label>
          <input id="employee_id" type="text" name="employee_id" value="<?= htmlspecialchars($submittedEmployeeId, ENT_QUOTES, 'UTF-8') ?>" placeholder="例如：E1024" autocomplete="off">
          <button type="submit">查詢</button>
        </form>

        <div class="status <?= htmlspecialchars($messageClass, ENT_QUOTES, 'UTF-8') ?>">
          <?= htmlspecialchars($message, ENT_QUOTES, 'UTF-8') ?>
        </div>

        <?php if ($resultRow !== null): ?>
          <div class="status notice" style="margin-top: 10px;">
            員工id: <?= htmlspecialchars($resultRow['employee_id'], ENT_QUOTES, 'UTF-8') ?><br>
            姓名: <?= htmlspecialchars($resultRow['name'], ENT_QUOTES, 'UTF-8') ?><br>
            部門: <?= htmlspecialchars($resultRow['dept'], ENT_QUOTES, 'UTF-8') ?><br>
            職位: <?= htmlspecialchars($resultRow['title'], ENT_QUOTES, 'UTF-8') ?>
          </div>
        <?php endif; ?>

        <?php if ($resultRow !== null && $resultRow['employee_id'] === 'E9001'): ?>
          <div class="flag">Privileged employee unlocked: <?= htmlspecialchars($flag, ENT_QUOTES, 'UTF-8') ?></div>
        <?php endif; ?>
      </article>

      <aside class="panel">
        <h2>查詢預覽</h2>
        <p class="query"><?= htmlspecialchars($queryPreview, ENT_QUOTES, 'UTF-8') ?></p>

        <h2 style="margin-top: 14px;">提示</h2>
        <ul>
          <li>預設只允許 `authorized = 0` 的員工資料。</li>
          <li>直接輸入 `E9001' --` 仍會因前置授權條件失敗。</li>
          <li>系統只擋「空白 OR 空白」型態，對 inline comment 處理不完整。</li>
          <li>觀察 `/**/` 如何改變 token 邊界並繞過過濾。</li>
        </ul>
      </aside>
    </section>
  </main>
</body>
</html>

