# ✅ Web-19 解題說明 — 重送請求的第二答案

## 題目描述
正常操作時系統只會回傳「查無資料」，但某個 API 請求的參數若稍作調整，回應內容就會完全不同。請找出真正的答案。

## 解題步驟
1. 開啟 `http://localhost:8019`，按 `F12` 進入 DevTools。
2. 在 `Network` 找到 `/api/report.php?id=1`。
3. 檢查回應的 JSON，會看到提示 `hint: "try id=7 with debug view"`。
4. 或直接檢查 HTML 源碼註解，會看到 `<!-- archived id list: last known internal entry #7 -->`。
5. 在 `Console` 也會看到提示 `[api hint] try id=7 with debug view`。
6. 使用 `Edit and Resend`，把參數改成 `/api/report.php?id=7&view=debug`。
7. 新回應中會出現 `archive` 欄位：`ZmxhZ3tyZXNlbmRfcmVxdWVzdHNfY2hhbmdlX2Fuc3dlcnN9`。
8. 將字串貼到 CyberChef，使用 `From Base64` 解碼。

## 學習重點
- 同一個 API 可能因參數不同而回傳不同資料。
- `Network` 的請求重送功能非常適合做驗證與觀察。
- 不應將除錯模式直接暴露給前端參數控制。

## Flag
`flag{resend_requests_change_answers}`