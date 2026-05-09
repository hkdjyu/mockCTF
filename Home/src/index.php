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
      'web01' => ['difficulty' => '★☆☆☆☆（1星）', 'tags' => ['WEB', 'DEVTOOL']],
      'web02' => ['difficulty' => '★★☆☆☆（2星）', 'tags' => ['WEB', 'DEVTOOL', 'CRYPTO']],
      'web03' => ['difficulty' => '★★☆☆☆（2星）', 'tags' => ['WEB', 'DEVTOOL', 'RE']],
      'web04' => ['difficulty' => '★★☆☆☆（2星）', 'tags' => ['WEB', 'DEVTOOL', 'CRYPTO']],
      'web05' => ['difficulty' => '★★☆☆☆（2星）', 'tags' => ['WEB', 'DEVTOOL']],
      'web06' => ['difficulty' => '★★☆☆☆（2星）', 'tags' => ['WEB', 'DEVTOOL', 'CRYPTO']],
      'web07' => ['difficulty' => '★★☆☆☆（2星）', 'tags' => ['WEB', 'DEVTOOL', 'CRYPTO']],
      'web08' => ['difficulty' => '★★★☆☆（3星）', 'tags' => ['WEB', 'DEVTOOL', 'RE']],
      'web09' => ['difficulty' => '★★★☆☆（3星）', 'tags' => ['WEB', 'DEVTOOL', 'MISC']],
      'web10' => ['difficulty' => '★★★★☆（4星）', 'tags' => ['WEB', 'DEVTOOL', 'CRYPTO', 'MISC']],
      'web11' => ['difficulty' => '★★☆☆☆（2星）', 'tags' => ['WEB', 'DEVTOOL']],
      'web12' => ['difficulty' => '★★☆☆☆（2星）', 'tags' => ['WEB', 'DEVTOOL']],
      'web13' => ['difficulty' => '★★☆☆☆（2星）', 'tags' => ['WEB', 'DEVTOOL']],
      'web14' => ['difficulty' => '★★★☆☆（3星）', 'tags' => ['WEB', 'DEVTOOL']],
      'web15' => ['difficulty' => '★★★☆☆（3星）', 'tags' => ['WEB', 'DEVTOOL', 'MISC']],
      'web16' => ['difficulty' => '★★★☆☆（3星）', 'tags' => ['WEB', 'DEVTOOL', 'CRYPTO']],
      'web17' => ['difficulty' => '★★☆☆☆（2星）', 'tags' => ['WEB', 'DEVTOOL']],
      'web18' => ['difficulty' => '★★★★☆（4星）', 'tags' => ['WEB', 'DEVTOOL', 'MISC']],
      'web19' => ['difficulty' => '★★★★☆（4星）', 'tags' => ['WEB', 'DEVTOOL']],
      'web20' => ['difficulty' => '★★★★☆（4星）', 'tags' => ['WEB', 'DEVTOOL', 'MISC']],
      'web21' => ['difficulty' => '★★☆☆☆（2星）', 'tags' => ['MISC', 'CRYPTO']],
      'web22' => ['difficulty' => '★★☆☆☆（2星）', 'tags' => ['MISC', 'MEDIA']],
      'web23' => ['difficulty' => '★★★☆☆（3星）', 'tags' => ['MEDIA', 'MISC']],
      'web24' => ['difficulty' => '★★★☆☆（3星）', 'tags' => ['MEDIA', 'MISC']],
      'web25' => ['difficulty' => '★★☆☆☆（2星）', 'tags' => ['MEDIA', 'MISC']],
      'web26' => ['difficulty' => '★★★☆☆（3星）', 'tags' => ['MEDIA', 'STENO']],
      'web27' => ['difficulty' => '★★★★☆（4星）', 'tags' => ['MEDIA', 'STENO']],
      'web28' => ['difficulty' => '★★☆☆☆（2星）', 'tags' => ['MEDIA', 'MISC']],
      'web29' => ['difficulty' => '★★★☆☆（3星）', 'tags' => ['MEDIA', 'MISC']],
      'web30' => ['difficulty' => '★★★★☆（4星）', 'tags' => ['MISC', 'MEDIA', 'CRYPTO']],
      'web31' => ['difficulty' => '★★★☆☆（3星）', 'tags' => ['WEB', 'MEDIA', 'STENO']],
      'web32' => ['difficulty' => '★★★☆☆（3星）', 'tags' => ['WEB', 'MEDIA', 'STENO', 'CRYPTO']],
      'web33' => ['difficulty' => '★★★☆☆（3星）', 'tags' => ['WEB', 'MEDIA', 'STENO']],
      'web34' => ['difficulty' => '★★★☆☆（3星）', 'tags' => ['WEB', 'MEDIA', 'STENO']],
      'web35' => ['difficulty' => '★★★☆☆（3星）', 'tags' => ['WEB', 'MEDIA', 'STENO']],
      'web36' => ['difficulty' => '★★★★☆（4星）', 'tags' => ['WEB', 'MEDIA', 'STENO', 'RE']],
      'web37' => ['difficulty' => '★★★☆☆（3星）', 'tags' => ['WEB', 'MEDIA', 'CRYPTO']],
      'web38' => ['difficulty' => '★★★☆☆（3星）', 'tags' => ['WEB', 'MEDIA', 'STENO']],
      'web39' => ['difficulty' => '★★★★☆（4星）', 'tags' => ['WEB', 'MEDIA', 'STENO']],
      'web40' => ['difficulty' => '★★★★☆（4星）', 'tags' => ['WEB', 'MEDIA', 'MISC']],
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
      max-width: 1100px;
      margin: 0 auto;
      padding: 24px 16px 28px;
    }

    .hero {
      background: linear-gradient(135deg, #0b7285, #3f51b5);
      color: #fff;
      border-radius: 16px;
      padding: 22px;
      box-shadow: 0 10px 22px rgba(16, 37, 84, 0.2);
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
      margin-top: 16px;
      background: var(--panel);
      border: 1px solid var(--line);
      border-radius: 14px;
      padding: 14px;
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

    .grid {
      margin-top: 16px;
      display: grid;
      grid-template-columns: repeat(auto-fill, minmax(180px, 1fr));
      gap: 10px;
    }

    .card {
      text-decoration: none;
      color: inherit;
      border: 1px solid var(--line);
      border-radius: 12px;
      background: #fff;
      padding: 12px;
      transition: transform 120ms ease, box-shadow 120ms ease;
      display: block;
    }

    .card:hover {
      transform: translateY(-2px);
      box-shadow: 0 8px 14px rgba(29, 45, 76, 0.14);
    }

    .title {
      font-size: 15px;
      font-weight: 700;
    }

    .meta {
      margin-top: 6px;
      font-size: 13px;
      color: var(--muted);
    }

    .difficulty {
      margin-top: 8px;
      font-size: 13px;
      color: #334155;
      font-weight: 600;
    }

    .tags {
      margin-top: 8px;
      display: flex;
      flex-wrap: wrap;
      gap: 6px;
    }

    .tag {
      font-size: 11px;
      line-height: 1;
      padding: 5px 7px;
      border-radius: 999px;
      border: 1px solid #d6deea;
      background: #f4f7fb;
      color: #344255;
      font-weight: 700;
      letter-spacing: 0.2px;
    }

    .badge {
      margin-top: 8px;
      font-size: 12px;
      font-weight: 700;
      display: inline-block;
      padding: 4px 8px;
      border-radius: 999px;
      background: var(--chip);
      color: #3a4350;
    }

    .badge.ok {
      background: #e8f8ef;
      color: var(--ok);
    }

    @media (max-width: 700px) {
      form { grid-template-columns: 1fr; }
      button { padding: 12px; }
      .hero h1 { font-size: 24px; }
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

    <section class="grid">
      <?php foreach ($questions as $key => $q): ?>
        <?php $done = !empty($_SESSION['solved'][$key]); ?>
        <?php $meta = $questionMeta[$key] ?? ['difficulty' => '未知', 'tags' => ['N/A']]; ?>
        <a class="card" href="<?php echo htmlspecialchars($q['url'], ENT_QUOTES, 'UTF-8'); ?>" target="_blank" rel="noopener noreferrer">
          <div class="title"><?php echo htmlspecialchars($q['label'], ENT_QUOTES, 'UTF-8'); ?></div>
          <div class="meta"><?php echo htmlspecialchars($q['url'], ENT_QUOTES, 'UTF-8'); ?></div>
          <div class="difficulty">難度：<?php echo htmlspecialchars($meta['difficulty'], ENT_QUOTES, 'UTF-8'); ?></div>
          <div class="tags">
            <?php foreach ($meta['tags'] as $tag): ?>
              <span class="tag"><?php echo htmlspecialchars($tag, ENT_QUOTES, 'UTF-8'); ?></span>
            <?php endforeach; ?>
          </div>
          <div class="badge <?php echo $done ? 'ok' : ''; ?>">
            <?php echo $done ? '已完成' : '未完成'; ?>
          </div>
        </a>
      <?php endforeach; ?>
    </section>
  </main>
</body>
</html>
