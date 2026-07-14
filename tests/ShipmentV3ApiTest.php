<?php

declare(strict_types=1);

namespace Flipkart\SellerApi\Tests;

use Flipkart\SellerApi\Api\ShipmentV3Api;

final class ShipmentV3ApiTest extends TestCase
{
    public function test_cancel_by_enforced_group_ids(): void
    {
        $body = ['shipmentIds' => ['S1']];
        $api = new ShipmentV3Api($this->apiClient());
        $api->cancelByEnforcedGroupIds($body);

        $this->assertRequest('POST', '/v3/shipments/cancel');
        $this->assertJsonBody($body);
    }

    public function test_get_invoices_pdf_from_esi(): void
    {
        $api = new ShipmentV3Api($this->apiClient());
        $api->getInvoicesPdfFromEsi('S1,S2');

        $this->assertRequest('GET', '/v3/shipments/S1%2CS2/invoices');
    }

    public function test_get_labels(): void
    {
        $api = new ShipmentV3Api($this->apiClient());
        $api->getLabels('S1');

        $this->assertRequest('GET', '/v3/shipments/S1/labels');
    }

    public function test_get_labels_only(): void
    {
        $api = new ShipmentV3Api($this->apiClient());
        $api->getLabelsOnly('S1', true);

        $this->assertRequest('POST', '/v3/shipments/S1/labelOnly', ['reprint' => 'true']);
    }

    public function test_get_labels_only_pdf(): void
    {
        $api = new ShipmentV3Api($this->apiClient());
        $api->getLabelsOnlyPDF('S1', false);

        $this->assertRequest('POST', '/v3/shipments/S1/labelOnly/pdf', ['reprint' => 'false']);
    }

    public function test_get_manifest(): void
    {
        $body = ['shipmentIds' => ['S1']];
        $api = new ShipmentV3Api($this->apiClient());
        $api->getManifest($body);

        $this->assertRequest('POST', '/v3/shipments/manifest');
        $this->assertJsonBody($body);
    }

    public function test_get_shipment_details(): void
    {
        $api = new ShipmentV3Api($this->apiClient());
        $api->getShipmentDetails('S1');

        $this->assertRequest('GET', '/v3/shipments/S1');
    }

    public function test_get_shipment_details_by_internal_id(): void
    {
        $api = new ShipmentV3Api($this->apiClient());
        $api->getShipmentDetailsByInternalId('S1', 'OI1', 'O1');

        $this->assertRequest('GET', '/v3/shipments', [
            'shipmentIds' => 'S1',
            'orderItemIds' => 'OI1',
            'orderIds' => 'O1',
        ]);
    }

    public function test_get_vendor_group_details(): void
    {
        $api = new ShipmentV3Api($this->apiClient());
        $api->getVendorGroupDetails('LOC1');

        $this->assertRequest('GET', '/v3/shipments/handover/counts', ['locationId' => 'LOC1']);
    }

    public function test_mark_rtd(): void
    {
        $body = ['shipmentIds' => ['S1']];
        $api = new ShipmentV3Api($this->apiClient());
        $api->markRTD($body);

        $this->assertRequest('POST', '/v3/shipments/dispatch');
        $this->assertJsonBody($body);
    }

    public function test_pack(): void
    {
        $body = ['shipmentIds' => ['S1']];
        $api = new ShipmentV3Api($this->apiClient());
        $api->pack($body);

        $this->assertRequest('POST', '/v3/shipments/labels');
        $this->assertJsonBody($body);
    }

    public function test_search_pre_dispatch_shipment_get(): void
    {
        $api = new ShipmentV3Api($this->apiClient());
        $api->searchPreDispatchShipmentGet('token-1');

        $this->assertRequest('GET', '/v3/shipments/filter', ['next_token' => 'token-1']);
    }

    public function test_search_pre_dispatch_shipment_post(): void
    {
        $body = ['filter' => []];
        $api = new ShipmentV3Api($this->apiClient());
        $api->searchPreDispatchShipmentPost($body);

        $this->assertRequest('POST', '/v3/shipments/filter');
        $this->assertJsonBody($body);
    }

    public function test_submit_self_ship_deliver_attempt_request(): void
    {
        $body = ['shipments' => []];
        $api = new ShipmentV3Api($this->apiClient());
        $api->submitSelfShipDeliverAttemptRequest($body);

        $this->assertRequest('POST', '/v3/shipments/selfShip/deliveryAttempt');
        $this->assertJsonBody($body);
    }

    public function test_submit_self_ship_delivery_request(): void
    {
        $body = ['shipments' => []];
        $api = new ShipmentV3Api($this->apiClient());
        $api->submitSelfShipDeliveryRequest($body);

        $this->assertRequest('POST', '/v3/shipments/selfShip/delivery');
        $this->assertJsonBody($body);
    }

    public function test_submit_self_shipt_dispatch_request(): void
    {
        $body = ['shipments' => []];
        $api = new ShipmentV3Api($this->apiClient());
        $api->submitSelfShiptDispatchRequest($body);

        $this->assertRequest('POST', '/v3/shipments/selfShip/dispatch');
        $this->assertJsonBody($body);
    }

    public function test_update_tracking_info(): void
    {
        $body = ['trackingId' => 'TRK1'];
        $api = new ShipmentV3Api($this->apiClient());
        $api->updateTrackingInfo('S1', $body);

        $this->assertRequest('POST', '/v3/shipments/S1/update');
        $this->assertJsonBody($body);
    }
}
