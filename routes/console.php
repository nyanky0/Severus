<?php

use Illuminate\Support\Facades\Artisan;

Artisan::command('severus:sync-tokopedia', function () {
    $this->call(\App\Console\Commands\SyncTokopediaCommand::class);
})->purpose('Sync product prices and catalog data from Tokopedia store');
