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

A haptic vibration plugin for NativePHP Mobile with iOS Core Haptics and Android VibrationEffect support.

## Features

- Fine-grained control over duration, intensity, and sharpness
- Runtime haptic support detection
- Vibration cancellation capability
- Event dispatching on completion
- iOS Core Haptics and Android VibrationEffect support

## Installation

```bash
composer require jvdluk/pro-vibration
php artisan native:plugin:register jvdluk/pro-vibration
```

## Compatibility

| Platform  | Minimum Version |
| --------- | --------------- |
| NativePHP | ^3.0            |
| iOS       | 13.0+           |
| Android   | 24+             |

## Events

- `VibrationCompleted` — fired when a single vibration finishes
- `PatternCompleted` — fired when a vibration pattern sequence finishes
