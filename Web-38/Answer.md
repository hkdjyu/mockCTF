# ✅ Web-38 解題說明 — LSB 影像隱寫術

## 背景知識
**LSB（Least Significant Bit）** 是最常見的圖像隱寫術技術，將秘密資訊藏在每個像素顏色值的最低位元，人眼幾乎無法察覺差異。

## 解題步驟

1. 下載題目提供的 `image.png`。
2. 前往線上工具：**https://stegonline.georgeom.net/extract**
3. 上傳 `image.png`。
4. 在 **Bit Planes** 欄位，勾選 **R Bit 0、G Bit 0、B Bit 0**（即 LSB）。
5. 點擊 **Extract String**。
6. 在輸出欄位中找到旗標字串。

## 提示
- 若工具沒有輸出，嘗試只勾選其中一個 channel（R/G/B）。
- 旗標格式為 `CTF{...}`。