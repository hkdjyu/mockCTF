# ✅ Web-12 解題說明 — SessionStorage 的短期記憶

## 題目描述
系統提示「資料只會保留在這次工作階段」。請從瀏覽器暫存儲存區找出可疑片段，並還原出隱藏旗標。

## 難度
★☆☆☆☆（1星）

## 種類
WEB

## 建議工具
- 瀏覽器 DevTools（Elements / Network / Sources / Application / Console）
- CyberChef（From Base64 / From Hex / URL Decode 等）
- Hex 工具（hexed.it）

## 解題步驟
1. 開啟 `http://localhost:8012`，按 `F12` 進入 DevTools。
2. 前往 `Application` → `Session Storage`。
3. 找到 `memo_a`、`memo_b`、`memo_c` 三個鍵值。
4. 按字母順序拼接字串後，得到一段 Base64：`ZmxhZ3tzZXNzaW9uX3N0b3JhZ2VfaXNfc2hvcnRfdGVybX0=`。
5. 將它貼到 CyberChef，使用 `From Base64` 解碼。

## 驗證與常見卡點
- 驗證方式：最終輸出需符合 `flag{...}` 格式，且與題目提示一致。
- 常見卡點：Base64 可能是 URL-safe 版本，必要時先補 `=` 再解碼。
- 常見卡點：Hex 需先去除空白與非 0-9A-F 字元。
- 常見卡點：確認在正確網域下重新整理後再讀取 Storage。

## 學習重點
- `sessionStorage` 只在目前分頁工作階段中存在。
- 瀏覽器儲存區常會留下測試或除錯資訊。
- 看似普通的鍵名也可能藏有線索。

## Flag
`flag{session_storage_is_short_term}`

