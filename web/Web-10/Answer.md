# ✅ Web-10 解題說明 — 終極偵測挑戰

## 題目描述
最後最難題結合多個 DevTools 功能：從 Storage、Network、Console 各地蒐集碎片，拼組後再做多層編碼解碼。

## 難度
★★☆☆☆（2星）

## 種類
WEB

## 建議工具
- 瀏覽器 DevTools（Elements / Network / Sources / Application / Console）
- CyberChef（From Base64 / From Hex / URL Decode 等）
- Hex 工具（hexed.it）

## 解題步驟
### 1. 開啟 DevTools 瀏覽 Storage

**localStorage 取第一段：**
- 開啟 `Application` → `Local Storage`
- 找到 `flag_part1: flag{`

**sessionStorage 取最後一段：**
- `Application` → `Session Storage`
- 找到 `flag_part3: ultimate_dev_detective}`

### 2. 使用 Network 檢查 API 呼叫

- 在 `Network` 篩選 `Fetch/XHR`
- 找 `/api/hint.php` 的 Response
- 取出 JSON 中 `debug_xyz` 的值：`emi_`（第二段）

### 3. 組裝三段

```
part1 + part2+3 + part4
= flag{ + emi_ + ultimate_dev_detective}
= flag{emi_ultimate_dev_detective}
```

### 4. 在 CyberChef 多層解碼
**反向解碼（CyberChef 中）：**
   - 貼上最終加密字串：`ZmxhZ3toaWRkZW5fanNvbl9maWVsZF9mb3VuZH0=`
   - 套用 `From Base64`
   - 得到： `flag{emi_ultimate_dev_detective}`

## 驗證與常見卡點
- 驗證方式：最終輸出需符合 `flag{...}` 格式，且與題目提示一致。
- 常見卡點：確認在正確網域下重新整理後再讀取 Storage。
- 常見卡點：改參數後要看 Response 內容，不只看狀態碼。

## 學習重點
- DevTools 的 **Storage** 分頁可檢視前端本機資訊（不安全）
- **Network** 分頁能截獲 AJAX 回應，洩漏 API 資訊
- **Console** 可看到開發者留下的提示與錯誤
- 多層編碼需按**正確順序逆解**

## Flag
`flag{emi_ultimate_dev_detective}`

