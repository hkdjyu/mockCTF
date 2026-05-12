# ✅ Web-13 解題說明 — Hash Fragment 的密語

## 題目描述
首頁看起來沒有任何異狀，但網址尾端的 fragment 會觸發不同邏輯。請找出只有在特定片段下才會出現的內部資料，並還原最終旗標。

## 難度
★☆☆☆☆（1星）

## 種類
WEB

## 建議工具
- 瀏覽器 DevTools（Elements / Network / Sources / Application / Console）
- CyberChef（From Base64）

## 解題步驟
1. 開啟 `https://llcmhlau.edu.hk/mockCTF/Web-13`，按 `F12` 進入 DevTools。
2. 先查看頁面原始碼，會看到 `#staff-preview` 是一個特別路由，但看不到旗標字串本體。
3. 把網址改成 `https://llcmhlau.edu.hk/mockCTF/Web-13/#staff-preview`。
4. 切到 `Network` 面板，會看到頁面發出請求（`?route=staff-preview`）。
5. 打開該請求回應，取得 Base64 字串 `ZmxhZ3toYXNoX3JvdXRlc19jYW5faGlkZV9wYXRoc30=`。
6. 將字串貼到 CyberChef，套用 `From Base64` 解碼得到旗標。

## 驗證與常見卡點
- 驗證方式：最終輸出需符合 `flag{...}` 格式，且與題目提示一致。
- 常見卡點：不切到 `#staff-preview` 不會觸發請求，也拿不到字串。
- 常見卡點：字串不在 `Elements` 直接可見，應從 `Network` 的 response 找。
- 常見卡點：Base64 解碼時要包含尾端 `=`。

## 學習重點
- `location.hash` 常被前端拿來做路由或狀態切換。
- 前端路由可搭配後端 API，讓資料只在特定條件下回傳。
- 敏感字串不直接寫在前端程式中，可降低被直接檢視源碼取得的風險。

## Flag
`flag{hash_routes_can_hide_paths}`


