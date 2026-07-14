<?php

declare(strict_types=1);

namespace Flipkart\SellerApi\Tests;

use Flipkart\SellerApi\Api\ListingsFlipkartV3Api;

final class ListingsFlipkartV3ApiTest extends TestCase
{
    public function test_create_listings(): void
    {
        $body = ['SKU-1' => ['product_id' => 'P1']];
        $api = new ListingsFlipkartV3Api($this->apiClient());
        $api->createListings($body);

        $this->assertRequest('POST', '/listings/v3');
        $this->assertJsonBody($body);
    }

    public function test_update_listings(): void
    {
        $body = ['SKU-1' => ['attribute_values' => []]];
        $api = new ListingsFlipkartV3Api($this->apiClient());
        $api->updateListings($body);

        $this->assertRequest('POST', '/listings/v3/update');
        $this->assertJsonBody($body);
    }
}
