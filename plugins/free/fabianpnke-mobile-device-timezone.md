---
name: "Device Timezone Plugin"
author: "fabianpnke"
price: "Free"
version: "latest"
license: "MIT"
github: "https://github.com/fabianpnke/mobile-device-timezone"
compatibility:
  nativephp: "^3.2.1 || ^4.0"
  php: "^8.2"
  android: "26+"
  ios: "16.0+"
install:
  - "composer require fabianpnke/mobile-device-timezone"
  - "php artisan vendor:publish --tag=nativephp-plugins-provider"
  - "php artisan native:plugin:register fabianpnke/mobile-device-timezone"
---

# Device Timezone Plugin

Reads the device's current IANA timezone identifier (e.g. `Europe/Vienna`) from a NativePHP Mobile app — the one piece of device info NativePHP core doesn't expose yet.

> **Platform:** iOS & Android. No permissions required.

## Features

- Reads the live IANA timezone identifier straight from the OS
- Works on both iOS and Android, no native permissions needed
- Returns `null` gracefully off-device (tests, `tinker`, `artisan serve`)
- Simple Facade API and a matching JS helper for Vue/React/Inertia

## Installation

```bash
composer require fabianpnke/mobile-device-timezone
php artisan vendor:publish --tag=nativephp-plugins-provider
php artisan native:plugin:register fabianpnke/mobile-device-timezone
php artisan native:plugin:list

This adds \Fabianpnke\MobileDeviceTimezone\DeviceTimezoneSeur plugins() array. Rebuild the app (native:run) afterwards.

Usage

use Fabianpnke\MobileDeviceTimezone\Facades\DeviceTimezone;

$identifier = DeviceTimezone::get(); // e.g. "Europe/Vienna

if ($identifier !== null) {
    $localNow = now($identifier);
}

JavaScript (Vue/React/Inertia)

import { DeviceTimezone } from '@fabianpnke/mobile-device-t

const identifier = await DeviceTimezone.get(); // e.g. "Eur

Platform Notes

┌──────────┬─────────────────────────────┐
│ Platform │           Source            │
├──────────┼─────────────────────────────┤
│ iOS      │ TimeZone.current.identifier │
├──────────┼─────────────────────────────┤
│ Android  │ TimeZone.getDefault().id    │
└──────────┴─────────────────────────────┘

No permissions required on either platform.
