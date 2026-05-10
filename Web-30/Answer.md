# ✅ Web-30 解題說明 — 壓縮檔迷宮

## 題目描述
最後的終極挑戰將多種檔案分析技巧綜合在一起，但這次所有線索都被包進同一個 `compress.zip`。玩家需要先解壓，再按順序分析裡面的四個檔案。

## 難度
★★☆☆☆（2星）

## 種類
MISC

## 建議工具
- CyberChef（From Base64 / From Hex / URL Decode 等）
- Metadata 檢視工具（exif.tools / metadata2go）
- Hex 工具（hexed.it）

## 解題步驟
1. 開啟 `http://localhost:8030`。
2. 下載 `compress.zip`。
3. 解壓縮後，可以得到 4 個檔案：
   - `part1.txt`
   - `part2.csv`
   - `part3.svg`
   - `part4.mp3`

4. **提取 Part 1 (TXT - Hex)**
   - 開啟 `part1.txt`
   - 找到 Hex 編碼字串
   - 用 CyberChef `From Hex` 解碼：`flag{`

5. **提取 Part 2 (CSV - Base64)**
   - 開啟 `part2.csv`
   - 第二列含 Base64 編碼
   - 用 CyberChef `From Base64` 解碼：`multi_format`

6. **提取 Part 3 (SVG - QR Code)**
   - 將 `part3.svg` 上傳到線上QR code decoder 工具（例如 `https://qrcoderaptor.com/`）
   - 找到字串`_maze`

7. **提取 Part 4 (MP3 - ID3 Comment)**
   - 將 `part4.mp3` 上傳到線上音訊 metadata 工具（例如 `https://www.metadata2go.com/`）
   - 在 ID3 的 `Comment`（或 `COMM`）欄位讀取 Base64 字串
   - 用 CyberChef `From Base64` 解碼，得到：`_challenge}`

8. **組合並最終解碼**
   - 依順序拼接：`flag{` + `multi_format` + `_maze` + `_challenge}`
   - 得到完整旗標

## 驗證與常見卡點
- 驗證方式：最終輸出需符合 `flag{...}` 格式，且與題目提示一致。
- 常見卡點：Base64 可能是 URL-safe 版本，必要時先補 `=` 再解碼。
- 常見卡點：Hex 需先去除空白與非 0-9A-F 字元。
- 常見卡點：QR Code Decode 除了可以使用電話相機，也有線上工具。
- 常見卡點：請檢查所有 metadata 欄位，不要只看單一欄位。

## 學習重點
- 需要先辨識並解壓壓縮檔，再綜合運用多種檔案格式的知識。
- 理解編碼順序和拼接邏輯。
- 整合推理能力。

## Flag
`flag{multi_format_maze_challenge}`

