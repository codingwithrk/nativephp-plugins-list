---
name: "NSFW Content Checker"
author: "Cody P Christian"
price: "$49"
version: "0.1.2"
license: "Proprietary"
source: "https://nativephp.com/plugins/codypchristian/nativephp-nsfw-checker"
support: "https://nativephp.com/plugins/codypchristian/nativephp-nsfw-checker"
compatibility:
  nativephp: "^4.0"
  ios: "17.0+"
  android: "24+"
install:
  - "composer require codypchristian/nativephp-nsfw-checker"
  - "php artisan vendor:publish --tag=nativephp-plugins-provider"
  - "php artisan native:plugin:register codypchristian/nativephp-nsfw-checker"
  - "php artisan native:install --force"
---

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
