# Web-40 Setup — 多媒體綜合隱寫 Final

## 目標
手動製作 3 個檔案，分別藏 3 段旗標，玩家需組合。

## 你要準備的檔案
- `src/files/final-photo.jpg`
- `src/files/final-audio.mp3`
- `src/files/final-video.mp4`

## 建議分配
- `final-photo.jpg`：EXIF `UserComment` 放 Part A
- `final-audio.mp3`：ID3 `Comment` 放 Part B
- `final-video.mp4`：metadata `comment` 放 Part C

## 建議格式
- 每段都先做 Base64，再讓學生解碼後拼接。
- 可在題目頁或 console 留下拼接順序提示（A→B→C）。

## 驗證
- 逐一上傳到 metadata viewer，確認三段都可讀。