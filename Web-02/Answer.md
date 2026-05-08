# ✅ Web-02 解題說明 — 註解中的註解

## 題目描述
首頁沒有明顯線索，但原始碼藏了多層註解與編碼片段。請找出真正有效的字串，再用 CyberChef 解出旗標。

## 解題步驟
1. 開啟 `http://localhost:8002`，在 `View Page Source` 搜尋 `TODO`、`debug`、`note`。
2. 找到看似被註解包住的可疑字串（例如 URL 編碼後再 Base64 的內容）。
3. 複製字串到 CyberChef，先用 `URL Decode`，再用 `From Base64`。
4. 若輸出仍是亂碼，再嘗試 `From Hex` 或 `From Base32`。
5. 還原為 `flag{...}` 格式即成功。

## 學習重點
- 註解與假註解常被用來藏線索。
- 多層編碼要判斷正確解碼順序。

## Flag
`flag{comment_1n_comm3nt}`
