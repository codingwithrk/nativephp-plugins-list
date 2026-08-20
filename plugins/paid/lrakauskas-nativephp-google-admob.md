---
name: "Google AdMob"
author: "Lukas Rakauskas"
price: "$99"
version: "1.0.0"
license: "Proprietary"
source: "https://nativephp.com/plugins/lrakauskas/nativephp-google-admob"
support: "lrakauskas@gmail.com"
compatibility:
  nativephp: "^3.0"
  ios: "18.0+"
  android: "23+"
install:
  - "composer config repositories.nativephp-plugins composer https://plugins.nativephp.com"
  - "composer config http-basic.plugins.nativephp.com your@email.com your-license-key"
  - "php artisan vendor:publish --tag=nativephp-plugins-provider"
  - "composer require lrakauskas/nativephp-google-admob"
  - "php artisan native:plugin:register lrakauskas/nativephp-google-admob"
---

# Google AdMob

Bridges Google AdMob to PHP and JavaScript for NativePHP Mobile — banner, interstitial, and rewarded ads with a facade-first PHP API and native event dispatching on both iOS and Android.

## Features

- **Anchored adaptive banner ads** — responsive banners that fit any screen size
- **Interstitial ads** with complete lifecycle events (loaded, shown, dismissed, failed)
- **Rewarded ads** with complete lifecycle events and reward callbacks
- **Facade-first PHP API** — clean, expressive interface from Laravel
- **Native event dispatching** — real-time ad lifecycle events on both platforms
- **Cross-platform** — consistent API across Android and iOS

## Installation

```bash
composer config repositories.nativephp-plugins composer https://plugins.nativephp.com
composer config http-basic.plugins.nativephp.com your@email.com your-license-key
php artisan vendor:publish --tag=nativephp-plugins-provider
composer require lrakauskas/nativephp-google-admob
php artisan native:plugin:register lrakauskas/nativephp-google-admob
```

## Prerequisites

A Google AdMob account with app IDs and ad unit IDs configured for both iOS and Android.
