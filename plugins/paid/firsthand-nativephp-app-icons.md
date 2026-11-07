---
name: "App Icons"
author: "Molly Klein (The Firsthand Co.)"
price: "$29"
version: "1.0.1"
license: "Proprietary"
source: "https://nativephp.com/plugins/firsthand/nativephp-app-icons"
support: "https://nativephp.com/plugins/firsthand/nativephp-app-icons"
compatibility:
  nativephp: "^4.0"
  php: "^8.3"
  laravel: "^11|^12|^13"
  ios: "18.0+"
  android: "29+"
install:
  - "composer config repositories.nativephp-plugins composer https://plugins.nativephp.com"
  - "composer config http-basic.plugins.nativephp.com your@email.com your-license-key"
  - "php artisan vendor:publish --tag=nativephp-plugins-provider"
  - "composer require firsthand/nativephp-app-icons"
  - "php artisan native:plugin:register firsthand/nativephp-app-icons"
  - "php artisan vendor:publish --tag=app-icons-config"
---

# App Icons

Let users switch between alternate app icons — dark mode, seasonal, or member-reward icons — from PHP or JavaScript, with no Xcode or Android Studio edits required.

> **PHP GD extension required** at build time for icon processing.
> **iPad:** Set `'ipad' => true` in `config/nativephp.php`.
> **iOS:** Apple always shows a system notice after an icon switch.
> **Android:** Switches happen when the user leaves the app by default; set `APP_ICONS_ANDROID_SWITCH=immediate` to switch instantly.

## Features

- **Automatic build-time setup** — icons added to the iOS asset catalog and Android adaptive icon set during each `native:run`
- **Build-time validation** — catches wrong sizes, non-PNG files, and invalid names before the build
- **`AppIcon::set()`, `reset()`, `current()`, `available()`** PHP API
- **JavaScript API** — for Inertia/SPA flows
- **`AppIconChanged` event** — reports the outcome of each switch
- **Testing support** — via NativePHP's testing suite
- **Icon requirements** — 1024×1024 square PNG files; list them in `config/app-icons.php`

## Installation

```bash
composer config repositories.nativephp-plugins composer https://plugins.nativephp.com
composer config http-basic.plugins.nativephp.com your@email.com your-license-key
php artisan vendor:publish --tag=nativephp-plugins-provider
composer require firsthand/nativephp-app-icons
php artisan native:plugin:register firsthand/nativephp-app-icons
php artisan vendor:publish --tag=app-icons-config
php artisan native:run
```
