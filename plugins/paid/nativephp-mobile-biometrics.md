---
name: "NativePHP Mobile Biometrics"
author: "Bifrost Technology"
price: "$49"
version: "1.0.2"
license: "Proprietary"
source: "https://nativephp.com/plugins/nativephp/mobile-biometrics"
support: "support@nativephp.com"
compatibility:
  nativephp: "^3.0"
  ios: "18.2+"
  android: "26+"
install:
  - "composer require nativephp/mobile-biometrics"
events:
  - BiometricCompleted
---

# NativePHP Mobile Biometrics

Biometric authentication for NativePHP Mobile — Face ID, Touch ID on iOS; fingerprint and facial unlock on Android.

## Features

- Face ID and Touch ID support (iOS)
- Fingerprint and facial unlock (Android)
- System authentication fallback
- JavaScript/Vue/React/Inertia integration
- PHP/Livewire/Blade support
- Event-driven authentication callbacks

## Installation

> Requires Composer credentials for the NativePHP plugin repository.

```bash
composer config repositories.nativephp-plugins composer https://plugins.nativephp.com
composer config http-basic.plugins.nativephp.com your@email.com your-license-key
composer require nativephp/mobile-biometrics
```

## Compatibility

| Platform   | Minimum Version |
| ---------- | --------------- |
| NativePHP  | ^3.0            |
| iOS        | 18.2+           |
| Android    | API 26+         |

## Events

- `BiometricCompleted` — fires on authentication success or failure, with result status
