---
name: "Live Activities"
author: "Pauline Vos"
price: "$49"
version: "1.2.0"
license: "Proprietary"
source: "https://nativephp.com/plugins/vos/nativephp-live-activities"
support: "https://twitter.com/vanamerongen"
compatibility:
  nativephp: "^4.5"
  php: "^8.4"
  laravel: "^12"
  ios: "18.0+"
  android: "29+"
install:
  - "composer config repositories.nativephp-plugins composer https://plugins.nativephp.com"
  - "composer config http-basic.plugins.nativephp.com your@email.com your-license-key"
  - "php artisan vendor:publish --tag=nativephp-plugins-provider"
  - "composer require vos/nativephp-live-activities"
  - "php artisan native:plugin:register vos/nativephp-live-activities"
---

# Live Activities

Local iOS Live Activities and Android ongoing progress notifications — lock screen widgets, Dynamic Island presence, and progress tracking without a push notification server.

## Features

- **iOS Live Activities** — displayed on the lock screen and in the Dynamic Island (iOS 18+)
- **Android ongoing progress notifications** — optionally promoted to Android Live Updates (Android 10+)
- **Progress bar** — 0.0–1.0 float, renders as a native progress indicator
- **Title & subtitle** — update in real time from PHP
- **Bundled Lucide icons** — `circle-dashed`, `utensils`, `truck`, `circle-check`, `package`, `clock`, `download`, `navigation`; colored via hex `#RRGGBB`
- **`LiveActivity::start($content)`** — create a new activity, returns an ID
- **`LiveActivity::update($id, $content)`** — push a content update to a running activity
- **`LiveActivity::end($id)`** — dismiss the activity
- **`LiveActivity::all()`** — list all running activities
- **`LiveActivity::capabilities()`** — check what the current device/OS supports

## Installation

```bash
composer config repositories.nativephp-plugins composer https://plugins.nativephp.com
composer config http-basic.plugins.nativephp.com your@email.com your-license-key
php artisan vendor:publish --tag=nativephp-plugins-provider
composer require vos/nativephp-live-activities
php artisan native:plugin:register vos/nativephp-live-activities
php artisan native:run
```
