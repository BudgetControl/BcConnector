<?php
namespace Budgetcontrol\Connector\Factory;

use Budgetcontrol\Connector\Service\ConnectorInterface;
use Budgetcontrol\Connector\Workspace\WorkspaceClient;

/**
 * FILEPATH: /Users/marco/Projects/marco/Core/microservices/Authtentication/vendor/budgetcontrol/libs-connector/src/Factory/Factory.php
 *
 * This is an abstract class that serves as a base for creating factories.
 * Factories are responsible for creating instances of objects.
 */
abstract class Factory {

    protected ConnectorInterface $service;

    /**
     * Constructor for the Factory class.
     *
     * @param string $method The HTTP method to be used.
     * @param array $payload The payload data to be sent.
     * @param array $header The optional headers to be included in the request.
     */
    private function __construct(string $method, array $payload, array $header = [])
    {
        $service = new WorkspaceClient();

        $service->setMethod($method)
            ->setPayload($payload)
            ->setHeader($header);

        $this->service = $service;
    }

    /**
     * Initializes the factory to create a connector instance.
     *
     * @param string $method The HTTP method to be used for the connector.
     * @param array $payload The payload data to be sent with the connector.
     * @param array $header The optional headers to be included with the connector.
     * @return ConnectorInterface The created connector instance.
     */
    abstract public static function init(string $method, array $payload, array $header = []): ConnectorInterface;


}