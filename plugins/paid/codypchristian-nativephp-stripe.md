---
name: "Native Stripe Payments"
author: "Cody P Christian"
price: "$99"
version: "0.4.0"
license: "Proprietary"
source: "https://nativephp.com/plugins/codypchristian/nativephp-stripe"
support: "https://nativephp.com/plugins/codypchristian/nativephp-stripe"
compatibility:
  nativephp: "^4.0"
  ios: "15.0+"
  android: "21+"
install:
  - "composer require codypchristian/nativephp-stripe:^0.2"
  - "php artisan native:plugin:register codypchristian/nativephp-stripe"
  - "php artisan native:install --force"
---

# Native Stripe Payments

Presents Stripe's native PaymentSheet entirely from PHP — Apple Pay, Google Pay, Link, and saved cards, all without touching Swift or Kotlin.

## Features

- **Multiple payment methods** — card entry, Link, Apple Pay (iOS), Google Pay (Android), saved cards
- **PaymentIntent & SetupIntent** — immediate charges or card storage flows
- **Fluent builder API** — chainable with `completed`, `canceled`, and `failed` callbacks
- **Stripe Connect** — direct charges on connected accounts
- **Server-side control** — client secrets created server-side; webhooks finalize orders
- **JavaScript bridge** — works with Livewire and Inertia web-view stacks

## Installation

```bash
composer require codypchristian/nativephp-stripe:^0.2
php artisan native:plugin:register codypchristian/nativephp-stripe
php artisan native:install --force
```
