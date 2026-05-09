# ✅ Web-03 解題說明 — 假登入的前端判斷

## 題目描述
這個登入頁看似有驗證，其實只靠前端 JavaScript 判斷。請分析條件比對邏輯，找出能通關的關鍵值。

## 難度
★★☆☆☆（2星）

## 種類
WEB, DEVTOOL, RE

## 建議工具
- 瀏覽器 DevTools（Elements / Network / Sources / Application / Console）
- CyberChef（From Base64 / From Hex / URL Decode 等）
- Hex 工具（hexed.it）

## 解題步驟
1. 開啟 `http://localhost:8003`，在 `Sources` 找主要腳本。
2. 搜尋 `if (`、`password`、`token`、`checkLogin` 等關鍵字。
3. 找到比對值後，觀察是否經過 ROT13、Hex 或字串反轉。
4. 將可疑值貼入 CyberChef，套用對應轉換還原明文。
5. 取得 `flag{...}` 即完成。

## 驗證與常見卡點
- 驗證方式：最終輸出需符合 `flag{...}` 格式，且與題目提示一致。
- 常見卡點：Base64 可能是 URL-safe 版本，必要時先補 `=` 再解碼。
- 常見卡點：Hex 需先去除空白與非 0-9A-F 字元。

## 學習重點
- 前端驗證不可當作真正安全機制。
- 讀懂 JavaScript 流程可快速定位敏感邏輯。

## Flag
`flag{frontend_auth_is_not_security}`

