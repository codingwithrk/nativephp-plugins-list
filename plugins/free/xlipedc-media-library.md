---
name: "Media Library"
author: "Felipe Almeida"
price: "Free"
version: "latest"
license: "MIT"
github: "https://github.com/XlipeDCodder/media-library"
compatibility:
  nativephp: "^3.0"
  php: "^8.2"
  android: "21+"
install:
  - "composer require musicplayer/media-library"
  - "php artisan vendor:publish --tag=nativephp-plugins-provider"
  - "php artisan native:plugin:register musicplayer/media-library"
events:
  - MediaLoaded
---

# Media Library

Query the device's audio library from a NativePHP Mobile app. Reads the Android `MediaStore` and returns ready-to-use track metadata without parsing files yourself.

> **Status:** Android is implemented and battle-tested. iOS is scaffolded but not yet implemented.

## Features

- Track metadata: title, artist, album, genre, duration, year, track number
- Folder/bucket grouping (API 29+)
- Content URI for playback
- Artwork URI
- No file parsing required — reads directly from `MediaStore`

## Compatibility

| Platform | Support |
| -------- | ------- |
| Android  | API 21+ (folder grouping requires API 29+) |
| iOS      | Scaffolded, not yet implemented |

## Installation

```bash
composer require musicplayer/media-library
php artisan vendor:publish --tag=nativephp-plugins-provider
php artisan native:plugin:register musicplayer/media-library
```

## Usage

```php
use MusicPlayer\MediaLibrary\Facades\MediaLibrary;

$tracks = MediaLibrary::getTracks();
$folders = MediaLibrary::getFolders();
$tracksByFolder = MediaLibrary::getTracksInFolder($folderId);
```

## Events

- `MediaLoaded` — fired asynchronously with `tracks` array containing title, artist, album, genre, duration, year, contentUri, and artworkUri
