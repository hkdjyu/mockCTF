#!/usr/bin/env python3
from PIL import Image
from PIL.PngImagePlugin import PngInfo
import base64, os

os.makedirs('/var/www/html/files', exist_ok=True)

flag = 'flag{png_exif_metadata}'
encoded = base64.b64encode(flag.encode()).decode()

img = Image.new('RGB', (260, 180), color=(205, 235, 205))
meta = PngInfo()
meta.add_text('Author', encoded)
meta.add_text('Subject', 'Internal')
meta.add_text('Comment', 'Check metadata fields carefully')

img.save('/var/www/html/files/background.png', pnginfo=meta)

print('[+] background.png generated with PNG text metadata')
