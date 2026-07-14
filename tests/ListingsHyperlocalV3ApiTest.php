<?php

declare(strict_types=1);

namespace Flipkart\SellerApi\Tests;

use Flipkart\SellerApi\Api\ListingsHyperlocalV3Api;

final class ListingsHyperlocalV3ApiTest extends TestCase
{
    public function test_create_listings(): void
    {
        $body = ['SKU-1' => ['product_id' => 'P1']];
        $api = new ListingsHyperlocalV3Api($this->apiClient());
        $api->createListings($body);

        $this->assertRequest('POST', '/listings/v3/hyperlocal');
        $this->assertJsonBody($body);
    }

    public function test_update_listings(): void
    {
        $body = ['SKU-1' => ['attribute_values' => []]];
        $api = new ListingsHyperlocalV3Api($this->apiClient());
        $api->updateListings($body);

        $this->assertRequest('POST', '/listings/v3/hyperlocal/update');
        $this->assertJsonBody($body);
    }
}
