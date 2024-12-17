<?php
namespace Budgetcontrol\Connector\Client;

use Budgetcontrol\Connector\Service\Interfaces\ConnectorInterface;
use HttpClientService;
use Psr\Log\LoggerInterface;
use Budgetcontrol\Connector\Entities\HttpResponse;

/**
 * Class to connect to the Budget Control API of the microservice.
 */
class WorkspaceClient extends Client implements ConnectorInterface {

    public function add(array $data): HttpResponse
    {
        return $this->post('/workspaces', $data);
    }

    public function list(string $userId): HttpResponse
    {
        return $this->get("/{$userId}/list");
    }

    public function listByUser(string $userId): HttpResponse
    {
        return $this->get("/{$userId}/by-user/list");
    }

    public function last(string $userId): HttpResponse
    {
        return $this->get("/{$userId}/last");
    }

    public function getWorkspace(string $userId, string $wsId): HttpResponse
    {
        return $this->get("/{$userId}/{$wsId}");
    }

    public function update(string $userId, string $wsId, array $data): HttpResponse
    {
        return $this->put("/{$userId}/update/{$wsId}", $data);
    }

    public function deleteWorkspace(string $wsId): HttpResponse
    {
        return $this->delete("/{$wsId}/delete");
    }

    public function activate(string $userId, string $wsId, array $data): HttpResponse
    {
        return $this->patch("/{$userId}/{$wsId}/activate", $data);
    }

    public function share(string $userId, string $wsId, array $data): HttpResponse
    {
        return $this->post("/{$userId}/{$wsId}/share", $data);
    }

}