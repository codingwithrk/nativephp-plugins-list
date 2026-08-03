---
name: "SMS Reader"
author: "Anthony Tendwa"
price: "Free"
version: "1.0.0"
license: "MIT"
github: "https://github.com/atendwa/nativephp-sms-reader"
compatibility:
  nativephp: "^3.0"
  php: "^8.2"
  laravel: "11 | 12"
  android: "26+"
install:
  - "composer require atendwa/nativephp-sms-reader"
  - "php artisan native:plugin:register atendwa/nativephp-sms-reader"
events:
  - SmsReceived
---

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
