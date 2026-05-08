# ✅ Web-08 解題說明 — Source Map 洩漏

## 題目描述
網站前端已壓縮混淆，但意外保留 source map。請透過 DevTools 還原原始程式，找出遺留的旗標資訊。

## 解題步驟
1. 在 `Sources` 查看壓縮後 JS，注意檔尾 `sourceMappingURL`。
2. 開啟對應 `.map` 檔案，找到 `sourcesContent`。
3. 從還原後原始碼搜尋 `flag`、`debug`、`secret`。
4. 若值仍經編碼，複製到 CyberChef 用 `From Base64` 或 `From Hex`。
5. 還原出 `flag{...}`。

## 學習重點
- 部署時保留 source map 可能外洩原始碼與註解。
- 混淆並不等於安全。

## Flag
`flag{sourcemap_leaks_source}`
