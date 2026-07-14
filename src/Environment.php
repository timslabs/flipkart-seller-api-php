<?php

declare(strict_types=1);

namespace Flipkart\SellerApi;

enum Environment: string
{
    case Prod = 'PROD';
    case Sandbox = 'SANDBOX';
}
