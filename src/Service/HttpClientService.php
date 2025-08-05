<?php
declare(strict_types=1);

namespace Budgetcontrol\Connector\Service;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\ServerException;
use GuzzleHttp\Exception\ConnectException;
use Budgetcontrol\Connector\Entities\HttpResponse as Response;
use Budgetcontrol\Connector\Entities\Payloads\PayloadInterface;
use Budgetcontrol\Connector\Service\Interfaces\ConnectorInterface;
use GuzzleHttp\Exception\BadResponseException;

class HttpClientService implements ConnectorInterface
{
    const VALID_STATUS_CODES = [
        200, 201, 202, 203, 204, 205, 206, 207, 208, 226
    ];

    protected string $domain;
    protected array $headers;
    protected array $validStatusCodes;
    protected string $queryParams = '';
    protected int $timeout = 30;
    protected int $connectTimeout = 10;
    protected bool $debug = false;

    public function __construct(string $microservice, string $apiSecret)
    {
        $this->domain = rtrim($microservice, '/');
        $this->headers = [
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
            'User-Agent' => 'BudgetControl-Connector/1.0',
            'X-API-SECRET' => $apiSecret
        ];
        $this->validStatusCodes = self::VALID_STATUS_CODES;
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

    public function post(string $endpoint, PayloadInterface $data, array $headers = []): Response
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
    public function put(string $endpoint, PayloadInterface $data, array $headers = []): Response
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
    public function patch(string $endpoint, PayloadInterface $data, array $headers = []): Response
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
     * @param PayloadInterface $data Optional. The data to send with the request. Default is an empty array.
     * @param array $headers Optional. The headers to include with the request. Default is an empty array.
     * @return Response The response from the HTTP request.
     */
    public function request(string $method, string $endpoint, ?PayloadInterface $data = null, array $headers = []): Response
    {
        if(null !== $data) {
            $data = $data->getData();
        }
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
        $url = $this->buildUrl($path);
        $mergedHeaders = array_merge($this->headers, $headers);

        try {
            $client = new Client([
                'timeout' => $this->timeout,
                'connect_timeout' => $this->connectTimeout,
                'headers' => $mergedHeaders,
                'verify' => !$this->debug,
            ]);

            $options = [];
            if (!empty($data) && in_array(strtoupper($method), ['POST', 'PUT', 'PATCH'])) {
                $options['json'] = $data;
            }

            $response = $client->request(strtoupper($method), $url, $options);

        } catch (ClientException $e) {
            return $this->createErrorResponse($e);
        } catch (ServerException $e) {
            return $this->createErrorResponse($e);
        } catch (ConnectException $e) {
            return new Response(0, 'Connection failed: ' . $e->getMessage(), []);
        } catch (\Exception $e) {
            return new Response($e->getCode() ?: 500, $e->getMessage(), []);
        }

        if (!in_array($response->getStatusCode(), $this->validStatusCodes)) {
            throw new BadResponseException(
                'Invalid response status code: ' . $response->getStatusCode(),
                $client->getRequest(),
                $response
            );
        }

        return new Response(
            $response->getStatusCode(),
            $response->getBody()->getContents(),
            $response->getHeaders()
        );
    }

    private function buildUrl(string $path): string
    {
        $path = ltrim($path, '/');
        return $this->domain . '/' . $path . $this->queryParams;
    }

    /**
     * Creates a standardized error response based on the provided exception.
     *
     * @param \GuzzleHttp\Exception\BadResponseException $e The exception that triggered the error response.
     * @return Response The generated error response object.
     */
    private function createErrorResponse(\GuzzleHttp\Exception\BadResponseException $e): Response
    {
        $statusCode = method_exists($e, 'getResponse') && $e->getResponse() 
            ? $e->getResponse()->getStatusCode() 
            : $e->getCode();
        
        $body = method_exists($e, 'getResponse') && $e->getResponse()
            ? $e->getResponse()->getBody()->getContents()
            : $e->getMessage();

        return new Response($statusCode, $body, []);
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

    /**
     * Set the value of queryParams
     *
     * @return  self
     */ 
    public function setQueryParams(array $queryParams)
    {
        $this->queryParams = http_build_query($queryParams);

        return $this;
    }

    /**
     * Set request timeout
     */
    public function setTimeout(int $seconds): self
    {
        $this->timeout = $seconds;
        return $this;
    }

    /**
     * Set connection timeout
     */
    public function setConnectTimeout(int $seconds): self
    {
        $this->connectTimeout = $seconds;
        return $this;
    }

    /**
     * Enable/disable debug mode
     */
    public function setDebug(bool $debug): self
    {
        $this->debug = $debug;
        return $this;
    }

    /**
     * Set authentication token
     */
    public function setAuthToken(string $token): self
    {
        $this->addHeaders(['Authorization' => 'Bearer ' . $token]);
        return $this;
    }
}
