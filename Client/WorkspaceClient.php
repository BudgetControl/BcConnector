<?php
namespace Budgetcontrol\Connector\Client;

use Budgetcontrol\Connector\Model\Response as ModelResponse;
use Budgetcontrol\Connector\Service\ConnectorInterface;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Response;

/**
 * Class to connect to the Budget Control API of the microservice.
 */
class WorkspaceClient extends Connector implements ConnectorInterface {

    protected string $_DOMAIN = 'http://budgetcontrol-ms-workspace';
    protected array $payload = [];
    protected array $header = [];
    protected string $method = 'get';

    public function setPayload($payload): self
    {
        $this->payload = $payload;
        return $this;
    }

    public function setHeader($header): self
    {
        $this->header = $header;
        return $this;
    }

    public function setMethod($method): self
    {
        if(!array_key_exists($method, self::METHODS)) {
            throw new \Exception("Method not allowed", 405);
        }

        $this->method = self::METHODS[$method];

        return $this;
    }
    
}