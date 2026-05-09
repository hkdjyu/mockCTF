# ✅ Web-30 解題說明 — 最終檔案迷宮

## 題目描述
最後的終極挑戰將前 9 題的技術綜合在一起。線索分散在四種不同格式的檔案中，需要按順序提取並組合。

## 解題步驟
1. 開啟 `http://localhost:8030`。
2. 下載全部 4 個檔案：
   - `part1.txt`
   - `part2.csv`
   - `part3.png`
   - `part4.mp3`

3. **提取 Part 1 (TXT - Hex)**
   - 開啟 `part1.txt`
   - 找到 Hex 編碼字串
   - 用 CyberChef `From Hex` 解碼：`flag{`

4. **提取 Part 2 (CSV - Base64)**
   - 開啟 `part2.csv`
   - 第二列含 Base64 編碼
   - 用 CyberChef `From Base64` 解碼：`multi_format`

5. **提取 Part 3 (PNG - Metadata)**
   - 將 `part3.png` 上傳到線上圖片 metadata 工具（例如 `https://www.metadata2go.com/` 或 `https://exif.tools/`）
   - 找到 PNG 的 `Comment`（tEXt）欄位，讀取 Base64 字串
   - 用 CyberChef `From Base64` 解碼，得到：`_maze`

6. **提取 Part 4 (MP3 - ID3 Comment)**
   - 將 `part4.mp3` 上傳到線上音訊 metadata 工具（例如 `https://www.metadata2go.com/`）
   - 在 ID3 的 `Comment`（或 `COMM`）欄位讀取 Base64 字串
   - 用 CyberChef `From Base64` 解碼，得到：`_challenge}`

7. **組合並最終解碼**
   - 依順序拼接：`flag{` + `multi_format` + `_maze` + `_challenge}`
   - 得到完整旗標

## 學習重點
- 需要綜合運用多種檔案格式的知識。
- 理解編碼順序和拼接邏輯。
- 整合推理能力。

## Flag
`flag{multi_format_maze_challenge}`
