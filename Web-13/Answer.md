# ✅ Web-13 解題說明 — Hash Fragment 的密語

## 題目描述
首頁看起來沒有任何異狀，但網址尾端的 fragment 其實藏有重要線索。請分析前端如何處理 `#...` 內容，找出真正的提示字串。

## 解題步驟
1. 開啟 `http://localhost:8013`，按 `F12` 進入 DevTools。
2. 在 `Sources` 查看頁面中的 JavaScript，找到 `routes` 物件。
3. 發現 `#staff-preview` 對應一段經過 `decodeURIComponent()` 處理的字串。
4. 把網址改成 `http://localhost:8013/#staff-preview`。
5. 頁面會顯示 Base64 字串，貼到 CyberChef 後使用 `From Base64` 解碼。

## 學習重點
- `location.hash` 常被前端拿來做路由或狀態切換。
- 即使不會送到伺服器，網址片段仍可決定前端顯示內容。
- `URL Decode` 與 `Base64 Decode` 常會串在一起使用。

## Flag
`flag{hash_routes_can_hide_paths}`