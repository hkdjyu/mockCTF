<?php
// ==========================================
// Web-48: 團結一致
// 學習目標：測試欄位數量 (ORDER BY)、尋找回顯點 (UNION SELECT)
// ==========================================

$dbPath = __DIR__ . '/level1.sqlite';
$pdo = new PDO('sqlite:' . $dbPath);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// 1. 初始化學生表 (刻意設計 3 個欄位，讓學生練習測出 3)
$pdo->exec("CREATE TABLE IF NOT EXISTS students (sid TEXT PRIMARY KEY, name TEXT, department TEXT)");

// 2. 初始化機密表 (表名與欄位名已在教學中公開)
$pdo->exec("CREATE TABLE IF NOT EXISTS level1_flag (id INTEGER PRIMARY KEY, flag_text TEXT)");

// 3. 填充假資料
$stmt = $pdo->query("SELECT COUNT(*) FROM students");
if ($stmt->fetchColumn() == 0) {
    $pdo->exec("INSERT INTO students (sid, name, department) VALUES ('s26001', 'Alice', '資工系')");
    $pdo->exec("INSERT INTO students (sid, name, department) VALUES ('s26002', 'Bob', '電機系')");
    $pdo->exec("INSERT INTO students (sid, name, department) VALUES ('s26003', 'Charlie', '企管系')");
}

$stmt = $pdo->query("SELECT COUNT(*) FROM level1_flag");
if ($stmt->fetchColumn() == 0) {
    $pdo->exec("INSERT INTO level1_flag (flag_text) VALUES ('flag{L3v3l_1_un10n_b4s1cs}')");
}

$sid = $_GET['sid'] ?? null;
$result = '';

if ($sid !== null) {
    // 【漏洞點】直接將使用者輸入拼接到 SQL 語句中
    $query = "SELECT * FROM students WHERE sid = '$sid'";
    
    // For debugging/teaching, show the exact query being executed (Commented out per your template)
    // echo "<div style='background: #eee; padding: 10px; margin-bottom: 20px;'><strong>Executed query:</strong> " . htmlspecialchars($query) . "</div>";

    try {
        $stmt = $pdo->query($query);
        
        if ($stmt) {
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
            if ($results) {
                $result = "<h2>查詢結果:</h2><ul>";
                foreach ($results as $row) {
                    // Level 1 有三個欄位
                    $result .= "<li><strong>SID:</strong> " . htmlspecialchars($row['sid'] ?? '') . 
                               " - <strong>Name:</strong> " . htmlspecialchars($row['name'] ?? '') . 
                               " - <strong>Department:</strong> " . htmlspecialchars($row['department'] ?? '') . "</li>";
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
  <title>Web-48 團結一致</title>
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
  <h1>🟢 Web-48 團結一致</h1>
  <div class="hint-box">
    <strong>【情報】</strong><br>
    我們知道系統內有一張表叫做 <code>level1_flag</code>，裡面有一個欄位 <code>flag_text</code>。<br>
    請找出網頁查詢的欄位數量，並用 <code>UNION</code> 將 Flag 查詢出來。
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