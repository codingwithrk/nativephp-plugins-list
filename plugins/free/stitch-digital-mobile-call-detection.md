---
name: "Mobile Call Detection"
author: "Stitch Digital"
price: "Free"
version: "1.0.0"
license: "MIT"
github: "https://github.com/stitch-digital/mobile-call-detection"
compatibility:
  nativephp: "^3.0"
  php: "^8.2"
  ios: "13.0+"
  android: "21+"
install:
  - "composer require stitch-digital/mobile-call-detection"
events:
  - CallEnded
---

# Call Detection Plugin for NativePHP Mobile

A NativePHP Mobile plugin that detects when phone calls end and fires a `CallEnded` event with call metadata.

Useful for apps that need to log calls, trigger workflows after conversations, or track call activity — such as `CRM`, `sales`, or `support` applications.

---

## Platform Support

| Feature              |          Android           |                iOS                 |
|----------------------|:--------------------------:|:----------------------------------:|
| Phone number         |             ✅              | ❌ Not available (Apple privacy)    |
| Call direction       | ✅ `inbound` / `outbound`  | ❌ Always `unknown`                 |
| Duration             | ✅ From call log (accurate) | ⚠️ From timestamps (approximate)  |
| Background detection |  ✅ BroadcastReceiver       | ⚠️ Limited (CXCallObserver)       |
| Permissions required |             ✅              | ✅ None needed                      |

### How It Works

**Android** uses a manifest-registered `BroadcastReceiver` that listens for `android.intent.action.PHONE_STATE`. A state machine tracks transitions between `RINGING`, `OFFHOOK`, and `IDLE` to determine when a call ends and whether it was inbound or outbound. After the call ends, the plugin waits ~1 second then queries `CallLog.Calls.CONTENT_URI` for the phone number, direction, and duration.

**iOS** uses `CXCallObserver` with a `CXCallObserverDelegate`. Apple privacy restrictions mean the plugin cannot access the phone number or call direction. It tracks `hasConnected` timestamps per call UUID to approximate duration, and dispatches the event when `hasEnded` becomes true.

---

## Requirements

|                  | Minimum          |
|------------------|------------------|
| PHP              | 8.2              |
| NativePHP Mobile | 3.x              |
| Android          | API 21+          |
| iOS              | 13.0+            |

---

## Installation

```bash
composer require stitch-digital/mobile-call-detection
```

The service provider and `CallDetection` facade are auto-discovered by Laravel — no manual registration needed.

---

## Quick Start

```php
use StitchDigital\CallDetection\Facades\CallDetection;

// Check if permissions are granted
$granted = CallDetection::hasPermission();

// Request permissions (shows system dialog on Android, no-op on iOS)
$granted = CallDetection::requestPermission();
```

Then listen for the `CallEnded` event in your Livewire component or event listener.

---

## PHP API

All methods are available via the `CallDetection` facade or by resolving `StitchDigital\CallDetection\CallDetection` from the container.

### `hasPermission(): bool`

Check whether the required permissions have been granted.

- **Android** — checks `READ_PHONE_STATE` and `READ_CALL_LOG` via `ContextCompat.checkSelfPermission`.
- **iOS** — always returns `true`. `CXCallObserver` does not require explicit permission.

Returns `false` if running outside NativePHP.

```php
if (CallDetection::hasPermission()) {
    // Ready to detect calls
}
```

---

### `requestPermission(): bool`

Request call detection permissions from the user.

- **Android** — shows the system permission dialog for `READ_PHONE_STATE` and `READ_CALL_LOG`. Returns `false` immediately because the result is asynchronous — call `hasPermission()` again after the user responds.
- **iOS** — no-op, returns `true`. No permission is needed.

Returns `false` if running outside NativePHP.

```php
CallDetection::requestPermission();

// After the user responds to the dialog:
$granted = CallDetection::hasPermission();
```

---

## JavaScript API

```js
import { HasPermission, RequestPermission } from '../vendor/stitch-digital/mobile-call-detection/resources/js/index.js';

const { data } = await HasPermission();
// data.granted → true/false

const { data } = await RequestPermission();
// data.granted → true/false
```

---

## Events

The plugin dispatches a single event that covers the full call lifecycle completion.

| Event       | Dispatched when           |
|-------------|---------------------------|
| `CallEnded` | A phone call has finished |

### `CallEnded` Payload

| Property       | Type      | Description                                        |
|----------------|-----------|----------------------------------------------------|
| `$phoneNumber` | `?string` | The phone number (`null` on iOS)                   |
| `$direction`   | `string`  | `'inbound'`, `'outbound'`, or `'unknown'`          |
| `$duration`    | `int`     | Call duration in seconds                            |
| `$platform`    | `string`  | `'android'` or `'ios'`                              |

### Listening with `#[OnNative]`

```php
use Native\Mobile\Attributes\OnNative;
use StitchDigital\CallDetection\Events\CallEnded;

class CallLog extends Component
{
    public array $calls = [];

    #[OnNative(CallEnded::class)]
    public function handleCallEnded(
        ?string $phoneNumber,
        string $direction,
        int $duration,
        string $platform,
    ): void {
        $this->calls[] = [
            'phoneNumber' => $phoneNumber,
            'direction' => $direction,
            'duration' => $duration,
            'platform' => $platform,
        ];
    }

    public function render()
    {
        return view('livewire.call-log');
    }
}
```

### Vue Example

```vue
<script setup>
import { ref, onMounted, onUnmounted } from 'vue';

const calls = ref([]);

function handleCallEnded(event) {
    calls.value.push(event.detail);
}

onMounted(() => {
    window.addEventListener('native:StitchDigital\CallDetection\Events\CallEnded', handleCallEnded);
});

onUnmounted(() => {
    window.removeEventListener('native:StitchDigital\CallDetection\Events\CallEnded', handleCallEnded);
});
</script>
```

### React Example

```jsx
import { useEffect, useState } from 'react';

function CallLog() {
    const [calls, setCalls] = useState([]);

    useEffect(() => {
        const handler = (event) => {
            setCalls(prev => [...prev, event.detail]);
        };

        window.addEventListener('native:StitchDigital\CallDetection\Events\CallEnded', handler);
        return () => window.removeEventListener('native:StitchDigital\CallDetection\Events\CallEnded', handler);
    }, []);

    return (
        <ul>
            {calls.map((call, i) => (
                <li key={i}>{call.direction} — {call.duration}s</li>
            ))}
        </ul>
    );
}
```

---

## Platform Notes

### Android

- The `CallEndedReceiver` is registered in the AndroidManifest via the plugin manifest, so it receives call state changes **even when the app is in the background**.
- After detecting `IDLE` state, the plugin waits ~1 second before querying the call log. This delay allows the system to finish writing the log entry.
- If `READ_CALL_LOG` permission is denied but `READ_PHONE_STATE` is granted, the receiver falls back to the internal state machine for direction and duration (less accurate, no phone number).
- The receiver tracks state transitions: `RINGING → OFFHOOK → IDLE` (inbound) and `OFFHOOK → IDLE` (outbound).
- The `CallEnded` event is dispatched on the **main thread**, which is required for WebView JavaScript injection.

### iOS

- `CXCallObserver` does not require explicit permission — the permission API is a no-op on iOS.
- **Phone numbers cannot be accessed** at the application level. Apple does not expose this data through `CXCallObserver`. The `phoneNumber` field is always `null`.
- **Call direction cannot be determined.** The `direction` field is always `"unknown"`.
- Duration is **approximated** from the time difference between `hasConnected` and `hasEnded` timestamps. Calls that end without connecting (missed/rejected) report a duration of `0`.
- The `CallObserverManager` singleton is initialized at app launch via `init_function` and persists for the app's lifetime.

---

## Testing

```bash
# Install in your NativePHP app
composer require stitch-digital/mobile-call-detection

# Run on Android
php artisan native:run android

# Run on iOS
php artisan native:run ios
```

Then trigger the permission flow and make a test call:

**Android** — call `CallDetection::requestPermission()`, grant both permissions, then make or receive a phone call. The `CallEnded` event should fire with the phone number, direction, and duration.

**iOS** — make or receive a phone call. The `CallEnded` event should fire with `null` phoneNumber, `"unknown"` direction, and an approximate duration.

---
