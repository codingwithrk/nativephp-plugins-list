---
name: "NativePHP Mobile Scanner"
author: "Bifrost Technology"
price: "$49"
version: "1.0.2"
license: "Proprietary"
source: "https://nativephp.com/plugins/nativephp/mobile-scanner"
support: "support@nativephp.com"
compatibility:
  nativephp: "^3.0"
  ios: "13.0+"
  android: "21+"
install:
  - "composer require nativephp/mobile-scanner"
events:
  - CodeScanned
---

# NativePHP Mobile Scanner

QR code and barcode scanner for NativePHP Mobile — supports multiple barcode formats with continuous scanning.

## Features

- Cross-platform barcode and QR code scanning via native camera
- Multiple format support: `qr`, `ean13`, `ean8`, `code128`, `code39`, `upca`, `upce`, `all`
- Continuous scanning mode
- Customizable prompt text
- Session identification for multiple scan contexts
- PHP/Livewire and JavaScript/Vue/React implementations

## Installation

> Requires Composer credentials for the NativePHP plugin repository.

```bash
composer config repositories.nativephp-plugins composer https://plugins.nativephp.com
composer config http-basic.plugins.nativephp.com your@email.com your-license-key
composer require nativephp/mobile-scanner
```

## Compatibility

| Platform   | Minimum Version              |
| ---------- | ---------------------------- |
| NativePHP  | ^3.0                         |
| iOS        | 13.0+                        |
| Android    | API 21+ (ML Kit), API 26+    |

## Events

- `CodeScanned` — fires when a barcode is successfully scanned; returns `data`, `format`, and optional `session` ID
