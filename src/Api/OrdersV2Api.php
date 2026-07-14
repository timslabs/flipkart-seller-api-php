<?php

declare(strict_types=1);

namespace Flipkart\SellerApi\Api;

use Flipkart\SellerApi\ApiClient;
use Flipkart\SellerApi\ApiException;

class OrdersV2Api
{
    public function __construct(
        private readonly ApiClient $client,
    ) {}

    public function getClient(): ApiClient
    {
        return $this->client;
    }

    /**
     * cancelOrders
     *
     * @param  array  $body
     * @return array|string
     *
     * @throws ApiException
     */
    public function cancelOrders(array $body): array|string
    {
        $path = '/v2/orders/cancel';
        $query = [];
        $body = $body;
        return $this->client->invoke('POST', $path, $query, $body);
    }

    /**
     * getBulkActionProgressByRequestId
     *
     * @param  string  $requestId
     * @return array|string
     *
     * @throws ApiException
     */
    public function getBulkActionProgressByRequestId(string $requestId): array|string
    {
        $path = '/v2/orders/labelRequest/{requestId}';
        $path = str_replace('{requestId}', rawurlencode((string) $requestId), $path);
        $query = [];
        $body = null;
        return $this->client->invoke('GET', $path, $query, $body);
    }

    /**
     * getInvoicesInfo
     *
     * @param  ?string  $orderItemIds
     * @return array|string
     *
     * @throws ApiException
     */
    public function getInvoicesInfo(?string $orderItemIds = null): array|string
    {
        $path = '/v2/orders/invoices';
        $query = [];
        if ($orderItemIds !== null) {
            $query['orderItemIds'] = $orderItemIds;
        }
        $body = null;
        return $this->client->invoke('GET', $path, $query, $body);
    }

    /**
     * getLabels
     *
     * @param  ?string  $orderItemIds
     * @return array|string
     *
     * @throws ApiException
     */
    public function getLabels(?string $orderItemIds = null): array|string
    {
        $path = '/v2/orders/labels';
        $query = [];
        if ($orderItemIds !== null) {
            $query['orderItemIds'] = $orderItemIds;
        }
        $body = null;
        return $this->client->invoke('GET', $path, $query, $body);
    }

    /**
     * getManifestPdfForRequest
     *
     * @return array|string
     *
     * @throws ApiException
     */
    public function getManifestPdfForRequest(): array|string
    {
        $path = '/v2/orders/manifest';
        $query = [];
        $body = null;
        return $this->client->invoke('GET', $path, $query, $body);
    }

    /**
     * getOrderItemById
     *
     * @param  string  $orderItemId
     * @return array|string
     *
     * @throws ApiException
     */
    public function getOrderItemById(string $orderItemId): array|string
    {
        $path = '/v2/orders/{order_item_id}';
        $path = str_replace('{order_item_id}', rawurlencode((string) $orderItemId), $path);
        $query = [];
        $body = null;
        return $this->client->invoke('GET', $path, $query, $body);
    }

    /**
     * getOrderItemsByIds
     *
     * @param  ?string  $orderItemIds
     * @return array|string
     *
     * @throws ApiException
     */
    public function getOrderItemsByIds(?string $orderItemIds = null): array|string
    {
        $path = '/v2/orders';
        $query = [];
        if ($orderItemIds !== null) {
            $query['orderItemIds'] = $orderItemIds;
        }
        $body = null;
        return $this->client->invoke('GET', $path, $query, $body);
    }

    /**
     * getShipments
     *
     * @param  ?string  $orderItemIds
     * @return array|string
     *
     * @throws ApiException
     */
    public function getShipments(?string $orderItemIds = null): array|string
    {
        $path = '/v2/orders/shipments';
        $query = [];
        if ($orderItemIds !== null) {
            $query['orderItemIds'] = $orderItemIds;
        }
        $body = null;
        return $this->client->invoke('GET', $path, $query, $body);
    }

    /**
     * searchOrderItemRequest
     *
     * @param  array  $body
     * @return array|string
     *
     * @throws ApiException
     */
    public function searchOrderItemRequest(array $body): array|string
    {
        $path = '/v2/orders/search';
        $query = [];
        $body = $body;
        return $this->client->invoke('POST', $path, $query, $body);
    }

    /**
     * submitBulkConfirmRequest
     *
     * @param  array  $body
     * @return array|string
     *
     * @throws ApiException
     */
    public function submitBulkConfirmRequest(array $body): array|string
    {
        $path = '/v2/orders/labels';
        $query = [];
        $body = $body;
        return $this->client->invoke('POST', $path, $query, $body);
    }

    /**
     * submitBulkRtdRequest
     *
     * @param  array  $body
     * @return array|string
     *
     * @throws ApiException
     */
    public function submitBulkRtdRequest(array $body): array|string
    {
        $path = '/v2/orders/dispatch';
        $query = [];
        $body = $body;
        return $this->client->invoke('POST', $path, $query, $body);
    }

    /**
     * submitSelfShipDeliverAttemptRequest
     *
     * @param  array  $body
     * @return array|string
     *
     * @throws ApiException
     */
    public function submitSelfShipDeliverAttemptRequest(array $body): array|string
    {
        $path = '/v2/shipments/deliveryAttempt';
        $query = [];
        $body = $body;
        return $this->client->invoke('POST', $path, $query, $body);
    }

    /**
     * submitSelfShipDeliverRequest
     *
     * @param  array  $body
     * @return array|string
     *
     * @throws ApiException
     */
    public function submitSelfShipDeliverRequest(array $body): array|string
    {
        $path = '/v2/shipments/delivery';
        $query = [];
        $body = $body;
        return $this->client->invoke('POST', $path, $query, $body);
    }

    /**
     * submitSelfShipmentDispatchRequest
     *
     * @param  array  $body
     * @return array|string
     *
     * @throws ApiException
     */
    public function submitSelfShipmentDispatchRequest(array $body): array|string
    {
        $path = '/v2/shipments/dispatch';
        $query = [];
        $body = $body;
        return $this->client->invoke('POST', $path, $query, $body);
    }

    /**
     * submitServiceAttemptRequest
     *
     * @param  array  $body
     * @return array|string
     *
     * @throws ApiException
     */
    public function submitServiceAttemptRequest(array $body): array|string
    {
        $path = '/v2/services/attempt';
        $query = [];
        $body = $body;
        return $this->client->invoke('POST', $path, $query, $body);
    }

    /**
     * submitServiceCompleteRequest
     *
     * @param  array  $body
     * @return array|string
     *
     * @throws ApiException
     */
    public function submitServiceCompleteRequest(array $body): array|string
    {
        $path = '/v2/services/complete';
        $query = [];
        $body = $body;
        return $this->client->invoke('POST', $path, $query, $body);
    }
}
