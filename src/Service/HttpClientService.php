<?php

declare(strict_types=1);

use GuzzleHttp\Client;
use Budgetcontrol\Connector\Entities\HttpResponse as Response;
use Budgetcontrol\Connector\Service\Interfaces\ConnectorInterface;
use Psr\Log\LoggerInterface;

class HttpClientService implements ConnectorInterface
{
    const VALID_STATUS_CODES = [
        200,
        201,
        202,
        203,
        204,
        205,
        206,
        207,
        208,
        226
    ];

    protected string $domain;
    protected array $headers;
    protected array $validStatusCodes;
    private LoggerInterface $log;

    public function __construct(string $microservice, LoggerInterface $log)
    {
        $this->domain = $microservice;
        $this->headers = [
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ];
        $this->validStatusCodes = self::VALID_STATUS_CODES;
        $this->log = $log;
    }

    /**
     * Sends a GET request to the specified endpoint with optional headers.
     *
     * @param string $endpoint The API endpoint to send the GET request to.
     * @param array $headers Optional headers to include in the request.
     * @return Response The response from the GET request.
     */
    public function get(string $endpoint, array $headers = []): Response
    {
        return $this->invoke('get', $endpoint, [], $headers);
    }
    /**
     * Sends a POST request to the specified endpoint with the given data and headers.
     *
     * @param string $endpoint The endpoint to send the POST request to.
     * @param array $data The data to be sent in the POST request body.
     * @param array $headers Optional headers to include in the POST request.
     * @return Response The response from the POST request.
     */

    public function post(string $endpoint, array $data, array $headers = []): Response
    {
        return $this->invoke('post', $endpoint, $data, $headers);
    }

    /**
     * Sends a PUT request to the specified endpoint with the given data and headers.
     *
     * @param string $endpoint The API endpoint to send the PUT request to.
     * @param array $data The data to be sent in the PUT request body.
     * @param array $headers Optional. Additional headers to include in the request.
     * @return Response The response from the API.
     */
    public function put(string $endpoint, array $data, array $headers = []): Response
    {
        return $this->invoke('put', $endpoint, $data, $headers);
    }

    /**
     * Sends a DELETE request to the specified endpoint.
     *
     * @param string $endpoint The API endpoint to send the DELETE request to.
     * @param array $headers Optional. An array of headers to include in the request.
     * @return Response The response from the API.
     */
    public function delete(string $endpoint, array $headers = []): Response
    {
        return $this->invoke('delete', $endpoint, [], $headers);
    }

    /**
     * Sends a PATCH request to the specified endpoint with the given data and headers.
     *
     * @param string $endpoint The API endpoint to send the PATCH request to.
     * @param array $data The data to be sent in the PATCH request body.
     * @param array $headers Optional. Additional headers to include in the request.
     * @return Response The response from the API.
     */
    public function patch(string $endpoint, array $data, array $headers = []): Response
    {
        return $this->invoke('patch', $endpoint, $data, $headers);
    }

    /**
     * Sends an HTTP OPTIONS request to the specified endpoint.
     *
     * @param string $endpoint The URL to which the request is sent.
     * @param array $headers Optional. An associative array of headers to include in the request.
     * @return Response The response object containing the server's response to the OPTIONS request.
     */
    public function options(string $endpoint, array $headers = []): Response
    {
        return $this->invoke('options', $endpoint, [], $headers);
    }

    /**
     * Sends a HEAD request to the specified endpoint with optional headers.
     *
     * @param string $endpoint The endpoint to send the HEAD request to.
     * @param array $headers Optional headers to include in the request.
     * @return Response The response from the HEAD request.
     */
    public function head(string $endpoint, array $headers = []): Response
    {
        return $this->invoke('head', $endpoint, [], $headers);
    }

    /**
     * Sends an HTTP request to the specified endpoint.
     *
     * @param string $method The HTTP method to use (e.g., 'GET', 'POST', 'PUT', 'DELETE').
     * @param string $endpoint The API endpoint to send the request to.
     * @param array $data Optional. The data to send with the request. Default is an empty array.
     * @param array $headers Optional. The headers to include with the request. Default is an empty array.
     * @return Response The response from the HTTP request.
     */
    public function request(string $method, string $endpoint, array $data = [], array $headers = []): Response
    {
        return $this->invoke($method, $endpoint, $data, $headers);
    }

    /**
     * Invokes an HTTP request with the specified method, path, data, and headers.
     *
     * @param string $method The HTTP method to use (e.g., 'GET', 'POST', 'PUT', 'DELETE').
     * @param string $path The URL path for the request.
     * @param array $data Optional. The data to send with the request. Default is an empty array.
     * @param array $headers Optional. The headers to include with the request. Default is an empty array.
     * @return Response The response from the HTTP request.
     */
    protected function invoke(string $method, string $path, array $data = [], array $headers = []): Response
    {
        $domain = $this->domain;
        $headers = array_merge($this->headers, $headers);

        $this->log->debug('Request to microservice', [
            'method' => $method,
            'path' => $path,
            'data' => $data,
            'headers' => $headers,
        ]);

        try {
            
            $client = new Client([
                'headers' => $headers,
            ]);
            /** @var  \Psr\Http\Message\ResponseInterface $response */
            $response = $client->$method("$domain/$path", $data);

        } catch (\Exception $e) {

            $this->log->critical('Error: on request to microservice', [
                'error' => $e->getMessage(),
            ]);
            return new Response(500, $e->getMessage(), []);

        }
        

        if (!in_array($response->getStatusCode(), $this->validStatusCodes)) {
            $this->log->error('Error: on request to microservice', [
                'response' => $response->getBody()->getContents(),
            ]);
        }

        $this->log->debug('Response from microservice', [
            'response' => $response->getBody()->getContents(),
        ]);

        return new Response($response->getStatusCode(), $response->getBody()->getContents(), $response->getHeaders());
    }
    /**
     * Set the headers for the HTTP client.
     *
     * @param array $headers An associative array of headers to set.
     * @return self Returns the instance of the HttpClientService for method chaining.
     */

    public function setHeaders(array $headers): self
    {
        $this->headers = $headers;
        return $this;
    }

    /**
     * Adds headers to the HTTP client service.
     *
     * @param array $headers An associative array of headers to add.
     * @return self Returns the instance of the HTTP client service.
     */
    public function addHeaders(array $headers): self
    {
        $this->headers = array_merge($this->headers, $headers);
        return $this;
    }

    /**
     * Retrieve the headers for the HTTP client.
     *
     * @return array An associative array of headers.
     */
    public function getHeaders(): array
    {
        return $this->headers;
    }

    /**
     * Set the domain for the HTTP client service.
     *
     * @param string $domain The domain to be set.
     * @return self Returns the instance of the HttpClientService.
     */
    public function setDomain(string $domain): self
    {
        $this->domain = $domain;
        return $this;
    }

    /**
     * Adds valid status codes to the list of acceptable HTTP response codes.
     *
     * @param array $validStatusCodes An array of valid HTTP status codes.
     * @return self Returns the instance of the HttpClientService for method chaining.
     */
    public function addValidStatusCodes(array $validStatusCodes): self
    {
        $this->validStatusCodes = array_merge($this->validStatusCodes, $validStatusCodes);
        return $this;
    }
}
