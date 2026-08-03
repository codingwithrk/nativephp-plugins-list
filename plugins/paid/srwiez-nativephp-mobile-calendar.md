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

Full native calendar and event management for NativePHP Mobile — CRUD calendars and events, recurring rules, alarms, attendees, real-time change detection, and external calendar URL generation.

## Features

- Full CRUD for calendars and events on iOS and Android
- RFC 5545 compliant recurring event rules (RRULE)
- Alarm and attendee support
- All-day event support
- Native calendar app integration (intent-based on Android)
- Real-time change detection listener
- Pure-PHP URL generation for Google Calendar, Outlook, Office 365, Yahoo, and ICS

## Installation

> Requires a license from nativephp.com/plugins.

```bash
composer config repositories.nativephp-plugins composer https://plugins.nativephp.com
composer config http-basic.plugins.nativephp.com your@email.com your-license-key
composer require srwiez/nativephp-mobile-calendar
php artisan vendor:publish --tag=nativephp-plugins-provider
php artisan native:plugin:register srwiez/nativephp-mobile-calendar
```

## PHP Usage

```php
use Srwiez\NativephpMobileCalendar\Facades\Calendar;

// Request permission
Calendar::requestAccess();

// List calendars
$calendars = Calendar::calendars();

// Create event
Calendar::createEvent(
    calendarId: $calendars[0]['id'],
    title: 'Team Meeting',
    startDate: now(),
    endDate: now()->addHour(),
    notes: 'Bring your laptop.',
    allDay: false,
);

// List events in range
$events = Calendar::events(
    calendarId: $calendars[0]['id'],
    startDate: now()->startOfDay(),
    endDate: now()->endOfDay(),
);

// Delete event
Calendar::deleteEvent(eventId: $eventId);

// Start/stop change listener
Calendar::startListening();
Calendar::stopListening();
```

## External Calendar URLs

```php
use Srwiez\NativephpMobileCalendar\CalendarUrl;

$url = CalendarUrl::google()
    ->title('Team Meeting')
    ->startsAt(now())
    ->endsAt(now()->addHour())
    ->generate();
```

Supported: `google()`, `outlook()`, `office365()`, `yahoo()`, `ics()`.

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
- `CalendarCreated` — calendar created
- `CalendarDeleted` — calendar deleted
- `EventCreated` — event created
- `EventUpdated` — event modified
- `EventDeleted` — event deleted
