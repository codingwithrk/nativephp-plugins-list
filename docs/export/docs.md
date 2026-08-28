# NativePHP Plugins List

> Listed all are created and maintained by independent developers, not the NativePHP team. Please review each plugin source code, license, and maintenance status before using it in production.

# NativePHP Plugins List

Listed all are created and maintained by independent developers, not the NativePHP team. Please review each plugin source code, license, and maintenance status before using it in production.

---

# ProVibration

> JVDLUK

<div class="plugin-info"><div class="pi-meta"><span class="pi-item"><span class="pi-label">Author</span><span class="pi-value">JVDLUK</span></span><span class="pi-item"><span class="pi-label">Plugin Type</span><span class="pi-badge pi-badge-community">Community Plugin</span></span><span class="pi-item"><span class="pi-label">Price</span><span class="pi-badge pi-badge-paid">$49</span></span><span class="pi-item"><span class="pi-label">Version</span><span class="pi-value">v1.0.1</span></span><span class="pi-item"><span class="pi-label">License</span><span class="pi-value">Proprietary</span></span></div><div class="pi-compat"><span class="pi-chip"><span class="pi-chip-label">NativePHP</span><span class="pi-chip-value">^3.0</span></span><span class="pi-chip"><span class="pi-chip-label">iOS</span><span class="pi-chip-value">13.0+</span></span><span class="pi-chip"><span class="pi-chip-label">Android</span><span class="pi-chip-value">24+</span></span></div><div class="pi-links"><a href="https://nativephp.com/plugins/jvdluk/pro-vibration" class="pi-link pi-link-buy" target="_blank" rel="noopener">Buy on NativePHP →</a></div></div>

# ProVibration

A haptic vibration library for NativePHP Mobile with iOS Core Haptics and Android VibrationEffect support.

## Features

- Fine-grained control over vibration duration, intensity, and sharpness
- Runtime haptic capability detection
- Vibration cancellation
- Fluent pattern builder with pause support
- Built-in presets: `success`, `error`, `warning`, `notification`, `double_click`
- Event dispatching on completion

## Installation

```bash
composer require jvdluk/pro-vibration
php artisan vendor:publish --tag=nativephp-plugins-provider
php artisan native:plugin:register jvdluk/pro-vibration
```

## PHP Usage

```php
use Jvdluk\ProVibration\Facades\ProVibration;

// Check support
if (ProVibration::hasHaptics()) {
    ProVibration::vibrate(duration: 500, intensity: 0.8);
}

// Pattern builder
ProVibration::pattern()
    ->vibrate(100, 0.8, 0.5)
    ->pause(50)
    ->vibrate(200, 1.0)
    ->play();

// Preset
ProVibration::preset('success')->play();

// Cancel
ProVibration::cancelVibration();
```

## JavaScript Usage

```javascript
import { proVibration } from '@jvdluk/pro-vibration';

if (await proVibration.hasHaptics()) {
    await proVibration.vibrate(500, 0.8, 0.5);

    await proVibration.playPattern([
        { type: 'vibrate', duration: 50, intensity: 0.6, sharpness: 0.5 },
        { type: 'pause', duration: 80 },
        { type: 'vibrate', duration: 80, intensity: 0.8 },
    ]);
}
```

## API

| Method | Description |
|--------|-------------|
| `vibrate(int $duration, float $intensity, ?float $sharpness)` | Single vibration; duration 1–5000 ms, intensity 0.0–1.0, sharpness iOS only |
| `hasHaptics(): bool` | Detect device support |
| `cancelVibration(): bool` | Stop active vibration |
| `pattern(array $steps): VibrationPatternBuilder` | Build a step sequence |
| `preset(string\|VibrationPreset $preset)` | Use a named preset |

## Compatibility

| Platform  | Minimum Version |
| --------- | --------------- |
| NativePHP | ^3.0            |
| iOS       | 13.0+           |
| Android   | 24+             |

> Sharpness parameter is iOS only; Android ignores it.

## Events

### `VibrationCompleted`

Fired when a single vibration finishes. Payload: `int $duration`, `float $intensity`, `?float $sharpness`.

### `PatternCompleted`

Fired when a pattern finishes. Payload: `int $totalDuration` (ms), `int $stepCount`.

---

# NFC

> weswecan

<div class="plugin-info"><div class="pi-meta"><span class="pi-item"><span class="pi-label">Author</span><span class="pi-value">Context Undefined</span></span><span class="pi-item"><span class="pi-label">Plugin Type</span><span class="pi-badge pi-badge-community">Community Plugin</span></span><span class="pi-item"><span class="pi-label">Price</span><span class="pi-badge pi-badge-paid">$99</span></span><span class="pi-item"><span class="pi-label">Version</span><span class="pi-value">v1.0.3</span></span><span class="pi-item"><span class="pi-label">License</span><span class="pi-value">Proprietary</span></span></div><div class="pi-compat"><span class="pi-chip"><span class="pi-chip-label">NativePHP</span><span class="pi-chip-value">^3</span></span><span class="pi-chip"><span class="pi-chip-label">iOS</span><span class="pi-chip-value">13.0+</span></span><span class="pi-chip"><span class="pi-chip-label">Android</span><span class="pi-chip-value">24+</span></span></div><div class="pi-links"><a href="https://nativephp.com/plugins/weswecan/nfc" class="pi-link pi-link-buy" target="_blank" rel="noopener">Buy on NativePHP →</a></div></div>

# NFC

Read and write NFC tags on iOS and Android from NativePHP Mobile — URLs, text, vCards, JSON/MIME, Android Application Records, and WiFi configuration.

## Features

- Read and write NFC tags on both platforms
- Data types: URLs, plain text, vCard contacts, JSON/MIME, Android Application Records
- Tag hardware information: capacity, writable status, technologies
- Continuous scanning with session persistence
- WiFi configuration writing
- Tag erasure
- Typed events with comprehensive error handling

## Installation

> Requires a license from nativephp.com/plugins.

```bash
composer config repositories.nativephp-plugins composer https://plugins.nativephp.com
composer config http-basic.plugins.nativephp.com your@email.com your-license-key
composer require weswecan/nfc
php artisan native:plugin:register weswecan/nfc
```

## PHP Usage

```php
use Weswecan\Nfc\Facades\Nfc;

// Read a tag
Nfc::read(
    alertMessage: 'Hold your device near an NFC tag.',
    continuous: false,
);

// Write a URL
Nfc::writeUrl(
    url: 'https://example.com',
    alertMessage: 'Hold near tag to write.',
);

// Write text
Nfc::writeText(
    text: 'Hello NFC',
    language: 'en',
);

// Erase a tag
Nfc::erase();

// Stop scanning session
Nfc::stop();
```

## Livewire Usage

```php
use Native\Mobile\Attributes\OnNative;
use Weswecan\Nfc\Events\NfcTagRead;

#[OnNative(NfcTagRead::class)]
public function onTagRead(
    array $records,
    array $hardware,
): void {
    foreach ($records as $record) {
        // $record['type'], $record['payload']
    }
}
```

## Compatibility

| Platform   | Minimum Version |
| ---------- | --------------- |
| NativePHP  | ^3              |
| iOS        | 13.0+           |
| Android    | API 24+         |

## Events

- `NfcTagRead` — tag read with records and hardware info
- `NfcUrlWritten` — URL write confirmed
- `NfcTextWritten` — text write confirmed
- `NfcTagErased` — tag erasure confirmed
- `NfcError` — error during session
- `NfcCancelled` — session cancelled *(iOS only)*

---

# Apple Intelligence Foundation Models

> weswecan

<div class="plugin-info"><div class="pi-meta"><span class="pi-item"><span class="pi-label">Author</span><span class="pi-value">Context Undefined</span></span><span class="pi-item"><span class="pi-label">Plugin Type</span><span class="pi-badge pi-badge-community">Community Plugin</span></span><span class="pi-item"><span class="pi-label">Price</span><span class="pi-badge pi-badge-paid">$29</span></span><span class="pi-item"><span class="pi-label">Version</span><span class="pi-value">v1.0.1</span></span><span class="pi-item"><span class="pi-label">License</span><span class="pi-value">Proprietary</span></span></div><div class="pi-compat"><span class="pi-chip"><span class="pi-chip-label">NativePHP</span><span class="pi-chip-value">^3</span></span><span class="pi-chip"><span class="pi-chip-label">iOS</span><span class="pi-chip-value">18.2+</span></span><span class="pi-chip"><span class="pi-chip-label">PHP</span><span class="pi-chip-value">^8.2</span></span></div><div class="pi-links"><a href="https://nativephp.com/plugins/weswecan/nativephp-mobile-apple-intelligence-foundation-models" class="pi-link pi-link-buy" target="_blank" rel="noopener">Buy on NativePHP →</a></div></div>

# Apple Intelligence Foundation Models

A typed PHP/JS bridge to Apple's on-device Foundation Models — structured JSON generation, streaming, tool use, transcript helpers, and session management.

> **iOS only.** Android returns `unsupported_platform` responses. Requires an Apple Intelligence-capable device running iOS 26.0+ for the Foundation Models Runtime.

## Features

- On-device language model inference — no cloud API calls
- Structured JSON responses with schema validation
- Streaming snapshots with normalized incremental output
- App tool context with user-controlled invocation
- Session management: instructions, cancellation, transcript history
- Availability checking with detailed unavailability reason codes
- Laravel, Livewire, Inertia, Vue, React, and JavaScript support
- TypeScript client with schema and tool helpers
- Token and context-window metadata retrieval

## Installation

> Requires a license from nativephp.com/plugins.

```bash
composer config repositories.nativephp-plugins composer https://plugins.nativephp.com
composer config http-basic.plugins.nativephp.com your@email.com your-license-key
composer require weswecan/nativephp-mobile-apple-intelligence-foundation-models
php artisan native:plugin:register weswecan/nativephp-mobile-apple-intelligence-foundation-models
php artisan vendor:publish --tag=nativephp-plugins-provider
```

## PHP Usage

```php
use Weswecan\FoundationModels\Facades\FoundationModel;

// Check availability
$status = FoundationModel::checkAvailability();

// Simple prompt
FoundationModel::session('session-1')
    ->instructions('You are a helpful assistant.')
    ->prompt('Summarize this text: ...');

// Streaming prompt
FoundationModel::session('session-1')
    ->prompt('Tell me a story.')
    ->stream();

// Structured JSON output
FoundationModel::session('session-1')
    ->schema(['type' => 'object', 'properties' => ['name' => ['type' => 'string']]])
    ->prompt('Extract the person name from: John visited Paris.');

// Cancel session
FoundationModel::cancel('session-1');
```

## Livewire Usage

```php
use Native\Mobile\Attributes\OnNative;
use Weswecan\FoundationModels\Events\FoundationModelResponseCompleted;
use Weswecan\FoundationModels\Events\FoundationModelStreamDelta;

#[OnNative(FoundationModelStreamDelta::class)]
public function onDelta(string $sessionId, string $delta): void
{
    $this->response .= $delta;
}

#[OnNative(FoundationModelResponseCompleted::class)]
public function onCompleted(string $sessionId, string $response): void
{
    $this->final = $response;
}
```

## Compatibility

| Platform           | Requirement                      |
| ------------------ | -------------------------------- |
| NativePHP          | ^3                               |
| iOS                | 18.2+ (Foundation Models: 26.0+) |
| Android            | Not supported                    |
| PHP                | ^8.2                             |

## Events

- `FoundationModelResponseCompleted` — full response available; `sessionId`, `response`
- `FoundationModelStreamDelta` — streaming chunk received; `sessionId`, `delta`
- `FoundationModelStreamCompleted` — stream finished; `sessionId`
- `FoundationModelToolRequested` — model requests a tool call; `sessionId`, `toolName`, `parameters`
- `FoundationModelToolResolved` — tool result returned to model; `sessionId`
- `FoundationModelError` — session error; `sessionId`, `error`, `code`

---

# Open Sound Control (OSC)

> weswecan

<div class="plugin-info"><div class="pi-meta"><span class="pi-item"><span class="pi-label">Author</span><span class="pi-value">Context Undefined</span></span><span class="pi-item"><span class="pi-label">Plugin Type</span><span class="pi-badge pi-badge-community">Community Plugin</span></span><span class="pi-item"><span class="pi-label">Price</span><span class="pi-badge pi-badge-paid">$29</span></span><span class="pi-item"><span class="pi-label">Version</span><span class="pi-value">v1.0.1</span></span><span class="pi-item"><span class="pi-label">License</span><span class="pi-value">Proprietary</span></span></div><div class="pi-compat"><span class="pi-chip"><span class="pi-chip-label">NativePHP</span><span class="pi-chip-value">^3</span></span><span class="pi-chip"><span class="pi-chip-label">iOS</span><span class="pi-chip-value">15.0+</span></span><span class="pi-chip"><span class="pi-chip-label">Android</span><span class="pi-chip-value">21+</span></span><span class="pi-chip"><span class="pi-chip-label">PHP</span><span class="pi-chip-value">^8.2</span></span></div><div class="pi-links"><a href="https://nativephp.com/plugins/weswecan/nativephp-mobile-osc" class="pi-link pi-link-buy" target="_blank" rel="noopener">Buy on NativePHP →</a></div></div>

# Open Sound Control (OSC)

Send and receive OSC messages over UDP on iOS and Android — for show control, audio, lighting, Arduino, and ESP32 workflows.

## Features

- UDP-based OSC messaging (no TCP)
- Multiple simultaneous listeners with distinct IDs
- Typed argument support: `int`, `float`, `string`, `blob`
- Bundle transmission support
- Local network address discovery
- Foreground-first lifecycle (listeners auto-stop when app backgrounds)
- Event-driven PHP and JavaScript architecture

## Installation

> Requires a license from nativephp.com/plugins.

```bash
composer config repositories.nativephp-plugins composer https://plugins.nativephp.com
composer config http-basic.plugins.nativephp.com your@email.com your-license-key
composer require weswecan/nativephp-mobile-osc
php artisan native:plugin:register weswecan/nativephp-mobile-osc
```

## PHP Usage

```php
use Weswecan\Osc\Facades\Osc;

// Get local IP address
$address = Osc::getLocalAddress();

// Start listening on port 8000
Osc::listen(id: 'main', port: 8000);

// Send a message
Osc::send(
    host: '192.168.1.100',
    port: 9000,
    address: '/volume',
    arguments: [['type' => 'float', 'value' => 0.75]],
);

// Send a bundle
Osc::sendBundle(
    host: '192.168.1.100',
    port: 9000,
    timetag: 0,
    messages: [
        ['address' => '/play', 'arguments' => []],
        ['address' => '/volume', 'arguments' => [['type' => 'float', 'value' => 1.0]]],
    ]
);

// Stop a listener
Osc::stop(id: 'main');
```

## Livewire Usage

```php
use Native\Mobile\Attributes\OnNative;
use Weswecan\Osc\Events\OscMessageReceived;

#[OnNative(OscMessageReceived::class)]
public function onMessage(string $listenerId, string $address, array $arguments): void
{
    // Handle incoming message
}
```

## Compatibility

| Platform   | Minimum Version |
| ---------- | --------------- |
| NativePHP  | ^3              |
| iOS        | 15.0+           |
| Android    | API 21+         |
| PHP        | ^8.2            |

## Events

- `OscMessageReceived` — incoming message; `listenerId`, `address`, `arguments`
- `OscBundleReceived` — incoming bundle; `listenerId`, `timetag`, `messages`
- `OscListenerStarted` — listener active; `listenerId`, `port`
- `OscListenerStopped` — listener stopped; `listenerId`
- `OscMessageSent` — send confirmed; `host`, `port`, `address`
- `OscError` — error during send or receive; `listenerId`, `error`

---

# Mobile Contacts

> Eser Deniz

<div class="plugin-info"><div class="pi-meta"><span class="pi-item"><span class="pi-label">Author</span><span class="pi-value">Eser Deniz</span></span><span class="pi-item"><span class="pi-label">Plugin Type</span><span class="pi-badge pi-badge-community">Community Plugin</span></span><span class="pi-item"><span class="pi-label">Price</span><span class="pi-badge pi-badge-paid">$49</span></span><span class="pi-item"><span class="pi-label">Version</span><span class="pi-value">v2.0.0</span></span><span class="pi-item"><span class="pi-label">License</span><span class="pi-value">Proprietary</span></span></div><div class="pi-compat"><span class="pi-chip"><span class="pi-chip-label">NativePHP</span><span class="pi-chip-value">^3.0</span></span><span class="pi-chip"><span class="pi-chip-label">iOS</span><span class="pi-chip-value">18.0+</span></span><span class="pi-chip"><span class="pi-chip-label">Android</span><span class="pi-chip-value">21+</span></span></div><div class="pi-links"><a href="https://nativephp.com/plugins/srwiez/nativephp-mobile-contacts" class="pi-link pi-link-buy" target="_blank" rel="noopener">Buy on NativePHP →</a></div></div>

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

---

# Mobile Calendar

> Eser Deniz

<div class="plugin-info"><div class="pi-meta"><span class="pi-item"><span class="pi-label">Author</span><span class="pi-value">Eser Deniz</span></span><span class="pi-item"><span class="pi-label">Plugin Type</span><span class="pi-badge pi-badge-community">Community Plugin</span></span><span class="pi-item"><span class="pi-label">Price</span><span class="pi-badge pi-badge-paid">$49</span></span><span class="pi-item"><span class="pi-label">Version</span><span class="pi-value">v2.0.0</span></span><span class="pi-item"><span class="pi-label">License</span><span class="pi-value">Proprietary</span></span></div><div class="pi-compat"><span class="pi-chip"><span class="pi-chip-label">NativePHP</span><span class="pi-chip-value">^3.0</span></span><span class="pi-chip"><span class="pi-chip-label">iOS</span><span class="pi-chip-value">17.0+</span></span><span class="pi-chip"><span class="pi-chip-label">Android</span><span class="pi-chip-value">14+</span></span></div><div class="pi-links"><a href="https://nativephp.com/plugins/srwiez/nativephp-mobile-calendar" class="pi-link pi-link-buy" target="_blank" rel="noopener">Buy on NativePHP →</a></div></div>

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

---

# Mobile Screenshots

> Eser Deniz

<div class="plugin-info"><div class="pi-meta"><span class="pi-item"><span class="pi-label">Author</span><span class="pi-value">Eser Deniz</span></span><span class="pi-item"><span class="pi-label">Plugin Type</span><span class="pi-badge pi-badge-community">Community Plugin</span></span><span class="pi-item"><span class="pi-label">Price</span><span class="pi-badge pi-badge-paid">$29</span></span><span class="pi-item"><span class="pi-label">Version</span><span class="pi-value">v2.0.0</span></span><span class="pi-item"><span class="pi-label">License</span><span class="pi-value">Proprietary</span></span></div><div class="pi-compat"><span class="pi-chip"><span class="pi-chip-label">NativePHP</span><span class="pi-chip-value">^3.0</span></span><span class="pi-chip"><span class="pi-chip-label">iOS</span><span class="pi-chip-value">17.0+</span></span><span class="pi-chip"><span class="pi-chip-label">Android</span><span class="pi-chip-value">26+</span></span></div><div class="pi-links"><a href="https://nativephp.com/plugins/srwiez/nativephp-mobile-screenshots" class="pi-link pi-link-buy" target="_blank" rel="noopener">Buy on NativePHP →</a></div></div>

# NativePHP Mobile Screenshots

Screenshot and screen recording control for NativePHP Mobile — block captures, detect attempts in real-time, and take programmatic screenshots.

## Features

- Block screenshots and screen recordings (`FLAG_SECURE` on Android; privacy overlay on iOS)
- Real-time detection of screenshot/recording attempts via Laravel events
- Programmatic screenshot capture (for bug reports, audit trails)
- Screen recording start/stop detection (iOS)

## Installation

> Requires a license from nativephp.com/plugins.

```bash
composer config repositories.nativephp-plugins composer https://plugins.nativephp.com
composer config http-basic.plugins.nativephp.com your@email.com your-license-key
composer require srwiez/nativephp-mobile-screenshots
php artisan vendor:publish --tag=nativephp-plugins-provider
php artisan native:plugin:register srwiez/nativephp-mobile-screenshots
```

## PHP Usage

```php
use Srwiez\NativephpMobileScreenshots\Facades\Screenshots;

// Block all screenshot/recording attempts
Screenshots::prevent();

// Allow screenshots again
Screenshots::allow();

// Programmatically capture the screen
Screenshots::capture();

// Check current prevention state
$isBlocked = Screenshots::isPreventing();
```

## Livewire Usage

```php
use Native\Mobile\Attributes\OnNative;
use Srwiez\NativephpMobileScreenshots\Events\ScreenshotDetected;

#[OnNative(ScreenshotDetected::class)]
public function onScreenshotDetected(): void
{
    // Log the attempt, warn the user, etc.
    $this->dispatch('screenshot-detected');
}
```

## Compatibility

| Platform   | Minimum Version |
| ---------- | --------------- |
| NativePHP  | ^3.0            |
| iOS        | 17.0+           |
| Android    | API 26+         |

## Events

- `ScreenshotDetected` — user captured the screen
- `ScreenshotCaptured` — programmatic capture succeeded
- `ScreenshotCaptureFailed` — programmatic capture failed
- `ScreenRecordingStarted` *(iOS only)* — screen recording began
- `ScreenRecordingStopped` *(iOS only)* — screen recording ended

---

# Social Auth

> Ikromjon Ochilov

<div class="plugin-info"><div class="pi-meta"><span class="pi-item"><span class="pi-label">Author</span><span class="pi-value">Ikromjon Ochilov</span></span><span class="pi-item"><span class="pi-label">Plugin Type</span><span class="pi-badge pi-badge-community">Community Plugin</span></span><span class="pi-item"><span class="pi-label">Price</span><span class="pi-badge pi-badge-paid">$29</span></span><span class="pi-item"><span class="pi-label">Version</span><span class="pi-value">v1.0.2</span></span><span class="pi-item"><span class="pi-label">License</span><span class="pi-value">Proprietary</span></span></div><div class="pi-compat"><span class="pi-chip"><span class="pi-chip-label">NativePHP</span><span class="pi-chip-value">^3.0</span></span><span class="pi-chip"><span class="pi-chip-label">iOS</span><span class="pi-chip-value">18.0+</span></span><span class="pi-chip"><span class="pi-chip-label">Android</span><span class="pi-chip-value">29+</span></span><span class="pi-chip"><span class="pi-chip-label">PHP</span><span class="pi-chip-value">8.3+</span></span><span class="pi-chip"><span class="pi-chip-label">Laravel</span><span class="pi-chip-value">11, 12, or 13</span></span></div><div class="pi-links"><a href="https://github.com/Ikromjon1998/nativephp-mobile-social-auth" class="pi-link" target="_blank" rel="noopener">GitHub →</a><a href="https://nativephp.com/plugins/ikromjon/nativephp-mobile-social-auth" class="pi-link pi-link-buy" target="_blank" rel="noopener">Buy on NativePHP →</a></div></div>

Native Apple Sign-In and Google Sign-In for NativePHP mobile apps. Uses native platform SDKs (not browser-based redirects) for a seamless sign-in experience.

> **App Store Requirement:** If your app offers any third-party sign-in (Google, Facebook, etc.), Apple requires you to also offer Sign in with Apple. Apps that don't comply will be rejected during App Store review. ([Apple Guideline 4.8](https://developer.apple.com/app-store/review/guidelines/#sign-in-with-apple))

## Features

- **Apple Sign-In** -- Native `ASAuthorizationController` on iOS with Face ID / Touch ID
- **Google Sign-In** -- Native Credential Manager on Android, Google Sign-In SDK on iOS
- **Identity tokens** -- JWT tokens for server-side verification
- **User info** -- Name, email, profile photo
- **Nonce support** -- Replay protection for both providers
- **Credential state** -- Check if an Apple credential is still valid
- **Events** -- Livewire `#[OnNative]` and JS event listeners

## Platform Support

| Feature | iOS | Android |
|---------|-----|---------|
| Apple Sign-In | Yes | No (Apple limitation) |
| Google Sign-In | Yes | Yes |
| Credential State Check | Yes (Apple) | No |
| Sign Out | Yes (Google) | Yes (Google) |

## Requirements

- PHP 8.3+
- Laravel 11, 12, or 13
- NativePHP Mobile 3.x
- iOS 18.0+ / Android API 29+
- Apple Developer account (for Apple Sign-In entitlement)

## Installation

```bash
composer require ikromjon/nativephp-mobile-social-auth
```

The service provider and facade are auto-discovered by Laravel.

Then rebuild your native project to include the plugin's native dependencies:

```bash
php artisan native:install --force
```

## Configuration

### 1. Google Cloud Console Setup

You need **two** OAuth client IDs from the same Google Cloud project:

**Step 1: Create a project & consent screen**
1. Go to [Google Cloud Console](https://console.cloud.google.com/)
2. Create a new project (or select existing)
3. Go to **APIs & Services > OAuth consent screen**
4. Choose **External**, fill in app name and email
5. Add scopes: `email`, `profile`
6. Add your test email under **Test users** (required while in testing mode)

**Step 2: Create an Android OAuth client**
1. Go to **Credentials > Create Credentials > OAuth client ID**
2. Application type: **Android**
3. Package name: your `NATIVEPHP_APP_ID` from `.env` (e.g. `com.yourcompany.yourapp`)
4. SHA-1 fingerprint -- get it with:
   ```bash
   cd nativephp/android && ./gradlew signingReport
   ```
5. Click **Create** (you won't use this client ID directly -- Google uses it to verify your app's signing key)

**Step 3: Create a Web OAuth client**
1. **Credentials > Create Credentials > OAuth client ID**
2. Application type: **Web application**
3. No redirect URIs needed
4. Click **Create**
5. Copy the **Client ID** -- this is your `GOOGLE_SERVER_CLIENT_ID`

**Step 4: Create an iOS OAuth client** (if targeting iOS)
1. **Credentials > Create Credentials > OAuth client ID**
2. Application type: **iOS**
3. Bundle ID: your `NATIVEPHP_APP_ID` from `.env`
4. Click **Create**
5. Copy the **Client ID** -- this is your `GOOGLE_IOS_CLIENT_ID`

> **Why three client IDs?** The Android client verifies your app's signing key. The Web client ID is used by Android Credential Manager and for backend token verification. The iOS client ID configures the Google Sign-In SDK on iOS.

**Step 5: Add credentials to your `.env`**

```env
GOOGLE_IOS_CLIENT_ID=123456789-abc.apps.googleusercontent.com
GOOGLE_SERVER_CLIENT_ID=123456789-xyz.apps.googleusercontent.com
```

The plugin reads `GOOGLE_SERVER_CLIENT_ID` from your `.env` at runtime and passes it to the native SDK automatically. No manual Android string resources needed.

### 2. Apple Sign-In Setup

The `com.apple.developer.applesignin` entitlement is automatically added by this plugin. You need to:

1. Log in to [Apple Developer Portal](https://developer.apple.com/account)
2. Go to **Certificates, Identifiers & Profiles > Identifiers**
3. Select your App ID (matching `NATIVEPHP_APP_ID`)
4. Enable **Sign in with Apple** capability
5. Save

No `.env` configuration needed for Apple -- it uses the native iOS SDK directly.

## Usage

### Important: Platform Behavior Differences

| | iOS | Android |
|---|---|---|
| **Apple Sign-In** | Returns `AuthResult` directly | Returns `null` (unsupported) |
| **Google Sign-In** | Returns `AuthResult` directly | Returns `null`; result arrives via event |

On **iOS**, bridge calls block until the user completes or cancels sign-in, then return the result.

On **Android**, Google Sign-In is asynchronous -- the call returns immediately, and the result is delivered via `GoogleSignInCompleted` or `SignInFailed` events.

**Recommended pattern:** Always use event listeners AND check the return value. This ensures your code works on both platforms:

### Livewire (Recommended)

```php
<?php

namespace App\Livewire;

use Ikromjon\NativePHP\SocialAuth\Data\AuthResult;
use Ikromjon\NativePHP\SocialAuth\Events\AppleSignInCompleted;
use Ikromjon\NativePHP\SocialAuth\Events\GoogleSignInCompleted;
use Ikromjon\NativePHP\SocialAuth\Events\SignInFailed;
use Ikromjon\NativePHP\SocialAuth\Facades\SocialAuth;
use Livewire\Component;
use Native\Mobile\Attributes\OnNative;

class LoginScreen extends Component
{
    public ?string $error = null;

    public function signInWithApple()
    {
        $rawNonce = bin2hex(random_bytes(16));
        session(['auth_nonce' => $rawNonce]);

        // iOS: returns AuthResult directly
        // Android: returns null (Apple Sign-In not available)
        $result = SocialAuth::appleSignIn(
            scopes: ['email', 'fullName'],
            nonce: hash('sha256', $rawNonce),
        );

        if ($result) {
            $this->handleSignIn($result->toArray());
        }
    }

    public function signInWithGoogle()
    {
        $nonce = bin2hex(random_bytes(16));
        session(['auth_nonce' => $nonce]);

        // iOS: returns AuthResult directly
        // Android: returns null, result comes via event below
        $result = SocialAuth::googleSignIn(nonce: $nonce);

        if ($result) {
            $this->handleSignIn($result->toArray());
        }
    }

    // Event handlers use NAMED PARAMETERS matching the event payload keys.
    // Do NOT use a single $data array — Livewire dispatches each key as a named argument.

    #[OnNative(AppleSignInCompleted::class)]
    public function onAppleSignIn(
        string $userId = '',
        ?string $identityToken = null,
        ?string $authorizationCode = null,
        ?string $email = null,
        ?string $givenName = null,
        ?string $familyName = null,
    ) {
        if (!empty($userId)) {
            $this->handleSignIn([
                'provider' => 'apple',
                'userId' => $userId,
                'identityToken' => $identityToken,
                'email' => $email,
                'givenName' => $givenName,
                'familyName' => $familyName,
            ]);
        }
    }

    #[OnNative(GoogleSignInCompleted::class)]
    public function onGoogleSignIn(
        string $userId = '',
        ?string $identityToken = null,
        ?string $email = null,
        ?string $displayName = null,
        ?string $givenName = null,
        ?string $familyName = null,
        ?string $photoUrl = null,
    ) {
        if (!empty($userId)) {
            $this->handleSignIn([
                'provider' => 'google',
                'userId' => $userId,
                'identityToken' => $identityToken,
                'email' => $email,
                'displayName' => $displayName,
                'givenName' => $givenName,
                'familyName' => $familyName,
                'photoUrl' => $photoUrl,
            ]);
        }
    }

    #[OnNative(SignInFailed::class)]
    public function onSignInFailed(
        string $provider = '',
        string $error = '',
        ?string $errorCode = null,
    ) {
        if ($errorCode !== 'CANCELED') {
            $this->error = !empty($error) ? $error : 'Sign-in failed.';
        }
    }

    private function handleSignIn(array $data)
    {
        // Verify identity token server-side, then create/find user
        // IMPORTANT: Apple only sends email/name on FIRST sign-in!
        // You must persist this data immediately.
        return $this->redirect('/dashboard');
    }

    public function render()
    {
        return view('livewire.login-screen');
    }
}
```

```blade
{{-- resources/views/livewire/login-screen.blade.php --}}
<div class="flex flex-col gap-4 p-6">
    @if($error)
        <div class="bg-red-100 text-red-700 p-3 rounded">{{ $error }}</div>
    @endif

    <button
        wire:click="signInWithApple"
        class="flex items-center justify-center gap-2 bg-black text-white rounded-lg py-3 px-6 font-medium"
    >
        Sign in with Apple
    </button>

    <button
        wire:click="signInWithGoogle"
        class="flex items-center justify-center gap-2 bg-white text-gray-700 border border-gray-300 rounded-lg py-3 px-6 font-medium"
    >
        Sign in with Google
    </button>
</div>
```

### JavaScript (Vue / React / Inertia)

```javascript
import { On } from '#nativephp';
import socialAuth from 'vendor/ikromjon/nativephp-mobile-social-auth/resources/js/social-auth';

// Generate nonce client-side
function generateNonce() {
    const array = new Uint8Array(16);
    crypto.getRandomValues(array);
    return Array.from(array, b => b.toString(16).padStart(2, '0')).join('');
}

async function sha256Hex(value) {
    const digest = await crypto.subtle.digest('SHA-256', new TextEncoder().encode(value));
    return Array.from(new Uint8Array(digest), b => b.toString(16).padStart(2, '0')).join('');
}

// Google Sign-In
async function handleGoogleSignIn() {
    const nonce = generateNonce();
    const result = await socialAuth.googleSignIn(nonce);
    // On iOS: result contains data. On Android: result is null, use event.
    if (result?.identityToken) {
        sendTokenToBackend(result.identityToken);
    }
}

// Apple Sign-In
async function handleAppleSignIn() {
    const rawNonce = generateNonce();
    // Apple expects the SHA-256 hash of the nonce -- keep rawNonce for server-side verification
    const result = await socialAuth.appleSignIn(['email', 'fullName'], await sha256Hex(rawNonce));
    if (result?.identityToken) {
        sendTokenToBackend(result.identityToken);
    }
}

// Listen for events (works on both platforms, required for Android)
On('Ikromjon\NativePHP\SocialAuth\Events\GoogleSignInCompleted', (payload) => {
    sendTokenToBackend(payload.identityToken);
});

On('Ikromjon\NativePHP\SocialAuth\Events\AppleSignInCompleted', (payload) => {
    sendTokenToBackend(payload.identityToken);
});

On('Ikromjon\NativePHP\SocialAuth\Events\SignInFailed', (payload) => {
    if (payload.errorCode !== 'CANCELED') {
        alert(`Sign-in failed: ${payload.error}`);
    }
});
```

## API Reference

### `SocialAuth::appleSignIn(array $scopes, ?string $nonce, ?string $state): ?AuthResult`

Initiates native Apple Sign-In. Returns `AuthResult` on iOS, `null` on Android.

- `$scopes` -- Requested scopes: `['email', 'fullName']` (default: both)
- `$nonce` -- SHA256-hashed nonce for replay protection
- `$state` -- Optional state string echoed back in response

> **Important:** Apple only returns `email` and `givenName`/`familyName` on the **first** sign-in. Subsequent sign-ins return only `userId` and `identityToken`. You must persist user info on first authentication.

### `SocialAuth::googleSignIn(?string $nonce): ?AuthResult`

Initiates native Google Sign-In. Returns `AuthResult` on iOS, `null` on Android (result via event).

- `$nonce` -- Optional nonce for replay protection (raw string, not hashed). Supported on both platforms: Android via Credential Manager, iOS via GoogleSignIn-iOS 9.x. The nonce comes back as the `nonce` claim inside the ID token -- verify it server-side.

### `SocialAuth::checkAppleCredentialState(string $userId): string`

Checks if an Apple credential is still valid. iOS only.

Returns: `'authorized'`, `'revoked'`, `'not_found'`, `'transferred'`, or `'unknown'`

### `SocialAuth::signOut(): bool`

Signs out from Google and clears credential state. Apple has no sign-out API.

### AuthResult

| Property | Type | Apple | Google |
|----------|------|-------|--------|
| `provider` | `string` | `'apple'` | `'google'` |
| `userId` | `?string` | Unique Apple user ID | Google user ID |
| `identityToken` | `?string` | JWT | JWT |
| `authorizationCode` | `?string` | One-time code | Server auth code |
| `accessToken` | `?string` | -- | OAuth access token |
| `email` | `?string` | First sign-in only | Always |
| `givenName` | `?string` | First sign-in only | Always |
| `familyName` | `?string` | First sign-in only | Always |
| `displayName` | `?string` | First sign-in only | Always |
| `photoUrl` | `?string` | -- | Profile photo URL |
| `nonce` | `?string` | Returned as `nonce` claim inside `identityToken` | Returned as `nonce` claim inside `identityToken` |
| `state` | `?string` | Echoed | -- |
| `realUserStatus` | `?string` | `'likelyReal'` / `'unknown'` | -- |

### Events

| Event | Payload |
|-------|---------|
| `AppleSignInCompleted` | `userId`, `identityToken`, `authorizationCode`, `email`, `givenName`, `familyName` |
| `GoogleSignInCompleted` | `userId`, `identityToken`, `email`, `displayName`, `givenName`, `familyName`, `photoUrl` |
| `SignInFailed` | `provider`, `error`, `errorCode` |

**Error codes:** `CANCELED`, `FAILED`, `INVALID_RESPONSE`, `NOT_HANDLED`, `NOT_INTERACTIVE`, `NO_AUTH_IN_KEYCHAIN`, `NO_CREDENTIAL`, `UNSUPPORTED_PLATFORM`, `MISSING_CONFIG`, `PARSE_ERROR`, `UNKNOWN`

## Server-Side Token Verification

Identity tokens are JWTs that **must** be verified server-side before trusting the user's identity:

```php
use Firebase\JWT\JWT;
use Firebase\JWT\JWK;

// Google verification
$googleKeys = json_decode(
    file_get_contents('https://www.googleapis.com/oauth2/v3/certs'), true
);
$decoded = JWT::decode($identityToken, JWK::parseKeySet($googleKeys));
// Verify: $decoded->aud === your GOOGLE_SERVER_CLIENT_ID
// Verify: $decoded->iss === 'https://accounts.google.com'
// If you passed a nonce to googleSignIn():
// Verify: $decoded->nonce === session('auth_nonce')

// Apple verification
$appleKeys = json_decode(
    file_get_contents('https://appleid.apple.com/auth/keys'), true
);
$decoded = JWT::decode($identityToken, JWK::parseKeySet($appleKeys));
// Verify: $decoded->aud === your app's bundle ID
// Verify: $decoded->iss === 'https://appleid.apple.com'
// If you passed a nonce to appleSignIn() (SHA-256 of the raw nonce):
// Verify: $decoded->nonce === hash('sha256', session('auth_nonce'))
```

Install the JWT library: `composer require firebase/php-jwt`

## Troubleshooting

**iOS build fails: `error: extra arguments at positions #4, #5 in call` in SocialAuthFunctions.swift**
- Plugin versions up to 1.0.1 pinned GoogleSignIn-iOS `~> 8.0` while calling the nonce sign-in overload, which only exists in GoogleSignIn-iOS 9.0+. Upgrade the plugin (`composer update ikromjon/nativephp-mobile-social-auth`), then run `php artisan native:install --force` so the regenerated Podfile resolves GoogleSignIn `~> 9.0`. If CocoaPods then reports a dependency conflict, another pod in your project is pinning AppAuth 1.x / GTMAppAuth 4.x -- update that dependency, since GoogleSignIn 9.x requires AppAuth 2.x and GTMAppAuth 5.x.

**"Developer console is not set up correctly" (Android)**
- Ensure you have BOTH an Android client AND a Web client in the same Google Cloud project
- The Android client must have the correct package name and SHA-1 fingerprint

**"MISSING_CONFIG" error**
- Check that `GOOGLE_SERVER_CLIENT_ID` is set in your `.env` file

**Google Sign-In returns null on Android**
- This is expected. On Android, Google Sign-In is async. Use `#[OnNative(GoogleSignInCompleted::class)]` to receive the result.

**Apple email/name are null**
- Apple only provides email and name on the **first** sign-in. After that, only `userId` and `identityToken` are returned. To reset during development: Settings > Apple ID > Sign-In & Security > Sign in with Apple > Your App > Stop Using Apple ID.

**App Store rejection for missing Apple Sign-In**
- If your app offers Google (or any third-party) sign-in, you must also offer Apple Sign-In. This plugin handles both.

## Support

- Issues: [GitHub Issues](https://github.com/Ikromjon1998/nativephp-mobile-social-auth/issues)
- Email: ikromjon98.98@icloud.com

---

# Background Tasks

> Bifrost Technology

<div class="plugin-info"><div class="pi-meta"><span class="pi-item"><span class="pi-label">Author</span><span class="pi-value">Bifrost Technology</span></span><span class="pi-item"><span class="pi-label">Plugin Type</span><span class="pi-badge pi-badge-first-party">1st Party Plugin</span></span><span class="pi-item"><span class="pi-label">Price</span><span class="pi-badge pi-badge-paid">$99</span></span><span class="pi-item"><span class="pi-label">Version</span><span class="pi-value">v0.0.4</span></span><span class="pi-item"><span class="pi-label">License</span><span class="pi-value">Proprietary</span></span></div><div class="pi-compat"><span class="pi-chip"><span class="pi-chip-label">NativePHP</span><span class="pi-chip-value">^3.2.1</span></span><span class="pi-chip"><span class="pi-chip-label">iOS</span><span class="pi-chip-value">16.0+</span></span><span class="pi-chip"><span class="pi-chip-label">Android</span><span class="pi-chip-value">26+</span></span></div><div class="pi-links"><a href="https://nativephp.com/plugins/nativephp/mobile-background-tasks" class="pi-link pi-link-buy" target="_blank" rel="noopener">Buy on NativePHP →</a></div></div>

# NativePHP Mobile Background Tasks

Run scheduled artisan commands in the background on iOS and Android via WorkManager (Android) and BGTaskScheduler (iOS) — tasks continue executing even after the user closes the app.

## Features

- Background task scheduling that survives app close
- Device constraints: network, charging, battery, storage, idle state
- Long-running task support for operations beyond typical execution limits
- Independent task scheduling with individual intervals
- Automatic OS-level task registration on app launch
- Testing utilities and debugging support

## Installation

> Requires Composer credentials for the NativePHP plugin repository.

```bash
composer config repositories.nativephp-plugins composer https://plugins.nativephp.com
composer config http-basic.plugins.nativephp.com your@email.com your-license-key
php artisan vendor:publish --tag=nativephp-plugins-provider
composer require nativephp/mobile-background-tasks
php artisan native:plugin:register nativephp/mobile-background-tasks
```

## Usage

Define tasks in `routes/console.php`:

```php
use Illuminate\Support\Facades\Schedule;

Schedule::command('sync:data')->everyFifteenMinutes()->onAnyNetwork();
Schedule::command('backup:run')->daily()->onWifi()->whileCharging()->whenBatteryNotLow();
Schedule::command('export:logs')->daily()->longRunning();
```

Trigger immediately for testing:

```php
use NativePHP\BackgroundTasks\Facades\BackgroundTasks;

BackgroundTasks::runNow();
```

## Constraints

| Method | Purpose |
|--------|---------|
| `onAnyNetwork()` | Requires WiFi or cellular |
| `onWifi()` | Requires WiFi only |
| `whileCharging()` | Device must be plugged in |
| `whenBatteryNotLow()` | Battery above ~15% |
| `whenStorageNotLow()` | Storage not critically low |
| `whenIdle()` | Device in idle/doze state |

## Schedule Intervals

| Method | Android | iOS |
|--------|---------|-----|
| `everyFifteenMinutes()` | 15 min minimum | OS discretion |
| `hourly()` | 60 min | OS discretion |
| `daily()` | 1440 min | OS discretion |

> iOS timing is entirely at OS discretion based on usage patterns and battery state.

## Compatibility

| Platform   | Minimum Version |
| ---------- | --------------- |
| NativePHP  | ^3.2.1          |
| iOS        | 16.0+           |
| Android    | API 26+         |

---

# Local Notifications

> Bifrost Technology

<div class="plugin-info"><div class="pi-meta"><span class="pi-item"><span class="pi-label">Author</span><span class="pi-value">Bifrost Technology</span></span><span class="pi-item"><span class="pi-label">Plugin Type</span><span class="pi-badge pi-badge-first-party">1st Party Plugin</span></span><span class="pi-item"><span class="pi-label">Price</span><span class="pi-badge pi-badge-paid">$99</span></span><span class="pi-item"><span class="pi-label">Version</span><span class="pi-value">v0.0.3</span></span><span class="pi-item"><span class="pi-label">License</span><span class="pi-value">Proprietary</span></span></div><div class="pi-compat"><span class="pi-chip"><span class="pi-chip-label">NativePHP</span><span class="pi-chip-value">^3.2.1</span></span><span class="pi-chip"><span class="pi-chip-label">iOS</span><span class="pi-chip-value">16.0+</span></span><span class="pi-chip"><span class="pi-chip-label">Android</span><span class="pi-chip-value">26+</span></span></div><div class="pi-links"><a href="https://nativephp.com/plugins/nativephp/mobile-local-notifications" class="pi-link pi-link-buy" target="_blank" rel="noopener">Buy on NativePHP →</a></div></div>

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

---

# Biometrics

> Bifrost Technology

<div class="plugin-info"><div class="pi-meta"><span class="pi-item"><span class="pi-label">Author</span><span class="pi-value">Bifrost Technology</span></span><span class="pi-item"><span class="pi-label">Plugin Type</span><span class="pi-badge pi-badge-first-party">1st Party Plugin</span></span><span class="pi-item"><span class="pi-label">Price</span><span class="pi-badge pi-badge-paid">$49</span></span><span class="pi-item"><span class="pi-label">Version</span><span class="pi-value">v1.0.3</span></span><span class="pi-item"><span class="pi-label">License</span><span class="pi-value">Proprietary</span></span></div><div class="pi-compat"><span class="pi-chip"><span class="pi-chip-label">NativePHP</span><span class="pi-chip-value">^3.0</span></span><span class="pi-chip"><span class="pi-chip-label">iOS</span><span class="pi-chip-value">18.2+</span></span><span class="pi-chip"><span class="pi-chip-label">Android</span><span class="pi-chip-value">26+</span></span></div><div class="pi-links"><a href="https://nativephp.com/plugins/nativephp/mobile-biometrics" class="pi-link pi-link-buy" target="_blank" rel="noopener">Buy on NativePHP →</a></div></div>

# NativePHP Mobile Biometrics

Biometric authentication for NativePHP Mobile — Face ID / Touch ID on iOS; fingerprint and facial unlock on Android — with a system passcode fallback.

## Features

- Face ID and Touch ID support on iOS
- Fingerprint and facial unlock on Android
- System authentication (passcode / PIN) fallback
- Availability checking before prompting
- PHP/Livewire/Blade and JavaScript/Vue/React/Inertia support
- Event-driven authentication result callbacks

## Installation

> Requires Composer credentials for the NativePHP plugin repository.

```bash
composer config repositories.nativephp-plugins composer https://plugins.nativephp.com
composer config http-basic.plugins.nativephp.com your@email.com your-license-key
php artisan vendor:publish --tag=nativephp-plugins-provider
composer require nativephp/mobile-biometrics
php artisan native:plugin:register nativephp/mobile-biometrics
```

## PHP Usage

```php
use NativePHP\MobileBiometrics\Facades\Biometrics;

// Check availability
if (Biometrics::isAvailable()) {
    Biometrics::authenticate(
        reason: 'Confirm your identity to continue.',
        allowDeviceCredential: true,
    );
}
```

## Livewire Usage

```php
use Native\Mobile\Attributes\OnNative;
use NativePHP\MobileBiometrics\Events\BiometricCompleted;

#[OnNative(BiometricCompleted::class)]
public function onBiometricCompleted(bool $success, ?string $error): void
{
    if ($success) {
        $this->dispatch('authenticated');
    }
}
```

## JavaScript Usage

```javascript
import { biometrics } from '@nativephp/mobile-biometrics';
import { on } from '@nativephp/native';

on('BiometricCompleted', ({ success, error }) => {
    console.log(success ? 'Authenticated' : `Failed: ${error}`);
});

await biometrics.authenticate({ reason: 'Confirm your identity.' });
```

## Compatibility

| Platform   | Minimum Version |
| ---------- | --------------- |
| NativePHP  | ^3.0            |
| iOS        | 18.2+           |
| Android    | API 26+         |

## Events

### `BiometricCompleted`

Fires when the authentication dialog resolves.

| Field | Type | Description |
|-------|------|-------------|
| `success` | `bool` | `true` if authenticated |
| `error` | `string\|null` | Error reason if failed |

---

# Firebase

> Bifrost Technology

<div class="plugin-info"><div class="pi-meta"><span class="pi-item"><span class="pi-label">Author</span><span class="pi-value">Bifrost Technology</span></span><span class="pi-item"><span class="pi-label">Plugin Type</span><span class="pi-badge pi-badge-first-party">1st Party Plugin</span></span><span class="pi-item"><span class="pi-label">Price</span><span class="pi-badge pi-badge-paid">$99</span></span><span class="pi-item"><span class="pi-label">Version</span><span class="pi-value">v1.1.1</span></span><span class="pi-item"><span class="pi-label">License</span><span class="pi-value">Proprietary</span></span></div><div class="pi-compat"><span class="pi-chip"><span class="pi-chip-label">NativePHP</span><span class="pi-chip-value">*</span></span><span class="pi-chip"><span class="pi-chip-label">iOS</span><span class="pi-chip-value">18.2+</span></span><span class="pi-chip"><span class="pi-chip-label">Android</span><span class="pi-chip-value">26+</span></span></div><div class="pi-links"><a href="https://nativephp.com/plugins/nativephp/mobile-firebase" class="pi-link pi-link-buy" target="_blank" rel="noopener">Buy on NativePHP →</a></div></div>

# NativePHP Mobile Firebase

Firebase Cloud Messaging (FCM) push notifications for NativePHP Mobile — device token management, permission handling, deep linking, and silent background event processing.

## Features

- FCM device token registration and lifecycle management
- Permission checking and requesting on iOS (Android auto-grants)
- Deep linking from notification taps to app routes
- Data-only (silent) messages dispatched as Laravel events via ephemeral PHP runtime
- Server-side FCM v1 API integration helpers
- Badge count management
- Compatible with the Local Notifications plugin

## Installation

> Requires Composer credentials for the NativePHP plugin repository.

```bash
composer config repositories.nativephp-plugins composer https://plugins.nativephp.com
composer config http-basic.plugins.nativephp.com your@email.com your-license-key
php artisan vendor:publish --tag=nativephp-plugins-provider
composer require nativephp/mobile-firebase
php artisan native:plugin:register nativephp/mobile-firebase
```

## Setup

1. Create a Firebase project and add iOS and Android apps.
2. Download `google-services.json` (Android) and `GoogleService-Info.plist` (iOS) and follow the NativePHP Mobile Firebase setup guide.
3. Enroll the device to receive a push token.

## PHP Usage

```php
use NativePHP\MobileFirebase\Facades\Firebase;

// Check permission (iOS)
Firebase::checkPermission();

// Request permission (iOS) 
Firebase::requestPermission();

// Enroll device — triggers TokenGenerated event
Firebase::enroll();

// Set badge count
Firebase::setBadgeCount(3);
Firebase::clearBadge();
```

## Livewire Usage

```php
use Native\Mobile\Attributes\OnNative;
use NativePHP\MobileFirebase\Events\TokenGenerated;
use NativePHP\MobileFirebase\Events\PushNotificationReceived;

#[OnNative(TokenGenerated::class)]
public function onTokenGenerated(string $token): void
{
    // Save $token to your server for sending push notifications
}

#[OnNative(PushNotificationReceived::class)]
public function onPushReceived(string $event, array $data): void
{
    // Handle silent push data-only message
}
```

## Compatibility

| Platform   | Minimum Version |
| ---------- | --------------- |
| NativePHP  | Any             |
| iOS        | 18.2+           |
| Android    | API 26+         |

## Events

### `TokenGenerated`

Fires when a push token becomes available. Payload: `string $token`.

### `PushNotificationReceived`

Fires for data-only messages containing an `event` key. Payload: `string $event`, `array $data`.

---

# Secure Storage

> Bifrost Technology

<div class="plugin-info"><div class="pi-meta"><span class="pi-item"><span class="pi-label">Author</span><span class="pi-value">Bifrost Technology</span></span><span class="pi-item"><span class="pi-label">Plugin Type</span><span class="pi-badge pi-badge-first-party">1st Party Plugin</span></span><span class="pi-item"><span class="pi-label">Price</span><span class="pi-badge pi-badge-paid">$49</span></span><span class="pi-item"><span class="pi-label">Version</span><span class="pi-value">v1.0.2</span></span><span class="pi-item"><span class="pi-label">License</span><span class="pi-value">Proprietary</span></span></div><div class="pi-compat"><span class="pi-chip"><span class="pi-chip-label">NativePHP</span><span class="pi-chip-value">^3.0</span></span><span class="pi-chip"><span class="pi-chip-label">iOS</span><span class="pi-chip-value">18.2+</span></span><span class="pi-chip"><span class="pi-chip-label">Android</span><span class="pi-chip-value">26+</span></span></div><div class="pi-links"><a href="https://nativephp.com/plugins/nativephp/mobile-secure-storage" class="pi-link pi-link-buy" target="_blank" rel="noopener">Buy on NativePHP →</a></div></div>

# NativePHP Mobile Secure Storage

Encrypted key-value storage for sensitive data, backed by iOS Keychain Services and Android EncryptedSharedPreferences.

## Features

- iOS Keychain Services with hardware-backed encryption
- Android EncryptedSharedPreferences with AES-256-GCM + AES-256-SIV
- `set()`, `get()`, `delete()` API — simple and composable
- Works with PHP (Livewire/Blade) and JavaScript (Vue/React/Inertia)
- Ideal for auth tokens, API keys, and user secrets

## Installation

> Requires Composer credentials for the NativePHP plugin repository.

```bash
composer config repositories.nativephp-plugins composer https://plugins.nativephp.com
composer config http-basic.plugins.nativephp.com your@email.com your-license-key
php artisan vendor:publish --tag=nativephp-plugins-provider
composer require nativephp/mobile-secure-storage
php artisan native:plugin:register nativephp/mobile-secure-storage
```

## PHP Usage

```php
use NativePHP\MobileSecureStorage\Facades\SecureStorage;

// Store a value
SecureStorage::set('auth_token', $token);

// Retrieve a value (returns null if not found)
$token = SecureStorage::get('auth_token');

// Delete a value
SecureStorage::delete('auth_token');
```

## JavaScript Usage

```javascript
import { secureStorage } from '@nativephp/mobile-secure-storage';

await secureStorage.set('auth_token', token);
const token = await secureStorage.get('auth_token');
await secureStorage.delete('auth_token');
```

## Compatibility

| Platform   | Minimum Version |
| ---------- | --------------- |
| NativePHP  | ^3.0            |
| iOS        | 18.2+           |
| Android    | API 26+         |

> Data persists across app restarts and updates. It is not automatically cleared on uninstall on Android — handle logout explicitly.

---

# Scanner

> Bifrost Technology

<div class="plugin-info"><div class="pi-meta"><span class="pi-item"><span class="pi-label">Author</span><span class="pi-value">Bifrost Technology</span></span><span class="pi-item"><span class="pi-label">Plugin Type</span><span class="pi-badge pi-badge-first-party">1st Party Plugin</span></span><span class="pi-item"><span class="pi-label">Price</span><span class="pi-badge pi-badge-paid">$49</span></span><span class="pi-item"><span class="pi-label">Version</span><span class="pi-value">v1.0.3</span></span><span class="pi-item"><span class="pi-label">License</span><span class="pi-value">Proprietary</span></span></div><div class="pi-compat"><span class="pi-chip"><span class="pi-chip-label">NativePHP</span><span class="pi-chip-value">^3.0</span></span><span class="pi-chip"><span class="pi-chip-label">iOS</span><span class="pi-chip-value">13.0+</span></span><span class="pi-chip"><span class="pi-chip-label">Android</span><span class="pi-chip-value">21+</span></span></div><div class="pi-links"><a href="https://nativephp.com/plugins/nativephp/mobile-scanner" class="pi-link pi-link-buy" target="_blank" rel="noopener">Buy on NativePHP →</a></div></div>

# NativePHP Mobile Scanner

QR code and barcode scanner for NativePHP Mobile — native camera-based scanning with multiple format support and continuous scanning mode.

## Features

- Cross-platform scanning via native camera (AVFoundation / ML Kit)
- Format support: `qr`, `ean13`, `ean8`, `code128`, `code39`, `upca`, `upce`, `all`
- Continuous scanning mode (multiple scans per session)
- Customizable prompt text shown in the scanner overlay
- Session IDs for managing multiple concurrent scan contexts
- PHP/Livewire and JavaScript/Vue/React support

## Installation

> Requires Composer credentials for the NativePHP plugin repository.

```bash
composer config repositories.nativephp-plugins composer https://plugins.nativephp.com
composer config http-basic.plugins.nativephp.com your@email.com your-license-key
php artisan vendor:publish --tag=nativephp-plugins-provider
composer require nativephp/mobile-scanner
php artisan native:plugin:register nativephp/mobile-scanner
```

## PHP Usage

```php
use NativePHP\MobileScanner\Facades\Scanner;

// Scan a QR code
Scanner::scan(
    formats: ['qr'],
    prompt: 'Scan a QR code to continue.',
    session: 'checkout',
    continuous: false,
);

// Multi-format continuous scan
Scanner::scan(
    formats: ['qr', 'ean13', 'code128'],
    prompt: 'Point at a barcode.',
    continuous: true,
);

// Stop continuous scanning
Scanner::stop();
```

## Livewire Usage

```php
use Native\Mobile\Attributes\OnNative;
use NativePHP\MobileScanner\Events\CodeScanned;

#[OnNative(CodeScanned::class)]
public function onCodeScanned(string $data, string $format, ?string $session): void
{
    if ($session === 'checkout') {
        $this->processBarcode($data);
    }
}
```

## Compatibility

| Platform   | Minimum Version              |
| ---------- | ---------------------------- |
| NativePHP  | ^3.0                         |
| iOS        | 13.0+                        |
| Android    | API 21+ (ML Kit), API 26+    |

## Events

### `CodeScanned`

Fires when a barcode is successfully decoded.

| Field | Type | Description |
|-------|------|-------------|
| `data` | `string` | The decoded barcode value |
| `format` | `string` | Format detected (e.g. `qr`, `ean13`) |
| `session` | `string\|null` | Session ID if provided |

---

# Geolocation

> Bifrost Technology

<div class="plugin-info"><div class="pi-meta"><span class="pi-item"><span class="pi-label">Author</span><span class="pi-value">Bifrost Technology</span></span><span class="pi-item"><span class="pi-label">Plugin Type</span><span class="pi-badge pi-badge-first-party">1st Party Plugin</span></span><span class="pi-item"><span class="pi-label">Price</span><span class="pi-badge pi-badge-paid">$49</span></span><span class="pi-item"><span class="pi-label">Version</span><span class="pi-value">v2.0.0</span></span><span class="pi-item"><span class="pi-label">License</span><span class="pi-value">Proprietary</span></span></div><div class="pi-compat"><span class="pi-chip"><span class="pi-chip-label">NativePHP</span><span class="pi-chip-value">^3.0</span></span><span class="pi-chip"><span class="pi-chip-label">iOS</span><span class="pi-chip-value">18.2+</span></span><span class="pi-chip"><span class="pi-chip-label">Android</span><span class="pi-chip-value">26+</span></span></div><div class="pi-links"><a href="https://nativephp.com/plugins/nativephp/mobile-geolocation" class="pi-link pi-link-buy" target="_blank" rel="noopener">Buy on NativePHP →</a></div></div>

# NativePHP Mobile Geolocation

GPS and network-based location with permission handling for NativePHP Mobile apps.

## Features

- Network and GPS positioning options
- One-shot and continuous location updates
- Permission checking and requesting with `permanently_denied` detection
- Accuracy metadata (`accuracy` in meters)
- PHP (Livewire/Blade) and JavaScript (Vue/React/Inertia) support

## Installation

> Requires Composer credentials for the NativePHP plugin repository.

```bash
composer config repositories.nativephp-plugins composer https://plugins.nativephp.com
composer config http-basic.plugins.nativephp.com your@email.com your-license-key
php artisan vendor:publish --tag=nativephp-plugins-provider
composer require nativephp/mobile-geolocation
php artisan native:plugin:register nativephp/mobile-geolocation
```

## PHP Usage

```php
use NativePHP\MobileGeolocation\Facades\Geolocation;

// Check current permission
Geolocation::checkPermission();

// Request permission
Geolocation::requestPermission();

// Get one-shot location
Geolocation::getLocation(provider: 'gps'); // 'gps' or 'network'

// Start continuous updates
Geolocation::startLocationUpdates(provider: 'gps', minDistance: 10);

// Stop updates
Geolocation::stopLocationUpdates();
```

## Livewire Usage

```php
use Native\Mobile\Attributes\OnNative;
use NativePHP\MobileGeolocation\Events\LocationReceived;
use NativePHP\MobileGeolocation\Events\PermissionRequestResult;

#[OnNative(LocationReceived::class)]
public function onLocation(
    ?float $latitude, ?float $longitude, ?float $accuracy,
    ?string $provider, ?string $error
): void {
    if ($error) return;
    $this->lat = $latitude;
    $this->lng = $longitude;
}

#[OnNative(PermissionRequestResult::class)]
public function onPermission(string $status, bool $permanently_denied): void
{
    if ($permanently_denied) {
        // Prompt user to open Settings
    }
}
```

## Compatibility

| Platform   | Minimum Version |
| ---------- | --------------- |
| NativePHP  | ^3.0            |
| iOS        | 18.2+           |
| Android    | API 26+         |

## Events

### `LocationReceived`

| Field | Type | Description |
|-------|------|-------------|
| `latitude` | `float\|null` | Latitude in decimal degrees |
| `longitude` | `float\|null` | Longitude in decimal degrees |
| `accuracy` | `float\|null` | Accuracy in meters |
| `timestamp` | `int\|null` | Unix timestamp |
| `provider` | `string\|null` | `gps` or `network` |
| `error` | `string\|null` | Error message if failed |

### `PermissionStatusReceived`

Returned by `checkPermission()`. Status: `granted`, `denied`, or `not_determined`.

### `PermissionRequestResult`

Returned by `requestPermission()`. Includes `permanently_denied: bool`.

---

# In-App Purchases

> Developernauts

<div class="plugin-info"><div class="pi-meta"><span class="pi-item"><span class="pi-label">Author</span><span class="pi-value">Developernauts</span></span><span class="pi-item"><span class="pi-label">Plugin Type</span><span class="pi-badge pi-badge-community">Community Plugin</span></span><span class="pi-item"><span class="pi-label">Price</span><span class="pi-badge pi-badge-paid">$99</span></span><span class="pi-item"><span class="pi-label">Version</span><span class="pi-value">v1.4.1</span></span><span class="pi-item"><span class="pi-label">License</span><span class="pi-value">Proprietary</span></span></div><div class="pi-compat"><span class="pi-chip"><span class="pi-chip-label">NativePHP</span><span class="pi-chip-value">^3.0</span></span><span class="pi-chip"><span class="pi-chip-label">PHP</span><span class="pi-chip-value">^8.3</span></span><span class="pi-chip"><span class="pi-chip-label">Laravel</span><span class="pi-chip-value">^12.0</span></span><span class="pi-chip"><span class="pi-chip-label">iOS</span><span class="pi-chip-value">18.2+</span></span><span class="pi-chip"><span class="pi-chip-label">Android</span><span class="pi-chip-value">26+</span></span></div><div class="pi-links"><a href="https://nativephp.com/plugins/developernauts/nativephp-inapp-purchases" class="pi-link pi-link-buy" target="_blank" rel="noopener">Buy on NativePHP →</a></div></div>

# In-App Purchases

In-app purchases via StoreKit 2 (iOS) and Google Play Billing (Android) for NativePHP Mobile Laravel apps.

## Features

- Fetches localized product metadata (titles, descriptions, prices) from native stores
- Initiates native purchase flows with Apple and Google infrastructure
- Restores previous purchases across devices
- Reads device entitlements in real-time
- Returns transaction data with verification proof (`jws` for iOS, `purchaseToken` for Android)
- Supports subscriptions, consumables, and non-consumable products
- Livewire v3/v4, Vue, and React support

## Installation

> Requires Composer credentials for the NativePHP plugin repository.

```bash
composer config repositories.nativephp-plugins composer https://plugins.nativephp.com
composer config http-basic.plugins.nativephp.com your@email.com your-license-key
php artisan vendor:publish --tag=nativephp-plugins-provider
composer require developernauts/nativephp-inapp-purchases
php artisan native:plugin:register developernauts/nativephp-inapp-purchases
```

## PHP Usage

```php
use Developernauts\NativephpInappPurchases\Facades\InApp;

// Fetch single product
$result = InApp::product('com.app.premium_monthly');
if ($result['ok']) {
    echo $result['product']['price_formatted'];
}

// Fetch multiple products
$result = InApp::products(['com.app.premium_monthly', 'com.app.premium_yearly']);

// Initiate purchase
$result = InApp::purchase('com.app.premium_monthly');
if ($result['ok']) {
    $jws = $result['transaction']['jws'];            // iOS
    $token = $result['transaction']['purchaseToken']; // Android
}

// Check entitlements
$result = InApp::entitlement();
if ($result['is_premium']) {
    // User has active subscription
}

// Restore purchases
$result = InApp::restore();
```

## JavaScript Usage

```javascript
import { products, purchase, entitlement, restore } from
    '../../vendor/developernauts/nativephp-inapp-purchases/resources/js/index.js';

const list = await products(['com.app.premium_monthly']);
const txn  = await purchase('com.app.premium_monthly');
const ent  = await entitlement();
const prev = await restore();
```

## API Methods

| Method | Purpose |
|--------|---------|
| `product($id)` | Fetch single product |
| `products($ids)` | Fetch multiple products |
| `purchase($id)` | Initiate purchase flow |
| `restore()` | Restore previous purchases |
| `entitlement()` | Check active entitlements |

## Compatibility

| Platform  | Minimum Version |
| --------- | --------------- |
| NativePHP | ^3.0            |
| PHP       | ^8.3            |
| Laravel   | ^12.0           |
| iOS       | 18.2+           |
| Android   | API 26+         |

## Notes

- This plugin does not emit NativePHP native events — all bridge functions return structured response arrays.
- Never store Apple `.p8` keys or Google service-account JSON inside the app bundle. Implement server-side receipt verification (App Store Server API / Play Developer API) for production entitlement management.

---

# Google AdMob

> Lukas Rakauskas

<div class="plugin-info"><div class="pi-meta"><span class="pi-item"><span class="pi-label">Author</span><span class="pi-value">Lukas Rakauskas</span></span><span class="pi-item"><span class="pi-label">Plugin Type</span><span class="pi-badge pi-badge-community">Community Plugin</span></span><span class="pi-item"><span class="pi-label">Price</span><span class="pi-badge pi-badge-paid">$99</span></span><span class="pi-item"><span class="pi-label">Version</span><span class="pi-value">v1.0.0</span></span><span class="pi-item"><span class="pi-label">License</span><span class="pi-value">Proprietary</span></span></div><div class="pi-compat"><span class="pi-chip"><span class="pi-chip-label">NativePHP</span><span class="pi-chip-value">^3.0</span></span><span class="pi-chip"><span class="pi-chip-label">iOS</span><span class="pi-chip-value">18.0+</span></span><span class="pi-chip"><span class="pi-chip-label">Android</span><span class="pi-chip-value">23+</span></span></div><div class="pi-links"><a href="https://nativephp.com/plugins/lrakauskas/nativephp-google-admob" class="pi-link pi-link-buy" target="_blank" rel="noopener">Buy on NativePHP →</a></div></div>

# Google AdMob

Bridges Google AdMob to PHP and JavaScript for NativePHP Mobile — banner, interstitial, and rewarded ads with a facade-first PHP API and native event dispatching on both iOS and Android.

## Features

- **Anchored adaptive banner ads** — responsive banners that fit any screen size
- **Interstitial ads** with complete lifecycle events (loaded, shown, dismissed, failed)
- **Rewarded ads** with complete lifecycle events and reward callbacks
- **Facade-first PHP API** — clean, expressive interface from Laravel
- **Native event dispatching** — real-time ad lifecycle events on both platforms
- **Cross-platform** — consistent API across Android and iOS

## Installation

```bash
composer config repositories.nativephp-plugins composer https://plugins.nativephp.com
composer config http-basic.plugins.nativephp.com your@email.com your-license-key
php artisan vendor:publish --tag=nativephp-plugins-provider
composer require lrakauskas/nativephp-google-admob
php artisan native:plugin:register lrakauskas/nativephp-google-admob
```

## Prerequisites

A Google AdMob account with app IDs and ad unit IDs configured for both iOS and Android.

---

# Share Target

> Neo Nos

<div class="plugin-info"><div class="pi-meta"><span class="pi-item"><span class="pi-label">Author</span><span class="pi-value">Neo Nos</span></span><span class="pi-item"><span class="pi-label">Plugin Type</span><span class="pi-badge pi-badge-community">Community Plugin</span></span><span class="pi-item"><span class="pi-label">Price</span><span class="pi-badge pi-badge-paid">$49</span></span><span class="pi-item"><span class="pi-label">Version</span><span class="pi-value">v0.3.2</span></span><span class="pi-item"><span class="pi-label">License</span><span class="pi-value">Proprietary</span></span></div><div class="pi-compat"><span class="pi-chip"><span class="pi-chip-label">NativePHP</span><span class="pi-chip-value">^3.0 || ^4.0</span></span><span class="pi-chip"><span class="pi-chip-label">iOS</span><span class="pi-chip-value">18.2+</span></span><span class="pi-chip"><span class="pi-chip-label">Android</span><span class="pi-chip-value">26+</span></span></div><div class="pi-links"><a href="https://nativephp.com/plugins/all1web/nativephp-share-target" class="pi-link pi-link-buy" target="_blank" rel="noopener">Buy on NativePHP →</a></div></div>

# Share Target

Enables your NativePHP app to receive incoming shares — links, text, images, videos, and PDFs — directly from the Android share sheet and iOS Shortcuts, with zero native code required.

## Features

- **Android Share Sheet integration** — app appears as a share destination for links, text, images, videos, PDFs
- **PHP object reception** — shared items arrive as typed PHP objects with automatic content detection
- **Persistent storage** — undelivered shares are queued until the app opens
- **Real-time events** — instant notifications when shares arrive during active sessions
- **iOS support (Beta)** — companion Shortcut enables iOS sharing with the same PHP API
- **Silent mode** — capture shares without interrupting the user's current view
- **Testing support** — built-in `ShareTarget::fake()` with fluent builders and assertions
- **Native confirmation** — "Saved ✓" card appears in the originating app (Android)
- **Diagnostic tool** — `php artisan share-target:doctor` verifies setup and flags issues
- **Full JS API** — works with Inertia, Vue, React, and vanilla JavaScript

## Installation

```bash
composer config repositories.nativephp-plugins composer https://plugins.nativephp.com
composer config http-basic.plugins.nativephp.com your@email.com your-license-key
composer require all1web/nativephp-share-target
php artisan native:plugin:register all1web/nativephp-share-target
php artisan native:install android --force
```

## Diagnostics

```bash
php artisan share-target:doctor
```

## Notes

- Pairs well with `nativephp/mobile-share` for outbound sharing
- No runtime permissions needed on either platform

---

# Widgets

> Borgman Digital

<div class="plugin-info"><div class="pi-meta"><span class="pi-item"><span class="pi-label">Author</span><span class="pi-value">Borgman Digital</span></span><span class="pi-item"><span class="pi-label">Plugin Type</span><span class="pi-badge pi-badge-community">Community Plugin</span></span><span class="pi-item"><span class="pi-label">Price</span><span class="pi-badge pi-badge-paid">$99</span></span><span class="pi-item"><span class="pi-label">Version</span><span class="pi-value">v0.9.0</span></span><span class="pi-item"><span class="pi-label">License</span><span class="pi-value">Proprietary</span></span></div><div class="pi-compat"><span class="pi-chip"><span class="pi-chip-label">NativePHP</span><span class="pi-chip-value">~4.0.0</span></span><span class="pi-chip"><span class="pi-chip-label">PHP</span><span class="pi-chip-value">^8.4</span></span><span class="pi-chip"><span class="pi-chip-label">Laravel</span><span class="pi-chip-value">11 || 12 || 13</span></span><span class="pi-chip"><span class="pi-chip-label">iOS</span><span class="pi-chip-value">18.0+</span></span><span class="pi-chip"><span class="pi-chip-label">Android</span><span class="pi-chip-value">31+</span></span></div><div class="pi-links"><a href="https://nativephp.com/plugins/rubenvdb/nativephp-widgets" class="pi-link pi-link-buy" target="_blank" rel="noopener">Buy on NativePHP →</a></div></div>

# Widgets

Cross-platform home screen widgets for NativePHP Mobile. Define widgets as PHP classes — rendered natively via WidgetKit (iOS) and Jetpack Glance (Android).

## Features

- **48 layout components** with a typed fluent API and five-layer theming
- **Device-side computations** — countdowns, streaks, and daily resets work with the app closed
- **Rapid tap response** — ~187ms measured using optimistic local state
- **Background PHP execution** via WorkManager (~1.2s cold start on Android)
- **Server push support** through FCM
- **Per-instance theming** via on-device configuration screens
- **17 ready-made recipes** — goal rings, streak trackers, counters, and more

## Installation

```bash
composer config repositories.nativephp-plugins composer https://plugins.nativephp.com
composer config http-basic.plugins.nativephp.com your@email.com your-license-key
php artisan vendor:publish --tag=nativephp-plugins-provider
composer require rubenvdb/nativephp-widgets
php artisan native:plugin:register rubenvdb/nativephp-widgets
php artisan native:install android
php artisan native:install ios
```

> **Note:** Five upstream patches must be applied post-installation to enable push functionality and prevent build failures. See the plugin documentation for the automated patching script.

---

# Actions Anywhere

> Neo Nos

<div class="plugin-info"><div class="pi-meta"><span class="pi-item"><span class="pi-label">Author</span><span class="pi-value">Neo Nos</span></span><span class="pi-item"><span class="pi-label">Plugin Type</span><span class="pi-badge pi-badge-community">Community Plugin</span></span><span class="pi-item"><span class="pi-label">Price</span><span class="pi-badge pi-badge-paid">$29</span></span><span class="pi-item"><span class="pi-label">Version</span><span class="pi-value">v0.4.0</span></span><span class="pi-item"><span class="pi-label">License</span><span class="pi-value">Proprietary</span></span></div><div class="pi-compat"><span class="pi-chip"><span class="pi-chip-label">NativePHP</span><span class="pi-chip-value">^3.0 || ^4.0</span></span><span class="pi-chip"><span class="pi-chip-label">iOS</span><span class="pi-chip-value">18.2+</span></span><span class="pi-chip"><span class="pi-chip-label">Android</span><span class="pi-chip-value">26+</span></span></div><div class="pi-links"><a href="https://nativephp.com/plugins/all1web/nativephp-actions-anywhere" class="pi-link pi-link-buy" target="_blank" rel="noopener">Buy on NativePHP →</a></div></div>

# Actions Anywhere

Converts a single Laravel configuration into native integrations across iOS and Android — Siri voice phrases, Spotlight results, Shortcuts automation blocks, and Android Quick Settings tiles — all without writing Swift or Kotlin.

## Features

- **Siri voice integration** — users activate app actions by speaking configured phrases
- **Spotlight search** — actions appear as searchable, tappable results
- **Shortcuts app** — actions function as automation building blocks on iOS
- **Android Quick Settings tiles** — up to 6 tiles placed directly in the notification shade
- **Deep linking** — every action generates a URL for NFC stickers and QR codes
- **Background & foreground modes** — choose whether actions launch the app or run silently
- **Testing utilities** — `AppIntents::fake()` for device-free unit testing
- **Diagnostics** — `php artisan appintents:doctor` validates your configuration
- **Zero permissions** — no runtime permissions or entitlements required

## Installation

```bash
composer config repositories.nativephp-plugins composer https://plugins.nativephp.com
composer config http-basic.plugins.nativephp.com your@email.com your-license-key
composer require all1web/nativephp-actions-anywhere
php artisan native:plugin:register all1web/nativephp-actions-anywhere
php artisan vendor:publish --tag=appintents-config
```

## Diagnostics

```bash
php artisan appintents:doctor
```

---

# Home Screen Widgets

> Neo Nos

<div class="plugin-info"><div class="pi-meta"><span class="pi-item"><span class="pi-label">Author</span><span class="pi-value">Neo Nos</span></span><span class="pi-item"><span class="pi-label">Plugin Type</span><span class="pi-badge pi-badge-community">Community Plugin</span></span><span class="pi-item"><span class="pi-label">Price</span><span class="pi-badge pi-badge-paid">$49</span></span><span class="pi-item"><span class="pi-label">Version</span><span class="pi-value">v0.7.2</span></span><span class="pi-item"><span class="pi-label">License</span><span class="pi-value">Proprietary</span></span></div><div class="pi-compat"><span class="pi-chip"><span class="pi-chip-label">NativePHP</span><span class="pi-chip-value">^3.3 || ^4.0</span></span><span class="pi-chip"><span class="pi-chip-label">iOS</span><span class="pi-chip-value">18.2+</span></span><span class="pi-chip"><span class="pi-chip-label">Android</span><span class="pi-chip-value">26+</span></span></div><div class="pi-links"><a href="https://nativephp.com/plugins/all1web/nativephp-widgets" class="pi-link pi-link-buy" target="_blank" rel="noopener">Buy on NativePHP →</a></div></div>

# Home Screen Widgets

Adds home-screen presence to your NativePHP Mobile app — real Android home-screen widgets with quick-action and capture buttons, plus iOS app-icon quick actions and badge mirroring (both beta), all driven from Laravel.

## Features

- **Android home-screen widget** — title, content lines, badge counter, and dark mode support
- **Quick-actions row** — up to 4 icon+label buttons with deep-link navigation
- **Capture buttons** — camera, voice, and document picker actions from the widget
- **iOS quick-actions menu** — 3D Touch / long-press shortcuts on the app icon (beta)
- **App icon badge mirroring** — sync badge count to iOS (beta)
- **Laravel-driven updates** — update widget content from controllers, observers, or jobs
- **"Add widget" prompt** — built-in trigger to guide users through widget placement
- **Offline rendering & empty states** — graceful display when data is unavailable
- **Testing support** — `Widgets::fake()` with assertions
- **Diagnostics** — `php artisan widgets:doctor` for setup verification

## Installation

```bash
composer config repositories.nativephp-plugins composer https://plugins.nativephp.com
composer config http-basic.plugins.nativephp.com your@email.com your-license-key
composer require all1web/nativephp-widgets
php artisan native:plugin:register all1web/nativephp-widgets
php artisan native:install android --force
```

## Diagnostics

```bash
php artisan widgets:doctor
```

---

# DatePicker

> camiant

<div class="plugin-info"><div class="pi-meta"><span class="pi-item"><span class="pi-label">Author</span><span class="pi-value">camiant</span></span><span class="pi-item"><span class="pi-label">Plugin Type</span><span class="pi-badge pi-badge-community">Community Plugin</span></span><span class="pi-item"><span class="pi-label">Price</span><span class="pi-badge pi-badge-paid">$29</span></span><span class="pi-item"><span class="pi-label">Version</span><span class="pi-value">v1.0.0</span></span><span class="pi-item"><span class="pi-label">License</span><span class="pi-value">Proprietary</span></span></div><div class="pi-compat"><span class="pi-chip"><span class="pi-chip-label">NativePHP</span><span class="pi-chip-value">^4.0</span></span><span class="pi-chip"><span class="pi-chip-label">iOS</span><span class="pi-chip-value">15.0+</span></span><span class="pi-chip"><span class="pi-chip-label">Android</span><span class="pi-chip-value">21+</span></span></div><div class="pi-links"><a href="https://nativephp.com/plugins/nativecodeforge/nativephp-datepicker" class="pi-link pi-link-buy" target="_blank" rel="noopener">Buy on NativePHP →</a></div></div>

# DatePicker

A native calendar interface for NativePHP Mobile that renders consistently across iOS (SwiftUI) and Android (Jetpack Compose) — custom calendar grid with an integrated wheel picker, not the OS system picker.

## Features

- **Custom calendar grid** — independent of the OS system date dialog
- **Wheel picker** for rapid year/month navigation
- **Theming** via accent and text color options
- **ISO date format** — returns values as `YYYY-MM-DD`
- **Dark mode** compatible
- **Built-in accessibility** support

## Installation

```bash
composer config repositories.nativephp-plugins composer https://plugins.nativephp.com
composer config http-basic.plugins.nativephp.com your@email.com your-license-key
php artisan vendor:publish --tag=nativephp-plugins-provider
composer require nativecodeforge/nativephp-datepicker
php artisan native:plugin:register nativecodeforge/nativephp-datepicker
```

---

# TimePicker

> camiant

<div class="plugin-info"><div class="pi-meta"><span class="pi-item"><span class="pi-label">Author</span><span class="pi-value">camiant</span></span><span class="pi-item"><span class="pi-label">Plugin Type</span><span class="pi-badge pi-badge-community">Community Plugin</span></span><span class="pi-item"><span class="pi-label">Price</span><span class="pi-badge pi-badge-paid">$29</span></span><span class="pi-item"><span class="pi-label">Version</span><span class="pi-value">v1.0.0</span></span><span class="pi-item"><span class="pi-label">License</span><span class="pi-value">Proprietary</span></span></div><div class="pi-compat"><span class="pi-chip"><span class="pi-chip-label">NativePHP</span><span class="pi-chip-value">^4.0</span></span><span class="pi-chip"><span class="pi-chip-label">iOS</span><span class="pi-chip-value">15.0+</span></span><span class="pi-chip"><span class="pi-chip-label">Android</span><span class="pi-chip-value">21+</span></span></div><div class="pi-links"><a href="https://nativephp.com/plugins/nativecodeforge/nativephp-timepicker" class="pi-link pi-link-buy" target="_blank" rel="noopener">Buy on NativePHP →</a></div></div>

# TimePicker

A native scrolling-wheel time picker for NativePHP Mobile — Jetpack Compose on Android and SwiftUI on iOS — with consistent appearance and behavior across both platforms.

## Features

- **Custom scrolling-wheel dialog** — not the OS system time picker
- **12h (AM/PM) and 24h modes** — configurable display format
- **Accent color theming**
- **24h wire format** — values returned as zero-padded `HH:mm` string
- **Dark mode** compatible
- **Built-in accessibility** labels and hints

## Installation

```bash
composer config repositories.nativephp-plugins composer https://plugins.nativephp.com
composer config http-basic.plugins.nativephp.com your@email.com your-license-key
php artisan vendor:publish --tag=nativephp-plugins-provider
composer require nativecodeforge/nativephp-timepicker
php artisan native:plugin:register nativecodeforge/nativephp-timepicker
```

---

# FilePicker

> noehassiel

<div class="plugin-info"><div class="pi-meta"><span class="pi-item"><span class="pi-label">Author</span><span class="pi-value">noehassiel</span></span><span class="pi-item"><span class="pi-label">Plugin Type</span><span class="pi-badge pi-badge-community">Community Plugin</span></span><span class="pi-item"><span class="pi-label">Price</span><span class="pi-badge pi-badge-paid">$49</span></span><span class="pi-item"><span class="pi-label">Version</span><span class="pi-value">v0.2.2</span></span><span class="pi-item"><span class="pi-label">License</span><span class="pi-value">MIT</span></span></div><div class="pi-compat"><span class="pi-chip"><span class="pi-chip-label">NativePHP</span><span class="pi-chip-value">^4.0</span></span><span class="pi-chip"><span class="pi-chip-label">iOS</span><span class="pi-chip-value">16.0+</span></span><span class="pi-chip"><span class="pi-chip-label">Android</span><span class="pi-chip-value">26+</span></span></div><div class="pi-links"><a href="https://nativephp.com/plugins/noehassiel/filepicker" class="pi-link pi-link-buy" target="_blank" rel="noopener">Buy on NativePHP →</a></div></div>

# FilePicker

Native document picker for NativePHP Mobile — select one or many files of any type using iOS UIDocumentPicker or the Android Storage Access Framework. Files are automatically copied to app-local storage so no runtime permission management is needed.

## Features

- **Multi-select and single-file modes**
- **File type filtering** — UTIs on iOS, MIME types on Android
- **Automatic file copy** to app-local storage (no permission complexity)
- **Camera capture** — capture directly from the picker on iOS
- **Photo library access** on iOS
- **No runtime permissions** required
- **Event-based delivery** — files arrive via native events
- **JavaScript / Inertia** integration

## Installation

```bash
composer config repositories.nativephp-plugins composer https://plugins.nativephp.com
composer config http-basic.plugins.nativephp.com your@email.com your-license-key
php artisan vendor:publish --tag=nativephp-plugins-provider
composer require noehassiel/filepicker
php artisan native:plugin:register noehassiel/filepicker
```

---

# NSFW Content Checker

> Cody P Christian

<div class="plugin-info"><div class="pi-meta"><span class="pi-item"><span class="pi-label">Author</span><span class="pi-value">Cody P Christian</span></span><span class="pi-item"><span class="pi-label">Plugin Type</span><span class="pi-badge pi-badge-community">Community Plugin</span></span><span class="pi-item"><span class="pi-label">Price</span><span class="pi-badge pi-badge-paid">$49</span></span><span class="pi-item"><span class="pi-label">Version</span><span class="pi-value">v0.1.2</span></span><span class="pi-item"><span class="pi-label">License</span><span class="pi-value">Proprietary</span></span></div><div class="pi-compat"><span class="pi-chip"><span class="pi-chip-label">NativePHP</span><span class="pi-chip-value">^4.0</span></span><span class="pi-chip"><span class="pi-chip-label">iOS</span><span class="pi-chip-value">17.0+</span></span><span class="pi-chip"><span class="pi-chip-label">Android</span><span class="pi-chip-value">24+</span></span></div><div class="pi-links"><a href="https://nativephp.com/plugins/codypchristian/nativephp-nsfw-checker" class="pi-link pi-link-buy" target="_blank" rel="noopener">Buy on NativePHP →</a></div></div>

# NSFW Content Checker

On-device sensitive image detection for NativePHP Mobile — no data leaves the device, no API calls required. iOS uses Apple's SensitiveContentAnalysis framework; Android uses ML Kit image labeling as a preliminary screening mechanism.

## Features

- **On-device only** — fully private, zero cloud transmission
- **Platform-specific backends** — Apple's nudity classifier (iOS) and ML Kit heuristics (Android)
- **Availability detection** — distinguishes unavailable analyzers from actual results
- **Configurable defaults** for when analysis cannot execute
- **Comprehensive error handling** with specific exception types

## Installation

```bash
composer require codypchristian/nativephp-nsfw-checker
php artisan vendor:publish --tag=nativephp-plugins-provider
php artisan native:plugin:register codypchristian/nativephp-nsfw-checker
php artisan native:install --force
```

---

# Google Mobile Ads

> Bhargav Detroja

<div class="plugin-info"><div class="pi-meta"><span class="pi-item"><span class="pi-label">Author</span><span class="pi-value">Bhargav Detroja</span></span><span class="pi-item"><span class="pi-label">Plugin Type</span><span class="pi-badge pi-badge-community">Community Plugin</span></span><span class="pi-item"><span class="pi-label">Price</span><span class="pi-badge pi-badge-free">Free</span></span><span class="pi-item"><span class="pi-label">Version</span><span class="pi-value">v1.2.0</span></span><span class="pi-item"><span class="pi-label">License</span><span class="pi-value">MIT</span></span></div><div class="pi-compat"><span class="pi-chip"><span class="pi-chip-label">NativePHP</span><span class="pi-chip-value">3+</span></span><span class="pi-chip"><span class="pi-chip-label">PHP</span><span class="pi-chip-value">8.2+</span></span><span class="pi-chip"><span class="pi-chip-label">Laravel</span><span class="pi-chip-value">12+</span></span></div><div class="pi-links"><a href="https://github.com/BhargavDetroja/google-mobile-ads" class="pi-link" target="_blank" rel="noopener">GitHub →</a></div></div>

Add **Google AdMob** ads to your [NativePHP Mobile](https://nativephp.com) app in minutes. No Kotlin, no Swift, no Gradle edits.

Works with **any frontend** — Livewire, React, Vue, Alpine.js, or plain JavaScript.

Supports **Banner**, **Interstitial**, **Rewarded**, **Rewarded Interstitial**, and **App Open** on Android and iOS.

---

## Requirements

- PHP 8.2+
- Laravel 12+
- NativePHP Mobile 3.x or 4.x
- An [AdMob account](https://admob.google.com) (free)

> **NativePHP Mobile v4:** this plugin works unchanged under v4's web view — the bridge functions, events, and Blade `<x-google-ads::banner>` component all keep working exactly as they do on v3. SuperNative-native `NativeComponent` screens are not required to use this plugin.

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
onAdEvent('NativePHP\GoogleMobileAds\Events\AdFailedToLoad', ({ adType, errorMessage }) => {
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

---

# Mobile Splashscreen

> Israel Pereira

<div class="plugin-info"><div class="pi-meta"><span class="pi-item"><span class="pi-label">Author</span><span class="pi-value">Israel Pereira</span></span><span class="pi-item"><span class="pi-label">Plugin Type</span><span class="pi-badge pi-badge-community">Community Plugin</span></span><span class="pi-item"><span class="pi-label">Price</span><span class="pi-badge pi-badge-free">Free</span></span><span class="pi-item"><span class="pi-label">Version</span><span class="pi-value">v1.4.0</span></span><span class="pi-item"><span class="pi-label">License</span><span class="pi-value">MIT</span></span></div><div class="pi-compat"><span class="pi-chip"><span class="pi-chip-label">NativePHP</span><span class="pi-chip-value">^3.0</span></span><span class="pi-chip"><span class="pi-chip-label">iOS</span><span class="pi-chip-value">18.0+</span></span><span class="pi-chip"><span class="pi-chip-label">Android</span><span class="pi-chip-value">26+</span></span><span class="pi-chip"><span class="pi-chip-label">PHP</span><span class="pi-chip-value">8.2+</span></span></div><div class="pi-links"><a href="https://github.com/S2BR/nativephp-mobile-splashscreen" class="pi-link" target="_blank" rel="noopener">GitHub →</a></div></div>

A feature-rich NativePHP plugin for animated mobile splash screens. Supports Lottie animations, gradient backgrounds, dark mode, seasonal scheduling, exit transitions, app icon overlay, and NativePHP event dispatching — all driven by a single config file and `.env` variables.

## Gallery

### Splashscreen with a lottie animation
https://github.com/user-attachments/assets/b30b7ef2-81f0-46df-979f-95ec5192c495

### Splashscreen with text and icon
https://github.com/user-attachments/assets/aca02bf1-6fde-4ad5-94bf-df900693b555

---

## Requirements

- PHP 8.2+
- `ext-zip` (for automatic dotLottie v2→v1 conversion)
- NativePHP Mobile 3.0+
- Lottie 4.6.0+ (iOS — the `lottie-spm` SPM package, declared automatically via `nativephp.json`)
- Lottie Compose 6.7.1+ (Android — declared automatically via `nativephp.json`)

---

## Installation

```bash
composer require s2br/nativephp-mobile-splashscreen
```

Publish the config:

```bash
php artisan vendor:publish --tag=mobile-splashscreen-config
```

Register the plugin so its native code gets compiled into your app. For security, NativePHP requires plugins to be explicitly registered — use the built-in command (recommended):

```bash
# Publish the NativeServiceProvider if you haven't already
php artisan vendor:publish --tag=nativephp-plugins-provider

# Register this plugin (pass the Composer package name)
php artisan native:plugin:register s2br/nativephp-mobile-splashscreen
```

Verify it was picked up:

```bash
php artisan native:plugin:list
```

> **Prefer to do it by hand?** The command simply adds the plugin to the `plugins()` method in `app/Providers/NativeServiceProvider.php`. You can edit that file directly instead:
>
> ```php
> use S2BR\MobileSplashscreen\MobileSplashscreenServiceProvider;
>
> public function plugins(): array
> {
>     return [
>         MobileSplashscreenServiceProvider::class,
>     ];
> }
> ```

Configure in `.env`:

```env
MOBILE_SPLASHSCREEN_ANIMATION_PATH="resources/animations/splash.lottie"
MOBILE_SPLASHSCREEN_BG_TYPE=gradient
MOBILE_SPLASHSCREEN_GRADIENT_COLORS="#079F3D,#046B28"
MOBILE_SPLASHSCREEN_SIZE=0.8
MOBILE_SPLASHSCREEN_LOOP=false
```

> **Tip:** Place your `.lottie` files in `resources/animations/` — this is the conventional location and is correctly resolved via `base_path()` at build time.

---

## Enabling / Disabling

The splash screen is on by default. To turn it off entirely:

```env
MOBILE_SPLASHSCREEN_ENABLED=false
```

When disabled, this plugin injects nothing — the app falls back to **NativePHP's default splash handling** (no animation, background, progress bar, or transitions from this package). Rebuild for the change to take effect.

> The OS always shows its own native launch screen for a moment at cold start (iOS `LaunchScreen.storyboard`, Android's themed window) — that can't be removed. If you set `launch_color`, it is still applied to that screen even when the splash is disabled, so it can match your brand:
>
> ```env
> MOBILE_SPLASHSCREEN_LAUNCH_COLOR="#079F3D"
> ```

---

## Bundled Example Animations

To help you get started, this package ships with **8 ready-to-use Lottie animations**. They live in the package's `resources/animations/` directory and can be published straight into your app:

```bash
php artisan vendor:publish --tag=mobile-splashscreen-examples
```

This copies all 8 `.lottie` files into your app's `resources/animations/` directory — exactly where `MOBILE_SPLASHSCREEN_ANIMATION_PATH` expects them. Point your config at any one of them:

```env
MOBILE_SPLASHSCREEN_ANIMATION_PATH="resources/animations/animation4.lottie"
```

## How It Works

The plugin hooks into NativePHP's build pipeline at two stages:

1. **`copy_assets`** — Copies your `.lottie` files to the native project. If a file is in **dotLottie v2** format (the default LottieFiles Creator export), it automatically converts it to **v1** for `lottie-spm` compatibility on iOS. Also copies scheduled and dark-mode animations if configured.

2. **`pre_compile`** — Generates platform-specific splash screen code:
   - iOS: Replaces `SplashView.swift` with generated SwiftUI.
   - Android: Replaces the `SplashScreen()` composable in `MainActivity.kt`.
   - Updates `LaunchScreen.storyboard` (iOS) and `themes.xml` (Android) to match the background color.

Everything is config-driven. Re-running the build picks up any change.

---

## Configuration Reference

All options can be set via `.env` or `config/mobile-splashscreen.php`.

### Content Type

```env
MOBILE_SPLASHSCREEN_CONTENT=animation   # animation | text
```

---

### Animation

| ENV variable | Default | Description |
|---|---|---|
| `MOBILE_SPLASHSCREEN_ANIMATION_PATH` | `null` | Relative path to `.lottie` file (from project root) |
| `MOBILE_SPLASHSCREEN_LOOP` | `true` | `true` = loop forever, `false` = play once |
| `MOBILE_SPLASHSCREEN_SIZE` | `0.8` | Width as fraction of screen width (0.1–1.0) |
| `MOBILE_SPLASHSCREEN_POSITION` | `center` | `center` / `top` / `bottom` |

---

### Background

| ENV variable | Default | Description |
|---|---|---|
| `MOBILE_SPLASHSCREEN_BG_TYPE` | `color` | `color` or `gradient` |
| `MOBILE_SPLASHSCREEN_BG_COLOR` | `#FFFFFF` | Hex color for solid backgrounds |
| `MOBILE_SPLASHSCREEN_GRADIENT_COLORS` | `#079F3D,#046B28` | Comma-separated hex colors (min 2) |
| `MOBILE_SPLASHSCREEN_GRADIENT_DIRECTION` | `vertical` | `vertical` / `horizontal` / `diagonal` |

> When using a gradient, the first color is also applied to `LaunchScreen.storyboard` (iOS) and `themes.xml` (Android) so the OS-level launch matches your animation background.

---

### Text (when `content = text`)

| ENV variable | Default | Description |
|---|---|---|
| `MOBILE_SPLASHSCREEN_TEXT` | `''` | The text to display |
| `MOBILE_SPLASHSCREEN_TEXT_COLOR` | `#FFFFFF` | Text color (hex) |
| `MOBILE_SPLASHSCREEN_TEXT_SIZE` | `32` | Font size in points/sp |
| `MOBILE_SPLASHSCREEN_TEXT_WEIGHT` | `bold` | `thin` / `light` / `regular` / `medium` / `semibold` / `bold` / `heavy` / `black` |

---

### App Icon Overlay

Displays the app icon alongside the animation or text.

| ENV variable | Default | Description |
|---|---|---|
| `MOBILE_SPLASHSCREEN_SHOW_ICON` | `false` | Show the icon |
| `MOBILE_SPLASHSCREEN_ICON_SIZE` | `0.2` | Width as fraction of screen width (0.1–0.5) |
| `MOBILE_SPLASHSCREEN_ICON_POSITION` | `bottom` | `top` or `bottom` relative to main content |
| `MOBILE_SPLASHSCREEN_ICON_RADIUS` | `0.22` | Corner radius as fraction of icon width (0.0–0.5, where 0.5 = circle) |

iOS uses `UIImage(named: "AppIcon")` from the asset catalog. Android uses `R.mipmap.ic_launcher`.

---

### Timing

All values in milliseconds.

| ENV variable | Default | Description |
|---|---|---|
| `MOBILE_SPLASHSCREEN_DELAY_BEFORE` | `0` | Wait before the splash fades in |
| `MOBILE_SPLASHSCREEN_FADE_IN` | `600` | Fade-in duration |
| `MOBILE_SPLASHSCREEN_DELAY_AFTER` | `0` | Hold after single-run animation ends (no transition) |

---

### Events

| ENV variable | Default | Description |
|---|---|---|
| `MOBILE_SPLASHSCREEN_EVENT_COMPLETE` | `true` | Dispatch `SplashscreenCompleted` when a single-run animation ends |
| `MOBILE_SPLASHSCREEN_EVENT_LOOP` | `false` | Dispatch `SplashscreenLoopCompleted` after each loop iteration |

---

### Launch Color

The OS renders `LaunchScreen.storyboard` (iOS) and `themes.xml` (Android) **before** the app process starts — typically for 100–300 ms. This color is baked into the binary at compile time and cannot be changed at runtime.

| ENV variable | Default | Description |
|---|---|---|
| `MOBILE_SPLASHSCREEN_LAUNCH_COLOR` | `null` | Solid hex color for the OS-level launch screen. When `null`, defaults to the first background/gradient color. |

> **Tip:** Use this when your animation background varies at runtime (e.g. seasonal schedule) and you want the OS launch color to stay consistent instead of matching whichever animation is currently active.

```env
MOBILE_SPLASHSCREEN_LAUNCH_COLOR="#18181B"
```

---

### Progress Bar

Displays a subtle loading indicator while a single-run animation (`loop = false`) has finished but the app is still loading. It fills asymptotically toward ~88%, then completes to 100% the moment the app is ready. For looping animations this option has no effect.

| ENV variable | Default | Description |
|---|---|---|
| `MOBILE_SPLASHSCREEN_PROGRESS_BAR` | `false` | Show the progress bar |
| `MOBILE_SPLASHSCREEN_PROGRESS_BAR_COLOR` | `#FFFFFF` | Bar color (track at 15% opacity, fill at 60% opacity) |
| `MOBILE_SPLASHSCREEN_PROGRESS_BAR_DIRECTION` | `ltr` | Fill direction: `ltr` fills left→right, `rtl` fills right→left |

The bar is centered, takes ~50% of the screen width, is 3dp/pt tall with rounded ends, and exits as part of the splash transition — for `circle_expand` it gets swept away by the expanding circle; for fade/slide/scale it exits with everything else.

Use `rtl` for right-to-left locales (Arabic, Hebrew, etc.) so the fill progresses in the same direction as the reading flow.

`MOBILE_SPLASHSCREEN_PROGRESS_BAR` sets the **default** — it can always be overridden per entry in the dynamic or static schedule using `"progress_bar": true/false`. The same applies to `progress_bar_color` and `progress_bar_direction`.

```env
MOBILE_SPLASHSCREEN_LOOP=false
MOBILE_SPLASHSCREEN_PROGRESS_BAR=false
MOBILE_SPLASHSCREEN_PROGRESS_BAR_COLOR="#FFFFFF"
MOBILE_SPLASHSCREEN_PROGRESS_BAR_DIRECTION=ltr
```

---

### Transition Out

The exit animation played within the SplashView **before** the completion event is dispatched. Works with both `loop = false` (single-run) and `loop = true` — in loop mode the transition fires as soon as the WebView is ready, regardless of where in the loop the animation is.

| ENV variable | Default | Options |
|---|---|---|
| `MOBILE_SPLASHSCREEN_TRANSITION_OUT` | `none` | `none` / `fade` / `scale_up` / `scale_down` / `slide_up` / `slide_down` / `circle_expand` |
| `MOBILE_SPLASHSCREEN_TRANSITION_DURATION` | `400` | Duration in milliseconds |
| `MOBILE_SPLASHSCREEN_TRANSITION_ORIGIN` | `center` | `circle_expand` start point: `center` / `top` / `bottom` / `top_left` / `top_right` / `bottom_left` / `bottom_right` / `center_left` / `center_right` |

**`circle_expand`** punches a transparent hole through the splash layer, revealing the WebView behind it — not a colored overlay. The hole expands from the chosen origin point until it covers the entire screen.

**Example — circle reveal from center:**
```env
MOBILE_SPLASHSCREEN_LOOP=false
MOBILE_SPLASHSCREEN_TRANSITION_OUT=circle_expand
MOBILE_SPLASHSCREEN_TRANSITION_DURATION=500
MOBILE_SPLASHSCREEN_TRANSITION_ORIGIN=center
```

**Example — reveal from the left edge (loop mode):**
```env
MOBILE_SPLASHSCREEN_LOOP=true
MOBILE_SPLASHSCREEN_TRANSITION_OUT=circle_expand
MOBILE_SPLASHSCREEN_TRANSITION_DURATION=600
MOBILE_SPLASHSCREEN_TRANSITION_ORIGIN=center_left
```

---

### Theme (Dark Mode)

Controls how the splash responds to the system dark/light mode.

| ENV variable | Default | Description |
|---|---|---|
| `MOBILE_SPLASHSCREEN_THEME` | `auto` | `auto` = follow system, `light` = always light, `dark` = always dark |
| `MOBILE_SPLASHSCREEN_DARK_ANIMATION_PATH` | `null` | Alternative `.lottie` file for dark mode |
| `MOBILE_SPLASHSCREEN_DARK_BG_TYPE` | `null` | Set to `color` or `gradient` to activate dark background |
| `MOBILE_SPLASHSCREEN_DARK_BG_COLOR` | `#000000` | Dark mode solid background color |
| `MOBILE_SPLASHSCREEN_DARK_GRADIENT_COLORS` | `#000000,#1A1A1A` | Dark mode gradient colors |
| `MOBILE_SPLASHSCREEN_DARK_GRADIENT_DIRECTION` | `vertical` | Dark mode gradient direction |

**Example — dark background with a separate animation:**
```env
MOBILE_SPLASHSCREEN_THEME=auto
MOBILE_SPLASHSCREEN_DARK_BG_TYPE=gradient
MOBILE_SPLASHSCREEN_DARK_GRADIENT_COLORS="#0D0D0D,#1A1A1A"
MOBILE_SPLASHSCREEN_DARK_ANIMATION_PATH="resources/animations/splash_dark.lottie"
```

When `theme = auto`, iOS uses `@Environment(\.colorScheme)` and Android uses `isSystemInDarkTheme()`. The detection happens at runtime — no rebuild needed when the user toggles dark mode.

---

### Schedule (Build-time / Static Date Animations)

Bake a static schedule into the binary at build time. Animation files are bundled and switching is evaluated on-device — no rebuild when the date changes, but adding new entries requires a rebuild.

```env
MOBILE_SPLASHSCREEN_SCHEDULE="resources/splash-schedule.json"
```

**Schedule JSON format:**

```json
{
  "schedule": [
    {
      "name": "christmas",
      "from": "12-24",
      "to": "12-26",
      "animation": "resources/animations/christmas.lottie",
      "background": {
        "type": "gradient",
        "colors": ["#1B4F72", "#154360"],
        "direction": "vertical"
      }
    },
    {
      "name": "new_year",
      "from": "12-31",
      "to": "01-02",
      "animation": "resources/animations/fireworks.lottie"
    },
    {
      "name": "christmas_2026_special",
      "from": "2026-12-24",
      "to": "2026-12-26",
      "animation": "resources/animations/christmas_anniversary.lottie"
    }
  ]
}
```

**Date format — two styles, mix freely:**

| Format | Example | Behavior |
|---|---|---|
| `MM-DD` | `"12-24"` | **Recurs every year** on that month/day. Use this for seasons. |
| `YYYY-MM-DD` | `"2026-12-24"` | Matches **only that specific year**. Use for one-off dated events. |

- Ranges that span the year boundary (e.g. `12-31` → `01-02`) are handled correctly in both formats.
- **Precedence:** when a full-date entry and a recurring entry both match today, the **full date wins** — so the `christmas_2026_special` entry above replaces the recurring `christmas` animation in 2026 only, then it reverts automatically.
- Every per-entry property listed in the dynamic schedule table (`loop`, `size`, `transition_out`, `background`, etc.) works here too. The entries are embedded in the binary as JSON and resolved on-device at launch — same mechanism, just baked in at build time instead of downloaded.
- All referenced animation files are automatically deployed at build time.

**Priority at runtime:** dynamic schedule-local → build-time schedule entry → dark mode override → default. Within a schedule, a full-date match beats a recurring `MM-DD` match.

---

### Dynamic Remote Schedule

For animations that can be updated without a new app release. The sync command fetches your remote schedule, pre-downloads `.lottie` files for every entry active within a configurable lookahead window, and writes `schedule-local.json` to device storage. Native code reads this file on every app launch and resolves today's active entry on-device — **no network call is needed at launch, and the correct animation plays even when the device is offline**.

**How it works:**

1. Your server exposes a JSON schedule at a URL.
2. A daily Laravel scheduler runs the sync command while the device has internet.
3. The command pre-downloads animation files for the next N days (default 30).
4. At launch the app reads the local schedule and picks the entry matching today's date.
5. If no entry matches, the static build-time animation plays instead.
6. Stale animation files (past their end date and no longer in the schedule) are automatically deleted.

**Step 1 — Define your remote schedule JSON:**

```json
{
  "schedule": [
    {
      "name": "christmas",
      "date": { "from": "2026-12-24", "to": "2026-12-26" },
      "url": "https://your-cdn.com/animations/christmas.lottie",
      "background": {
        "type": "gradient",
        "colors": ["#1B4F72", "#154360"]
      }
    },
    {
      "name": "new_year",
      "date": { "from": "2026-12-31", "to": "2027-01-02" },
      "url": "https://your-cdn.com/animations/new_year.lottie",
      "background": {
        "type": "color",
        "color": "#0D0D0D"
      }
    }
  ]
}
```

| Field | Description |
|---|---|
| `date.from` / `date.to` | Date range. Use `YYYY-MM-DD` for a specific year, or `MM-DD` to recur every year. Year-boundary ranges work correctly; a full-date match takes precedence over a recurring `MM-DD` match. |
| `url` | URL to download the `.lottie` file from. |
| `background` | Optional. `type: "gradient"` with a `colors` array, or `type: "color"` with a `color` hex. Overrides the build-time background for this entry. |
| `loop` | Optional boolean. Overrides `MOBILE_SPLASHSCREEN_LOOP` for this entry. |
| `size` | Optional float (0.1–1.0). Overrides `MOBILE_SPLASHSCREEN_SIZE`. |
| `position` | Optional string (`center` / `top` / `bottom`). Overrides `MOBILE_SPLASHSCREEN_POSITION`. |
| `transition_out` | Optional string (`none` / `fade` / `scale_up` / `scale_down` / `slide_up` / `slide_down` / `circle_expand`). |
| `transition_duration` | Optional integer (ms). Overrides `MOBILE_SPLASHSCREEN_TRANSITION_DURATION`. |
| `transition_origin` | Optional string. Overrides `MOBILE_SPLASHSCREEN_TRANSITION_ORIGIN` for `circle_expand`. |
| `delay_before` | Optional integer (ms). Overrides `MOBILE_SPLASHSCREEN_DELAY_BEFORE`. |
| `fade_in` | Optional integer (ms). Overrides `MOBILE_SPLASHSCREEN_FADE_IN`. |
| `delay_after` | Optional integer (ms). Overrides `MOBILE_SPLASHSCREEN_DELAY_AFTER`. |
| `on_complete` | Optional boolean. Overrides `MOBILE_SPLASHSCREEN_EVENT_COMPLETE`. |
| `on_loop` | Optional boolean. Overrides `MOBILE_SPLASHSCREEN_EVENT_LOOP`. |
| `show_icon` | Optional boolean. Overrides `MOBILE_SPLASHSCREEN_SHOW_ICON`. |
| `icon_size` | Optional float (0.1–0.5). Overrides `MOBILE_SPLASHSCREEN_ICON_SIZE`. |
| `icon_position` | Optional string (`top` / `bottom`). Overrides `MOBILE_SPLASHSCREEN_ICON_POSITION`. |
| `icon_radius` | Optional float (0.0–0.5). Overrides `MOBILE_SPLASHSCREEN_ICON_RADIUS`. |
| `progress_bar` | Optional boolean. Show or hide the progress bar for this entry. Overrides `MOBILE_SPLASHSCREEN_PROGRESS_BAR`. |
| `progress_bar_color` | Optional hex string. Overrides `MOBILE_SPLASHSCREEN_PROGRESS_BAR_COLOR` for this entry. |
| `progress_bar_direction` | Optional string (`ltr` / `rtl`). Overrides `MOBILE_SPLASHSCREEN_PROGRESS_BAR_DIRECTION` for this entry. |

Every property is optional — omit any field to inherit the build-time value from your `.env`/config. This means a minimal entry only needs `date`, `url`, and the properties that differ from your defaults.

**Full example — entry with all overrides:**

```json
{
  "schedule": [
    {
      "name": "christmas",
      "date": { "from": "2026-12-24", "to": "2026-12-26" },
      "url": "https://your-cdn.com/animations/christmas.lottie",
      "background": {
        "type": "gradient",
        "colors": ["#1B4F72", "#154360"]
      },
      "loop": true,
      "size": 0.9,
      "position": "center",
      "transition_out": "circle_expand",
      "transition_duration": 600,
      "transition_origin": "center",
      "delay_before": 0,
      "fade_in": 800,
      "delay_after": 0,
      "on_complete": false,
      "on_loop": true,
      "show_icon": true,
      "icon_size": 0.15,
      "icon_position": "bottom",
      "icon_radius": 0.22,
      "progress_bar": true,
      "progress_bar_color": "#FFFFFF",
      "progress_bar_direction": "ltr"
    }
  ]
}
```

**Step 2 — Run the sync command:**

```bash
# Fetch schedule + pre-download animations active within the next 30 days (default)
php artisan nativephp:mobile-splashscreen:sync --url=https://your-cdn.com/animations.json

# Extend the lookahead window (e.g. 60 days, useful before a long offline period)
php artisan nativephp:mobile-splashscreen:sync --url=https://your-cdn.com/animations.json --days=60

# Re-resolve from an already-downloaded animations.json (no re-fetch)
php artisan nativephp:mobile-splashscreen:sync
```

**Step 3 — Schedule it to run daily:**

```php
// routes/console.php
Schedule::command('nativephp:mobile-splashscreen:sync --url=https://your-cdn.com/animations.json')
    ->daily();
```

**Or use the fluent PHP API directly:**

```php
use S2BR\MobileSplashscreen\Facades\MobileSplashscreen;

MobileSplashscreen::syncFromUrl('https://your-cdn.com/animations.json')
                 ->resolveActive(daysAhead: 30);
```

**Other helpers:**

```php
MobileSplashscreen::hasActive();   // true if schedule-local.json exists
MobileSplashscreen::clearActive(); // remove schedule-local.json (reverts to default)
```

**Files written to `storage/app/splashscreen/`:**

| File | Description |
|---|---|
| `animations.json` | Full schedule downloaded from your server |
| `animations/` | Pre-downloaded `.lottie` files (stale files auto-deleted on each sync) |
| `schedule-local.json` | Normalised upcoming entries with local file paths — read by native code at launch |

The bundled default animation (from `.env`) always serves as fallback if `schedule-local.json` does not exist or no entry matches today's date.

---

## Events

### SplashscreenCompleted

Dispatched when a single-run animation (`loop = false`) finishes, after any `transition_out` animation completes.

Payload: `animationName` (string), `duration` (float, reserved — currently always `0.0`).

### SplashscreenLoopCompleted

Dispatched after each loop iteration when `loop = true` and `events.on_loop = true`.

Payload: `animationName` (string), `iteration` (int, starts at 1).

---

## Listening for Events

### Livewire

```php
use Livewire\Attributes\On;
use S2BR\MobileSplashscreen\Events\SplashscreenCompleted;
use S2BR\MobileSplashscreen\Events\SplashscreenLoopCompleted;

#[On('native:'.SplashscreenCompleted::class)]
public function onSplashDone(string $animationName, float $duration): void
{
    // Dispatched after the splash exits (including any transition_out animation)
}

#[On('native:'.SplashscreenLoopCompleted::class)]
public function onSplashLoop(int $iteration, string $animationName): void
{
    if ($iteration >= 3) {
        // After 3 loops, do something in your app
    }
}
```

### React

```javascript
import { useEffect } from 'react';
import { SplashscreenCompleted } from '@/nativephp/events';

useEffect(() => {
    const handler = (event) => {
        const { animationName, duration } = event.detail;
        console.log('Splash done', animationName);
    };

    window.addEventListener('native:S2BR\MobileSplashscreen\Events\SplashscreenCompleted', handler);

    return () => {
        window.removeEventListener('native:S2BR\MobileSplashscreen\Events\SplashscreenCompleted', handler);
    };
}, []);
```

### Vue

```javascript
import { onMounted, onUnmounted } from 'vue';

function onSplashDone(event) {
    const { animationName } = event.detail;
    console.log('Splash done', animationName);
}

onMounted(() => {
    window.addEventListener('native:S2BR\MobileSplashscreen\Events\SplashscreenCompleted', onSplashDone);
});

onUnmounted(() => {
    window.removeEventListener('native:S2BR\MobileSplashscreen\Events\SplashscreenCompleted', onSplashDone);
});
```

> **Note:** Events are dispatched via the NativePHP JS bridge after the WebView is ready. They arrive **after** the splash has signalled completion, not while it is still visible. NativePHP handles the actual dismissal of the splash view when the WebView finishes loading.

---

## Usage Examples

### Minimal — gradient background, looping animation

```env
MOBILE_SPLASHSCREEN_ANIMATION_PATH="resources/animations/splash.lottie"
MOBILE_SPLASHSCREEN_BG_TYPE=gradient
MOBILE_SPLASHSCREEN_GRADIENT_COLORS="#079F3D,#046B28"
MOBILE_SPLASHSCREEN_SIZE=0.8
```

### Play once with a progress bar while loading

```env
MOBILE_SPLASHSCREEN_ANIMATION_PATH="resources/animations/intro.lottie"
MOBILE_SPLASHSCREEN_LOOP=false
MOBILE_SPLASHSCREEN_PROGRESS_BAR=true
MOBILE_SPLASHSCREEN_PROGRESS_BAR_COLOR="#FFFFFF"
MOBILE_SPLASHSCREEN_TRANSITION_OUT=circle_expand
MOBILE_SPLASHSCREEN_TRANSITION_ORIGIN=center_left
```

### Play once with a fade-out transition

```env
MOBILE_SPLASHSCREEN_ANIMATION_PATH="resources/animations/intro.lottie"
MOBILE_SPLASHSCREEN_LOOP=false
MOBILE_SPLASHSCREEN_TRANSITION_OUT=fade
MOBILE_SPLASHSCREEN_TRANSITION_DURATION=400
MOBILE_SPLASHSCREEN_EVENT_COMPLETE=true
```

### Loop with a circle-expand reveal

```env
MOBILE_SPLASHSCREEN_ANIMATION_PATH="resources/animations/splash.lottie"
MOBILE_SPLASHSCREEN_LOOP=true
MOBILE_SPLASHSCREEN_TRANSITION_OUT=circle_expand
MOBILE_SPLASHSCREEN_TRANSITION_DURATION=500
MOBILE_SPLASHSCREEN_TRANSITION_ORIGIN=center
```

### Dark mode support

```env
MOBILE_SPLASHSCREEN_THEME=auto
MOBILE_SPLASHSCREEN_BG_TYPE=gradient
MOBILE_SPLASHSCREEN_GRADIENT_COLORS="#079F3D,#046B28"
MOBILE_SPLASHSCREEN_DARK_BG_TYPE=gradient
MOBILE_SPLASHSCREEN_DARK_GRADIENT_COLORS="#0D0D0D,#1A1A1A"
```

### Seasonal schedule

```env
MOBILE_SPLASHSCREEN_SCHEDULE="resources/splash-schedule.json"
```

### Text-only splash

```env
MOBILE_SPLASHSCREEN_CONTENT=text
MOBILE_SPLASHSCREEN_TEXT="Loading..."
MOBILE_SPLASHSCREEN_TEXT_COLOR="#FFFFFF"
MOBILE_SPLASHSCREEN_TEXT_WEIGHT=light
MOBILE_SPLASHSCREEN_BG_COLOR="#1A1A2E"
```

### Animation with icon below

```env
MOBILE_SPLASHSCREEN_ANIMATION_PATH="resources/animations/splash.lottie"
MOBILE_SPLASHSCREEN_BG_TYPE=gradient
MOBILE_SPLASHSCREEN_GRADIENT_COLORS="#079F3D,#046B28"
MOBILE_SPLASHSCREEN_SHOW_ICON=true
MOBILE_SPLASHSCREEN_ICON_POSITION=bottom
MOBILE_SPLASHSCREEN_ICON_RADIUS=0.22
```

---

## dotLottie Format Notes

| Scenario | Behavior |
|---|---|
| v1 file | Copied as-is to the native bundle |
| v2 file (LottieFiles Creator default) | Auto-converted to v1 during `copy_assets` |
| Conversion strips | `fonts`, layer effects (`ef`), `hasMask`, text layers (`ty=5`), `Background` layer |

**Why this matters:** `lottie-spm` 4.6.0 (the iOS Lottie renderer this plugin declares in `nativephp.json`) only supports dotLottie v1. A v2 file silently fails — blank screen, no error. The conversion happens automatically; no manual script is needed.

To verify your file format:
```bash
unzip -l your-animation.lottie
# v1: shows animations/main.json
# v2: shows a/Main Scene.json
```

**Text layers:** `ty=5` text layers are stripped during conversion because `lottie-spm` crashes when a referenced font is not embedded. Vectorize text in LottieFiles Creator before exporting.

---

## Programmatic Config Access

```php
use S2BR\MobileSplashscreen\Facades\MobileSplashscreen;

$size = MobileSplashscreen::config('animation.size');
$bgType = MobileSplashscreen::config('background.type');

$errors = MobileSplashscreen::validate();
```

---

## Troubleshooting

### Animation not showing on iOS (blank screen)

Check the build output for:
```
Detected dotLottie v2 — converting to v1 for lottie-spm...
```

If absent, verify `animation.path` is set and the file exists. Also make sure you don't declare a Lottie iOS SPM dependency in your own `nativephp.json` — this plugin already declares `lottie-spm`, and a second Lottie package causes a product naming conflict.

### Gradient colors from ENV not parsing

Ensure no spaces around commas:
```env
# Correct
MOBILE_SPLASHSCREEN_GRADIENT_COLORS="#079F3D,#046B28"

# Wrong
MOBILE_SPLASHSCREEN_GRADIENT_COLORS="#079F3D, #046B28"
```

### SplashView.swift not updating

The plugin replaces `SplashView.swift` entirely during `pre_compile`. Manual edits are overwritten. All customization must go through the config file.

### Schedule animations not deploying

Ensure the schedule JSON path is correct and all referenced `.lottie` files exist at build time. The `copy_assets` hook reads the schedule and deploys all referenced animations.

### Dynamic schedule not showing on device

1. Confirm `schedule-local.json` exists in `storage/app/splashscreen/` on the device.
2. Check that the entry's `from`/`to` dates include today in `YYYY-MM-DD` format.
3. Verify the `.lottie` file was downloaded to `storage/app/splashscreen/animations/` — check the sync command output.
4. If the sync command ran before the entry's start date, ensure the lookahead window (`--days`) was large enough to include it.

### Build hook not running

Ensure the plugin is registered. Run `php artisan native:plugin:list` — if it isn't listed, register it with:
```bash
php artisan native:plugin:register s2br/nativephp-mobile-splashscreen
```
This adds the plugin to the `plugins()` method in `app/Providers/NativeServiceProvider.php` (which you can also edit by hand):
```php
public function plugins(): array
{
    return [
        \S2BR\MobileSplashscreen\MobileSplashscreenServiceProvider::class,
    ];
}
```

---

---

# Mobile Locales

> Developernauts

<div class="plugin-info"><div class="pi-meta"><span class="pi-item"><span class="pi-label">Author</span><span class="pi-value">Developernauts</span></span><span class="pi-item"><span class="pi-label">Plugin Type</span><span class="pi-badge pi-badge-community">Community Plugin</span></span><span class="pi-item"><span class="pi-label">Price</span><span class="pi-badge pi-badge-free">Free</span></span><span class="pi-item"><span class="pi-label">Version</span><span class="pi-value">v1.0.2</span></span><span class="pi-item"><span class="pi-label">License</span><span class="pi-value">MIT</span></span></div><div class="pi-compat"><span class="pi-chip"><span class="pi-chip-label">NativePHP</span><span class="pi-chip-value">v3</span></span><span class="pi-chip"><span class="pi-chip-label">iOS</span><span class="pi-chip-value">14.0+</span></span><span class="pi-chip"><span class="pi-chip-label">Android</span><span class="pi-chip-value">24+</span></span><span class="pi-chip"><span class="pi-chip-label">PHP</span><span class="pi-chip-value">8.3+</span></span><span class="pi-chip"><span class="pi-chip-label">Laravel</span><span class="pi-chip-value">12+</span></span></div><div class="pi-links"><a href="https://github.com/developernauts/nativephp-mobile-locales" class="pi-link" target="_blank" rel="noopener">GitHub →</a></div></div>

Declare the locales your NativePHP mobile app supports — once — and have the plugin wire the platform-native configuration on every iOS and Android build.

> **Build-time only.** This plugin runs during `php artisan native:run`. It writes native config files into the generated iOS and Android projects. It does **not** run at runtime, ship translations, switch locales, or persist user preferences.

## Requirements

- PHP 8.3+
- Laravel >= 12
- NativePHP Mobile v3 or v4

## Features

- Single source of truth for supported locales — one config array, both platforms.
- iOS: writes `CFBundleLocalizations` into `Info.plist`.
- Android: generates `res/xml/locales_config.xml` and references it from `AndroidManifest.xml`.
- Automatic format conversion (BCP 47 in, platform-native out).
- Idempotent — repeated builds produce the same output.

## Installation

```bash
composer require developernauts/nativephp-mobile-locales
```

Register the plugin with NativePHP:

```bash
php artisan native:plugin:register developernauts/nativephp-mobile-locales
```

Publish the config file:

```bash
php artisan vendor:publish --tag=nativephp-mobile-locales-config
```

## Configuration

`config/mobile-locales.php`

```php
return [
    'locales' => [
        'en',
        'en-GB',
    ],
];
```

Use [BCP 47](https://www.rfc-editor.org/rfc/rfc5646) tags (`en`, `pt-BR`, `en-GB`). Region subtags are optional. Tags are normalized automatically — `en_gb`, `EN-GB`, and `en-GB` resolve to the same entry.

## Native Platform Language Support

The plugin automatically syncs your configured locales into the native iOS and Android projects so the operating system can properly recognise which languages your app supports — without any manual Xcode or Android Studio configuration.

### iOS App Store Language Display

iOS reads the `CFBundleLocalizations` entries written to `Info.plist` and surfaces them in Settings and on the App Store listing.

![iOS language settings showing supported app languages](https://github.com/user-attachments/assets/be09b8c3-831c-456e-a788-dffce15f68c3)

![iOS App Store language list populated from configured locales](https://github.com/user-attachments/assets/1eebfc53-42cf-432d-9927-985780cc1412)

### Android App Language Support

Android 13+ uses `locales_config.xml` to populate the per-app language picker in system Settings, allowing users to override the app language independently of the system locale.

---

## When are locale files generated?

The sync commands run automatically as a `pre_compile` plugin hook during:

- `php artisan native:run` (iOS and Android)
- `php artisan native:build` (iOS)
- `php artisan native:bundle` (iOS and Android)

After `native:install --force` the native project files are reset to their template state. The locale files will be restored on the next build/run/bundle.

## Generating locale files locally

To inspect or verify the generated files without running a full build, the sync commands can be run directly:

```bash
# Sync all platforms
php artisan nativephp-mobile-locales:sync

# iOS only — updates nativephp/ios/NativePHP/Info.plist and nativephp/ios/NativePHP-simulator-Info.plist
php artisan nativephp-mobile-locales:sync-ios

# Android only — creates nativephp/android/app/src/main/res/xml/locales_config.xml
php artisan nativephp-mobile-locales:sync-android

# Android manifest only — adds android:localeConfig to AndroidManifest.xml
php artisan nativephp-mobile-locales:sync-android-manifest
```

## How it works

On every build, the plugin reads the `locales` array and writes the platform-native equivalent into the generated native projects.

### iOS

`nativephp/ios/NativePHP/Info.plist`

```xml
<key>CFBundleLocalizations</key>
<array>
    <string>en</string>
    <string>en-GB</string>
</array>
```

### Android

`nativephp/android/app/src/main/res/xml/locales_config.xml`

```xml
<?xml version="1.0" encoding="utf-8"?>
<locale-config xmlns:android="http://schemas.android.com/apk/res/android">
    <locale android:name="en"/>
    <locale android:name="en-rGB"/>
</locale-config>
```

`nativephp/android/app/src/main/AndroidManifest.xml`

```xml
<application android:localeConfig="@xml/locales_config" ...>
```

BCP 47 (`en-GB`) is automatically converted to Android's resource qualifier format (`en-rGB`). Keep your config in BCP 47.

## Testing

```bash
composer test
```

The test suite covers locale normalisation, BCP 47 → platform-native format conversion, XML write/update logic for all three config files, platform routing, and idempotency.

## Notes

> [!NOTE]
> Running `php artisan native:plugin:validate` will report two warnings for this plugin:
> - *No bridge_functions defined in manifest*
> - *No native code directories found (resources/android or resources/ios)*
>
> Both are expected. This plugin ships no bridge functions and no native code — it works entirely through a `pre_compile` hook that writes config files into the generated native projects. The warnings do not affect functionality.

- Per-app language preferences on Android 13+ require both `locales_config.xml` and the manifest reference — both handled here.
- iOS reads `CFBundleLocalizations` at build time; rebuild after changing the config.
- An empty `locales` array is a valid no-op.
- Only two-part BCP 47 tags are supported (`en`, `en-GB`). Three-part tags such as `zh-Hans-CN` are rejected with an `InvalidArgumentException`.

---

# Mobikul Loader

> Mobikul

<div class="plugin-info"><div class="pi-meta"><span class="pi-item"><span class="pi-label">Author</span><span class="pi-value">Mobikul</span></span><span class="pi-item"><span class="pi-label">Plugin Type</span><span class="pi-badge pi-badge-community">Community Plugin</span></span><span class="pi-item"><span class="pi-label">Price</span><span class="pi-badge pi-badge-free">Free</span></span><span class="pi-item"><span class="pi-label">Version</span><span class="pi-value">v1.0.2</span></span><span class="pi-item"><span class="pi-label">License</span><span class="pi-value">MIT</span></span></div><div class="pi-compat"><span class="pi-chip"><span class="pi-chip-label">NativePHP</span><span class="pi-chip-value">^3.0</span></span><span class="pi-chip"><span class="pi-chip-label">iOS</span><span class="pi-chip-value">16.0+</span></span><span class="pi-chip"><span class="pi-chip-label">Android</span><span class="pi-chip-value">29+</span></span><span class="pi-chip"><span class="pi-chip-label">PHP</span><span class="pi-chip-value">8.2+</span></span><span class="pi-chip"><span class="pi-chip-label">Laravel</span><span class="pi-chip-value">^10.0 | ^11.0 | ^12.0 | ^13.0</span></span></div><div class="pi-links"><a href="https://github.com/SocialMobikul/Mobikul_Loader_Native_Php" class="pi-link" target="_blank" rel="noopener">GitHub →</a></div></div>

Show and hide loader state in NativePHP Mobile apps, with optional Blade and web view support.

To find out more, visit: https://mobikul.com/

## What this plugin does

`mobikul_loader` provides two NativePHP bridge methods:

- `MobikulLoader.Show`
- `MobikulLoader.Hide`

These methods return loader state that your app can use while processing actions such as login, sync, or API requests.

The package also includes an optional HTML, CSS, and JavaScript helper for Blade-based screens or hybrid web views where you want a ready-made overlay spinner.

## Requirements

- PHP `8.2` or higher
- Laravel support package compatibility: `^10.0`, `^11.0`, `^12.0`, or `^13`
- `nativephp/mobile` `^3.0`
- A NativePHP Mobile application

## Installation

Install the package:

```bash
composer require mobikul/mobikul_loader
```

Register the plugin with NativePHP:

```bash
php artisan native:plugin:register mobikul/mobikul_loader
```

If this is your first time installing the plugin, or if you later change native bridge files, rebuild the native layer:

```bash
php artisan native:install --force
```

If you install from the NativePHP marketplace, configure the NativePHP Composer repository and credentials first:

```bash
composer config repositories.nativephp-plugins composer https://plugins.nativephp.com
composer config http-basic.plugins.nativephp.com <your-email> <your-license-key>
composer require mobikul/mobikul_loader
php artisan native:plugin:register mobikul/mobikul_loader
```

## Optional Asset Publishing

If you want to use the included Blade or web view loader UI, publish the package assets:

```bash
php artisan vendor:publish --tag=mobikul-loader-assets
```

This publishes the loader files to:

```text
public/vendor/mobikul_loader/
```

## Quick Start

Example login flow using the bridge methods from a NativePHP web view:

```js
async function signIn() {
  await fetch('/_native/api/call', {
    method: 'POST',
    headers: { 'Content-Type': 'application/json' },
    body: JSON.stringify({
      method: 'MobikulLoader.Show',
      params: { message: 'Signing you in...' }
    })
  });

  try {
    await fakeLoginRequest();
  } finally {
    await fetch('/_native/api/call', {
      method: 'POST',
      headers: { 'Content-Type': 'application/json' },
      body: JSON.stringify({
        method: 'MobikulLoader.Hide',
        params: {}
      })
    });
  }
}
```

## JavaScript Usage

You can call the bridge endpoint directly:

```js
await fetch('/_native/api/call', {
  method: 'POST',
  headers: { 'Content-Type': 'application/json' },
  body: JSON.stringify({
    method: 'MobikulLoader.Show',
    params: { message: 'Loading...' }
  })
});
```

Or use the included helper module from [mobikulLoader.js](/Users/aman/Documents/Native/plugins/mobikul_loader/resources/js/mobikulLoader.js):

```js
import { show, hide } from './vendor/mobikul_loader/js/mobikulLoader.js';

await show({ message: 'Loading...' });
await hide();
```

The helper is intended for bundled frontend code in your app. The import path above is an example and may need to be adjusted to match your app's frontend build setup. If you are not using a bundler, call the bridge endpoint directly.

## Bridge Methods

### `MobikulLoader.Show`

Marks the loader as visible and returns the resolved loader state.

Parameters:

- `message` optional string shown in the response payload

Returns:

```json
{
  "visible": true,
  "message": "Loading..."
}
```

### `MobikulLoader.Hide`

Marks the loader as hidden and returns the resolved loader state.

Returns:

```json
{
  "visible": false
}
```

## Blade and Web View Helper

If your NativePHP app renders Blade or hybrid web views, you can use the included helper to render a loader overlay after publishing assets:

```php
<?php

use MobikulLoader\HtmlLoader;

$loader = new HtmlLoader('mobikul-native-loader', 'Please wait...');
?>

<link rel="stylesheet" href="/vendor/mobikul_loader/css/loader.css">

<?= $loader->render(); ?>

<script src="/vendor/mobikul_loader/js/loader.js"></script>
<script>
  window.MobikulNativeLoader.show('mobikul-native-loader');

  setTimeout(() => {
    window.MobikulNativeLoader.hide('mobikul-native-loader');
  }, 1200);
</script>
```

## Important Behavior 

This plugin currently provides loader state bridge responses and optional web-based loader UI helpers. The native bridge implementations return a success payload that your app can use to coordinate loading behavior on Android and iOS.

If your app needs a fully rendered platform-native overlay component, extend the native bridge implementations in:

- `resources/android/src/MobikulLoaderFunctions.kt`
- `resources/ios/Sources/MobikulLoaderFunctions.swift`

## Permissions

This plugin does not require any special permissions.

- Android permissions: none
- iOS Info.plist permissions: none

## Events

This plugin does not dispatch any custom NativePHP events in the current version.

## Validation

Run validation from your NativePHP app root:

```bash
php artisan native:plugin:validate
```

If you change native bridge code or the plugin manifest, rebuild the native layer:

```bash
php artisan native:install --force
php artisan native:run
```

## Versioning

This plugin follows semantic versioning.

- `MAJOR` for breaking API or manifest changes
- `MINOR` for backward-compatible features
- `PATCH` for fixes and documentation updates

## Preview

Loader UI example inside a NativePHP Mobile login screen:

---

# In App Update

> Wilson Tovar

<div class="plugin-info"><div class="pi-meta"><span class="pi-item"><span class="pi-label">Author</span><span class="pi-value">Wilson Tovar</span></span><span class="pi-item"><span class="pi-label">Plugin Type</span><span class="pi-badge pi-badge-community">Community Plugin</span></span><span class="pi-item"><span class="pi-label">Price</span><span class="pi-badge pi-badge-free">Free</span></span><span class="pi-item"><span class="pi-label">Version</span><span class="pi-value">v1.0.2</span></span><span class="pi-item"><span class="pi-label">License</span><span class="pi-value">MIT</span></span></div><div class="pi-compat"><span class="pi-chip"><span class="pi-chip-label">NativePHP</span><span class="pi-chip-value">^3.0</span></span><span class="pi-chip"><span class="pi-chip-label">Android</span><span class="pi-chip-value">26+</span></span></div><div class="pi-links"><a href="https://github.com/wilsonatb/in-app-update" class="pi-link" target="_blank" rel="noopener">GitHub →</a></div></div>

# InAppUpdate Plugin for NativePHP Mobile

Android-only NativePHP plugin for Google Play In-App Updates. Easily integrate native app updates into your PHP/Livewire or JavaScript frontend with support for both **Flexible** and **Immediate** flows.

<p align="center">
</p>

## Understanding Update Flows

Google Play offers two ways to handle in-app updates. This plugin supports both:
* **Flexible:** The user can continue using the app while the update downloads in the background. Once downloaded, you prompt the user to install it.
* **Immediate:** A fullscreen blocking UI. The user must update and restart the app to continue using it.

---

## Installation

```bash
# 1. Install the package
composer require wilsonatb/in-app-update

# 2. Publish the plugins provider (first time only)
php artisan vendor:publish --tag=nativephp-plugins-provider

# 3. Register the plugin
php artisan native:plugin:register wilsonatb/in-app-update
```

### Platform Support

| Platform | Support | Notes |
|---|---|---|
| **Android** | ✅ Supported | Uses Google Play Core |
| **iOS** | ❌ Not supported | Returns a controlled skipped response (`supported: false`) to prevent crashes. |

---

## How It Works (The Recommended Flow)

Whether you use PHP or JavaScript, the mental model for a successful update attempt is the same:

1. **Generate an ID:** Create one UUID (`id`) per update attempt.
2. **Listen to Events:** Register listeners for `InAppUpdateStateChanged` and `InAppUpdateFlowCompleted`.
3. **Check Availability:** Call `checkForUpdate(...)`.
4. **Start the Update:** If available, call `startImmediateUpdate(...)` or `startFlexibleUpdate(...)`.
5. **Complete (Flexible only):** When the `installStatus` changes to `downloaded`, call `completeFlexibleUpdate(...)` to apply it.

---

## Usage Examples

### PHP / Livewire

This example demonstrates how to handle the async events triggered by the update flow using NativePHP's #[OnNative] attributes.

```php
use Native\Mobile\Attributes\OnNative;
use Wilsonatb\InAppUpdate\Events\InAppUpdateFlowCompleted;
use Wilsonatb\InAppUpdate\Events\InAppUpdateStateChanged;
use Wilsonatb\InAppUpdate\Facades\InAppUpdate;

public ?string $updateFlowId = null;

public function checkUpdate(): void
{
    $this->updateFlowId = (string) str()->uuid();

    $result = InAppUpdate::checkForUpdate(
        preferredType: 'any', // flexible | immediate | any
        id: $this->updateFlowId,
    );

    // iOS-safe response: plugin gracefully skips execution
    if (($result->supported ?? true) === false) {
        return;
    }
}

#[OnNative(InAppUpdateStateChanged::class)]
public function onInAppUpdateStateChanged(
    string $status,
    ?string $updateType = null,
    ?string $id = null,
    ?string $installStatus = null,
    ?bool $isUpdateAvailable = null,
): void {
    // Ensure we are responding to the current flow
    if ($id !== $this->updateFlowId) {
        return;
    }

    if ($status === 'availability_checked' && $isUpdateAvailable) {
        InAppUpdate::startFlexibleUpdate(id: $id);
    }

    if (in_array($installStatus, ['downloaded'], true)) {
        InAppUpdate::completeFlexibleUpdate(id: $id);
    }
}

#[OnNative(InAppUpdateFlowCompleted::class)]
public function onInAppUpdateFlowCompleted(
    string $result,
    string $updateType,
    ?string $id = null,
): void {
    // Handle final results: installed | downloaded | canceled | failed
}
```

### JavaScript (Vue / React / Inertia)

```javascript
import { InAppUpdate, Events } from '@wilsonatb/in-app-update';
import { on, off } from '@nativephp/native';

const id = crypto.randomUUID();

const onState = (payload) => console.log('State changed:', payload);
const onFlowCompleted = (payload) => console.log('Flow completed:', payload);

// Register listeners
on(Events.InAppUpdateStateChanged, onState);
on(Events.InAppUpdateFlowCompleted, onFlowCompleted);

// Check for update
const check = await InAppUpdate.checkForUpdate({ preferredType: 'any', id });

if (!check?.supported) {
    console.log('Skipped: InAppUpdate not supported on iOS', check);
} else if (check?.isUpdateAvailable) {
    await InAppUpdate.startFlexibleUpdate({ id });
}

// Complete if already downloaded
const latestStatus = await InAppUpdate.getInstallStatus();
if (latestStatus?.installStatus === 'downloaded') {
    await InAppUpdate.completeFlexibleUpdate({ id });
}

// Remember to clean up listeners when the component unmounts
off(Events.InAppUpdateStateChanged, onState);
off(Events.InAppUpdateFlowCompleted, onFlowCompleted);
```

---

## API Reference

> **Note:** Always pass the same `id` across all method calls and event checks for a single update attempt.

### Methods

| Method | Parameters | What it does | Returns (Immediate) |
|---|---|---|---|
| `checkForUpdate(...)` | `preferredType` (flexible\|immediate\|any, default: `flexible`), `minStalenessDays?` (int), `minPriority?` (int), `id?` (string) | Checks availability and allowed update types. | `{ status: "checking", ... }` |
| `startFlexibleUpdate(...)`| `allowAssetPackDeletion` (bool, default: `false`), `id?` (string) | Starts Play Core flexible flow in the background. | `{ status: "starting", updateType: "flexible", ... }` |
| `startImmediateUpdate(...)`| `allowAssetPackDeletion` (bool, default: `false`), `id?` (string) | Starts Play Core immediate blocking flow. | `{ status: "starting", updateType: "immediate", ... }` |
| `completeFlexibleUpdate(...)`| `id?` (string) | Installs a flexible update that has finished downloading. | `{ status: "completing", ... }` |
| `getInstallStatus()` | *None* | Returns last known native status snapshot. | Last cached status object |

### Events

* **`InAppUpdateStateChanged`**: Fired for non-terminal lifecycle/progress updates.
    * *Key Payload Fields:* `status`, `updateType`, `id`, `installStatus`, `isUpdateAvailable`, `bytesDownloaded`, `totalBytesToDownload`.
    * *Status Values:* `availability_checked`, `flow_started`, `install_state_changed`, `downloaded_pending_completion`, `developer_triggered_update_in_progress`, `resuming_immediate_update`, `completing_flexible_update`, `resume_check_failed`.
* **`InAppUpdateFlowCompleted`**: Fired when the flow reaches a terminal outcome.
    * *Key Payload Fields:* `result`, `updateType`, `id`, `error`.
    * *Result Values:* `installed`, `downloaded`, `canceled`, `failed`.

---

## Testing with Internal App Sharing

Testing Android In-App Updates requires specific conditions. Using Google Play's Internal App Sharing is the recommended approach:

1. Install a base build of your app that already includes this plugin on your device.
2. Build a new version with a **higher `versionCode`**.
3. Upload this newer build to Internal App Sharing in the Play Console.
4. Open the generated sharing URL on your test device, but **do not click install** on the Play Store page.
5. Open your currently installed app and trigger your update logic.

### ⚠️ Common Troubleshooting
* The Google account on the test device **must** have installed the app from Google Play at least once previously.
* Both the installed build and the uploaded build must share the **exact same `applicationId` and signing key**.
* `inAppUpdatePriority` constraints do not work during Internal App Sharing tests.

---

## Requirements & Support

* **Permissions:** No additional Android permissions are required.
* **Dependencies:** Plugin automatically includes `com.google.android.play:app-update:2.1.0` and `com.google.android.play:app-update-ktx:2.1.0`.

For issues, questions, or feature requests:
* **GitHub Issues:** [Open an issue](https://github.com/wilsonatb/in-app-update/issues)
* **Email:** diwdesign.wilson@gmail.com

---

# Double Back to Close

> CodingwithRK

<div class="plugin-info"><div class="pi-meta"><span class="pi-item"><span class="pi-label">Author</span><span class="pi-value">CodingwithRK</span></span><span class="pi-item"><span class="pi-label">Plugin Type</span><span class="pi-badge pi-badge-community">Community Plugin</span></span><span class="pi-item"><span class="pi-label">Price</span><span class="pi-badge pi-badge-free">Free</span></span><span class="pi-item"><span class="pi-label">Version</span><span class="pi-value">v1.1.0</span></span><span class="pi-item"><span class="pi-label">License</span><span class="pi-value">MIT</span></span></div><div class="pi-compat"><span class="pi-chip"><span class="pi-chip-label">NativePHP</span><span class="pi-chip-value">^3.0</span></span><span class="pi-chip"><span class="pi-chip-label">iOS</span><span class="pi-chip-value">18.2+</span></span><span class="pi-chip"><span class="pi-chip-label">Android</span><span class="pi-chip-value">26+</span></span></div><div class="pi-links"><a href="https://github.com/codingwithrk/double-back-to-close" class="pi-link" target="_blank" rel="noopener">GitHub →</a></div></div>

![Image](https://raw.githubusercontent.com/codingwithrk/nativephp-mobile-plugins/refs/heads/main/assets/screenshots/double-back-to-close.png)

Prompts users to press the back button twice before the app exits.

On the **first** back press a native toast is shown ("Press back again to exit"). If the user presses back **again within the timeout** the app exits. If the timeout elapses the state resets and the next back press starts the cycle over.

Supports NativePHP Mobile **v3** and **v4** (SuperNative). `DoubleBackToClose::showToast()` uses the `Dialog` facade to optionally surface the confirmation message as a rich dialog toast from PHP.

---

## Requirements

| Platform | Minimum version                                            |
|----------|------------------------------------------------------------|
| Android  | API 26 (Android 8)                                         |
| iOS      | 18.2 (feature is a no-op; iOS has no hardware back button) |

`nativephp/mobile` `^3.0` or `^4.0`.

---

## Installation

```bash
composer require codingwithrk/double-back-to-close
```

Publish the plugins provider (first time only):

```bash
php artisan vendor:publish --tag=nativephp-plugins-provider
```

Register this plugin (adds the service provider to your `NativePluginsServiceProvider`):

```bash
php artisan native:plugin:register codingwithrk/double-back-to-close
```

### `showToast()` on NativePHP Mobile v3

On v4, `Dialog` ships inside `nativephp/mobile` core — no extra steps needed. On **v3**, `Dialog` is a separate plugin, so if you want to use `DoubleBackToClose::showToast()` install and register it too:

```bash
composer require nativephp/mobile-dialog
php artisan native:plugin:register nativephp/mobile-dialog
```

This is only required if you call `showToast()`; `enable()`, `disable()`, and `configure()` work without it.

Verify:

```bash
php artisan native:plugin:list
```

---

## PHP Usage

```php
use Codingwithrk\DoubleBackToClose\Facades\DoubleBackToClose;

// Enable with defaults — message: "Press back again to exit", timeout: 2000 ms
DoubleBackToClose::enable();

// Enable with a custom message and timeout
DoubleBackToClose::enable('Tap back again to quit', 3000);

// Update message / timeout while already active
DoubleBackToClose::configure('Press back to exit', 2500);

// Disable (restores default back behaviour)
DoubleBackToClose::disable();

// Show a toast via the Dialog facade (built in on v4; requires nativephp/mobile-dialog on v3)
DoubleBackToClose::showToast('Press back again to exit');
```

### Typical Livewire setup

```php
use Livewire\Component;
use Codingwithrk\DoubleBackToClose\Facades\DoubleBackToClose;

class AppLayout extends Component
{
    public function mount(): void
    {
        DoubleBackToClose::enable();
    }
}
```

---

## Events

### `DoubleBackToCloseTriggered`

Dispatched on the **first** back press. The native Android `Toast` has already been shown; listen to this event if you want to show a dialog toast via the `Dialog` facade instead.

```php
use Native\Mobile\Attributes\OnNative;
use Codingwithrk\DoubleBackToClose\Events\DoubleBackToCloseTriggered;
use Codingwithrk\DoubleBackToClose\Facades\DoubleBackToClose;

#[OnNative(DoubleBackToCloseTriggered::class)]
public function onFirstBackPress(string $message): void
{
    // Override with a dialog toast
    DoubleBackToClose::showToast($message);
}
```

**Payload**

| Property  | Type     | Description                  |
|-----------|----------|------------------------------|
| `message` | `string` | The configured toast message |

### `AppExiting`

Dispatched on the **second** back press, immediately before `activity.finish()` is called.

```php
use Native\Mobile\Attributes\OnNative;
use Codingwithrk\DoubleBackToClose\Events\AppExiting;

#[OnNative(AppExiting::class)]
public function onAppExiting(): void
{
    // Last-moment cleanup
}
```

---

## JavaScript Usage

```javascript
import {DoubleBackToClose, Events} from '@codingwithrk/double-back-to-close';
import {on, off} from '@nativephp/native';

// Enable
await DoubleBackToClose.enable({message: 'Press back again to exit', timeout: 2000});

// Update config
await DoubleBackToClose.configure({message: 'Back again to quit', timeout: 3000});

// Disable
await DoubleBackToClose.disable();

// Listen for first back press
const onTriggered = ({message}) => console.log('First press:', message);
on(Events.DoubleBackToCloseTriggered, onTriggered);

// Listen for exit
const onExiting = () => console.log('Goodbye!');
on(Events.AppExiting, onExiting);

// Tear down
off(Events.DoubleBackToCloseTriggered, onTriggered);
off(Events.AppExiting, onExiting);
```

---

## How it works

### Android

`Enable` registers an [`OnBackPressedCallback`](https://developer.android.com/reference/androidx/activity/OnBackPressedCallback) on the activity's `onBackPressedDispatcher`.

- **First press**: shows a native `Toast`, dispatches `DoubleBackToCloseTriggered`, starts a `Handler` timer for the configured timeout.
- **Second press within timeout**: cancels the timer, dispatches `AppExiting`, calls `activity.finish()`.
- **Timeout elapses**: resets `backPressedOnce` to `false`; the next press is treated as a first press again.

`Disable` removes the callback and clears all state.

`Configure` updates the message/timeout in-place without re-registering the callback.

### iOS

iOS does not expose a hardware back button. The bridge functions accept and store configuration, and fire the same PHP events so cross-platform code stays consistent. Pair the feature with `DoubleBackToClose::showToast()` if you need visual feedback on iOS.

---

## Support

For questions or issues, email [connect@codingwithrk.com](mailto:connect@codingwithrk.com)

---

---

# All Permission Handler

> Bhargav Detroja

<div class="plugin-info"><div class="pi-meta"><span class="pi-item"><span class="pi-label">Author</span><span class="pi-value">Bhargav Detroja</span></span><span class="pi-item"><span class="pi-label">Plugin Type</span><span class="pi-badge pi-badge-community">Community Plugin</span></span><span class="pi-item"><span class="pi-label">Price</span><span class="pi-badge pi-badge-free">Free</span></span><span class="pi-item"><span class="pi-label">Version</span><span class="pi-value">v1.0.2</span></span><span class="pi-item"><span class="pi-label">License</span><span class="pi-value">MIT</span></span></div><div class="pi-compat"><span class="pi-chip"><span class="pi-chip-label">NativePHP</span><span class="pi-chip-value">^3.0</span></span><span class="pi-chip"><span class="pi-chip-label">iOS</span><span class="pi-chip-value">15.0+</span></span><span class="pi-chip"><span class="pi-chip-label">Android</span><span class="pi-chip-value">21+</span></span><span class="pi-chip"><span class="pi-chip-label">PHP</span><span class="pi-chip-value">8.2+</span></span></div><div class="pi-links"><a href="https://github.com/BhargavDetroja/nativephp-all-permission-handler" class="pi-link" target="_blank" rel="noopener">GitHub →</a></div></div>

# AllPermissionHandler for NativePHP Mobile

Runtime permission checks and requests for **iOS and Android** from your Laravel app. The API is aligned with Flutter’s **`permission_handler`** naming so the same permission strings work across PHP and JavaScript.

**Package:** `bhargavdetroja/nativephp-all-permission-handle`  
**Requires:** [NativePHP Mobile v3](https://nativephp.com/docs/mobile/3/getting-started/installation), PHP 8.2+

---

## Table of contents

1. [Quick start (7 steps)](#quick-start-7-steps)
2. [What this plugin does](#what-this-plugin-does)
3. [Requirements](#requirements)
4. [Installation](#installation)
5. [Configure permissions](#configure-permissions)
6. [After you change config](#after-you-change-config)
7. [Verify everything works](#verify-everything-works)
8. [Examples](#examples)
9. [API reference](#api-reference)
10. [Permission names (PHP and JS)](#permission-names-php-and-js)
11. [Status codes](#status-codes)
12. [Platform behaviour](#platform-behaviour)
13. [How builds use your config](#how-builds-use-your-config)
14. [Troubleshooting](#troubleshooting)
15. [Store & compliance](#store--compliance)
16. [Developing this plugin](#developing-this-plugin)
17. [Changelog & license](#changelog--license)

---

## Quick start (7 steps)

Do these in your **Laravel app that already uses NativePHP Mobile** (not inside this package’s repo).

| Step | Action |
|------|--------|
| 1 | `composer require bhargavdetroja/nativephp-all-permission-handle` |
| 2 | `php artisan vendor:publish --tag=nativephp-plugins-provider` |
| 3 | `php artisan native:plugin:register bhargavdetroja/nativephp-all-permission-handle` |
| 4 | `php artisan vendor:publish --tag=all-permission-handler-config` |
| 5 | Edit `config/all-permission-handler.php` — set `enabled_permissions` and `ios_usage_descriptions` for what you use (see [Configure permissions](#configure-permissions)) |
| 6 | `php artisan native:plugin:list` — confirm the plugin appears |
| 7 | Rebuild and run the native app (`php artisan native:run` or your usual iOS/Android flow) |

If any step fails, see [Troubleshooting](#troubleshooting).

---

## What this plugin does

- **Check** permission state (`check` / `status`)
- **Request** one or many permissions (`request`, `requestMultiple`)
- **Service status** where it applies (e.g. location services, notifications on some platforms)
- **Open app settings** (`openAppSettings`)
- **Android:** `shouldShowRequestRationale` (iOS returns `false`)

By default **no** permissions are enabled until you list them in config (safe for stores and security).

---

## Requirements

- Laravel application with **`nativephp/mobile` ^3.0** installed and project scaffolded (`native:install` or current NativePHP docs).
- Without NativePHP Mobile, Composer may still download this package, but **native code will not build** and you will see errors about missing providers or bridge classes.

---

## Installation

Run commands **in order**. Skipping an early step causes confusing errors later.

### 1. Install the Composer package

```bash
composer require bhargavdetroja/nativephp-all-permission-handle
```

### 2. Publish NativePHP’s plugin provider

Creates `app/Providers/NativeServiceProvider.php` (or equivalent). **Required before** `native:plugin:register`.

```bash
php artisan vendor:publish --tag=nativephp-plugins-provider
```

### 3. Register this plugin

Registers native (Swift/Kotlin) code for the next build.

```bash
php artisan native:plugin:register bhargavdetroja/nativephp-all-permission-handle
```

### 4. Publish this plugin’s config

```bash
php artisan vendor:publish --tag=all-permission-handler-config
```

### 5. Confirm registration

```bash
php artisan native:plugin:list
```

You should see `bhargavdetroja/nativephp-all-permission-handle` (or the registered name) in the list.

---

## Configure permissions

Edit **`config/all-permission-handler.php`**.

### Minimal example (camera + microphone)

```php
<?php

return [
    'enabled_permissions' => [
        'camera',
        'microphone',
    ],
    'preset' => 'none',
    'ios_usage_descriptions' => [
        'NSCameraUsageDescription' => 'We use the camera for [your real feature].',
        'NSMicrophoneUsageDescription' => 'We use the microphone for [your real feature].',
    ],
];
```

**iOS rule:** For every sensitive capability you enable, Apple expects a matching **`NS…UsageDescription`** string in the app’s **Info.plist**. This plugin generates those strings from `ios_usage_descriptions` (and sensible defaults where defined) and, on iOS builds, **merges them into the real NativePHP Info.plists** (see [How builds use your config](#how-builds-use-your-config)).

**Android rule:** Declared permissions come from the same `enabled_permissions` / preset list via the build hook.

### Presets (`preset` key)

Presets are **merged with** `enabled_permissions`.

| Value | Typical use |
|-------|-------------|
| `none` | Default. Only what you list under `enabled_permissions`. |
| `camera_only` | Adds camera. |
| `media_only` | Photos, videos, audio style set (see enum table). |
| `location_only` | Location when-in-use style set. |
| `full` | Everything the plugin knows about (use with care). |

Example — camera only, empty explicit list:

```php
'preset' => 'camera_only',
'enabled_permissions' => [],
'ios_usage_descriptions' => [
    'NSCameraUsageDescription' => '…',
],
```

---

## After you change config

1. Save `config/all-permission-handler.php`.
2. Run a **fresh native build** so hooks regenerate metadata and (on iOS) merge Info.plist keys.
3. On **iOS Simulator**, if the app was installed before, **delete the app** and install again so the new plist is picked up.

---

## Verify everything works

**Plugin visible**

```bash
php artisan native:plugin:list
```

**Optional — run the iOS copy-assets hook manually** (paths match a typical host project; adjust if yours differs):

```bash
php artisan nativephp:all-permission-handler:copy-assets \
  --platform=ios \
  --build-path="$(pwd)/nativephp/ios"
```

You should see JSON generated and log lines like `Merged usage descriptions into: …/NativePHP-simulator-Info.plist` when the plist files exist.

**Functional test:** Call `request('camera')` or the PHP equivalent **inside the NativePHP app**, not only in a desktop browser with `php artisan serve`.

---

## Examples

### Copy-paste: camera in one route

**Config** (at least):

```php
'enabled_permissions' => ['camera'],
'preset' => 'none',
'ios_usage_descriptions' => [
    'NSCameraUsageDescription' => 'This demo needs camera access.',
],
```

**`routes/web.php`**

```php
use Illuminate\Support\Facades\Route;
use Nativephp\AllPermissionHandler\Facades\AllPermissionHandler;
use Nativephp\AllPermissionHandler\Enums\Permission;

Route::get('/demo/camera', function () {
    $status = AllPermissionHandler::request(Permission::Camera);

    return response('Camera status: '.$status->name, 200, [
        'Content-Type' => 'text/plain; charset=UTF-8',
    ]);
});
```

Open `/demo/camera` in the **NativePHP mobile shell**; you should get the system dialog.

### Livewire button

**`app/Livewire/CameraDemo.php`**

```php
<?php

declare(strict_types=1);

namespace App\Livewire;

use Livewire\Component;
use Nativephp\AllPermissionHandler\Facades\AllPermissionHandler;
use Nativephp\AllPermissionHandler\Enums\Permission;

class CameraDemo extends Component
{
    public string $cameraStatus = 'not asked';

    public function requestCamera(): void
    {
        $this->cameraStatus = AllPermissionHandler::request(Permission::Camera)->name;
    }

    public function render()
    {
        return view('livewire.camera-demo');
    }
}
```

**`resources/views/livewire/camera-demo.blade.php`**

```blade
<div class="p-4">
    <button type="button" wire:click="requestCamera"
        class="rounded-lg bg-neutral-900 px-4 py-2 text-white active:opacity-80">
        Request camera
    </button>
    <p class="mt-3 text-sm text-neutral-600">Status: <strong>{{ $cameraStatus }}</strong></p>
</div>
```

**`routes/web.php`**

```php
use App\Livewire\CameraDemo;
use Illuminate\Support\Facades\Route;

Route::get('/demo/camera', CameraDemo::class);
```

### JavaScript (Inertia / Vite)

Install the JS helper from your NativePHP / package docs if needed, then:

```javascript
import { request } from '@nativephp/all-permission-handler';

const code = await request('camera'); // number: 0 denied, 1 granted, …
```

---

## API reference

### PHP

```php
use Nativephp\AllPermissionHandler\Facades\AllPermissionHandler;
use Nativephp\AllPermissionHandler\Enums\Permission;

AllPermissionHandler::status(Permission::Camera);   // alias of check()
AllPermissionHandler::check(Permission::Camera);
AllPermissionHandler::request(Permission::Camera);
AllPermissionHandler::requestMultiple([Permission::Camera, Permission::Microphone]);
AllPermissionHandler::serviceStatus(Permission::LocationWhenInUse);
AllPermissionHandler::shouldShowRequestRationale(Permission::Camera);
AllPermissionHandler::openAppSettings();

AllPermissionHandler::onDeniedCallback(fn () => logger()->warning('denied'))
    ->onGrantedCallback(fn () => logger()->info('granted'))
    ->request(Permission::Camera);
```

### JavaScript

```javascript
import {
  status,
  check,
  request,
  requestMultiple,
  serviceStatus,
  shouldShowRequestRationale,
  withCallbacks,
  openAppSettings,
} from '@nativephp/all-permission-handler';
```

### Methods summary

| Method | PHP | JS | Notes |
|--------|-----|-----|--------|
| Check current status | `check` / `status` | `check` / `status` | No prompt |
| Ask user | `request` | `request` | May show system UI |
| Several at once | `requestMultiple` | `requestMultiple` | |
| Service / subsystem | `serviceStatus` | `serviceStatus` | e.g. location enabled |
| Rationale (Android) | `shouldShowRequestRationale` | `shouldShowRequestRationale` | iOS: effectively false |
| Open settings | `openAppSettings` | `openAppSettings` | |
| Callbacks around request | fluent methods | `withCallbacks` | |

Return types: PHP uses enums where noted; JS typically uses numeric status codes (see below).

---

## Permission names (PHP and JS)

Use `Permission::X` in PHP or the string in the right column in JS.

| PHP enum | String (JS / config) |
|----------|----------------------|
| `Permission::Calendar` | `calendar` |
| `Permission::Camera` | `camera` |
| `Permission::Contacts` | `contacts` |
| `Permission::Location` | `location` |
| `Permission::LocationAlways` | `locationAlways` |
| `Permission::LocationWhenInUse` | `locationWhenInUse` |
| `Permission::MediaLibrary` | `mediaLibrary` |
| `Permission::Microphone` | `microphone` |
| `Permission::Phone` | `phone` |
| `Permission::Photos` | `photos` |
| `Permission::PhotosAddOnly` | `photosAddOnly` |
| `Permission::Reminders` | `reminders` |
| `Permission::Sensors` | `sensors` |
| `Permission::Sms` | `sms` |
| `Permission::Speech` | `speech` |
| `Permission::Storage` | `storage` |
| `Permission::IgnoreBatteryOptimizations` | `ignoreBatteryOptimizations` |
| `Permission::Notification` | `notification` |
| `Permission::AccessMediaLocation` | `access_media_location` |
| `Permission::ActivityRecognition` | `activity_recognition` |
| `Permission::Unknown` | `unknown` |
| `Permission::Bluetooth` | `bluetooth` |
| `Permission::ManageExternalStorage` | `manageExternalStorage` |
| `Permission::SystemAlertWindow` | `systemAlertWindow` |
| `Permission::RequestInstallPackages` | `requestInstallPackages` |
| `Permission::AppTrackingTransparency` | `appTrackingTransparency` |
| `Permission::CriticalAlerts` | `criticalAlerts` |
| `Permission::AccessNotificationPolicy` | `accessNotificationPolicy` |
| `Permission::BluetoothScan` | `bluetoothScan` |
| `Permission::BluetoothAdvertise` | `bluetoothAdvertise` |
| `Permission::BluetoothConnect` | `bluetoothConnect` |
| `Permission::NearbyWifiDevices` | `nearbyWifiDevices` |
| `Permission::Videos` | `videos` |
| `Permission::Audio` | `audio` |
| `Permission::ScheduleExactAlarm` | `scheduleExactAlarm` |
| `Permission::SensorsAlways` | `sensorsAlways` |
| `Permission::CalendarWriteOnly` | `calendarWriteOnly` |
| `Permission::CalendarFullAccess` | `calendarFullAccess` |
| `Permission::Assistant` | `assistant` |
| `Permission::BackgroundRefresh` | `backgroundRefresh` |

---

## Status codes

### Permission status (bridge / JS number)

| Code | Meaning |
|------|---------|
| `0` | denied |
| `1` | granted |
| `2` | restricted |
| `3` | limited |
| `4` | permanentlyDenied |
| `5` | provisional |

### Service status

| Code | Meaning |
|------|---------|
| `0` | disabled |
| `1` | enabled |
| `2` | notApplicable |

---

## Platform behaviour

| Area | iOS | Android |
|------|-----|---------|
| Camera, microphone | Runtime prompt | Runtime prompt |
| Location | Runtime / settings | May need settings after deny |
| Photos / media | Runtime | Varies by API level |
| Contacts, calendar | Runtime | Runtime |
| Reminders | iOS | N/A in map |
| Notifications | Runtime (iOS) | Android 13+ runtime |
| Speech | Runtime | Often tied to mic |
| Sensors / activity | Partial / device | API dependent |
| Special “settings” permissions | Limited | Opens settings screens |

**Android settings-style flows** (no simple runtime dialog):  
`manageExternalStorage`, `systemAlertWindow`, `requestInstallPackages`, `ignoreBatteryOptimizations`, `scheduleExactAlarm`, `accessNotificationPolicy`.

**iOS:** After denial, the user may need to use **Settings**; `openAppSettings()` helps.

---

## How builds use your config

When NativePHP runs the **`copy-assets`** hook for this plugin:

1. **`all-permission-handler.generated.android.json`** — enabled permissions and Android permission strings.
2. **`all-permission-handler.generated.ios.json`** — enabled permissions and **`ios_info_plist`** key/value strings.

NativePHP also reads static `ios.info_plist` from each plugin’s `nativephp.json`. This package keeps that minimal; your real strings come from **Laravel config**.

**Important (iOS):** The plugin **merges** those usage-description keys into the actual Xcode plist files next to the iOS build, when present:

- `NativePHP-simulator-Info.plist`
- `NativePHP/Info.plist`

That avoids a situation where JSON was generated but the **running app’s Info.plist** still lacked `NSCameraUsageDescription`, which causes an immediate **TCC / privacy crash** when camera APIs run.

---

## Troubleshooting

| What you see | What it usually means | What to do |
|--------------|----------------------|------------|
| `NativeServiceProvider not found` | Step 2 skipped | Run `vendor:publish --tag=nativephp-plugins-provider`, then register the plugin again. |
| `NativePluginHookCommand` not found | Wrong / missing NativePHP | `composer require nativephp/mobile:^3.0` and `composer update`. |
| iOS crash: `TCC`, `NSCameraUsageDescription`, privacy | Info.plist missing usage text | Set `enabled_permissions` + `ios_usage_descriptions`, rebuild iOS, delete old simulator app, reinstall. |
| Permission always denied | Plugin not in build or wrong key | `native:plugin:list`, clean rebuild; use exact strings from [Permission names](#permission-names-php-and-js). |
| Works in browser, not in app | No native bridge | Test inside the **NativePHP mobile** app; `nativephp_call` exists only there. |
| JSON exists but iOS still crashes | Old install or hook not run | Run iOS build again; confirm merge log lines; grep plist for `NSCameraUsageDescription`. |

---

## Store & compliance

- Enable **only** permissions your app truly uses.
- Write **specific** iOS usage strings (real feature, not “we need access”).
- Avoid risky Android permissions unless necessary (`sms`, background location, etc.).
- Re-check the list before each App Store / Play Store submission.

---

## Developing this plugin

Clone this repository and run tests locally:

```bash
composer install
./vendor/bin/pest --compact
```

Validate against a NativePHP checkout (path may differ):

```bash
php artisan native:plugin:validate path/to/all-permission-handler --no-interaction
```

---

## Semantic versioning (maintainers)

- **MAJOR** — breaking API or behaviour.
- **MINOR** — new permissions or features, backwards compatible.
- **PATCH** — fixes, docs, tests, internal refactors.

---

# Fullscreen

> Kevin Batdorf

<div class="plugin-info"><div class="pi-meta"><span class="pi-item"><span class="pi-label">Author</span><span class="pi-value">Kevin Batdorf</span></span><span class="pi-item"><span class="pi-label">Plugin Type</span><span class="pi-badge pi-badge-community">Community Plugin</span></span><span class="pi-item"><span class="pi-label">Price</span><span class="pi-badge pi-badge-free">Free</span></span><span class="pi-item"><span class="pi-label">Version</span><span class="pi-value">v0.1.1</span></span><span class="pi-item"><span class="pi-label">License</span><span class="pi-value">MIT</span></span></div><div class="pi-compat"><span class="pi-chip"><span class="pi-chip-label">NativePHP</span><span class="pi-chip-value">^3.0</span></span><span class="pi-chip"><span class="pi-chip-label">iOS</span><span class="pi-chip-value">15.0+</span></span><span class="pi-chip"><span class="pi-chip-label">Android</span><span class="pi-chip-value">21+</span></span></div><div class="pi-links"><a href="https://github.com/KevinBatdorf/nativephp-fullscreen" class="pi-link" target="_blank" rel="noopener">GitHub →</a></div></div>

Enter and exit fullscreen (immersive) mode.

## Installation

```bash
composer require kevinbatdorf/nativephp-fullscreen
```

## Usage

```php
use KevinBatdorf\Fullscreen\Facades\Fullscreen;

// Enter fullscreen (hide status bar + navigation bar)
Fullscreen::enter();

// Exit fullscreen (show system bars)
Fullscreen::exit();

// Check if fullscreen mode is active
$active = Fullscreen::isActive();
```

## JavaScript

```js
import { Fullscreen } from '@kevinbatdorf/nativephp-fullscreen';

await Fullscreen.enter();
await Fullscreen.exit();
const active = await Fullscreen.isActive();
```

## Platform Behavior

- **Android**: Uses `WindowInsetsControllerCompat` with `BEHAVIOR_SHOW_TRANSIENT_BARS_BY_SWIPE`. System bars reappear briefly on edge swipe, then auto-hide. Fullscreen persists across page navigations natively.
- **iOS**: Swizzles the root UIViewController to hide the status bar and home indicator. Negates safe area insets so content extends into the notch/dynamic island. Injects CSS to zero out NativePHP's safe area variables (`--inset-*`, `--sat/sar/sab/sal`) and removes `body.nativephp-safe-area` padding. A `WKUserScript` at document start reads a `sessionStorage` flag to apply fullscreen CSS before the page renders, preventing flash-of-insets on navigation. A KVO observer on `WKWebView.isLoading` re-injects CSS after each page load. Orientation changes are handled automatically.

---

# In App Reviews

> Wilson Tovar

<div class="plugin-info"><div class="pi-meta"><span class="pi-item"><span class="pi-label">Author</span><span class="pi-value">Wilson Tovar</span></span><span class="pi-item"><span class="pi-label">Plugin Type</span><span class="pi-badge pi-badge-community">Community Plugin</span></span><span class="pi-item"><span class="pi-label">Price</span><span class="pi-badge pi-badge-free">Free</span></span><span class="pi-item"><span class="pi-label">Version</span><span class="pi-value">v1.0.5</span></span><span class="pi-item"><span class="pi-label">License</span><span class="pi-value">MIT</span></span></div><div class="pi-compat"><span class="pi-chip"><span class="pi-chip-label">NativePHP</span><span class="pi-chip-value">^3.0</span></span><span class="pi-chip"><span class="pi-chip-label">iOS</span><span class="pi-chip-value">16.0+</span></span><span class="pi-chip"><span class="pi-chip-label">Android</span><span class="pi-chip-value">26+</span></span></div><div class="pi-links"><a href="https://github.com/wilsonatb/nativephp-in-app-reviews" class="pi-link" target="_blank" rel="noopener">GitHub →</a></div></div>

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

---

# Store Review

> Geof

<div class="plugin-info"><div class="pi-meta"><span class="pi-item"><span class="pi-label">Author</span><span class="pi-value">Geof</span></span><span class="pi-item"><span class="pi-label">Plugin Type</span><span class="pi-badge pi-badge-community">Community Plugin</span></span><span class="pi-item"><span class="pi-label">Price</span><span class="pi-badge pi-badge-free">Free</span></span><span class="pi-item"><span class="pi-label">Version</span><span class="pi-value">v1.0.4</span></span><span class="pi-item"><span class="pi-label">License</span><span class="pi-value">MIT</span></span></div><div class="pi-compat"><span class="pi-chip"><span class="pi-chip-label">NativePHP</span><span class="pi-chip-value">^3.0</span></span><span class="pi-chip"><span class="pi-chip-label">iOS</span><span class="pi-chip-value">15.0+</span></span><span class="pi-chip"><span class="pi-chip-label">Android</span><span class="pi-chip-value">26+</span></span><span class="pi-chip"><span class="pi-chip-label">PHP</span><span class="pi-chip-value">8.2+</span></span></div><div class="pi-links"><a href="https://github.com/geof-dev/nativephp-store-review" class="pi-link" target="_blank" rel="noopener">GitHub →</a></div></div>

A [NativePHP Mobile](https://nativephp.com) plugin to trigger the native in-app review prompt on iOS and Android — letting users rate your app without leaving it.

- **iOS** — uses [`SKStoreReviewController`](https://developer.apple.com/documentation/storekit/skstorereviewcontroller)
- **Android** — uses the [Play In-App Review API](https://developer.android.com/guide/playcore/in-app-review)

## Requirements

- PHP 8.2+
- `nativephp/mobile` ^3.0
- iOS 15+ / Android 8.0+ (API 26)

## Installation

```bash
composer require geof-dev/nativephp-store-review
```

The service provider is auto-discovered.

## Usage

```php
use Nativephp\StoreReview\Facades\StoreReview;

// Check if in-app review is available on this device
if (StoreReview::isAvailable()) {
    StoreReview::requestReview();
}
```

### `requestReview(): bool`

Asks the OS to display the native review prompt. Returns `true` if the request was successfully dispatched to the system.

> **Important:** returning `true` does **not** mean the dialog was shown to the user. Both iOS and Android throttle how often the prompt appears (iOS limits it to ~3 times per 365-day window per app). The OS decides whether to actually display it — this is by design and cannot be overridden.

### `isAvailable(): bool`

Returns `true` if the current platform supports in-app reviews. Use this to hide review CTAs on unsupported environments (e.g. running in a browser during development).

## Listening for Events

The plugin dispatches a `StoreReviewCompleted` event when the native flow finishes:

```php
use Livewire\Attributes\On;

#[On('native:Nativephp\StoreReview\Events\StoreReviewCompleted')]
public function handleReviewCompleted($result, $id = null)
{
    // $result — raw result payload from the native layer
}
```

## Best Practices

Apple and Google both discourage prompting users at arbitrary moments. A few guidelines:

- **Don't ask too early.** Wait until the user has experienced the value of your app (completed a task, finished onboarding, used it several times).
- **Never tie the prompt to a button labeled "Rate us".** Apple's guidelines forbid triggering `SKStoreReviewController` from an explicit user action — the system may ignore it.
- **Don't call it after an error or negative event.**
- **Don't call it repeatedly.** The OS will silently suppress excess requests; spamming it won't help.

See [Apple's HIG on Ratings and Reviews](https://developer.apple.com/design/human-interface-guidelines/ratings-and-reviews) for more.

## Testing in Development

- **iOS Simulator / Debug builds** — the dialog appears every time (no throttling), but submissions are not sent.
- **TestFlight / sideloaded builds** — the prompt does **not** appear. You must test on a production build from the App Store.
- **Android** — use a [FakeReviewManager](https://developer.android.com/guide/playcore/in-app-review/test) for local testing; production requires an app published to the Play Store.

---

# Audio

> Sagar Pansuriya

<div class="plugin-info"><div class="pi-meta"><span class="pi-item"><span class="pi-label">Author</span><span class="pi-value">Sagar Pansuriya</span></span><span class="pi-item"><span class="pi-label">Plugin Type</span><span class="pi-badge pi-badge-community">Community Plugin</span></span><span class="pi-item"><span class="pi-label">Price</span><span class="pi-badge pi-badge-free">Free</span></span><span class="pi-item"><span class="pi-label">Version</span><span class="pi-value">v1.3.1</span></span><span class="pi-item"><span class="pi-label">License</span><span class="pi-value">MIT</span></span></div><div class="pi-compat"><span class="pi-chip"><span class="pi-chip-label">NativePHP</span><span class="pi-chip-value">^3.0</span></span><span class="pi-chip"><span class="pi-chip-label">iOS</span><span class="pi-chip-value">13.0+</span></span><span class="pi-chip"><span class="pi-chip-label">Android</span><span class="pi-chip-value">21+</span></span></div><div class="pi-links"><a href="https://github.com/theunwindfront/nativephp-audio" class="pi-link" target="_blank" rel="noopener">GitHub →</a></div></div>

A premium NativePHP plugin for professional audio playback on mobile devices (Android & iOS). This plugin provides deep integration with native OS features like MediaSession, background services, and remote controls.

## ✨ Features

- **🏆 Native Media Integration** - Full support for OS Lock Screen controls, Bluetooth devices, and Android Auto/CarPlay.
- **📱 Background Excellence** - Reliable background playback using Foreground Services (Android) and specialized Audio Sessions (iOS).
- **🎶 Advanced Playlist Management** - Natively managed queues with Shuffle and Repeat modes.
- **📻 Live Radio Streaming** - First-class support for live audio streams with real-time metadata updates.
- **🎧 Audio Focus Intelligence** - Gracefully handles interruptions (phone calls, notifications, Siri) with auto-ducking and resuming.
- **🕒 Sleep Timers** - Programmatic sleep timers that safely release native resources.
- **📊 Detailed Analytics Events** - Granular event reporting for playback progress, track changes, buffering, and remote commands.
- **🖼 Rich Metadata** - Support for high-quality artwork, titles, artists, and arbitrary custom metadata.

## 🚀 Installation

```bash
# Install via Composer
composer require theunwindfront/nativephp-audio

# Publish the plugins provider (if not already done)
php artisan vendor:publish --tag=nativephp-plugins-provider

# Register the plugin with NativePHP
php artisan native:plugin:register theunwindfront/nativephp-audio
```

## 📖 Usage

### PHP Interface (Livewire / Controller)

```php
use Theunwindfront\Audio\Facades\Audio;

// 1. Play a single track with metadata
Audio::play('https://example.com/song.mp3', [
    'title'    => 'Midnight City',
    'artist'   => 'M83',
    'artwork'  => 'https://example.com/artwork.jpg',
]);

// 2. Play a Local File (Mobile Storage)
// Raw paths from storage_path() are natively supported
Audio::play(storage_path('app/public/recordings/audio.mp3'), [
    'title'  => 'Voice Note',
    'artist' => 'Recorded Local'
]);

// 3. Manage a Playlist (Natively handled auto-advance)
Audio::setPlaylist([
    [
        'url'   => 'https://example.com/track1.mp3',
        'title' => 'Track 01',
    ],
    // ... more tracks
], autoPlay: true, startIndex: 0);

// 4. Playback Controls
Audio::pause();
Audio::resume();
Audio::next();
Audio::previous();
Audio::skipTo(5); // Skip to index 5 in playlist

// 5. State & Settings
$state = Audio::getState(); 
Audio::setVolume(0.8);
Audio::setPlaybackRate(1.5);
Audio::setShuffleMode(true);
Audio::setRepeatMode('all'); // 'none', 'one', 'all'

// 6. Sleep Timer
Audio::setSleepTimer(1800); // 30 minutes
```

### 📻 Live Radio Streaming

Play live audio streams (Icecast, Shoutcast, or any HTTP audio stream) with dedicated streaming APIs:

```php
use Theunwindfront\Audio\Facades\Audio;

// Play a stream by direct URL
Audio::playStream('https://stream.example.com/live.mp3', [
    'title'   => 'My Radio Station',
    'artist'  => 'Live DJ Set',
    'artwork' => 'https://example.com/radio-logo.jpg',
]);

// Play a stream by mountpoint (resolved against a server URL)
Audio::playStream('/live', [
    'serverUrl' => 'https://stream.example.com',
    'title'     => 'Main Channel',
    'artist'    => 'Now Playing',
]);

// Update metadata in real-time (e.g., when the current song changes)
Audio::updateStreamMetadata([
    'title'   => 'New Song Title',
    'artist'  => 'New Artist',
    'artwork' => 'https://example.com/new-artwork.jpg',
]);
```

> **Note:** `playStream` automatically marks the session as a live stream, sets duration to `null`, disables auto-advance on completion, and flags the lock screen / Now Playing info as a live broadcast.

### ⚡ JavaScript Bridge

If you are building a SPA (Inertia/Vue/React) or using Alpine.js, you can use the JavaScript bridge directly.

First, include the bridge in your layout:
```html
@include('audio::bridge')
```

Then, use the `audio` helper:
```javascript
import audio from './resources/js/audio.js';

// Play immediately
await audio.play('https://server.com/song.mp3', { title: 'My Song' });

// Play a live stream
await audio.playStream('https://stream.example.com/live.mp3', {
    title: 'Live Radio',
    artist: 'DJ Mix'
});

// Update stream metadata in real-time
await audio.updateStreamMetadata({
    title: 'New Track Playing',
    artist: 'Featured Artist'
});

// Listen for native events on the window
window.addEventListener('audio:playback-progress-updated', (event) => {
    const { position, duration } = event.detail;
    console.log(`Playing: ${position} / ${duration}`);
});

// Listen for stream metadata changes
window.addEventListener('audio:stream-metadata-changed', (event) => {
    const { track, metadata } = event.detail;
    console.log(`Now playing: ${track.title} by ${track.artist}`);
});
```

### 📡 Event Synchronization

This plugin dispatches powerful Laravel events that you can listen to in your application:

| Event | Description |
|-------|-------------|
| `PlaybackStarted` | Fired when audio actually begins playing. |
| `PlaybackProgressUpdated` | Heartbeat event with `position` and `duration`. |
| `PlaylistTrackChanged` | Fired on auto-advance or manual track skip. |
| `AudioFocusLost` | Fired when another app takes over audio (e.g. phone call). |
| `RemotePlayReceived` | Fired when the user hits 'Play' on headphones/lockscreen. |
| `SleepTimerExpired` | Fired when the scheduled sleep timer hits zero. |
| `StreamMetadataChanged` | Fired when live stream metadata is updated (e.g. new song starts). |

## 🛠 Advanced Features

### Background Sync
When your app returns from the background, you can "drain" any missed events that occurred while the PHP process was suspended:

```php
$missedEvents = Audio::drainEvents();
```

### Absolute Local Paths
Unlike standard web players, this plugin has direct filesystem access. On Android, it even requests `READ_MEDIA_AUDIO` permissions automatically.

```php
Audio::play('/storage/emulated/0/Download/my-song.mp3');
```

## 📋 API Reference

| Method | Parameters | Description |
|--------|------------|-------------|
| `play` | `string $url, array $options` | Play/Restart audio |
| `playStream` | `string $mountpoint, array $options` | Play a live radio stream |
| `load` | `string $url, array $options` | Prepare audio without playing |
| `setPlaylist` | `array $tracks, bool $autoPlay, int $idx` | Set native queue |
| `next / previous` | - | Navigate playlist |
| `skipTo` | `int $index` | Jump to specific track |
| `setVolume` | `float $level` (0.0 - 1.0) | Set player volume |
| `setPlaybackRate`| `float $rate` (0.25 - 4.0) | Set playback speed |
| `setMetadata` | `array $metadata` | Set track metadata |
| `updateStreamMetadata`| `array $metadata` | Update live stream metadata without replacing track |
| `setSleepTimer` | `int $seconds` | Schedule a shutdown |
| `cancelSleepTimer`| - | Stop the active timer |
| `getState` | - | Get full status object |
| `getPlaylist` | - | Get full playlist state |
| `drainEvents` | - | Get background events |

## 📱 Version Support

- **Android**: 5.0 (API 21) or higher.
- **iOS**: 13.0 or higher.

## 👥 Credits

- **[Sagar Pansuriya](https://github.com/theunwindfront)** - Lead Developer
- [All Contributors](../../contributors)

## 🤝 Support

For questions or issues, contact **pansuriya.sagar94@gmail.com** or open a [GitHub Issue](https://github.com/theunwindfront/nativephp-audio/issues).

## 📄 License

The MIT License (MIT). Please see [License File](LICENSE) for more information.

---

# App Lifecycle

> Igor Djurovic

<div class="plugin-info"><div class="pi-meta"><span class="pi-item"><span class="pi-label">Author</span><span class="pi-value">Igor Djurovic</span></span><span class="pi-item"><span class="pi-label">Plugin Type</span><span class="pi-badge pi-badge-community">Community Plugin</span></span><span class="pi-item"><span class="pi-label">Price</span><span class="pi-badge pi-badge-free">Free</span></span><span class="pi-item"><span class="pi-label">Version</span><span class="pi-value">v1.0.0</span></span><span class="pi-item"><span class="pi-label">License</span><span class="pi-value">MIT</span></span></div><div class="pi-compat"><span class="pi-chip"><span class="pi-chip-label">NativePHP</span><span class="pi-chip-value">^3.0</span></span><span class="pi-chip"><span class="pi-chip-label">iOS</span><span class="pi-chip-value">15.0+</span></span><span class="pi-chip"><span class="pi-chip-label">Android</span><span class="pi-chip-value">21+</span></span><span class="pi-chip"><span class="pi-chip-label">PHP</span><span class="pi-chip-value">^8.2</span></span></div><div class="pi-links"><a href="https://github.com/djurovicigoor/app-lifecycle" class="pi-link" target="_blank" rel="noopener">GitHub →</a></div></div>

# AppLifecycle Plugin for NativePHP Mobile

App lifecycle state detection for NativePHP Mobile — detects foreground/background transitions on Android and iOS.

---

## Installation

```bash
composer require djurovicigoor/app-lifecycle
```

## Plugin Registration

Register the plugin in your `NativeServiceProvider`:

```php
// app/Providers/NativeServiceProvider.php

public function plugins(): array
{
    return [
        // ...other plugins
        \Djurovicigoor\AppLifecycle\AppLifecycleServiceProvider::class,
    ];
}
```

---

## Usage

### PHP — Laravel Event Listener

Register a listener in your `AppServiceProvider`:

```php
// app/Providers/AppServiceProvider.php

use Djurovicigoor\AppLifecycle\Events\AppForegrounded;
use Djurovicigoor\AppLifecycle\Events\AppBackgrounded;
use Illuminate\Support\Facades\Event;

public function boot(): void
{
    // Fires every time the user returns to the app
    Event::listen(AppForegrounded::class, function (AppForegrounded $event) {
        // make an API call, refresh data, etc.
    });

    // Fires every time the user leaves the app
    Event::listen(AppBackgrounded::class, function (AppBackgrounded $event) {
        // flush pending writes, pause timers, etc.
    });
}
```

Or use a dedicated listener class:

```php
// app/Listeners/SyncOnForeground.php

namespace App\Listeners;

use Djurovicigoor\AppLifecycle\Events\AppForegrounded;
use Illuminate\Support\Facades\Http;

class SyncOnForeground
{
    public function handle(AppForegrounded $event): void
    {

    }
}
```

```php
// app/Providers/AppServiceProvider.php

Event::listen(AppForegrounded::class, SyncOnForeground::class);
```

> ⚠️ **NativePHP Mobile has no queue worker.** Do not implement `ShouldQueue` on your listeners — jobs will be written to the database but never processed. Keep listener logic fast and synchronous.

---

### PHP — Livewire Component

Use the `#[On]` attribute with the `native:` prefix in any Livewire component:

```php
use Livewire\Attributes\On;
use Livewire\Component;

class Dashboard extends Component
{
    #[On('native:Djurovicigoor\AppLifecycle\Events\AppForegrounded')]
    public function handleForegrounded(int $timestamp): void
    {
        // Refresh data when app returns to foreground
        $this->loadLatestData();
    }

    #[On('native:Djurovicigoor\AppLifecycle\Events\AppBackgrounded')]
    public function handleBackgrounded(int $timestamp): void
    {
        // Save state when app goes to background
        $this->saveCurrentState();
    }
}
```

---

### JavaScript — Vue 3 (Composition API)

```javascript
import { onAppForegrounded, onAppBackgrounded } from '@djurovicigoor/app-lifecycle';
import { onMounted, onUnmounted } from 'vue';

export default {
    setup() {
        let stopFg, stopBg;

        onMounted(() => {
            stopFg = onAppForegrounded(({ timestamp }) => {
                console.log('App is active again', new Date(timestamp));
                // fetch fresh data, restart polling, etc.
            });

            stopBg = onAppBackgrounded(({ timestamp }) => {
                console.log('App went to background', new Date(timestamp));
                // pause timers, cancel requests, etc.
            });
        });

        onUnmounted(() => {
            stopFg?.();
            stopBg?.();
        });
    },
};
```

---

### JavaScript — React

```javascript
import { onAppForegrounded, onAppBackgrounded } from '@djurovicigoor/app-lifecycle';
import { useEffect } from 'react';

export function Dashboard() {
    useEffect(() => {
        const stopFg = onAppForegrounded(({ timestamp }) => {
            console.log('App foregrounded at', timestamp);
        });

        const stopBg = onAppBackgrounded(({ timestamp }) => {
            console.log('App backgrounded at', timestamp);
        });

        return () => {
            stopFg();
            stopBg();
        };
    }, []);
}
```

---

### JavaScript — Vanilla / Inertia

```javascript
import { onAppForegrounded, onAppBackgrounded } from '@djurovicigoor/app-lifecycle';

// Returns an unsubscribe function — call it to clean up
const stopFg = onAppForegrounded(({ timestamp }) => syncData());
const stopBg = onAppBackgrounded(({ timestamp }) => saveState());

// Later, when tearing down:
stopFg();
stopBg();
```

---

## Events

### `AppForegrounded`

Fired when the user returns the app to the foreground after it was previously backgrounded.

> **Note:** This event does **not** fire on initial app launch — only on genuine background → foreground transitions.

**PHP class:** `Djurovicigoor\AppLifecycle\Events\AppForegrounded`

| Property | Type | Description |
|---|---|---|
| `$timestamp` | `int` | Unix timestamp in milliseconds when the transition occurred |

---

### `AppBackgrounded`

Fired when the user leaves the app (presses Home, switches apps, or locks the screen).

**PHP class:** `Djurovicigoor\AppLifecycle\Events\AppBackgrounded`

| Property | Type | Description |
|---|---|---|
| `$timestamp` | `int` | Unix timestamp in milliseconds when the transition occurred |

---

## JavaScript API

```javascript
import { onAppForegrounded, onAppBackgrounded, Events } from '@djurovicigoor/app-lifecycle';
```

| Function | Parameters | Returns | Description |
|---|---|---|---|
| `onAppForegrounded(handler)` | `handler: ({ timestamp: number }) => void` | `() => void` | Subscribe to foreground transitions |
| `onAppBackgrounded(handler)` | `handler: ({ timestamp: number }) => void` | `() => void` | Subscribe to background transitions |
| `Events.AppLifecycle.AppForegrounded` | — | `string` | PHP class name constant |
| `Events.AppLifecycle.AppBackgrounded` | — | `string` | PHP class name constant |

---

## Platform Behavior

### Android

- Foreground detection uses `NativePHPLifecycle.ON_RESUME`
- Background detection uses `NativePHPLifecycle.ON_PAUSE`
- The initial `onResume` at app launch is **suppressed** — a `wasBackgrounded` guard ensures only genuine returns fire the event
- NativePHP's activity declares `android:configChanges="uiMode|colorMode|orientation|screenSize"`, so screen rotation does **not** trigger false foreground/background events

### iOS

- Foreground detection uses `UIApplication.willEnterForegroundNotification`
- Background detection uses `UIApplication.didEnterBackgroundNotification`
- `willEnterForeground` fires only when returning from the background, **not** on initial app launch — no extra guard is needed

---

## Plugin Details

| Field | Value |
|---|---|
| Author | Djurovic Igor |
| Version | 1.0.0 |
| License | MIT |
| Android min SDK | 21 |
| iOS min version | 15.0 |
| Platforms | Android, iOS |
| NativePHP Mobile | `^3.0` |
| PHP | `^8.2` |

# Support
For questions or issues, email djurovic.igoor@gmail.com

---

# No Screenshot

> CodingwithRK

<div class="plugin-info"><div class="pi-meta"><span class="pi-item"><span class="pi-label">Author</span><span class="pi-value">CodingwithRK</span></span><span class="pi-item"><span class="pi-label">Plugin Type</span><span class="pi-badge pi-badge-community">Community Plugin</span></span><span class="pi-item"><span class="pi-label">Price</span><span class="pi-badge pi-badge-free">Free</span></span><span class="pi-item"><span class="pi-label">Version</span><span class="pi-value">v1.1.0</span></span><span class="pi-item"><span class="pi-label">License</span><span class="pi-value">MIT</span></span></div><div class="pi-compat"><span class="pi-chip"><span class="pi-chip-label">NativePHP</span><span class="pi-chip-value">^3.0</span></span><span class="pi-chip"><span class="pi-chip-label">iOS</span><span class="pi-chip-value">13.0+</span></span><span class="pi-chip"><span class="pi-chip-label">Android</span><span class="pi-chip-value">21+</span></span><span class="pi-chip"><span class="pi-chip-label">PHP</span><span class="pi-chip-value">8.2+</span></span></div><div class="pi-links"><a href="https://github.com/codingwithrk/no-screenshot" class="pi-link" target="_blank" rel="noopener">GitHub →</a></div></div>

# NoScreenshot plugin for NativePHP Mobile

A NativePHP Mobile plugin that prevents screenshots, blocks screen recording, and protects the App Switcher thumbnail — on both Android and iOS.

Mainly useful for apps that handle sensitive data such as **financial**, **healthcare**, or **enterprise** applications where protecting user privacy and data security is paramount.

---

## Platform Support

| Feature                            |     Android     |            iOS             |
|------------------------------------|:---------------:|:--------------------------:|
| Block screenshots                  | ✅ `FLAG_SECURE` | ✅ UITextField secure layer |
| Block screen recording             | ✅ `FLAG_SECURE` |      ✅ Black overlay       |
| App Switcher thumbnail protection  |        ✅        |             ✅              |
| Detect live recording              |        —        |  ✅ `UIScreen.isCaptured`   |
| Detect screenshot events           |    ✅ API 34+    |       ✅ All versions       |
| Persist protection across restarts |        ✅        |             ✅              |

### How It Works

**Android** uses `WindowManager.LayoutParams.FLAG_SECURE` — an OS-level window flag that prevents the system from capturing the screen by any means: the screenshot button, the built-in screen recorder, ADB, and third-party capture apps all receive a blank frame. The flag also prevents the App Switcher / Recents thumbnail from showing real content.

A `ContentProvider` (`NoScreenshotInitProvider`) registers `Application.ActivityLifecycleCallbacks` before any Activity is created. On every `Activity.onCreate()` it reads the persisted protection state from `SharedPreferences` and re-applies `FLAG_SECURE` — so the flag is active from the very first frame, even before the WebView or any PHP controller has run.

**iOS** uses two complementary techniques:

1. **UITextField `isSecureTextEntry` screenshot prevention** — when protection is active, all main-window content is moved inside the first subview of a `UITextField` with `isSecureTextEntry = true`. iOS routes that subtree through its system DRM compositing path, which is excluded from the screenshot pipeline. The protected area appears **blank/white** in any screenshot taken while protection is active.

2. **Overlay windows** — a full-screen black `UIWindow` (above the status bar) is shown:
    - When `UIScreen.main.isCaptured` is `true` (screen recording / AirPlay mirroring active)
    - When `UIApplication.willResignActiveNotification` fires (user pressed Home — prevents the OS from capturing a real frame for the App Switcher thumbnail)

Protection state is persisted in `UserDefaults`. The plugin exports a `NativePHPNoScreenshotInit` function (registered as `init_function` in the manifest) that restores the saved state at app startup, re-arming all observers before the first bridge call.

---

## Requirements

|                  | Minimum                       |
|------------------|-------------------------------|
| PHP              | 8.2                           |
| NativePHP Mobile | 3.x or 4.x                    |
| Android          | API 21 (Android 5.0 Lollipop) |
| iOS              | 13.0                          |

> `FLAG_SECURE` is available from Android API 1. API 21 is set to match NativePHP Mobile's own minimum. The iOS 13 minimum is required because the recording overlay uses `UIWindowScene`, introduced in iOS 13.

---

## Installation

```bash
composer require codingwithrk/no-screenshot

php artisan native:plugin:register codingwithrk/no-screenshot
```

The service provider and `NoScreenshot` facade are auto-discovered by Laravel — no manual registration needed.

---

## Quick Start

```php
use Codingwithrk\NoScreenshot\Facades\NoScreenshot;

// Protect the entire app (persisted across restarts)
NoScreenshot::disableGlobally();

// Lift global protection
NoScreenshot::enableGlobally();
```

Call `disableGlobally()` once — from a service provider, middleware, or any controller. The choice is saved to `SharedPreferences` (Android) / `UserDefaults` (iOS) and automatically restored the next time the app launches.

---

## PHP API

All methods are available via the `NoScreenshot` facade or by resolving `Codingwithrk\NoScreenshot\NoScreenshot` from the container.

### `disableGlobally(): bool`

Activates protection for the entire app and persists the state so it survives app restarts.

- **Android** — adds `FLAG_SECURE` to the activity window; all capture attempts receive a blank frame. On the next launch, `FLAG_SECURE` is applied at `Activity.onCreate()` before the WebView loads.
- **iOS** — moves window content into the `UITextField` secure container (screenshot content appears blank), starts the `UIScreen.capturedDidChangeNotification` observer, and registers `willResignActiveNotification` to protect the App Switcher thumbnail.

Returns `true` on success, `false` if running outside NativePHP.

```php
NoScreenshot::disableGlobally();
```

---

### `enableGlobally(): bool`

Removes global protection and clears the persisted state.

```php
NoScreenshot::enableGlobally();
```

---

### `toggle(): bool`

Toggles global protection on/off. Returns the new `isGloballyProtected` state.

```php
$isNowProtected = NoScreenshot::toggle();
```

---

### `getStatus(): ?ScreenProtectionStatus`

Returns the current protection state as a typed DTO, or `null` outside NativePHP.

```php
$status = NoScreenshot::getStatus();

$status->isGloballyProtected;         // bool — true after disableGlobally()
$status->isScreenBeingRecorded;       // bool — iOS: live UIScreen.main.isCaptured; Android: always false
$status->isScreenshotDetectionActive; // bool — true when screenshot detection is running
```

---

### `startScreenshotDetection(): bool`

Registers a native observer that fires `ScreenshotAttempted` whenever the user takes a screenshot.

- **Android** — uses `Activity.registerScreenCaptureCallback()` (API 34+). On older devices the call succeeds but `supported` is `false` and no events fire.
- **iOS** — uses `UIApplication.userDidTakeScreenshotNotification` (all iOS versions).

```php
NoScreenshot::startScreenshotDetection();
```

---

### `stopScreenshotDetection(): bool`

Unregisters the screenshot observer.

```php
NoScreenshot::stopScreenshotDetection();
```

---

## Events

Three events cover the full lifecycle of capture activity. Listen to them in Livewire components with the `native:` prefix.

| Event                    | Dispatched when                                              |
|--------------------------|--------------------------------------------------------------|
| `ScreenshotAttempted`    | A screenshot was taken (iOS: all versions; Android: API 34+) |
| `ScreenRecordingStarted` | `isScreenBeingRecorded` transitions `false → true` (iOS)     |
| `ScreenRecordingStopped` | `isScreenBeingRecorded` transitions `true → false` (iOS)     |

> **Android note:** `FLAG_SECURE` prevents capture at the OS level rather than detecting it. `ScreenshotAttempted` requires API 34+ and `startScreenshotDetection()` to be called first. `ScreenRecordingStarted` / `ScreenRecordingStopped` are iOS-only.

### Listening in a Livewire component

```php
use Livewire\Attributes\On;
use Livewire\Component;
use Codingwithrk\NoScreenshot\Facades\NoScreenshot;

class SecureScreen extends Component
{
    #[On('native:Codingwithrk\NoScreenshot\Events\ScreenshotAttempted')]
    public function onScreenshotAttempted(): void
    {
        logger()->warning('Screenshot attempted');
    }

    #[On('native:Codingwithrk\NoScreenshot\Events\ScreenRecordingStarted')]
    public function onRecordingStarted(): void
    {
        // Recording / mirroring is now active — overlay is already shown by the plugin.
        // Use this hook for your own app logic (e.g. pause playback).
    }

    #[On('native:Codingwithrk\NoScreenshot\Events\ScreenRecordingStopped')]
    public function onRecordingStopped(): void
    {
        // Recording stopped — overlay is hidden automatically.
    }
}
```

### Manual dispatch (polling pattern)

```php
use Codingwithrk\NoScreenshot\Facades\NoScreenshot;
use Codingwithrk\NoScreenshot\Events\ScreenRecordingStarted;
use Codingwithrk\NoScreenshot\Events\ScreenRecordingStopped;

$status = NoScreenshot::getStatus();

match (true) {
    $status->isScreenBeingRecorded => ScreenRecordingStarted::dispatch(),
    default                        => ScreenRecordingStopped::dispatch(),
};
```

---

## ScreenProtectionStatus Reference

| Property                      | Type   | Android        | iOS                             |
|-------------------------------|--------|----------------|---------------------------------|
| `isGloballyProtected`         | `bool` | ✅              | ✅                               |
| `isScreenBeingRecorded`       | `bool` | Always `false` | Live `UIScreen.main.isCaptured` |
| `isScreenshotDetectionActive` | `bool` | API 34+ only   | ✅ All versions                  |

---

## Platform Notes

### Android

- **Startup protection** — `NoScreenshotInitProvider` (a `ContentProvider`) runs before `MainActivity.onCreate()`. It reads `SharedPreferences` and registers `ActivityLifecycleCallbacks`. On every `Activity.onCreate()` and `onResume()`, `FLAG_SECURE` is re-applied if protection is active. This means the App Switcher thumbnail is always black on cold launches — not just after the first bridge call.
- **Scope** — `FLAG_SECURE` covers the entire activity window. All capture methods (screenshot button, built-in recorder, ADB, third-party apps, Recents thumbnail) receive a blank frame.
- **Screenshot detection** — `registerScreenCaptureCallback()` requires API 34 (Android 14+). On earlier devices `startScreenshotDetection()` returns `supported: false` and `ScreenshotAttempted` never fires.

### iOS

- **Screenshot content prevention** — when protection is active, the main window's subviews are moved inside a `UITextField` with `isSecureTextEntry = true`. iOS's secure compositing path excludes this subtree from screenshot capture — the screenshot shows blank/white instead of real content. If Apple changes the internal `UITextField` structure in a future OS release, the plugin falls back gracefully to overlay-only protection.
- **App Switcher protection** — `willResignActiveNotification` fires before the OS captures the Recents thumbnail. The plugin shows the black overlay at that moment and hides it again on `didBecomeActiveNotification`.
- **Screen recording overlay** — `UIScreen.main.isCaptured` is `true` during screen recording and AirPlay mirroring. The black `UIWindow` overlay (level `statusBar + 1`) appears immediately when either starts and disappears when both stop.
- **Startup restoration** — `NativePHPNoScreenshotInit` (the `init_function`) reads `UserDefaults` at app launch and calls `apply()` if protection was previously enabled. The `didBecomeActiveNotification` observer retries `applyScreenshotPrevention()` if the window was not yet ready at init time.
- **iOS 13 minimum** — required for `UIWindowScene` used by the overlay window.

---

## Testing

### Unit tests

```bash
cd packages/codingwithrk/no-screenshot
./vendor/bin/pest
```

### Device scenarios

| # | Scenario                                 | Steps                                                             | Expected                                                                    |
|---|------------------------------------------|-------------------------------------------------------------------|-----------------------------------------------------------------------------|
| 1 | **App Switcher** (Android & iOS)         | Enable protection → press Home → open Recents                     | Thumbnail is black                                                          |
| 2 | **Screenshot content** (iOS)             | Enable protection → take screenshot (Vol Up + Side) → open Photos | Screenshot is blank/white                                                   |
| 3 | **Screenshot event** (Android 14+ & iOS) | `startScreenshotDetection()` → take screenshot                    | `ScreenshotAttempted` fires in Livewire                                     |
| 4 | **Restart persistence** (Android & iOS)  | Enable protection → force-kill app → reopen                       | Protection active before any PHP call; App Switcher thumbnail already black |

---
## Changelog

### 1.1.0

- **Android fix** — `FLAG_SECURE` is now applied at `Activity.onCreate()` via `NoScreenshotInitProvider` (a `ContentProvider`), fixing the App Switcher thumbnail leak that occurred before the first bridge call ([#1](https://github.com/codingwithrk/no-screenshot/issues/1))
- **Android** — protection state persisted to `SharedPreferences`; restored automatically on cold launch
- **iOS** — added `UITextField isSecureTextEntry` screenshot prevention; screenshot content now appears blank instead of showing real app content
- **iOS** — added `willResignActiveNotification` observer to protect the App Switcher thumbnail
- **iOS** — added `NativePHPNoScreenshotInit` (`init_function`) to restore persisted protection state at app startup
- **iOS** — protection state persisted to `UserDefaults`

### 1.0.0

- Initial release

---

## Support

For questions or issues, email [connect@codingwithrk.com](mailto:connect@codingwithrk.com)

---

# Package Info

> CodingwithRK

<div class="plugin-info"><div class="pi-meta"><span class="pi-item"><span class="pi-label">Author</span><span class="pi-value">CodingwithRK</span></span><span class="pi-item"><span class="pi-label">Plugin Type</span><span class="pi-badge pi-badge-community">Community Plugin</span></span><span class="pi-item"><span class="pi-label">Price</span><span class="pi-badge pi-badge-free">Free</span></span><span class="pi-item"><span class="pi-label">Version</span><span class="pi-value">v1.1.0</span></span><span class="pi-item"><span class="pi-label">License</span><span class="pi-value">MIT</span></span></div><div class="pi-compat"><span class="pi-chip"><span class="pi-chip-label">NativePHP</span><span class="pi-chip-value">^3.0</span></span><span class="pi-chip"><span class="pi-chip-label">iOS</span><span class="pi-chip-value">13.0+</span></span><span class="pi-chip"><span class="pi-chip-label">Android</span><span class="pi-chip-value">21+</span></span></div><div class="pi-links"><a href="https://github.com/codingwithrk/package-info" class="pi-link" target="_blank" rel="noopener">GitHub →</a></div></div>

# PackageInfo Plugin for NativePHP Mobile

A NativePHP Mobile plugin that provides an API for querying application package information — similar to Flutter's `package_info_plus`.

## Requirements

- PHP ^8.2
- `nativephp/mobile` ^3.0 or ^4.0 (SuperNative)

## Installation

```bash
composer require codingwithrk/package-info

php artisan native:plugin:register codingwithrk/package-info
```

The service provider is auto-discovered by Laravel.

## Usage

### Via Facade

```php
use Codingwithrk\PackageInfo\Facades\PackageInfo;

$info = PackageInfo::getInfo();

if ($info) {
    echo $info->appName;        // "My App"
    echo $info->packageName;    // "com.example.myapp"
    echo $info->version;        // "1.2.3"
    echo $info->buildNumber;    // "42"
    echo $info->installerStore; // "com.android.vending" (Android) or "" (iOS)
}
```

> `getInfo()` returns `null` when called outside a NativePHP Mobile environment.

### Returned Data

`getInfo()` returns a `PackageInfoData` value object with the following properties:

| Property         | Type     | Description                                                                     |
|------------------|----------|---------------------------------------------------------------------------------|
| `appName`        | `string` | Human-readable application name                                                 |
| `packageName`    | `string` | Unique app identifier (bundle ID on iOS, application ID on Android)             |
| `version`        | `string` | Marketing version string (e.g. `"1.2.3"`)                                       |
| `buildNumber`    | `string` | Build/version code as a string (e.g. `"42"`)                                    |
| `installerStore` | `string` | Package name of the installing store, or empty string if unknown/not applicable |

You can also convert the data to an array:

```php
$array = $info->toArray();
// ['appName' => '...', 'packageName' => '...', 'version' => '...', 'buildNumber' => '...', 'installerStore' => '...']
```

## Listening for Events

After `getInfo()` successfully retrieves data, a `PackageInfoRetrieved` event is dispatched. You can listen for it in a Livewire component using the `#[OnNative]` attribute:

```php
use Codingwithrk\PackageInfo\Events\PackageInfoRetrieved;
use Codingwithrk\PackageInfo\PackageInfoData;
use Native\Mobile\Attributes\OnNative;

#[OnNative(PackageInfoRetrieved::class)]
public function handlePackageInfoRetrieved(PackageInfoData $info): void
{
    $this->appName     = $info->appName;
    $this->version     = $info->version;
    $this->buildNumber = $info->buildNumber;
}
```

## Platform Support

| Platform | Supported |
|----------|-----------|
| Android  | Yes       |
| iOS      | Yes       |

## Support

For questions or issues, email [connect@codingwithrk.com](mailto:connect@codingwithrk.com)

---

# Mobile Screen

> Eser Deniz

<div class="plugin-info"><div class="pi-meta"><span class="pi-item"><span class="pi-label">Author</span><span class="pi-value">Eser Deniz</span></span><span class="pi-item"><span class="pi-label">Plugin Type</span><span class="pi-badge pi-badge-community">Community Plugin</span></span><span class="pi-item"><span class="pi-label">Price</span><span class="pi-badge pi-badge-free">Free</span></span><span class="pi-item"><span class="pi-label">Version</span><span class="pi-value">v2.0.0</span></span><span class="pi-item"><span class="pi-label">License</span><span class="pi-value">MIT</span></span></div><div class="pi-compat"><span class="pi-chip"><span class="pi-chip-label">NativePHP</span><span class="pi-chip-value">^3.0</span></span><span class="pi-chip"><span class="pi-chip-label">iOS</span><span class="pi-chip-value">13.0+</span></span><span class="pi-chip"><span class="pi-chip-label">Android</span><span class="pi-chip-value">21+</span></span></div><div class="pi-links"><a href="https://github.com/SRWieZ/nativephp-mobile-screen" class="pi-link" target="_blank" rel="noopener">GitHub →</a></div></div>

# Screen for NativePHP Mobile

### Keep screens awake. Control brightness. Built for apps users stare at.

<p align="center">
  <a href="https://packagist.org/packages/srwiez/nativephp-mobile-screen">
  </a>
</p>

<p align="center">
</p>

A tiny, focused NativePHP plugin for two things mobile devs constantly need: keeping the screen on and controlling brightness. One facade, six methods, zero setup.

## Why this plugin?

- **☀️ Keep the screen awake** — perfect for barcode tickets, live dashboards, kiosks and scoring apps.
- **🔆 Control brightness** — crank to 100% to scan barcodes in sunlight, dim down for dark reading rooms.
- **🪶 Dependency-free** — a single wake-lock + brightness wrapper. No bloat, no configuration.
- **📱 Works everywhere** — iOS 13+ and Android 5+ (API 21).

## Features at a glance

| Feature | Android | iOS |
|:---|:---:|:---:|
| Keep screen awake | ✅ | ✅ |
| Set brightness (0.0–1.0) | ✅ | ✅ |
| Reset to system default | ✅ | ✅ |

## Perfect for

Ticket & boarding-pass apps · Barcode / QR scanners · Kiosk & POS apps · Sports scoreboards · Live dashboards & monitoring · E-readers

---

## Installation

```bash
# Install the package
composer require srwiez/nativephp-mobile-screen

# Publish the plugins provider (first time only)
php artisan vendor:publish --tag=nativephp-plugins-provider

# Register the plugin
php artisan native:plugin:register srwiez/nativephp-mobile-screen

# Verify registration
php artisan native:plugin:list
```

This adds `\SRWieZ\NativePHP\Mobile\Screen\MobileScreenServiceProvider::class` to your `plugins()` array.

## Usage

### PHP (Livewire/Blade)

```php
use SRWieZ\NativePHP\Mobile\Screen\Facades\Screen;

// Keep screen awake
Screen::keepAwake(); // true if wake lock enabled

// Allow screen to sleep
Screen::allowSleep(); // true if wake lock disabled

// Check wake lock status
$isAwake = Screen::isAwake(); // bool

// Set brightness (0.0 to 1.0)
$level = Screen::setBrightness(1.0); // returns actual level, or false on failure

// Get current brightness
$level = Screen::getBrightness(); // float or null

// Reset to system default
Screen::resetBrightness(); // returns level or false on failure
```

### JavaScript (Vue/React/Inertia)

```javascript
import { mobileScreen } from '@srwiez/nativephp-mobile-screen';

// Keep screen awake
await mobileScreen.keepAwake();

// Set maximum brightness
await mobileScreen.setBrightness(1.0);

// Reset when done
await mobileScreen.resetBrightness();
await mobileScreen.allowSleep();
```

## API Reference

| Method | Returns | Description |
|--------|---------|-------------|
| `keepAwake(bool $enabled = true)` | `bool` | Enable/disable screen wake lock |
| `allowSleep()` | `bool` | Alias for `keepAwake(false)` |
| `isAwake()` | `bool` | Check if wake lock is active |
| `setBrightness(float $level)` | `bool\|float` | Set brightness (0.0-1.0). Returns actual level or `false` on failure |
| `getBrightness()` | `?float` | Get current brightness level |
| `resetBrightness()` | `bool\|float` | Reset to system default. Returns level or `false` on failure |

## Version Support

| Platform | Minimum Version |
|----------|----------------|
| Android  | 5.0 (API 21)   |
| iOS      | 13.0            |

## More NativePHP Mobile plugins

Building a mobile app with NativePHP? Check out the rest of the suite:

- **[Calendar](https://nativephp.com/plugins/srwiez/nativephp-mobile-calendar)** — Native calendars & events from PHP, on both platforms.
- **[Contacts](https://nativephp.com/plugins/srwiez/nativephp-mobile-contacts)** — Read, create & sync the device address book straight from Laravel.
- **[Screenshots](https://nativephp.com/plugins/srwiez/nativephp-mobile-screenshots)** — Lock down sensitive screens, catch capture attempts, respond instantly.

## Support

Bugs, questions, and feature requests should be reported at [github.com/SRWieZ/nativephp-mobile-screen/issues](https://github.com/SRWieZ/nativephp-mobile-screen/issues).

---

# Mobile Dialog

> Bifrost Technology

<div class="plugin-info"><div class="pi-meta"><span class="pi-item"><span class="pi-label">Author</span><span class="pi-value">Bifrost Technology</span></span><span class="pi-item"><span class="pi-label">Plugin Type</span><span class="pi-badge pi-badge-first-party">1st Party Plugin</span></span><span class="pi-item"><span class="pi-label">Price</span><span class="pi-badge pi-badge-free">Free</span></span><span class="pi-item"><span class="pi-label">Version</span><span class="pi-value">v1.0.2</span></span><span class="pi-item"><span class="pi-label">License</span><span class="pi-value">MIT</span></span></div><div class="pi-compat"><span class="pi-chip"><span class="pi-chip-label">NativePHP</span><span class="pi-chip-value">^3.0</span></span><span class="pi-chip"><span class="pi-chip-label">iOS</span><span class="pi-chip-value">18.2+</span></span><span class="pi-chip"><span class="pi-chip-label">Android</span><span class="pi-chip-value">26+</span></span></div><div class="pi-links"><a href="https://github.com/NativePHP/mobile-dialog" class="pi-link" target="_blank" rel="noopener">GitHub →</a></div></div>

# Dialog Plugin for NativePHP Mobile

Native alert dialogs and toast notifications for NativePHP Mobile applications.

## Overview

The Dialog API provides cross-platform native alert dialogs and toast/snackbar notifications.

## Installation

```bash
composer require nativephp/mobile-dialog
```

## Usage

### Alert Dialogs

#### PHP (Livewire/Blade)

```php
use Native\Mobile\Facades\Dialog;
use Native\Mobile\Events\Alert\ButtonPressed;

// Simple alert
Dialog::alert('Hello', 'Welcome to our app!');

// Alert with custom buttons
Dialog::alert('Confirm', 'Are you sure?', ['Cancel', 'Delete'])
    ->id('delete-confirm')
    ->show();

// Listen for button press
#[OnNative(ButtonPressed::class)]
public function handleButton($index, $label, $id = null)
{
    if ($id === 'delete-confirm' && $label === 'Delete') {
        $this->deleteItem();
    }
}
```

#### JavaScript (Vue/React/Inertia)

```js
import { Dialog, On, Off, Events } from '#nativephp';

// Simple alert
await Dialog.alert('Hello', 'Welcome to our app!');

// Alert with custom buttons
await Dialog.alert('Confirm', 'Are you sure?', ['Cancel', 'Delete'])
    .id('delete-confirm');

// Listen for button press
const handleButton = (payload) => {
    const { index, label, id } = payload;
    if (id === 'delete-confirm' && label === 'Delete') {
        deleteItem();
    }
};

On(Events.Alert.ButtonPressed, handleButton);
```

### Toast Notifications

#### PHP

```php
use Native\Mobile\Facades\Dialog;

// Short toast (2 seconds)
Dialog::toast('Item saved!', 'short');

// Long toast (4 seconds) - default
Dialog::toast('Processing complete');
```

#### JavaScript

```js
import { Dialog } from '#nativephp';

// Short toast
Dialog.toast('Item saved!', 'short');

// Long toast (default)
Dialog.toast('Processing complete');
```

## Configuration Methods

### Alert Methods

#### `id(string $id)`

Set a unique identifier for the alert. Useful for identifying which alert triggered a button press.

```php
Dialog::alert('Title', 'Message', ['OK', 'Cancel'])
    ->id('my-alert');
```

#### `event(string $eventClass)`

Specify a custom event class to dispatch when a button is pressed.

```php
Dialog::alert('Title', 'Message')
    ->event(MyCustomEvent::class);
```

#### `remember()`

Store the alert ID in session for retrieval in event handlers.

```php
Dialog::alert('Title', 'Message')
    ->id('confirm-action')
    ->remember();

// Later, in event handler
$alertId = \Native\Mobile\PendingAlert::lastId();
```

#### `show()`

Explicitly display the alert. If not called, the alert shows automatically when the object is destructed.

```php
Dialog::alert('Title', 'Message')->show();
```

### Toast Parameters

| Parameter | Type | Default | Description |
|-----------|------|---------|-------------|
| `message` | string | required | The message to display |
| `duration` | string | `'long'` | `'short'` (2s) or `'long'` (4s) |

## Events

### `ButtonPressed`

Fired when a button in an alert dialog is tapped.

**Properties:**
- `int $index` - The button index (0-based)
- `string $label` - The button label text
- `string|null $id` - The alert ID (if set)

#### PHP

```php
use Native\Mobile\Attributes\OnNative;
use Native\Mobile\Events\Alert\ButtonPressed;

#[OnNative(ButtonPressed::class)]
public function handleButton($index, $label, $id = null)
{
    match($label) {
        'Delete' => $this->delete(),
        'Cancel' => null,
        default => null,
    };
}
```

#### Vue

```js
import { On, Off, Events } from '#nativephp';
import { onMounted, onUnmounted } from 'vue';

const handleButton = (payload) => {
    const { index, label, id } = payload;
    if (label === 'Delete') {
        deleteItem();
    }
};

onMounted(() => On(Events.Alert.ButtonPressed, handleButton));
onUnmounted(() => Off(Events.Alert.ButtonPressed, handleButton));
```

## Platform Behavior

### Alert Dialogs
- **Android:** Native `AlertDialog` via `NativeActionCoordinator`
- **iOS:** Native `UIAlertController` with `.alert` style

### Toast Notifications
- **Android:** Material Design `Snackbar` (positioned above bottom navigation)
- **iOS:** Custom `ToastManager` overlay

---

# Mobile System

> Bifrost Technology

<div class="plugin-info"><div class="pi-meta"><span class="pi-item"><span class="pi-label">Author</span><span class="pi-value">Bifrost Technology</span></span><span class="pi-item"><span class="pi-label">Plugin Type</span><span class="pi-badge pi-badge-first-party">1st Party Plugin</span></span><span class="pi-item"><span class="pi-label">Price</span><span class="pi-badge pi-badge-free">Free</span></span><span class="pi-item"><span class="pi-label">Version</span><span class="pi-value">v1.0.3</span></span><span class="pi-item"><span class="pi-label">License</span><span class="pi-value">MIT</span></span></div><div class="pi-compat"><span class="pi-chip"><span class="pi-chip-label">NativePHP</span><span class="pi-chip-value">^3.0</span></span><span class="pi-chip"><span class="pi-chip-label">iOS</span><span class="pi-chip-value">18.2+</span></span><span class="pi-chip"><span class="pi-chip-label">Android</span><span class="pi-chip-value">26+</span></span></div><div class="pi-links"><a href="https://github.com/NativePHP/mobile-system" class="pi-link" target="_blank" rel="noopener">GitHub →</a></div></div>

# System Plugin for NativePHP Mobile

System-level operations for NativePHP Mobile apps.

## Overview

The System API provides access to system-level functionality like platform detection and opening the app's settings page.

## Installation

```bash
composer require nativephp/mobile-system
```

## Usage

### PHP (Livewire/Blade)

```php
use Native\Mobile\Facades\System;

// Platform detection
System::isIos();       // true on iOS
System::isAndroid();   // true on Android
System::isMobile();    // true on either platform

// Open app settings (useful when user denied permissions)
System::appSettings();

// Toggle the flashlight
System::flashlight();
```

### JavaScript (Vue/React/Inertia)

```js
import { System } from '#nativephp';

// Open app settings
await System.openAppSettings();
```

## Methods

### `isIos(): bool`

Returns `true` if the app is running on iOS.

### `isAndroid(): bool`

Returns `true` if the app is running on Android.

### `isMobile(): bool`

Returns `true` if the app is running on iOS or Android.

### `appSettings(): void`

Opens the app's settings screen in the device settings. This is useful when a user has denied a permission and you want to direct them to the settings to grant it.

### `flashlight(): void`

Toggles the device flashlight on/off.

## Use Cases

- Detect the current platform to conditionally render UI
- Direct users to grant permissions after initial denial
- Allow users to change notification preferences

---

# Mobile Browser

> Bifrost Technology

<div class="plugin-info"><div class="pi-meta"><span class="pi-item"><span class="pi-label">Author</span><span class="pi-value">Bifrost Technology</span></span><span class="pi-item"><span class="pi-label">Plugin Type</span><span class="pi-badge pi-badge-first-party">1st Party Plugin</span></span><span class="pi-item"><span class="pi-label">Price</span><span class="pi-badge pi-badge-free">Free</span></span><span class="pi-item"><span class="pi-label">Version</span><span class="pi-value">v1.0.2</span></span><span class="pi-item"><span class="pi-label">License</span><span class="pi-value">MIT</span></span></div><div class="pi-compat"><span class="pi-chip"><span class="pi-chip-label">NativePHP</span><span class="pi-chip-value">^3.0</span></span><span class="pi-chip"><span class="pi-chip-label">iOS</span><span class="pi-chip-value">18.2+</span></span><span class="pi-chip"><span class="pi-chip-label">Android</span><span class="pi-chip-value">26+</span></span></div><div class="pi-links"><a href="https://github.com/NativePHP/mobile-browser" class="pi-link" target="_blank" rel="noopener">GitHub →</a></div></div>

# Browser Plugin for NativePHP Mobile

Open URLs in system browser, in-app browser (SFSafariViewController/Chrome Custom Tabs), and OAuth authentication sessions.

## Overview

The Browser API provides three methods for opening URLs, each designed for specific use cases: in-app browsing, system browser navigation, and web authentication flows.

## Installation

```bash
composer require nativephp/mobile-browser
```

## Usage

### PHP (Livewire/Blade)

```php
use Native\Mobile\Facades\Browser;

// Open in in-app browser
Browser::inApp('https://nativephp.com/mobile');

// Open in system browser
Browser::open('https://nativephp.com/mobile');

// OAuth authentication
Browser::auth('https://provider.com/oauth/authorize?client_id=123&redirect_uri=nativephp://127.0.0.1/auth/callback');
```

### JavaScript (Vue/React/Inertia)

```js
import { Browser } from '#nativephp';

// Open in in-app browser
await Browser.inApp('https://nativephp.com/mobile');

// Open in system browser
await Browser.open('https://nativephp.com/mobile');

// OAuth authentication
await Browser.auth('https://provider.com/oauth/authorize?client_id=123&redirect_uri=nativephp://127.0.0.1/auth/callback');
```

## Methods

### `inApp()`

Opens a URL in an embedded browser within your app using Custom Tabs (Android) or SFSafariViewController (iOS).

### `open()`

Opens a URL in the device's default browser app, leaving your application entirely.

### `auth()`

Opens a URL in a specialized authentication browser designed for OAuth flows with automatic `nativephp://` redirect handling.

## Use Cases

### When to Use Each Method

**`inApp()`** - Keep users within your app experience:
- Documentation, help pages, terms of service
- External content that relates to your app
- When you want users to easily return to your app

**`open()`** - Full browser experience needed:
- Complex web applications
- Content requiring specific browser features
- When users need bookmarking or sharing capabilities

**`auth()`** - OAuth authentication flows:
- Login with WorkOS, Auth0, Google, Facebook, etc.
- Secure authentication with automatic redirects
- Isolated browser session for security

## Testing

The plugin extends the NativePHP testing suite with browser-specific helpers, so your app tests can assert what was opened without knowing any bridge internals:

```php
use Native\Mobile\Testing\Native;

it('opens the docs in the in-app browser', function () {
    Native::fakeBridge()->respondTo('Browser.OpenInApp', ['success' => true]);

    Native::test(HelpScreen::class)
        ->tap('View documentation')
        ->assertOpenedInApp('https://nativephp.com/docs');
});

it('starts the oauth flow', function () {
    Native::fakeBridge()->respondTo('Browser.OpenAuth', ['success' => true]);

    Native::test(LoginScreen::class)
        ->tap('Continue with Google')
        ->assertOpenedAuth();
});

it('does nothing until the button is tapped', function () {
    Native::test(LoginScreen::class)
        ->assertNothingBrowsed();
});
```

### Helpers

- `assertBrowsed(?string $url = null)` — assert a URL was opened, via `open()`, `inApp()`, or `auth()` — any of the three, or exactly `$url` when given.
- `assertOpenedInApp(?string $url = null)` — assert a URL was opened in the in-app browser (`inApp()`), or exactly `$url` when given.
- `assertOpenedAuth(?string $url = null)` — assert a URL was opened in an authentication session (`auth()`), or exactly `$url` when given.
- `assertNothingBrowsed()` — assert nothing was opened by any of the three methods.

`open()`, `inApp()`, and `auth()` are fire-and-forget calls with nothing to read back beyond success/failure, so there's no `with*()` helper to fake a response — script it directly when a test needs `open()`/`inApp()`/`auth()` to return `true`:

```php
Native::fakeBridge()->respondTo('Browser.Open', ['success' => true]);
```

The helpers are available on `Native::fakeBridge()` and chain directly off `Native::test(...)`. They register automatically while running tests (requires a core with a macroable FakeBridge; on older cores they simply don't register).

---

# Mobile File

> Bifrost Technology

<div class="plugin-info"><div class="pi-meta"><span class="pi-item"><span class="pi-label">Author</span><span class="pi-value">Bifrost Technology</span></span><span class="pi-item"><span class="pi-label">Plugin Type</span><span class="pi-badge pi-badge-first-party">1st Party Plugin</span></span><span class="pi-item"><span class="pi-label">Price</span><span class="pi-badge pi-badge-free">Free</span></span><span class="pi-item"><span class="pi-label">Version</span><span class="pi-value">v1.0.2</span></span><span class="pi-item"><span class="pi-label">License</span><span class="pi-value">MIT</span></span></div><div class="pi-compat"><span class="pi-chip"><span class="pi-chip-label">NativePHP</span><span class="pi-chip-value">^3.0</span></span><span class="pi-chip"><span class="pi-chip-label">iOS</span><span class="pi-chip-value">18.2+</span></span><span class="pi-chip"><span class="pi-chip-label">Android</span><span class="pi-chip-value">26+</span></span></div><div class="pi-links"><a href="https://github.com/NativePHP/mobile-file" class="pi-link" target="_blank" rel="noopener">GitHub →</a></div></div>

# File Plugin for NativePHP Mobile

File operations (move, copy) for NativePHP Mobile applications.

## Overview

The File API provides cross-platform file manipulation operations.

## Installation

```bash
composer require nativephp/mobile-file
```

## Usage

### PHP (Livewire/Blade)

```php
use Native\Mobile\Facades\File;

// Move a file
$result = File::move('/path/to/source.txt', '/path/to/destination.txt');

if ($result['success']) {
    echo 'File moved successfully!';
}

// Copy a file
$result = File::copy('/path/to/source.txt', '/path/to/copy.txt');

if ($result['success']) {
    echo 'File copied successfully!';
}
```

### JavaScript (Vue/React/Inertia)

```js
import { File } from '#nativephp';

// Move a file
const result = await File.move('/path/to/source.txt', '/path/to/destination.txt');

if (result.success) {
    console.log('File moved successfully!');
}

// Copy a file
const result = await File.copy('/path/to/source.txt', '/path/to/copy.txt');

if (result.success) {
    console.log('File copied successfully!');
}
```

## Methods

### `move(string $from, string $to): array`

Moves a file from source to destination.

| Parameter | Type | Description |
|-----------|------|-------------|
| `from` | string | Source file path |
| `to` | string | Destination file path |

**Returns:**
- `success: bool` - Whether the operation succeeded
- `error: string` - Error message if operation failed (optional)

### `copy(string $from, string $to): array`

Copies a file from source to destination.

| Parameter | Type | Description |
|-----------|------|-------------|
| `from` | string | Source file path |
| `to` | string | Destination file path |

**Returns:**
- `success: bool` - Whether the operation succeeded
- `error: string` - Error message if operation failed (optional)

## Behavior

- Parent directories are created automatically if they don't exist
- Existing destination files are overwritten
- File integrity is verified after copy operations
- On Android, if rename fails (cross-filesystem), falls back to copy + delete

## Examples

### Move File to Permanent Storage

```php
use Native\Mobile\Facades\File;

$tempPath = '/var/mobile/Containers/Data/tmp/recording.m4a';
$permanentPath = storage_path('recordings/recording.m4a');

$result = File::move($tempPath, $permanentPath);

if ($result['success']) {
    // File moved successfully
}
```

### Backup File Before Edit

```php
use Native\Mobile\Facades\File;

public function editFile($filePath)
{
    // Create backup
    $backupPath = str_replace('.txt', '_backup.txt', $filePath);
    File::copy($filePath, $backupPath);

    // Proceed with editing...
}
```

---

# Mobile Share

> Bifrost Technology

<div class="plugin-info"><div class="pi-meta"><span class="pi-item"><span class="pi-label">Author</span><span class="pi-value">Bifrost Technology</span></span><span class="pi-item"><span class="pi-label">Plugin Type</span><span class="pi-badge pi-badge-first-party">1st Party Plugin</span></span><span class="pi-item"><span class="pi-label">Price</span><span class="pi-badge pi-badge-free">Free</span></span><span class="pi-item"><span class="pi-label">Version</span><span class="pi-value">v1.0.2</span></span><span class="pi-item"><span class="pi-label">License</span><span class="pi-value">MIT</span></span></div><div class="pi-compat"><span class="pi-chip"><span class="pi-chip-label">NativePHP</span><span class="pi-chip-value">^3.0</span></span><span class="pi-chip"><span class="pi-chip-label">iOS</span><span class="pi-chip-value">18.2+</span></span><span class="pi-chip"><span class="pi-chip-label">Android</span><span class="pi-chip-value">26+</span></span></div><div class="pi-links"><a href="https://github.com/NativePHP/mobile-share" class="pi-link" target="_blank" rel="noopener">GitHub →</a></div></div>

# Share Plugin for NativePHP Mobile

Native share sheet for sharing URLs and files in NativePHP Mobile applications.

## Overview

The Share API provides cross-platform native share sheet functionality for sharing URLs, text, and files.

## Installation

```bash
composer require nativephp/mobile-share
```

## Usage

### Share a URL

#### PHP (Livewire/Blade)

```php
use Native\Mobile\Facades\Share;

// Share a URL with title and text
Share::url('Check this out!', 'Found this great article', 'https://example.com');
```

#### JavaScript (Vue/React/Inertia)

```js
import { Share } from '#nativephp';

// Share a URL
await Share.url('Check this out!', 'Found this great article', 'https://example.com');
```

### Share a File

#### PHP

```php
use Native\Mobile\Facades\Share;

// Share a file
Share::file('My Recording', 'Listen to this!', '/path/to/audio.m4a');

// Share just text (no file)
Share::file('Hello', 'This is my message', '');
```

#### JavaScript

```js
import { Share } from '#nativephp';

// Share a file
await Share.file('My Recording', 'Listen to this!', '/path/to/audio.m4a');

// Share just text
await Share.file('Hello', 'This is my message');
```

## Methods

### `url(string $title, string $text, string $url)`

Opens the native share sheet with a URL.

| Parameter | Type | Description |
|-----------|------|-------------|
| `title` | string | Share dialog title / subject |
| `text` | string | Text message to include with the URL |
| `url` | string | The URL to share |

### `file(string $title, string $text, string $filePath)`

Opens the native share sheet with a file or text.

| Parameter | Type | Description |
|-----------|------|-------------|
| `title` | string | Share dialog title / subject |
| `text` | string | Text message to share |
| `filePath` | string | Absolute path to file (optional) |

## Supported File Types

The share sheet automatically detects MIME types for common file formats:

**Audio:** m4a, aac, mp3, wav, ogg, flac
**Video:** mp4, m4v, mov, avi, mkv, webm
**Images:** jpg, jpeg, png, gif, webp
**Documents:** pdf, txt

## Platform Behavior

### Android
- Uses `Intent.ACTION_SEND` with `Intent.createChooser`
- Files are shared via `FileProvider` for security
- Temporary copies are made for files in app storage
- Old share temp files are automatically cleaned up

### iOS
- Uses `UIActivityViewController`
- Supports iPad popover presentation
- Files are shared directly via file URLs

## Testing

The plugin extends the NativePHP testing suite with share-specific helpers, so your app tests can assert share sheet activity without knowing any bridge internals:

```php
use Native\Mobile\Testing\Native;

it('shares the invite link', function () {
    Native::test(ShareSheet::class)
        ->tap('Share link')
        ->assertSharedUrl('https://example.com/invite/abc');
});

it('shares the exported report', function () {
    Native::test(ReportScreen::class)
        ->tap('Share report')
        ->assertSharedFile('/storage/app/report.pdf');
});

it('does not share anything before the button is tapped', function () {
    Native::test(ReportScreen::class)
        ->assertNothingShared();
});
```

### Helpers

- `assertShared()` — assert something was shared, a URL or a file.
- `assertSharedUrl(?string $url = null)` — assert a URL was shared, or exactly `$url` when given.
- `assertSharedFile(?string $filePath = null)` — assert a file was shared, or exactly `$filePath` when given.
- `assertNothingShared()` — assert neither `Share::url()` nor `Share::file()` was called.

The helpers are available on `Native::fakeBridge()` and chain directly off `Native::test(...)`. They register automatically while running tests (requires a core with a macroable FakeBridge; on older cores they simply don't register).

---

# Mobile Network

> Bifrost Technology

<div class="plugin-info"><div class="pi-meta"><span class="pi-item"><span class="pi-label">Author</span><span class="pi-value">Bifrost Technology</span></span><span class="pi-item"><span class="pi-label">Plugin Type</span><span class="pi-badge pi-badge-first-party">1st Party Plugin</span></span><span class="pi-item"><span class="pi-label">Price</span><span class="pi-badge pi-badge-free">Free</span></span><span class="pi-item"><span class="pi-label">Version</span><span class="pi-value">v1.0.2</span></span><span class="pi-item"><span class="pi-label">License</span><span class="pi-value">MIT</span></span></div><div class="pi-compat"><span class="pi-chip"><span class="pi-chip-label">NativePHP</span><span class="pi-chip-value">^3.0</span></span><span class="pi-chip"><span class="pi-chip-label">iOS</span><span class="pi-chip-value">18.2+</span></span><span class="pi-chip"><span class="pi-chip-label">Android</span><span class="pi-chip-value">26+</span></span></div><div class="pi-links"><a href="https://github.com/NativePHP/mobile-network" class="pi-link" target="_blank" rel="noopener">GitHub →</a></div></div>

# Network Plugin for NativePHP Mobile

Network connectivity status monitoring for NativePHP Mobile applications.

## Overview

The Network API provides cross-platform network connectivity status detection, including connection type and metered status.

## Installation

```bash
composer require nativephp/mobile-network
```

## Usage

### PHP (Livewire/Blade)

```php
use Native\Mobile\Facades\Network;

// Get current network status
$status = Network::status();

if ($status->connected) {
    echo "Connected via: " . $status->type;

    if ($status->isExpensive) {
        echo " (metered connection)";
    }
} else {
    echo "No network connection";
}
```

### JavaScript (Vue/React/Inertia)

```js
import { Network } from '#nativephp';

// Get current network status
const status = await Network.status();

if (status.connected) {
    console.log(`Connected via: ${status.type}`);

    if (status.isExpensive) {
        console.log('Warning: metered connection');
    }
} else {
    console.log('No network connection');
}
```

## Response Object

The `status()` method returns an object with the following properties:

| Property | Type | Description |
|----------|------|-------------|
| `connected` | boolean | Whether device has network connectivity |
| `type` | string | Connection type: `wifi`, `cellular`, `ethernet`, or `unknown` |
| `isExpensive` | boolean | Whether connection is metered (e.g., cellular data) |
| `isConstrained` | boolean | Whether Low Data Mode is enabled (iOS only) |

## Examples

### Conditional Data Sync

```php
use Native\Mobile\Facades\Network;

public function syncData()
{
    $status = Network::status();

    if (!$status->connected) {
        // Handle no connection
        return;
    }

    if ($status->isExpensive) {
        // On cellular - sync only essential data
        $this->syncEssentialData();
    } else {
        // On WiFi - full sync
        $this->syncAllData();
    }
}
```

### JavaScript Connection Check

```js
import { Network } from '#nativephp';

async function checkBeforeDownload() {
    const status = await Network.status();

    if (!status.connected) {
        console.log('No internet connection');
        return false;
    }

    if (status.isExpensive && status.type === 'cellular') {
        console.log('On cellular data - consider warning user');
        return false;
    }

    return true;
}
```

## Platform Behavior

### Android
- Uses `ConnectivityManager` and `NetworkCapabilities`
- `isConstrained` is always `false` (not applicable)
- Requires `ACCESS_NETWORK_STATE` permission (added automatically)

### iOS
- Uses `NWPathMonitor` from Network framework
- `isConstrained` reflects Low Data Mode setting
- No special permissions required

## Testing

The plugin extends the NativePHP testing suite with network-specific helpers, so your app tests can fake connectivity and assert it was checked without knowing any bridge internals:

```php
use Native\Mobile\Testing\Native;

it('syncs everything on wifi', function () {
    Native::fakeBridge()->withWifi();

    Native::test(SyncButton::class)
        ->tap('Sync now')
        ->assertNetworkChecked();
});

it('warns instead of syncing when offline', function () {
    Native::fakeBridge()->withOffline();

    Native::test(SyncButton::class)
        ->tap('Sync now')
        ->assertSee('No connection');
});
```

### Helpers

- `withNetworkStatus(array $status = [])` — fake the raw response to `status()`. Accepts any of `connected`, `type`, `isExpensive`, `isConstrained`, `error` — the same fields the native bridge returns.
- `withWifi(array $extra = [])` — fake a connected, unmetered, unconstrained Wi-Fi status. Pass `$extra` to override individual fields.
- `withCellular(array $extra = [])` — fake a connected, metered cellular status.
- `withOffline(array $extra = [])` — fake a disconnected status (`type: 'unknown'`).
- `withError(string $error = 'Unknown error', array $extra = [])` — fake the native error path (e.g. an Android catch reporting failure to read connectivity state).
- `assertNetworkChecked()` — assert `status()` was called.

The helpers are available on `Native::fakeBridge()` and chain directly off `Native::test(...)`. They register automatically while running tests (requires a core with a macroable FakeBridge; on older cores they simply don't register).

Note that `status()` decodes the bridge's JSON response without the `true` flag, so it returns a `stdClass` object (`$status->type`), not an array — the same is true of the objects returned while faked.

---

# Mobile Microphone

> Bifrost Technology

<div class="plugin-info"><div class="pi-meta"><span class="pi-item"><span class="pi-label">Author</span><span class="pi-value">Bifrost Technology</span></span><span class="pi-item"><span class="pi-label">Plugin Type</span><span class="pi-badge pi-badge-first-party">1st Party Plugin</span></span><span class="pi-item"><span class="pi-label">Price</span><span class="pi-badge pi-badge-free">Free</span></span><span class="pi-item"><span class="pi-label">Version</span><span class="pi-value">v1.0.2</span></span><span class="pi-item"><span class="pi-label">License</span><span class="pi-value">MIT</span></span></div><div class="pi-compat"><span class="pi-chip"><span class="pi-chip-label">NativePHP</span><span class="pi-chip-value">^3.0</span></span><span class="pi-chip"><span class="pi-chip-label">iOS</span><span class="pi-chip-value">18.2+</span></span><span class="pi-chip"><span class="pi-chip-label">Android</span><span class="pi-chip-value">26+</span></span></div><div class="pi-links"><a href="https://github.com/NativePHP/mobile-microphone" class="pi-link" target="_blank" rel="noopener">GitHub →</a></div></div>

# Microphone Plugin for NativePHP Mobile

Audio recording plugin for NativePHP Mobile with pause/resume support, background recording, and native permission handling.

## Overview

The Microphone API provides access to the device's microphone for recording audio. It offers a fluent interface for starting and managing recordings, tracking them with unique identifiers, and responding to completion events.

## Installation

```bash
composer require nativephp/mobile-microphone
```

## Usage

### PHP (Livewire/Blade)

```php
use Native\Mobile\Facades\Microphone;

// Start recording
Microphone::record()->start();

// Stop recording
Microphone::stop();

// Pause recording
Microphone::pause();

// Resume recording
Microphone::resume();

// Get status
$status = Microphone::getStatus();
// Returns: "idle", "recording", or "paused"

// Get last recording path
$path = Microphone::getRecording();
```

### JavaScript (Vue/React/Inertia)

```js
import { Microphone, On, Off, Events } from '#nativephp';

// Basic recording
await Microphone.record();

// With identifier for tracking
await Microphone.record()
    .id('voice-memo');

// Stop recording
await Microphone.stop();

// Pause/resume
await Microphone.pause();
await Microphone.resume();

// Get status
const result = await Microphone.getStatus();
if (result.status === 'recording') {
    // Recording in progress
}

// Get last recording
const result = await Microphone.getRecording();
if (result.path) {
    // Process the recording
}
```

## PendingMicrophone API

### `id(string $id)`

Set a unique identifier for this recording.

```php
Microphone::record()
    ->id('voice-note-123')
    ->start();
```

### `event(string $eventClass)`

Set a custom event class to dispatch when recording completes.

```php
use App\Events\VoiceMessageRecorded;

Microphone::record()
    ->event(VoiceMessageRecorded::class)
    ->start();
```

### `remember()`

Store the recorder's ID in the session for later retrieval.

```php
Microphone::record()
    ->id('voice-note')
    ->remember()
    ->start();
```

### `start()`

Explicitly start the audio recording. Returns `true` if recording started successfully.

## Events

### `MicrophoneRecorded`

Dispatched when an audio recording completes.

**Payload:**
- `string $path` - File path to the recorded audio
- `string $mimeType` - MIME type of the audio (default: `'audio/m4a'`)
- `?string $id` - The recorder's ID, if one was set

#### PHP

```php
use Native\Mobile\Attributes\OnNative;
use Native\Mobile\Events\Microphone\MicrophoneRecorded;

#[OnNative(MicrophoneRecorded::class)]
public function handleAudioRecorded(string $path, string $mimeType, ?string $id)
{
    $this->recordings[] = [
        'path' => $path,
        'mimeType' => $mimeType,
        'id' => $id,
    ];
}
```

#### Vue

```js
import { On, Off, Events } from '#nativephp';
import { ref, onMounted, onUnmounted } from 'vue';

const recordings = ref([]);

const handleAudioRecorded = (payload) => {
    const { path, mimeType, id } = payload;
    recordings.value.push({ path, mimeType, id });
};

onMounted(() => {
    On(Events.Microphone.MicrophoneRecorded, handleAudioRecorded);
});

onUnmounted(() => {
    Off(Events.Microphone.MicrophoneRecorded, handleAudioRecorded);
});
```

#### React

```jsx
import { On, Off, Events } from '#nativephp';
import { useState, useEffect } from 'react';

const [recordings, setRecordings] = useState([]);

const handleAudioRecorded = (payload) => {
    const { path, mimeType, id } = payload;
    setRecordings(prev => [...prev, { path, mimeType, id }]);
};

useEffect(() => {
    On(Events.Microphone.MicrophoneRecorded, handleAudioRecorded);

    return () => {
        Off(Events.Microphone.MicrophoneRecorded, handleAudioRecorded);
    };
}, []);
```

## Testing

The plugin extends the NativePHP testing suite with microphone-specific helpers, so your app tests can fake recordings and assert recording activity without knowing any bridge internals:

```php
use Native\Mobile\Testing\Native;

it('saves a voice memo', function () {
    Native::fakeBridge()->withRecording('/storage/emulated/0/audio/note.m4a');

    Native::test(VoiceMemo::class)
        ->tap('Record')
        ->assertRecordingStarted();
});

it('shows the paused state in the UI', function () {
    Native::fakeBridge()->withMicrophoneStatus('paused');

    Native::test(VoiceMemo::class)
        ->assertSet('status', 'paused');
});
```

### Helpers

- `withRecording(?string $path = null)` — fake a completed recording. `getStatus()` reports `"idle"` and `getRecording()` reports `$path` (a generic `.m4a` path when omitted) — the state right after a real recording session ends.
- `withMicrophoneStatus(string $status)` — script `getStatus()` directly (e.g. `"recording"` or `"paused"`), without a completed recording on disk.
- `assertRecordingStarted()` — assert a recording was started.
- `assertRecordingStopped()` — assert the recording was stopped.
- `assertNothingRecorded()` — assert no recording was ever started.

The helpers are available on `Native::fakeBridge()` and chain directly off `Native::test(...)`. They register automatically while running tests (requires a core with a macroable FakeBridge; on older cores they simply don't register).

## Notes

- **Microphone Permission:** The first time your app requests microphone access, users will be prompted for permission. If denied, recording functions will fail silently.

- **Background Recording:** You can allow your app to record audio while the device is locked by toggling `microphone_background` to true in the config.

- **File Format:** Recordings are stored as M4A/AAC audio files (`.m4a`). This format is optimized for small file sizes while maintaining quality.

- **Recording State:** Only one recording can be active at a time. Calling `start()` while a recording is in progress will return `false`.

- **Auto-Start Behavior:** If you don't explicitly call `start()`, the recording will automatically start when the `PendingMicrophone` is destroyed.

---

# Mobile Device

> Bifrost Technology

<div class="plugin-info"><div class="pi-meta"><span class="pi-item"><span class="pi-label">Author</span><span class="pi-value">Bifrost Technology</span></span><span class="pi-item"><span class="pi-label">Plugin Type</span><span class="pi-badge pi-badge-first-party">1st Party Plugin</span></span><span class="pi-item"><span class="pi-label">Price</span><span class="pi-badge pi-badge-free">Free</span></span><span class="pi-item"><span class="pi-label">Version</span><span class="pi-value">v1.0.3</span></span><span class="pi-item"><span class="pi-label">License</span><span class="pi-value">MIT</span></span></div><div class="pi-compat"><span class="pi-chip"><span class="pi-chip-label">NativePHP</span><span class="pi-chip-value">^3.0</span></span><span class="pi-chip"><span class="pi-chip-label">iOS</span><span class="pi-chip-value">18.2+</span></span><span class="pi-chip"><span class="pi-chip-label">Android</span><span class="pi-chip-value">26+</span></span></div><div class="pi-links"><a href="https://github.com/NativePHP/mobile-device" class="pi-link" target="_blank" rel="noopener">GitHub →</a></div></div>

# Device Plugin for NativePHP Mobile

Device hardware operations including vibration, flashlight, device info, and battery status.

## Overview

The Device API provides access to device hardware features and information.

## Installation

```bash
composer require nativephp/mobile-device
```

## Usage

### PHP (Livewire/Blade)

```php
use Native\Mobile\Facades\Device;

// Vibrate the device
Device::vibrate();

// Toggle flashlight
$result = Device::toggleFlashlight();
// Returns: ['success' => true, 'state' => true|false]

// Get device ID
$result = Device::getId();
// Returns: ['id' => 'unique-device-id']

// Get device info
$result = Device::getInfo();
// Returns: ['info' => '{"name":"iPhone","model":"iPhone","platform":"ios",...}']

// Get battery info
$result = Device::getBatteryInfo();
// Returns: ['info' => '{"batteryLevel":0.85,"isCharging":false}']
```

### JavaScript (Vue/React/Inertia)

```js
import { Device } from '#nativephp';

// Vibrate the device
await Device.vibrate();

// Toggle flashlight
const flashResult = await Device.toggleFlashlight();
console.log('Flashlight state:', flashResult.state);

// Get device ID
const idResult = await Device.getId();
console.log('Device ID:', idResult.id);

// Get device info
const infoResult = await Device.getInfo();
const info = JSON.parse(infoResult.info);
console.log('Platform:', info.platform);

// Get battery info
const batteryResult = await Device.getBatteryInfo();
const battery = JSON.parse(batteryResult.info);
console.log('Battery level:', battery.batteryLevel * 100 + '%');
```

## Methods

### `vibrate(): array`

Vibrate the device.

**Returns:** `{ success: true }`

### `toggleFlashlight(): array`

Toggle the device flashlight on/off.

**Returns:** `{ success: boolean, state: boolean }`

### `getId(): array`

Get the unique device identifier.

**Returns:** `{ id: string }`

- iOS: Uses `identifierForVendor` UUID
- Android: Uses `ANDROID_ID`

### `getInfo(): array`

Get detailed device information.

**Returns:** `{ info: string }` (JSON string)

Device info includes:
- `name` - Device name
- `model` - Device model
- `platform` - "ios" or "android"
- `operatingSystem` - OS name
- `osVersion` - OS version string
- `manufacturer` - Device manufacturer
- `language` - Device language as BCP 47 tag (e.g. "en-US")
- `isVirtual` - Whether running in simulator/emulator
- `memUsed` - Memory usage in bytes
- `webViewVersion` - WebView version

### `getBatteryInfo(): array`

Get battery level and charging status.

**Returns:** `{ info: string }` (JSON string)

Battery info includes:
- `batteryLevel` - Battery level from 0.0 to 1.0
- `isCharging` - Whether device is charging

## Permissions

### Android
- `android.permission.VIBRATE` - For vibration
- `android.permission.FLASHLIGHT` - For flashlight control

### iOS
No special permissions required.

---

# Mobile Camera

> Bifrost Technology

<div class="plugin-info"><div class="pi-meta"><span class="pi-item"><span class="pi-label">Author</span><span class="pi-value">Bifrost Technology</span></span><span class="pi-item"><span class="pi-label">Plugin Type</span><span class="pi-badge pi-badge-first-party">1st Party Plugin</span></span><span class="pi-item"><span class="pi-label">Price</span><span class="pi-badge pi-badge-free">Free</span></span><span class="pi-item"><span class="pi-label">Version</span><span class="pi-value">v1.0.4</span></span><span class="pi-item"><span class="pi-label">License</span><span class="pi-value">MIT</span></span></div><div class="pi-compat"><span class="pi-chip"><span class="pi-chip-label">NativePHP</span><span class="pi-chip-value">^3.0</span></span><span class="pi-chip"><span class="pi-chip-label">iOS</span><span class="pi-chip-value">18.2+</span></span><span class="pi-chip"><span class="pi-chip-label">Android</span><span class="pi-chip-value">26+</span></span></div><div class="pi-links"><a href="https://github.com/NativePHP/mobile-camera" class="pi-link" target="_blank" rel="noopener">GitHub →</a></div></div>

# Camera Plugin for NativePHP Mobile

Camera plugin for NativePHP Mobile providing photo capture, video recording, and gallery picker functionality.

## Overview

The Camera API provides access to the device's camera for taking photos, recording videos, and selecting media from the gallery.

## Installation

```shell
composer require nativephp/mobile-camera
```

Don't forget to register the plugin:

```shell
php artisan native:plugin:register nativephp/mobile-camera
```

## Usage

### PHP (Livewire/Blade)

```php
use Native\Mobile\Facades\Camera;

// Take a photo
Camera::getPhoto();

// Record a video
Camera::recordVideo();

// Record with max duration
Camera::recordVideo(['maxDuration' => 30]);

// Using fluent API
Camera::recordVideo()
    ->maxDuration(60)
    ->id('my-video-123')
    ->start();

// Pick images from gallery
Camera::pickImages('images', false);  // Single image
Camera::pickImages('images', true);   // Multiple images
Camera::pickImages('all', true);      // Any media type
```

### JavaScript (Vue/React/Inertia)

```js
import { Camera, On, Off, Events } from '#nativephp';

// Take a photo
await Camera.getPhoto();

// With identifier for tracking
await Camera.getPhoto()
    .id('profile-pic');

// Record video
await Camera.recordVideo()
    .maxDuration(60);

// Pick images
await Camera.pickImages()
    .images()
    .multiple()
    .maxItems(5);
```

## Events

### `PhotoTaken`

Fired when a photo is taken with the camera.

#### PHP

```php
use Native\Mobile\Attributes\OnNative;
use Native\Mobile\Events\Camera\PhotoTaken;

#[OnNative(PhotoTaken::class)]
public function handlePhotoTaken(string $path)
{
    // Process the captured photo
    $this->processPhoto($path);
}
```

#### Vue

```js
import { On, Off, Events } from '#nativephp';
import { ref, onMounted, onUnmounted } from 'vue';

const photoPath = ref('');

const handlePhotoTaken = (payload) => {
    photoPath.value = payload.path;
    processPhoto(payload.path);
};

onMounted(() => {
    On(Events.Camera.PhotoTaken, handlePhotoTaken);
});

onUnmounted(() => {
    Off(Events.Camera.PhotoTaken, handlePhotoTaken);
});
```

### `VideoRecorded`

Fired when a video is successfully recorded.

**Payload:**
- `string $path` - File path to the recorded video
- `string $mimeType` - Video MIME type (default: `'video/mp4'`)
- `?string $id` - Optional identifier if set via `id()` method

### `VideoCancelled`

Fired when video recording is cancelled by the user.

### `MediaSelected`

Fired when media is selected from the gallery.

```php
use Native\Mobile\Attributes\OnNative;
use Native\Mobile\Events\Gallery\MediaSelected;

#[OnNative(MediaSelected::class)]
public function handleMediaSelected($success, $files, $count)
{
    foreach ($files as $file) {
        $this->processMedia($file);
    }
}
```

## PendingVideoRecorder API

### `maxDuration(int $seconds)`

Set the maximum recording duration in seconds.

### `id(string $id)`

Set a unique identifier for this recording to correlate with events.

### `event(string $eventClass)`

Set a custom event class to dispatch when recording completes.

### `remember()`

Store the recorder's ID in the session for later retrieval.

### `start()`

Explicitly start the video recording.

## Storage Locations

**Photos:**
- **Android:** App cache directory at `{cache}/captured.jpg`
- **iOS:** Application Support at `~/Library/Application Support/Photos/captured.jpg`

**Videos:**
- **Android:** App cache directory at `{cache}/video_{timestamp}.mp4`
- **iOS:** Application Support at `~/Library/Application Support/Videos/captured_video_{timestamp}.mp4`

## Testing

The plugin extends the NativePHP testing suite with camera-specific helpers, so your app tests can assert capture/recording/picker activity without knowing any bridge internals.

`getPhoto()`, `recordVideo()`, and `pickImages()` only open the native camera or gallery UI — the result (`PhotoTaken`, `VideoRecorded`, `MediaSelected`, or a cancellation/permission-denied counterpart) arrives later as an async event that the bridge never answers synchronously. So these helpers assert that a request was made; there's no `with*` helper to preload a captured photo or picked media.

```php
use Native\Mobile\Testing\Native;

it('opens the camera when taking a profile photo', function () {
    Native::test(ProfileEditor::class)
        ->tap('Take photo')
        ->assertPhotoRequested();
});

it('opens the gallery picker for a single image', function () {
    Native::test(ProfileEditor::class)
        ->tap('Choose from gallery')
        ->assertMediaPicked(fn (array $p) => $p['mediaType'] === 'image' && $p['multiple'] === false);
});

it('does not touch the camera on a plain form save', function () {
    Native::test(ProfileEditor::class)
        ->tap('Save')
        ->assertNothingCaptured();
});
```

### Helpers

- `assertPhotoRequested()` — assert a photo capture was started (`Camera::getPhoto()->start()`).
- `assertVideoRequested()` — assert a video recording was started (`Camera::recordVideo()->start()`).
- `assertMediaPicked(?callable $filter = null)` — assert the gallery picker was opened, optionally matching the decoded call params (e.g. `mediaType`, `multiple`, `maxItems`).
- `assertNothingCaptured()` — assert no photo, video, or media picker request was made.

The helpers are available on `Native::fakeBridge()` and chain directly off `Native::test(...)`. They register automatically while running tests (requires a core with a macroable FakeBridge; on older cores they simply don't register).

## Notes

- **Permissions:** You must enable the `camera` permission in `config/nativephp.php` to use camera features
- If permission is denied, camera functions will fail silently
- Camera permission is required for photos, videos, AND QR/barcode scanning
- File formats: JPEG for photos, MP4 for videos

---

# Mobile Media Player

> Shane Rosenthal

<div class="plugin-info"><div class="pi-meta"><span class="pi-item"><span class="pi-label">Author</span><span class="pi-value">Shane Rosenthal</span></span><span class="pi-item"><span class="pi-label">Plugin Type</span><span class="pi-badge pi-badge-first-party">1st Party Plugin</span></span><span class="pi-item"><span class="pi-label">Price</span><span class="pi-badge pi-badge-free">Free</span></span><span class="pi-item"><span class="pi-label">Version</span><span class="pi-value">v1.0.1</span></span><span class="pi-item"><span class="pi-label">License</span><span class="pi-value">MIT</span></span></div><div class="pi-compat"><span class="pi-chip"><span class="pi-chip-label">NativePHP</span><span class="pi-chip-value">^3.0 || ^4.0</span></span><span class="pi-chip"><span class="pi-chip-label">iOS</span><span class="pi-chip-value">16.0+</span></span><span class="pi-chip"><span class="pi-chip-label">Android</span><span class="pi-chip-value">26+</span></span></div><div class="pi-links"><a href="https://github.com/NativePHP/mobile-media-player" class="pi-link" target="_blank" rel="noopener">GitHub →</a></div></div>

# Media Player Plugin for NativePHP Mobile

Audio/video playback for NativePHP Mobile: a shared background player driven from PHP, a full-screen system player, and an inline `<video-player>` element for native (Edge) views.

## Overview

The plugin provides three ways to play media:

- **Shared player** — `MediaPlayer::play()` plays audio or video sources app-wide (AVPlayer on iOS, MediaPlayer on Android) with pause/resume/seek/volume control from PHP.
- **Full-screen presentation** — `MediaPlayer::present()` opens the system player UI (AVPlayerViewController on iOS, a dedicated full-screen activity on Android); the user dismisses it natively.
- **Inline `<video-player>` element** — a video surface for native UI views, rendered as SwiftUI `VideoPlayer` (AVKit) on iOS and a `VideoView` inside Compose on Android.

## Installation

```shell
composer require nativephp/mobile-media-player
```

Don't forget to register the plugin:

```shell
php artisan native:plugin:register nativephp/mobile-media-player
```

## Usage

### Shared player (PHP)

```php
use NativePHP\MediaPlayer\Facades\MediaPlayer;

// Play a bundled file, storage path, or URL
MediaPlayer::play(storage_path('app/theme.mp3'));

// With options
MediaPlayer::play('https://example.com/stream.mp3', [
    'loop' => true,
    'volume' => 0.5,
]);

// Transport controls
MediaPlayer::pause();
MediaPlayer::resume();
MediaPlayer::seek(42.5);        // seconds
MediaPlayer::setVolume(0.8);    // 0.0 – 1.0
MediaPlayer::stop();            // stops and releases the player

// Poll playback state
$status = MediaPlayer::getStatus();
// ['state' => 'playing', 'position' => 12.3, 'duration' => 180.0, 'source' => '...']
```

`play()` and `present()` return `false` when the source can't be started (or when
running outside the native runtime).

### Full-screen system player

```php
MediaPlayer::present(storage_path('app/videos/intro.mp4'));
```

### Inline video in native views

```blade
<video-player :src="$video['path']" controls class="w-full aspect-video rounded-2xl"/>
```

Attributes:

| Attribute  | Default | Description |
|------------|---------|-------------|
| `src`      | —       | File path or URL |
| `controls` | `true`  | Show native transport chrome |
| `autoplay` | `false` | Start playback on mount |
| `loop`     | `false` | Restart when playback ends |
| `muted`    | `false` | Start muted |

Sizing follows the element's layout props (`width`/`height`/`aspect` classes), like `Image`.

With `controls=false` you get a bare video surface — overlay your own Element UI
and drive playback through the `MediaPlayer` facade:

```blade
<stack class="w-full aspect-video">
    <video-player :src="$src" :controls="false" autoplay muted class="w-full h-full"/>
    <button @press="togglePlayback" icon="pause.fill" class="absolute bottom-2 right-2"/>
</stack>
```

### Building the element from PHP

```php
use NativePHP\MediaPlayer\Elements\VideoPlayer;

VideoPlayer::make($path)
    ->controls(false)
    ->autoplay()
    ->loop()
    ->muted();
```

## Events

### `PlaybackEnded`

Fired when the shared player reaches the end of the source.

**Payload:** `string $source`

```php
use Native\Mobile\Attributes\OnNative;
use NativePHP\MediaPlayer\Events\PlaybackEnded;

#[OnNative(PlaybackEnded::class)]
public function handlePlaybackEnded(string $source)
{
    $this->playNext();
}
```

### `PlaybackError`

Fired when the shared player fails to load or play a source.

**Payload:** `string $source`, `string $message`

```php
use Native\Mobile\Attributes\OnNative;
use NativePHP\MediaPlayer\Events\PlaybackError;

#[OnNative(PlaybackError::class)]
public function handlePlaybackError(string $source, string $message)
{
    $this->status = "Playback failed: {$message}";
}
```

## Status values

`MediaPlayer::getStatus()['state']` is one of: `idle`, `playing`, `paused`.

## Testing

The plugin extends the NativePHP testing suite with playback-specific helpers, so your app tests can fake and assert media activity without knowing any bridge internals:

```php
use Native\Mobile\Testing\Native;

it('plays the selected track', function () {
    Native::fakeBridge();

    Native::test(NowPlaying::class)
        ->tap('Play')
        ->assertPlayed('https://example.com/stream.mp3');
});

it('shows where playback is', function () {
    Native::fakeBridge()->withPlaybackStatus('playing', position: 12.0, duration: 180.0);

    Native::test(NowPlaying::class)
        ->call('refresh')
        ->assertSee('0:12 / 3:00');
});

it('pauses, seeks, and stops', function () {
    Native::fakeBridge();

    Native::test(NowPlaying::class)
        ->tap('Pause')->assertPaused()
        ->tap('Skip forward')->assertSeeked(30.0)
        ->tap('Stop')->assertStopped();
});
```

### Helpers

- `withPlaybackStatus(string $state = 'playing', float $position = 0.0, float $duration = 0.0, ?string $source = null)` — script the status `getStatus()` reports. `$state` is one of `idle`, `playing`, `paused`.
- `assertPlayed(?string $source = null)` — assert playback was started, or exactly `$source` (a path or URL) when given.
- `assertPaused()` — assert playback was paused.
- `assertStopped()` — assert playback was stopped and the player released.
- `assertSeeked(?float $to = null)` — assert a seek happened, or to exactly `$to` seconds when given.
- `assertNothingPlayed()` — assert no playback was started.

The helpers are available on `Native::fakeBridge()` and chain directly off `Native::test(...)`. They register automatically while running tests (requires a core with a macroable FakeBridge; on older cores they simply don't register).

## Platform Support

- **iOS:** 16.0+ (AVPlayer / AVKit)
- **Android:** API 26+ (MediaPlayer / Media3 UI)

## Notes

- One shared player: calling `play()` replaces whatever is currently playing.
- Remote URLs require network access; local paths must be readable by the app
  (e.g. `storage_path()` or bundled assets).
- No runtime permissions are required.

---

# Mobile Vibe

> Shane Rosenthal

<div class="plugin-info"><div class="pi-meta"><span class="pi-item"><span class="pi-label">Author</span><span class="pi-value">Shane Rosenthal</span></span><span class="pi-item"><span class="pi-label">Plugin Type</span><span class="pi-badge pi-badge-first-party">1st Party Plugin</span></span><span class="pi-item"><span class="pi-label">Price</span><span class="pi-badge pi-badge-free">Free</span></span><span class="pi-item"><span class="pi-label">Version</span><span class="pi-value">v2.0.0</span></span><span class="pi-item"><span class="pi-label">License</span><span class="pi-value">MIT</span></span></div><div class="pi-compat"><span class="pi-chip"><span class="pi-chip-label">NativePHP</span><span class="pi-chip-value">^3.0 || ^4.0</span></span><span class="pi-chip"><span class="pi-chip-label">PHP</span><span class="pi-chip-value">^8.3</span></span><span class="pi-chip"><span class="pi-chip-label">iOS</span><span class="pi-chip-value">15.0+</span></span><span class="pi-chip"><span class="pi-chip-label">Android</span><span class="pi-chip-value">26+</span></span></div><div class="pi-links"><a href="https://github.com/NativePHP/mobile-vibe" class="pi-link" target="_blank" rel="noopener">GitHub →</a></div></div>

# Vibe — websockets for NativePHP Mobile

Vibe brings live server events into your NativePHP Mobile app over the **Pusher
protocol** — so it works with **Vask**, **Laravel Reverb**, or **Pusher** without
changing your code. Your PHP components subscribe to channels and react to
broadcasts, exactly like Laravel Echo does in the browser.

The websocket lives on the native side (Swift/Kotlin, via the official Pusher
SDKs); PHP just declares what to subscribe to and handles the events.

## Requirements

- PHP 8.3+, `nativephp/mobile` **v4** with Edge components (`NativeComponent`) — v3 is not supported: the plugin's native event pipeline (`NativeElementBridge`) only exists in the v4 core
- A Pusher-protocol websocket server: [Vask](https://vask.dev), [Laravel Reverb](https://laravel.com/docs/reverb), or [Pusher](https://pusher.com)

## Install

```bash
composer require nativephp/mobile-vibe
php artisan native:plugin:register nativephp/mobile-vibe
```

## Configure

Use the standard Laravel `PUSHER_*` vars in your app's `.env` (they're bundled
into the app at build time):

```dotenv
PUSHER_APP_KEY=your-app-key
PUSHER_HOST=wss.vask.dev      # the WEBSOCKET host
PUSHER_PORT=443
PUSHER_SCHEME=https
```

The app secret is **never** shipped to the device.

If `PUSHER_APP_KEY` / `PUSHER_HOST` are missing when you subscribe on-device,
Vibe throws a `VibeException` immediately rather than failing silently.

## Public channels

```php
use NativePHP\Vibe\Facades\Vibe;

public function mount(): void
{
    Vibe::channel('orders')->on('OrderShipped', function ($event) {
        $this->status = $event->status;   // $this is the component
    });
}
```

Events arrive as native events and re-render the component. Match the event name
to what your server broadcasts — **without** `broadcastAs()` that's the full
class name (`App\Events\OrderShipped`), so use `broadcastAs()` to keep it short.
Unlike Laravel Echo, do **not** prefix the name with a dot: Vibe matches the raw
broadcast name (`'OrderShipped'`, not `'.OrderShipped'`).

Listeners are **channel-scoped**: an `OrderShipped` listener on `orders` never
fires for a different channel that happens to broadcast the same event name.

You can also use an attribute instead of the fluent `->on()` — pass the channel
so the listener is scoped (use the full name as subscribed, e.g.
`private-orders.42` for `Vibe::private('orders.42')`):

```php
#[\NativePHP\Vibe\Attributes\OnEcho('OrderShipped', channel: 'orders')]
public function shipped(string $status): void { ... }
```

## Private channels

Private (`private-`) and presence (`presence-`) channels require a signed
authorization from **your remote Laravel backend**. The default
`/broadcasting/auth` route is session-guarded, which won't work for a mobile
bearer token — register it under your API middleware instead:

```php
// Your BACKEND's broadcasting setup (e.g. AppServiceProvider::boot())
Broadcast::routes(['prefix' => 'api/v1', 'middleware' => ['auth:sanctum']]);
```

Then point Vibe at it and give it the current bearer token:

```dotenv
VIBE_AUTH_ENDPOINT=https://your-backend.example.com/api/v1/broadcasting/auth
```

```php
// e.g. in AppServiceProvider::boot()
use NativePHP\Vibe\Facades\Vibe;
use Native\Mobile\Facades\SecureStorage;

Vibe::resolveTokenUsing(fn () => SecureStorage::get('api_token'));
```

```php
Vibe::private('orders.42')->on('OrderShipped', fn ($e) => $this->status = $e->status);
```

Subscribing to a private/presence channel without `VIBE_AUTH_ENDPOINT` set
throws a `VibeException`.

After a re-login / token refresh, push the new token to the live connection:

```php
Vibe::withToken($freshToken);
```

## Presence channels

Presence channels track who's online. The auth response carries `channel_data`
(user id + info); Vibe surfaces the roster and member changes:

```php
Vibe::presence('room.1')
    ->here(fn (array $members) => $this->online = $members)   // each: ['id' => , 'info' => [...]]
    ->joining(fn (array $member) => $this->online[] = $member)
    ->leaving(fn (array $member) => /* remove */)
    ->on('MessageSent', fn ($e) => $this->messages[] = $e->body);
```

On reconnect the SDKs re-subscribe and the `here` roster is delivered again —
you don't need to rebuild presence state manually.

## Whispers (client events)

Send ephemeral events directly to the other subscribers of a private/presence
channel (no server round-trip, not persisted) — typing indicators, cursors:

```php
$room = Vibe::presence('room.1')
    ->listenForWhisper('typing', fn ($e) => $this->typing = $e->name);

$room->whisper('typing', ['name' => $this->name]);   // sender doesn't receive its own whisper
```

## Connection lifecycle & errors

```php
Vibe::channel('orders')
    ->on('OrderShipped', fn ($e) => $this->refresh())
    ->onDisconnect(fn () => $this->live = false)        // show "reconnecting…"
    ->onReconnect(fn () => $this->refetch())            // refetch missed state
    ->onError(fn ($e) => logger()->warning("vibe: {$e->type} {$e->message}"));
```

- `onReconnect` / `onDisconnect` / `onError` are **connection-level** — they
  fire regardless of which subscription registered them.
- `onError` receives `{ type, channel, message }` for failed channel auth
  (e.g. a 403 from `/broadcasting/auth`), failed subscriptions, and connection
  errors — the failures that are otherwise invisible on a device.

## Lifecycle

- Subscriptions are torn down automatically when the component unmounts —
  including attribute-only usage (`Vibe::channel(...)` in `mount()` +
  `#[OnEcho]`).
- Channels are refcounted natively: if two components subscribe to the same
  channel, it stays open until the last one leaves. The socket disconnects
  when no channels remain.
- Listeners must be registered from within a `NativeComponent` (typically
  `mount()`); registering elsewhere throws a `VibeException`.

## On your server

The app is a plain Pusher-protocol subscriber, so the server side is standard
[Laravel broadcasting](https://laravel.com/docs/broadcasting). The three pieces
Vibe cares about:

```php
// 1. The event — broadcastAs() keeps the client-side name short; the payload
//    ($event->message on the device) comes from public properties or broadcastWith().
class OrderShipped implements ShouldBroadcast
{
    public function __construct(public string $message) {}

    public function broadcastOn(): Channel
    {
        return new PrivateChannel('orders.'.$this->orderId);
    }

    public function broadcastAs(): string
    {
        return 'OrderShipped';
    }
}
```

```php
// 2. routes/channels.php — authorize private channels (true/false)...
Broadcast::channel('orders.{orderId}', fn ($user, $orderId) => $user->canSee($orderId));

// 3. ...and presence channels, which must RETURN THE MEMBER ARRAY — this becomes
//    channel_data in the auth response and is what here()/joining() receive as
//    ['id' => ..., 'info' => [...]]. Returning true breaks the roster.
Broadcast::channel('room.{id}', fn ($user, $id) => ['id' => $user->id, 'name' => $user->name]);
```

Whispers require client events to be enabled on your websocket server (Pusher:
app settings → "Enable client events"; check your Reverb/Vask config).

## Troubleshooting

**Nothing arrives:**
- Event name mismatch — no `broadcastAs()` means the name is the FQCN
  (`App\Events\OrderShipped`); and no leading dot, unlike Echo.
- `#[OnEcho]` channel mismatch — use the **full** channel name as subscribed:
  `channel: 'private-orders.42'`, not `channel: 'orders.42'`.
- The app is backgrounded — the OS suspends the socket; events are
  foreground-only.
- Queued broadcasts need a running queue worker on the server (or
  `ShouldBroadcastNow`).

**Private/presence fails:** attach `->onError()` — auth rejections arrive as
`auth_failed` / `subscription_failed` with the reason. Usual suspects: expired
bearer token, `VIBE_AUTH_ENDPOINT` pointing at a dead tunnel/host, or the
backend route not guarded by an API (token) middleware.

**Misconfiguration throws:** missing `PUSHER_APP_KEY`/`PUSHER_HOST`, or a
private/presence subscribe without `VIBE_AUTH_ENDPOINT`, throws `VibeException`
at subscribe-time rather than failing silently.

## Notes

- Websockets are foreground-only on mobile (the OS suspends the socket in the
  background). For delivery while the app is closed, use push notifications.
- Websocket events signal *liveness*, not source of truth — on reconnect, refetch
  authoritative state (`onReconnect` is built for exactly this).

---

# Mobile Clipboard

> Shane Rosenthal

<div class="plugin-info"><div class="pi-meta"><span class="pi-item"><span class="pi-label">Author</span><span class="pi-value">Shane Rosenthal</span></span><span class="pi-item"><span class="pi-label">Plugin Type</span><span class="pi-badge pi-badge-first-party">1st Party Plugin</span></span><span class="pi-item"><span class="pi-label">Price</span><span class="pi-badge pi-badge-free">Free</span></span><span class="pi-item"><span class="pi-label">Version</span><span class="pi-value">v1.0.0</span></span><span class="pi-item"><span class="pi-label">License</span><span class="pi-value">MIT</span></span></div><div class="pi-compat"><span class="pi-chip"><span class="pi-chip-label">NativePHP</span><span class="pi-chip-value">^3.0 || ^4.0</span></span><span class="pi-chip"><span class="pi-chip-label">iOS</span><span class="pi-chip-value">18.2+</span></span><span class="pi-chip"><span class="pi-chip-label">Android</span><span class="pi-chip-value">26+</span></span></div><div class="pi-links"><a href="https://github.com/NativePHP/mobile-clipboard" class="pi-link" target="_blank" rel="noopener">GitHub →</a></div></div>

# Clipboard Plugin for NativePHP Mobile

System clipboard access (copy/paste plain text) for NativePHP Mobile applications.

## Overview

The Clipboard API reads and writes plain text on the system clipboard. Two methods, no permissions, no events.

## Installation

```bash
composer require nativephp/mobile-clipboard
php artisan native:plugin:register nativephp/mobile-clipboard
```

## Usage

```php
use NativePHP\Clipboard\Facades\Clipboard;

// Copy text to the clipboard
$copied = Clipboard::writeText('Hello from NativePHP!');   // true on success

// Read text from the clipboard
$text = Clipboard::readText();   // string, or null if the clipboard has no text

if ($text !== null) {
    // Use the pasted text
}
```

## Methods

### `writeText(string $text): bool`

Writes plain text to the system clipboard. Returns `true` once the text is on the clipboard, `false` on failure.

### `readText(): ?string`

Reads plain text from the system clipboard. Returns `null` when the clipboard is empty or holds no text.

Both methods degrade gracefully when the native bridge isn't available (running tests, CI): `writeText()` returns `false` and `readText()` returns `null` — no exception is thrown.

## Testing

The plugin extends the NativePHP testing suite with clipboard-specific helpers, so your app tests can fake and assert clipboard activity without knowing any bridge internals:

```php
use Native\Mobile\Testing\Native;

it('copies the invite link', function () {
    Native::fakeBridge()->withClipboard();

    Native::test(ShareSheet::class)
        ->tap('Copy link')
        ->assertCopied('https://example.com/invite/abc');
});

it('pastes into the form', function () {
    Native::fakeBridge()->withClipboard('+1 555 0100');

    Native::test(SignupScreen::class)
        ->tap('Paste number')
        ->assertSet('phone', '+1 555 0100');
});
```

### Helpers

- `withClipboard(string $text = '')` — fake the clipboard's contents. Reads return the current text; writes succeed and update it, so copy-then-paste flows behave like a real clipboard.
- `assertCopied(?string $text = null)` — assert something was copied, or exactly `$text` when given.
- `assertNothingCopied()` — assert no write happened.

The helpers are available on `Native::fakeBridge()` and chain directly off `Native::test(...)`. They register automatically while running tests (requires a core with a macroable FakeBridge; on older cores they simply don't register).

---

# Mobile UI

> Shane Rosenthal

<div class="plugin-info"><div class="pi-meta"><span class="pi-item"><span class="pi-label">Author</span><span class="pi-value">Shane Rosenthal</span></span><span class="pi-item"><span class="pi-label">Plugin Type</span><span class="pi-badge pi-badge-first-party">1st Party Plugin</span></span><span class="pi-item"><span class="pi-label">Price</span><span class="pi-badge pi-badge-free">Free</span></span><span class="pi-item"><span class="pi-label">Version</span><span class="pi-value">v0.4.0</span></span><span class="pi-item"><span class="pi-label">License</span><span class="pi-value">MIT</span></span></div><div class="pi-compat"><span class="pi-chip"><span class="pi-chip-label">NativePHP</span><span class="pi-chip-value">^4.0</span></span><span class="pi-chip"><span class="pi-chip-label">PHP</span><span class="pi-chip-value">^8.2</span></span><span class="pi-chip"><span class="pi-chip-label">iOS</span><span class="pi-chip-value">any</span></span><span class="pi-chip"><span class="pi-chip-label">Android</span><span class="pi-chip-value">any</span></span></div><div class="pi-links"><a href="https://github.com/NativePHP/mobile-ui" class="pi-link" target="_blank" rel="noopener">GitHub →</a></div></div>

# NativeUI Plugin for NativePHP Mobile

A NativePHP Mobile plugin

## Installation

```bash
composer require nativephp/mobile-ui
```

## Usage

```php
use Native\Mobile I\Facades\NativeUI;

// Execute functionality
$result = NativeUI::execute(['option1' => 'value']);

// Get status
$status = NativeUI::getStatus();
```

## Listening for Events

```php
use Livewire\Attributes\On;

#[On('native:Native\Mobile I\Events\NativeUICompleted')]
public function handleNativeUICompleted($result, $id = null)
{
    // Handle the event
}
```

## Theming & Colors

Theme tokens live in `config/native-ui.php` (publish with
`php artisan vendor:publish --tag=native-ui-config`). Every authored color —
theme tokens, element color props, and arbitrary-value classes — accepts the
same grammar:

```php
'light' => [
    'primary'   => 'violet-600',      // Tailwind palette name
    'secondary' => 'fuchsia-500/70',  // opacity modifier → tonal fill
    'surface'   => '#F8FAFC',         // plain hex (#RGB / #RRGGBB)
    'accent'    => '#00AAA680',       // CSS alpha hex (#RRGGBBAA)
],
```

Alpha hex is authored in CSS `#RRGGBBAA` order; the framework converts to the
native wire format. Dark mode is auto-derived from `light` (alpha preserved)
unless a `dark` block overrides specific tokens.

Disabled controls draw from the `surface-variant` (fill) and
`on-surface-variant` (label) tokens on both platforms — adjust those two
tokens to tune disabled contrast app-wide.

Icons accept platform enum overrides in Blade, matching the fluent API:

```blade
<native:icon :ios="Ios::House" :android="Android::Home" :size="24" />
```

## Accessibility

Every element accepts a screen-reader label and an optional hint, via Blade
attributes (`a11y-label` / `a11y-hint`, or the camelCase spellings
`a11yLabel` / `a11yHint`) or the fluent API (`->a11yLabel()` / `->a11yHint()`).
The label maps to `accessibilityLabel` on iOS and `contentDescription` on
Android; the hint maps to `accessibilityHint` on iOS and is appended to the
content description on Android.

```blade
<native:button icon="trash" a11y-label="Delete draft" a11y-hint="Deletes the draft permanently" @press="deleteDraft" />
```

```php
use Native\Mobile I\Elements\Button;

Button::make()
    ->icon('plus')
    ->a11yLabel('Add item')
    ->a11yHint('Adds a new item to the list')
    ->onPress('addItem');
```

Always set `a11y-label` on icon-only buttons, chips, and tabs — without
visible text there is nothing for VoiceOver / TalkBack to announce. Icons are
decorative (silent to screen readers) unless given an `a11y-label`. List items
with a trailing icon button take `trailing-a11y-label` (fluent:
`->trailingA11yLabel()`) to label that button separately from the row.

## Date & Time Pickers

`<native:date-picker>` wraps SwiftUI's `DatePicker` and Material 3's
`DatePicker` / `TimePicker` behind one API.

```blade
<native:date-picker
    label="Appointment"
    mode="datetime"
    native:model="appointmentAt"
    min="2026-01-01"
    max="2026-12-31"
    timezone="Europe/Berlin"
    locale="de-DE"
    @change="appointmentChanged"
/>
```

```php
use Native\Mobile I\Elements\DatePicker;

DatePicker::make()
    ->label('Appointment')
    ->mode('datetime')
    ->value($this->appointmentAt)   // string or any DateTimeInterface
    ->min('2026-01-01')
    ->timezone('Europe/Berlin')
    ->locale('de-DE')
    ->onChange('appointmentChanged');
```

### The value contract

Values cross the bridge as **wall-clock ISO 8601 strings with no offset**,
shaped by `mode`:

| mode | wire value | example |
|---|---|---|
| `date` (default) | `Y-m-d` | `2026-07-25` |
| `time` | `H:i`, always 24-hour | `14:30` |
| `datetime` | `Y-m-d\TH:i` | `2026-07-25T14:30` |

No UTC conversion ever crosses the bridge. That is deliberate: it is what
keeps the classic off-by-one-day bug out of the element. Android's
`DatePickerState` reports UTC-midnight epoch millis and SwiftUI's `DatePicker`
binds an instant, so each renderer converts on its own side against one
agreed calendar — neither ever ships an instant.

`value`, `min`, and `max` accept an ISO string *or* any `DateTimeInterface`
(Carbon included), and a value finer than the mode needs is truncated — so a
`datetime` column can drive a date-only picker without reformatting:

```php
->mode('date')->value('2026-07-25T14:30:59Z')   // serializes as 2026-07-25
```

An empty string clears the selection; an unparseable one throws.

### Timezones and internationalization

`timezone` takes an IANA identifier and names **the calendar the picker
operates in** — what "today" means for an empty picker, and on iOS the
calendar used to convert between the bound instant and the wall-clock string.
It does *not* shift the wire value. Set it when your app pins a business
timezone instead of following the device; leave it unset to follow the device.

`locale` takes a BCP-47 tag and drives **display only** — month and weekday
names, weekday order, and the default clock convention. It never changes the
wire value, and the wire formatter is pinned to a Gregorian POSIX calendar so
a Buddhist- or Japanese-era locale can't leak a non-Gregorian year onto the
bridge.

`hour-format` (`auto` | `12` | `24`) overrides the clock convention. `auto`
resolves from the locale on **both** platforms — Android asks
`getBestDateTimePattern(locale, "jm")` rather than reading the device's
24-hour system setting, so the same `locale` gives the same result either
side.

### Display styles

`picker-style` picks the presentation, mapped to the nearest native idiom.
(It is not called `display` — that name is already flex/layout display on every
element.)

| `picker-style` | iOS | Android |
|---|---|---|
| `compact` (default) | `.compact` — tap to popover | trigger field + modal dialog |
| `inline` | `.graphical` — embedded calendar | embedded picker |
| `wheel` | `.wheel` — drum | **no drum in Material**; falls back to embedded |

### Platform notes

- `title`, `confirm-label`, and `cancel-label` are **Android only** — iOS
  commits on selection and has no dialog chrome to label. They are still
  user-visible strings, so pass translated values: `->confirmLabel(__('Done'))`.
- On iOS with `picker-style="compact"` and no value, a placeholder trigger stands
  in until first tap, because SwiftUI's compact picker always renders a
  concrete date and has no empty state.
- With `picker-style="inline"` and no initial value, neither platform commits the
  seeded "today" — you get a change event only once the user actually picks.
- `a11y-label` / `a11y-hint` are plumbed on both platforms; the current
  selection is additionally announced as the control's accessibility value.
- **`min` / `max` are rejected for `mode="time"`.** Neither platform can
  enforce a time-of-day range — SwiftUI's `in:` bounds an absolute instant, and
  Material 3's `TimePicker` has no bounds API — so passing them throws rather
  than silently doing nothing. Validate the chosen time in your component.
- **`picker-style="inline"` falls back to compact for `mode="time"` on iOS.**
  SwiftUI's `.graphical` style is date-only. Android embeds the time picker as
  asked.
- **Sync-mode modifiers are rejected.** A picker commits discretely, so
  `native:model.blur` / `native:model.debounce.300ms` have nothing to defer;
  they throw. Use plain `native:model`.

### Testing

The plugin registers picker vocabulary on the test harness, so screens read in
picker terms rather than raw select-change plumbing:

```php
Native::visit('/booking')
    ->pickDate('startsOn', '2026-12-24')
    ->pickTime('opensAt', new DateTimeImmutable('18:05'))
    ->pickDateTime('appointment', '2027-03-01T07:45')
    ->clearPicker('deadline')
    ->assertPicker('Starts', 'date')
    ->assertPickerValue('Starts', '2026-12-24')
    ->assertPickerEmpty('Deadline');
```

The `pick*` macros take an ISO string *or* any `DateTimeInterface` and
normalize to the wire shape for that mode before dispatching, so a test using
a Carbon instance or a full timestamp still sends exactly what the renderer
would. `assertPicker*` match on the picker's `label`.

Macros register only under a test runner, and only on a core whose
`TestableComponent` is macroable — the same `method_exists` gate the camera
plugin uses for its `FakeBridge` macros.

## Testing

Theme normalization and config write-back are pure PHP — no device, emulator,
or bridge round-trip required. `Theme::load()` / `Theme::merge()` resolve
authored color tokens (Tailwind names, `red-300/20` opacity modifiers, CSS
`#RRGGBBAA` alpha hex) to wire-format hex, auto-derive a dark block, and mirror
the effective set into `config('native-ui.theme.…')`. You can assert every step
of that in a unit test:

```php
use Illuminate\Config\Repository;
use Illuminate\Container\Container;
use Native\Mobile I\Theme;

it('normalizes tokens and mirrors them into config', function () {
    Container::getInstance()->instance('config', new Repository);

    try {
        Theme::load([
            'light' => ['primary' => 'red-300', 'accent' => '#8B5CF680'],
            'dark'  => ['primary' => 'red-800'],
        ]);

        // Normalized tokens are readable via Theme::get('mode.token'):
        expect(Theme::get('light.primary'))->toBe('#FCA5A5');   // palette name
        expect(Theme::get('light.accent'))->toBe('#808B5CF6');  // CSS alpha → wire ARGB

        // …and mirrored back so core's theme() helper reads wire-format hex:
        expect(config('native-ui.theme.light.primary'))->toBe('#FCA5A5');
        expect(config('native-ui.theme.dark.primary'))->toBe('#991B1B');
    } finally {
        Container::setInstance(null);
    }
});
```

Element color and typography props share the same grammar and serialize the
same way. Elements expose `toArray(new CallbackRegistry)` (via
`NativeElementCollector`), so you can assert what lands on the wire:

```php
use Native\Mobile\Edge\CallbackRegistry;
use Native\Mobile I\Elements\Button;

it('serializes typography props on an element', function () {
    $props = Button::make('Save')->font('Inter-Bold')->toArray(new CallbackRegistry)['props'];

    expect($props['font_name'])->toBe('Inter-Bold');
});
```

### Keeping `Theme::pushToNative()` off the wire

`Theme::load()` / `merge()` fire a `NativeUI.Theme.Set` bridge call on every
change. In a full Laravel test app, `pushToNative()`'s `runningUnitTests()`
guard suppresses it. In **plain Pest** (no booted app), that guard can't trip,
so mute the bridge in `beforeEach()` — the same pattern the plugin's own tests
use — and `reset()` between tests:

```php
use Native\Mobile\JumpBridge;
use Native\Mobile I\Theme;

beforeEach(function () {
    JumpBridge::instance()->mute();
    Theme::reset();
});

afterEach(fn () => Theme::reset());
```

---

# Image Resizer

> asciito

<div class="plugin-info"><div class="pi-meta"><span class="pi-item"><span class="pi-label">Author</span><span class="pi-value">asciito</span></span><span class="pi-item"><span class="pi-label">Plugin Type</span><span class="pi-badge pi-badge-community">Community Plugin</span></span><span class="pi-item"><span class="pi-label">Price</span><span class="pi-badge pi-badge-free">Free</span></span><span class="pi-item"><span class="pi-label">Version</span><span class="pi-value">v0.1.0</span></span><span class="pi-item"><span class="pi-label">License</span><span class="pi-value">MIT</span></span></div><div class="pi-compat"><span class="pi-chip"><span class="pi-chip-label">NativePHP</span><span class="pi-chip-value">^3.2</span></span><span class="pi-chip"><span class="pi-chip-label">PHP</span><span class="pi-chip-value">^8.2</span></span><span class="pi-chip"><span class="pi-chip-label">iOS</span><span class="pi-chip-value">any</span></span><span class="pi-chip"><span class="pi-chip-label">Android</span><span class="pi-chip-value">any</span></span></div><div class="pi-links"><a href="https://github.com/coyotito-mx/image-resizer" class="pi-link" target="_blank" rel="noopener">GitHub →</a></div></div>

NativePHP Mobile plugin that downscales images using native APIs — `ImageIO` on iOS and `BitmapFactory` on Android.

## Install

```bash
composer require coyotito/image-resizer
```

Register the plugin it the `NativeServiceProvider`:

```php
public function plugins(): array
{
    return [
        \Coyotito\ImageResizer\ImageResizerServiceProvider::class,
    ];
}
```

## Usage

```php
use Coyotito\ImageResizer\Facades\ImageResizer;

$ok = ImageResizer::resize(
    sourcePath: '/abs/path/to/source.jpg',
    targetPath: '/abs/path/to/target.jpg',
    maxSide: 1024,   // longest side cap; preserves aspect ratio, no upscale
    quality: 80,     // JPEG quality, 0-100
);
```

Returns `true` on success, `false` otherwise. Target is always written as JPEG. EXIF orientation is respected on both platforms.

## Platform notes

| Feature                | iOS                                | Android                            |
|------------------------|------------------------------------|------------------------------------|
| Decoder                | `CGImageSource` (ImageIO)          | `BitmapFactory` with `inSampleSize`|
| EXIF orientation       | Auto via thumbnail transform       | Explicit via `ExifInterface`       |
| Output format          | JPEG                               | JPEG                               |
| Memory efficiency      | Thumbnail API streams from disk    | `inSampleSize` downsamples on read |

---

# Mobile Photos

> Voicecode

<div class="plugin-info"><div class="pi-meta"><span class="pi-item"><span class="pi-label">Author</span><span class="pi-value">Voicecode</span></span><span class="pi-item"><span class="pi-label">Plugin Type</span><span class="pi-badge pi-badge-community">Community Plugin</span></span><span class="pi-item"><span class="pi-label">Price</span><span class="pi-badge pi-badge-free">Free</span></span><span class="pi-item"><span class="pi-label">Version</span><span class="pi-value">v1.0.0</span></span><span class="pi-item"><span class="pi-label">License</span><span class="pi-value">MIT</span></span></div><div class="pi-compat"><span class="pi-chip"><span class="pi-chip-label">NativePHP</span><span class="pi-chip-value">^3.0</span></span><span class="pi-chip"><span class="pi-chip-label">PHP</span><span class="pi-chip-value">^8.2</span></span><span class="pi-chip"><span class="pi-chip-label">iOS</span><span class="pi-chip-value">any</span></span><span class="pi-chip"><span class="pi-chip-label">Android</span><span class="pi-chip-value">29+</span></span></div><div class="pi-links"><a href="https://github.com/voicecode-bv/mobile-photos" class="pi-link" target="_blank" rel="noopener">GitHub →</a></div></div>

Save remote images and videos directly to the device photo library (camera roll on iOS, MediaStore gallery on Android) from a NativePHP Mobile app — no share sheet, no extra taps.

## Installation

```bash
composer require voicecode-bv/mobile-photos
```

After install, register the plugin so it gets compiled into the native projects:

```bash
php artisan native:plugin:register voicecode-bv/mobile-photos
```

Then rebuild the iOS and Android projects through the usual NativePHP build flow.

### iOS notes

The plugin manifest declares `NSPhotoLibraryAddUsageDescription`. You can override the prompt copy by setting your own value in `nativephp/ios/NativePHP/Info.plist` — the plugin compiler will not overwrite a key that already exists.

The plugin uses iOS' **add-only** authorization (`PHAccessLevel.addOnly`), which means users don't have to give full photo library access just to save a single file.

### Android notes

Requires Android 10 (API 29) or higher. Saves go through `MediaStore` so no runtime storage permission is needed.

## Usage

### From PHP

```php
use Voicecode\Mobile\Photos\Photos;

app(Photos::class)->save('https://cdn.example.com/photo.jpg');
app(Photos::class)->save('https://cdn.example.com/clip.mp4', 'video');
```

### From JavaScript / TypeScript

```ts
import { BridgeCall } from '@nativephp/mobile';

const result = await BridgeCall('Photos.Save', {
    url: 'https://cdn.example.com/photo.jpg',
    // type is optional — inferred from the URL extension when omitted.
    type: 'image',
});

if (result?.status === 'saved') {
    // saved to camera roll / gallery
}
```

The call returns synchronously once the asset has been written. On failure the response carries a `code` and `message` (`PERMISSION_DENIED`, `EXECUTION_FAILED`, `INVALID_PARAMETERS`).

---

# Image Lightbox

> Peter Teal

<div class="plugin-info"><div class="pi-meta"><span class="pi-item"><span class="pi-label">Author</span><span class="pi-value">Peter Teal</span></span><span class="pi-item"><span class="pi-label">Plugin Type</span><span class="pi-badge pi-badge-community">Community Plugin</span></span><span class="pi-item"><span class="pi-label">Price</span><span class="pi-badge pi-badge-free">Free</span></span><span class="pi-item"><span class="pi-label">Version</span><span class="pi-value">v1.0.11</span></span><span class="pi-item"><span class="pi-label">License</span><span class="pi-value">MIT</span></span></div><div class="pi-compat"><span class="pi-chip"><span class="pi-chip-label">NativePHP</span><span class="pi-chip-value">^3.0</span></span><span class="pi-chip"><span class="pi-chip-label">PHP</span><span class="pi-chip-value">^8.2</span></span><span class="pi-chip"><span class="pi-chip-label">iOS</span><span class="pi-chip-value">any</span></span><span class="pi-chip"><span class="pi-chip-label">Android</span><span class="pi-chip-value">any</span></span></div><div class="pi-links"><a href="https://github.com/pteal79/plugin-image-lightbox" class="pi-link" target="_blank" rel="noopener">GitHub →</a></div></div>

# ImageLightbox Plugin for NativePHP Mobile

Display images (`jpg`, `jpeg`, `png`, `heic`) in a full-screen native lightbox overlay above the running app UI.

**Features**

- Native full-screen modal on both iOS and Android
- Pinch-to-zoom (up to 5×) and pan after zooming
- Aspect-fit display by default
- Loads local file paths and remote URLs (with WebView session cookie injection for authenticated endpoints)
- Optional **Edit**, **Markup**, **Share**, and **Delete** action buttons
- Native share sheet for both local files and remote images
- `EditPressed`, `MarkupPressed`, `DeletePressed`, and `ClosePressed` events with `imageId` payload
- Icon-based toolbar at the top of the screen with dark-background buttons for legibility
- Safe-area aware controls; dismiss animation
- Graceful error states (invalid URL, missing file, decode failure)

---

## Installation

```bash
# 1. Install the package
composer require pteal79/plugin-image-lightbox

# 2. Publish the plugins provider (first time only)
php artisan vendor:publish --tag=nativephp-plugins-provider

# 3. Register the plugin (adds the service provider to NativePluginsServiceProvider)
php artisan native:plugin:register pteal79/plugin-image-lightbox

# 4. Verify registration
php artisan native:plugin:list
```

### Local development (path repository)

Add to your app's `composer.json`:

```json
{
    "repositories": [
        {
            "type": "path",
            "url": "./packages/pteal79/plugin-image-lightbox"
        }
    ]
}
```

Then run `composer require pteal79/plugin-image-lightbox`.

---

## Requirements

### Android

| Requirement | Detail |
|---|---|
| Permission | `android.permission.INTERNET` (remote URLs) — added automatically via `nativephp.json` |
| FileProvider | The host app must have a `FileProvider` configured with authority `${applicationId}.provider` for the **Share** feature to work. NativePHP Mobile typically configures this by default. |
| HEIC support | Android 9 (API 28)+ via `ImageDecoder`. Older devices fall back to `BitmapFactory`; HEIC may not decode on API < 28. |

### iOS

No additional permissions or Info.plist entries are required. HEIC is supported natively via `UIImage`.

---

## Usage

### PHP — Livewire / Blade

```php
use Nativephp\ImageLightbox\Facades\ImageLightbox;

// Remote URL — minimal
ImageLightbox::show([
    'url' => 'https://example.com/photo.jpg',
]);

// Local file — minimal
ImageLightbox::show([
    'local' => '/var/mobile/.../Documents/app/storage/app/public/photo.jpg',
]);

// Full options
ImageLightbox::show([
    'url'     => 'https://example.com/photo.heic',
    'imageId' => '550e8400-e29b-41d4-a716-446655440000',
    'edit'    => true,
    'markup'  => true,
    'share'   => true,
    'delete'  => true,
]);
```

### Parameters

| Parameter | Type     | Default | Description |
|-----------|----------|---------|-------------|
| `url`     | `string` | `null`  | Remote image URL (`http`/`https`). Supported formats: `jpg`, `jpeg`, `png`, `heic`, `webp`. |
| `local`   | `string` | `null`  | Absolute local file path to an image on the device. |
| `imageId` | `string` | `null`  | Optional identifier included in all event payloads. |
| `edit`    | `bool`   | `false` | Show an **Edit** button in the toolbar. |
| `markup`  | `bool`   | `false` | Show a **Markup** button in the toolbar. |
| `share`   | `bool`   | `false` | Show a **Share** button that opens the native share sheet. |
| `delete`  | `bool`   | `false` | Show a **Delete** button in the toolbar. |

Either `url` or `local` is required. If neither is provided the call is a no-op.

---

## Events

All events are dispatched after the lightbox has dismissed. Each event carries the `imageId` that was passed to `::show()` (or `null` if none was provided).

### `ClosePressed`

Fired when the user taps the **close (✕)** button.

```php
use Native\Mobile\Attributes\OnNative;
use Pteal79\ImageLightbox\Events\ClosePressed;

#[OnNative(ClosePressed::class)]
public function handleClose(?string $imageId = null): void
{
    // lightbox has been dismissed
}
```

### `EditPressed`

Fired when the user taps the **Edit** button (only available when `edit: true`).

```php
use Native\Mobile\Attributes\OnNative;
use Pteal79\ImageLightbox\Events\EditPressed;

#[OnNative(EditPressed::class)]
public function handleEdit(?string $imageId = null): void
{
    // open your edit UI here
}
```

### `MarkupPressed`

Fired when the user taps the **Markup** button (only available when `markup: true`).

```php
use Native\Mobile\Attributes\OnNative;
use Pteal79\ImageLightbox\Events\MarkupPressed;

#[OnNative(MarkupPressed::class)]
public function handleMarkup(?string $imageId = null): void
{
    //
}
```

### `DeletePressed`

Fired when the user taps the **Delete** button (only available when `delete: true`).

```php
use Native\Mobile\Attributes\OnNative;
use Pteal79\ImageLightbox\Events\DeletePressed;

#[OnNative(DeletePressed::class)]
public function handleDelete(?string $imageId = null): void
{
    // perform your delete logic here
}
```

### Event payload summary

| Event | Property | Type | Description |
|-------|----------|------|-------------|
| `ClosePressed`  | `imageId` | `string\|null` | The `imageId` passed to `::show()` |
| `EditPressed`   | `imageId` | `string\|null` | The `imageId` passed to `::show()` |
| `MarkupPressed` | `imageId` | `string\|null` | The `imageId` passed to `::show()` |
| `DeletePressed` | `imageId` | `string\|null` | The `imageId` passed to `::show()` |

---

## JavaScript (Vue / React / Inertia)

```javascript
import { ImageLightbox, Events } from '@pteal79/plugin-image-lightbox';
import { on, off } from '@nativephp/native';

// Show the lightbox
await ImageLightbox.show({
    url:     'https://example.com/photo.jpg',
    imageId: 'abc-123',
    edit:    true,
    delete:  true,
    share:   true,
});

// Listen for events using the exported constants (avoids typos)
const onDelete = ({ imageId }) => console.log('Delete pressed for', imageId);
on(Events.DeletePressed, onDelete);

const onClose = ({ imageId }) => console.log('Closed for', imageId);
on(Events.ClosePressed, onClose);

// Clean up
off(Events.DeletePressed, onDelete);
off(Events.ClosePressed, onClose);
```

Available event constants:

```javascript
Events.EditPressed   // 'Pteal79\ImageLightbox\Events\EditPressed'
Events.MarkupPressed // 'Pteal79\ImageLightbox\Events\MarkupPressed'
Events.DeletePressed // 'Pteal79\ImageLightbox\Events\DeletePressed'
Events.ClosePressed  // 'Pteal79\ImageLightbox\Events\ClosePressed'
```

---

## Toolbar

The toolbar sits at the top of the screen. Each button is a white SF Symbol (iOS) or text label (Android) on a semi-transparent dark background for legibility over any image. The close button is always present on the right; action buttons appear on the left in the order: Edit → Markup → Share → Delete.

---

## Share behaviour

- **Local file** — shared directly via the native share sheet.
- **Remote URL** — the image is downloaded to a temporary cache file first, then shared. If the image was already loaded for display, the cached copy is reused (no second download).
- Share failures (network error, missing file) surface a toast / alert — the lightbox remains open.

---

## Remote URL authentication

When loading a remote URL the plugin injects the current WebView session cookies into the `URLSession` / `HttpURLConnection` request automatically, so images served behind a Laravel session-authenticated route will load correctly.

---

## Limitations

- HEIC decoding on Android requires API 28+. On older devices the image may fail to render; a graceful error message is shown.
- The plugin presents over the current top-most view controller / activity. Ensure no other full-screen modal is already covering the app when calling `::show()`.
- The Edit, Markup, and Delete buttons are UI affordances only — the plugin dispatches an event and dismisses. Your application is responsible for the resulting action.
- Very large images (>20 MP) may be slow to decode on low-end Android devices. Consider resizing on the server before passing to the lightbox.
- The Share feature on Android requires the host app to have a `FileProvider` registered with the authority `${applicationId}.provider`. NativePHP Mobile configures this by default, but if you see a `FileUriExposedException` you may need to add/adjust the provider in your app's `AndroidManifest.xml`.

---

---

# Mobile Local Notifications

> Ikromjon Ochilov

<div class="plugin-info"><div class="pi-meta"><span class="pi-item"><span class="pi-label">Author</span><span class="pi-value">Ikromjon Ochilov</span></span><span class="pi-item"><span class="pi-label">Plugin Type</span><span class="pi-badge pi-badge-community">Community Plugin</span></span><span class="pi-item"><span class="pi-label">Price</span><span class="pi-badge pi-badge-free">Free</span></span><span class="pi-item"><span class="pi-label">Version</span><span class="pi-value">v1.11.0</span></span><span class="pi-item"><span class="pi-label">License</span><span class="pi-value">MIT</span></span></div><div class="pi-compat"><span class="pi-chip"><span class="pi-chip-label">NativePHP</span><span class="pi-chip-value">^3.0</span></span><span class="pi-chip"><span class="pi-chip-label">PHP</span><span class="pi-chip-value">^8.3</span></span><span class="pi-chip"><span class="pi-chip-label">Laravel</span><span class="pi-chip-value">11 | 12</span></span><span class="pi-chip"><span class="pi-chip-label">iOS</span><span class="pi-chip-value">any</span></span><span class="pi-chip"><span class="pi-chip-label">Android</span><span class="pi-chip-value">any</span></span></div><div class="pi-links"><a href="https://github.com/Ikromjon1998/nativephp-mobile-local-notifications" class="pi-link" target="_blank" rel="noopener">GitHub →</a></div></div>

<p align="center">
</p>

Schedule, manage, and cancel local notifications in your NativePHP Mobile app — no server or Firebase required.

## Quick Start

```php
use Ikromjon\LocalNotifications\Facades\LocalNotifications;

// Request permission (required on Android 13+ and iOS)
LocalNotifications::requestPermission();

// Schedule a notification in 10 seconds
LocalNotifications::schedule([
    'id' => 'welcome',
    'title' => 'Hello!',
    'body' => 'Your first local notification',
    'delay' => 10,
]);
```

## How is this different?

| Plugin | What it does | Requires |
|--------|-------------|----------|
| **nativephp/mobile-dialog** | Toast/snackbar messages (in-app only, disappear when app closes) | Nothing |
| **nativephp/mobile-firebase** | Push notifications from a server via FCM/APNs | Firebase project, server, internet |
| **This plugin** | Local notifications scheduled on-device | Nothing — works offline |

## Features

- Schedule notifications with a delay or at a specific time
- Repeat intervals: minute, hourly, daily, weekly, monthly, yearly
- Custom repeat intervals (any duration >= 60 seconds)
- Day-of-week scheduling (e.g. every Mon/Wed/Fri at 9 AM)
- Repeat count limits (fire N times then stop)
- Rich content: images, subtitles, and expanded text
- Action buttons with text input support (configurable limit, default 3)
- Native snooze (reschedules without opening the app)
- Custom sounds, badges, and data payloads
- Cancel individual or all notifications
- List pending notifications
- Update existing notifications
- Permission management (Android 13+, iOS)
- Laravel Notification channel support
- Survives device reboot (Android)
- Events for notification lifecycle (scheduled, received, tapped, action pressed)
- Cold-start tap event auto-flush via Blade component
- Works completely offline — no server or Firebase needed

## Documentation

| Guide | Description |
|-------|-------------|
| [Getting Started](docs/getting-started.md) | Installation, configuration, cold-start setup, requirements |
| [Scheduling](docs/scheduling.md) | Schedule, cancel, update, list notifications, type-safe DTO |
| [Events](docs/events.md) | Listen in Livewire, Laravel event listeners, or JavaScript |
| [Repeat Intervals](docs/repeat-intervals.md) | Standard intervals, custom durations, day-of-week, count limits |
| [Rich Content](docs/rich-content.md) | Images, subtitles, expanded text |
| [Custom Sounds](docs/custom-sounds.md) | Custom sound files per notification |
| [Action Buttons](docs/action-buttons.md) | Tap actions, text input, native snooze |
| [Laravel Notification Channel](docs/laravel-notification-channel.md) | Standard `$user->notify()` pattern |
| [JavaScript API](docs/javascript-api.md) | Full API for Vue, React, and Inertia apps |
| [Permissions](docs/permissions.md) | Android and iOS permission requirements |
| [Troubleshooting](docs/troubleshooting.md) | Common issues and solutions |
| [Upgrading](docs/upgrading.md) | Migration guides between versions |

## Example App

**[Daily Habits](https://github.com/Ikromjon1998/daily-habits)** is a full, open-source mobile app built with this plugin. It demonstrates scheduling, action buttons, snooze, custom sounds, the Laravel Notification channel, and a notification debug panel with 9 test scenarios.

## Testing

```bash
composer test        # Run tests
composer analyse     # Run static analysis
```

## Roadmap

See [ROADMAP.md](ROADMAP.md) for planned features and their status.

## Support

For questions or issues, use [GitHub Issues](https://github.com/Ikromjon1998/nativephp-mobile-local-notifications/issues) or contact: ikromjon98.98@icloud.com

---

# Media Library

> Felipe Almeida

<div class="plugin-info"><div class="pi-meta"><span class="pi-item"><span class="pi-label">Author</span><span class="pi-value">Felipe Almeida</span></span><span class="pi-item"><span class="pi-label">Plugin Type</span><span class="pi-badge pi-badge-community">Community Plugin</span></span><span class="pi-item"><span class="pi-label">Price</span><span class="pi-badge pi-badge-free">Free</span></span><span class="pi-item"><span class="pi-label">Version</span><span class="pi-value">vlatest</span></span><span class="pi-item"><span class="pi-label">License</span><span class="pi-value">MIT</span></span></div><div class="pi-compat"><span class="pi-chip"><span class="pi-chip-label">NativePHP</span><span class="pi-chip-value">^3.0</span></span><span class="pi-chip"><span class="pi-chip-label">PHP</span><span class="pi-chip-value">^8.2</span></span><span class="pi-chip"><span class="pi-chip-label">Android</span><span class="pi-chip-value">21+</span></span></div><div class="pi-links"><a href="https://github.com/XlipeDCodder/media-library" class="pi-link" target="_blank" rel="noopener">GitHub →</a></div></div>

Query the **device's audio library** from a NativePHP Mobile app. On Android it reads the
system **MediaStore**, so you get ready-to-use track metadata (title, artist, album, genre,
duration, year, track number), the containing **folder**, a content **URI** for playback and
an **artwork URI** — without parsing files yourself.

> Status: **Android** is implemented and battle-tested. iOS is scaffolded but not yet implemented.

---

## Requirements

- NativePHP Mobile `^3.0`
- PHP `^8.2`
- Android `minSdk 21+` (folder/bucket grouping uses MediaStore buckets on API 29+)

---

## Installation

```bash
composer require musicplayer/media-library
```

Publish the NativePHP plugin provider (once per app) and register the plugin:

```bash
php artisan vendor:publish --tag=nativephp-plugins-provider
php artisan native:plugin:register musicplayer/media-library
```

Verify it is registered:

```bash
php artisan native:plugin:list
```

### Local development (from source)

Add a path repository to your app's `composer.json`, then require it:

```json
{
    "repositories": [
        { "type": "path", "url": "./packages/musicplayer/media-library" }
    ]
}
```

```bash
composer require musicplayer/media-library:@dev
```

---

## Permissions

The plugin declares the read permissions in its manifest, which are merged into your
`AndroidManifest.xml` at build time:

- `android.permission.READ_MEDIA_AUDIO` (Android 13+ / API 33+)
- `android.permission.READ_EXTERNAL_STORAGE` (older versions)

You must have the permission **granted at runtime** before calling `queryAudio()` — otherwise
the MediaStore returns an empty result (no exception). Request it through your app's normal
permission flow. For quick testing you can grant it via ADB:

```bash
adb shell pm grant <your.app.id> android.permission.READ_MEDIA_AUDIO
```

---

## Usage

```php
use Musicplayer\MediaLibrary\Facades\MediaLibrary;

// Confirm the native side is loaded
$status = MediaLibrary::getStatus();
// => ['status' => 'ready', 'provider' => 'MediaStore']

// Get every audio track indexed by the device
$tracks = MediaLibrary::queryAudio();
```

You can also resolve it from the container instead of the facade:

```php
$tracks = app(\Musicplayer\MediaLibrary\MediaLibrary::class)->queryAudio();
```

### Return shape

`queryAudio()` returns an array of associative arrays, one per track:

| Key           | Type   | Description                                              |
|---------------|--------|----------------------------------------------------------|
| `id`          | string | MediaStore item id                                       |
| `uri`         | string | `content://` URI of the track (use this to play it)      |
| `path`        | string | Absolute file path (`_data`) when available              |
| `title`       | string | Track title                                              |
| `artist`      | string | Artist                                                   |
| `album`       | string | Album                                                    |
| `album_id`    | string | MediaStore album id                                      |
| `artwork_uri` | string | `content://media/external/audio/albumart/<album_id>`     |
| `duration`    | int    | Duration in **seconds**                                  |
| `year`        | int    | Release year (`0` if unknown)                            |
| `track`       | int    | Track number (`0` if unknown)                            |
| `size`        | int    | File size in bytes                                       |
| `mime`        | string | MIME type (e.g. `audio/mpeg`)                            |
| `folder`      | string | Containing folder name (MediaStore bucket / parent dir)  |

Empty string / `0` is used for missing values (never `null`), so the payload is always
JSON-safe across the bridge.

### Example: group by folder

```php
$byFolder = collect(MediaLibrary::queryAudio())
    ->groupBy('folder')
    ->map->count();
```

---

### Runtime permission

```php
use Musicplayer\MediaLibrary\Facades\MediaLibrary;

if (! MediaLibrary::checkPermission()) {
    MediaLibrary::requestPermission(); // shows the native permission dialog
    // Ask the user to retry once granted.
}
```

### Folder picker (Storage Access Framework)

`pickFolder()` opens the native folder picker. It is **asynchronous**: the result is
delivered to the frontend as a DOM `native-event`, and the access is persisted across
app restarts (`takePersistableUriPermission`).

```php
MediaLibrary::pickFolder();
```

```js
// Vue / JS — listen for the chosen folder
document.addEventListener('native-event', (e) => {
    if (e.detail.event === 'folder:chosen') {
        const { uri, name } = e.detail.payload; // content tree URI + folder name
        // e.g. POST it to your backend to persist + scan
    }
    // 'folder:cancelled' is emitted if the user backs out.
});
```

Then read the audio inside the chosen tree (content URIs, via `MediaMetadataRetriever`):

```php
$tracks = MediaLibrary::scanTree($treeUri); // [{ uri, title, artist, album, duration, size, mime }, ...]
```

## Building

Native code changes are picked up when you (re)build the native project:

```bash
php artisan native:run        # prepares the bundle, compiles the plugin, runs the app
```

On Windows, if `native:run` cannot invoke the Gradle wrapper, build directly:

```bash
cd nativephp/android
./gradlew.bat assembleDebug   # or ./gradlew on macOS/Linux
```

---

## Bridge functions

| Function                    | Params     | Returns                                       |
|-----------------------------|------------|-----------------------------------------------|
| `MediaLibrary.QueryAudio`   | `context`  | `{ tracks: [...], count: int }`               |
| `MediaLibrary.CheckPermission` | `context` | `{ granted: bool }`                          |
| `MediaLibrary.RequestPermission` | `activity` | `{ granted: bool, requested: bool }`     |
| `MediaLibrary.PickFolder`   | `activity` | `{ started: true }` — result via `folder:chosen` event |
| `MediaLibrary.ScanTree`     | `context`  | `{ tracks: [...], count: int }`               |
| `MediaLibrary.GetStatus`    | `context`  | `{ status: "ready", provider: "MediaStore" }` |

---

## Roadmap

- iOS implementation (MPMediaQuery)
- Optional filtering parameters (by folder, by album, paging)
- Album-art bytes accessor for webview rendering

---

# TFLite Plugin

> 1338

<div class="plugin-info"><div class="pi-meta"><span class="pi-item"><span class="pi-label">Author</span><span class="pi-value">1338</span></span><span class="pi-item"><span class="pi-label">Plugin Type</span><span class="pi-badge pi-badge-community">Community Plugin</span></span><span class="pi-item"><span class="pi-label">Price</span><span class="pi-badge pi-badge-free">Free</span></span><span class="pi-item"><span class="pi-label">Version</span><span class="pi-value">v0.1.0</span></span><span class="pi-item"><span class="pi-label">License</span><span class="pi-value">Unlicensed</span></span></div><div class="pi-compat"><span class="pi-chip"><span class="pi-chip-label">NativePHP</span><span class="pi-chip-value">^3.0</span></span><span class="pi-chip"><span class="pi-chip-label">PHP</span><span class="pi-chip-value">^8.0</span></span><span class="pi-chip"><span class="pi-chip-label">Android</span><span class="pi-chip-value">any</span></span></div><div class="pi-links"><a href="https://github.com/1338/nativephp-tflite-plugin" class="pi-link" target="_blank" rel="noopener">GitHub →</a></div></div>

# NativePHP TFLite

NativePHP plugin for loading TensorFlow Lite models and running on-device inference from PHP or JavaScript.

This project is intentionally scoped as a small TFLite bridge, not a wakeword engine. Android and iOS do not provide reliable custom wakeword support in the way this project originally explored, so the useful surface is model storage, model metadata, and direct inference.

## Status

- Android: implemented for single-input models.
- iOS: bridge stubs only; not implemented yet.
- Supported tensor types: `FLOAT32`, `INT32`, `UINT8`, and `INT8`.
- Current limitation: one input tensor per model. Multiple outputs are supported by choosing an `outputIndex`.
- Build validation: installed from Packagist into a clean NativePHP Mobile 3.3 app and compiled with `./gradlew assembleRelease`.

## Requirements

- NativePHP Mobile 3 app.
- PHP 8.3+.
- Android min SDK 33 or higher.
- Android project generated by NativePHP.
- TensorFlow Lite Android dependency from `nativephp.json`.

## Install

Require and register the plugin from your NativePHP mobile app:

```bash
composer require 1338/nativephp-tflite
php artisan native:plugin:register 1338/nativephp-tflite
php artisan native:plugin:validate
php artisan native:install --force
```

## PHP Usage

Load a model bundled in Android assets:

```php
use OneThreeThreeEight\NativephpTflite\Tflite;

$info = Tflite::loadModelFromAsset('models/example.tflite');
```

Store a model in app storage:

```php
$base64 = base64_encode(file_get_contents('/local/path/to/model.tflite'));

Tflite::addModel('model.tflite', $base64);
Tflite::loadModelFromFile('model.tflite');
```

Inspect the loaded model:

```php
$info = Tflite::modelInfo();
```

Run inference:

```php
$result = Tflite::run([
    0.1,
    0.2,
    0.3,
]);

$output = $result['data'];
```

The input array is flattened before being passed to TensorFlow Lite, so nested arrays are allowed:

```php
$result = Tflite::run([
    [0.1, 0.2],
    [0.3, 0.4],
]);
```

For models with multiple outputs, choose the output tensor:

```php
$result = Tflite::run($input, outputIndex: 1);
```

## JavaScript Usage

```js
import {
  loadModelFromAsset,
  loadModelFromFile,
  modelInfo,
  run,
} from '/_native/plugins/tflite/tflite.js';

await loadModelFromAsset('models/example.tflite');

const info = await modelInfo();
const result = await run([0.1, 0.2, 0.3]);
```

## API

### `Tflite::loadModelFromAsset(string $asset): ?array`

Loads a `.tflite` model from Android assets and returns model metadata.

### `Tflite::addModel(string $name, string $base64Data): ?array`

Stores a base64-encoded model in app-private storage under `tflite_models/`.

### `Tflite::listModels(): array`

Returns stored model files with `name`, `size`, and `lastModified`.

### `Tflite::deleteModel(string $name): bool`

Deletes a stored model file.

### `Tflite::loadModelFromFile(string $filename): ?array`

Loads a model previously stored with `addModel()` or `copyAssetToStorage()`.

### `Tflite::copyAssetToStorage(string $assetName, string $targetName): ?array`

Copies a bundled asset model into app-private model storage.

### `Tflite::modelInfo(): ?array`

Returns metadata for the currently loaded model:

```php
[
    'loaded' => true,
    'model' => 'file:model.tflite',
    'inputs' => [
        [
            'index' => 0,
            'name' => 'serving_default_input',
            'shape' => [1, 224, 224, 3],
            'dataType' => 'FLOAT32',
            'bytes' => 602112,
        ],
    ],
    'outputs' => [
        [
            'index' => 0,
            'name' => 'StatefulPartitionedCall',
            'shape' => [1, 1001],
            'dataType' => 'FLOAT32',
            'bytes' => 4004,
        ],
    ],
]
```

### `Tflite::run(array $input, int $outputIndex = 0): ?array`

Runs inference against the loaded model.

Return shape:

```php
[
    'outputIndex' => 0,
    'shape' => [1, 1001],
    'dataType' => 'FLOAT32',
    'data' => [0.01, 0.93, 0.06],
]
```

## Security Notes

- Stored model names are sanitized to a basename before writing to app storage.
- Models are stored in the app-private files directory.
- This plugin does not download models by itself. If your app downloads models, validate source, integrity, size, and expected tensor metadata before loading.

## Roadmap

- Add tests for PHP facade behavior.
- Add Kotlin tests for tensor flattening and output decoding.
- Support multiple input tensors.
- Add optional output reshaping instead of returning a flat array only.
- Implement iOS with TensorFlow Lite Swift or document Android-only support permanently.

## Not Goals

- Wakeword detection.
- Background audio capture.
- Always-on microphone behavior.
- Model training or conversion.

---

# Innerr Media Permissions

> Michael Blijleven

<div class="plugin-info"><div class="pi-meta"><span class="pi-item"><span class="pi-label">Author</span><span class="pi-value">Michael Blijleven</span></span><span class="pi-item"><span class="pi-label">Plugin Type</span><span class="pi-badge pi-badge-community">Community Plugin</span></span><span class="pi-item"><span class="pi-label">Price</span><span class="pi-badge pi-badge-free">Free</span></span><span class="pi-item"><span class="pi-label">Version</span><span class="pi-value">vlatest</span></span><span class="pi-item"><span class="pi-label">License</span><span class="pi-value">MIT</span></span></div><div class="pi-compat"><span class="pi-chip"><span class="pi-chip-label">NativePHP</span><span class="pi-chip-value">^3.0</span></span><span class="pi-chip"><span class="pi-chip-label">PHP</span><span class="pi-chip-value">^8.2</span></span><span class="pi-chip"><span class="pi-chip-label">iOS</span><span class="pi-chip-value">any</span></span></div><div class="pi-links"><a href="https://github.com/voicecode-bv/nativephp-plugin-innerr-media-permissions" class="pi-link" target="_blank" rel="noopener">GitHub →</a></div></div>

# Media Permissions Plugin for NativePHP Mobile

Contributes iOS `Info.plist` usage descriptions required for camera, microphone, and photo library access in the Innerr app.

This is a manifest-only plugin: it has no bridge functions or native code. Its sole purpose is to inject the correct `NS*UsageDescription` entries into the generated iOS `Info.plist` via the NativePHP manifest merge process.

## Installation

Add this package as a path repository in the consuming app's `composer.json`:

```json
"repositories": [
    { "type": "path", "url": "./packages/voicecode-bv/nativephp-plugin-innerr-media-permissions" }
]
```

Then install and register:

```bash
composer require voicecode-bv/nativephp-plugin-innerr-media-permissions

# First time only: publish the plugins provider
php artisan vendor:publish --tag=nativephp-plugins-provider

# Register the plugin
php artisan native:plugin:register voicecode-bv/nativephp-plugin-innerr-media-permissions

# Verify
php artisan native:plugin:list
```

## What it contributes

| Key                              | Description                                                                                |
| -------------------------------- | ------------------------------------------------------------------------------------------ |
| `NSCameraUsageDescription`       | To upload media to your circles, Innerr requires camera access.                            |
| `NSMicrophoneUsageDescription`   | To make new recordings, Innerr requires microphone access to record video with audio.      |
| `NSPhotoLibraryUsageDescription` | Before you can post media to your circles, Innerr requires photo library access to select media. |
| `NSPhotoLibraryAddUsageDescription` | This app needs permission to save photos and videos to your library.                    |

To change the wording, edit `nativephp.json` in this package and rebuild the iOS app.

---

# Mobile Document Scanner

> Ikromjon Ochilov

<div class="plugin-info"><div class="pi-meta"><span class="pi-item"><span class="pi-label">Author</span><span class="pi-value">Ikromjon Ochilov</span></span><span class="pi-item"><span class="pi-label">Plugin Type</span><span class="pi-badge pi-badge-community">Community Plugin</span></span><span class="pi-item"><span class="pi-label">Price</span><span class="pi-badge pi-badge-free">Free</span></span><span class="pi-item"><span class="pi-label">Version</span><span class="pi-value">v1.4.0</span></span><span class="pi-item"><span class="pi-label">License</span><span class="pi-value">MIT</span></span></div><div class="pi-compat"><span class="pi-chip"><span class="pi-chip-label">NativePHP</span><span class="pi-chip-value">^3.0</span></span><span class="pi-chip"><span class="pi-chip-label">PHP</span><span class="pi-chip-value">^8.3</span></span><span class="pi-chip"><span class="pi-chip-label">iOS</span><span class="pi-chip-value">any</span></span><span class="pi-chip"><span class="pi-chip-label">Android</span><span class="pi-chip-value">any</span></span></div><div class="pi-links"><a href="https://github.com/Ikromjon1998/nativephp-mobile-document-scanner" class="pi-link" target="_blank" rel="noopener">GitHub →</a></div></div>

Scan documents with automatic edge detection, perspective correction, and cropping in your NativePHP Mobile app — powered by native platform APIs.

## Quick Start

```bash
composer require ikromjon/nativephp-mobile-document-scanner
php artisan native:plugin:register ikromjon/nativephp-mobile-document-scanner
php artisan native:run android  # or ios
```

```php
use Ikromjon\DocumentScanner\Facades\DocumentScanner;
use Ikromjon\DocumentScanner\Events\DocumentScanned;
use Native\Mobile\Attributes\OnNative;

// In your Livewire component:
DocumentScanner::scan();

// Handle the result (Livewire method)
#[OnNative(DocumentScanned::class)]
public function onScanned($data)
{
    $paths = $data['paths'];           // ['/path/scan_0.jpg', ...]
    $pageCount = $data['pageCount'];   // 2
}
```

That's it. The scanner opens, the user scans, and you get the file paths back via events. See below for full options and JavaScript usage.

## How It Works

| Platform    | Native API                                   | Features                                                                |
| ----------- | -------------------------------------------- | ----------------------------------------------------------------------- |
| **iOS**     | VisionKit (`VNDocumentCameraViewController`) | Auto edge detection, perspective correction, shadow removal, multi-page |
| **Android** | Google ML Kit Document Scanner               | Auto edge detection, cropping, rotation, multi-page, gallery import     |

No external API keys or internet required. Camera permission is handled automatically.

## Installation

```bash
composer require ikromjon/nativephp-mobile-document-scanner
php artisan native:plugin:register ikromjon/nativephp-mobile-document-scanner
```

Build your app (plugin requires a native build):

```bash
php artisan native:run android
# or
php artisan native:run ios
```

> **Note:** The scanner requires a native build on a real device — it won't work with `php artisan serve`. If you call `scan()` without a native build, you'll see a warning in your Laravel log.

## Configuration

Optionally publish the config file:

```bash
php artisan vendor:publish --tag=document-scanner-config
```

| Key                     | Default             | Description                                            |
| ----------------------- | ------------------- | ------------------------------------------------------ |
| `default_max_pages`     | `0`                 | Default max pages per scan (0 = unlimited)             |
| `max_pages_limit`       | `100`               | Absolute cap on pages per scan                         |
| `default_output_format` | `jpeg`              | Default output format (`jpeg` or `pdf`)                |
| `default_jpeg_quality`  | `90`                | Default JPEG compression quality (1-100)               |
| `storage_directory`     | `scanned-documents` | Subdirectory for scanned files                         |
| `default_gallery_import`| `false`             | Allow gallery import (Android only)                    |
| `default_scanner_mode`  | `full`              | Scanner mode: `base`, `filter`, `full` (Android only)  |

## Usage (PHP)

### Scan a Document

```php
use Ikromjon\DocumentScanner\Facades\DocumentScanner;

// Scan with defaults
DocumentScanner::scan();

// Scan with options
DocumentScanner::scan([
    'maxPages' => 3,
    'outputFormat' => 'jpeg',
    'jpegQuality' => 85,
]);

// Scan a single page (e.g. ID card)
DocumentScanner::scan(['maxPages' => 1]);

// Scan to PDF
DocumentScanner::scan(['outputFormat' => 'pdf']);
```

The `scan()` method opens the native scanner UI and returns immediately. Results are delivered asynchronously via events.

### Type-Safe DTO

```php
use Ikromjon\DocumentScanner\Data\ScanOptions;
use Ikromjon\DocumentScanner\Enums\OutputFormat;

DocumentScanner::scan(new ScanOptions(
    maxPages: 5,
    outputFormat: OutputFormat::Pdf,
));
```

### Scan Parameters

| Parameter       | Type                 | Platform     | Description                               |
| --------------- | -------------------- | ------------ | ----------------------------------------- |
| `maxPages`      | int                  | Both         | Max pages to scan (0 = unlimited)         |
| `outputFormat`  | OutputFormat\|string | Both         | `jpeg` or `pdf`                           |
| `jpegQuality`   | int                  | Both         | JPEG quality 1-100 (only for jpeg output) |
| `galleryImport` | bool                 | Android only | Allow importing from device gallery       |
| `scannerMode`   | ScannerMode\|string  | Android only | `base`, `filter`, or `full`               |

## Full Livewire Example

A complete component that scans documents and displays the results:

```php
use Livewire\Component;
use Native\Mobile\Attributes\OnNative;
use Ikromjon\DocumentScanner\Facades\DocumentScanner;
use Ikromjon\DocumentScanner\Events\DocumentScanned;
use Ikromjon\DocumentScanner\Events\ScanCancelled;
use Ikromjon\DocumentScanner\Events\ScanFailed;

class DocumentScannerComponent extends Component
{
    public array $scannedFiles = [];
    public string $error = '';

    public function scan()
    {
        DocumentScanner::scan(['maxPages' => 5]);
    }

    #[OnNative(DocumentScanned::class)]
    public function onScanned($data)
    {
        $this->scannedFiles = $data['paths'];
    }

    #[OnNative(ScanCancelled::class)]
    public function onCancelled()
    {
        // User dismissed the scanner
    }

    #[OnNative(ScanFailed::class)]
    public function onFailed($data)
    {
        $this->error = $data['error'];
    }
}
```

> **Important:** Use `#[OnNative(...)]` (not `#[On(...)]`) for NativePHP events.

## Listening to Events (Laravel)

```php
use Ikromjon\DocumentScanner\Events\DocumentScanned;

class HandleDocumentScanned
{
    public function handle(DocumentScanned $event): void
    {
        // $event->paths — array of file paths
        // $event->pageCount — number of pages scanned
        // $event->outputFormat — 'jpeg' or 'pdf'
    }
}
```

## Usage (JavaScript)

```js
import {
  scan,
  imagesToPdf,
  pdfToImages,
  Events,
} from "../../vendor/ikromjon/nativephp-mobile-document-scanner/resources/js/index.js";
import { On } from "#nativephp";

// Open scanner
await scan({ maxPages: 3, outputFormat: "jpeg", jpegQuality: 90 });

// Listen for results
On(Events.DocumentScanned, (payload) => {
  console.log("Scanned:", payload.paths, payload.pageCount);
});

On(Events.ScanCancelled, () => {
  console.log("Cancelled");
});

On(Events.ScanFailed, (payload) => {
  console.error("Failed:", payload.error);
});

// Combine images into PDF
const result = await imagesToPdf(["/path/scan_0.jpg", "/path/scan_1.jpg"]);
console.log("PDF:", result.path);

// Extract thumbnails from PDF
const thumbs = await pdfToImages("/path/scan.pdf", 80);
console.log("Pages:", thumbs.paths);
```

## Events

| Event             | Payload                              | When                            |
| ----------------- | ------------------------------------ | ------------------------------- |
| `DocumentScanned` | `paths`, `pageCount`, `outputFormat` | Scanning completed successfully |
| `ScanCancelled`   | —                                    | User cancelled the scanner      |
| `ScanFailed`      | `error`                              | An error occurred               |
| `PdfCreated`      | `path`                               | `imagesToPdf()` completed       |

## Scanned Files

Scanned files are saved to the app's internal storage under the configured `storage_directory` (default: `scanned-documents`). File paths returned in the `DocumentScanned` event are absolute paths on the device.

- **JPEG output:** one file per page (e.g. `scan_0.jpg`, `scan_1.jpg`)
- **PDF output:** a single multi-page PDF file
- Files persist until the app is uninstalled or you delete them manually

### Which format to use?

**JPEG (default)** is the better choice for most apps. You get individual files per page, which means you can show page previews, let users view/delete specific pages, and convert to PDF later on your own terms (e.g. with [fpdf](https://packagist.org/packages/setasign/fpdf)). You also control file size via `jpegQuality`.

**PDF** is useful when you need a single file immediately and don't need to display or manipulate individual pages. Note that the native scanner produces the PDF directly — you can't extract page previews from it without a separate library.

See [Smart Docs](https://github.com/Ikromjon1998/smart-docs) for an example that scans as JPEG by default and converts to PDF on demand.

## Required Permissions

**Android:** `CAMERA` — declared automatically via `nativephp.json`. ML Kit handles the scanner UI internally.

**iOS:** VisionKit requests camera access at runtime. Your app's `Info.plist` must include an `NSCameraUsageDescription` string — NativePHP sets a default, but you should customize it for your app store submission (e.g. "This app uses the camera to scan documents").

No API keys or internet required.

## Demo App

See [Smart Docs](https://github.com/Ikromjon1998/smart-docs) — a full NativePHP mobile app that uses this plugin for document scanning.

## Documentation

- [Installation](docs/installation.md) — requirements, setup steps, verification
- [Configuration](docs/configuration.md) — all config options explained
- [Usage with Livewire](docs/livewire.md) — Livewire components and event handling
- [Usage with JavaScript](docs/javascript.md) — Inertia Vue/React integration
- [API Reference](docs/api-reference.md) — events, DTOs, enums, validation, contracts

## JPEG-to-PDF Conversion

Combine scanned JPEG pages into a single PDF on-device — no extra PHP library needed:

```php
use Ikromjon\DocumentScanner\Facades\DocumentScanner;
use Ikromjon\DocumentScanner\Events\PdfCreated;
use Native\Mobile\Attributes\OnNative;

// Combine images into a PDF
$result = DocumentScanner::imagesToPdf([
    '/path/scan_0.jpg',
    '/path/scan_1.jpg',
]);
$pdfPath = $result['path']; // '/path/combined_1712345678.pdf'

// Listen for completion
#[OnNative(PdfCreated::class)]
public function onPdfCreated($data)
{
    $pdfPath = $data['path'];
}
```

Works with any JPEG files, not just scanned documents.

## PDF Page Thumbnails

Extract page previews from a PDF — useful when you scan as PDF but need page-level previews:

```php
$result = DocumentScanner::pdfToImages('/path/scan.pdf', quality: 80);
$pagePaths = $result['paths']; // ['/path/page_0.jpg', '/path/page_1.jpg']
```

## Planned Features

- **File management** — list, delete, and clean up scanned files via the plugin API
- **Image post-processing** — grayscale, contrast, rotation on scanned images

See [ROADMAP.md](ROADMAP.md) for full details and status.

## Testing

```bash
composer test
composer analyse
```

## Requirements

- PHP 8.3+
- NativePHP Mobile v3+
- iOS 13+ / Android API 21+

---

# Offline Sync

> Kromaric

<div class="plugin-info"><div class="pi-meta"><span class="pi-item"><span class="pi-label">Author</span><span class="pi-value">Kromaric</span></span><span class="pi-item"><span class="pi-label">Plugin Type</span><span class="pi-badge pi-badge-community">Community Plugin</span></span><span class="pi-item"><span class="pi-label">Price</span><span class="pi-badge pi-badge-free">Free</span></span><span class="pi-item"><span class="pi-label">Version</span><span class="pi-value">v0.1.0</span></span><span class="pi-item"><span class="pi-label">License</span><span class="pi-value">MIT</span></span></div><div class="pi-compat"><span class="pi-chip"><span class="pi-chip-label">NativePHP</span><span class="pi-chip-value">^0.8.0</span></span><span class="pi-chip"><span class="pi-chip-label">PHP</span><span class="pi-chip-value">^8.1</span></span><span class="pi-chip"><span class="pi-chip-label">Laravel</span><span class="pi-chip-value">10 | 11 | 12</span></span><span class="pi-chip"><span class="pi-chip-label">iOS</span><span class="pi-chip-value">14.0+</span></span><span class="pi-chip"><span class="pi-chip-label">Android</span><span class="pi-chip-value">24+</span></span></div><div class="pi-links"><a href="https://github.com/Kromaric/offlinesync" class="pi-link" target="_blank" rel="noopener">GitHub →</a></div></div>

**Offline-first synchronization plugin for NativePHP Mobile applications.**

Stop fighting with offline data. This plugin handles queuing, sync, and conflicts so you can focus on building features. Works out-of-the-box with zero native code required.

---

## ✨ Features

- ✅ **Automatic Queue Management** - Operations are automatically queued when offline
- ✅ **Bidirectional Sync** - Push local changes and pull remote updates
- ✅ **4 Conflict Resolution Strategies** - Server wins, Client wins, Last write wins, Merge
- ✅ **Auto-Connectivity Monitoring** - Syncs automatically when connection returns
- ✅ **Background Sync** - Works even when app is closed (iOS/Android)
- ✅ **Secure by Default** - HTTPS enforcement, auth-agnostic design (your app controls auth)
- ✅ **Observable** - Laravel events, logs, Artisan commands
- ✅ **Zero Native Code** - All native bridges included (Kotlin + Swift)

---

## 📋 Requirements

- **PHP** ≥ 8.1
- **Laravel** ≥ 10.0
- **NativePHP** ≥ 0.8.0
- **iOS** ≥ 14.0
- **Android** API Level ≥ 24 (Android 7.0)

---

## 🚀 Installation

### 1. Install via Composer

```bash
composer require techparse/offline-sync
```

### 2. Register the Plugin

```bash
php artisan native:plugin:register techparse/offline-sync
```

### 3. Publish Configuration

```bash
php artisan vendor:publish --tag=offline-sync-config
```

### 4. Run Migrations

```bash
php artisan migrate
```

### 5. Configure Your API

Edit `.env`:

```env
SYNC_API_URL=https://api.yourapp.com
SYNC_REQUIRE_HTTPS=true
```

---

## 📖 Quick Start

### 1. Add Syncable Trait to Your Models

```php
use Techparse\OfflineSync\Traits\Syncable;

class Task extends Model
{
    use Syncable;
    
    // Optional: customize sync behavior
    protected $syncResourceName = 'tasks';
    protected $syncExcluded = ['internal_notes'];
}
```

### 2. Map Resources in Config

Edit `config/offline-sync.php`:

```php
'resource_mapping' => [
    'tasks' => \App\Models\Task::class,
    'users' => \App\Models ser::class,
],
```

### 3. Use It!

```php
// Operations are automatically queued when offline
$task = Task::create(['title' => 'My Task']);

// Manual sync (optional)
use Techparse\OfflineSync\Facades\OfflineSync;

OfflineSync::sync(['tasks']);

// Check status
$status = OfflineSync::getStatus();
// ['pending_count' => 5, 'is_syncing' => false, 'last_sync' => '...']
```

---

## 🎯 Usage

### Automatic Syncing

With the `Syncable` trait, all create/update/delete operations are automatically queued:

```php
// These are automatically queued when offline
$task = Task::create(['title' => 'New Task']);
$task->update(['completed' => true]);
$task->delete();
```

### Manual Syncing

```php
use Techparse\OfflineSync\Facades\OfflineSync;

// Bidirectional sync (push + pull)
OfflineSync::sync(['tasks', 'users']);

// Push only (local → server)
OfflineSync::push(['tasks']);

// Pull only (server → local)
OfflineSync::pull(['users']);
```

### Queue Management

```php
// Get pending items
$pending = OfflineSync::getPending();
$pendingTasks = OfflineSync::getPending('tasks');

// Purge old synced items (older than 7 days)
OfflineSync::purgeOldItems(7);
```

### Artisan Commands

```bash
# Push local changes to server
php artisan sync:push

# Push specific resources
php artisan sync:push tasks users

# Pull remote changes
php artisan sync:pull tasks users

# Check queue status
php artisan sync:status

# Clear queue
php artisan sync:clear
php artisan sync:clear --failed
```

---

## ⚔️ Conflict Resolution

Configure in `config/offline-sync.php`:

```php
'conflict_resolution' => [
    // Default strategy for all resources
    'default_strategy' => 'server_wins',
    
    // Per-resource strategies
    'per_resource' => [
        'tasks' => 'last_write_wins',
        'users' => 'server_wins',
    ],
],
```

### Available Strategies

| Strategy | Description | Best For |
|----------|-------------|----------|
| **server_wins** | Server data always overwrites local | Critical data, auth |
| **client_wins** | Local data always overwrites server | User preferences |
| **last_write_wins** | Newest timestamp wins | Most use cases |
| **merge** | Intelligent field-level merge | Complex data |

---

## 🔐 Security

### Authentication

The plugin is **auth-agnostic** — it does not manage tokens or credentials. Your application is responsible for authentication. To forward an auth header on every sync request, set `offline-sync.security.headers` at runtime (e.g. in your `AppServiceProvider`):

```php
// app/Providers/AppServiceProvider.php
public function boot(): void
{
    $token = $this->app->make(Request::class)->bearerToken();

    if ($token) {
        config(['offline-sync.security.headers' => [
            'Authorization' => 'Bearer ' . $token,
        ]]);
    }
}
```

This works with any auth system: Laravel Sanctum, Passport, API keys, etc.

### HTTPS Enforcement

```env
SYNC_REQUIRE_HTTPS=true
```

---

## 📡 Backend Setup

### Routes

Add to `routes/api.php`:

```php
use Techparse\OfflineSync\Http\Controllers\SyncController;

Route::middleware('auth:sanctum')->prefix('sync')->group(function () {
    Route::post('/push', [SyncController::class, 'push']);
    Route::get('/pull/{resource}', [SyncController::class, 'pull']);
    Route::get('/status', [SyncController::class, 'status']);
    Route::get('/ping', [SyncController::class, 'ping']);
});
```

### Controller

Use the included `SyncController` or extend it for custom logic.

---

## 🔔 Events

Listen to sync events in your application:

```php
use Techparse\OfflineSync\Events\SyncCompleted;

Event::listen(SyncCompleted::class, function ($event) {
    Log::info("Synced {$event->synced} items in {$event->durationMs}ms");
});
```

### Available Events

- `SyncStarted` - Sync process started
- `SyncCompleted` - Sync finished successfully
- `SyncFailed` - Sync failed
- `ItemQueued` - Item added to queue
- `ItemSynced` - Item synchronized
- `ConflictDetected` - Conflict detected
- `QueuePurged` - Old items purged

---

## ⚙️ Configuration

See `config/offline-sync.php` for all options:

- API URL and security headers
- Resource mapping
- Conflict resolution strategies
- Connectivity settings
- Performance tuning
- Security options
- Logging configuration

---

## 📱 Native Platform Support

### Android (Kotlin)

- Automatic connectivity monitoring
- Background sync with WorkManager
- WiFi-only mode support
- Battery-aware scheduling

### iOS (Swift)

- Network framework monitoring
- Background fetch
- App refresh scheduling
- Low power mode respect

All native code is included. No manual native development required.

---

## 🧪 Testing

Run the test suite:

```bash
composer test
```

Or with coverage:

```bash
composer test-coverage
```

---

## 📚 Documentation

- [Installation Guide](docs/INSTALL.md)
- [Backend Setup](docs/BACKEND.md)
- [Conflict Resolution](docs/CONFLICTS.md)
- [Security Best Practices](docs/SECURITY.md)
- [Troubleshooting](docs/TROUBLESHOOTING.md)

---

## 🤝 Support

- **Email**: offlinessync@techparse.fr
- **Documentation**: https://docs.offlinesync.techparse.fr
- **Issues**: https://github.com/Kromaric/offlinesync/issues

---

## 📄 License

This software is open source, released under the MIT License. See [LICENSE](LICENSE) for details.

---

## 🙏 Credits

Built with ❤️ for the NativePHP community.

- [NativePHP](https://nativephp.com)
- [Laravel](https://laravel.com)

---

## 📝 Changelog

See [CHANGELOG.md](dev/CHANGELOG.md) for version history.

---

**Made by Techparse** | [Website](https://techparse.fr) | [Twitter](https://twitter.com/techparse)

---

# Mobile Haptics

> GrayMatter Technology

<div class="plugin-info"><div class="pi-meta"><span class="pi-item"><span class="pi-label">Author</span><span class="pi-value">GrayMatter Technology</span></span><span class="pi-item"><span class="pi-label">Plugin Type</span><span class="pi-badge pi-badge-community">Community Plugin</span></span><span class="pi-item"><span class="pi-label">Price</span><span class="pi-badge pi-badge-free">Free</span></span><span class="pi-item"><span class="pi-label">Version</span><span class="pi-value">vlatest</span></span><span class="pi-item"><span class="pi-label">License</span><span class="pi-value">MIT</span></span></div><div class="pi-compat"><span class="pi-chip"><span class="pi-chip-label">NativePHP</span><span class="pi-chip-value">^3.0</span></span><span class="pi-chip"><span class="pi-chip-label">PHP</span><span class="pi-chip-value">^8.2</span></span><span class="pi-chip"><span class="pi-chip-label">Laravel</span><span class="pi-chip-value">11 | 12</span></span><span class="pi-chip"><span class="pi-chip-label">iOS</span><span class="pi-chip-value">any</span></span><span class="pi-chip"><span class="pi-chip-label">Android</span><span class="pi-chip-value">any</span></span></div><div class="pi-links"><a href="https://github.com/graymattertechnology/nativephp-mobile-haptics" class="pi-link" target="_blank" rel="noopener">GitHub →</a></div></div>

Haptic feedback plugin for [NativePHP Mobile](https://nativephp.com) — impact, notification, selection, vibrate & pattern.

## Features

- **5 haptic types**: impact, notification, selection, raw vibrate, and custom patterns
- **Cross-platform**: native iOS (`UIFeedbackGenerator`) and Android (`VibrationEffect`) implementations
- **PHP + JavaScript**: use from Livewire/Blade or Vue/React/Inertia
- **Graceful degradation**: returns `false` on simulators or missing hardware
- **Zero config**: install and use — no publish, no migrations

## Requirements

- PHP 8.2+
- Laravel 11 or 12
- NativePHP Mobile

## Installation

```bash
composer require graymatter/nativephp-mobile-haptics
```

The service provider and facade are auto-discovered.

## Usage (PHP)

```php
use GrayMatter\NativePHP\Mobile\Haptics\Facades\Haptics;

// Impact feedback — for button taps, collisions, UI emphasis
Haptics::impact('light');    // light, medium (default), heavy, rigid, soft

// Notification feedback — for async operation results
Haptics::notification('success');  // success (default), warning, error

// Selection feedback — for pickers, sliders, toggles
Haptics::selection();

// Raw vibration (ms) — native on Android, approximated on iOS
Haptics::vibrate(300);

// Vibration pattern [vibrate, pause, vibrate, pause, ...]
Haptics::pattern([100, 50, 200, 50, 100]);
```

All methods return `bool` — `true` on success, `false` on failure or missing hardware.

## Usage (JavaScript)

```js
import { haptics } from '@graymatter/nativephp-mobile-haptics';

await haptics.impact('heavy');
await haptics.notification('error');
await haptics.selection();
await haptics.vibrate(200);
await haptics.pattern([100, 50, 200]);
```

Or import individual functions:

```js
import { impact, notification, selection } from '@graymatter/nativephp-mobile-haptics';

await impact('medium');
```

## API Reference

| Method | Parameters | Default | Description |
|--------|-----------|---------|-------------|
| `impact($style)` | `light`, `medium`, `heavy`, `rigid`, `soft` | `medium` | Impact haptic feedback |
| `notification($type)` | `success`, `warning`, `error` | `success` | Notification haptic feedback |
| `selection()` | — | — | Selection tick feedback |
| `vibrate($ms)` | `1`–`5000` | `200` | Raw vibration in milliseconds |
| `pattern($array)` | `[vibrate, pause, ...]` | — | Custom vibration pattern |

## Platform Differences

| Feature | iOS | Android |
|---------|-----|---------|
| Impact | Native (`UIImpactFeedbackGenerator`) | Native (`VibrationEffect.createOneShot`) |
| Notification | Native (`UINotificationFeedbackGenerator`) | Native (predefined effects API 29+, waveform fallback) |
| Selection | Native (`UISelectionFeedbackGenerator`) | Native (`EFFECT_TICK` API 29+, short vibration fallback) |
| Vibrate | Approximated via repeated impacts | Native (`createOneShot`) |
| Pattern | Approximated via timed impacts | Native (`createWaveform`) |
| Permission | None required | `VIBRATE` (auto-granted) |
| Min version | iOS 13.0 | API 26 (Android 8.0) |

## Disabling Haptics

Use standard conditional logic:

```php
if ($user->prefersHaptics()) {
    Haptics::impact('medium');
}
```

## Testing

```bash
composer test
```

---

# Enhanced Splash

> Unloc

<div class="plugin-info"><div class="pi-meta"><span class="pi-item"><span class="pi-label">Author</span><span class="pi-value">Unloc</span></span><span class="pi-item"><span class="pi-label">Plugin Type</span><span class="pi-badge pi-badge-community">Community Plugin</span></span><span class="pi-item"><span class="pi-label">Price</span><span class="pi-badge pi-badge-free">Free</span></span><span class="pi-item"><span class="pi-label">Version</span><span class="pi-value">v1.0.0</span></span><span class="pi-item"><span class="pi-label">License</span><span class="pi-value">MIT</span></span></div><div class="pi-compat"><span class="pi-chip"><span class="pi-chip-label">NativePHP</span><span class="pi-chip-value">^3.0 || ^4.0</span></span><span class="pi-chip"><span class="pi-chip-label">iOS</span><span class="pi-chip-value">16.0+</span></span><span class="pi-chip"><span class="pi-chip-label">Android</span><span class="pi-chip-value">26+</span></span></div><div class="pi-links"><a href="https://github.com/unlocnl/nativephp-enhanced-splash" class="pi-link" target="_blank" rel="noopener">GitHub →</a></div></div>

# Enhanced Splash for NativePHP Mobile

Take control of your app's launch screen: no visible jump on Android, and a polished iOS launch screen generated from your app icon — no design work required.

## Why "enhanced"

**Android shows two splashes, and you only control one of them.** Since Android 12 the system draws its own splash on every cold start — your launcher icon on a flat background — and it cannot be turned off. Only after that does NativePHP's own overlay fade in your `splash.png`. The system half is hardcoded white or black, so unless your splash art happens to be black too, users see a cut in the middle of your app opening.

This plugin fixes it two ways, and you pick:

- Give the system splash the same background as your splash image, so the two phases read as one continuous screen.
- Or drop the second phase entirely with `android.mode = 'icon'`: the system splash is held on screen until your app is ready to draw, so there is one splash instead of two.

**iOS launch screens usually mean commissioning artwork.** Every device size, light and dark. With `ios.mode = 'icon'` you don't design anything: the plugin takes the app icon you already have, masks it to the iOS squircle, centers it on the background color you choose, and uses that for both of iOS's launch phases. It looks deliberate, and it takes one config line.

And if you do have artwork, `public/splash.svg` is used as a true vector launch image on iOS — one file, sharp on every device, instead of a folder of PNG variants.

## Installation

```bash
composer require unloc/nativephp-enhanced-splash

# Only needed once per app, before its first plugin registration.
php artisan vendor:publish --tag=nativephp-plugins-provider

php artisan native:plugin:register unloc/nativephp-enhanced-splash
php artisan native:plugin:list
```

Then rebuild — native code only compiles in at build time:

```bash
php artisan native:run ios      # or: android
```

> **Note:** Only run one splash plugin at a time. This plugin edits `MainActivity.kt` by exact-string match, as every splash plugin for NativePHP does. Running alongside `s2br/nativephp-mobile-splashscreen` will cause conflicts.

## Configuration

Set the `.env` keys, or publish the config to edit it directly:

```bash
php artisan vendor:publish --tag=enhanced-splash-config
```

| Key                       | `.env`                                    | Values                                      |
|---------------------------|-------------------------------------------|---------------------------------------------|
| `ios.mode`                | `ENHANCED_SPLASH_IOS_MODE`                | `image` (default), `icon`                   |
| `ios.background`          | `ENHANCED_SPLASH_IOS_BACKGROUND`          | `#RRGGBB` / `#RRGGBBAA` (default `#FFFFFF`) |
| `ios.background_dark`     | `ENHANCED_SPLASH_IOS_BACKGROUND_DARK`     | `#RRGGBB` / `#RRGGBBAA` (default `#000000`) |
| `ios.icon_size`           | `ENHANCED_SPLASH_IOS_ICON_SIZE`           | points (default `160`)                      |
| `ios.icon_rounded`        | `ENHANCED_SPLASH_IOS_ICON_ROUNDED`        | bool (default `true`)                       |
| `ios.icon_shadow`         | `ENHANCED_SPLASH_IOS_ICON_SHADOW`         | bool (default `false`)                      |
| `android.mode`            | `ENHANCED_SPLASH_ANDROID_MODE`            | `image` (default), `icon`                   |
| `android.background`      | `ENHANCED_SPLASH_ANDROID_BACKGROUND`      | `#RRGGBB` / `#RRGGBBAA` (default `#000000`) |
| `android.background_dark` | `ENHANCED_SPLASH_ANDROID_BACKGROUND_DARK` | `#RRGGBB` / `#RRGGBBAA` (default `#000000`) |

Colors are authored in CSS channel order; the alpha byte is converted to each platform's own ordering at build time.

`#` starts a comment in `.env`, so quote hex values there:

```dotenv
ENHANCED_SPLASH_ANDROID_MODE=icon
ENHANCED_SPLASH_ANDROID_BACKGROUND="#0F172A"
ENHANCED_SPLASH_ANDROID_BACKGROUND_DARK="#020617"
```

Defaults match NativePHP's own behavior, so installing the plugin changes nothing until you configure it.

## Android Modes

### `icon`: just one native splash instead of two

The system splash is held on screen until your app is ready, and the overlay never draws. Your launcher icon on `background`, then straight into your app. No second phase, nothing to time.

This mode ignores `splash.png` — the system splash draws your launcher icon, not your artwork. Pick it when your splash is a logo on a flat color, and `image` when the artwork matters.

### `image`: keep the default splash image, but influence the system splash color

Your `splash.png` still fills the screen. `background` and `background_dark` repaint everything around and before it — the system splash, the app window, and the overlay your image fades into. This makes transitions less jarring when your app and `splash.png` use different background colors.

## iOS Modes

### `icon`: a launch screen without a designer

Set `ios.mode = 'icon'` and the plugin builds the launch screen from `AppIcon.appiconset`: your icon, masked to the iOS squircle so it matches the home screen, centered on `background` / `background_dark`. Both of iOS's launch phases get the same image, so there is no flicker between them.

Tuning:

- `icon_size` — how large the icon is drawn, in points. The default `160` matches what Android shows.
- `icon_rounded` — turn off for artwork that is already shaped, or a logo that shouldn't be clipped.
- `icon_shadow` — a soft shadow to lift the icon off the background. Off by default.

### `image`: added SVG (vector) support

Drop `public/splash.svg` (and optionally `public/splash-dark.svg`) in place and it becomes the launch image, kept as a vector so it's sharp at every size. Without an SVG, the PNG variants are used as usual.

## Uninstall

```bash
composer remove unloc/nativephp-enhanced-splash

php artisan native:install
```

`native:install` regenerates the native project from NativePHP's own sources, clearing everything the plugin changed.

---

# SVG Component

> Unloc

<div class="plugin-info"><div class="pi-meta"><span class="pi-item"><span class="pi-label">Author</span><span class="pi-value">Unloc</span></span><span class="pi-item"><span class="pi-label">Plugin Type</span><span class="pi-badge pi-badge-community">Community Plugin</span></span><span class="pi-item"><span class="pi-label">Price</span><span class="pi-badge pi-badge-free">Free</span></span><span class="pi-item"><span class="pi-label">Version</span><span class="pi-value">v1.1.0</span></span><span class="pi-item"><span class="pi-label">License</span><span class="pi-value">MIT</span></span></div><div class="pi-compat"><span class="pi-chip"><span class="pi-chip-label">NativePHP</span><span class="pi-chip-value">^3.0 || ^4.0</span></span><span class="pi-chip"><span class="pi-chip-label">iOS</span><span class="pi-chip-value">16.0+</span></span><span class="pi-chip"><span class="pi-chip-label">Android</span><span class="pi-chip-value">26+</span></span></div><div class="pi-links"><a href="https://github.com/unlocnl/nativephp-svg-component" class="pi-link" target="_blank" rel="noopener">GitHub →</a></div></div>

# NativePHP SVG EDGE Component

`<native:svg>` — renders SVG as a real native graphic. SwiftDraw on iOS, coil-svg on Android, resolution-independent on both.

```blade
<native:svg :src="resource_path('svg/logo.svg')" alt="Logo" class="h-16 w-full object-contain"/>
```

Mirrors core's `<native:image>` — same props, same Tailwind sizing and `object-*` classes.

## Installation

```bash
composer require unloc/nativephp-svg-component

php artisan native:plugin:register unloc/nativephp-svg-component
```

## Attributes

| Attribute   | Notes |
|-------------|-------|
| `src`       | Required. File path, URL, `data:` URI, raw markup, or bundled asset name. |
| `fit`       | `none`, `contain`, `cover`, `fill`, `stretch`. Prefer the `object-*` classes. |
| `tintColor` | Palette name (`red-300`), `white` / `black` / `transparent`, hex, or any of those with a `/N` opacity modifier. For a theme token use `theme('primary')`. |
| `alt`       | Accessibility label. Omit it and the graphic is hidden from VoiceOver and TalkBack. |

```blade
<native:svg :src="$icon" :tintColor="theme('primary')" alt="Filter" class="h-6 w-6"/>
```

Size with classes, as you would an image:

```blade
<native:svg :src="$path" class="h-32 w-full object-cover rounded-2xl"/>
```

With no `object-*` class the graphic draws at its document size and lays out where the parent puts it, like an `<img>` with no CSS. Add `object-contain` to scale it into a frame.

## Sources

| Form | Description |
|------|-------------|
| `/absolute/path.svg`, `file://…` | Read from the filesystem |
| `https://…` | Fetched over the network |
| `data:image/svg+xml;…` | Base64 or percent-encoded, decoded in PHP |
| `<svg …>` | The document itself |
| anything else | Bundled asset name |

For SVGs shipped in your Laravel app, absolute paths are the reliable choice — the whole tree is copied into the bundle:

```blade
<native:svg :src="resource_path('svg/map.svg')"/>
```

## PHP API

```php
use NativePHP\SvgComponent\Elements\Svg;

Svg::make(resource_path('svg/logo.svg'))
    ->tintColor('primary')
    ->alt('Logo')
    ->class('h-16 w-full object-contain');
```

## Gotchas

**Author to SVG 1.1.** Android rejects the whole document on an attribute value it doesn't know, so a single SVG 2 value gives you a blank frame rather than a degraded one. iOS ignores the value and draws the rest, so it presents as "fine on iOS, blank on Android" with nothing in the logs. Seen with `orient="auto-start-reverse"`; `orient="auto"` renders.

**Inline markup has to come from PHP.** The precompiler treats every registered element type as a bare tag, so a literal `<svg>` written into a native view compiles to an *element*, not a string. Read it in your component and bind it:

```php
return view('native.screen', ['markup' => file_get_contents(resource_path('svg/logo.svg'))]);
```

```blade
<native:svg :src="$markup"/>
```

**Always author a `viewBox`.** Without one the document has no intrinsic size: iOS renders nothing, Android draws it unscaled in the corner.

**Failures are silent**, like `native:image`. A 404, a missing file, or malformed markup renders nothing. Native failures go to the native console; an undecodable data URI goes to the Laravel log.

A remote SVG that works on iOS but not Android is usually the host rejecting OkHttp's User-Agent — some CDNs return 403 to OkHttp and 200 to `URLSession`. Check with `curl -A 'okhttp/4.12.0' <url>`.

## Supported SVG Features

**Supported on both platforms:** paths, shapes, groups, transforms, fills and strokes, gradients, clip paths, masks, patterns, opacity, fill-rule, `<style>` blocks, embedded rasters.

**Not rendered:** filters, SMIL animation, and markers on iOS only. Filters and markers are dropped cleanly — the shape still draws.

`<text>` renders on both, but each engine picks its own fonts. Flatten it to paths when they have to match.

`fill` behaves as `cover` on iOS, since SwiftUI has no stretch content mode. Use `cover` when the platforms must agree.

---

# Mobile Haptics (Laravel 13 Fork)

> Blessed Zulu

<div class="plugin-info"><div class="pi-meta"><span class="pi-item"><span class="pi-label">Author</span><span class="pi-value">Blessed Zulu</span></span><span class="pi-item"><span class="pi-label">Plugin Type</span><span class="pi-badge pi-badge-community">Community Plugin</span></span><span class="pi-item"><span class="pi-label">Price</span><span class="pi-badge pi-badge-free">Free</span></span><span class="pi-item"><span class="pi-label">Version</span><span class="pi-value">v1.1.4</span></span><span class="pi-item"><span class="pi-label">License</span><span class="pi-value">MIT</span></span></div><div class="pi-compat"><span class="pi-chip"><span class="pi-chip-label">NativePHP</span><span class="pi-chip-value">^3.0</span></span><span class="pi-chip"><span class="pi-chip-label">PHP</span><span class="pi-chip-value">^8.2</span></span><span class="pi-chip"><span class="pi-chip-label">Laravel</span><span class="pi-chip-value">11 | 12 | 13</span></span><span class="pi-chip"><span class="pi-chip-label">iOS</span><span class="pi-chip-value">any</span></span><span class="pi-chip"><span class="pi-chip-label">Android</span><span class="pi-chip-value">any</span></span></div><div class="pi-links"><a href="https://github.com/blessedzulu/nativephp-mobile-haptics" class="pi-link" target="_blank" rel="noopener">GitHub →</a></div></div>

# NativePHP Mobile Haptics

Haptic feedback plugin for [NativePHP Mobile](https://nativephp.com) - impact, notification, selection, vibrate & pattern.

## Features

- **5 haptic types**: impact, notification, selection, raw vibrate, and custom patterns
- **Cross-platform**: native iOS (`UIFeedbackGenerator`) and Android (`VibrationEffect`) implementations
- **PHP + JavaScript**: use from Livewire/Blade or Vue/React/Inertia
- **Graceful degradation**: returns `false` on simulators or missing hardware
- **Zero config**: install and use - no publish, no migrations

## Requirements

- PHP 8.2+
- Laravel 11, 12 or 13
- NativePHP Mobile 3.0+

## Installation

```bash
composer require blessedzulu/nativephp-mobile-haptics
```

The service provider and facade are auto-discovered.

## Usage (PHP)

```php
use BlessedZulu\NativePHP\Mobile\Haptics\Facades\Haptics;

// Impact feedback - for button taps, collisions, UI emphasis
Haptics::impact('light');    // light, medium (default), heavy, rigid, soft

// Notification feedback - for async operation results
Haptics::notification('success');  // success (default), warning, error

// Selection feedback - for pickers, sliders, toggles
Haptics::selection();

// Raw vibration (ms) - native on Android, approximated on iOS
Haptics::vibrate(300);

// Vibration pattern [vibrate, pause, vibrate, pause, ...]
Haptics::pattern([100, 50, 200, 50, 100]);
```

All methods return `bool` - `true` on success, `false` on failure or missing hardware.

## Usage (JavaScript)

```js
import { haptics } from '@blessedzulu/nativephp-mobile-haptics';

await haptics.impact('heavy');
await haptics.notification('error');
await haptics.selection();
await haptics.vibrate(200);
await haptics.pattern([100, 50, 200]);
```

Or import individual functions:

```js
import { impact, notification, selection } from '@blessedzulu/nativephp-mobile-haptics';

await impact('medium');
```

## API Reference

| Method | Parameters | Default | Description |
|--------|-----------|---------|-------------|
| `impact($style)` | `light`, `medium`, `heavy`, `rigid`, `soft` | `medium` | Impact haptic feedback |
| `notification($type)` | `success`, `warning`, `error` | `success` | Notification haptic feedback |
| `selection()` | - | - | Selection tick feedback |
| `vibrate($ms)` | `1` - `5000` | `200` | Raw vibration in milliseconds |
| `pattern($array)` | `[vibrate, pause, ...]` | - | Custom vibration pattern |

## Platform Differences

| Feature | iOS | Android |
|---------|-----|---------|
| Impact | Native (`UIImpactFeedbackGenerator`) | Native (`VibrationEffect.createOneShot`) |
| Notification | Native (`UINotificationFeedbackGenerator`) | Native (predefined effects API 29+, waveform fallback) |
| Selection | Native (`UISelectionFeedbackGenerator`) | Native (`EFFECT_TICK` API 29+, short vibration fallback) |
| Vibrate | Approximated via repeated impacts | Native (`createOneShot`) |
| Pattern | Approximated via timed impacts | Native (`createWaveform`) |
| Permission | None required | `VIBRATE` (auto-granted) |
| Min version | iOS 13.0 | API 26 (Android 8.0) |

## Disabling Haptics

Use standard conditional logic:

```php
if ($user->prefersHaptics()) {
    Haptics::impact('medium');
}
```

## Testing

```bash
composer test
```

---

# Super Code Highlight

> Matildevoldsen

<div class="plugin-info"><div class="pi-meta"><span class="pi-item"><span class="pi-label">Author</span><span class="pi-value">Matildevoldsen</span></span><span class="pi-item"><span class="pi-label">Plugin Type</span><span class="pi-badge pi-badge-community">Community Plugin</span></span><span class="pi-item"><span class="pi-label">Price</span><span class="pi-badge pi-badge-free">Free</span></span><span class="pi-item"><span class="pi-label">Version</span><span class="pi-value">vlatest</span></span><span class="pi-item"><span class="pi-label">License</span><span class="pi-value">MIT</span></span></div><div class="pi-compat"><span class="pi-chip"><span class="pi-chip-label">NativePHP</span><span class="pi-chip-value">^3.0</span></span><span class="pi-chip"><span class="pi-chip-label">PHP</span><span class="pi-chip-value">^8.4</span></span><span class="pi-chip"><span class="pi-chip-label">Laravel</span><span class="pi-chip-value">13+</span></span><span class="pi-chip"><span class="pi-chip-label">iOS</span><span class="pi-chip-value">18.2+</span></span><span class="pi-chip"><span class="pi-chip-label">Android</span><span class="pi-chip-value">33+</span></span></div><div class="pi-links"><a href="https://github.com/Matildevoldsen/super-codehighlight" class="pi-link" target="_blank" rel="noopener">GitHub →</a></div></div>

NativePHP mobile UI plugin for Shiki-powered code highlighting rendered with native SwiftUI and Jetpack Compose views.

This package uses Shiki itself. It does not use `highlight.js`, `hljs`, or WebView-rendered HTML.

## Features

- Native `<native:shiki-code />` Blade component.
- Shiki `4.2.0` runtime bundled from official Shiki packages.
- Generated manifest from Shiki language and theme registries.
- iOS runtime through JavaScriptCore.
- Android runtime through Jetpack JavaScriptEngine.
- Native token rows rendered as SwiftUI and Compose text spans.
- Intended integration with Super Markdown code fences.

## Requirements

- PHP 8.4 or newer.
- Laravel with `nativephp/mobile`.
- Node.js for rebuilding the Shiki bundle.
- iOS 18.2 or newer.
- Android API 33 or newer.
- Android dependency `androidx.javascriptengine:javascriptengine`.

## Installation

```bash
composer require tilly/nativephp-shiki
```

For local development:

```json
{
  "repositories": [
    {
      "type": "path",
      "url": "packages/nativephp-shiki",
      "options": { "symlink": true }
    }
  ]
}
```

Then:

```bash
composer require tilly/nativephp-shiki:*
```

## NativePHP Registration

Register the plugin in `app/Providers/NativeServiceProvider.php`:

```php
use Tilly\NativephpShiki\ShikiServiceProvider;

public function plugins(): array
{
    return [
        ShikiServiceProvider::class,
    ];
}
```

## Usage

```blade
<native:shiki-code
    :code="$code"
    language="php"
    theme="github-dark"
    :font-size="13"
    :show-language-label="true" />
```

With Super Markdown:

```blade
<native:cmark-markdown
    :source="$markdown"
    :highlight-code="true"
    code-light-theme="github-light"
    code-dark-theme="github-dark" />
```

## Shiki Bundle

The generated runtime lives in `resources/generated`.

Rebuild it after changing Shiki version or codegen:

```bash
npm install
npm run build
npm test
```

The build script reads Shiki's own language and theme registries. Do not manually maintain a hard-coded language list.

## Props

| Prop | Default | Description |
| --- | --- | --- |
| `code` | `''` | Source code to highlight. |
| `language` | `text` | Shiki language id or alias. |
| `theme` | `github-dark` | Shiki theme id. |
| `font-size` | `13` | Native code font size. |
| `show-language-label` | `true` | Shows the language label. |

## Development

From a NativePHP host app:

```bash
composer dump-autoload
php artisan native:plugin:list
php artisan native:plugin:validate packages/nativephp-shiki
php artisan test
```

Run native verification:

```bash
php artisan native:run ios --start-url=/markdown-chat --no-vite
php artisan native:run android emulator-5554 --start-url=/markdown-chat --no-vite
```

Scan for forbidden renderers:

```bash
rg -n "WebView|WKWebView|highlight\.js|hljs" packages/nativephp-shiki
```

## Runtime Notes

- Unknown languages should fall back to plain native code rendering in the caller.
- Streaming callers should cache highlights by `sha256(code + lang + theme)`.
- The native renderer consumes token JSON, not HTML.

---

# Super Markdown

> Matildevoldsen

<div class="plugin-info"><div class="pi-meta"><span class="pi-item"><span class="pi-label">Author</span><span class="pi-value">Matildevoldsen</span></span><span class="pi-item"><span class="pi-label">Plugin Type</span><span class="pi-badge pi-badge-community">Community Plugin</span></span><span class="pi-item"><span class="pi-label">Price</span><span class="pi-badge pi-badge-free">Free</span></span><span class="pi-item"><span class="pi-label">Version</span><span class="pi-value">vlatest</span></span><span class="pi-item"><span class="pi-label">License</span><span class="pi-value">MIT</span></span></div><div class="pi-compat"><span class="pi-chip"><span class="pi-chip-label">NativePHP</span><span class="pi-chip-value">^3.0</span></span><span class="pi-chip"><span class="pi-chip-label">PHP</span><span class="pi-chip-value">^8.4</span></span><span class="pi-chip"><span class="pi-chip-label">Laravel</span><span class="pi-chip-value">13+</span></span><span class="pi-chip"><span class="pi-chip-label">iOS</span><span class="pi-chip-value">18.2+</span></span><span class="pi-chip"><span class="pi-chip-label">Android</span><span class="pi-chip-value">33+</span></span></div><div class="pi-links"><a href="https://github.com/Matildevoldsen/super-markdown" class="pi-link" target="_blank" rel="noopener">GitHub →</a></div></div>

NativePHP mobile UI plugin for rendering GitHub Flavored Markdown with native SwiftUI and Jetpack Compose views.

This package uses `cmark-gfm` as the parser source. It does not render Markdown as HTML and does not use a WebView for Markdown output.

## Features

- Native `<native:cmark-markdown />` Blade component.
- cmark-gfm powered parsing for headings, paragraphs, emphasis, links, lists, task lists, tables, thematic breaks, blockquotes, unsafe HTML text, and fenced code blocks.
- iOS SwiftUI renderer backed by `libcmark_gfm` from CocoaPods.
- Android Compose renderer backed by cmark-gfm through JNI.
- Stream-friendly block records for stable native identity during data streaming.
- Optional Shiki integration for highlighted code blocks.
- Mermaid fence handling through `tilly/nativephp-mermaid`.
- Per-word streaming animations inspired by Streamdown: `fade-in`, `blur-in`, and `slide-up`.

## Requirements

- PHP 8.4 or newer.
- Laravel with `nativephp/mobile`.
- NativePHP mobile 3 style UI plugins.
- iOS 18.2 or newer.
- Android API 33 or newer.
- Xcode with CocoaPods for iOS builds.
- Android Studio, SDK, NDK, and CMake for Android builds.

## Installation

Install the package in your NativePHP mobile app:

```bash
composer require tilly/nativephp-cmark-markdown
```

For local development, use a path repository:

```json
{
  "repositories": [
    {
      "type": "path",
      "url": "packages/nativephp-cmark-markdown",
      "options": { "symlink": true }
    }
  ]
}
```

Then require it:

```bash
composer require tilly/nativephp-cmark-markdown:*
```

## NativePHP Registration

Register the plugin explicitly in `app/Providers/NativeServiceProvider.php`:

```php
use Tilly\NativephpCmarkMarkdown\CmarkMarkdownServiceProvider;

public function plugins(): array
{
    return [
        CmarkMarkdownServiceProvider::class,
    ];
}
```

## Usage

```blade
<native:cmark-markdown
    :source="$markdown"
    streaming
    :highlight-code="true"
    code-light-theme="github-light"
    code-dark-theme="github-dark"
    animation="slide-up"
    animation-split="word"
    :animation-duration="180"
    caret="block"
    mermaid-renderer="beautiful" />
```

For high-frequency streaming, pass stable block records alongside the full source:

```blade
<native:cmark-markdown
    :source="$this->visibleMarkdown()"
    :blocks="$this->visibleMarkdownBlocks()"
    streaming />
```

The `blocks` prop is an internal performance hint. The visible output should still be driven by normal token or text deltas.

## Props

| Prop | Default | Description |
| --- | --- | --- |
| `source` | `''` | Markdown source text. |
| `blocks` | `[]` | JSON or array of stable block records. |
| `streaming` | `false` | Marks the renderer as stream-aware. |
| `base-font-size` | `16` | Base prose font size. |
| `code-font-size` | `14` | Code font size. |
| `theme` | `system` | `system`, `light`, or `dark`. |
| `show-language-labels` | `true` | Shows fence language labels. |
| `highlight-code` | `true` | Delegates code blocks to Shiki when installed. |
| `code-light-theme` | `github-light` | Shiki light theme. |
| `code-dark-theme` | `github-dark` | Shiki dark theme. |
| `animation` | `slide-up` | `fade-in`, `blur-in`, or `slide-up`. |
| `animation-split` | `auto` | `auto`, `word`, or `char`. |
| `animation-duration` | `500` | Animation duration in milliseconds. |
| `caret` | `block` | `none`, `block`, or `circle`. |

## Streaming Guidance

Use your transport layer to append normal text or token deltas. Do not emit artificial Markdown block chunks as user-visible content.

For production chat UIs:

- Keep the full assistant message as one source string.
- Use stable block records only as renderer identity hints.
- Avoid animating code blocks, tables, and diagrams while they are still structurally incomplete.
- Prefer `animation-split="word"` for normal assistant prose.
- Use `animation-split="char"` sparingly because it creates more native views.

## Development

From a host NativePHP app:

```bash
composer dump-autoload
php artisan native:plugin:list
php artisan native:plugin:validate packages/nativephp-cmark-markdown
php artisan test
```

Run iOS:

```bash
php artisan native:run ios --start-url=/markdown-chat --no-vite
```

Run Android:

```bash
export ANDROID_HOME="$HOME/Library/Android/sdk"
export PATH="$ANDROID_HOME/platform-tools:$ANDROID_HOME/emulator:$PATH"
php artisan native:run android emulator-5554 --start-url=/markdown-chat --no-vite
```

## Security

Markdown HTML nodes are not passed to a web renderer. Unsafe HTML must be displayed as inert text or skipped by the native renderer.

---

# Health Connect

> captenmasin

<div class="plugin-info"><div class="pi-meta"><span class="pi-item"><span class="pi-label">Author</span><span class="pi-value">captenmasin</span></span><span class="pi-item"><span class="pi-label">Plugin Type</span><span class="pi-badge pi-badge-community">Community Plugin</span></span><span class="pi-item"><span class="pi-label">Price</span><span class="pi-badge pi-badge-free">Free</span></span><span class="pi-item"><span class="pi-label">Version</span><span class="pi-value">vlatest</span></span><span class="pi-item"><span class="pi-label">License</span><span class="pi-value">MIT</span></span></div><div class="pi-compat"><span class="pi-chip"><span class="pi-chip-label">NativePHP</span><span class="pi-chip-value">^3.0</span></span><span class="pi-chip"><span class="pi-chip-label">PHP</span><span class="pi-chip-value">^8.2</span></span><span class="pi-chip"><span class="pi-chip-label">Android</span><span class="pi-chip-value">33+</span></span></div><div class="pi-links"><a href="https://github.com/captenmasin/nativephp-health-connect" class="pi-link" target="_blank" rel="noopener">GitHub →</a></div></div>

NativePHP Health Connect is a NativePHP mobile plugin for reading normalized workout data from Android Health Connect.

It exposes a small Laravel-friendly PHP API backed by a NativePHP Android bridge. The plugin can check Health Connect availability, launch the Android permission flow, and read recent workouts with calories, dates, durations, and source metadata.

## Requirements

- PHP 8.2 or higher
- `nativephp/mobile` 3.0 or higher
- Android API 33 or higher
- Android Health Connect available on the device

This package currently provides an Android implementation. Calls made outside a NativePHP Android app return an unsupported response instead of throwing.

## Installation

Install the package with Composer:

```bash
composer require captenmasin/nativephp-health-connect
```

The service provider, facade alias, NativePHP manifest, Android permissions, and Android dependency are registered through the package metadata.

## Usage

Use the `HealthConnect` facade from your NativePHP mobile app:

```php
use HealthConnect;

$status = HealthConnect::status();

if (($status['status'] ?? null) === 'permission_required') {
    HealthConnect::requestPermissions();
}

$result = HealthConnect::readWorkouts(30);
```

`readWorkouts()` accepts a sync window in days. Values below `1` are clamped to `1`.

```php
$result = HealthConnect::syncNow(windowDays: 14);
```

`syncNow()` is an alias for `readWorkouts()`.

## API

### `HealthConnect::status()`

Returns Health Connect availability and permission state.

### `HealthConnect::requestPermissions()`

Launches the Android Health Connect permission flow.

### `HealthConnect::readWorkouts(int $windowDays = 30)`

Reads workout records from Health Connect for the requested window.

### `HealthConnect::syncNow(int $windowDays = 30)`

Alias for `readWorkouts()`.

## Response Shape

Successful workout reads return an array with a JSON payload string:

```php
[
    'supported' => true,
    'available' => true,
    'has_permissions' => true,
    'status' => 'success',
    'records_count' => 3,
    'payload' => '{"synced_at":"...","window_start":"...","window_end":"...","records":[...]}',
]
```

Each record in `payload.records` is normalized to fields like:

```json
{
    "external_id": "health-connect-record-id",
    "title": "Run",
    "calories_burned": 420,
    "date": "2026-05-21",
    "started_at": "2026-05-21T07:30:00+01:00",
    "ended_at": "2026-05-21T08:05:00+01:00",
    "duration_seconds": 2100,
    "source_name": "com.example.healthapp",
    "source_package": "com.example.healthapp"
}
```

Common statuses include:

- `unsupported` when the call is made outside a NativePHP Android app
- `unavailable` when Health Connect or the bridge is not available
- `permission_required` when Health Connect permissions have not been granted
- `permission_requested` after launching the permission flow
- `success` when records were read
- `error` when the bridge returns an invalid response

## Health Connect Data

The Android implementation reads:

- Exercise sessions
- Total calories burned
- Active calories burned

Exercise sessions are preferred when calories can be matched to the session. Standalone calorie records are included when they do not overlap an already imported workout interval.

---

# Mobile Call Detection

> Stitch Digital

<div class="plugin-info"><div class="pi-meta"><span class="pi-item"><span class="pi-label">Author</span><span class="pi-value">Stitch Digital</span></span><span class="pi-item"><span class="pi-label">Plugin Type</span><span class="pi-badge pi-badge-community">Community Plugin</span></span><span class="pi-item"><span class="pi-label">Price</span><span class="pi-badge pi-badge-free">Free</span></span><span class="pi-item"><span class="pi-label">Version</span><span class="pi-value">v1.0.0</span></span><span class="pi-item"><span class="pi-label">License</span><span class="pi-value">MIT</span></span></div><div class="pi-compat"><span class="pi-chip"><span class="pi-chip-label">NativePHP</span><span class="pi-chip-value">^3.0</span></span><span class="pi-chip"><span class="pi-chip-label">PHP</span><span class="pi-chip-value">^8.2</span></span><span class="pi-chip"><span class="pi-chip-label">iOS</span><span class="pi-chip-value">13.0+</span></span><span class="pi-chip"><span class="pi-chip-label">Android</span><span class="pi-chip-value">21+</span></span></div><div class="pi-links"><a href="https://github.com/stitch-digital/mobile-call-detection" class="pi-link" target="_blank" rel="noopener">GitHub →</a></div></div>

# Call Detection Plugin for NativePHP Mobile

A NativePHP Mobile plugin that detects when phone calls end and fires a `CallEnded` event with call metadata.

Useful for apps that need to log calls, trigger workflows after conversations, or track call activity — such as `CRM`, `sales`, or `support` applications.

---

## Platform Support

| Feature              |          Android           |                iOS                 |
|----------------------|:--------------------------:|:----------------------------------:|
| Phone number         |             ✅              | ❌ Not available (Apple privacy)    |
| Call direction       | ✅ `inbound` / `outbound`  | ❌ Always `unknown`                 |
| Duration             | ✅ From call log (accurate) | ⚠️ From timestamps (approximate)  |
| Background detection |  ✅ BroadcastReceiver       | ⚠️ Limited (CXCallObserver)       |
| Permissions required |             ✅              | ✅ None needed                      |

### How It Works

**Android** uses a manifest-registered `BroadcastReceiver` that listens for `android.intent.action.PHONE_STATE`. A state machine tracks transitions between `RINGING`, `OFFHOOK`, and `IDLE` to determine when a call ends and whether it was inbound or outbound. After the call ends, the plugin waits ~1 second then queries `CallLog.Calls.CONTENT_URI` for the phone number, direction, and duration.

**iOS** uses `CXCallObserver` with a `CXCallObserverDelegate`. Apple privacy restrictions mean the plugin cannot access the phone number or call direction. It tracks `hasConnected` timestamps per call UUID to approximate duration, and dispatches the event when `hasEnded` becomes true.

---

## Requirements

|                  | Minimum          |
|------------------|------------------|
| PHP              | 8.2              |
| NativePHP Mobile | 3.x              |
| Android          | API 21+          |
| iOS              | 13.0+            |

---

## Installation

```bash
composer require stitch-digital/mobile-call-detection
```

The service provider and `CallDetection` facade are auto-discovered by Laravel — no manual registration needed.

---

## Quick Start

```php
use StitchDigital\CallDetection\Facades\CallDetection;

// Check if permissions are granted
$granted = CallDetection::hasPermission();

// Request permissions (shows system dialog on Android, no-op on iOS)
$granted = CallDetection::requestPermission();
```

Then listen for the `CallEnded` event in your Livewire component or event listener.

---

## PHP API

All methods are available via the `CallDetection` facade or by resolving `StitchDigital\CallDetection\CallDetection` from the container.

### `hasPermission(): bool`

Check whether the required permissions have been granted.

- **Android** — checks `READ_PHONE_STATE` and `READ_CALL_LOG` via `ContextCompat.checkSelfPermission`.
- **iOS** — always returns `true`. `CXCallObserver` does not require explicit permission.

Returns `false` if running outside NativePHP.

```php
if (CallDetection::hasPermission()) {
    // Ready to detect calls
}
```

---

### `requestPermission(): bool`

Request call detection permissions from the user.

- **Android** — shows the system permission dialog for `READ_PHONE_STATE` and `READ_CALL_LOG`. Returns `false` immediately because the result is asynchronous — call `hasPermission()` again after the user responds.
- **iOS** — no-op, returns `true`. No permission is needed.

Returns `false` if running outside NativePHP.

```php
CallDetection::requestPermission();

// After the user responds to the dialog:
$granted = CallDetection::hasPermission();
```

---

## JavaScript API

```js
import { HasPermission, RequestPermission } from '../vendor/stitch-digital/mobile-call-detection/resources/js/index.js';

const { data } = await HasPermission();
// data.granted → true/false

const { data } = await RequestPermission();
// data.granted → true/false
```

---

## Events

The plugin dispatches a single event that covers the full call lifecycle completion.

| Event       | Dispatched when           |
|-------------|---------------------------|
| `CallEnded` | A phone call has finished |

### `CallEnded` Payload

| Property       | Type      | Description                                        |
|----------------|-----------|----------------------------------------------------|
| `$phoneNumber` | `?string` | The phone number (`null` on iOS)                   |
| `$direction`   | `string`  | `'inbound'`, `'outbound'`, or `'unknown'`          |
| `$duration`    | `int`     | Call duration in seconds                            |
| `$platform`    | `string`  | `'android'` or `'ios'`                              |

### Listening with `#[OnNative]`

```php
use Native\Mobile\Attributes\OnNative;
use StitchDigital\CallDetection\Events\CallEnded;

class CallLog extends Component
{
    public array $calls = [];

    #[OnNative(CallEnded::class)]
    public function handleCallEnded(
        ?string $phoneNumber,
        string $direction,
        int $duration,
        string $platform,
    ): void {
        $this->calls[] = [
            'phoneNumber' => $phoneNumber,
            'direction' => $direction,
            'duration' => $duration,
            'platform' => $platform,
        ];
    }

    public function render()
    {
        return view('livewire.call-log');
    }
}
```

### Vue Example

```vue
<script setup>
import { ref, onMounted, onUnmounted } from 'vue';

const calls = ref([]);

function handleCallEnded(event) {
    calls.value.push(event.detail);
}

onMounted(() => {
    window.addEventListener('native:StitchDigital\CallDetection\Events\CallEnded', handleCallEnded);
});

onUnmounted(() => {
    window.removeEventListener('native:StitchDigital\CallDetection\Events\CallEnded', handleCallEnded);
});
</script>
```

### React Example

```jsx
import { useEffect, useState } from 'react';

function CallLog() {
    const [calls, setCalls] = useState([]);

    useEffect(() => {
        const handler = (event) => {
            setCalls(prev => [...prev, event.detail]);
        };

        window.addEventListener('native:StitchDigital\CallDetection\Events\CallEnded', handler);
        return () => window.removeEventListener('native:StitchDigital\CallDetection\Events\CallEnded', handler);
    }, []);

    return (
        <ul>
            {calls.map((call, i) => (
                <li key={i}>{call.direction} — {call.duration}s</li>
            ))}
        </ul>
    );
}
```

---

## Platform Notes

### Android

- The `CallEndedReceiver` is registered in the AndroidManifest via the plugin manifest, so it receives call state changes **even when the app is in the background**.
- After detecting `IDLE` state, the plugin waits ~1 second before querying the call log. This delay allows the system to finish writing the log entry.
- If `READ_CALL_LOG` permission is denied but `READ_PHONE_STATE` is granted, the receiver falls back to the internal state machine for direction and duration (less accurate, no phone number).
- The receiver tracks state transitions: `RINGING → OFFHOOK → IDLE` (inbound) and `OFFHOOK → IDLE` (outbound).
- The `CallEnded` event is dispatched on the **main thread**, which is required for WebView JavaScript injection.

### iOS

- `CXCallObserver` does not require explicit permission — the permission API is a no-op on iOS.
- **Phone numbers cannot be accessed** at the application level. Apple does not expose this data through `CXCallObserver`. The `phoneNumber` field is always `null`.
- **Call direction cannot be determined.** The `direction` field is always `"unknown"`.
- Duration is **approximated** from the time difference between `hasConnected` and `hasEnded` timestamps. Calls that end without connecting (missed/rejected) report a duration of `0`.
- The `CallObserverManager` singleton is initialized at app launch via `init_function` and persists for the app's lifetime.

---

## Testing

```bash
# Install in your NativePHP app
composer require stitch-digital/mobile-call-detection

# Run on Android
php artisan native:run android

# Run on iOS
php artisan native:run ios
```

Then trigger the permission flow and make a test call:

**Android** — call `CallDetection::requestPermission()`, grant both permissions, then make or receive a phone call. The `CallEnded` event should fire with the phone number, direction, and duration.

**iOS** — make or receive a phone call. The `CallEnded` event should fire with `null` phoneNumber, `"unknown"` direction, and an approximate duration.

---

---

# Mobile LA518 Recorder

> Wojt Janowski

<div class="plugin-info"><div class="pi-meta"><span class="pi-item"><span class="pi-label">Author</span><span class="pi-value">Wojt Janowski</span></span><span class="pi-item"><span class="pi-label">Plugin Type</span><span class="pi-badge pi-badge-community">Community Plugin</span></span><span class="pi-item"><span class="pi-label">Price</span><span class="pi-badge pi-badge-free">Free</span></span><span class="pi-item"><span class="pi-label">Version</span><span class="pi-value">vlatest</span></span><span class="pi-item"><span class="pi-label">License</span><span class="pi-value">MIT</span></span></div><div class="pi-compat"><span class="pi-chip"><span class="pi-chip-label">NativePHP</span><span class="pi-chip-value">^3.0</span></span><span class="pi-chip"><span class="pi-chip-label">PHP</span><span class="pi-chip-value">^8.2</span></span><span class="pi-chip"><span class="pi-chip-label">iOS</span><span class="pi-chip-value">any</span></span><span class="pi-chip"><span class="pi-chip-label">Android</span><span class="pi-chip-value">any</span></span></div><div class="pi-links"><a href="https://github.com/wojt-janowski/mobile-la518-recorder" class="pi-link" target="_blank" rel="noopener">GitHub →</a></div></div>

# MobileLa518Recorder — NativePHP plugin for LA518 voice recorders

A NativePHP Mobile plugin that talks to LA518-based BLE voice recorders
(Umevo Note Plus and OEM rebadges using the same chip). Connect, list
recordings, start/stop recording from your app, download MP3s, and consume
live audio + VU level data — all from PHP and JavaScript.

The full BLE protocol was reverse-engineered from PacketLogger captures of
the official iOS app. See [`PROTOCOL.md`](PROTOCOL.md) for the complete
wire-level spec — frame format, opcode table, handshake sequence, file
listing, recording control, downloads, live VU/audio streams, and
end-of-transfer flag semantics.

## Installation

```bash
composer require wojt-janowski/mobile-la518-recorder
php artisan vendor:publish --tag=nativephp-plugins-provider     # first time only
php artisan native:plugin:register wojt-janowski/mobile-la518-recorder
php artisan native:plugin:list                                    # verify
```

## Permissions

### Android (auto-merged into your `AndroidManifest.xml`)
- `BLUETOOTH`, `BLUETOOTH_ADMIN`
- `BLUETOOTH_SCAN`, `BLUETOOTH_CONNECT` (Android 12+)
- `ACCESS_FINE_LOCATION` (required for BLE scanning)

### iOS (auto-merged into your `Info.plist`)
- `NSBluetoothAlwaysUsageDescription`
- `NSBluetoothPeripheralUsageDescription`

You'll be prompted by the OS the first time `connect()` is called.

## PHP usage (Livewire/Blade)

```php
use WojtJanowski\MobileLa518Recorder\Facades\MobileLa518Recorder;

// Discover and bind. Returns 15-char device serial, or null on failure.
$serial = MobileLa518Recorder::connect();

// List stored recordings — array of ['name' => '...', 'size' => bytes, 'duration' => seconds]
$files = MobileLa518Recorder::listFiles();

// Start a new recording on the device
$filename = MobileLa518Recorder::startRecording();

// …user does something for a while…

// Stop. Returns ['filename' => '...', 'size' => bytes, 'mode' => 'normal'|'call']
$ack = MobileLa518Recorder::stopRecording();

// Download a stored recording. Returns absolute local file path.
$localPath = MobileLa518Recorder::downloadFile($filename);
```

### Listening to events

```php
use Native\Mobile\Attributes\OnNative;
use WojtJanowski\MobileLa518Recorder\Events\{
    DeviceConnected, DeviceDisconnected,
    RecordingStarted, RecordingStopped,
    VuLevel, LiveAudioChunk,
    DownloadProgress, DownloadCompleted,
};

class Recorder extends Livewire\Component
{
    public int $vuLevel = 0;

    #[OnNative(VuLevel::class)]
    public function onVu($level, $deltaSinceLast)
    {
        $this->vuLevel = $level;
    }

    #[OnNative(LiveAudioChunk::class)]
    public function onChunk($filename, $base64Data, $sequenceIndex)
    {
        // base64-decode into a buffer, stream to a transcriber, etc.
    }

    #[OnNative(RecordingStopped::class)]
    public function onStopped($filename, $size, $mode)
    {
        // Recording is now persisted on the device — fetch it
        $localPath = MobileLa518Recorder::downloadFile($filename);
    }
}
```

## JavaScript usage (Vue/React/Inertia)

```js
import { MobileLa518Recorder, Events } from '@wojt-janowski/mobile-la518-recorder';
import { on, off } from '@nativephp/native';

const serial = await MobileLa518Recorder.connect();
const files  = await MobileLa518Recorder.listFiles();

const handler = ({ level }) => updateMeter(level);
on(Events.VuLevel, handler);

await MobileLa518Recorder.startRecording();
// …
const result = await MobileLa518Recorder.stopRecording();

off(Events.VuLevel, handler);
```

## Available methods

| Method | Returns | Notes |
|---|---|---|
| `connect(int $scanTimeoutSeconds = 10)` | `string\|null` | Device serial. Requests fast BLE mode. |
| `disconnect()` | `bool` | Closes BLE link; **does not** stop a running recording. |
| `isConnected()` | `bool` | |
| `listFiles()` | `array` | Each row: `['name', 'size', 'duration']`. |
| `startRecording()` | `string\|null` | Recording filename (`YYYYMMDDHHMMSS`). |
| `stopRecording()` | `array\|null` | `['filename', 'size', 'mode']`, mode = `normal` or `call`. |
| `downloadFile(string $name)` | `string\|null` | Absolute local file path. |

## Event payloads

| Event | Properties |
|---|---|
| `DeviceConnected` | `serial: string` |
| `DeviceDisconnected` | `reason: ?string` |
| `RecordingStarted` | `filename: string` |
| `RecordingStopped` | `filename: string`, `size: int`, `mode: string` |
| `VuLevel` | `level: int (0..65535)`, `deltaSinceLast: int` |
| `LiveAudioChunk` | `filename: string`, `base64Data: string` (raw F0F3 chunk), `sequenceIndex: int` |
| `DownloadProgress` | `filename: string`, `bytesReceived: int`, `totalBytes: int` |
| `DownloadCompleted` | `filename: string`, `localPath: string`, `size: int` |

## Protocol reference

The complete reverse-engineered BLE protocol — GATT layout, frame format,
every opcode, the bind handshake, file-listing format, recording control,
download flow, live VU/audio streams, and call-mode flag semantics — is
documented in [`PROTOCOL.md`](PROTOCOL.md).

Quick summary:

- Audio output: **MP3, 32 kbps, 16 kHz, mono**
- Custom GATT service `F0F0` with TX (`F0F1`), control RX (`F0F2`), live
  stream (`F0F3`), and download stream (`F0F4`) characteristics
- Frame envelope: `80 08 02 [op] [len] [body] [trailer]`
- Mandatory bind handshake within ~3 s of connecting (challenge `"131186"`)

---

# SMS Reader

> Anthony Tendwa

<div class="plugin-info"><div class="pi-meta"><span class="pi-item"><span class="pi-label">Author</span><span class="pi-value">Anthony Tendwa</span></span><span class="pi-item"><span class="pi-label">Plugin Type</span><span class="pi-badge pi-badge-community">Community Plugin</span></span><span class="pi-item"><span class="pi-label">Price</span><span class="pi-badge pi-badge-free">Free</span></span><span class="pi-item"><span class="pi-label">Version</span><span class="pi-value">v1.0.0</span></span><span class="pi-item"><span class="pi-label">License</span><span class="pi-value">MIT</span></span></div><div class="pi-compat"><span class="pi-chip"><span class="pi-chip-label">NativePHP</span><span class="pi-chip-value">^3.0</span></span><span class="pi-chip"><span class="pi-chip-label">PHP</span><span class="pi-chip-value">^8.2</span></span><span class="pi-chip"><span class="pi-chip-label">Laravel</span><span class="pi-chip-value">11 | 12</span></span><span class="pi-chip"><span class="pi-chip-label">Android</span><span class="pi-chip-value">26+</span></span></div><div class="pi-links"><a href="https://github.com/atendwa/nativephp-sms-reader" class="pi-link" target="_blank" rel="noopener">GitHub →</a></div></div>

# atendwa/nativephp-sms-reader

A [NativePHP Mobile](https://nativephp.com/docs/mobile) plugin for Laravel that lets your Android app read SMS messages from the device inbox and listen for incoming SMS in real time.

---

## Introduction

`atendwa/sms-reader` bridges the Android SMS `ContentProvider` and `BroadcastReceiver` into your Laravel application. It provides:

- **`SmsReader::getMessages()`** — query the device inbox with optional sender, limit, and date filters.
- **`SmsReader::getMessagesForSenders()`** — batch inbox queries across multiple senders.
- **`SmsReceived` event** — fired in real time whenever a new SMS arrives on the device.

The plugin only operates inside the NativePHP Android runtime. On the web, in Artisan, or on iOS it returns empty results rather than throwing, so your code runs safely in all environments.

---

## Requirements

| Requirement      | Version               |
|------------------|-----------------------|
| PHP              | 8.3+                  |
| Laravel          | 11+                   |
| NativePHP Mobile | 3.0+                  |
| Android          | API 26+ (Android 8.0) |

---

## Installation

### 1. Add the package via Composer

```bash
composer require atendwa/nativephp-sms-reader
```

### 2. Register the plugin with NativePHP

NativePHP requires every plugin to be explicitly registered as a security measure — it prevents transitive Composer dependencies from silently bundling native code into your app.

```bash
php artisan native:plugin:register atendwa/nativephp-sms-reader
```

This adds the service provider to `app/Providers/NativeServiceProvider.php`:

```php
public function plugins(): array
{
    return [
        \Atendwa\SmsReader\SmsReaderServiceProvider::class,
    ];
}
```

### 3. Rebuild the app

Plugin changes require a full rebuild:

```bash
php artisan native:run android
```

---

## Verifying the Installation

### Check the plugin is registered

```bash
php artisan native:plugin:list
```

You should see `atendwa/sms-reader` in the output.

### Validate the plugin manifest

```bash
php artisan native:plugin:validate
```

### Test the bridge on-device

Add a temporary debug button in a Livewire component to confirm the bridge is reachable:

```php
use Atendwa\SmsReader\Facades\SmsReader;

public function debugSms(): void
{
    $raw = SmsReader::getRawResponse(['sender' => 'MPESA', 'limit' => 1]);
    dd($raw); // inspect the raw JSON from the native bridge
}
```

If the bridge is working you will see a JSON string like:

```json
{"messages":[{"id":"123","sender":"MPESA","body":"...","timestamp":1234567890000}]}
```

If `nativephp_call()` does not exist (e.g. you are running on the web), the method returns a descriptive string rather than throwing.

---

## Usage

### Reading inbox messages

```php
use Atendwa\SmsReader\Facades\SmsReader;

// All messages from MPESA in the last 30 days
$sinceMs = now()->subDays(30)->timestamp * 1000;

$messages = SmsReader::getMessages([
    'sender' => 'MPESA',
    'limit'  => 500,
    'since'  => $sinceMs,
]);

// Each message: ['id' => string, 'sender' => string, 'body' => string, 'timestamp' => int]
foreach ($messages as $sms) {
    echo $sms['body'];
}
```

Available options:

| Option   | Type     | Description                                                             |
|----------|----------|-------------------------------------------------------------------------|
| `sender` | `string` | Filter by originating address (exact match)                             |
| `limit`  | `int`    | Maximum number of messages to return (default 500)                      |
| `since`  | `int`    | Only return messages newer than this Unix timestamp in **milliseconds** |

### Reading from multiple senders

```php
$messages = SmsReader::getMessagesForSenders(
    senders:    ['MPESA', 'airtelmoney'],
    sinceMs:    now()->subDays(90)->timestamp * 1000,
    limitEach:  500,
);
```

Results are merged and sorted by timestamp descending.

### Listening for incoming SMS (real time)

Use the `#[OnNative]` attribute in any Livewire component:

```php
use Atendwa\SmsReader\Events\SmsReceived;
use Native\Mobile\Attributes\OnNative;

class Dashboard extends Component
{
    #[OnNative(SmsReceived::class)]
    public function onSmsReceived(
        string $sender,
        string $body,
        int    $timestamp,
        string $id,
    ): void {
        // $sender    — originating address, e.g. "MPESA"
        // $body      — full SMS text
        // $timestamp — Unix milliseconds since epoch
        // $id        — "{sender}_{timestamp}", stable per message
    }
}
```

> **Livewire v3 & v4:** The `#[OnNative]` attribute is provided by NativePHP Mobile and works with both Livewire v3 and v4.

---

## JavaScript Usage

For Vue, React, Inertia, or vanilla JS apps, import directly from the package's JS file:

```js
import {
    getMessages,
    getMessagesForSenders,
    onSmsReceived,
    offSmsReceived,
} from './vendor/atendwa/nativephp-sms-reader/resources/js/smsReader.js';
```

TypeScript definitions are included at `resources/js/smsReader.d.ts`.

### Reading inbox messages

```js
// All MPESA messages from the last 30 days
const sinceMs = Date.now() - 30 * 24 * 60 * 60 * 1000;

const messages = await getMessages({ sender: 'MPESA', limit: 500, since: sinceMs });

for (const sms of messages) {
    console.log(sms.sender, sms.body, sms.timestamp);
}
```

### Reading from multiple senders

```js
const messages = await getMessagesForSenders(
    ['MPESA', 'airtelmoney'],
    sinceMs,   // null to skip date filter
    500,       // limitEach
);
// Results are merged and sorted by timestamp descending
```

### Listening for incoming SMS (real time)

```js
const handler = ({ sender, body, timestamp, id }) => {
    console.log(`New SMS from ${sender}: ${body}`);
};

// Register
onSmsReceived(handler);

// Unregister when the component unmounts
offSmsReceived(handler);
```

If you prefer to use NativePHP's own JS event bus directly, the exported constant `SMS_RECEIVED_EVENT` holds the fully-qualified event class name:

```js
import { SMS_RECEIVED_EVENT } from './vendor/atendwa/nativephp-sms-reader/resources/js/smsReader.js';

window.Native?.on(SMS_RECEIVED_EVENT, handler);
```

### Vue 3 (Composition API)

```vue
<script setup>
import { onMounted, onUnmounted, ref } from 'vue';
import { getMessages, onSmsReceived, offSmsReceived } from
    './vendor/atendwa/nativephp-sms-reader/resources/js/smsReader.js';

const messages = ref([]);
const error = ref(null);

async function loadMessages() {
    try {
        messages.value = await getMessages({ sender: 'MPESA', limit: 50 });
    } catch (e) {
        error.value = e.message;
    }
}

const handleIncoming = (sms) => {
    messages.value.unshift(sms);
};

onMounted(() => {
    loadMessages();
    onSmsReceived(handleIncoming);
});

onUnmounted(() => {
    offSmsReceived(handleIncoming);
});
</script>
```

### React

```jsx
import { useEffect, useState } from 'react';
import { getMessages, onSmsReceived, offSmsReceived } from
    './vendor/atendwa/nativephp-sms-reader/resources/js/smsReader.js';

export default function SmsList() {
    const [messages, setMessages] = useState([]);
    const [error, setError] = useState(null);

    useEffect(() => {
        getMessages({ sender: 'MPESA', limit: 50 })
            .then(setMessages)
            .catch((e) => setError(e.message));

        const handleIncoming = (sms) =>
            setMessages((prev) => [sms, ...prev]);

        onSmsReceived(handleIncoming);
        return () => offSmsReceived(handleIncoming);
    }, []);

    if (error) return <p>{error}</p>;
    return (
        <ul>
            {messages.map((sms) => (
                <li key={sms.id}>{sms.body}</li>
            ))}
        </ul>
    );
}
```

---

## Permissions

The plugin declares the required permissions automatically via `nativephp.json`. You do not need to add them manually.

| Permission    | Purpose                                              |
|---------------|------------------------------------------------------|
| `READ_SMS`    | Query the inbox `ContentProvider`                    |
| `RECEIVE_SMS` | Listen for incoming messages via `BroadcastReceiver` |

On Android 6.0+ these are **runtime permissions**. The plugin requests them automatically the first time `getMessages()` is called. If the user has not granted them yet, a `RuntimeException` is thrown with the message:

> `SmsReader bridge error [PERMISSION_REQUIRED]: READ_SMS permission has not been granted...`

Show the user a prompt and retry after they grant the permission.

---

## Error Handling

`getMessages()` throws a `RuntimeException` in these situations:

| Condition                        | Exception message                                    |
|----------------------------------|------------------------------------------------------|
| `nativephp_call` not in registry | `SmsReader.GetMessages not found in bridge registry` |
| Bridge returned invalid JSON     | `SmsReader bridge returned invalid JSON: ...`        |
| Permission not granted           | `SmsReader bridge error [PERMISSION_REQUIRED]: ...`  |
| Permission denied by system      | `SmsReader bridge error [PERMISSION_DENIED]: ...`    |
| Any other native error           | `SmsReader bridge error [ERROR_CODE]: ...`           |

```php
use RuntimeException;

try {
    $messages = SmsReader::getMessages(['sender' => 'MPESA']);
} catch (RuntimeException $e) {
    // surface the error to the user
    $this->error = $e->getMessage();
}
```

The JavaScript `getMessages()` function throws an `Error` with the same message format:

```js
try {
    const messages = await getMessages({ sender: 'MPESA' });
} catch (e) {
    // e.message — "SmsReader bridge error [PERMISSION_REQUIRED]: ..."
    console.error(e.message);
}
```

---

## Testing

The package ships with a Pest test suite that covers all three methods and the `SmsReceived` event. Because the bridge only exists inside the NativePHP Android runtime, tests use a thin subclass that overrides two protected hook methods (`isOnDevice()` and `callBridge()`) to simulate on-device behaviour without requiring a real device.

```bash
# Install dev dependencies inside the package directory
cd packages/nativephp-sms-reader
composer install

# Run all tests
composer test
```

---

## Support

Found a bug or have a question? Open an issue on [GitHub](https://github.com/atendwa/nativephp-sms-reader/issues) or reach out directly:

**Email:** [opensource@tendwa.dev](mailto:opensource@tendwa.dev)

---

---

# AdMob

> Blessed Zulu

<div class="plugin-info"><div class="pi-meta"><span class="pi-item"><span class="pi-label">Author</span><span class="pi-value">Blessed Zulu</span></span><span class="pi-item"><span class="pi-label">Plugin Type</span><span class="pi-badge pi-badge-community">Community Plugin</span></span><span class="pi-item"><span class="pi-label">Price</span><span class="pi-badge pi-badge-free">Free</span></span><span class="pi-item"><span class="pi-label">Version</span><span class="pi-value">v1.3.4</span></span><span class="pi-item"><span class="pi-label">License</span><span class="pi-value">MIT</span></span></div><div class="pi-compat"><span class="pi-chip"><span class="pi-chip-label">NativePHP</span><span class="pi-chip-value">^3.0</span></span><span class="pi-chip"><span class="pi-chip-label">PHP</span><span class="pi-chip-value">^8.3</span></span><span class="pi-chip"><span class="pi-chip-label">Laravel</span><span class="pi-chip-value">11 | 12 | 13</span></span><span class="pi-chip"><span class="pi-chip-label">iOS</span><span class="pi-chip-value">any</span></span><span class="pi-chip"><span class="pi-chip-label">Android</span><span class="pi-chip-value">any</span></span></div><div class="pi-links"><a href="https://github.com/blessedzulu/nativephp-admob" class="pi-link" target="_blank" rel="noopener">GitHub →</a></div></div>

Google AdMob plugin for [NativePHP Mobile](https://nativephp.com). Banner, interstitial, rewarded, rewarded interstitial, and app-open ads, with built-in UMP consent and iOS App Tracking Transparency.

Ad units are named slots you configure once, then call from PHP or JavaScript:

```php
Admob::rewarded('extra_lives')->show();
```

```js
const ad = Admob.rewarded('extra_lives');
await ad.load();
await ad.show();
```

## Features

- Five ad formats: banner, interstitial, rewarded, rewarded interstitial, app open
- Fluent, slot-based API: `Admob::interstitial('level_complete')->load()->show()`
- Config-driven slot names - no raw `ca-app-pub-...` IDs in app code, no env-key convention
- Platform-aware ad units - per-Android/iOS unit IDs and app ID, resolved automatically
- `<x-admob::banner>` Blade component (no Livewire dependency)
- Per-format / per-slot frequency caps
- UMP (User Messaging Platform) consent flow baked in
- iOS App Tracking Transparency (ATT) prompt baked in
- `show()` silently no-ops until consent is granted - hard to misuse
- Automatic test ad mode outside production
- Typed Laravel events for every ad lifecycle moment
- `Admob::fake()` for tests - no devices required for unit tests

## Requirements

- PHP 8.3+
- Laravel 11, 12, or 13
- NativePHP Mobile `^3.0`
- An AdMob account and at least one ad unit per format you use

## Installation

```bash
composer require blessedzulu/nativephp-admob
php artisan vendor:publish --tag=nativephp-plugins-provider    # first plugin only
php artisan native:plugin:register blessedzulu/nativephp-admob
php artisan native:run                                          # rebuild
```

## Configuration

### Required: AdMob app ID

Set your AdMob app ID in `.env` before running `native:run`. The app ID is validated **per platform** at compile time, so the build fails with a clear error if the app ID for the platform you're building is missing:

```dotenv
ADMOB_ENABLED=true
ADMOB_APP_ID=ca-app-pub-XXXXXXXXXXXXXXXX~YYYYYYYYYY
```

`ADMOB_ENABLED` is a real kill-switch: when `false`, every ad `load()` / `show()` / `hide()` no-ops across all formats (and the Blade/JS banner + JS API). Consent (UMP) and tracking (ATT) still run, so you can keep gathering consent while ads are toggled off.

The plugin's manifest takes care of writing this into the right places on each platform:

- **Android**: injected into `AndroidManifest.xml` as the `com.google.android.gms.ads.APPLICATION_ID` `<meta-data>` entry.
- **iOS**: injected into `Info.plist` as `GADApplicationIdentifier`.

You do not need to edit either of those files yourself.

For separate Android + iOS apps, set the app ID per platform - each build reads `ADMOB_APP_ID_ANDROID` / `ADMOB_APP_ID_IOS` for its target, falling back to a universal `ADMOB_APP_ID`:

```dotenv
ADMOB_APP_ID_ANDROID=ca-app-pub-XXXXXXXXXXXXXXXX~AAAAAAAAAA
ADMOB_APP_ID_IOS=ca-app-pub-XXXXXXXXXXXXXXXX~IIIIIIIIII
```

### Where ad units are configured

Ad units live under named **slots** in `config/admob.php` - never as raw IDs in your app code. A slot is just a name you pick (`home_footer`, `level_complete`, ...) mapped to the AdMob ad unit ID for that placement.

The package has **no env-key convention**. It resolves a slot solely from `config('admob.slots.{format}.{name}')`. Where each ID comes from is entirely your choice - hardcode it, or read it from an env var you name yourself.

Publish the config and add your slots:

```bash
php artisan vendor:publish --tag=admob-config
```

```php
// config/admob.php
'slots' => [
    'banner' => [
        'home_footer' => env('ADMOB_BANNER_HOME_FOOTER'), // env name is yours; not required
    ],
    'interstitial' => [
        'level_complete' => 'ca-app-pub-XXXXXXXXXXXXXXXX/YYYYYYYYYY', // or hardcode
    ],
    // rewarded / rewarded_interstitial / app_open follow the same shape
],
```

Outside `production`, `test_mode` is on and these IDs are ignored in favour of Google's reserved test IDs, so you cannot accidentally serve a real ad in development.

### Platform-specific ad units (Android & iOS)

AdMob ad units and app IDs are **per platform** - Android and iOS are separate apps in AdMob, and a unit belongs to one of them. Give any slot (or the app ID) a platform-keyed array and the plugin resolves the running platform automatically:

```php
// config/admob.php
'app_id' => [
    'android' => env('ADMOB_APP_ID_ANDROID'),
    'ios'     => env('ADMOB_APP_ID_IOS'),
],

'slots' => [
    'banner' => [
        'home_footer' => [
            'android' => env('ADMOB_BANNER_HOME_ANDROID'),
            'ios'     => env('ADMOB_BANNER_HOME_IOS'),
        ],
    ],
],
```

A plain string is still valid - treated as a **universal** value for single-platform apps (`'home_footer' => env('ADMOB_BANNER_HOME')`). Resolution is lazy: the platform is only queried (a cached native call) when a slot is actually platform-keyed, so string slots cost nothing extra.

Need the resolved unit yourself - e.g. to gate UI on "is this configured?" Both helpers are non-throwing and platform + test-mode aware:

```php
Admob::adUnit('banner', 'home_footer');   // ?string - the unit that would be used now, or null
Admob::hasSlot('rewarded', 'extra_life'); // bool
```

### Displaying each format

| Format | How to display |
|--------|----------------|
| Banner | `<x-admob::banner slot="home_footer" position="bottom" />` (screen-anchored native overlay, one per slot) - or manually `Admob::banner('home_footer')->load()->show('bottom')` / `->hide()` |
| Interstitial | `Admob::interstitial('level_complete')->load();` then `->show()` when `->isReady()`; listen for lifecycle events |
| Rewarded | `Admob::rewarded('unlock_feature')->load()->show();` grant on the `UserEarnedReward` event |
| Rewarded interstitial | `Admob::rewardedInterstitial('session_break')->load()->show();` |
| App open | `Admob::appOpen('cold_start')->load()` on boot; the native lifecycle observer auto-shows on foreground |

### SKAdNetwork list (iOS)

The plugin ships a starter list of SKAdNetwork identifiers in its iOS Info.plist contribution. Google publishes the canonical list at [developers.google.com/admob/ios/privacy/strategies](https://developers.google.com/admob/ios/privacy/strategies) and updates it from time to time. Check that page before each App Store submission and add any new entries to your consumer app's Info.plist - your additions are merged with the plugin's defaults.

## PHP Usage

### Banner ads

```php
use BlessedZulu\NativePhpAdmob\Facades\Admob;

// In a Livewire/Volt component's mount() or wherever you want a banner:
Admob::banner('home_footer')
    ->load()
    ->show('bottom');     // or ->show('top')

// Later, when navigating away or hiding:
Admob::banner('home_footer')->hide();
```

Register the `home_footer` slot in `config/admob.php` (see [Where ad units are configured](#where-ad-units-are-configured)). Or skip the manual calls entirely and use the [Blade component](#blade), which loads, shows, and tears the banner down for you.

The banner uses Google's **adaptive banner** sizing - the SDK picks the right height for the device. Width is full screen width. Banners are attached to the activity's root view (Android) or key window (iOS) as an overlay, so they don't shift your existing layout.

Test mode is automatic outside `production`. Real ad unit IDs are silently swapped for Google's reserved test IDs, so you can never accidentally show a real ad during development.

### Interstitial ads

```php
use BlessedZulu\NativePhpAdmob\Facades\Admob;
use BlessedZulu\NativePhpAdmob\Events\AdLoaded;
use BlessedZulu\NativePhpAdmob\Events\AdDismissed;
use Native\Mobile\Attributes\OnNative;

// Pre-load when the screen mounts:
public function mount(): void
{
    Admob::interstitial('between_calculations')->load();
}

// Show when the user finishes a meaningful action:
public function onCalculationFinished(): void
{
    if (Admob::interstitial('between_calculations')->isReady()) {
        Admob::interstitial('between_calculations')->show();
    }
}

// Re-load after dismissal so the next show is ready:
#[OnNative(AdDismissed::class)]
public function onDismissed(string $slot, string $format): void
{
    if ($format === 'interstitial') {
        Admob::interstitial($slot)->load();
    }
}
```

Interstitials are **one-shot**: each loaded ad survives until it is shown and dismissed, then the slot must be loaded again. The plugin clears the registry slot on `AdDismissed` and `AdFailedToShow` automatically.

Register the `between_calculations` slot in `config/admob.php` (see [Where ad units are configured](#where-ad-units-are-configured)).

Events dispatched for the interstitial lifecycle: `AdLoaded`, `AdFailedToLoad`, `AdShown`, `AdFailedToShow`, `AdImpression`, `AdClicked`, `AdDismissed`. Listen with `#[OnNative(EventClass::class)]` on any Livewire component.

### Rewarded ads

```php
use BlessedZulu\NativePhpAdmob\Facades\Admob;
use BlessedZulu\NativePhpAdmob\Events\AdDismissed;
use BlessedZulu\NativePhpAdmob\Events serEarnedReward;
use Native\Mobile\Attributes\OnNative;

// Pre-load when the screen mounts:
public function mount(): void
{
    Admob::rewarded('export_pdf')->load();
}

// Show in response to a user action ("Watch a video to unlock PDF export"):
public function onUnlockTapped(): void
{
    if (Admob::rewarded('export_pdf')->isReady()) {
        Admob::rewarded('export_pdf')->show();
    }
}

// Grant the reward when the user finishes watching:
#[OnNative(UserEarnedReward::class)]
public function onEarned(string $slot, string $format, string $type, int $amount): void
{
    if ($slot === 'export_pdf') {
        $this->unlockPdfExport();
    }
}

// Re-load after dismissal:
#[OnNative(AdDismissed::class)]
public function onDismissed(string $slot, string $format): void
{
    if ($format === 'rewarded') {
        Admob::rewarded($slot)->load();
    }
}
```

The `UserEarnedReward` event fires ONLY if the user watches to the rewardable threshold. Dismissing early fires `AdDismissed` without `UserEarnedReward`.

Register the `export_pdf` slot in `config/admob.php` (see [Where ad units are configured](#where-ad-units-are-configured)).

### Rewarded interstitial ads

Same API surface as rewarded, but the ad **auto-plays on entry** with a 5-second skip warning rather than an opt-in "Watch ad" tap. Useful between level transitions where you want to reward continuation without requiring an explicit tap.

```php
Admob::rewardedInterstitial('between_levels')->load();
// later…
if (Admob::rewardedInterstitial('between_levels')->isReady()) {
    Admob::rewardedInterstitial('between_levels')->show();
}
```

`UserEarnedReward` event payload includes `format: 'rewarded_interstitial'` so a single listener can branch.

### App Open ads

App Open ads are the format Google designed for the brief moment between app foreground and your splash/home screen. The plugin's recommended path is **auto-show**: call `load()` once on app start; the native lifecycle observer presents the cached ad on every subsequent foreground (skipping the cold-start resume), and discards anything older than 4 hours.

```php
use BlessedZulu\NativePhpAdmob\Facades\Admob;
use BlessedZulu\NativePhpAdmob\Events\AdDismissed;
use Native\Mobile\Attributes\OnNative;

// Once, on app boot or in a long-lived component:
public function mount(): void
{
    Admob::appOpen('warm_resume')->load();
}

// Re-load after dismissal so the next foreground has a fresh ad:
#[OnNative(AdDismissed::class)]
public function onDismissed(string $slot, string $format): void
{
    if ($format === 'app_open') {
        Admob::appOpen($slot)->load();
    }
}
```

**Locked behaviours:**
- **Skip first resume.** The very first `onResume` / `didBecomeActive` after launch is consumed silently so the splash owns cold start.
- **4-hour staleness.** Ads older than 4h are silently discarded on foreground. The plugin does NOT auto-load a replacement (consumer drives that via `#[OnNative(AdDismissed::class)]` or a periodic re-load).
- **One-shot per show.** Same as interstitial/rewarded: dismissal clears the registry slot; call `load()` again before the next show.

**Suppressing the auto-show.** Because app-open presents on foreground *outside* any per-request gate, a normal "don't load new ads" check can't stop an already-loaded one. To stand the auto-show down (e.g. while a user holds a temporary ad-free pass), call:

```php
Admob::setAppOpenSuppressed(true);  // false to restore
```

The flag lives in the native layer and resets on app restart, so re-sync it at boot (e.g. `Admob::setAppOpenSuppressed($user->hasAdFreePass())`).

**Manual override** when the auto-show flow doesn't fit (e.g. you want to gate on a feature-flag or an in-app purchase state):

```php
Admob::appOpen('paywall_dismissed')->load();

// Later:
if (Admob::appOpen('paywall_dismissed')->isReady()) {
    Admob::appOpen('paywall_dismissed')->show();
}
```

Register the `warm_resume` slot in `config/admob.php` (see [Where ad units are configured](#where-ad-units-are-configured)).

### Quick reference

A single snippet covering SDK boot, consent, and one call per format:

```php
use BlessedZulu\NativePhpAdmob\Facades\Admob;

// The Mobile Ads SDK boots automatically at app start (the plugin's
// init_function) - there is no start() call to make. Request UMP consent
// (EEA/UK) and, on iOS, the ATT prompt once early in your app's lifecycle:
Admob::ump()->requestConsentInfo();      // then ->showFormIfRequired()
Admob::att()->requestAuthorization();    // iOS only; no-ops elsewhere

// Banner
Admob::banner('calculator_bottom')->load()->show('bottom');
Admob::banner('calculator_bottom')->hide();

// Interstitial - pre-load, then show when ready
Admob::interstitial('between_calculations')->load();
if (Admob::interstitial('between_calculations')->isReady()) {
    Admob::interstitial('between_calculations')->show();
}

// Rewarded - dispatches UserEarnedReward event on success
Admob::rewarded('export_pdf')->load()->show();
```

### Listening for events (Livewire)

```php
use Native\Mobile\Attributes\OnNative;
use BlessedZulu\NativePhpAdmob\Events serEarnedReward;

class ExportPdf extends Component
{
    #[OnNative(UserEarnedReward::class)]
    public function onReward(string $slot, string $type, int $amount)
    {
        if ($slot === 'export_pdf') {
            $this->generatePdf();
        }
    }
}
```

### Blade

```blade
<x-admob::banner slot="home_footer" position="bottom" />
```

Drop this on any page that should show a banner. On render it loads and shows the banner for the slot; when you navigate away it tears the native overlay down for you. Because the banner is a screen-anchored native overlay (not a WebView element), teardown happens by listening for a DOM event and calling `Admob.HideBanner` through NativePHP's own JS bridge.

Since the banner pins to the very top/bottom edge, it can sit on top of chrome like a native bottom-nav. Lift it off the edge with an **offset** (dp) - per call (`<x-admob::banner slot="home_footer" offset="56" />`, `<admob-banner offset="56">`, `Admob::banner('home_footer')->show('bottom', 56)`) or globally via `config('admob.banner.offset.{top,bottom}')`.

By default the banner also **auto-insets past the OS system bars** (status bar at top, navigation/gesture bar at bottom) so it isn't clipped behind them - your `offset` stacks on top of that. iOS does this via its safe-area guide; Android reads `WindowInsets`. NativePHP's own safe-area support is CSS (`--inset-*`) for WebView *content* and doesn't cover this native overlay, hence the plugin handles it. Set `ADMOB_BANNER_SAFE_AREA=false` (or `config('admob.banner.safe_area')`) for a true edge-to-edge banner against the raw screen edge.

**No Livewire dependency.** The teardown events are configurable, defaulting to Livewire's SPA navigation:

```php
// config/admob.php
'banner' => [
    // Listens on BOTH window and document for each event, cleaned up on teardown.
    'hide_on_events' => ['livewire:navigating', 'inertia:before', 'pagehide'],
],
```

Auto-hide needs *some* navigation event from your host app: Livewire dispatches `livewire:navigating` on `window`, Inertia dispatches `inertia:*` on `document`, and `pagehide` covers full-page unloads. Override the list for a different router, or set `[]` to disable and call `Admob::banner($slot)->hide()` yourself. Notes: one native overlay per slot; sharing a slot across pages is safe; don't mount two different positions for the same slot at once (last wins). **Inertia/Vue/React apps should use the JS API + `<admob-banner>` Web Component below instead** - its connect/disconnect lifecycle drives show/hide with no event guessing.

## JavaScript API (Inertia / Vue / React / vanilla)

The plugin ships a JS module so you can drive ads from JavaScript without Livewire or Blade. Publish it into your app and import it:

```bash
php artisan vendor:publish --tag=admob-js   # -> resources/js/vendor/admob/admob.js (+ .d.ts)
```

```js
import { Admob, Events } from './vendor/admob/admob.js';
import { On } from '@nativephp/mobile'; // your NativePHP runtime import

On(Events.UserEarnedReward, ({ slot, amount }) => grant(slot, amount));

await Admob.interstitial('level_complete').load();
if (await Admob.interstitial('level_complete').isReady()) {
    await Admob.interstitial('level_complete').show();
}

// Consent / tracking
await Admob.ump.requestInfo();
if (!(await Admob.ump.canRequestAds())) await Admob.ump.showForm();
await Admob.att.request(); // iOS only
```

**Banner - `<admob-banner>` Web Component** (framework-agnostic mirror of `<x-admob::banner>`):

```html
<admob-banner slot="home_footer" position="bottom"></admob-banner>
```

Works in Vue (hyphenated tags resolve as custom elements; mark it via `app.config.compilerOptions.isCustomElement = t => t === 'admob-banner'`), React 19+ (native custom-element support), and vanilla. The element's own lifecycle is the teardown signal: connect → load + show, disconnect → hide - no navigation-event wiring. For manual control use `Admob.banner('home_footer').show('bottom')` / `.hide()` (e.g. in `onMounted` / `onBeforeUnmount`).

**How it works.** Every JS call POSTs to a thin same-origin endpoint (`/_admob/call`) that runs the PHP `Admob` facade, so slot resolution, the consent gate, frequency caps, and the `ADMOB_ENABLED` kill-switch all apply server-side - the JS layer duplicates none of it. Ad events still arrive in JS via the runtime's `On()`. The endpoint is CSRF-exempt and session-less, exactly like NativePHP's own `/_native/api/call` - it only exists inside the localhost native WebView. Toggle it off with `ADMOB_JS_API=false`; change its prefix with `config('admob.js_api_prefix')`.

> `npm`-packaged distribution is a planned follow-up; for now publish the file as above (or import it via a `#admob` alias you define).

## Built-in test page

The plugin ships a generic, self-contained test/debug page so you can exercise every format + the consent flow and watch a live event log - no scaffolding needed. It's a plain HTML page (own inline styles, no Livewire/Inertia/CSRF dependency) that drives the JS API.

It's served at **`/_admob/test`** whenever `config('admob.test_page')` is true - which defaults **on outside production** (like `test_mode`) and off in production. Override with `ADMOB_TEST_PAGE` / `ADMOB_TEST_ROUTE`. Boot straight into it during development:

```dotenv
NATIVEPHP_START_URL=/_admob/test
```

Buttons cover banner show/hide/flip, load/ready/show for the full-screen formats, UMP request/form/status/reset, and the iOS ATT prompt; the event log streams native events (`AdLoaded`, `ConsentChanged`, …). Intended for `test_mode`, where any slot name resolves to Google's demo ad units.

## Events

| Event | Payload |
|-------|---------|
| `AdLoaded` | `slot`, `format` |
| `AdFailedToLoad` | `slot`, `format`, `errorCode`, `errorMessage` |
| `AdShown` | `slot`, `format` |
| `AdDismissed` | `slot`, `format` |
| `AdFailedToShow` | `slot`, `format`, `errorCode`, `errorMessage` |
| `AdImpression` | `slot`, `format` |
| `AdClicked` | `slot`, `format` |
| `UserEarnedReward` | `slot`, `format`, `type`, `amount` |
| `AdShowThrottled` | `slot`, `format`, `reason` |
| `ConsentFormShown` | - |
| `ConsentFormDismissed` | `status` |
| `ConsentChanged` | `status` |
| `TrackingAuthorizationGranted` | - |
| `TrackingAuthorizationDenied` | - |

## Permissions

Declared automatically via the plugin's manifest:

- Android: `android.permission.INTERNET`, `android.permission.ACCESS_NETWORK_STATE`, plus AdMob SDK runtime requirements
- iOS: `NSUserTrackingUsageDescription` (only when ATT is enabled) plus AdMob SDK runtime requirements

You do not need to add any of these to your own app's manifest.

## UMP and ATT Compliance

UMP (consent) and ATT (iOS tracking) are enabled by default. If your audience is entirely outside the EEA + UK and you only ever serve non-personalised ads, you can opt out:

```dotenv
ADMOB_UMP_ENABLED=false
ADMOB_ATT_ENABLED=false
```

### Testing the consent form

The UMP consent form only appears for users in the EEA + UK. To exercise it during development on a device anywhere, either:

- **Use a VPN** to a EEA region (e.g. Germany) and relaunch - this drives the real form, no extra config; or
- **Force a debug geography** by registering your device as a test device in the AdMob console (Settings -> Test devices, by raw advertising ID) and setting:

  ```dotenv
  ADMOB_UMP_DEBUG_GEOGRAPHY=EEA
  ```

Set `ADMOB_UMP_DEBUG_GEOGRAPHY=DISABLED` (the default) for production.

> Test devices are managed entirely in the AdMob console - the plugin bakes in no device IDs (a baked-in ID goes stale the moment a device resets its advertising ID). The same console registration makes both real ads serve as test ads **and** the UMP debug geography take effect.

You are responsible for following Google's [AdMob policies](https://support.google.com/admob/answer/6128543) and Apple's [App Tracking Transparency requirements](https://developer.apple.com/app-store/user-privacy-and-data-use/).

## Frequency caps

Throttle how often the full-screen formats (interstitial, rewarded, rewarded interstitial, app open) show, per format or per slot. Banners are exempt. Both constraints are opt-in - omit or set `0` to disable. Caps are persisted in the cache, so they survive app relaunches, and reset at local midnight. `test_mode` bypasses caps so you can spam-test.

```php
// config/admob.php
'frequency' => [
    'interstitial' => ['min_interval_seconds' => 60, 'max_per_day' => 10],
    'slots' => [
        'interstitial' => ['level_complete' => ['min_interval_seconds' => 30]], // per-slot overrides per-format
    ],
],
```

When a `show()` is suppressed, it no-ops and dispatches `AdShowThrottled` (`slot`, `format`, `reason` = `cooldown` | `daily_cap`) so you can react or log it.

## Debugging

Set `ADMOB_DEBUG=true` to trace every native bridge call (method, params, and response) at `debug` log level. When a bridge call fails (`success: false`), the plugin logs a warning rather than throwing - a failed ad never crashes your app.

## Testing

```bash
composer install
composer test       # Pest
composer lint       # Pint
```

Outside production, the plugin automatically swaps registered ad unit IDs for Google's reserved test IDs - you cannot accidentally show a real ad in `local` or `staging`.

For unit tests in your own app, swap the live bridge for a fake:

```php
use BlessedZulu\NativePhpAdmob\Facades\Admob;

Admob::fake();

// Then assert against recorded calls in your test.
```

---

# Firebase Phone Number Verification

> Tarik Manoar

<div class="plugin-info"><div class="pi-meta"><span class="pi-item"><span class="pi-label">Author</span><span class="pi-value">Tarik Manoar</span></span><span class="pi-item"><span class="pi-label">Plugin Type</span><span class="pi-badge pi-badge-community">Community Plugin</span></span><span class="pi-item"><span class="pi-label">Price</span><span class="pi-badge pi-badge-free">Free</span></span><span class="pi-item"><span class="pi-label">Version</span><span class="pi-value">v1.0.3</span></span><span class="pi-item"><span class="pi-label">License</span><span class="pi-value">MIT</span></span></div><div class="pi-compat"><span class="pi-chip"><span class="pi-chip-label">NativePHP</span><span class="pi-chip-value">^2.6 || ^3.0</span></span><span class="pi-chip"><span class="pi-chip-label">PHP</span><span class="pi-chip-value">^8.3</span></span><span class="pi-chip"><span class="pi-chip-label">Laravel</span><span class="pi-chip-value">10 | 11 | 12 | 13</span></span><span class="pi-chip"><span class="pi-chip-label">Android</span><span class="pi-chip-value">any</span></span></div><div class="pi-links"><a href="https://github.com/tarikmanoar/firebase-pnv" class="pi-link" target="_blank" rel="noopener">GitHub →</a></div></div>

A [NativePHP Mobile](https://nativephp.com/docs/mobile) plugin that wraps the
official **Firebase Phone Number Verification (PNV)** Android SDK
(`com.google.firebase:firebase-pnv`). It lets a Laravel/NativePHP app verify the
device's phone number with a **single tap** — the number is read from the SIM via
the carrier network through the Android **Credential Manager**, with **no SMS
code** to receive or type.

```php
use Manoar\FirebasePnv\Facades\FirebasePNV;

// Start verification — the result arrives via the Verified event.
FirebasePNV::verify();
```

> **Platform support:** Firebase PNV is an **Android-only** product. On iOS the
> bridge functions return an `UNSUPPORTED_PLATFORM` error so your code degrades
> gracefully.

---

## How it works

```
PHP                         Native (Android, Kotlin)                 Firebase / Android
──────────────────────      ───────────────────────────────────     ──────────────────────
FirebasePNV::verify()
  └─ nativephp_call(         FirebasePnvFunctions
       'FirebasePnv            .GetVerifiedPhoneNumber.execute()
        .GetVerifiedPhoneNumber') ─► FirebasePhoneNumberVerification
                                       .getInstance()
                                       .getVerifiedPhoneNumber(activity) ─► Credential Manager
                                                                            (user consent, 1 tap)
                                                                       ─► Firebase PNV backend
                                     Task.addOnSuccessListener { result }
                                       └─ NativeActionCoordinator
                                            .dispatchEvent(
                                              activity,
                                              'Manoar\FirebasePnv\Events\Verified',
                                              { phoneNumber, token, id })
   POST /_native/api/events ◄──────────  (runs JS in the WebView)
   event(new Verified(...)) 
   └─ your listener fires
```

The asynchronous result (objective: *handle the Credential Manager callback back
to the PHP layer*) is delivered by firing a **Laravel event**. The Kotlin payload
keys map 1:1 to the event class's constructor arguments
(`new Verified(...$payload)`).

---

## Requirements

- A working **NativePHP Mobile** app (`nativephp/mobile`) targeting **Android**.
- PHP **8.3+**, Laravel 10/11/12.
- A **Firebase project** with Phone Number Verification enabled, and the standard
  [Firebase Android setup](https://firebase.google.com/docs/android/setup):
  `google-services.json` in the app module and the **google-services Gradle
  plugin** applied (see [Android setup](#android-setup-google-services)).

---

## Installation

```bash
# 1. Require the plugin (use a path repo during local development)
composer require tarikmanoar/firebase-pnv

# 2. Register it with NativePHP (adds the provider to NativeServiceProvider)
php artisan native:plugin:register tarikmanoar/firebase-pnv

# 3. (optional) publish the config
php artisan vendor:publish --tag=firebase-pnv-config

# 4. Rebuild the native app so the Kotlin + Gradle deps are injected
php artisan native:run
```

> **Local development:** add a path repository to your app's `composer.json`
> before requiring it:
> ```json
> "repositories": [
>     { "type": "path", "url": "../Packages/PNV-Plugin" }
> ]
> ```

### Android setup (google-services)

NativePHP injects the `firebase-pnv` dependency automatically (declared in
[`nativephp.json`](nativephp.json)). The one thing it **cannot** do for you is wire
up Firebase config, so add Firebase to your Android project the normal way:

1. Create/register your Android app in the Firebase console and download
   `google-services.json`.
2. Apply the **google-services Gradle plugin** and drop `google-services.json`
   into the Android app module. See
   [`resources/android/gradle/firebase-pnv.gradle.kts`](resources/android/gradle/firebase-pnv.gradle.kts)
   for the exact snippet.

---

## Usage

### Verify a phone number

```php
use Manoar\FirebasePnv\Facades\FirebasePNV;

// Simplest form — auto-starts on the line below.
FirebasePNV::verify();

// Fluent form with a correlation id and explicit dispatch:
FirebasePNV::verify()
    ->id('checkout-42')          // correlate the result event
    ->dispatch();
```

### Check device/SIM support first

```php
FirebasePNV::supportInfo()->check();
// → fires Manoar\FirebasePnv\Events\SupportInfoRetrieved { supported, sims, id }
```

### Listen for the result

The result is **always** delivered via an event — never as the return value of
`verify()` (the native flow is asynchronous and shows UI).

**A. Plain Laravel listener** (works everywhere):

```php
use Illuminate\Support\Facades\Event;
use Manoar\FirebasePnv\Events\Verified;
use Manoar\FirebasePnv\Events\VerificationFailed;

Event::listen(Verified::class, function (Verified $e) {
    // $e->phoneNumber, $e->token, $e->id
});

Event::listen(VerificationFailed::class, function (VerificationFailed $e) {
    // $e->code, $e->message, $e->id
});
```

See [`stubs/VerifiedListener.php`](stubs/VerifiedListener.php) for a class-based example.

**B. Livewire component** with the `#[OnNative]` attribute (live UI updates) —
see [`stubs/VerifyPhoneNumber.php`](stubs/VerifyPhoneNumber.php):

```php
use Native\Mobile\Attributes\OnNative;
use Manoar\FirebasePnv\Events\Verified;

#[OnNative(Verified::class)]
public function onVerified(string $phoneNumber, string $token, ?string $id = null) { /* ... */ }
```

**C. JavaScript** (optional) — see [`resources/js/firebase-pnv.js`](resources/js/firebase-pnv.js):

```js
import FirebasePNV from './vendor/firebase-pnv';

FirebasePNV.onVerified(({ phoneNumber, token }) => { /* ... */ });
FirebasePNV.verify({ id: 'checkout-42' });
```

---

## ⚠️ Security: trust the token, not the number

`getVerifiedPhoneNumber()` returns both a `phoneNumber` (for display) and a
**signed `token`**. Treat the raw phone number as untrusted UX data. Always send
the `token` to your server and verify it (against Firebase) **before** you
associate the number with a user or grant any access.

---

## Test mode (no SIM, no billing)

Firebase PNV supports a SIM-less **test session** using a token generated in the
Firebase console — ideal for emulators and CI.

```dotenv
FIREBASE_PNV_TEST_TOKEN="paste-test-token-from-firebase-console"
```

When set, `verify()` and `supportInfo()` run in test mode automatically (via
`enableTestSession(...)`), and `getVerifiedPhoneNumber()` returns a fixed test
number. Override per call with `->test('token')`, or force production with the
env left empty.

> Test mode requires the device to be enrolled in the Google system services
> public beta program (see the Firebase docs).

---

## API reference

### `FirebasePNV` facade

| Method | Returns | Description |
|---|---|---|
| `verify()` | `PendingVerification` | Start the full verification flow. |
| `supportInfo()` | `PendingSupportInfo` | Check device/SIM capability. |

### `PendingVerification` / `PendingSupportInfo` (fluent)

| Method | Description |
|---|---|
| `->id(string)` | Correlation id echoed back in the result event. |
| `->test(?string)` | Run in test-session mode (defaults to the config token). |
| `->event(class)` | Override the success event class. |
| `->failureEvent(class)` | Override the failure event class. |
| `->remember()` | Flash the id into the session (`PendingVerification::lastId()`). |
| `->dispatch()` / `->check()` | Start the flow explicitly (otherwise auto on destruct). |

### Events

| Event | Payload |
|---|---|
| `Events\Verified` | `string $phoneNumber, string $token, ?string $id` |
| `Events\SupportInfoRetrieved` | `bool $supported, array $sims, ?string $id` |
| `Events\VerificationFailed` | `string $code, string $message, ?string $id` |

Failure `code` values: `SUPPORT_INFO_FAILED`, `NOT_SUPPORTED`,
`VERIFICATION_FAILED`, `UNSUPPORTED_PLATFORM`.

### Native bridge functions

| Bridge name | Android class | Firebase SDK call |
|---|---|---|
| `FirebasePnv.GetVerificationSupportInfo` | `…FirebasePnvFunctions.GetVerificationSupportInfo` | `getVerificationSupportInfo()` |
| `FirebasePnv.GetVerifiedPhoneNumber` | `…FirebasePnvFunctions.GetVerifiedPhoneNumber` | `getVerifiedPhoneNumber(activity)` |

---

## Project layout

```
.
├── composer.json                       # type: nativephp-plugin
├── nativephp.json                      # bridge functions, events, android deps
├── config/firebase-pnv.php             # test_token
├── src/
│   ├── FirebasePnvServiceProvider.php
│   ├── PhoneNumberVerification.php     # verify() / supportInfo()
│   ├── PendingVerification.php
│   ├── PendingSupportInfo.php
│   ├── Concerns/CallsNativeBridge.php  # nativephp_call() wrapper
│   ├── Facades/FirebasePNV.php
│   └── Events/{Verified,SupportInfoRetrieved,VerificationFailed}.php
├── resources/
│   ├── android/src/com/tarikmanoar/plugins/firebasepnv/FirebasePnvFunctions.kt
│   ├── android/gradle/firebase-pnv.gradle.kts
│   ├── ios/Sources/FirebasePnv/FirebasePnvFunctions.swift   # unsupported stub
│   └── js/firebase-pnv.js
└── stubs/                              # copy-paste examples for your app
```

---

## Manual integration (NativePHP Mobile v2.x)

The v3 plugin loader consumes `nativephp.json` automatically. If you are on a
v2.x runtime (no plugin auto-loader), wire the native side in manually:

1. Publish the native sources: `php artisan vendor:publish --tag=firebase-pnv-native`.
2. Copy
   [`FirebasePnvFunctions.kt`](resources/android/src/com/tarikmanoar/plugins/firebasepnv/FirebasePnvFunctions.kt)
   into your Android project under its package directory.
3. Register the two functions in `BridgeFunctionRegistration.kt`:
   ```kotlin
   registry.register("FirebasePnv.GetVerificationSupportInfo",
       FirebasePnvFunctions.GetVerificationSupportInfo(activity))
   registry.register("FirebasePnv.GetVerifiedPhoneNumber",
       FirebasePnvFunctions.GetVerifiedPhoneNumber(activity))
   ```
4. Add the Gradle dependency and google-services plugin (see the Gradle reference).

---

## Support

- 🐛 **Bugs & feature requests:** [GitHub Issues](https://github.com/tarikmanoar/firebase-pnv/issues)
- 💬 **Questions:** start a [discussion](https://github.com/tarikmanoar/firebase-pnv/discussions) or email **tarikmanoar@gmail.com**

---

---

# Push Notifications

> Fatlum Gjinofci

<div class="plugin-info"><div class="pi-meta"><span class="pi-item"><span class="pi-label">Author</span><span class="pi-value">Fatlum Gjinofci</span></span><span class="pi-item"><span class="pi-label">Plugin Type</span><span class="pi-badge pi-badge-community">Community Plugin</span></span><span class="pi-item"><span class="pi-label">Price</span><span class="pi-badge pi-badge-free">Free</span></span><span class="pi-item"><span class="pi-label">Version</span><span class="pi-value">v0.1.3</span></span><span class="pi-item"><span class="pi-label">License</span><span class="pi-value">MIT</span></span></div><div class="pi-compat"><span class="pi-chip"><span class="pi-chip-label">NativePHP</span><span class="pi-chip-value">^3.2</span></span><span class="pi-chip"><span class="pi-chip-label">iOS</span><span class="pi-chip-value">18.0+</span></span><span class="pi-chip"><span class="pi-chip-label">Android</span><span class="pi-chip-value">29+</span></span></div><div class="pi-links"><a href="https://github.com/FatlumGjinofci/nativephp-push" class="pi-link" target="_blank" rel="noopener">GitHub →</a></div></div>

# fatlum/nativephp-push

A **free**, MIT-licensed plugin.

It implements only the part that actually costs money — the **native Swift/Kotlin layer** — and
wires it into the push API that already ships in NativePHP Mobile's open-source core. Firebase
Cloud Messaging and APNs are free; this is the glue.

## How it fits together

The PHP API, the `TokenGenerated` event, and the on-device event-dispatch route all live in core
(`nativephp/mobile`, MIT) already. This plugin supplies the native implementations core calls:

| Layer | Where it lives |
| --- | --- |
| `PushNotifications::enroll() / checkPermission() / getToken()` | **core** (`Native\Mobile\Facades\PushNotifications`) |
| `TokenGenerated` event, `POST /_native/api/events` route | **core** |
| Ephemeral PHP runtime for background execution | **core** (v3.2+) |
| Native bridge functions `PushNotification.*`, Firebase SDK, FCM service | **this plugin** |
| Server-side FCM v1 sender | **this plugin** |

> **Do not install this alongside `nativephp/mobile-firebase`.** Both register the same
> `PushNotification.*` bridge functions — pick one.

## What's implemented

- Permission flow + token delivery (`TokenGenerated` fires with `token` + enrollment `id`)
- **Background data-message processing** — when the app is backgrounded or killed, the FCM service
  boots core's ephemeral PHP runtime and dispatches your event via the `native:push:dispatch`
  artisan command. Foreground messages go through the live web view so mounted Livewire components
  react.
- Deep-link / data handling, badge clearing
- Free server-side sending via the FCM v1 API

---

## Install

```json
// app composer.json
{ "repositories": [ { "type": "path", "url": "../packages/nativephp-push" } ] }
```

```bash
composer require fatlum/nativephp-push
php artisan native:plugin:register fatlum/nativephp-push
php artisan vendor:publish --tag=native-push-config   # optional
```

Requires `nativephp/mobile` **^3.2** (for the ephemeral runtime).

## Firebase setup

1. Create a Firebase project (free).
2. **iOS:** add an iOS app, download `GoogleService-Info.plist`, place it at
   `resources/GoogleService-Info.plist` in this plugin. Upload your APNs key under
   Firebase Console → Cloud Messaging.
3. **Android:** add an Android app, download `google-services.json`, place it at
   `resources/google-services.json` in this plugin.
4. **Server:** Project Settings → Service Accounts → *Generate new private key*.

```dotenv
APS_ENVIRONMENT=production          # 'development' for local device builds
FCM_PROJECT_ID=your-project-id      # server sending
FIREBASE_CREDENTIALS=/abs/path/service-account.json
```

---

## Usage (PHP / Livewire) — core's API

```php
use Native\Mobile\Facades\PushNotifications;
use Native\Mobile\Events\PushNotification\TokenGenerated;

// Enroll (prompts if needed). Token arrives via TokenGenerated.
PushNotifications::enroll();

$status = PushNotifications::checkPermission(); // granted|denied|not_determined|provisional|ephemeral

#[\Native\Mobile\Attributes\OnNative(TokenGenerated::class)]
public function handleToken(string $token)
{
    auth()->user()->update(['push_token' => $token]);
}
```

### Background processing

Send a data message naming any event class. It runs even when the app is backgrounded/killed:

```php
// A normal Laravel listener (service provider boot) — runs in the ephemeral runtime.
Event::listen(function (\Lumi\NativePush\Events\PushNotificationReceived $event) {
    // $event->data — persist, queue work, update local SQLite, etc.
});
```

> **Event constructor convention:** the native handler passes the FCM `data` map (minus the
> `event` key) as a single `array $data` argument. Design your push event classes as
> `__construct(array $data)` (the bundled `PushNotificationReceived` already does).

## Sending from your server (free)

```bash
composer require google/auth   # sending machine only
```

```php
use Lumi\NativePush\Server\{FcmSender, FcmMessage};

$sender = new FcmSender();

// Tray notification (no PHP on device):
$sender->notify($token, 'Order shipped', 'On its way!', ['url' => '/orders/123']);

// Background event:
$sender->send(
    FcmMessage::make()->to($token)
        ->event(\Lumi\NativePush\Events\PushNotificationReceived::class, ['sync_id' => 42])
);
```

---

---

# Device Timezone Plugin

> fabianpnke

<div class="plugin-info"><div class="pi-meta"><span class="pi-item"><span class="pi-label">Author</span><span class="pi-value">fabianpnke</span></span><span class="pi-item"><span class="pi-label">Plugin Type</span><span class="pi-badge pi-badge-community">Community Plugin</span></span><span class="pi-item"><span class="pi-label">Price</span><span class="pi-badge pi-badge-free">Free</span></span><span class="pi-item"><span class="pi-label">Version</span><span class="pi-value">v2.0.0</span></span><span class="pi-item"><span class="pi-label">License</span><span class="pi-value">MIT</span></span></div><div class="pi-compat"><span class="pi-chip"><span class="pi-chip-label">NativePHP</span><span class="pi-chip-value">^3.2.1 || ^4.0</span></span><span class="pi-chip"><span class="pi-chip-label">PHP</span><span class="pi-chip-value">^8.2</span></span><span class="pi-chip"><span class="pi-chip-label">Android</span><span class="pi-chip-value">26+</span></span><span class="pi-chip"><span class="pi-chip-label">iOS</span><span class="pi-chip-value">16.0+</span></span></div><div class="pi-links"><a href="https://github.com/fabianpnke/mobile-device-timezone" class="pi-link" target="_blank" rel="noopener">GitHub →</a></div></div>

Reads the device's current IANA timezone identifier (e.g. `Europe/Vienna`) from a NativePHP Mobile app — the one piece of device info NativePHP core doesn't expose yet.

## Installation

```bash
composer require fabianpnke/mobile-device-timezone
php artisan vendor:publish --tag=nativephp-plugins-provider
php artisan native:plugin:register fabianpnke/mobile-device-timezone
php artisan native:plugin:list
```

This adds `\Fabianpnke\MobileDeviceTimezone\DeviceTimezoneServiceProvider::class` to your `plugins()` array. Rebuild the app (`native:run`) afterwards.

## Usage

```php
use Fabianpnke\MobileDeviceTimezone\Facades\DeviceTimezone;

$identifier = DeviceTimezone::get(); // e.g. "Europe/Vienna"

if ($identifier !== null) {
    $localNow = now($identifier);
}
```

`get()` returns `null` when the native bridge isn't available — off-device (tests, `php artisan tinker`, plain `php artisan serve`), or on the rare platform edge case where the OS can't resolve one.

### JavaScript (Vue/React/Inertia)

```javascript
import { DeviceTimezone } from '@fabianpnke/mobile-device-timezone';

const identifier = await DeviceTimezone.get(); // e.g. "Europe/Vienna", or null
```

## Platform Notes

| Platform | Source |
|---|---|
| iOS | `TimeZone.current.identifier` |
| Android | `TimeZone.getDefault().id` |

No permissions required on either platform.

## Compatibility

Requires `nativephp/mobile` `^3.2.1` or `^4.0`.

---

# Firebase Crashlytics

> CodingwithRK

<div class="plugin-info"><div class="pi-meta"><span class="pi-item"><span class="pi-label">Author</span><span class="pi-value">CodingwithRK</span></span><span class="pi-item"><span class="pi-label">Plugin Type</span><span class="pi-badge pi-badge-community">Community Plugin</span></span><span class="pi-item"><span class="pi-label">Price</span><span class="pi-badge pi-badge-free">Free</span></span><span class="pi-item"><span class="pi-label">Version</span><span class="pi-value">v1.0.0</span></span><span class="pi-item"><span class="pi-label">License</span><span class="pi-value">MIT</span></span></div><div class="pi-compat"><span class="pi-chip"><span class="pi-chip-label">NativePHP</span><span class="pi-chip-value">^3.0 || ^4.0</span></span><span class="pi-chip"><span class="pi-chip-label">iOS</span><span class="pi-chip-value">any</span></span><span class="pi-chip"><span class="pi-chip-label">Android</span><span class="pi-chip-value">any</span></span></div><div class="pi-links"><a href="https://github.com/codingwithrk/firebase-crashlytics" class="pi-link" target="_blank" rel="noopener">GitHub →</a></div></div>

# Firebase Crashlytics Plugin for NativePHP Mobile

Wraps Firebase Crashlytics for Android and iOS — crash reporting and error tracking directly from your NativePHP app.

## Features

- Record fatal and non-fatal exceptions
- Log breadcrumb messages for debugging context
- Attach user identifiers and custom metadata
- Report everything to the Firebase console
- Consent-based data collection support

## Prerequisites

A Firebase project with Crashlytics enabled. Place `google-services.json` (Android) and `GoogleService-Info.plist` (iOS) in your project before registering the plugin.

## Installation

```bash
composer require codingwithrk/firebase-crashlytics
php artisan vendor:publish --tag=nativephp-plugins-provider
php artisan native:plugin:register codingwithrk/firebase-crashlytics
```

## Usage

```php
use Codingwithrk\FirebaseCrashlytics\Facades\FirebaseCrashlytics;

// Record a caught exception (non-fatal)
try {
    $riskyOperation();
} catch (Throwable $e) {
    FirebaseCrashlytics::recordError($e);
}

// Log a breadcrumb message
FirebaseCrashlytics::log('User reached checkout');

// Attach a user ID to all subsequent reports
FirebaseCrashlytics::setUserId((string) $user->id);

// Attach custom key–value metadata
FirebaseCrashlytics::setCustomKey('subscription_tier', 'pro');
```

## JavaScript API

```javascript
import { FirebaseCrashlytics } from '@codingwithrk/firebase-crashlytics';

await FirebaseCrashlytics.recordError(error);
await FirebaseCrashlytics.log('User reached checkout');
await FirebaseCrashlytics.setUserId('user-123');
```

---

# Image Cropper

> Vipul Walia

<div class="plugin-info"><div class="pi-meta"><span class="pi-item"><span class="pi-label">Author</span><span class="pi-value">Vipul Walia</span></span><span class="pi-item"><span class="pi-label">Plugin Type</span><span class="pi-badge pi-badge-community">Community Plugin</span></span><span class="pi-item"><span class="pi-label">Price</span><span class="pi-badge pi-badge-free">Free</span></span><span class="pi-item"><span class="pi-label">Version</span><span class="pi-value">v1.3.0</span></span><span class="pi-item"><span class="pi-label">License</span><span class="pi-value">MIT</span></span></div><div class="pi-compat"><span class="pi-chip"><span class="pi-chip-label">NativePHP</span><span class="pi-chip-value">^3.0 || ^4.0</span></span><span class="pi-chip"><span class="pi-chip-label">iOS</span><span class="pi-chip-value">15.0+</span></span><span class="pi-chip"><span class="pi-chip-label">Android</span><span class="pi-chip-value">26+</span></span></div><div class="pi-links"><a href="https://github.com/vipertecpro/image-cropper" class="pi-link" target="_blank" rel="noopener">GitHub →</a></div></div>

# Image Cropper

A fully native image cropping and editing tool for NativePHP Mobile. Built with SwiftUI (iOS) and Jetpack Compose (Android) using zero third-party native libraries.

## Features

- **Freehand cropping** with 2D drag, pinch-zoom, and two-finger rotation
- **Shape & preset options** — circle, rectangle, Profile, Square, Portrait, 16:9, Cover, Banner, Story (switchable in-app)
- **Adjustment tools** — brightness, contrast, saturation, and built-in filters
- **Configurable modes** — crop-only, adjust-only, or filter-only workflows
- **Theme-aware** — adapts to system light/dark mode automatically
- **Zero native dependencies** — no third-party libraries or special permissions required
- **Cross-platform** unified PHP API for iOS and Android

## Installation

```bash
composer require vipertecpro/image-cropper
php artisan vendor:publish --tag=nativephp-plugins-provider
php artisan native:plugin:register vipertecpro/image-cropper
```

## Usage

```php
use Vipertecpro\ImageCropper\Facades\ImageCropper;

// Open an image for cropping
ImageCropper::open('/path/to/image.jpg');

// With options
ImageCropper::open('https://example.com/photo.png', [
    'preset'  => 'square',
    'shape'   => 'circle',
    'tools'   => ['crop', 'adjust'],
    'theme'   => 'system',
]);
```

**Accepted formats:** JPG, JPEG, PNG, GIF, WebP, BMP, HEIC, HEIF, AVIF

**Input:** Local file paths or HTTP(S) URLs

## Events

```php
use Vipertecpro\ImageCropper\Events\ImageCropped;
use Vipertecpro\ImageCropper\Events\CropCancelled;

// Fired with the saved file path (and optional ID)
ImageCropped::class;

// Fired when the user dismisses the cropper
CropCancelled::class;
```

---

# WiFi Radar

> Neo Nos

<div class="plugin-info"><div class="pi-meta"><span class="pi-item"><span class="pi-label">Author</span><span class="pi-value">Neo Nos</span></span><span class="pi-item"><span class="pi-label">Plugin Type</span><span class="pi-badge pi-badge-community">Community Plugin</span></span><span class="pi-item"><span class="pi-label">Price</span><span class="pi-badge pi-badge-free">Free</span></span><span class="pi-item"><span class="pi-label">Version</span><span class="pi-value">v0.2.3</span></span><span class="pi-item"><span class="pi-label">License</span><span class="pi-value">MIT</span></span></div><div class="pi-compat"><span class="pi-chip"><span class="pi-chip-label">NativePHP</span><span class="pi-chip-value">^3.0 || ^4.0</span></span><span class="pi-chip"><span class="pi-chip-label">iOS</span><span class="pi-chip-value">13.0+ (no public API)</span></span><span class="pi-chip"><span class="pi-chip-label">Android</span><span class="pi-chip-value">23+</span></span></div><div class="pi-links"><a href="https://github.com/all1web/nativephp-wifi-scan" class="pi-link" target="_blank" rel="noopener">GitHub →</a></div></div>

# WiFi Radar

Scans visible WiFi access points from PHP code, reads the currently connected network, and generates device-location fingerprints using BSSID signatures — no Kotlin required.

> **Note:** iOS has no public API for WiFi scanning; this plugin is Android-only for active scanning. iOS returns the connected network info only.

## Features

- **Full AP enumeration** — every access point in range with SSID, BSSID, RSSI, and frequency
- **Connected network detection** — identify the current access point by BSSID
- **Place fingerprinting** — order-independent location detection via BSSID signatures
- **Event-driven** — scan completion fires a native event to PHP/JS
- **Auto permission handling** — Android 6.0+ location permission managed automatically
- **JavaScript module** — works with Inertia, Vue, React, and vanilla JS
- **Diagnostic command** — `php artisan wifi-scan:doctor` for troubleshooting

## Installation

```bash
composer require all1web/nativephp-wifi-scan
php artisan native:plugin:register all1web/nativephp-wifi-scan
php artisan native:install android --force
```

## Diagnostics

```bash
php artisan wifi-scan:doctor
```

---

# Lottie EDGE Component

> Cody P Christian

<div class="plugin-info"><div class="pi-meta"><span class="pi-item"><span class="pi-label">Author</span><span class="pi-value">Cody P Christian</span></span><span class="pi-item"><span class="pi-label">Plugin Type</span><span class="pi-badge pi-badge-community">Community Plugin</span></span><span class="pi-item"><span class="pi-label">Price</span><span class="pi-badge pi-badge-free">Free</span></span><span class="pi-item"><span class="pi-label">Version</span><span class="pi-value">v0.2.5</span></span><span class="pi-item"><span class="pi-label">License</span><span class="pi-value">MIT</span></span></div><div class="pi-compat"><span class="pi-chip"><span class="pi-chip-label">NativePHP</span><span class="pi-chip-value">^4.0</span></span><span class="pi-chip"><span class="pi-chip-label">iOS</span><span class="pi-chip-value">18.0+</span></span><span class="pi-chip"><span class="pi-chip-label">Android</span><span class="pi-chip-value">26+</span></span></div><div class="pi-links"><a href="https://github.com/CodyPChristian/nativephp-lottie" class="pi-link" target="_blank" rel="noopener">GitHub →</a></div></div>

# Lottie EDGE Component

Adds a `<native:lottie-view>` Blade tag that plays dotLottie animations natively — Jetpack Compose on Android and SwiftUI with lottie-spm on iOS. No code generation required.

## Features

- **dotLottie playback** — play animations from bundled assets or remote URLs
- **Native rendering** — Jetpack Compose (Android) and SwiftUI (iOS) with no wrappers
- **Configurable looping, sizing, and accessibility labels**
- **Offline-safe** — bundled asset playback works without a network connection
- **Auto-converts** dotLottie v2 to v1 for iOS compatibility
- **Static-renderer plugin** — native dependencies declared cleanly in the manifest

## Installation

```bash
composer require codypchristian/nativephp-lottie
php artisan native:plugin:register codypchristian/nativephp-lottie
```

## Usage

```blade
<native:lottie-view
    src="animations/confetti.lottie"
    :loop="true"
    accessibility-label="Confetti celebration"
/>
```

Supports both local asset paths and HTTPS URLs as the `src` value.

---

# Play Games Services

> Bhargav Detroja

<div class="plugin-info"><div class="pi-meta"><span class="pi-item"><span class="pi-label">Author</span><span class="pi-value">Bhargav Detroja</span></span><span class="pi-item"><span class="pi-label">Plugin Type</span><span class="pi-badge pi-badge-community">Community Plugin</span></span><span class="pi-item"><span class="pi-label">Price</span><span class="pi-badge pi-badge-free">Free</span></span><span class="pi-item"><span class="pi-label">Version</span><span class="pi-value">v1.1.0</span></span><span class="pi-item"><span class="pi-label">License</span><span class="pi-value">MIT</span></span></div><div class="pi-compat"><span class="pi-chip"><span class="pi-chip-label">NativePHP</span><span class="pi-chip-value">^3.0 || ^4.0</span></span><span class="pi-chip"><span class="pi-chip-label">iOS</span><span class="pi-chip-value">14.0+</span></span><span class="pi-chip"><span class="pi-chip-label">Android</span><span class="pi-chip-value">21+</span></span></div><div class="pi-links"><a href="https://github.com/BhargavDetroja/play-games-services" class="pi-link" target="_blank" rel="noopener">GitHub →</a></div></div>

# Play Games Services

Add Google Play Games Services — sign-in, leaderboards, and achievements — to your NativePHP Mobile Android app in minutes. No Kotlin, no Gradle edits.

> **Note:** This plugin targets Android (Google Play Games Services). iOS support is listed for compatibility but Play Games is an Android-first platform.

## Features

- **Google Play Games sign-in** — authenticate users via their Google Play account
- **Leaderboards** — submit scores and display leaderboard UI natively
- **Achievements** — unlock achievements and track progress
- **Named slot configuration** — define leaderboards and achievements by name in config
- **Auto sign-in** — configurable automatic sign-in on app launch
- **Event-driven** — PHP and JS listeners for all game service events
- **Multi-framework** — works with Livewire, React, Vue, and Alpine.js

## Installation

```bash
composer require bhargavdetroja/nativephp-play-games-services
php artisan native:plugin:register bhargavdetroja/nativephp-play-games-services
php artisan vendor:publish --tag=play-games-services-config
php artisan native:install --force
```

---

# NativePHP Fetch

> Efekpogua Victory

<div class="plugin-info"><div class="pi-meta"><span class="pi-item"><span class="pi-label">Author</span><span class="pi-value">Efekpogua Victory</span></span><span class="pi-item"><span class="pi-label">Plugin Type</span><span class="pi-badge pi-badge-community">Community Plugin</span></span><span class="pi-item"><span class="pi-label">Price</span><span class="pi-badge pi-badge-free">Free</span></span><span class="pi-item"><span class="pi-label">Version</span><span class="pi-value">v1.0.1</span></span><span class="pi-item"><span class="pi-label">License</span><span class="pi-value">MIT</span></span></div><div class="pi-compat"><span class="pi-chip"><span class="pi-chip-label">NativePHP</span><span class="pi-chip-value">^4.1</span></span><span class="pi-chip"><span class="pi-chip-label">PHP</span><span class="pi-chip-value">^8.4</span></span><span class="pi-chip"><span class="pi-chip-label">iOS</span><span class="pi-chip-value">18.0+</span></span><span class="pi-chip"><span class="pi-chip-label">Android</span><span class="pi-chip-value">29+</span></span></div><div class="pi-links"><a href="https://github.com/victorycodedev/nativephp-fetch" class="pi-link" target="_blank" rel="noopener">GitHub →</a></div></div>

# NativePHP Fetch

Truly asynchronous native HTTP networking for NativePHP Mobile. Performs HTTP requests, file uploads, and file downloads using the platform's own networking stack — not a WebView or PHP stream wrapper.

## Features

- **Async HTTP requests** — GET, POST, PUT, PATCH, DELETE with non-blocking execution
- **File uploads** — multipart support with real-time upload progress events
- **File downloads** — streaming to disk with download progress tracking
- **Native retry policies** — exponential backoff with configurable retry limits
- **Request cancellation** — cancel in-flight requests by ID
- **Auth & headers** — bearer token and arbitrary custom header support
- **Flexible body formats** — JSON, form data, query parameters
- **JavaScript client** — first-class support for Inertia, Vue, and React
- **Testing support** — built-in fakes for unit and feature tests

## Installation

```bash
composer require victorycodedev/nativephp-fetch
php artisan vendor:publish --tag=nativephp-plugins-provider
php artisan native:plugin:register victorycodedev/nativephp-fetch
```

## Usage

```php
use Victorycodedev\NativephpFetch\Facades\NativeFetch;

// Simple GET request
NativeFetch::get('https://api.example.com/data', headers: [
    'Authorization' => 'Bearer ' . $token,
]);

// POST with JSON body
NativeFetch::post('https://api.example.com/items', body: [
    'name' => 'My Item',
]);

// Download a file
NativeFetch::download('https://example.com/report.pdf', to: '/local/path/report.pdf');
```

---

# ToastKit

> Efekpogua Victory

<div class="plugin-info"><div class="pi-meta"><span class="pi-item"><span class="pi-label">Author</span><span class="pi-value">Efekpogua Victory</span></span><span class="pi-item"><span class="pi-label">Plugin Type</span><span class="pi-badge pi-badge-community">Community Plugin</span></span><span class="pi-item"><span class="pi-label">Price</span><span class="pi-badge pi-badge-free">Free</span></span><span class="pi-item"><span class="pi-label">Version</span><span class="pi-value">v1.0.2</span></span><span class="pi-item"><span class="pi-label">License</span><span class="pi-value">MIT</span></span></div><div class="pi-compat"><span class="pi-chip"><span class="pi-chip-label">NativePHP</span><span class="pi-chip-value">^4.1</span></span><span class="pi-chip"><span class="pi-chip-label">PHP</span><span class="pi-chip-value">^8.4</span></span><span class="pi-chip"><span class="pi-chip-label">iOS</span><span class="pi-chip-value">18.0+</span></span><span class="pi-chip"><span class="pi-chip-label">Android</span><span class="pi-chip-value">29+</span></span></div><div class="pi-links"><a href="https://github.com/victorycodedev/toastkit" class="pi-link" target="_blank" rel="noopener">GitHub →</a></div></div>

# ToastKit

Rich, customizable native toast notifications for NativePHP Mobile — rendered as native overlays using Jetpack Compose (Android) and SwiftUI (iOS).

## Features

- **5 toast variants** — success, error, warning, info, neutral
- **Customizable styling** — colors, corner radius, padding, shadows
- **Rich content** — title, message, icons with platform-specific overrides
- **Native action buttons** with event handling
- **Queue and stack display strategies**
- **Live updates** — modify a toast without recreating it
- **Swipe-to-dismiss** and close controls
- **JavaScript API** for Inertia, Vue, and React
- **Testing macros** for assertion-based validation

## Installation

```bash
composer require victorycodedev/toastkit
php artisan vendor:publish --tag=nativephp-plugins-provider
php artisan native:plugin:register victorycodedev/toastkit
```

## Usage

```php
use Victorycodedev\Toastkit\Facades\Toast;

Toast::success('Saved!', 'Your changes have been saved.');
Toast::error('Failed', 'Something went wrong.');
Toast::warning('Heads up', 'This action cannot be undone.');
Toast::info('Update available', 'A new version is ready.');
```

## Events

```php
use Victorycodedev\Toastkit\Events\ToastShown;
use Victorycodedev\Toastkit\Events\ToastDismissed;
use Victorycodedev\Toastkit\Events\ToastActionPressed;
```
