---
name: "Background Geofencing"
author: "Neo Nos"
price: "$49"
version: "0.2.3"
license: "Proprietary"
source: "https://nativephp.com/plugins/all1web/nativephp-geofence"
support: "https://github.com/all1web/plugin-assets/issues"
compatibility:
  nativephp: "^3.0 || ^4.0"
  ios: "18.0+"
  android: "29+"
install:
  - "composer config repositories.nativephp-plugins composer https://plugins.nativephp.com"
  - "composer config http-basic.plugins.nativephp.com your@email.com your-license-key"
  - "composer require all1web/nativephp-geofence"
  - "php artisan native:plugin:register all1web/nativephp-geofence"
  - "php artisan native:install android --force"
---

# Background Geofencing

OS-level geofencing that persists when the app is backgrounded, force-quit, or the device reboots. Geofence transitions are reported via HTTPS POST to your configured endpoint directly from native code — bypassing PHP's inability to run background processes on mobile.

## Features

- **Persistent fencing** — survives app death and device reboot on both platforms
- **Direct server reporting** — authenticated HTTPS POSTs from native receivers to your endpoint
- **Unified API** — same PHP calls across Android and iOS
- **Encrypted credentials** — AES-256 on Android, Keychain on iOS
- **Foreground events** — optional Laravel events when the app is active
- **Configurable responsiveness** — adjustable dwell delay, retry logic, and timeouts
- **Broad capacity** — ~100 fences on Android; 20 maximum on iOS

## Installation

```bash
composer config repositories.nativephp-plugins composer https://plugins.nativephp.com
composer config http-basic.plugins.nativephp.com your@email.com your-license-key
composer require all1web/nativephp-geofence
php artisan native:plugin:register all1web/nativephp-geofence
php artisan native:install android --force
```
