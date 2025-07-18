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

    public function index(int $wsid): HttpResponse
    {
        return $this->get("/$wsid");
    }

    public function show(int $wsid, string $uuid): HttpResponse
    {
        return $this->get("/$wsid/$uuid");
    }

    public function create(int $wsid, array $data): HttpResponse
    {
        return $this->post("/$wsid/budget", $data);
    }

    public function update(int $wsid, string $uuid, array $data): HttpResponse
    {
        return $this->put("/$wsid/budget/$uuid", $data);
    }

    public function deleteBudget(int $wsid, string $uuid): HttpResponse
    {
        return $this->delete("/$wsid/budget/$uuid");
    }

    public function expired(int $wsid, string $uuid): HttpResponse
    {
        return $this->get("/$wsid/budget/$uuid/expired");
    }

    public function exceeded(int $wsid, string $uuid): HttpResponse
    {
        return $this->get("/$wsid/budget/$uuid/exceeded");
    }

    public function status(int $wsid, string $uuid): HttpResponse
    {
        return $this->get("/$wsid/budget/$uuid/status");
    }

    public function getStats(int $wsid, string $uuid): HttpResponse
    {
        return $this->get("/$wsid/budget/$uuid/stats");
    }

    public function getAllStats(int $wsid): HttpResponse
    {
        return $this->get("/$wsid/budgets/stats");
    }

    public function getAllEntry(int $wsid, string $uuid): HttpResponse
    {
        return $this->get("/$wsid/budget/$uuid/entry-list");
    }
    
}