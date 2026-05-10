# ✅ Web-09 解題說明 — 假 API 真線索

## 題目描述
頁面會偷偷呼叫一個 API。回應 JSON 裡有一個欄位平常不顯示，但它正是解出旗標的關鍵。

## 難度
★☆☆☆☆（1星）

## 種類
WEB

## 建議工具
- 瀏覽器 DevTools（Elements / Network / Sources / Application / Console）
- CyberChef（From Base64 / From Hex / URL Decode 等）
- Hex 工具（hexed.it）

## 解題步驟
1. 開啟題目頁，進入 `Network`，篩選 `Fetch/XHR`。
2. 找到可疑 API（如 `/api/status`、`/api/profile`）。
3. 檢視 `Response`，留意未顯示在頁面的欄位（例如 `debug_data`）。
4. 把該欄位值貼到 CyberChef，依提示做 `From Base64` 或 `JWT Decode`。
5. 取得 `flag{...}` 即完成。

## 驗證與常見卡點
- 驗證方式：最終輸出需符合 `flag{...}` 格式，且與題目提示一致。
- 常見卡點：Base64 可能是 URL-safe 版本，必要時先補 `=` 再解碼。
- 常見卡點：Hex 需先去除空白與非 0-9A-F 字元。
- 常見卡點：改參數後要看 Response 內容，不只看狀態碼。

## 學習重點
- 前端不顯示 ≠ 不可取得。
- API 回應常是資訊外洩重點來源。

## Flag
`flag{hidden_json_field_found}`

