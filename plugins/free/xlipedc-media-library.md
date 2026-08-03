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

Query the **device's audio library** from a NativePHP Mobile app. On Android it reads the
system **MediaStore**, so you get ready-to-use track metadata (title, artist, album, genre,
duration, year, track number), the containing **folder**, a content **URI** for playback and
an **artwork URI** — without parsing files yourself.

> Status: **Android** is implemented and battle-tested. iOS is scaffolded but not yet implemented.

---

## Requirements

- NativePHP Mobile `^3.0`
- PHP `^8.2`
- Android `minSdk 21+` (folder/bucket grouping uses MediaStore buckets on API 29+)

---

## Installation

```bash
composer require musicplayer/media-library
```

Publish the NativePHP plugin provider (once per app) and register the plugin:

```bash
php artisan vendor:publish --tag=nativephp-plugins-provider
php artisan native:plugin:register musicplayer/media-library
```

Verify it is registered:

```bash
php artisan native:plugin:list
```

### Local development (from source)

Add a path repository to your app's `composer.json`, then require it:

```json
{
    "repositories": [
        { "type": "path", "url": "./packages/musicplayer/media-library" }
    ]
}
```

```bash
composer require musicplayer/media-library:@dev
```

---

## Permissions

The plugin declares the read permissions in its manifest, which are merged into your
`AndroidManifest.xml` at build time:

- `android.permission.READ_MEDIA_AUDIO` (Android 13+ / API 33+)
- `android.permission.READ_EXTERNAL_STORAGE` (older versions)

You must have the permission **granted at runtime** before calling `queryAudio()` — otherwise
the MediaStore returns an empty result (no exception). Request it through your app's normal
permission flow. For quick testing you can grant it via ADB:

```bash
adb shell pm grant <your.app.id> android.permission.READ_MEDIA_AUDIO
```

---

## Usage

```php
use Musicplayer\MediaLibrary\Facades\MediaLibrary;

// Confirm the native side is loaded
$status = MediaLibrary::getStatus();
// => ['status' => 'ready', 'provider' => 'MediaStore']

// Get every audio track indexed by the device
$tracks = MediaLibrary::queryAudio();
```

You can also resolve it from the container instead of the facade:

```php
$tracks = app(\Musicplayer\MediaLibrary\MediaLibrary::class)->queryAudio();
```

### Return shape

`queryAudio()` returns an array of associative arrays, one per track:

| Key           | Type   | Description                                              |
|---------------|--------|----------------------------------------------------------|
| `id`          | string | MediaStore item id                                       |
| `uri`         | string | `content://` URI of the track (use this to play it)      |
| `path`        | string | Absolute file path (`_data`) when available              |
| `title`       | string | Track title                                              |
| `artist`      | string | Artist                                                   |
| `album`       | string | Album                                                    |
| `album_id`    | string | MediaStore album id                                      |
| `artwork_uri` | string | `content://media/external/audio/albumart/<album_id>`     |
| `duration`    | int    | Duration in **seconds**                                  |
| `year`        | int    | Release year (`0` if unknown)                            |
| `track`       | int    | Track number (`0` if unknown)                            |
| `size`        | int    | File size in bytes                                       |
| `mime`        | string | MIME type (e.g. `audio/mpeg`)                            |
| `folder`      | string | Containing folder name (MediaStore bucket / parent dir)  |

Empty string / `0` is used for missing values (never `null`), so the payload is always
JSON-safe across the bridge.

### Example: group by folder

```php
$byFolder = collect(MediaLibrary::queryAudio())
    ->groupBy('folder')
    ->map->count();
```

---

### Runtime permission

```php
use Musicplayer\MediaLibrary\Facades\MediaLibrary;

if (! MediaLibrary::checkPermission()) {
    MediaLibrary::requestPermission(); // shows the native permission dialog
    // Ask the user to retry once granted.
}
```

### Folder picker (Storage Access Framework)

`pickFolder()` opens the native folder picker. It is **asynchronous**: the result is
delivered to the frontend as a DOM `native-event`, and the access is persisted across
app restarts (`takePersistableUriPermission`).

```php
MediaLibrary::pickFolder();
```

```js
// Vue / JS — listen for the chosen folder
document.addEventListener('native-event', (e) => {
    if (e.detail.event === 'folder:chosen') {
        const { uri, name } = e.detail.payload; // content tree URI + folder name
        // e.g. POST it to your backend to persist + scan
    }
    // 'folder:cancelled' is emitted if the user backs out.
});
```

Then read the audio inside the chosen tree (content URIs, via `MediaMetadataRetriever`):

```php
$tracks = MediaLibrary::scanTree($treeUri); // [{ uri, title, artist, album, duration, size, mime }, ...]
```

## Building

Native code changes are picked up when you (re)build the native project:

```bash
php artisan native:run        # prepares the bundle, compiles the plugin, runs the app
```

On Windows, if `native:run` cannot invoke the Gradle wrapper, build directly:

```bash
cd nativephp/android
./gradlew.bat assembleDebug   # or ./gradlew on macOS/Linux
```

---

## Bridge functions

| Function                    | Params     | Returns                                       |
|-----------------------------|------------|-----------------------------------------------|
| `MediaLibrary.QueryAudio`   | `context`  | `{ tracks: [...], count: int }`               |
| `MediaLibrary.CheckPermission` | `context` | `{ granted: bool }`                          |
| `MediaLibrary.RequestPermission` | `activity` | `{ granted: bool, requested: bool }`     |
| `MediaLibrary.PickFolder`   | `activity` | `{ started: true }` — result via `folder:chosen` event |
| `MediaLibrary.ScanTree`     | `context`  | `{ tracks: [...], count: int }`               |
| `MediaLibrary.GetStatus`    | `context`  | `{ status: "ready", provider: "MediaStore" }` |

---

## Roadmap

- iOS implementation (MPMediaQuery)
- Optional filtering parameters (by folder, by album, paging)
- Album-art bytes accessor for webview rendering
