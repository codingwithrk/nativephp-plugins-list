---
name: "Apple Intelligence Foundation Models"
author: "Context Undefined"
price: "$29"
version: "1.0.0"
license: "Proprietary"
source: "https://nativephp.com/plugins/weswecan/nativephp-mobile-apple-intelligence-foundation-models"
support: "support@weswecan.com"
compatibility:
  nativephp: "^3"
  ios: "18.2+"
  android: "not supported"
  php: "^8.2"
install:
  - "composer require weswecan/nativephp-mobile-apple-intelligence-foundation-models"
  - "php artisan native:plugin:register weswecan/nativephp-mobile-apple-intelligence-foundation-models"
  - "php artisan vendor:publish --tag=nativephp-plugins-provider"
events:
  - FoundationModelResponseCompleted
  - FoundationModelStreamDelta
  - FoundationModelStreamCompleted
  - FoundationModelToolRequested
  - FoundationModelToolResolved
  - FoundationModelError
---

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
