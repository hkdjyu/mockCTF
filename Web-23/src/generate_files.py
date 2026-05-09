#!/usr/bin/env python3
import os

os.makedirs('/var/www/html/files', exist_ok=True)

pdf_content = """%PDF-1.4
1 0 obj
<< /Type /Catalog /Pages 2 0 R >>
endobj
2 0 obj
<< /Type /Pages /Kids [3 0 R] /Count 1 >>
endobj
3 0 obj
<< /Type /Page /Parent 2 0 R /Resources << /Font << /F1 4 0 R >> >> /MediaBox [0 0 612 792] /Contents 5 0 R >>
endobj
4 0 obj
<< /Type /Font /Subtype /Type1 /BaseFont /Helvetica >>
endobj
5 0 obj
<< /Length 60 >>
stream
BT
/F1 18 Tf
60 730 Td
(Annual Report 2026) Tj
ET
endstream
endobj
6 0 obj
<< /Author (ZmxhZ3twZGZfbWV0YWRhdGFfbGVha2VkfQ==) /Title (Annual Report) /Subject (Internal) /Creator (mockCTF) /Producer (mockCTF) >>
endobj
xref
0 7
0000000000 65535 f 
0000000009 00000 n 
0000000058 00000 n 
0000000115 00000 n 
0000000241 00000 n 
0000000314 00000 n 
0000000423 00000 n 
trailer
<< /Size 7 /Root 1 0 R /Info 6 0 R >>
startxref
558
%%EOF
"""

with open('/var/www/html/files/annual-report.pdf', 'w', encoding='latin1') as f:
    f.write(pdf_content)

print('[+] annual-report.pdf generated')
