<?php

declare(strict_types=1);

namespace Flipkart\SellerApi;

final class UrlConfiguration
{
    private static string $env = '';

    private static ?string $authCode = null;

    private static ?string $state = null;

    private static ?string $redirectUrl = null;

    public function __construct(
        string|Environment $env,
        ?string $redirectUrl = null,
        ?string $state = null,
        ?string $authCode = null,
    ) {
        self::$env = $env instanceof Environment ? $env->value : strtoupper($env);
        self::$redirectUrl = $redirectUrl;
        self::$state = $state;
        self::$authCode = $authCode;
    }

    public static function getAccessTokenUrl(): string
    {
        $isProd = strcasecmp(self::$env, Environment::Prod->value) === 0;
        $isSandbox = strcasecmp(self::$env, Environment::Sandbox->value) === 0;

        if ($isProd && self::$authCode !== null) {
            return Constants::THIRD_PARTY_PROD_GET_ACCESS_TOKEN_REDIRECT_URL
                .self::$redirectUrl
                .Constants::THIRD_PARTY_PROD_GET_ACCESS_TOKEN_STATE
                .self::$state
                .Constants::THIRD_PARTY_PROD_GET_ACCESS_TOKEN_CODE
                .self::$authCode;
        }

        if ($isSandbox && self::$authCode !== null) {
            return Constants::THIRD_PARTY_SANDBOX_GET_ACCESS_TOKEN_REDIRECT_URL
                .self::$redirectUrl
                .Constants::THIRD_PARTY_SANDBOX_GET_ACCESS_TOKEN_STATE
                .self::$state
                .Constants::THIRD_PARTY_SANDBOX_GET_ACCESS_TOKEN_CODE
                .self::$authCode;
        }

        if ($isProd) {
            return Constants::PROD_GET_ACCESS_TOKEN;
        }

        if ($isSandbox) {
            return Constants::SANDBOX_GET_ACCESS_TOKEN;
        }

        throw new \InvalidArgumentException('Unsupported environment ['.self::$env.']. Use PROD or SANDBOX.');
    }

    public static function getApiBaseUrl(): string
    {
        if (strcasecmp(self::$env, Environment::Prod->value) === 0) {
            return Constants::PROD_GET_API_CLIENT;
        }

        if (strcasecmp(self::$env, Environment::Sandbox->value) === 0) {
            return Constants::SANDBOX_API_CLIENT;
        }

        throw new \InvalidArgumentException('Unsupported environment ['.self::$env.']. Use PROD or SANDBOX.');
    }
}
