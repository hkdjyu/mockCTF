<?php
$flag = 'flag{png_exif_metadata}';
$encoded = base64_encode($flag);

$png_base64 = 'iVBORw0KGgoAAAANSUhEUgAAAMgAAADICAIAAAAiOjnJAAABMElEQVR4nO3SwQnAIBDAMHX/nc8hfEghmaDQNXPMfY4Bgf9sA34dw2QQJiCTMAGZhAnIJEzAJmECMgkTkEmYgEzCBGQSJiCTMAGZhAnIJEzAJmECMgkTkEmYgEzCBGQSJiCTMAGZhAnIJEzAJmECMgkTkEmYgEzCBGQSJiCTMAGZhAnIJEzAJmECMgkTkEmYgEzCBGQSJiCTMAGZhAnIJEzAJmECMgkTkEmYgEzCBGQSJiCTMAGZhAnIJEzAJmECMgkTkEmYgEzCBGQSJiCTMAGZhAnIJEzAJmECMgkTkEmYgEzCBGQSJiCTMIGO9wQTF8f6qQAAAABJRU5ErkJggg==';
$png_data = base64_decode($png_base64);

@mkdir('/var/www/html/files', 0755, true);

// Write PNG with text chunk
$text_chunk = "\x00\x00\x00" . chr(strlen($encoded) + 5) . "tEXtAuthor\x00" . $encoded;
$crc = pack('N', crc32('tEXtAuthor' . "\x00" . $encoded));
$text_chunk .= $crc;

// Insert before IEND chunk
$pos = strrpos($png_data, 'IEND') - 4;
$modified_png = substr($png_data, 0, $pos) . $text_chunk . substr($png_data, $pos);

file_put_contents('/var/www/html/files/seal.png', $modified_png);

echo '[+] seal.png generated with Author metadata';
?>
