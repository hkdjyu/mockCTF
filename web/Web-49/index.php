<?php
// ==========================================
// CTF Level 2: 結構探勘 (Schema Recon)
// 學習目標：從 sqlite_master 系統表中挖出未知的資料表與欄位名稱
// ==========================================

$dbPath = __DIR__ . '/level2.sqlite';
$pdo = new PDO('sqlite:' . $dbPath);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// 1. 初始化學生表 (Level 2 簡化為 2 個欄位，對應教學文件)
$pdo->exec("CREATE TABLE IF NOT EXISTS students (sid TEXT PRIMARY KEY, name TEXT)");

// 2. 初始化機密表 (刻意使用亂數命名，強迫學生去查表)
$pdo->exec("CREATE TABLE IF NOT EXISTS secret_vault_8a9b (id INTEGER PRIMARY KEY, hidden_flag_val TEXT)");

// 3. 填充假資料
$stmt = $pdo->query("SELECT COUNT(*) FROM students");
if ($stmt->fetchColumn() == 0) {
    $pdo->exec("INSERT INTO students (sid, name) VALUES ('s26001', 'Alice')");
    $pdo->exec("INSERT INTO students (sid, name) VALUES ('s26002', 'Bob')");
}

$stmt = $pdo->query("SELECT COUNT(*) FROM secret_vault_8a9b");
if ($stmt->fetchColumn() == 0) {
    $pdo->exec("INSERT INTO secret_vault_8a9b (hidden_flag_val) VALUES ('flag{L3v3l_2_m4st3r_0f_sch3m4}')");
}

$sid = $_GET['sid'] ?? null;
$result = '';

if ($sid !== null) {
    // 【漏洞點】字串拼接 SQL Injection
    $query = "SELECT * FROM students WHERE sid = '$sid'";
    
    // For debugging/teaching, show the exact query being executed
    // echo "<div style='background: #eee; padding: 10px; margin-bottom: 20px;'><strong>Executed query:</strong> " . htmlspecialchars($query) . "</div>";

    try {
        $stmt = $pdo->query($query);
        
        if ($stmt) {
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
            if ($results) {
                $result = "<h2>查詢結果:</h2><ul>";
                foreach ($results as $row) {
                    // Level 2 只有兩個欄位
                    $result .= "<li><strong>SID:</strong> " . htmlspecialchars($row['sid'] ?? '') . 
                               " - <strong>Name:</strong> " . htmlspecialchars($row['name'] ?? '') . "</li>";
                }
                $result .= "</ul>";
            } else {
                $result = "<div style='color: black;'><strong>查無此人</strong></div>";
            }
        }
    } catch (PDOException $e) {
        $result = "<div style='color: red;'><strong>Database Error:</strong> " . htmlspecialchars($e->getMessage()) . "</div>";
    }
}
?>

<!doctype html>
<html lang="zh-TW">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Web-49 欄離難捨</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      margin: 20px;
      max-width: 800px;
      line-height: 1.6;
    }
    .hint-box { background: #fffbeb; border: 1px solid #fde68a; padding: 15px; border-radius: 5px; margin-bottom: 20px; }
    input[type="text"] {
      padding: 5px;
      width: 300px;
      font-size: 16px;
    }
    button {
      padding: 5px 10px;
      font-size: 16px;
      cursor: pointer;
    }
    #result {
      margin-top: 20px;
      padding: 10px;
      background-color: #f9f9f9;
      border: 1px solid #ddd;
    }
  </style>
</head>
<body>
  <h1>🟡 Web-49 欄離難捨</h1>
  <div class="hint-box">
    <strong>【情報】</strong><br>
    網頁固定為 <strong>2 個欄位</strong>。但是 Flag 被藏在一個檔名充滿亂碼的資料表裡面，欄位名稱我們也不知道。<br>
    請利用 SQLite 的系統目錄 <code>sqlite_master</code> 找出表名與欄位名，再把 Flag 偷出來。
  </div>
  
  <h2>查詢同學資料</h2>
  <input type="text" id="studentId" placeholder="輸入學生編號 (例如: s26001)">
  <button onclick="queryStudent()">查詢</button>
  <div id="result"> <?php echo $result; ?></div>
  
  <script>
    function queryStudent() {
      const studentId = document.getElementById('studentId').value;
      window.location.href = `?sid=${encodeURIComponent(studentId)}`;
    }
  </script>
</body>
</html>