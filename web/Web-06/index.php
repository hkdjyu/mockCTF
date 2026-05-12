<?php
$error = '';
$success = false;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    if (hash_equals('admin', $username) && hash_equals('admin', $password)) {
        setcookie('part1', 'ZmxhZ3tjb2', 0, '/');
        setcookie('part2', '9raWVzX21h', 0, '/');
        setcookie('part3', 'a2VfYV9wdXp6bGV9', 0, '/');
        $success = true;
    } else {
        $error = '用戶名或密碼錯誤。';
        // Clear any existing cookie parts on failed login
        setcookie('part1', '', time() - 3600, '/');
        setcookie('part2', '', time() - 3600, '/');
        setcookie('part3', '', time() - 3600, '/');
    }
}
?><!DOCTYPE html>
<html lang="zh-HK">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Web-06 Cookie 拼圖</title>
  <style>
    body {
      font-family: sans-serif;
      display: flex;
      justify-content: center;
      align-items: center;
      min-height: 100vh;
      margin: 0;
      background: #f5f5f5;
    }
    .card {
      background: #fff;
      padding: 2rem 2.5rem;
      border-radius: 10px;
      box-shadow: 0 2px 12px rgba(0,0,0,0.12);
      width: 320px;
    }
    h2 { margin-top: 0; text-align: center; }
    label { display: block; margin-top: 1rem; font-size: 0.9rem; color: #555; }
    input[type="text"], input[type="password"] {
      width: 100%;
      padding: 0.5rem 0.6rem;
      margin-top: 0.3rem;
      border: 1px solid #ccc;
      border-radius: 6px;
      font-size: 1rem;
      box-sizing: border-box;
    }
    button {
      width: 100%;
      margin-top: 1.4rem;
      padding: 0.6rem;
      background: #4a90e2;
      color: #fff;
      border: none;
      border-radius: 6px;
      font-size: 1rem;
      cursor: pointer;
    }
    button:hover { background: #357abd; }
    .error { color: #c0392b; margin-top: 1rem; text-align: center; font-size: 0.9rem; }
    .success { color: #27ae60; margin-top: 1rem; text-align: center; font-size: 0.9rem; }
  </style>
</head>
<body>
  <div class="card">
    <h2>🍪 使用者登入</h2>
    <?php if ($success): ?>
      <p class="success">登入成功！</p>
      <p style="font-size:0.85rem;color:#888;text-align:center;">ZmxhZyh0aGlzX2lzX2FfZmFrZV9mbGFnKQ==</p>
    <?php else: ?>

      <!-- 預設帳號：admin -->
      <form method="POST" action="">
        <label for="username">用戶名</label>
        <input type="text" id="username" name="username" autocomplete="off" required>
        <label for="password">密碼</label>
        <input type="password" id="password" name="password" required>
        <?php if ($error): ?>
          <p class="error"><?= htmlspecialchars($error) ?></p>
        <?php endif; ?>
        <button type="submit">登入</button>
      </form>
    <?php endif; ?>
  </div>
</body>
</html>
