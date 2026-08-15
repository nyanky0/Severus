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
curl_close($ch);

echo "HTML Length: " . strlen($html) . "\n";

// Search for product JSON objects in initial script payloads
preg_match_all('/"name"\s*:\s*"([^"]+)".*?"url"\s*:\s*"([^"]+)"/i', $html, $m1);
echo "Name + URL matches: " . count($m1[0]) . "\n";
for ($i = 0; $i < min(15, count($m1[0])); $i++) {
    echo "Product: {$m1[1][$i]} => {$m1[2][$i]}\n";
}

// Search for price patterns
preg_match_all('/"price"\s*:\s*\{[^}]*"text_idr"\s*:\s*"([^"]+)"/i', $html, $m2);
echo "Price text matches: " . count($m2[0]) . "\n";
foreach (array_slice(array_unique($m2[1]), 0, 10) as $priceStr) {
    echo " - Price: {$priceStr}\n";
}

// Search for item images
preg_match_all('/"image_url"\s*:\s*"([^"]+)"/i', $html, $m3);
echo "Image URL matches: " . count(array_unique($m3[1])) . "\n";
foreach (array_slice(array_unique($m3[1]), 0, 10) as $imgUrl) {
    echo " - Image: {$imgUrl}\n";
}
