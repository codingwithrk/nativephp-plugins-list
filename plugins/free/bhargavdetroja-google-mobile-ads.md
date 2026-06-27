---
name: "NativePHP Google Mobile Ads"
author: "Bhargav Detroja"
price: "Free"
version: "latest"
license: "MIT"
github: "https://github.com/BhargavDetroja/google-mobile-ads"
compatibility:
  nativephp: "3+"
  php: "8.2+"
  laravel: "12+"
install:
  - "composer require bhargavdetroja/nativephp-google-mobile-ads"
events:
  - AdLoaded
  - AdFailedToLoad
  - AdOpened
  - AdClosed
  - AdImpression
  - AdClicked
  - RewardEarned
---

# NativePHP Google Mobile Ads

Add **Google AdMob** ads to your [NativePHP Mobile](https://nativephp.com) app in minutes. No Kotlin, no Swift, no Gradle edits.

Works with **any frontend** — Livewire, React, Vue, Alpine.js, or plain JavaScript.

Supports **Banner**, **Interstitial**, **Rewarded**, **Rewarded Interstitial**, and **App Open** on Android and iOS.

---

## Requirements

- PHP 8.2+
- Laravel 12+
- NativePHP Mobile 3+
- An [AdMob account](https://admob.google.com) (free)

---

## Installation

### 1. Install the package

```bash
composer require bhargavdetroja/nativephp-google-mobile-ads
```

### 2. Publish the config

```bash
php artisan vendor:publish --tag=google-mobile-ads-config
```

### 3. Add your AdMob IDs to `.env`

```env
# App IDs — from AdMob console → Apps (one per platform)
ADMOB_APP_ID=ca-app-pub-XXXXXXXXXXXXXXXX~XXXXXXXXXX       # Android
ADMOB_IOS_APP_ID=ca-app-pub-XXXXXXXXXXXXXXXX~XXXXXXXXXX   # iOS

# Ad Unit IDs — from AdMob console → Ad units
ADMOB_BANNER_AD_UNIT_ID=ca-app-pub-XXXXXXXXXXXXXXXX/XXXXXXXXXX
ADMOB_INTERSTITIAL_AD_UNIT_ID=ca-app-pub-XXXXXXXXXXXXXXXX/XXXXXXXXXX
ADMOB_REWARDED_AD_UNIT_ID=ca-app-pub-XXXXXXXXXXXXXXXX/XXXXXXXXXX
ADMOB_REWARDED_INTERSTITIAL_AD_UNIT_ID=ca-app-pub-XXXXXXXXXXXXXXXX/XXXXXXXXXX
ADMOB_APP_OPEN_AD_UNIT_ID=ca-app-pub-XXXXXXXXXXXXXXXX/XXXXXXXXXX
ADMOB_ANCHORED_ADAPTIVE_BANNER_AD_UNIT_ID=ca-app-pub-XXXXXXXXXXXXXXXX/XXXXXXXXXX
ADMOB_INLINE_ADAPTIVE_BANNER_AD_UNIT_ID=ca-app-pub-XXXXXXXXXXXXXXXX/XXXXXXXXXX
```

> **Not ready for real IDs?** Leave the values empty — when `APP_ENV` is not `production`, the plugin automatically uses Google's official demo IDs so you always see real test ads.

### 4. Run native install

```bash
php artisan native:install --force
```

Both App IDs are injected into native configs automatically from your `.env`. No vendor files to edit.

---

## Configuration

`config/google-mobile-ads.php` gives you full control over ad placements, test mode, and the kill-switch.

### Kill-switch

Disable all ads globally with one env key — useful for premium users or A/B testing.

```env
ADMOB_ENABLED=false
```

### Test mode

Automatically on when `APP_ENV != production`. Override if needed:

```env
ADMOB_TEST_MODE=true
```

When active, Google's official demo IDs are substituted automatically — your real Ad Unit IDs are never used.

### Named slots

Slots are named ad placements defined in your config. They support different IDs per platform:

```php
// config/google-mobile-ads.php
'slots' => [
    'home_banner'    => env('ADMOB_BANNER_AD_UNIT_ID'),

    // Different ID per platform:
    'level_complete' => [
        'android' => env('ADMOB_INTERSTITIAL_ANDROID'),
        'ios'     => env('ADMOB_INTERSTITIAL_IOS'),
    ],
],
```

---

## Showing Ads

### Option A — Blade component (banner only)

Drop a banner anywhere in your Blade views. Show/hide is handled automatically when the component mounts and unmounts.

```blade
{{-- Uses the 'banner' slot from your config --}}
<x-google-ads::banner slot="banner" position="bottom" size="adaptive" />

{{-- Custom slot name --}}
<x-google-ads::banner slot="home_banner" position="top" />
```

### Option B — PHP Facade

```php
use NativePHP\GoogleMobileAds\Facades\GoogleMobileAds;

// Initialize once on app boot
GoogleMobileAds::initialize();

// Banner
GoogleMobileAds::showBanner('banner', position: 'bottom');
GoogleMobileAds::hideBanner();

// Interstitial — load first, show when ready
GoogleMobileAds::loadInterstitial('interstitial');
GoogleMobileAds::showInterstitial();

// Rewarded
GoogleMobileAds::loadRewarded('rewarded');
GoogleMobileAds::showRewarded();

// Rewarded Interstitial
GoogleMobileAds::loadRewardedInterstitial('rewarded_interstitial');
GoogleMobileAds::showRewardedInterstitial();

// App Open
GoogleMobileAds::loadAppOpen('app_open');
GoogleMobileAds::showAppOpen();
```

### Option C — JavaScript (React, Vue, Alpine, plain JS)

The JS bridge accepts raw ad unit IDs. Slot resolution and test-mode substitution happen server-side via the Blade component or PHP Facade.

```javascript
import {
    initialize,
    showBanner, hideBanner,
    loadInterstitial, showInterstitial,
    loadRewarded, showRewarded,
    loadRewardedInterstitial, showRewardedInterstitial,
    loadAppOpen, showAppOpen,
    onAdLoaded, onAdClosed, onRewardEarned, onAdEvent,
} from 'vendor/bhargavdetroja/nativephp-google-mobile-ads/resources/js/index.js';

// Initialize
await initialize();

// Banner — pass the resolved ID from your Blade/PHP layer
await showBanner('ca-app-pub-XXXXXXXXXXXXXXXX/XXXXXXXXXX', 'bottom', 'adaptive');
await hideBanner();

// Interstitial
await loadInterstitial('ca-app-pub-XXXXXXXXXXXXXXXX/XXXXXXXXXX');
await showInterstitial();

// Rewarded
await loadRewarded('ca-app-pub-XXXXXXXXXXXXXXXX/XXXXXXXXXX');
await showRewarded();
```

Pass the resolved ID from Blade so test-mode is respected:

```blade
<script>
    const BANNER_ID = '{{ app("google-mobile-ads")->resolveAdUnitId("banner") }}';
    const REWARDED_ID = '{{ app("google-mobile-ads")->resolveAdUnitId("rewarded") }}';
</script>
```

---

## Listening to Events

### In JavaScript — works with any framework

```javascript
import { onAdLoaded, onAdClosed, onRewardEarned, onAdEvent } from '...';

// Convenience helpers — return an unsubscribe function
const stopLoaded = onAdLoaded(({ adType, adUnitId }) => {
    console.log(`${adType} ad ready`);
});

onAdClosed(({ adType }) => {
    if (adType === 'interstitial') loadInterstitial(INTERSTITIAL_ID); // pre-load next
});

onRewardEarned(({ rewardType, rewardAmount }) => {
    addCoinsToUI(rewardAmount);
});

// Listen to any event by PHP class name
onAdEvent('NativePHP\\GoogleMobileAds\\Events\\AdFailedToLoad', ({ adType, errorMessage }) => {
    console.warn(`${adType} failed: ${errorMessage}`);
});

// Clean up (React/Vue component unmount)
stopLoaded();
```

**React:**

```jsx
useEffect(() => {
    loadRewarded(REWARDED_ID);
    const stop = onRewardEarned(({ rewardAmount }) => addCoins(rewardAmount));
    return stop; // cleans up on unmount
}, []);
```

**Vue:**

```js
onMounted(() => {
    loadRewarded(REWARDED_ID);
    const stop = onRewardEarned(({ rewardAmount }) => addCoins(rewardAmount));
    onUnmounted(stop);
});
```

### In PHP — standard Laravel events

```php
use NativePHP\GoogleMobileAds\Events\RewardEarned;
use NativePHP\GoogleMobileAds\Events\AdLoaded;
use NativePHP\GoogleMobileAds\Events\AdClosed;

// Any Laravel listener, queued job, or Livewire component:
public function handle(RewardEarned $event): void
{
    // $event->rewardType   → e.g. "coins"
    // $event->rewardAmount → e.g. 50
    auth()->user()->increment('coins', $event->rewardAmount);
}
```

Register in `AppServiceProvider`:

```php
Event::listen(RewardEarned::class, GrantRewardListener::class);
```

**Livewire:**

```php
protected $listeners = [
    AdLoaded::class     => 'onAdLoaded',
    AdClosed::class     => 'onAdClosed',
    RewardEarned::class => 'onRewardEarned',
];
```

---

## All Events

| Event | Properties | When it fires |
|---|---|---|
| `AdLoaded` | `$adType`, `$adUnitId` | Ad is ready to show |
| `AdFailedToLoad` | `$adType`, `$adUnitId`, `$errorCode`, `$errorMessage` | Ad failed to load |
| `AdOpened` | `$adType` | Full-screen ad appeared |
| `AdClosed` | `$adType` | Full-screen ad was dismissed |
| `AdImpression` | `$adType` | Ad recorded an impression |
| `AdClicked` | `$adType` | User tapped the ad |
| `RewardEarned` | `$rewardType`, `$rewardAmount` | User completed a rewarded ad |

`$adType` values: `banner`, `interstitial`, `rewarded`, `rewarded_interstitial`, `app_open`

---

## Going to Production

1. Add your real Ad Unit IDs to `.env`.
2. Set `APP_ENV=production` — test mode turns off automatically.
3. Run `php artisan native:install --force`.
4. Build your release: `php artisan native:run android` / `php artisan native:run ios`.

---

## Troubleshooting

**App crashes on iOS launch**
`ADMOB_IOS_APP_ID` is missing or wrong in your `.env`. Set it to your real iOS App ID and run `php artisan native:install --force`.

**Ads not showing in development**
Test mode is likely on — this is correct behaviour. You should still see Google demo ads. If you see nothing, make sure you called `initialize()` and that you're on a real device (not iOS Simulator).

**`unknown slot` exception**
You passed a slot name that isn't defined in `config/google-mobile-ads.php`. Either add it to `slots`, or pass a raw `ca-app-pub-...` ID directly.

**Interstitial/Rewarded "not loaded" error**
You must call `load*()` and wait for the `AdLoaded` event before calling `show*()`.

**iOS Simulator shows no ads**
Google Mobile Ads SDK does not support iOS Simulator. Use a real iPhone.

**Android emulator shows no ads**
The AVD must use a **Google APIs** system image — not plain Android or Google Play.

**Validate plugin setup**
```bash
php artisan native:plugin:validate
```

---

## License

MIT
