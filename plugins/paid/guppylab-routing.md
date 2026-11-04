---
name: "Routing"
author: "guppylab"
price: "$49"
version: "4.3.2"
license: "Proprietary"
source: "https://nativephp.com/plugins/guppylab/routing"
support: "https://nativephp.com/plugins/guppylab/routing"
compatibility:
  nativephp: "^3.0|^4.0"
  ios: "15.0+"
  android: "21+"
install:
  - "composer config repositories.nativephp-plugins composer https://plugins.nativephp.com"
  - "composer config --global http-basic.plugins.nativephp.com your@email.com your-license-key"
  - "composer require guppylab/routing:\"^4.3.1\""
  - "php artisan native:plugin:register guppylab/routing"
---

# Routing

Real-route distance and ETA from one origin to many destinations — iOS via MapKit (no API key), Android via a configurable routing provider.

> **Android routing provider required:** Configure one of Mapbox, openrouteservice, Geoapify, Google Maps, or a self-hosted OSRM server in your Android setup.

> **iOS transit:** Transit mode requires iOS 16+.

## Features

- **Multi-destination routing** — distance and ETA to multiple destinations in one call; each result always returns so you can fall back to a straight-line estimate
- **iOS MapKit on-device** — `MKDirections` at no extra cost, no API key
- **Android providers** — Mapbox, openrouteservice, Geoapify, Google Maps, or self-hosted OSRM
- **Transport modes** — driving, walking, cycling, transit (platform/provider dependent)
- **Route options** — avoid tolls, avoid highways, departure time, arrival time
- **Navigation handoff** — open turn-by-turn navigation in Apple Maps, Google Maps, or Waze
- **Place search** — search for points of interest or addresses
- **Reverse geocoding** — coordinates to a human-readable address
- **PHP & JavaScript API** — Livewire (PHP facade) and Inertia/Vue/React (TypeScript definitions included)

## Installation

```bash
composer config repositories.nativephp-plugins composer https://plugins.nativephp.com
composer config --global http-basic.plugins.nativephp.com your@email.com your-license-key
composer require guppylab/routing:"^4.3.1"
php artisan native:plugin:register guppylab/routing
php artisan native:plugin:validate guppylab/routing
php artisan native:run
```
