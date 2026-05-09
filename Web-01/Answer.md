# ✅ Web-01 解題說明 — 開發者遺留除錯檔

## 題目描述
學校登入頁看似正常，但開發者把除錯腳本留在線上。請用 DevTools 找出隱藏字串，並用 CyberChef 還原旗標。

## 難度
★☆☆☆☆（1星）

## 種類
WEB, DEVTOOL

## 建議工具
- 瀏覽器 DevTools（Elements / Network / Sources / Application / Console）
- CyberChef（From Base64 / From Hex / URL Decode 等）
- Hex 工具（hexed.it）

## 解題步驟
1. 開啟 `http://localhost:8001`，按 `F12` 進入 DevTools。
2. 在 `Network` 重新整理頁面，查看主請求回應標頭，取得提示 `X-Hint: The answer lies within...`。
3. 檢視頁面原始碼，發現頁尾引用 `app.js`。
4. 在 `Sources` 或直接開啟 `/app.js`，找到字串：`ZmxhZ3tkM3ZfdDAwbHNfNF90aDNfdzFufQ==`。
5. 將字串貼到 CyberChef，使用 `From Base64` 解碼。

## 驗證與常見卡點
- 驗證方式：最終輸出需符合 `flag{...}` 格式，且與題目提示一致。
- 常見卡點：Base64 可能是 URL-safe 版本，必要時先補 `=` 再解碼。
- 常見卡點：Hex 需先去除空白與非 0-9A-F 字元。

## 學習重點
- HTTP 標頭與原始碼可能洩漏敏感資訊。
- 前端 JavaScript 對使用者完全可見，不能存放機密。
- Base64 是編碼不是加密。

## Flag
`flag{d3v_t00ls_4_th3_w1n}`

