---
name: "Datetime Picker"
author: "CodingwithRK"
price: "Free"
version: "1.0.0"
license: "MIT"
github: "https://github.com/codingwithrk/nativephp-datetime-picker"
support: "https://github.com/codingwithrk/nativephp-datetime-picker/issues"
compatibility:
  nativephp: "^3.0 || ^4.0"
  ios: "15.0+"
  android: "24+"
install:
  - "composer require codingwithrk/nativephp-datetime-picker"
  - "php artisan native:plugin:register codingwithrk/nativephp-datetime-picker"
---

# Datetime Picker

Native date, time, and datetime picker for NativePHP Mobile — iOS wheel-style UIDatePicker bottom sheet and Android native platform dialogs, with no Material 3 dependency.

## Features

- **3 picker modes** — date, time (12h/24h), and datetime
- **iOS bottom sheet** with wheel-style interface
- **Android platform dialogs** with theme compatibility
- **Min/max bounds** and initial value support
- **Locale hints** for regional formatting
- **Change event streaming** (iOS)
- **Livewire and Inertia** (Vue/React) support

## Installation

```bash
composer require codingwithrk/nativephp-datetime-picker
php artisan native:plugin:register codingwithrk/nativephp-datetime-picker
```
