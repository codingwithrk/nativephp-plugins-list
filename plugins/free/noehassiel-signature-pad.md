---
name: "Signature Pad"
author: "noehassiel"
price: "Free"
version: "0.1.3"
license: "MIT"
github: "https://github.com/noehassiel/signature-pad"
support: "https://github.com/noehassiel/signature-pad/issues"
compatibility:
  nativephp: "^4.0"
  ios: "16.0+"
  android: "26+"
install:
  - "composer require noehassiel/signature-pad"
  - "php artisan vendor:publish --tag=nativephp-plugins-provider"
  - "php artisan native:plugin:register noehassiel/signature-pad"
---

# Signature Pad

Native freehand signature capture for NativePHP Mobile — rendered with SwiftUI Path (iOS) and Compose Canvas (Android) — exported as a base64-encoded PNG data URL compatible with existing web form endpoints.

## Features

- **EDGE element** — `<native:signature-pad>` Blade tag
- **No permissions required** on either platform
- **Customizable** pen color, stroke width, and styling via Tailwind classes
- **Read-only mode** for displaying existing signatures
- **Undo and clear** via token-based props
- **Offline-friendly** — emits on stroke end, no network required
- **Existing signature display** support
- **Event-driven** — stroke-end callbacks

## Installation

```bash
composer require noehassiel/signature-pad
php artisan vendor:publish --tag=nativephp-plugins-provider
php artisan native:plugin:register noehassiel/signature-pad
```

## Usage

```blade
<native:signature-pad
    class="w-full h-48 border rounded-lg"
    pen-color="#000000"
    stroke-width="3"
/>
```
