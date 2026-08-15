<?php

require __DIR__ . '/../vendor/autoload.php';

// Test Tokopedia GraphQL API endpoint for Shop Products
$shopId = "17299578"; // Severus shop ID or slug
$gqlUrl = 'https://gql.tokopedia.com/graphql/ShopProducts';

$query = [
    [
        'operationName' => 'ShopProducts',
        'variables' => [
            'sid' => '17299578',
            'page' => 1,
            'perPage' => 50,
            'etalaseId' => '0',
            'sort' => 1,
            'user_districtId' => '2274',
            'user_cityId' => '176',
            'user_lat' => '',
            'user_long' => ''
        ],
        'query' => 'query ShopProducts($sid: String!, $page: Int, $perPage: Int, $etalaseId: String, $sort: Int) {
          GetShopProduct(shopID: $sid, filter: {page: $page, perPage: $perPage, etalaseID: $etalaseId, sort: $sort}) {
            status
            errors
            totalData
            data {
              product_id
              name
              price {
                text_idr
              }
              primary_image {
                original
                thumbnail
              }
              product_url
              stock
            }
          }
        }'
    ]
];

$ch = curl_init();
curl_setopt_array($ch, [
    CURLOPT_URL => $gqlUrl,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_POST => true,
    CURLOPT_POSTFIELDS => json_encode($query),
    CURLOPT_HTTPHEADER => [
        'Content-Type: application/json',
        'User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Safari/537.36',
        'X-Source: tokodev',
    ],
    CURLOPT_TIMEOUT => 15,
]);

$response = curl_exec($ch);
$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);

echo "GQL Status Code: {$httpCode}\n";
echo "Response Length: " . strlen($response) . "\n";
echo "Response snippet: " . substr($response, 0, 500) . "\n";
