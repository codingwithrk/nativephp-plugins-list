---
name: "NativePHP Mobile Dialog"
author: "Bifrost Technology"
price: "Free"
version: "1.0.1"
license: "MIT"
github: "https://github.com/NativePHP/mobile-dialog"
support: "https://nativephp.com/support"
compatibility:
  nativephp: "^3.0"
  ios: "18.2+"
  android: "26+"
install:
  - "composer require nativephp/mobile-dialog"
events:
  - ButtonPressed
---

# NativePHP Mobile Dialog

Native alert dialogs and toast notifications for NativePHP Mobile applications.

## Features

- Cross-platform native alert dialogs
- Toast/snackbar notifications with configurable duration (short: 2s, long: 4s)
- Custom button handling with event callbacks
- Alert identification system for tracking user interactions
- Session-based alert persistence via `remember()` method

## Installation

```bash
composer require nativephp/mobile-dialog
```

## Compatibility

| Platform  | Minimum Version |
| --------- | --------------- |
| NativePHP | ^3.0            |
| iOS       | 18.2+           |
| Android   | API 26+         |

## Events

- `ButtonPressed` — triggered when a dialog button is tapped; includes index, label, and optional alert ID
