<?php

declare(strict_types=1);

namespace Flipkart\SellerApi;

use Flipkart\SellerApi\Api\ListingsCommonV3Api;
use Flipkart\SellerApi\Api\ListingsFlipkartV3Api;
use Flipkart\SellerApi\Api\ListingsHyperlocalV3Api;
use Flipkart\SellerApi\Api\OrdersV2Api;
use Flipkart\SellerApi\Api\ReturnsV2Api;
use Flipkart\SellerApi\Api\SelfServeApi;
use Flipkart\SellerApi\Api\ShipmentV3Api;

final class FlipkartSellerClient
{
    public function __construct(
        private readonly ApiClient $apiClient,
    ) {}

    public static function fromCredentials(
        string|Environment $environment,
        string $clientId,
        string $clientSecret,
        ?string $redirectUrl = null,
        ?string $state = null,
        ?string $authCode = null,
    ): self {
        new UrlConfiguration($environment, $redirectUrl, $state, $authCode);

        $token = (new AccessTokenGenerator)
            ->clientCredentials($clientId, $clientSecret)
            ->getAccessToken();

        $client = new ApiClient;
        $client->setAccessToken($token);

        return new self($client);
    }

    public function apiClient(): ApiClient
    {
        return $this->apiClient;
    }

    public function listingsCommonV3(): ListingsCommonV3Api
    {
        return new ListingsCommonV3Api($this->apiClient);
    }

    public function listingsFlipkartV3(): ListingsFlipkartV3Api
    {
        return new ListingsFlipkartV3Api($this->apiClient);
    }

    public function listingsHyperlocalV3(): ListingsHyperlocalV3Api
    {
        return new ListingsHyperlocalV3Api($this->apiClient);
    }

    public function ordersV2(): OrdersV2Api
    {
        return new OrdersV2Api($this->apiClient);
    }

    public function returnsV2(): ReturnsV2Api
    {
        return new ReturnsV2Api($this->apiClient);
    }

    public function shipmentV3(): ShipmentV3Api
    {
        return new ShipmentV3Api($this->apiClient);
    }

    public function selfServe(): SelfServeApi
    {
        return new SelfServeApi($this->apiClient);
    }
}
