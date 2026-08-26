---
name: "FilePicker"
author: "noehassiel"
price: "$49"
version: "0.2.2"
license: "MIT"
source: "https://nativephp.com/plugins/noehassiel/filepicker"
support: "contact@noehassiel.com"
compatibility:
  nativephp: "^4.0"
  ios: "16.0+"
  android: "26+"
install:
  - "composer config repositories.nativephp-plugins composer https://plugins.nativephp.com"
  - "composer config http-basic.plugins.nativephp.com your@email.com your-license-key"
  - "php artisan vendor:publish --tag=nativephp-plugins-provider"
  - "composer require noehassiel/filepicker"
  - "php artisan native:plugin:register noehassiel/filepicker"
---

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
