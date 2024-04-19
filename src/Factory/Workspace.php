<?php
namespace Budgetcontrol\Connector\Factory;

use Budgetcontrol\Connector\Service\ConnectorInterface;
use Budgetcontrol\Connector\Workspace\WorkspaceClient;

class Workspace extends Factory {

    protected ConnectorInterface $service;

    private function __construct(string $method, array $payload, array $header = [])
    {
        $service = new WorkspaceClient();

        $service->setMethod($method)
            ->setPayload($payload)
            ->setHeader($header);

        $this->service = $service;
    }

    public static function init(string $method, array $payload, array $header = []): ConnectorInterface
    {
        $client = new Workspace($method,$payload, $header);
        return $client->service;
    }


}