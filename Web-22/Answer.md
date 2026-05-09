# ✅ Web-22 解題說明 — 試算表隱藏欄

## 題目描述
學生成績表中存在隱藏的第五欄。請下載 CSV 檔案，找出並解碼其中的旗標。

## 解題步驟
1. 開啟 `http://localhost:8022`。
2. 下載 `students.csv`。
3. 用文本編輯器開啟，或拖入線上 CSV 查看器。
4. 觀察表頭，會看到第五欄 `Internal`。
5. 查看 Alice Chen 那列，第五欄是 Base64 編碼：`flag{csv_hidden_columns}` 的編碼版。
6. 將字串貼到 CyberChef，使用 `From Base64` 解碼。

## 學習重點
- CSV 完全基於純文本，隱藏欄位只需在第一行增加欄位名。
- GUI 試算表軟體有時不會立即顯示所有欄位。

## Flag
`flag{csv_hidden_columns}`
