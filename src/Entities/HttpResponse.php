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

    /**
     * Get the HTTP status code from the response.
     *
     * @return int The HTTP status code.
     */
    public function getStatusCode(): int {
        return $this->statusCode;
    }

    /**
     * Retrieves the body of the HTTP response.
     *
     * @return string The body content of the HTTP response.
     */
    public function getBody(): string {
        return $this->body;
    }

    /**
     * Converts the HTTP response to an associative array.
     *
     * @return array The HTTP response as an associative array.
     */
    public function toArray(): array {
        return json_decode($this->body, true);
    }

    /**
     * Converts the HTTP response to a JSON string.
     *
     * @return string The JSON representation of the HTTP response.
     */
    public function toJson(): string {
        return $this->body;
    }

    /**
     * Retrieves the headers from the HTTP response.
     *
     * @return array An associative array of headers where the key is the header name and the value is the header value.
     */
    public function getHeaders(): array {
        return $this->headers;
    }

    /**
     * Retrieves the value of a specific header from the HTTP response.
     *
     * @param string $header The name of the header to retrieve.
     * @return string The value of the specified header.
     */
    public function getHeader(string $header): string {
        return $this->headers[$header];
    }

    /**
     * Determines if the HTTP response was successful.
     *
     * @return bool True if the response was successful, false otherwise.
     */
    public function isSuccessful(): bool {
        return $this->statusCode >= 200 && $this->statusCode < 300;
    }
    
}