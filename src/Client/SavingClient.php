<?php
namespace Budgetcontrol\Connector\Client;

use Budgetcontrol\Connector\Service\Interfaces\ConnectorInterface;
use Budgetcontrol\Connector\Service\HttpClientService;
use Psr\Log\LoggerInterface;
use Budgetcontrol\Connector\Entities\HttpResponse;

/**
 * Class to connect to the Budget Control API of the microservice.
 */
class SavingClient extends Client implements ConnectorInterface {
    
    /**
     * Get all savings for a workspace.
     *
     * @param int $wsid
     * @return HttpResponse
     */
    public function getAllSavings(int $wsid): HttpResponse {
        $url = "/$wsid";
        return $this->get($url);
    }

    /**
     * Get a specific saving by UUID.
     *
     * @param int $wsid
     * @param string $uuid
     * @return HttpResponse
     */
    public function getSaving(int $wsid, string $uuid): HttpResponse {
        $url = "/$wsid/$uuid";
        return $this->get($url);
    }

    /**
     * Create a new saving.
     *
     * @param int $wsid
     * @param array $data
     * @return HttpResponse
     */
    public function createSaving(int $wsid, array $data): HttpResponse {
        $url = "/$wsid";
        return $this->post($url, $data);
    }

    /**
     * Update an existing saving.
     *
     * @param int $wsid
     * @param string $uuid
     * @param array $data
     * @return HttpResponse
     */
    public function updateSaving(int $wsid, string $uuid, array $data): HttpResponse {
        $url = "/$wsid/$uuid";
        return $this->put($url, $data);
    }

    /**
     * Delete a saving.
     *
     * @param int $wsid
     * @param string $uuid
     * @return HttpResponse
     */
    public function deleteSaving(int $wsid, string $uuid): HttpResponse {
        $url = "/$wsid/$uuid";
        return $this->delete($url);
    }
    
}