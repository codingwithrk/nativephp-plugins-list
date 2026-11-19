---
name: "Video Rooms"
author: "Paul (PARTek)"
price: "$99"
version: "1.0.1"
license: "Proprietary"
source: "https://nativephp.com/plugins/partek/video-rooms"
support: "https://nativephp.com/plugins/partek/video-rooms"
compatibility:
  nativephp: "^4.6.1"
  ios: "18.0+"
  android: "26+"
install:
  - "composer config repositories.nativephp-plugins composer https://plugins.nativephp.com"
  - "composer config http-basic.plugins.nativephp.com your@email.com your-license-key"
  - "php artisan vendor:publish --tag=nativephp-plugins-provider"
  - "composer require partek/video-rooms"
  - "php artisan native:plugin:register partek/video-rooms"
---

# Video Rooms

Native video calling for NativePHP Mobile via LiveKit — one call opens a full-screen native video room with mute, camera, flip, and hang-up controls.

> **LiveKit server required:** LiveKit Cloud (free tier available) or self-hosted. You need the server URL, API key, and API secret.
>
> The API secret stays on your server — `AccessToken::make()` creates room tokens server-side so the secret never reaches the device.

## Features

- **`VideoRooms::join()`** — one call opens a native full-screen video room
- **In-call controls** — mute, camera on/off, flip camera, hang up
- **Server-side tokens** — `AccessToken::make()` Laravel helper signs room tokens
- **Events** — `RoomConnected`, `RoomDisconnected`, `ParticipantJoined`, `ParticipantLeft`, `LocalMediaChanged`
- **Voice-only mode** — and listen-only viewer support
- **iOS background audio** — video keeps playing via audio background mode
- **Adaptive video** — LiveKit adaptive stream and dynacast enabled
- **Portrait-friendly** — video stays upright regardless of device orientation
- **Testing helpers** — fakes for NativePHP's bridge
- **JavaScript API** — `join()` and `leave()`

## Installation

```bash
composer config repositories.nativephp-plugins composer https://plugins.nativephp.com
composer config http-basic.plugins.nativephp.com your@email.com your-license-key
php artisan vendor:publish --tag=nativephp-plugins-provider
composer require partek/video-rooms
php artisan native:plugin:register partek/video-rooms
php artisan native:run
```
