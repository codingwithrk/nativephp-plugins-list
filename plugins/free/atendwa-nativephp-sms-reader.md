---
name: "SMS Reader"
author: "Anthony Tendwa"
price: "Free"
version: "latest"
license: "MIT"
github: "https://github.com/atendwa/nativephp-sms-reader"
compatibility:
  nativephp: "^3.0"
  php: "^8.2"
  laravel: "11 | 12"
  android: "26+"
install:
  - "composer require atendwa/nativephp-sms-reader"
  - "php artisan native:plugin:register atendwa/nativephp-sms-reader"
events:
  - SmsReceived
---

# SMS Reader

Read SMS messages from the Android device inbox and listen for incoming SMS in real time from a NativePHP Mobile app.

> **Platform:** Android only. Returns empty results on web, Artisan, or iOS without throwing.

## Features

- Query the device inbox with optional sender, limit, and date filters
- Batch inbox queries across multiple senders
- Real-time `SmsReceived` event for new incoming messages
- Works safely in all environments — returns empty results outside the NativePHP Android runtime

## Compatibility

| Requirement | Minimum |
| ----------- | ------- |
| Android | API 26 (Android 8.0) |
| READ_SMS permission | Required |

## Installation

```bash
composer require atendwa/nativephp-sms-reader
php artisan native:plugin:register atendwa/nativephp-sms-reader
```

Rebuild after registration:

```bash
php artisan native:run android
```

## Usage

```php
use Atendwa\SmsReader\Facades\SmsReader;

// Read all messages
$messages = SmsReader::getMessages();

// With filters
$messages = SmsReader::getMessages(sender: '+1234567890', limit: 20);

// Batch query multiple senders
$messages = SmsReader::getMessagesForSenders(['+111', '+222']);
```

## Events

- `SmsReceived` — fired when a new SMS arrives; includes `sender`, `body`, and `timestamp`
