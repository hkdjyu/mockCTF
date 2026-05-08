<?php
header('Content-Type: application/json; charset=utf-8');
echo json_encode([
  'status' => 'ok',
  'message' => 'See Network tab for details',
  'debug_xyz' => 'emi_'
], JSON_UNESCAPED_UNICODE);
