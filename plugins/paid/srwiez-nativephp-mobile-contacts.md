---
name: "NativePHP Mobile Contacts"
author: "Eser Deniz"
price: "$49"
version: "1.0.2"
license: "Proprietary"
source: "https://nativephp.com/plugins/srwiez/nativephp-mobile-contacts"
support: "https://github.com/SRWieZ/nativephp-mobile-packages"
compatibility:
  nativephp: "^3.0"
  ios: "18.0+"
  android: "21+"
install:
  - "composer require srwiez/nativephp-mobile-contacts"
  - "php artisan vendor:publish --tag=nativephp-plugins-provider"
  - "php artisan native:plugin:register srwiez/nativephp-mobile-contacts"
events:
  - ContactAccessGranted
  - ContactAccessDenied
  - ContactCreated
  - ContactUpdated
  - ContactDeleted
  - ContactAccessUpdated
  - GroupCreated
  - GroupDeleted
---

# NativePHP Mobile Contacts

A complete contacts API enabling developers to query contacts with a fluent builder, create and update entries, and manage groups for NativePHP mobile applications.

## Features

- Fluent contact search and filtering
- Full CRUD operations for contacts and groups
- iOS 18+ limited-access contact picker
- Real-time event dispatching
- Unified API across iOS and Android platforms

## Installation

```bash
composer require srwiez/nativephp-mobile-contacts
php artisan vendor:publish --tag=nativephp-plugins-provider
php artisan native:plugin:register srwiez/nativephp-mobile-contacts
```

## Compatibility

| Platform   | Minimum Version |
| ---------- | --------------- |
| NativePHP  | ^3.0            |
| iOS        | 18.0+           |
| Android    | API 21+         |

## Events

- `ContactAccessGranted` — permission granted
- `ContactAccessDenied` — permission denied
- `ContactCreated` — new contact created
- `ContactUpdated` — existing contact updated
- `ContactDeleted` — contact removed
- `ContactAccessUpdated` — access level changed (iOS 18 limited access)
- `GroupCreated` — contact group created
- `GroupDeleted` — contact group removed
