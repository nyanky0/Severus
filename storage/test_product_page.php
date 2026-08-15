<?php

require __DIR__ . '/../vendor/autoload.php';

$productUrl = 'https://www.tokopedia.com/severus/severus-gen-1-carbon-shaft-unilock-low-deflection-high-power-12-4mm-11-8';

$ch = curl_init();
curl_setopt_array($ch, [
    CURLOPT_URL => $productUrl,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_ENCODING => '',
    CURLOPT_USERAGENT => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Safari/537.36',
    CURLOPT_HTTPHEADER => [
        'Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/avif,image/webp,*/*;q=0.8',
        'Accept-Language: id-ID,id;q=0.9,en-US;q=0.8,en;q=0.7',
    ],
    CURLOPT_TIMEOUT => 10,
]);

$html = curl_exec($ch);
$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);

echo "HTTP Status Code: {$httpCode}\n";
echo "Product Page HTML Length: " . strlen($html) . "\n";

if ($html) {
    if (preg_match('/<meta\s+property="product:price:amount"\s+content="([^"]+)"/i', $html, $m)) {
        echo "OG Price Amount: " . $m[1] . "\n";
    }
    if (preg_match('/"price":\s*"?(\d{6,8})"?/', $html, $m)) {
        echo "JSON Price matched: " . $m[1] . "\n";
    }
    if (preg_match_all('/<meta\s+property="([^"]+)"\s+content="([^"]+)"/i', $html, $mAll)) {
        echo "\nOpenGraph Meta Tags:\n";
        for ($i = 0; $i < count($mAll[0]); $i++) {
            echo " - " . $mAll[1][$i] . " => " . $mAll[2][$i] . "\n";
        }
    }
}
