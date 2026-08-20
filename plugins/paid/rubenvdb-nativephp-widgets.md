---
name: "Widgets"
author: "Borgman Digital"
price: "$99"
version: "0.9.0"
license: "Proprietary"
source: "https://nativephp.com/plugins/rubenvdb/nativephp-widgets"
support: "rubenvdb@borgmandigital.com"
compatibility:
  nativephp: "~4.0.0"
  php: "^8.4"
  laravel: "11 || 12 || 13"
  ios: "18.0+"
  android: "31+"
install:
  - "composer config repositories.nativephp-plugins composer https://plugins.nativephp.com"
  - "composer config http-basic.plugins.nativephp.com your@email.com your-license-key"
  - "php artisan vendor:publish --tag=nativephp-plugins-provider"
  - "composer require rubenvdb/nativephp-widgets"
  - "php artisan native:plugin:register rubenvdb/nativephp-widgets"
  - "php artisan native:install android"
  - "php artisan native:install ios"
---

# Widgets

Cross-platform home screen widgets for NativePHP Mobile. Define widgets as PHP classes — rendered natively via WidgetKit (iOS) and Jetpack Glance (Android).

## Features

- **48 layout components** with a typed fluent API and five-layer theming
- **Device-side computations** — countdowns, streaks, and daily resets work with the app closed
- **Rapid tap response** — ~187ms measured using optimistic local state
- **Background PHP execution** via WorkManager (~1.2s cold start on Android)
- **Server push support** through FCM
- **Per-instance theming** via on-device configuration screens
- **17 ready-made recipes** — goal rings, streak trackers, counters, and more

## Installation

```bash
composer config repositories.nativephp-plugins composer https://plugins.nativephp.com
composer config http-basic.plugins.nativephp.com your@email.com your-license-key
php artisan vendor:publish --tag=nativephp-plugins-provider
composer require rubenvdb/nativephp-widgets
php artisan native:plugin:register rubenvdb/nativephp-widgets
php artisan native:install android
php artisan native:install ios
```

> **Note:** Five upstream patches must be applied post-installation to enable push functionality and prevent build failures. See the plugin documentation for the automated patching script.
