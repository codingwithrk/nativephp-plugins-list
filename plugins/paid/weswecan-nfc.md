---
name: "NFC"
author: "Context Undefined"
price: "$99"
version: "1.0.1"
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

Read and write NFC tags on iOS and Android from NativePHP Mobile.

## Features

- Read and write NFC tags on both platforms
- Supported data types: URLs, plain text, vCard contacts, JSON/MIME data, Android Application Records
- Tag hardware information access (capacity, writable status, technologies)
- Continuous scanning with session persistence
- WiFi configuration writing
- Tag erasure capability
- Platform-aware session options
- Typed events with comprehensive error handling

## Installation

```bash
composer require weswecan/nfc
php artisan native:plugin:register weswecan/nfc
```

## Compatibility

| Platform   | Minimum Version |
| ---------- | --------------- |
| NativePHP  | ^3              |
| iOS        | 13.0+           |
| Android    | API 24+         |

## Events

- `NfcTagRead` — tag read with hardware info
- `NfcUrlWritten` — URL write completion
- `NfcTextWritten` — text write completion
- `NfcTagErased` — tag erasure confirmation
- `NfcError` — error occurrences
- `NfcCancelled` — session cancellation (iOS only)
