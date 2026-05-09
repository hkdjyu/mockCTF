# ✅ Web-14 解題說明 — 被快取的舊秘密

## 題目描述
開發者聲稱提示早已刪除，但瀏覽器可能仍保留舊版本資源。請從快取中找出被遺忘的內容，還原最終旗標。

## 解題步驟
1. 開啟 `http://localhost:8014`，按 `F12` 進入 DevTools。
2. 前往 `Application` → `Cache Storage`。
3. 找到 `web14-static-v1`，裡面會有 `/legacy/app.v1.js`。
4. 開啟該舊版檔案，找到 Base64 字串：`ZmxhZ3tjYWNoZV9zdG9yYWdlX2tlZXBzX2hpc3Rvcnl9`。
5. 將字串貼到 CyberChef，使用 `From Base64` 解碼。

## 學習重點
- 瀏覽器快取可能留下舊版靜態資源。
- 「已刪除」不代表使用者端完全拿不到。
- Cache Storage 是偵查前端舊資料的重要位置。

## Flag
`flag{cache_storage_keeps_history}`