---
name: "NativePHP Audio"
author: "Sagar Pansuriya"
price: "Free"
version: "1.3.1"
license: "MIT"
github: "https://github.com/theunwindfront/nativephp-audio"
support: "theunwindfront@gmail.com"
compatibility:
  nativephp: "^3.0"
  ios: "13.0+"
  android: "21+"
install:
  - "composer require theunwindfront/nativephp-audio"
  - "php artisan vendor:publish --tag=nativephp-plugins-provider"
  - "php artisan native:plugin:register theunwindfront/nativephp-audio"
events:
  - PlaybackStarted
  - PlaybackProgressUpdated
  - PlaylistTrackChanged
  - AudioFocusLost
  - RemotePlayReceived
  - SleepTimerExpired
  - StreamMetadataChanged
---

# NativePHP Audio

Professional audio playback for NativePHP Mobile — native OS integration, background services, and remote controls for Android and iOS.

## Features

- Native MediaSession integration (lock screen, Bluetooth, Android Auto/CarPlay)
- Background playback with foreground services and audio sessions
- Playlist management with shuffle/repeat modes
- Live radio streaming with real-time metadata
- Audio focus handling with auto-ducking
- Programmable sleep timers
- Rich metadata and artwork support

## Installation

```bash
composer require theunwindfront/nativephp-audio
php artisan vendor:publish --tag=nativephp-plugins-provider
php artisan native:plugin:register theunwindfront/nativephp-audio
```

## Compatibility

| Platform  | Minimum Version |
| --------- | --------------- |
| NativePHP | ^3.0            |
| iOS       | 13.0+           |
| Android   | API 21+         |

## Events

- `PlaybackStarted` — playback has begun
- `PlaybackProgressUpdated` — periodic playback position update
- `PlaylistTrackChanged` — active track in playlist changed
- `AudioFocusLost` — audio focus taken by another app
- `RemotePlayReceived` — remote control play command received
- `SleepTimerExpired` — configured sleep timer fired
- `StreamMetadataChanged` — live stream metadata updated
