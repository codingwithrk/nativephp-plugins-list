---
name: "Force Update"
author: "Paul (PARTek)"
price: "$29"
version: "1.0.0"
license: "Proprietary"
source: "https://nativephp.com/plugins/partek/force-update"
support: "https://nativephp.com/plugins/partek/force-update"
compatibility:
  nativephp: "^3.0 || ^4.0"
  ios: "18.0+"
  android: "26+"
install:
  - "composer config repositories.nativephp-plugins composer https://plugins.nativephp.com"
  - "composer config http-basic.plugins.nativephp.com your@email.com your-license-key"
  - "php artisan vendor:publish --tag=nativephp-plugins-provider"
  - "composer require partek/force-update"
  - "php artisan native:plugin:register partek/force-update"
---

# Force Update

Cross-platform minimum-version gate and store listing opener. Reads the running app version from `config('nativephp.version')`, compares it via semver against a configured minimum, and opens the correct App Store or Google Play listing.

## Features

- **`ForceUpdate::configure([...])`** — set `minimum`, `latest`, `ios_url`, `android_url`, `mode` (`hard`/`soft`)
- **`ForceUpdate::status()`** — returns `current`, `minimum`, `latest`, `outdated`, `storeUrl`, `mode`
- **`ForceUpdate::isOutdated()`** — returns `true` when `current < minimum`
- **`ForceUpdate::openStore()`** — opens App Store or Play Store natively
- `DEBUG`/unreadable app versions are never considered outdated
- No route interception — app handles its own blocking UI
- **JavaScript** — `openStore()` available (pass `storeUrl` from server)

## Installation

```bash
composer config repositories.nativephp-plugins composer https://plugins.nativephp.com
composer config http-basic.plugins.nativephp.com your@email.com your-license-key
php artisan vendor:publish --tag=nativephp-plugins-provider
composer require partek/force-update
php artisan native:plugin:register partek/force-update
```
