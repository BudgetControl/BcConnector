<?php
namespace Budgetcontrol\Connector\Client;

use Budgetcontrol\Connector\Service\Interfaces\ConnectorInterface;
use Budgetcontrol\Connector\Service\HttpClientService;
use Psr\Log\LoggerInterface;
use Budgetcontrol\Connector\Entities\HttpResponse;

/**
 * Class to connect to the Budget Control API of the microservice.
 */
class BudgetClient extends Client implements ConnectorInterface {

    public function index(int $wsId): HttpResponse
    {
        return $this->get("/$wsid");
    }

    public function show(int $wsId, string $uuid): HttpResponse
    {
        return $this->get("/$wsid/$uuid");
    }

    public function create(int $wsId, array $data): HttpResponse
    {
        return $this->post("/$wsid/budget", $data);
    }

    public function update(int $wsId, string $uuid, array $data): HttpResponse
    {
        return $this->put("/$wsid/budget/$uuid", $data);
    }

    public function deleteBudget(int $wsId, string $uuid): HttpResponse
    {
        return $this->delete("/$wsid/budget/$uuid");
    }

    public function expired(int $wsId, string $uuid): HttpResponse
    {
        return $this->get("/$wsid/budget/$uuid/expired");
    }

    public function exceeded(int $wsId, string $uuid): HttpResponse
    {
        return $this->get("/$wsid/budget/$uuid/exceeded");
    }

    public function status(int $wsId, string $uuid): HttpResponse
    {
        return $this->get("/$wsid/budget/$uuid/status");
    }

    public function getStats(int $wsId, string $uuid): HttpResponse
    {
        return $this->get("/$wsid/budget/$uuid/stats");
    }

    public function getAllStats(int $wsId): HttpResponse
    {
        return $this->get("/$wsid/budgets/stats");
    }

    public function getAllEntry(int $wsId, string $uuid): HttpResponse
    {
        return $this->get("/$wsid/budget/$uuid/entry-list");
    }
    
}