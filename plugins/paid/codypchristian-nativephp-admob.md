---
name: "Google AdMob"
author: "Cody P Christian"
price: "$49"
version: "0.2.0"
license: "Proprietary"
source: "https://nativephp.com/plugins/codypchristian/nativephp-admob"
support: "https://nativephp.com/plugins/codypchristian/nativephp-admob"
compatibility:
  nativephp: "^3.0 || ^4.0"
  ios: "18.2+"
  android: "26+"
install:
  - "php artisan vendor:publish --tag=nativephp-plugins-provider"
  - "composer require codypchristian/nativephp-admob"
  - "php artisan native:plugin:register codypchristian/nativephp-admob"
  - "php artisan native:install --force"
---

# Google AdMob

Google AdMob banner, interstitial, and rewarded ads driven from PHP — with GDPR consent management and frequency capping across iOS and Android.

## Features

- **Ad formats** — banner, interstitial, rewarded video, and rewarded interstitial
- **Consent management** — GoogleUserMessagingPlatform integration for EEA/GDPR compliance
- **App Tracking Transparency** — iOS ATT prompt support
- **SKAdNetwork** — 50 pre-configured identifiers for install attribution
- **Frequency capping** — per-format and per-slot display limits
- **Diagnostics page** — real-time event logging and troubleshooting tools
- **Testing support** — fake bridge for unit testing without devices
- **Synchronous API** — calls return immediately without blocking on ad networks

## Installation

```bash
php artisan vendor:publish --tag=nativephp-plugins-provider
composer require codypchristian/nativephp-admob
php artisan native:plugin:register codypchristian/nativephp-admob
php artisan native:install --force
```
