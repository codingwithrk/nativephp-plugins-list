---
name: "Dynamic Notifications"
author: "Shane Rosenthal"
price: "Free"
version: "0.1.1"
license: "MIT"
github: "https://github.com/NativePHP/mobile-dynamic-notifications"
support: "nativephp@gmail.com"
compatibility:
  nativephp: "^4.5.0"
  ios: "18.2+"
  android: "Not supported (iOS only)"
install:
  - "composer require nativephp/mobile-dynamic-notifications"
  - "php artisan native:plugin:register nativephp/mobile-dynamic-notifications"
---

# Dynamic Notifications

Dynamic Island-style in-app notifications for NativePHP Mobile on iOS 18.2+. Pure SwiftUI — no JavaScript animation engines, no third-party SDKs.

> **iOS only.** Android is not supported.

## Features

- **Dynamic Island-style UI** — fluid animated pill notification overlay, native SwiftUI
- **`DynamicNotifications::show($content)`** — display a notification with title, message, SF Symbol, accent color, and duration
- **`DynamicNotifications::dismiss()`** — dismiss the current notification programmatically
- **`NotificationTapped` event** — fires when the user taps the notification
- **`NotificationDismissed` event** — fires when the notification is dismissed (auto or manual)
- **Accessibility** — Reduce Motion, Dynamic Type, and VoiceOver support

## Installation

```bash
composer require nativephp/mobile-dynamic-notifications
php artisan native:plugin:register nativephp/mobile-dynamic-notifications
```

Rebuild your iOS app (`php artisan native:run ios`) to compile the SwiftUI code.
