<?php

declare(strict_types=1);

namespace Flipkart\SellerApi\Api;

use Flipkart\SellerApi\ApiClient;
use Flipkart\SellerApi\ApiException;

class ShipmentV3Api
{
    public function __construct(
        private readonly ApiClient $client,
    ) {}

    public function getClient(): ApiClient
    {
        return $this->client;
    }

    /**
     * cancelByEnforcedGroupIds
     *
     * @param  array  $body
     * @return array|string
     *
     * @throws ApiException
     */
    public function cancelByEnforcedGroupIds(array $body): array|string
    {
        $path = '/v3/shipments/cancel';
        $query = [];
        $body = $body;
        return $this->client->invoke('POST', $path, $query, $body);
    }

    /**
     * getInvoicesPdfFromEsi
     *
     * @param  string  $shipmentIds
     * @return array|string
     *
     * @throws ApiException
     */
    public function getInvoicesPdfFromEsi(string $shipmentIds): array|string
    {
        $path = '/v3/shipments/{shipmentIds}/invoices';
        $path = str_replace('{shipmentIds}', rawurlencode((string) $shipmentIds), $path);
        $query = [];
        $body = null;
        return $this->client->invoke('GET', $path, $query, $body);
    }

    /**
     * getLabels
     *
     * @param  string  $shipmentIds
     * @return array|string
     *
     * @throws ApiException
     */
    public function getLabels(string $shipmentIds): array|string
    {
        $path = '/v3/shipments/{shipmentIds}/labels';
        $path = str_replace('{shipmentIds}', rawurlencode((string) $shipmentIds), $path);
        $query = [];
        $body = null;
        return $this->client->invoke('GET', $path, $query, $body);
    }

    /**
     * getLabelsOnly
     *
     * @param  string  $shipmentIds
     * @param  bool  $reprint
     * @return array|string
     *
     * @throws ApiException
     */
    public function getLabelsOnly(string $shipmentIds, ?bool $reprint = null): array|string
    {
        $path = '/v3/shipments/{shipmentIds}/labelOnly';
        $path = str_replace('{shipmentIds}', rawurlencode((string) $shipmentIds), $path);
        $query = [];
        if ($reprint !== null) {
            $query['reprint'] = $reprint;
        }
        $body = null;
        return $this->client->invoke('POST', $path, $query, $body);
    }

    /**
     * getLabelsOnlyPDF
     *
     * @param  string  $shipmentIds
     * @param  bool  $reprint
     * @return array|string
     *
     * @throws ApiException
     */
    public function getLabelsOnlyPDF(string $shipmentIds, ?bool $reprint = null): array|string
    {
        $path = '/v3/shipments/{shipmentIds}/labelOnly/pdf';
        $path = str_replace('{shipmentIds}', rawurlencode((string) $shipmentIds), $path);
        $query = [];
        if ($reprint !== null) {
            $query['reprint'] = $reprint;
        }
        $body = null;
        return $this->client->invoke('POST', $path, $query, $body);
    }

    /**
     * getManifest
     *
     * @param  array  $body
     * @return array|string
     *
     * @throws ApiException
     */
    public function getManifest(array $body): array|string
    {
        $path = '/v3/shipments/manifest';
        $query = [];
        $body = $body;
        return $this->client->invoke('POST', $path, $query, $body);
    }

    /**
     * getShipmentDetails
     *
     * @param  string  $shipmentIds
     * @return array|string
     *
     * @throws ApiException
     */
    public function getShipmentDetails(string $shipmentIds): array|string
    {
        $path = '/v3/shipments/{shipmentIds}';
        $path = str_replace('{shipmentIds}', rawurlencode((string) $shipmentIds), $path);
        $query = [];
        $body = null;
        return $this->client->invoke('GET', $path, $query, $body);
    }

    /**
     * getShipmentDetailsByInternalId
     *
     * @param  ?string  $shipmentIds
     * @param  ?string  $orderItemIds
     * @param  ?string  $orderIds
     * @return array|string
     *
     * @throws ApiException
     */
    public function getShipmentDetailsByInternalId(?string $shipmentIds = null, ?string $orderItemIds = null, ?string $orderIds = null): array|string
    {
        $path = '/v3/shipments';
        $query = [];
        if ($shipmentIds !== null) {
            $query['shipmentIds'] = $shipmentIds;
        }
        if ($orderItemIds !== null) {
            $query['orderItemIds'] = $orderItemIds;
        }
        if ($orderIds !== null) {
            $query['orderIds'] = $orderIds;
        }
        $body = null;
        return $this->client->invoke('GET', $path, $query, $body);
    }

    /**
     * getVendorGroupDetails
     *
     * @param  ?string  $locationId
     * @return array|string
     *
     * @throws ApiException
     */
    public function getVendorGroupDetails(?string $locationId = null): array|string
    {
        $path = '/v3/shipments/handover/counts';
        $query = [];
        if ($locationId !== null) {
            $query['locationId'] = $locationId;
        }
        $body = null;
        return $this->client->invoke('GET', $path, $query, $body);
    }

    /**
     * markRTD
     *
     * @param  array  $body
     * @return array|string
     *
     * @throws ApiException
     */
    public function markRTD(array $body): array|string
    {
        $path = '/v3/shipments/dispatch';
        $query = [];
        $body = $body;
        return $this->client->invoke('POST', $path, $query, $body);
    }

    /**
     * pack
     *
     * @param  array  $body
     * @return array|string
     *
     * @throws ApiException
     */
    public function pack(array $body): array|string
    {
        $path = '/v3/shipments/labels';
        $query = [];
        $body = $body;
        return $this->client->invoke('POST', $path, $query, $body);
    }

    /**
     * searchPreDispatchShipmentGet
     *
     * @param  ?string  $nextToken
     * @return array|string
     *
     * @throws ApiException
     */
    public function searchPreDispatchShipmentGet(?string $nextToken = null): array|string
    {
        $path = '/v3/shipments/filter';
        $query = [];
        if ($nextToken !== null) {
            $query['next_token'] = $nextToken;
        }
        $body = null;
        return $this->client->invoke('GET', $path, $query, $body);
    }

    /**
     * searchPreDispatchShipmentPost
     *
     * @param  array  $body
     * @return array|string
     *
     * @throws ApiException
     */
    public function searchPreDispatchShipmentPost(array $body): array|string
    {
        $path = '/v3/shipments/filter';
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
        $path = '/v3/shipments/selfShip/deliveryAttempt';
        $query = [];
        $body = $body;
        return $this->client->invoke('POST', $path, $query, $body);
    }

    /**
     * submitSelfShipDeliveryRequest
     *
     * @param  array  $body
     * @return array|string
     *
     * @throws ApiException
     */
    public function submitSelfShipDeliveryRequest(array $body): array|string
    {
        $path = '/v3/shipments/selfShip/delivery';
        $query = [];
        $body = $body;
        return $this->client->invoke('POST', $path, $query, $body);
    }

    /**
     * submitSelfShiptDispatchRequest
     *
     * @param  array  $body
     * @return array|string
     *
     * @throws ApiException
     */
    public function submitSelfShiptDispatchRequest(array $body): array|string
    {
        $path = '/v3/shipments/selfShip/dispatch';
        $query = [];
        $body = $body;
        return $this->client->invoke('POST', $path, $query, $body);
    }

    /**
     * updateTrackingInfo
     *
     * @param  string  $shipmentId
     * @param  array  $body
     * @return array|string
     *
     * @throws ApiException
     */
    public function updateTrackingInfo(string $shipmentId, array $body): array|string
    {
        $path = '/v3/shipments/{shipmentId}/update';
        $path = str_replace('{shipmentId}', rawurlencode((string) $shipmentId), $path);
        $query = [];
        $body = $body;
        return $this->client->invoke('POST', $path, $query, $body);
    }
}
