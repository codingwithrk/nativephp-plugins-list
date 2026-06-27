---
name: "All Permission Handler"
author: "Bhargav Detroja"
price: "Free"
version: "1.0.2"
license: "MIT"
github: "https://github.com/BhargavDetroja/nativephp-all-permission-handler"
support: "bhargavdetroja@gmail.com"
compatibility:
  nativephp: "^3.0"
  ios: "15.0+"
  android: "21+"
  php: "8.2+"
install:
  - "composer require bhargavdetroja/nativephp-all-permission-handle"
---

# All Permission Handler

Manages runtime permission checks and requests for iOS and Android from Laravel applications. API aligned to Flutter's `permission_handler` naming conventions.

## Features

- Check permission status
- Request single or multiple permissions
- Service status verification (location services, notifications)
- Open app settings
- Android `shouldShowRequestRationale` support
- Safe-by-default — no permissions enabled until configured
- PHP and JavaScript APIs with fluent callback support

## Installation

```bash
composer require bhargavdetroja/nativephp-all-permission-handle
```

## Compatibility

| Platform  | Minimum Version |
| --------- | --------------- |
| NativePHP | ^3.0            |
| iOS       | 15.0+           |
| Android   | API 21+         |
| PHP       | 8.2+            |
