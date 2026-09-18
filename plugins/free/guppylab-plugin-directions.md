---
name: "Directions"
author: "guppylab"
price: "Free"
version: "2.0.1"
license: "MIT"
github: "https://github.com/edinhocostaf/plugin-directions"
support: "https://github.com/edinhocostaf/plugin-directions/issues"
compatibility:
  nativephp: "^3.0"
  ios: "15.0+"
  android: "21+"
install:
  - "composer require guppylab/plugin-directions"
  - "php artisan native:plugin:register guppylab/plugin-directions"
---

# Directions

Real-route distance and ETA from one origin to multiple destinations. iOS uses MapKit `MKDirections` (on-device, no server). Android uses OSRM over HTTP (self-hosted).

> **Note:** Android requires a self-hosted `osrm-backend` server.

## Features

- **Batch queries** — single origin to many destinations in one call
- **iOS** — on-device MapKit routing, no server needed
- **Android** — OSRM HTTP routing (configurable self-hosted backend)
- **Graceful fallback** — every destination always gets a response (`ok: true/false`)
- **`Directions::isSupported()`** — check engine availability at runtime
- **Configurable** `max_destinations` (default 25) and `timeout`
- **Concurrent call support** via correlation IDs (UUID)
- **Error codes** — `unsupported`, `timeout`, `over_limit`, `no_route`, `failed`
- **JavaScript API** with TypeScript definitions for Livewire and Inertia (Vue/React)

## Installation

```bash
composer require guppylab/plugin-directions
php artisan native:plugin:register guppylab/plugin-directions
```
