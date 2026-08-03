---
name: "Double Back to Close"
author: "CodingwithRK"
price: "Free"
version: "1.1.0"
license: "MIT"
github: "https://github.com/codingwithrk/double-back-to-close"
support: "codingwithrk@gmail.com"
compatibility:
  nativephp: "^3.0"
  ios: "18.2+"
  android: "26+"
install:
  - "composer require codingwithrk/double-back-to-close"
  - "php artisan vendor:publish --tag=nativephp-plugins-provider"
  - "php artisan native:plugin:register codingwithrk/double-back-to-close"
  - "php artisan native:plugin:register nativephp/mobile-dialog"
events:
  - DoubleBackToCloseTriggered
  - AppExiting
---

![Image](https://raw.githubusercontent.com/codingwithrk/nativephp-mobile-plugins/refs/heads/main/assets/screenshots/double-back-to-close.png)

Prompts users to press the back button twice before the app exits.

On the **first** back press a native toast is shown ("Press back again to exit"). If the user presses back **again within the timeout** the app exits. If the timeout elapses the state resets and the next back press starts the cycle over.

Supports NativePHP Mobile **v3** and **v4** (SuperNative). `DoubleBackToClose::showToast()` uses the `Dialog` facade to optionally surface the confirmation message as a rich dialog toast from PHP.

---

## Requirements

| Platform | Minimum version                                            |
|----------|------------------------------------------------------------|
| Android  | API 26 (Android 8)                                         |
| iOS      | 18.2 (feature is a no-op; iOS has no hardware back button) |

`nativephp/mobile` `^3.0` or `^4.0`.

---

## Installation

```bash
composer require codingwithrk/double-back-to-close
```

Publish the plugins provider (first time only):

```bash
php artisan vendor:publish --tag=nativephp-plugins-provider
```

Register this plugin (adds the service provider to your `NativePluginsServiceProvider`):

```bash
php artisan native:plugin:register codingwithrk/double-back-to-close
```

### `showToast()` on NativePHP Mobile v3

On v4, `Dialog` ships inside `nativephp/mobile` core — no extra steps needed. On **v3**, `Dialog` is a separate plugin, so if you want to use `DoubleBackToClose::showToast()` install and register it too:

```bash
composer require nativephp/mobile-dialog
php artisan native:plugin:register nativephp/mobile-dialog
```

This is only required if you call `showToast()`; `enable()`, `disable()`, and `configure()` work without it.

Verify:

```bash
php artisan native:plugin:list
```

---

## PHP Usage

```php
use Codingwithrk\DoubleBackToClose\Facades\DoubleBackToClose;

// Enable with defaults — message: "Press back again to exit", timeout: 2000 ms
DoubleBackToClose::enable();

// Enable with a custom message and timeout
DoubleBackToClose::enable('Tap back again to quit', 3000);

// Update message / timeout while already active
DoubleBackToClose::configure('Press back to exit', 2500);

// Disable (restores default back behaviour)
DoubleBackToClose::disable();

// Show a toast via the Dialog facade (built in on v4; requires nativephp/mobile-dialog on v3)
DoubleBackToClose::showToast('Press back again to exit');
```

### Typical Livewire setup

```php
use Livewire\Component;
use Codingwithrk\DoubleBackToClose\Facades\DoubleBackToClose;

class AppLayout extends Component
{
    public function mount(): void
    {
        DoubleBackToClose::enable();
    }
}
```

---

## Events

### `DoubleBackToCloseTriggered`

Dispatched on the **first** back press. The native Android `Toast` has already been shown; listen to this event if you want to show a dialog toast via the `Dialog` facade instead.

```php
use Native\Mobile\Attributes\OnNative;
use Codingwithrk\DoubleBackToClose\Events\DoubleBackToCloseTriggered;
use Codingwithrk\DoubleBackToClose\Facades\DoubleBackToClose;

#[OnNative(DoubleBackToCloseTriggered::class)]
public function onFirstBackPress(string $message): void
{
    // Override with a dialog toast
    DoubleBackToClose::showToast($message);
}
```

**Payload**

| Property  | Type     | Description                  |
|-----------|----------|------------------------------|
| `message` | `string` | The configured toast message |

### `AppExiting`

Dispatched on the **second** back press, immediately before `activity.finish()` is called.

```php
use Native\Mobile\Attributes\OnNative;
use Codingwithrk\DoubleBackToClose\Events\AppExiting;

#[OnNative(AppExiting::class)]
public function onAppExiting(): void
{
    // Last-moment cleanup
}
```

---

## JavaScript Usage

```javascript
import {DoubleBackToClose, Events} from '@codingwithrk/double-back-to-close';
import {on, off} from '@nativephp/native';

// Enable
await DoubleBackToClose.enable({message: 'Press back again to exit', timeout: 2000});

// Update config
await DoubleBackToClose.configure({message: 'Back again to quit', timeout: 3000});

// Disable
await DoubleBackToClose.disable();

// Listen for first back press
const onTriggered = ({message}) => console.log('First press:', message);
on(Events.DoubleBackToCloseTriggered, onTriggered);

// Listen for exit
const onExiting = () => console.log('Goodbye!');
on(Events.AppExiting, onExiting);

// Tear down
off(Events.DoubleBackToCloseTriggered, onTriggered);
off(Events.AppExiting, onExiting);
```

---

## How it works

### Android

`Enable` registers an [`OnBackPressedCallback`](https://developer.android.com/reference/androidx/activity/OnBackPressedCallback) on the activity's `onBackPressedDispatcher`.

- **First press**: shows a native `Toast`, dispatches `DoubleBackToCloseTriggered`, starts a `Handler` timer for the configured timeout.
- **Second press within timeout**: cancels the timer, dispatches `AppExiting`, calls `activity.finish()`.
- **Timeout elapses**: resets `backPressedOnce` to `false`; the next press is treated as a first press again.

`Disable` removes the callback and clears all state.

`Configure` updates the message/timeout in-place without re-registering the callback.

### iOS

iOS does not expose a hardware back button. The bridge functions accept and store configuration, and fire the same PHP events so cross-platform code stays consistent. Pair the feature with `DoubleBackToClose::showToast()` if you need visual feedback on iOS.

---

## Support

For questions or issues, email [connect@codingwithrk.com](mailto:connect@codingwithrk.com)

---
