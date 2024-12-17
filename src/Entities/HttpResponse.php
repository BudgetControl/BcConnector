<?php
declare(strict_types=1);

namespace Budgetcontrol\Connector\Entities;

final class HttpResponse {
    private int $statusCode;
    private string $body;
    private array $headers;

    public function __construct(int $statusCode, string $body, array $headers) {
        $this->statusCode = $statusCode;
        $this->body = $body;
        $this->headers = $headers;
    }

    public function getStatusCode(): int {
        return $this->statusCode;
    }

    public function getBody(): string {
        return $this->body;
    }

    public function toArray(): array {
        return json_decode($this->body, true);
    }

    public function toJson(): string {
        return $this->body;
    }
    
}