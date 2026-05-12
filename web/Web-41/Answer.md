# ✅ Web-41 解題說明 — SQL Injection Login

## 題目描述
這是一條入門 SQL Injection 題。頁面把使用者輸入的 `username` 與 `password` 直接拼接到查詢語句內，目標是繞過正常密碼驗證，直接以 `admin` 身分登入。

## 難度
★★☆☆☆（2星）

## 種類
WEB, SQL Injection

## 建議工具
- 瀏覽器
- DevTools（可觀察表單送出內容）
- 基本 SQL 邏輯概念

## 解題步驟
1. 開啟 `https://llcmhlau.edu.hk/mockCTF/Web-41`。
2. 觀察右側顯示的查詢語句：
   `SELECT * FROM users WHERE username = '...' AND password = '...' LIMIT 1;`
3. 發現輸入內容會直接進入 SQL，因此可以嘗試在其中一個欄位注入永真條件。
4. 例如輸入以下 payload：
   - Username: `' OR '1'='1' -- `
   - Password: `anything`
5. 注入後，原本的條件會被改寫成永遠成立，系統便誤判為登入成功並顯示 admin 旗標。

## 驗證與常見卡點
- 驗證方式：頁面會顯示 `Admin panel unlocked` 與旗標。
- 常見卡點：忘記補單引號，導致語法邏輯無法閉合。
- 常見卡點：沒有使用註解把後半段條件截斷。

## 學習重點
- SQL Injection 的核心是「未過濾輸入直接拼接到查詢語句」。
- 常見利用方式包括永真條件、UNION、時間延遲與錯誤回顯。
- 防禦方式是 prepared statements / parameterized queries，而不是只靠黑名單過濾字串。

## Flag
`flag{sqli_login_bypass}`