---
name: "Mobile Haptics (Laravel 13 Fork)"
author: "Blessed Zulu"
price: "Free"
version: "1.1.4"
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

# NativePHP Mobile Haptics

Haptic feedback plugin for [NativePHP Mobile](https://nativephp.com) - impact, notification, selection, vibrate & pattern.

## Features

- **5 haptic types**: impact, notification, selection, raw vibrate, and custom patterns
- **Cross-platform**: native iOS (`UIFeedbackGenerator`) and Android (`VibrationEffect`) implementations
- **PHP + JavaScript**: use from Livewire/Blade or Vue/React/Inertia
- **Graceful degradation**: returns `false` on simulators or missing hardware
- **Zero config**: install and use - no publish, no migrations

## Requirements

- PHP 8.2+
- Laravel 11, 12 or 13
- NativePHP Mobile 3.0+

## Installation

```bash
composer require blessedzulu/nativephp-mobile-haptics
```

The service provider and facade are auto-discovered.

## Usage (PHP)

```php
use BlessedZulu\NativePHP\Mobile\Haptics\Facades\Haptics;

// Impact feedback - for button taps, collisions, UI emphasis
Haptics::impact('light');    // light, medium (default), heavy, rigid, soft

// Notification feedback - for async operation results
Haptics::notification('success');  // success (default), warning, error

// Selection feedback - for pickers, sliders, toggles
Haptics::selection();

// Raw vibration (ms) - native on Android, approximated on iOS
Haptics::vibrate(300);

// Vibration pattern [vibrate, pause, vibrate, pause, ...]
Haptics::pattern([100, 50, 200, 50, 100]);
```

All methods return `bool` - `true` on success, `false` on failure or missing hardware.

## Usage (JavaScript)

```js
import { haptics } from '@blessedzulu/nativephp-mobile-haptics';

await haptics.impact('heavy');
await haptics.notification('error');
await haptics.selection();
await haptics.vibrate(200);
await haptics.pattern([100, 50, 200]);
```

Or import individual functions:

```js
import { impact, notification, selection } from '@blessedzulu/nativephp-mobile-haptics';

await impact('medium');
```

## API Reference

| Method | Parameters | Default | Description |
|--------|-----------|---------|-------------|
| `impact($style)` | `light`, `medium`, `heavy`, `rigid`, `soft` | `medium` | Impact haptic feedback |
| `notification($type)` | `success`, `warning`, `error` | `success` | Notification haptic feedback |
| `selection()` | - | - | Selection tick feedback |
| `vibrate($ms)` | `1` - `5000` | `200` | Raw vibration in milliseconds |
| `pattern($array)` | `[vibrate, pause, ...]` | - | Custom vibration pattern |

## Platform Differences

| Feature | iOS | Android |
|---------|-----|---------|
| Impact | Native (`UIImpactFeedbackGenerator`) | Native (`VibrationEffect.createOneShot`) |
| Notification | Native (`UINotificationFeedbackGenerator`) | Native (predefined effects API 29+, waveform fallback) |
| Selection | Native (`UISelectionFeedbackGenerator`) | Native (`EFFECT_TICK` API 29+, short vibration fallback) |
| Vibrate | Approximated via repeated impacts | Native (`createOneShot`) |
| Pattern | Approximated via timed impacts | Native (`createWaveform`) |
| Permission | None required | `VIBRATE` (auto-granted) |
| Min version | iOS 13.0 | API 26 (Android 8.0) |

## Disabling Haptics

Use standard conditional logic:

```php
if ($user->prefersHaptics()) {
    Haptics::impact('medium');
}
```

## Testing

```bash
composer test
```
