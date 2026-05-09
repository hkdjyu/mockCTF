#!/usr/bin/env python3
from openpyxl import Workbook
from openpyxl.worksheet.worksheet import Worksheet
import base64, os

os.makedirs('/var/www/html/files', exist_ok=True)

flag = 'flag{excel_hidden_sheets}'
encoded = base64.b64encode(flag.encode()).decode()

wb = Workbook()
ws1 = wb.active
ws1.title = 'Public'
ws1['A1'] = 'ID'
ws1['B1'] = 'Name'
ws1['A2'] = '001'
ws1['B2'] = 'Alice'

ws2 = wb.create_sheet('Internal')
ws2['A1'] = 'Secret Data'
ws2['A2'] = encoded
ws2.sheet_state = 'hidden'

wb.save('/var/www/html/files/records.xlsx')
print('[+] records.xlsx generated with hidden sheet')
