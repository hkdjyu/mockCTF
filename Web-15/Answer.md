# ✅ Web-15 解題說明 — IndexedDB 資料倉庫

## 題目描述
網站會把部分資料存進瀏覽器資料庫。請在前端資料儲存區中找到不該公開的測試資訊，並分析出旗標。

## 解題步驟
1. 開啟 `http://localhost:8015`，按 `F12` 進入 DevTools。
2. 前往 `Application` → `IndexedDB`。
3. 展開 `campusDrafts` → `drafts`，找到 `id = 2` 的資料。
4. 其中 `note` 欄位是 Base64：`ZmxhZ3tpbmRleGVkZGJfa2VlcHNfZHJhZnRzfQ==`。
5. 將字串貼到 CyberChef，使用 `From Base64` 解碼。

## 學習重點
- IndexedDB 常被前端框架用來存大量資料。
- 本機資料庫中的測試欄位可能洩漏敏感訊息。
- JSON 結構與欄位命名都值得仔細檢查。

## Flag
`flag{indexeddb_keeps_drafts}`