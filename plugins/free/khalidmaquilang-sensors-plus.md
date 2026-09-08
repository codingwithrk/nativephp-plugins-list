---
name: "Sensor Plus"
author: "khalidmaquilang"
price: "Free"
version: "1.0.2"
license: "MIT"
github: "https://github.com/khalidmaquilang/sensor-plus"
support: "https://github.com/khalidmaquilang/sensor-plus/issues"
compatibility:
  nativephp: "^4.0"
  ios: "15.0+"
  android: "21+"
install:
  - "composer require khalidmaquilang/sensors-plus"
  - "php artisan native:plugin:register khalidmaquilang/sensors-plus"
---

# Sensor Plus

Exposes the accelerometer, user-accelerometer (gravity removed), gyroscope, magnetometer, and barometer sensors to your Laravel/Livewire mobile app.

## Features

- **5 sensors** — accelerometer, user-accelerometer (gravity removed), gyroscope, magnetometer, barometer
- **Configurable sampling rates** — FASTEST, GAME, UI, NORMAL intervals
- **Sensor availability checking** and status monitoring
- **Asynchronous event-based readings**
- **PHP and JavaScript** (Vue/React) integration support

## Installation

```bash
composer require khalidmaquilang/sensors-plus
php artisan native:plugin:register khalidmaquilang/sensors-plus
```

## Usage

```php
use Khalidmaquilang\SensorsPlus\Facades\SensorPlus;

// Start listening to the accelerometer
SensorPlus::accelerometer()->start();

// Stop
SensorPlus::accelerometer()->stop();
```
