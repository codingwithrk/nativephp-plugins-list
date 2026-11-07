---
name: "Accessibility"
author: "Paul (PARTek)"
price: "$99"
version: "1.0.1"
license: "Proprietary"
source: "https://nativephp.com/plugins/partek/accessibility"
support: "https://nativephp.com/plugins/partek/accessibility"
compatibility:
  nativephp: "^4.6.1"
  php: "^8.2"
  laravel: "^10|^11|^12|^13"
  ios: "18.0+"
  android: "26+"
install:
  - "composer config repositories.nativephp-plugins composer https://plugins.nativephp.com"
  - "composer config http-basic.plugins.nativephp.com your@email.com your-license-key"
  - "php artisan vendor:publish --tag=nativephp-plugins-provider"
  - "composer require partek/accessibility"
  - "php artisan native:plugin:register partek/accessibility"
---

# Accessibility

Screen-reader support, accessibility setting detection, focus management, and a dev-time audit overlay for NativePHP Mobile — VoiceOver on iOS, TalkBack on Android.

> No Android permissions, Gradle dependencies, Info.plist keys, entitlements, or Apple developer portal changes required.

## Features

- **Screen-reader announcements** — polite and assertive priority via VoiceOver (iOS) and TalkBack (Android); language option on iOS only
- **Accessibility settings detection** — screen reader, reduce motion, bold text, contrast, reduce transparency, invert colors, text scale; reports supported / best-effort / unsupported per value
- **`AccessibilitySettingsChanged` event** — fires when an OS setting changes while observing
- **Focus management** — move focus to the WebView; set focus to page heading after Livewire, Inertia, or history navigation
- **Focus trap** — locks focus inside modals and bottom sheets, makes background inert
- **JavaScript module** — `announce()`, settings-to-CSS mapping, Alpine.js plugin
- **Dev-time audit overlay** — 16 rules, shown in-app when `APP_DEBUG=true`; does not certify WCAG or legal compliance
- **PHP API** — `Accessibility` facade, Blade components, typed settings DTO, `Accessibility::fake()` for testing
- **Privacy** — `ACCESSIBILITY_SETTINGS_REPORTING=false` disables settings reporting; no data is transmitted

## Installation

```bash
composer config repositories.nativephp-plugins composer https://plugins.nativephp.com
composer config http-basic.plugins.nativephp.com your@email.com your-license-key
php artisan vendor:publish --tag=nativephp-plugins-provider
composer require partek/accessibility
php artisan native:plugin:register partek/accessibility
php artisan native:run
```
