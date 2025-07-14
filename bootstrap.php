<?php

use Illuminate\Container\Container;
use Illuminate\Filesystem\FilesystemManager;
use Illuminate\Support\Facades\Facade;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

// Bootstrap Laravel container
$app = new Container();
Container::setInstance($app);

// Set up facades
Facade::setFacadeApplication($app);

// Register config
$app->instance('config', new \Illuminate\Config\Repository([
    'filesystems.default' => 'local',
    'filesystems.disks.local' => [
        'driver' => 'local',
        'root' => __DIR__.'/storage',
    ],
]));

// Register Storage manually
$app->singleton('files', function () {
    return new \Illuminate\Filesystem\Filesystem;
});

$app->singleton('filesystem', function ($app) {
    return new FilesystemManager($app);
});

// Now you can use Storage facade
Storage::put('example.txt', 'Hello from chunk upload package!');

echo Storage::get('example.txt'); // → Works!
