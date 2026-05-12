# ✅ Web-31 解題說明 — 校訓及校徽

## 題目描述
此題將線索藏在 JPEG 的 EXIF metadata 中。畫面上不一定會直接顯示圖片，挑戰者需要用 DevTools 的 Network 找到檔案，再從 metadata 欄位取出可解碼字串。

## 難度
★★☆☆☆（2星）

## 種類
WEB, Forensics

## 建議工具
- 瀏覽器 DevTools（Network / Sources）
- EXIF 工具（exif.tools / metadata2go）
- CyberChef（From Hex）

## 解題步驟
1. 開啟 `https://llcmhlau.edu.hk/mockCTF/Web-31` 並按 `F12`。
2. 在 `Network` 找到並下載 `llc.jpg`。
3. 將檔案上傳到 `exif.tools` 或 `metadata2go`。
4. 在 `UserComment`（或相關註解欄位）找到 Hex 字串。
5. 把 Hex 字串貼到 CyberChef，用 `From Hex` 解碼取得旗標。

## 驗證與常見卡點
- 驗證方式：解碼後需符合 `flag{...}`。
- 常見卡點：別只看 `Make/Model`，旗標常在 `Comment/UserComment` 類欄位。
- 常見卡點：Hex 字串要先去掉空白後再解碼。

## 學習重點
- JPEG 不只影像像素，metadata 也是常見藏資料位置。
- DevTools Network 能看到前端不直接呈現的資源。
- 編碼解碼流程要和檔案分析結合。

## Flag
`flag{llc_jpeg_exif_hidden_text}`

