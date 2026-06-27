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

A typed bridge to Apple Intelligence on iOS — on-device language model sessions, structured JSON responses, streaming snapshots, optional app-provided tool context, transcript helpers, cancellation, and token/context metadata.

> **iOS only.** Android returns `unsupported_platform` responses. Requires an Apple Intelligence-capable device running iOS 26.0+ for Foundation Models Runtime.

## Features

- Structured on-device JSON responses with schema validation
- Streaming snapshot support with normalized output
- Explicit app tool context with user-controlled invocation
- Session management with instructions and cancellation
- Availability checking with detailed unavailability reasons
- Laravel, Livewire, Inertia, Vue, React, and JavaScript support
- TypeScript client with schema and tool helpers
- Token/context metadata retrieval

## Installation

```bash
composer require weswecan/nativephp-mobile-apple-intelligence-foundation-models
php artisan native:plugin:register weswecan/nativephp-mobile-apple-intelligence-foundation-models
php artisan vendor:publish --tag=nativephp-plugins-provider
```

## Compatibility

| Platform           | Requirement                      |
| ------------------ | -------------------------------- |
| NativePHP          | ^3                               |
| iOS                | 18.2+ (Foundation Models: 26.0+) |
| Android            | Not supported                    |
| PHP                | ^8.2                             |

## Events

- `FoundationModelResponseCompleted` — full response available
- `FoundationModelStreamDelta` — streaming chunk received
- `FoundationModelStreamCompleted` — stream finished
- `FoundationModelToolRequested` — model requests a tool call
- `FoundationModelToolResolved` — tool result returned to model
- `FoundationModelError` — error occurred during session
