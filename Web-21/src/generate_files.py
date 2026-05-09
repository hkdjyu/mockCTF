#!/usr/bin/env python3
import base64, os

os.makedirs('/var/www/html/files', exist_ok=True)

flag = 'flag{text_encoding_chain}'
hex_part = flag[0:17].encode().hex()
b64_part = base64.b64encode(flag[17:].encode()).decode()

with open('/var/www/html/files/notes.txt', 'w', encoding='utf-8') as f:
    f.write('=== 英文科筆記 ===\n')
    f.write('Week 1: Introduction to literature\n')
    f.write('Week 2: Poetry analysis\n')
    f.write('Week 3: Narrative techniques\n')
    f.write('\n=== 內部備註 ===\n')
    f.write(f'Flag Part 1 (Hex): {hex_part}\n')
    f.write(f'Flag Part 2 (Base64): {b64_part}\n')
    f.write('End of file\n')

print('[+] notes.txt generated')
