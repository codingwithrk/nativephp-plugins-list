---
name: "Retro Emulator"
author: "Kevin Batdorf"
price: "Free"
version: "0.1.3"
license: "MIT"
github: "https://github.com/KevinBatdorf/nativephp-retro-emulator"
support: "https://github.com/KevinBatdorf/nativephp-retro-emulator/issues"
compatibility:
  nativephp: "^4.0"
  ios: "16.0+"
  android: "26+"
install:
  - "composer require kevinbatdorf/nativephp-retro-emulator"
  - "php artisan native:plugin:register kevinbatdorf/nativephp-retro-emulator"
---

# Retro Emulator

Native retro emulation for NativePHP Mobile apps — NES, SNES, Game Boy, Game Boy Color, Game Boy Advance, and Genesis via swappable cores. No BIOS files, API keys, or extensive setup required.

## Supported Systems

- NES
- SNES
- Game Boy / Game Boy Color
- Game Boy Advance
- Sega Genesis

## Features

- **Save states** with undo and instant rewind
- **Multiple controller options** — touch d-pad, physical gamepads, multitap
- **Live memory access** — read, write, and monitor memory in real time
- **CRT shaders** and presentation controls
- **Built-in cheat support** and ROM picker
- **Cross-platform event system** — works with Livewire and JavaScript (Vue/React)

## Installation

```bash
composer require kevinbatdorf/nativephp-retro-emulator
php artisan native:plugin:register kevinbatdorf/nativephp-retro-emulator
```
