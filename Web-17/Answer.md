# ✅ Web-17 解題說明 — manifest.json 說太多了

## 題目描述
這是一個看似普通的 PWA 網站，但某個前端設定檔透露了過多資訊。請從靜態資源中找出隱藏路徑或提示，取得旗標。

## 難度
★★★☆☆（3星）

## 種類
WEB, CRYPTO

## 建議工具
- 瀏覽器 DevTools（Elements / Network / Sources / Application / Console）
- CyberChef（From Base64 / From Hex / URL Decode 等）
- Hex 工具（hexed.it）

## 解題步驟
1. 開啟 `http://localhost:8017`，按 `F12` 進入 DevTools。
2. 在`Elements` 找到 `I8hkJQjtgotF7Y69NPRCHcB2pxrttax1NOa02sOUt7dy79cc0UzWZrAN8eaNc5G1XPcC7jjXnJXlveZNwdjjbLMxPNAYlrA/5lLsvEbmtyWEvWgzsSRNarZwNIRjrW44ffgkrCQnOMm3AUL/va7VSp4Hjro366WgLjWrVuJNtmI= `
3. 在 `Network` 或 `Sources` 找到 `/manifest.json`。
4. 讀取其中的 `shortcuts` 欄位，可看到隱藏路徑 `/draft.php?from=manifest`。
5. 直接開啟該路徑，頁面會顯示 RSA Key資訊。
```
-----BEGIN PUBLIC KEY-----
MIGfMA0GCSqGSIb3DQEBAQUAA4GNADCBiQKBgQDxTQK46cN1DQKn+yvBHcC8jiuB
VafnPM0Wm83yqFWUrsur085SXFb7vVjRvLjMnFCsW1J/f/s6qJj308ins++gJ3fK
I5m3DBDt21kXfHBKvtjMQYD0WYhmWKoe04xFC40ZyYOeRoY5J57yUKAdWZ1CdpPn
wrjhlDDDy9zMnOW6ZwIDAQAB
-----END PUBLIC KEY-----

-----BEGIN RSA PRIVATE KEY-----
MIICXAIBAAKBgQDxTQK46cN1DQKn+yvBHcC8jiuBVafnPM0Wm83yqFWUrsur085S
XFb7vVjRvLjMnFCsW1J/f/s6qJj308ins++gJ3fKI5m3DBDt21kXfHBKvtjMQYD0
WYhmWKoe04xFC40ZyYOeRoY5J57yUKAdWZ1CdpPnwrjhlDDDy9zMnOW6ZwIDAQAB
AoGAco0kpbQT3hV3FVffxaXiQaEcdiG7u8LZecotUu0m85anicLbR64efRO+fpMh
B8GNasVPvMd89LPlKoGX2EVLk8gncrGgV5uihO1EfSszBs1RkjSzbpOUfBgbkwQy
uYkNvpjpikcDjjamkEKvvXRjxI6r1QRH5asmemc3sPE5AEECQQD8HtFV5V5H4bgX
mLmefJcCVDEQ7Fh0YkCOsy844GCJXV53n6y4BYw5csXL3hzfWCUQle0w1GTkUKt7
naPDJCOrAkEA9QOSPJjz4xr/IVhoAcKUM9vUmtgexEa8CJGJgkSx7Cxgnyt4kAjT
8osrt+e4KnpcX9306GoIiy0ALI0psucINQJAOiLBEpV5UAn0cTx+UNVZ3OedCNH2
859UU5Nt6CeVGxe0mNDw+t4Mn5KfmYr2DWo94b0wnHndaehQIokPIghLUQJAW/Qf
KgbtYUp8ffND9YUlQeE7BXIe+eLiJwUX6oAFlnGBQbt63/OwN9LrcXXRtH9/s6sF
g0RoOHOHITFJeQ8kEQJBALqyeL9cVZq8g+8cCGdrTWRDhYysOmvNLijG8y5VCB2h
yNr4Ht+MbHh9OgbWsuyzwEnqizbr1Vg4yAddTItkERU=
-----END RSA PRIVATE KEY-----
```
1. 將字串貼到 CyberChef，使用`From Base64` 解碼，然後再使用`RSA Decrypt`(SHA-256)。

## 驗證與常見卡點
- 驗證方式：最終輸出需符合 `flag{...}` 格式，且與題目提示一致。
- 常見卡點：直接使用`RSA Decrypt`而未有由`Base64`轉換成二進制資訊
- 常見卡點：`RSA Decrypt` 只嘗試使用`SHA-1` 而沒有嘗試其他Algorithm

## 學習重點
- `manifest.json`、`robots.txt`、`sitemap.xml` 都可能洩漏路徑資訊。
- 信息經過加密後，有機會會再使用`Base64`進行編碼，藉此能夠正常顯示
- PWA 設定檔屬於前端資源，任何人都能查看。
- 靜態設定中的測試路徑不應直接保留到正式環境。

## Flag
`flag{manifest_files_leak_routes}`

