# 🛡️ 靈糧堂劉梅軒中學 — Web CTF 實戰靶機伺服器（10 題版）

本專案以 Docker Compose 架設 10 題 Web CTF 入門靶機，適合高中生使用瀏覽器 DevTools 與 CyberChef 進行解題練習。

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
└── Web-10/
     ├── Dockerfile
     ├── Answer.md
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

---

## 👨‍🏫 課堂使用建議

- 建議順序：`Web-01` → `Web-10`（由易到難）。
- 學生工具限制：僅使用 DevTools + CyberChef。
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
