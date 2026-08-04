---
name: "NativePHP Mobile Background Tasks"
author: "Bifrost Technology"
price: "$99"
version: "0.0.4"
license: "Proprietary"
source: "https://nativephp.com/plugins/nativephp/mobile-background-tasks"
support: "support@nativephp.com"
compatibility:
  nativephp: "^3.2.1"
  ios: "16.0+"
  android: "26+"
install:
  - "composer require nativephp/mobile-background-tasks"
  - "php artisan native:plugin:register nativephp/mobile-background-tasks"
---

# NativePHP Mobile Background Tasks

Run scheduled artisan commands in the background on iOS and Android via WorkManager (Android) and BGTaskScheduler (iOS) — tasks continue executing even after the user closes the app.

## Features

- Background task scheduling that survives app close
- Device constraints: network, charging, battery, storage, idle state
- Long-running task support for operations beyond typical execution limits
- Independent task scheduling with individual intervals
- Automatic OS-level task registration on app launch
- Testing utilities and debugging support

## Installation

> Requires Composer credentials for the NativePHP plugin repository.

```bash
composer config repositories.nativephp-plugins composer https://plugins.nativephp.com
composer config http-basic.plugins.nativephp.com your@email.com your-license-key
php artisan vendor:publish --tag=nativephp-plugins-provider
composer require nativephp/mobile-background-tasks
php artisan native:plugin:register nativephp/mobile-background-tasks
```

## Usage

Define tasks in `routes/console.php`:

```php
use Illuminate\Support\Facades\Schedule;

Schedule::command('sync:data')->everyFifteenMinutes()->onAnyNetwork();
Schedule::command('backup:run')->daily()->onWifi()->whileCharging()->whenBatteryNotLow();
Schedule::command('export:logs')->daily()->longRunning();
```

Trigger immediately for testing:

```php
use NativePHP\BackgroundTasks\Facades\BackgroundTasks;

BackgroundTasks::runNow();
```

## Constraints

| Method | Purpose |
|--------|---------|
| `onAnyNetwork()` | Requires WiFi or cellular |
| `onWifi()` | Requires WiFi only |
| `whileCharging()` | Device must be plugged in |
| `whenBatteryNotLow()` | Battery above ~15% |
| `whenStorageNotLow()` | Storage not critically low |
| `whenIdle()` | Device in idle/doze state |

## Schedule Intervals

| Method | Android | iOS |
|--------|---------|-----|
| `everyFifteenMinutes()` | 15 min minimum | OS discretion |
| `hourly()` | 60 min | OS discretion |
| `daily()` | 1440 min | OS discretion |

> iOS timing is entirely at OS discretion based on usage patterns and battery state.

## Compatibility

| Platform   | Minimum Version |
| ---------- | --------------- |
| NativePHP  | ^3.2.1          |
| iOS        | 16.0+           |
| Android    | API 26+         |
