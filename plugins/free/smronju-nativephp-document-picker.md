---
name: "Document Picker"
author: "Mohammad Shoriful Islam Ronju"
price: "Free"
version: "1.1.2"
license: "MIT"
github: "https://github.com/smronju/nativephp-document-picker"
support: "https://github.com/smronju/nativephp-document-picker/issues"
compatibility:
  nativephp: "^3.0 || ^4.0"
  ios: "15.0+"
  android: "21+"
install:
  - "composer require smronju/nativephp-document-picker"
  - "php artisan vendor:publish --tag=nativephp-plugins-provider"
  - "php artisan native:plugin:register smronju/nativephp-document-picker"
---

# Document Picker

Integrates system document pickers into NativePHP Mobile — open a foreign file or save one back out to a user-chosen location, with no permission requests required.

## Features

- **Open files** — iOS `UIDocumentPickerViewController` and Android `ACTION_OPEN_DOCUMENT`
- **Save files** — iOS `forExporting` and Android `ACTION_CREATE_DOCUMENT`
- **No permission requests** — system UI handles all authorization through user selection
- **MIME type filtering** — restrict selectable file types
- **Event-driven** — results via `DocumentPicked` and `DocumentSaved` events

## Installation

```bash
composer require smronju/nativephp-document-picker
php artisan vendor:publish --tag=nativephp-plugins-provider
php artisan native:plugin:register smronju/nativephp-document-picker
```
