<?php
namespace Budgetcontrol\Connector\Service\Interfaces;

use Budgetcontrol\Connector\Entities\HttpResponse as Response;

/**
 * Class to connect to the Budget Control API of the microservice.
 */
interface ConnectorInterface {

    /**
     * Sends a GET request to the specified endpoint with optional headers.
     *
     * @param string $endpoint The API endpoint to send the GET request to.
     * @param array $headers Optional headers to include in the request.
     * @return Response The response from the GET request.
     */
    public function get(string $endpoint, array $headers = []): Response;

    /**
     * Sends a POST request to the specified endpoint with the given data and headers.
     *
     * @param string $endpoint The endpoint to send the POST request to.
     * @param array $data The data to be sent in the POST request body.
     * @param array $headers Optional headers to include in the POST request.
     * @return Response The response from the POST request.
     */

    public function post(string $endpoint, array $data, array $headers = []): Response;

    /**
     * Sends a PUT request to the specified endpoint with the given data and headers.
     *
     * @param string $endpoint The API endpoint to send the PUT request to.
     * @param array $data The data to be sent in the PUT request body.
     * @param array $headers Optional. Additional headers to include in the request.
     * @return Response The response from the API.
     */
    public function put(string $endpoint, array $data, array $headers = []): Response;

    /**
     * Sends a DELETE request to the specified endpoint.
     *
     * @param string $endpoint The API endpoint to send the DELETE request to.
     * @param array $headers Optional. An array of headers to include in the request.
     * @return Response The response from the API.
     */
    public function delete(string $endpoint, array $headers = []): Response;

    /**
     * Sends a PATCH request to the specified endpoint with the given data and headers.
     *
     * @param string $endpoint The API endpoint to send the PATCH request to.
     * @param array $data The data to be sent in the PATCH request body.
     * @param array $headers Optional. Additional headers to include in the request.
     * @return Response The response from the API.
     */
    public function patch(string $endpoint, array $data, array $headers = []): Response;

    /**
     * Sends an HTTP OPTIONS request to the specified endpoint.
     *
     * @param string $endpoint The URL to which the request is sent.
     * @param array $headers Optional. An associative array of headers to include in the request.
     * @return Response The response object containing the server's response to the OPTIONS request.
     */
    public function options(string $endpoint, array $headers = []): Response;

    /**
     * Sends a HEAD request to the specified endpoint with optional headers.
     *
     * @param string $endpoint The endpoint to send the HEAD request to.
     * @param array $headers Optional headers to include in the request.
     * @return Response The response from the HEAD request.
     */
    public function head(string $endpoint, array $headers = []): Response;

}