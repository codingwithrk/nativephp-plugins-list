---
name: "Rich Push"
author: "Molly Klein (The Firsthand Co.)"
price: "$49"
version: "1.1.0"
license: "Proprietary"
source: "https://nativephp.com/plugins/firsthand/nativephp-rich-push"
support: "https://nativephp.com/plugins/firsthand/nativephp-rich-push"
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
  - "composer require firsthand/nativephp-rich-push"
  - "php artisan native:plugin:register firsthand/nativephp-rich-push"
---

# Rich Push

Add images, GIFs, and video previews to push notifications. Works alongside your existing push plugin — adds a Notification Service Extension to your iOS Xcode project automatically on each build.

> **iOS prerequisite:** Push notifications capability must be enabled for your app ID and `push_notifications` set to `true` in `config/nativephp.php`.

## Features

- **Rich media** — images on both platforms; GIFs and video on iOS
- **iOS media limits** — images/GIFs up to 10 MB, video up to 50 MB, audio up to 5 MB; must use HTTPS
- **Graceful fallback** — if media is too large, slow, or missing, the notification still arrives as plain text
- **Multiple send options** — `RichPush::send()`, Laravel notification channel, `rich-push:send` Artisan command, or `RichPushMessage` for Firebase/other services
- **Foreground display** — configurable via `RICH_PUSH_FOREGROUND`: `banner` (default), `list`, or `none`
- **Tap handling** — custom data received on tap, including taps that launch a closed app
- **JavaScript helpers** — Vue and React with TypeScript types

## Installation

```bash
composer config repositories.nativephp-plugins composer https://plugins.nativephp.com
composer config http-basic.plugins.nativephp.com your@email.com your-license-key
php artisan vendor:publish --tag=nativephp-plugins-provider
composer require firsthand/nativephp-rich-push
php artisan native:plugin:register firsthand/nativephp-rich-push
php artisan native:run
```
