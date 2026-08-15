<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\TokopediaSyncLog;
use App\Services\TokopediaScraperService;
use App\Services\TokopediaSyncService;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $totalProducts = Product::count();
        $totalCategories = Category::count();
        $recentSyncLogs = TokopediaSyncLog::with('product')->latest()->take(10)->get();
        $products = Product::with('category')->latest()->take(5)->get();

        return view('admin.dashboard', compact('totalProducts', 'totalCategories', 'recentSyncLogs', 'products'));
    }

    public function triggerSync(TokopediaSyncService $syncService)
    {
        $result = $syncService->syncAllProducts();
        
        return redirect()->back()->with('success', "Tokopedia price sync executed! Synced {$result['synced']} out of {$result['total']} products.");
    }

    public function triggerScrape(TokopediaScraperService $scraperService)
    {
        $result = $scraperService->scrapeStoreProducts();
        
        return redirect()->back()->with('success', "Tokopedia Scraper completed! Found {$result['total_found']} items on Tokopedia store product page and imported/updated {$result['imported']} catalog items.");
    }
}
