<?php
header('Content-Type: application/json; charset=utf-8');

echo json_encode([
    'status' => 'ok',
    'piece' => 'ZXZ0b29s'
], JSON_UNESCAPED_UNICODE);