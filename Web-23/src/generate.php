<?php
// Generate a simple PDF with metadata
// Since reportlab is complex, we'll use a simpler approach with fpdf or manual PDF structure
$flag = 'flag{pdf_metadata_leaked}';
$encoded = base64_encode($flag);

// Manual PDF generation with metadata
$pdf = "%PDF-1.4\n";
$pdf .= "1 0 obj\n<< /Type /Catalog /Pages 2 0 R >>\nendobj\n";
$pdf .= "2 0 obj\n<< /Type /Pages /Kids [3 0 R] /Count 1 >>\nendobj\n";
$pdf .= "3 0 obj\n<< /Type /Page /Parent 2 0 R /Resources << /Font << /F1 4 0 R >> >> /MediaBox [0 0 612 792] /Contents 5 0 R >>\nendobj\n";
$pdf .= "4 0 obj\n<< /Type /Font /Subtype /Type1 /BaseFont /Helvetica >>\nendobj\n";
$pdf .= "5 0 obj\n<< /Length 44 >>\nstream\nBT\n/F1 12 Tf\n50 700 Td\n(Annual Report) Tj\nET\nendstream\nendobj\n";
$pdf .= "6 0 obj\n<< /Type /Info /Author ($encoded) /Title (Annual Report) /Subject (Internal) /Creator (Mock CTF) /Producer (PHP) >>\nendobj\n";
$pdf .= "xref\n0 7\n0000000000 65535 f\n0000000009 00000 n\n0000000058 00000 n\n0000000115 00000 n\n0000000244 00000 n\n0000000317 00000 n\n0000000410 00000 n\n";
$pdf .= "trailer\n<< /Size 7 /Root 1 0 R /Info 6 0 R >>\nstartxref\n549\n%%EOF\n";

@mkdir('/var/www/html/files', 0755, true);
file_put_contents('/var/www/html/files/annual-report.pdf', $pdf);
echo '[+] annual-report.pdf generated';
?>
