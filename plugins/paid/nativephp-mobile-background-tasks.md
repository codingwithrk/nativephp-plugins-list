---
name: "NativePHP Mobile Background Tasks"
author: "Bifrost Technology"
price: "$99"
version: "0.0.3"
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

Schedule and run artisan commands in the background on iOS and Android using platform-native schedulers (WorkManager on Android, BGTaskScheduler on iOS).

## Features

- Scheduled artisan command execution on iOS and Android
- Independent task scheduling with individual intervals
- Device constraint support (network, charging, battery, storage, idle states)
- Long-running task capability for extended operations
- Cold boot handling with transparent PHP process management

## Installation

> Requires Composer credentials for the NativePHP plugin repository.

```bash
composer config repositories.nativephp-plugins composer https://plugins.nativephp.com
composer config http-basic.plugins.nativephp.com your@email.com your-license-key
composer require nativephp/mobile-background-tasks
php artisan native:plugin:register nativephp/mobile-background-tasks
```

## Compatibility

| Platform   | Minimum Version |
| ---------- | --------------- |
| NativePHP  | ^3.2.1          |
| iOS        | 16.0+           |
| Android    | API 26+         |

## Scheduling API

```php
Schedule::command('your:command')
    ->onAnyNetwork()
    ->whileCharging()
    ->whenBatteryNotLow()
    ->whenStorageNotLow()
    ->whenIdle()
    ->longRunning();
```

Trigger immediately with `BackgroundTasks::runNow()`.
