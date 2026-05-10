# ✅ Web-22 解題說明 — 試算表隱藏欄

## 題目描述
學生成績表中存在隱藏的第五欄。請下載 CSV 檔案，找出並解碼其中的旗標。

## 難度
★☆☆☆☆（1星）

## 種類
WEB, MISC

## 建議工具
- 瀏覽器 DevTools（Elements / Network / Sources / Application / Console）
- CyberChef（From Base64 / From Hex / URL Decode 等）
- Hex 工具（hexed.it）

## 解題步驟
1. 開啟 `http://localhost:8022`。
2. 在Elements中閲讀代碼，前往`http://localhost:8022/files/students.csv`
3. 下載 `students.csv`。
4. 用文本編輯器開啟，或拖入線上 CSV 查看器。
5. 觀察表頭，會看到第五欄 `Internal`。
6. 查看 Alice Chen 那列，第五欄是 Base64 編碼：`flag{csv_hidden_columns}` 的編碼版。
7. 將字串貼到 CyberChef，使用 `From Base64` 解碼。

## 驗證與常見卡點
- 驗證方式：最終輸出需符合 `flag{...}` 格式，且與題目提示一致。
- 常見卡點：Base64 可能是 URL-safe 版本，必要時先補 `=` 再解碼。
- 常見卡點：Hex 需先去除空白與非 0-9A-F 字元。

## 學習重點
- CSV 完全基於純文本，隱藏欄位只需在第一行增加欄位名。
- GUI 試算表軟體有時不會立即顯示所有欄位。

## Flag
`flag{csv_hidden_columns}`

