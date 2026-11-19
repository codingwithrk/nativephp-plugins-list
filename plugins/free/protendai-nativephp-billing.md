---
name: "NativePHP Billing"
author: "Tendai Karuma"
price: "Free"
version: "1.1.0"
license: "MIT"
github: "https://github.com/protendai/nativephp-billing"
support: "https://nativephp.com/plugins/protendai/nativephp-billing"
compatibility:
  nativephp: "^4.0"
  ios: "15.0+"
  android: "21+"
install:
  - "composer require protendai/nativephp-billing"
  - "php artisan native:plugin:register protendai/nativephp-billing"
---

# NativePHP Billing

In-app purchases and subscriptions for NativePHP Mobile — StoreKit 2 on iOS, Google Play Billing 8 on Android — via a single facade and event API.

> **Store setup required:** Google Play needs a testing track upload and products created in Monetize with Play. App Store Connect needs the Paid Apps agreement and products created under In-App Purchases or Subscriptions.
>
> **Server-side verification:** Requires a Google Cloud service account (Android) or App Store Server API key (iOS).

## Features

- **Subscriptions** — base plans, free trials, introductory prices, upgrades and downgrades
- **One-time products** — consumable and non-consumable
- **Restore & acknowledge** — `restore()`, `acknowledge()`, `consume()`
- **Server-side verification** — purchase tokens (Android) and signed JWS transactions (iOS)
- **PHP & JavaScript** — Livewire/EDGE components and Inertia + Vue/React
- **Event-driven, non-blocking** — each call returns a request ID; results arrive as events
- **Testing** — `Native::test(...)` FakeBridge macros

## Limitations

- Promotional offers, win-back offers, offer code redemption, and the manage-subscriptions sheet are not yet supported on iOS
- External offers, user choice billing, and alternative billing are not supported
- Only one purchase sheet can be open at a time

## Installation

```bash
composer require protendai/nativephp-billing
php artisan native:plugin:register protendai/nativephp-billing
php artisan native:run
```
