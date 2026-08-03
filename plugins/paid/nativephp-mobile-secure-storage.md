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

Encrypted key-value storage for sensitive data, backed by iOS Keychain Services and Android EncryptedSharedPreferences.

## Features

- iOS Keychain Services with hardware-backed encryption
- Android EncryptedSharedPreferences with AES-256-GCM + AES-256-SIV
- `set()`, `get()`, `delete()` API — simple and composable
- Works with PHP (Livewire/Blade) and JavaScript (Vue/React/Inertia)
- Ideal for auth tokens, API keys, and user secrets

## Installation

> Requires Composer credentials for the NativePHP plugin repository.

```bash
composer config repositories.nativephp-plugins composer https://plugins.nativephp.com
composer config http-basic.plugins.nativephp.com your@email.com your-license-key
php artisan vendor:publish --tag=nativephp-plugins-provider
composer require nativephp/mobile-secure-storage
php artisan native:plugin:register nativephp/mobile-secure-storage
```

## PHP Usage

```php
use NativePHP\MobileSecureStorage\Facades\SecureStorage;

// Store a value
SecureStorage::set('auth_token', $token);

// Retrieve a value (returns null if not found)
$token = SecureStorage::get('auth_token');

// Delete a value
SecureStorage::delete('auth_token');
```

## JavaScript Usage

```javascript
import { secureStorage } from '@nativephp/mobile-secure-storage';

await secureStorage.set('auth_token', token);
const token = await secureStorage.get('auth_token');
await secureStorage.delete('auth_token');
```

## Compatibility

| Platform   | Minimum Version |
| ---------- | --------------- |
| NativePHP  | ^3.0            |
| iOS        | 18.2+           |
| Android    | API 26+         |

> Data persists across app restarts and updates. It is not automatically cleared on uninstall on Android — handle logout explicitly.
