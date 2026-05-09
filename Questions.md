# 📋 mockCTF — 全部題目與連線資訊

本文檔列出全部 40 題 Web CTF 靶機的詳細資訊與連線方式。

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
| 11 | 被隱藏的表單欄位 | http://localhost:8011 |
| 12 | SessionStorage 的短期記憶 | http://localhost:8012 |
| 13 | Hash Fragment 的密語 | http://localhost:8013 |
| 14 | 被快取的舊秘密 | http://localhost:8014 |
| 15 | IndexedDB 資料倉庫 | http://localhost:8015 |
| 16 | JWT 自白書 | http://localhost:8016 |
| 17 | manifest.json 說太多了 | http://localhost:8017 |
| 18 | Service Worker 的假畫面 | http://localhost:8018 |
| 19 | 重送請求的第二答案 | http://localhost:8019 |
| 20 | 最終拼圖：你看的不只是一頁 | http://localhost:8020 |
| 21 | 文本檔的編碼祕密 | http://localhost:8021 |
| 22 | 試算表隱藏欄 | http://localhost:8022 |
| 23 | PDF 元數據洩漏 | http://localhost:8023 |
| 24 | 隱藏工作表 | http://localhost:8024 |
| 25 | 向量圖裡的文本 | http://localhost:8025 |
| 26 | 圖片 EXIF 元數據 | http://localhost:8026 |
| 27 | 位圖隱寫 | http://localhost:8027 |
| 28 | 音訊 ID3 標籤 | http://localhost:8028 |
| 29 | RIFF 元數據 | http://localhost:8029 |
| 30 | 最終檔案迷宮 | http://localhost:8030 |
| 31 | JPEG EXIF 隱寫 | http://localhost:8031 |
| 32 | PNG tEXt 隱寫 | http://localhost:8032 |
| 33 | GIF 幀訊息 | http://localhost:8033 |
| 34 | WebP Metadata | http://localhost:8034 |
| 35 | MP4 Metadata 隱寫 | http://localhost:8035 |
| 36 | MKV 附件隱寫 | http://localhost:8036 |
| 37 | FLAC Tag 隱寫 | http://localhost:8037 |
| 38 | OGG/Opus Metadata | http://localhost:8038 |
| 39 | 光譜圖隱寫 | http://localhost:8039 |
| 40 | 多媒體綜合隱寫 | http://localhost:8040 |

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

### Web-11 — 被隱藏的表單欄位
**連線地址：** `http://localhost:8011`

**題目描述：**  
頁面上只有一個普通表單，但無論怎麼填寫都無法通過驗證。請檢查頁面 DOM 結構，找出被隱藏的欄位與真正的條件，取得最終旗標。

**技術重點：**  
HTML 表單分析、`hidden/disabled` 欄位、DOM 編輯

**所需工具：**  
DevTools (Elements / Network)、CyberChef

**難度：** ⭐⭐☆☆☆

**解題指南：** [Web-11/Answer.md](Web-11/Answer.md)

---

### Web-12 — SessionStorage 的短期記憶
**連線地址：** `http://localhost:8012`

**題目描述：**  
系統提示「資料只會保留在這次工作階段」。請從瀏覽器暫存儲存區找出可疑片段，並還原出隱藏旗標。

**技術重點：**  
Session Storage 檢查、字串拼接、Base64 解碼

**所需工具：**  
DevTools (Application / Storage)、CyberChef

**難度：** ⭐⭐☆☆☆

**解題指南：** [Web-12/Answer.md](Web-12/Answer.md)

---

### Web-13 — Hash Fragment 的密語
**連線地址：** `http://localhost:8013`

**題目描述：**  
首頁看起來沒有任何異狀，但網址尾端的 fragment 其實藏有重要線索。請分析前端如何處理 `#...` 內容，找出真正的提示字串。

**技術重點：**  
URL Fragment、JavaScript 路由邏輯、URL Decode、多層編碼分析

**所需工具：**  
DevTools (Sources / Console)、CyberChef

**難度：** ⭐⭐☆☆☆

**解題指南：** [Web-13/Answer.md](Web-13/Answer.md)

---

### Web-14 — 被快取的舊秘密
**連線地址：** `http://localhost:8014`

**題目描述：**  
開發者聲稱提示早已刪除，但瀏覽器可能仍保留舊版本資源。請從快取中找出被遺忘的內容，還原最終旗標。

**技術重點：**  
Cache Storage、資源版本差異、靜態資源檢查

**所需工具：**  
DevTools (Application / Sources / Network)、CyberChef

**難度：** ⭐⭐⭐☆☆

**解題指南：** [Web-14/Answer.md](Web-14/Answer.md)

---

### Web-15 — IndexedDB 資料倉庫
**連線地址：** `http://localhost:8015`

**題目描述：**  
網站會把部分資料存進瀏覽器資料庫。請在前端資料儲存區中找到不該公開的測試資訊，並分析出旗標。

**技術重點：**  
IndexedDB 檢查、JSON 結構分析、隱藏欄位發現

**所需工具：**  
DevTools (Application / IndexedDB)、CyberChef

**難度：** ⭐⭐⭐☆☆

**解題指南：** [Web-15/Answer.md](Web-15/Answer.md)

---

### Web-16 — JWT 自白書
**連線地址：** `http://localhost:8016`

**題目描述：**  
系統回傳了一段看似登入用途的 token。你不需要偽造它，只要正確解析內容，就能從中找到關鍵資訊。

**技術重點：**  
JWT 結構、Base64URL 解碼、Payload 分析

**所需工具：**  
DevTools (Network / Application)、CyberChef

**難度：** ⭐⭐⭐☆☆

**解題指南：** [Web-16/Answer.md](Web-16/Answer.md)

---

### Web-17 — manifest.json 說太多了
**連線地址：** `http://localhost:8017`

**題目描述：**  
這是一個看似普通的 PWA 網站，但某個前端設定檔透露了過多資訊。請從靜態資源中找出隱藏路徑或提示，取得旗標。

**技術重點：**  
`manifest.json`、Meta 資訊、靜態資源分析、路徑探索

**所需工具：**  
DevTools (Network / Sources)、CyberChef

**難度：** ⭐⭐☆☆☆

**解題指南：** [Web-17/Answer.md](Web-17/Answer.md)

---

### Web-18 — Service Worker 的假畫面
**連線地址：** `http://localhost:8018`

**題目描述：**  
你眼前看到的畫面，未必就是伺服器真正回傳的內容。請找出攔截請求的機制，並從快取或腳本中還原真相。

**技術重點：**  
Service Worker、請求攔截、離線頁面、Cache Storage 配合分析

**所需工具：**  
DevTools (Application / Sources / Network)、CyberChef

**難度：** ⭐⭐⭐⭐☆

**解題指南：** [Web-18/Answer.md](Web-18/Answer.md)

---

### Web-19 — 重送請求的第二答案
**連線地址：** `http://localhost:8019`

**題目描述：**  
正常操作時系統只會回傳「查無資料」，但某個 API 請求的參數若稍作調整，回應內容就會完全不同。請找出真正的答案。

**技術重點：**  
Network 請求分析、Edit and Resend、Query 參數修改、JSON 檢查

**所需工具：**  
DevTools (Network)、CyberChef

**難度：** ⭐⭐⭐⭐☆

**解題指南：** [Web-19/Answer.md](Web-19/Answer.md)

---

### Web-20 — 最終拼圖：你看的不只是一頁
**連線地址：** `http://localhost:8020`

**題目描述：**  
最終挑戰將線索分散在頁面 DOM、瀏覽器儲存區與 API 回應之中。請蒐集所有碎片，依照正確順序拼組，並完成多層解碼還原最終旗標。

**技術重點：**  
DOM 分析、Storage 檢查、Network 回應分析、多層編碼鏈、整合推理

**所需工具：**  
DevTools (Elements / Application / Network / Console)、CyberChef

**難度：** ⭐⭐⭐⭐☆

**解題指南：** [Web-20/Answer.md](Web-20/Answer.md)

---

### Web-21 — 文本檔的編碼祕密
**連線地址：** `http://localhost:8021`

**題目描述：**  
從下載的 TXT 檔案中找出被拆成 Hex 與 Base64 的兩段線索，還原完整旗標。

**技術重點：**  
TXT 分析、Hex 解碼、Base64 解碼

**所需工具：**  
DevTools (Network / Sources)、CyberChef

**難度：** ⭐⭐☆☆☆

**解題指南：** [Web-21/Answer.md](Web-21/Answer.md)

---

### Web-22 — 試算表隱藏欄
**連線地址：** `http://localhost:8022`

**題目描述：**  
CSV 檔案看似普通成績表，但其中包含額外隱藏欄位，欄位值可解出旗標。

**技術重點：**  
CSV 結構、隱藏欄位辨識、Base64 解碼

**所需工具：**  
DevTools (Network / Sources)、CyberChef

**難度：** ⭐⭐☆☆☆

**解題指南：** [Web-22/Answer.md](Web-22/Answer.md)

---

### Web-23 — PDF 元數據洩漏
**連線地址：** `http://localhost:8023`

**題目描述：**  
PDF 本文沒有提示，但文件 metadata（如 Author）保留了編碼線索。

**技術重點：**  
PDF 元數據、文件屬性分析、Base64 解碼

**所需工具：**  
DevTools + PDF metadata viewer、CyberChef

**難度：** ⭐⭐⭐☆☆

**解題指南：** [Web-23/Answer.md](Web-23/Answer.md)

---

### Web-24 — 隱藏工作表
**連線地址：** `http://localhost:8024`

**題目描述：**  
XLSX 檔案含有隱藏工作表，真實線索位於隱藏頁籤資料中。

**技術重點：**  
XLSX 工作表可見性、資料提取、Base64 解碼

**所需工具：**  
DevTools + 試算表工具、CyberChef

**難度：** ⭐⭐⭐☆☆

**解題指南：** [Web-24/Answer.md](Web-24/Answer.md)

---

### Web-25 — 向量圖裡的文本
**連線地址：** `http://localhost:8025`

**題目描述：**  
SVG 向量圖中藏有不可見文字節點，需從原始 XML 取出線索。

**技術重點：**  
SVG 原始碼、隱藏節點、Base64 解碼

**所需工具：**  
DevTools (Sources / Network)、CyberChef

**難度：** ⭐⭐☆☆☆

**解題指南：** [Web-25/Answer.md](Web-25/Answer.md)

---

### Web-26 — 圖片 EXIF 元數據
**連線地址：** `http://localhost:8026`

**題目描述：**  
PNG 圖片 metadata 欄位（Author / Comment）藏有編碼字串，需擷取後解碼。

**技術重點：**  
圖片 metadata、PNG text chunk、Base64 解碼

**所需工具：**  
DevTools + 圖片 metadata viewer、CyberChef

**難度：** ⭐⭐⭐☆☆

**解題指南：** [Web-26/Answer.md](Web-26/Answer.md)

---

### Web-27 — 位圖隱寫
**連線地址：** `http://localhost:8027`

**題目描述：**  
BMP 位圖用 LSB 手法藏字串，需依提示提取位元資料後還原旗標。

**技術重點：**  
BMP、LSB 隱寫、Base64 解碼

**所需工具：**  
DevTools + Python 提示腳本、CyberChef

**難度：** ⭐⭐⭐⭐☆

**解題指南：** [Web-27/Answer.md](Web-27/Answer.md)

---

### Web-28 — 音訊 ID3 標籤
**連線地址：** `http://localhost:8028`

**題目描述：**  
MP3 音檔的 ID3 Comments 欄位藏有線索，透過 metadata 工具可取出。

**技術重點：**  
MP3 ID3 tag、Comment 欄位、Base64 解碼

**所需工具：**  
DevTools + 音訊 metadata viewer、CyberChef

**難度：** ⭐⭐☆☆☆

**解題指南：** [Web-28/Answer.md](Web-28/Answer.md)

---

### Web-29 — RIFF 元數據
**連線地址：** `http://localhost:8029`

**題目描述：**  
WAV 檔案搭配 metadata 提示檔，需解讀 RIFF/LIST 概念後找出旗標片段。

**技術重點：**  
WAV/RIFF 結構、metadata 提示、Base64 解碼

**所需工具：**  
DevTools (Network / Sources)、CyberChef

**難度：** ⭐⭐⭐☆☆

**解題指南：** [Web-29/Answer.md](Web-29/Answer.md)

---

### Web-30 — 最終檔案迷宮
**連線地址：** `http://localhost:8030`

**題目描述：**  
從 TXT、CSV、PNG、MP3 四種檔案取出碎片，依序拼接還原最終旗標。

**技術重點：**  
多格式資料提取、跨檔案拼接、編碼流程

**所需工具：**  
DevTools + 外部 metadata viewer + CyberChef

**難度：** ⭐⭐⭐⭐☆

**解題指南：** [Web-30/Answer.md](Web-30/Answer.md)

---

### Web-31 — JPEG EXIF 隱寫
**連線地址：** `http://localhost:8031`

**題目描述：**  
從 JPG 的 EXIF / XMP metadata 提取線索。

**技術重點：**  
JPEG metadata、EXIF 欄位、Base64 解碼

**所需工具：**  
DevTools + metadata viewer + CyberChef

**難度：** ⭐⭐⭐☆☆

**解題指南：** [Web-31/Answer.md](Web-31/Answer.md)（出題建置： [Web-31/setup.md](Web-31/setup.md) ）

---

### Web-32 — PNG tEXt 隱寫
**連線地址：** `http://localhost:8032`

**題目描述：**  
從 PNG tEXt / iTXt chunk 取得線索。

**技術重點：**  
PNG metadata chunk、Base64 解碼

**所需工具：**  
DevTools + metadata viewer + CyberChef

**難度：** ⭐⭐⭐☆☆

**解題指南：** [Web-32/Answer.md](Web-32/Answer.md)（出題建置： [Web-32/setup.md](Web-32/setup.md) ）

---

### Web-33 — GIF 幀訊息
**連線地址：** `http://localhost:8033`

**題目描述：**  
線索藏在 GIF 某個 frame 或 comment extension。

**技術重點：**  
GIF frame 分析、comment extension、編碼還原

**所需工具：**  
DevTools + GIF frame 工具 + CyberChef

**難度：** ⭐⭐⭐☆☆

**解題指南：** [Web-33/Answer.md](Web-33/Answer.md)（出題建置： [Web-33/setup.md](Web-33/setup.md) ）

---

### Web-34 — WebP Metadata
**連線地址：** `http://localhost:8034`

**題目描述：**  
從 WebP 的 EXIF / XMP metadata 讀取線索。

**技術重點：**  
WebP metadata、欄位提取、Base64 解碼

**所需工具：**  
DevTools + metadata viewer + CyberChef

**難度：** ⭐⭐⭐☆☆

**解題指南：** [Web-34/Answer.md](Web-34/Answer.md)（出題建置： [Web-34/setup.md](Web-34/setup.md) ）

---

### Web-35 — MP4 Metadata 隱寫
**連線地址：** `http://localhost:8035`

**題目描述：**  
從 MP4 metadata（comment/title）取得線索。

**技術重點：**  
MP4 metadata、欄位分析、Base64 解碼

**所需工具：**  
DevTools + metadata viewer + CyberChef

**難度：** ⭐⭐⭐☆☆

**解題指南：** [Web-35/Answer.md](Web-35/Answer.md)（出題建置： [Web-35/setup.md](Web-35/setup.md) ）

---

### Web-36 — MKV 附件隱寫
**連線地址：** `http://localhost:8036`

**題目描述：**  
從 MKV 容器的附件或 track metadata 取得線索。

**技術重點：**  
MKV 容器結構、附件、metadata 讀取

**所需工具：**  
DevTools + 影片 metadata 工具 + CyberChef

**難度：** ⭐⭐⭐⭐☆

**解題指南：** [Web-36/Answer.md](Web-36/Answer.md)（出題建置： [Web-36/setup.md](Web-36/setup.md) ）

---

### Web-37 — FLAC Tag 隱寫
**連線地址：** `http://localhost:8037`

**題目描述：**  
從 FLAC 的 Vorbis comment 取得線索。

**技術重點：**  
音訊 tag、comment 欄位、Base64 解碼

**所需工具：**  
DevTools + 音訊 metadata 工具 + CyberChef

**難度：** ⭐⭐⭐☆☆

**解題指南：** [Web-37/Answer.md](Web-37/Answer.md)（出題建置： [Web-37/setup.md](Web-37/setup.md) ）

---

### Web-38 — LSB 影像隱寫術
**連線地址：** `http://localhost:8038`

**題目描述：**  
旗標藏在一張 PNG 圖像的最低有效位元（LSB）中，人眼無法察覺。

**技術重點：**  
LSB 隱寫術、影像位元平面分析

**所需工具：**  
StegOnline (https://stegonline.georgeom.net)

**難度：** ⭐⭐⭐☆☆

**解題指南：** [Web-38/Answer.md](Web-38/Answer.md)（出題建置： [Web-38/setup.md](Web-38/setup.md) ）

---

### Web-39 — 光譜圖隱寫
**連線地址：** `http://localhost:8039`

**題目描述：**  
從音訊 spectrogram 讀取視覺化線索。

**技術重點：**  
Spectrogram、視覺化讀字、編碼還原

**所需工具：**  
DevTools + spectrogram viewer + CyberChef

**難度：** ⭐⭐⭐⭐☆

**解題指南：** [Web-39/Answer.md](Web-39/Answer.md)（出題建置： [Web-39/setup.md](Web-39/setup.md) ）

---

### Web-40 — 多媒體綜合隱寫
**連線地址：** `http://localhost:8040`

**題目描述：**  
從 JPG / MP3 / MP4 三個檔案收集片段並拼接旗標。

**技術重點：**  
跨媒體 metadata、片段拼接、流程整合

**所需工具：**  
DevTools + metadata viewer + CyberChef

**難度：** ⭐⭐⭐⭐☆

**解題指南：** [Web-40/Answer.md](Web-40/Answer.md)（出題建置： [Web-40/setup.md](Web-40/setup.md) ）

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

**180 分鐘版本：**
- 前 90 分鐘內容
- Web-11 ~ Web-13：30 分（DOM、Storage、URL Fragment）
- Web-14 ~ Web-17：30 分（快取、資料庫、JWT、Manifest）
- Web-18 ~ Web-20：30 分（Service Worker、改請求、綜合題）

**240 分鐘版本：**
- 前 180 分鐘內容
- Web-21 ~ Web-24：20 分（TXT/CSV/PDF/XLSX 文件分析）
- Web-25 ~ Web-28：20 分（SVG/PNG/BMP/MP3 檔案隱寫）
- Web-29 ~ Web-30：20 分（WAV 與多格式綜合）

---

## 📚 學習進度建議

- **入門（Web-01 ~ 03）：** 熟悉 DevTools 基礎操作
- **進階（Web-04 ~ 07）：** 靜態資源與標頭安全
- **高級（Web-08 ~ 10）：** 整合思維與複雜場景
- **延伸（Web-11 ~ 15）：** DOM、快取與瀏覽器資料儲存
- **壓軸（Web-16 ~ 20）：** Token、Service Worker、請求重送與綜合推理
- **檔案分析（Web-21 ~ 25）：** 常見文件與圖片格式線索提取
- **隱寫進階（Web-26 ~ 30）：** 多媒體 metadata 與跨格式整合

---

## 🔗 其他資源

- [README.md](README.md) —— 系統架設與啟動指南
- [run.command](run.command) —— macOS 快速啟停（`./run.command start`）
- [run.bat](run.bat) —— Windows 快速啟停（`run.bat start`）

