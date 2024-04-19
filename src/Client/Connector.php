<?php
namespace Budgetcontrol\Connector\Client;

use Budgetcontrol\Connector\Model\Response as ModelResponse;
use Budgetcontrol\Connector\Service\ConnectorInterface;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Response;

/**
 * Class to connect to the Budget Control API of the microservice.
 */
class Connector {

    protected string $_DOMAIN = 'http://budgetcontrol-core';
    protected array $payload = [];
    protected array $header = [];
    protected string $method = 'get';
    protected array $_PATH= [];

    public function call(string $path, int $userId): ModelResponse
    {
        if(!in_array($path, $this->_PATH)){
            throw new \Exception("Path not allowed", 405);
        }

        $path =  $this->_DOMAIN."/$userId$path";
        $payload = $this->payload;

        $method = $this->method;

        $curl = new Client();
        $response = $curl->$method($path, [
            'headers' => $this->header,
            'json' => $payload
        ]);
        
        return new ModelResponse($response->getStatusCode(), $response->getBody()->getContents());
    }
}