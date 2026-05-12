<!DOCTYPE html>
<html lang="zh-HK">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Web-26 背景</title>
    <style>
        :root { --ink: #1f2937; --muted: #5b6b63; --card: rgba(255, 255, 255, .86); --line: rgba(31, 41, 55, .08); }
        * { box-sizing: border-box; }
        body {
            margin: 0;
            min-height: 100vh;
            font-family: "Noto Sans TC", "Microsoft JhengHei", Arial, sans-serif;
            color: var(--ink);
            background: #dff0d7 url('/files/background.png') center/cover fixed no-repeat;
        }
        .overlay {
            min-height: 100vh;
            background: linear-gradient(180deg, rgba(245, 252, 242, .82), rgba(233, 245, 226, .92));
            padding: 32px 16px 56px;
        }
        .page { width: min(100%, 960px); margin: 0 auto; }
        .hero {
            padding: 28px 28px 22px;
            margin-bottom: 24px;
            border: 1px solid var(--line);
            border-radius: 24px;
            background: var(--card);
            backdrop-filter: blur(8px);
            box-shadow: 0 18px 40px rgba(0, 0, 0, .08);
        }
        .eyebrow { margin: 0 0 10px; letter-spacing: .16em; font-size: .85rem; color: #4f7a59; }
        h1 { margin: 0; font-size: clamp(2rem, 4vw, 3.2rem); line-height: 1.1; }
        .subtitle { margin: 14px 0 0; color: var(--muted); line-height: 1.8; }
        .feed { display: grid; gap: 20px; }
        .post {
            display: grid;
            grid-template-columns: 220px 1fr;
            gap: 18px;
            padding: 18px;
            border: 1px solid var(--line);
            border-radius: 22px;
            background: rgba(255, 255, 255, .82);
            backdrop-filter: blur(6px);
            box-shadow: 0 10px 24px rgba(0, 0, 0, .06);
        }
        .thumb {
            width: 100%;
            aspect-ratio: 4 / 3;
            object-fit: cover;
            border-radius: 16px;
            background: rgba(223, 240, 215, .9);
            border: 1px solid rgba(31, 41, 55, .08);
        }
        .meta { font-size: .9rem; color: #67806c; margin-bottom: 8px; }
        .post h2 { margin: 0 0 10px; font-size: 1.35rem; }
        .post p { margin: 0; color: var(--muted); line-height: 1.85; }
        .tag { display: inline-block; margin-top: 12px; padding: 6px 10px; border-radius: 999px; background: #edf7e9; color: #4b7a55; font-size: .85rem; }
        .note {
            margin-top: 18px;
            padding: 14px 18px;
            border-radius: 16px;
            background: rgba(255, 255, 255, .72);
            border: 1px dashed rgba(31, 41, 55, .14);
            color: #4f5d54;
            line-height: 1.75;
        }
        @media (max-width: 720px) {
            .hero, .post { padding: 18px; }
            .post { grid-template-columns: 1fr; }
        }
    </style>
</head>
<body>
    <div class="overlay">
        <main class="page">
            <section class="hero">
                <p class="eyebrow">FOOD DIARY · 食物分享</p>
                <h1>日常餐桌的小確幸</h1>
                <p class="subtitle">這裡記錄幾篇簡單的食物分享文章。每張照片都是生活的一角，背景圖則是我精心挑選。</p>
            </section>

            <section class="feed">
                <article class="post">
                    <img class="thumb" src="./files/img1.jpg" alt="早餐照片">
                    <div>
                        <div class="meta">2026 年 5 月 10 日 · 早餐</div>
                        <h2>清晨的吐司與牛奶</h2>
                        <p>今天起得比較早，簡單烤了兩片吐司，配上一杯溫牛奶。沒有太多調味，但剛剛好的香氣，已經足夠讓人開始新的一天。</p>
                        <span class="tag">#早餐 #簡單生活</span>
                    </div>
                </article>

                <article class="post">
                    <img class="thumb" src="./files/img2.jpg" alt="午餐照片">
                    <div>
                        <div class="meta">2026 年 5 月 10 日 · 午餐</div>
                        <h2>便當裡的家常味道</h2>
                        <p>中午打開便當，裡面是白飯、炒青菜和一點滷蛋。看起來普通，卻很有家裡的味道，吃完之後心情也安定了不少。</p>
                        <span class="tag">#午餐 #家常菜</span>
                    </div>
                </article>

                <article class="post">
                    <img class="thumb" src="./files/img3.jpg" alt="甜點照片">
                    <div>
                        <div class="meta">2026 年 5 月 10 日 · 甜點</div>
                        <h2>午後的豆花時光</h2>
                        <p>下午茶選了豆花加一點黑糖漿，口感滑順又不會太甜。坐在窗邊慢慢吃，剛好把整天的疲憊都收起來。</p>
                        <span class="tag">#甜點 #下午茶</span>
                    </div>
                </article>
            </section>

            <!-- <div class="note">提示：背景圖片檔案名稱已改為 <strong>background.png</strong>，而且它本身是淡綠色。請多留意背景與頁面內容之間的差異。</div> -->
        </main>
    </div>
</body>
</html>

