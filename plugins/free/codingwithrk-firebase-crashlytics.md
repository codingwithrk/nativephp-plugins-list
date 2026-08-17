---
name: "Firebase Crashlytics"
author: "CodingwithRK"
price: "Free"
version: "1.0.0"
license: "MIT"
github: "https://github.com/codingwithrk/firebase-crashlytics"
support: "https://github.com/codingwithrk/firebase-crashlytics/issues"
compatibility:
  nativephp: "^3.0 || ^4.0"
  ios: "any"
  android: "any"
install:
  - "composer require codingwithrk/firebase-crashlytics"
  - "php artisan vendor:publish --tag=nativephp-plugins-provider"
  - "php artisan native:plugin:register codingwithrk/firebase-crashlytics"
---

# Firebase Crashlytics Plugin for NativePHP Mobile

Wraps Firebase Crashlytics for Android and iOS — crash reporting and error tracking directly from your NativePHP app.

## Features

- Record fatal and non-fatal exceptions
- Log breadcrumb messages for debugging context
- Attach user identifiers and custom metadata
- Report everything to the Firebase console
- Consent-based data collection support

## Prerequisites

A Firebase project with Crashlytics enabled. Place `google-services.json` (Android) and `GoogleService-Info.plist` (iOS) in your project before registering the plugin.

## Installation

```bash
composer require codingwithrk/firebase-crashlytics
php artisan vendor:publish --tag=nativephp-plugins-provider
php artisan native:plugin:register codingwithrk/firebase-crashlytics
```

## Usage

```php
use Codingwithrk\FirebaseCrashlytics\Facades\FirebaseCrashlytics;

// Record a caught exception (non-fatal)
try {
    $riskyOperation();
} catch (Throwable $e) {
    FirebaseCrashlytics::recordError($e);
}

// Log a breadcrumb message
FirebaseCrashlytics::log('User reached checkout');

// Attach a user ID to all subsequent reports
FirebaseCrashlytics::setUserId((string) $user->id);

// Attach custom key–value metadata
FirebaseCrashlytics::setCustomKey('subscription_tier', 'pro');
```

## JavaScript API

```javascript
import { FirebaseCrashlytics } from '@codingwithrk/firebase-crashlytics';

await FirebaseCrashlytics.recordError(error);
await FirebaseCrashlytics.log('User reached checkout');
await FirebaseCrashlytics.setUserId('user-123');
```
