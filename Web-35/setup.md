# Web-35 Setup — MP4 Metadata 隱寫

## 目標
手動製作 MP4 並在 metadata comment/title 寫入線索。

## 你要準備的檔案
- 放到 `src/files/intro.mp4`

## 製作方式
1. 準備任意短 MP4。
2. 用 ffmpeg 或影片 metadata 工具寫入 comment。
   - 例：`ffmpeg -i in.mp4 -metadata comment="<base64>" -codec copy intro.mp4`
3. 放入 `src/files/intro.mp4`。

## 驗證
- 用 `metadata2go` 檢查 comment 是否存在。