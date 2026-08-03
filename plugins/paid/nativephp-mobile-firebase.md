---
name: "NativePHP Mobile Firebase"
author: "Bifrost Technology"
price: "$99"
version: "1.1.0"
license: "Proprietary"
source: "https://nativephp.com/plugins/nativephp/mobile-firebase"
support: "support@nativephp.com"
compatibility:
  nativephp: "*"
  ios: "18.2+"
  android: "26+"
install:
  - "composer require nativephp/mobile-firebase"
events:
  - TokenGenerated
  - PushNotificationReceived
---

# NativePHP Mobile Firebase

Firebase Cloud Messaging (FCM) push notifications for NativePHP Mobile — device token management, permission handling, deep linking, and silent background event processing.

## Features

- FCM device token registration and lifecycle management
- Permission checking and requesting on iOS (Android auto-grants)
- Deep linking from notification taps to app routes
- Data-only (silent) messages dispatched as Laravel events via ephemeral PHP runtime
- Server-side FCM v1 API integration helpers
- Badge count management
- Compatible with the Local Notifications plugin

## Installation

> Requires Composer credentials for the NativePHP plugin repository.

```bash
composer config repositories.nativephp-plugins composer https://plugins.nativephp.com
composer config http-basic.plugins.nativephp.com your@email.com your-license-key
php artisan vendor:publish --tag=nativephp-plugins-provider
composer require nativephp/mobile-firebase
php artisan native:plugin:register nativephp/mobile-firebase
```

## Setup

1. Create a Firebase project and add iOS and Android apps.
2. Download `google-services.json` (Android) and `GoogleService-Info.plist` (iOS) and follow the NativePHP Mobile Firebase setup guide.
3. Enroll the device to receive a push token.

## PHP Usage

```php
use NativePHP\MobileFirebase\Facades\Firebase;

// Check permission (iOS)
Firebase::checkPermission();

// Request permission (iOS) 
Firebase::requestPermission();

// Enroll device — triggers TokenGenerated event
Firebase::enroll();

// Set badge count
Firebase::setBadgeCount(3);
Firebase::clearBadge();
```

## Livewire Usage

```php
use Native\Mobile\Attributes\OnNative;
use NativePHP\MobileFirebase\Events\TokenGenerated;
use NativePHP\MobileFirebase\Events\PushNotificationReceived;

#[OnNative(TokenGenerated::class)]
public function onTokenGenerated(string $token): void
{
    // Save $token to your server for sending push notifications
}

#[OnNative(PushNotificationReceived::class)]
public function onPushReceived(string $event, array $data): void
{
    // Handle silent push data-only message
}
```

## Compatibility

| Platform   | Minimum Version |
| ---------- | --------------- |
| NativePHP  | Any             |
| iOS        | 18.2+           |
| Android    | API 26+         |

## Events

### `TokenGenerated`

Fires when a push token becomes available. Payload: `string $token`.

### `PushNotificationReceived`

Fires for data-only messages containing an `event` key. Payload: `string $event`, `array $data`.
