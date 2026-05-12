# ✅ Web-35 解題說明 — WAV LSB 隱寫

## 題目描述
此題線索藏在 WAV 音訊資料的最低有效位元（LSB）。直接播放不一定能聽出資訊，需要用 LSB 分析工具抽取位元內容。

## 難度
★★★☆☆（3星）

## 種類
Forensics

## 建議工具
- 瀏覽器 DevTools（Network）
- Audio Stego 工具（futureboy.us/stegano）
- Audacity（輔助檢查）

## 解題步驟
1. 開啟 `https://llcmhlau.edu.hk/mockCTF/Web-35`。
2. 下載 `bell.wav`。
3. 把檔案丟到 LSB 分析工具進行抽取。
4. 觀察輸出文字或位元串是否可直接還原。
5. 取得最終旗標字串。

## 驗證與常見卡點
- 驗證方式：最終答案符合 `flag{...}`。
- 常見卡點：把音訊題只當作耳聽題，忽略位元層分析。
- 常見卡點：抽取模式（每位元/每聲道）要多嘗試。

## 學習重點
- LSB 不只存在圖片，也可用在音訊樣本。
- 媒體隱寫題核心是「資料層」而非「感官層」。
- 善用專用 stego 工具可大幅減少試錯。

## Flag
`flag{least_significant_bit}`

