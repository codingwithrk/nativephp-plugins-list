---
name: "Contacts Picker"
author: "Mohammad Shoriful Islam Ronju"
price: "Free"
version: "1.1.0"
license: "MIT"
github: "https://github.com/smronju/nativephp-contacts-picker"
support: "https://github.com/smronju/nativephp-contacts-picker/issues"
compatibility:
  nativephp: "^3.0 || ^4.0"
  ios: "15.0+"
  android: "21+"
install:
  - "composer require smronju/nativephp-contacts-picker"
  - "php artisan vendor:publish --tag=nativephp-plugins-provider"
  - "php artisan native:plugin:register smronju/nativephp-contacts-picker"
---

# Contacts Picker

Presents the system contact picker for NativePHP Mobile and returns the chosen contact's name and phone number — no contacts permission required. The system UI mediates all access.

## Features

- **Native system picker** on iOS and Android
- **Returns** contact display name and phone number
- **No permissions required** — system UI handles all authorization
- **Fire-and-forget API** with asynchronous event delivery
- **Graceful cancellation** — returns null values when dismissed
- **First phone number** returned when a contact has multiple

## Installation

```bash
composer require smronju/nativephp-contacts-picker
php artisan vendor:publish --tag=nativephp-plugins-provider
php artisan native:plugin:register smronju/nativephp-contacts-picker
```
