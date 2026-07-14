<?php

declare(strict_types=1);

namespace Flipkart\SellerApi\Tests;

use Flipkart\SellerApi\AccessTokenGenerator;
use Flipkart\SellerApi\ApiException;
use Flipkart\SellerApi\Environment;
use Flipkart\SellerApi\UrlConfiguration;
use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Middleware;
use GuzzleHttp\Psr7\Response;

final class AccessTokenGeneratorTest extends TestCase
{
    public function test_requires_credentials(): void
    {
        new UrlConfiguration(Environment::Sandbox);
        $generator = new AccessTokenGenerator;

        $this->expectException(ApiException::class);
        $this->expectExceptionMessage('Client ID and client secret are required');

        $generator->getAccessToken();
    }

    public function test_client_credentials_token_request(): void
    {
        new UrlConfiguration(Environment::Sandbox);

        $history = [];
        $mock = new MockHandler([
            new Response(200, ['Content-Type' => 'application/json'], '{"access_token":"atk-1","token_type":"bearer"}'),
        ]);
        $stack = HandlerStack::create($mock);
        $stack->push(Middleware::history($history));

        $token = (new AccessTokenGenerator(new Client(['handler' => $stack, 'http_errors' => false])))
            ->clientCredentials('cid', 'csecret')
            ->getAccessToken();

        $this->assertSame('atk-1', $token);
        $this->assertCount(1, $history);
        $request = $history[0]['request'];
        $this->assertSame('GET', $request->getMethod());
        $this->assertStringContainsString('grant_type=client_credentials', (string) $request->getUri());
        $this->assertSame('Basic '.base64_encode('cid:csecret'), $request->getHeaderLine('Authorization'));
    }

    public function test_missing_access_token_in_response(): void
    {
        new UrlConfiguration(Environment::Sandbox);

        $mock = new MockHandler([
            new Response(200, ['Content-Type' => 'application/json'], '{"token_type":"bearer"}'),
        ]);

        $generator = (new AccessTokenGenerator(new Client([
            'handler' => HandlerStack::create($mock),
            'http_errors' => false,
        ])))->clientCredentials('cid', 'csecret');

        $this->expectException(ApiException::class);
        $this->expectExceptionMessage('Access token missing');

        $generator->getAccessToken();
    }

    public function test_http_error_response(): void
    {
        new UrlConfiguration(Environment::Sandbox);

        $mock = new MockHandler([
            new Response(400, ['Content-Type' => 'application/json'], '{"error":"invalid_client"}'),
        ]);

        $generator = (new AccessTokenGenerator(new Client([
            'handler' => HandlerStack::create($mock),
            'http_errors' => false,
        ])))->clientCredentials('cid', 'csecret');

        $this->expectException(ApiException::class);

        $generator->getAccessToken();
    }
}
