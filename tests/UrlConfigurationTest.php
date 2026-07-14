<?php

declare(strict_types=1);

namespace Flipkart\SellerApi\Tests;

use Flipkart\SellerApi\Constants;
use Flipkart\SellerApi\Environment;
use Flipkart\SellerApi\UrlConfiguration;
use InvalidArgumentException;

final class UrlConfigurationTest extends TestCase
{
    public function test_sandbox_self_access_urls(): void
    {
        new UrlConfiguration(Environment::Sandbox);

        $this->assertSame(Constants::SANDBOX_GET_ACCESS_TOKEN, UrlConfiguration::getAccessTokenUrl());
        $this->assertSame(Constants::SANDBOX_API_CLIENT, UrlConfiguration::getApiBaseUrl());
    }

    public function test_prod_self_access_urls(): void
    {
        new UrlConfiguration(Environment::Prod);

        $this->assertSame(Constants::PROD_GET_ACCESS_TOKEN, UrlConfiguration::getAccessTokenUrl());
        $this->assertSame(Constants::PROD_GET_API_CLIENT, UrlConfiguration::getApiBaseUrl());
    }

    public function test_third_party_sandbox_token_url_includes_code(): void
    {
        new UrlConfiguration(Environment::Sandbox, 'https://app.test/cb', 'state-1', 'auth-code');

        $url = UrlConfiguration::getAccessTokenUrl();

        $this->assertStringContainsString('redirect_uri=https://app.test/cb', $url);
        $this->assertStringContainsString('state=state-1', $url);
        $this->assertStringContainsString('code=auth-code', $url);
        $this->assertStringContainsString('grant_type=authorization_code', $url);
    }

    public function test_third_party_prod_token_url_includes_code(): void
    {
        new UrlConfiguration(Environment::Prod, 'https://app.test/cb', 'state-2', 'auth-code-2');

        $url = UrlConfiguration::getAccessTokenUrl();

        $this->assertStringContainsString('api.flipkart.net', $url);
        $this->assertStringContainsString('redirect_uri=https://app.test/cb', $url);
        $this->assertStringContainsString('state=state-2', $url);
        $this->assertStringContainsString('code=auth-code-2', $url);
    }

    public function test_string_environment_is_accepted(): void
    {
        new UrlConfiguration('sandbox');

        $this->assertSame(Constants::SANDBOX_API_CLIENT, UrlConfiguration::getApiBaseUrl());
    }

    public function test_unsupported_environment_throws(): void
    {
        new UrlConfiguration('staging');

        $this->expectException(InvalidArgumentException::class);
        UrlConfiguration::getApiBaseUrl();
    }
}
