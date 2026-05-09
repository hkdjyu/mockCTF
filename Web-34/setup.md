# Web-34 Setup — WebP Metadata 隱寫

## 目標
製作 WebP 並寫入 XMP/EXIF metadata（例如 comment 欄位）。

## 你要準備的檔案
- 放到 `src/files/banner.webp`

## 製作方式
1. 先建立一般 `banner.webp`。
2. 使用可編輯 WebP metadata 工具寫入 Base64 字串。
3. 確認 metadata 可被線上工具讀取。

## 驗證
- 用 `exif.tools` 上傳 WebP，確認欄位存在。