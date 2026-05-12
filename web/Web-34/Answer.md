# ✅ Web-34 解題說明 — WebP圖片

## 題目描述
WebP 圖片可能在 metadata 或亮度層裡藏有資訊。此題需先取得圖檔，再透過調整顯示或檢查 metadata 找出隱藏文字。

## 難度
★★☆☆☆（2星）

## 種類
Forensics

## 建議工具
- 瀏覽器 DevTools（Network）
- 圖像工具（Photopea / GIMP / LunaPic）
- Metadata 工具（exif.tools）

## 解題步驟
1. 開啟 `https://llcmhlau.edu.hk/mockCTF/Web-34`。
2. 下載 `paraglide.webp`。
3. 先檢查 metadata（EXIF/XMP）欄位是否有可疑字串。
4. 若 metadata 無明顯結果，使用LunaPic調整 Levels/Contrast 檢查暗區或角落。
5. 讀取隱藏字串並整理成旗標格式。

## 驗證與常見卡點
- 驗證方式：應輸出完整 `flag{...}`。
- 常見卡點：只看原圖不調亮度，會漏掉低對比文字。
- 常見卡點：WebP 也可能帶 metadata，別只以為是純影像。

## 學習重點
- WebP 可同時藏像素層與 metadata 層線索。
- 圖像題常需「視覺處理 + 結構檢查」雙軌並行。
- 低對比隱藏是常見 CTF 技巧。

## Flag
`flag{this_is_paragliding}`

