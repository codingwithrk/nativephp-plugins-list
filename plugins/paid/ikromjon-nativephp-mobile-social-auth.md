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

Native Apple Sign-In and Google Sign-In for NativePHP mobile apps. Uses native platform SDKs (not browser-based redirects) for a seamless sign-in experience.

> **App Store Requirement:** If your app offers any third-party sign-in (Google, Facebook, etc.), Apple requires you to also offer Sign in with Apple. Apps that don't comply will be rejected during App Store review. ([Apple Guideline 4.8](https://developer.apple.com/app-store/review/guidelines/#sign-in-with-apple))

## Features

- **Apple Sign-In** -- Native `ASAuthorizationController` on iOS with Face ID / Touch ID
- **Google Sign-In** -- Native Credential Manager on Android, Google Sign-In SDK on iOS
- **Identity tokens** -- JWT tokens for server-side verification
- **User info** -- Name, email, profile photo
- **Nonce support** -- Replay protection for both providers
- **Credential state** -- Check if an Apple credential is still valid
- **Events** -- Livewire `#[OnNative]` and JS event listeners

## Platform Support

| Feature | iOS | Android |
|---------|-----|---------|
| Apple Sign-In | Yes | No (Apple limitation) |
| Google Sign-In | Yes | Yes |
| Credential State Check | Yes (Apple) | No |
| Sign Out | Yes (Google) | Yes (Google) |

## Requirements

- PHP 8.3+
- Laravel 11, 12, or 13
- NativePHP Mobile 3.x
- iOS 18.0+ / Android API 29+
- Apple Developer account (for Apple Sign-In entitlement)

## Installation

```bash
composer require ikromjon/nativephp-mobile-social-auth
```

The service provider and facade are auto-discovered by Laravel.

Then rebuild your native project to include the plugin's native dependencies:

```bash
php artisan native:install --force
```

## Configuration

### 1. Google Cloud Console Setup

You need **two** OAuth client IDs from the same Google Cloud project:

**Step 1: Create a project & consent screen**
1. Go to [Google Cloud Console](https://console.cloud.google.com/)
2. Create a new project (or select existing)
3. Go to **APIs & Services > OAuth consent screen**
4. Choose **External**, fill in app name and email
5. Add scopes: `email`, `profile`
6. Add your test email under **Test users** (required while in testing mode)

**Step 2: Create an Android OAuth client**
1. Go to **Credentials > Create Credentials > OAuth client ID**
2. Application type: **Android**
3. Package name: your `NATIVEPHP_APP_ID` from `.env` (e.g. `com.yourcompany.yourapp`)
4. SHA-1 fingerprint -- get it with:
   ```bash
   cd nativephp/android && ./gradlew signingReport
   ```
5. Click **Create** (you won't use this client ID directly -- Google uses it to verify your app's signing key)

**Step 3: Create a Web OAuth client**
1. **Credentials > Create Credentials > OAuth client ID**
2. Application type: **Web application**
3. No redirect URIs needed
4. Click **Create**
5. Copy the **Client ID** -- this is your `GOOGLE_SERVER_CLIENT_ID`

**Step 4: Create an iOS OAuth client** (if targeting iOS)
1. **Credentials > Create Credentials > OAuth client ID**
2. Application type: **iOS**
3. Bundle ID: your `NATIVEPHP_APP_ID` from `.env`
4. Click **Create**
5. Copy the **Client ID** -- this is your `GOOGLE_IOS_CLIENT_ID`

> **Why three client IDs?** The Android client verifies your app's signing key. The Web client ID is used by Android Credential Manager and for backend token verification. The iOS client ID configures the Google Sign-In SDK on iOS.

**Step 5: Add credentials to your `.env`**

```env
GOOGLE_IOS_CLIENT_ID=123456789-abc.apps.googleusercontent.com
GOOGLE_SERVER_CLIENT_ID=123456789-xyz.apps.googleusercontent.com
```

The plugin reads `GOOGLE_SERVER_CLIENT_ID` from your `.env` at runtime and passes it to the native SDK automatically. No manual Android string resources needed.

### 2. Apple Sign-In Setup

The `com.apple.developer.applesignin` entitlement is automatically added by this plugin. You need to:

1. Log in to [Apple Developer Portal](https://developer.apple.com/account)
2. Go to **Certificates, Identifiers & Profiles > Identifiers**
3. Select your App ID (matching `NATIVEPHP_APP_ID`)
4. Enable **Sign in with Apple** capability
5. Save

No `.env` configuration needed for Apple -- it uses the native iOS SDK directly.

## Usage

### Important: Platform Behavior Differences

| | iOS | Android |
|---|---|---|
| **Apple Sign-In** | Returns `AuthResult` directly | Returns `null` (unsupported) |
| **Google Sign-In** | Returns `AuthResult` directly | Returns `null`; result arrives via event |

On **iOS**, bridge calls block until the user completes or cancels sign-in, then return the result.

On **Android**, Google Sign-In is asynchronous -- the call returns immediately, and the result is delivered via `GoogleSignInCompleted` or `SignInFailed` events.

**Recommended pattern:** Always use event listeners AND check the return value. This ensures your code works on both platforms:

### Livewire (Recommended)

```php
<?php

namespace App\Livewire;

use Ikromjon\NativePHP\SocialAuth\Data\AuthResult;
use Ikromjon\NativePHP\SocialAuth\Events\AppleSignInCompleted;
use Ikromjon\NativePHP\SocialAuth\Events\GoogleSignInCompleted;
use Ikromjon\NativePHP\SocialAuth\Events\SignInFailed;
use Ikromjon\NativePHP\SocialAuth\Facades\SocialAuth;
use Livewire\Component;
use Native\Mobile\Attributes\OnNative;

class LoginScreen extends Component
{
    public ?string $error = null;

    public function signInWithApple()
    {
        $rawNonce = bin2hex(random_bytes(16));
        session(['auth_nonce' => $rawNonce]);

        // iOS: returns AuthResult directly
        // Android: returns null (Apple Sign-In not available)
        $result = SocialAuth::appleSignIn(
            scopes: ['email', 'fullName'],
            nonce: hash('sha256', $rawNonce),
        );

        if ($result) {
            $this->handleSignIn($result->toArray());
        }
    }

    public function signInWithGoogle()
    {
        $nonce = bin2hex(random_bytes(16));
        session(['auth_nonce' => $nonce]);

        // iOS: returns AuthResult directly
        // Android: returns null, result comes via event below
        $result = SocialAuth::googleSignIn(nonce: $nonce);

        if ($result) {
            $this->handleSignIn($result->toArray());
        }
    }

    // Event handlers use NAMED PARAMETERS matching the event payload keys.
    // Do NOT use a single $data array — Livewire dispatches each key as a named argument.

    #[OnNative(AppleSignInCompleted::class)]
    public function onAppleSignIn(
        string $userId = '',
        ?string $identityToken = null,
        ?string $authorizationCode = null,
        ?string $email = null,
        ?string $givenName = null,
        ?string $familyName = null,
    ) {
        if (!empty($userId)) {
            $this->handleSignIn([
                'provider' => 'apple',
                'userId' => $userId,
                'identityToken' => $identityToken,
                'email' => $email,
                'givenName' => $givenName,
                'familyName' => $familyName,
            ]);
        }
    }

    #[OnNative(GoogleSignInCompleted::class)]
    public function onGoogleSignIn(
        string $userId = '',
        ?string $identityToken = null,
        ?string $email = null,
        ?string $displayName = null,
        ?string $givenName = null,
        ?string $familyName = null,
        ?string $photoUrl = null,
    ) {
        if (!empty($userId)) {
            $this->handleSignIn([
                'provider' => 'google',
                'userId' => $userId,
                'identityToken' => $identityToken,
                'email' => $email,
                'displayName' => $displayName,
                'givenName' => $givenName,
                'familyName' => $familyName,
                'photoUrl' => $photoUrl,
            ]);
        }
    }

    #[OnNative(SignInFailed::class)]
    public function onSignInFailed(
        string $provider = '',
        string $error = '',
        ?string $errorCode = null,
    ) {
        if ($errorCode !== 'CANCELED') {
            $this->error = !empty($error) ? $error : 'Sign-in failed.';
        }
    }

    private function handleSignIn(array $data)
    {
        // Verify identity token server-side, then create/find user
        // IMPORTANT: Apple only sends email/name on FIRST sign-in!
        // You must persist this data immediately.
        return $this->redirect('/dashboard');
    }

    public function render()
    {
        return view('livewire.login-screen');
    }
}
```

```blade
{{-- resources/views/livewire/login-screen.blade.php --}}
<div class="flex flex-col gap-4 p-6">
    @if($error)
        <div class="bg-red-100 text-red-700 p-3 rounded">{{ $error }}</div>
    @endif

    <button
        wire:click="signInWithApple"
        class="flex items-center justify-center gap-2 bg-black text-white rounded-lg py-3 px-6 font-medium"
    >
        Sign in with Apple
    </button>

    <button
        wire:click="signInWithGoogle"
        class="flex items-center justify-center gap-2 bg-white text-gray-700 border border-gray-300 rounded-lg py-3 px-6 font-medium"
    >
        Sign in with Google
    </button>
</div>
```

### JavaScript (Vue / React / Inertia)

```javascript
import { On } from '#nativephp';
import socialAuth from 'vendor/ikromjon/nativephp-mobile-social-auth/resources/js/social-auth';

// Generate nonce client-side
function generateNonce() {
    const array = new Uint8Array(16);
    crypto.getRandomValues(array);
    return Array.from(array, b => b.toString(16).padStart(2, '0')).join('');
}

async function sha256Hex(value) {
    const digest = await crypto.subtle.digest('SHA-256', new TextEncoder().encode(value));
    return Array.from(new Uint8Array(digest), b => b.toString(16).padStart(2, '0')).join('');
}

// Google Sign-In
async function handleGoogleSignIn() {
    const nonce = generateNonce();
    const result = await socialAuth.googleSignIn(nonce);
    // On iOS: result contains data. On Android: result is null, use event.
    if (result?.identityToken) {
        sendTokenToBackend(result.identityToken);
    }
}

// Apple Sign-In
async function handleAppleSignIn() {
    const rawNonce = generateNonce();
    // Apple expects the SHA-256 hash of the nonce -- keep rawNonce for server-side verification
    const result = await socialAuth.appleSignIn(['email', 'fullName'], await sha256Hex(rawNonce));
    if (result?.identityToken) {
        sendTokenToBackend(result.identityToken);
    }
}

// Listen for events (works on both platforms, required for Android)
On('Ikromjon\NativePHP\SocialAuth\Events\GoogleSignInCompleted', (payload) => {
    sendTokenToBackend(payload.identityToken);
});

On('Ikromjon\NativePHP\SocialAuth\Events\AppleSignInCompleted', (payload) => {
    sendTokenToBackend(payload.identityToken);
});

On('Ikromjon\NativePHP\SocialAuth\Events\SignInFailed', (payload) => {
    if (payload.errorCode !== 'CANCELED') {
        alert(`Sign-in failed: ${payload.error}`);
    }
});
```

## API Reference

### `SocialAuth::appleSignIn(array $scopes, ?string $nonce, ?string $state): ?AuthResult`

Initiates native Apple Sign-In. Returns `AuthResult` on iOS, `null` on Android.

- `$scopes` -- Requested scopes: `['email', 'fullName']` (default: both)
- `$nonce` -- SHA256-hashed nonce for replay protection
- `$state` -- Optional state string echoed back in response

> **Important:** Apple only returns `email` and `givenName`/`familyName` on the **first** sign-in. Subsequent sign-ins return only `userId` and `identityToken`. You must persist user info on first authentication.

### `SocialAuth::googleSignIn(?string $nonce): ?AuthResult`

Initiates native Google Sign-In. Returns `AuthResult` on iOS, `null` on Android (result via event).

- `$nonce` -- Optional nonce for replay protection (raw string, not hashed). Supported on both platforms: Android via Credential Manager, iOS via GoogleSignIn-iOS 9.x. The nonce comes back as the `nonce` claim inside the ID token -- verify it server-side.

### `SocialAuth::checkAppleCredentialState(string $userId): string`

Checks if an Apple credential is still valid. iOS only.

Returns: `'authorized'`, `'revoked'`, `'not_found'`, `'transferred'`, or `'unknown'`

### `SocialAuth::signOut(): bool`

Signs out from Google and clears credential state. Apple has no sign-out API.

### AuthResult

| Property | Type | Apple | Google |
|----------|------|-------|--------|
| `provider` | `string` | `'apple'` | `'google'` |
| `userId` | `?string` | Unique Apple user ID | Google user ID |
| `identityToken` | `?string` | JWT | JWT |
| `authorizationCode` | `?string` | One-time code | Server auth code |
| `accessToken` | `?string` | -- | OAuth access token |
| `email` | `?string` | First sign-in only | Always |
| `givenName` | `?string` | First sign-in only | Always |
| `familyName` | `?string` | First sign-in only | Always |
| `displayName` | `?string` | First sign-in only | Always |
| `photoUrl` | `?string` | -- | Profile photo URL |
| `nonce` | `?string` | Returned as `nonce` claim inside `identityToken` | Returned as `nonce` claim inside `identityToken` |
| `state` | `?string` | Echoed | -- |
| `realUserStatus` | `?string` | `'likelyReal'` / `'unknown'` | -- |

### Events

| Event | Payload |
|-------|---------|
| `AppleSignInCompleted` | `userId`, `identityToken`, `authorizationCode`, `email`, `givenName`, `familyName` |
| `GoogleSignInCompleted` | `userId`, `identityToken`, `email`, `displayName`, `givenName`, `familyName`, `photoUrl` |
| `SignInFailed` | `provider`, `error`, `errorCode` |

**Error codes:** `CANCELED`, `FAILED`, `INVALID_RESPONSE`, `NOT_HANDLED`, `NOT_INTERACTIVE`, `NO_AUTH_IN_KEYCHAIN`, `NO_CREDENTIAL`, `UNSUPPORTED_PLATFORM`, `MISSING_CONFIG`, `PARSE_ERROR`, `UNKNOWN`

## Server-Side Token Verification

Identity tokens are JWTs that **must** be verified server-side before trusting the user's identity:

```php
use Firebase\JWT\JWT;
use Firebase\JWT\JWK;

// Google verification
$googleKeys = json_decode(
    file_get_contents('https://www.googleapis.com/oauth2/v3/certs'), true
);
$decoded = JWT::decode($identityToken, JWK::parseKeySet($googleKeys));
// Verify: $decoded->aud === your GOOGLE_SERVER_CLIENT_ID
// Verify: $decoded->iss === 'https://accounts.google.com'
// If you passed a nonce to googleSignIn():
// Verify: $decoded->nonce === session('auth_nonce')

// Apple verification
$appleKeys = json_decode(
    file_get_contents('https://appleid.apple.com/auth/keys'), true
);
$decoded = JWT::decode($identityToken, JWK::parseKeySet($appleKeys));
// Verify: $decoded->aud === your app's bundle ID
// Verify: $decoded->iss === 'https://appleid.apple.com'
// If you passed a nonce to appleSignIn() (SHA-256 of the raw nonce):
// Verify: $decoded->nonce === hash('sha256', session('auth_nonce'))
```

Install the JWT library: `composer require firebase/php-jwt`

## Troubleshooting

**iOS build fails: `error: extra arguments at positions #4, #5 in call` in SocialAuthFunctions.swift**
- Plugin versions up to 1.0.1 pinned GoogleSignIn-iOS `~> 8.0` while calling the nonce sign-in overload, which only exists in GoogleSignIn-iOS 9.0+. Upgrade the plugin (`composer update ikromjon/nativephp-mobile-social-auth`), then run `php artisan native:install --force` so the regenerated Podfile resolves GoogleSignIn `~> 9.0`. If CocoaPods then reports a dependency conflict, another pod in your project is pinning AppAuth 1.x / GTMAppAuth 4.x -- update that dependency, since GoogleSignIn 9.x requires AppAuth 2.x and GTMAppAuth 5.x.

**"Developer console is not set up correctly" (Android)**
- Ensure you have BOTH an Android client AND a Web client in the same Google Cloud project
- The Android client must have the correct package name and SHA-1 fingerprint

**"MISSING_CONFIG" error**
- Check that `GOOGLE_SERVER_CLIENT_ID` is set in your `.env` file

**Google Sign-In returns null on Android**
- This is expected. On Android, Google Sign-In is async. Use `#[OnNative(GoogleSignInCompleted::class)]` to receive the result.

**Apple email/name are null**
- Apple only provides email and name on the **first** sign-in. After that, only `userId` and `identityToken` are returned. To reset during development: Settings > Apple ID > Sign-In & Security > Sign in with Apple > Your App > Stop Using Apple ID.

**App Store rejection for missing Apple Sign-In**
- If your app offers Google (or any third-party) sign-in, you must also offer Apple Sign-In. This plugin handles both.

## Support

- Issues: [GitHub Issues](https://github.com/Ikromjon1998/nativephp-mobile-social-auth/issues)
- Email: ikromjon98.98@icloud.com
