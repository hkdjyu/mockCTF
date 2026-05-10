# ✅ Web-37 解題說明 — Telegraph
## 題目描述
FLAC 除了音訊資料，還可包含 Vorbis Comment 與其他 tag。此題線索可能是文字標籤，或需把音訊節奏轉成摩斯碼進一步解讀。

## 難度
★★☆☆☆（2星）

## 種類
Forensics

## 建議工具
- 瀏覽器 DevTools（Network）
- metadata2go / exif.tools（音訊標籤）
- Audacity（觀察節奏）
- CyberChef（Morse Decode）

## 解題步驟
1. 開啟 `http://localhost:8037`。
2. 下載 `code.flac`。
3. 先看音訊 metadata 是否已有可疑字串。
4. 若提示與摩斯碼有關，利用波形長短節奏轉成 `.-` 序列。
   （可利用spectrogram或wavacity）
5. 用 CyberChef 或 Morse 解碼器還原文字，再組成旗標。

## 驗證與常見卡點
- 驗證方式：最後輸出需是完整 `flag{...}`。
- 常見卡點：摩斯碼分隔（字母/單字）判斷錯誤。
- 常見卡點：先後步驟可能是 metadata 提示 + 音訊解碼。

## 學習重點
- 音訊題常混合 metadata 與訊號節奏分析。
- 摩斯碼在 CTF 仍是高頻出題手法。
- 先找提示再正式解碼能有效降低難度。

## Flag
`flag{moresecodeisclassic}`
