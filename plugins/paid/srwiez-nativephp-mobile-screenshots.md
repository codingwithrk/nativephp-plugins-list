---
name: "NativePHP Mobile Screenshots"
author: "Eser Deniz"
price: "$29"
version: "1.0.2"
license: "Proprietary"
source: "https://nativephp.com/plugins/srwiez/nativephp-mobile-screenshots"
support: "https://github.com/SRWieZ/nativephp-mobile-packages"
compatibility:
  nativephp: "^3.0"
  ios: "17.0+"
  android: "26+"
install:
  - "composer require srwiez/nativephp-mobile-screenshots"
  - "php artisan vendor:publish --tag=nativephp-plugins-provider"
  - "php artisan native:plugin:register srwiez/nativephp-mobile-screenshots"
events:
  - ScreenshotDetected
  - ScreenshotCaptured
  - ScreenshotCaptureFailed
  - ScreenRecordingStarted
  - ScreenRecordingStopped
---

# NativePHP Mobile Screenshots

Screenshot and screen recording control for NativePHP Mobile — block captures, detect attempts in real-time, and take programmatic screenshots.

## Features

- Block screenshots and screen recordings (`FLAG_SECURE` on Android; privacy overlay on iOS)
- Real-time detection of screenshot/recording attempts via Laravel events
- Programmatic screenshot capture (for bug reports, audit trails)
- Screen recording start/stop detection (iOS)

## Installation

> Requires a license from nativephp.com/plugins.

```bash
composer config repositories.nativephp-plugins composer https://plugins.nativephp.com
composer config http-basic.plugins.nativephp.com your@email.com your-license-key
composer require srwiez/nativephp-mobile-screenshots
php artisan vendor:publish --tag=nativephp-plugins-provider
php artisan native:plugin:register srwiez/nativephp-mobile-screenshots
```

## PHP Usage

```php
use Srwiez\NativephpMobileScreenshots\Facades\Screenshots;

// Block all screenshot/recording attempts
Screenshots::prevent();

// Allow screenshots again
Screenshots::allow();

// Programmatically capture the screen
Screenshots::capture();

// Check current prevention state
$isBlocked = Screenshots::isPreventing();
```

## Livewire Usage

```php
use Native\Mobile\Attributes\OnNative;
use Srwiez\NativephpMobileScreenshots\Events\ScreenshotDetected;

#[OnNative(ScreenshotDetected::class)]
public function onScreenshotDetected(): void
{
    // Log the attempt, warn the user, etc.
    $this->dispatch('screenshot-detected');
}
```

## Compatibility

| Platform   | Minimum Version |
| ---------- | --------------- |
| NativePHP  | ^3.0            |
| iOS        | 17.0+           |
| Android    | API 26+         |

## Events

- `ScreenshotDetected` — user captured the screen
- `ScreenshotCaptured` — programmatic capture succeeded
- `ScreenshotCaptureFailed` — programmatic capture failed
- `ScreenRecordingStarted` *(iOS only)* — screen recording began
- `ScreenRecordingStopped` *(iOS only)* — screen recording ended
