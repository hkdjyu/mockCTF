# ✅ Web-04 解題說明 — CSS 不只是樣式

## 題目描述
頁面樣式檔中藏有看似無意義的字串。請從 Network 找出 CSS 內的編碼資料，還原出最終旗標。

## 解題步驟
1. 開啟題目頁後，在 `Network` 篩選 `CSS`。
2. 點入主要樣式檔，搜尋 `/*`、`debug`、`secret`、`unicode`。
3. 複製可疑片段（如 `\u0066\u006c...` 或 Hex 字串）。
4. 將字串貼到 CyberChef，使用 `From Unicode` 或 `From Hex`。
5. 轉換結果為 `flag{...}` 即解題成功。

## 學習重點
- 靜態資源（CSS/JS）也可能包含敏感資訊。
- Unicode Escape 與 Hex 是常見初階混淆方式。

## Flag
`flag{css_can_leak_secrets}`
