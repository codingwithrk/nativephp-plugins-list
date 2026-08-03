---
name: "NativePHP Mobile Geolocation"
author: "Bifrost Technology"
price: "$49"
version: "1.0.3"
license: "Proprietary"
source: "https://nativephp.com/plugins/nativephp/mobile-geolocation"
support: "support@nativephp.com"
compatibility:
  nativephp: "^3.0"
  ios: "18.2+"
  android: "26+"
install:
  - "composer require nativephp/mobile-geolocation"
events:
  - LocationReceived
  - PermissionStatusReceived
  - PermissionRequestResult
---

# NativePHP Mobile Geolocation

GPS and network-based location with permission handling for NativePHP Mobile apps.

## Features

- Network and GPS positioning options
- One-shot and continuous location updates
- Permission checking and requesting with `permanently_denied` detection
- Accuracy metadata (`accuracy` in meters)
- PHP (Livewire/Blade) and JavaScript (Vue/React/Inertia) support

## Installation

> Requires Composer credentials for the NativePHP plugin repository.

```bash
composer config repositories.nativephp-plugins composer https://plugins.nativephp.com
composer config http-basic.plugins.nativephp.com your@email.com your-license-key
php artisan vendor:publish --tag=nativephp-plugins-provider
composer require nativephp/mobile-geolocation
php artisan native:plugin:register nativephp/mobile-geolocation
```

## PHP Usage

```php
use NativePHP\MobileGeolocation\Facades\Geolocation;

// Check current permission
Geolocation::checkPermission();

// Request permission
Geolocation::requestPermission();

// Get one-shot location
Geolocation::getLocation(provider: 'gps'); // 'gps' or 'network'

// Start continuous updates
Geolocation::startLocationUpdates(provider: 'gps', minDistance: 10);

// Stop updates
Geolocation::stopLocationUpdates();
```

## Livewire Usage

```php
use Native\Mobile\Attributes\OnNative;
use NativePHP\MobileGeolocation\Events\LocationReceived;
use NativePHP\MobileGeolocation\Events\PermissionRequestResult;

#[OnNative(LocationReceived::class)]
public function onLocation(
    ?float $latitude, ?float $longitude, ?float $accuracy,
    ?string $provider, ?string $error
): void {
    if ($error) return;
    $this->lat = $latitude;
    $this->lng = $longitude;
}

#[OnNative(PermissionRequestResult::class)]
public function onPermission(string $status, bool $permanently_denied): void
{
    if ($permanently_denied) {
        // Prompt user to open Settings
    }
}
```

## Compatibility

| Platform   | Minimum Version |
| ---------- | --------------- |
| NativePHP  | ^3.0            |
| iOS        | 18.2+           |
| Android    | API 26+         |

## Events

### `LocationReceived`

| Field | Type | Description |
|-------|------|-------------|
| `latitude` | `float\|null` | Latitude in decimal degrees |
| `longitude` | `float\|null` | Longitude in decimal degrees |
| `accuracy` | `float\|null` | Accuracy in meters |
| `timestamp` | `int\|null` | Unix timestamp |
| `provider` | `string\|null` | `gps` or `network` |
| `error` | `string\|null` | Error message if failed |

### `PermissionStatusReceived`

Returned by `checkPermission()`. Status: `granted`, `denied`, or `not_determined`.

### `PermissionRequestResult`

Returned by `requestPermission()`. Includes `permanently_denied: bool`.
