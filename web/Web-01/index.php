<?php
// Set a subtle hint in the HTTP response header
// header("X-Hint: The answer lies within...");
?><!DOCTYPE html>
<html lang="zh-TW">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Web-01 開發者遺留除錯檔</title>
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body {
            font-family: "Helvetica Neue", Arial, sans-serif;
            background: #f0f2f5;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }
        .card {
            background: #fff;
            padding: 2.5rem 2rem;
            border-radius: 8px;
            box-shadow: 0 2px 12px rgba(0,0,0,.15);
            width: 100%;
            max-width: 380px;
        }
        .logo {
            text-align: center;
            margin-bottom: 1.5rem;
        }
        .logo h1 { font-size: 1.1rem; color: #333; }
        .logo p  { font-size: .85rem; color: #888; margin-top: .25rem; }
        label { display: block; font-size: .9rem; color: #555; margin-bottom: .3rem; }
        input[type="text"], input[type="password"] {
            width: 100%;
            padding: .6rem .75rem;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: .95rem;
            margin-bottom: 1rem;
        }
        input[type="text"]:focus, input[type="password"]:focus {
            outline: none;
            border-color: #4a90e2;
        }
        input[type="submit"] {
            width: 100%;
            padding: .7rem;
            background: #4a90e2;
            color: #fff;
            border: none;
            border-radius: 4px;
            font-size: 1rem;
            cursor: pointer;
        }
        input[type="submit"]:hover { background: #357abd; }
        .msg { margin-top: 1rem; font-size: .9rem; text-align: center; }
        .error { color: #e74c3c; }
        footer { margin-top: 1.5rem; font-size: .75rem; color: #bbb; text-align: center; }
    </style>
</head>
<body>

    <!--
        TODO (Dev Team): 正式上線前請移除 debug 模式！
        已暫時引入 app.js 進行前端除錯，上線前必須刪除。
    -->

    <div class="card">
        <div class="logo">
            <h1>Web-01 開發者遺留除錯檔</h1>
            <p>靈糧堂劉梅軒中學 內部系統</p>
        </div>

        <form method="POST" action="">
            <label for="username">帳號</label>
            <input type="text" id="username" name="username" placeholder="Employee ID" autocomplete="off">

            <label for="password">密碼</label>
            <input type="password" id="password" name="password" placeholder="••••••••">

            <input type="submit" value="登入">
        </form>

        <?php if ($_SERVER['REQUEST_METHOD'] === 'POST'): ?>
            <p class="msg error">⚠ 帳號或密碼錯誤，請重試。</p>
        <?php endif; ?>

        <footer>如需技術支援，請聯絡系統管理員</footer>
    </div>

    <!-- debug helper (remove before production) -->
    <script src="app.js"></script>

</body>
</html>
