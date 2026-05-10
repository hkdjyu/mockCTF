# ✅ Web-29 解題說明 — RIFF 元數據

## 題目描述
WAV 音訊檔案是 RIFF 格式。該格式的 LIST chunk 中含有隱藏資訊。請下載檔案並提取元數據。

## 難度
★☆☆☆☆（1星）

## 種類
Forensics

## 建議工具
- Metadata 檢視工具（[metadatakit.com](https://metadatakit.com/metadata) / exif.tools）
- CyberChef（From Base64）
- Hex 工具（hexed.it）——進階分析用

## 解題步驟

### 快速方法（使用線上 Metadata 工具）
1. 開啟 `http://localhost:8029`，下載 `announcement.wav`。
2. 前往 `https://metadatakit.com/metadata`，上傳 `announcement.wav`。
3. 工具會自動解析 RIFF INFO chunk，在結果中找到 `Comment`（對應 `ICMT` 欄位）。
4. 複製其中的 Base64 字串，貼到 CyberChef，套用 `From Base64` 解碼，得到旗標。

### 進階方法（使用 Hex 工具理解底層結構）
1. 前往 `https://hexed.it/`，把 `announcement.wav` 拖進去。
2. 搜尋 `ICMT`（這是 RIFF INFO 的 Comment 子欄位）。
3. 在 `ICMT` 後方有 4 bytes 長度值（little-endian），再後面是 ASCII 內容。
4. 在 ASCII 視窗讀取 Base64 字串（通常以 `=` 或 `==` 結尾，後面有空字元 `00`）。
5. 複製 Base64 到 CyberChef，使用 `From Base64` 解碼，得到旗標。

## 驗證與常見卡點
- 驗證方式：最終輸出需符合 `flag{...}` 格式，且與題目提示一致。
- 常見卡點：Base64 可能是 URL-safe 版本，必要時先補 `=` 再解碼。
- 常見卡點：Hex 需先去除空白與非 0-9A-F 字元。
- 常見卡點：請檢查所有 metadata 欄位，不要只看單一欄位。

## 學習重點
- WAV 是 RIFF 格式，可包含多種 chunk（data、LIST、INFO 等）。
- LIST INFO chunk 的子欄位（如 `ICMT`）可存放作者、日期、註解等 metadata。
- 線上 metadata 工具（metadatakit.com、exif.tools）能一鍵解析檔案的 metadata，是鑑識入門的好工具。
- hexed.it 等十六進位工具適合理解 RIFF 底層結構，進一步學習格式細節。

## Flag
`flag{wav_riff_chunks}`

