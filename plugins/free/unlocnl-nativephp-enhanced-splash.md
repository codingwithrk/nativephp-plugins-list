---
name: "Enhanced Splash"
author: "Unloc"
price: "Free"
version: "1.0.0"
license: "MIT"
github: "https://github.com/unlocnl/nativephp-enhanced-splash"
support: "https://github.com/unlocnl/nativephp-enhanced-splash/issues"
compatibility:
  nativephp: "^3.0 || ^4.0"
  ios: "16.0+"
  android: "26+"
install:
  - "composer require unloc/nativephp-enhanced-splash"
  - "php artisan vendor:publish --tag=nativephp-plugins-provider"
  - "php artisan native:plugin:register unloc/nativephp-enhanced-splash"
---

# Enhanced Splash for NativePHP Mobile

Take control of your app's launch screen: no visible jump on Android, and a polished iOS launch screen generated from your app icon — no design work required.

## Why "enhanced"

**Android shows two splashes, and you only control one of them.** Since Android 12 the system draws its own splash on every cold start — your launcher icon on a flat background — and it cannot be turned off. Only after that does NativePHP's own overlay fade in your `splash.png`. The system half is hardcoded white or black, so unless your splash art happens to be black too, users see a cut in the middle of your app opening.

This plugin fixes it two ways, and you pick:

- Give the system splash the same background as your splash image, so the two phases read as one continuous screen.
- Or drop the second phase entirely with `android.mode = 'icon'`: the system splash is held on screen until your app is ready to draw, so there is one splash instead of two.

**iOS launch screens usually mean commissioning artwork.** Every device size, light and dark. With `ios.mode = 'icon'` you don't design anything: the plugin takes the app icon you already have, masks it to the iOS squircle, centers it on the background color you choose, and uses that for both of iOS's launch phases. It looks deliberate, and it takes one config line.

And if you do have artwork, `public/splash.svg` is used as a true vector launch image on iOS — one file, sharp on every device, instead of a folder of PNG variants.

## Installation

```bash
composer require unloc/nativephp-enhanced-splash

# Only needed once per app, before its first plugin registration.
php artisan vendor:publish --tag=nativephp-plugins-provider

php artisan native:plugin:register unloc/nativephp-enhanced-splash
php artisan native:plugin:list
```

Then rebuild — native code only compiles in at build time:

```bash
php artisan native:run ios      # or: android
```

> **Note:** Only run one splash plugin at a time. This plugin edits `MainActivity.kt` by exact-string match, as every splash plugin for NativePHP does. Running alongside `s2br/nativephp-mobile-splashscreen` will cause conflicts.

## Configuration

Set the `.env` keys, or publish the config to edit it directly:

```bash
php artisan vendor:publish --tag=enhanced-splash-config
```

| Key                       | `.env`                                    | Values                                      |
|---------------------------|-------------------------------------------|---------------------------------------------|
| `ios.mode`                | `ENHANCED_SPLASH_IOS_MODE`                | `image` (default), `icon`                   |
| `ios.background`          | `ENHANCED_SPLASH_IOS_BACKGROUND`          | `#RRGGBB` / `#RRGGBBAA` (default `#FFFFFF`) |
| `ios.background_dark`     | `ENHANCED_SPLASH_IOS_BACKGROUND_DARK`     | `#RRGGBB` / `#RRGGBBAA` (default `#000000`) |
| `ios.icon_size`           | `ENHANCED_SPLASH_IOS_ICON_SIZE`           | points (default `160`)                      |
| `ios.icon_rounded`        | `ENHANCED_SPLASH_IOS_ICON_ROUNDED`        | bool (default `true`)                       |
| `ios.icon_shadow`         | `ENHANCED_SPLASH_IOS_ICON_SHADOW`         | bool (default `false`)                      |
| `android.mode`            | `ENHANCED_SPLASH_ANDROID_MODE`            | `image` (default), `icon`                   |
| `android.background`      | `ENHANCED_SPLASH_ANDROID_BACKGROUND`      | `#RRGGBB` / `#RRGGBBAA` (default `#000000`) |
| `android.background_dark` | `ENHANCED_SPLASH_ANDROID_BACKGROUND_DARK` | `#RRGGBB` / `#RRGGBBAA` (default `#000000`) |

Colors are authored in CSS channel order; the alpha byte is converted to each platform's own ordering at build time.

`#` starts a comment in `.env`, so quote hex values there:

```dotenv
ENHANCED_SPLASH_ANDROID_MODE=icon
ENHANCED_SPLASH_ANDROID_BACKGROUND="#0F172A"
ENHANCED_SPLASH_ANDROID_BACKGROUND_DARK="#020617"
```

Defaults match NativePHP's own behavior, so installing the plugin changes nothing until you configure it.

## Android Modes

### `icon`: just one native splash instead of two

The system splash is held on screen until your app is ready, and the overlay never draws. Your launcher icon on `background`, then straight into your app. No second phase, nothing to time.

This mode ignores `splash.png` — the system splash draws your launcher icon, not your artwork. Pick it when your splash is a logo on a flat color, and `image` when the artwork matters.

### `image`: keep the default splash image, but influence the system splash color

Your `splash.png` still fills the screen. `background` and `background_dark` repaint everything around and before it — the system splash, the app window, and the overlay your image fades into. This makes transitions less jarring when your app and `splash.png` use different background colors.

## iOS Modes

### `icon`: a launch screen without a designer

Set `ios.mode = 'icon'` and the plugin builds the launch screen from `AppIcon.appiconset`: your icon, masked to the iOS squircle so it matches the home screen, centered on `background` / `background_dark`. Both of iOS's launch phases get the same image, so there is no flicker between them.

Tuning:

- `icon_size` — how large the icon is drawn, in points. The default `160` matches what Android shows.
- `icon_rounded` — turn off for artwork that is already shaped, or a logo that shouldn't be clipped.
- `icon_shadow` — a soft shadow to lift the icon off the background. Off by default.

### `image`: added SVG (vector) support

Drop `public/splash.svg` (and optionally `public/splash-dark.svg`) in place and it becomes the launch image, kept as a vector so it's sharp at every size. Without an SVG, the PNG variants are used as usual.

## Uninstall

```bash
composer remove unloc/nativephp-enhanced-splash

php artisan native:install
```

`native:install` regenerates the native project from NativePHP's own sources, clearing everything the plugin changed.
