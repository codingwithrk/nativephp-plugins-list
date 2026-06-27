---
name: "In App Reviews"
author: "Wilson Tovar"
price: "Free"
version: "1.0.4"
license: "MIT"
github: "https://github.com/wilsonatb/nativephp-in-app-reviews"
support: "wilsonatb@gmail.com"
compatibility:
  nativephp: "^3.0"
  ios: "16.0+"
  android: "26+"
install:
  - "composer require wilsonatb/nativephp-in-app-reviews"
  - "php artisan native:plugin:register wilsonatb/nativephp-in-app-reviews"
---

# In App Reviews

Request app reviews on Android (Google Play) and iOS (App Store) through native system dialogs — no external browser or redirect needed.

## Features

- Native review flow for both platforms
- Facade-based PHP API
- JavaScript/Vue/React component support
- Livewire v3 and v4 compatibility
- No additional permissions required
- Returns status information on request

## Installation

```bash
composer require wilsonatb/nativephp-in-app-reviews
php artisan native:plugin:register wilsonatb/nativephp-in-app-reviews
```

## Compatibility

| Platform  | Minimum Version |
| --------- | --------------- |
| NativePHP | ^3.0            |
| iOS       | 16.0+           |
| Android   | API 26+         |
