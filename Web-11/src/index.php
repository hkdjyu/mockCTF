<?php
$expected = '666c61677b64697361626c65645f6669656c64735f7374696c6c5f74616c6b7d';
$message = '';
$success = false;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $submitted = $_POST['recovery_code'] ?? '';
    if ($submitted === $expected) {
        $success = true;
        $message = '偵錯輸出：' . htmlspecialchars($submitted, ENT_QUOTES, 'UTF-8');
    } else {
        $message = '驗證失敗：缺少正確的復原欄位。';
    }
}
?><!DOCTYPE html>
<html lang="zh-HK">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Web-11 被隱藏的表單欄位</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #eef2ff;
            margin: 0;
            min-height: 100vh;
            display: grid;
            place-items: center;
        }
        .card {
            width: min(92vw, 420px);
            background: #fff;
            border-radius: 14px;
            box-shadow: 0 12px 30px rgba(15, 23, 42, 0.14);
            padding: 2rem;
        }
        h1 { margin-top: 0; font-size: 1.35rem; }
        p { color: #475569; line-height: 1.6; }
        label { display: block; margin-top: 1rem; font-weight: 700; }
        input[type="text"] {
            width: 100%;
            margin-top: .4rem;
            padding: .7rem .8rem;
            border: 1px solid #cbd5e1;
            border-radius: 8px;
            box-sizing: border-box;
        }
        button {
            margin-top: 1rem;
            width: 100%;
            padding: .8rem;
            border: 0;
            border-radius: 8px;
            background: #4f46e5;
            color: white;
            font-size: 1rem;
            cursor: pointer;
        }
        .msg {
            margin-top: 1rem;
            padding: .9rem 1rem;
            border-radius: 8px;
            background: #f8fafc;
            color: #1e293b;
            word-break: break-all;
        }
        .ok { border-left: 4px solid #16a34a; }
        .fail { border-left: 4px solid #dc2626; }
        small { color: #64748b; }
    </style>
</head>
<body>
    <!-- Dev note: disabled 欄位送出前不會被提交。 -->
    <div class="card">
        <h1>📝 表單同步測試</h1>
        <p>系統正在測試新的表單欄位同步功能。若表單資料完整，伺服器會顯示偵錯輸出。</p>

        <form method="POST">
            <label for="student_id">學生編號</label>
            <input type="text" id="student_id" name="student_id" placeholder="S12345" autocomplete="off">

            <label for="recovery_code">復原欄位（暫時鎖定）</label>
            <input
                type="hidden"
                id="recovery_code"
                name="recovery_code"
                value="<?= $expected ?>"
                disabled
            >

            <button type="submit">送出</button>
        </form>

        <?php if ($message !== ''): ?>
            <div class="msg <?= $success ? 'ok' : 'fail' ?>"><?= $message ?></div>
        <?php endif; ?>

        <p><small>提示：有些欄位只是看不到，不代表不存在。</small></p>
    </div>
</body>
</html>