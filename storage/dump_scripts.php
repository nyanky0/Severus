<?php

require __DIR__ . '/../vendor/autoload.php';

$url = 'https://www.tokopedia.com/severus/product';

$ch = curl_init();
curl_setopt_array($ch, [
    CURLOPT_URL => $url,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_ENCODING => '',
    CURLOPT_USERAGENT => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Safari/537.36',
    CURLOPT_HTTPHEADER => [
        'Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/avif,image/webp,*/*;q=0.8',
    ],
    CURLOPT_TIMEOUT => 15,
]);

$html = curl_exec($ch);
curl_close($ch);

preg_match_all('/<script[^>]*>(.*?)<\/script>/s', $html, $matches);

echo "Found " . count($matches[1]) . " script tags.\n";

foreach ($matches[1] as $idx => $code) {
    if (strlen($code) > 1000) {
        echo "Script #{$idx} (Length: " . strlen($code) . "): " . substr($code, 0, 150) . "...\n";
    }
}
