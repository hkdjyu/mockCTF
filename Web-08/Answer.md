# ✅ Web-08 解題說明 — Source Map 洩漏

## 題目描述
網站前端已壓縮混淆，但意外保留 source map。請透過 DevTools 還原原始程式，找出遺留的旗標資訊。

## 難度
★☆☆☆☆（1星）

## 種類
WEB

## 建議工具
- 瀏覽器 DevTools（Elements / Network / Sources / Application / Console）
- CyberChef（From Base64 / From Hex / URL Decode 等）
- Hex 工具（hexed.it）

## 解題步驟
1. 在 `Sources` 查看壓縮後 JS，注意檔尾 `sourceMappingURL`。
2. 開啟對應 `.map` 檔案，找到 `sourcesContent`。
3. 從還原後原始碼得到 `leaked = 'ZmxhZ3tzb3VyY2VtYXBfbGVha3Nfc291cmNlfQ==';`。
4. 若值仍經編碼，複製到 CyberChef 用 `From Base64` 。
5. 還原出 `flag{...}`。

## 驗證與常見卡點
- 驗證方式：最終輸出需符合 `flag{...}` 格式，且與題目提示一致。
- 常見卡點：Base64 可能是 URL-safe 版本，必要時先補 `=` 再解碼。
- 常見卡點：Hex 需先去除空白與非 0-9A-F 字元。

## 學習重點
- 部署時保留 source map 可能外洩原始碼與註解。
- 混淆並不等於安全。

## Flag
`flag{sourcemap_leaks_source}`

