---
name: "Firstlight UI"
author: "Wojt Janowski"
price: "Free"
version: "1.1.1"
license: "MIT"
github: "https://github.com/firstlightui/nativephp"
support: "https://nativephp.com/plugins/firstlightui/nativephp"
compatibility:
  nativephp: "^4.8"
  php: "^8.4"
  ios: "18.2+"
  android: "29+"
install:
  - "composer require firstlightui/nativephp"
  - "php artisan native:plugin:register firstlightui/nativephp"
  - "php artisan native:install --force"
---

# Firstlight UI

The app-shell layer for NativePHP Mobile — genuine SwiftUI controls on iOS and Jetpack Compose Material 3 on Android, exposed behind a Blade API with Laravel validation, forms, lists, dialogs, and feedback.

> **Requires** `nativephp/mobile-ui` ^0.10.0.
>
> **Re-run** `php artisan native:install --force` after every Firstlight update to keep native code in sync.

## Features

- **Native controls** — Button, Checkbox, Select, Switch, Tabs, Text Field, Date and Time Picker, List, Modal, Bottom Sheet, Callout, and more; SwiftUI on iOS, Material 3 on Android
- **Laravel validation** — `$rules` or Form Requests; native field error slots and form-level errors; `submit()` runs once per tap
- **Gates and Policies** — standard Laravel authorization works inside screens
- **Paginated lists** — cursor- and page-based pagination with native scroll and load-more behavior
- **Accessibility** — VoiceOver and TalkBack labels, spoken validation errors, Dynamic Type, right-to-left layout, Reduce Motion
- **Localization** — Firstlight labels use Laravel lang files; date and time pickers follow the app locale and timezone
- **Haptics** — optional haptic feedback on controls; `Haptics::success()` callable from PHP
- **Testing** — `ScreenAssertions` for Pest on NativePHP's `Native::test()` harness; `Feedback::fake()`
- **Coding-agent support** — Boost guideline, two skills (`firstlight-init`, `building-firstlight-screens`), `llms.txt` / `llms-full.txt`
- **Recipes** — list/detail flow, searchable list, large list, form screen, settings screen, photo upload, app lock

## Installation

```bash
composer require firstlightui/nativephp
php artisan native:plugin:register firstlightui/nativephp
php artisan native:install --force
php artisan native:run
```

Scaffold a screen and its test:

```bash
php artisan make:firstlight-screen MyScreen
```
