<?php
// random data for seeding the demerits table
$names = ['Alice', 'Bob', 'Charlie', 'David', 'Eve', 'Frank', 'Grace', 'Heidi', 'Ivan', 'Judy', 'Karl', 'Leo', 'Mallory', 'Nina', 'Oscar', 'Peggy', 'Quentin', 'Rupert', 'Sybil', 'Trent', 'Uma', 'Victor', 'Walter', 'Xavier', 'Yvonne', 'Zara'];

// create a sqlite database and tables for demonstration if it doesn't exist
$dbPath = __DIR__ . '/students.sqlite';
$pdo = new PDO('sqlite:' . $dbPath);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// Initialize students table
$pdo->exec("CREATE TABLE IF NOT EXISTS students (sid TEXT PRIMARY KEY, name TEXT)");

// Initialize a secret flags table for the CTF challenge
$pdo->exec("CREATE TABLE IF NOT EXISTS secret_flags (id INTEGER PRIMARY KEY, flag_value TEXT)");

// Seed students data
$stmt = $pdo->query("SELECT COUNT(*) FROM students");
if ($stmt->fetchColumn() == 0) {
    $insertStmt = $pdo->prepare("INSERT INTO students (sid, name) VALUES (?, ?)");
    for ($i = 1; $i <= 26; $i++) {
        $sid = sprintf("s260%02d", $i);
        $name = $names[$i - 1];
        $insertStmt->execute([$sid, $name]);
    }
}

// Seed flag data
$stmt = $pdo->query("SELECT COUNT(*) FROM secret_flags");
if ($stmt->fetchColumn() == 0) {
    $pdo->exec("INSERT INTO secret_flags (flag_value) VALUES ('flag{un10n_sq1_1nj3ct10n_m4st3r}')");
}

// 1. Get the 'sid' parameter from the query string
$sid = $_GET['sid'] ?? null;

$result = '';

if ($sid) {
    // VULNERABILITY INTRODUCED HERE: String Concatenation instead of Prepared Statements
    $query = "SELECT * FROM students WHERE sid = '$sid'";
    // $query = 'SELECT * FROM students WHERE sid = "$sid"';
    // For debugging/teaching, show the exact query being executed
    // echo "<div style='background: #eee; padding: 10px; margin-bottom: 20px;'><strong>Executed query:</strong> " . htmlspecialchars($query) . "</div>";

    try {
        // 3. Execute the vulnerable query directly
        $stmt = $pdo->query($query);

        if ($stmt) {
            // 4. Fetch ALL results (important for UNION injections which append rows)
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
            if ($results) {
                // echo "<pre>" . json_encode($results, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE) . "</pre>";
                // put the result in the #result div instead of printing it directly
                // $result = "<pre>" . json_encode($results, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE) . "</pre>";
                // For better readability, format the results in a more user-friendly way
                $result = "<h2>查詢結果:</h2><ul>";
                foreach ($results as $row) {
                    $result .= "<li><strong>SID:</strong> " . htmlspecialchars($row['sid']) . " - <strong>Name:</strong> " . htmlspecialchars($row['name']) . "</li>";
                }
            } else {
                $result = "<div style='color: black;'><strong>查無此人</strong></div>";
            }
        }
    } catch (PDOException $e) {
        // Outputting database errors is very helpful for beginners learning SQLi
        // echo "<div style='color: red;'><strong>Database Error:</strong> " . $e->getMessage() . "</div>";
        $result = "<div style='color: red;'><strong>Database Error:</strong> " . htmlspecialchars($e->getMessage()) . "</div>";
    }
    
    // Stop execution so we don't render the HTML form again below the JSON output
    // exit; 
} 
?>

<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Web-50 查無此人</title>
</head>
<body>
  <style>
    body {
      font-family: Arial, sans-serif;
      margin: 20px;
    }
    input[type="text"] {
      padding: 5px;
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
  <h1>🔴 Web-50 查無此人
  <h2>查詢同學資料</h2>
  <input type="text" id="studentId" placeholder="輸入學生編號 (e.g., s26001)">
  <button onclick="queryStudent()">查詢</button>
  <div id="result"> <?php echo $result; ?></div>
  <script>
    function queryStudent() {
      const studentId = document.getElementById('studentId').value;
      // Navigate to the same page with the GET parameter
      window.location.href = `?sid=${encodeURIComponent(studentId)}`;
    }
  </script>
</body>
</html>