<?php

require __DIR__ . '/../vendor/autoload.php';

$storeUrl = 'https://www.tokopedia.com/severus';

$ch = curl_init();
curl_setopt_array($ch, [
    CURLOPT_URL => $storeUrl,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_ENCODING => '',
    CURLOPT_USERAGENT => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Safari/537.36',
    CURLOPT_HTTPHEADER => [
        'Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/avif,image/webp,*/*;q=0.8',
        'Accept-Language: id-ID,id;q=0.9,en-US;q=0.8,en;q=0.7',
    ],
    CURLOPT_TIMEOUT => 15,
]);

$html = curl_exec($ch);
$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);

echo "HTTP Code: {$httpCode}, Body Length: " . strlen($html) . "\n";

// Look for product card components and price tags in Tokopedia shop HTML
preg_match_all('/<div[^>]*data-testid="master-product-card"[^>]*>(.*?)<\/div>/s', $html, $cards);
if (empty($cards[0])) {
    // Try generic product item regex
    preg_match_all('/href="(https:\/\/www\.tokopedia\.com\/severus\/[^"?]+)"[^>]*>.*?Rp\s*([\d\.]+)/s', $html, $matches);
    echo "Direct Link + Price Matches: " . count($matches[0]) . "\n";
    for ($i = 0; $i < min(10, count($matches[0])); $i++) {
        echo "URL: {$matches[1][$i]} | Price: Rp {$matches[2][$i]}\n";
    }
}

// Check JSON script tags for shop products
preg_match_all('/"name"\s*:\s*"([^"]+)".*?"price"\s*:\s*(\d{5,9})/i', $html, $jsonMatches);
echo "JSON Price Matches: " . count($jsonMatches[0]) . "\n";
for ($i = 0; $i < min(10, count($jsonMatches[0])); $i++) {
    echo "Item: {$jsonMatches[1][$i]} => Rp " . number_format($jsonMatches[2][$i], 0, ',', '.') . "\n";
}
