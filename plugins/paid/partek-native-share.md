---
name: "Native Share"
author: "Paul (PARTek)"
price: "$29"
version: "1.1.0"
license: "Proprietary"
source: "https://nativephp.com/plugins/partek/native-share"
support: "https://nativephp.com/plugins/partek/native-share"
compatibility:
  nativephp: "^3.0 || ^4.0"
  ios: "15.0+"
  android: "21+"
install:
  - "composer config repositories.nativephp-plugins composer https://plugins.nativephp.com"
  - "composer config http-basic.plugins.nativephp.com your@email.com your-license-key"
  - "php artisan vendor:publish --tag=nativephp-plugins-provider"
  - "composer require partek/native-share"
  - "php artisan native:plugin:register partek/native-share"
---

# Native Share

Clipboard copy and plain-text OS share sheet for NativePHP Mobile — no permissions required on either platform.

> Complements the free `nativephp/mobile-share` plugin (which handles URLs and files). This plugin is focused on plain-text sharing and clipboard writing.

## Features

- **`NativeShare::copy($text)`** — writes plain text to the system clipboard immediately
- **`NativeShare::share($title, $text)`** — opens the native OS share sheet (Android `ACTION_SEND` / iOS `UIActivityViewController`)
- **No permissions required** on either platform
- **Testing helpers** — `assertCopied()` and `assertShared()` for NativePHP's fake bridge
- **JavaScript API** — `copy()` and `share()` functions with Vite alias
- Works with Livewire, Blade, and Inertia (Vue/React)
- Android 13+ shows system "Copied" confirmation automatically on clipboard write

## Installation

```bash
composer config repositories.nativephp-plugins composer https://plugins.nativephp.com
composer config http-basic.plugins.nativephp.com your@email.com your-license-key
php artisan vendor:publish --tag=nativephp-plugins-provider
composer require partek/native-share
php artisan native:plugin:register partek/native-share
```
