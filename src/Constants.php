<?php

declare(strict_types=1);

namespace Flipkart\SellerApi;

final class Constants
{
    public const HTTPS_PROTOCOL = 'https://';

    public const PROD_BASE_URL = 'api.flipkart.net';

    public const SANDBOX_BASE_URL = 'sandbox-api.flipkart.net';

    public const OAUTH_SERVICE = '/oauth-service';

    public const PROD_GET_ACCESS_TOKEN = self::HTTPS_PROTOCOL.self::PROD_BASE_URL.self::OAUTH_SERVICE.'/oauth/token?grant_type=client_credentials&scope=Seller_Api';

    public const THIRD_PARTY_PROD_GET_ACCESS_TOKEN_REDIRECT_URL = self::HTTPS_PROTOCOL.self::PROD_BASE_URL.self::OAUTH_SERVICE.'/oauth/token?redirect_uri=';

    public const THIRD_PARTY_PROD_GET_ACCESS_TOKEN_STATE = '&grant_type=authorization_code&state=';

    public const THIRD_PARTY_PROD_GET_ACCESS_TOKEN_CODE = '&code=';

    public const SANDBOX_GET_ACCESS_TOKEN = self::HTTPS_PROTOCOL.self::SANDBOX_BASE_URL.self::OAUTH_SERVICE.'/oauth/token?grant_type=client_credentials&scope=Seller_Api';

    public const THIRD_PARTY_SANDBOX_GET_ACCESS_TOKEN_REDIRECT_URL = self::HTTPS_PROTOCOL.self::SANDBOX_BASE_URL.self::OAUTH_SERVICE.'/oauth/token?redirect_uri=';

    public const THIRD_PARTY_SANDBOX_GET_ACCESS_TOKEN_STATE = '&grant_type=authorization_code&state=';

    public const THIRD_PARTY_SANDBOX_GET_ACCESS_TOKEN_CODE = '&code=';

    public const PROD_GET_API_CLIENT = self::HTTPS_PROTOCOL.self::PROD_BASE_URL.'/sellers';

    public const SANDBOX_API_CLIENT = self::HTTPS_PROTOCOL.self::SANDBOX_BASE_URL.'/sellers';
}
