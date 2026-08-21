---
name: "NativePHP Fetch"
author: "Efekpogua Victory"
price: "Free"
version: "1.0.0"
license: "MIT"
github: "https://github.com/victorycodedev/nativephp-fetch"
support: "https://github.com/victorycodedev/nativephp-fetch/issues"
compatibility:
  nativephp: "^4.1"
  php: "^8.4"
  ios: "18.0+"
  android: "29+"
install:
  - "composer require victorycodedev/nativephp-fetch"
  - "php artisan vendor:publish --tag=nativephp-plugins-provider"
  - "php artisan native:plugin:register victorycodedev/nativephp-fetch"
---

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
