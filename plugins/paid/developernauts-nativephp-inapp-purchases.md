---
name: "In-App Purchases"
author: "Developernauts"
price: "$99"
version: "1.3.1"
license: "Proprietary"
source: "https://nativephp.com/plugins/developernauts/nativephp-inapp-purchases"
support: "support@developernauts.com"
compatibility:
  nativephp: "^3.0"
  php: "^8.3"
  laravel: "^12.0"
  ios: "18.2+"
  android: "26+"
install:
  - "composer config repositories.nativephp-plugins composer https://plugins.nativephp.com"
  - "composer config http-basic.plugins.nativephp.com your@email.com your-license-key"
  - "composer require developernauts/nativephp-inapp-purchases"
  - "php artisan native:plugin:register developernauts/nativephp-inapp-purchases"
---

# In-App Purchases

In-app purchases via StoreKit 2 (iOS) and Google Play Billing (Android) for NativePHP Mobile Laravel apps.

## Features

- Product fetching (single and multiple products)
- Purchase initiation and transaction handling
- Restore previous purchases
- Entitlement status checking
- Server-side receipt validation (Apple & Google)
- Livewire v3/v4 support
- Inertia + Vue/React support

## Installation

> Requires Composer credentials for the NativePHP plugin repository.

```bash
composer config repositories.nativephp-plugins composer https://plugins.nativephp.com
composer config http-basic.plugins.nativephp.com your@email.com your-license-key
composer require developernauts/nativephp-inapp-purchases
php artisan native:plugin:register developernauts/nativephp-inapp-purchases
```

## Compatibility

| Platform  | Minimum Version |
| --------- | --------------- |
| NativePHP | ^3.0            |
| PHP       | ^8.3            |
| Laravel   | ^12.0           |
| iOS       | 18.2+           |
| Android   | API 26+         |
