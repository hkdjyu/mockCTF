# 答案

## Web-01 開發者遺留除錯檔
1. 開啟 `http://localhost:8001`，按 `F12` 進入 DevTools。
2. 在 `Network` 重新整理頁面，查看主請求回應標頭，取得提示 `X-Hint: The answer lies within...`。
3. 檢視頁面原始碼，發現頁尾引用 `app.js`。
4. 在 `Sources` 或直接開啟 `/app.js`，找到字串：`flag{d3v_t00ls_4_th3_w1n}`。

## Web-02 註解中的註解
1. 開啟 `http://localhost:8002`，在 `View Page Source` 搜尋 `TODO`、`debug`、`note`。
2. 找到看似被註解包住的可疑字串（例如 URL 編碼後再 Base64 的內容）。
3. 複製字串到 CyberChef，先用 `URL Decode`，再用 `From Base64`。
4. 若輸出仍是亂碼，再嘗試 `From Hex` 或 `From Base32`。
5. 還原為 `flag{...}` 格式即成功。

## Web-03 假登入的前端判斷
1. 開啟 `http://localhost:8003`，在 `Sources` 找主要腳本Index。
2. Index搜尋 `if (`、`password`、`token`、`checkLogin` 等關鍵字，沒有特別，注意到`src="auth.js`
3. 開啟`auth.js`，留意到`const gateToken = "synt{sebagraq_nhgu_vf_abg_frphevgl}";`
4. 找到比對值後，觀察是否經過 ROT13、Hex 或字串反轉。
5. 將可疑值貼入 CyberChef，套用ROT13、Hex 或字串反轉，嘗試轉換還原明文。
6. 取得 `flag{...}` 即完成。

## Web-04 CSS 不只是樣式
1. 開啟題目頁後，在 `Network` 篩選 `CSS`。
2. 點入主要樣式檔，搜尋 `/*`、`debug`、`secret`、`unicode`。
3. 複製可疑片段（如 `\u0066\u006c...` 或 Hex 字串）。
4. 將字串貼到 CyberChef，使用 `From Unicode` 或 `From Hex`。
5. 轉換結果為 `flag{...}` 即解題成功。

## Web-05 LocalStorage 的秘密
1. 開啟題目頁，按 `F12` 進入 DevTools。
2. 到 `Application`（或 `Storage`）→ `Local Storage`。
3. 尋找 key 名稱像 `debug_token`、`backup`、`note` 的資料。
4. 複製 value 到 CyberChef，先試 `From Base64`，不行再試 `From Base58`。
5. 當輸出為 `flag{...}` 時即完成。

## Web-06 Cookie 拼圖
1. 開啟題目頁，看到登入表單。
2. 在 DevTools 的 `Elements` 或 `Sources` 面板中查看頁面原始碼。
3. 找到 HTML 注釋 `<!-- 預設帳號：admin -->`，確認用戶名為 `admin`。
4. 密碼需要猜測——嘗試常見弱密碼，例如 `admin`、`password`、`123456` 等。
5. 使用 `admin` / `admin` 成功登入。
6. 登入成功後，進入 DevTools → `Application` → `Cookies`。
7. 找到 `part1`、`part2`、`part3` 三個欄位，依序拼接其 value。
8. 將拼接後結果貼到 CyberChef，套用 `From Base64`。
9. 解出 `flag{...}` 即完成。

## Web-07 回應標頭藏訊息
1. 開啟題目後，在 `Network` 查看主請求。
2. 在 `Response Headers` 尋找自訂欄位（如 `X-Debug`、`X-Trace`）。
3. 複製其值（可能是 Hex 或 XOR 後字串）。
4. 在 CyberChef 先用 `From Hex`；若有提示 key，再接 `XOR`。
5. 得到 `flag{...}` 即成功。

## Web-08 Source Map 洩漏
1. 在 `Sources` 查看壓縮後 JS，注意檔尾 `sourceMappingURL`。
2. 開啟對應 `.map` 檔案，找到 `sourcesContent`。
3. 從還原後原始碼得到 `leaked = 'ZmxhZ3tzb3VyY2VtYXBfbGVha3Nfc291cmNlfQ==';`。
4. 若值仍經編碼，複製到 CyberChef 用 `From Base64`。
5. 還原出 `flag{...}`。

## Web-09 假 API 真線索
1. 開啟題目頁，進入 `Network`，篩選 `Fetch/XHR`。
2. 找到可疑 API（如 `/api/status`、`/api/profile`）。
3. 檢視 `Response`，留意未顯示在頁面的欄位（例如 `debug_data`）。
4. 把該欄位值貼到 CyberChef，依提示做 `From Base64` 或 `JWT Decode`。
5. 取得 `flag{...}` 即完成。

## Web-10 終極偵測挑戰
1. 開啟 DevTools，在 `Application` → `Local Storage` 找到 `flag_part1: flag{`。
2. 在 `Application` → `Session Storage` 找到 `flag_part3: ultimate_dev_detective}`。
3. 在 `Network` 篩選 `Fetch/XHR`，找 `/api/hint.php` 的 Response，取出 JSON 中 `debug_xyz` 的值：`emi_`（第二段）。
4. 依序組裝三段：`flag{` + `emi_` + `ultimate_dev_detective}` = `flag{emi_ultimate_dev_detective}`。
5. 在 CyberChef 貼上加密字串 `ZmxhZ3toaWRkZW5fanNvbl9maWVsZF9mb3VuZH0=`，套用 `From Base64` 驗證結果。

## Web-11 被隱藏的表單欄位
1. 開啟 `http://localhost:8011`，按 `F12` 進入 DevTools。
2. 在 `Elements` 檢查表單，找到 `recovery_code` 欄位，原本是 `type="hidden"` 且帶有 `disabled`。
3. 將欄位改為 `type="text"`，然後輸入學生編號（格式：`s` + 6 位數字，例如 `s123456`）。
4. 送出表單，若格式正確會顯示驗證成功提示。
5. 同時頁面會跳出提示，並在瀏覽器 `Console` 輸出旗標：`flag{disabled_fields_still_talk}`。

## Web-12 SessionStorage 的短期記憶
1. 開啟 `http://localhost:8012`，按 `F12` 進入 DevTools。
2. 前往 `Application` → `Session Storage`。
3. 找到 `memo_a`、`memo_b`、`memo_c` 三個鍵值。
4. 按字母順序拼接字串後，得到一段 Base64：`ZmxhZ3tzZXNzaW9uX3N0b3JhZ2VfaXNfc2hvcnRfdGVybX0=`。
5. 將它貼到 CyberChef，使用 `From Base64` 解碼。

## Web-13 Hash Fragment 的密語
1. 開啟 `http://localhost:8013`，按 `F12` 進入 DevTools。
2. 先查看頁面原始碼，會看到 `#staff-preview` 是一個特別路由，但看不到旗標字串本體。
3. 把網址改成 `http://localhost:8013/#staff-preview`。
4. 切到 `Network` 面板，會看到頁面發出請求（`?route=staff-preview`）。
5. 打開該請求回應，取得 Base64 字串 `ZmxhZ3toYXNoX3JvdXRlc19jYW5faGlkZV9wYXRoc30=`。
6. 將字串貼到 CyberChef，套用 `From Base64` 解碼得到旗標。

## Web-14 被快取的舊秘密
1. 開啟 `http://localhost:8014`，按 `F12` 進入 DevTools。
2. 前往 `Application` → `Cache Storage`。
3. 找到 `web14-static-v1`，裡面會有 `/legacy/app.v1.js`。
4. 開啟該舊版檔案，找到被封存的 ciphertext、key/IV 以及加密方式（AES-128-CBC）。
5. 將字串貼到 CyberChef，使用 `AES Decrypt` 和 `From Base64` 解碼。

## Web-15 IndexedDB 資料倉庫
1. 開啟 `http://localhost:8015`，按 `F12` 進入 DevTools。
2. 前往 `Application` → `IndexedDB`。
3. 展開 `campusDrafts` → `drafts`，找到 `id = 2` 的資料。
4. 其中 `note` 欄位是 Base64：`ZmxhZ3tpbmRleGVkZGJfa2VlcHNfZHJhZnRzfQ==`。
5. 將字串貼到 CyberChef，使用 `From Base64` 解碼。

## Web-16 JWT 自白書
1. 開啟 `http://localhost:8016`，按 `F12` 進入 DevTools。
2. 前往 `Application` → `Local Storage`，找到 `portal.jwt`。
3. JWT 由三段組成，取中間的 payload。
4. 將 payload 貼到 CyberChef，使用 `From Base64` 或 `From Base64 (URL Safe)` 解碼。
5. 在 JSON 內容中讀出 `flag` 欄位。

## Web-17 manifest.json 說太多了
1. 開啟 `http://localhost:8017`，按 `F12` 進入 DevTools。
2. 在 `Elements` 找到加密後的 Base64 字串。
3. 在 `Network` 或 `Sources` 找到 `/manifest.json`。
4. 讀取其中的 `shortcuts` 欄位，可看到隱藏路徑 `/draft.php?from=manifest`。
5. 直接開啟該路徑，頁面會顯示 RSA Key 資訊（公鑰與私鑰）。
6. 將字串貼到 CyberChef，使用 `From Base64` 解碼，然後再使用 `RSA Decrypt`（SHA-256）。

## Web-18 Service Worker 的假畫面
1. 開啟 `http://localhost:8018`，按 `F12` 進入 DevTools。
2. 前往 `Application` → `Service Workers`，確認網站註冊了 `/sw.js`。
3. 在 `Sources` 或直接開啟 `/sw.js`，可看到它攔截 `/daily-message.txt` 並回傳假公告。
4. 前往 `Application` → `Cache Storage`，找到 `web18-worker-cache`。
5. 開啟 `/internal/archive-note.txt`，可看到 Base64 字串。
6. 將它貼到 CyberChef，使用 `From Base64` 解碼。

## Web-19 重送請求的第二答案
1. 開啟 `http://localhost:8019`，按 `F12` 進入 DevTools。
2. 在 `Network` 找到 `/api/report.php?id=1&view=normal`。
3. 檢查回應的 JSON，會看到提示 `hint: "try id=7 with debug view"`。
4. 或直接檢查 HTML 源碼註解，會看到 `<!-- archived id list: last known internal entry #7 -->`。
5. 在 `Console` 也會看到提示 `[api hint] try id=7 with debug view`。
6. 使用 `Edit and Resend`，把參數改成 `/api/report.php?id=7&view=debug`。
7. 新回應中會出現 `archive` 欄位：`ZmxhZ3tyZXNlbmRfcmVxdWVzdHNfY2hhbmdlX2Fuc3dlcnN9`。
8. 將字串貼到 CyberChef，使用 `From Base64` 解碼。

## Web-20 最終拼圖：你看的不只是一頁
1. 開啟 `http://localhost:8020`，按 `F12` 進入 DevTools。
2. 在 `Application` → `Local Storage` 找到 `piece_local = Zmxh`。
3. 在 `Elements` 找到 `#seal`，其 `data-piece` 為 `Z3tk`。
4. 在 `Network` 打開 `/api/piece.php`，取得 `piece = ZXZ0b29s`。
5. 在 `Application` → `Session Storage` 找到 `piece_session = c19jb2xs`。
6. 在頁面原始碼註解中找到最後一段：`ZWN0c19hbGx9`。
7. 依照 Console 提示順序拼接：`Zmxh` + `Z3tk` + `ZXZ0b29s` + `c19jb2xs` + `ZWN0c19hbGx9`。
8. 得到完整 Base64：`ZmxhZ3tkZXZ0b29sc19jb2xsZWN0c19hbGx9`。
9. 將它貼到 CyberChef，使用 `From Base64` 解碼。

## Web-21 文本檔的編碼祕密
1. 開啟 `http://localhost:8021`。
2. 下載 `notes.txt`。
3. 用文本編輯器開啟，找到兩段編碼：`Flag Part 1 (Hex): ...` 和 `Flag Part 2 (Base64): ...`。
4. 將 Hex 部分貼到 CyberChef，使用 `From Hex` 解碼。
5. 將 Base64 部分貼到 CyberChef，使用 `From Base64` 解碼。
6. 拼接兩部分得到完整旗標。

## Web-22 試算表隱藏欄
1. 開啟 `http://localhost:8022`。
2. 在 Elements 中閲讀代碼，前往 `http://localhost:8022/files/students.csv`。
3. 下載 `students.csv`。
4. 用文本編輯器開啟，或拖入線上 CSV 查看器。
5. 觀察表頭，會看到第五欄 `Internal`。
6. 查看 Alice Chen 那列，第五欄是 Base64 編碼的旗標。
7. 將字串貼到 CyberChef，使用 `From Base64` 解碼。

## Web-23 PDF 元數據洩漏
1. 開啟 `http://localhost:8023`。
2. 下載 `file.pdf`。
3. 使用線上 PDF 元數據檢查工具（如 https://exif.tools/ 或 https://metadatakit.com/metadata）。
4. 在 Subject 欄位找到 flag。

## Web-24 隱藏工作表
1. 開啟 `http://localhost:8024`。
2. 下載 `records.xlsx`。
3. 在 Excel、Google Sheets 或線上 Excel 查看器中開啟。
4. 通常會看到一個名叫「Public」的工作表。
5. 查看工作表標籤，尋找隱藏的工作表（有時右鍵選單會顯示「取消隱藏」）。
6. 在隱藏工作表找到 Base64 編碼的資料。
7. 將其貼到 CyberChef，使用 `From Base64` 解碼。

## Web-25 向量圖裡的文本
1. 開啟 `http://localhost:8025`。
2. 下載 `logo.svg`。
3. 用文本編輯器開啟（記事本、VSCode 等）。
4. 尋找隱藏的 `<text>` 元素，其中 `x` 和 `y` 座標為負數（超出視圖外）。
5. 該元素包含 Base64 編碼的資訊。
6. 將其貼到 CyberChef，使用 `From Base64` 解碼。

## Web-26 背景
1. 開啟 `http://localhost:8026`。
2. 注意頁面背景圖已改成 `background.png`，不要被部落格內容分散注意力。
3. 下載 `background.png`。
4. 上傳到線上 PNG/metadata 檢查工具（例如 https://exif.tools/）。
5. 在元數據的 Author 欄位找到 Base64 編碼字串。
6. 將其貼到 CyberChef，使用 `From Base64` 解碼。

## Web-27 Mario 像素檔案
1. 開啟 `http://localhost:8027`。
2. 下載 `mario.bmp`。
3. 前往線上十六進位檢視工具 `https://hexed.it/`，把 `mario.bmp` 拖進去。
4. 後面可以看到一段 Base64 字串。
5. 將該字串貼到 CyberChef，使用 `From Base64` 解碼。

## Web-28 音訊 ID3 標籤
1. 開啟 `http://localhost:8028`。
2. 下載 `anthem.mp3`。
3. 上傳到線上 MP3 元數據查看工具或使用本地音訊編輯器。
4. 在 Comments 欄位找到 Base64 編碼字串。
5. 將其貼到 CyberChef，使用 `From Base64` 解碼。

## Web-29 RIFF 元數據
1. 開啟 `http://localhost:8029`，下載 `announcement.wav`。
2. 前往 `https://metadatakit.com/metadata`，上傳 `announcement.wav`。
3. 工具會自動解析 RIFF INFO chunk，在結果中找到 `Comment`（對應 `ICMT` 欄位）。
4. 複製其中的 Base64 字串，貼到 CyberChef，套用 `From Base64` 解碼，得到旗標。

## Web-30 壓縮檔迷宮
1. 開啟 `http://localhost:8030`。
2. 下載 `compress.zip`，解壓縮後得到 4 個檔案：`part1.txt`、`part2.csv`、`part3.svg`、`part4.mp3`。
3. 開啟 `part1.txt`，找到 Hex 編碼字串，用 CyberChef `From Hex` 解碼：`flag{`。
4. 開啟 `part2.csv`，第二列含 Base64 編碼，用 CyberChef `From Base64` 解碼：`multi_format`。
5. 將 `part3.svg` 上傳到線上 QR code decoder 工具（例如 `https://qrcoderaptor.com/`），找到字串 `_maze`。
6. 將 `part4.mp3` 上傳到線上音訊 metadata 工具，在 ID3 的 `Comment` 欄位讀取 Base64 字串，用 CyberChef `From Base64` 解碼：`_challenge}`。
7. 依順序拼接：`flag{` + `multi_format` + `_maze` + `_challenge}` = `flag{multi_format_maze_challenge}`。

## Web-31 校訓及校徽
1. 開啟 `http://localhost:8031` 並按 `F12`。
2. 在 `Network` 找到並下載 `llc.jpg`。
3. 將檔案上傳到 `exif.tools` 或 `metadata2go`。
4. 在 `UserComment`（或相關註解欄位）找到 Hex 字串。
5. 把 Hex 字串貼到 CyberChef，用 `From Hex` 解碼取得旗標。

## Web-32 PNG tEXt 隱寫
1. 開啟 `http://localhost:8032`。
2. 下載 `PNG.png`（必要時也可比對其他同頁檔案）。
3. 上傳到 metadata 工具，查看 `Artist`、`Comment`、`tEXt` 欄位。
4. 找到可疑字串後，使用 CyberChef 做 ROT/位移轉換（amount = -5）。
5. 還原出 `flag{...}`。

## Web-33 GIF 幀訊息
1. 開啟 `http://localhost:8033`。
2. 下載題目提供的 GIF 檔案。
3. 使用分幀工具 (https://ezgif.com/split) 逐幀查看影像內容。
4. 若畫面沒有明顯字串，檢查 GIF comment extension 或附加資料。
5. 取得線索後還原成完整旗標。

## Web-34 WebP 圖片
1. 開啟 `http://localhost:8034`。
2. 下載 `paraglide.webp`。
3. 先檢查 metadata（EXIF/XMP）欄位是否有可疑字串。
4. 若 metadata 無明顯結果，使用 LunaPic 調整 Levels/Contrast 檢查暗區或角落。
5. 讀取隱藏字串並整理成旗標格式。

## Web-35 WAV LSB 隱寫
1. 開啟 `http://localhost:8035`。
2. 下載 `bell.wav`。
3. 把檔案丟到 LSB 分析工具進行抽取。
4. 觀察輸出文字或位元串是否可直接還原。
5. 取得最終旗標字串。

## Web-36 MKV 隱寫
1. 開啟 `http://localhost:8036`。
2. 下載題目提供的 `file.mkv`。
3. 使用 mkvinfo / mkvextract 檢查 attachments、chapters、tags。
4. 將可疑附件抽出並檢查內容。
5. 還原得到最終旗標。

## Web-37 Telegraph
1. 開啟 `http://localhost:8037`。
2. 下載 `code.flac`。
3. 先看音訊 metadata 是否已有可疑字串。
4. 若提示與摩斯碼有關，利用波形長短節奏轉成 `.-` 序列（可利用 spectrogram 或 Audacity）。
5. 用 CyberChef 或 Morse 解碼器還原文字，再組成旗標。

## Web-38 LSB Steganography
1. 開啟 `http://localhost:8038`。
2. 下載題目提供的圖片檔。
3. 使用 LSB 工具抽取隱藏位元資料。
4. 若輸出是編碼字串，做 Base64/Hex 等後續轉換。
5. 還原成最終旗標。

## Web-39 光譜圖隱寫
1. 開啟 `http://localhost:8039`。
2. 下載題目提供的音訊檔。
3. 在 Audacity 切換為 `Spectrogram` 檢視模式。
4. 調整頻率上限、對比、窗長，讀取隱藏圖樣或字串。
5. 整理文字後得到旗標。

## Web-40 Speech
1. 開啟 `http://localhost:8040`，按 `F12`。
2. 在 `Network` 觀察並下載 `speech.dat`。
3. 讀取內容後，確認為可解碼字串（如 Base64）。
4. 用 CyberChef 轉回原始資料，必要時再另存為可播放格式。
5. 依題目提示還原最終旗標。
