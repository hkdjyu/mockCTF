# ✅ Web-11 解題說明 — 被隱藏的表單欄位

## 題目描述
頁面上只有一個普通表單，但無論怎麼填寫都無法通過驗證。請檢查頁面 DOM 結構，找出被隱藏的欄位與真正的條件，取得最終旗標。

## 難度
★★☆☆☆（2星）

## 種類
WEB, DEVTOOL

## 建議工具
- 瀏覽器 DevTools（Elements / Network / Sources / Application / Console）
- CyberChef（From Base64 / From Hex / URL Decode 等）
- Hex 工具（hexed.it）

## 解題步驟
1. 開啟 `http://localhost:8011`，按 `F12` 進入 DevTools。
2. 在 `Elements` 檢查表單，可看到 `recovery_code` 欄位帶有一串 Hex 值，但它被設成 `disabled`，而且type是`hidden`
3. 移除 `disabled` 屬性，改為`type=text`後重新送出表單，頁面會顯示偵錯輸出。
4. 將輸出的 Hex 字串貼到 CyberChef，使用 `From Hex` 解碼。

## 驗證與常見卡點
- 驗證方式：最終輸出需符合 `flag{...}` 格式，且與題目提示一致。
- 常見卡點：Base64 可能是 URL-safe 版本，必要時先補 `=` 再解碼。
- 常見卡點：Hex 需先去除空白與非 0-9A-F 字元。

## 學習重點
- `disabled` 欄位不會被表單提交。
- 使用者端的 DOM 可以被觀察與修改。
- 前端表單內不應放敏感資訊。

## Flag
`flag{disabled_fields_still_talk}`

