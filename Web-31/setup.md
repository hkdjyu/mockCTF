# Web-31 Setup — JPEG EXIF 隱寫

## 目標
手動製作一張 JPEG，將線索放在 EXIF / XMP metadata（例如 `UserComment`、`ImageDescription`）。

## 你要準備的檔案
- 放到 `src/files/campus-photo.jpg`

## 建議旗標片段
- 例：`flag{jpeg_exif_hidden_text}`
- 建議先 Base64 後放入 metadata。

## 手動製作方式（擇一）
1. **GUI 工具**：ExifTool GUI / Exif Pilot / XnView MP。
2. **線上工具**：可編輯圖片 metadata 的網站。
3. **指令列（可選）**：
   - `exiftool -UserComment="<base64字串>" campus-photo.jpg`

## 驗證
- 用 `exif.tools` 或 `metadata2go` 上傳 `campus-photo.jpg`。
- 確認能看到你寫入的欄位與字串。