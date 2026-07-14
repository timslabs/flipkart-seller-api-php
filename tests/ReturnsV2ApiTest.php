<?php

declare(strict_types=1);

namespace Flipkart\SellerApi\Tests;

use Flipkart\SellerApi\Api\ReturnsV2Api;

final class ReturnsV2ApiTest extends TestCase
{
    public function test_approve_self_ship_returns(): void
    {
        $body = ['returnIds' => ['R1']];
        $api = new ReturnsV2Api($this->apiClient());
        $api->approveSelfShipReturns($body);

        $this->assertRequest('POST', '/v2/returns/approve');
        $this->assertJsonBody($body);
    }

    public function test_cancel_self_ship_return(): void
    {
        $body = ['returnIds' => ['R1']];
        $api = new ReturnsV2Api($this->apiClient());
        $api->cancelSelfShipReturn($body);

        $this->assertRequest('POST', '/v2/returns/cancel');
        $this->assertJsonBody($body);
    }

    public function test_get_returns(): void
    {
        $api = new ReturnsV2Api($this->apiClient());
        $api->getReturns(
            source: 'SELF',
            modifiedAfter: '2024-01-01',
            modifiedBefore: '2024-01-31',
            createdAfter: '2024-01-01',
            createdBefore: '2024-01-31',
            returnIds: 'R1',
            trackingIds: 'T1',
            locationId: 'LOC1',
        );

        $this->assertRequest('GET', '/v2/returns', [
            'source' => 'SELF',
            'modifiedAfter' => '2024-01-01',
            'modifiedBefore' => '2024-01-31',
            'createdAfter' => '2024-01-01',
            'createdBefore' => '2024-01-31',
            'returnIds' => 'R1',
            'trackingIds' => 'T1',
            'locationId' => 'LOC1',
        ]);
    }

    public function test_pickup(): void
    {
        $body = ['returnIds' => ['R1']];
        $api = new ReturnsV2Api($this->apiClient());
        $api->pickup($body);

        $this->assertRequest('POST', '/v2/returns/pickup');
        $this->assertJsonBody($body);
    }

    public function test_pickup_attempt(): void
    {
        $body = ['returnIds' => ['R1']];
        $api = new ReturnsV2Api($this->apiClient());
        $api->pickupAttempt($body);

        $this->assertRequest('POST', '/v2/returns/pickupAttempt');
        $this->assertJsonBody($body);
    }

    public function test_reject_self_ship_returns(): void
    {
        $body = ['returnIds' => ['R1']];
        $api = new ReturnsV2Api($this->apiClient());
        $api->rejectSelfShipReturns($body);

        $this->assertRequest('POST', '/v2/returns/reject');
        $this->assertJsonBody($body);
    }

    public function test_return_complete(): void
    {
        $body = ['returnIds' => ['R1']];
        $api = new ReturnsV2Api($this->apiClient());
        $api->returnComplete($body);

        $this->assertRequest('POST', '/v2/returns/complete');
        $this->assertJsonBody($body);
    }
}
