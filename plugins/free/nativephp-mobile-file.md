---
name: "NativePHP Mobile File"
author: "Bifrost Technology"
price: "Free"
version: "1.0.1"
license: "MIT"
github: "https://github.com/NativePHP/mobile-file"
support: "https://nativephp.com/support"
compatibility:
  nativephp: "^3.0"
  ios: "18.2+"
  android: "26+"
install:
  - "composer require nativephp/mobile-file"
---

# NativePHP Mobile File

File operations (move, copy) for NativePHP Mobile applications with cross-platform file manipulation.

## Features

- Move files between locations
- Copy files with automatic parent directory creation
- Overwrite existing destination files
- File integrity verification
- Android cross-filesystem fallback (copy + delete if rename fails)

## Installation

```bash
composer require nativephp/mobile-file
```

## Compatibility

| Platform  | Minimum Version |
| --------- | --------------- |
| NativePHP | ^3.0            |
| iOS       | 18.2+           |
| Android   | API 26+         |

## API

```php
File::move(string $from, string $to): array;
File::copy(string $from, string $to): array;
```
