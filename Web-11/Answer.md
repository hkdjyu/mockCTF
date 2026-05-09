# ✅ Web-11 解題說明 — 被隱藏的表單欄位

## 題目描述
頁面上只有一個普通表單，但無論怎麼填寫都無法通過驗證。請檢查頁面 DOM 結構，找出被隱藏的欄位與真正的條件，取得最終旗標。

## 解題步驟
1. 開啟 `http://localhost:8011`，按 `F12` 進入 DevTools。
2. 在 `Elements` 檢查表單，可看到 `recovery_code` 欄位帶有一串 Hex 值，但它被設成 `disabled`，而且type是`hidden`
3. 移除 `disabled` 屬性，改為`type=text`後重新送出表單，頁面會顯示偵錯輸出。
4. 將輸出的 Hex 字串貼到 CyberChef，使用 `From Hex` 解碼。

## 學習重點
- `disabled` 欄位不會被表單提交。
- 使用者端的 DOM 可以被觀察與修改。
- 前端表單內不應放敏感資訊。

## Flag
`flag{disabled_fields_still_talk}`