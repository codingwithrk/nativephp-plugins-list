---
name: "Wi-Fi Direct"
author: "Tendai Karuma"
price: "Free"
version: "1.0.0"
license: "MIT"
github: "https://github.com/protendai/nativephp-wifi-direct"
support: "https://nativephp.com/plugins/protendai/nativephp-wifi-direct"
compatibility:
  nativephp: "^4.0"
  ios: "15.0+"
  android: "29+"
install:
  - "composer require protendai/nativephp-wifi-direct"
  - "php artisan native:plugin:register protendai/nativephp-wifi-direct"
---

# Wi-Fi Direct

Phone-to-phone networking with no router or internet — one device hosts a Wi-Fi Direct group, the other joins, and both communicate over sockets or HTTP at `192.168.49.1`.

> **iOS joining is experimental.** In testing, joins sometimes time out; a fallback (e.g. shared Wi-Fi) is recommended for production.
>
> **iOS Info.plist:** Add camera and local network usage descriptions (required for QR scanning and host communication).
>
> **Permission conflict:** If another plugin or your app declares plain location permissions, a manifest conflict may occur. See the plugin docs for resolution steps.
>
> **Security:** The group passphrase appears in NativePHP's event logs — treat debug logs as sensitive.

## Features

- **Host/join** — Android can host and join; iOS can only join an Android group (experimental)
- **QR code pairing** — QR generation and scanning included
- **Silent join on Android 10+** — no system invitation dialog shown to the user
- **5 GHz support** — can be faster than routing through a home router
- **PHP facade + JavaScript library + test helpers**
- **`native:jump` is not sufficient** — rebuild with `php artisan native:run` after installing (native code must compile in)

## Installation

```bash
composer require protendai/nativephp-wifi-direct
php artisan native:plugin:register protendai/nativephp-wifi-direct
php artisan native:run
```

Add a Vite alias pointing to `resources/js/index.js` inside the package for the JavaScript library.
