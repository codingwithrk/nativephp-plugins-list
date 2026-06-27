---
name: "NativePHP Mobile Device"
author: "Bifrost Technology"
price: "Free"
version: "1.0.2"
license: "MIT"
github: "https://github.com/NativePHP/mobile-device"
support: "https://nativephp.com/support"
compatibility:
  nativephp: "^3.0"
  ios: "18.2+"
  android: "26+"
install:
  - "composer require nativephp/mobile-device"
---

# NativePHP Mobile Device

Device hardware operations for NativePHP Mobile — vibration, flashlight, device info, and battery status.

## Features

- Device vibration control
- Flashlight toggle with state reporting
- Unique device identification
- Comprehensive device information retrieval
- Battery level and charging status monitoring
- Cross-platform support (iOS/Android)

## Installation

```bash
composer require nativephp/mobile-device
```

## Compatibility

| Platform  | Minimum Version |
| --------- | --------------- |
| NativePHP | ^3.0            |
| iOS       | 18.2+           |
| Android   | API 26+         |

## API

```php
Device::vibrate();
Device::toggleFlashlight();
Device::getId();
Device::getInfo();
Device::getBatteryInfo();
```
