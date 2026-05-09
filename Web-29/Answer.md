# ✅ Web-29 解題說明 — RIFF 元數據

## 題目描述
WAV 音訊檔案是 RIFF 格式。該格式的 LIST chunk 中含有隱藏資訊。請下載檔案並提取元數據。

## 解題步驟
1. 開啟 `http://localhost:8029`。
2. 下載 `announcement.wav`。
3. 前往線上十六進位工具 `https://hexed.it/`，把 `announcement.wav` 拖進去。
4. 先搜尋 `ICMT`（這是 RIFF INFO 的 Comment 子欄位）。
5. 在 `ICMT` 後方會有 4 bytes 長度值（little-endian），再後面就是 ASCII 文字內容。
6. 在 ASCII 視窗直接讀取該段 Base64 字串（通常以 `=` 或 `==` 結尾，且後面有空字元 `00`）。
7. 複製 Base64 到 CyberChef，使用 `From Base64` 解碼，得到旗標。

## 線上工具版小技巧（給學生）
- 在 `hexed.it` 先切換右側 ASCII 檢視，文字會更好辨識。
- 若只看到 `ICMT` 但不確定內容長度，可先直接看 ASCII 連續可讀區段。
- 複製時只取 Base64 本體，不要包含 `00`、空白或控制字元。

## 學習重點
- WAV 是 RIFF 格式，可包含多種 chunk（data、LIST、INFO 等）。
- LIST chunk 可用於存儲元數據如作者、註解等。
- 線上十六進位工具即可完成基礎音訊檔鑑識，不一定要安裝本機軟體。

## Flag
`flag{wav_riff_chunks}`
