# ✅ Web-06 解題說明 — Cookie 拼圖

## 題目描述
系統把線索拆成多段放在不同 Cookie。請找到規則並拼回完整字串，再用 CyberChef 解出旗標。

## 難度
★★☆☆☆（2星）

## 種類
WEB, DEVTOOL, CRYPTO

## 建議工具
- 瀏覽器 DevTools（Elements / Network / Sources / Application / Console）
- CyberChef（From Base64 / From Hex / URL Decode 等）
- Hex 工具（hexed.it）

## 解題步驟
1. 開啟題目頁，進入 `Application` → `Cookies`。
2. 找到多個可疑欄位（例如 `part1`、`part2`、`part3`）。
3. 依名稱或編號順序拼接 value。
4. 將拼接後結果貼到 CyberChef，套用 `From Base64`。
5. 解出 `flag{...}` 即完成。

## 驗證與常見卡點
- 驗證方式：最終輸出需符合 `flag{...}` 格式，且與題目提示一致。
- 常見卡點：Base64 可能是 URL-safe 版本，必要時先補 `=` 再解碼。
- 常見卡點：Hex 需先去除空白與非 0-9A-F 字元。
- 常見卡點：確認在正確網域下重新整理後再讀取 Storage。

## 學習重點
- Cookie 內容可被讀取，不應存放敏感資料。
- 分段儲存常用於迷惑初學者。

## Flag
`flag{cookies_make_a_puzzle}`

