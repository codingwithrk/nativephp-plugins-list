---
name: "NativePHP UI"
author: "CodingwithRK"
price: "₹5,000"
version: "1.0.1"
license: "Proprietary"
source: "https://marketplace.codingwithrk.com/products/nativephp-ui"
support: "https://marketplace.codingwithrk.com/products/nativephp-ui"
compatibility:
  nativephp: "^4.5"
  ios: "18.2+"
  android: "26+"
install:
  - "composer require codingwithrk/nativephp-ui"
  - "php artisan native:plugin:register codingwithrk/nativephp-ui"
  - "php artisan vendor:publish --tag=nativephp-ui-config"
---

# NativePHP UI

30+ components and 50+ Blade tags that render as native SwiftUI and Jetpack Compose views — a complete UI kit for NativePHP Mobile, no native code required.

> Built on NativePHP's EDGE elements. No rebuild needed to update components — everything is pure PHP on top of the SuperNative layer.

## Features

- **30+ components, 50+ tags** — Button, Badge, Card, Alert, Accordion, Tabs, Toggle, Dialog, Sheet, Drawer, Item Groups, Empty States, and more
- **shadcn/ui design system** — neutral, zinc, slate, stone, and gray base colors with configurable accent themes
- **Automatic light/dark mode** — adapts to the device's system appearance with no extra configuration
- **Two-way binding** — `native:model` for forms, inputs, switches, checkboxes, and radio groups
- **SwiftUI on iOS, Jetpack Compose on Android** — truly native rendering, not WebView
- **AI agent skills** — Claude Code and Codex skills included for AI-assisted development

## Core Components

| Category | Components |
|---|---|
| **Display** | Badge, Card, Alert, Empty State, Typography |
| **Forms** | Input, Textarea, Switch, Checkbox, Radio Group |
| **Navigation** | Tabs, Accordion, Item Group |
| **Overlays** | Dialog, Sheet, Drawer |
| **Actions** | Button, Toggle |

## Installation

```bash
composer require codingwithrk/nativephp-ui
php artisan native:plugin:register codingwithrk/nativephp-ui
php artisan vendor:publish --tag=nativephp-ui-config
php artisan native:run
```

## Docs & Support

- Docs: <https://nativephp-ui.codingwithrk.com>
- Email: connect@codingwithrk.com
- Marketplace: <https://marketplace.codingwithrk.com/products/nativephp-ui>
