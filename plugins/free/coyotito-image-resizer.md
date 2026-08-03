---
name: "Image Resizer"
author: "asciito"
price: "Free"
version: "0.1.0"
license: "MIT"
github: "https://github.com/coyotito-mx/image-resizer"
compatibility:
  nativephp: "^3.2"
  php: "^8.2"
  ios: "any"
  android: "any"
---

NativePHP Mobile plugin that downscales images using native APIs — `ImageIO` on iOS and `BitmapFactory` on Android.

## Install

```bash
composer require coyotito/image-resizer
```

Register the plugin it the `NativeServiceProvider`:

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
    maxSide: 1024,   // longest side cap; preserves aspect ratio, no upscale
    quality: 80,     // JPEG quality, 0-100
);
```

Returns `true` on success, `false` otherwise. Target is always written as JPEG. EXIF orientation is respected on both platforms.

## Platform notes

| Feature                | iOS                                | Android                            |
|------------------------|------------------------------------|------------------------------------|
| Decoder                | `CGImageSource` (ImageIO)          | `BitmapFactory` with `inSampleSize`|
| EXIF orientation       | Auto via thumbnail transform       | Explicit via `ExifInterface`       |
| Output format          | JPEG                               | JPEG                               |
| Memory efficiency      | Thumbnail API streams from disk    | `inSampleSize` downsamples on read |
