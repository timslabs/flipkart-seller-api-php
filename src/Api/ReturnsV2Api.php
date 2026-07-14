<?php

declare(strict_types=1);

namespace Flipkart\SellerApi\Api;

use Flipkart\SellerApi\ApiClient;
use Flipkart\SellerApi\ApiException;

class ReturnsV2Api
{
    public function __construct(
        private readonly ApiClient $client,
    ) {}

    public function getClient(): ApiClient
    {
        return $this->client;
    }

    /**
     * approveSelfShipReturns
     *
     * @param  array  $body
     * @return array|string
     *
     * @throws ApiException
     */
    public function approveSelfShipReturns(array $body): array|string
    {
        $path = '/v2/returns/approve';
        $query = [];
        $body = $body;
        return $this->client->invoke('POST', $path, $query, $body);
    }

    /**
     * cancelSelfShipReturn
     *
     * @param  array  $body
     * @return array|string
     *
     * @throws ApiException
     */
    public function cancelSelfShipReturn(array $body): array|string
    {
        $path = '/v2/returns/cancel';
        $query = [];
        $body = $body;
        return $this->client->invoke('POST', $path, $query, $body);
    }

    /**
     * getReturns
     *
     * @param  ?string  $source
     * @param  ?string  $modifiedAfter
     * @param  ?string  $modifiedBefore
     * @param  ?string  $createdAfter
     * @param  ?string  $createdBefore
     * @param  ?string  $returnIds
     * @param  ?string  $trackingIds
     * @param  ?string  $locationId
     * @return array|string
     *
     * @throws ApiException
     */
    public function getReturns(?string $source = null, ?string $modifiedAfter = null, ?string $modifiedBefore = null, ?string $createdAfter = null, ?string $createdBefore = null, ?string $returnIds = null, ?string $trackingIds = null, ?string $locationId = null): array|string
    {
        $path = '/v2/returns';
        $query = [];
        if ($source !== null) {
            $query['source'] = $source;
        }
        if ($modifiedAfter !== null) {
            $query['modifiedAfter'] = $modifiedAfter;
        }
        if ($modifiedBefore !== null) {
            $query['modifiedBefore'] = $modifiedBefore;
        }
        if ($createdAfter !== null) {
            $query['createdAfter'] = $createdAfter;
        }
        if ($createdBefore !== null) {
            $query['createdBefore'] = $createdBefore;
        }
        if ($returnIds !== null) {
            $query['returnIds'] = $returnIds;
        }
        if ($trackingIds !== null) {
            $query['trackingIds'] = $trackingIds;
        }
        if ($locationId !== null) {
            $query['locationId'] = $locationId;
        }
        $body = null;
        return $this->client->invoke('GET', $path, $query, $body);
    }

    /**
     * pickup
     *
     * @param  array  $body
     * @return array|string
     *
     * @throws ApiException
     */
    public function pickup(array $body): array|string
    {
        $path = '/v2/returns/pickup';
        $query = [];
        $body = $body;
        return $this->client->invoke('POST', $path, $query, $body);
    }

    /**
     * pickupAttempt
     *
     * @param  array  $body
     * @return array|string
     *
     * @throws ApiException
     */
    public function pickupAttempt(array $body): array|string
    {
        $path = '/v2/returns/pickupAttempt';
        $query = [];
        $body = $body;
        return $this->client->invoke('POST', $path, $query, $body);
    }

    /**
     * rejectSelfShipReturns
     *
     * @param  array  $body
     * @return array|string
     *
     * @throws ApiException
     */
    public function rejectSelfShipReturns(array $body): array|string
    {
        $path = '/v2/returns/reject';
        $query = [];
        $body = $body;
        return $this->client->invoke('POST', $path, $query, $body);
    }

    /**
     * returnComplete
     *
     * @param  array  $body
     * @return array|string
     *
     * @throws ApiException
     */
    public function returnComplete(array $body): array|string
    {
        $path = '/v2/returns/complete';
        $query = [];
        $body = $body;
        return $this->client->invoke('POST', $path, $query, $body);
    }
}
