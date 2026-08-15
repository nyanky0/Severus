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
    CURLOPT_TIMEOUT => 15,
]);

$html = curl_exec($ch);
curl_close($ch);

preg_match_all('/<script[^>]*>(.*?)<\/script>/s', $html, $matches);
$code = $matches[1][4] ?? '';

// Search for dataLayer items or product objects
if (preg_match_all('/"item_name"\s*:\s*"([^"]+)"/i', $code, $mName)) {
    echo "dataLayer Product Names found (" . count($mName[1]) . "):\n";
    foreach (array_slice(array_unique($mName[1]), 0, 15) as $name) {
        echo " - " . $name . "\n";
    }
}

if (preg_match_all('/"item_category"\s*:\s*"([^"]+)"/i', $code, $mCat)) {
    echo "\ndataLayer Categories found (" . count($mCat[1]) . "):\n";
    foreach (array_slice(array_unique($mCat[1]), 0, 15) as $cat) {
        echo " - " . $cat . "\n";
    }
}

// Search for product URLs in script
if (preg_match_all('#https?:\\\\?/\\\\?/www\.tokopedia\.com\\\\?/severus\\\\?/[a-z0-9\-]+#i', $code, $mUrls)) {
    echo "\ndataLayer Product URLs found (" . count($mUrls[0]) . "):\n";
    foreach (array_slice(array_unique($mUrls[0]), 0, 15) as $pUrl) {
        echo " - " . str_replace(['\/', '\\/'], '/', $pUrl) . "\n";
    }
}
