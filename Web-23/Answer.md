# ✅ Web-23 解題說明 — PDF 元數據洩漏

## 題目描述
年度報告書的 PDF 檔案在其元數據中隱藏了機密資訊。請下載並檢查檔案的元數據。

## 解題步驟
1. 開啟 `http://localhost:8023`。
2. 下載 `file.pdf`。
3. 使用線上 PDF 元數據檢查工具（如 https://exif.tools/ 或 https://metadatakit.com/metadata）。
4. 在 Subject 欄位找到flag

## 學習重點
- PDF 檔案含有元數據（metadata），包括作者、標題、建立日期等。
- 這些元數據可能洩漏敏感資訊。

## Flag
`flag{pdf_metadata_leaked}`
