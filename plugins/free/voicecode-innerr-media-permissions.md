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

# Innerr Media Permissions

A manifest-only NativePHP plugin that injects iOS `Info.plist` usage descriptions for camera, microphone, and photo library access.

This plugin contains no bridge functions or native code — its sole purpose is to inject the correct `NS*UsageDescription` keys into the generated iOS `Info.plist` via the NativePHP manifest merge process.

## What It Contributes

| Key | Description |
| --- | ----------- |
| `NSCameraUsageDescription` | Camera access for uploading media |
| `NSMicrophoneUsageDescription` | Microphone access for recording video with audio |
| `NSPhotoLibraryUsageDescription` | Photo library access for selecting media |
| `NSPhotoLibraryAddUsageDescription` | Permission to save photos and videos to the library |

## Installation

```bash
composer require voicecode-bv/nativephp-plugin-innerr-media-permissions
php artisan vendor:publish --tag=nativephp-plugins-provider
php artisan native:plugin:register voicecode-bv/nativephp-plugin-innerr-media-permissions
```

To customise the permission wording, edit `nativephp.json` in the package and rebuild the iOS app. A key that already exists in your `Info.plist` will not be overwritten.
