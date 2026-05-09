#!/usr/bin/env python3
import base64
import binascii
import os

os.makedirs('/var/www/html/files', exist_ok=True)

flag = 'flag{multi_format_maze_challenge}'

# Split flag into 4 parts
part1 = 'flag{'
part2 = 'multi_format'
part3 = '_maze'
part4 = '_challenge}'

# Part 1: TXT with Hex encoding
hex_encoded = part1.encode().hex()
with open('/var/www/html/files/part1.txt', 'w') as f:
    f.write(f'Part 1 Data: {hex_encoded}\n')
    f.write('(Hex encoded)\n')

# Part 2: CSV with Base64 encoding
b64_encoded = base64.b64encode(part2.encode()).decode()
with open('/var/www/html/files/part2.csv', 'w') as f:
    f.write('ID,Data,Encoding\n')
    f.write(f'2,{b64_encoded},base64\n')

# Part 3: PNG with embedded tEXt metadata
png_blob = base64.b64decode(
    'iVBORw0KGgoAAAANSUhEUgAAAGQAAABkCAIAAAD/gAIDAAAAn0lEQVR4nO3QQQkAIADAQDW50a3gXiLcJRibYw8urdcBPzErMCswKzArMCswKzArMCswKzArMCswKzArMCswKzArMCswKzArMCswKzArMCswKzArMCswKzArMCswKzArMCswKzArMCswKzArMCswKzArMCswKzArMCswKzArMCswKzArMCswKzArMCswKzArMCswKzArMCswKzArMCswKzArMCswKzArMCswKzArMCswK7ArB7E4A7U9JQkWAAAAAElFTkSuQmCC'
)

part3_b64 = base64.b64encode(part3.encode()).decode()
tkey = b'Comment'
tval = part3_b64.encode('ascii')
tdata = tkey + b'\x00' + tval
tchunk = (
    len(tdata).to_bytes(4, 'big')
    + b'tEXt'
    + tdata
    + (binascii.crc32(b'tEXt' + tdata) & 0xFFFFFFFF).to_bytes(4, 'big')
)

# Insert metadata chunk before IEND
iend_pos = png_blob.rfind(b'IEND')
chunk_start = iend_pos - 4
png_with_meta = png_blob[:chunk_start] + tchunk + png_blob[chunk_start:]

with open('/var/www/html/files/part3.png', 'wb') as f:
    f.write(png_with_meta)

# Part 4: MP3 stub with metadata file
os.system('ffmpeg -f lavfi -i anullsrc=r=44100:cl=mono -t 1 -q:a 9 -acodec libmp3lame /var/www/html/files/part4.mp3 2>/dev/null')

part4_b64 = base64.b64encode(part4.encode()).decode()
os.system(
    f"ffmpeg -y -i /var/www/html/files/part4.mp3 -metadata comment='{part4_b64}' "
    "-codec copy /var/www/html/files/part4_tagged.mp3 2>/dev/null"
)
os.replace('/var/www/html/files/part4_tagged.mp3', '/var/www/html/files/part4.mp3')

print('[+] Web-30 multi-format challenge files generated')
print(f'[+] Final flag: {flag}')
