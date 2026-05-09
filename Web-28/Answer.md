# ✅ Web-28 解題說明 — 音訊 ID3 標籤

## 題目描述
MP3 音訊檔案的 ID3 標籤中隱藏了機密資訊。請下載檔案並檢查其 ID3 元數據。

## 解題步驟
1. 開啟 `http://localhost:8028`。
2. 下載 `anthem.mp3`。
3. 上傳到線上 MP3 元數據查看工具或使用本地音訊編輯器。
4. 在 Comments 欄位找到 Base64 編碼字串。
5. 將其貼到 CyberChef，使用 `From Base64` 解碼。

## 學習重點
- MP3 檔案含有 ID3 標籤（title、artist、comment 等）。
- Comments 欄位常被忽視，可藏匿資訊。

## Flag
`flag{mp3_id3_tags}`
