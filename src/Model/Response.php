<?php
namespace Budgetcontrol\Connector\Model;

class Response {
    private int $statusCode;
    private string $body;
    private string $error;

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

    /**
     * Get the value of error
     *
     * @return string
     */
    public function getError(): string
    {
        return $this->error;
    }

    /**
     * Set the value of error
     *
     * @param string $error
     *
     * @return self
     */
    public function setError(string $error): self
    {
        $this->error = $error;

        return $this;
    }
}