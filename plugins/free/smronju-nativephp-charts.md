---
name: "Charts"
author: "Mohammad Shoriful Islam Ronju"
price: "Free"
version: "1.1.0"
license: "MIT"
github: "https://github.com/smronju/nativephp-charts"
support: "https://nativephp.com/plugins/smronju/nativephp-charts"
compatibility:
  nativephp: "^3.0|^4.0"
  ios: "15.0+"
  android: "24+"
install:
  - "composer require smronju/nativephp-charts"
  - "php artisan vendor:publish --tag=nativephp-plugins-provider"
  - "php artisan native:plugin:register smronju/nativephp-charts"
---

# Charts

Native charts for NativePHP Mobile — no WebView, no JavaScript charting library. Renders directly on the device via a single `<native:chart>` Blade element.

> **Android-first:** Verified on a real Android device. iOS has compiled but has not yet been verified on a device or simulator.

## Supported Chart Types

Line, Area, Bar, Scatter, Candlestick, Radar, Pie, Doughnut

## Features

- **`<native:chart>`** Blade element — `type` selects the shape, `series` supplies the data
- **Theme-driven colors** — inherits your app's color theme automatically
- **Candlestick colors** — configurable rising and falling colors
- **Composable with EDGE text** — add axis labels, legends, and tooltips using `<native:text>` in Blade (the plugin does not render these itself)

## Installation

```bash
composer require smronju/nativephp-charts
php artisan vendor:publish --tag=nativephp-plugins-provider
php artisan native:plugin:register smronju/nativephp-charts
php artisan native:run
```
