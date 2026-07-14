<?php

declare(strict_types=1);

namespace Flipkart\SellerApi;

use GuzzleHttp\Client;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\GuzzleException;
use Psr\Http\Message\ResponseInterface;

class ApiClient
{
    private string $accessToken = '';

    private string $basePath;

    private ClientInterface $httpClient;

    private bool $debugging = false;

    /**
     * @param  array<string, mixed>  $guzzleOptions
     */
    public function __construct(
        ?string $basePath = null,
        ?ClientInterface $httpClient = null,
        array $guzzleOptions = [],
    ) {
        $this->basePath = rtrim($basePath ?? UrlConfiguration::getApiBaseUrl(), '/');
        $this->httpClient = $httpClient ?? new Client(array_merge([
            'http_errors' => false,
            'timeout' => 60,
        ], $guzzleOptions));
    }

    public function setAccessToken(string $accessToken): self
    {
        $this->accessToken = $accessToken;

        return $this;
    }

    public function getAccessToken(): string
    {
        return $this->accessToken;
    }

    public function setBasePath(string $basePath): self
    {
        $this->basePath = rtrim($basePath, '/');

        return $this;
    }

    public function getBasePath(): string
    {
        return $this->basePath;
    }

    public function setDebugging(bool $debugging): self
    {
        $this->debugging = $debugging;

        return $this;
    }

    public function getHttpClient(): ClientInterface
    {
        return $this->httpClient;
    }

    /**
     * @param  array<string, mixed>  $query
     * @param  array<string, mixed>|object|string|null  $body
     * @param  array<string, string>  $headers
     * @return array<string, mixed>|string
     *
     * @throws ApiException
     */
    public function invoke(
        string $method,
        string $path,
        array $query = [],
        array|object|string|null $body = null,
        array $headers = [],
        bool $asBinary = false,
    ): array|string {
        if ($this->accessToken === '') {
            throw new ApiException('Access token is not set. Call setAccessToken() first.', 401);
        }

        $url = $this->basePath.'/'.ltrim($path, '/');
        $requestHeaders = array_merge([
            'Authorization' => 'Bearer '.$this->accessToken,
            'Accept' => 'application/json',
        ], $headers);

        $options = [
            'headers' => $requestHeaders,
            'query' => $this->normalizeQuery($query),
        ];

        if ($body !== null) {
            if (is_string($body)) {
                $options['body'] = $body;
                $options['headers']['Content-Type'] ??= 'application/json';
            } else {
                $options['json'] = $body;
            }
        }

        try {
            $response = $this->httpClient->request(strtoupper($method), $url, $options);
        } catch (GuzzleException $e) {
            throw new ApiException('HTTP request failed: '.$e->getMessage(), 0, previous: $e);
        }

        return $this->handleResponse($response, $asBinary);
    }

    /**
     * @param  array<string, mixed>  $query
     * @return array<string, mixed>
     */
    private function normalizeQuery(array $query): array
    {
        $out = [];
        foreach ($query as $key => $value) {
            if ($value === null) {
                continue;
            }
            if (is_bool($value)) {
                $out[$key] = $value ? 'true' : 'false';
            } elseif (is_array($value)) {
                $out[$key] = implode(',', array_map('strval', $value));
            } else {
                $out[$key] = $value;
            }
        }

        return $out;
    }

    /**
     * @return array<string, mixed>|string
     *
     * @throws ApiException
     */
    private function handleResponse(ResponseInterface $response, bool $asBinary): array|string
    {
        $status = $response->getStatusCode();
        $raw = (string) $response->getBody();
        $headers = $response->getHeaders();

        if ($this->debugging) {
            error_log(sprintf('[Flipkart\\SellerApi] %d %s', $status, substr($raw, 0, 500)));
        }

        if ($status >= 400) {
            throw new ApiException(
                $raw !== '' ? $raw : 'API request failed',
                $status,
                $headers,
                $raw,
            );
        }

        if ($asBinary || $raw === '') {
            return $raw;
        }

        $contentType = $response->getHeaderLine('Content-Type');
        if (str_contains($contentType, 'application/json') || (str_starts_with(ltrim($raw), '{') || str_starts_with(ltrim($raw), '['))) {
            $decoded = json_decode($raw, true);
            if (json_last_error() === JSON_ERROR_NONE && is_array($decoded)) {
                return $decoded;
            }
        }

        return $raw;
    }
}
