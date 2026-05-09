# Web-36 Setup — MKV Attachment / Track Metadata

## 目標
在 MKV 容器中放入隱藏資料（附件檔、字幕 metadata 或 track 名稱）。

## 你要準備的檔案
- 放到 `src/files/session.mkv`

## 製作方式
1. 準備任意 `session.mkv`。
2. 用 MKVToolNix GUI：
   - 可加一個附件（例如 `note.txt`）
   - 或在 track name/comment 放 Base64 字串
3. 輸出為 `session.mkv`。

## 驗證
- 用 `mkvinfo`（可選）或線上 metadata 分析工具確認可讀取隱藏欄位。