---
name: "NativePHP Mobile Screen"
author: "Eser Deniz"
price: "Free"
version: "1.1.0"
license: "MIT"
github: "https://github.com/SRWieZ/nativephp-mobile-screen"
compatibility:
  nativephp: "^3.0"
  ios: "13.0+"
  android: "21+"
install:
  - "composer require srwiez/nativephp-mobile-screen"
  - "php artisan vendor:publish --tag=nativephp-plugins-provider"
  - "php artisan native:plugin:register srwiez/nativephp-mobile-screen"
---

# Screen for NativePHP Mobile

### Keep screens awake. Control brightness. Built for apps users stare at.

<p align="center">
  <a href="https://packagist.org/packages/srwiez/nativephp-mobile-screen">
  </a>
</p>

<p align="center">
</p>

A tiny, focused NativePHP plugin for two things mobile devs constantly need: keeping the screen on and controlling brightness. One facade, six methods, zero setup.

## Why this plugin?

- **☀️ Keep the screen awake** — perfect for barcode tickets, live dashboards, kiosks and scoring apps.
- **🔆 Control brightness** — crank to 100% to scan barcodes in sunlight, dim down for dark reading rooms.
- **🪶 Dependency-free** — a single wake-lock + brightness wrapper. No bloat, no configuration.
- **📱 Works everywhere** — iOS 13+ and Android 5+ (API 21).

## Features at a glance

| Feature | Android | iOS |
|:---|:---:|:---:|
| Keep screen awake | ✅ | ✅ |
| Set brightness (0.0–1.0) | ✅ | ✅ |
| Reset to system default | ✅ | ✅ |

## Perfect for

Ticket & boarding-pass apps · Barcode / QR scanners · Kiosk & POS apps · Sports scoreboards · Live dashboards & monitoring · E-readers

---

## Installation

```bash
# Install the package
composer require srwiez/nativephp-mobile-screen

# Publish the plugins provider (first time only)
php artisan vendor:publish --tag=nativephp-plugins-provider

# Register the plugin
php artisan native:plugin:register srwiez/nativephp-mobile-screen

# Verify registration
php artisan native:plugin:list
```

This adds `\SRWieZ\NativePHP\Mobile\Screen\MobileScreenServiceProvider::class` to your `plugins()` array.

## Usage

### PHP (Livewire/Blade)

```php
use SRWieZ\NativePHP\Mobile\Screen\Facades\Screen;

// Keep screen awake
Screen::keepAwake(); // true if wake lock enabled

// Allow screen to sleep
Screen::allowSleep(); // true if wake lock disabled

// Check wake lock status
$isAwake = Screen::isAwake(); // bool

// Set brightness (0.0 to 1.0)
$level = Screen::setBrightness(1.0); // returns actual level, or false on failure

// Get current brightness
$level = Screen::getBrightness(); // float or null

// Reset to system default
Screen::resetBrightness(); // returns level or false on failure
```

### JavaScript (Vue/React/Inertia)

```javascript
import { mobileScreen } from '@srwiez/nativephp-mobile-screen';

// Keep screen awake
await mobileScreen.keepAwake();

// Set maximum brightness
await mobileScreen.setBrightness(1.0);

// Reset when done
await mobileScreen.resetBrightness();
await mobileScreen.allowSleep();
```

## API Reference

| Method | Returns | Description |
|--------|---------|-------------|
| `keepAwake(bool $enabled = true)` | `bool` | Enable/disable screen wake lock |
| `allowSleep()` | `bool` | Alias for `keepAwake(false)` |
| `isAwake()` | `bool` | Check if wake lock is active |
| `setBrightness(float $level)` | `bool\|float` | Set brightness (0.0-1.0). Returns actual level or `false` on failure |
| `getBrightness()` | `?float` | Get current brightness level |
| `resetBrightness()` | `bool\|float` | Reset to system default. Returns level or `false` on failure |

## Version Support

| Platform | Minimum Version |
|----------|----------------|
| Android  | 5.0 (API 21)   |
| iOS      | 13.0            |

## More NativePHP Mobile plugins

Building a mobile app with NativePHP? Check out the rest of the suite:

- **[Calendar](https://nativephp.com/plugins/srwiez/nativephp-mobile-calendar)** — Native calendars & events from PHP, on both platforms.
- **[Contacts](https://nativephp.com/plugins/srwiez/nativephp-mobile-contacts)** — Read, create & sync the device address book straight from Laravel.
- **[Screenshots](https://nativephp.com/plugins/srwiez/nativephp-mobile-screenshots)** — Lock down sensitive screens, catch capture attempts, respond instantly.

## Support

Bugs, questions, and feature requests should be reported at [github.com/SRWieZ/nativephp-mobile-screen/issues](https://github.com/SRWieZ/nativephp-mobile-screen/issues).
