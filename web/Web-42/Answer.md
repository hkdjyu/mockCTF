# ✅ Web-42 解題說明 — 局部修補失敗的 Numeric SQL Injection

## 題目描述
這題模擬真實維護情境：舊系統曾爆出 SQL Injection，開發者只先修了 `username`（把單引號做轉義），但仍把 `pin` 直接拼接進查詢。

目標是在不知道 admin 真實 PIN 的情況下登入，理解「局部修補」為何仍會被攻破。

## 難度
★★★☆☆（3星）

## 種類
WEB, SQL Injection

## 建議工具
- 瀏覽器
- DevTools（觀察欄位送出內容）
- 基本 SQL 邏輯概念（`AND`、`OR`、運算優先順序）

## 解題步驟
1. 開啟 `https://llcmhlau.edu.hk/mockCTF/Web-42`。
2. 觀察右側查詢預覽：
   `SELECT username, role FROM accounts WHERE username = '...' AND pin = ... LIMIT 1;`
3. 注意 `pin` 不是參數化處理，也沒有引號保護，仍可被當作 SQL 表達式。
4. 以 `admin` 為帳號，嘗試在 `pin` 注入邏輯條件：
   - Username: `admin`
   - PIN: `0 OR 1=1 -- `
5. 查詢可被改寫成：
   `SELECT username, role FROM accounts WHERE username = 'admin' AND pin = 0 OR 1=1 --  LIMIT 1;`
6. `1=1` 為永真條件，導致驗證邏輯被繞過，系統回傳 admin 並顯示旗標。

## 為甚麼這次在 Username 輸入 `' OR 1=1 --` 不會成功
1. 這題後端對 `username` 做了單引號轉義，`'` 會被處理成 SQL 字串內容，而不是查詢語法的一部分。
2. 也就是說，`username` 欄位的注入路徑被暫時堵住，但 `pin` 欄位仍然外露。
3. 這正是實務常見錯誤：只修一個輸入點，沒有全面改為參數化查詢。

## 為甚麼 Username 留空、PIN 輸入 `1 OR 1=1` 也可能通過
1. 當 `username` 留空時，查詢可能變成：
   `WHERE username = '' AND pin = 1 OR 1=1`
2. 在 SQL 中，`AND` 的優先順序高於 `OR`，所以等價於：
   `(username = '' AND pin = 1) OR 1=1`
3. 因為 `1=1` 永遠成立，整個 `WHERE` 條件就會成立，即使 `username` 是空值。
4. 再加上 `LIMIT 1` 只取第一筆，系統可能直接回傳第一個帳號（本題資料中剛好是 admin）。

這個現象不是「題目壞掉」，而是典型 SQL Injection 後果：一旦邏輯被改寫，攻擊者不一定要走你預期的欄位流程。

## 驗證與常見卡點
- 驗證方式：頁面顯示 `已解鎖管理員保險庫` 與旗標。
- 常見卡點：延續上一題思路，反覆在 `username` 注入。
- 常見卡點：`--` 後面缺少空白或註解未正確生效。
- 常見卡點：忽略 `AND` 與 `OR` 優先順序，導致誤判查詢邏輯。

## 學習重點
- SQL Injection 的風險來自「拼接查詢」，不分字串欄位或數值欄位。
- 局部過濾（只逃脫某欄位）不是完整修補，攻擊者會轉向其他輸入點。
- 正確防禦是全查詢改用 prepared statements / parameterized queries。

## 與真實開發的對照
- 不安全做法：`username` 逃脫、`pin` 直接拼接。
- 安全做法：`username` 與 `pin` 都用參數綁定（例如 `WHERE username = ? AND pin = ?`）。
- 實務流程：修補後要做回歸測試，涵蓋所有查詢入口，不可只測單一欄位。

## Flag
`flag{numeric_pin_sqli_bypass}`
