<!DOCTYPE html>
<html lang="zh-HK">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Web-15 IndexedDB 資料倉庫</title>
    <style>
        body {
            margin: 0;
            min-height: 100vh;
            display: grid;
            place-items: center;
            font-family: Arial, sans-serif;
            background: #f8fafc;
        }
        .card {
            width: min(92vw, 560px);
            background: #fff;
            padding: 2rem;
            border-radius: 16px;
            box-shadow: 0 12px 24px rgba(15, 23, 42, .08);
        }
    </style>
</head>
<body>
    <div class="card">
        <h1>🗂️ 草稿資料同步器</h1>
        <p>系統會先把草稿資料同步到本機資料庫，以加快載入速度。</p>
        <p id="status">正在初始化資料庫...</p>
    </div>

    <script>
        const request = indexedDB.open('campusDrafts', 1);

        request.onupgradeneeded = event => {
            const db = event.target.result;
            const store = db.createObjectStore('drafts', { keyPath: 'id' });
            store.createIndex('owner', 'owner', { unique: false });
        };

        request.onsuccess = event => {
            const db = event.target.result;
            const tx = db.transaction('drafts', 'readwrite');
            const store = tx.objectStore('drafts');

            store.put({ id: 1, owner: 'editor', note: 'weekly bulletin' });
            store.put({ id: 2, owner: 'dev-team', note: 'ZmxhZ3tpbmRleGVkZGJfa2VlcHNfZHJhZnRzfQ==' });
            store.put({ id: 3, owner: 'system', note: 'autosave complete' });

            tx.oncomplete = () => {
                document.getElementById('status').textContent = '資料庫已同步完成。';
            };
        };
    </script>
</body>
</html>