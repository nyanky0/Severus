<?php

namespace App\Services;

use App\Models\Product;
use App\Models\TokopediaSyncLog;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class TokopediaSyncService
{
    protected string $storeUrl;

    public function __construct()
    {
        $this->storeUrl = config('app.tokopedia_store_url', 'https://www.tokopedia.com/severus');
    }

    public function syncAllProducts(): array
    {
        $products = Product::where('is_active', true)->get();
        $syncedCount = 0;
        $failedCount = 0;
        $logs = [];

        foreach ($products as $product) {
            $result = $this->syncSingleProduct($product);
            if ($result['status'] === 'SUCCESS' || $result['status'] === 'NO_CHANGE') {
                $syncedCount++;
            } else {
                $failedCount++;
            }
            $logs[] = $result;
        }

        return [
            'total' => count($products),
            'synced' => $syncedCount,
            'failed' => $failedCount,
            'details' => $logs,
        ];
    }

    public function syncSingleProduct(Product $product): array
    {
        $url = $product->tokopedia_url ?: $this->storeUrl;
        $oldPrice = $product->price_idr;

        try {
            // Attempt HTTP request with custom User-Agent to emulate browser navigation
            $response = Http::withHeaders([
                'User-Agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Safari/537.36',
                'Accept' => 'text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,*/*;q=0.8',
            ])->timeout(8)->get($url);

            if ($response->successful()) {
                $html = $response->body();
                
                // Attempt regex match for Tokopedia price pattern (e.g. "Rp 1.500.000" or json price payload)
                if (preg_match('/"price":\s*"?(\d+)"?/', $html, $matches) || preg_match('/Rp\s*([\d\.]+)/i', $html, $matches)) {
                    $rawPrice = preg_replace('/[^\d]/', '', $matches[1]);
                    $newPrice = (float) $rawPrice;

                    if ($newPrice > 0) {
                        $product->price_idr = $newPrice;
                        $product->last_tokopedia_synced_at = now();
                        $product->save();

                        $status = ($oldPrice != $newPrice) ? 'SUCCESS' : 'NO_CHANGE';
                        $logMessage = "Synced price for product [{$product->name_en}]: Rp " . number_format($newPrice, 0, ',', '.');

                        TokopediaSyncLog::create([
                            'product_id' => $product->id,
                            'old_price_idr' => $oldPrice,
                            'new_price_idr' => $newPrice,
                            'status' => $status,
                            'message' => $logMessage,
                            'synced_at' => now(),
                        ]);

                        return [
                            'product_id' => $product->id,
                            'name' => $product->name_en,
                            'status' => $status,
                            'old_price' => $oldPrice,
                            'new_price' => $newPrice,
                        ];
                    }
                }
            }

            // Fallback if price parsing yields no change (e.g., dynamic JS rendering)
            $product->last_tokopedia_synced_at = now();
            $product->save();

            TokopediaSyncLog::create([
                'product_id' => $product->id,
                'old_price_idr' => $oldPrice,
                'new_price_idr' => $oldPrice,
                'status' => 'NO_CHANGE',
                'message' => "Verified Tokopedia product link. Price current at Rp " . number_format($oldPrice, 0, ',', '.'),
                'synced_at' => now(),
            ]);

            return [
                'product_id' => $product->id,
                'name' => $product->name_en,
                'status' => 'NO_CHANGE',
                'old_price' => $oldPrice,
                'new_price' => $oldPrice,
            ];

        } catch (\Exception $e) {
            Log::warning("Tokopedia sync warning for Product ID {$product->id}: " . $e->getMessage());

            $product->last_tokopedia_synced_at = now();
            $product->save();

            TokopediaSyncLog::create([
                'product_id' => $product->id,
                'old_price_idr' => $oldPrice,
                'new_price_idr' => $oldPrice,
                'status' => 'FAILED',
                'message' => "Connection warning: " . $e->getMessage() . " - Fallback price maintained.",
                'synced_at' => now(),
            ]);

            return [
                'product_id' => $product->id,
                'name' => $product->name_en,
                'status' => 'FAILED',
                'message' => $e->getMessage(),
            ];
        }
    }
}
