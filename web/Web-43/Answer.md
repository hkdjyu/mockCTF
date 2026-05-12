# ✅ Web-43 解題說明 — Line Comment SQL Injection

## 題目描述
這題模擬常見登入漏洞：系統把 `username`、`password` 直接拼進查詢字串。

目標是在不知道 admin 密碼下登入，理解行尾註解如何截斷後續條件。

## 難度
★★★☆☆（3星）

## 種類
WEB, SQL

## 建議工具
- 瀏覽器
- DevTools（檢查表單送出內容）
- SQL 註解基礎（`--`、`#`）

## 解題步驟
1. 開啟 `https://llcmhlau.edu.hk/mockCTF/Web-43`。
2. 觀察查詢預覽：
   `SELECT username, role FROM members WHERE username = "..." AND password = "..." LIMIT 1;`
3. 在 `username` 欄位輸入可閉合字串並加上行尾註解：
   - `admin"#`
4. 密碼欄位可隨意輸入（例如 `anything`）。
5. 查詢會被改寫成僅檢查 username，後面的密碼條件被 `#` 註解掉。
6. 若命中 admin，即可看到旗標。

## 為什麼這條語句不成功
你提到的例子：

```sql
SELECT username, role FROM members WHERE username = 'admin'' AND password = '' OR 1=1 #' LIMIT 1;
```

在目前版本（雙引號包字串）下，這種單引號語法本身就不符合注入上下文。

關鍵問題有兩個：
- 這裡的 `admin''` 代表字串裡的單引號字元（等價於 `admin'` 這個文字），不是「成功跳出字串後再接 OR 條件」。
- `#` 在本題會被當作行尾註解，後面的內容（包含你原本想保留的尾巴）會被移除，容易令整段 SQL 結構不如預期。

所以它通常不會形成你想要的「穩定可控的布林繞過」。

本題較穩定做法是：
- 在 `username` 輸入：`admin"#`
- `password` 任意

這樣會直接把密碼條件註解掉，查詢只剩 `username='admin'`，更符合本題設計的教學路徑。

## 驗證與常見卡點
- 驗證方式：頁面顯示 `Admin panel unlocked` 與旗標。
- 常見卡點：忘記先用單引號結束原字串。
- 常見卡點：嘗試使用 `--` 會被系統阻擋。
- 常見卡點：不同資料庫註解語法支援有差異；本題強制要求 `#`（MySQL 風格）來學習多資料庫差異。

## 學習重點
- 行尾註解可用來忽略原查詢後半段邏輯。
- SQL Injection 核心是「輸入變成語法」，而非只是在欄位填特殊字元。
- 防禦方式應採用 prepared statements / parameterized queries。

## Flag
`flag{line_comment_login_bypass}`
