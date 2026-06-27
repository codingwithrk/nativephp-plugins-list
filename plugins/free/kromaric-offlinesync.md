---
name: "Offline Sync"
author: "Kromaric"
price: "Free"
version: "latest"
license: "MIT"
github: "https://github.com/Kromaric/offlinesync"
compatibility:
  nativephp: "^0.8.0"
  php: "^8.1"
  laravel: "10 | 11 | 12"
  ios: "14.0+"
  android: "24+"
install:
  - "composer require techparse/offline-sync"
  - "php artisan native:plugin:register techparse/offline-sync"
  - "php artisan vendor:publish --tag=offline-sync-config"
  - "php artisan migrate"
events:
  - SyncCompleted
  - SyncFailed
  - ConflictDetected
  - QueueFlushed
---

# Offline Sync

Offline-first synchronization plugin for NativePHP Mobile. Handles queuing, bidirectional sync, and conflict resolution so you can focus on building features.

## Features

- Automatic queue management — operations queued when offline
- Bidirectional sync — push local changes and pull remote updates
- 4 conflict resolution strategies: Server wins, Client wins, Last write wins, Merge
- Auto-connectivity monitoring — syncs automatically when connection returns
- Background sync (iOS/Android)
- HTTPS enforcement, auth-agnostic design
- Laravel events, logs, and Artisan commands
- Zero native code required — all Kotlin + Swift bridges included

## Installation

```bash
composer require techparse/offline-sync
php artisan native:plugin:register techparse/offline-sync
php artisan vendor:publish --tag=offline-sync-config
php artisan migrate
```

## Usage

```php
use Techparse\OfflineSync\Facades\OfflineSync;

// Queue an operation
OfflineSync::queue('create', '/api/posts', ['title' => 'Hello']);

// Force sync now
OfflineSync::sync();

// Get sync status
$status = OfflineSync::status();
```

## Events

- `SyncCompleted` — sync round finished successfully
- `SyncFailed` — sync attempt failed with error details
- `ConflictDetected` — a conflict was found; includes the resolution applied
- `QueueFlushed` — all queued operations were processed
