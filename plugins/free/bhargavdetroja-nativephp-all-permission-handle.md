---
name: "All Permission Handler"
author: "Bhargav Detroja"
price: "Free"
version: "1.0.2"
license: "MIT"
github: "https://github.com/BhargavDetroja/nativephp-all-permission-handler"
support: "bhargavdetroja@gmail.com"
compatibility:
  nativephp: "^3.0"
  ios: "15.0+"
  android: "21+"
  php: "8.2+"
install:
  - "composer require bhargavdetroja/nativephp-all-permission-handle"
---

# AllPermissionHandler for NativePHP Mobile

Runtime permission checks and requests for **iOS and Android** from your Laravel app. The API is aligned with Flutter’s **`permission_handler`** naming so the same permission strings work across PHP and JavaScript.

**Package:** `bhargavdetroja/nativephp-all-permission-handle`  
**Requires:** [NativePHP Mobile v3](https://nativephp.com/docs/mobile/3/getting-started/installation), PHP 8.2+

---

## Table of contents

1. [Quick start (7 steps)](#quick-start-7-steps)
2. [What this plugin does](#what-this-plugin-does)
3. [Requirements](#requirements)
4. [Installation](#installation)
5. [Configure permissions](#configure-permissions)
6. [After you change config](#after-you-change-config)
7. [Verify everything works](#verify-everything-works)
8. [Examples](#examples)
9. [API reference](#api-reference)
10. [Permission names (PHP and JS)](#permission-names-php-and-js)
11. [Status codes](#status-codes)
12. [Platform behaviour](#platform-behaviour)
13. [How builds use your config](#how-builds-use-your-config)
14. [Troubleshooting](#troubleshooting)
15. [Store & compliance](#store--compliance)
16. [Developing this plugin](#developing-this-plugin)
17. [Changelog & license](#changelog--license)

---

## Quick start (7 steps)

Do these in your **Laravel app that already uses NativePHP Mobile** (not inside this package’s repo).

| Step | Action |
|------|--------|
| 1 | `composer require bhargavdetroja/nativephp-all-permission-handle` |
| 2 | `php artisan vendor:publish --tag=nativephp-plugins-provider` |
| 3 | `php artisan native:plugin:register bhargavdetroja/nativephp-all-permission-handle` |
| 4 | `php artisan vendor:publish --tag=all-permission-handler-config` |
| 5 | Edit `config/all-permission-handler.php` — set `enabled_permissions` and `ios_usage_descriptions` for what you use (see [Configure permissions](#configure-permissions)) |
| 6 | `php artisan native:plugin:list` — confirm the plugin appears |
| 7 | Rebuild and run the native app (`php artisan native:run` or your usual iOS/Android flow) |

If any step fails, see [Troubleshooting](#troubleshooting).

---

## What this plugin does

- **Check** permission state (`check` / `status`)
- **Request** one or many permissions (`request`, `requestMultiple`)
- **Service status** where it applies (e.g. location services, notifications on some platforms)
- **Open app settings** (`openAppSettings`)
- **Android:** `shouldShowRequestRationale` (iOS returns `false`)

By default **no** permissions are enabled until you list them in config (safe for stores and security).

---

## Requirements

- Laravel application with **`nativephp/mobile` ^3.0** installed and project scaffolded (`native:install` or current NativePHP docs).
- Without NativePHP Mobile, Composer may still download this package, but **native code will not build** and you will see errors about missing providers or bridge classes.

---

## Installation

Run commands **in order**. Skipping an early step causes confusing errors later.

### 1. Install the Composer package

```bash
composer require bhargavdetroja/nativephp-all-permission-handle
```

### 2. Publish NativePHP’s plugin provider

Creates `app/Providers/NativeServiceProvider.php` (or equivalent). **Required before** `native:plugin:register`.

```bash
php artisan vendor:publish --tag=nativephp-plugins-provider
```

### 3. Register this plugin

Registers native (Swift/Kotlin) code for the next build.

```bash
php artisan native:plugin:register bhargavdetroja/nativephp-all-permission-handle
```

### 4. Publish this plugin’s config

```bash
php artisan vendor:publish --tag=all-permission-handler-config
```

### 5. Confirm registration

```bash
php artisan native:plugin:list
```

You should see `bhargavdetroja/nativephp-all-permission-handle` (or the registered name) in the list.

---

## Configure permissions

Edit **`config/all-permission-handler.php`**.

### Minimal example (camera + microphone)

```php
<?php

return [
    'enabled_permissions' => [
        'camera',
        'microphone',
    ],
    'preset' => 'none',
    'ios_usage_descriptions' => [
        'NSCameraUsageDescription' => 'We use the camera for [your real feature].',
        'NSMicrophoneUsageDescription' => 'We use the microphone for [your real feature].',
    ],
];
```

**iOS rule:** For every sensitive capability you enable, Apple expects a matching **`NS…UsageDescription`** string in the app’s **Info.plist**. This plugin generates those strings from `ios_usage_descriptions` (and sensible defaults where defined) and, on iOS builds, **merges them into the real NativePHP Info.plists** (see [How builds use your config](#how-builds-use-your-config)).

**Android rule:** Declared permissions come from the same `enabled_permissions` / preset list via the build hook.

### Presets (`preset` key)

Presets are **merged with** `enabled_permissions`.

| Value | Typical use |
|-------|-------------|
| `none` | Default. Only what you list under `enabled_permissions`. |
| `camera_only` | Adds camera. |
| `media_only` | Photos, videos, audio style set (see enum table). |
| `location_only` | Location when-in-use style set. |
| `full` | Everything the plugin knows about (use with care). |

Example — camera only, empty explicit list:

```php
'preset' => 'camera_only',
'enabled_permissions' => [],
'ios_usage_descriptions' => [
    'NSCameraUsageDescription' => '…',
],
```

---

## After you change config

1. Save `config/all-permission-handler.php`.
2. Run a **fresh native build** so hooks regenerate metadata and (on iOS) merge Info.plist keys.
3. On **iOS Simulator**, if the app was installed before, **delete the app** and install again so the new plist is picked up.

---

## Verify everything works

**Plugin visible**

```bash
php artisan native:plugin:list
```

**Optional — run the iOS copy-assets hook manually** (paths match a typical host project; adjust if yours differs):

```bash
php artisan nativephp:all-permission-handler:copy-assets \
  --platform=ios \
  --build-path="$(pwd)/nativephp/ios"
```

You should see JSON generated and log lines like `Merged usage descriptions into: …/NativePHP-simulator-Info.plist` when the plist files exist.

**Functional test:** Call `request('camera')` or the PHP equivalent **inside the NativePHP app**, not only in a desktop browser with `php artisan serve`.

---

## Examples

### Copy-paste: camera in one route

**Config** (at least):

```php
'enabled_permissions' => ['camera'],
'preset' => 'none',
'ios_usage_descriptions' => [
    'NSCameraUsageDescription' => 'This demo needs camera access.',
],
```

**`routes/web.php`**

```php
use Illuminate\Support\Facades\Route;
use Nativephp\AllPermissionHandler\Facades\AllPermissionHandler;
use Nativephp\AllPermissionHandler\Enums\Permission;

Route::get('/demo/camera', function () {
    $status = AllPermissionHandler::request(Permission::Camera);

    return response('Camera status: '.$status->name, 200, [
        'Content-Type' => 'text/plain; charset=UTF-8',
    ]);
});
```

Open `/demo/camera` in the **NativePHP mobile shell**; you should get the system dialog.

### Livewire button

**`app/Livewire/CameraDemo.php`**

```php
<?php

declare(strict_types=1);

namespace App\Livewire;

use Livewire\Component;
use Nativephp\AllPermissionHandler\Facades\AllPermissionHandler;
use Nativephp\AllPermissionHandler\Enums\Permission;

class CameraDemo extends Component
{
    public string $cameraStatus = 'not asked';

    public function requestCamera(): void
    {
        $this->cameraStatus = AllPermissionHandler::request(Permission::Camera)->name;
    }

    public function render()
    {
        return view('livewire.camera-demo');
    }
}
```

**`resources/views/livewire/camera-demo.blade.php`**

```blade
<div class="p-4">
    <button type="button" wire:click="requestCamera"
        class="rounded-lg bg-neutral-900 px-4 py-2 text-white active:opacity-80">
        Request camera
    </button>
    <p class="mt-3 text-sm text-neutral-600">Status: <strong>{{ $cameraStatus }}</strong></p>
</div>
```

**`routes/web.php`**

```php
use App\Livewire\CameraDemo;
use Illuminate\Support\Facades\Route;

Route::get('/demo/camera', CameraDemo::class);
```

### JavaScript (Inertia / Vite)

Install the JS helper from your NativePHP / package docs if needed, then:

```javascript
import { request } from '@nativephp/all-permission-handler';

const code = await request('camera'); // number: 0 denied, 1 granted, …
```

---

## API reference

### PHP

```php
use Nativephp\AllPermissionHandler\Facades\AllPermissionHandler;
use Nativephp\AllPermissionHandler\Enums\Permission;

AllPermissionHandler::status(Permission::Camera);   // alias of check()
AllPermissionHandler::check(Permission::Camera);
AllPermissionHandler::request(Permission::Camera);
AllPermissionHandler::requestMultiple([Permission::Camera, Permission::Microphone]);
AllPermissionHandler::serviceStatus(Permission::LocationWhenInUse);
AllPermissionHandler::shouldShowRequestRationale(Permission::Camera);
AllPermissionHandler::openAppSettings();

AllPermissionHandler::onDeniedCallback(fn () => logger()->warning('denied'))
    ->onGrantedCallback(fn () => logger()->info('granted'))
    ->request(Permission::Camera);
```

### JavaScript

```javascript
import {
  status,
  check,
  request,
  requestMultiple,
  serviceStatus,
  shouldShowRequestRationale,
  withCallbacks,
  openAppSettings,
} from '@nativephp/all-permission-handler';
```

### Methods summary

| Method | PHP | JS | Notes |
|--------|-----|-----|--------|
| Check current status | `check` / `status` | `check` / `status` | No prompt |
| Ask user | `request` | `request` | May show system UI |
| Several at once | `requestMultiple` | `requestMultiple` | |
| Service / subsystem | `serviceStatus` | `serviceStatus` | e.g. location enabled |
| Rationale (Android) | `shouldShowRequestRationale` | `shouldShowRequestRationale` | iOS: effectively false |
| Open settings | `openAppSettings` | `openAppSettings` | |
| Callbacks around request | fluent methods | `withCallbacks` | |

Return types: PHP uses enums where noted; JS typically uses numeric status codes (see below).

---

## Permission names (PHP and JS)

Use `Permission::X` in PHP or the string in the right column in JS.

| PHP enum | String (JS / config) |
|----------|----------------------|
| `Permission::Calendar` | `calendar` |
| `Permission::Camera` | `camera` |
| `Permission::Contacts` | `contacts` |
| `Permission::Location` | `location` |
| `Permission::LocationAlways` | `locationAlways` |
| `Permission::LocationWhenInUse` | `locationWhenInUse` |
| `Permission::MediaLibrary` | `mediaLibrary` |
| `Permission::Microphone` | `microphone` |
| `Permission::Phone` | `phone` |
| `Permission::Photos` | `photos` |
| `Permission::PhotosAddOnly` | `photosAddOnly` |
| `Permission::Reminders` | `reminders` |
| `Permission::Sensors` | `sensors` |
| `Permission::Sms` | `sms` |
| `Permission::Speech` | `speech` |
| `Permission::Storage` | `storage` |
| `Permission::IgnoreBatteryOptimizations` | `ignoreBatteryOptimizations` |
| `Permission::Notification` | `notification` |
| `Permission::AccessMediaLocation` | `access_media_location` |
| `Permission::ActivityRecognition` | `activity_recognition` |
| `Permission::Unknown` | `unknown` |
| `Permission::Bluetooth` | `bluetooth` |
| `Permission::ManageExternalStorage` | `manageExternalStorage` |
| `Permission::SystemAlertWindow` | `systemAlertWindow` |
| `Permission::RequestInstallPackages` | `requestInstallPackages` |
| `Permission::AppTrackingTransparency` | `appTrackingTransparency` |
| `Permission::CriticalAlerts` | `criticalAlerts` |
| `Permission::AccessNotificationPolicy` | `accessNotificationPolicy` |
| `Permission::BluetoothScan` | `bluetoothScan` |
| `Permission::BluetoothAdvertise` | `bluetoothAdvertise` |
| `Permission::BluetoothConnect` | `bluetoothConnect` |
| `Permission::NearbyWifiDevices` | `nearbyWifiDevices` |
| `Permission::Videos` | `videos` |
| `Permission::Audio` | `audio` |
| `Permission::ScheduleExactAlarm` | `scheduleExactAlarm` |
| `Permission::SensorsAlways` | `sensorsAlways` |
| `Permission::CalendarWriteOnly` | `calendarWriteOnly` |
| `Permission::CalendarFullAccess` | `calendarFullAccess` |
| `Permission::Assistant` | `assistant` |
| `Permission::BackgroundRefresh` | `backgroundRefresh` |

---

## Status codes

### Permission status (bridge / JS number)

| Code | Meaning |
|------|---------|
| `0` | denied |
| `1` | granted |
| `2` | restricted |
| `3` | limited |
| `4` | permanentlyDenied |
| `5` | provisional |

### Service status

| Code | Meaning |
|------|---------|
| `0` | disabled |
| `1` | enabled |
| `2` | notApplicable |

---

## Platform behaviour

| Area | iOS | Android |
|------|-----|---------|
| Camera, microphone | Runtime prompt | Runtime prompt |
| Location | Runtime / settings | May need settings after deny |
| Photos / media | Runtime | Varies by API level |
| Contacts, calendar | Runtime | Runtime |
| Reminders | iOS | N/A in map |
| Notifications | Runtime (iOS) | Android 13+ runtime |
| Speech | Runtime | Often tied to mic |
| Sensors / activity | Partial / device | API dependent |
| Special “settings” permissions | Limited | Opens settings screens |

**Android settings-style flows** (no simple runtime dialog):  
`manageExternalStorage`, `systemAlertWindow`, `requestInstallPackages`, `ignoreBatteryOptimizations`, `scheduleExactAlarm`, `accessNotificationPolicy`.

**iOS:** After denial, the user may need to use **Settings**; `openAppSettings()` helps.

---

## How builds use your config

When NativePHP runs the **`copy-assets`** hook for this plugin:

1. **`all-permission-handler.generated.android.json`** — enabled permissions and Android permission strings.
2. **`all-permission-handler.generated.ios.json`** — enabled permissions and **`ios_info_plist`** key/value strings.

NativePHP also reads static `ios.info_plist` from each plugin’s `nativephp.json`. This package keeps that minimal; your real strings come from **Laravel config**.

**Important (iOS):** The plugin **merges** those usage-description keys into the actual Xcode plist files next to the iOS build, when present:

- `NativePHP-simulator-Info.plist`
- `NativePHP/Info.plist`

That avoids a situation where JSON was generated but the **running app’s Info.plist** still lacked `NSCameraUsageDescription`, which causes an immediate **TCC / privacy crash** when camera APIs run.

---

## Troubleshooting

| What you see | What it usually means | What to do |
|--------------|----------------------|------------|
| `NativeServiceProvider not found` | Step 2 skipped | Run `vendor:publish --tag=nativephp-plugins-provider`, then register the plugin again. |
| `NativePluginHookCommand` not found | Wrong / missing NativePHP | `composer require nativephp/mobile:^3.0` and `composer update`. |
| iOS crash: `TCC`, `NSCameraUsageDescription`, privacy | Info.plist missing usage text | Set `enabled_permissions` + `ios_usage_descriptions`, rebuild iOS, delete old simulator app, reinstall. |
| Permission always denied | Plugin not in build or wrong key | `native:plugin:list`, clean rebuild; use exact strings from [Permission names](#permission-names-php-and-js). |
| Works in browser, not in app | No native bridge | Test inside the **NativePHP mobile** app; `nativephp_call` exists only there. |
| JSON exists but iOS still crashes | Old install or hook not run | Run iOS build again; confirm merge log lines; grep plist for `NSCameraUsageDescription`. |

---

## Store & compliance

- Enable **only** permissions your app truly uses.
- Write **specific** iOS usage strings (real feature, not “we need access”).
- Avoid risky Android permissions unless necessary (`sms`, background location, etc.).
- Re-check the list before each App Store / Play Store submission.

---

## Developing this plugin

Clone this repository and run tests locally:

```bash
composer install
./vendor/bin/pest --compact
```

Validate against a NativePHP checkout (path may differ):

```bash
php artisan native:plugin:validate path/to/all-permission-handler --no-interaction
```

---

## Semantic versioning (maintainers)

- **MAJOR** — breaking API or behaviour.
- **MINOR** — new permissions or features, backwards compatible.
- **PATCH** — fixes, docs, tests, internal refactors.
