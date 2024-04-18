<?php
namespace Budgetcontrol\Connector\Workspace;

use Budgetcontrol\Connector\Service\ConnectorInterface;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Slim\Psr7\Request;

/**
 * Class to connect to the Budget Control API of the microservice.
 */
class WorkspaceClient implements ConnectorInterface {

    private array $payload = [];
    private array $header = [];
    private string $method = 'get';

    const PATH = [
        'ADD' => '/add',
    ];

    const METHODS = [
        'POST' => 'post',
        'GET' => 'get',
        'PUT' => 'put',
        'DELETE' => 'delete',
        'PATCH' => 'patch',
    ];

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
        if(!in_array($method, self::METHODS)) {
            throw new \Exception("Method not allowed", 405);
        }

        return $this;
    }

    public function call(string $path, int $userId): \Illuminate\Http\Client\Response
    {
        $path = env('BC_WORKSPACE') . "/$userId/add";
        $payload = $this->payload;

        $method = $this->method;

        $response = Http::$method($path, $payload, $this->header);
        if($response->status() != 200 || $response->status() != 201) {
            Log::error("Error creating workspace ".$response->body());
            throw new \Exception("Error creating workspace", 500);
        }

        return $response;
    }
}