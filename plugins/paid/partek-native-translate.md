---
name: "Native Translate"
author: "Paul (PARTek)"
price: "$49"
version: "1.1.1"
license: "Proprietary"
source: "https://nativephp.com/plugins/partek/native-translate"
support: "https://nativephp.com/plugins/partek/native-translate"
compatibility:
  nativephp: "^4.6.1"
  ios: "18.0+"
  android: "23+"
install:
  - "composer config repositories.nativephp-plugins composer https://plugins.nativephp.com"
  - "composer config http-basic.plugins.nativephp.com your@email.com your-license-key"
  - "php artisan vendor:publish --tag=nativephp-plugins-provider"
  - "composer require partek/native-translate"
  - "php artisan native:plugin:register partek/native-translate"
---

# Native Translate

On-device text translation for NativePHP Mobile — no cloud API, no developer-supplied credentials. Uses the OS translation models on iOS and Android.

> **iOS note:** Device only, not the Simulator. Some features require iOS 26+; the iOS 18–25 fallback has not been fully tested on a device.

## Features

- **On-device only** — no network after language models are downloaded; no API keys required
- **Single-string and batch translation** — one explicit source/target language pair per batch
- **Automatic source-language detection** — reports uncertainty instead of guessing
- **Model management** — check status, prepare (download) a language pair, delete models (Android only; iOS has no deletion API)
- **Job cancellation** — with honest reporting of platform differences
- **Async results** — delivered as Laravel events
- **PHP facade + JavaScript API** — `Translate` facade and a JS bridge for Inertia/SPA apps
- **Typed failure codes** — `MODEL_REQUIRED`, `NETWORK_UNAVAILABLE`, and more
- **Testing helpers** — facade fake for application tests; no device needed

## Installation

```bash
composer config repositories.nativephp-plugins composer https://plugins.nativephp.com
composer config http-basic.plugins.nativephp.com your@email.com your-license-key
php artisan vendor:publish --tag=nativephp-plugins-provider
composer require partek/native-translate
php artisan native:plugin:register partek/native-translate
php artisan native:run
```

> **Vite alias required:** Add an alias for the plugin's JavaScript in your `vite.config.js`, as NativePHP does not alias it automatically.
