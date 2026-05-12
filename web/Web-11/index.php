<?php
$flag = 'flag{disabled_fields_still_talk}';
$message = '';
$success = false;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $submitted = trim($_POST['recovery_code'] ?? '');
    if (preg_match('/^s\d{6}$/', $submitted) === 1) {
        $success = true;
        $message = '驗證成功：收到有效學生編號 ' . htmlspecialchars($submitted, ENT_QUOTES, 'UTF-8');
    } else {
        $message = '驗證失敗：請輸入格式為 s + 6 位數字（例如 s123456）。';
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
        <h1>📝 輸入學生編號得到旗幟</h1>
        <p>系統正在測試，目前隱藏輸入欄位。</p>

        <form method="POST">
            <label for="recovery_code">學生編號（暫時隱藏）</label>
            <!-- 學生編號格式（s123456） -->
            <input
                type="hidden"
                id="recovery_code"
                name="recovery_code"
                value=""
                disabled
            >

            <button type="submit">送出</button>
        </form>

        <?php if ($message !== ''): ?>
            <div class="msg <?= $success ? 'ok' : 'fail' ?>"><?= $message ?></div>
        <?php endif; ?>

    </div>
    <script>
        const recoveryInput = document.getElementById('recovery_code');
        const ensureEditableWhenText = () => {
            if (recoveryInput.type === 'text') {
                recoveryInput.disabled = false;
            }
        };

        ensureEditableWhenText();

        const observer = new MutationObserver(ensureEditableWhenText);
        observer.observe(recoveryInput, { attributes: true, attributeFilter: ['type'] });
    </script>
    <?php if ($success): ?>
    <script>
        console.log('<?= htmlspecialchars($flag, ENT_QUOTES, 'UTF-8') ?>');
        alert('已觸發偵錯輸出，請開啟 Console 查看結果。');
    </script>
    <?php endif; ?>
</body>
</html>