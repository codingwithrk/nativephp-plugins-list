---
name: "Firebase Phone Number Verification"
author: "Tarik Manoar"
price: "Free"
version: "latest"
license: "MIT"
github: "https://github.com/tarikmanoar/firebase-pnv"
compatibility:
  nativephp: "^2.6 || ^3.0"
  php: "^8.3"
  laravel: "10 | 11 | 12 | 13"
  android: "any"
install:
  - "composer require tarikmanoar/firebase-pnv"
  - "php artisan native:plugin:register tarikmanoar/firebase-pnv"
events:
  - Verified
  - VerificationFailed
---

# Firebase Phone Number Verification

NativePHP Mobile plugin wrapping the official Firebase Phone Number Verification (PNV) Android SDK. Verify a device's phone number with a single tap — the number is read from the SIM via the carrier network through Android Credential Manager. No SMS code required.

> **Platform:** Android only. On iOS, bridge functions return an `UNSUPPORTED_PLATFORM` error for graceful degradation.

## How It Works

```
PHP                        Android (Kotlin)                Firebase / Credential Manager
──────────────────────     ──────────────────────────      ─────────────────────────────
FirebasePNV::verify()  ──► GetVerifiedPhoneNumber        ──► Credential Manager (1 tap)
                             .execute()                   ──► Firebase PNV backend
                           dispatchEvent(Verified)
event(new Verified(...)) ◄─ POST /_native/api/events
```

## Installation

```bash
composer require tarikmanoar/firebase-pnv
php artisan native:plugin:register tarikmanoar/firebase-pnv
```

## Usage

```php
use Manoar\FirebasePnv\Facades\FirebasePNV;

// Start verification — result arrives via the Verified event
FirebasePNV::verify();
```

```php
// In a Livewire component
use Manoar\FirebasePnv\Events\Verified;
use Native\Mobile\Attributes\OnNative;

#[OnNative(Verified::class)]
public function onVerified($data)
{
    $phoneNumber = $data['phoneNumber'];
    $token       = $data['token'];
}
```

## Events

- `Verified` — phone number verified successfully; includes `phoneNumber`, `token`, and `id`
- `VerificationFailed` — verification failed; includes error details
