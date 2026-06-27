---
name: "Mobile LA518 Recorder"
author: "Wojt Janowski"
price: "Free"
version: "latest"
license: "MIT"
github: "https://github.com/wojt-janowski/mobile-la518-recorder"
compatibility:
  nativephp: "^3.0"
  php: "^8.2"
  ios: "any"
  android: "any"
install:
  - "composer require wojt-janowski/mobile-la518-recorder"
  - "php artisan vendor:publish --tag=nativephp-plugins-provider"
  - "php artisan native:plugin:register wojt-janowski/mobile-la518-recorder"
events:
  - Connected
  - Disconnected
  - FileListed
  - RecordingStarted
  - RecordingStopped
  - FileDownloaded
  - AudioDataReceived
  - VuLevelReceived
---

# Mobile LA518 Recorder

NativePHP Mobile plugin for LA518-based BLE voice recorders (Umevo Note Plus and OEM rebadges). Connect, list recordings, start/stop recording, download MP3s, and consume live audio and VU level data — all from PHP and JavaScript.

> The full BLE protocol was reverse-engineered from PacketLogger captures of the official iOS app. See `PROTOCOL.md` for the complete wire-level spec.

## Permissions

**Android** (auto-merged): `BLUETOOTH`, `BLUETOOTH_ADMIN`, `BLUETOOTH_SCAN`, `BLUETOOTH_CONNECT` (Android 12+), `ACCESS_FINE_LOCATION`

**iOS** (auto-merged): `NSBluetoothAlwaysUsageDescription`, `NSBluetoothPeripheralUsageDescription`

## Installation

```bash
composer require wojt-janowski/mobile-la518-recorder
php artisan vendor:publish --tag=nativephp-plugins-provider
php artisan native:plugin:register wojt-janowski/mobile-la518-recorder
```

## Usage

```php
use WojtJanowski\MobileLa518Recorder\Facades\MobileLa518Recorder;

// Connect and get device serial
$serial = MobileLa518Recorder::connect();

// List stored recordings
$files = MobileLa518Recorder::listFiles();

// Record
MobileLa518Recorder::startRecording();
MobileLa518Recorder::stopRecording();

// Download a file
$localPath = MobileLa518Recorder::downloadFile($filename);
```

## Events

- `Connected` / `Disconnected` — BLE device connection state changes
- `FileListed` — list of recordings returned from device
- `RecordingStarted` / `RecordingStopped` — recording state changes with filename and size
- `FileDownloaded` — download complete with local file path
- `AudioDataReceived` — live PCM audio chunk from the device
- `VuLevelReceived` — live VU meter level update
