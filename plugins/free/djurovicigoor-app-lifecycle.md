---
name: "App Lifecycle"
author: "Igor Djurovic"
price: "Free"
version: "1.0.0"
license: "MIT"
github: "https://github.com/djurovicigoor/app-lifecycle"
compatibility:
  nativephp: "^3.0"
  ios: "15.0+"
  android: "21+"
  php: "^8.2"
install:
  - "composer require djurovicigoor/app-lifecycle"
events:
  - AppForegrounded
  - AppBackgrounded
---

# App Lifecycle

App lifecycle state detection for NativePHP Mobile — detects foreground/background transitions on Android and iOS.

## Features

- Detects app foreground/background transitions on both platforms
- Suppresses false events on initial launch (Android) and screen rotation
- Multiple integration methods: Laravel events, Livewire components, JavaScript hooks

## Installation

```bash
composer require djurovicigoor/app-lifecycle
```

## Compatibility

| Platform  | Minimum Version |
| --------- | --------------- |
| NativePHP | ^3.0            |
| iOS       | 15.0+           |
| Android   | API 21+         |
| PHP       | ^8.2            |

## Events

Both events include a Unix timestamp (milliseconds) property.

- `AppForegrounded` — fires when the user returns the app to the foreground
- `AppBackgrounded` — fires when the user leaves the app
