# ✅ Web-26 解題說明 — 圖片 EXIF 元數據

## 題目描述
打掃描的校方印章 PNG 檔案包含了隱藏的 EXIF 元數據。請下載檔案並提取元數據。

## 解題步驟
1. 開啟 `http://localhost:8026`。
2. 下載 `seal.png`。
3. 上傳到線上 EXIF 查看工具（https://exif.tools/）。
4. 在元數據的 Author 欄位找到 Base64 編碼字串。
5. 將其貼到 CyberChef，使用 `From Base64` 解碼。

## 學習重點
- 圖片檔案含有 EXIF 元數據（相機資訊、拍攝時間、作者等）。
- 這些元數據可能洩漏敏感資訊。
- 即使檔案被下載或分享，元數據仍會保留。

## Flag
`flag{png_exif_metadata}`
