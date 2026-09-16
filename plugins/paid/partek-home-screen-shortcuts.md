---
name: "Home Screen Shortcuts"
author: "Paul (PARTek)"
price: "$49"
version: "3.0.2"
license: "Proprietary"
source: "https://nativephp.com/plugins/partek/home-screen-shortcuts"
support: "https://nativephp.com/plugins/partek/home-screen-shortcuts"
compatibility:
  nativephp: "^3.0 || ^4.0"
  ios: "14.0+"
  android: "24+"
install:
  - "composer config repositories.nativephp-plugins composer https://plugins.nativephp.com"
  - "composer config http-basic.plugins.nativephp.com your@email.com your-license-key"
  - "php artisan vendor:publish --tag=nativephp-plugins-provider"
  - "composer require partek/home-screen-shortcuts"
  - "php artisan native:plugin:register partek/home-screen-shortcuts"
---

# Home Screen Shortcuts

Registers home screen long-press shortcuts (iOS `UIApplicationShortcutItem` / Android App Shortcuts) that deep-link into named routes — one facade, no native code required.

## Features

- **Up to 4 shortcuts** per app on the long-press launcher menu
- **Route or path targets** — named Laravel route or raw relative path per shortcut
- **Optional subtitle** per shortcut (shown on iOS)
- **PHP facade** — `HomeScreenShortcuts::set([...])` and `HomeScreenShortcuts::clear()`
- **JavaScript API** — pass pre-built deeplink URLs
- **No extra permissions** required on either platform
- Requires `NATIVEPHP_DEEPLINK_SCHEME` set in `.env`

## Installation

```bash
composer config repositories.nativephp-plugins composer https://plugins.nativephp.com
composer config http-basic.plugins.nativephp.com your@email.com your-license-key
php artisan vendor:publish --tag=nativephp-plugins-provider
composer require partek/home-screen-shortcuts
php artisan native:plugin:register partek/home-screen-shortcuts
```
