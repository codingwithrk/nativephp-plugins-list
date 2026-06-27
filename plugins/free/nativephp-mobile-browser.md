---
name: "NativePHP Mobile Browser"
author: "Bifrost Technology"
price: "Free"
version: "1.0.1"
license: "MIT"
github: "https://github.com/NativePHP/mobile-browser"
support: "https://nativephp.com/support"
compatibility:
  nativephp: "^3.0"
  ios: "18.2+"
  android: "26+"
install:
  - "composer require nativephp/mobile-browser"
---

# NativePHP Mobile Browser

Open URLs in the system browser, in-app browser (Custom Tabs/SFSafariViewController), and handle OAuth authentication flows in NativePHP Mobile.

## Features

- Open URLs in embedded in-app browser
- Launch system default browser
- Specialized OAuth authentication flow with automatic redirect processing

## Installation

```bash
composer require nativephp/mobile-browser
```

## Compatibility

| Platform  | Minimum Version |
| --------- | --------------- |
| NativePHP | ^3.0            |
| iOS       | 18.2+           |
| Android   | API 26+         |

## API

```php
Browser::inApp($url);  // Embedded in-app browser
Browser::open($url);   // System browser
Browser::auth($url);   // OAuth authentication session
```
