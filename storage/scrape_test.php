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
        'Accept-Language: id-ID,id;q=0.9,en-US;q=0.8,en;q=0.7',
    ],
    CURLOPT_TIMEOUT => 15,
]);

$html = curl_exec($ch);
$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);

echo "HTTP Status Code: {$httpCode}\n";
echo "HTML Length: " . strlen($html) . "\n";

// Search for product cards, URLs, image links, and prices in HTML
preg_match_all('/href="(https:\/\/www\.tokopedia\.com\/severus\/[^"?]+)"/i', $html, $urlMatches);
echo "Product URLs found: " . count(array_unique($urlMatches[1])) . "\n";
foreach (array_slice(array_unique($urlMatches[1]), 0, 10) as $pUrl) {
    echo " - " . $pUrl . "\n";
}

// Search for image tags
preg_match_all('/(https:\/\/images\.tokopedia\.net\/img\/cache\/[^\s"\'<>]+)/i', $html, $imgMatches);
echo "\nTokopedia Image CDN URLs found: " . count(array_unique($imgMatches[1])) . "\n";
foreach (array_slice(array_unique($imgMatches[1]), 0, 10) as $imgUrl) {
    echo " - " . $imgUrl . "\n";
}
