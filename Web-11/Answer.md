# ✅ Web-11 解題說明 — 被隱藏的表單欄位

## 題目描述
頁面上的關鍵欄位被設成 `type="hidden"` 且 `disabled`，正常情況下無法輸入。請透過 DevTools 修改欄位型別並提交正確格式的學生編號，觸發偵錯輸出取得旗標。

## 難度
★★☆☆☆（2星）

## 種類
WEB

## 建議工具
- 瀏覽器 DevTools（Elements / Network / Sources / Application / Console）

## 解題步驟
1. 開啟 `http://localhost:8011`，按 `F12` 進入 DevTools。
2. 在 `Elements` 檢查表單，找到 `recovery_code` 欄位，原本是 `type="hidden"` 且帶有 `disabled`。
3. 將欄位改為 `type="text"`，然後輸入學生編號（格式：`s` + 6 位數字，例如 `s123456`）。
4. 送出表單，若格式正確會顯示驗證成功提示。
5. 同時頁面會跳出提示，並在瀏覽器 `Console` 輸出旗標：`flag{disabled_fields_still_talk}`。

## 驗證與常見卡點
- 驗證方式：`Console` 中可看到 `flag{disabled_fields_still_talk}`。
- 常見卡點：只改欄位 value 不夠，仍需把 `type` 由 `hidden` 改為 `text`。
- 常見卡點：學生編號格式必須精確符合 `^s\d{6}$`（開頭小寫 `s` + 6 位數字）。

## 學習重點
- `disabled` 欄位不會被表單提交。
- 使用者端的 DOM 可以被觀察與修改。
- 不應只依賴前端欄位狀態（hidden/disabled）作為安全機制。

## Flag
`flag{disabled_fields_still_talk}`

