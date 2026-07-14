# flipkart-seller-api-php

PHP client for Flipkart Seller APIs. Ported from the [Java SDK](https://github.com/Flipkart/flipkart-seller-api-java-sdk).

Requires PHP 8.2+, ext-json, and Guzzle 7.

```bash
composer require tims/flipkart-seller-api-php
```

## Usage

```php
use Flipkart\SellerApi\Environment;
use Flipkart\SellerApi\FlipkartSellerClient;

$fk = FlipkartSellerClient::fromCredentials(
    Environment::Sandbox, // or Environment::Prod
    getenv('FLIPKART_CLIENT_ID'),
    getenv('FLIPKART_CLIENT_SECRET'),
);

$listings = $fk->listingsCommonV3()->getListings('SKU1,SKU2');
```

For third-party OAuth, pass `redirectUrl`, `state`, and `authCode` into `fromCredentials()`.

You can also build an `ApiClient` yourself:

```php
use Flipkart\SellerApi\AccessTokenGenerator;
use Flipkart\SellerApi\ApiClient;
use Flipkart\SellerApi\Api\OrdersV2Api;
use Flipkart\SellerApi\Environment;
use Flipkart\SellerApi\UrlConfiguration;

new UrlConfiguration(Environment::Sandbox);

$token = (new AccessTokenGenerator)
    ->clientCredentials($clientId, $clientSecret)
    ->getAccessToken();

$client = new ApiClient;
$client->setAccessToken($token);

$orders = new OrdersV2Api($client);
$result = $orders->searchOrderItemRequest([/* ... */]);
```

API classes under `Flipkart\SellerApi\Api\` match the Java SDK (`ListingsCommonV3Api`, `OrdersV2Api`, `ShipmentV3Api`, etc.). Methods return decoded JSON arrays, or raw strings for PDFs and other binary responses.

- Sandbox: `https://sandbox-api.flipkart.net/sellers`
- Production: `https://api.flipkart.net/sellers`

Get credentials from Flipkart Seller Developer Admin.

## License

MIT
