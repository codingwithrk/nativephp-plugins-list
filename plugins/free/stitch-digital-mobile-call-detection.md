---
name: "Mobile Call Detection"
author: "Stitch Digital"
price: "Free"
version: "latest"
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

# Mobile Call Detection

Detects when phone calls end and fires a `CallEnded` event with call metadata. Useful for CRM, sales, or support apps that need to log calls or trigger workflows after conversations.

## Platform Support

| Feature | Android | iOS |
| ------- | ------- | --- |
| Phone number | Yes | No (Apple privacy) |
| Call direction | `inbound` / `outbound` | Always `unknown` |
| Duration | Accurate (from call log) | Approximate (from timestamps) |
| Background detection | Yes (BroadcastReceiver) | Limited (CXCallObserver) |
| Permissions required | Yes (READ_CALL_LOG) | None |

## Installation

```bash
composer require stitch-digital/mobile-call-detection
```

Service provider and `CallDetection` facade are auto-discovered — no manual registration needed.

## Usage

```php
use StitchDigital\CallDetection\Facades\CallDetection;

// Check permissions
$granted = CallDetection::hasPermission();

// Request permissions (shows dialog on Android; no-op on iOS)
$granted = CallDetection::requestPermission();
```

```php
// In a Livewire component or event listener
use StitchDigital\CallDetection\Events\CallEnded;

protected $listeners = [CallEnded::class => 'onCallEnded'];

public function onCallEnded($data)
{
    $number    = $data['phoneNumber'];  // Android only
    $direction = $data['direction'];    // inbound / outbound / unknown
    $duration  = $data['duration'];     // seconds
}
```

## Events

- `CallEnded` — fired when a phone call ends; includes `phoneNumber` (Android only), `direction`, and `duration`
