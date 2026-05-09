# ✅ Web-04 解題說明 — CSS 不只是樣式

## 題目描述
頁面樣式檔中藏有看似無意義的字串。請從 Network 找出 CSS 內的編碼資料，還原出最終旗標。

## 難度
★★☆☆☆（2星）

## 種類
WEB, DEVTOOL, CRYPTO

## 建議工具
- 瀏覽器 DevTools（Elements / Network / Sources / Application / Console）
- CyberChef（From Base64 / From Hex / URL Decode 等）
- Hex 工具（hexed.it）

## 解題步驟
1. 開啟題目頁後，在 `Network` 篩選 `CSS`。
2. 點入主要樣式檔，搜尋 `/*`、`debug`、`secret`、`unicode`。
3. 複製可疑片段（如 `\u0066\u006c...` 或 Hex 字串）。
4. 將字串貼到 CyberChef，使用 `From Unicode` 或 `From Hex`。
5. 轉換結果為 `flag{...}` 即解題成功。

## 驗證與常見卡點
- 驗證方式：最終輸出需符合 `flag{...}` 格式，且與題目提示一致。
- 常見卡點：Base64 可能是 URL-safe 版本，必要時先補 `=` 再解碼。
- 常見卡點：Hex 需先去除空白與非 0-9A-F 字元。

## 學習重點
- 靜態資源（CSS/JS）也可能包含敏感資訊。
- Unicode Escape 與 Hex 是常見初階混淆方式。

## Flag
`flag{css_can_leak_secrets}`

