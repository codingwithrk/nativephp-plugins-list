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

NativePHP mobile UI plugin for Shiki-powered code highlighting rendered with native SwiftUI and Jetpack Compose views.

This package uses Shiki itself. It does not use `highlight.js`, `hljs`, or WebView-rendered HTML.

## Features

- Native `<native:shiki-code />` Blade component.
- Shiki `4.2.0` runtime bundled from official Shiki packages.
- Generated manifest from Shiki language and theme registries.
- iOS runtime through JavaScriptCore.
- Android runtime through Jetpack JavaScriptEngine.
- Native token rows rendered as SwiftUI and Compose text spans.
- Intended integration with Super Markdown code fences.

## Requirements

- PHP 8.4 or newer.
- Laravel with `nativephp/mobile`.
- Node.js for rebuilding the Shiki bundle.
- iOS 18.2 or newer.
- Android API 33 or newer.
- Android dependency `androidx.javascriptengine:javascriptengine`.

## Installation

```bash
composer require tilly/nativephp-shiki
```

For local development:

```json
{
  "repositories": [
    {
      "type": "path",
      "url": "packages/nativephp-shiki",
      "options": { "symlink": true }
    }
  ]
}
```

Then:

```bash
composer require tilly/nativephp-shiki:*
```

## NativePHP Registration

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
    :code="$code"
    language="php"
    theme="github-dark"
    :font-size="13"
    :show-language-label="true" />
```

With Super Markdown:

```blade
<native:cmark-markdown
    :source="$markdown"
    :highlight-code="true"
    code-light-theme="github-light"
    code-dark-theme="github-dark" />
```

## Shiki Bundle

The generated runtime lives in `resources/generated`.

Rebuild it after changing Shiki version or codegen:

```bash
npm install
npm run build
npm test
```

The build script reads Shiki's own language and theme registries. Do not manually maintain a hard-coded language list.

## Props

| Prop | Default | Description |
| --- | --- | --- |
| `code` | `''` | Source code to highlight. |
| `language` | `text` | Shiki language id or alias. |
| `theme` | `github-dark` | Shiki theme id. |
| `font-size` | `13` | Native code font size. |
| `show-language-label` | `true` | Shows the language label. |

## Development

From a NativePHP host app:

```bash
composer dump-autoload
php artisan native:plugin:list
php artisan native:plugin:validate packages/nativephp-shiki
php artisan test
```

Run native verification:

```bash
php artisan native:run ios --start-url=/markdown-chat --no-vite
php artisan native:run android emulator-5554 --start-url=/markdown-chat --no-vite
```

Scan for forbidden renderers:

```bash
rg -n "WebView|WKWebView|highlight\.js|hljs" packages/nativephp-shiki
```

## Runtime Notes

- Unknown languages should fall back to plain native code rendering in the caller.
- Streaming callers should cache highlights by `sha256(code + lang + theme)`.
- The native renderer consumes token JSON, not HTML.
