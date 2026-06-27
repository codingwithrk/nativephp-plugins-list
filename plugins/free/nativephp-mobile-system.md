---
name: "NativePHP Mobile System"
author: "Bifrost Technology"
price: "Free"
version: "1.0.2"
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

# NativePHP Mobile System

System-level operations for NativePHP Mobile apps — platform detection, device settings, and flashlight control.

## Features

- Platform detection (`isIos()`, `isAndroid()`, `isMobile()`)
- Open app settings interface
- Toggle device flashlight
- Permission management workflows
- PHP (Livewire/Blade) and JavaScript (Vue/React/Inertia) support

## Installation

```bash
composer require nativephp/mobile-system
```

## Compatibility

| Platform  | Minimum Version |
| --------- | --------------- |
| NativePHP | ^3.0            |
| iOS       | 18.2+           |
| Android   | API 26+         |
