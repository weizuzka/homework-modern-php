<?php declare(strict_types=1);

use ZW\HomeWork\Decorators\ExtractLevelDecorator;
use ZW\HomeWork\FileReader;

require __DIR__ . '/vendor/autoload.php';

$filters = ['debug'];

$reader = new ExtractLevelDecorator(new FileReader($filters));

$reader->run();
