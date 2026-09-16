---
name: "Text to Speech"
author: "Paul (PARTek)"
price: "$29"
version: "1.0.0"
license: "Proprietary"
source: "https://nativephp.com/plugins/partek/text-to-speech"
support: "https://nativephp.com/plugins/partek/text-to-speech"
compatibility:
  nativephp: "^3.0 || ^4.0"
  ios: "18.0+"
  android: "26+"
install:
  - "composer config repositories.nativephp-plugins composer https://plugins.nativephp.com"
  - "composer config http-basic.plugins.nativephp.com your@email.com your-license-key"
  - "php artisan vendor:publish --tag=nativephp-plugins-provider"
  - "composer require partek/text-to-speech"
  - "php artisan native:plugin:register partek/text-to-speech"
---

# Text to Speech

On-device text-to-speech using the OS's own speech engine — iOS uses `AVSpeechSynthesizer`, Android uses `android.speech.tts.TextToSpeech`. No cloud TTS, no network dependency, no extra permissions.

## Features

- **`TextToSpeech::speak($text, $locale, $rate, $pitch)`** — start speaking
- **`stop()`, `pause()`, `resume()`, `isSpeaking()`** controls
- **BCP-47 locale** support (e.g. `en-US`, `en-GB`)
- **Rate** (0.1–1.0) and **pitch** (0.5–2.0) control
- **Events** — `SpeechStarted`, `SpeechFinished`, `SpeechFailed`
- Works with Livewire, Blade, and JavaScript (Vue/React/Inertia)
- **No permissions required** on either platform

## Installation

```bash
composer config repositories.nativephp-plugins composer https://plugins.nativephp.com
composer config http-basic.plugins.nativephp.com your@email.com your-license-key
php artisan vendor:publish --tag=nativephp-plugins-provider
composer require partek/text-to-speech
php artisan native:plugin:register partek/text-to-speech
```
