---
name: "Passkeys"
author: "Paul (PARTek)"
price: "$99"
version: "1.1.2"
license: "Proprietary"
source: "https://nativephp.com/plugins/partek/passkeys"
support: "https://nativephp.com/plugins/partek/passkeys"
compatibility:
  nativephp: "^4.0"
  ios: "18.0+"
  android: "26+"
install:
  - "composer config repositories.nativephp-plugins composer https://plugins.nativephp.com"
  - "composer config http-basic.plugins.nativephp.com your@email.com your-license-key"
  - "php artisan vendor:publish --tag=nativephp-plugins-provider"
  - "composer require partek/passkeys"
  - "php artisan native:plugin:register partek/passkeys"
  - "php artisan vendor:publish --tag=passkeys-config"
---

# Passkeys

End-to-end FIDO2/WebAuthn passkeys for NativePHP Mobile — native OS UI (`AuthenticationServices` on iOS, `Credential Manager` on Android) backed by a full Laravel relying-party server.

> **Note:** Apple Associated Domains (iOS) and Android Digital Asset Links must be configured manually on your domain and in Xcode/Gradle.

## Features

- **Native OS biometric UI** — Face ID / Touch ID on iOS; biometric/screen-lock on Android
- **Full Laravel RP server** — challenge generation, single-use `ChallengeStore`, cryptographic verification via `web-auth/webauthn-lib`
- **`CredentialRepository` contract** — you implement and bind it; the plugin never assumes your user model shape
- **Four ready-made routes** — registration options, registration complete, authentication options, authentication complete
- **Discoverable sign-in** — omit login hint to let the user pick a passkey from the OS sheet
- **Testing fake** — `Passkeys::fake()` with assertions for unit tests
- **JS bridge** — `create`, `createdCredential`, `authenticate`, `authenticatedAssertion`, `cancel` for Inertia/SPA apps
- **Events** — `PasskeyCreated`, `PasskeyCreationCancelled`, `PasskeyCreationFailed`

## Facade API

| Method | Purpose |
|---|---|
| `Passkeys::registrationOptions($user)` | Build WebAuthn registration options |
| `Passkeys::create($regOptions)` | Present native passkey creation UI; returns `$requestId` |
| `Passkeys::createdCredential($requestId)` | Retrieve raw credential after `PasskeyCreated` fires |
| `Passkeys::completeRegistration($user, $credential, $challengeKey)` | Verify and persist via `CredentialRepository` |
| `Passkeys::authenticationOptions(?$loginHint)` | Build WebAuthn sign-in options |
| `Passkeys::authenticate($authOptions)` | Present native passkey sign-in UI; returns `$requestId` |
| `Passkeys::authenticatedAssertion($requestId)` | Retrieve raw assertion after sign-in |
| `Passkeys::completeAuthentication($assertion, $challengeKey)` | Verify, resolve user, call `Auth::login($user)` |

## Installation

```bash
composer config repositories.nativephp-plugins composer https://plugins.nativephp.com
composer config http-basic.plugins.nativephp.com your@email.com your-license-key
php artisan vendor:publish --tag=nativephp-plugins-provider
composer require partek/passkeys
php artisan native:plugin:register partek/passkeys
php artisan vendor:publish --tag=passkeys-config
php artisan native:run
```
