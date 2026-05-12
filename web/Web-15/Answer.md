# ✅ Web-15 解題說明 — IndexedDB 資料倉庫

## 題目描述
網站會把部分資料存進瀏覽器資料庫。請在前端資料儲存區中找到不該公開的測試資訊，並分析出旗標。

## 難度
★☆☆☆☆（1星）

## 種類
WEB

## 建議工具
- 瀏覽器 DevTools（Elements / Network / Sources / Application / Console）
- CyberChef（From Base64 / From Hex / URL Decode 等）
- Hex 工具（hexed.it）

## 解題步驟
1. 開啟 `https://llcmhlau.edu.hk/mockCTF/Web-15`，按 `F12` 進入 DevTools。
2. 前往 `Application` → `IndexedDB`。
3. 展開 `campusDrafts` → `drafts`，找到 `id = 2` 的資料。
4. 其中 `note` 欄位是 Base64：`ZmxhZ3tpbmRleGVkZGJfa2VlcHNfZHJhZnRzfQ==`。
5. 將字串貼到 CyberChef，使用 `From Base64` 解碼。

## 驗證與常見卡點
- 驗證方式：最終輸出需符合 `flag{...}` 格式，且與題目提示一致。
- 常見卡點：Base64 可能是 URL-safe 版本，必要時先補 `=` 再解碼。
- 常見卡點：Hex 需先去除空白與非 0-9A-F 字元。
- 常見卡點：確認在正確網域下重新整理後再讀取 Storage。

## 學習重點
- IndexedDB 常被前端框架用來存大量資料。
- 本機資料庫中的測試欄位可能洩漏敏感訊息。
- JSON 結構與欄位命名都值得仔細檢查。

## Flag
`flag{indexeddb_keeps_drafts}`


