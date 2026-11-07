---
name: "Consent"
author: "Molly Klein (The Firsthand Co.)"
price: "$29"
version: "1.0.1"
license: "Proprietary"
source: "https://nativephp.com/plugins/firsthand/nativephp-consent"
support: "https://nativephp.com/plugins/firsthand/nativephp-consent"
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
  - "composer require firsthand/nativephp-consent"
  - "php artisan native:plugin:register firsthand/nativephp-consent"
  - "php artisan vendor:publish --tag=consent-config"
---

# Consent

Google UMP consent form and Apple App Tracking Transparency prompt for NativePHP Mobile — only shown to users who need to answer (EEA, UK, Switzerland).

> **Requires:** An AdMob account with a published consent message, and AdMob app IDs configured in your environment.

## Features

- **Google UMP consent form** — shown only where legally required (EEA, UK, Switzerland); skipped elsewhere
- **Apple ATT prompt** — requested on iOS after Google's form
- **`Consent::canRequestAds()`** — tells you when ads can safely be requested
- **Re-openable privacy settings** — provides the form users can reopen, as required by EEA regulations
- **Build-time config** — adds tracking wording and AdMob app IDs to both platforms without duplicating an ID an ads plugin already added
- **PHP & JavaScript APIs** — Livewire, Blade, Vue, React, Inertia; TypeScript types included
- **Events** — `ConsentUpdated`, `TrackingAnswered`
- **Testing** — bridge-faking test helper and options to simulate the EEA
- **Ads-agnostic** — works with any ads plugin; does not load ads itself

## Installation

```bash
composer config repositories.nativephp-plugins composer https://plugins.nativephp.com
composer config http-basic.plugins.nativephp.com your@email.com your-license-key
php artisan vendor:publish --tag=nativephp-plugins-provider
composer require firsthand/nativephp-consent
php artisan native:plugin:register firsthand/nativephp-consent
php artisan vendor:publish --tag=consent-config
php artisan native:run
```
