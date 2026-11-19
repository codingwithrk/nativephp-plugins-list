---
name: "Swipe Actions"
author: "Robert (AtlasNatives)"
price: "$29"
version: "1.0.2"
license: "Proprietary"
source: "https://nativephp.com/plugins/atlasnatives/nativephp-swipe-actions"
support: "https://nativephp.com/plugins/atlasnatives/nativephp-swipe-actions"
compatibility:
  nativephp: "^4.6"
  ios: "15.0+"
  android: "26+"
install:
  - "composer config repositories.nativephp-plugins composer https://plugins.nativephp.com"
  - "composer config http-basic.plugins.nativephp.com your@email.com your-license-key"
  - "php artisan vendor:publish --tag=nativephp-plugins-provider"
  - "composer require atlasnatives/nativephp-swipe-actions"
  - "php artisan native:plugin:register atlasnatives/nativephp-swipe-actions"
---

# Swipe Actions

Native swipe actions for NativePHP Mobile list items — wrap any content in `<native:swipe-row>` and declare trailing or leading actions with `<native:swipe-action>`.

> **Requires** `nativephp/mobile-ui` 0.8+ and native (EDGE) screens.
>
> **iOS SwiftUI renderer** ships with the plugin but has not yet been verified on a device.

## Features

- **`<native:swipe-row>`** — wraps any content; one row can be open at a time
- **Leading and trailing sides** — leading (right-swipe) and trailing (left-swipe) actions
- **Flexible styling** — hex colors, Tailwind palette names, or theme tokens (follows dark mode)
- **Destructive actions** — marked actions turn red automatically when no color is set
- **Optional labels under icons** — configurable icon size and action width
- **Snap behaviour** — rows snap open past half the actions' combined width
- **Conditional actions** — wrap in `@if` / `@foreach`, or build in PHP with `SwipeRow::make()` and `SwipeAction::make()`
- **Accessibility** — TalkBack actions menu (Android) and VoiceOver actions rotor (iOS)

## Installation

```bash
composer config repositories.nativephp-plugins composer https://plugins.nativephp.com
composer config http-basic.plugins.nativephp.com your@email.com your-license-key
php artisan vendor:publish --tag=nativephp-plugins-provider
composer require atlasnatives/nativephp-swipe-actions
php artisan native:plugin:register atlasnatives/nativephp-swipe-actions
php artisan native:run
```
