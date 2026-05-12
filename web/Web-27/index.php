<!DOCTYPE html>
<html lang="zh-HK">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Web-27 Mario 像素檔案</title>
    <style>
        :root {
            --sky: #79c7ff;
            --cloud: #f8fbff;
            --brick: #b35a2d;
            --brick-edge: #7d3218;
            --ground: #d9a34a;
            --panel: #fff8dd;
            --ink: #2d1d13;
            --accent: #d62828;
        }
        * { box-sizing: border-box; }
        body {
            margin: 0;
            min-height: 100vh;
            font-family: "Press Start 2P", "Courier New", monospace;
            color: var(--ink);
            background:
                radial-gradient(circle at 15% 15%, var(--cloud) 0 5%, transparent 5.2%),
                radial-gradient(circle at 24% 17%, var(--cloud) 0 4%, transparent 4.2%),
                radial-gradient(circle at 78% 12%, var(--cloud) 0 5%, transparent 5.2%),
                radial-gradient(circle at 86% 14%, var(--cloud) 0 4%, transparent 4.2%),
                linear-gradient(180deg, var(--sky) 0 76%, var(--ground) 76% 100%);
            display: grid;
            place-items: center;
            padding: 24px 16px;
        }
        .card {
            width: min(100%, 860px);
            border: 6px solid var(--brick-edge);
            background: var(--panel);
            box-shadow: 0 0 0 6px var(--brick), 12px 12px 0 rgba(45, 29, 19, .22);
            padding: 28px;
        }
        .banner {
            margin-bottom: 20px;
            padding: 14px 16px;
            border: 4px solid var(--brick-edge);
            background: repeating-linear-gradient(
                90deg,
                #ffd166 0 20px,
                #ffcb47 20px 40px
            );
        }
        h1 {
            margin: 0;
            font-size: clamp(1.25rem, 3vw, 2rem);
            line-height: 1.4;
        }
        .layout {
            display: grid;
            grid-template-columns: 280px 1fr;
            gap: 24px;
            align-items: start;
        }
        .preview {
            width: 100%;
            image-rendering: pixelated;
            border: 4px solid var(--brick-edge);
            background: #ffffff;
            padding: 10px;
        }
        .panel {
            border: 4px solid var(--brick-edge);
            background: rgba(255, 255, 255, .78);
            padding: 16px;
        }
        p {
            margin: 0 0 14px;
            font-size: .78rem;
            line-height: 1.9;
        }
        .intro {
            margin-bottom: 18px;
        }
        .cta {
            display: inline-block;
            margin: 8px 0 18px;
            padding: 14px 18px;
            border: 4px solid var(--brick-edge);
            background: var(--accent);
            color: #fffbea;
            text-decoration: none;
        }
        .hint {
            padding: 14px;
            border: 4px dashed var(--brick-edge);
            background: #fff3c2;
        }
        code {
            font-family: "Courier New", monospace;
            font-size: .9em;
            background: rgba(45, 29, 19, .08);
            padding: 2px 6px;
        }
        @media (max-width: 760px) {
            .card { padding: 18px; }
            .layout { grid-template-columns: 1fr; }
        }
    </style>
</head>
<body>
    <div class="card">
        <div class="banner">
            <h1>MARIO PIXEL ARCHIVE</h1>
        </div>
        <div class="layout">
            <img class="preview" src="./files/mario.bmp" alt="Mario BMP 預覽圖">
            <div class="panel">
                <p class="intro">瑪利歐身高1米55，現居蘑菇王國，瑪利歐是一位矮小結實的水管工。由於多次挫敗庫巴綁架碧姬公主的計劃，瑪利歐的英名傳遍蘑菇王國，並影響到和周邊一些國家。他的勇敢的個性、熱情無畏的精神、敏捷的體格、跳躍技能、以及與碧姬公主的友情也更加鞏固了他的名聲。</p>
                <p>《超級瑪利歐兄弟》（日語：スーパーマリオブラザーズ）是任天堂於1985年發售的橫版過關遊戲，是電子遊戲領域的代表作之一，其遊玩模式、配樂及2D設計風格世界聞名。</p>
                <div class="hint">
                    <p>《超級瑪利歐兄弟》的遊玩過程當中，<strong><mark>只有走到最尾</mark></strong>，才能把通關的旗幟拉下來喲！</p>
                </div>
            </div>
        </div>
    </div>
</body>
</html>

