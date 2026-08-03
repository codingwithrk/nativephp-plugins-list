---
name: "App Lifecycle"
author: "Igor Djurovic"
price: "Free"
version: "1.0.0"
license: "MIT"
github: "https://github.com/djurovicigoor/app-lifecycle"
compatibility:
  nativephp: "^3.0"
  ios: "15.0+"
  android: "21+"
  php: "^8.2"
install:
  - "composer require djurovicigoor/app-lifecycle"
events:
  - AppForegrounded
  - AppBackgrounded
---

# AppLifecycle Plugin for NativePHP Mobile

App lifecycle state detection for NativePHP Mobile — detects foreground/background transitions on Android and iOS.

---

## Installation

```bash
composer require djurovicigoor/app-lifecycle
```

## Plugin Registration

Register the plugin in your `NativeServiceProvider`:

```php
// app/Providers/NativeServiceProvider.php

public function plugins(): array
{
    return [
        // ...other plugins
        \Djurovicigoor\AppLifecycle\AppLifecycleServiceProvider::class,
    ];
}
```

---

## Usage

### PHP — Laravel Event Listener

Register a listener in your `AppServiceProvider`:

```php
// app/Providers/AppServiceProvider.php

use Djurovicigoor\AppLifecycle\Events\AppForegrounded;
use Djurovicigoor\AppLifecycle\Events\AppBackgrounded;
use Illuminate\Support\Facades\Event;

public function boot(): void
{
    // Fires every time the user returns to the app
    Event::listen(AppForegrounded::class, function (AppForegrounded $event) {
        // make an API call, refresh data, etc.
    });

    // Fires every time the user leaves the app
    Event::listen(AppBackgrounded::class, function (AppBackgrounded $event) {
        // flush pending writes, pause timers, etc.
    });
}
```

Or use a dedicated listener class:

```php
// app/Listeners/SyncOnForeground.php

namespace App\Listeners;

use Djurovicigoor\AppLifecycle\Events\AppForegrounded;
use Illuminate\Support\Facades\Http;

class SyncOnForeground
{
    public function handle(AppForegrounded $event): void
    {

    }
}
```

```php
// app/Providers/AppServiceProvider.php

Event::listen(AppForegrounded::class, SyncOnForeground::class);
```

> ⚠️ **NativePHP Mobile has no queue worker.** Do not implement `ShouldQueue` on your listeners — jobs will be written to the database but never processed. Keep listener logic fast and synchronous.

---

### PHP — Livewire Component

Use the `#[On]` attribute with the `native:` prefix in any Livewire component:

```php
use Livewire\Attributes\On;
use Livewire\Component;

class Dashboard extends Component
{
    #[On('native:Djurovicigoor\AppLifecycle\Events\AppForegrounded')]
    public function handleForegrounded(int $timestamp): void
    {
        // Refresh data when app returns to foreground
        $this->loadLatestData();
    }

    #[On('native:Djurovicigoor\AppLifecycle\Events\AppBackgrounded')]
    public function handleBackgrounded(int $timestamp): void
    {
        // Save state when app goes to background
        $this->saveCurrentState();
    }
}
```

---

### JavaScript — Vue 3 (Composition API)

```javascript
import { onAppForegrounded, onAppBackgrounded } from '@djurovicigoor/app-lifecycle';
import { onMounted, onUnmounted } from 'vue';

export default {
    setup() {
        let stopFg, stopBg;

        onMounted(() => {
            stopFg = onAppForegrounded(({ timestamp }) => {
                console.log('App is active again', new Date(timestamp));
                // fetch fresh data, restart polling, etc.
            });

            stopBg = onAppBackgrounded(({ timestamp }) => {
                console.log('App went to background', new Date(timestamp));
                // pause timers, cancel requests, etc.
            });
        });

        onUnmounted(() => {
            stopFg?.();
            stopBg?.();
        });
    },
};
```

---

### JavaScript — React

```javascript
import { onAppForegrounded, onAppBackgrounded } from '@djurovicigoor/app-lifecycle';
import { useEffect } from 'react';

export function Dashboard() {
    useEffect(() => {
        const stopFg = onAppForegrounded(({ timestamp }) => {
            console.log('App foregrounded at', timestamp);
        });

        const stopBg = onAppBackgrounded(({ timestamp }) => {
            console.log('App backgrounded at', timestamp);
        });

        return () => {
            stopFg();
            stopBg();
        };
    }, []);
}
```

---

### JavaScript — Vanilla / Inertia

```javascript
import { onAppForegrounded, onAppBackgrounded } from '@djurovicigoor/app-lifecycle';

// Returns an unsubscribe function — call it to clean up
const stopFg = onAppForegrounded(({ timestamp }) => syncData());
const stopBg = onAppBackgrounded(({ timestamp }) => saveState());

// Later, when tearing down:
stopFg();
stopBg();
```

---

## Events

### `AppForegrounded`

Fired when the user returns the app to the foreground after it was previously backgrounded.

> **Note:** This event does **not** fire on initial app launch — only on genuine background → foreground transitions.

**PHP class:** `Djurovicigoor\AppLifecycle\Events\AppForegrounded`

| Property | Type | Description |
|---|---|---|
| `$timestamp` | `int` | Unix timestamp in milliseconds when the transition occurred |

---

### `AppBackgrounded`

Fired when the user leaves the app (presses Home, switches apps, or locks the screen).

**PHP class:** `Djurovicigoor\AppLifecycle\Events\AppBackgrounded`

| Property | Type | Description |
|---|---|---|
| `$timestamp` | `int` | Unix timestamp in milliseconds when the transition occurred |

---

## JavaScript API

```javascript
import { onAppForegrounded, onAppBackgrounded, Events } from '@djurovicigoor/app-lifecycle';
```

| Function | Parameters | Returns | Description |
|---|---|---|---|
| `onAppForegrounded(handler)` | `handler: ({ timestamp: number }) => void` | `() => void` | Subscribe to foreground transitions |
| `onAppBackgrounded(handler)` | `handler: ({ timestamp: number }) => void` | `() => void` | Subscribe to background transitions |
| `Events.AppLifecycle.AppForegrounded` | — | `string` | PHP class name constant |
| `Events.AppLifecycle.AppBackgrounded` | — | `string` | PHP class name constant |

---

## Platform Behavior

### Android

- Foreground detection uses `NativePHPLifecycle.ON_RESUME`
- Background detection uses `NativePHPLifecycle.ON_PAUSE`
- The initial `onResume` at app launch is **suppressed** — a `wasBackgrounded` guard ensures only genuine returns fire the event
- NativePHP's activity declares `android:configChanges="uiMode|colorMode|orientation|screenSize"`, so screen rotation does **not** trigger false foreground/background events

### iOS

- Foreground detection uses `UIApplication.willEnterForegroundNotification`
- Background detection uses `UIApplication.didEnterBackgroundNotification`
- `willEnterForeground` fires only when returning from the background, **not** on initial app launch — no extra guard is needed

---

## Plugin Details

| Field | Value |
|---|---|
| Author | Djurovic Igor |
| Version | 1.0.0 |
| License | MIT |
| Android min SDK | 21 |
| iOS min version | 15.0 |
| Platforms | Android, iOS |
| NativePHP Mobile | `^3.0` |
| PHP | `^8.2` |

# Support
For questions or issues, email djurovic.igoor@gmail.com
