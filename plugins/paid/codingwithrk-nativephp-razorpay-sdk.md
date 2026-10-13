---
name: "NativePHP Razorpay SDK"
author: "CodingwithRK"
price: "₹2,500"
version: "1.0.0"
license: "Proprietary"
source: "https://marketplace.codingwithrk.com/products/nativephp-razorpay-sdk"
support: "https://marketplace.codingwithrk.com/products/nativephp-razorpay-sdk"
compatibility:
  nativephp: "^3.0|^4.0"
  ios: "18.0+"
  android: "29+"
install:
  - "composer require codingwithrk/nativephp-razorpay-sdk"
  - "php artisan native:plugin:register codingwithrk/nativephp-razorpay-sdk"
---

# NativePHP Razorpay SDK

Native Razorpay Standard Checkout for NativePHP Mobile — opens the native Razorpay payment UI on both iOS and Android and delivers results asynchronously through NativePHP events.

> **Server-side verification required:** After a successful payment, verify the Razorpay signature on your server before fulfilling any order. The Razorpay secret key is never bundled in the plugin; it is passed securely at runtime.

## Features

- **Native checkout UI** — opens the official Razorpay Standard Checkout UI natively on iOS and Android (no WebView)
- **Async event delivery** — payment results (success, failure, external wallet) arrive as NativePHP events
- **Prefilled customer data** — pass `contact` and `email` to pre-populate the checkout form
- **Customizable theme** — configure checkout theme colors to match your app brand
- **PHP & JavaScript API** — full support for both Blade/PHP and Inertia/SPA flows
- **Server-side signature verification** — verify `razorpay_order_id`, `razorpay_payment_id`, and `razorpay_signature` before order fulfilment

## Installation

```bash
composer require codingwithrk/nativephp-razorpay-sdk
php artisan native:plugin:register codingwithrk/nativephp-razorpay-sdk
php artisan native:run
```

## Support

- Email: connect@codingwithrk.com
- Marketplace: <https://marketplace.codingwithrk.com/products/nativephp-razorpay-sdk>
