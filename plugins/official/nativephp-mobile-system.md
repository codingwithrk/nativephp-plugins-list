---
name: "NativePHP Mobile System"
author: "Bifrost Technology"
price: "Free"
version: "1.0.3"
license: "MIT"
github: "https://github.com/NativePHP/mobile-system"
support: "https://nativephp.com/support"
compatibility:
  nativephp: "^3.0"
  ios: "18.2+"
  android: "26+"
install:
  - "composer require nativephp/mobile-system"
---

# System Plugin for NativePHP Mobile

System-level operations for NativePHP Mobile apps.

## Overview

The System API provides access to system-level functionality like platform detection and opening the app's settings page.

## Installation

```bash
composer require nativephp/mobile-system
```

## Usage

### PHP (Livewire/Blade)

```php
use Native\Mobile\Facades\System;

// Platform detection
System::isIos();       // true on iOS
System::isAndroid();   // true on Android
System::isMobile();    // true on either platform

// Open app settings (useful when user denied permissions)
System::appSettings();

// Toggle the flashlight
System::flashlight();
```

### JavaScript (Vue/React/Inertia)

```js
import { System } from '#nativephp';

// Open app settings
await System.openAppSettings();
```

## Methods

### `isIos(): bool`

Returns `true` if the app is running on iOS.

### `isAndroid(): bool`

Returns `true` if the app is running on Android.

### `isMobile(): bool`

Returns `true` if the app is running on iOS or Android.

### `appSettings(): void`

Opens the app's settings screen in the device settings. This is useful when a user has denied a permission and you want to direct them to the settings to grant it.

### `flashlight(): void`

Toggles the device flashlight on/off.

## Use Cases

- Detect the current platform to conditionally render UI
- Direct users to grant permissions after initial denial
- Allow users to change notification preferences
