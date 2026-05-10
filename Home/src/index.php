<?php
session_start();

$questions = [];
for ($i = 1; $i <= 40; $i++) {
    $id = str_pad((string)$i, 2, '0', STR_PAD_LEFT);
    $key = "web{$id}";
    $questions[$key] = [
        'label' => "Web-{$id}",
        'url' => 'http://localhost:' . (8000 + $i),
    ];
}

    $questionMeta = [
      'web01' => ['difficulty' => '★☆☆☆☆（1星）', 'tags' => ['WEB']],
      'web02' => ['difficulty' => '★☆☆☆☆（1星）', 'tags' => ['WEB']],
      'web03' => ['difficulty' => '★☆☆☆☆（1星）', 'tags' => ['WEB']],
      'web04' => ['difficulty' => '★☆☆☆☆（1星）', 'tags' => ['WEB']],
      'web05' => ['difficulty' => '★☆☆☆☆（1星）', 'tags' => ['WEB']],
      'web06' => ['difficulty' => '★★★☆☆（3星）', 'tags' => ['WEB']],
      'web07' => ['difficulty' => '★★☆☆☆（2星）', 'tags' => ['WEB']],
      'web08' => ['difficulty' => '★☆☆☆☆（1星）', 'tags' => ['WEB']],
      'web09' => ['difficulty' => '★☆☆☆☆（1星）', 'tags' => ['WEB']],
      'web10' => ['difficulty' => '★★☆☆☆（2星）', 'tags' => ['WEB']],
      'web11' => ['difficulty' => '★★☆☆☆（2星）', 'tags' => ['WEB']],
      'web12' => ['difficulty' => '★☆☆☆☆（1星）', 'tags' => ['WEB']],
      'web13' => ['difficulty' => '★☆☆☆☆（1星）', 'tags' => ['WEB']],
      'web14' => ['difficulty' => '★★☆☆☆（2星）', 'tags' => ['WEB', 'CRYPTO']],
      'web15' => ['difficulty' => '★☆☆☆☆（1星）', 'tags' => ['WEB']],
      'web16' => ['difficulty' => '★☆☆☆☆（1星）', 'tags' => ['WEB']],
      'web17' => ['difficulty' => '★★★☆☆（3星）', 'tags' => ['WEB', 'CRYPTO']],
      'web18' => ['difficulty' => '★☆☆☆☆（1星）', 'tags' => ['WEB']],
      'web19' => ['difficulty' => '★★☆☆☆（2星）', 'tags' => ['WEB']],
      'web20' => ['difficulty' => '★★☆☆☆（2星）', 'tags' => ['WEB']],
      'web21' => ['difficulty' => '★☆☆☆☆（1星）', 'tags' => ['Forensics']],
      'web22' => ['difficulty' => '★☆☆☆☆（1星）', 'tags' => ['WEB', 'Forensics']],
      'web23' => ['difficulty' => '★☆☆☆☆（1星）', 'tags' => ['Forensics']],
      'web24' => ['difficulty' => '★★☆☆☆（2星）', 'tags' => ['Forensics']],
      'web25' => ['difficulty' => '★☆☆☆☆（1星）', 'tags' => ['Forensics']],
      'web26' => ['difficulty' => '★★☆☆☆（2星）', 'tags' => ['Forensics']],
      'web27' => ['difficulty' => '★★★☆☆（3星）', 'tags' => ['Forensics']],
      'web28' => ['difficulty' => '★☆☆☆☆（1星）', 'tags' => ['Forensics']],
      'web29' => ['difficulty' => '★☆☆☆☆（1星）', 'tags' => ['Forensics']],
      'web30' => ['difficulty' => '★★☆☆☆（2星）', 'tags' => ['Forensics']],
      'web31' => ['difficulty' => '★★☆☆☆（2星）', 'tags' => ['WEB', 'Forensics']],
      'web32' => ['difficulty' => '★★★☆☆（3星）', 'tags' => ['Forensics', 'CRYPTO']],
      'web33' => ['difficulty' => '★★☆☆☆（2星）', 'tags' => ['Forensics']],
      'web34' => ['difficulty' => '★★☆☆☆（2星）', 'tags' => ['Forensics']],
      'web35' => ['difficulty' => '★★★☆☆（3星）', 'tags' => ['Forensics']],
      'web36' => ['difficulty' => '★☆☆☆☆（1星）', 'tags' => ['Forensics']],
      'web37' => ['difficulty' => '★★☆☆☆（2星）', 'tags' => ['Forensics']],
      'web38' => ['difficulty' => '★★☆☆☆（2星）', 'tags' => ['Forensics']],
      'web39' => ['difficulty' => '★★★☆☆（3星）', 'tags' => ['Forensics']],
      'web40' => ['difficulty' => '★★★★☆（4星）', 'tags' => ['WEB', 'Forensics']],
    ];

$flagsByQuestion = [
    'web01' => 'flag{d3v_t00ls_4_th3_w1n}',
    'web02' => 'flag{comment_1n_comm3nt}',
    'web03' => 'flag{frontend_auth_is_not_security}',
    'web04' => 'flag{css_can_leak_secrets}',
    'web05' => 'flag{localstorage_is_public}',
    'web06' => 'flag{cookies_make_a_puzzle}',
    'web07' => 'flag{headers_tell_stories}',
    'web08' => 'flag{sourcemap_leaks_source}',
    'web09' => 'flag{hidden_json_field_found}',
    'web10' => 'flag{emi_ultimate_dev_detective}',
    'web11' => 'flag{disabled_fields_still_talk}',
    'web12' => 'flag{session_storage_is_short_term}',
    'web13' => 'flag{hash_routes_can_hide_paths}',
    'web14' => 'flag{cache_storage_keeps_history}',
    'web15' => 'flag{indexeddb_keeps_drafts}',
    'web16' => 'flag{jwt_payloads_are_public}',
    'web17' => 'flag{manifest_files_leak_routes}',
    'web18' => 'flag{service_workers_can_mislead}',
    'web19' => 'flag{resend_requests_change_answers}',
    'web20' => 'flag{devtools_collects_all}',
    'web21' => 'flag{text_encoding_chain}',
    'web22' => 'flag{csv_hidden_columns}',
    'web23' => 'flag{pdf_metadata_leaked}',
    'web24' => 'flag{excel_hidden_sheets}',
    'web25' => 'flag{svg_hidden_text}',
    'web26' => 'flag{png_exif_metadata}',
    'web27' => 'flag{bmp_steganography}',
    'web28' => 'flag{mp3_id3_tags}',
    'web29' => 'flag{wav_riff_chunks}',
    'web30' => 'flag{multi_format_maze_challenge}',
    'web31' => 'flag{llc_jpeg_exif_hidden_text}',
    'web32' => 'flag{correct_flag_for_png}',
    'web33' => 'flag{you_got_it_in_a_frame}',
    'web34' => 'flag{this_is_paragliding}',
    'web35' => 'flag{least_significant_bit}',
    'web36' => 'flag{rickroll_hahahaha}',
    'web37' => 'flag{moresecodeisclassic}',
    'web38' => 'flag{LSB_in_picture}',
    'web39' => 'flag{spectrogram_hard}',
    'web40' => 'flag{hello_world}',
];

$message = '';
$messageType = '';

if (!isset($_SESSION['solved']) || !is_array($_SESSION['solved'])) {
  $_SESSION['solved'] = [];
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $flagInput = isset($_POST['flag']) ? trim((string)$_POST['flag']) : '';

  if ($flagInput === '') {
    $message = '請先輸入 Flag。';
    $messageType = 'error';
  } else {
    $matchedQuestion = null;
    foreach ($flagsByQuestion as $question => $flag) {
      if (hash_equals($flag, $flagInput)) {
        $matchedQuestion = $question;
        break;
      }
    }

    if ($matchedQuestion !== null) {
      $_SESSION['solved'][$matchedQuestion] = true;
      $message = '驗證成功！已完成 ' . strtoupper($matchedQuestion) . '。';
      $messageType = 'success';
    } else {
      $message = 'Flag 不正確，請再試一次。';
      $messageType = 'error';
    }
  }
}

$solvedCount = count($_SESSION['solved']);
$totalCount = count($questions);
?>
<!doctype html>
<html lang="zh-Hant">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>mockCTF Home</title>
  <style>
    :root {
      --bg: #f6f8fb;
      --panel: #ffffff;
      --ink: #1f2937;
      --muted: #5b6472;
      --accent: #0b7285;
      --ok: #1b9e59;
      --bad: #cb3a31;
      --line: #d8dee7;
      --chip: #edf2f7;
    }

    * { box-sizing: border-box; }

    body {
      margin: 0;
      font-family: "Segoe UI", "Noto Sans TC", sans-serif;
      color: var(--ink);
      background:
        radial-gradient(circle at 20% 10%, #d8eef2 0, transparent 38%),
        radial-gradient(circle at 85% 85%, #e8eaf8 0, transparent 42%),
        var(--bg);
      min-height: 100vh;
    }

    .wrap {
      max-width: 1200px;
      margin: 0 auto;
      padding: 24px 16px 28px;
    }

    .hero {
      background: linear-gradient(135deg, #0b7285, #3f51b5);
      color: #fff;
      border-radius: 16px;
      padding: 22px;
      box-shadow: 0 10px 22px rgba(16, 37, 84, 0.2);
      margin-bottom: 20px;
    }

    .hero h1 {
      margin: 0;
      font-size: 28px;
      letter-spacing: 0.3px;
    }

    .hero p {
      margin: 10px 0 0;
      opacity: 0.95;
    }

    .meter {
      margin-top: 14px;
      display: inline-block;
      background: rgba(255, 255, 255, 0.18);
      border: 1px solid rgba(255, 255, 255, 0.3);
      padding: 6px 10px;
      border-radius: 999px;
      font-weight: 600;
      font-size: 14px;
    }

    .panel {
      position: sticky;
      top: 10px;
      z-index: 100;
      background: var(--panel);
      border: 1px solid var(--line);
      border-radius: 14px;
      padding: 14px;
      margin-bottom: 20px;
      box-shadow: 0 4px 12px rgba(0,0,0,0.1);
    }

    form {
      display: grid;
      gap: 10px;
      grid-template-columns: 1fr auto;
    }

    input[type="text"] {
      width: 100%;
      border: 1px solid var(--line);
      border-radius: 10px;
      padding: 12px;
      font-size: 16px;
      outline: none;
    }

    input[type="text"]:focus {
      border-color: var(--accent);
      box-shadow: 0 0 0 3px rgba(11, 114, 133, 0.14);
    }

    button {
      border: none;
      border-radius: 10px;
      background: var(--accent);
      color: #fff;
      font-weight: 700;
      padding: 0 18px;
      cursor: pointer;
      transition: background 120ms ease;
    }

    button:hover {
      background: #085a71;
    }

    .msg {
      margin-top: 10px;
      padding: 10px;
      border-radius: 10px;
      font-weight: 600;
    }

    .msg.success {
      background: #e8f8ef;
      color: var(--ok);
      border: 1px solid #c9ebd8;
    }

    .msg.error {
      background: #feeceb;
      color: var(--bad);
      border: 1px solid #f5cecc;
    }

    .filter-section {
      background: var(--panel);
      border: 1px solid var(--line);
      border-radius: 14px;
      padding: 16px;
      margin-bottom: 20px;
    }

    .filter-title {
      font-weight: 700;
      margin-bottom: 12px;
      font-size: 14px;
      color: var(--ink);
    }

    .filter-group {
      margin-bottom: 16px;
    }

    .filter-group:last-child {
      margin-bottom: 0;
    }

    .filter-options {
      display: flex;
      flex-wrap: wrap;
      gap: 8px;
    }

    .filter-btn {
      padding: 6px 12px;
      border: 1px solid var(--line);
      border-radius: 999px;
      background: #fff;
      color: var(--ink);
      cursor: pointer;
      font-size: 13px;
      font-weight: 600;
      transition: all 120ms ease;
    }

    .filter-btn:hover {
      border-color: var(--accent);
      background: #f0f7fb;
    }

    .filter-btn.active {
      background: var(--accent);
      color: #fff;
      border-color: var(--accent);
    }

    .grid {
      display: grid;
      grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
      gap: 12px;
    }

    .card {
      text-decoration: none;
      color: inherit;
      border: 1px solid var(--line);
      border-radius: 12px;
      background: #fff;
      padding: 14px;
      transition: all 120ms ease;
      display: block;
      position: relative;
    }

    .card:hover {
      transform: translateY(-3px);
      box-shadow: 0 8px 16px rgba(29, 45, 76, 0.14);
    }

    .card.completed {
      background: #e8f8ef;
      border-color: #c9ebd8;
    }

    .card.completed:hover {
      box-shadow: 0 8px 16px rgba(27, 158, 89, 0.15);
    }

    .title {
      font-size: 16px;
      font-weight: 700;
      margin-bottom: 4px;
    }

    .meta {
      font-size: 12px;
      color: var(--muted);
      margin-bottom: 10px;
    }

    .difficulty {
      font-size: 13px;
      color: #334155;
      font-weight: 600;
      margin-bottom: 8px;
    }

    .tags {
      display: flex;
      flex-wrap: wrap;
      gap: 5px;
      margin-bottom: 10px;
    }

    .tag {
      font-size: 11px;
      line-height: 1.2;
      padding: 4px 8px;
      border-radius: 6px;
      font-weight: 700;
      letter-spacing: 0.3px;
      color: #fff;
      border: none;
    }

    .tag.web { background: #3b82f6; }
    .tag.crypto { background: #f97316; }
    .tag.misc { background: #8b5cf6; }
    .tag.forensics { background: #10b981; }

    .badge {
      font-size: 12px;
      font-weight: 700;
      display: inline-block;
      padding: 5px 10px;
      border-radius: 6px;
      background: #fef08a;
      color: #78350f;
    }

    .badge.ok {
      background: #dcfce7;
      color: var(--ok);
    }

    .hidden {
      display: none;
    }

    @media (max-width: 700px) {
      form { grid-template-columns: 1fr; }
      button { padding: 12px; }
      .hero h1 { font-size: 24px; }
      .grid { grid-template-columns: repeat(auto-fill, minmax(150px, 1fr)); }
    }
  </style>
</head>
<body>
  <main class="wrap">
    <section class="hero">
      <h1>mockCTF Home</h1>
      <p>在這裡快速跳轉題目，並輸入你找到的 Flag 以記錄已完成題目。</p>
      <div class="meter">
        完成進度：<?php echo $solvedCount; ?> / <?php echo $totalCount; ?>
      </div>
    </section>

    <section class="panel">
      <form method="post" action="">
        <input type="text" name="flag" placeholder="輸入 flag{...}" autocomplete="off">
        <button type="submit">驗證 Flag</button>
      </form>
      <?php if ($message !== ''): ?>
        <div class="msg <?php echo htmlspecialchars($messageType, ENT_QUOTES, 'UTF-8'); ?>">
          <?php echo htmlspecialchars($message, ENT_QUOTES, 'UTF-8'); ?>
        </div>
      <?php endif; ?>
    </section>

    <section class="filter-section">
      <div class="filter-title">🔍 篩選</div>
      
      <div class="filter-group">
        <div style="font-size:12px; font-weight:600; margin-bottom:8px; color:var(--muted);">難度</div>
        <div class="filter-options">
          <button type="button" class="filter-btn active" data-filter-type="difficulty" data-filter-value="all">全部</button>
          <button type="button" class="filter-btn" data-filter-type="difficulty" data-filter-value="1">1星</button>
          <button type="button" class="filter-btn" data-filter-type="difficulty" data-filter-value="2">2星</button>
          <button type="button" class="filter-btn" data-filter-type="difficulty" data-filter-value="3">3星</button>
          <button type="button" class="filter-btn" data-filter-type="difficulty" data-filter-value="4">4星</button>
        </div>
      </div>

      <div class="filter-group">
        <div style="font-size:12px; font-weight:600; margin-bottom:8px; color:var(--muted);">種類</div>
        <div class="filter-options">
          <button type="button" class="filter-btn active" data-filter-type="tag" data-filter-value="all">全部</button>
          <button type="button" class="filter-btn" data-filter-type="tag" data-filter-value="WEB">WEB</button>
          <button type="button" class="filter-btn" data-filter-type="tag" data-filter-value="CRYPTO">CRYPTO</button>
          <!-- <button type="button" class="filter-btn" data-filter-type="tag" data-filter-value="MISC">MISC</button> -->
          <button type="button" class="filter-btn" data-filter-type="tag" data-filter-value="Forensics">Forensics</button>
        </div>
      </div>

      <div class="filter-group">
        <div style="font-size:12px; font-weight:600; margin-bottom:8px; color:var(--muted);">狀態</div>
        <div class="filter-options">
          <button type="button" class="filter-btn active" data-filter-type="status" data-filter-value="all">全部</button>
          <button type="button" class="filter-btn" data-filter-type="status" data-filter-value="completed">已完成</button>
          <button type="button" class="filter-btn" data-filter-type="status" data-filter-value="incomplete">未完成</button>
        </div>
      </div>
    </section>

    <section class="grid" id="questionsGrid">
      <?php foreach ($questions as $key => $q): ?>
        <?php $done = !empty($_SESSION['solved'][$key]); ?>
        <?php $meta = $questionMeta[$key] ?? ['difficulty' => '未知', 'tags' => ['N/A']]; ?>
        <?php $diffNum = preg_match('/(\d)星/', $meta['difficulty'], $m) ? $m[1] : '0'; ?>
        <a class="card <?php echo $done ? 'completed' : ''; ?>" 
           href="<?php echo htmlspecialchars($q['url'], ENT_QUOTES, 'UTF-8'); ?>" 
           target="_blank" rel="noopener noreferrer"
           data-question-key="<?php echo htmlspecialchars($key, ENT_QUOTES, 'UTF-8'); ?>"
           data-difficulty="<?php echo $diffNum; ?>"
           data-tags="<?php echo htmlspecialchars(implode(',', $meta['tags']), ENT_QUOTES, 'UTF-8'); ?>"
           data-status="<?php echo $done ? 'completed' : 'incomplete'; ?>">
          <div class="title"><?php echo htmlspecialchars($q['label'], ENT_QUOTES, 'UTF-8'); ?></div>
          <div class="meta"><?php echo htmlspecialchars($q['url'], ENT_QUOTES, 'UTF-8'); ?></div>
          <div class="difficulty"><?php echo htmlspecialchars($meta['difficulty'], ENT_QUOTES, 'UTF-8'); ?></div>
          <div class="tags">
            <?php foreach ($meta['tags'] as $tag): ?>
              <span class="tag <?php echo strtolower($tag); ?>"><?php echo htmlspecialchars($tag, ENT_QUOTES, 'UTF-8'); ?></span>
            <?php endforeach; ?>
          </div>
          <!-- <div class="badge <?php echo $done ? 'ok' : ''; ?>">
            <?php echo $done ? '✓ 已完成' : '未完成'; ?>
          </div> -->
        </a>
      <?php endforeach; ?>
    </section>
  </main>

  <script>
    const filterState = {
      difficulty: 'all',
      tag: 'all',
      status: 'all'
    };

    document.querySelectorAll('.filter-btn').forEach(btn => {
      btn.addEventListener('click', function() {
        const filterType = this.dataset.filterType;
        const filterValue = this.dataset.filterValue;

        document.querySelectorAll(`[data-filter-type="${filterType}"]`).forEach(b => {
          b.classList.remove('active');
        });
        this.classList.add('active');

        filterState[filterType] = filterValue;
        applyFilters();
      });
    });

    function applyFilters() {
      const cards = document.querySelectorAll('.card');
      cards.forEach(card => {
        const cardDifficulty = card.dataset.difficulty;
        const cardTags = card.dataset.tags.split(',');
        const cardStatus = card.dataset.status;

        let show = true;

        if (filterState.difficulty !== 'all' && cardDifficulty !== filterState.difficulty) {
          show = false;
        }

        if (filterState.tag !== 'all' && !cardTags.includes(filterState.tag)) {
          show = false;
        }

        if (filterState.status !== 'all' && cardStatus !== filterState.status) {
          show = false;
        }

        card.classList.toggle('hidden', !show);
      });
    }
  </script>
</body>
</html>
