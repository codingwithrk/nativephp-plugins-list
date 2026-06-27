---
name: "Mobile Haptics"
author: "GrayMatter Technology"
price: "Free"
version: "latest"
license: "MIT"
github: "https://github.com/graymattertechnology/nativephp-mobile-haptics"
compatibility:
  nativephp: "^3.0"
  php: "^8.2"
  laravel: "11 | 12"
  ios: "any"
  android: "any"
install:
  - "composer require graymatter/nativephp-mobile-haptics"
---

# Mobile Haptics

Haptic feedback plugin for NativePHP Mobile — impact, notification, selection, raw vibrate, and custom patterns. Uses native iOS `UIFeedbackGenerator` and Android `VibrationEffect`.

## Features

- 5 haptic types: impact, notification, selection, raw vibrate, custom pattern
- PHP and JavaScript APIs
- Graceful degradation on simulators or missing hardware (returns `false`)
- Zero config — install and use, no publish or migrations needed

## Installation

```bash
composer require graymatter/nativephp-mobile-haptics
```

## Usage (PHP)

```php
use GrayMatter\NativePHP\Mobile\Haptics\Facades\Haptics;

Haptics::impact('light');          // light, medium, heavy, rigid, soft
Haptics::notification('success');  // success, warning, error
Haptics::selection();
Haptics::vibrate(300);             // milliseconds
Haptics::pattern([100, 50, 200, 50, 100]);
```

## Usage (JavaScript)

```js
import { haptics } from '@graymatter/nativephp-mobile-haptics';

await haptics.impact('heavy');
await haptics.notification('error');
await haptics.selection();
await haptics.vibrate(200);
await haptics.pattern([100, 50, 200]);
```

All methods return `bool` — `true` on success, `false` on failure or missing hardware.
