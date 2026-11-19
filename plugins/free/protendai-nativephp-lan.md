---
name: "LAN Transfer"
author: "Tendai Karuma"
price: "Free"
version: "1.0.0"
license: "MIT"
github: "https://github.com/protendai/nativephp-lan"
support: "https://nativephp.com/plugins/protendai/nativephp-lan"
compatibility:
  nativephp: "^4.0"
  ios: "15.0+"
  android: "29+"
install:
  - "composer require protendai/nativephp-lan"
  - "php artisan native:plugin:register protendai/nativephp-lan"
  - "php artisan vendor:publish --tag=lan-config"
---

# LAN Transfer

Local-network file transfer for NativePHP Mobile — devices discover each other over UDP multicast or HTTP subnet probing and exchange files without the internet.

> **No encryption:** Traffic is plain HTTP. Device fingerprints are not authentication.
>
> **iOS multicast:** Sending to a multicast group requires Apple's multicast entitlement.
>
> **iOS storage:** Received files stay in the app sandbox; no public-folder option on iOS.
>
> **iOS Wi-Fi status:** Always reported as enabled on iOS.
>
> **`native:jump` is not sufficient** — rebuild with `php artisan native:run` after installing.

## Features

- **Device discovery** — UDP multicast every 5 seconds; falls back to HTTP probing of the /24 subnet (handles routers that drop multicast)
- **Receive server** — embedded HTTP server streams uploads to disk; on Android can write to the public Downloads folder
- **Access control** — your PHP code decides who may send; each request waits for your app's response
- **Sending** — uses Laravel's `Http` client (testable with `Http::fake()`)
- **PIN protection** — optional PIN per transfer; wrong PINs trigger a lockout after repeated failures
- **Testing** — FakeBridge macros in the service provider
- **Utilities** — file/media pickers, thumbnails, open-file helper
- **Protocol** — derived from LocalSend v2; does not interoperate with the LocalSend app

## Installation

```bash
composer require protendai/nativephp-lan
php artisan native:plugin:register protendai/nativephp-lan
php artisan vendor:publish --tag=lan-config
php artisan native:run
```
