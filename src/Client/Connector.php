<?php
namespace Budgetcontrol\Connector\Client;

use Budgetcontrol\Connector\Model\Response as ModelResponse;
use Budgetcontrol\Connector\Service\ConnectorInterface;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Psr7\Response;

/**
 * Class to connect to the Budget Control API of the microservice.
 */
class Connector implements ConnectorInterface {

    protected string $_DOMAIN = 'http://budgetcontrol-core';
    protected array $payload = [];
    protected array $header = [];
    protected string $method = 'get';

    const METHODS = [
        'POST' => 'post',
        'GET' => 'get',
        'PUT' => 'put',
        'DELETE' => 'delete',
        'PATCH' => 'patch',
    ];

    public function call(string $path, int $wsId): ModelResponse
    {
        $method = strtolower($this->method);
        if(!in_array($method, self::METHODS)){
            throw new \Exception("Method not allowed", 405);
        }

        $path =  $this->_DOMAIN."/$wsId$path";
        $payload = $this->payload;


        try {
            $curl = new Client();
            $response = $curl->{$method}($path, [
                'headers' => $this->header,
                'json' => $payload
            ]);
        } catch (RequestException $e) {
            return new ModelResponse(400, '');
        }

        
        return new ModelResponse($response->getStatusCode(), $response->getBody()->getContents());
    }


    /**
     * Set the value of header
     *
     * @param array $header
     *
     * @return self
     */
    public function setHeader(array $header): self
    {
        $this->header = $header;

        return $this;
    }


    /**
     * Set the value of payload
     *
     * @param array $payload
     *
     * @return self
     */
    public function setPayload(array $payload): self
    {
        $this->payload = $payload;

        return $this;
    }


    /**
     * Set the value of method
     *
     * @param string $method
     *
     * @return self
     */
    public function setMethod(string $method): self
    {
        $this->method = $method;

        return $this;
    }


    /**
     * Set the value of _DOMAIN
     *
     * @param string $_DOMAIN
     *
     * @return self
     */
    public function setDomain(string $_DOMAIN): self
    {
        $this->_DOMAIN = $_DOMAIN;

        return $this;
    }
}