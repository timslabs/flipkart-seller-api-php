<?php

declare(strict_types=1);

namespace Flipkart\SellerApi\Api;

use Flipkart\SellerApi\ApiClient;
use Flipkart\SellerApi\ApiException;

class SelfServeApi
{
    public function __construct(
        private readonly ApiClient $client,
    ) {}

    public function getClient(): ApiClient
    {
        return $this->client;
    }

    /**
     * changeDispatchSlots
     *
     * @param  array  $body
     * @return array|string
     *
     * @throws ApiException
     */
    public function changeDispatchSlots(array $body): array|string
    {
        $path = '/orders/sandbox/update_dispatch_slot';
        $query = [];
        $body = $body;
        return $this->client->invoke('POST', $path, $query, $body);
    }

    /**
     * createReturn
     *
     * @param  array  $body
     * @return array|string
     *
     * @throws ApiException
     */
    public function createReturn(array $body): array|string
    {
        $path = '/returns/sandbox/create_returns';
        $query = [];
        $body = $body;
        return $this->client->invoke('POST', $path, $query, $body);
    }

    /**
     * createService
     *
     * @param  array  $body
     * @return array|string
     *
     * @throws ApiException
     */
    public function createService(array $body): array|string
    {
        $path = '/v2/shipments/sandbox/create_service/';
        $query = [];
        $body = $body;
        return $this->client->invoke('POST', $path, $query, $body);
    }

    /**
     * createTestOrders
     *
     * @param  array  $body
     * @return array|string
     *
     * @throws ApiException
     */
    public function createTestOrders(array $body): array|string
    {
        $path = '/orders/sandbox/test_orders';
        $query = [];
        $body = $body;
        return $this->client->invoke('POST', $path, $query, $body);
    }

    /**
     * makeOrderUnHold
     *
     * @param  array  $body
     * @return array|string
     *
     * @throws ApiException
     */
    public function makeOrderUnHold(array $body): array|string
    {
        $path = '/orders/sandbox/un_hold';
        $query = [];
        $body = $body;
        return $this->client->invoke('PUT', $path, $query, $body);
    }

    /**
     * markOrderItemDelivered
     *
     * @param  array  $body
     * @return array|string
     *
     * @throws ApiException
     */
    public function markOrderItemDelivered(array $body): array|string
    {
        $path = '/orders/sandbox/delivered';
        $query = [];
        $body = $body;
        return $this->client->invoke('POST', $path, $query, $body);
    }

    /**
     * markOrderItemPickupComplete
     *
     * @param  array  $body
     * @return array|string
     *
     * @throws ApiException
     */
    public function markOrderItemPickupComplete(array $body): array|string
    {
        $path = '/orders/sandbox/pick_up_complete';
        $query = [];
        $body = $body;
        return $this->client->invoke('POST', $path, $query, $body);
    }

    /**
     * markOrderItemShipped
     *
     * @param  array  $body
     * @return array|string
     *
     * @throws ApiException
     */
    public function markOrderItemShipped(array $body): array|string
    {
        $path = '/orders/sandbox/shipped';
        $query = [];
        $body = $body;
        return $this->client->invoke('POST', $path, $query, $body);
    }

    /**
     * processReturnEvents
     *
     * @param  array  $body
     * @return array|string
     *
     * @throws ApiException
     */
    public function processReturnEvents(array $body): array|string
    {
        $path = '/returns/sandbox/return_events';
        $query = [];
        $body = $body;
        return $this->client->invoke('POST', $path, $query, $body);
    }

    /**
     * putOrderOnHold
     *
     * @param  array  $body
     * @return array|string
     *
     * @throws ApiException
     */
    public function putOrderOnHold(array $body): array|string
    {
        $path = '/orders/sandbox/on_hold';
        $query = [];
        $body = $body;
        return $this->client->invoke('PUT', $path, $query, $body);
    }
}
