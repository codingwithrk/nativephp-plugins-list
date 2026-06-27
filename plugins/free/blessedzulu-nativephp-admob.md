---
name: "AdMob"
author: "Blessed Zulu"
price: "Free"
version: "latest"
license: "MIT"
github: "https://github.com/blessedzulu/nativephp-admob"
compatibility:
  nativephp: "^3.0"
  php: "^8.3"
  laravel: "11 | 12 | 13"
  ios: "any"
  android: "any"
install:
  - "composer require blessedzulu/nativephp-admob"
  - "php artisan vendor:publish --tag=nativephp-plugins-provider"
  - "php artisan native:plugin:register blessedzulu/nativephp-admob"
events:
  - AdLoaded
  - AdFailedToLoad
  - AdShown
  - AdDismissed
  - RewardEarned
  - ConsentObtained
---

# AdMob

Google AdMob plugin for NativePHP Mobile. Banner, interstitial, rewarded, rewarded interstitial, and app-open ads, with built-in UMP consent and iOS App Tracking Transparency.

> **Status:** 1.1.0-beta. Android device-verified. iOS implemented but not yet tested on hardware.

## Features

- Five ad formats: banner, interstitial, rewarded, rewarded interstitial, app open
- Fluent slot-based API — no raw `ca-app-pub-...` IDs in app code
- Config-driven slot names, per-Android/iOS ad unit and app ID resolution
- `<x-admob::banner>` Blade component (no Livewire dependency)
- Per-format and per-slot frequency caps
- UMP consent flow built in
- iOS App Tracking Transparency prompt built in
- `show()` silently no-ops until consent is granted
- Automatic test ad mode outside production
- `Admob::fake()` for unit tests

## Installation

```bash
composer require blessedzulu/nativephp-admob
php artisan vendor:publish --tag=nativephp-plugins-provider
php artisan native:plugin:register blessedzulu/nativephp-admob
php artisan native:run
```

Set your AdMob app ID in `.env`:

```dotenv
ADMOB_ENABLED=true
ADMOB_APP_ID=ca-app-pub-XXXXXXXXXXXXXXXX~YYYYYYYYYY
```

## Usage

```php
use BlessedZulu\Admob\Facades\Admob;

// PHP
Admob::rewarded('extra_lives')->load()->show();
Admob::interstitial('level_complete')->load()->show();
```

```js
// JavaScript
const ad = Admob.rewarded('extra_lives');
await ad.load();
await ad.show();
```

## Events

- `AdLoaded` — ad preloaded successfully
- `AdFailedToLoad` — ad load failed with error code
- `AdShown` — ad displayed to the user
- `AdDismissed` — user closed the ad
- `RewardEarned` — user earned a reward (rewarded/rewarded interstitial)
- `ConsentObtained` — UMP consent flow completed
