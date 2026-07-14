<?php

declare(strict_types=1);

namespace Flipkart\SellerApi\Api;

use Flipkart\SellerApi\ApiClient;
use Flipkart\SellerApi\ApiException;

class ListingsHyperlocalV3Api
{
    public function __construct(
        private readonly ApiClient $client,
    ) {}

    public function getClient(): ApiClient
    {
        return $this->client;
    }

    /**
     * createListings
     *
     * @param  array  $body
     * @return array|string
     *
     * @throws ApiException
     */
    public function createListings(array $body): array|string
    {
        $path = '/listings/v3/hyperlocal';
        $query = [];
        $body = $body;
        return $this->client->invoke('POST', $path, $query, $body);
    }

    /**
     * updateListings
     *
     * @param  array  $body
     * @return array|string
     *
     * @throws ApiException
     */
    public function updateListings(array $body): array|string
    {
        $path = '/listings/v3/hyperlocal/update';
        $query = [];
        $body = $body;
        return $this->client->invoke('POST', $path, $query, $body);
    }
}
