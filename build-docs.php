<?php

declare(strict_types=1);

require __DIR__ . '/vendor/autoload.php';

use Docsmith\Docsmith;

Docsmith::make()
    ->readmeIndex(__DIR__ . '/README.md')
    ->output(__DIR__ . '/docs')
    ->title('NativePHP Plugins List')
    ->description('A curated directory of plugins for NativePHP Mobile.')
    ->build();
