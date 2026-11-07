---
name: "Wallet Passes"
author: "Paul (PARTek)"
price: "$99"
version: "2.0.0"
license: "Proprietary"
source: "https://nativephp.com/plugins/partek/wallet-passes"
support: "https://nativephp.com/plugins/partek/wallet-passes"
compatibility:
  nativephp: "^4.6.1"
  php: "^8.2"
  laravel: "^10|^11|^12|^13"
  ios: "18.0+"
  android: "29+"
install:
  - "composer config repositories.nativephp-plugins composer https://plugins.nativephp.com"
  - "composer config http-basic.plugins.nativephp.com your@email.com your-license-key"
  - "php artisan vendor:publish --tag=nativephp-plugins-provider"
  - "composer require partek/wallet-passes"
  - "php artisan native:plugin:register partek/wallet-passes"
  - "php artisan vendor:publish --tag=wallet-passes-config"
---

# Wallet Passes

Add Google Wallet passes to Android devices from NativePHP Mobile.

> **Android only (Google Wallet).** iOS calls return `unsupported_platform`. A Google Wallet API issuer account and service account are required. The plugin does not sign JWTs.

## Features

- **Capability check** — `WalletPasses::canAdd()` with a stable reason when Google Wallet is unavailable
- **Add passes** — opens the Google Wallet save sheet via the official Wallet SDK; reports `added`, `cancelled`, or `failed`
- **Save token validation** — validates the token's format in PHP before it reaches the native bridge
- **JavaScript module** — Inertia, Vue, React, and plain JS support
- **Optional HTTP routes** — off by default
- **Testing** — fake and test helpers for NativePHP's test harness
- **No Android permissions** required; adds one transparent, non-exported activity
- **No network requests** of its own

## Installation

```bash
composer config repositories.nativephp-plugins composer https://plugins.nativephp.com
composer config http-basic.plugins.nativephp.com your@email.com your-license-key
php artisan vendor:publish --tag=nativephp-plugins-provider
composer require partek/wallet-passes
php artisan native:plugin:register partek/wallet-passes
php artisan vendor:publish --tag=wallet-passes-config
php artisan native:run android
```
