<?php

declare(strict_types=1);

require __DIR__.'/../vendor/autoload.php';

use Flipkart\SellerApi\Environment;
use Flipkart\SellerApi\FlipkartSellerClient;

$clientId = getenv('FLIPKART_CLIENT_ID') ?: '';
$clientSecret = getenv('FLIPKART_CLIENT_SECRET') ?: '';
$skuIds = getenv('FLIPKART_SKU_IDS') ?: 'SKU_ID';

if ($clientId === '' || $clientSecret === '') {
    fwrite(STDERR, "Set FLIPKART_CLIENT_ID and FLIPKART_CLIENT_SECRET\n");
    exit(1);
}

$fk = FlipkartSellerClient::fromCredentials(
    Environment::Sandbox,
    $clientId,
    $clientSecret,
);

$result = $fk->listingsCommonV3()->getListings($skuIds);
echo json_encode($result, JSON_PRETTY_PRINT).PHP_EOL;
