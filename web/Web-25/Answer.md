# ✅ Web-25 解題說明 — 向量圖裡的文本

## 題目描述
SVG 向量圖中藏有隱藏的文本元素。請下載 SVG 檔案，檢查其原始碼。

## 難度
★☆☆☆☆（1星）

## 種類
Forensics

## 建議工具
- CyberChef（From Base64 / From Hex / URL Decode 等）
- Hex 工具（hexed.it）

## 解題步驟
1. 開啟 `https://llcmhlau.edu.hk/mockCTF/Web-25`。
2. 下載 `logo.svg`。
3. 用文本編輯器開啟（記事本、VSCode 等）。
4. 尋找隱藏的 `<text>` 元素，其中 `x` 和 `y` 座標為負數（超出視圖外）。
5. 該元素包含 Base64 編碼的資訊。
6. 將其貼到 CyberChef，使用 `From Base64` 解碼。

## 驗證與常見卡點
- 驗證方式：最終輸出需符合 `flag{...}` 格式，且與題目提示一致。
- 常見卡點：Base64 可能是 URL-safe 版本，必要時先補 `=` 再解碼。
- 常見卡點：Hex 需先去除空白與非 0-9A-F 字元。

## 學習重點
- SVG 是基於 XML 的向量圖格式，完全可以編輯與查看原始碼。
- 即使元素不可見，代碼仍然存在。

## Flag
`flag{svg_hidden_text}`


