<?php

namespace App\Console\Commands;

use App\Services\TokopediaSyncService;
use Illuminate\Console\Command;

class SyncTokopediaCommand extends Command
{
    protected $signature = 'severus:sync-tokopedia';
    protected $description = 'Sync product prices and active stock status from Tokopedia store (https://www.tokopedia.com/severus)';

    public function handle(TokopediaSyncService $syncService): int
    {
        $this->info('Starting Severus Cues Tokopedia Store Price & Catalog Sync...');
        
        $result = $syncService->syncAllProducts();

        $this->table(
            ['Product ID', 'Product Name', 'Status', 'Old Price (IDR)', 'New Price (IDR)'],
            collect($result['details'])->map(function ($item) {
                return [
                    $item['product_id'],
                    $item['name'],
                    $item['status'],
                    isset($item['old_price']) ? 'Rp ' . number_format($item['old_price'], 0, ',', '.') : '-',
                    isset($item['new_price']) ? 'Rp ' . number_format($item['new_price'], 0, ',', '.') : '-',
                ];
            })
        );

        $this->info("Sync Completed: {$result['synced']} successful, {$result['failed']} failed out of {$result['total']} products.");
        return 0;
    }
}
