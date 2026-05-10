# ✅ Web-27 解題說明 — Mario 像素檔案

## 題目描述
BMP 位圖檔案使用隱寫方式藏了線索。這題假設學生不寫程式，改用線上工具完成。

## 難度
★★★☆☆（3星）

## 種類
Forensics

## 建議工具
- CyberChef（From Base64 / From Hex / URL Decode 等）
- Hex 工具（hexed.it）

## 解題步驟
1. 開啟 `http://localhost:8027`。
2. 下載 `mario.bmp`。
3. 前往線上十六進位檢視工具 `https://hexed.it/`，把 `mario.bmp` 拖進去。
4. 後面可以看到一段 Base64 字串。
5. 將該字串貼到 CyberChef，使用 `From Base64` 解碼。

## 驗證與常見卡點
- 驗證方式：最終輸出需符合 `flag{...}` 格式，且與題目提示一致。
- 常見卡點：Base64 可能是 URL-safe 版本，必要時先補 `=` 再解碼。
- 常見卡點：Hex 需先去除空白與非 0-9A-F 字元。

## 學習重點
- 即使不用寫程式，也能用線上十六進位工具找出隱藏資料。
- 線索可放在 BMP header 與像素資料之間，不必放在檔案尾端。
- 檔案分析題可先用「搜尋關鍵字」快速定位線索。

## Flag
`flag{bmp_lsb_steganography}`

