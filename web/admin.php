<?php
session_start();

// --- 1. 管理員登入設定 ---
$admin_password = 'admin'; 

if (isset($_POST['logout'])) {
    unset($_SESSION['is_admin']);
    header("Location: admin.php");
    exit;
}

if (isset($_POST['login_pw'])) {
    if ($_POST['login_pw'] === $admin_password) {
        $_SESSION['is_admin'] = true;
        header("Location: admin.php");
        exit;
    } else {
        $login_error = "密碼錯誤！";
    }
}

if (!isset($_SESSION['is_admin']) || $_SESSION['is_admin'] !== true) {
    ?>
    <!DOCTYPE html>
    <html lang="zh-TW">
    <head>
        <meta charset="UTF-8">
        <title>管理員登入 - mockCTF</title>
        <style>
            body { font-family: sans-serif; background: #f4f6f8; display: flex; justify-content: center; align-items: center; height: 100vh; margin: 0; }
            .login-box { background: white; padding: 30px; border-radius: 8px; box-shadow: 0 4px 12px rgba(0,0,0,0.1); text-align: center; }
            input[type="password"] { padding: 10px; margin: 10px 0; width: 80%; border: 1px solid #ccc; border-radius: 4px; }
            button { padding: 10px 20px; background: #0056b3; color: white; border: none; border-radius: 4px; cursor: pointer; }
            .error { color: red; font-size: 14px; }
        </style>
    </head>
    <body>
        <div class="login-box">
            <h2>CTF 管理員控制台</h2>
            <?php if(isset($login_error)) echo "<p class='error'>{$login_error}</p>"; ?>
            <form method="POST">
                <input type="password" name="login_pw" placeholder="請輸入管理員密碼" required autofocus>
                <br>
                <button type="submit">登入</button>
            </form>
        </div>
    </body>
    </html>
    <?php
    exit;
}

// --- 2. 連線資料庫 ---
try {
    $db = new PDO('sqlite:ctf_progress.db');
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $db->exec("CREATE TABLE IF NOT EXISTS solved_questions (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        username TEXT,
        question_key TEXT,
        solved_at DATETIME DEFAULT CURRENT_TIMESTAMP,
        UNIQUE(username, question_key)
    )");
} catch (PDOException $e) {
    die("資料庫連線失敗: " . $e->getMessage());
}

// --- 3. 處理重置動作 ---
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'])) {
    if ($_POST['action'] === 'reset_all' && !empty($_POST['username'])) {
        $stmt = $db->prepare("DELETE FROM solved_questions WHERE username = :user");
        $stmt->execute([':user' => $_POST['username']]);
    } 
    elseif ($_POST['action'] === 'reset_single' && !empty($_POST['username']) && !empty($_POST['question_key'])) {
        $stmt = $db->prepare("DELETE FROM solved_questions WHERE username = :user AND question_key = :key");
        $stmt->execute([':user' => $_POST['username'], ':key' => $_POST['question_key']]);
    }
    // 導向時保留目前的 GET 參數(搜尋與過濾條件)
    $query_string = $_SERVER['QUERY_STRING'] ? '?' . $_SERVER['QUERY_STRING'] : '';
    header("Location: admin.php" . $query_string);
    exit;
}

// --- 4. 取得排行榜資料 (不套用過濾，維持總覽) ---
$summary_stmt = $db->query("SELECT username, COUNT(question_key) as total FROM solved_questions GROUP BY username ORDER BY total DESC");
$summary_data = $summary_stmt->fetchAll(PDO::FETCH_ASSOC);

// --- 5. 處理「詳細紀錄」的搜尋、過濾與排序 ---
// 接收 GET 參數
$search_user = isset($_GET['search']) ? trim($_GET['search']) : '';
$filter_question = isset($_GET['filter']) ? trim($_GET['filter']) : '';
$sort_by = isset($_GET['sort']) ? $_GET['sort'] : 'time_desc';

// 動態建立 SQL 查詢語句與參數陣列
$query = "SELECT username, question_key, solved_at FROM solved_questions WHERE 1=1";
$params = [];

// [Search] 搜尋學生姓名 (模糊搜尋)
if ($search_user !== '') {
    $query .= " AND username LIKE :search";
    $params[':search'] = "%$search_user%";
}

// [Filter] 過濾題目代號 (精確匹配)
if ($filter_question !== '') {
    $query .= " AND question_key = :filter";
    $params[':filter'] = $filter_question;
}

// [Sort] 排序條件
switch ($sort_by) {
    case 'time_asc':
        $query .= " ORDER BY solved_at ASC";
        break;
    case 'user_asc':
        $query .= " ORDER BY username ASC, solved_at DESC";
        break;
    case 'user_desc':
        $query .= " ORDER BY username DESC, solved_at DESC";
        break;
    case 'time_desc':
    default:
        $query .= " ORDER BY solved_at DESC";
        break;
}

$detail_stmt = $db->prepare($query);
$detail_stmt->execute($params);
$detail_data = $detail_stmt->fetchAll(PDO::FETCH_ASSOC);

// 為了讓過濾選單可以下拉選擇，取得資料庫中所有出現過的題目代號
$all_questions_stmt = $db->query("SELECT DISTINCT question_key FROM solved_questions ORDER BY question_key");
$all_questions = $all_questions_stmt->fetchAll(PDO::FETCH_COLUMN);
?>

<!DOCTYPE html>
<html lang="zh-TW">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>mockCTF - 管理員控制台</title>
    <style>
        :root { --primary: #0f172a; --danger: #dc2626; --bg: #f8fafc; --card: #ffffff; --border: #e2e8f0; }
        body { font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif; background: var(--bg); color: #333; margin: 0; padding: 20px; }
        .container { max-width: 1000px; margin: 0 auto; }
        .header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 24px; padding-bottom: 16px; border-bottom: 2px solid var(--border); }
        h1, h2 { margin: 0; color: var(--primary); }
        .card { background: var(--card); border: 1px solid var(--border); border-radius: 8px; padding: 20px; margin-bottom: 24px; box-shadow: 0 1px 3px rgba(0,0,0,0.05); }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        th, td { text-align: left; padding: 12px; border-bottom: 1px solid var(--border); }
        th { background: #f1f5f9; font-weight: 600; }
        form { display: inline; }
        
        /* 表單元素樣式 */
        input[type="text"], select { padding: 8px; border: 1px solid #ccc; border-radius: 4px; font-size: 14px; }
        button, .btn { padding: 8px 12px; border: none; border-radius: 4px; cursor: pointer; font-size: 13px; font-weight: 500; text-decoration: none; display: inline-block; }
        .btn-primary { background: #0284c7; color: white; }
        .btn-primary:hover { background: #0369a1; }
        .btn-danger { background: #fee2e2; color: var(--danger); }
        .btn-danger:hover { background: #fecaca; }
        .btn-outline { background: white; border: 1px solid var(--border); color: #333;}
        .btn-outline:hover { background: #f1f5f9; }
        .badge { background: #e0f2fe; color: #0284c7; padding: 4px 8px; border-radius: 999px; font-size: 12px; font-weight: bold; }
        
        /* 工具列樣式 */
        .toolbar { display: flex; flex-wrap: wrap; gap: 10px; background: #f8fafc; padding: 12px; border-radius: 6px; margin-bottom: 16px; border: 1px solid var(--border); align-items: center; }
        .toolbar-group { display: flex; align-items: center; gap: 8px; }
    </style>
</head>
<body>

<div class="container">
    <div class="header">
        <h1>🛠️ mockCTF 管理員控制台</h1>
        <form method="POST">
            <button type="submit" name="logout" class="btn-outline">登出管理員</button>
        </form>
    </div>

    <div class="card">
        <h2>📊 學生進度總覽</h2>
        <table>
            <thead>
                <tr>
                    <th>排名</th>
                    <th>學生姓名 / 學號</th>
                    <th>完成題數</th>
                    <th>管理操作</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($summary_data)): ?>
                    <tr><td colspan="4" style="text-align:center;">目前還沒有任何學生的解題紀錄。</td></tr>
                <?php else: ?>
                    <?php $rank = 1; foreach ($summary_data as $row): ?>
                        <tr>
                            <td>#<?php echo $rank++; ?></td>
                            <td><strong><?php echo htmlspecialchars($row['username']); ?></strong></td>
                            <td><span class="badge"><?php echo $row['total']; ?> 題</span></td>
                            <td>
                                <form method="POST" onsubmit="return confirm('警告：確定要清空【<?php echo htmlspecialchars($row['username']); ?>】的所有解題紀錄嗎？');">
                                    <input type="hidden" name="action" value="reset_all">
                                    <input type="hidden" name="username" value="<?php echo htmlspecialchars($row['username']); ?>">
                                    <button type="submit" class="btn-danger">重置紀錄</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <div class="card">
        <h2>📝 詳細解題動態</h2>
        
        <form method="GET" class="toolbar">
            <div class="toolbar-group">
                <label>🔍 搜尋：</label>
                <input type="text" name="search" placeholder="輸入學生姓名..." value="<?php echo htmlspecialchars($search_user); ?>">
            </div>
            
            <div class="toolbar-group">
                <label>📂 題目：</label>
                <select name="filter">
                    <option value="">-- 所有題目 --</option>
                    <?php foreach ($all_questions as $q): ?>
                        <option value="<?php echo htmlspecialchars($q); ?>" <?php if($filter_question === $q) echo 'selected'; ?>>
                            <?php echo strtoupper(htmlspecialchars($q)); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            
            <div class="toolbar-group">
                <label>⬇️ 排序：</label>
                <select name="sort">
                    <option value="time_desc" <?php if($sort_by === 'time_desc') echo 'selected'; ?>>最新時間優先</option>
                    <option value="time_asc" <?php if($sort_by === 'time_asc') echo 'selected'; ?>>最舊時間優先</option>
                    <option value="user_asc" <?php if($sort_by === 'user_asc') echo 'selected'; ?>>學生姓名 (A-Z)</option>
                    <option value="user_desc" <?php if($sort_by === 'user_desc') echo 'selected'; ?>>學生姓名 (Z-A)</option>
                </select>
            </div>
            
            <button type="submit" class="btn btn-primary">套用</button>
            <a href="admin.php" class="btn btn-outline">清除條件</a>
        </form>

        <table>
            <thead>
                <tr>
                    <th>完成時間</th>
                    <th>學生姓名</th>
                    <th>題目代號</th>
                    <th>操作</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($detail_data)): ?>
                    <tr><td colspan="4" style="text-align:center;">找不到符合條件的紀錄。</td></tr>
                <?php else: ?>
                    <?php foreach ($detail_data as $row): ?>
                        <tr>
                            <td style="color: #64748b; font-size: 14px;"><?php echo $row['solved_at']; ?></td>
                            <td><strong><?php echo htmlspecialchars($row['username']); ?></strong></td>
                            <td><span class="badge"><?php echo strtoupper(htmlspecialchars($row['question_key'])); ?></span></td>
                            <td>
                                <form method="POST" onsubmit="return confirm('確定要取消【<?php echo htmlspecialchars($row['username']); ?>】在【<?php echo strtoupper(htmlspecialchars($row['question_key'])); ?>】的紀錄嗎？');">
                                    <input type="hidden" name="action" value="reset_single">
                                    <input type="hidden" name="username" value="<?php echo htmlspecialchars($row['username']); ?>">
                                    <input type="hidden" name="question_key" value="<?php echo htmlspecialchars($row['question_key']); ?>">
                                    <button type="submit" class="btn-danger" style="padding: 4px 8px; font-size: 12px;">刪除此題</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

</body>
</html>