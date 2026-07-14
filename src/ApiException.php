<?php

declare(strict_types=1);

namespace Flipkart\SellerApi;

use Throwable;

class ApiException extends \Exception
{
    /**
     * @param  array<string, list<string>|string>  $responseHeaders
     */
    public function __construct(
        string $message = '',
        private readonly int $statusCode = 0,
        private readonly array $responseHeaders = [],
        private readonly ?string $responseBody = null,
        ?Throwable $previous = null,
    ) {
        parent::__construct($message, $statusCode, $previous);
    }

    public function getStatusCode(): int
    {
        return $this->statusCode;
    }

    /**
     * @return array<string, list<string>|string>
     */
    public function getResponseHeaders(): array
    {
        return $this->responseHeaders;
    }

    public function getResponseBody(): ?string
    {
        return $this->responseBody;
    }
}
