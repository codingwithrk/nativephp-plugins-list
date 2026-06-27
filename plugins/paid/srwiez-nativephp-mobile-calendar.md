---
name: "NativePHP Mobile Calendar"
author: "Eser Deniz"
price: "$49"
version: "1.0.2"
license: "Proprietary"
source: "https://nativephp.com/plugins/srwiez/nativephp-mobile-calendar"
support: "https://github.com/SRWieZ/nativephp-mobile-packages"
compatibility:
  nativephp: "^3.0"
  ios: "17.0+"
  android: "14+"
install:
  - "composer require srwiez/nativephp-mobile-calendar"
  - "php artisan vendor:publish --tag=nativephp-plugins-provider"
  - "php artisan native:plugin:register srwiez/nativephp-mobile-calendar"
events:
  - CalendarAccessGranted
  - CalendarAccessDenied
  - CalendarChanged
  - CalendarCreated
  - CalendarDeleted
  - EventCreated
  - EventUpdated
  - EventDeleted
---

# NativePHP Mobile Calendar

A NativePHP plugin for native calendar and event management directly from PHP, supporting both iOS and Android platforms.

## Features

- Full CRUD operations on calendars and events
- RFC 5545 compliant recurring event rules
- Alarms, attendees, and all-day event support
- Native calendar app integration (intent-based on Android)
- Real-time change detection listener
- Pure-PHP URL generation for Google Calendar, Outlook, Office 365, Yahoo, and ICS formats

## Installation

```bash
composer require srwiez/nativephp-mobile-calendar
php artisan vendor:publish --tag=nativephp-plugins-provider
php artisan native:plugin:register srwiez/nativephp-mobile-calendar
```

## Compatibility

| Platform   | Minimum Version |
| ---------- | --------------- |
| NativePHP  | ^3.0            |
| iOS        | 17.0+           |
| Android    | API 14+         |

## Events

- `CalendarAccessGranted` — permission granted
- `CalendarAccessDenied` — permission denied
- `CalendarChanged` — change detected in calendar store
- `CalendarCreated` — new calendar created
- `CalendarDeleted` — calendar removed
- `EventCreated` — new event created
- `EventUpdated` — event modified
- `EventDeleted` — event removed
