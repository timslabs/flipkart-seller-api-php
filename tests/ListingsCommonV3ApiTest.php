<?php

declare(strict_types=1);

namespace Flipkart\SellerApi\Tests;

use Flipkart\SellerApi\Api\ListingsCommonV3Api;

final class ListingsCommonV3ApiTest extends TestCase
{
    public function test_get_listings(): void
    {
        $api = new ListingsCommonV3Api($this->apiClient());
        $result = $api->getListings('SKU-1');

        $this->assertSame(['ok' => true], $result);
        $this->assertRequest('GET', '/listings/v3/SKU-1');
    }

    public function test_update_inventory(): void
    {
        $body = ['SKU-1' => ['locations' => [['id' => 'LOC1', 'inventory' => 5]]]];
        $api = new ListingsCommonV3Api($this->apiClient());
        $api->updateInventory($body);

        $this->assertRequest('POST', '/listings/v3/update/inventory');
        $this->assertJsonBody($body);
    }

    public function test_update_price(): void
    {
        $body = ['SKU-1' => ['price' => ['mrp' => 100, 'selling_price' => 90]]];
        $api = new ListingsCommonV3Api($this->apiClient());
        $api->updatePrice($body);

        $this->assertRequest('POST', '/listings/v3/update/price');
        $this->assertJsonBody($body);
    }
}
