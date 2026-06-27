---
name: "Open Sound Control (OSC)"
author: "Context Undefined"
price: "$29"
version: "1.0.0"
license: "Proprietary"
source: "https://nativephp.com/plugins/weswecan/nativephp-mobile-osc"
support: "support@weswecan.com"
compatibility:
  nativephp: "^3"
  ios: "15.0+"
  android: "21+"
  php: "^8.2"
install:
  - "composer require weswecan/nativephp-mobile-osc"
  - "php artisan native:plugin:register weswecan/nativephp-mobile-osc"
events:
  - OscMessageReceived
  - OscBundleReceived
  - OscListenerStarted
  - OscListenerStopped
  - OscMessageSent
  - OscError
---

# Open Sound Control (OSC)

Send and receive OSC messages over UDP on iOS and Android — for show control, audio, lighting, Arduino, and ESP32 workflows, with PHP facades, Swift/Kotlin bridges, and typed JavaScript clients.

## Features

- UDP-based OSC messaging (no TCP)
- Multiple simultaneous listeners with distinct IDs
- Typed argument support (int, float, string, blob)
- Bundle transmission
- Local address discovery
- Foreground-first lifecycle handling
- Event-driven architecture (JavaScript and PHP)

## Installation

```bash
composer require weswecan/nativephp-mobile-osc
php artisan native:plugin:register weswecan/nativephp-mobile-osc
```

## Compatibility

| Platform   | Minimum Version |
| ---------- | --------------- |
| NativePHP  | ^3              |
| iOS        | 15.0+           |
| Android    | API 21+         |
| PHP        | ^8.2            |

## Events

- `OscMessageReceived` — incoming OSC message
- `OscBundleReceived` — incoming OSC bundle
- `OscListenerStarted` — listener started successfully
- `OscListenerStopped` — listener stopped
- `OscMessageSent` — outgoing message confirmed
- `OscError` — error during send or receive
