<?php

declare(strict_types=1);

namespace Flipkart\SellerApi\Api;

use Flipkart\SellerApi\ApiClient;
use Flipkart\SellerApi\ApiException;

class ListingsCommonV3Api
{
    public function __construct(
        private readonly ApiClient $client,
    ) {}

    public function getClient(): ApiClient
    {
        return $this->client;
    }

    /**
     * getListings
     *
     * @param  string  $skuIds
     * @return array|string
     *
     * @throws ApiException
     */
    public function getListings(string $skuIds): array|string
    {
        $path = '/listings/v3/{skuIds}';
        $path = str_replace('{skuIds}', rawurlencode((string) $skuIds), $path);
        $query = [];
        $body = null;
        return $this->client->invoke('GET', $path, $query, $body);
    }

    /**
     * updateInventory
     *
     * @param  array  $body
     * @return array|string
     *
     * @throws ApiException
     */
    public function updateInventory(array $body): array|string
    {
        $path = '/listings/v3/update/inventory';
        $query = [];
        $body = $body;
        return $this->client->invoke('POST', $path, $query, $body);
    }

    /**
     * updatePrice
     *
     * @param  array  $body
     * @return array|string
     *
     * @throws ApiException
     */
    public function updatePrice(array $body): array|string
    {
        $path = '/listings/v3/update/price';
        $query = [];
        $body = $body;
        return $this->client->invoke('POST', $path, $query, $body);
    }
}
