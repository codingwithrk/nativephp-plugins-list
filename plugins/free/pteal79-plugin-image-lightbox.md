---
name: "Image Lightbox"
author: "Peter Teal"
price: "Free"
version: "latest"
license: "MIT"
github: "https://github.com/pteal79/plugin-image-lightbox"
compatibility:
  nativephp: "^3.0"
  php: "^8.2"
  ios: "any"
  android: "any"
install:
  - "composer require pteal79/plugin-image-lightbox"
  - "php artisan vendor:publish --tag=nativephp-plugins-provider"
  - "php artisan native:plugin:register pteal79/plugin-image-lightbox"
events:
  - EditPressed
  - MarkupPressed
  - DeletePressed
  - ClosePressed
---

# Image Lightbox

Display images (`jpg`, `jpeg`, `png`, `heic`) in a full-screen native lightbox overlay above the running app UI, with pinch-to-zoom, pan, and optional action buttons.

## Features

- Native full-screen modal on iOS and Android
- Pinch-to-zoom (up to 5×) and pan after zooming
- Loads local file paths and remote URLs
- WebView session cookie injection for authenticated endpoints
- Optional Edit, Markup, Share, and Delete toolbar buttons
- Native share sheet for local files and remote images
- Safe-area aware controls with dismiss animation
- Graceful error states (invalid URL, missing file, decode failure)

## Installation

```bash
composer require pteal79/plugin-image-lightbox
php artisan vendor:publish --tag=nativephp-plugins-provider
php artisan native:plugin:register pteal79/plugin-image-lightbox
```

## Usage

```php
use Pteal79\PluginImageLightbox\Facades\ImageLightbox;

ImageLightbox::show('/path/to/image.jpg');
ImageLightbox::show('https://example.com/photo.png');
```

## Events

- `EditPressed` — user tapped the Edit button; includes `imageId`
- `MarkupPressed` — user tapped the Markup button; includes `imageId`
- `DeletePressed` — user tapped the Delete button; includes `imageId`
- `ClosePressed` — user dismissed the lightbox; includes `imageId`
