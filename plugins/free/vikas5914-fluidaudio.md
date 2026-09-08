---
name: "FluidAudio"
author: "Vikas Kapadiya"
price: "Free"
version: "1.1.0"
license: "MIT"
github: "https://github.com/vikas5914/fluidaudio"
support: "https://github.com/vikas5914/fluidaudio/issues"
compatibility:
  nativephp: "^3.0 || ^4.0"
  ios: "18.0+"
  android: "29+ (stub only)"
install:
  - "composer require vikas5914/fluidaudio"
  - "php artisan native:plugin:register vikas5914/fluidaudio"
---

# FluidAudio

On-device speech recognition via FluidAudio (Apple Core ML) for NativePHP Mobile. Transcribe audio files or stream from the microphone in real time — all on-device, no cloud required.

> **Note:** Android support is a stub only. Full functionality is iOS-only.

## Features

- **Batch file ASR** — download model packs, then transcribe audio files with `transcribeFile()`
- **Microphone streaming** — real-time partial transcripts using Parakeet EOU models
- **Non-blocking** — all calls return immediately with request IDs; results arrive via events
- **Multiple model variants** — English v2 or multilingual v3 for batch; 160ms/320ms/1280ms latency options for streaming
- **Model caching** — downloaded models persist on-device for reuse
- **JavaScript client** — `@vikas5914/fluidaudio` npm package for Inertia/Vue/React

## Installation

```bash
composer require vikas5914/fluidaudio
php artisan native:plugin:register vikas5914/fluidaudio
```

## iOS Permissions

The plugin declares `NSMicrophoneUsageDescription` and audio background mode automatically.
