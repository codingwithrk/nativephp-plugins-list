---
name: "NativePHP Mobile Social Auth"
author: "Ikromjon Ochilov"
price: "$29"
version: "1.0.1"
license: "Proprietary"
source: "https://nativephp.com/plugins/ikromjon/nativephp-mobile-social-auth"
support: "ikromjon1998@gmail.com"
github: "https://github.com/Ikromjon1998/nativephp-mobile-social-auth"
compatibility:
  nativephp: "^3.0"
  ios: "18.0+"
  android: "29+"
  php: "8.3+"
  laravel: "11, 12, or 13"
install:
  - "composer require ikromjon/nativephp-mobile-social-auth"
  - "php artisan native:install --force"
events:
  - AppleSignInCompleted
  - GoogleSignInCompleted
  - SignInFailed
---

# NativePHP Mobile Social Auth

Native Apple Sign-In and Google Sign-In for NativePHP mobile apps. Uses native platform SDKs — not browser-based redirects — for a seamless sign-in experience.

## Features

- Native Apple Sign-In with biometric authentication (iOS only)
- Native Google Sign-In (iOS & Android)
- JWT identity token verification
- User information retrieval (name, email, profile photo)
- Nonce/state support for replay protection
- Credential state validation (Apple)
- Livewire and JavaScript event listeners

## Installation

```bash
composer require ikromjon/nativephp-mobile-social-auth
php artisan native:install --force
```

## Compatibility

| Platform   | Requirement     |
| ---------- | --------------- |
| NativePHP  | ^3.0            |
| iOS        | 18.0+           |
| Android    | API 29+         |
| PHP        | 8.3+            |
| Laravel    | 11, 12, or 13   |

## Events

- `AppleSignInCompleted` — Apple Sign-In succeeded (iOS only)
- `GoogleSignInCompleted` — Google Sign-In succeeded
- `SignInFailed` — authentication failed
