---
name: "In App Update"
author: "Wilson Tovar"
price: "Free"
version: "1.0.1"
license: "MIT"
github: "https://github.com/wilsonatb/in-app-update"
support: "wilsonatb@gmail.com"
compatibility:
  nativephp: "^3.0"
  ios: "not supported"
  android: "26+"
install:
  - "composer require wilsonatb/in-app-update"
  - "php artisan vendor:publish --tag=nativephp-plugins-provider"
  - "php artisan native:plugin:register wilsonatb/in-app-update"
events:
  - InAppUpdateStateChanged
  - InAppUpdateFlowCompleted
---

# In App Update

Android Google Play Core in-app updates for NativePHP Mobile — supports both flexible and immediate update flows.

> **Android only.** iOS gracefully returns a skipped response with no error.

## Features

- Flexible update flow (background download with user prompt)
- Immediate update flow (blocking fullscreen UI)
- Android-only with Google Play Core integration
- iOS-safe fallback mechanism
- PHP/Livewire and JavaScript frontend support

## Installation

```bash
composer require wilsonatb/in-app-update
php artisan vendor:publish --tag=nativephp-plugins-provider
php artisan native:plugin:register wilsonatb/in-app-update
```

## Compatibility

| Platform  | Minimum Version     |
| --------- | ------------------- |
| NativePHP | ^3.0                |
| iOS       | Not supported       |
| Android   | API 26+             |

## API

```php
checkForUpdate();
startFlexibleUpdate();
startImmediateUpdate();
completeFlexibleUpdate();
getInstallStatus();
```

## Events

- `InAppUpdateStateChanged` — lifecycle and progress updates during the update flow
- `InAppUpdateFlowCompleted` — terminal outcome (success, cancelled, failed)
