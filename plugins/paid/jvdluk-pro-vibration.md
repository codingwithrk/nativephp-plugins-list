---
name: "ProVibration"
author: "JVDLUK"
price: "$49"
version: "1.0.1"
license: "Proprietary"
source: "https://nativephp.com/plugins/jvdluk/pro-vibration"
support: "support@jvdluk.com"
compatibility:
  nativephp: "^3.0"
  ios: "13.0+"
  android: "24+"
install:
  - "composer require jvdluk/pro-vibration"
  - "php artisan native:plugin:register jvdluk/pro-vibration"
events:
  - VibrationCompleted
  - PatternCompleted
---

# ProVibration

A haptic vibration library for NativePHP Mobile with iOS Core Haptics and Android VibrationEffect support.

## Features

- Fine-grained control over vibration duration, intensity, and sharpness
- Runtime haptic capability detection
- Vibration cancellation
- Fluent pattern builder with pause support
- Built-in presets: `success`, `error`, `warning`, `notification`, `double_click`
- Event dispatching on completion

## Installation

```bash
composer require jvdluk/pro-vibration
php artisan vendor:publish --tag=nativephp-plugins-provider
php artisan native:plugin:register jvdluk/pro-vibration
```

## PHP Usage

```php
use Jvdluk\ProVibration\Facades\ProVibration;

// Check support
if (ProVibration::hasHaptics()) {
    ProVibration::vibrate(duration: 500, intensity: 0.8);
}

// Pattern builder
ProVibration::pattern()
    ->vibrate(100, 0.8, 0.5)
    ->pause(50)
    ->vibrate(200, 1.0)
    ->play();

// Preset
ProVibration::preset('success')->play();

// Cancel
ProVibration::cancelVibration();
```

## JavaScript Usage

```javascript
import { proVibration } from '@jvdluk/pro-vibration';

if (await proVibration.hasHaptics()) {
    await proVibration.vibrate(500, 0.8, 0.5);

    await proVibration.playPattern([
        { type: 'vibrate', duration: 50, intensity: 0.6, sharpness: 0.5 },
        { type: 'pause', duration: 80 },
        { type: 'vibrate', duration: 80, intensity: 0.8 },
    ]);
}
```

## API

| Method | Description |
|--------|-------------|
| `vibrate(int $duration, float $intensity, ?float $sharpness)` | Single vibration; duration 1–5000 ms, intensity 0.0–1.0, sharpness iOS only |
| `hasHaptics(): bool` | Detect device support |
| `cancelVibration(): bool` | Stop active vibration |
| `pattern(array $steps): VibrationPatternBuilder` | Build a step sequence |
| `preset(string\|VibrationPreset $preset)` | Use a named preset |

## Compatibility

| Platform  | Minimum Version |
| --------- | --------------- |
| NativePHP | ^3.0            |
| iOS       | 13.0+           |
| Android   | 24+             |

> Sharpness parameter is iOS only; Android ignores it.

## Events

### `VibrationCompleted`

Fired when a single vibration finishes. Payload: `int $duration`, `float $intensity`, `?float $sharpness`.

### `PatternCompleted`

Fired when a pattern finishes. Payload: `int $totalDuration` (ms), `int $stepCount`.
