---
name: "Share Sheet"
author: "Molly Klein (The Firsthand Co.)"
price: "$49"
version: "1.0.2"
license: "Proprietary"
source: "https://nativephp.com/plugins/firsthand/nativephp-share-sheet"
support: "https://nativephp.com/plugins/firsthand/nativephp-share-sheet"
compatibility:
  nativephp: "^4.0"
  php: "^8.3"
  laravel: "^11|^12|^13"
  ios: "18.0+"
  android: "29+"
install:
  - "composer config repositories.nativephp-plugins composer https://plugins.nativephp.com"
  - "composer config http-basic.plugins.nativephp.com your@email.com your-license-key"
  - "php artisan vendor:publish --tag=nativephp-plugins-provider"
  - "composer require firsthand/nativephp-share-sheet"
  - "php artisan native:plugin:register firsthand/nativephp-share-sheet"
---

# Share Sheet

Receive links, text, photos, and files shared into your app from the iOS and Android share sheets — a real iOS Share Extension with no Swift required.

> **iOS App Group required:** Register an App Group matching your app ID in Apple's developer portal and assign it to both your app and the share extension. A paid Apple Developer account is needed. Run `php artisan share-sheet:doctor` to check your setup.

## Features

- **Receives links, text, photos, and files** from the OS share sheet on both platforms
- **Real iOS Share Extension** — users share directly from any app; no Shortcuts workaround
- **Single PHP API** — `ShareSheet::pending()` collects items when the user returns to your app
- **JavaScript API** — `pending()` for Inertia/Vue/React apps
- **HEIC → JPEG** — iPhone HEIC photos are converted to JPEG by default
- **Confirmation UI** — shown over the sharing app before the user returns to yours
- **Content persisted on device** until your code acts on it
- **`share-sheet:doctor`** — diagnoses setup issues (iOS App Group, entitlements, etc.)
- **Facade fake** — test share handling without a device
- **Frontend support** — Livewire 3/4, Inertia + Vue, Inertia + React

## Installation

```bash
composer config repositories.nativephp-plugins composer https://plugins.nativephp.com
composer config http-basic.plugins.nativephp.com your@email.com your-license-key
php artisan vendor:publish --tag=nativephp-plugins-provider
composer require firsthand/nativephp-share-sheet
php artisan native:plugin:register firsthand/nativephp-share-sheet
php artisan native:run
```

### Inertia / SPA JavaScript

```bash
npm install ./vendor/firsthand/nativephp-share-sheet
```

### Support

Email: support@thefirsthandco.com
