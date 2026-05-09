# 🛡️ 靈糧堂劉梅軒中學 — Web CTF 實戰靶機伺服器（40 題版）

本專案以 Docker Compose 架設 40 題 Web CTF 入門靶機，適合高中生使用瀏覽器 DevTools 與 CyberChef 進行解題練習。

---

## 📋 系統需求

| 項目 | 需求 |
|------|------|
| 作業系統 | macOS / Windows / Linux |
| 必要軟體 | [Docker Desktop](https://www.docker.com/products/docker-desktop/)（需為 Running） |
| 網路環境 | 教師與學生裝置需在同一 LAN / Wi-Fi |

---

## 📂 專案結構

```text
mockCTF/
├── README.md
├── docker-compose.yml
├── Web-01/
│   ├── Dockerfile
│   ├── Answer.md
│   └── src/
├── Web-02/
│   ├── Dockerfile
│   ├── Answer.md
│   └── src/
├── ...
├── Web-10/
│   ├── Dockerfile
│   ├── Answer.md
│   └── src/
├── ...
├── Web-20/
│   ├── Dockerfile
│   ├── Answer.md
│   └── src/
├── ...
└── Web-40/
    ├── Dockerfile
    ├── Answer.md
    ├── setup.md
    └── src/
```

---

## 🚀 快速啟動

```bash
cd /你的路徑/mockCTF
docker compose up --build -d
docker compose ps
```

所有服務狀態應為 `Up`。

### Windows 一鍵控制（run.bat）

若你在 Windows 使用本專案，可直接雙擊 [run.bat](run.bat) 或在 CMD / PowerShell 執行：

```bat
run.bat start
run.bat stop
run.bat restart
run.bat status
run.bat logs web01
run.bat clean
```

不帶參數執行 `run.bat` 會進入互動選單。

### macOS 一鍵控制（run.command）

你可以在 macOS 用終端機執行：

```bash
./run.command start
./run.command stop
./run.command restart
./run.command status
./run.command logs web01
./run.command clean
```

也可以在 Finder 直接雙擊 [run.command](run.command)（若被系統阻擋，請在「系統設定 → 隱私權與安全性」允許執行）。

不帶參數執行 `./run.command` 會進入互動選單。

---

## 🌐 題目與埠號對照

| 題目 | 類型重點 | 本機網址 | 解題檔 |
|------|----------|----------|--------|
| Web-01 | 開發者遺留除錯檔（Header + JS + Base64） | http://localhost:8001 | [Web-01/Answer.md](Web-01/Answer.md) |
| Web-02 | 註解中的註解（URL Decode + Base64） | http://localhost:8002 | [Web-02/Answer.md](Web-02/Answer.md) |
| Web-03 | 前端假登入判斷（ROT13） | http://localhost:8003 | [Web-03/Answer.md](Web-03/Answer.md) |
| Web-04 | CSS 線索（Hex） | http://localhost:8004 | [Web-04/Answer.md](Web-04/Answer.md) |
| Web-05 | LocalStorage 洩漏（Base64） | http://localhost:8005 | [Web-05/Answer.md](Web-05/Answer.md) |
| Web-06 | Cookie 拼圖（分段拼接 + Base64） | http://localhost:8006 | [Web-06/Answer.md](Web-06/Answer.md) |
| Web-07 | 回應標頭訊息（Hex + XOR） | http://localhost:8007 | [Web-07/Answer.md](Web-07/Answer.md) |
| Web-08 | Source Map 洩漏 | http://localhost:8008 | [Web-08/Answer.md](Web-08/Answer.md) |
| Web-09 | 假 API 真線索（JSON 欄位） | http://localhost:8009 | [Web-09/Answer.md](Web-09/Answer.md) |
| Web-10 | 多步轉換壓軸題（Base64 → Hex） | http://localhost:8010 | [Web-10/Answer.md](Web-10/Answer.md) |
| Web-11 | 被隱藏的表單欄位（DOM / Disabled Field） | http://localhost:8011 | [Web-11/Answer.md](Web-11/Answer.md) |
| Web-12 | SessionStorage 的短期記憶 | http://localhost:8012 | [Web-12/Answer.md](Web-12/Answer.md) |
| Web-13 | Hash Fragment 的密語 | http://localhost:8013 | [Web-13/Answer.md](Web-13/Answer.md) |
| Web-14 | 被快取的舊秘密（Cache Storage） | http://localhost:8014 | [Web-14/Answer.md](Web-14/Answer.md) |
| Web-15 | IndexedDB 資料倉庫 | http://localhost:8015 | [Web-15/Answer.md](Web-15/Answer.md) |
| Web-16 | JWT 自白書 | http://localhost:8016 | [Web-16/Answer.md](Web-16/Answer.md) |
| Web-17 | manifest.json 說太多了 | http://localhost:8017 | [Web-17/Answer.md](Web-17/Answer.md) |
| Web-18 | Service Worker 的假畫面 | http://localhost:8018 | [Web-18/Answer.md](Web-18/Answer.md) |
| Web-19 | 重送請求的第二答案 | http://localhost:8019 | [Web-19/Answer.md](Web-19/Answer.md) |
| Web-20 | 最終拼圖：你看的不只是一頁 | http://localhost:8020 | [Web-20/Answer.md](Web-20/Answer.md) |
| Web-21 | 文本檔的編碼祕密（TXT + Hex/Base64） | http://localhost:8021 | [Web-21/Answer.md](Web-21/Answer.md) |
| Web-22 | 試算表隱藏欄（CSV） | http://localhost:8022 | [Web-22/Answer.md](Web-22/Answer.md) |
| Web-23 | PDF 元數據洩漏 | http://localhost:8023 | [Web-23/Answer.md](Web-23/Answer.md) |
| Web-24 | 隱藏工作表（XLSX） | http://localhost:8024 | [Web-24/Answer.md](Web-24/Answer.md) |
| Web-25 | 向量圖裡的文本（SVG） | http://localhost:8025 | [Web-25/Answer.md](Web-25/Answer.md) |
| Web-26 | 圖片 EXIF 元數據（PNG） | http://localhost:8026 | [Web-26/Answer.md](Web-26/Answer.md) |
| Web-27 | 位圖隱寫（BMP + LSB） | http://localhost:8027 | [Web-27/Answer.md](Web-27/Answer.md) |
| Web-28 | 音訊 ID3 標籤（MP3） | http://localhost:8028 | [Web-28/Answer.md](Web-28/Answer.md) |
| Web-29 | RIFF 元數據（WAV） | http://localhost:8029 | [Web-29/Answer.md](Web-29/Answer.md) |
| Web-30 | 最終檔案迷宮（多格式綜合） | http://localhost:8030 | [Web-30/Answer.md](Web-30/Answer.md) |
| Web-31 | JPEG EXIF 隱寫（手動製檔） | http://localhost:8031 | [Web-31/Answer.md](Web-31/Answer.md) |
| Web-32 | PNG tEXt 隱寫（手動製檔） | http://localhost:8032 | [Web-32/Answer.md](Web-32/Answer.md) |
| Web-33 | GIF 幀訊息（手動製檔） | http://localhost:8033 | [Web-33/Answer.md](Web-33/Answer.md) |
| Web-34 | WebP Metadata（手動製檔） | http://localhost:8034 | [Web-34/Answer.md](Web-34/Answer.md) |
| Web-35 | MP4 Metadata 隱寫（手動製檔） | http://localhost:8035 | [Web-35/Answer.md](Web-35/Answer.md) |
| Web-36 | MKV 附件隱寫（手動製檔） | http://localhost:8036 | [Web-36/Answer.md](Web-36/Answer.md) |
| Web-37 | FLAC Tag 隱寫（手動製檔） | http://localhost:8037 | [Web-37/Answer.md](Web-37/Answer.md) |
| Web-38 | OGG/Opus Metadata（手動製檔） | http://localhost:8038 | [Web-38/Answer.md](Web-38/Answer.md) |
| Web-39 | 光譜圖隱寫（手動製檔） | http://localhost:8039 | [Web-39/Answer.md](Web-39/Answer.md) |
| Web-40 | 多媒體綜合隱寫（手動製檔） | http://localhost:8040 | [Web-40/Answer.md](Web-40/Answer.md) |

---

## 👨‍🏫 課堂使用建議

- 建議順序：`Web-01` → `Web-40`（由易到難）。
- 學生工具限制：DevTools + CyberChef + 線上檔案分析工具。
- Web-31 ~ Web-40 的素材檔請教師先依各題 `setup.md` 手動製作後放入 `src/files/`。
- 教師可先閱讀各題 `Answer.md` 再安排提示層級。

---

## 🌍 學生從其他裝置連線

將 `localhost` 改為教師電腦區網 IP，例如：`http://192.168.1.100:8001`。

macOS 查 IP：

```bash
ipconfig getifaddr en0
```

---

## 🛑 關閉環境

```bash
docker compose down
```

若要同時刪除映像檔：

```bash
docker compose down --rmi all
```

---

## 🔧 常見問題

**Q：埠號衝突怎麼辦？**  
A：修改 [docker-compose.yml](docker-compose.yml) 的左側埠號（例如 `8001:80` 改成 `9001:80`）。

**Q：學生無法連線？**  
A：確認在同一網路、教師端防火牆未封鎖埠號、容器狀態為 `Up`。

---

## 📄 授權

本專案僅供教育用途，請勿部署於公開網際網路。
