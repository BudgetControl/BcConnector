<?php
namespace Budgetcontrol\Connector\Service;

use Budgetcontrol\Connector\Model\Response as ModelResponse;

/**
 * Class to connect to the Budget Control API of the microservice.
 */
interface ConnectorInterface {

    /**
     * Sets the payload for the connector.
     *
     * @param array $payload The payload data to be set.
     * @return self Returns the instance of the connector.
     */
    public function setPayload(array $payload): self;

    /**
     * Sets the header for the connector.
     *
     * @param array $header The header to set.
     * @return self
     */
    public function setHeader(array $header): self;

    /**
     * Sets the HTTP method for the connector.
     *
     * @param string $method The HTTP method to set.
     * @return self Returns the instance of the connector.
     */
    public function setMethod(string $method): self;

    /**
     * Makes a call to the specified path and returns the HTTP response.
     *
     * @param string $path The path to call.
     * @return HttpResponse The HTTP response.
     */
    public function call(string $path, int $userId): ModelResponse;

}