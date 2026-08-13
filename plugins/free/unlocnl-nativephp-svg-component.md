---
name: "SVG Component"
author: "Unloc"
price: "Free"
version: "1.0.0"
license: "MIT"
github: "https://github.com/unlocnl/nativephp-svg-component"
support: "https://github.com/unlocnl/nativephp-svg-component/issues"
compatibility:
  nativephp: "^3.0 || ^4.0"
  ios: "16.0+"
  android: "26+"
install:
  - "composer require unloc/nativephp-svg-component"
  - "php artisan native:plugin:register unloc/nativephp-svg-component"
---

# NativePHP SVG EDGE Component

`<native:svg>` — renders SVG as a real native graphic. SwiftDraw on iOS, coil-svg on Android, resolution-independent on both.

```blade
<native:svg :src="resource_path('svg/logo.svg')" alt="Logo" class="h-16 w-full object-contain"/>
```

Mirrors core's `<native:image>` — same props, same Tailwind sizing and `object-*` classes.

## Installation

```bash
composer require unloc/nativephp-svg-component

php artisan native:plugin:register unloc/nativephp-svg-component
```

## Attributes

| Attribute   | Notes |
|-------------|-------|
| `src`       | Required. File path, URL, `data:` URI, raw markup, or bundled asset name. |
| `fit`       | `none`, `contain`, `cover`, `fill`, `stretch`. Prefer the `object-*` classes. |
| `tintColor` | Palette name (`red-300`), `white` / `black` / `transparent`, hex, or any of those with a `/N` opacity modifier. For a theme token use `theme('primary')`. |
| `alt`       | Accessibility label. Omit it and the graphic is hidden from VoiceOver and TalkBack. |

```blade
<native:svg :src="$icon" :tintColor="theme('primary')" alt="Filter" class="h-6 w-6"/>
```

Size with classes, as you would an image:

```blade
<native:svg :src="$path" class="h-32 w-full object-cover rounded-2xl"/>
```

With no `object-*` class the graphic draws at its document size and lays out where the parent puts it, like an `<img>` with no CSS. Add `object-contain` to scale it into a frame.

## Sources

| Form | Description |
|------|-------------|
| `/absolute/path.svg`, `file://…` | Read from the filesystem |
| `https://…` | Fetched over the network |
| `data:image/svg+xml;…` | Base64 or percent-encoded, decoded in PHP |
| `<svg …>` | The document itself |
| anything else | Bundled asset name |

For SVGs shipped in your Laravel app, absolute paths are the reliable choice — the whole tree is copied into the bundle:

```blade
<native:svg :src="resource_path('svg/map.svg')"/>
```

## PHP API

```php
use NativePHP\SvgComponent\Elements\Svg;

Svg::make(resource_path('svg/logo.svg'))
    ->tintColor('primary')
    ->alt('Logo')
    ->class('h-16 w-full object-contain');
```

## Gotchas

**Author to SVG 1.1.** Android rejects the whole document on an attribute value it doesn't know, so a single SVG 2 value gives you a blank frame rather than a degraded one. iOS ignores the value and draws the rest, so it presents as "fine on iOS, blank on Android" with nothing in the logs. Seen with `orient="auto-start-reverse"`; `orient="auto"` renders.

**Inline markup has to come from PHP.** The precompiler treats every registered element type as a bare tag, so a literal `<svg>` written into a native view compiles to an *element*, not a string. Read it in your component and bind it:

```php
return view('native.screen', ['markup' => file_get_contents(resource_path('svg/logo.svg'))]);
```

```blade
<native:svg :src="$markup"/>
```

**Always author a `viewBox`.** Without one the document has no intrinsic size: iOS renders nothing, Android draws it unscaled in the corner.

**Failures are silent**, like `native:image`. A 404, a missing file, or malformed markup renders nothing. Native failures go to the native console; an undecodable data URI goes to the Laravel log.

A remote SVG that works on iOS but not Android is usually the host rejecting OkHttp's User-Agent — some CDNs return 403 to OkHttp and 200 to `URLSession`. Check with `curl -A 'okhttp/4.12.0' <url>`.

## Supported SVG Features

**Supported on both platforms:** paths, shapes, groups, transforms, fills and strokes, gradients, clip paths, masks, patterns, opacity, fill-rule, `<style>` blocks, embedded rasters.

**Not rendered:** filters, SMIL animation, and markers on iOS only. Filters and markers are dropped cleanly — the shape still draws.

`<text>` renders on both, but each engine picks its own fonts. Flatten it to paths when they have to match.

`fill` behaves as `cover` on iOS, since SwiftUI has no stretch content mode. Use `cover` when the platforms must agree.
