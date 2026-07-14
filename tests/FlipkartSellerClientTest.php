<?php

declare(strict_types=1);

namespace Flipkart\SellerApi\Tests;

use Flipkart\SellerApi\Api\ListingsCommonV3Api;
use Flipkart\SellerApi\Api\ListingsFlipkartV3Api;
use Flipkart\SellerApi\Api\ListingsHyperlocalV3Api;
use Flipkart\SellerApi\Api\OrdersV2Api;
use Flipkart\SellerApi\Api\ReturnsV2Api;
use Flipkart\SellerApi\Api\SelfServeApi;
use Flipkart\SellerApi\Api\ShipmentV3Api;
use Flipkart\SellerApi\FlipkartSellerClient;

final class FlipkartSellerClientTest extends TestCase
{
    public function test_api_accessors(): void
    {
        $apiClient = $this->apiClient();
        $fk = new FlipkartSellerClient($apiClient);

        $this->assertSame($apiClient, $fk->apiClient());
        $this->assertInstanceOf(ListingsCommonV3Api::class, $fk->listingsCommonV3());
        $this->assertInstanceOf(ListingsFlipkartV3Api::class, $fk->listingsFlipkartV3());
        $this->assertInstanceOf(ListingsHyperlocalV3Api::class, $fk->listingsHyperlocalV3());
        $this->assertInstanceOf(OrdersV2Api::class, $fk->ordersV2());
        $this->assertInstanceOf(ReturnsV2Api::class, $fk->returnsV2());
        $this->assertInstanceOf(ShipmentV3Api::class, $fk->shipmentV3());
        $this->assertInstanceOf(SelfServeApi::class, $fk->selfServe());
    }
}
