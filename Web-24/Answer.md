# ✅ Web-24 解題說明 — 隱藏工作表

## 題目描述
XLSX 檔案中包含隱藏的工作表。請找到並解碼隱藏工作表中的資訊。

## 難度
★★☆☆☆（2星）

## 種類
Forensics

## 建議工具
- CyberChef（From Base64 / From Hex / URL Decode 等）
- Hex 工具（hexed.it）

## 解題步驟
1. 開啟 `http://localhost:8024`。
2. 下載 `records.xlsx`。
3. 在 Excel、Google Sheets 或線上 Excel 查看器中開啟。
4. 通常會看到一個名叫「Public」的工作表。
5. 查看工作表標籤，尋找隱藏的工作表（有時右鍵選單會顯示「取消隱藏」）。
6. 在隱藏工作表找到 Base64 編碼的資料。
7. 將其貼到 CyberChef，使用 `From Base64` 解碼。

## 驗證與常見卡點
- 驗證方式：最終輸出需符合 `flag{...}` 格式，且與題目提示一致。
- 常見卡點：Base64 可能是 URL-safe 版本，必要時先補 `=` 再解碼。
- 常見卡點：Hex 需先去除空白與非 0-9A-F 字元。

## 學習重點
- Excel/XLSX 檔案可以隱藏整個工作表。
- 隱藏不等於刪除，資料仍在檔案中。

## Flag
`flag{excel_hidden_sheets}`

