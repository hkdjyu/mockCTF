#!/usr/bin/env python3
import base64
import os
import struct

os.makedirs('/var/www/html/files', exist_ok=True)

flag = 'flag{bmp_lsb_steganography}'
encoded = base64.b64encode(flag.encode()).decode()

# Create a 240x180 BMP image with LSB steganography in blue channel
width, height = 240, 180
row_bytes = width * 3
padding = (4 - (row_bytes % 4)) % 4
pixel_data = bytearray((80, 120, 160) * (width * height))

# Embed the message in LSB of blue bytes
msg_bytes = encoded.encode()
bit_index = 0
capacity_bits = width * height
target_bits = len(msg_bytes) * 8

for i in range(min(capacity_bits, target_bits)):
    byte_index = i // 8
    bit_pos = i % 8
    bit_value = (msg_bytes[byte_index] >> (7 - bit_pos)) & 1
    pixel_offset = i * 3
    blue = pixel_data[pixel_offset]
    pixel_data[pixel_offset] = (blue & 0xFE) | bit_value

# Build BMP headers (24-bit)
pixel_array = bytearray()
for y in range(height - 1, -1, -1):
    start = y * row_bytes
    end = start + row_bytes
    pixel_array.extend(pixel_data[start:end])
    pixel_array.extend(b'\x00' * padding)

# Put a traceable metadata block before pixel data (inside file structure, not file tail)
metadata_block = b'CTF_NOTE:' + encoded.encode() + b'\x00'
pixel_offset = 54 + len(metadata_block)

file_size = pixel_offset + len(pixel_array)
file_header = b'BM' + struct.pack('<IHHI', file_size, 0, 0, pixel_offset)
dib_header = struct.pack('<IIIHHIIIIII', 40, width, height, 1, 24, 0, len(pixel_array), 2835, 2835, 0, 0)

with open('/var/www/html/files/campus.bmp', 'wb') as f:
    f.write(file_header)
    f.write(dib_header)
    f.write(metadata_block)
    f.write(pixel_array)

print(f'[+] campus.bmp generated with LSB encoding')
print(f'[+] Embedded marker before pixel data: CTF_NOTE:{encoded}')
