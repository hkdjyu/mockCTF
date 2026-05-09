# ✅ Web-19 解題說明 — 重送請求的第二答案

## 題目描述
正常操作時系統只會回傳「查無資料」，但某個 API 請求的參數若稍作調整，回應內容就會完全不同。請找出真正的答案。

## 難度
★★★★☆（4星）

## 種類
WEB, DEVTOOL

## 建議工具
- 瀏覽器 DevTools（Elements / Network / Sources / Application / Console）
- CyberChef（From Base64 / From Hex / URL Decode 等）
- Hex 工具（hexed.it）

## 解題步驟
1. 開啟 `http://localhost:8019`，按 `F12` 進入 DevTools。
2. 在 `Network` 找到 `/api/report.php?id=1`。
3. 檢查回應的 JSON，會看到提示 `hint: "try id=7 with debug view"`。
4. 或直接檢查 HTML 源碼註解，會看到 `<!-- archived id list: last known internal entry #7 -->`。
5. 在 `Console` 也會看到提示 `[api hint] try id=7 with debug view`。
6. 使用 `Edit and Resend`，把參數改成 `/api/report.php?id=7&view=debug`。
7. 新回應中會出現 `archive` 欄位：`ZmxhZ3tyZXNlbmRfcmVxdWVzdHNfY2hhbmdlX2Fuc3dlcnN9`。
8. 將字串貼到 CyberChef，使用 `From Base64` 解碼。

## 驗證與常見卡點
- 驗證方式：最終輸出需符合 `flag{...}` 格式，且與題目提示一致。
- 常見卡點：Base64 可能是 URL-safe 版本，必要時先補 `=` 再解碼。
- 常見卡點：Hex 需先去除空白與非 0-9A-F 字元。
- 常見卡點：改參數後要看 Response 內容，不只看狀態碼。

## 學習重點
- 同一個 API 可能因參數不同而回傳不同資料。
- `Network` 的請求重送功能非常適合做驗證與觀察。
- 不應將除錯模式直接暴露給前端參數控制。

## Flag
`flag{resend_requests_change_answers}`

