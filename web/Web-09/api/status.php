<?php
header('Content-Type: application/json; charset=utf-8');
echo json_encode([
  'service' => 'student-portal',
  'status' => 'ok',
  'uptime' => '99.9%',
  'debug_data' => 'ZmxhZ3toaWRkZW5fanNvbl9maWVsZF9mb3VuZH0='
], JSON_UNESCAPED_UNICODE);
