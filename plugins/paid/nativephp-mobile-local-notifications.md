---
name: "NativePHP Mobile Local Notifications"
author: "Bifrost Technology"
price: "$99"
version: "0.0.2"
license: "Proprietary"
source: "https://nativephp.com/plugins/nativephp/mobile-local-notifications"
support: "support@nativephp.com"
compatibility:
  nativephp: "^3.2.1"
  ios: "16.0+"
  android: "26+"
install:
  - "composer require nativephp/mobile-local-notifications"
events:
  - NotificationTapped
  - PermissionGranted
---

# NativePHP Mobile Local Notifications

Send, schedule, and manage local notifications in NativePHP Mobile apps — with recurring schedules, action buttons, custom sounds, deep links, badge management, and a Laravel Notification Channel.

## Features

- Immediate and delayed (scheduled) notifications
- Recurring schedules: hourly, daily, weekly, monthly, yearly
- Up to 3 action buttons per notification
- Custom sound support (.mp3, .wav, .caf, .aiff, .m4a)
- Badge count management
- Silent delivery mode
- URL navigation on tap
- Custom data payloads
- Laravel Notification Channel integration

## Installation

> Requires Composer credentials for the NativePHP plugin repository.

```bash
composer config repositories.nativephp-plugins composer https://plugins.nativephp.com
composer config http-basic.plugins.nativephp.com your@email.com your-license-key
php artisan vendor:publish --tag=nativephp-plugins-provider
composer require nativephp/mobile-local-notifications
php artisan native:plugin:register nativephp/mobile-local-notifications
```

## PHP Usage

```php
use NativePHP\MobileLocalNotifications\Facades\LocalNotifications;

// Immediate notification
LocalNotifications::send(
    id: 'promo-1',
    title: 'Welcome back!',
    body: 'Your session is ready.',
    url: '/dashboard',
    data: ['key' => 'value'],
);

// Scheduled notification (delay in seconds)
LocalNotifications::schedule(
    id: 'reminder-1',
    title: 'Reminder',
    body: 'Check your tasks.',
    delay: 3600,
);

// Recurring notification
LocalNotifications::recurring(
    id: 'daily-summary',
    title: 'Daily Summary',
    body: 'Your daily report is ready.',
    frequency: 'daily',
);

// Cancel notification
LocalNotifications::cancel('reminder-1');

// Badge management
LocalNotifications::setBadge(5);
LocalNotifications::clearBadge();

// Permission
LocalNotifications::requestPermission();
```

## Laravel Notification Channel

```php
use NativePHP\MobileLocalNotifications\Channels\LocalNotificationChannel;
use NativePHP\MobileLocalNotifications\Messages\LocalNotificationMessage;

class TaskReminderNotification extends Notification
{
    public function via($notifiable): array
    {
        return [LocalNotificationChannel::class];
    }

    public function toLocalNotification($notifiable): LocalNotificationMessage
    {
        return (new LocalNotificationMessage)
            ->id('task-reminder')
            ->title('Task Due')
            ->body('Your task is due soon.')
            ->url('/tasks');
    }
}
```

## Compatibility

| Platform   | Minimum Version |
| ---------- | --------------- |
| NativePHP  | ^3.2.1          |
| iOS        | 16.0+           |
| Android    | API 26+         |

## Events

### `NotificationTapped`

Fires when the user taps a notification. Payload includes `id`, `url`, and `data`.

### `PermissionGranted`

Fires when the permission dialog resolves. Payload includes `granted: bool`.
