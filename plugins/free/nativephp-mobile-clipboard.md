---
name: "Mobile Clipboard"
author: "Shane Rosenthal"
price: "Free"
version: "1.0.0"
license: "MIT"
github: "https://github.com/NativePHP/mobile-clipboard"
support: "https://nativephp.com/support"
compatibility:
  nativephp: "^3.0 || ^4.0"
  ios: "18.2+"
  android: "26+"
install:
  - "composer require nativephp/mobile-clipboard"
  - "php artisan native:plugin:register nativephp/mobile-clipboard"
---

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
