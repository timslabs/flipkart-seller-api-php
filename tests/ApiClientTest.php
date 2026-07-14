<?php

declare(strict_types=1);

namespace Flipkart\SellerApi\Tests;

use Flipkart\SellerApi\ApiClient;
use Flipkart\SellerApi\ApiException;
use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;

final class ApiClientTest extends TestCase
{
    public function test_invoke_requires_access_token(): void
    {
        $client = new ApiClient(basePath: 'https://sandbox-api.flipkart.net/sellers');

        $this->expectException(ApiException::class);
        $this->expectExceptionMessage('Access token is not set');

        $client->invoke('GET', '/v2/orders');
    }

    public function test_invoke_throws_on_http_error(): void
    {
        $mock = new MockHandler([
            new Response(401, ['Content-Type' => 'application/json'], '{"error":"unauthorized"}'),
        ]);
        $client = new ApiClient(
            basePath: 'https://sandbox-api.flipkart.net/sellers',
            httpClient: new Client(['handler' => HandlerStack::create($mock), 'http_errors' => false]),
        );
        $client->setAccessToken('bad-token');

        try {
            $client->invoke('GET', '/v2/orders');
            $this->fail('Expected ApiException');
        } catch (ApiException $e) {
            $this->assertSame(401, $e->getStatusCode());
            $this->assertStringContainsString('unauthorized', $e->getMessage());
        }
    }

    public function test_invoke_returns_raw_string_for_non_json(): void
    {
        $mock = new MockHandler([
            new Response(200, ['Content-Type' => 'application/pdf'], '%PDF-1.4'),
        ]);
        $client = new ApiClient(
            basePath: 'https://sandbox-api.flipkart.net/sellers',
            httpClient: new Client(['handler' => HandlerStack::create($mock), 'http_errors' => false]),
        );
        $client->setAccessToken('test-token');

        $result = $client->invoke('GET', '/v2/orders/labels');

        $this->assertSame('%PDF-1.4', $result);
    }

    public function test_invoke_as_binary_returns_raw_body(): void
    {
        $mock = new MockHandler([
            new Response(200, ['Content-Type' => 'application/json'], '{"ok":true}'),
        ]);
        $client = new ApiClient(
            basePath: 'https://sandbox-api.flipkart.net/sellers',
            httpClient: new Client(['handler' => HandlerStack::create($mock), 'http_errors' => false]),
        );
        $client->setAccessToken('test-token');

        $result = $client->invoke('GET', '/v2/orders', asBinary: true);

        $this->assertSame('{"ok":true}', $result);
    }

    public function test_setters(): void
    {
        $client = new ApiClient(basePath: 'https://example.test/sellers');
        $client->setAccessToken('tok');
        $client->setBasePath('https://other.test/sellers/');
        $client->setDebugging(true);

        $this->assertSame('tok', $client->getAccessToken());
        $this->assertSame('https://other.test/sellers', $client->getBasePath());
        $this->assertInstanceOf(Client::class, $client->getHttpClient());
    }
}
