---
name: "Wallet"
author: "Molly Klein (The Firsthand Co.)"
price: "$99"
version: "1.0.1"
license: "Proprietary"
source: "https://nativephp.com/plugins/firsthand/nativephp-wallet"
support: "https://nativephp.com/plugins/firsthand/nativephp-wallet"
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
  - "composer require firsthand/nativephp-wallet"
  - "php artisan native:plugin:register firsthand/nativephp-wallet"
---

# Wallet

Add passes to Apple Wallet (iOS) and Google Wallet (Android) with a single `Wallet::add()` call.

> **iOS:** Passes must be signed with a Pass Type ID certificate. No entitlement or capability needed. Pairs well with `spatie/laravel-mobile-pass` for pass generation.
>
> **Android:** Only Google Wallet save links work. Apple `.pkpass` files are rejected. A Google Pay & Wallet Console issuer account is required.

## Features

- **`Wallet::add()`** — opens Apple's add-to-Wallet sheet on iOS and Google Wallet save sheet on Android
- **Flexible pass input** — pass URL (with optional headers), `.pkpass` file in the app bundle, or raw `.pkpass` bytes
- **`PassAddFinished` event** — reports `added`, `closed`, `invalid`, or `failed` on iOS
- **`Wallet::status()`** — reports the platform and whether a pass can be added
- **`<native:wallet-add-button>`** — Apple's official button on iOS; renders nothing on Android
- **JavaScript helpers** — `add()`, `onPassAddFinished()` for Vue and React

## Installation

```bash
composer config repositories.nativephp-plugins composer https://plugins.nativephp.com
composer config http-basic.plugins.nativephp.com your@email.com your-license-key
php artisan vendor:publish --tag=nativephp-plugins-provider
composer require firsthand/nativephp-wallet
php artisan native:plugin:register firsthand/nativephp-wallet
php artisan native:run
```
