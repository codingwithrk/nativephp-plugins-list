---
name: "Confetti Celebration"
author: "noehassiel"
price: "Free"
version: "1.0.1"
license: "MIT"
github: "https://github.com/noehassiel/nativephp-confetti"
support: "https://github.com/noehassiel/nativephp-confetti/issues"
compatibility:
  nativephp: "^4.0"
  ios: "16.0+"
  android: "26+"
install:
  - "composer require noehassiel/confetti"
  - "php artisan vendor:publish --tag=nativephp-plugins-provider"
  - "php artisan native:plugin:register noehassiel/confetti"
---

# Confetti Celebration

Native confetti animation for NativePHP Mobile via a `<native:confetti>` EDGE element — Konfetti (Jetpack Compose) on Android and a hand-rolled SwiftUI particle system on iOS. Genuine independent particle movement that web-based alternatives cannot provide.

## Features

- **6 animation presets** — burst, rain, cannon, explode, festive, corners
- **Customizable particles** — count, duration, speed, damping, colors
- **Dual trigger modes** — reactive `fire-token` binding or `Confetti::burst()` facade
- **Multi-reference support** — multiple confetti elements per screen
- **Non-blocking rendering** — doesn't intercept underlying UI touches
- **Completion callbacks** via `_finished` attribute
- **JavaScript integration** via `noehassiel-confetti` module

## Installation

```bash
composer require noehassiel/confetti
php artisan vendor:publish --tag=nativephp-plugins-provider
php artisan native:plugin:register noehassiel/confetti
```

## Usage

```blade
<native:confetti preset="burst" />
```

```php
use Noehassiel\Confetti\Facades\Confetti;

Confetti::burst();
```
