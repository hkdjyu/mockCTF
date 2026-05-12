# ✅ Web-20 解題說明 — 最終拼圖：你看的不只是一頁

## 題目描述
最終挑戰將線索分散在頁面 DOM、瀏覽器儲存區與 API 回應之中。請蒐集所有碎片，依照正確順序拼組，並完成多層解碼還原最終旗標。

## 難度
★★☆☆☆（2星）

## 種類
WEB

## 建議工具
- 瀏覽器 DevTools（Elements / Network / Sources / Application / Console）
- CyberChef（From Base64 / From Hex / URL Decode 等）
- Hex 工具（hexed.it）

## 解題步驟
1. 開啟 `https://llcmhlau.edu.hk/mockCTF/Web-20`，按 `F12` 進入 DevTools。
2. 在 `Application` → `Local Storage` 找到 `piece_local = Zmxh`。
3. 在 `Elements` 找到 `#seal`，其 `data-piece` 為 `Z3tk`。
4. 在 `Network` 打開 `/api/piece.php`，取得 `piece = ZXZ0b29s`。
5. 在 `Application` → `Session Storage` 找到 `piece_session = c19jb2xs`。
6. 在頁面原始碼註解中找到最後一段：`ZWN0c19hbGx9`。
7. 依照 Console 提示順序拼接：
   `Zmxh` + `Z3tk` + `ZXZ0b29s` + `c19jb2xs` + `ZWN0c19hbGx9`
8. 得到完整 Base64：`ZmxhZ3tkZXZ0b29sc19jb2xsZWN0c19hbGx9`。
9. 將它貼到 CyberChef，使用 `From Base64` 解碼。

## 驗證與常見卡點
- 驗證方式：最終輸出需符合 `flag{...}` 格式，且與題目提示一致。
- 常見卡點：Base64 可能是 URL-safe 版本，必要時先補 `=` 再解碼。
- 常見卡點：Hex 需先去除空白與非 0-9A-F 字元。
- 常見卡點：確認在正確網域下重新整理後再讀取 Storage。
- 常見卡點：改參數後要看 Response 內容，不只看狀態碼。

## 學習重點
- 真實線索可能分散在 DOM、Storage、Network 與原始碼中。
- 綜合題關鍵在於建立「收集 → 排序 → 解碼」流程。
- DevTools 的多個面板需要一起使用。

## Flag
`flag{devtools_collects_all}`


