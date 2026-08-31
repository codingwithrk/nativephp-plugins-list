---
name: "ShazamKit"
author: "thelemon2020"
price: "$29"
version: "1.0.1"
license: "Proprietary"
source: "https://nativephp.com/plugins/thelemon2020/nativephp-shazamkit"
support: "support@thelemon2020.com"
compatibility:
  nativephp: "^4.0"
  ios: "18.0+"
  android: "29+"
install:
  - "composer config repositories.nativephp-plugins composer https://plugins.nativephp.com"
  - "composer config http-basic.plugins.nativephp.com your@email.com your-license-key"
  - "composer require thelemon2020/nativephp-shazamkit"
  - "php artisan native:plugin:register thelemon2020/nativephp-shazamkit"
---

# ShazamKit

Identify songs from ambient audio using Apple's ShazamKit — on both iOS and Android — from a NativePHP Mobile app, no JavaScript required.

## Features

- **Song recognition** powered by Apple's ShazamKit catalog
- **Cross-platform** — iOS and Android support
- **Microphone integration** for ambient audio matching
- **iOS library saving** — add matched songs to the user's Shazam library
- **Event-based results** — `MatchFound`, `NoMatch`, `ListeningError`, `PermissionDenied`, `AddedToLibrary`, `LibraryError`
- **PHP/Livewire and JavaScript** (Vue/React) integration
- **Backend token resolver** for Android developer authentication

## Installation

```bash
composer config repositories.nativephp-plugins composer https://plugins.nativephp.com
composer config http-basic.plugins.nativephp.com your@email.com your-license-key
composer require thelemon2020/nativephp-shazamkit
php artisan native:plugin:register thelemon2020/nativephp-shazamkit
```
