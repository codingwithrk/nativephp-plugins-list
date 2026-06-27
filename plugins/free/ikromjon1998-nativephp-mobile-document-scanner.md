---
name: "Mobile Document Scanner"
author: "Ikromjon Ochilov"
price: "Free"
version: "latest"
license: "MIT"
github: "https://github.com/Ikromjon1998/nativephp-mobile-document-scanner"
compatibility:
  nativephp: "^3.0"
  php: "^8.3"
  ios: "any"
  android: "any"
install:
  - "composer require ikromjon/nativephp-mobile-document-scanner"
  - "php artisan native:plugin:register ikromjon/nativephp-mobile-document-scanner"
events:
  - DocumentScanned
---

# Mobile Document Scanner

Scan documents with automatic edge detection, perspective correction, and cropping in your NativePHP Mobile app — powered by native platform APIs. No external API keys or internet required.

## Platform APIs

| Platform | Native API | Features |
| -------- | ---------- | -------- |
| iOS | VisionKit (`VNDocumentCameraViewController`) | Auto edge detection, perspective correction, shadow removal, multi-page |
| Android | Google ML Kit Document Scanner | Auto edge detection, cropping, rotation, multi-page, gallery import |

## Installation

```bash
composer require ikromjon/nativephp-mobile-document-scanner
php artisan native:plugin:register ikromjon/nativephp-mobile-document-scanner
php artisan native:run android  # or ios
```

## Usage

```php
use Ikromjon\DocumentScanner\Facades\DocumentScanner;
use Ikromjon\DocumentScanner\Events\DocumentScanned;
use Native\Mobile\Attributes\OnNative;

// Open the scanner
DocumentScanner::scan();

// Handle the result in a Livewire component
#[OnNative(DocumentScanned::class)]
public function onScanned($data)
{
    $paths     = $data['paths'];     // ['/path/scan_0.jpg', ...]
    $pageCount = $data['pageCount']; // 2
}
```

## Events

- `DocumentScanned` — fired after scanning completes; includes `paths` (array of absolute file paths) and `pageCount`
