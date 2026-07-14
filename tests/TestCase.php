<?php

declare(strict_types=1);

namespace Flipkart\SellerApi\Tests;

use Flipkart\SellerApi\ApiClient;
use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Middleware;
use GuzzleHttp\Psr7\Response;
use PHPUnit\Framework\TestCase as BaseTestCase;
use Psr\Http\Message\RequestInterface;

abstract class TestCase extends BaseTestCase
{
    /** @var list<array{request: RequestInterface, response: mixed}> */
    protected array $history = [];

    protected function apiClient(Response ...$responses): ApiClient
    {
        $this->history = [];
        $mock = new MockHandler($responses !== [] ? $responses : [
            new Response(200, ['Content-Type' => 'application/json'], '{"ok":true}'),
        ]);
        $stack = HandlerStack::create($mock);
        $stack->push(Middleware::history($this->history));

        $client = new ApiClient(
            basePath: 'https://sandbox-api.flipkart.net/sellers',
            httpClient: new Client(['handler' => $stack, 'http_errors' => false]),
        );
        $client->setAccessToken('test-token');

        return $client;
    }

    protected function lastRequest(): RequestInterface
    {
        $this->assertNotEmpty($this->history);

        return $this->history[array_key_last($this->history)]['request'];
    }

    /**
     * @param  array<string, string>  $query
     */
    protected function assertRequest(string $method, string $path, array $query = []): void
    {
        $request = $this->lastRequest();
        $this->assertSame($method, $request->getMethod());
        $this->assertSame('/sellers'.$path, $request->getUri()->getPath());
        $this->assertSame('Bearer test-token', $request->getHeaderLine('Authorization'));

        parse_str($request->getUri()->getQuery(), $actualQuery);
        $this->assertSame($query, $actualQuery);
    }

    /**
     * @param  array<string, mixed>  $body
     */
    protected function assertJsonBody(array $body): void
    {
        $request = $this->lastRequest();
        $this->assertSame($body, json_decode((string) $request->getBody(), true));
    }
}
