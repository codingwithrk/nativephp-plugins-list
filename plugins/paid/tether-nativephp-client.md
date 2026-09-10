---
name: "Tether Client"
author: "Lukas Rakauskas"
price: "$99"
version: "1.2.0"
license: "Proprietary"
source: "https://nativephp.com/plugins/tether/nativephp-client"
support: "https://github.com/lrakauskas/tether-core/issues"
compatibility:
  nativephp: "^3.0 || ^4.0"
  ios: "18.2+"
  android: "26+"
install:
  - "composer config repositories.nativephp-plugins composer https://plugins.nativephp.com"
  - "composer config http-basic.plugins.nativephp.com your@email.com your-license-key"
  - "composer require tether/nativephp-client"
  - "php artisan native:plugin:register tether/nativephp-client"
  - "php artisan vendor:publish --tag=tether-nativephp-config"
---

# Tether Client

Integrates Laravel Tether's offline-first synchronization framework with NativePHP Mobile — automatically triggers sync when the app resumes or the device reconnects to the network, with the entire sync engine running in PHP.

## Features

- **Auto-sync** on app resume and network reconnection
- **Mobile lifecycle events** — app foreground/background exposed as Laravel events
- **Connectivity events** — network state changes as Laravel events
- **Background sync** support when `nativephp/mobile-background-tasks` is present
- **Cooldown mechanism** to prevent repeated sync attempts
- **Full and partial sync** options
- **No native code** — cross-platform iOS and Android in pure PHP

## Installation

```bash
composer config repositories.nativephp-plugins composer https://plugins.nativephp.com
composer config http-basic.plugins.nativephp.com your@email.com your-license-key
composer require tether/nativephp-client
php artisan native:plugin:register tether/nativephp-client
php artisan vendor:publish --tag=tether-nativephp-config
```
