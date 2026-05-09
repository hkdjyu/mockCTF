# Web-38 Setup — LSB 影像隱寫術

## 目標
將旗標字串藏入 PNG 圖像的**最低有效位元（LSB）**，圖像外觀不會有明顯變化。

## 你要準備的檔案
- 放到 `src/files/image.png`

## 製作方式

### 使用線上工具（推薦）
1. 準備任意一張 PNG 圖像（例如學校照片），建議解析度 ≥ 200×200 px。
2. 前往 **[StegOnline](https://stegonline.georgeom.net/embed)**。
3. 點選 **Embed Text**，上傳你的 PNG。
4. 在文字框輸入旗標，例如 `CTF{LSB_hidden_flag}`。
5. 選擇 Channel：**R, G, B** 各自的 **Bit 0**（即 LSB）。
6. 點 **Embed & Download**，存檔為 `image.png`。
7. 將 `image.png` 放入 `src/files/`。

### 使用命令列工具（進階）
```bash
# 使用 Python stegano 套件
pip install stegano
python3 -c "from stegano.lsb import hide; hide.hide('source.png', 'CTF{LSB_hidden_flag}', 'image.png')"
```

## 驗證
1. 前往 [StegOnline Extract](https://stegonline.georgeom.net/extract)。
2. 上傳 `image.png`，勾選相同的 R/G/B Bit 0。
3. 確認能讀出旗標字串。