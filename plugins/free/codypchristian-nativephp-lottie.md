---
name: "Lottie EDGE Component"
author: "Cody P Christian"
price: "Free"
version: "0.2.4"
license: "MIT"
github: "https://github.com/CodyPChristian/nativephp-lottie"
support: "https://github.com/CodyPChristian/nativephp-lottie/issues"
compatibility:
  nativephp: "^4.0"
  ios: "18.0+"
  android: "26+"
install:
  - "composer require codypchristian/nativephp-lottie"
  - "php artisan native:plugin:register codypchristian/nativephp-lottie"
---

# Lottie EDGE Component

Adds a `<native:lottie-view>` Blade tag that plays dotLottie animations natively — Jetpack Compose on Android and SwiftUI with lottie-spm on iOS. No code generation required.

## Features

- **dotLottie playback** — play animations from bundled assets or remote URLs
- **Native rendering** — Jetpack Compose (Android) and SwiftUI (iOS) with no wrappers
- **Configurable looping, sizing, and accessibility labels**
- **Offline-safe** — bundled asset playback works without a network connection
- **Auto-converts** dotLottie v2 to v1 for iOS compatibility
- **Static-renderer plugin** — native dependencies declared cleanly in the manifest

## Installation

```bash
composer require codypchristian/nativephp-lottie
php artisan native:plugin:register codypchristian/nativephp-lottie
```

## Usage

```blade
<native:lottie-view
    src="animations/confetti.lottie"
    :loop="true"
    accessibility-label="Confetti celebration"
/>
```

Supports both local asset paths and HTTPS URLs as the `src` value.
