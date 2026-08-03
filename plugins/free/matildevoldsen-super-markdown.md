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

NativePHP mobile UI plugin for rendering GitHub Flavored Markdown with native SwiftUI and Jetpack Compose views.

This package uses `cmark-gfm` as the parser source. It does not render Markdown as HTML and does not use a WebView for Markdown output.

## Features

- Native `<native:cmark-markdown />` Blade component.
- cmark-gfm powered parsing for headings, paragraphs, emphasis, links, lists, task lists, tables, thematic breaks, blockquotes, unsafe HTML text, and fenced code blocks.
- iOS SwiftUI renderer backed by `libcmark_gfm` from CocoaPods.
- Android Compose renderer backed by cmark-gfm through JNI.
- Stream-friendly block records for stable native identity during data streaming.
- Optional Shiki integration for highlighted code blocks.
- Mermaid fence handling through `tilly/nativephp-mermaid`.
- Per-word streaming animations inspired by Streamdown: `fade-in`, `blur-in`, and `slide-up`.

## Requirements

- PHP 8.4 or newer.
- Laravel with `nativephp/mobile`.
- NativePHP mobile 3 style UI plugins.
- iOS 18.2 or newer.
- Android API 33 or newer.
- Xcode with CocoaPods for iOS builds.
- Android Studio, SDK, NDK, and CMake for Android builds.

## Installation

Install the package in your NativePHP mobile app:

```bash
composer require tilly/nativephp-cmark-markdown
```

For local development, use a path repository:

```json
{
  "repositories": [
    {
      "type": "path",
      "url": "packages/nativephp-cmark-markdown",
      "options": { "symlink": true }
    }
  ]
}
```

Then require it:

```bash
composer require tilly/nativephp-cmark-markdown:*
```

## NativePHP Registration

Register the plugin explicitly in `app/Providers/NativeServiceProvider.php`:

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
<native:cmark-markdown
    :source="$markdown"
    streaming
    :highlight-code="true"
    code-light-theme="github-light"
    code-dark-theme="github-dark"
    animation="slide-up"
    animation-split="word"
    :animation-duration="180"
    caret="block"
    mermaid-renderer="beautiful" />
```

For high-frequency streaming, pass stable block records alongside the full source:

```blade
<native:cmark-markdown
    :source="$this->visibleMarkdown()"
    :blocks="$this->visibleMarkdownBlocks()"
    streaming />
```

The `blocks` prop is an internal performance hint. The visible output should still be driven by normal token or text deltas.

## Props

| Prop | Default | Description |
| --- | --- | --- |
| `source` | `''` | Markdown source text. |
| `blocks` | `[]` | JSON or array of stable block records. |
| `streaming` | `false` | Marks the renderer as stream-aware. |
| `base-font-size` | `16` | Base prose font size. |
| `code-font-size` | `14` | Code font size. |
| `theme` | `system` | `system`, `light`, or `dark`. |
| `show-language-labels` | `true` | Shows fence language labels. |
| `highlight-code` | `true` | Delegates code blocks to Shiki when installed. |
| `code-light-theme` | `github-light` | Shiki light theme. |
| `code-dark-theme` | `github-dark` | Shiki dark theme. |
| `animation` | `slide-up` | `fade-in`, `blur-in`, or `slide-up`. |
| `animation-split` | `auto` | `auto`, `word`, or `char`. |
| `animation-duration` | `500` | Animation duration in milliseconds. |
| `caret` | `block` | `none`, `block`, or `circle`. |

## Streaming Guidance

Use your transport layer to append normal text or token deltas. Do not emit artificial Markdown block chunks as user-visible content.

For production chat UIs:

- Keep the full assistant message as one source string.
- Use stable block records only as renderer identity hints.
- Avoid animating code blocks, tables, and diagrams while they are still structurally incomplete.
- Prefer `animation-split="word"` for normal assistant prose.
- Use `animation-split="char"` sparingly because it creates more native views.

## Development

From a host NativePHP app:

```bash
composer dump-autoload
php artisan native:plugin:list
php artisan native:plugin:validate packages/nativephp-cmark-markdown
php artisan test
```

Run iOS:

```bash
php artisan native:run ios --start-url=/markdown-chat --no-vite
```

Run Android:

```bash
export ANDROID_HOME="$HOME/Library/Android/sdk"
export PATH="$ANDROID_HOME/platform-tools:$ANDROID_HOME/emulator:$PATH"
php artisan native:run android emulator-5554 --start-url=/markdown-chat --no-vite
```

## Security

Markdown HTML nodes are not passed to a web renderer. Unsafe HTML must be displayed as inert text or skipped by the native renderer.
