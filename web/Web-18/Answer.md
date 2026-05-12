# ✅ Web-18 解題說明 — Service Worker 的假畫面

## 題目描述
你眼前看到的畫面，未必就是伺服器真正回傳的內容。請找出攔截請求的機制，並從快取或腳本中還原真相。

## 難度
★☆☆☆☆（1星）

## 種類
WEB

## 建議工具
- 瀏覽器 DevTools（Elements / Network / Sources / Application / Console）
- CyberChef（From Base64 / From Hex / URL Decode 等）
- Hex 工具（hexed.it）

## 解題步驟
1. 開啟 `https://llcmhlau.edu.hk/mockCTF/Web-18`，按 `F12` 進入 DevTools。
2. 前往 `Application` → `Service Workers`，確認網站註冊了 `/sw.js`。
3. 在 `Sources` 或直接開啟 `/sw.js`，可看到它攔截 `/daily-message.txt` 並回傳假公告。
4. 前往 `Application` → `Cache Storage`，找到 `web18-worker-cache`。
5. 開啟 `/internal/archive-note.txt`，可看到 Base64 字串。
6. 將它貼到 CyberChef，使用 `From Base64` 解碼。

## 驗證與常見卡點
- 驗證方式：最終輸出需符合 `flag{...}` 格式，且與題目提示一致。
- 常見卡點：Base64 可能是 URL-safe 版本，必要時先補 `=` 再解碼。
- 常見卡點：Hex 需先去除空白與非 0-9A-F 字元。
- 常見卡點：確認在正確網域下重新整理後再讀取 Storage。

## 學習重點
- Service Worker 能攔截並改寫前端請求結果。
- 使用者看到的內容不一定是原始回應。
- Cache Storage 與 Service Worker 常要一起檢查。

## Flag
`flag{service_workers_can_mislead}`


