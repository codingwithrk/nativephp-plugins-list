---
name: "Mobile SFX"
author: "Kirill"
price: "Free"
version: "1.0.0"
license: "MIT"
github: "https://github.com/kirilldakhniuk/nativephp-mobile-sfx"
support: "https://github.com/kirilldakhniuk/nativephp-mobile-sfx/issues"
compatibility:
  nativephp: "^4.3"
  php: "^8.4"
  ios: "15.0+"
  android: "21+"
install:
  - "composer require stupidbrains/mobile-sfx"
  - "php artisan native:plugin:register stupidbrains/mobile-sfx"
---

# Mobile SFX

Low-latency short-sound playback for NativePHP Mobile — preload audio files, trigger them by name, and release them when done.

## Features

- **Preload** multiple audio files with `Sfx::preload()`
- **Play by name** with `Sfx::play()`
- **Unload** sounds when no longer needed with `Sfx::unload()`
- **Overlapping playback** — up to 4 simultaneous sounds on Android
- **Respects iOS silent switch** behavior
- **Format** — 16-bit PCM WAV at 44.1 kHz (mono)

## Installation

```bash
composer require stupidbrains/mobile-sfx
php artisan native:plugin:register stupidbrains/mobile-sfx
```

## Usage

```php
use Stupidbrains\MobileSfx\Facades\Sfx;

// Preload a sound file
Sfx::preload('click', 'sounds/click.wav');

// Play it
Sfx::play('click');

// Release when done
Sfx::unload('click');
```
