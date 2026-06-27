---
name: "NativePHP Mobile Camera"
author: "Bifrost Technology"
price: "Free"
version: "1.0.3"
license: "MIT"
github: "https://github.com/NativePHP/mobile-camera"
support: "https://nativephp.com/support"
compatibility:
  nativephp: "^3.0"
  ios: "18.2+"
  android: "26+"
install:
  - "composer require nativephp/mobile-camera"
  - "php artisan native:plugin:register nativephp/mobile-camera"
events:
  - PhotoTaken
  - VideoRecorded
  - VideoCancelled
  - MediaSelected
---

# NativePHP Mobile Camera

Camera plugin for NativePHP Mobile — photo capture, video recording, and gallery picker functionality.

## Features

- Photo capture via device camera
- Video recording with optional duration limits
- Gallery/media picker (single or multiple selection)
- Fluent API support
- PHP (Livewire/Blade) and JavaScript (Vue/React/Inertia) implementations

## Installation

```bash
composer require nativephp/mobile-camera
php artisan native:plugin:register nativephp/mobile-camera
```

## Compatibility

| Platform  | Minimum Version |
| --------- | --------------- |
| NativePHP | ^3.0            |
| iOS       | 18.2+           |
| Android   | API 26+         |

## Events

- `PhotoTaken` — triggered when a photo is captured
- `VideoRecorded` — triggered on successful video completion
- `VideoCancelled` — triggered when recording is cancelled
- `MediaSelected` — triggered when gallery items are selected
