---
name: "Mobile OCR"
author: "Tendai Karuma"
price: "Free"
version: "1.0.0"
license: "MIT"
github: "https://github.com/protendai/nativephp-mobile-ocr"
support: "https://nativephp.com/plugins/protendai/nativephp-mobile-ocr"
compatibility:
  nativephp: "^4.0"
  ios: "13.0+"
  android: "21+"
install:
  - "composer require protendai/nativephp-mobile-ocr"
  - "php artisan vendor:publish --tag=nativephp-plugins-provider"
  - "php artisan native:plugin:register protendai/nativephp-mobile-ocr"
---

# Mobile OCR

On-device text recognition for NativePHP Mobile — Apple Vision on iOS, Google ML Kit on Android. No API key, no server, works offline.

> **Printed Latin-script text only.** Handwriting and non-Latin scripts are not supported in this version. One image per call.
>
> **`native:jump` is not sufficient** — rebuild with `php artisan native:run` after installing (native code must compile in).

## Features

- **Three methods:**
  - `Ocr::capture()` — opens the back camera and recognises text
  - `Ocr::scan()` — opens the platform document scanner
  - `Ocr::recognize($path)` — reads an existing image file
- **Positional output** — each recognised line includes its position on the page
- **Layout helpers** — `Layout::rows()` and `Layout::valueBeside()` rebuild rows and pair labels with values
- **Event-driven results** — `TextRecognized`, `RecognitionFailed`, `ScanCancelled`
- **JavaScript module** — ES module for Inertia + Vue/React
- **Testing** — adds OCR assertions to NativePHP's `FakeBridge`

## Installation

```bash
composer require protendai/nativephp-mobile-ocr
php artisan vendor:publish --tag=nativephp-plugins-provider
php artisan native:plugin:register protendai/nativephp-mobile-ocr
php artisan native:run
```
