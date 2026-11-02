---
name: "Live Activities (Free)"
author: "Pauline Vos"
price: "Free"
version: "1.0.1"
license: "MIT"
github: "https://github.com/paulinevos/nativephp-live-activities-free"
support: "https://nativephp.com/plugins/vos/nativephp-live-activities-free"
compatibility:
  nativephp: "^4.5"
  php: "^8.4"
  laravel: "^12"
  ios: "18.0+"
  android: "29+"
install:
  - "composer require vos/nativephp-live-activities-free"
  - "php artisan vendor:publish --tag=nativephp-plugins-provider"
  - "php artisan native:plugin:register vos/nativephp-live-activities-free"
---

# Live Activities (Free)

Start, update, and end Live Activities from PHP — Lock Screen and Dynamic Island on iOS, ongoing progress notifications on Android. A free edition with bundled icons; the [paid edition](https://nativephp.com/plugins/vos/nativephp-live-activities) adds custom icons, countdowns, ETA, deep links, and a fluent API.

> **Free and paid editions share a PHP namespace and cannot be installed together.** Remove this package before upgrading to the paid edition.

> **Android 13+:** The plugin does not handle the notification-permission request required on Android 13 and above.

## Features

- **`LiveActivities` facade** — `start()`, `update()`, `end()`, `list()`, `capabilities()`
- **Progress bar** — numeric value `0.0–1.0`
- **Eight bundled Lucide icons** — `circle-dashed`, `utensils`, `truck`, `circle-check`, `package`, `clock`, `download`, `navigation`
- **Six-digit hex accent color**
- **Title and subtitle**
- **Platform capability check** — `capabilities()` reports whether Live Activities are supported and whether the permission is enabled
- **Local updates only** — the app must be running to update an activity; server-driven push updates are in the paid edition

## iOS vs Android

| | iOS | Android |
|---|---|---|
| **Display** | Lock Screen + Dynamic Island | Ongoing notification |
| **Minimum** | iOS 18.0 | API 29 (Android 10) |
| **Live Update promotion** | Dynamic Island | Android 13+ where system allows |

## Installation

```bash
composer require vos/nativephp-live-activities-free
php artisan vendor:publish --tag=nativephp-plugins-provider
php artisan native:plugin:register vos/nativephp-live-activities-free
php artisan native:run
```
