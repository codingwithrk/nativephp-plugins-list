---
name: "NativePHP Charts"
author: "donmanueldev"
price: "Free"
version: "1.0.0"
license: "MIT"
github: "https://github.com/donmanueldev/nativephp-charts"
support: "https://github.com/donmanueldev/nativephp-charts/issues"
compatibility:
  nativephp: "^4.0"
  php: "^8.4"
  ios: "18.2+"
  android: "26+"
install:
  - "composer require donmanueldev/nativephp-charts:^1.0"
  - "php artisan vendor:publish --tag=nativephp-plugins-provider --no-interaction"
  - "php artisan native:plugin:register donmanueldev/nativephp-charts --no-interaction"
---

# NativePHP Charts

Eight native chart types for NativePHP Mobile — Swift Charts + SwiftUI Canvas on iOS, Jetpack Compose Canvas on Android. No WebView, no JavaScript chart library, no third-party native dependencies.

## Chart Types

| Blade tag | Chart |
|-----------|-------|
| `<native:line-chart>` | Line |
| `<native:area-chart>` | Area |
| `<native:bar-chart>` | Bar |
| `<native:scatter-chart>` | Scatter |
| `<native:candlestick-chart>` | Candlestick |
| `<native:radar-chart>` | Radar |
| `<native:pie-chart>` | Pie |
| `<native:donut-chart>` | Donut |

## Features

- **Fully native rendering** — no WebView, no JS, no network calls
- **Multi-series** with grouped bars, stacked area fills, and multi-series radar
- **X-axis types** — `category`, `number`, `date` (`YYYY-MM-DD`), `datetime` (RFC 3339)
- **Localized value formatting** — `number`, `currency` (e.g. `USD`), `percent`
- **Selection callbacks** — bind `_select` to a PHP method; payload includes `series_id`, `point_id`, `value`
- **Configurable legends** — `position`, `alignment`, font, color, marker size
- **Native animations** — reveal and update (disable with `animated="false"`)
- **Strict validation** — unknown options rejected, IDs must be unique, values must be finite
- **Fluent PHP API** alongside Blade attribute syntax

## Installation

```bash
composer require donmanueldev/nativephp-charts:^1.0
php artisan vendor:publish --tag=nativephp-plugins-provider --no-interaction
php artisan native:plugin:register donmanueldev/nativephp-charts --no-interaction
```
