---
name: "Home Screen Widgets"
author: "Neo Nos"
price: "$49"
version: "0.7.2"
license: "Proprietary"
source: "https://nativephp.com/plugins/all1web/nativephp-widgets"
support: "https://github.com/all1web/nativephp-widgets/issues"
compatibility:
  nativephp: "^3.3 || ^4.0"
  ios: "18.2+"
  android: "26+"
install:
  - "composer config repositories.nativephp-plugins composer https://plugins.nativephp.com"
  - "composer config http-basic.plugins.nativephp.com your@email.com your-license-key"
  - "composer require all1web/nativephp-widgets"
  - "php artisan native:plugin:register all1web/nativephp-widgets"
  - "php artisan native:install android --force"
---

# Home Screen Widgets

Adds home-screen presence to your NativePHP Mobile app — real Android home-screen widgets with quick-action and capture buttons, plus iOS app-icon quick actions and badge mirroring (both beta), all driven from Laravel.

## Features

- **Android home-screen widget** — title, content lines, badge counter, and dark mode support
- **Quick-actions row** — up to 4 icon+label buttons with deep-link navigation
- **Capture buttons** — camera, voice, and document picker actions from the widget
- **iOS quick-actions menu** — 3D Touch / long-press shortcuts on the app icon (beta)
- **App icon badge mirroring** — sync badge count to iOS (beta)
- **Laravel-driven updates** — update widget content from controllers, observers, or jobs
- **"Add widget" prompt** — built-in trigger to guide users through widget placement
- **Offline rendering & empty states** — graceful display when data is unavailable
- **Testing support** — `Widgets::fake()` with assertions
- **Diagnostics** — `php artisan widgets:doctor` for setup verification

## Installation

```bash
composer config repositories.nativephp-plugins composer https://plugins.nativephp.com
composer config http-basic.plugins.nativephp.com your@email.com your-license-key
composer require all1web/nativephp-widgets
php artisan native:plugin:register all1web/nativephp-widgets
php artisan native:install android --force
```

## Diagnostics

```bash
php artisan widgets:doctor
```
