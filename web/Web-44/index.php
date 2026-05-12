<?php
$seedInvoices = [
    ['id' => 1001, 'order_no' => 'PUB-1001', 'owner' => 'student', 'amount' => 280, 'is_internal' => 0],
    ['id' => 1002, 'order_no' => 'PUB-1002', 'owner' => 'guest', 'amount' => 160, 'is_internal' => 0],
    ['id' => 9001, 'order_no' => 'INT-9001', 'owner' => 'admin', 'amount' => 99999, 'is_internal' => 1],
    ['id' => 2653, 'order_no' => 'INT-2653', 'owner' => 'student', 'amount' => 1234, 'is_internal' => 1],
];

function buildInvoiceDb(array $rows): SQLite3
{
    $db = new SQLite3(':memory:');
    $db->exec('CREATE TABLE invoices (id INTEGER, order_no TEXT, owner TEXT, amount INTEGER, is_internal INTEGER)');
    $stmt = $db->prepare('INSERT INTO invoices (id, order_no, owner, amount, is_internal) VALUES (:id, :order_no, :owner, :amount, :is_internal)');
    foreach ($rows as $row) {
        $stmt->bindValue(':id', (int) $row['id'], SQLITE3_INTEGER);
        $stmt->bindValue(':order_no', $row['order_no'], SQLITE3_TEXT);
        $stmt->bindValue(':owner', $row['owner'], SQLITE3_TEXT);
        $stmt->bindValue(':amount', (int) $row['amount'], SQLITE3_INTEGER);
        $stmt->bindValue(':is_internal', (int) $row['is_internal'], SQLITE3_INTEGER);
        $stmt->execute();
    }

    return $db;
}

$submittedId = '';
$queryPreview = 'SELECT id, order_no, owner, amount, is_internal FROM invoices WHERE id = 0 AND is_internal = 0;';
$message = '提示：系統有黑名單阻擋 `OR 1=1`，但不是完整防護。';
$messageClass = 'hint';
$sqlError = '';
$resultRows = [];
$hasInternalRow = false;
$flag = 'flag{inline_comment_blacklist_bypass}';

if (!class_exists('SQLite3')) {
    $message = '伺服器未啟用 SQLite3 擴充，無法執行此題。';
    $messageClass = 'error';
} elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $submittedId = isset($_POST['invoice_id']) ? trim((string) $_POST['invoice_id']) : '';
    $idExpr = $submittedId === '' ? '0' : $submittedId;

    $queryPreview = sprintf(
        'SELECT id, order_no, owner, amount, is_internal FROM invoices WHERE id = %s AND is_internal = 0;',
        $idExpr
    );

    if (preg_match('/\bor\s+1\s*=\s*1\b/i', $submittedId) === 1) {
        $message = 'WAF：偵測到關鍵字 `OR 1=1`，請求已被阻擋。';
        $messageClass = 'error';
    } else {
        $db = buildInvoiceDb($seedInvoices);
        $result = @$db->query($queryPreview);

        if ($result === false) {
            $sqlError = $db->lastErrorMsg();
            $message = 'SQL 執行錯誤，請調整語法。';
            $messageClass = 'error';
        } else {
          while (($row = $result->fetchArray(SQLITE3_ASSOC)) !== false) {
            $resultRows[] = $row;
            if ((int) $row['is_internal'] === 1) {
              $hasInternalRow = true;
            }
          }

          if (count($resultRows) > 0) {
            if ($hasInternalRow) {
              $message = '查詢到了內部帳單，權限邏輯已被繞過。';
              $messageClass = 'success';
            } else {
              $message = '查詢成功，但仍是公開資料。';
              $messageClass = 'notice';
            }
            } else {
                $message = '查無資料，試著思考如何使用 inline comment 改寫條件。';
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
  <title>Web-44 Inline Comment SQL Injection</title>
  <style>
    :root {
      --bg: #eef4f8;
      --panel: #ffffff;
      --text: #1f2933;
      --muted: #5a6773;
      --border: #d6e0e8;
      --accent: #275d8b;
      --ok: #1f6b42;
      --warn: #8e6500;
      --bad: #a93232;
    }
    * { box-sizing: border-box; }
    body {
      margin: 0;
      min-height: 100vh;
      font-family: "Segoe UI", "Microsoft JhengHei", sans-serif;
      color: var(--text);
      background: linear-gradient(180deg, #f9fcff 0%, var(--bg) 100%);
    }
    .page { max-width: 1020px; margin: 0 auto; padding: 26px 16px 40px; }
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
      background: linear-gradient(120deg, #24537b, #3270a5);
      cursor: pointer;
    }
    .status {
      margin-top: 12px;
      border: 1px solid var(--border);
      border-radius: 10px;
      background: #eef4f9;
      padding: 10px 12px;
      line-height: 1.55;
    }
    .status.success { border-color: #b9dcc8; background: #eaf8f1; color: var(--ok); }
    .status.notice { border-color: #e3d5ab; background: #fbf6e8; color: var(--warn); }
    .status.error { border-color: #edc6c6; background: #fff0f0; color: var(--bad); }
    .query {
      margin: 0;
      background: #0f1720;
      color: #d7e2ec;
      border-radius: 10px;
      padding: 11px;
      line-height: 1.6;
      white-space: pre-wrap;
      word-break: break-word;
    }
    .result {
      margin-top: 10px;
      border: 1px solid var(--border);
      border-radius: 10px;
      background: #f7fbff;
      padding: 10px 12px;
      line-height: 1.6;
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
    code { background: #eaf1f7; border: 1px solid #d4e1eb; border-radius: 6px; padding: 1px 5px; }
    @media (max-width: 860px) { .grid { grid-template-columns: 1fr; } }
  </style>
</head>
<body>
  <main class="page">
    <section class="hero">
      <h1>Web-44：Inline Comment 與黑名單繞過</h1>
      <p>報表系統用黑名單擋 `OR 1=1`，但仍把 `invoice_id` 直接拼進 SQL。請讀出內部帳單（`is_internal = 1`）並取得旗標。</p>
    </section>

    <section class="grid">
      <article class="panel">
        <h2>查詢單據</h2>
        <form method="post" action="">
          <label for="invoice_id">Invoice ID</label>
          <input id="invoice_id" type="text" name="invoice_id" value="<?= htmlspecialchars($submittedId, ENT_QUOTES, 'UTF-8') ?>" autocomplete="off">
          <button type="submit">Search</button>
        </form>

        <div class="status <?= htmlspecialchars($messageClass, ENT_QUOTES, 'UTF-8') ?>">
          <?= htmlspecialchars($message, ENT_QUOTES, 'UTF-8') ?>
        </div>

        <?php if ($sqlError !== ''): ?>
          <div class="status error" style="margin-top: 10px;">SQL Error: <?= htmlspecialchars($sqlError, ENT_QUOTES, 'UTF-8') ?></div>
        <?php endif; ?>

        <?php if (count($resultRows) > 0): ?>
          <div class="result">
            <?php foreach ($resultRows as $row): ?>
              id: <?= htmlspecialchars((string) $row['id'], ENT_QUOTES, 'UTF-8') ?><br>
              order_no: <?= htmlspecialchars($row['order_no'], ENT_QUOTES, 'UTF-8') ?><br>
              owner: <?= htmlspecialchars($row['owner'], ENT_QUOTES, 'UTF-8') ?><br>
              amount: <?= htmlspecialchars((string) $row['amount'], ENT_QUOTES, 'UTF-8') ?><br>
              is_internal: <?= htmlspecialchars((string) $row['is_internal'], ENT_QUOTES, 'UTF-8') ?><br>
              <hr style="border: 0; border-top: 1px solid #d6e0e8; margin: 8px 0;">
            <?php endforeach; ?>
          </div>
        <?php endif; ?>

        <?php if ($hasInternalRow): ?>
          <div class="flag">Internal record exposed: <?= htmlspecialchars($flag, ENT_QUOTES, 'UTF-8') ?></div>
        <?php endif; ?>
      </article>

      <aside class="panel">
        <h2>查詢預覽</h2>
        <p class="query"><?= htmlspecialchars($queryPreview, ENT_QUOTES, 'UTF-8') ?></p>

        <h2 style="margin-top: 14px;">提示</h2>
        <ul>
          <li>黑名單只擋固定字串，未必能擋住語義相同的寫法。</li>
          <li>試試用 inline comment（`/* ... */`）重排條件。</li>
          <li>重點是越權讀到 `is_internal = 1` 的資料。</li>
        </ul>
      </aside>
    </section>
  </main>
</body>
</html>

