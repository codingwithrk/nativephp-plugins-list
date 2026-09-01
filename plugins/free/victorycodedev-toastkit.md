---
name: "ToastKit"
author: "Efekpogua Victory"
price: "Free"
version: "1.3.0"
license: "MIT"
github: "https://github.com/victorycodedev/toastkit"
support: "https://github.com/victorycodedev/toastkit/issues"
compatibility:
  nativephp: "^4.1"
  php: "^8.4"
  ios: "18.0+"
  android: "29+"
install:
  - "composer require victorycodedev/toastkit"
  - "php artisan vendor:publish --tag=nativephp-plugins-provider"
  - "php artisan native:plugin:register victorycodedev/toastkit"
---

# ToastKit

Rich, customizable native toast notifications for NativePHP Mobile — rendered as native overlays using Jetpack Compose (Android) and SwiftUI (iOS).

## Features

- **5 toast variants** — success, error, warning, info, neutral
- **Customizable styling** — colors, corner radius, padding, shadows
- **Rich content** — title, message, icons with platform-specific overrides
- **Native action buttons** with event handling
- **Queue and stack display strategies**
- **Live updates** — modify a toast without recreating it
- **Swipe-to-dismiss** and close controls
- **JavaScript API** for Inertia, Vue, and React
- **Testing macros** for assertion-based validation

## Installation

```bash
composer require victorycodedev/toastkit
php artisan vendor:publish --tag=nativephp-plugins-provider
php artisan native:plugin:register victorycodedev/toastkit
```

## Usage

```php
use Victorycodedev\Toastkit\Facades\Toast;

Toast::success('Saved!', 'Your changes have been saved.');
Toast::error('Failed', 'Something went wrong.');
Toast::warning('Heads up', 'This action cannot be undone.');
Toast::info('Update available', 'A new version is ready.');
```

## Events

```php
use Victorycodedev\Toastkit\Events\ToastShown;
use Victorycodedev\Toastkit\Events\ToastDismissed;
use Victorycodedev\Toastkit\Events\ToastActionPressed;
```
