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

Biometric authentication for NativePHP Mobile — Face ID / Touch ID on iOS; fingerprint and facial unlock on Android — with a system passcode fallback.

## Features

- Face ID and Touch ID support on iOS
- Fingerprint and facial unlock on Android
- System authentication (passcode / PIN) fallback
- Availability checking before prompting
- PHP/Livewire/Blade and JavaScript/Vue/React/Inertia support
- Event-driven authentication result callbacks

## Installation

> Requires Composer credentials for the NativePHP plugin repository.

```bash
composer config repositories.nativephp-plugins composer https://plugins.nativephp.com
composer config http-basic.plugins.nativephp.com your@email.com your-license-key
php artisan vendor:publish --tag=nativephp-plugins-provider
composer require nativephp/mobile-biometrics
php artisan native:plugin:register nativephp/mobile-biometrics
```

## PHP Usage

```php
use NativePHP\MobileBiometrics\Facades\Biometrics;

// Check availability
if (Biometrics::isAvailable()) {
    Biometrics::authenticate(
        reason: 'Confirm your identity to continue.',
        allowDeviceCredential: true,
    );
}
```

## Livewire Usage

```php
use Native\Mobile\Attributes\OnNative;
use NativePHP\MobileBiometrics\Events\BiometricCompleted;

#[OnNative(BiometricCompleted::class)]
public function onBiometricCompleted(bool $success, ?string $error): void
{
    if ($success) {
        $this->dispatch('authenticated');
    }
}
```

## JavaScript Usage

```javascript
import { biometrics } from '@nativephp/mobile-biometrics';
import { on } from '@nativephp/native';

on('BiometricCompleted', ({ success, error }) => {
    console.log(success ? 'Authenticated' : `Failed: ${error}`);
});

await biometrics.authenticate({ reason: 'Confirm your identity.' });
```

## Compatibility

| Platform   | Minimum Version |
| ---------- | --------------- |
| NativePHP  | ^3.0            |
| iOS        | 18.2+           |
| Android    | API 26+         |

## Events

### `BiometricCompleted`

Fires when the authentication dialog resolves.

| Field | Type | Description |
|-------|------|-------------|
| `success` | `bool` | `true` if authenticated |
| `error` | `string\|null` | Error reason if failed |
