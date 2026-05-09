# ✅ Web-16 解題說明 — JWT 自白書

## 題目描述
系統回傳了一段看似登入用途的 token。你不需要偽造它，只要正確解析內容，就能從中找到關鍵資訊。

## 解題步驟
1. 開啟 `http://localhost:8016`，按 `F12` 進入 DevTools。
2. 前往 `Application` → `Local Storage`，找到 `portal.jwt`。
3. JWT 由三段組成，取中間的 payload：
   `eyJ1c2VyIjoic3R1ZGVudCIsInJvbGUiOiJndWVzdCIsIm5vdGUiOiJkZWNvZGVfbWUiLCJmbGFnIjoiZmxhZ3tqd3RfcGF5bG9hZHNfYXJlX3B1YmxpY30ifQ`
4. 將 payload 貼到 CyberChef，使用 `From Base64` 或 `From Base64 (URL Safe)` 解碼。
5. 在 JSON 內容中讀出 `flag` 欄位。

## 學習重點
- JWT 的 payload 並非加密，任何人都能解讀。
- Token 不應存放敏感明文資訊。
- `Base64URL` 和一般 `Base64` 很接近，但符號規則不同。

## Flag
`flag{jwt_payloads_are_public}`