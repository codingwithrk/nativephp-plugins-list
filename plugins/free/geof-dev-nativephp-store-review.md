---
name: "Store Review"
author: "Geof"
price: "Free"
version: "1.0.3"
license: "MIT"
github: "https://github.com/geof-dev/nativephp-store-review"
support: "geof.dev@gmail.com"
compatibility:
  nativephp: "^3.0"
  ios: "15.0+"
  android: "26+"
  php: "8.2+"
install:
  - "composer require geof-dev/nativephp-store-review"
events:
  - StoreReviewCompleted
---

# Store Review

Native in-app store review prompts for NativePHP Mobile — iOS `SKStoreReviewController` and Android Play In-App Review API.

## Features

- Native review prompts via `SKStoreReviewController` (iOS) and Play In-App Review API (Android)
- Platform availability checking
- Event dispatching on completion
- OS-level throttling respected (Apple limits ~3 times per 365 days)

## Installation

```bash
composer require geof-dev/nativephp-store-review
```

## Compatibility

| Platform  | Minimum Version |
| --------- | --------------- |
| NativePHP | ^3.0            |
| iOS       | 15.0+           |
| Android   | API 26+         |
| PHP       | 8.2+            |

## Events

- `StoreReviewCompleted` — dispatched when the native review flow finishes
