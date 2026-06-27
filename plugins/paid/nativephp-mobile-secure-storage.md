---
name: "NativePHP Mobile Secure Storage"
author: "Bifrost Technology"
price: "$49"
version: "1.0.1"
license: "Proprietary"
source: "https://nativephp.com/plugins/nativephp/mobile-secure-storage"
support: "support@nativephp.com"
compatibility:
  nativephp: "^3.0"
  ios: "18.2+"
  android: "26+"
install:
  - "composer require nativephp/mobile-secure-storage"
---

# NativePHP Mobile Secure Storage

Encrypted key-value storage using iOS Keychain and Android EncryptedSharedPreferences.

## Features

- Encrypted storage for sensitive data (tokens, credentials, secrets)
- iOS Keychain Services with hardware-backed encryption
- Android EncryptedSharedPreferences with AES-256-GCM encryption
- Three core methods: `set()`, `get()`, `delete()`
- Works with PHP (Livewire/Blade) and JavaScript (Vue/React/Inertia)

## Installation

> Requires Composer credentials for the NativePHP plugin repository.

```bash
composer config repositories.nativephp-plugins composer https://plugins.nativephp.com
composer config http-basic.plugins.nativephp.com your@email.com your-license-key
composer require nativephp/mobile-secure-storage
```

## Compatibility

| Platform   | Minimum Version |
| ---------- | --------------- |
| NativePHP  | ^3.0            |
| iOS        | 18.2+           |
| Android    | API 26+         |
