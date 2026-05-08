# ✅ Web-09 解題說明 — 假 API 真線索

## 題目描述
頁面會偷偷呼叫一個 API。回應 JSON 裡有一個欄位平常不顯示，但它正是解出旗標的關鍵。

## 解題步驟
1. 開啟題目頁，進入 `Network`，篩選 `Fetch/XHR`。
2. 找到可疑 API（如 `/api/status`、`/api/profile`）。
3. 檢視 `Response`，留意未顯示在頁面的欄位（例如 `debug_data`）。
4. 把該欄位值貼到 CyberChef，依提示做 `From Base64` 或 `JWT Decode`。
5. 取得 `flag{...}` 即完成。

## 學習重點
- 前端不顯示 ≠ 不可取得。
- API 回應常是資訊外洩重點來源。

## Flag
`flag{hidden_json_field_found}`
