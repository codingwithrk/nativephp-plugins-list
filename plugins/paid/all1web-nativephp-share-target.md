---
name: "Share Target"
author: "Neo Nos"
price: "$49"
version: "0.3.2"
license: "Proprietary"
source: "https://nativephp.com/plugins/all1web/nativephp-share-target"
support: "https://github.com/all1web/nativephp-share-target/issues"
compatibility:
  nativephp: "^3.0 || ^4.0"
  ios: "18.2+"
  android: "26+"
install:
  - "composer config repositories.nativephp-plugins composer https://plugins.nativephp.com"
  - "composer config http-basic.plugins.nativephp.com your@email.com your-license-key"
  - "composer require all1web/nativephp-share-target"
  - "php artisan native:plugin:register all1web/nativephp-share-target"
---

# Share Target

Enables your NativePHP app to receive incoming shares — links, text, images, videos, and PDFs — directly from the Android share sheet and iOS Shortcuts, with zero native code required.

## Features

- **Android Share Sheet integration** — app appears as a share destination for links, text, images, videos, PDFs
- **PHP object reception** — shared items arrive as typed PHP objects with automatic content detection
- **Persistent storage** — undelivered shares are queued until the app opens
- **Real-time events** — instant notifications when shares arrive during active sessions
- **iOS support (Beta)** — companion Shortcut enables iOS sharing with the same PHP API
- **Silent mode** — capture shares without interrupting the user's current view
- **Testing support** — built-in `ShareTarget::fake()` with fluent builders and assertions
- **Native confirmation** — "Saved ✓" card appears in the originating app (Android)
- **Diagnostic tool** — `php artisan share-target:doctor` verifies setup and flags issues
- **Full JS API** — works with Inertia, Vue, React, and vanilla JavaScript

## Installation

```bash
composer config repositories.nativephp-plugins composer https://plugins.nativephp.com
composer config http-basic.plugins.nativephp.com your@email.com your-license-key
composer require all1web/nativephp-share-target
php artisan native:plugin:register all1web/nativephp-share-target
php artisan native:install android --force
```

## Diagnostics

```bash
php artisan share-target:doctor
```

## Notes

- Pairs well with `nativephp/mobile-share` for outbound sharing
- No runtime permissions needed on either platform
