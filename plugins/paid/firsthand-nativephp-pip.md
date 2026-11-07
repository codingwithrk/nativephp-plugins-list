---
name: "Picture in Picture"
author: "Molly Klein (The Firsthand Co.)"
price: "$99"
version: "1.0.1"
license: "Proprietary"
source: "https://nativephp.com/plugins/firsthand/nativephp-pip"
support: "https://nativephp.com/plugins/firsthand/nativephp-pip"
compatibility:
  nativephp: "^4.0"
  php: "^8.3"
  laravel: "^11|^12|^13"
  ios: "18.0+"
  android: "29+"
install:
  - "composer config repositories.nativephp-plugins composer https://plugins.nativephp.com"
  - "composer config http-basic.plugins.nativephp.com your@email.com your-license-key"
  - "php artisan vendor:publish --tag=nativephp-plugins-provider"
  - "composer require firsthand/nativephp-pip"
  - "php artisan native:plugin:register firsthand/nativephp-pip"
---

# Picture in Picture

Float video into a corner so users can keep watching while using other apps — Apple AVPlayer on iOS, Google Media3 on Android. No permissions required.

## Features

- **Floating window** — video shrinks into a corner and keeps playing while the user switches apps; moveable, resizable, and restorable to full screen
- **Auto-float** — leaving the app during playback floats the video automatically (`autoPip: false` to disable)
- **Casting** — cast button appears when a compatible TV is on the same Wi-Fi; AirPlay on iOS, Chromecast/Google TV on Android; HTTPS videos only
- **Playback control** — `pause()`, `resume()`, `seek()`, `stop()` while floating or casting
- **`VideoStateChanged` event** — reports `playing`, `paused`, `floating`, `casting`, `ended`, `closed`, and position in seconds
- **Lock-screen controls** — both native players expose media controls on the lock screen
- **Formats** — MP4, HLS (`.m3u8`) streams, and device-local video files

## Installation

```bash
composer config repositories.nativephp-plugins composer https://plugins.nativephp.com
composer config http-basic.plugins.nativephp.com your@email.com your-license-key
php artisan vendor:publish --tag=nativephp-plugins-provider
composer require firsthand/nativephp-pip
php artisan native:plugin:register firsthand/nativephp-pip
php artisan native:run
```
