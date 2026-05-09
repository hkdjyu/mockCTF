# ✅ Web-33 解題說明 — GIF 幀訊息

## 題目描述
GIF 支援多幀動畫，線索可能只出現在其中某一幀，或藏在 comment extension。挑戰者需要逐幀檢查而不是只看預覽畫面。

## 難度
★★★☆☆（3星）

## 種類
WEB, MEDIA, STENO

## 建議工具
- 瀏覽器 DevTools（Network）
- GIF 分幀工具（ezgif / ImageMagick）
- Hex 工具（hexed.it）

## 解題步驟
1. 開啟 `http://localhost:8033`。
2. 下載題目提供的 GIF 檔案。
3. 使用分幀工具逐幀查看影像內容。
4. 若畫面沒有明顯字串，檢查 GIF comment extension 或附加資料。
5. 取得線索後還原成完整旗標。

## 驗證與常見卡點
- 驗證方式：結果應是完整 `flag{...}`。
- 常見卡點：只看動畫播放，未逐幀檢查會漏掉單幀線索。
- 常見卡點：部分線索在檔案結構而非可見影像。

## 學習重點
- GIF 的 frame 與 extension block 都可作為隱寫位置。
- 動態媒體分析要結合視覺與檔案結構。
- 媒體題常有「短暫顯示」資訊。

## Flag
`flag{you_got_it_in_a_frame}`
