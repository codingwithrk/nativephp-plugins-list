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

- Fetches localized product metadata (titles, descriptions, prices) from native stores
- Initiates native purchase flows with Apple and Google infrastructure
- Restores previous purchases across devices
- Reads device entitlements in real-time
- Returns transaction data with verification proof (`jws` for iOS, `purchaseToken` for Android)
- Supports subscriptions, consumables, and non-consumable products
- Livewire v3/v4, Vue, and React support

## Installation

> Requires Composer credentials for the NativePHP plugin repository.

```bash
composer config repositories.nativephp-plugins composer https://plugins.nativephp.com
composer config http-basic.plugins.nativephp.com your@email.com your-license-key
php artisan vendor:publish --tag=nativephp-plugins-provider
composer require developernauts/nativephp-inapp-purchases
php artisan native:plugin:register developernauts/nativephp-inapp-purchases
```

## PHP Usage

```php
use Developernauts\NativephpInappPurchases\Facades\InApp;

// Fetch single product
$result = InApp::product('com.app.premium_monthly');
if ($result['ok']) {
    echo $result['product']['price_formatted'];
}

// Fetch multiple products
$result = InApp::products(['com.app.premium_monthly', 'com.app.premium_yearly']);

// Initiate purchase
$result = InApp::purchase('com.app.premium_monthly');
if ($result['ok']) {
    $jws = $result['transaction']['jws'];            // iOS
    $token = $result['transaction']['purchaseToken']; // Android
}

// Check entitlements
$result = InApp::entitlement();
if ($result['is_premium']) {
    // User has active subscription
}

// Restore purchases
$result = InApp::restore();
```

## JavaScript Usage

```javascript
import { products, purchase, entitlement, restore } from
    '../../vendor/developernauts/nativephp-inapp-purchases/resources/js/index.js';

const list = await products(['com.app.premium_monthly']);
const txn  = await purchase('com.app.premium_monthly');
const ent  = await entitlement();
const prev = await restore();
```

## API Methods

| Method | Purpose |
|--------|---------|
| `product($id)` | Fetch single product |
| `products($ids)` | Fetch multiple products |
| `purchase($id)` | Initiate purchase flow |
| `restore()` | Restore previous purchases |
| `entitlement()` | Check active entitlements |

## Compatibility

| Platform  | Minimum Version |
| --------- | --------------- |
| NativePHP | ^3.0            |
| PHP       | ^8.3            |
| Laravel   | ^12.0           |
| iOS       | 18.2+           |
| Android   | API 26+         |

## Notes

- This plugin does not emit NativePHP native events — all bridge functions return structured response arrays.
- Never store Apple `.p8` keys or Google service-account JSON inside the app bundle. Implement server-side receipt verification (App Store Server API / Play Developer API) for production entitlement management.
