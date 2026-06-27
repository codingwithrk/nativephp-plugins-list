---
name: "NativePHP Mobile Share"
author: "Bifrost Technology"
price: "Free"
version: "1.0.1"
license: "MIT"
github: "https://github.com/NativePHP/mobile-share"
support: "https://nativephp.com/support"
compatibility:
  nativephp: "^3.0"
  ios: "18.2+"
  android: "26+"
install:
  - "composer require nativephp/mobile-share"
---

# NativePHP Mobile Share

Native share sheet for NativePHP Mobile — share URLs, text, and files using the platform's native sharing UI.

## Features

- Share URLs with custom titles and text
- Share files with automatic MIME type detection
- Share plain text messages
- Native share sheet UI per platform
- Automatic temporary file cleanup (Android)
- iPad popover support (iOS)

## Installation

```bash
composer require nativephp/mobile-share
```

## Compatibility

| Platform  | Minimum Version |
| --------- | --------------- |
| NativePHP | ^3.0            |
| iOS       | 18.2+           |
| Android   | API 26+         |

## Supported File Types

Audio (m4a, aac, mp3, wav, ogg, flac), Video (mp4, m4v, mov, avi, mkv, webm), Images (jpg, jpeg, png, gif, webp), Documents (pdf, txt)

## API

```php
Share::url(title: 'Title', text: 'Check this out', url: 'https://...');
Share::file(title: 'Title', text: 'Here is the file', filePath: '/path/to/file');
```
