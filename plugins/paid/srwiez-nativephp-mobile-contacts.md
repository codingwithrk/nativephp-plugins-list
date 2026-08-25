---
name: "NativePHP Mobile Contacts"
author: "Eser Deniz"
price: "$49"
version: "2.0.0"
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

Complete contacts management for NativePHP Mobile — fluent search, CRUD operations, group management, iOS 18 limited-access picker, and real-time event dispatching.

## Features

- Fluent contact search and filtering builder
- Full CRUD for contacts and groups
- iOS 18+ limited-access contact picker
- Real-time event dispatching for all contact changes
- Unified API across iOS and Android

## Installation

> Requires a license from nativephp.com/plugins.

```bash
composer config repositories.nativephp-plugins composer https://plugins.nativephp.com
composer config http-basic.plugins.nativephp.com your@email.com your-license-key
composer require srwiez/nativephp-mobile-contacts
php artisan vendor:publish --tag=nativephp-plugins-provider
php artisan native:plugin:register srwiez/nativephp-mobile-contacts
```

## PHP Usage

```php
use Srwiez\NativephpMobileContacts\Facades\Contacts;

// Request access
Contacts::requestAccess();

// Search contacts
$contacts = Contacts::query()
    ->search('John')
    ->withPhoneNumbers()
    ->withEmails()
    ->get();

// Create contact
Contacts::create([
    'firstName' => 'Jane',
    'lastName'  => 'Doe',
    'phones'    => [['label' => 'mobile', 'number' => '+1234567890']],
    'emails'    => [['label' => 'work', 'email' => 'jane@example.com']],
]);

// Update contact
Contacts::update($contactId, ['firstName' => 'Janet']);

// Delete contact
Contacts::delete($contactId);

// Group operations
Contacts::createGroup('VIP Customers');
Contacts::addToGroup($contactId, $groupId);
Contacts::deleteGroup($groupId);
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
- `ContactCreated` — contact created
- `ContactUpdated` — contact updated
- `ContactDeleted` — contact deleted
- `ContactAccessUpdated` — access level changed (iOS 18 limited access)
- `GroupCreated` — group created
- `GroupDeleted` — group deleted
