---
name: "WiFi Radar"
author: "Neo Nos"
price: "Free"
version: "0.2.3"
license: "MIT"
github: "https://github.com/all1web/nativephp-wifi-scan"
support: "https://github.com/all1web/nativephp-wifi-scan/issues"
compatibility:
  nativephp: "^3.0 || ^4.0"
  ios: "13.0+ (no public API)"
  android: "23+"
install:
  - "composer require all1web/nativephp-wifi-scan"
  - "php artisan native:plugin:register all1web/nativephp-wifi-scan"
  - "php artisan native:install android --force"
---

# WiFi Radar

Scans visible WiFi access points from PHP code, reads the currently connected network, and generates device-location fingerprints using BSSID signatures — no Kotlin required.

> **Note:** iOS has no public API for WiFi scanning; this plugin is Android-only for active scanning. iOS returns the connected network info only.

## Features

- **Full AP enumeration** — every access point in range with SSID, BSSID, RSSI, and frequency
- **Connected network detection** — identify the current access point by BSSID
- **Place fingerprinting** — order-independent location detection via BSSID signatures
- **Event-driven** — scan completion fires a native event to PHP/JS
- **Auto permission handling** — Android 6.0+ location permission managed automatically
- **JavaScript module** — works with Inertia, Vue, React, and vanilla JS
- **Diagnostic command** — `php artisan wifi-scan:doctor` for troubleshooting

## Installation

```bash
composer require all1web/nativephp-wifi-scan
php artisan native:plugin:register all1web/nativephp-wifi-scan
php artisan native:install android --force
```

## Diagnostics

```bash
php artisan wifi-scan:doctor
```
