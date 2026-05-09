# ✅ Web-17 解題說明 — manifest.json 說太多了

## 題目描述
這是一個看似普通的 PWA 網站，但某個前端設定檔透露了過多資訊。請從靜態資源中找出隱藏路徑或提示，取得旗標。

## 解題步驟
1. 開啟 `http://localhost:8017`，按 `F12` 進入 DevTools。
2. 在 `Network` 或 `Sources` 找到 `/manifest.json`。
3. 讀取其中的 `shortcuts` 欄位，可看到隱藏路徑 `/draft.php?from=manifest`。
4. 直接開啟該路徑，頁面會顯示 Base64 字串。
5. 將字串貼到 CyberChef，使用 `From Base64` 解碼。

## 學習重點
- `manifest.json`、`robots.txt`、`sitemap.xml` 都可能洩漏路徑資訊。
- PWA 設定檔屬於前端資源，任何人都能查看。
- 靜態設定中的測試路徑不應直接保留到正式環境。

## Flag
`flag{manifest_files_leak_routes}`