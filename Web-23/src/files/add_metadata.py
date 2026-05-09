from pypdf import PdfReader, PdfWriter

# Path to the original PDF
original_pdf = '2526校訊(2025年12月-2026年2月).pdf'
output_pdf = 'file.pdf'

# Read the PDF
reader = PdfReader(original_pdf)
writer = PdfWriter()

# Copy all pages
for page in reader.pages:
    writer.add_page(page)

# Add metadata with the flag
writer.add_metadata({
    '/Title': 'School Newsletter 2526',
    '/Author': 'School Administration',
    '/Subject': 'flag{pdf_metadata_leaked}',
    '/Keywords': 'newsletter,school,2526',
})

# Write to the new PDF
with open(output_pdf, 'wb') as f:
    writer.write(f)

print(f"PDF created: {output_pdf}")
print(f"Flag added to Subject metadata")
