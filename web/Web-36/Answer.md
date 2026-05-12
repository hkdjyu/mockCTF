# ✅ Web-36 解題說明 — MKV隱寫

## 題目描述
Matroska（MKV）容器可附帶附件、章節與額外 metadata。此題線索不在影片畫面本身，而在容器的隱藏結構內。

## 難度
★☆☆☆☆（1星）

## 種類
Forensics

## 建議工具
- 瀏覽器 DevTools（Network）
- mkvtoolnix / ffprobe
- Hex 工具（hexed.it）

## 解題步驟
1. 開啟 `https://llcmhlau.edu.hk/mockCTF/Web-36`。
2. 下載題目提供的 `file.mkv`。
3. 使用 mkvinfo / mkvextract 檢查 attachments、chapters、tags。
4. 將可疑附件抽出並檢查內容。
5. 還原得到最終旗標。

## 驗證與常見卡點
- 驗證方式：答案需符合 `flag{...}`。
- 常見卡點：只播放影片不看容器資訊，會找不到線索。
- 常見卡點：附件可能有二次編碼，需再解碼。

## 學習重點
- 容器格式可同時承載多種資料型態。
- 「媒體檔 = 畫面」是常見誤區。
- 逆向容器結構是進階媒體題重點。

## Flag
`flag{rickroll_hahahaha}`

