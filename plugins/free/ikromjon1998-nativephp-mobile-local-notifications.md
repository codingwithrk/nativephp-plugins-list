---
name: "Mobile Local Notifications"
author: "Ikromjon Ochilov"
price: "Free"
version: "latest"
license: "MIT"
github: "https://github.com/Ikromjon1998/nativephp-mobile-local-notifications"
compatibility:
  nativephp: "^3.0"
  php: "^8.3"
  laravel: "11 | 12"
  ios: "any"
  android: "any"
install:
  - "composer require ikromjon/nativephp-mobile-local-notifications"
  - "php artisan native:plugin:register ikromjon/nativephp-mobile-local-notifications"
events:
  - NotificationScheduled
  - NotificationReceived
  - NotificationTapped
  - ActionPressed
  - PermissionGranted
  - PermissionDenied
---

# Mobile Local Notifications

Schedule, manage, and cancel local notifications in your NativePHP Mobile app — no server or Firebase required. Works completely offline.

## Features

- Schedule notifications with a delay or at a specific date/time
- Repeat intervals: minute, hourly, daily, weekly, monthly, yearly
- Custom repeat intervals (any duration ≥ 60 seconds)
- Day-of-week scheduling (e.g. every Mon/Wed/Fri at 9 AM)
- Repeat count limits (fire N times then stop)
- Rich content: images, subtitles, and expanded text
- Action buttons with text input support
- Native snooze (reschedules without opening the app)
- Custom sounds, badges, and data payloads
- Cancel individual or all notifications
- List pending notifications
- Update existing notifications
- Permission management (Android 13+, iOS)
- Laravel Notification channel support
- Survives device reboot (Android)

## Installation

```bash
composer require ikromjon/nativephp-mobile-local-notifications
php artisan native:plugin:register ikromjon/nativephp-mobile-local-notifications
```

## Usage

```php
use Ikromjon\LocalNotifications\Facades\LocalNotifications;

// Request permission (required on Android 13+ and iOS)
LocalNotifications::requestPermission();

// Schedule a notification in 10 seconds
LocalNotifications::schedule([
    'id'    => 'welcome',
    'title' => 'Hello!',
    'body'  => 'Your first local notification',
    'delay' => 10,
]);

// Cancel by ID
LocalNotifications::cancel('welcome');

// Cancel all pending
LocalNotifications::cancelAll();
```
