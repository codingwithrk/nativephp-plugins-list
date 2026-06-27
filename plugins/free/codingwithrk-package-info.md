---
name: "Package Info"
author: "CodingwithRK"
price: "Free"
version: "1.0.0"
license: "MIT"
github: "https://github.com/codingwithrk/package-info"
support: "codingwithrk@gmail.com"
compatibility:
  nativephp: "^3.0"
  ios: "13.0+"
  android: "21+"
install:
  - "composer require codingwithrk/package-info"
  - "php artisan native:plugin:register codingwithrk/package-info"
events:
  - PackageInfoRetrieved
---

# Package Info

Query application package information from NativePHP Mobile — similar to Flutter's `package_info_plus`.

## Features

- Query app name, package name, version, and build number
- Retrieve installer store information
- Convert data to array format
- Auto-discovered service provider

## Installation

```bash
composer require codingwithrk/package-info
php artisan native:plugin:register codingwithrk/package-info
```

## Compatibility

| Platform  | Minimum Version |
| --------- | --------------- |
| NativePHP | ^3.0            |
| iOS       | 13.0+           |
| Android   | API 21+         |

## Events

- `PackageInfoRetrieved` — dispatched after successful data retrieval
