---
name: "Play Games Services"
author: "Bhargav Detroja"
price: "Free"
version: "1.1.0"
license: "MIT"
github: "https://github.com/BhargavDetroja/play-games-services"
support: "https://github.com/BhargavDetroja/play-games-services/issues"
compatibility:
  nativephp: "^3.0 || ^4.0"
  ios: "14.0+"
  android: "21+"
install:
  - "composer require bhargavdetroja/nativephp-play-games-services"
  - "php artisan native:plugin:register bhargavdetroja/nativephp-play-games-services"
  - "php artisan vendor:publish --tag=play-games-services-config"
  - "php artisan native:install --force"
---

# Play Games Services

Add Google Play Games Services — sign-in, leaderboards, and achievements — to your NativePHP Mobile Android app in minutes. No Kotlin, no Gradle edits.

> **Note:** This plugin targets Android (Google Play Games Services). iOS support is listed for compatibility but Play Games is an Android-first platform.

## Features

- **Google Play Games sign-in** — authenticate users via their Google Play account
- **Leaderboards** — submit scores and display leaderboard UI natively
- **Achievements** — unlock achievements and track progress
- **Named slot configuration** — define leaderboards and achievements by name in config
- **Auto sign-in** — configurable automatic sign-in on app launch
- **Event-driven** — PHP and JS listeners for all game service events
- **Multi-framework** — works with Livewire, React, Vue, and Alpine.js

## Installation

```bash
composer require bhargavdetroja/nativephp-play-games-services
php artisan native:plugin:register bhargavdetroja/nativephp-play-games-services
php artisan vendor:publish --tag=play-games-services-config
php artisan native:install --force
```
