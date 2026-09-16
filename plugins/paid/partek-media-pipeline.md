---
name: "Media Pipeline"
author: "Paul (PARTek)"
price: "$99"
version: "1.0.6"
license: "Proprietary"
source: "https://nativephp.com/plugins/partek/media-pipeline"
support: "https://nativephp.com/plugins/partek/media-pipeline"
compatibility:
  nativephp: "^3.0 || ^4.0"
  ios: "18.0+"
  android: "26+"
install:
  - "composer config repositories.nativephp-plugins composer https://plugins.nativephp.com"
  - "composer config http-basic.plugins.nativephp.com your@email.com your-license-key"
  - "php artisan vendor:publish --tag=nativephp-plugins-provider"
  - "composer require partek/media-pipeline"
  - "php artisan native:plugin:register partek/media-pipeline"
---

# Media Pipeline

On-device photo and video compression for NativePHP Mobile. Takes a local file path and compresses/resizes it natively — iOS uses `UIImage`/`AVAssetExportSession`, Android uses `BitmapFactory`/LightCompressor — without sending originals to a server.

## Features

- **`MediaPipeline::compressImage($path, $maxWidth, $maxHeight, $quality)`** — returns job ID
- **`MediaPipeline::compressVideo($path, $preset, $maxWidth, $targetBitrateKbps)`** — returns job ID; presets: `low`, `medium`, `high`
- **`MediaPipeline::cancel($jobId)`** — cancels an in-progress video job
- **Progress events** — `CompressionProgress` (0–100), `CompressionCompleted`, `CompressionFailed`
- **Aspect-preserving resize** — never upscales
- **EXIF orientation correction** on Android for portrait camera photos
- **No camera/photo permissions declared** — works with paths from `mobile-camera`
- **JavaScript API** — `CompressImage`, `CompressVideo`, `Cancel`

## Installation

```bash
composer config repositories.nativephp-plugins composer https://plugins.nativephp.com
composer config http-basic.plugins.nativephp.com your@email.com your-license-key
php artisan vendor:publish --tag=nativephp-plugins-provider
composer require partek/media-pipeline
php artisan native:plugin:register partek/media-pipeline
```
