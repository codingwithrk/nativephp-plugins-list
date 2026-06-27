---
name: "Super Markdown"
author: "Matildevoldsen"
price: "Free"
version: "latest"
license: "MIT"
github: "https://github.com/Matildevoldsen/super-markdown"
compatibility:
  nativephp: "^3.0"
  php: "^8.4"
  laravel: "13+"
  ios: "18.2+"
  android: "33+"
install:
  - "composer require tilly/nativephp-cmark-markdown"
---

# Super Markdown

NativePHP mobile UI plugin for rendering GitHub Flavored Markdown with native SwiftUI (iOS) and Jetpack Compose (Android) views — no WebView, no HTML output.

## Features

- Native `<native:cmark-markdown />` Blade component
- `cmark-gfm` powered parsing: headings, paragraphs, emphasis, links, lists, task lists, tables, blockquotes, fenced code blocks
- iOS SwiftUI renderer backed by `libcmark_gfm` (CocoaPods)
- Android Compose renderer backed by cmark-gfm through JNI
- Stream-friendly block records for stable native identity during data streaming
- Per-word streaming animations: `fade-in`, `blur-in`, `slide-up`
- Optional Shiki integration for highlighted code blocks (`tilly/nativephp-shiki`)

## Compatibility

| Platform | Minimum |
| -------- | ------- |
| iOS | 18.2+ (requires CocoaPods) |
| Android | API 33+ (requires NDK + CMake) |
| PHP | 8.4+ |
| Laravel | 13+ |

## Installation

```bash
composer require tilly/nativephp-cmark-markdown
```

Register the plugin in `app/Providers/NativeServiceProvider.php`:

```php
use Tilly\NativephpCmarkMarkdown\CmarkMarkdownServiceProvider;

public function plugins(): array
{
    return [
        CmarkMarkdownServiceProvider::class,
    ];
}
```

## Usage

```blade
<native:cmark-markdown :content="$markdownString" />
```
