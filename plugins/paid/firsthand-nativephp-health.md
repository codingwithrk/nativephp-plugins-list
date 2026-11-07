---
name: "Health"
author: "Molly Klein (The Firsthand Co.)"
price: "$99"
version: "1.0.1"
license: "Proprietary"
source: "https://nativephp.com/plugins/firsthand/nativephp-health"
support: "https://nativephp.com/plugins/firsthand/nativephp-health"
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
  - "composer require firsthand/nativephp-health"
  - "php artisan native:plugin:register firsthand/nativephp-health"
  - "php artisan vendor:publish --tag=health-config"
---

# Health

Read and write health data from HealthKit (iOS) and Health Connect (Android) using the same PHP and JavaScript API.

> **iOS:** Enable the HealthKit capability for your app ID in Apple's developer portal.
> **Android:** Health Connect is built in from Android 14. On Android 10–13, it installs from Google Play. Complete the Health Connect declaration in Play Console before publishing.
> **Google Play:** A Health Connect declaration is required.

## Supported Data Types

| Read | Write |
|---|---|
| Steps, activity, heart rate, weight, sleep, workouts | Weight, height, water |

## Features

- **Unified API** — same method names and units across HealthKit and Health Connect
- **PHP & JavaScript** — Livewire, Blade, Inertia + Vue/React
- **Unit preferences** — shows values in the user's preferred units with conversion helpers
- **De-duplication** — totals avoid double-counting when a phone and watch record the same activity
- **Latest reading on demand** — returns the most recent value for any data type
- **Permission result event** — fires after the OS permission dialog is answered
- **Config-driven** — declare the data types you read/write in `config/health.php`; set permission wording and privacy URL in env
- **Testing helper** — script the bridge without a device

## Installation

```bash
composer config repositories.nativephp-plugins composer https://plugins.nativephp.com
composer config http-basic.plugins.nativephp.com your@email.com your-license-key
php artisan vendor:publish --tag=nativephp-plugins-provider
composer require firsthand/nativephp-health
php artisan native:plugin:register firsthand/nativephp-health
php artisan vendor:publish --tag=health-config
php artisan native:run
```
