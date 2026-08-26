---
name: "DatePicker"
author: "camiant"
price: "$29"
version: "1.0.0"
license: "Proprietary"
source: "https://nativephp.com/plugins/nativecodeforge/nativephp-datepicker"
support: "https://nativephp.com/plugins/nativecodeforge/nativephp-datepicker"
compatibility:
  nativephp: "^4.0"
  ios: "15.0+"
  android: "21+"
install:
  - "composer config repositories.nativephp-plugins composer https://plugins.nativephp.com"
  - "composer config http-basic.plugins.nativephp.com your@email.com your-license-key"
  - "php artisan vendor:publish --tag=nativephp-plugins-provider"
  - "composer require nativecodeforge/nativephp-datepicker"
  - "php artisan native:plugin:register nativecodeforge/nativephp-datepicker"
---

# DatePicker

A native calendar interface for NativePHP Mobile that renders consistently across iOS (SwiftUI) and Android (Jetpack Compose) — custom calendar grid with an integrated wheel picker, not the OS system picker.

## Features

- **Custom calendar grid** — independent of the OS system date dialog
- **Wheel picker** for rapid year/month navigation
- **Theming** via accent and text color options
- **ISO date format** — returns values as `YYYY-MM-DD`
- **Dark mode** compatible
- **Built-in accessibility** support

## Installation

```bash
composer config repositories.nativephp-plugins composer https://plugins.nativephp.com
composer config http-basic.plugins.nativephp.com your@email.com your-license-key
php artisan vendor:publish --tag=nativephp-plugins-provider
composer require nativecodeforge/nativephp-datepicker
php artisan native:plugin:register nativecodeforge/nativephp-datepicker
```
