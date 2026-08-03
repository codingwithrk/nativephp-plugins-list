---
name: "In App Update"
author: "Wilson Tovar"
price: "Free"
version: "1.0.2"
license: "MIT"
github: "https://github.com/wilsonatb/in-app-update"
support: "wilsonatb@gmail.com"
compatibility:
  nativephp: "^3.0"
  ios: "not supported"
  android: "26+"
install:
  - "composer require wilsonatb/in-app-update"
  - "php artisan vendor:publish --tag=nativephp-plugins-provider"
  - "php artisan native:plugin:register wilsonatb/in-app-update"
events:
  - InAppUpdateStateChanged
  - InAppUpdateFlowCompleted
---

# InAppUpdate Plugin for NativePHP Mobile

Android-only NativePHP plugin for Google Play In-App Updates. Easily integrate native app updates into your PHP/Livewire or JavaScript frontend with support for both **Flexible** and **Immediate** flows.

<p align="center">
</p>

## Understanding Update Flows

Google Play offers two ways to handle in-app updates. This plugin supports both:
* **Flexible:** The user can continue using the app while the update downloads in the background. Once downloaded, you prompt the user to install it.
* **Immediate:** A fullscreen blocking UI. The user must update and restart the app to continue using it.

---

## Installation

```bash
# 1. Install the package
composer require wilsonatb/in-app-update

# 2. Publish the plugins provider (first time only)
php artisan vendor:publish --tag=nativephp-plugins-provider

# 3. Register the plugin
php artisan native:plugin:register wilsonatb/in-app-update
```

### Platform Support

| Platform | Support | Notes |
|---|---|---|
| **Android** | ✅ Supported | Uses Google Play Core |
| **iOS** | ❌ Not supported | Returns a controlled skipped response (`supported: false`) to prevent crashes. |

---

## How It Works (The Recommended Flow)

Whether you use PHP or JavaScript, the mental model for a successful update attempt is the same:

1. **Generate an ID:** Create one UUID (`id`) per update attempt.
2. **Listen to Events:** Register listeners for `InAppUpdateStateChanged` and `InAppUpdateFlowCompleted`.
3. **Check Availability:** Call `checkForUpdate(...)`.
4. **Start the Update:** If available, call `startImmediateUpdate(...)` or `startFlexibleUpdate(...)`.
5. **Complete (Flexible only):** When the `installStatus` changes to `downloaded`, call `completeFlexibleUpdate(...)` to apply it.

---

## Usage Examples

### PHP / Livewire

This example demonstrates how to handle the async events triggered by the update flow using NativePHP's #[OnNative] attributes.

```php
use Native\Mobile\Attributes\OnNative;
use Wilsonatb\InAppUpdate\Events\InAppUpdateFlowCompleted;
use Wilsonatb\InAppUpdate\Events\InAppUpdateStateChanged;
use Wilsonatb\InAppUpdate\Facades\InAppUpdate;

public ?string $updateFlowId = null;

public function checkUpdate(): void
{
    $this->updateFlowId = (string) str()->uuid();

    $result = InAppUpdate::checkForUpdate(
        preferredType: 'any', // flexible | immediate | any
        id: $this->updateFlowId,
    );

    // iOS-safe response: plugin gracefully skips execution
    if (($result->supported ?? true) === false) {
        return;
    }
}

#[OnNative(InAppUpdateStateChanged::class)]
public function onInAppUpdateStateChanged(
    string $status,
    ?string $updateType = null,
    ?string $id = null,
    ?string $installStatus = null,
    ?bool $isUpdateAvailable = null,
): void {
    // Ensure we are responding to the current flow
    if ($id !== $this->updateFlowId) {
        return;
    }

    if ($status === 'availability_checked' && $isUpdateAvailable) {
        InAppUpdate::startFlexibleUpdate(id: $id);
    }

    if (in_array($installStatus, ['downloaded'], true)) {
        InAppUpdate::completeFlexibleUpdate(id: $id);
    }
}

#[OnNative(InAppUpdateFlowCompleted::class)]
public function onInAppUpdateFlowCompleted(
    string $result,
    string $updateType,
    ?string $id = null,
): void {
    // Handle final results: installed | downloaded | canceled | failed
}
```

### JavaScript (Vue / React / Inertia)

```javascript
import { InAppUpdate, Events } from '@wilsonatb/in-app-update';
import { on, off } from '@nativephp/native';

const id = crypto.randomUUID();

const onState = (payload) => console.log('State changed:', payload);
const onFlowCompleted = (payload) => console.log('Flow completed:', payload);

// Register listeners
on(Events.InAppUpdateStateChanged, onState);
on(Events.InAppUpdateFlowCompleted, onFlowCompleted);

// Check for update
const check = await InAppUpdate.checkForUpdate({ preferredType: 'any', id });

if (!check?.supported) {
    console.log('Skipped: InAppUpdate not supported on iOS', check);
} else if (check?.isUpdateAvailable) {
    await InAppUpdate.startFlexibleUpdate({ id });
}

// Complete if already downloaded
const latestStatus = await InAppUpdate.getInstallStatus();
if (latestStatus?.installStatus === 'downloaded') {
    await InAppUpdate.completeFlexibleUpdate({ id });
}

// Remember to clean up listeners when the component unmounts
off(Events.InAppUpdateStateChanged, onState);
off(Events.InAppUpdateFlowCompleted, onFlowCompleted);
```

---

## API Reference

> **Note:** Always pass the same `id` across all method calls and event checks for a single update attempt.

### Methods

| Method | Parameters | What it does | Returns (Immediate) |
|---|---|---|---|
| `checkForUpdate(...)` | `preferredType` (flexible\|immediate\|any, default: `flexible`), `minStalenessDays?` (int), `minPriority?` (int), `id?` (string) | Checks availability and allowed update types. | `{ status: "checking", ... }` |
| `startFlexibleUpdate(...)`| `allowAssetPackDeletion` (bool, default: `false`), `id?` (string) | Starts Play Core flexible flow in the background. | `{ status: "starting", updateType: "flexible", ... }` |
| `startImmediateUpdate(...)`| `allowAssetPackDeletion` (bool, default: `false`), `id?` (string) | Starts Play Core immediate blocking flow. | `{ status: "starting", updateType: "immediate", ... }` |
| `completeFlexibleUpdate(...)`| `id?` (string) | Installs a flexible update that has finished downloading. | `{ status: "completing", ... }` |
| `getInstallStatus()` | *None* | Returns last known native status snapshot. | Last cached status object |

### Events

* **`InAppUpdateStateChanged`**: Fired for non-terminal lifecycle/progress updates.
    * *Key Payload Fields:* `status`, `updateType`, `id`, `installStatus`, `isUpdateAvailable`, `bytesDownloaded`, `totalBytesToDownload`.
    * *Status Values:* `availability_checked`, `flow_started`, `install_state_changed`, `downloaded_pending_completion`, `developer_triggered_update_in_progress`, `resuming_immediate_update`, `completing_flexible_update`, `resume_check_failed`.
* **`InAppUpdateFlowCompleted`**: Fired when the flow reaches a terminal outcome.
    * *Key Payload Fields:* `result`, `updateType`, `id`, `error`.
    * *Result Values:* `installed`, `downloaded`, `canceled`, `failed`.

---

## Testing with Internal App Sharing

Testing Android In-App Updates requires specific conditions. Using Google Play's Internal App Sharing is the recommended approach:

1. Install a base build of your app that already includes this plugin on your device.
2. Build a new version with a **higher `versionCode`**.
3. Upload this newer build to Internal App Sharing in the Play Console.
4. Open the generated sharing URL on your test device, but **do not click install** on the Play Store page.
5. Open your currently installed app and trigger your update logic.

### ⚠️ Common Troubleshooting
* The Google account on the test device **must** have installed the app from Google Play at least once previously.
* Both the installed build and the uploaded build must share the **exact same `applicationId` and signing key**.
* `inAppUpdatePriority` constraints do not work during Internal App Sharing tests.

---

## Requirements & Support

* **Permissions:** No additional Android permissions are required.
* **Dependencies:** Plugin automatically includes `com.google.android.play:app-update:2.1.0` and `com.google.android.play:app-update-ktx:2.1.0`.

For issues, questions, or feature requests:
* **GitHub Issues:** [Open an issue](https://github.com/wilsonatb/in-app-update/issues)
* **Email:** diwdesign.wilson@gmail.com
