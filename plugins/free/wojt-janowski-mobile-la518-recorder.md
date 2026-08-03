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

# MobileLa518Recorder — NativePHP plugin for LA518 voice recorders

A NativePHP Mobile plugin that talks to LA518-based BLE voice recorders
(Umevo Note Plus and OEM rebadges using the same chip). Connect, list
recordings, start/stop recording from your app, download MP3s, and consume
live audio + VU level data — all from PHP and JavaScript.

The full BLE protocol was reverse-engineered from PacketLogger captures of
the official iOS app. See [`PROTOCOL.md`](PROTOCOL.md) for the complete
wire-level spec — frame format, opcode table, handshake sequence, file
listing, recording control, downloads, live VU/audio streams, and
end-of-transfer flag semantics.

## Installation

```bash
composer require wojt-janowski/mobile-la518-recorder
php artisan vendor:publish --tag=nativephp-plugins-provider     # first time only
php artisan native:plugin:register wojt-janowski/mobile-la518-recorder
php artisan native:plugin:list                                    # verify
```

## Permissions

### Android (auto-merged into your `AndroidManifest.xml`)
- `BLUETOOTH`, `BLUETOOTH_ADMIN`
- `BLUETOOTH_SCAN`, `BLUETOOTH_CONNECT` (Android 12+)
- `ACCESS_FINE_LOCATION` (required for BLE scanning)

### iOS (auto-merged into your `Info.plist`)
- `NSBluetoothAlwaysUsageDescription`
- `NSBluetoothPeripheralUsageDescription`

You'll be prompted by the OS the first time `connect()` is called.

## PHP usage (Livewire/Blade)

```php
use WojtJanowski\MobileLa518Recorder\Facades\MobileLa518Recorder;

// Discover and bind. Returns 15-char device serial, or null on failure.
$serial = MobileLa518Recorder::connect();

// List stored recordings — array of ['name' => '...', 'size' => bytes, 'duration' => seconds]
$files = MobileLa518Recorder::listFiles();

// Start a new recording on the device
$filename = MobileLa518Recorder::startRecording();

// …user does something for a while…

// Stop. Returns ['filename' => '...', 'size' => bytes, 'mode' => 'normal'|'call']
$ack = MobileLa518Recorder::stopRecording();

// Download a stored recording. Returns absolute local file path.
$localPath = MobileLa518Recorder::downloadFile($filename);
```

### Listening to events

```php
use Native\Mobile\Attributes\OnNative;
use WojtJanowski\MobileLa518Recorder\Events\{
    DeviceConnected, DeviceDisconnected,
    RecordingStarted, RecordingStopped,
    VuLevel, LiveAudioChunk,
    DownloadProgress, DownloadCompleted,
};

class Recorder extends Livewire\Component
{
    public int $vuLevel = 0;

    #[OnNative(VuLevel::class)]
    public function onVu($level, $deltaSinceLast)
    {
        $this->vuLevel = $level;
    }

    #[OnNative(LiveAudioChunk::class)]
    public function onChunk($filename, $base64Data, $sequenceIndex)
    {
        // base64-decode into a buffer, stream to a transcriber, etc.
    }

    #[OnNative(RecordingStopped::class)]
    public function onStopped($filename, $size, $mode)
    {
        // Recording is now persisted on the device — fetch it
        $localPath = MobileLa518Recorder::downloadFile($filename);
    }
}
```

## JavaScript usage (Vue/React/Inertia)

```js
import { MobileLa518Recorder, Events } from '@wojt-janowski/mobile-la518-recorder';
import { on, off } from '@nativephp/native';

const serial = await MobileLa518Recorder.connect();
const files  = await MobileLa518Recorder.listFiles();

const handler = ({ level }) => updateMeter(level);
on(Events.VuLevel, handler);

await MobileLa518Recorder.startRecording();
// …
const result = await MobileLa518Recorder.stopRecording();

off(Events.VuLevel, handler);
```

## Available methods

| Method | Returns | Notes |
|---|---|---|
| `connect(int $scanTimeoutSeconds = 10)` | `string\|null` | Device serial. Requests fast BLE mode. |
| `disconnect()` | `bool` | Closes BLE link; **does not** stop a running recording. |
| `isConnected()` | `bool` | |
| `listFiles()` | `array` | Each row: `['name', 'size', 'duration']`. |
| `startRecording()` | `string\|null` | Recording filename (`YYYYMMDDHHMMSS`). |
| `stopRecording()` | `array\|null` | `['filename', 'size', 'mode']`, mode = `normal` or `call`. |
| `downloadFile(string $name)` | `string\|null` | Absolute local file path. |

## Event payloads

| Event | Properties |
|---|---|
| `DeviceConnected` | `serial: string` |
| `DeviceDisconnected` | `reason: ?string` |
| `RecordingStarted` | `filename: string` |
| `RecordingStopped` | `filename: string`, `size: int`, `mode: string` |
| `VuLevel` | `level: int (0..65535)`, `deltaSinceLast: int` |
| `LiveAudioChunk` | `filename: string`, `base64Data: string` (raw F0F3 chunk), `sequenceIndex: int` |
| `DownloadProgress` | `filename: string`, `bytesReceived: int`, `totalBytes: int` |
| `DownloadCompleted` | `filename: string`, `localPath: string`, `size: int` |

## Protocol reference

The complete reverse-engineered BLE protocol — GATT layout, frame format,
every opcode, the bind handshake, file-listing format, recording control,
download flow, live VU/audio streams, and call-mode flag semantics — is
documented in [`PROTOCOL.md`](PROTOCOL.md).

Quick summary:

- Audio output: **MP3, 32 kbps, 16 kHz, mono**
- Custom GATT service `F0F0` with TX (`F0F1`), control RX (`F0F2`), live
  stream (`F0F3`), and download stream (`F0F4`) characteristics
- Frame envelope: `80 08 02 [op] [len] [body] [trailer]`
- Mandatory bind handshake within ~3 s of connecting (challenge `"131186"`)
