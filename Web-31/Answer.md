# ✅ Web-31 解題說明 — JPEG EXIF 隱寫

1. 在Network下載 `llc.jpg`。
2. 用 `exif.tools` 或 `metadata2go` 查看 metadata。
3. 找到 `UserComment` 內的編碼字串`666c61677b6c6c635f6a7065675f657869665f68696464656e5f746578747d`。
4. 用 CyberChef 解碼(HEX)取得旗標。

## Flag
`flag{llc_jpeg_exif_hidden_text}`