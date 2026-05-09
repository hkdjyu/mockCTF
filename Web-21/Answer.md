# ✅ Web-21 解題說明 — 文本檔的編碼祕密

## 題目描述
學校筆記備份中藏有多層編碼的線索。請下載文本檔，找出被分段編碼的旗標。

## 解題步驟
1. 開啟 `http://localhost:8021`。
2. 下載 `notes.txt`。
3. 用文本編輯器開啟，找到兩段編碼：
   - `Flag Part 1 (Hex): ...`
   - `Flag Part 2 (Base64): ...`
4. 將 Hex 部分貼到 CyberChef，使用 `From Hex` 解碼。
5. 將 Base64 部分貼到 CyberChef，使用 `From Base64` 解碼。
6. 拼接兩部分得到完整旗標。

## 學習重點
- 文本檔可能包含多種編碼方式。
- 同時使用多種編碼會增加難度。

## Flag
`flag{text_encoding_chain}`
