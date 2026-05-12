# ✅ Web-32 解題說明 — PNG tEXt 隱寫

## 題目描述
此題提供兩張看似類似的 PNG。真正線索在 PNG metadata（如 tEXt/iTXt/Artist）欄位中的可疑字串，需再做字母替換或位移解碼。

## 難度
★★★☆☆（3星）

## 種類
Forensics, CRYPTO

## 建議工具
- 瀏覽器 DevTools（Network）
- PNG metadata 工具（exif.tools / metadata2go）
- CyberChef（ROT13 / Caesar Shift）

## 解題步驟
1. 開啟 `https://llcmhlau.edu.hk/mockCTF/Web-32`。
2. 下載 `PNG.png`（必要時也可比對其他同頁檔案）。
3. 上傳到 metadata 工具，查看 `Artist`、`Comment`、`tEXt` 欄位。
4. 找到可疑字串後，使用 CyberChef 做 ROT/位移轉換(amount = -5)。
5. 還原出 `flag{...}`。

## 驗證與常見卡點
- 驗證方式：輸出需為完整 `flag{...}` 並有可讀語意。
- 常見卡點：不要只看 EXIF，PNG 常見是 tEXt / iTXt。
- 常見卡點：位移方向錯誤會得到看似亂碼但接近英文的字串。

## 學習重點
- PNG 可在多種 metadata chunk 放入文字線索。
- 圖片題常結合「metadata + 簡單密碼學」兩步驟。
- 可疑字串要嘗試不同編碼/位移方法。

## Flag
`flag{correct_flag_for_png}`

