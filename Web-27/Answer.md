# ✅ Web-27 解題說明 — 位圖隱寫

## 題目描述
BMP 位圖檔案使用隱寫方式藏了線索。這題假設學生不寫程式，改用線上工具完成。

## 解題步驟
1. 開啟 `http://localhost:8027`。
2. 下載 `campus.bmp`。
3. 前往線上十六進位檢視工具 `https://hexed.it/`，把 `campus.bmp` 拖進去。
4. 用搜尋功能找字串 `CTF_NOTE`。
5. 在 `CTF_NOTE:` 後面可以看到一段 Base64 字串。
6. 將該字串貼到 CyberChef，使用 `From Base64` 解碼。

## 學習重點
- 即使不用寫程式，也能用線上十六進位工具找出隱藏資料。
- 線索可放在 BMP header 與像素資料之間，不必放在檔案尾端。
- 檔案分析題可先用「搜尋關鍵字」快速定位線索。

## Flag
`flag{bmp_lsb_steganography}`
