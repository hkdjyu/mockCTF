<?php
$flag = 'flag{svg_hidden_text}';
$encoded = base64_encode($flag);

$svg = <<<SVG
<?xml version="1.0" encoding="UTF-8"?>
<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 200 200">
  <circle cx="100" cy="100" r="90" stroke="blue" fill="lightblue" stroke-width="2"/>
  <text x="100" y="110" text-anchor="middle" font-size="24" fill="blue">校徽</text>
  <text x="-9999" y="-9999" font-size="12" fill="white" display="none">$encoded</text>
</svg>
SVG;

@mkdir('/var/www/html/files', 0755, true);
file_put_contents('/var/www/html/files/logo.svg', $svg);
echo 'SVG generated: ' . htmlspecialchars($encoded);
?>
