<?php
// 建立一個簡單的 SQLite3 資料庫，並在記憶體中創建一個 products 表格，然後在前端提供一個按鈕，當使用者點擊按鈕時，會從資料庫中查詢價格大於 10 的產品並顯示在表格中。
$db = new SQLite3(':memory:');

// 模擬一個簡單的超市產品資料表, 100個record, id從0100到0200, name為Product1到Product100, price為隨機生成的1到20之間的浮點數
$db->exec('CREATE TABLE products (id TEXT, name TEXT, price REAL)');
$stmt = $db->prepare('INSERT INTO products (id, name, price) VALUES (:id, :name, :price)');
for ($i = 1; $i <= 100; $i++) {
    $id = sprintf('P%04d', 100 + $i);
    $name = 'Product' . $i;
    $price = mt_rand(100, 2000) / 100; // 隨機價格在1.00到20.00之間
    $stmt->bindValue(':id', $id, SQLITE3_TEXT);
    $stmt->bindValue(':name', $name, SQLITE3_TEXT);
    $stmt->bindValue(':price', $price, SQLITE3_FLOAT);
    $stmt->execute();
}

// 更新一個特殊的產品，id=P0123，價格為0，name為flag{y0u_f0und_th3_fl4g_in_th3_pr0ducts}
$stmt->bindValue(':id', 'P0123', SQLITE3_TEXT);
$stmt->bindValue(':name', 'flag{y0u_f0und_th3_fl4g_in_th3_pr0ducts}', SQLITE3_TEXT);
$stmt->bindValue(':price', 0, SQLITE3_FLOAT);
$stmt->execute();

// 這裡我們不直接在 PHP 中執行查詢，而是讓前端 JavaScript 發送請求，根據使用者的query指令來查詢資料庫，並將結果返回給前端顯示。
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $input = json_decode(file_get_contents('php://input'), true);
    $query = isset($input['query']) ? $input['query'] : '';

    // 為了安全起見，我們只允許查詢 products 表格，並且只能使用 SELECT 語句。
    if (preg_match('/^\s*SELECT\s+.*\s+FROM\s+products\s*/', $query) === 1) {
        $result = @$db->query($query);
        if ($result !== false) {
            $products = [];
            while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
                $products[] = $row;
            }
            header('Content-Type: application/json');
            echo json_encode($products);
        } else {
            http_response_code(400);
            echo json_encode(['error' => 'Invalid query']);
        }
    } else {
        http_response_code(400);
        echo json_encode(['error' => 'Only SELECT queries on products table are allowed']);
    }
    exit;
}
?>

<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Web-46 隱藏的產品</title>
</head>
<body>
  <h1>請找出隱藏的產品</h1>
  <button onclick="sendQuery('SELECT id, name, price FROM products WHERE price > 10 ORDER BY price DESC')">查詢價格大於10的產品</button>
  <hr/>
  <table border="1">
    <thead>
      <tr>
        <th>ID</th>
        <th>Item</th>
        <th>Price</th>
      </tr>
    </thead>
    <tbody id="results">
    </tbody>
  </table>
  <script>
    function sendQuery(query) {
      fetch('', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json'
        },
        body: JSON.stringify({ query })
      })
      .then(response => response.json())
      .then(data => {
        const resultsTable = document.getElementById('results');
        resultsTable.innerHTML = '';
        data.forEach(product => {
          const row = document.createElement('tr');
          row.innerHTML = `<td>${product.id}</td><td>${product.name}</td><td>${product.price}</td>`;
          resultsTable.appendChild(row);
        });
      })
      .catch(error => console.error('Error:', error));
    }
  </script>
</body>
</html>


