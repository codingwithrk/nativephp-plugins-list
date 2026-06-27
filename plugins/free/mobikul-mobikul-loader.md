---
name: "Mobikul Loader"
author: "Mobikul"
price: "Free"
version: "1.0.2"
license: "MIT"
github: "https://github.com/SocialMobikul/Mobikul_Loader_Native_Php"
support: "https://store.webkul.com/support.html"
compatibility:
  nativephp: "^3.0"
  ios: "16.0+"
  android: "29+"
  php: "8.2+"
  laravel: "^10.0 | ^11.0 | ^12.0 | ^13.0"
install:
  - "composer require mobikul/mobikul_loader"
  - "php artisan native:plugin:register mobikul/mobikul_loader"
  - "php artisan native:install --force"
---

# Mobikul Loader

Loader state bridge for NativePHP Mobile with optional Blade and web view helpers.

## Features

- Two bridge methods: `MobikulLoader.Show` and `MobikulLoader.Hide`
- Optional HTML/CSS/JavaScript loader overlay for Blade-based screens
- Web view support for hybrid applications
- Loader state responses for coordinating UI behaviour

## Installation

```bash
composer require mobikul/mobikul_loader
php artisan native:plugin:register mobikul/mobikul_loader
php artisan native:install --force
```

## Compatibility

| Platform  | Minimum Version                    |
| --------- | ---------------------------------- |
| NativePHP | ^3.0                               |
| iOS       | 16.0+                              |
| Android   | API 29+                            |
| PHP       | 8.2+                               |
| Laravel   | ^10.0 \| ^11.0 \| ^12.0 \| ^13.0 |
