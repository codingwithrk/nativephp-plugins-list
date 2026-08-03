---
name: "Package Info"
author: "CodingwithRK"
price: "Free"
version: "1.0.0"
license: "MIT"
github: "https://github.com/codingwithrk/package-info"
support: "codingwithrk@gmail.com"
compatibility:
  nativephp: "^3.0"
  ios: "13.0+"
  android: "21+"
install:
  - "composer require codingwithrk/package-info"
  - "php artisan native:plugin:register codingwithrk/package-info"
events:
  - PackageInfoRetrieved
---

# PackageInfo Plugin for NativePHP Mobile

A NativePHP Mobile plugin that provides an API for querying application package information — similar to Flutter's `package_info_plus`.

## Requirements

- PHP ^8.2
- `nativephp/mobile` ^3.0 or ^4.0 (SuperNative)

## Installation

```bash
composer require codingwithrk/package-info

php artisan native:plugin:register codingwithrk/package-info
```

The service provider is auto-discovered by Laravel.

## Usage

### Via Facade

```php
use Codingwithrk\PackageInfo\Facades\PackageInfo;

$info = PackageInfo::getInfo();

if ($info) {
    echo $info->appName;        // "My App"
    echo $info->packageName;    // "com.example.myapp"
    echo $info->version;        // "1.2.3"
    echo $info->buildNumber;    // "42"
    echo $info->installerStore; // "com.android.vending" (Android) or "" (iOS)
}
```

> `getInfo()` returns `null` when called outside a NativePHP Mobile environment.

### Returned Data

`getInfo()` returns a `PackageInfoData` value object with the following properties:

| Property         | Type     | Description                                                                     |
|------------------|----------|---------------------------------------------------------------------------------|
| `appName`        | `string` | Human-readable application name                                                 |
| `packageName`    | `string` | Unique app identifier (bundle ID on iOS, application ID on Android)             |
| `version`        | `string` | Marketing version string (e.g. `"1.2.3"`)                                       |
| `buildNumber`    | `string` | Build/version code as a string (e.g. `"42"`)                                    |
| `installerStore` | `string` | Package name of the installing store, or empty string if unknown/not applicable |

You can also convert the data to an array:

```php
$array = $info->toArray();
// ['appName' => '...', 'packageName' => '...', 'version' => '...', 'buildNumber' => '...', 'installerStore' => '...']
```

## Listening for Events

After `getInfo()` successfully retrieves data, a `PackageInfoRetrieved` event is dispatched. You can listen for it in a Livewire component using the `#[OnNative]` attribute:

```php
use Codingwithrk\PackageInfo\Events\PackageInfoRetrieved;
use Codingwithrk\PackageInfo\PackageInfoData;
use Native\Mobile\Attributes\OnNative;

#[OnNative(PackageInfoRetrieved::class)]
public function handlePackageInfoRetrieved(PackageInfoData $info): void
{
    $this->appName     = $info->appName;
    $this->version     = $info->version;
    $this->buildNumber = $info->buildNumber;
}
```

## Platform Support

| Platform | Supported |
|----------|-----------|
| Android  | Yes       |
| iOS      | Yes       |

## Support

For questions or issues, email [connect@codingwithrk.com](mailto:connect@codingwithrk.com)
