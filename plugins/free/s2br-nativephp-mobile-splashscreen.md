---
name: "NativePHP Mobile Splashscreen"
author: "Israel Pereira"
price: "Free"
version: "1.4.0"
license: "MIT"
github: "https://github.com/S2BR/nativephp-mobile-splashscreen"
support: "support@s2br.dev"
compatibility:
  nativephp: "^3.0"
  ios: "18.0+"
  android: "26+"
  php: "8.2+"
install:
  - "composer require s2br/nativephp-mobile-splashscreen"
  - "php artisan vendor:publish --tag=mobile-splashscreen-config"
  - "php artisan native:plugin:register s2br/nativephp-mobile-splashscreen"
events:
  - SplashscreenCompleted
  - SplashscreenLoopCompleted
---

A feature-rich NativePHP plugin for animated mobile splash screens. Supports Lottie animations, gradient backgrounds, dark mode, seasonal scheduling, exit transitions, app icon overlay, and NativePHP event dispatching — all driven by a single config file and `.env` variables.

## Gallery

### Splashscreen with a lottie animation
https://github.com/user-attachments/assets/b30b7ef2-81f0-46df-979f-95ec5192c495

### Splashscreen with text and icon
https://github.com/user-attachments/assets/aca02bf1-6fde-4ad5-94bf-df900693b555

---

## Requirements

- PHP 8.2+
- `ext-zip` (for automatic dotLottie v2→v1 conversion)
- NativePHP Mobile 3.0+
- Lottie 4.6.0+ (iOS — the `lottie-spm` SPM package, declared automatically via `nativephp.json`)
- Lottie Compose 6.7.1+ (Android — declared automatically via `nativephp.json`)

---

## Installation

```bash
composer require s2br/nativephp-mobile-splashscreen
```

Publish the config:

```bash
php artisan vendor:publish --tag=mobile-splashscreen-config
```

Register the plugin so its native code gets compiled into your app. For security, NativePHP requires plugins to be explicitly registered — use the built-in command (recommended):

```bash
# Publish the NativeServiceProvider if you haven't already
php artisan vendor:publish --tag=nativephp-plugins-provider

# Register this plugin (pass the Composer package name)
php artisan native:plugin:register s2br/nativephp-mobile-splashscreen
```

Verify it was picked up:

```bash
php artisan native:plugin:list
```

> **Prefer to do it by hand?** The command simply adds the plugin to the `plugins()` method in `app/Providers/NativeServiceProvider.php`. You can edit that file directly instead:
>
> ```php
> use S2BR\MobileSplashscreen\MobileSplashscreenServiceProvider;
>
> public function plugins(): array
> {
>     return [
>         MobileSplashscreenServiceProvider::class,
>     ];
> }
> ```

Configure in `.env`:

```env
MOBILE_SPLASHSCREEN_ANIMATION_PATH="resources/animations/splash.lottie"
MOBILE_SPLASHSCREEN_BG_TYPE=gradient
MOBILE_SPLASHSCREEN_GRADIENT_COLORS="#079F3D,#046B28"
MOBILE_SPLASHSCREEN_SIZE=0.8
MOBILE_SPLASHSCREEN_LOOP=false
```

> **Tip:** Place your `.lottie` files in `resources/animations/` — this is the conventional location and is correctly resolved via `base_path()` at build time.

---

## Enabling / Disabling

The splash screen is on by default. To turn it off entirely:

```env
MOBILE_SPLASHSCREEN_ENABLED=false
```

When disabled, this plugin injects nothing — the app falls back to **NativePHP's default splash handling** (no animation, background, progress bar, or transitions from this package). Rebuild for the change to take effect.

> The OS always shows its own native launch screen for a moment at cold start (iOS `LaunchScreen.storyboard`, Android's themed window) — that can't be removed. If you set `launch_color`, it is still applied to that screen even when the splash is disabled, so it can match your brand:
>
> ```env
> MOBILE_SPLASHSCREEN_LAUNCH_COLOR="#079F3D"
> ```

---

## Bundled Example Animations

To help you get started, this package ships with **8 ready-to-use Lottie animations**. They live in the package's `resources/animations/` directory and can be published straight into your app:

```bash
php artisan vendor:publish --tag=mobile-splashscreen-examples
```

This copies all 8 `.lottie` files into your app's `resources/animations/` directory — exactly where `MOBILE_SPLASHSCREEN_ANIMATION_PATH` expects them. Point your config at any one of them:

```env
MOBILE_SPLASHSCREEN_ANIMATION_PATH="resources/animations/animation4.lottie"
```

## How It Works

The plugin hooks into NativePHP's build pipeline at two stages:

1. **`copy_assets`** — Copies your `.lottie` files to the native project. If a file is in **dotLottie v2** format (the default LottieFiles Creator export), it automatically converts it to **v1** for `lottie-spm` compatibility on iOS. Also copies scheduled and dark-mode animations if configured.

2. **`pre_compile`** — Generates platform-specific splash screen code:
   - iOS: Replaces `SplashView.swift` with generated SwiftUI.
   - Android: Replaces the `SplashScreen()` composable in `MainActivity.kt`.
   - Updates `LaunchScreen.storyboard` (iOS) and `themes.xml` (Android) to match the background color.

Everything is config-driven. Re-running the build picks up any change.

---

## Configuration Reference

All options can be set via `.env` or `config/mobile-splashscreen.php`.

### Content Type

```env
MOBILE_SPLASHSCREEN_CONTENT=animation   # animation | text
```

---

### Animation

| ENV variable | Default | Description |
|---|---|---|
| `MOBILE_SPLASHSCREEN_ANIMATION_PATH` | `null` | Relative path to `.lottie` file (from project root) |
| `MOBILE_SPLASHSCREEN_LOOP` | `true` | `true` = loop forever, `false` = play once |
| `MOBILE_SPLASHSCREEN_SIZE` | `0.8` | Width as fraction of screen width (0.1–1.0) |
| `MOBILE_SPLASHSCREEN_POSITION` | `center` | `center` / `top` / `bottom` |

---

### Background

| ENV variable | Default | Description |
|---|---|---|
| `MOBILE_SPLASHSCREEN_BG_TYPE` | `color` | `color` or `gradient` |
| `MOBILE_SPLASHSCREEN_BG_COLOR` | `#FFFFFF` | Hex color for solid backgrounds |
| `MOBILE_SPLASHSCREEN_GRADIENT_COLORS` | `#079F3D,#046B28` | Comma-separated hex colors (min 2) |
| `MOBILE_SPLASHSCREEN_GRADIENT_DIRECTION` | `vertical` | `vertical` / `horizontal` / `diagonal` |

> When using a gradient, the first color is also applied to `LaunchScreen.storyboard` (iOS) and `themes.xml` (Android) so the OS-level launch matches your animation background.

---

### Text (when `content = text`)

| ENV variable | Default | Description |
|---|---|---|
| `MOBILE_SPLASHSCREEN_TEXT` | `''` | The text to display |
| `MOBILE_SPLASHSCREEN_TEXT_COLOR` | `#FFFFFF` | Text color (hex) |
| `MOBILE_SPLASHSCREEN_TEXT_SIZE` | `32` | Font size in points/sp |
| `MOBILE_SPLASHSCREEN_TEXT_WEIGHT` | `bold` | `thin` / `light` / `regular` / `medium` / `semibold` / `bold` / `heavy` / `black` |

---

### App Icon Overlay

Displays the app icon alongside the animation or text.

| ENV variable | Default | Description |
|---|---|---|
| `MOBILE_SPLASHSCREEN_SHOW_ICON` | `false` | Show the icon |
| `MOBILE_SPLASHSCREEN_ICON_SIZE` | `0.2` | Width as fraction of screen width (0.1–0.5) |
| `MOBILE_SPLASHSCREEN_ICON_POSITION` | `bottom` | `top` or `bottom` relative to main content |
| `MOBILE_SPLASHSCREEN_ICON_RADIUS` | `0.22` | Corner radius as fraction of icon width (0.0–0.5, where 0.5 = circle) |

iOS uses `UIImage(named: "AppIcon")` from the asset catalog. Android uses `R.mipmap.ic_launcher`.

---

### Timing

All values in milliseconds.

| ENV variable | Default | Description |
|---|---|---|
| `MOBILE_SPLASHSCREEN_DELAY_BEFORE` | `0` | Wait before the splash fades in |
| `MOBILE_SPLASHSCREEN_FADE_IN` | `600` | Fade-in duration |
| `MOBILE_SPLASHSCREEN_DELAY_AFTER` | `0` | Hold after single-run animation ends (no transition) |

---

### Events

| ENV variable | Default | Description |
|---|---|---|
| `MOBILE_SPLASHSCREEN_EVENT_COMPLETE` | `true` | Dispatch `SplashscreenCompleted` when a single-run animation ends |
| `MOBILE_SPLASHSCREEN_EVENT_LOOP` | `false` | Dispatch `SplashscreenLoopCompleted` after each loop iteration |

---

### Launch Color

The OS renders `LaunchScreen.storyboard` (iOS) and `themes.xml` (Android) **before** the app process starts — typically for 100–300 ms. This color is baked into the binary at compile time and cannot be changed at runtime.

| ENV variable | Default | Description |
|---|---|---|
| `MOBILE_SPLASHSCREEN_LAUNCH_COLOR` | `null` | Solid hex color for the OS-level launch screen. When `null`, defaults to the first background/gradient color. |

> **Tip:** Use this when your animation background varies at runtime (e.g. seasonal schedule) and you want the OS launch color to stay consistent instead of matching whichever animation is currently active.

```env
MOBILE_SPLASHSCREEN_LAUNCH_COLOR="#18181B"
```

---

### Progress Bar

Displays a subtle loading indicator while a single-run animation (`loop = false`) has finished but the app is still loading. It fills asymptotically toward ~88%, then completes to 100% the moment the app is ready. For looping animations this option has no effect.

| ENV variable | Default | Description |
|---|---|---|
| `MOBILE_SPLASHSCREEN_PROGRESS_BAR` | `false` | Show the progress bar |
| `MOBILE_SPLASHSCREEN_PROGRESS_BAR_COLOR` | `#FFFFFF` | Bar color (track at 15% opacity, fill at 60% opacity) |
| `MOBILE_SPLASHSCREEN_PROGRESS_BAR_DIRECTION` | `ltr` | Fill direction: `ltr` fills left→right, `rtl` fills right→left |

The bar is centered, takes ~50% of the screen width, is 3dp/pt tall with rounded ends, and exits as part of the splash transition — for `circle_expand` it gets swept away by the expanding circle; for fade/slide/scale it exits with everything else.

Use `rtl` for right-to-left locales (Arabic, Hebrew, etc.) so the fill progresses in the same direction as the reading flow.

`MOBILE_SPLASHSCREEN_PROGRESS_BAR` sets the **default** — it can always be overridden per entry in the dynamic or static schedule using `"progress_bar": true/false`. The same applies to `progress_bar_color` and `progress_bar_direction`.

```env
MOBILE_SPLASHSCREEN_LOOP=false
MOBILE_SPLASHSCREEN_PROGRESS_BAR=false
MOBILE_SPLASHSCREEN_PROGRESS_BAR_COLOR="#FFFFFF"
MOBILE_SPLASHSCREEN_PROGRESS_BAR_DIRECTION=ltr
```

---

### Transition Out

The exit animation played within the SplashView **before** the completion event is dispatched. Works with both `loop = false` (single-run) and `loop = true` — in loop mode the transition fires as soon as the WebView is ready, regardless of where in the loop the animation is.

| ENV variable | Default | Options |
|---|---|---|
| `MOBILE_SPLASHSCREEN_TRANSITION_OUT` | `none` | `none` / `fade` / `scale_up` / `scale_down` / `slide_up` / `slide_down` / `circle_expand` |
| `MOBILE_SPLASHSCREEN_TRANSITION_DURATION` | `400` | Duration in milliseconds |
| `MOBILE_SPLASHSCREEN_TRANSITION_ORIGIN` | `center` | `circle_expand` start point: `center` / `top` / `bottom` / `top_left` / `top_right` / `bottom_left` / `bottom_right` / `center_left` / `center_right` |

**`circle_expand`** punches a transparent hole through the splash layer, revealing the WebView behind it — not a colored overlay. The hole expands from the chosen origin point until it covers the entire screen.

**Example — circle reveal from center:**
```env
MOBILE_SPLASHSCREEN_LOOP=false
MOBILE_SPLASHSCREEN_TRANSITION_OUT=circle_expand
MOBILE_SPLASHSCREEN_TRANSITION_DURATION=500
MOBILE_SPLASHSCREEN_TRANSITION_ORIGIN=center
```

**Example — reveal from the left edge (loop mode):**
```env
MOBILE_SPLASHSCREEN_LOOP=true
MOBILE_SPLASHSCREEN_TRANSITION_OUT=circle_expand
MOBILE_SPLASHSCREEN_TRANSITION_DURATION=600
MOBILE_SPLASHSCREEN_TRANSITION_ORIGIN=center_left
```

---

### Theme (Dark Mode)

Controls how the splash responds to the system dark/light mode.

| ENV variable | Default | Description |
|---|---|---|
| `MOBILE_SPLASHSCREEN_THEME` | `auto` | `auto` = follow system, `light` = always light, `dark` = always dark |
| `MOBILE_SPLASHSCREEN_DARK_ANIMATION_PATH` | `null` | Alternative `.lottie` file for dark mode |
| `MOBILE_SPLASHSCREEN_DARK_BG_TYPE` | `null` | Set to `color` or `gradient` to activate dark background |
| `MOBILE_SPLASHSCREEN_DARK_BG_COLOR` | `#000000` | Dark mode solid background color |
| `MOBILE_SPLASHSCREEN_DARK_GRADIENT_COLORS` | `#000000,#1A1A1A` | Dark mode gradient colors |
| `MOBILE_SPLASHSCREEN_DARK_GRADIENT_DIRECTION` | `vertical` | Dark mode gradient direction |

**Example — dark background with a separate animation:**
```env
MOBILE_SPLASHSCREEN_THEME=auto
MOBILE_SPLASHSCREEN_DARK_BG_TYPE=gradient
MOBILE_SPLASHSCREEN_DARK_GRADIENT_COLORS="#0D0D0D,#1A1A1A"
MOBILE_SPLASHSCREEN_DARK_ANIMATION_PATH="resources/animations/splash_dark.lottie"
```

When `theme = auto`, iOS uses `@Environment(\.colorScheme)` and Android uses `isSystemInDarkTheme()`. The detection happens at runtime — no rebuild needed when the user toggles dark mode.

---

### Schedule (Build-time / Static Date Animations)

Bake a static schedule into the binary at build time. Animation files are bundled and switching is evaluated on-device — no rebuild when the date changes, but adding new entries requires a rebuild.

```env
MOBILE_SPLASHSCREEN_SCHEDULE="resources/splash-schedule.json"
```

**Schedule JSON format:**

```json
{
  "schedule": [
    {
      "name": "christmas",
      "from": "12-24",
      "to": "12-26",
      "animation": "resources/animations/christmas.lottie",
      "background": {
        "type": "gradient",
        "colors": ["#1B4F72", "#154360"],
        "direction": "vertical"
      }
    },
    {
      "name": "new_year",
      "from": "12-31",
      "to": "01-02",
      "animation": "resources/animations/fireworks.lottie"
    },
    {
      "name": "christmas_2026_special",
      "from": "2026-12-24",
      "to": "2026-12-26",
      "animation": "resources/animations/christmas_anniversary.lottie"
    }
  ]
}
```

**Date format — two styles, mix freely:**

| Format | Example | Behavior |
|---|---|---|
| `MM-DD` | `"12-24"` | **Recurs every year** on that month/day. Use this for seasons. |
| `YYYY-MM-DD` | `"2026-12-24"` | Matches **only that specific year**. Use for one-off dated events. |

- Ranges that span the year boundary (e.g. `12-31` → `01-02`) are handled correctly in both formats.
- **Precedence:** when a full-date entry and a recurring entry both match today, the **full date wins** — so the `christmas_2026_special` entry above replaces the recurring `christmas` animation in 2026 only, then it reverts automatically.
- Every per-entry property listed in the dynamic schedule table (`loop`, `size`, `transition_out`, `background`, etc.) works here too. The entries are embedded in the binary as JSON and resolved on-device at launch — same mechanism, just baked in at build time instead of downloaded.
- All referenced animation files are automatically deployed at build time.

**Priority at runtime:** dynamic schedule-local → build-time schedule entry → dark mode override → default. Within a schedule, a full-date match beats a recurring `MM-DD` match.

---

### Dynamic Remote Schedule

For animations that can be updated without a new app release. The sync command fetches your remote schedule, pre-downloads `.lottie` files for every entry active within a configurable lookahead window, and writes `schedule-local.json` to device storage. Native code reads this file on every app launch and resolves today's active entry on-device — **no network call is needed at launch, and the correct animation plays even when the device is offline**.

**How it works:**

1. Your server exposes a JSON schedule at a URL.
2. A daily Laravel scheduler runs the sync command while the device has internet.
3. The command pre-downloads animation files for the next N days (default 30).
4. At launch the app reads the local schedule and picks the entry matching today's date.
5. If no entry matches, the static build-time animation plays instead.
6. Stale animation files (past their end date and no longer in the schedule) are automatically deleted.

**Step 1 — Define your remote schedule JSON:**

```json
{
  "schedule": [
    {
      "name": "christmas",
      "date": { "from": "2026-12-24", "to": "2026-12-26" },
      "url": "https://your-cdn.com/animations/christmas.lottie",
      "background": {
        "type": "gradient",
        "colors": ["#1B4F72", "#154360"]
      }
    },
    {
      "name": "new_year",
      "date": { "from": "2026-12-31", "to": "2027-01-02" },
      "url": "https://your-cdn.com/animations/new_year.lottie",
      "background": {
        "type": "color",
        "color": "#0D0D0D"
      }
    }
  ]
}
```

| Field | Description |
|---|---|
| `date.from` / `date.to` | Date range. Use `YYYY-MM-DD` for a specific year, or `MM-DD` to recur every year. Year-boundary ranges work correctly; a full-date match takes precedence over a recurring `MM-DD` match. |
| `url` | URL to download the `.lottie` file from. |
| `background` | Optional. `type: "gradient"` with a `colors` array, or `type: "color"` with a `color` hex. Overrides the build-time background for this entry. |
| `loop` | Optional boolean. Overrides `MOBILE_SPLASHSCREEN_LOOP` for this entry. |
| `size` | Optional float (0.1–1.0). Overrides `MOBILE_SPLASHSCREEN_SIZE`. |
| `position` | Optional string (`center` / `top` / `bottom`). Overrides `MOBILE_SPLASHSCREEN_POSITION`. |
| `transition_out` | Optional string (`none` / `fade` / `scale_up` / `scale_down` / `slide_up` / `slide_down` / `circle_expand`). |
| `transition_duration` | Optional integer (ms). Overrides `MOBILE_SPLASHSCREEN_TRANSITION_DURATION`. |
| `transition_origin` | Optional string. Overrides `MOBILE_SPLASHSCREEN_TRANSITION_ORIGIN` for `circle_expand`. |
| `delay_before` | Optional integer (ms). Overrides `MOBILE_SPLASHSCREEN_DELAY_BEFORE`. |
| `fade_in` | Optional integer (ms). Overrides `MOBILE_SPLASHSCREEN_FADE_IN`. |
| `delay_after` | Optional integer (ms). Overrides `MOBILE_SPLASHSCREEN_DELAY_AFTER`. |
| `on_complete` | Optional boolean. Overrides `MOBILE_SPLASHSCREEN_EVENT_COMPLETE`. |
| `on_loop` | Optional boolean. Overrides `MOBILE_SPLASHSCREEN_EVENT_LOOP`. |
| `show_icon` | Optional boolean. Overrides `MOBILE_SPLASHSCREEN_SHOW_ICON`. |
| `icon_size` | Optional float (0.1–0.5). Overrides `MOBILE_SPLASHSCREEN_ICON_SIZE`. |
| `icon_position` | Optional string (`top` / `bottom`). Overrides `MOBILE_SPLASHSCREEN_ICON_POSITION`. |
| `icon_radius` | Optional float (0.0–0.5). Overrides `MOBILE_SPLASHSCREEN_ICON_RADIUS`. |
| `progress_bar` | Optional boolean. Show or hide the progress bar for this entry. Overrides `MOBILE_SPLASHSCREEN_PROGRESS_BAR`. |
| `progress_bar_color` | Optional hex string. Overrides `MOBILE_SPLASHSCREEN_PROGRESS_BAR_COLOR` for this entry. |
| `progress_bar_direction` | Optional string (`ltr` / `rtl`). Overrides `MOBILE_SPLASHSCREEN_PROGRESS_BAR_DIRECTION` for this entry. |

Every property is optional — omit any field to inherit the build-time value from your `.env`/config. This means a minimal entry only needs `date`, `url`, and the properties that differ from your defaults.

**Full example — entry with all overrides:**

```json
{
  "schedule": [
    {
      "name": "christmas",
      "date": { "from": "2026-12-24", "to": "2026-12-26" },
      "url": "https://your-cdn.com/animations/christmas.lottie",
      "background": {
        "type": "gradient",
        "colors": ["#1B4F72", "#154360"]
      },
      "loop": true,
      "size": 0.9,
      "position": "center",
      "transition_out": "circle_expand",
      "transition_duration": 600,
      "transition_origin": "center",
      "delay_before": 0,
      "fade_in": 800,
      "delay_after": 0,
      "on_complete": false,
      "on_loop": true,
      "show_icon": true,
      "icon_size": 0.15,
      "icon_position": "bottom",
      "icon_radius": 0.22,
      "progress_bar": true,
      "progress_bar_color": "#FFFFFF",
      "progress_bar_direction": "ltr"
    }
  ]
}
```

**Step 2 — Run the sync command:**

```bash
# Fetch schedule + pre-download animations active within the next 30 days (default)
php artisan nativephp:mobile-splashscreen:sync --url=https://your-cdn.com/animations.json

# Extend the lookahead window (e.g. 60 days, useful before a long offline period)
php artisan nativephp:mobile-splashscreen:sync --url=https://your-cdn.com/animations.json --days=60

# Re-resolve from an already-downloaded animations.json (no re-fetch)
php artisan nativephp:mobile-splashscreen:sync
```

**Step 3 — Schedule it to run daily:**

```php
// routes/console.php
Schedule::command('nativephp:mobile-splashscreen:sync --url=https://your-cdn.com/animations.json')
    ->daily();
```

**Or use the fluent PHP API directly:**

```php
use S2BR\MobileSplashscreen\Facades\MobileSplashscreen;

MobileSplashscreen::syncFromUrl('https://your-cdn.com/animations.json')
                 ->resolveActive(daysAhead: 30);
```

**Other helpers:**

```php
MobileSplashscreen::hasActive();   // true if schedule-local.json exists
MobileSplashscreen::clearActive(); // remove schedule-local.json (reverts to default)
```

**Files written to `storage/app/splashscreen/`:**

| File | Description |
|---|---|
| `animations.json` | Full schedule downloaded from your server |
| `animations/` | Pre-downloaded `.lottie` files (stale files auto-deleted on each sync) |
| `schedule-local.json` | Normalised upcoming entries with local file paths — read by native code at launch |

The bundled default animation (from `.env`) always serves as fallback if `schedule-local.json` does not exist or no entry matches today's date.

---

## Events

### SplashscreenCompleted

Dispatched when a single-run animation (`loop = false`) finishes, after any `transition_out` animation completes.

Payload: `animationName` (string), `duration` (float, reserved — currently always `0.0`).

### SplashscreenLoopCompleted

Dispatched after each loop iteration when `loop = true` and `events.on_loop = true`.

Payload: `animationName` (string), `iteration` (int, starts at 1).

---

## Listening for Events

### Livewire

```php
use Livewire\Attributes\On;
use S2BR\MobileSplashscreen\Events\SplashscreenCompleted;
use S2BR\MobileSplashscreen\Events\SplashscreenLoopCompleted;

#[On('native:'.SplashscreenCompleted::class)]
public function onSplashDone(string $animationName, float $duration): void
{
    // Dispatched after the splash exits (including any transition_out animation)
}

#[On('native:'.SplashscreenLoopCompleted::class)]
public function onSplashLoop(int $iteration, string $animationName): void
{
    if ($iteration >= 3) {
        // After 3 loops, do something in your app
    }
}
```

### React

```javascript
import { useEffect } from 'react';
import { SplashscreenCompleted } from '@/nativephp/events';

useEffect(() => {
    const handler = (event) => {
        const { animationName, duration } = event.detail;
        console.log('Splash done', animationName);
    };

    window.addEventListener('native:S2BR\MobileSplashscreen\Events\SplashscreenCompleted', handler);

    return () => {
        window.removeEventListener('native:S2BR\MobileSplashscreen\Events\SplashscreenCompleted', handler);
    };
}, []);
```

### Vue

```javascript
import { onMounted, onUnmounted } from 'vue';

function onSplashDone(event) {
    const { animationName } = event.detail;
    console.log('Splash done', animationName);
}

onMounted(() => {
    window.addEventListener('native:S2BR\MobileSplashscreen\Events\SplashscreenCompleted', onSplashDone);
});

onUnmounted(() => {
    window.removeEventListener('native:S2BR\MobileSplashscreen\Events\SplashscreenCompleted', onSplashDone);
});
```

> **Note:** Events are dispatched via the NativePHP JS bridge after the WebView is ready. They arrive **after** the splash has signalled completion, not while it is still visible. NativePHP handles the actual dismissal of the splash view when the WebView finishes loading.

---

## Usage Examples

### Minimal — gradient background, looping animation

```env
MOBILE_SPLASHSCREEN_ANIMATION_PATH="resources/animations/splash.lottie"
MOBILE_SPLASHSCREEN_BG_TYPE=gradient
MOBILE_SPLASHSCREEN_GRADIENT_COLORS="#079F3D,#046B28"
MOBILE_SPLASHSCREEN_SIZE=0.8
```

### Play once with a progress bar while loading

```env
MOBILE_SPLASHSCREEN_ANIMATION_PATH="resources/animations/intro.lottie"
MOBILE_SPLASHSCREEN_LOOP=false
MOBILE_SPLASHSCREEN_PROGRESS_BAR=true
MOBILE_SPLASHSCREEN_PROGRESS_BAR_COLOR="#FFFFFF"
MOBILE_SPLASHSCREEN_TRANSITION_OUT=circle_expand
MOBILE_SPLASHSCREEN_TRANSITION_ORIGIN=center_left
```

### Play once with a fade-out transition

```env
MOBILE_SPLASHSCREEN_ANIMATION_PATH="resources/animations/intro.lottie"
MOBILE_SPLASHSCREEN_LOOP=false
MOBILE_SPLASHSCREEN_TRANSITION_OUT=fade
MOBILE_SPLASHSCREEN_TRANSITION_DURATION=400
MOBILE_SPLASHSCREEN_EVENT_COMPLETE=true
```

### Loop with a circle-expand reveal

```env
MOBILE_SPLASHSCREEN_ANIMATION_PATH="resources/animations/splash.lottie"
MOBILE_SPLASHSCREEN_LOOP=true
MOBILE_SPLASHSCREEN_TRANSITION_OUT=circle_expand
MOBILE_SPLASHSCREEN_TRANSITION_DURATION=500
MOBILE_SPLASHSCREEN_TRANSITION_ORIGIN=center
```

### Dark mode support

```env
MOBILE_SPLASHSCREEN_THEME=auto
MOBILE_SPLASHSCREEN_BG_TYPE=gradient
MOBILE_SPLASHSCREEN_GRADIENT_COLORS="#079F3D,#046B28"
MOBILE_SPLASHSCREEN_DARK_BG_TYPE=gradient
MOBILE_SPLASHSCREEN_DARK_GRADIENT_COLORS="#0D0D0D,#1A1A1A"
```

### Seasonal schedule

```env
MOBILE_SPLASHSCREEN_SCHEDULE="resources/splash-schedule.json"
```

### Text-only splash

```env
MOBILE_SPLASHSCREEN_CONTENT=text
MOBILE_SPLASHSCREEN_TEXT="Loading..."
MOBILE_SPLASHSCREEN_TEXT_COLOR="#FFFFFF"
MOBILE_SPLASHSCREEN_TEXT_WEIGHT=light
MOBILE_SPLASHSCREEN_BG_COLOR="#1A1A2E"
```

### Animation with icon below

```env
MOBILE_SPLASHSCREEN_ANIMATION_PATH="resources/animations/splash.lottie"
MOBILE_SPLASHSCREEN_BG_TYPE=gradient
MOBILE_SPLASHSCREEN_GRADIENT_COLORS="#079F3D,#046B28"
MOBILE_SPLASHSCREEN_SHOW_ICON=true
MOBILE_SPLASHSCREEN_ICON_POSITION=bottom
MOBILE_SPLASHSCREEN_ICON_RADIUS=0.22
```

---

## dotLottie Format Notes

| Scenario | Behavior |
|---|---|
| v1 file | Copied as-is to the native bundle |
| v2 file (LottieFiles Creator default) | Auto-converted to v1 during `copy_assets` |
| Conversion strips | `fonts`, layer effects (`ef`), `hasMask`, text layers (`ty=5`), `Background` layer |

**Why this matters:** `lottie-spm` 4.6.0 (the iOS Lottie renderer this plugin declares in `nativephp.json`) only supports dotLottie v1. A v2 file silently fails — blank screen, no error. The conversion happens automatically; no manual script is needed.

To verify your file format:
```bash
unzip -l your-animation.lottie
# v1: shows animations/main.json
# v2: shows a/Main Scene.json
```

**Text layers:** `ty=5` text layers are stripped during conversion because `lottie-spm` crashes when a referenced font is not embedded. Vectorize text in LottieFiles Creator before exporting.

---

## Programmatic Config Access

```php
use S2BR\MobileSplashscreen\Facades\MobileSplashscreen;

$size = MobileSplashscreen::config('animation.size');
$bgType = MobileSplashscreen::config('background.type');

$errors = MobileSplashscreen::validate();
```

---

## Troubleshooting

### Animation not showing on iOS (blank screen)

Check the build output for:
```
Detected dotLottie v2 — converting to v1 for lottie-spm...
```

If absent, verify `animation.path` is set and the file exists. Also make sure you don't declare a Lottie iOS SPM dependency in your own `nativephp.json` — this plugin already declares `lottie-spm`, and a second Lottie package causes a product naming conflict.

### Gradient colors from ENV not parsing

Ensure no spaces around commas:
```env
# Correct
MOBILE_SPLASHSCREEN_GRADIENT_COLORS="#079F3D,#046B28"

# Wrong
MOBILE_SPLASHSCREEN_GRADIENT_COLORS="#079F3D, #046B28"
```

### SplashView.swift not updating

The plugin replaces `SplashView.swift` entirely during `pre_compile`. Manual edits are overwritten. All customization must go through the config file.

### Schedule animations not deploying

Ensure the schedule JSON path is correct and all referenced `.lottie` files exist at build time. The `copy_assets` hook reads the schedule and deploys all referenced animations.

### Dynamic schedule not showing on device

1. Confirm `schedule-local.json` exists in `storage/app/splashscreen/` on the device.
2. Check that the entry's `from`/`to` dates include today in `YYYY-MM-DD` format.
3. Verify the `.lottie` file was downloaded to `storage/app/splashscreen/animations/` — check the sync command output.
4. If the sync command ran before the entry's start date, ensure the lookahead window (`--days`) was large enough to include it.

### Build hook not running

Ensure the plugin is registered. Run `php artisan native:plugin:list` — if it isn't listed, register it with:
```bash
php artisan native:plugin:register s2br/nativephp-mobile-splashscreen
```
This adds the plugin to the `plugins()` method in `app/Providers/NativeServiceProvider.php` (which you can also edit by hand):
```php
public function plugins(): array
{
    return [
        \S2BR\MobileSplashscreen\MobileSplashscreenServiceProvider::class,
    ];
}
```

---
