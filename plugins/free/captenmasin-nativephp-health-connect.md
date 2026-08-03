---
name: "Health Connect"
author: "captenmasin"
price: "Free"
version: "latest"
license: "MIT"
github: "https://github.com/captenmasin/nativephp-health-connect"
compatibility:
  nativephp: "^3.0"
  php: "^8.2"
  android: "33+"
install:
  - "composer require captenmasin/nativephp-health-connect"
events:
  - PermissionsGranted
  - WorkoutsRead
---

NativePHP Health Connect is a NativePHP mobile plugin for reading normalized workout data from Android Health Connect.

It exposes a small Laravel-friendly PHP API backed by a NativePHP Android bridge. The plugin can check Health Connect availability, launch the Android permission flow, and read recent workouts with calories, dates, durations, and source metadata.

## Requirements

- PHP 8.2 or higher
- `nativephp/mobile` 3.0 or higher
- Android API 33 or higher
- Android Health Connect available on the device

This package currently provides an Android implementation. Calls made outside a NativePHP Android app return an unsupported response instead of throwing.

## Installation

Install the package with Composer:

```bash
composer require captenmasin/nativephp-health-connect
```

The service provider, facade alias, NativePHP manifest, Android permissions, and Android dependency are registered through the package metadata.

## Usage

Use the `HealthConnect` facade from your NativePHP mobile app:

```php
use HealthConnect;

$status = HealthConnect::status();

if (($status['status'] ?? null) === 'permission_required') {
    HealthConnect::requestPermissions();
}

$result = HealthConnect::readWorkouts(30);
```

`readWorkouts()` accepts a sync window in days. Values below `1` are clamped to `1`.

```php
$result = HealthConnect::syncNow(windowDays: 14);
```

`syncNow()` is an alias for `readWorkouts()`.

## API

### `HealthConnect::status()`

Returns Health Connect availability and permission state.

### `HealthConnect::requestPermissions()`

Launches the Android Health Connect permission flow.

### `HealthConnect::readWorkouts(int $windowDays = 30)`

Reads workout records from Health Connect for the requested window.

### `HealthConnect::syncNow(int $windowDays = 30)`

Alias for `readWorkouts()`.

## Response Shape

Successful workout reads return an array with a JSON payload string:

```php
[
    'supported' => true,
    'available' => true,
    'has_permissions' => true,
    'status' => 'success',
    'records_count' => 3,
    'payload' => '{"synced_at":"...","window_start":"...","window_end":"...","records":[...]}',
]
```

Each record in `payload.records` is normalized to fields like:

```json
{
    "external_id": "health-connect-record-id",
    "title": "Run",
    "calories_burned": 420,
    "date": "2026-05-21",
    "started_at": "2026-05-21T07:30:00+01:00",
    "ended_at": "2026-05-21T08:05:00+01:00",
    "duration_seconds": 2100,
    "source_name": "com.example.healthapp",
    "source_package": "com.example.healthapp"
}
```

Common statuses include:

- `unsupported` when the call is made outside a NativePHP Android app
- `unavailable` when Health Connect or the bridge is not available
- `permission_required` when Health Connect permissions have not been granted
- `permission_requested` after launching the permission flow
- `success` when records were read
- `error` when the bridge returns an invalid response

## Health Connect Data

The Android implementation reads:

- Exercise sessions
- Total calories burned
- Active calories burned

Exercise sessions are preferred when calories can be matched to the session. Standalone calorie records are included when they do not overlap an already imported workout interval.
