#!/usr/bin/env python3
import os, base64
from mutagen.mp3 import MP3
from mutagen.id3 import ID3, COMM

os.makedirs('/var/www/html/files', exist_ok=True)

flag = 'flag{mp3_id3_tags}'
encoded = base64.b64encode(flag.encode()).decode()

# Create a minimal MP3 file with ID3 tags
# First, generate a simple silent audio file using ffmpeg
os.system('ffmpeg -f lavfi -i anullsrc=r=44100:cl=mono -t 2 -q:a 9 -acodec libmp3lame /var/www/html/files/anthem.mp3 2>/dev/null')

# Add ID3 tags
try:
    audio = MP3('/var/www/html/files/anthem.mp3')
    audio['COMM'] = COMM(encoding=3, lang='eng', desc='', text=[encoded])
    audio.save()
    print(f'[+] anthem.mp3 generated with ID3 Comments')
    print(f'[+] Encoded flag: {encoded}')
except Exception as e:
    print(f'[-] Error: {e}')
