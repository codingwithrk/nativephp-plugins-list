---
name: "Firebase Phone Number Verification"
author: "Tarik Manoar"
price: "Free"
version: "1.0.3"
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

A [NativePHP Mobile](https://nativephp.com/docs/mobile) plugin that wraps the
official **Firebase Phone Number Verification (PNV)** Android SDK
(`com.google.firebase:firebase-pnv`). It lets a Laravel/NativePHP app verify the
device's phone number with a **single tap** — the number is read from the SIM via
the carrier network through the Android **Credential Manager**, with **no SMS
code** to receive or type.

```php
use Manoar\FirebasePnv\Facades\FirebasePNV;

// Start verification — the result arrives via the Verified event.
FirebasePNV::verify();
```

> **Platform support:** Firebase PNV is an **Android-only** product. On iOS the
> bridge functions return an `UNSUPPORTED_PLATFORM` error so your code degrades
> gracefully.

---

## How it works

```
PHP                         Native (Android, Kotlin)                 Firebase / Android
──────────────────────      ───────────────────────────────────     ──────────────────────
FirebasePNV::verify()
  └─ nativephp_call(         FirebasePnvFunctions
       'FirebasePnv            .GetVerifiedPhoneNumber.execute()
        .GetVerifiedPhoneNumber') ─► FirebasePhoneNumberVerification
                                       .getInstance()
                                       .getVerifiedPhoneNumber(activity) ─► Credential Manager
                                                                            (user consent, 1 tap)
                                                                       ─► Firebase PNV backend
                                     Task.addOnSuccessListener { result }
                                       └─ NativeActionCoordinator
                                            .dispatchEvent(
                                              activity,
                                              'Manoar\FirebasePnv\Events\Verified',
                                              { phoneNumber, token, id })
   POST /_native/api/events ◄──────────  (runs JS in the WebView)
   event(new Verified(...)) 
   └─ your listener fires
```

The asynchronous result (objective: *handle the Credential Manager callback back
to the PHP layer*) is delivered by firing a **Laravel event**. The Kotlin payload
keys map 1:1 to the event class's constructor arguments
(`new Verified(...$payload)`).

---

## Requirements

- A working **NativePHP Mobile** app (`nativephp/mobile`) targeting **Android**.
- PHP **8.3+**, Laravel 10/11/12.
- A **Firebase project** with Phone Number Verification enabled, and the standard
  [Firebase Android setup](https://firebase.google.com/docs/android/setup):
  `google-services.json` in the app module and the **google-services Gradle
  plugin** applied (see [Android setup](#android-setup-google-services)).

---

## Installation

```bash
# 1. Require the plugin (use a path repo during local development)
composer require tarikmanoar/firebase-pnv

# 2. Register it with NativePHP (adds the provider to NativeServiceProvider)
php artisan native:plugin:register tarikmanoar/firebase-pnv

# 3. (optional) publish the config
php artisan vendor:publish --tag=firebase-pnv-config

# 4. Rebuild the native app so the Kotlin + Gradle deps are injected
php artisan native:run
```

> **Local development:** add a path repository to your app's `composer.json`
> before requiring it:
> ```json
> "repositories": [
>     { "type": "path", "url": "../Packages/PNV-Plugin" }
> ]
> ```

### Android setup (google-services)

NativePHP injects the `firebase-pnv` dependency automatically (declared in
[`nativephp.json`](nativephp.json)). The one thing it **cannot** do for you is wire
up Firebase config, so add Firebase to your Android project the normal way:

1. Create/register your Android app in the Firebase console and download
   `google-services.json`.
2. Apply the **google-services Gradle plugin** and drop `google-services.json`
   into the Android app module. See
   [`resources/android/gradle/firebase-pnv.gradle.kts`](resources/android/gradle/firebase-pnv.gradle.kts)
   for the exact snippet.

---

## Usage

### Verify a phone number

```php
use Manoar\FirebasePnv\Facades\FirebasePNV;

// Simplest form — auto-starts on the line below.
FirebasePNV::verify();

// Fluent form with a correlation id and explicit dispatch:
FirebasePNV::verify()
    ->id('checkout-42')          // correlate the result event
    ->dispatch();
```

### Check device/SIM support first

```php
FirebasePNV::supportInfo()->check();
// → fires Manoar\FirebasePnv\Events\SupportInfoRetrieved { supported, sims, id }
```

### Listen for the result

The result is **always** delivered via an event — never as the return value of
`verify()` (the native flow is asynchronous and shows UI).

**A. Plain Laravel listener** (works everywhere):

```php
use Illuminate\Support\Facades\Event;
use Manoar\FirebasePnv\Events\Verified;
use Manoar\FirebasePnv\Events\VerificationFailed;

Event::listen(Verified::class, function (Verified $e) {
    // $e->phoneNumber, $e->token, $e->id
});

Event::listen(VerificationFailed::class, function (VerificationFailed $e) {
    // $e->code, $e->message, $e->id
});
```

See [`stubs/VerifiedListener.php`](stubs/VerifiedListener.php) for a class-based example.

**B. Livewire component** with the `#[OnNative]` attribute (live UI updates) —
see [`stubs/VerifyPhoneNumber.php`](stubs/VerifyPhoneNumber.php):

```php
use Native\Mobile\Attributes\OnNative;
use Manoar\FirebasePnv\Events\Verified;

#[OnNative(Verified::class)]
public function onVerified(string $phoneNumber, string $token, ?string $id = null) { /* ... */ }
```

**C. JavaScript** (optional) — see [`resources/js/firebase-pnv.js`](resources/js/firebase-pnv.js):

```js
import FirebasePNV from './vendor/firebase-pnv';

FirebasePNV.onVerified(({ phoneNumber, token }) => { /* ... */ });
FirebasePNV.verify({ id: 'checkout-42' });
```

---

## ⚠️ Security: trust the token, not the number

`getVerifiedPhoneNumber()` returns both a `phoneNumber` (for display) and a
**signed `token`**. Treat the raw phone number as untrusted UX data. Always send
the `token` to your server and verify it (against Firebase) **before** you
associate the number with a user or grant any access.

---

## Test mode (no SIM, no billing)

Firebase PNV supports a SIM-less **test session** using a token generated in the
Firebase console — ideal for emulators and CI.

```dotenv
FIREBASE_PNV_TEST_TOKEN="paste-test-token-from-firebase-console"
```

When set, `verify()` and `supportInfo()` run in test mode automatically (via
`enableTestSession(...)`), and `getVerifiedPhoneNumber()` returns a fixed test
number. Override per call with `->test('token')`, or force production with the
env left empty.

> Test mode requires the device to be enrolled in the Google system services
> public beta program (see the Firebase docs).

---

## API reference

### `FirebasePNV` facade

| Method | Returns | Description |
|---|---|---|
| `verify()` | `PendingVerification` | Start the full verification flow. |
| `supportInfo()` | `PendingSupportInfo` | Check device/SIM capability. |

### `PendingVerification` / `PendingSupportInfo` (fluent)

| Method | Description |
|---|---|
| `->id(string)` | Correlation id echoed back in the result event. |
| `->test(?string)` | Run in test-session mode (defaults to the config token). |
| `->event(class)` | Override the success event class. |
| `->failureEvent(class)` | Override the failure event class. |
| `->remember()` | Flash the id into the session (`PendingVerification::lastId()`). |
| `->dispatch()` / `->check()` | Start the flow explicitly (otherwise auto on destruct). |

### Events

| Event | Payload |
|---|---|
| `Events\Verified` | `string $phoneNumber, string $token, ?string $id` |
| `Events\SupportInfoRetrieved` | `bool $supported, array $sims, ?string $id` |
| `Events\VerificationFailed` | `string $code, string $message, ?string $id` |

Failure `code` values: `SUPPORT_INFO_FAILED`, `NOT_SUPPORTED`,
`VERIFICATION_FAILED`, `UNSUPPORTED_PLATFORM`.

### Native bridge functions

| Bridge name | Android class | Firebase SDK call |
|---|---|---|
| `FirebasePnv.GetVerificationSupportInfo` | `…FirebasePnvFunctions.GetVerificationSupportInfo` | `getVerificationSupportInfo()` |
| `FirebasePnv.GetVerifiedPhoneNumber` | `…FirebasePnvFunctions.GetVerifiedPhoneNumber` | `getVerifiedPhoneNumber(activity)` |

---

## Project layout

```
.
├── composer.json                       # type: nativephp-plugin
├── nativephp.json                      # bridge functions, events, android deps
├── config/firebase-pnv.php             # test_token
├── src/
│   ├── FirebasePnvServiceProvider.php
│   ├── PhoneNumberVerification.php     # verify() / supportInfo()
│   ├── PendingVerification.php
│   ├── PendingSupportInfo.php
│   ├── Concerns/CallsNativeBridge.php  # nativephp_call() wrapper
│   ├── Facades/FirebasePNV.php
│   └── Events/{Verified,SupportInfoRetrieved,VerificationFailed}.php
├── resources/
│   ├── android/src/com/tarikmanoar/plugins/firebasepnv/FirebasePnvFunctions.kt
│   ├── android/gradle/firebase-pnv.gradle.kts
│   ├── ios/Sources/FirebasePnv/FirebasePnvFunctions.swift   # unsupported stub
│   └── js/firebase-pnv.js
└── stubs/                              # copy-paste examples for your app
```

---

## Manual integration (NativePHP Mobile v2.x)

The v3 plugin loader consumes `nativephp.json` automatically. If you are on a
v2.x runtime (no plugin auto-loader), wire the native side in manually:

1. Publish the native sources: `php artisan vendor:publish --tag=firebase-pnv-native`.
2. Copy
   [`FirebasePnvFunctions.kt`](resources/android/src/com/tarikmanoar/plugins/firebasepnv/FirebasePnvFunctions.kt)
   into your Android project under its package directory.
3. Register the two functions in `BridgeFunctionRegistration.kt`:
   ```kotlin
   registry.register("FirebasePnv.GetVerificationSupportInfo",
       FirebasePnvFunctions.GetVerificationSupportInfo(activity))
   registry.register("FirebasePnv.GetVerifiedPhoneNumber",
       FirebasePnvFunctions.GetVerifiedPhoneNumber(activity))
   ```
4. Add the Gradle dependency and google-services plugin (see the Gradle reference).

---

## Support

- 🐛 **Bugs & feature requests:** [GitHub Issues](https://github.com/tarikmanoar/firebase-pnv/issues)
- 💬 **Questions:** start a [discussion](https://github.com/tarikmanoar/firebase-pnv/discussions) or email **tarikmanoar@gmail.com**

---
