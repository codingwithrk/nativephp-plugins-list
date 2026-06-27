---
name: "No Screenshot"
author: "CodingwithRK"
price: "Free"
version: "1.0.0"
license: "MIT"
github: "https://github.com/codingwithrk/no-screenshot"
support: "codingwithrk@gmail.com"
compatibility:
  nativephp: "^3.0"
  ios: "13.0+"
  android: "21+"
  php: "8.2+"
install:
  - "composer require codingwithrk/no-screenshot"
  - "php artisan native:plugin:register codingwithrk/no-screenshot"
events:
  - ScreenshotAttempted
  - ScreenRecordingStarted
  - ScreenRecordingStopped
---

# No Screenshot

Prevent screenshots, block screen recording, and provide global app protection during app-switching for sensitive data applications.

## Features

- Block screenshots (`FLAG_SECURE` on Android), detect on iOS
- Block screen recording with black overlay on both platforms
- Detect live recording status (iOS)
- Global protection flag
- Real-time status via `ScreenProtectionStatus` DTO

## Installation

```bash
composer require codingwithrk/no-screenshot
php artisan native:plugin:register codingwithrk/no-screenshot
```

## Compatibility

| Platform  | Minimum Version |
| --------- | --------------- |
| NativePHP | ^3.0            |
| iOS       | 13.0+           |
| Android   | API 21+         |
| PHP       | 8.2+            |

## Events

- `ScreenshotAttempted` — fires when a screenshot is attempted
- `ScreenRecordingStarted` — fires when screen recording begins
- `ScreenRecordingStopped` — fires when screen recording ends
