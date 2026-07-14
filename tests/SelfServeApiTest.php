<?php

declare(strict_types=1);

namespace Flipkart\SellerApi\Tests;

use Flipkart\SellerApi\Api\SelfServeApi;

final class SelfServeApiTest extends TestCase
{
    public function test_change_dispatch_slots(): void
    {
        $body = ['orderItemIds' => ['OI1']];
        $api = new SelfServeApi($this->apiClient());
        $api->changeDispatchSlots($body);

        $this->assertRequest('POST', '/orders/sandbox/update_dispatch_slot');
        $this->assertJsonBody($body);
    }

    public function test_create_return(): void
    {
        $body = ['orderItemId' => 'OI1'];
        $api = new SelfServeApi($this->apiClient());
        $api->createReturn($body);

        $this->assertRequest('POST', '/returns/sandbox/create_returns');
        $this->assertJsonBody($body);
    }

    public function test_create_service(): void
    {
        $body = ['orderItemId' => 'OI1'];
        $api = new SelfServeApi($this->apiClient());
        $api->createService($body);

        $this->assertRequest('POST', '/v2/shipments/sandbox/create_service/');
        $this->assertJsonBody($body);
    }

    public function test_create_test_orders(): void
    {
        $body = ['skus' => [['sku' => 'SKU1']]];
        $api = new SelfServeApi($this->apiClient());
        $api->createTestOrders($body);

        $this->assertRequest('POST', '/orders/sandbox/test_orders');
        $this->assertJsonBody($body);
    }

    public function test_make_order_un_hold(): void
    {
        $body = ['orderItemIds' => ['OI1']];
        $api = new SelfServeApi($this->apiClient());
        $api->makeOrderUnHold($body);

        $this->assertRequest('PUT', '/orders/sandbox/un_hold');
        $this->assertJsonBody($body);
    }

    public function test_mark_order_item_delivered(): void
    {
        $body = ['orderItemIds' => ['OI1']];
        $api = new SelfServeApi($this->apiClient());
        $api->markOrderItemDelivered($body);

        $this->assertRequest('POST', '/orders/sandbox/delivered');
        $this->assertJsonBody($body);
    }

    public function test_mark_order_item_pickup_complete(): void
    {
        $body = ['orderItemIds' => ['OI1']];
        $api = new SelfServeApi($this->apiClient());
        $api->markOrderItemPickupComplete($body);

        $this->assertRequest('POST', '/orders/sandbox/pick_up_complete');
        $this->assertJsonBody($body);
    }

    public function test_mark_order_item_shipped(): void
    {
        $body = ['orderItemIds' => ['OI1']];
        $api = new SelfServeApi($this->apiClient());
        $api->markOrderItemShipped($body);

        $this->assertRequest('POST', '/orders/sandbox/shipped');
        $this->assertJsonBody($body);
    }

    public function test_process_return_events(): void
    {
        $body = ['returnIds' => ['R1']];
        $api = new SelfServeApi($this->apiClient());
        $api->processReturnEvents($body);

        $this->assertRequest('POST', '/returns/sandbox/return_events');
        $this->assertJsonBody($body);
    }

    public function test_put_order_on_hold(): void
    {
        $body = ['orderItemIds' => ['OI1']];
        $api = new SelfServeApi($this->apiClient());
        $api->putOrderOnHold($body);

        $this->assertRequest('PUT', '/orders/sandbox/on_hold');
        $this->assertJsonBody($body);
    }
}
