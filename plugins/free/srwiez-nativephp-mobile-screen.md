---
name: "NativePHP Mobile Screen"
author: "Eser Deniz"
price: "Free"
version: "1.0.1"
license: "MIT"
github: "https://github.com/SRWieZ/nativephp-mobile-screen"
compatibility:
  nativephp: "^3.0"
  ios: "13.0+"
  android: "21+"
install:
  - "composer require srwiez/nativephp-mobile-screen"
  - "php artisan vendor:publish --tag=nativephp-plugins-provider"
  - "php artisan native:plugin:register srwiez/nativephp-mobile-screen"
---

# NativePHP Mobile Screen

Screen wake lock and brightness control for NativePHP Mobile — designed for barcode tickets, live dashboards, kiosks, and scoring applications.

## Features

- Keep screen awake (wake-lock control)
- Control brightness (0.0–1.0 scale)
- Reset to system default brightness
- Works across iOS and Android
- Zero-configuration, dependency-free implementation

## Installation

```bash
composer require srwiez/nativephp-mobile-screen
php artisan vendor:publish --tag=nativephp-plugins-provider
php artisan native:plugin:register srwiez/nativephp-mobile-screen
```

## Compatibility

| Platform  | Minimum Version |
| --------- | --------------- |
| NativePHP | ^3.0            |
| iOS       | 13.0+           |
| Android   | API 21+         |
