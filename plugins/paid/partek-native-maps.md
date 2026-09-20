---
name: "Native Maps"
author: "Paul (PARTek)"
price: "$99"
version: "1.0.0"
license: "Proprietary"
source: "https://nativephp.com/plugins/partek/native-maps"
support: "https://nativephp.com/plugins/partek/native-maps"
compatibility:
  nativephp: "^4.0"
  ios: "18.0+"
  android: "26+"
install:
  - "composer config repositories.nativephp-plugins composer https://plugins.nativephp.com"
  - "composer config http-basic.plugins.nativephp.com your@email.com your-license-key"
  - "php artisan vendor:publish --tag=nativephp-plugins-provider"
  - "composer require partek/native-maps"
  - "php artisan native:plugin:register partek/native-maps"
---

# Native Maps

Fully native maps for NativePHP Mobile — Apple MapKit (`MKMapView`) on iOS, Google Maps via Jetpack Compose on Android. No WebView, no JS map library.

> **Android setup required:** Add a Google Maps API key via a Gradle manifest placeholder (see below). iOS uses MapKit with no API key.

## Features

- **`<native:parqore-map>`** Blade component — drop a full map anywhere in your UI
- **Markers** — add, update, and remove pins with custom icons and info windows
- **Camera control** — `NativeMaps::animateCamera()`, `NativeMaps::moveCamera()`, `NativeMaps::fitCoordinates()`, `NativeMaps::focusMarker()`, `NativeMaps::visibleRegion()`
- **iOS** — MapKit `MKMapView`, no API key, no configuration
- **Android** — Jetpack Compose `GoogleMap`, requires a Google Maps API key
- **`nativephp-ui-plugin`** (SuperNative EDGE component) — requires NativePHP Mobile `^4.0`

## Installation

```bash
composer config repositories.nativephp-plugins composer https://plugins.nativephp.com
composer config http-basic.plugins.nativephp.com your@email.com your-license-key
php artisan vendor:publish --tag=nativephp-plugins-provider
composer require partek/native-maps
php artisan native:plugin:register partek/native-maps
php artisan native:run
```

### Android: Google Maps API key

In your app module's `build.gradle`:

```gradle
android {
    defaultConfig {
        manifestPlaceholders["GOOGLE_MAPS_API_KEY"] = project.findProperty("GOOGLE_MAPS_API_KEY") ?: ""
    }
}
```

In a local, uncommitted `gradle.properties`:

```properties
GOOGLE_MAPS_API_KEY=your-google-maps-api-key-here
```
