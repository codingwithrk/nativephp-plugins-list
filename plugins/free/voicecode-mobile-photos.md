---
name: "Mobile Photos"
author: "Voicecode"
price: "Free"
version: "latest"
license: "MIT"
github: "https://github.com/voicecode-bv/mobile-photos"
compatibility:
  nativephp: "^3.0"
  php: "^8.2"
  ios: "any"
  android: "29+"
---

# Mobile Photos

Save remote images and videos directly to the device photo library (camera roll on iOS, MediaStore gallery on Android) from a NativePHP Mobile app — no share sheet, no extra taps.

## Features

- Save remote images and videos straight to the camera roll / gallery
- No runtime storage permission needed on Android 10+
- iOS add-only authorization — users grant minimal access
- Supports both PHP and JavaScript / TypeScript bridge calls

## Installation

```bash
composer require voicecode-bv/mobile-photos
php artisan native:plugin:register voicecode-bv/mobile-photos
```

Then rebuild the iOS and Android projects through the usual NativePHP build flow.

### iOS Notes

The plugin declares `NSPhotoLibraryAddUsageDescription` in the manifest. Override the prompt copy in `nativephp/ios/NativePHP/Info.plist` — a key that already exists will not be overwritten by the plugin compiler.

Uses iOS **add-only** authorization (`PHAccessLevel.addOnly`) so users don't need to grant full photo library access.

### Android Notes

Requires Android 10 (API 29) or higher. Saves go through `MediaStore`, so no runtime storage permission is required.

## Usage

### PHP

```php
use Voicecode\Mobile\Photos\Photos;

app(Photos::class)->save('https://cdn.example.com/photo.jpg');
app(Photos::class)->save('https://cdn.example.com/clip.mp4', 'video');
```

### JavaScript / TypeScript

```ts
import { BridgeCall } from '@nativephp/mobile';

const result = await BridgeCall('Photos.Save', {
    url: 'https://cdn.example.com/photo.jpg',
    type: 'image', // optional — inferred from URL extension when omitted
});

if (result?.status === 'saved') {
    // saved to camera roll / gallery
}
```

The call resolves once the asset has been written. On failure, the response includes a `code` and `message`:

| Code                 | Meaning                              |
| -------------------- | ------------------------------------ |
| `PERMISSION_DENIED`  | User did not grant photo library access |
| `EXECUTION_FAILED`   | Native save operation failed         |
| `INVALID_PARAMETERS` | URL or type parameter is invalid     |
