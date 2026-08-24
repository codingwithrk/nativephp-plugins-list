---
name: "Store Review"
author: "Geof"
price: "Free"
version: "1.0.4"
license: "MIT"
github: "https://github.com/geof-dev/nativephp-store-review"
support: "geof.dev@gmail.com"
compatibility:
  nativephp: "^3.0"
  ios: "15.0+"
  android: "26+"
  php: "8.2+"
install:
  - "composer require geof-dev/nativephp-store-review"
events:
  - StoreReviewCompleted
---

A [NativePHP Mobile](https://nativephp.com) plugin to trigger the native in-app review prompt on iOS and Android — letting users rate your app without leaving it.

- **iOS** — uses [`SKStoreReviewController`](https://developer.apple.com/documentation/storekit/skstorereviewcontroller)
- **Android** — uses the [Play In-App Review API](https://developer.android.com/guide/playcore/in-app-review)

## Requirements

- PHP 8.2+
- `nativephp/mobile` ^3.0
- iOS 15+ / Android 8.0+ (API 26)

## Installation

```bash
composer require geof-dev/nativephp-store-review
```

The service provider is auto-discovered.

## Usage

```php
use Nativephp\StoreReview\Facades\StoreReview;

// Check if in-app review is available on this device
if (StoreReview::isAvailable()) {
    StoreReview::requestReview();
}
```

### `requestReview(): bool`

Asks the OS to display the native review prompt. Returns `true` if the request was successfully dispatched to the system.

> **Important:** returning `true` does **not** mean the dialog was shown to the user. Both iOS and Android throttle how often the prompt appears (iOS limits it to ~3 times per 365-day window per app). The OS decides whether to actually display it — this is by design and cannot be overridden.

### `isAvailable(): bool`

Returns `true` if the current platform supports in-app reviews. Use this to hide review CTAs on unsupported environments (e.g. running in a browser during development).

## Listening for Events

The plugin dispatches a `StoreReviewCompleted` event when the native flow finishes:

```php
use Livewire\Attributes\On;

#[On('native:Nativephp\StoreReview\Events\StoreReviewCompleted')]
public function handleReviewCompleted($result, $id = null)
{
    // $result — raw result payload from the native layer
}
```

## Best Practices

Apple and Google both discourage prompting users at arbitrary moments. A few guidelines:

- **Don't ask too early.** Wait until the user has experienced the value of your app (completed a task, finished onboarding, used it several times).
- **Never tie the prompt to a button labeled "Rate us".** Apple's guidelines forbid triggering `SKStoreReviewController` from an explicit user action — the system may ignore it.
- **Don't call it after an error or negative event.**
- **Don't call it repeatedly.** The OS will silently suppress excess requests; spamming it won't help.

See [Apple's HIG on Ratings and Reviews](https://developer.apple.com/design/human-interface-guidelines/ratings-and-reviews) for more.

## Testing in Development

- **iOS Simulator / Debug builds** — the dialog appears every time (no throttling), but submissions are not sent.
- **TestFlight / sideloaded builds** — the prompt does **not** appear. You must test on a production build from the App Store.
- **Android** — use a [FakeReviewManager](https://developer.android.com/guide/playcore/in-app-review/test) for local testing; production requires an app published to the Play Store.
