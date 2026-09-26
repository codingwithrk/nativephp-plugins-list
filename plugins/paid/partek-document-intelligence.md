---
name: "Document Intelligence"
author: "Paul (PARTek)"
price: "$99"
version: "1.0.1"
license: "Proprietary"
source: "https://nativephp.com/plugins/partek/document-intelligence"
support: "https://nativephp.com/plugins/partek/document-intelligence"
compatibility:
  nativephp: "^4.0"
  ios: "18.0+"
  android: "26+"
install:
  - "composer config repositories.nativephp-plugins composer https://plugins.nativephp.com"
  - "composer config http-basic.plugins.nativephp.com your@email.com your-license-key"
  - "php artisan vendor:publish --tag=nativephp-plugins-provider"
  - "composer require partek/document-intelligence"
  - "php artisan native:plugin:register partek/document-intelligence"
---

# Document Intelligence

Native multi-page document scanning and on-device OCR for NativePHP Mobile — VisionKit + Apple Vision on iOS, ML Kit Document Scanner + Text Recognition on Android. No cloud upload, no third-party API key.

## Features

- **Native scanner UI** — automatic edge detection, perspective correction, and cropping
- **On-device OCR** — Apple Vision (iOS) / ML Kit Text Recognition (Android); no network calls
- **Multi-page support** — scan up to 100 pages per session (configurable)
- **Optional PDF generation** from captured pages (`->outputPdf()`)
- **Recognize existing images** — `DocumentIntelligence::recognize($path)` for OCR on any stored image
- **Structured OCR output** — `OcrResult` → `OcrPage` → `OcrBlock` → `OcrLine` → `OcrElement`, each with normalized bounding boxes (0.0–1.0) and nullable confidence scores
- **Security** — `PathGuard` path traversal protection, `storage_root` confinement, `max_image_dimension` cap (default 8000px)
- **Testing fake** — `DocumentIntelligence::fake()` for unit tests without a device
- **JS API** — `scan`, `result`, `cancel`, `recognize` for Inertia/SPA apps
- **Events** — `ScanStarted`, `ScanProgress`, `ScanCompleted`, `ScanCancelled`, `ScanFailed`

## Facade API

```php
// Start a scan
$scanId = DocumentIntelligence::scan(
    ScanOptions::make(maxPages: 10)
        ->outputPdf()
        ->recognizeText()
        ->imageFormat(ImageFormat::Jpeg)
        ->quality(0.85)
);

// Retrieve result after ScanCompleted fires
$result = DocumentIntelligence::result($scanId);
// $result->pages — ScannedPage[], $result->pdfPath

// OCR on an existing image
$ocr = DocumentIntelligence::recognize(storage_path('scans/page.jpg'));
// $ocr->fullText(), $ocr->pages[0]->blocks

// Cancel an in-flight scan
DocumentIntelligence::cancel($scanId);

// Clean up temp files older than 1 day
DocumentIntelligence::purgeTemporaryFiles();
```

## Installation

```bash
composer config repositories.nativephp-plugins composer https://plugins.nativephp.com
composer config http-basic.plugins.nativephp.com your@email.com your-license-key
php artisan vendor:publish --tag=nativephp-plugins-provider
composer require partek/document-intelligence
php artisan native:plugin:register partek/document-intelligence
php artisan native:run
```
