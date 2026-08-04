---
name: "Open Sound Control (OSC)"
author: "Context Undefined"
price: "$29"
version: "1.0.1"
license: "Proprietary"
source: "https://nativephp.com/plugins/weswecan/nativephp-mobile-osc"
support: "support@weswecan.com"
compatibility:
  nativephp: "^3"
  ios: "15.0+"
  android: "21+"
  php: "^8.2"
install:
  - "composer require weswecan/nativephp-mobile-osc"
  - "php artisan native:plugin:register weswecan/nativephp-mobile-osc"
events:
  - OscMessageReceived
  - OscBundleReceived
  - OscListenerStarted
  - OscListenerStopped
  - OscMessageSent
  - OscError
---

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
