---
name: "Android Launcher"
author: "Kevin Batdorf"
price: "Free"
version: "0.1.0"
license: "MIT"
github: "https://github.com/KevinBatdorf/nativephp-launcher"
support: "https://github.com/KevinBatdorf/nativephp-launcher/issues"
compatibility:
  nativephp: "^4.5"
  ios: "15.0+"
  android: "30+"
install:
  - "composer require kevinbatdorf/nativephp-launcher"
  - "php artisan native:plugin:register kevinbatdorf/nativephp-launcher"
---

# Android Launcher

Turn your NativePHP app into an Android home screen launcher — list installed apps, open them, and handle multi-display layouts.

> **Android only.** iOS reports every function as unsupported (no home screen to replace). Requires Android 11+ (API 30).

## Features

- **`Launcher::apps()`** — returns all installed apps with `label`, `package`, `activity`, and `icon` path
- **`Launcher::open($package, $display, $activity)`** — launch any installed app (optionally on a specific display)
- **`Launcher::isDefaultHome()`** — check if your app is the current default launcher
- **`Launcher::currentHome()`** — returns the current default home app package
- **`Launcher::openHomeSettings()`** — navigates the user to Settings → Default apps → Home app to switch launchers
- **`HomeRequested($displayId)`** event — fired when Android requests the home screen (great for multi-display)
- **`IsHomeScreen` trait** — apply to your root component so the back button stays at the root instead of minimizing
- **`QUERY_ALL_PACKAGES` permission** — declared in the manifest; accepted by Google Play for launcher use cases
- **JavaScript API** — `resources/js/Launcher.js` export for Inertia/SPA apps

## Installation

```bash
composer require kevinbatdorf/nativephp-launcher
php artisan native:plugin:register kevinbatdorf/nativephp-launcher
```

After install, your app will appear in Android's home-app picker. Call `Launcher::openHomeSettings()` to take the user directly there.
