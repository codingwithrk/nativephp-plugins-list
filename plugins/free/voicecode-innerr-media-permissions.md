---
name: "Innerr Media Permissions"
author: "Michael Blijleven"
price: "Free"
version: "latest"
license: "MIT"
github: "https://github.com/voicecode-bv/nativephp-plugin-innerr-media-permissions"
compatibility:
  nativephp: "^3.0"
  php: "^8.2"
  ios: "any"
install:
  - "composer require voicecode-bv/nativephp-plugin-innerr-media-permissions"
  - "php artisan vendor:publish --tag=nativephp-plugins-provider"
  - "php artisan native:plugin:register voicecode-bv/nativephp-plugin-innerr-media-permissions"
---

# Media Permissions Plugin for NativePHP Mobile

Contributes iOS `Info.plist` usage descriptions required for camera, microphone, and photo library access in the Innerr app.

This is a manifest-only plugin: it has no bridge functions or native code. Its sole purpose is to inject the correct `NS*UsageDescription` entries into the generated iOS `Info.plist` via the NativePHP manifest merge process.

## Installation

Add this package as a path repository in the consuming app's `composer.json`:

```json
"repositories": [
    { "type": "path", "url": "./packages/voicecode-bv/nativephp-plugin-innerr-media-permissions" }
]
```

Then install and register:

```bash
composer require voicecode-bv/nativephp-plugin-innerr-media-permissions

# First time only: publish the plugins provider
php artisan vendor:publish --tag=nativephp-plugins-provider

# Register the plugin
php artisan native:plugin:register voicecode-bv/nativephp-plugin-innerr-media-permissions

# Verify
php artisan native:plugin:list
```

## What it contributes

| Key                              | Description                                                                                |
| -------------------------------- | ------------------------------------------------------------------------------------------ |
| `NSCameraUsageDescription`       | To upload media to your circles, Innerr requires camera access.                            |
| `NSMicrophoneUsageDescription`   | To make new recordings, Innerr requires microphone access to record video with audio.      |
| `NSPhotoLibraryUsageDescription` | Before you can post media to your circles, Innerr requires photo library access to select media. |
| `NSPhotoLibraryAddUsageDescription` | This app needs permission to save photos and videos to your library.                    |

To change the wording, edit `nativephp.json` in this package and rebuild the iOS app.
