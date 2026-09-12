---
name: "Social Auth"
author: "CodingwithRK"
price: "Free"
version: "1.0.0"
license: "MIT"
github: "https://github.com/codingwithrk/nativephp-social-auth"
support: "https://github.com/codingwithrk/nativephp-social-auth/issues"
compatibility:
  nativephp: "^3.0 || ^4.0"
  php: "^8.2"
  laravel: "11 || 12"
  ios: "18.0+"
  android: "29+"
install:
  - "composer require codingwithrk/nativephp-social-auth"
  - "php artisan native:plugin:register codingwithrk/nativephp-social-auth"
---

# Social Auth

Native Apple Sign-In and Google Sign-In for NativePHP Mobile apps — using actual platform SDKs, not browser-based OAuth redirects.

## Features

- **Apple Sign-In** on iOS
- **Google Sign-In** on iOS and Android
- **Apple credential state verification** (iOS only)
- **Google sign-out** support
- **Asynchronous event-based** authentication flows
- **Server-side JWT token verification** support
- **Livewire and JavaScript** (Vue/React) integration

## Installation

```bash
composer require codingwithrk/nativephp-social-auth
php artisan native:plugin:register codingwithrk/nativephp-social-auth
```
