# ✅ Web-16 解題說明 — JWT 自白書

## 題目描述
系統回傳了一段看似登入用途的 token。你不需要偽造它，只要正確解析內容，就能從中找到關鍵資訊。

## 難度
★☆☆☆☆（1星）

## 種類
WEB

## 建議工具
- 瀏覽器 DevTools（Elements / Network / Sources / Application / Console）
- CyberChef（From Base64 / From Hex / URL Decode 等）
- Hex 工具（hexed.it）

## 解題步驟
1. 開啟 `https://llcmhlau.edu.hk/mockCTF/Web-16`，按 `F12` 進入 DevTools。
2. 前往 `Application` → `Local Storage`，找到 `portal.jwt`。
3. JWT 由三段組成，取中間的 payload：
   `eyJ1c2VyIjoic3R1ZGVudCIsInJvbGUiOiJndWVzdCIsIm5vdGUiOiJkZWNvZGVfbWUiLCJmbGFnIjoiZmxhZ3tqd3RfcGF5bG9hZHNfYXJlX3B1YmxpY30ifQ`
4. 將 payload 貼到 CyberChef，使用 `From Base64` 或 `From Base64 (URL Safe)` 解碼。
5. 在 JSON 內容中讀出 `flag` 欄位。

## 驗證與常見卡點
- 驗證方式：最終輸出需符合 `flag{...}` 格式，且與題目提示一致。
- 常見卡點：Base64 可能是 URL-safe 版本，必要時先補 `=` 再解碼。
- 常見卡點：Hex 需先去除空白與非 0-9A-F 字元。
- 常見卡點：確認在正確網域下重新整理後再讀取 Storage。

## 學習重點
- JWT 的 payload 並非加密，任何人都能解讀。
- Token 不應存放敏感明文資訊。
- `Base64URL` 和一般 `Base64` 很接近，但符號規則不同。

## Flag
`flag{jwt_payloads_are_public}`


