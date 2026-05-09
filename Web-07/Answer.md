# ✅ Web-07 解題說明 — 回應標頭藏訊息

## 題目描述
頁面內容幾乎沒有資訊，但伺服器回應標頭洩露了關鍵字串。請沿著提示解碼，拿到最終旗標。

## 難度
★★☆☆☆（2星）

## 種類
WEB, DEVTOOL, CRYPTO

## 建議工具
- 瀏覽器 DevTools（Elements / Network / Sources / Application / Console）
- CyberChef（From Base64 / From Hex / URL Decode 等）
- Hex 工具（hexed.it）

## 解題步驟
1. 開啟題目後，在 `Network` 查看主請求。
2. 在 `Response Headers` 尋找自訂欄位（如 `X-Debug`、`X-Trace`）。
3. 複製其值（可能是 Hex 或 XOR 後字串）。
4. 在 CyberChef 先用 `From Hex`；若有提示 key，再接 `XOR`。
5. 得到 `flag{...}` 即成功。

## 驗證與常見卡點
- 驗證方式：最終輸出需符合 `flag{...}` 格式，且與題目提示一致。
- 常見卡點：Base64 可能是 URL-safe 版本，必要時先補 `=` 再解碼。
- 常見卡點：Hex 需先去除空白與非 0-9A-F 字元。

## 學習重點
- 安全檢查不只看 HTML，也要看 HTTP 層。
- 自訂標頭若管控不當容易洩密。

## Flag
`flag{headers_tell_stories}`

