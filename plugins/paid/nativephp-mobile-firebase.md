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

Firebase push notifications via FCM for Android and APNs for iOS in NativePHP Mobile apps, with token management and background processing.

## Features

- Device registration and token lifecycle management
- Permission flow (check, request, cache tokens)
- Deep linking from notification taps to specific app routes
- Data-only silent messages triggering background PHP event processing
- Server-side sending via FCM v1 API
- Badge count management
- Ephemeral PHP runtime for background event handling
- Coexists with the local notifications plugin

## Installation

> Requires Composer credentials for the NativePHP plugin repository.

```bash
composer config repositories.nativephp-plugins composer https://plugins.nativephp.com
composer config http-basic.plugins.nativephp.com your@email.com your-license-key
composer require nativephp/mobile-firebase
```

## Compatibility

| Platform   | Minimum Version |
| ---------- | --------------- |
| NativePHP  | Any             |
| iOS        | 18.2+           |
| Android    | API 26+         |

## Events

- `TokenGenerated` — fires when a push token becomes available after enrollment
- `PushNotificationReceived` — fires for data-only messages containing an `event` key
