<?php

  // 使用檔案型 SQLite，避免每次請求都重建記憶體資料庫。
  function buildDemeritDb() {
    $dbPath = __DIR__ . '/demerits.sqlite';
    $db = new SQLite3($dbPath);
    $db->exec('CREATE TABLE IF NOT EXISTS demerits (id INTEGER PRIMARY KEY AUTOINCREMENT, date TEXT, name TEXT, type TEXT, reason TEXT)');
    return $db;
  }

  function seedDemeritsIfEmpty($db, $students, $types, $reasons) {
    $countResult = $db->querySingle('SELECT COUNT(*) FROM demerits');
    if ((int) $countResult > 0) {
      return;
    }

    $stmt = $db->prepare('INSERT INTO demerits (date, name, type, reason) VALUES (:date, :name, :type, :reason)');
    for ($i = 0; $i < 20; $i++) {
      $date = date('Y-m-d', strtotime('-' . rand(0, 30) . ' days'));
      $name = $students[array_rand($students)];
      $type = $types[array_rand($types)];
      $reason = $reasons[array_rand($reasons)];
      $stmt->bindValue(':date', $date, SQLITE3_TEXT);
      $stmt->bindValue(':name', $name, SQLITE3_TEXT);
      $stmt->bindValue(':type', $type, SQLITE3_TEXT);
      $stmt->bindValue(':reason', $reason, SQLITE3_TEXT);
      $stmt->execute();
    }
  }

  function executeStackedQueries($db, $query, &$sqlError) {
    $rows = [];
    $statements = explode(';', $query);

    foreach ($statements as $statement) {
      $statement = trim($statement);
      if ($statement === '') {
        continue;
      }

      if (preg_match('/^select\b/i', $statement) === 1) {
        $result = $db->query($statement);
        if ($result === false) {
          $sqlError = $db->lastErrorMsg();
          return [];
        }

        $rows = [];
        while (($row = $result->fetchArray(SQLITE3_ASSOC)) !== false) {
          $rows[] = $row;
        }
      } else {
        $ok = $db->exec($statement);
        if ($ok === false) {
          $sqlError = $db->lastErrorMsg();
          return [];
        }
      }
    }

    return $rows;
  }

  // 預先插入一些缺點紀錄，方便測試。
  $db = buildDemeritDb();
  $students = ['Alice', 'Bob', 'Charlie', 'David', 'Eve', 'Frank', 'Grace', 'Heidi', 'Ivan', 'Judy', 'Karl', 'Leo', 'Mallory', 'Nina', 'Oscar', 'Peggy', 'Quentin', 'Rupert', 'Sybil', 'Trent', 'Uma', 'Victor', 'Walter', 'Xavier', 'Yvonne', 'Zara'];
  $types = ['警告', '缺點', '小過', '大過'];
  $reasons = ['遲到', '早退', '未帶課本', '上課講話', '打架', '作弊', '不交作業', '使用手機', '穿著不當', '其他'];

  // 只在資料表為空時，插入初始測試資料。
  seedDemeritsIfEmpty($db, $students, $types, $reasons);

  // 這裡我們不直接在 PHP 中執行查詢，而是讓前端 JavaScript 發送請求來執行查詢，模擬一個簡單的 API。
  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // query 參數應該是 JSON 格式，包含一個 SQL 查詢語句
    $input = json_decode(file_get_contents('php://input'), true);
    $query = isset($input['query']) ? $input['query'] : '';

    $sqlError = '';
    $demerits = executeStackedQueries($db, $query, $sqlError);

    // 檢查 demerits 的紀錄數目是否為 0，如果是 0 則回傳 flag。
    $result = null;
    $countResult = $db->querySingle('SELECT COUNT(*) FROM demerits');
    if ($countResult === false || (int) $countResult === 0) {
      $result = 'flag{y0u_succ3ssfully_d3m3rits_r3cords}';
    }

    header('Content-Type: application/json');
    echo json_encode([
      'rows' => $demerits,
      'executedQuery' => $query,
      'error' => $sqlError,
      'result' => $result,
    ]);
    exit;
  }
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Web-47 剷除缺點紀錄</title>
</head>
<body>
  <h1>缺點管理頁面</h1>
  <hr/>
  <h2>顯示缺點紀錄</h2>
  <label for="filterName">篩選學生姓名：</label>
  <button onclick="refreshDemeritTable()">刷新表格</button>
  <input type="text" id="filterName" name="filterName">
  <table border="1">
    <thead>
      <tr>
        <th>ID</th>
        <th>日期</th>
        <th>學生姓名</th>
        <th>缺點類型</th>
        <th>事由</th>
      </tr>
    </thead>
    <tbody id="demeritTableBody">
    </tbody>
  </table>

  <script>
    window.alert('我要剷除全部同學的缺點紀錄>v<！');
    function sendQuery(query) {
      fetch('', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ query })
      })
      .then(response => response.json())
      .then(data => {
        if (data && data.executedQuery) {
          console.log('[Web-47] SQL executed by server');
        }
        if (data && data.error) {
          console.error('[Web-47] SQL Error:', data.error);
        }
        const demeritTableBody = document.getElementById('demeritTableBody');
        demeritTableBody.innerHTML = '';
        const rows = (data && data.rows) ? data.rows : [];
        rows.forEach(demerit => {
          const row = document.createElement('tr');
          row.innerHTML = `
            <td>${demerit.id}</td>
            <td>${demerit.date}</td>
            <td>${demerit.name}</td>
            <td>${demerit.type}</td>
            <td>${demerit.reason}</td>
          `;
          demeritTableBody.appendChild(row);
        });
        if (data && data.result) {
          alert(data.result);
        }
      })
      .catch(error => {
        console.error('Error:', error);
      });
    }
    
    window.refreshDemeritTable = function refreshDemeritTable() {
      const filterName = document.getElementById('filterName').value;
      let query = 'SELECT * FROM demerits';
      if (filterName) {
        query += ` WHERE name LIKE '%${filterName}%'`;
      }
      sendQuery(query);
    };
  </script>
</body>
</html>

