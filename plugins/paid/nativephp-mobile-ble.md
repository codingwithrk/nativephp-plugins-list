---
name: "Mobile BLE"
author: "Bifrost Technology"
price: "$49"
version: "1.0.0"
license: "Proprietary"
source: "https://nativephp.com/plugins/nativephp/mobile-ble"
support: "https://nativephp.com/plugins/nativephp/mobile-ble"
compatibility:
  nativephp: "^3.0 || ^4.0"
  ios: "18.2+"
  android: "26+"
install:
  - "composer config repositories.nativephp-plugins composer https://plugins.nativephp.com"
  - "composer config http-basic.plugins.nativephp.com your@email.com your-license-key"
  - "composer require nativephp/mobile-ble"
  - "php artisan native:plugin:register nativephp/mobile-ble"
---

# Mobile BLE

Bluetooth Low Energy scanning and connection tracking for NativePHP Mobile — scan peripherals, connect to them, and monitor presence states from Laravel without reading GATT characteristics.

## Features

- **BLE device scanning** with optional service UUID filtering
- **Connection management** and state tracking
- **System peripheral discovery**
- **Device reconnection** on app launch
- **Background connection support** on iOS
- **Event-driven** — `DeviceDiscovered`, `DeviceConnected`, `ConnectionFailed`
- **Testing utilities** for mocking the BLE radio

## Installation

```bash
composer config repositories.nativephp-plugins composer https://plugins.nativephp.com
composer config http-basic.plugins.nativephp.com your@email.com your-license-key
composer require nativephp/mobile-ble
php artisan native:plugin:register nativephp/mobile-ble
```
