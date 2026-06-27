---
name: "Double Back to Close"
author: "CodingwithRK"
price: "Free"
version: "1.0.0"
license: "MIT"
github: "https://github.com/codingwithrk/double-back-to-close"
support: "codingwithrk@gmail.com"
compatibility:
  nativephp: "^3.0"
  ios: "18.2+"
  android: "26+"
install:
  - "composer require codingwithrk/double-back-to-close"
  - "php artisan vendor:publish --tag=nativephp-plugins-provider"
  - "php artisan native:plugin:register codingwithrk/double-back-to-close"
  - "php artisan native:plugin:register nativephp/mobile-dialog"
events:
  - DoubleBackToCloseTriggered
  - AppExiting
---

# Double Back to Close

Prompt users to press back twice before exiting the app. On the first back press a native toast is shown ("Press back again to exit"). If the user presses back again within the timeout the app exits.

> **Android only.** iOS is a no-op as it has no hardware back button.

## Features

- Double-tap back button detection with configurable timeout
- Customizable toast messages
- Native Android Toast or dialog-based notifications
- Cross-platform PHP/JavaScript API
- Event-driven architecture

## Installation

```bash
composer require codingwithrk/double-back-to-close
php artisan vendor:publish --tag=nativephp-plugins-provider
php artisan native:plugin:register codingwithrk/double-back-to-close
php artisan native:plugin:register nativephp/mobile-dialog
```

## Compatibility

| Platform  | Minimum Version |
| --------- | --------------- |
| NativePHP | ^3.0            |
| iOS       | 18.2+ (no-op)   |
| Android   | API 26+         |

## Events

- `DoubleBackToCloseTriggered` — fires on first back press
- `AppExiting` — fires on second back press before exit
