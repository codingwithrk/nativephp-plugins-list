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

QR code and barcode scanner for NativePHP Mobile — native camera-based scanning with multiple format support and continuous scanning mode.

## Features

- Cross-platform scanning via native camera (AVFoundation / ML Kit)
- Format support: `qr`, `ean13`, `ean8`, `code128`, `code39`, `upca`, `upce`, `all`
- Continuous scanning mode (multiple scans per session)
- Customizable prompt text shown in the scanner overlay
- Session IDs for managing multiple concurrent scan contexts
- PHP/Livewire and JavaScript/Vue/React support

## Installation

> Requires Composer credentials for the NativePHP plugin repository.

```bash
composer config repositories.nativephp-plugins composer https://plugins.nativephp.com
composer config http-basic.plugins.nativephp.com your@email.com your-license-key
php artisan vendor:publish --tag=nativephp-plugins-provider
composer require nativephp/mobile-scanner
php artisan native:plugin:register nativephp/mobile-scanner
```

## PHP Usage

```php
use NativePHP\MobileScanner\Facades\Scanner;

// Scan a QR code
Scanner::scan(
    formats: ['qr'],
    prompt: 'Scan a QR code to continue.',
    session: 'checkout',
    continuous: false,
);

// Multi-format continuous scan
Scanner::scan(
    formats: ['qr', 'ean13', 'code128'],
    prompt: 'Point at a barcode.',
    continuous: true,
);

// Stop continuous scanning
Scanner::stop();
```

## Livewire Usage

```php
use Native\Mobile\Attributes\OnNative;
use NativePHP\MobileScanner\Events\CodeScanned;

#[OnNative(CodeScanned::class)]
public function onCodeScanned(string $data, string $format, ?string $session): void
{
    if ($session === 'checkout') {
        $this->processBarcode($data);
    }
}
```

## Compatibility

| Platform   | Minimum Version              |
| ---------- | ---------------------------- |
| NativePHP  | ^3.0                         |
| iOS        | 13.0+                        |
| Android    | API 21+ (ML Kit), API 26+    |

## Events

### `CodeScanned`

Fires when a barcode is successfully decoded.

| Field | Type | Description |
|-------|------|-------------|
| `data` | `string` | The decoded barcode value |
| `format` | `string` | Format detected (e.g. `qr`, `ean13`) |
| `session` | `string\|null` | Session ID if provided |
