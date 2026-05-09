<!DOCTYPE html>
<html lang="zh-HK">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Web-31 校訓及校徽</title>
    <link rel="icon" href="/files/llc.jpg">
    <style>
        :root {
            --bg: #f3f5f9;
            --panel: #ffffff;
            --ink: #1f2937;
            --muted: #5b6472;
            --line: #dbe2ec;
            --accent: #8b6b2f;
        }

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: "Noto Serif TC", "Microsoft JhengHei", serif;
            color: var(--ink);
            background:
                radial-gradient(circle at 15% 15%, #e6edf8 0, transparent 38%),
                radial-gradient(circle at 90% 80%, #f9efdb 0, transparent 40%),
                var(--bg);
            line-height: 1.85;
        }

        .wrap {
            max-width: 920px;
            margin: 0 auto;
            padding: 32px 16px 40px;
        }

        .hero {
            display: grid;
            grid-template-columns: 1fr;
            gap: 18px;
            align-items: center;
            background: linear-gradient(135deg, #1f3558, #2f4d78);
            color: #fff;
            border-radius: 16px;
            padding: 20px;
            box-shadow: 0 14px 28px rgba(20, 35, 69, 0.28);
            position: relative;
            overflow: hidden;
        }

        .hero::after {
            content: "";
            position: absolute;
            inset: 0;
            background: url('/files/llc.jpg') right -40px center / 220px auto no-repeat;
            opacity: 0.14;
            pointer-events: none;
        }

        .hero h1 {
            margin: 0;
            font-size: clamp(1.5rem, 3vw, 2rem);
            letter-spacing: 0.03em;
            position: relative;
            z-index: 1;
        }

        .hero p {
            margin: 8px 0 0;
            opacity: 0.95;
            position: relative;
            z-index: 1;
        }

        .panel {
            margin-top: 16px;
            background: var(--panel);
            border: 1px solid var(--line);
            border-radius: 14px;
            padding: 20px;
            box-shadow: 0 10px 18px rgba(29, 42, 68, 0.08);
        }

        .panel h2 {
            margin: 0 0 10px;
            font-size: 1.2rem;
            color: #1d3152;
            border-left: 4px solid var(--accent);
            padding-left: 10px;
        }

        .verse {
            margin: 0;
            font-weight: 700;
            color: #2c3b55;
            background: #f4f7fb;
            border: 1px solid var(--line);
            border-radius: 10px;
            padding: 12px;
        }

        .desc {
            margin: 0;
            color: var(--muted);
            text-align: justify;
        }

        @media (max-width: 680px) {
            .hero {
                grid-template-columns: 1fr;
                text-align: center;
            }

            .hero::after {
                background-position: center bottom -35px;
                background-size: 180px auto;
            }
        }
    </style>
</head>
<body>
    <main class="wrap">
        <section class="hero">
            <div>
                <h1>Web-31 校訓及校徽</h1>
                <p>本頁簡介本校校訓與校徽意義。</p>
            </div>
        </section>

        <section class="panel">
            <h2>校訓</h2>
            <p class="verse">「敬畏耶和華是智慧的開端，認識至聖者便是聰明。」（箴言九章十節）</p>
        </section>

        <section class="panel">
            <h2>校徽意義</h2>
            <p class="desc">校徽外圍的圓形皮帶取自新約聖經以弗所書六章十四節－「用真理當作帶子束腰」，勉勵學生要身體力行，實踐真理；圓形的皮帶喻意「完全」，強調全人的教育。背景的荊棘十字架，取材自歐洲中世紀的古老十架模式，代表著基督耶穌的救贖。其中金色的榮耀冠冕代表著基督耶穌作王。校徽以金色為主色，表示貴重和單純的品質，聖經勉勵信徒要「作貴重的器皿，成為聖潔，合乎主用。」（提摩太後書二章廿一節）。我們期望靈糧中學的學生是懂得尊重自己及擁有高尚品格的良好公民，更是一個自信及自愛的基督徒。</p>
        </section>
    </main>
</body>
</html>