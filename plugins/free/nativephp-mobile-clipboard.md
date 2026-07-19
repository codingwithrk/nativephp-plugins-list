---
name: "Mobile Clipboard"
author: "Bifrost Technology"
price: "Free"
version: "1.0.0"
license: "MIT"
github: "https://github.com/NativePHP/mobile-clipboard"
support: "https://nativephp.com/support"
compatibility:
  nativephp: "^3.0 || ^4.0"
  ios: "18.2+"
  android: "26+"
install:
  - "composer require nativephp/mobile-clipboard"
  - "php artisan native:plugin:register nativephp/mobile-clipboard"
---

# Mobile Clipboard

System clipboard access for NativePHP Mobile — copy and paste plain text with a two-method API.

## Features

- `writeText(string $text): bool` — copies text to the system clipboard
- `readText(): ?string` — reads text from the system clipboard
- Graceful degradation when the native bridge is unavailable
- Built-in testing helpers (`withClipboard`, `assertCopied`, `assertNothingCopied`)

## Installation

```bash
composer require nativephp/mobile-clipboard
php artisan native:plugin:register nativephp/mobile-clipboard
```

## Compatibility

| Platform  | Minimum Version |
| --------- | --------------- |
| NativePHP | ^3.0 \|\| ^4.0  |
| iOS       | 18.2+           |
| Android   | API 26+         |
