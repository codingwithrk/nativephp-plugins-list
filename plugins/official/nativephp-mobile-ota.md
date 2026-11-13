---
name: "Mobile OTA"
author: "Bifrost Technology"
price: "Free"
version: "1.0.1"
license: "MIT"
github: "https://github.com/NativePHP/mobile-ota"
support: "https://nativephp.com/plugins/nativephp/mobile-ota"
compatibility:
  nativephp: "^3.3.11|^4.6.1"
  ios: "18.2+"
  android: "26+"
install:
  - "composer require nativephp/mobile-ota"
  - "php artisan native:plugin:register nativephp/mobile-ota"
---

# Mobile OTA

Over-the-air PHP updates for NativePHP Mobile — push new routes, controllers, Livewire components, Blade views, CSS, JavaScript, and images to installed devices without a store review.

> **Bifrost required:** OTA updates are signed by Bifrost for a specific app, Arc, and native setup. A Bifrost project is required; the plugin cannot point to a custom update server. Ship a new store build from Bifrost after installing so the app can locate its updates.

> **What cannot be updated OTA:** Compiled native content — adding/updating plugins, updating `nativephp/mobile`, or changing native settings in `config/nativephp.php` (app ID, permissions, deep links) — still requires a new store build.

## Update Modes

Set `NATIVEPHP_OTA_MODE` to control how updates are applied:

| Mode | Behaviour |
|---|---|
| `manual` | Your code drives every step (default) |
| `prompt` | User is asked before applying |
| `silent` | Updates download and apply automatically |

## Facade API

| Method | Purpose |
|---|---|
| `Ota::check()` | Check whether an update is available |
| `Ota::downloadAndApply()` | Download and apply the latest update |
| `Ota::rollback()` | Roll back to the previous release |
| `Ota::status()` | Current OTA status |
| `Ota::currentRelease()` | Details about the installed release |

## Events

`UpdateAvailable`, `UpdateDownloaded`, `UpdateApplied`, `RolledBack`, `UpdateFailed`

## Installation

```bash
composer require nativephp/mobile-ota
php artisan native:plugin:register nativephp/mobile-ota
php artisan native:run
```

After installing, ship a new store build from Bifrost to embed the project and Arc details the app needs to find its updates.
