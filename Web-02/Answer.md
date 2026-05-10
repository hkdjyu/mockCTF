# ✅ Web-02 解題說明 — 註解中的註解

## 題目描述
首頁沒有明顯線索，但原始碼藏了多層註解與編碼片段。請找出真正有效的字串，再用 CyberChef 解出旗標。

## 難度
★☆☆☆☆（1星）

## 種類
WEB

## 建議工具
- CyberChef（From Base64 / From Hex / URL Decode 等）
- Metadata 檢視工具（exif.tools / metadata2go）
- Hex 工具（hexed.it）

## 解題步驟
1. 開啟 `http://localhost:8002`，在 `View Page Source` 搜尋 `TODO`、`debug`、`note`。
2. 找到看似被註解包住的可疑字串（例如 URL 編碼後再 Base64 的內容）。
3. 複製字串到 CyberChef，先用 `URL Decode`，再用 `From Base64`。
4. 若輸出仍是亂碼，再嘗試 `From Hex` 或 `From Base32`。
5. 還原為 `flag{...}` 格式即成功。

## 驗證與常見卡點
- 驗證方式：最終輸出需符合 `flag{...}` 格式，且與題目提示一致。
- 常見卡點：Base64 可能是 URL-safe 版本，必要時先補 `=` 再解碼。
- 常見卡點：Hex 需先去除空白與非 0-9A-F 字元。
- 常見卡點：請檢查所有 metadata 欄位，不要只看單一欄位。

## 學習重點
- Base64 是編碼不是加密。
- 註解與假註解常被用來藏線索。
- 多層編碼要判斷正確解碼順序。

## Flag
`flag{comment_1n_comm3nt}`

