---
name: "Image Resizer"
author: "asciito"
price: "Free"
version: "latest"
license: "MIT"
github: "https://github.com/coyotito-mx/image-resizer"
compatibility:
  nativephp: "^3.2"
  php: "^8.2"
  ios: "any"
  android: "any"
---

# Image Resizer

Downscale images using native platform APIs — `ImageIO` on iOS and `BitmapFactory` on Android — from a NativePHP Mobile app.

## Features

- Resize images to a maximum side length while preserving aspect ratio
- No upscaling — only downscales
- Automatic EXIF orientation correction on both platforms
- Output always written as JPEG
- Memory-efficient: iOS streams from disk via thumbnail API; Android uses `inSampleSize` on decode

## Installation

```bash
composer require coyotito/image-resizer
```

Register the plugin in your `NativeServiceProvider`:

```php
public function plugins(): array
{
    return [
        \Coyotito\ImageResizer\ImageResizerServiceProvider::class,
    ];
}
```

## Usage

```php
use Coyotito\ImageResizer\Facades\ImageResizer;

$ok = ImageResizer::resize(
    sourcePath: '/abs/path/to/source.jpg',
    targetPath: '/abs/path/to/target.jpg',
    maxSide: 1024,  // longest side cap; preserves aspect ratio
    quality: 80,    // JPEG quality, 0–100
);
```

Returns `true` on success, `false` on failure. The target is always written as JPEG.

## Platform Notes

| Feature          | iOS                                     | Android                              |
| ---------------- | --------------------------------------- | ------------------------------------ |
| Decoder          | `CGImageSource` (ImageIO)               | `BitmapFactory` with `inSampleSize`  |
| EXIF orientation | Auto via thumbnail transform            | Explicit via `ExifInterface`         |
| Output format    | JPEG                                    | JPEG                                 |
| Memory           | Thumbnail API streams from disk         | `inSampleSize` downsamples on read   |
