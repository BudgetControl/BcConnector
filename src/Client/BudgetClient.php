<?php
namespace Budgetcontrol\Connector\Client;

use Budgetcontrol\Connector\Service\Interfaces\ConnectorInterface;
use HttpClientService;
use Psr\Log\LoggerInterface;
use Budgetcontrol\Connector\Entities\HttpResponse;

/**
 * Class to connect to the Budget Control API of the microservice.
 */
class BudgetClient extends Client implements ConnectorInterface {

    public function index(string $wsid): HttpResponse
    {
        return $this->get("/{$wsid}");
    }

    public function show(string $wsid, string $uuid): HttpResponse
    {
        return $this->get("/{$wsid}/{$uuid}");
    }

    public function create(string $wsid, array $data): HttpResponse
    {
        return $this->post("/{$wsid}/budget", $data);
    }

    public function update(string $wsid, string $uuid, array $data): HttpResponse
    {
        return $this->put("/{$wsid}/budget/{$uuid}", $data);
    }

    public function deleteBudget(string $wsid, string $uuid): HttpResponse
    {
        return $this->delete("/{$wsid}/budget/{$uuid}");
    }

    public function expired(string $wsid, string $uuid): HttpResponse
    {
        return $this->get("/{$wsid}/budget/{$uuid}/expired");
    }

    public function exceeded(string $wsid, string $uuid): HttpResponse
    {
        return $this->get("/{$wsid}/budget/{$uuid}/exceeded");
    }

    public function status(string $wsid, string $uuid): HttpResponse
    {
        return $this->get("/{$wsid}/budget/{$uuid}/status");
    }

    public function getStats(string $wsid, string $uuid): HttpResponse
    {
        return $this->get("/{$wsid}/budget/{$uuid}/stats");
    }

    public function getAllStats(string $wsid): HttpResponse
    {
        return $this->get("/{$wsid}/budgets/stats");
    }

    public function getAllEntry(string $wsid, string $uuid): HttpResponse
    {
        return $this->get("/{$wsid}/budget/{$uuid}/entry-list");
    }
    
}