# Profiler

Profiler Library Abstraction

## Install

Via Composer

```bash
$ composer require arabcoders/profiler
```

## Usage Example.

```php
<?php

require __DIR__ . '/../../autoload.php';

$provider = new \arabcoders\profiler\Providers\Tideways();
$handler = new \arabcoders\profiler\Handlers\FileHandler( '/dir/to/save/to' );
$profiler = new \arabcoders\profiler\Profiler( $provider, $handler );

$sampler = new \arabcoders\profiler\Sampler( $profiler, 0, 1 );
```
