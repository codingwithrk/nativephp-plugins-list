---
name: "Mobile Media Player"
author: "Shane Rosenthal"
price: "Free"
version: "1.0.1"
license: "MIT"
github: "https://github.com/NativePHP/mobile-media-player"
support: "https://nativephp.com/support"
compatibility:
  nativephp: "^3.0 || ^4.0"
  ios: "16.0+"
  android: "26+"
install:
  - "composer require nativephp/mobile-media-player"
  - "php artisan native:plugin:register nativephp/mobile-media-player"
events:
  - PlaybackEnded
  - PlaybackError
---

# Mobile Media Player

Audio and video playback for NativePHP Mobile — shared background player, full-screen presentation, and an inline `<video-player>` element.

## Features

- Shared background audio/video playback with PHP-controlled transport (pause, resume, seek, volume)
- Full-screen native system player interface
- Inline `<video-player>` element for embedded video surfaces in native views
- `PlaybackEnded` and `PlaybackError` event callbacks
- Bridge faking and assertion helpers for testing

## Installation

```bash
composer require nativephp/mobile-media-player
php artisan native:plugin:register nativephp/mobile-media-player
```

## Compatibility

| Platform  | Minimum Version |
| --------- | --------------- |
| NativePHP | ^3.0 \|\| ^4.0  |
| iOS       | 16.0+           |
| Android   | API 26+         |

## Events

- `PlaybackEnded` — fired when media playback finishes
- `PlaybackError` — fired on playback failure; includes error details
