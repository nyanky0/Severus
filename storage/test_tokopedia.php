<?php

require __DIR__ . '/../vendor/autoload.php';

$url = 'https://www.tokopedia.com/severus';
$opts = [
    'http' => [
        'method' => "GET",
        'header' => "User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Safari/537.36\r\n"
    ]
];

$context = stream_context_create($opts);
$html = @file_get_contents($url, false, $context);

preg_match_all('/<script[^>]*>(.*?)<\/script>/s', $html, $scriptMatches);
$script4 = $scriptMatches[1][4] ?? '';

// Search for product names and prices inside script 4
preg_match_all('/"name"\s*:\s*"([^"]+)".*?"price"\s*:\s*"([^"]+)"/i', $script4, $m1);
echo "Pattern 1 matches: " . count($m1[0]) . "\n";
for ($i = 0; $i < min(10, count($m1[0])); $i++) {
    echo "Product: {$m1[1][$i]} | Price: {$m1[2][$i]}\n";
}

// Search for Rp format prices
preg_match_all('/"([^"]*cue[^"]*)"[^\}]*?"price"[^\}]*?"([^"]+)"/i', $script4, $m2);
echo "\nPattern 2 (Cue items) matches: " . count($m2[0]) . "\n";
for ($i = 0; $i < min(10, count($m2[0])); $i++) {
    echo "Product: {$m2[1][$i]} | Price: {$m2[2][$i]}\n";
}

// Print sample snippet around 'Severus' or product names
preg_match_all('/Severus[^\"]*/i', $script4, $severusMatches);
echo "\nSeverus mentions: " . count($severusMatches[0]) . "\n";
foreach (array_slice(array_unique($severusMatches[0]), 0, 10) as $s) {
    echo " - " . substr($s, 0, 80) . "\n";
}
