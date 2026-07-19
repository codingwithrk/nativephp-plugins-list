---
name: "Mobile Vibe"
author: "Bifrost Technology"
price: "Free"
version: "1.0.1"
license: "MIT"
github: "https://github.com/NativePHP/mobile-vibe"
support: "https://nativephp.com/support"
compatibility:
  nativephp: "^3.0 || ^4.0"
  php: "^8.3"
  ios: "15.0+"
  android: "26+"
install:
  - "composer require nativephp/mobile-vibe"
  - "php artisan native:plugin:register nativephp/mobile-vibe"
---

# Mobile Vibe

Native WebSocket client for NativePHP Mobile — delivers live server events over the Pusher protocol, compatible with Laravel Reverb, Vask, or Pusher.

## Features

- Public, private, and presence channel subscriptions
- Whisper support for client-to-client ephemeral events
- Connection lifecycle management (reconnect, disconnect, error handling)
- Attribute-based listener registration via `#[OnEcho]`
- Automatic subscription cleanup on component unmount
- Channel reference counting for multi-component scenarios

## Installation

```bash
composer require nativephp/mobile-vibe
php artisan native:plugin:register nativephp/mobile-vibe
```

## Compatibility

| Platform  | Minimum Version                        |
| --------- | -------------------------------------- |
| NativePHP | ^3.0 \|\| ^4.0                         |
| PHP       | ^8.3                                   |
| iOS       | 15.0+                                  |
| Android   | API 26+                                |

> Works with Laravel Reverb, Vask, or Pusher as the WebSocket backend.
