---
name: "Mobile Haptics (Laravel 13 Fork)"
author: "Blessed Zulu"
price: "Free"
version: "latest"
license: "MIT"
github: "https://github.com/blessedzulu/nativephp-mobile-haptics"
compatibility:
  nativephp: "^3.0"
  php: "^8.2"
  laravel: "11 | 12 | 13"
  ios: "any"
  android: "any"
install:
  - "composer require blessedzulu/nativephp-mobile-haptics"
---

# Mobile Haptics (Laravel 13 Fork)

Fork of [graymatter/nativephp-mobile-haptics](https://github.com/graymattertechnology/nativephp-mobile-haptics), modernised for Laravel 13 with a widened `illuminate/support` constraint and a fix for the `{ method, params }` body shape that NativePHP core's `/_native/api/call` endpoint expects.

## Features

- 5 haptic types: impact, notification, selection, raw vibrate, custom pattern
- Laravel 11, 12, and 13 support
- PHP and JavaScript APIs
- Graceful degradation on simulators or missing hardware (returns `false`)
- Zero config — install and use

## Installation

```bash
composer require blessedzulu/nativephp-mobile-haptics
```

## Usage (PHP)

```php
use BlessedZulu\NativePHP\Mobile\Haptics\Facades\Haptics;

Haptics::impact('light');          // light, medium, heavy, rigid, soft
Haptics::notification('success');  // success, warning, error
Haptics::selection();
Haptics::vibrate(300);
Haptics::pattern([100, 50, 200, 50, 100]);
```

## Usage (JavaScript)

```js
import { haptics } from '@blessedzulu/nativephp-mobile-haptics';

await haptics.impact('heavy');
await haptics.notification('error');
await haptics.selection();
await haptics.vibrate(200);
await haptics.pattern([100, 50, 200]);
```
