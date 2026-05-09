#!/usr/bin/env python3
import csv, base64, os

os.makedirs('/var/www/html/files', exist_ok=True)

flag = 'flag{csv_hidden_columns}'
encoded = base64.b64encode(flag.encode()).decode()

with open('/var/www/html/files/students.csv', 'w', newline='', encoding='utf-8') as f:
    writer = csv.writer(f)
    writer.writerow(['Name', 'ID', 'Score', 'Grade', 'Internal'])
    writer.writerow(['Alice Chen', '001', '92', 'A', encoded])
    writer.writerow(['Bob Wong', '002', '85', 'B', 'dGVzdA=='])
    writer.writerow(['Carol Liu', '003', '78', 'C', 'ZmFrZQ=='])

print('[+] students.csv generated')
