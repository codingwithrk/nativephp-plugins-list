---
name: "Image Cropper"
author: "Vipul Walia"
price: "Free"
version: "1.3.0"
license: "MIT"
github: "https://github.com/vipertecpro/image-cropper"
support: "https://github.com/vipertecpro/image-cropper/issues"
compatibility:
  nativephp: "^3.0 || ^4.0"
  ios: "15.0+"
  android: "26+"
install:
  - "composer require vipertecpro/image-cropper"
  - "php artisan vendor:publish --tag=nativephp-plugins-provider"
  - "php artisan native:plugin:register vipertecpro/image-cropper"
---

# Image Cropper

A fully native image cropping and editing tool for NativePHP Mobile. Built with SwiftUI (iOS) and Jetpack Compose (Android) using zero third-party native libraries.

## Features

- **Freehand cropping** with 2D drag, pinch-zoom, and two-finger rotation
- **Shape & preset options** — circle, rectangle, Profile, Square, Portrait, 16:9, Cover, Banner, Story (switchable in-app)
- **Adjustment tools** — brightness, contrast, saturation, and built-in filters
- **Configurable modes** — crop-only, adjust-only, or filter-only workflows
- **Theme-aware** — adapts to system light/dark mode automatically
- **Zero native dependencies** — no third-party libraries or special permissions required
- **Cross-platform** unified PHP API for iOS and Android

## Installation

```bash
composer require vipertecpro/image-cropper
php artisan vendor:publish --tag=nativephp-plugins-provider
php artisan native:plugin:register vipertecpro/image-cropper
```

## Usage

```php
use Vipertecpro\ImageCropper\Facades\ImageCropper;

// Open an image for cropping
ImageCropper::open('/path/to/image.jpg');

// With options
ImageCropper::open('https://example.com/photo.png', [
    'preset'  => 'square',
    'shape'   => 'circle',
    'tools'   => ['crop', 'adjust'],
    'theme'   => 'system',
]);
```

**Accepted formats:** JPG, JPEG, PNG, GIF, WebP, BMP, HEIC, HEIF, AVIF

**Input:** Local file paths or HTTP(S) URLs

## Events

```php
use Vipertecpro\ImageCropper\Events\ImageCropped;
use Vipertecpro\ImageCropper\Events\CropCancelled;

// Fired with the saved file path (and optional ID)
ImageCropped::class;

// Fired when the user dismisses the cropper
CropCancelled::class;
```
