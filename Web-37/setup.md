# Web-37 Setup — FLAC Vorbis Comment

## 目標
在 FLAC 的 Vorbis comment（例如 `COMMENT`）寫入 Base64 線索。

## 你要準備的檔案
- 放到 `src/files/podcast.flac`

## 製作方式
1. 準備短 FLAC 音檔。
2. 用音訊 tag 編輯器（Mp3tag、Kid3）寫入 `COMMENT`。
3. 將編碼字串放到 `COMMENT` 欄位。

## 驗證
- 用線上音訊 metadata viewer 可讀到 `COMMENT`。