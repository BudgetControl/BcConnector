<?php
namespace Budgetcontrol\Connector\Model;

class Response {
    private int $statusCode;
    private string $body;

    public function __construct(int $statusCode, string $body)
    {
        $this->statusCode = $statusCode;
        $this->body = $body;
    }

    public function getStatusCode(): int
    {
        return $this->statusCode;
    }

    public function getBody(): array
    {
        if(empty($this->body)) {
            return [];
        }

        return json_decode($this->body, true);
    }
}