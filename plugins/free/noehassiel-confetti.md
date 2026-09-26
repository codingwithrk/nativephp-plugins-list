---
name: "Confetti Celebration"
author: "noehassiel"
price: "Free"
version: "1.0.1"
license: "Proprietary"
github: "https://github.com/noehassiel/nativephp-confetti"
support: "hello@noehassiel.com"
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

Native confetti particle animations for NativePHP Mobile — Konfetti (Jetpack Compose) on Android, a SwiftUI particle system on iOS. Layers over live UI without blocking touches.

## Features

- **`<native:confetti>`** SuperNative EDGE component — place last inside a `<native:stack>` to overlay other content
- **6 presets** — `burst`, `rain`, `cannon`, `explode`, `festive`, `corners` (`corners` fires two cannons from bottom corners angling inward)
- **`Confetti::burst(?$ref)`** — trigger from any PHP context (service class, queued job, action bar)
- **`fire-token`** attribute — increment any integer to fire a burst; useful in Livewire/Blade flows
- **Fully customizable** — colors (Tailwind names, hex, CSS), particle count, duration, angle, spread, speed, damping, position, fade-out
- **Non-interactive** — particles never intercept touches on underlying UI
- **Zero idle cost** — no animation loop runs until `fire-token` first changes after mount
- **`_finished` callback** — fires once every particle from the burst has died
- **`ConfettiBurstFailed` event** — fires when `Confetti::burst($ref)` finds no mounted matching element
- **JS API** — `import { burst, Events } from 'noehassiel-confetti'` for Inertia/SPA apps

## Installation

```bash
composer require noehassiel/confetti
php artisan vendor:publish --tag=nativephp-plugins-provider
php artisan native:plugin:register noehassiel/confetti
php artisan native:run
```
