<?php

namespace App\Console\Commands;

use App\Services\TokopediaScraperService;
use Illuminate\Console\Command;

class ScrapeTokopediaCommand extends Command
{
    protected $signature = 'severus:scrape-tokopedia {url? : Optional target Tokopedia store product URL}';
    protected $description = 'Scrape and import product catalog items from Tokopedia store (https://www.tokopedia.com/severus/product)';

    public function handle(TokopediaScraperService $scraperService): int
    {
        $targetUrl = $this->argument('url') ?: 'https://www.tokopedia.com/severus/product';
        
        $this->info("Starting Tokopedia Product Scraper for: {$targetUrl}");

        $result = $scraperService->scrapeStoreProducts($targetUrl);

        if ($result['status'] === 'FAILED') {
            $this->error($result['message']);
            return 1;
        }

        $this->table(
            ['ID', 'Product Title', 'Price (IDR)', 'Tip Size', 'Joint System', 'Tokopedia Link'],
            collect($result['items'])->map(function ($item) {
                return [
                    $item['id'],
                    $item['title'],
                    $item['formatted_price'],
                    $item['tip_size'] ?: '-',
                    $item['joint_type'] ?: '-',
                    $item['tokopedia_url'],
                ];
            })
        );

        $this->info("Scraping Completed: Found {$result['total_found']} item links, imported/updated {$result['imported']} products into database.");
        return 0;
    }
}
