<?php
namespace Budgetcontrol\Connector\Client;

use Budgetcontrol\Connector\Service\Interfaces\ConnectorInterface;
use Budgetcontrol\Connector\Service\HttpClientService;
use Psr\Log\LoggerInterface;
use Budgetcontrol\Connector\Entities\HttpResponse;

/**
 * Class to connect to the Budget Control API of the microservice.
 */
class WorkspaceClient extends Client implements ConnectorInterface {

    public function add(int $userId, array $data): HttpResponse
    {
        return $this->post("/$userId/add", $data);
    }

    public function list(int $userId): HttpResponse
    {
        return $this->get("/$userId/list");
    }

    public function listByUser(int $userId): HttpResponse
    {
        return $this->get("/$userId/by-user/list");
    }

    public function last(int $userId): HttpResponse
    {
        return $this->get("/$userId/last");
    }

    public function getWorkspace(int $userId, int $wsid): HttpResponse
    {
        return $this->get("/$userId/$wsid");
    }

    public function update(int $userId, int $wsid, array $data): HttpResponse
    {
        return $this->put("/$userId/update/$wsid", $data);
    }

    public function deleteWorkspace(int $wsid): HttpResponse
    {
        return $this->delete("/$wsid/delete");
    }

    public function activate(int $userId, int $wsid, array $data): HttpResponse
    {
        return $this->patch("/$userId/$wsid/activate", $data);
    }

    public function share(int $userId, int $wsid, array $data): HttpResponse
    {
        return $this->post("/$userId/$wsid/share", $data);
    }

}