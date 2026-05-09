# ✅ Web-12 解題說明 — SessionStorage 的短期記憶

## 題目描述
系統提示「資料只會保留在這次工作階段」。請從瀏覽器暫存儲存區找出可疑片段，並還原出隱藏旗標。

## 解題步驟
1. 開啟 `http://localhost:8012`，按 `F12` 進入 DevTools。
2. 前往 `Application` → `Session Storage`。
3. 找到 `memo_a`、`memo_b`、`memo_c` 三個鍵值。
4. 按字母順序拼接字串後，得到一段 Base64：`ZmxhZ3tzZXNzaW9uX3N0b3JhZ2VfaXNfc2hvcnRfdGVybX0=`。
5. 將它貼到 CyberChef，使用 `From Base64` 解碼。

## 學習重點
- `sessionStorage` 只在目前分頁工作階段中存在。
- 瀏覽器儲存區常會留下測試或除錯資訊。
- 看似普通的鍵名也可能藏有線索。

## Flag
`flag{session_storage_is_short_term}`