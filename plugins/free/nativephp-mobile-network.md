---
name: "NativePHP Mobile Network"
author: "Bifrost Technology"
price: "Free"
version: "1.0.1"
license: "MIT"
github: "https://github.com/NativePHP/mobile-network"
support: "https://nativephp.com/support"
compatibility:
  nativephp: "^3.0"
  ios: "18.2+"
  android: "26+"
install:
  - "composer require nativephp/mobile-network"
---

# NativePHP Mobile Network

Network connectivity status monitoring for NativePHP Mobile — connection type, metered status, and Low Data Mode detection.

## Features

- Network connectivity status detection
- Connection type identification (wifi, cellular, ethernet, unknown)
- Metered connection detection
- Low Data Mode detection (iOS)
- PHP (Livewire/Blade) and JavaScript (Vue/React/Inertia) APIs

## Installation

```bash
composer require nativephp/mobile-network
```

## Compatibility

| Platform  | Minimum Version |
| --------- | --------------- |
| NativePHP | ^3.0            |
| iOS       | 18.2+           |
| Android   | API 26+         |

## Response Properties

| Property        | Type    | Description                        |
| --------------- | ------- | ---------------------------------- |
| `connected`     | boolean | Whether device is online           |
| `type`          | string  | wifi / cellular / ethernet / unknown |
| `isExpensive`   | boolean | Cellular or hotspot connection     |
| `isConstrained` | boolean | Low Data Mode active (iOS)         |
