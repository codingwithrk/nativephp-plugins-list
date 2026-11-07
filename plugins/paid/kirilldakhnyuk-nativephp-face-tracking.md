---
name: "Face Tracking"
author: "Kirill Dakhnyuk"
price: "$29"
version: "1.0.0"
license: "Proprietary"
source: "https://nativephp.com/plugins/kirilldakhnyuk/nativephp-face-tracking"
support: "https://nativephp.com/plugins/kirilldakhnyuk/nativephp-face-tracking"
compatibility:
  nativephp: "^4.5.2"
  php: "^8.4"
  ios: "16.0+"
  android: "24+"
install:
  - "composer config repositories.nativephp-plugins composer https://plugins.nativephp.com"
  - "composer config http-basic.plugins.nativephp.com your@email.com your-license-key"
  - "php artisan vendor:publish --tag=nativephp-plugins-provider"
  - "composer require kirilldakhnyuk/nativephp-face-tracking"
  - "php artisan native:plugin:register kirilldakhnyuk/nativephp-face-tracking"
---

# Face Tracking

Real-time face gesture detection for NativePHP Mobile — 13 preset gestures plus custom combos, powered by MediaPipe on Android and ARKit on iOS.

> **iOS:** Device only, not the Simulator. Requires a device with face-tracking support.
> **Android:** Beta. Front camera required. Gaze direction and some blend shapes are unavailable.

## Gesture Presets (13)

Blink, smile, left wink, right wink, jaw open, brow raise, tilt left, tilt right, tilt up, tilt down, nod, shake, tongue out *(iOS only)*

## Features

- **Custom gestures** — combine expression or head-angle conditions with configurable threshold, duration, and cooldown
- **`<native:face-tracking-preview>`** — camera preview component with mirror option, face mesh display (iOS only), and hidden-tracking mode
- **Face data snapshots** — read blend shapes, head rotation/position, and gaze direction on demand
- **Events** — gesture detected, face detected, face lost, frame updated, tracking failure
- **Streaming** — optional regular face-data updates at 1–30 events per second
- **Bundled MediaPipe model** — Apache 2.0 licensed

## Installation

```bash
composer config repositories.nativephp-plugins composer https://plugins.nativephp.com
composer config http-basic.plugins.nativephp.com your@email.com your-license-key
php artisan vendor:publish --tag=nativephp-plugins-provider
composer require kirilldakhnyuk/nativephp-face-tracking
php artisan native:plugin:register kirilldakhnyuk/nativephp-face-tracking
php artisan native:run
```
