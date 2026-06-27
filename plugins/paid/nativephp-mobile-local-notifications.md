---
name: "NativePHP Mobile Local Notifications"
author: "Bifrost Technology"
price: "$99"
version: "0.0.2"
license: "Proprietary"
source: "https://nativephp.com/plugins/nativephp/mobile-local-notifications"
support: "support@nativephp.com"
compatibility:
  nativephp: "^3.2.1"
  ios: "16.0+"
  android: "26+"
install:
  - "composer require nativephp/mobile-local-notifications"
events:
  - NotificationTapped
  - PermissionGranted
---

# NativePHP Mobile Local Notifications

Send, schedule, and manage local notifications in NativePHP Mobile apps. Supports immediate and delayed notifications, recurring schedules, action buttons, tap events with URL navigation, custom sounds, badge counts, and silent delivery.

## Features

- Immediate and delayed notifications
- Recurring schedules (hourly, daily, weekly, monthly, yearly)
- Up to 3 action buttons per notification
- Custom sound support (.mp3, .wav, .caf, .aiff, .m4a)
- Badge count management
- Silent delivery mode
- URL navigation on tap
- Custom data payloads
- Laravel Notification Channel integration

## Installation

> Requires Composer credentials for the NativePHP plugin repository.

```bash
composer config repositories.nativephp-plugins composer https://plugins.nativephp.com
composer config http-basic.plugins.nativephp.com your@email.com your-license-key
composer require nativephp/mobile-local-notifications
```

## Compatibility

| Platform   | Minimum Version |
| ---------- | --------------- |
| NativePHP  | ^3.2.1          |
| iOS        | 16.0+           |
| Android    | API 26+         |

## Events

- `NotificationTapped` — fires when the user interacts with a notification
- `PermissionGranted` — fires when notification permission result is returned
