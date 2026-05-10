<?php
header('Content-Type: application/json; charset=utf-8');

$id = $_GET['id'] ?? '1';
$view = $_GET['view'] ?? 'public';

if ($view === 'normal') {
    echo json_encode([
        'status' => 'ok',
        'message' => 'NORMAL',
        'hint' => 'You discovered the & parameter separator! Try removing &view=normal'
    ], JSON_UNESCAPED_UNICODE);
    exit;
}

if ($id === '7' && $view === 'debug') {
    echo json_encode([
        'status' => 'ok',
        'message' => 'internal record loaded',
        'archive' => 'ZmxhZ3tyZXNlbmRfcmVxdWVzdHNfY2hhbmdlX2Fuc3dlcnN9'
    ], JSON_UNESCAPED_UNICODE);
    exit;
}

echo json_encode([
    'status' => 'not_found',
    'message' => 'public record unavailable',
    'hint' => 'try id=7 with debug view'
], JSON_UNESCAPED_UNICODE);