---
name: "Mobile Photos"
author: "Voicecode"
price: "Free"
version: "1.0.0"
license: "MIT"
github: "https://github.com/voicecode-bv/mobile-photos"
compatibility:
  nativephp: "^3.0"
  php: "^8.2"
  ios: "any"
  android: "29+"
---

Save remote images and videos directly to the device photo library (camera roll on iOS, MediaStore gallery on Android) from a NativePHP Mobile app — no share sheet, no extra taps.

## Installation

```bash
composer require voicecode-bv/mobile-photos
```

After install, register the plugin so it gets compiled into the native projects:

```bash
php artisan native:plugin:register voicecode-bv/mobile-photos
```

Then rebuild the iOS and Android projects through the usual NativePHP build flow.

### iOS notes

The plugin manifest declares `NSPhotoLibraryAddUsageDescription`. You can override the prompt copy by setting your own value in `nativephp/ios/NativePHP/Info.plist` — the plugin compiler will not overwrite a key that already exists.

The plugin uses iOS' **add-only** authorization (`PHAccessLevel.addOnly`), which means users don't have to give full photo library access just to save a single file.

### Android notes

Requires Android 10 (API 29) or higher. Saves go through `MediaStore` so no runtime storage permission is needed.

## Usage

### From PHP

```php
use Voicecode\Mobile\Photos\Photos;

app(Photos::class)->save('https://cdn.example.com/photo.jpg');
app(Photos::class)->save('https://cdn.example.com/clip.mp4', 'video');
```

### From JavaScript / TypeScript

```ts
import { BridgeCall } from '@nativephp/mobile';

const result = await BridgeCall('Photos.Save', {
    url: 'https://cdn.example.com/photo.jpg',
    // type is optional — inferred from the URL extension when omitted.
    type: 'image',
});

if (result?.status === 'saved') {
    // saved to camera roll / gallery
}
```

The call returns synchronously once the asset has been written. On failure the response carries a `code` and `message` (`PERMISSION_DENIED`, `EXECUTION_FAILED`, `INVALID_PARAMETERS`).
