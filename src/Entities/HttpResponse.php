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
    public function toArray(): ?array {
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
     */
    public function getHeader(string $header): ?string {
        // Handle case-insensitive header lookup
        foreach ($this->headers as $key => $value) {
            if (strcasecmp($key, $header) === 0) {
                return is_array($value) ? implode(', ', $value) : $value;
            }
        }
        return null;
    }

    /**
     * Check if a header exists
     */
    public function hasHeader(string $header): bool {
        foreach ($this->headers as $key => $value) {
            if (strcasecmp($key, $header) === 0) {
                return true;
            }
        }
        return false;
    }

    /**
     * Determines if the HTTP response was successful.
     */
    public function isSuccessful(): bool {
        return $this->statusCode >= 200 && $this->statusCode < 300;
    }

    /**
     * Check if response is client error (4xx)
     */
    public function isClientError(): bool {
        return $this->statusCode >= 400 && $this->statusCode < 500;
    }

    /**
     * Check if response is server error (5xx)
     */
    public function isServerError(): bool {
        return $this->statusCode >= 500 && $this->statusCode < 600;
    }

    /**
     * Check if response has error
     */
    public function hasError(): bool {
        return !$this->isSuccessful();
    }

    /**
     * Get error message from response body
     */
    public function getErrorMessage(): ?string {
        if ($this->isSuccessful()) {
            return null;
        }

        $data = $this->toArray();
        if (is_array($data)) {
            return $data['message'] ?? $data['error'] ?? null;
        }

        return $this->body;
    }
}