---
name: "In App Reviews"
author: "Wilson Tovar"
price: "Free"
version: "1.0.5"
license: "MIT"
github: "https://github.com/wilsonatb/nativephp-in-app-reviews"
support: "wilsonatb@gmail.com"
compatibility:
  nativephp: "^3.0"
  ios: "16.0+"
  android: "26+"
install:
  - "composer require wilsonatb/nativephp-in-app-reviews"
  - "php artisan native:plugin:register wilsonatb/nativephp-in-app-reviews"
---

# InAppReviews Plugin for NativePHP Mobile

NativePHP plugin for requesting app reviews on Android (Google Play) and iOS (App Store).

## Screenshots

<p align="center">
</p>

## Installation

```bash
composer require wilsonatb/nativephp-in-app-reviews

php artisan native:plugin:register wilsonatb/nativephp-in-app-reviews
```

## Usage (PHP)

### Basic Usage

```php
use Nativephp\InAppReviews\Facades\InAppReviews;

// Request app review flow
$result = InAppReviews::requestReview();

// Result contains status information
// $result->status = 'review_process_started'
```

### In Livewire Components

```php
use Livewire\Component;
use Nativephp\InAppReviews\Facades\InAppReviews;

class ReviewComponent extends Component
{
    public ?string $reviewStatus = null;

    public function requestReview(): void
    {
        $result = InAppReviews::requestReview();
        $this->reviewStatus = $result->status ?? 'unknown';
    }

    public function render()
    {
        return view('livewire.review-component');
    }
}
```

## Usage (JavaScript)

### In Vue/React Components (Inertia)

```javascript
import { requestReview } from './vendor/nativephp/in-app-reviews/resources/js/InAppReviews.js';

// Request review flow
async function requestAppReview() {
    try {
        const result = await requestReview();
        console.log('Review process started:', result.status);
    } catch (error) {
        console.error('Failed to request review:', error);
    }
}
```

### Available JavaScript Functions

- `requestReview()`: Requests the app review flow

## Available Methods

### PHP Facade Methods

- `InAppReviews::requestReview(): ?object` - Requests the app review flow
    - Returns: Object with `status` property
    - Platform-specific behavior:
        - **Android**: Launches Google Play In-App Review flow
        - **iOS**: Requests App Store Review using StoreKit

## Required Permissions

No additional permissions required. Both Google Play In-App Review and App Store Review use system-provided dialogs.

## Platform-Specific Behavior

### Android
- Uses Google Play In-App Review API (com.google.android.play:review:2.0.2)
- Minimum Android SDK version: 30
- The review dialog is shown by Google Play services
- User can rate the app without leaving your app

### iOS
- Uses StoreKit's modern AppStore.requestReview API (with fallbacks for older versions)
- Minimum iOS version: 16.0
- The review request is managed by iOS
- Apple may limit how often the prompt appears

## Testing on Real Devices

### Android Testing
- Test on a physical Android device (not just emulator)
- Google Play In-App Review requires the app to be published in Google Play (internal/alpha/beta track)
- Use [Google Play internal testing track](https://support.google.com/googleplay/android-developer/answer/9845334) for development

### iOS Testing
- Test on a physical iPhone/iPad
- App Store Review requires the app to be published in TestFlight
- Use [TestFlight](https://developer.apple.com/testflight/) for development

## Frontend Stack Compatibility

Tested with:
- ✅ Livewire v3
- ✅ Livewire v4
- ✅ Inertia + Vue 3
- ✅ Inertia + React

## Environment Variables

No environment variables required.

## Support

For issues, questions, or feature requests:
- **Email:** diwdesign.wilson@gmail.com
- **GitHub Issues:** [Issues](https://github.com/wilsonatb/nativephp-in-app-reviews/issues)
