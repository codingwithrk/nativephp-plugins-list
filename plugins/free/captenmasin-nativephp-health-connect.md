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

# Health Connect

NativePHP Mobile plugin for reading normalized workout and calorie data from Android Health Connect.

> **Platform:** Android only. Returns an unsupported response (not an error) on iOS.

## Features

- Check Health Connect availability and permission state
- Launch the Android permission flow
- Read recent workouts with calories, dates, durations, and source metadata
- Configurable sync window (days)

## Compatibility

| Requirement | Minimum |
| ----------- | ------- |
| Android | API 33+ |
| Health Connect | Must be available on device |

## Installation

```bash
composer require captenmasin/nativephp-health-connect
```

The service provider, facade alias, NativePHP manifest, Android permissions, and Android dependency are all registered automatically.

## Usage

```php
use HealthConnect;

// Check status
$status = HealthConnect::status();

if (($status['status'] ?? null) === 'permission_required') {
    HealthConnect::requestPermissions();
}

// Read workouts from the last 30 days
$result = HealthConnect::readWorkouts(30);

// Alias
$result = HealthConnect::syncNow(windowDays: 14);
```

## Events

- `PermissionsGranted` — user granted Health Connect permissions
- `WorkoutsRead` — workout data returned; includes array of workouts with calories, duration, date, and source
