---
name: "NFC"
author: "Context Undefined"
price: "$99"
version: "1.0.3"
license: "Proprietary"
source: "https://nativephp.com/plugins/weswecan/nfc"
support: "support@weswecan.com"
compatibility:
  nativephp: "^3"
  ios: "13.0+"
  android: "24+"
install:
  - "composer require weswecan/nfc"
  - "php artisan native:plugin:register weswecan/nfc"
events:
  - NfcTagRead
  - NfcUrlWritten
  - NfcTextWritten
  - NfcTagErased
  - NfcError
  - NfcCancelled
---

# NFC

Read and write NFC tags on iOS and Android from NativePHP Mobile — URLs, text, vCards, JSON/MIME, Android Application Records, and WiFi configuration.

## Features

- Read and write NFC tags on both platforms
- Data types: URLs, plain text, vCard contacts, JSON/MIME, Android Application Records
- Tag hardware information: capacity, writable status, technologies
- Continuous scanning with session persistence
- WiFi configuration writing
- Tag erasure
- Typed events with comprehensive error handling

## Installation

> Requires a license from nativephp.com/plugins.

```bash
composer config repositories.nativephp-plugins composer https://plugins.nativephp.com
composer config http-basic.plugins.nativephp.com your@email.com your-license-key
composer require weswecan/nfc
php artisan native:plugin:register weswecan/nfc
```

## PHP Usage

```php
use Weswecan\Nfc\Facades\Nfc;

// Read a tag
Nfc::read(
    alertMessage: 'Hold your device near an NFC tag.',
    continuous: false,
);

// Write a URL
Nfc::writeUrl(
    url: 'https://example.com',
    alertMessage: 'Hold near tag to write.',
);

// Write text
Nfc::writeText(
    text: 'Hello NFC',
    language: 'en',
);

// Erase a tag
Nfc::erase();

// Stop scanning session
Nfc::stop();
```

## Livewire Usage

```php
use Native\Mobile\Attributes\OnNative;
use Weswecan\Nfc\Events\NfcTagRead;

#[OnNative(NfcTagRead::class)]
public function onTagRead(
    array $records,
    array $hardware,
): void {
    foreach ($records as $record) {
        // $record['type'], $record['payload']
    }
}
```

## Compatibility

| Platform   | Minimum Version |
| ---------- | --------------- |
| NativePHP  | ^3              |
| iOS        | 13.0+           |
| Android    | API 24+         |

## Events

- `NfcTagRead` — tag read with records and hardware info
- `NfcUrlWritten` — URL write confirmed
- `NfcTextWritten` — text write confirmed
- `NfcTagErased` — tag erasure confirmed
- `NfcError` — error during session
- `NfcCancelled` — session cancelled *(iOS only)*
