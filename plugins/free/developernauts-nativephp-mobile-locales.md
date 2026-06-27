---
name: "NativePHP Mobile Locales"
author: "Developernauts"
price: "Free"
version: "1.0.0"
license: "MIT"
github: "https://github.com/developernauts/nativephp-mobile-locales"
compatibility:
  nativephp: "v3"
  ios: "14.0+"
  android: "24+"
  php: "8.3+"
  laravel: "12+"
install:
  - "composer require developernauts/nativephp-mobile-locales"
  - "php artisan native:plugin:register developernauts/nativephp-mobile-locales"
  - "php artisan vendor:publish --tag=nativephp-mobile-locales-config"
---

# NativePHP Mobile Locales

A NativePHP plugin for managing supported locales and syncing language preferences between mobile apps and Laravel.

## Features

- Single configuration source for both iOS and Android platforms
- Writes `CFBundleLocalizations` to iOS `Info.plist`
- Generates Android `locales_config.xml` and manifest references
- Automatic BCP 47 format conversion to platform-native equivalents
- Idempotent builds with consistent output
- Hooks into `pre_compile` during `native:run`, `native:build`, and `native:bundle`

## Installation

```bash
composer require developernauts/nativephp-mobile-locales
php artisan native:plugin:register developernauts/nativephp-mobile-locales
php artisan vendor:publish --tag=nativephp-mobile-locales-config
```

## Compatibility

| Platform  | Minimum Version |
| --------- | --------------- |
| NativePHP | v3              |
| iOS       | 14.0+           |
| Android   | API 24+         |
| PHP       | 8.3+            |
| Laravel   | 12+             |
