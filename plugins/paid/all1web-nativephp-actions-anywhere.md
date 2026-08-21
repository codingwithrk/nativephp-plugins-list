---
name: "Actions Anywhere"
author: "Neo Nos"
price: "$29"
version: "0.4.0"
license: "Proprietary"
source: "https://nativephp.com/plugins/all1web/nativephp-actions-anywhere"
support: "https://github.com/all1web/nativephp-actions-anywhere/issues"
compatibility:
  nativephp: "^3.0 || ^4.0"
  ios: "18.2+"
  android: "26+"
install:
  - "composer config repositories.nativephp-plugins composer https://plugins.nativephp.com"
  - "composer config http-basic.plugins.nativephp.com your@email.com your-license-key"
  - "composer require all1web/nativephp-actions-anywhere"
  - "php artisan native:plugin:register all1web/nativephp-actions-anywhere"
  - "php artisan vendor:publish --tag=appintents-config"
---

# Actions Anywhere

Converts a single Laravel configuration into native integrations across iOS and Android — Siri voice phrases, Spotlight results, Shortcuts automation blocks, and Android Quick Settings tiles — all without writing Swift or Kotlin.

## Features

- **Siri voice integration** — users activate app actions by speaking configured phrases
- **Spotlight search** — actions appear as searchable, tappable results
- **Shortcuts app** — actions function as automation building blocks on iOS
- **Android Quick Settings tiles** — up to 6 tiles placed directly in the notification shade
- **Deep linking** — every action generates a URL for NFC stickers and QR codes
- **Background & foreground modes** — choose whether actions launch the app or run silently
- **Testing utilities** — `AppIntents::fake()` for device-free unit testing
- **Diagnostics** — `php artisan appintents:doctor` validates your configuration
- **Zero permissions** — no runtime permissions or entitlements required

## Installation

```bash
composer config repositories.nativephp-plugins composer https://plugins.nativephp.com
composer config http-basic.plugins.nativephp.com your@email.com your-license-key
composer require all1web/nativephp-actions-anywhere
php artisan native:plugin:register all1web/nativephp-actions-anywhere
php artisan vendor:publish --tag=appintents-config
```

## Diagnostics

```bash
php artisan appintents:doctor
```
