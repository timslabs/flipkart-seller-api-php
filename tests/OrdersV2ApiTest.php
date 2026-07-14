<?php

declare(strict_types=1);

namespace Flipkart\SellerApi\Tests;

use Flipkart\SellerApi\Api\OrdersV2Api;

final class OrdersV2ApiTest extends TestCase
{
    public function test_cancel_orders(): void
    {
        $body = ['orderItemIds' => ['OI1']];
        $api = new OrdersV2Api($this->apiClient());
        $api->cancelOrders($body);

        $this->assertRequest('POST', '/v2/orders/cancel');
        $this->assertJsonBody($body);
    }

    public function test_get_bulk_action_progress_by_request_id(): void
    {
        $api = new OrdersV2Api($this->apiClient());
        $api->getBulkActionProgressByRequestId('req-1');

        $this->assertRequest('GET', '/v2/orders/labelRequest/req-1');
    }

    public function test_get_invoices_info(): void
    {
        $api = new OrdersV2Api($this->apiClient());
        $api->getInvoicesInfo('OI1,OI2');

        $this->assertRequest('GET', '/v2/orders/invoices', ['orderItemIds' => 'OI1,OI2']);
    }

    public function test_get_labels(): void
    {
        $api = new OrdersV2Api($this->apiClient());
        $api->getLabels('OI1');

        $this->assertRequest('GET', '/v2/orders/labels', ['orderItemIds' => 'OI1']);
    }

    public function test_get_manifest_pdf_for_request(): void
    {
        $api = new OrdersV2Api($this->apiClient());
        $api->getManifestPdfForRequest();

        $this->assertRequest('GET', '/v2/orders/manifest');
    }

    public function test_get_order_item_by_id(): void
    {
        $api = new OrdersV2Api($this->apiClient());
        $api->getOrderItemById('OI-1');

        $this->assertRequest('GET', '/v2/orders/OI-1');
    }

    public function test_get_order_items_by_ids(): void
    {
        $api = new OrdersV2Api($this->apiClient());
        $api->getOrderItemsByIds('OI1,OI2');

        $this->assertRequest('GET', '/v2/orders', ['orderItemIds' => 'OI1,OI2']);
    }

    public function test_get_shipments(): void
    {
        $api = new OrdersV2Api($this->apiClient());
        $api->getShipments('OI1');

        $this->assertRequest('GET', '/v2/orders/shipments', ['orderItemIds' => 'OI1']);
    }

    public function test_search_order_item_request(): void
    {
        $body = ['filter' => ['type' => 'status', 'value' => 'APPROVED']];
        $api = new OrdersV2Api($this->apiClient());
        $api->searchOrderItemRequest($body);

        $this->assertRequest('POST', '/v2/orders/search');
        $this->assertJsonBody($body);
    }

    public function test_submit_bulk_confirm_request(): void
    {
        $body = ['orderItemIds' => ['OI1']];
        $api = new OrdersV2Api($this->apiClient());
        $api->submitBulkConfirmRequest($body);

        $this->assertRequest('POST', '/v2/orders/labels');
        $this->assertJsonBody($body);
    }

    public function test_submit_bulk_rtd_request(): void
    {
        $body = ['orderItemIds' => ['OI1']];
        $api = new OrdersV2Api($this->apiClient());
        $api->submitBulkRtdRequest($body);

        $this->assertRequest('POST', '/v2/orders/dispatch');
        $this->assertJsonBody($body);
    }

    public function test_submit_self_ship_deliver_attempt_request(): void
    {
        $body = ['shipments' => []];
        $api = new OrdersV2Api($this->apiClient());
        $api->submitSelfShipDeliverAttemptRequest($body);

        $this->assertRequest('POST', '/v2/shipments/deliveryAttempt');
        $this->assertJsonBody($body);
    }

    public function test_submit_self_ship_deliver_request(): void
    {
        $body = ['shipments' => []];
        $api = new OrdersV2Api($this->apiClient());
        $api->submitSelfShipDeliverRequest($body);

        $this->assertRequest('POST', '/v2/shipments/delivery');
        $this->assertJsonBody($body);
    }

    public function test_submit_self_shipment_dispatch_request(): void
    {
        $body = ['shipments' => []];
        $api = new OrdersV2Api($this->apiClient());
        $api->submitSelfShipmentDispatchRequest($body);

        $this->assertRequest('POST', '/v2/shipments/dispatch');
        $this->assertJsonBody($body);
    }

    public function test_submit_service_attempt_request(): void
    {
        $body = ['services' => []];
        $api = new OrdersV2Api($this->apiClient());
        $api->submitServiceAttemptRequest($body);

        $this->assertRequest('POST', '/v2/services/attempt');
        $this->assertJsonBody($body);
    }

    public function test_submit_service_complete_request(): void
    {
        $body = ['services' => []];
        $api = new OrdersV2Api($this->apiClient());
        $api->submitServiceCompleteRequest($body);

        $this->assertRequest('POST', '/v2/services/complete');
        $this->assertJsonBody($body);
    }
}
