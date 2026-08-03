---
name: "Fullscreen"
author: "Kevin Batdorf"
price: "Free"
version: "0.1.0"
license: "MIT"
github: "https://github.com/KevinBatdorf/nativephp-fullscreen"
compatibility:
  nativephp: "^3.0"
  ios: "15.0+"
  android: "21+"
install:
  - "composer require kevinbatdorf/nativephp-fullscreen"
---

Enter and exit fullscreen (immersive) mode.

## Installation

```bash
composer require kevinbatdorf/nativephp-fullscreen
```

## Usage

```php
use KevinBatdorf\Fullscreen\Facades\Fullscreen;

// Enter fullscreen (hide status bar + navigation bar)
Fullscreen::enter();

// Exit fullscreen (show system bars)
Fullscreen::exit();

// Check if fullscreen mode is active
$active = Fullscreen::isActive();
```

## JavaScript

```js
import { Fullscreen } from '@kevinbatdorf/nativephp-fullscreen';

await Fullscreen.enter();
await Fullscreen.exit();
const active = await Fullscreen.isActive();
```

## Platform Behavior

- **Android**: Uses `WindowInsetsControllerCompat` with `BEHAVIOR_SHOW_TRANSIENT_BARS_BY_SWIPE`. System bars reappear briefly on edge swipe, then auto-hide. Fullscreen persists across page navigations natively.
- **iOS**: Swizzles the root UIViewController to hide the status bar and home indicator. Negates safe area insets so content extends into the notch/dynamic island. Injects CSS to zero out NativePHP's safe area variables (`--inset-*`, `--sat/sar/sab/sal`) and removes `body.nativephp-safe-area` padding. A `WKUserScript` at document start reads a `sessionStorage` flag to apply fullscreen CSS before the page renders, preventing flash-of-insets on navigation. A KVO observer on `WKWebView.isLoading` re-injects CSS after each page load. Orientation changes are handled automatically.
