# ✅ Web-23 解題說明 — PDF 元數據洩漏

## 題目描述
年度報告書的 PDF 檔案在其元數據中隱藏了機密資訊。請下載並檢查檔案的元數據。

## 難度
★☆☆☆☆（1星）

## 種類
Forensics

## 建議工具
- CyberChef（From Base64 / From Hex / URL Decode 等）
- Metadata 檢視工具（exif.tools / metadata2go）

## 解題步驟
1. 開啟 `https://llcmhlau.edu.hk/mockCTF/Web-23`。
2. 下載 `file.pdf`。
3. 使用線上 PDF 元數據檢查工具（如 https://exif.tools/ 或 https://metadatakit.com/metadata）。
4. 在 Subject 欄位找到flag

## 驗證與常見卡點
- 驗證方式：最終輸出需符合 `flag{...}` 格式，且與題目提示一致。
- 常見卡點：請檢查所有 metadata 欄位，不要只看單一欄位。
- 常見卡點：若結果像亂碼，通常是解碼順序或複製內容有誤。

## 學習重點
- PDF 檔案含有元數據（metadata），包括作者、標題、建立日期等。
- 這些元數據可能洩漏敏感資訊。

## Flag
`flag{pdf_metadata_leaked}`


