---
name: "Push Notifications"
author: "guppylab"
price: "Free"
version: "2.1.0"
license: "MIT"
github: "https://github.com/guppylab/plugin-push"
support: "https://github.com/guppylab/plugin-push/issues"
compatibility:
  nativephp: "^3.0"
  ios: "15.0+"
  android: "21+"
install:
  - "composer require guppylab/plugin-push"
  - "php artisan native:plugin:register guppylab/plugin-push"
  - "php artisan vendor:publish --tag=push-config"
---

# Push Notifications

Push notifications for NativePHP Mobile — direct APNs (`.p8` key, no Firebase SDK) on iOS and Firebase Cloud Messaging on Android.

## Features

- **iOS** — direct APNs via `.p8` key, no Firebase dependency
- **Android** — FCM with `google-services.json`
- **`MessageReceived`** event — fires for foreground and silent/data-only pushes
- **`NotificationTapped`** event — fires on tap including cold-start taps
- **`TokenGenerated`** event — device token registration
- **`Push::unenroll()`** — delete token and stop receiving pushes
- **`Push::setBadge(n)` / `Push::clearBadge()`** — iOS badge count control
- **`Push::isSupported()`** — detect simulator or missing `google-services.json`
- **Permission states** — `granted`, `denied`, `not_determined`, `provisional`, `ephemeral`
- **Provisional permission** support on iOS
- **JavaScript API** with TypeScript definitions for Livewire v3/v4 and Inertia (Vue/React)

## Installation

```bash
composer require guppylab/plugin-push
php artisan native:plugin:register guppylab/plugin-push
php artisan vendor:publish --tag=push-config
```
