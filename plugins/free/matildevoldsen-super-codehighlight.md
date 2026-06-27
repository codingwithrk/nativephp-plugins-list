---
name: "Super Code Highlight"
author: "Matildevoldsen"
price: "Free"
version: "latest"
license: "MIT"
github: "https://github.com/Matildevoldsen/super-codehighlight"
compatibility:
  nativephp: "^3.0"
  php: "^8.4"
  laravel: "13+"
  ios: "18.2+"
  android: "33+"
install:
  - "composer require tilly/nativephp-shiki"
---

# Super Code Highlight

NativePHP mobile UI plugin for Shiki-powered syntax highlighting, rendered with native SwiftUI (iOS) and Jetpack Compose (Android) views — no WebView, no `highlight.js`.

## Features

- Native `<native:shiki-code />` Blade component
- Shiki 4.2.0 runtime bundled from official Shiki packages
- iOS runtime through JavaScriptCore
- Android runtime through Jetpack JavaScriptEngine
- Native token rows rendered as SwiftUI text spans and Compose spans
- Full language and theme registry from Shiki

## Compatibility

| Platform | Minimum |
| -------- | ------- |
| iOS | 18.2+ |
| Android | API 33+ |
| PHP | 8.4+ |
| Laravel | 13+ |

## Installation

```bash
composer require tilly/nativephp-shiki
```

Register the plugin in `app/Providers/NativeServiceProvider.php`:

```php
use Tilly\NativephpShiki\ShikiServiceProvider;

public function plugins(): array
{
    return [
        ShikiServiceProvider::class,
    ];
}
```

## Usage

```blade
<native:shiki-code
    language="php"
    theme="github-dark"
    :code="$codeString"
/>
```
