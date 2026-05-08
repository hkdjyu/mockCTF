# 📋 mockCTF — 全部題目與連線資訊

本文檔列出全部 10 題 Web CTF 靶機的詳細資訊與連線方式。

---

## 🌐 連線地址

### 本機連線（教師電腦）
將以下網址貼到瀏覽器網址欄即可：

| 題號 | 題名 | 本機網址 |
|------|------|---------|
| 01 | 開發者遺留除錯檔 | http://localhost:8001 |
| 02 | 註解中的註解 | http://localhost:8002 |
| 03 | 前端假登入判斷 | http://localhost:8003 |
| 04 | CSS 不只是樣式 | http://localhost:8004 |
| 05 | LocalStorage 的秘密 | http://localhost:8005 |
| 06 | Cookie 拼圖 | http://localhost:8006 |
| 07 | 回應標頭藏訊息 | http://localhost:8007 |
| 08 | Source Map 洩漏 | http://localhost:8008 |
| 09 | 假 API 真線索 | http://localhost:8009 |
| 10 | 終極偵測挑戰 | http://localhost:8010 |

### 區網連線（學生電腦）
將上表 `localhost` 改為教師電腦區網 IP，例如：

```
http://192.168.1.100:8001
http://192.168.1.100:8002
...
http://192.168.1.100:8010
```

> **查詢教師電腦 IP：**
> - **macOS：** `ipconfig getifaddr en0` 或 `ifconfig | grep inet`
> - **Windows：** `ipconfig /all` 找 IPv4 Address
> - **Linux：** `hostname -I`

---

## 📝 題目詳細描述

### Web-01 — 開發者遺留除錯檔
**連線地址：** `http://localhost:8001`

**題目描述：**  
學校登入頁看似正常，但開發者把除錯腳本留在線上。請用 DevTools 找出隱藏字串，並用 CyberChef 還原旗標。

**技術重點：**  
HTTP 標頭、HTML 原始碼、JavaScript 來源、Base64 解碼

**所需工具：**  
DevTools (F12)、CyberChef

**難度：** ⭐☆☆☆☆

**解題指南：** [Web-01/Answer.md](Web-01/Answer.md)

---

### Web-02 — 註解中的註解
**連線地址：** `http://localhost:8002`

**題目描述：**  
首頁沒有明顯線索，但原始碼藏了多層註解與編碼片段。請找出真正有效的字串，再用 CyberChef 解出旗標。

**技術重點：**  
HTML 原始碼分析、URL 編碼、Base64 編碼鏈

**所需工具：**  
DevTools、CyberChef

**難度：** ⭐⭐☆☆☆

**解題指南：** [Web-02/Answer.md](Web-02/Answer.md)

---

### Web-03 — 前端假登入判斷
**連線地址：** `http://localhost:8003`

**題目描述：**  
這個登入頁看似有驗證，其實只靠前端 JavaScript 判斷。請分析條件比對邏輯，找出能通關的關鍵值。

**技術重點：**  
JavaScript 邏輯分析、ROT13 解碼、前端驗證陷阱

**所需工具：**  
DevTools (Sources)、CyberChef

**難度：** ⭐⭐☆☆☆

**解題指南：** [Web-03/Answer.md](Web-03/Answer.md)

---

### Web-04 — CSS 不只是樣式
**連線地址：** `http://localhost:8004`

**題目描述：**  
頁面樣式檔中藏有看似無意義的字串。請從 Network 找出 CSS 內的編碼資料，還原出最終旗標。

**技術重點：**  
CSS 檔案檢查、Hex 編碼、Network 分析

**所需工具：**  
DevTools (Network + Sources)、CyberChef

**難度：** ⭐⭐☆☆☆

**解題指南：** [Web-04/Answer.md](Web-04/Answer.md)

---

### Web-05 — LocalStorage 的秘密
**連線地址：** `http://localhost:8005`

**題目描述：**  
網站會把除錯資料存在瀏覽器本機儲存。請在 DevTools 的儲存區找到可疑值，並用 CyberChef 轉換取得旗標。

**技術重點：**  
LocalStorage 檢查、Base64 解碼、瀏覽器存儲安全

**所需工具：**  
DevTools (Application/Storage)、CyberChef

**難度：** ⭐⭐☆☆☆

**解題指南：** [Web-05/Answer.md](Web-05/Answer.md)

---

### Web-06 — Cookie 拼圖
**連線地址：** `http://localhost:8006`

**題目描述：**  
系統把線索拆成多段放在不同 Cookie。請找到規則並拼回完整字串，再用 CyberChef 解出旗標。

**技術重點：**  
Cookie 分析、字串拼接、Base64 解碼

**所需工具：**  
DevTools (Application/Cookies)、CyberChef

**難度：** ⭐⭐☆☆☆

**解題指南：** [Web-06/Answer.md](Web-06/Answer.md)

---

### Web-07 — 回應標頭藏訊息
**連線地址：** `http://localhost:8007`

**題目描述：**  
頁面內容幾乎沒有資訊，但伺服器回應標頭洩露了關鍵字串。請沿著提示解碼，拿到最終旗標。

**技術重點：**  
HTTP 標頭檢查、Hex 編碼、XOR 解碼

**所需工具：**  
DevTools (Network Headers)、CyberChef

**難度：** ⭐⭐☆☆☆

**解題指南：** [Web-07/Answer.md](Web-07/Answer.md)

---

### Web-08 — Source Map 洩漏
**連線地址：** `http://localhost:8008`

**題目描述：**  
網站前端已壓縮混淆，但意外保留 source map。請透過 DevTools 還原原始程式，找出遺留的旗標資訊。

**技術重點：**  
Source Map 分析、JavaScript 還原、混淆反制

**所需工具：**  
DevTools (Sources)、CyberChef（選用）

**難度：** ⭐⭐⭐☆☆

**解題指南：** [Web-08/Answer.md](Web-08/Answer.md)

---

### Web-09 — 假 API 真線索
**連線地址：** `http://localhost:8009`

**題目描述：**  
頁面會偷偷呼叫一個 API。回應 JSON 裡有一個欄位平常不顯示，但它正是解出旗標的關鍵。

**技術重點：**  
Network 監聽、JSON 分析、隱藏欄位發現

**所需工具：**  
DevTools (Network/Console)、CyberChef

**難度：** ⭐⭐⭐☆☆

**解題指南：** [Web-09/Answer.md](Web-09/Answer.md)

---

### Web-10 — 終極偵測挑戰
**連線地址：** `http://localhost:8010`

**題目描述：**  
最後最難題結合多個 DevTools 功能：從 Storage、Network、Console 各地蒐集碎片，拼組後再做多層編碼解碼。此題要求同時運用 DevTools 全套工具。

**技術重點：**  
LocalStorage + SessionStorage、Fetch/XOR 監聽、Console 提示、多層編碼鏈、集成思維

**所需工具：**  
DevTools (Storage + Network + Console)、CyberChef

**難度：** ⭐⭐⭐⭐☆

**解題指南：** [Web-10/Answer.md](Web-10/Answer.md)

---

## 👨‍🏫 建議課堂流程

**45 分鐘版本：**
- Web-01 + Web-02：10 分（基礎編碼意識）
- Web-03 + Web-04：10 分（DevTools Sources + 資源檢查）
- Web-05 + Web-06：10 分（Storage 機制）
- 總結與常見漏洞：15 分

**90 分鐘版本：**
- 上段 45 分內容
- Web-07 + Web-08：15 分（進階標頭與 Source Map）
- Web-09：15 分（API 安全）
- Web-10 分組挑戰：15 分

---

## 📚 學習進度建議

- **入門（Web-01 ~ 03）：** 熟悉 DevTools 基礎操作
- **進階（Web-04 ~ 07）：** 靜態資源與標頭安全
- **高級（Web-08 ~ 10）：** 整合思維與複雜場景

---

## 🔗 其他資源

- [README.md](README.md) —— 系統架設與啟動指南
- [run.command](run.command) —— macOS 快速啟停（`./run.command start`）
- [run.bat](run.bat) —— Windows 快速啟停（`run.bat start`）

