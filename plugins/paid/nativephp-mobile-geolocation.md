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

GPS location and permission handling for NativePHP Mobile applications, with access to device positioning via GPS or network services.

## Features

- Network and GPS positioning options
- Permission checking and request handling
- Location accuracy tracking
- Event-driven architecture
- PHP (Livewire/Blade) and JavaScript (Vue/React/Inertia) support

## Installation

> Requires Composer credentials for the NativePHP plugin repository.

```bash
composer config repositories.nativephp-plugins composer https://plugins.nativephp.com
composer config http-basic.plugins.nativephp.com your@email.com your-license-key
composer require nativephp/mobile-geolocation
```

## Compatibility

| Platform   | Minimum Version |
| ---------- | --------------- |
| NativePHP  | ^3.0            |
| iOS        | 18.2+           |
| Android    | API 26+         |

## Events

- `LocationReceived` — returns `latitude`, `longitude`, `accuracy`, `timestamp`, `provider`, and `error`
- `PermissionStatusReceived` — returns permission state: `granted`, `denied`, or `not_determined`
- `PermissionRequestResult` — includes `permanently_denied` state
