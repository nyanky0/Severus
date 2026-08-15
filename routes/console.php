<?php

use Illuminate\Support\Facades\Artisan;

Artisan::command('severus:sync-tokopedia', function () {
    $this->call(\App\Console\Commands\SyncTokopediaCommand::class);
})->purpose('Sync product prices and catalog data from Tokopedia store');

Artisan::command('severus:scrape-tokopedia', function () {
    $this->call(\App\Console\Commands\ScrapeTokopediaCommand::class);
})->purpose('Scrape product catalog items from Tokopedia store (https://www.tokopedia.com/severus/product)');
