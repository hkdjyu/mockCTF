# ✅ Web-05 解題說明 — LocalStorage 的秘密

## 題目描述
網站會把除錯資料存在瀏覽器本機儲存。請在 DevTools 的儲存區找到可疑值，並用 CyberChef 轉換取得旗標。

## 難度
★★☆☆☆（2星）

## 種類
WEB, DEVTOOL

## 建議工具
- 瀏覽器 DevTools（Elements / Network / Sources / Application / Console）
- CyberChef（From Base64 / From Hex / URL Decode 等）
- Hex 工具（hexed.it）

## 解題步驟
1. 開啟題目頁，按 `F12` 進入 DevTools。
2. 到 `Application`（或 `Storage`）→ `Local Storage`。
3. 尋找 key 名稱像 `debug_token`、`backup`、`note` 的資料。
4. 複製 value 到 CyberChef，先試 `From Base64`，不行再試 `From Base58`。
5. 當輸出為 `flag{...}` 時即完成。

## 驗證與常見卡點
- 驗證方式：最終輸出需符合 `flag{...}` 格式，且與題目提示一致。
- 常見卡點：Base64 可能是 URL-safe 版本，必要時先補 `=` 再解碼。
- 常見卡點：Hex 需先去除空白與非 0-9A-F 字元。
- 常見卡點：確認在正確網域下重新整理後再讀取 Storage。

## 學習重點
- LocalStorage 對使用者可讀，不適合放機密。
- 需根據字元特徵判斷編碼類型。

## Flag
`flag{localstorage_is_public}`

