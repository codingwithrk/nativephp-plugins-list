---
name: "Speech to Text"
author: "Paul (PARTek)"
price: "$29"
version: "1.0.0"
license: "Proprietary"
source: "https://nativephp.com/plugins/partek/speech-to-text"
support: "https://nativephp.com/plugins/partek/speech-to-text"
compatibility:
  nativephp: "^3.0 || ^4.0"
  ios: "18.0+"
  android: "26+"
install:
  - "composer config repositories.nativephp-plugins composer https://plugins.nativephp.com"
  - "composer config http-basic.plugins.nativephp.com your@email.com your-license-key"
  - "php artisan vendor:publish --tag=nativephp-plugins-provider"
  - "composer require partek/speech-to-text"
  - "php artisan native:plugin:register partek/speech-to-text"
---

# Speech to Text

On-device speech recognition / dictation for NativePHP Mobile — iOS uses `SFSpeechRecognizer`, Android uses `SpeechRecognizer`/`RecognizerIntent`. Returns text via events, does not save audio recordings.

## Features

- **`SpeechToText::listen($locale, $partial)`** — BCP-47 locale (e.g. `en-US`), optional partial results
- **`SpeechToText::stop()`** — ends session and keeps final transcript
- **`SpeechToText::cancel()`** — ends session and discards transcript
- **Events** — `SpeechPartial` (live hypothesis), `SpeechResult` (final + `isFinal`), `SpeechFailed`, `PermissionDenied`
- **Prefers on-device recognition** where available (iOS and Android API 31+)
- **Runtime permissions** — `RECORD_AUDIO` on Android; microphone + speech recognition on iOS
- **Android silence timeout** extended to 3000ms (vs OS default ~1000ms)
- **JavaScript API** — `listen()`, `stop()`, `cancel()` from `partek-speech-to-text`

## Installation

```bash
composer config repositories.nativephp-plugins composer https://plugins.nativephp.com
composer config http-basic.plugins.nativephp.com your@email.com your-license-key
php artisan vendor:publish --tag=nativephp-plugins-provider
composer require partek/speech-to-text
php artisan native:plugin:register partek/speech-to-text
```
