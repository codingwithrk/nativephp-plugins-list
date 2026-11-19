---
name: "Native Calls"
author: "Paul (PARTek)"
price: "$99"
version: "1.1.0"
license: "Proprietary"
source: "https://nativephp.com/plugins/partek/native-calls"
support: "https://nativephp.com/plugins/partek/native-calls"
compatibility:
  nativephp: "^4.6.1"
  php: "^8.2"
  ios: "18.0+"
  android: "28+"
install:
  - "composer config repositories.nativephp-plugins composer https://plugins.nativephp.com"
  - "composer config http-basic.plugins.nativephp.com your@email.com your-license-key"
  - "php artisan vendor:publish --tag=nativephp-plugins-provider"
  - "composer require partek/native-calls"
  - "php artisan native:plugin:register partek/native-calls"
---

# Native Calls

Native incoming and outgoing call UI for NativePHP Mobile — CallKit on iOS (including VoIP push while the app is closed), Telecom framework on Android. Does not carry audio or video; your calling SDK handles media.

> **iOS VoIP push:** Enable push notifications in `config/nativephp.php` and send pushes with an APNs key.
>
> **iOS limitation:** One call at a time; CallKit is unavailable on the China App Store.
>
> **Android closed-app ringing:** Requires a push service not included in this version.
>
> **Google Play:** A full-screen intent declaration is required (granted by default for calling apps).

## Features

- **Incoming call UI** — full CallKit screen on iOS (including from closed state via VoIP push); Answer/Decline notification on Android via Telecom framework
- **Outgoing calls** — shown in the device's recent calls list
- **In-call controls** — mute, hold, and audio-session events for your calling SDK
- **Built-in in-call screen** — caller name, timer, Mute, and End buttons (can be disabled)
- **Ring timeout** — unanswered calls end as missed with a "Missed call" notification
- **Recovery** — reports `app_restarted` for calls cut off by an app restart
- **Android locked-screen** — checks full-screen intent permission and opens settings if not granted
- **Testing helpers** — fakes for the native bridge and in-call screen actions

## Installation

```bash
composer config repositories.nativephp-plugins composer https://plugins.nativephp.com
composer config http-basic.plugins.nativephp.com your@email.com your-license-key
php artisan vendor:publish --tag=nativephp-plugins-provider
composer require partek/native-calls
php artisan native:plugin:register partek/native-calls
php artisan native:run
```
