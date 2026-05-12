# ✅ Web-26 解題說明 — 背景

## 題目描述
這是一個看起來像食記部落格的頁面，背景圖 `background.png` 內藏有隱藏的 PNG 文本元數據。請下載檔案並提取元數據。

## 難度
★★☆☆☆（2星）

## 種類
Forensics

## 建議工具
- CyberChef（From Base64 / From Hex / URL Decode 等）
- Metadata 檢視工具（exif.tools / metadata2go）
- Hex 工具（hexed.it）

## 解題步驟
1. 開啟 `https://llcmhlau.edu.hk/mockCTF/Web-26`。
2. 注意頁面背景圖已改成 `background.png`，不要被部落格內容分散注意力。
3. 下載 `background.png`。
4. 上傳到線上 PNG/metadata 檢查工具（例如 https://exif.tools/）。
5. 在元數據的 Author 欄位找到 Base64 編碼字串。
6. 將其貼到 CyberChef，使用 `From Base64` 解碼。

## 驗證與常見卡點
- 驗證方式：最終輸出需符合 `flag{...}` 格式，且與題目提示一致。
- 常見卡點：Base64 可能是 URL-safe 版本，必要時先補 `=` 再解碼。
- 常見卡點：Hex 需先去除空白與非 0-9A-F 字元。
- 常見卡點：請檢查所有 metadata 欄位，不要只看單一欄位。

## 學習重點
- PNG 檔案也可以包含文本元數據，不只 JPEG 才有隱藏資訊。
- 背景圖、縮圖與頁面內容可以混淆視線，增加分析成本。
- 元數據可能洩漏敏感資訊，即使檔案被下載或分享，仍會保留。

## Flag
`flag{png_exif_metadata}`


