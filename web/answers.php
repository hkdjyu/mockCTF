<?php
// 1. 使用 PHP 遞迴掃描目錄下所有的 Answer.md
$baseDir = __DIR__;
$mdFiles = [];

// 設定遞迴目錄迭代器
$iterator = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($baseDir));

foreach ($iterator as $file) {
    // 尋找檔名為 Answer.md (不分大小寫)
    if ($file->isFile() && strcasecmp($file->getFilename(), 'Answer.md') === 0) {
        // 取得相對路徑 (方便前端 fetch 讀取)
        $relativePath = str_replace($baseDir . DIRECTORY_SEPARATOR, '', $file->getPathname());
        // 將 Windows 的反斜線替換為網頁用的正斜線
        $relativePath = str_replace('\\', '/', $relativePath);
        $mdFiles[] = $relativePath;
    }
}

// 將 PHP 陣列轉換為 JSON，傳遞給前端 JavaScript
$filesJson = json_encode($mdFiles);
?>

<!DOCTYPE html>
<html lang="zh-TW">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CTF 解答文檔總覽</title>
    <script src="https://cdn.jsdelivr.net/npm/marked/marked.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/github-markdown-css/5.2.0/github-markdown.min.css">
    <style>
        :root {
            --sidebar-width: 300px;
            --mobile-topbar-height: 56px;
        }
        body {
            margin: 0;
            padding: 0;
            display: flex;
            min-height: 100vh;
            font-family: sans-serif;
            background-color: #f6f8fa;
        }
        /* 左側側邊欄 */
        #sidebar {
            width: var(--sidebar-width);
            background-color: #ffffff;
            border-right: 1px solid #d0d7de;
            overflow-y: auto;
            padding: 20px;
            box-sizing: border-box;
        }
        #sidebar h2 {
            font-size: 1.2em;
            margin-top: 0;
            padding-bottom: 10px;
            border-bottom: 2px solid #eaecef;
        }
        .file-link {
            display: block;
            padding: 10px;
            margin-bottom: 5px;
            background-color: #f3f4f6;
            color: #0969da;
            text-decoration: none;
            border-radius: 6px;
            word-break: break-all;
            transition: background-color 0.2s;
        }
        .file-link:hover, .file-link.active {
            background-color: #0969da;
            color: #ffffff;
        }
        /* 右側內容區 */
        #main-content {
            flex-grow: 1;
            overflow-y: auto;
            padding: 40px;
            box-sizing: border-box;
        }
        .markdown-body {
            max-width: 900px;
            margin: 0 auto;
            background: #ffffff;
            padding: 40px;
            border-radius: 8px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.1);
        }
        .empty-state {
            text-align: center;
            color: #6e7781;
            margin-top: 100px;
        }
        #mobile-topbar {
            display: none;
            position: sticky;
            top: 0;
            z-index: 20;
            height: var(--mobile-topbar-height);
            background: #ffffff;
            border-bottom: 1px solid #d0d7de;
            align-items: center;
            justify-content: space-between;
            padding: 0 12px;
            box-sizing: border-box;
        }
        #mobile-menu-btn {
            border: 1px solid #d0d7de;
            background: #ffffff;
            border-radius: 6px;
            padding: 6px 10px;
            cursor: pointer;
            font-size: 14px;
        }
        #mobile-title {
            font-size: 16px;
            font-weight: 600;
            margin: 0;
            color: #24292f;
        }
        #overlay {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(0, 0, 0, 0.3);
            z-index: 15;
        }

        @media (max-width: 768px) {
            body {
                display: block;
            }
            #mobile-topbar {
                display: flex;
            }
            #sidebar {
                position: fixed;
                top: 0;
                left: 0;
                bottom: 0;
                z-index: 30;
                width: min(82vw, 320px);
                transform: translateX(-100%);
                transition: transform 0.2s ease;
                box-shadow: 2px 0 12px rgba(0, 0, 0, 0.15);
            }
            body.sidebar-open #sidebar {
                transform: translateX(0);
            }
            body.sidebar-open #overlay {
                display: block;
            }
            #main-content {
                width: 100%;
                padding: 16px;
                box-sizing: border-box;
            }
            .markdown-body {
                max-width: 100%;
                margin: 0;
                padding: 20px 16px;
                border-radius: 0;
                box-shadow: none;
                font-size: 15px;
                line-height: 1.65;
            }
            .empty-state {
                margin-top: 48px;
            }
            .file-link {
                padding: 12px;
                font-size: 15px;
            }
        }
    </style>
</head>
<body>

    <div id="mobile-topbar">
        <button id="mobile-menu-btn" type="button">☰ 選單</button>
        <h1 id="mobile-title">CTF 解答文檔總覽</h1>
    </div>

    <div id="overlay" aria-hidden="true"></div>

    <div id="sidebar">
        <h2>📁 發現的解答 (Answer.md)</h2>
        <div id="file-list"></div>
    </div>

    <div id="main-content">
        <div id="content" class="markdown-body">
            <div class="empty-state">
                <h2>👈 請從左側選單選擇一個解答文檔</h2>
            </div>
        </div>
    </div>

    <script>
        // 接收來自 PHP 的檔案列表
        const files = <?php echo $filesJson; ?>;
        const fileListContainer = document.getElementById('file-list');
        const contentContainer = document.getElementById('content');
        const menuBtn = document.getElementById('mobile-menu-btn');
        const overlay = document.getElementById('overlay');

        function openSidebar() {
            document.body.classList.add('sidebar-open');
        }

        function closeSidebar() {
            document.body.classList.remove('sidebar-open');
        }

        if (menuBtn) {
            menuBtn.addEventListener('click', () => {
                if (document.body.classList.contains('sidebar-open')) {
                    closeSidebar();
                } else {
                    openSidebar();
                }
            });
        }

        if (overlay) {
            overlay.addEventListener('click', closeSidebar);
        }

        // 如果沒有找到檔案
        if (files.length === 0) {
            fileListContainer.innerHTML = '<p style="color: #cf222e;">目前目錄或子目錄下找不到任何 Answer.md 檔案。</p>';
        }

        // 動態生成左側列表
        files.forEach(file => {
            const link = document.createElement('a');
            link.href = '#';
            link.className = 'file-link';
            // 顯示路徑，如果只是根目錄的 Answer.md 則直接顯示
            link.textContent = file; 
            
            link.onclick = (e) => {
                e.preventDefault();
                
                // 移除其他連結的 active 狀態
                document.querySelectorAll('.file-link').forEach(el => el.classList.remove('active'));
                link.classList.add('active');

                // 載入並渲染 Markdown
                loadMarkdown(file);

                // 手機版選擇檔案後自動收起側欄
                closeSidebar();
            };
            fileListContainer.appendChild(link);
        });

        // 讀取並渲染 Markdown 的函數
        function loadMarkdown(filePath) {
            contentContainer.innerHTML = '<div class="empty-state">讀取中... ⏳</div>';
            
            // 加上時間戳避免瀏覽器快取舊資料
            fetch(filePath + '?t=' + new Date().getTime())
                .then(response => {
                    if (!response.ok) throw new Error('檔案讀取失敗');
                    return response.text();
                })
                .then(text => {
                    contentContainer.innerHTML = marked.parse(text);
                })
                .catch(error => {
                    contentContainer.innerHTML = `<div class="empty-state" style="color: red;">載入失敗：${error.message}</div>`;
                });
        }
    </script>
</body>
</html>