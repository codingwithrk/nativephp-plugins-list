---
name: "Skia"
author: "Bifrost Technology"
price: "$99"
version: "1.0.0"
license: "Proprietary"
source: "https://nativephp.com/plugins/nativephp/mobile-skia"
support: "https://nativephp.com/plugins/nativephp/mobile-skia"
compatibility:
  nativephp: "^4.5.1"
  ios: "15.0+"
  android: "26+"
install:
  - "composer config repositories.nativephp-plugins composer https://plugins.nativephp.com"
  - "composer config http-basic.plugins.nativephp.com your@email.com your-license-key"
  - "php artisan vendor:publish --tag=nativephp-plugins-provider"
  - "composer require nativephp/mobile-skia"
  - "php artisan native:plugin:register nativephp/mobile-skia"
---

# Skia

Native Skia canvas rendering for NativePHP Mobile — MetalKit on iOS, OpenGL ES 3 on Android. Draw shapes, text, images, gradients, and animations from PHP with no WebView.

## Features

- **`<skia-canvas>`** Blade element with accessibility support
- **Shapes** — rectangles, circles, lines, arbitrary paths, SVG shapes
- **Text & paragraphs** — rich text with fonts, spacing, alignment
- **Images** — render bitmap images and SVG/Lottie files onto the canvas
- **Groups** — composite shapes with shared transforms
- **Paint effects** — linear/radial gradients, blur, drop shadows, blend modes, SkSL runtime shaders
- **Animations** — transform and property animations with spring physics and decay curves
- **Gestures** — pan, pinch, rotation with native shared values
- **Touch interaction** — per-shape dragging, ink drawing with undo support
- **Export** — snapshot canvas to PNG, JPEG, WebP, or PDF
- **Testing** — `PHPUnit`/`Pest` assertion macros and fake bridge controls
- **Fluent PHP Scene API** — chainable builders for every primitive and effect

## Installation

```bash
composer config repositories.nativephp-plugins composer https://plugins.nativephp.com
composer config http-basic.plugins.nativephp.com your@email.com your-license-key
php artisan vendor:publish --tag=nativephp-plugins-provider
composer require nativephp/mobile-skia
php artisan native:plugin:register nativephp/mobile-skia
php artisan native:run
```
