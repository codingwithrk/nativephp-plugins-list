---
name: "NativePHP Mobile Splashscreen"
author: "Israel Pereira"
price: "Free"
version: "1.3.0"
license: "MIT"
github: "https://github.com/S2BR/nativephp-mobile-splashscreen"
support: "support@s2br.dev"
compatibility:
  nativephp: "^3.0"
  ios: "18.0+"
  android: "26+"
  php: "8.2+"
install:
  - "composer require s2br/nativephp-mobile-splashscreen"
  - "php artisan vendor:publish --tag=mobile-splashscreen-config"
  - "php artisan native:plugin:register s2br/nativephp-mobile-splashscreen"
events:
  - SplashscreenCompleted
  - SplashscreenLoopCompleted
---

# NativePHP Mobile Splashscreen

A feature-rich NativePHP plugin for animated mobile splash screens with gradients, events, and flexible configuration.

## Features

- Lottie animation support with auto v2→v1 conversion
- Gradient and solid color backgrounds
- Dark mode support with system detection
- Animated exit transitions (fade, scale, slide, circle expand)
- Progress bar during app loading
- Seasonal/static scheduling via JSON
- Dynamic remote scheduling with pre-download capability
- App icon overlay
- Text-only splash option

## Installation

```bash
composer require s2br/nativephp-mobile-splashscreen
php artisan vendor:publish --tag=mobile-splashscreen-config
php artisan native:plugin:register s2br/nativephp-mobile-splashscreen
```

## Compatibility

| Platform  | Minimum Version |
| --------- | --------------- |
| NativePHP | ^3.0            |
| iOS       | 18.0+           |
| Android   | API 26+         |
| PHP       | 8.2+            |

## Events

- `SplashscreenCompleted` — fired after a single-run animation finishes
- `SplashscreenLoopCompleted` — fired after each loop iteration
