#!/usr/bin/env python3
import base64
import os
import struct

os.makedirs('/var/www/html/files', exist_ok=True)

flag = 'flag{wav_riff_chunks}'
encoded = base64.b64encode(flag.encode()).decode()

sample_rate = 44100
duration = 2
num_channels = 1
bits_per_sample = 16
block_align = num_channels * (bits_per_sample // 8)
byte_rate = sample_rate * block_align
num_samples = sample_rate * duration
pcm_data = b'\x00\x00' * num_samples

# fmt chunk
fmt_data = struct.pack('<HHIIHH', 1, num_channels, sample_rate, byte_rate, block_align, bits_per_sample)
fmt_chunk = b'fmt ' + struct.pack('<I', len(fmt_data)) + fmt_data

# LIST/INFO/ICMT chunk with Base64 flag
icmt_text = encoded.encode('ascii') + b'\x00'
if len(icmt_text) % 2 == 1:
    icmt_text += b'\x00'
icmt_chunk = b'ICMT' + struct.pack('<I', len(icmt_text)) + icmt_text

list_data = b'INFO' + icmt_chunk
if len(list_data) % 2 == 1:
    list_data += b'\x00'
list_chunk = b'LIST' + struct.pack('<I', len(list_data)) + list_data

# data chunk
data_chunk = b'data' + struct.pack('<I', len(pcm_data)) + pcm_data

# RIFF container
riff_size = 4 + len(fmt_chunk) + len(list_chunk) + len(data_chunk)
wav_bytes = b'RIFF' + struct.pack('<I', riff_size) + b'WAVE' + fmt_chunk + list_chunk + data_chunk

with open('/var/www/html/files/announcement.wav', 'wb') as f:
    f.write(wav_bytes)

print('[+] announcement.wav generated')
print(f'[+] Embedded LIST/INFO/ICMT: {encoded}')
