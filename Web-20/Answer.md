# ✅ Web-20 解題說明 — 最終拼圖：你看的不只是一頁

## 題目描述
最終挑戰將線索分散在頁面 DOM、瀏覽器儲存區與 API 回應之中。請蒐集所有碎片，依照正確順序拼組，並完成多層解碼還原最終旗標。

## 解題步驟
1. 開啟 `http://localhost:8020`，按 `F12` 進入 DevTools。
2. 在 `Application` → `Local Storage` 找到 `piece_local = Zmxh`。
3. 在 `Elements` 找到 `#seal`，其 `data-piece` 為 `Z3tk`。
4. 在 `Network` 打開 `/api/piece.php`，取得 `piece = ZXZ0b29s`。
5. 在 `Application` → `Session Storage` 找到 `piece_session = c19jb2xs`。
6. 在頁面原始碼註解中找到最後一段：`ZWN0c19hbGx9`。
7. 依照 Console 提示順序拼接：
   `Zmxh` + `Z3tk` + `ZXZ0b29s` + `c19jb2xs` + `ZWN0c19hbGx9`
8. 得到完整 Base64：`ZmxhZ3tkZXZ0b29sc19jb2xsZWN0c19hbGx9`。
9. 將它貼到 CyberChef，使用 `From Base64` 解碼。

## 學習重點
- 真實線索可能分散在 DOM、Storage、Network 與原始碼中。
- 綜合題關鍵在於建立「收集 → 排序 → 解碼」流程。
- DevTools 的多個面板需要一起使用。

## Flag
`flag{devtools_collects_all}`