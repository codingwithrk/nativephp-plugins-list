---
name: "NativePHP Mobile Microphone"
author: "Bifrost Technology"
price: "Free"
version: "1.0.1"
license: "MIT"
github: "https://github.com/NativePHP/mobile-microphone"
support: "https://nativephp.com/support"
compatibility:
  nativephp: "^3.0"
  ios: "18.2+"
  android: "26+"
install:
  - "composer require nativephp/mobile-microphone"
events:
  - MicrophoneRecorded
---

# NativePHP Mobile Microphone

Microphone recording for NativePHP Mobile — audio recording with pause/resume support and background recording capability.

## Features

- Audio recording with pause/resume functionality
- Background recording support (configurable)
- Unique identifier tracking for recordings
- Custom event dispatching
- Session persistence with `remember()`
- M4A/AAC file format output
- Native permission handling
- Fluent API interface

## Installation

```bash
composer require nativephp/mobile-microphone
```

## Compatibility

| Platform  | Minimum Version |
| --------- | --------------- |
| NativePHP | ^3.0            |
| iOS       | 18.2+           |
| Android   | API 26+         |

## Events

- `MicrophoneRecorded` — dispatched on recording completion; includes file path, MIME type, and optional ID
