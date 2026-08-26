---
name: "TimePicker"
author: "camiant"
price: "$29"
version: "1.0.0"
license: "Proprietary"
source: "https://nativephp.com/plugins/nativecodeforge/nativephp-timepicker"
support: "https://nativephp.com/plugins/nativecodeforge/nativephp-timepicker"
compatibility:
  nativephp: "^4.0"
  ios: "15.0+"
  android: "21+"
install:
  - "composer config repositories.nativephp-plugins composer https://plugins.nativephp.com"
  - "composer config http-basic.plugins.nativephp.com your@email.com your-license-key"
  - "php artisan vendor:publish --tag=nativephp-plugins-provider"
  - "composer require nativecodeforge/nativephp-timepicker"
  - "php artisan native:plugin:register nativecodeforge/nativephp-timepicker"
---

# TimePicker

A native scrolling-wheel time picker for NativePHP Mobile — Jetpack Compose on Android and SwiftUI on iOS — with consistent appearance and behavior across both platforms.

## Features

- **Custom scrolling-wheel dialog** — not the OS system time picker
- **12h (AM/PM) and 24h modes** — configurable display format
- **Accent color theming**
- **24h wire format** — values returned as zero-padded `HH:mm` string
- **Dark mode** compatible
- **Built-in accessibility** labels and hints

## Installation

```bash
composer config repositories.nativephp-plugins composer https://plugins.nativephp.com
composer config http-basic.plugins.nativephp.com your@email.com your-license-key
php artisan vendor:publish --tag=nativephp-plugins-provider
composer require nativecodeforge/nativephp-timepicker
php artisan native:plugin:register nativecodeforge/nativephp-timepicker
```
