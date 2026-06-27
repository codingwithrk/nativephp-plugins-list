---
name: "TFLite Plugin"
author: "1338"
price: "Free"
version: "latest"
license: "Unlicensed"
github: "https://github.com/1338/nativephp-tflite-plugin"
compatibility:
  nativephp: "^3.0"
  php: "^8.0"
  android: "any"
install:
  - "composer require 1338/nativephp-tflite"
  - "php artisan vendor:publish --tag=nativephp-plugins-provider"
  - "php artisan native:plugin:register 1338/nativephp-tflite"
events:
  - DetectionEvent
---

# TFLite Plugin

Run on-device TensorFlow Lite model inference from NativePHP Mobile. Load `.tflite` models, perform real-time audio inference, and receive detection events in PHP.

> **Platform:** Android only. Adds `android.permission.RECORD_AUDIO`.

## Features

- Load TFLite models from base64 or app storage
- List and manage stored models on-device
- Real-time inference on device microphone audio
- Configurable sample rate, threshold, and sensitivity
- Detection events dispatched to PHP via NativePHP event system

## Installation

```bash
composer require 1338/nativephp-tflite
php artisan vendor:publish --tag=nativephp-plugins-provider
php artisan native:plugin:register 1338/nativephp-tflite
```

## Usage

```php
use OneThreeThreeEight\NativephpTflite\Tflite;

// Upload a model (base64)
$base64 = base64_encode(file_get_contents('/path/to/model.tflite'));
Tflite::addModel('my_model.tflite', $base64);

// List stored models
$models = Tflite::listModels();

// Load and start listening
Tflite::loadModelFromFile('my_model.tflite');
Tflite::startListening([
    'sampleRate'  => 16000,
    'threshold'   => 0.7,
    'sensitivity' => 0.5,
]);

// Stop inference
Tflite::stopListening();
```

## Events

- `DetectionEvent` — fired when the model detects a match above the configured threshold; includes inference results
