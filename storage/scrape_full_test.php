<?php

require __DIR__ . '/../vendor/autoload.php';

// Method A: Query Tokopedia Store Product Search / Ace API Endpoint
$url = 'https://ace.tokopedia.com/search/v2.6/product?shop_id=17299578&rows=60&start=0';

$ch = curl_init();
curl_setopt_array($ch, [
    CURLOPT_URL => $url,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => '',
    CURLOPT_USERAGENT => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Safari/537.36',
    CURLOPT_TIMEOUT => 15,
]);

$json = curl_exec($ch);
$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);

echo "Ace API HTTP Code: {$httpCode}, Response Length: " . strlen($json) . "\n";

$data = json_decode($json, true);

if (!empty($data['data'])) {
    echo "Found " . count($data['data']) . " products via Tokopedia Store API!\n";
    foreach ($data['data'] as $idx => $item) {
        echo " [" . ($idx+1) . "] Name: " . ($item['name'] ?? 'N/A') . "\n";
        echo "     Price: " . ($item['price'] ?? 'N/A') . "\n";
        echo "     URL: " . ($item['url'] ?? 'N/A') . "\n";
        echo "     Image: " . ($item['image_url'] ?? 'N/A') . "\n\n";
    }
} else {
    echo "Ace API returned empty data array. Response snippet:\n" . substr($json, 0, 300) . "\n";
}
