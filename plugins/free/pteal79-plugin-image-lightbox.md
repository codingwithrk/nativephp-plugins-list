---
name: "Image Lightbox"
author: "Peter Teal"
price: "Free"
version: "1.0.9"
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

# ImageLightbox Plugin for NativePHP Mobile

Display images (`jpg`, `jpeg`, `png`, `heic`) in a full-screen native lightbox overlay above the running app UI.

**Features**

- Native full-screen modal on both iOS and Android
- Pinch-to-zoom (up to 5×) and pan after zooming
- Aspect-fit display by default
- Loads local file paths and remote URLs (with WebView session cookie injection for authenticated endpoints)
- Optional **Edit**, **Markup**, **Share**, and **Delete** action buttons
- Native share sheet for both local files and remote images
- `EditPressed`, `MarkupPressed`, `DeletePressed`, and `ClosePressed` events with `imageId` payload
- Icon-based toolbar at the top of the screen with dark-background buttons for legibility
- Safe-area aware controls; dismiss animation
- Graceful error states (invalid URL, missing file, decode failure)

---

## Installation

```bash
# 1. Install the package
composer require pteal79/plugin-image-lightbox

# 2. Publish the plugins provider (first time only)
php artisan vendor:publish --tag=nativephp-plugins-provider

# 3. Register the plugin (adds the service provider to NativePluginsServiceProvider)
php artisan native:plugin:register pteal79/plugin-image-lightbox

# 4. Verify registration
php artisan native:plugin:list
```

### Local development (path repository)

Add to your app's `composer.json`:

```json
{
    "repositories": [
        {
            "type": "path",
            "url": "./packages/pteal79/plugin-image-lightbox"
        }
    ]
}
```

Then run `composer require pteal79/plugin-image-lightbox`.

---

## Requirements

### Android

| Requirement | Detail |
|---|---|
| Permission | `android.permission.INTERNET` (remote URLs) — added automatically via `nativephp.json` |
| FileProvider | The host app must have a `FileProvider` configured with authority `${applicationId}.provider` for the **Share** feature to work. NativePHP Mobile typically configures this by default. |
| HEIC support | Android 9 (API 28)+ via `ImageDecoder`. Older devices fall back to `BitmapFactory`; HEIC may not decode on API < 28. |

### iOS

No additional permissions or Info.plist entries are required. HEIC is supported natively via `UIImage`.

---

## Usage

### PHP — Livewire / Blade

```php
use Nativephp\ImageLightbox\Facades\ImageLightbox;

// Remote URL — minimal
ImageLightbox::show([
    'url' => 'https://example.com/photo.jpg',
]);

// Local file — minimal
ImageLightbox::show([
    'local' => '/var/mobile/.../Documents/app/storage/app/public/photo.jpg',
]);

// Full options
ImageLightbox::show([
    'url'     => 'https://example.com/photo.heic',
    'imageId' => '550e8400-e29b-41d4-a716-446655440000',
    'edit'    => true,
    'markup'  => true,
    'share'   => true,
    'delete'  => true,
]);
```

### Parameters

| Parameter | Type     | Default | Description |
|-----------|----------|---------|-------------|
| `url`     | `string` | `null`  | Remote image URL (`http`/`https`). Supported formats: `jpg`, `jpeg`, `png`, `heic`, `webp`. |
| `local`   | `string` | `null`  | Absolute local file path to an image on the device. |
| `imageId` | `string` | `null`  | Optional identifier included in all event payloads. |
| `edit`    | `bool`   | `false` | Show an **Edit** button in the toolbar. |
| `markup`  | `bool`   | `false` | Show a **Markup** button in the toolbar. |
| `share`   | `bool`   | `false` | Show a **Share** button that opens the native share sheet. |
| `delete`  | `bool`   | `false` | Show a **Delete** button in the toolbar. |

Either `url` or `local` is required. If neither is provided the call is a no-op.

---

## Events

All events are dispatched after the lightbox has dismissed. Each event carries the `imageId` that was passed to `::show()` (or `null` if none was provided).

### `ClosePressed`

Fired when the user taps the **close (✕)** button.

```php
use Native\Mobile\Attributes\OnNative;
use Pteal79\ImageLightbox\Events\ClosePressed;

#[OnNative(ClosePressed::class)]
public function handleClose(?string $imageId = null): void
{
    // lightbox has been dismissed
}
```

### `EditPressed`

Fired when the user taps the **Edit** button (only available when `edit: true`).

```php
use Native\Mobile\Attributes\OnNative;
use Pteal79\ImageLightbox\Events\EditPressed;

#[OnNative(EditPressed::class)]
public function handleEdit(?string $imageId = null): void
{
    // open your edit UI here
}
```

### `MarkupPressed`

Fired when the user taps the **Markup** button (only available when `markup: true`).

```php
use Native\Mobile\Attributes\OnNative;
use Pteal79\ImageLightbox\Events\MarkupPressed;

#[OnNative(MarkupPressed::class)]
public function handleMarkup(?string $imageId = null): void
{
    //
}
```

### `DeletePressed`

Fired when the user taps the **Delete** button (only available when `delete: true`).

```php
use Native\Mobile\Attributes\OnNative;
use Pteal79\ImageLightbox\Events\DeletePressed;

#[OnNative(DeletePressed::class)]
public function handleDelete(?string $imageId = null): void
{
    // perform your delete logic here
}
```

### Event payload summary

| Event | Property | Type | Description |
|-------|----------|------|-------------|
| `ClosePressed`  | `imageId` | `string\|null` | The `imageId` passed to `::show()` |
| `EditPressed`   | `imageId` | `string\|null` | The `imageId` passed to `::show()` |
| `MarkupPressed` | `imageId` | `string\|null` | The `imageId` passed to `::show()` |
| `DeletePressed` | `imageId` | `string\|null` | The `imageId` passed to `::show()` |

---

## JavaScript (Vue / React / Inertia)

```javascript
import { ImageLightbox, Events } from '@pteal79/plugin-image-lightbox';
import { on, off } from '@nativephp/native';

// Show the lightbox
await ImageLightbox.show({
    url:     'https://example.com/photo.jpg',
    imageId: 'abc-123',
    edit:    true,
    delete:  true,
    share:   true,
});

// Listen for events using the exported constants (avoids typos)
const onDelete = ({ imageId }) => console.log('Delete pressed for', imageId);
on(Events.DeletePressed, onDelete);

const onClose = ({ imageId }) => console.log('Closed for', imageId);
on(Events.ClosePressed, onClose);

// Clean up
off(Events.DeletePressed, onDelete);
off(Events.ClosePressed, onClose);
```

Available event constants:

```javascript
Events.EditPressed   // 'Pteal79\ImageLightbox\Events\EditPressed'
Events.MarkupPressed // 'Pteal79\ImageLightbox\Events\MarkupPressed'
Events.DeletePressed // 'Pteal79\ImageLightbox\Events\DeletePressed'
Events.ClosePressed  // 'Pteal79\ImageLightbox\Events\ClosePressed'
```

---

## Toolbar

The toolbar sits at the top of the screen. Each button is a white SF Symbol (iOS) or text label (Android) on a semi-transparent dark background for legibility over any image. The close button is always present on the right; action buttons appear on the left in the order: Edit → Markup → Share → Delete.

---

## Share behaviour

- **Local file** — shared directly via the native share sheet.
- **Remote URL** — the image is downloaded to a temporary cache file first, then shared. If the image was already loaded for display, the cached copy is reused (no second download).
- Share failures (network error, missing file) surface a toast / alert — the lightbox remains open.

---

## Remote URL authentication

When loading a remote URL the plugin injects the current WebView session cookies into the `URLSession` / `HttpURLConnection` request automatically, so images served behind a Laravel session-authenticated route will load correctly.

---

## Limitations

- HEIC decoding on Android requires API 28+. On older devices the image may fail to render; a graceful error message is shown.
- The plugin presents over the current top-most view controller / activity. Ensure no other full-screen modal is already covering the app when calling `::show()`.
- The Edit, Markup, and Delete buttons are UI affordances only — the plugin dispatches an event and dismisses. Your application is responsible for the resulting action.
- Very large images (>20 MP) may be slow to decode on low-end Android devices. Consider resizing on the server before passing to the lightbox.
- The Share feature on Android requires the host app to have a `FileProvider` registered with the authority `${applicationId}.provider`. NativePHP Mobile configures this by default, but if you see a `FileUriExposedException` you may need to add/adjust the provider in your app's `AndroidManifest.xml`.

---
