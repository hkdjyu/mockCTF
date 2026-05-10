# ✅ Web-28 解題說明 — 音訊 ID3 標籤

## 題目描述
MP3 音訊檔案的 ID3 標籤中隱藏了機密資訊。請下載檔案並檢查其 ID3 元數據。

## 難度
★☆☆☆☆（1星）

## 種類
Forensics

## 建議工具
- CyberChef（From Base64 / From Hex / URL Decode 等）
- Metadata 檢視工具（exif.tools / metadata2go）
- Hex 工具（hexed.it）

## 解題步驟
1. 開啟 `http://localhost:8028`。
2. 下載 `anthem.mp3`。
3. 上傳到線上 MP3 元數據查看工具或使用本地音訊編輯器。
4. 在 Comments 欄位找到 Base64 編碼字串。
5. 將其貼到 CyberChef，使用 `From Base64` 解碼。

## 驗證與常見卡點
- 驗證方式：最終輸出需符合 `flag{...}` 格式，且與題目提示一致。
- 常見卡點：Base64 可能是 URL-safe 版本，必要時先補 `=` 再解碼。
- 常見卡點：Hex 需先去除空白與非 0-9A-F 字元。
- 常見卡點：請檢查所有 metadata 欄位，不要只看單一欄位。

## 學習重點
- MP3 檔案含有 ID3 標籤（title、artist、comment 等）。
- Comments 欄位常被忽視，可藏匿資訊。

## Flag
`flag{mp3_id3_tags}`

