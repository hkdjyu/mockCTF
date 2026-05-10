# ✅ Web-06 解題說明 — Cookie 拼圖

## 題目描述
這是一個登入頁面，成功登入後系統會把 Token 拆成三段分別存入不同的 Cookie。請找出帳號與密碼，登入後從 Cookie 拼回完整字串，再用 CyberChef 解出旗標。

## 難度
★★★☆☆（3星）

## 種類
WEB

## 建議工具
- 瀏覽器 DevTools（Elements / Sources / Application → Cookies）
- CyberChef（From Base64）

## 解題步驟
1. 開啟題目頁，看到登入表單。
2. 在 DevTools 的 `Elements` 或 `Sources` 面板中查看頁面原始碼。
3. 找到 HTML 注釋 `<!-- 預設帳號：admin -->`，確認用戶名為 `admin`。
4. 密碼需要猜測——嘗試常見弱密碼，例如 `admin`、`password`、`123456` 等。
5. 使用 `admin` / `admin` 成功登入。
6. 登入成功後，進入 DevTools → `Application` → `Cookies`。
7. 找到 `part1`、`part2`、`part3` 三個欄位，依序拼接其 value。
8. 將拼接後結果貼到 CyberChef，套用 `From Base64`。
9. 解出 `flag{...}` 即完成。

## 驗證與常見卡點
- 驗證方式：最終輸出需符合 `flag{...}` 格式。
- 常見卡點：登入失敗時 Cookie 不會被設置，確保登入成功再查看。
- 常見卡點：登入失敗會清除已有的 Cookie parts，必須重新登入。
- 常見卡點：Base64 拼接順序需按 `part1` → `part2` → `part3`。

## 學習重點
- HTML 注釋（`<!-- -->`）在前端原始碼中完全可見，不應包含敏感提示。
- Cookie 在登入後才被設置，代表需先通過驗證才能取得資料。
- 弱密碼（如 admin/admin）是真實攻擊中最常見的入侵手法之一。
- 分段儲存 Cookie 是一種常見的 CTF 出題技巧。

## Flag
`flag{cookies_make_a_puzzle}`

