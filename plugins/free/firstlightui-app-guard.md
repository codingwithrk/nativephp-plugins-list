---
name: "App Guard"
author: "Wojt Janowski"
price: "Free"
version: "1.0.1"
license: "MIT"
github: "https://github.com/firstlightui/app-guard"
support: "https://nativephp.com/plugins/firstlightui/app-guard"
compatibility:
  nativephp: "^4.7"
  php: "^8.4"
  ios: "18.0+"
  android: "29+"
install:
  - "composer require firstlightui/app-guard"
  - "php artisan native:plugin:register firstlightui/app-guard"
  - "php artisan vendor:publish --tag=app-guard-config"
---

# App Guard

Privacy cover, app lock, return shield, sensitive clipboard, and lifecycle events for NativePHP Mobile.

> **PIN feature** requires `nativephp/mobile-secure-storage` at runtime (not a Composer dependency).
> **Biometric unlock** pairs well with `nativephp/mobile-biometrics`.

## Features

- **Privacy cover** — blurs the app in the iOS app switcher; uses `FLAG_SECURE` on Android (also blocks screenshots)
- **Return shield** — covers the app before its first frame after a timeout; shows your image, splash screen, or app icon
- **App lock** — headless lock service with optional PIN support and `app-lock` route middleware to keep protected screens closed while locked
- **Sensitive copy** — copies text to a device-only clipboard that clears itself after up to one hour
- **Lifecycle events** — `Backgrounded` and `Foregrounded` with time-away measured natively

## Installation

```bash
composer require firstlightui/app-guard
php artisan native:plugin:register firstlightui/app-guard
php artisan vendor:publish --tag=app-guard-config
php artisan native:run
```
