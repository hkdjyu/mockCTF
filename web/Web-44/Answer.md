# ✅ Web-44 解題說明 — 行內註解繞過

## 題目描述
這題模擬報表查詢 API：後端將 `invoice_id` 直接拼進 SQL，並用黑名單阻擋字串 `OR 1=1`。

目標是讀取 `is_internal = 1` 的內部單據，證明黑名單防禦不足。

## 難度
★★★☆☆（3星）

## 種類
WEB, SQL

## 建議工具
- 瀏覽器
- DevTools（觀察請求內容）
- SQL inline comment 概念（`/* ... */`）

## 解題步驟
1. 開啟 `https://llcmhlau.edu.hk/mockCTF/Web-44`。
2. 觀察查詢預覽：
   `SELECT ... FROM invoices WHERE id = ... AND is_internal = 0;`
3. 直接輸入 `OR 1=1` 會被黑名單擋下。
4. 用 inline comment 混淆關鍵字並截斷後續條件，例如：
   - `1/**/OR/**/1=1--`
5. 查詢邏輯被改寫，`is_internal = 0` 條件被註解忽略，結果集會包含內部資料。
6. 讀到 `is_internal = 1` 後即可取得旗標。

## 驗證與常見卡點
- 驗證方式：結果區會列出所有命中資料；只要其中有 `is_internal: 1` 即會出現旗標。
- 常見卡點：只嘗試 `OR 1=1`（被黑名單擋下）。
- 常見卡點：`/*` 使用後語法未正確閉合，造成 SQL 錯誤。
- 常見卡點：把重點放在猜 ID，而不是改寫查詢邏輯。

## 學習重點
- 黑名單比對固定字串，容易被註解分割與語法變形繞過。
- Inline comment 可同時達成混淆與截斷效果。
- 正確作法是參數化查詢，不是持續補黑名單規則。

## Flag
`flag{inline_comment_blacklist_bypass}`
