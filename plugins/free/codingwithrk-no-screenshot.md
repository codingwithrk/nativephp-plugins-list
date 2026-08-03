---
name: "No Screenshot"
author: "CodingwithRK"
price: "Free"
version: "1.1.0"
license: "MIT"
github: "https://github.com/codingwithrk/no-screenshot"
support: "codingwithrk@gmail.com"
compatibility:
  nativephp: "^3.0"
  ios: "13.0+"
  android: "21+"
  php: "8.2+"
install:
  - "composer require codingwithrk/no-screenshot"
  - "php artisan native:plugin:register codingwithrk/no-screenshot"
events:
  - ScreenshotAttempted
  - ScreenRecordingStarted
  - ScreenRecordingStopped
---

# NoScreenshot plugin for NativePHP Mobile

A NativePHP Mobile plugin that prevents screenshots, blocks screen recording, and protects the App Switcher thumbnail — on both Android and iOS.

Mainly useful for apps that handle sensitive data such as **financial**, **healthcare**, or **enterprise** applications where protecting user privacy and data security is paramount.

---

## Platform Support

| Feature                            |     Android     |            iOS             |
|------------------------------------|:---------------:|:--------------------------:|
| Block screenshots                  | ✅ `FLAG_SECURE` | ✅ UITextField secure layer |
| Block screen recording             | ✅ `FLAG_SECURE` |      ✅ Black overlay       |
| App Switcher thumbnail protection  |        ✅        |             ✅              |
| Detect live recording              |        —        |  ✅ `UIScreen.isCaptured`   |
| Detect screenshot events           |    ✅ API 34+    |       ✅ All versions       |
| Persist protection across restarts |        ✅        |             ✅              |

### How It Works

**Android** uses `WindowManager.LayoutParams.FLAG_SECURE` — an OS-level window flag that prevents the system from capturing the screen by any means: the screenshot button, the built-in screen recorder, ADB, and third-party capture apps all receive a blank frame. The flag also prevents the App Switcher / Recents thumbnail from showing real content.

A `ContentProvider` (`NoScreenshotInitProvider`) registers `Application.ActivityLifecycleCallbacks` before any Activity is created. On every `Activity.onCreate()` it reads the persisted protection state from `SharedPreferences` and re-applies `FLAG_SECURE` — so the flag is active from the very first frame, even before the WebView or any PHP controller has run.

**iOS** uses two complementary techniques:

1. **UITextField `isSecureTextEntry` screenshot prevention** — when protection is active, all main-window content is moved inside the first subview of a `UITextField` with `isSecureTextEntry = true`. iOS routes that subtree through its system DRM compositing path, which is excluded from the screenshot pipeline. The protected area appears **blank/white** in any screenshot taken while protection is active.

2. **Overlay windows** — a full-screen black `UIWindow` (above the status bar) is shown:
    - When `UIScreen.main.isCaptured` is `true` (screen recording / AirPlay mirroring active)
    - When `UIApplication.willResignActiveNotification` fires (user pressed Home — prevents the OS from capturing a real frame for the App Switcher thumbnail)

Protection state is persisted in `UserDefaults`. The plugin exports a `NativePHPNoScreenshotInit` function (registered as `init_function` in the manifest) that restores the saved state at app startup, re-arming all observers before the first bridge call.

---

## Requirements

|                  | Minimum                       |
|------------------|-------------------------------|
| PHP              | 8.2                           |
| NativePHP Mobile | 3.x or 4.x                    |
| Android          | API 21 (Android 5.0 Lollipop) |
| iOS              | 13.0                          |

> `FLAG_SECURE` is available from Android API 1. API 21 is set to match NativePHP Mobile's own minimum. The iOS 13 minimum is required because the recording overlay uses `UIWindowScene`, introduced in iOS 13.

---

## Installation

```bash
composer require codingwithrk/no-screenshot

php artisan native:plugin:register codingwithrk/no-screenshot
```

The service provider and `NoScreenshot` facade are auto-discovered by Laravel — no manual registration needed.

---

## Quick Start

```php
use Codingwithrk\NoScreenshot\Facades\NoScreenshot;

// Protect the entire app (persisted across restarts)
NoScreenshot::disableGlobally();

// Lift global protection
NoScreenshot::enableGlobally();
```

Call `disableGlobally()` once — from a service provider, middleware, or any controller. The choice is saved to `SharedPreferences` (Android) / `UserDefaults` (iOS) and automatically restored the next time the app launches.

---

## PHP API

All methods are available via the `NoScreenshot` facade or by resolving `Codingwithrk\NoScreenshot\NoScreenshot` from the container.

### `disableGlobally(): bool`

Activates protection for the entire app and persists the state so it survives app restarts.

- **Android** — adds `FLAG_SECURE` to the activity window; all capture attempts receive a blank frame. On the next launch, `FLAG_SECURE` is applied at `Activity.onCreate()` before the WebView loads.
- **iOS** — moves window content into the `UITextField` secure container (screenshot content appears blank), starts the `UIScreen.capturedDidChangeNotification` observer, and registers `willResignActiveNotification` to protect the App Switcher thumbnail.

Returns `true` on success, `false` if running outside NativePHP.

```php
NoScreenshot::disableGlobally();
```

---

### `enableGlobally(): bool`

Removes global protection and clears the persisted state.

```php
NoScreenshot::enableGlobally();
```

---

### `toggle(): bool`

Toggles global protection on/off. Returns the new `isGloballyProtected` state.

```php
$isNowProtected = NoScreenshot::toggle();
```

---

### `getStatus(): ?ScreenProtectionStatus`

Returns the current protection state as a typed DTO, or `null` outside NativePHP.

```php
$status = NoScreenshot::getStatus();

$status->isGloballyProtected;         // bool — true after disableGlobally()
$status->isScreenBeingRecorded;       // bool — iOS: live UIScreen.main.isCaptured; Android: always false
$status->isScreenshotDetectionActive; // bool — true when screenshot detection is running
```

---

### `startScreenshotDetection(): bool`

Registers a native observer that fires `ScreenshotAttempted` whenever the user takes a screenshot.

- **Android** — uses `Activity.registerScreenCaptureCallback()` (API 34+). On older devices the call succeeds but `supported` is `false` and no events fire.
- **iOS** — uses `UIApplication.userDidTakeScreenshotNotification` (all iOS versions).

```php
NoScreenshot::startScreenshotDetection();
```

---

### `stopScreenshotDetection(): bool`

Unregisters the screenshot observer.

```php
NoScreenshot::stopScreenshotDetection();
```

---

## Events

Three events cover the full lifecycle of capture activity. Listen to them in Livewire components with the `native:` prefix.

| Event                    | Dispatched when                                              |
|--------------------------|--------------------------------------------------------------|
| `ScreenshotAttempted`    | A screenshot was taken (iOS: all versions; Android: API 34+) |
| `ScreenRecordingStarted` | `isScreenBeingRecorded` transitions `false → true` (iOS)     |
| `ScreenRecordingStopped` | `isScreenBeingRecorded` transitions `true → false` (iOS)     |

> **Android note:** `FLAG_SECURE` prevents capture at the OS level rather than detecting it. `ScreenshotAttempted` requires API 34+ and `startScreenshotDetection()` to be called first. `ScreenRecordingStarted` / `ScreenRecordingStopped` are iOS-only.

### Listening in a Livewire component

```php
use Livewire\Attributes\On;
use Livewire\Component;
use Codingwithrk\NoScreenshot\Facades\NoScreenshot;

class SecureScreen extends Component
{
    #[On('native:Codingwithrk\NoScreenshot\Events\ScreenshotAttempted')]
    public function onScreenshotAttempted(): void
    {
        logger()->warning('Screenshot attempted');
    }

    #[On('native:Codingwithrk\NoScreenshot\Events\ScreenRecordingStarted')]
    public function onRecordingStarted(): void
    {
        // Recording / mirroring is now active — overlay is already shown by the plugin.
        // Use this hook for your own app logic (e.g. pause playback).
    }

    #[On('native:Codingwithrk\NoScreenshot\Events\ScreenRecordingStopped')]
    public function onRecordingStopped(): void
    {
        // Recording stopped — overlay is hidden automatically.
    }
}
```

### Manual dispatch (polling pattern)

```php
use Codingwithrk\NoScreenshot\Facades\NoScreenshot;
use Codingwithrk\NoScreenshot\Events\ScreenRecordingStarted;
use Codingwithrk\NoScreenshot\Events\ScreenRecordingStopped;

$status = NoScreenshot::getStatus();

match (true) {
    $status->isScreenBeingRecorded => ScreenRecordingStarted::dispatch(),
    default                        => ScreenRecordingStopped::dispatch(),
};
```

---

## ScreenProtectionStatus Reference

| Property                      | Type   | Android        | iOS                             |
|-------------------------------|--------|----------------|---------------------------------|
| `isGloballyProtected`         | `bool` | ✅              | ✅                               |
| `isScreenBeingRecorded`       | `bool` | Always `false` | Live `UIScreen.main.isCaptured` |
| `isScreenshotDetectionActive` | `bool` | API 34+ only   | ✅ All versions                  |

---

## Platform Notes

### Android

- **Startup protection** — `NoScreenshotInitProvider` (a `ContentProvider`) runs before `MainActivity.onCreate()`. It reads `SharedPreferences` and registers `ActivityLifecycleCallbacks`. On every `Activity.onCreate()` and `onResume()`, `FLAG_SECURE` is re-applied if protection is active. This means the App Switcher thumbnail is always black on cold launches — not just after the first bridge call.
- **Scope** — `FLAG_SECURE` covers the entire activity window. All capture methods (screenshot button, built-in recorder, ADB, third-party apps, Recents thumbnail) receive a blank frame.
- **Screenshot detection** — `registerScreenCaptureCallback()` requires API 34 (Android 14+). On earlier devices `startScreenshotDetection()` returns `supported: false` and `ScreenshotAttempted` never fires.

### iOS

- **Screenshot content prevention** — when protection is active, the main window's subviews are moved inside a `UITextField` with `isSecureTextEntry = true`. iOS's secure compositing path excludes this subtree from screenshot capture — the screenshot shows blank/white instead of real content. If Apple changes the internal `UITextField` structure in a future OS release, the plugin falls back gracefully to overlay-only protection.
- **App Switcher protection** — `willResignActiveNotification` fires before the OS captures the Recents thumbnail. The plugin shows the black overlay at that moment and hides it again on `didBecomeActiveNotification`.
- **Screen recording overlay** — `UIScreen.main.isCaptured` is `true` during screen recording and AirPlay mirroring. The black `UIWindow` overlay (level `statusBar + 1`) appears immediately when either starts and disappears when both stop.
- **Startup restoration** — `NativePHPNoScreenshotInit` (the `init_function`) reads `UserDefaults` at app launch and calls `apply()` if protection was previously enabled. The `didBecomeActiveNotification` observer retries `applyScreenshotPrevention()` if the window was not yet ready at init time.
- **iOS 13 minimum** — required for `UIWindowScene` used by the overlay window.

---

## Testing

### Unit tests

```bash
cd packages/codingwithrk/no-screenshot
./vendor/bin/pest
```

### Device scenarios

| # | Scenario                                 | Steps                                                             | Expected                                                                    |
|---|------------------------------------------|-------------------------------------------------------------------|-----------------------------------------------------------------------------|
| 1 | **App Switcher** (Android & iOS)         | Enable protection → press Home → open Recents                     | Thumbnail is black                                                          |
| 2 | **Screenshot content** (iOS)             | Enable protection → take screenshot (Vol Up + Side) → open Photos | Screenshot is blank/white                                                   |
| 3 | **Screenshot event** (Android 14+ & iOS) | `startScreenshotDetection()` → take screenshot                    | `ScreenshotAttempted` fires in Livewire                                     |
| 4 | **Restart persistence** (Android & iOS)  | Enable protection → force-kill app → reopen                       | Protection active before any PHP call; App Switcher thumbnail already black |

---
## Changelog

### 1.1.0

- **Android fix** — `FLAG_SECURE` is now applied at `Activity.onCreate()` via `NoScreenshotInitProvider` (a `ContentProvider`), fixing the App Switcher thumbnail leak that occurred before the first bridge call ([#1](https://github.com/codingwithrk/no-screenshot/issues/1))
- **Android** — protection state persisted to `SharedPreferences`; restored automatically on cold launch
- **iOS** — added `UITextField isSecureTextEntry` screenshot prevention; screenshot content now appears blank instead of showing real app content
- **iOS** — added `willResignActiveNotification` observer to protect the App Switcher thumbnail
- **iOS** — added `NativePHPNoScreenshotInit` (`init_function`) to restore persisted protection state at app startup
- **iOS** — protection state persisted to `UserDefaults`

### 1.0.0

- Initial release

---

## Support

For questions or issues, email [connect@codingwithrk.com](mailto:connect@codingwithrk.com)
