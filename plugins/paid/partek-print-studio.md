---
name: "Print Studio"
author: "Paul (PARTek)"
price: "$99"
version: "1.1.0"
license: "Proprietary"
source: "https://nativephp.com/plugins/partek/print-studio"
support: "https://nativephp.com/plugins/partek/print-studio"
compatibility:
  nativephp: "^4.0"
  ios: "18.0+"
  android: "26+"
install:
  - "composer config repositories.nativephp-plugins composer https://plugins.nativephp.com"
  - "composer config http-basic.plugins.nativephp.com your@email.com your-license-key"
  - "php artisan vendor:publish --tag=nativephp-plugins-provider"
  - "composer require partek/print-studio"
  - "php artisan native:plugin:register partek/print-studio"
---

# Print Studio

Native document printing and PDF generation for NativePHP Mobile — `UIPrintInteractionController` on iOS, `PrintManager` on Android. Drive the OS print sheet or render directly to a PDF file, all from PHP.

> Not a thermal/ESC-POS receipt SDK. Not a cloud print service. Receipt paper sizes are layout presets only.

## Features

- **Print HTML, Blade views, plain text, existing PDF/HTML files, and images** via the `PrintStudio` facade
- **`->print()`** — presents the native OS print dialog asynchronously
- **`->toPdf()`** — renders content to a PDF on disk (no print dialog)
- **Paper sizes** — Letter, Legal, A4, A5, ShippingLabel 4×6, Receipt 58mm/80mm, Custom
- **Portrait/Landscape**, margins, copies (Android), DPI for PDF output
- **Security** — `PathGuard` path traversal protection, `storage_root` confinement, overwrite protection by default
- **Testing fake** — `PrintStudio::fake()` with `assertPrinted()`, `assertPdfGenerated()`, `assertCancelled()`, `->failing()` simulation
- **JS API** — `printHtml`, `printPdfFile`, `printImageFile`, `generatePdf`, `cancel` for Inertia/SPA apps
- **Events** — `PrintJobCreated`, `PrintJobPresented`, `PrintJobCompleted`, `PrintJobCancelled`, `PrintJobFailed`, `PdfGenerated`, `PdfGenerationFailed`

## Facade API

```php
PrintStudio::html($html)->paper(PaperSize::A4)->orientation(Orientation::Portrait)->print();
PrintStudio::view('invoice', $data)->paper(PaperSize::Letter)->toPdf('invoice.pdf');
PrintStudio::text($plainText)->print();
PrintStudio::pdf($existingPdfPath)->print();
PrintStudio::image($imagePath, ImageFit::Contain)->toPdf('photo.pdf');
PrintStudio::cancel($jobId);
```

## Installation

```bash
composer config repositories.nativephp-plugins composer https://plugins.nativephp.com
composer config http-basic.plugins.nativephp.com your@email.com your-license-key
php artisan vendor:publish --tag=nativephp-plugins-provider
composer require partek/print-studio
php artisan native:plugin:register partek/print-studio
php artisan native:run
```
