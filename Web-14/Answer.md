# ✅ Web-14 解題說明 — 被快取的舊秘密

## 題目描述
開發者聲稱提示早已刪除，但瀏覽器可能仍保留舊版本資源。請從快取中找出被遺忘的內容，還原最終旗標。

## 難度
★★☆☆☆（2星）

## 種類
WEB, CRYPTO

## 建議工具
- 瀏覽器 DevTools（Elements / Network / Sources / Application / Console）
- CyberChef（From Base64 / From Hex / URL Decode 等）
- Hex 工具（hexed.it）

## 解題步驟
1. 開啟 `http://localhost:8014`，按 `F12` 進入 DevTools。
2. 前往 `Application` → `Cache Storage`。
3. 找到 `web14-static-v1`，裡面會有 `/legacy/app.v1.js`。
4. 開啟該舊版檔案，找到
```
// archived ciphertext: 37496b17ad7ff6e9137bc0b7011c7362861d1015e62a675e453b80887212a957274f571840fd16be904d8f1a3039d12f
// archived key and IV: e98099e698afe5af86e991b0e596b22e
// archived encryption method: AES-128-CBC
```
5. 將字串貼到 CyberChef，使用`AES Decrypt` 和 `From Base64` 解碼。

## 驗證與常見卡點
- 驗證方式：最終輸出需符合 `flag{...}` 格式，且與題目提示一致。
- 常見卡點：Base64 可能是 URL-safe 版本，必要時先補 `=` 再解碼。
- 常見卡點：Hex 需先去除空白與非 0-9A-F 字元。
- 常見卡點：確認在正確網域下重新整理後再讀取 Storage。

## 學習重點
- 瀏覽器快取可能留下舊版靜態資源。
- 「已刪除」不代表使用者端完全拿不到。
- Cache Storage 是偵查前端舊資料的重要位置。
- 留意加密方式，需要有KEY 和 Initialization Vector (IV)
- 一般而言Key是不公開，而IV是可以公開的。

## Flag
`flag{cache_storage_keeps_history}`

