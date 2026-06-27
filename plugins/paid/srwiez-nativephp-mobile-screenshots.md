---
name: "NativePHP Mobile Screenshots"
author: "Eser Deniz"
price: "$29"
version: "1.0.2"
license: "Proprietary"
source: "https://nativephp.com/plugins/srwiez/nativephp-mobile-screenshots"
support: "https://github.com/SRWieZ/nativephp-mobile-packages"
compatibility:
  nativephp: "^3.0"
  ios: "17.0+"
  android: "26+"
install:
  - "composer require srwiez/nativephp-mobile-screenshots"
  - "php artisan vendor:publish --tag=nativephp-plugins-provider"
  - "php artisan native:plugin:register srwiez/nativephp-mobile-screenshots"
events:
  - ScreenshotDetected
  - ScreenshotCaptured
  - ScreenshotCaptureFailed
  - ScreenRecordingStarted
  - ScreenRecordingStopped
---

# NativePHP Mobile Screenshots

A NativePHP plugin for capturing and controlling screenshots on mobile devices.

## Features

- Block screenshots and screen recordings (`FLAG_SECURE` on Android; privacy overlay on iOS)
- Real-time detection of capture attempts via Laravel events
- Programmatic screenshot capture for bug reports and audit trails
- Platform-native implementations for iOS 17+ and Android 8+

## Installation

```bash
composer require srwiez/nativephp-mobile-screenshots
php artisan vendor:publish --tag=nativephp-plugins-provider
php artisan native:plugin:register srwiez/nativephp-mobile-screenshots
```

## Compatibility

| Platform   | Minimum Version |
| ---------- | --------------- |
| NativePHP  | ^3.0            |
| iOS        | 17.0+           |
| Android    | API 26+         |

## Events

- `ScreenshotDetected` — fires when user captures the screen
- `ScreenshotCaptured` — fires on successful programmatic capture
- `ScreenshotCaptureFailed` — fires when programmatic capture fails
- `ScreenRecordingStarted` *(iOS only)* — fires when screen recording begins
- `ScreenRecordingStopped` *(iOS only)* — fires when screen recording ends
