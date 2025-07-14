<?php

namespace ChunkUpload;

use Illuminate\Support\ServiceProvider;

class ChunkUploadServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->loadRoutesFrom(__DIR__.'/routes/web.php');
        $this->loadRoutesFrom(__DIR__.'/routes/api.php');
        $this->publishes([
            __DIR__.'/config/chunkupload.php' => config_path('chunkupload.php'),
        ], 'config');
    }

    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/config/chunkupload.php', 'chunkupload');
    }
}
