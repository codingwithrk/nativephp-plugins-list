---
name: "IAP Apple & Google"
author: "Cody P Christian"
price: "$49"
version: "0.3.0"
license: "Proprietary"
source: "https://nativephp.com/plugins/codypchristian/nativephp-iap"
support: "app-support@codypchristian.net"
compatibility:
  nativephp: "^3.0 || ^4.0"
  ios: "18.2+"
  android: "26+"
install:
  - "composer config repositories.nativephp-plugins composer https://plugins.nativephp.com"
  - "composer config http-basic.plugins.nativephp.com your@email.com your-license-key"
  - "php artisan vendor:publish --tag=nativephp-plugins-provider"
  - "composer require codypchristian/nativephp-iap"
  - "php artisan native:plugin:register codypchristian/nativephp-iap"
  - "php artisan native:install --force"
---

# IAP Apple & Google (In-App Purchases)

Auto-renewing subscriptions and in-app purchases from PHP — StoreKit 2 on iOS and Google Play Billing 8 on Android — with a unified synchronous API across both platforms.

## Features

- **Subscription management** — auto-renewing subscriptions on iOS and Android
- **Server-side verification** — signed transaction tokens (iOS) and purchase tokens (Android)
- **Restored purchases** and entitlement checking
- **Base plan selection** for Android multi-plan products
- **Automatic acknowledgment** — Play purchases acknowledged within the 3-day requirement
- **Synchronous PHP surface** wrapping asynchronous native operations
- **Consistent error handling** — normalized responses across platforms

## Installation

```bash
composer config repositories.nativephp-plugins composer https://plugins.nativephp.com
composer config http-basic.plugins.nativephp.com your@email.com your-license-key
php artisan vendor:publish --tag=nativephp-plugins-provider
composer require codypchristian/nativephp-iap
php artisan native:plugin:register codypchristian/nativephp-iap
php artisan native:install --force
```
