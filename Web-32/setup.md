# Web-32 Setup — PNG tEXt Chunk

## 目標
手動製作 PNG，將線索放進 PNG 的 `tEXt` 或 `iTXt` metadata chunk。

## 你要準備的檔案
- 放到 `src/files/poster.png`

## 建議線索欄位
- Key：`Comment`
- Value：Base64 字串（例如旗標片段）

## 製作方式
1. 使用可編輯 PNG metadata 的工具。
2. 或用 `pngcheck` / `tweakpng` / `exiftool` 類工具。
3. 完成後上傳到 `exif.tools` 檢查有無 `Comment`。

## 驗證
- 用線上 metadata viewer 可讀到 `Comment=<base64>`。