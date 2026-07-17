---
name: "Push Notifications"
author: "Fatlum Gjinofci"
price: "Free"
version: "0.1.2"
license: "MIT"
github: "https://github.com/FatlumGjinofci/nativephp-push"
compatibility:
  nativephp: "^3.2"
  ios: "18.0+"
  android: "29+"
install:
  - "composer require fatlum/nativephp-push"
  - "php artisan native:plugin:register fatlum/nativephp-push"
  - "php artisan vendor:publish --tag=native-push-config"
events:
  - TokenGenerated
---

# Push Notifications

Native push notifications for NativePHP Mobile via Firebase Cloud Messaging (FCM) on Android and Apple Push Notification service (APNs) on iOS.

## Features

- Permission flow with FCM/APNs token delivery via `TokenGenerated` event
- Background data-message processing when app is backgrounded or killed
- Deep-link and data handling with badge clearing
- Free server-side sending via FCM v1 API
- Foreground message handling through live web view integration

## Installation

```bash
composer require fatlum/nativephp-push
php artisan native:plugin:register fatlum/nativephp-push
php artisan vendor:publish --tag=native-push-config
```

## Compatibility

| Platform  | Minimum Version |
| --------- | --------------- |
| NativePHP | ^3.2            |
| iOS       | 18.0+           |
| Android   | API 29+         |

## Events

- `TokenGenerated` — fired when a push token is issued; includes the device token for server-side targeting
