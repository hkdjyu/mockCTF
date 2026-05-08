# ✅ Web-03 解題說明 — 假登入的前端判斷

## 題目描述
這個登入頁看似有驗證，其實只靠前端 JavaScript 判斷。請分析條件比對邏輯，找出能通關的關鍵值。

## 解題步驟
1. 開啟 `http://localhost:8003`，在 `Sources` 找主要腳本。
2. 搜尋 `if (`、`password`、`token`、`checkLogin` 等關鍵字。
3. 找到比對值後，觀察是否經過 ROT13、Hex 或字串反轉。
4. 將可疑值貼入 CyberChef，套用對應轉換還原明文。
5. 取得 `flag{...}` 即完成。

## 學習重點
- 前端驗證不可當作真正安全機制。
- 讀懂 JavaScript 流程可快速定位敏感邏輯。

## Flag
`flag{frontend_auth_is_not_security}`
