<?php

declare(strict_types=1);

namespace Flipkart\SellerApi;

use GuzzleHttp\Client;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\GuzzleException;

final class AccessTokenGenerator
{
    private string $clientId = '';

    private string $clientSecret = '';

    public function __construct(
        private readonly ?ClientInterface $httpClient = null,
    ) {}

    public function clientCredentials(string $clientId, string $clientSecret): self
    {
        $this->clientId = $clientId;
        $this->clientSecret = $clientSecret;

        return $this;
    }

    /**
     * @throws ApiException
     */
    public function getAccessToken(): string
    {
        if ($this->clientId === '' || $this->clientSecret === '') {
            throw new ApiException('Client ID and client secret are required.', 400);
        }

        $client = $this->httpClient ?? new Client(['http_errors' => false]);
        $url = UrlConfiguration::getAccessTokenUrl();

        try {
            $response = $client->request('GET', $url, [
                'headers' => [
                    'Authorization' => 'Basic '.base64_encode($this->clientId.':'.$this->clientSecret),
                    'Accept' => 'application/json',
                ],
            ]);
        } catch (GuzzleException $e) {
            throw new ApiException('Failed to request access token: '.$e->getMessage(), 0, previous: $e);
        }

        $status = $response->getStatusCode();
        $raw = (string) $response->getBody();
        $json = json_decode($raw, true);

        if ($status >= 400) {
            throw new ApiException(
                is_array($json) ? (string) json_encode($json) : $raw,
                $status,
                $response->getHeaders(),
                $raw,
            );
        }

        if (! is_array($json) || ! isset($json['access_token']) || ! is_string($json['access_token'])) {
            throw new ApiException('Access token missing from OAuth response.', $status, $response->getHeaders(), $raw);
        }

        return $json['access_token'];
    }
}
