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
     * @param string $wsid
     * @return HttpResponse
     */
    public function getAllSavings(string $wsid): HttpResponse {
        $url = "/{$wsid}";
        return $this->get($url);
    }

    /**
     * Get a specific saving by UUID.
     *
     * @param string $wsid
     * @param string $uuid
     * @return HttpResponse
     */
    public function getSaving(string $wsid, string $uuid): HttpResponse {
        $url = "/{$wsid}/{$uuid}";
        return $this->get($url);
    }

    /**
     * Create a new saving.
     *
     * @param string $wsid
     * @param array $data
     * @return HttpResponse
     */
    public function createSaving(string $wsid, array $data): HttpResponse {
        $url = "/{$wsid}";
        return $this->post($url, $data);
    }

    /**
     * Update an existing saving.
     *
     * @param string $wsid
     * @param string $uuid
     * @param array $data
     * @return HttpResponse
     */
    public function updateSaving(string $wsid, string $uuid, array $data): HttpResponse {
        $url = "/{$wsid}/{$uuid}";
        return $this->put($url, $data);
    }

    /**
     * Delete a saving.
     *
     * @param string $wsid
     * @param string $uuid
     * @return HttpResponse
     */
    public function deleteSaving(string $wsid, string $uuid): HttpResponse {
        $url = "/{$wsid}/{$uuid}";
        return $this->delete($url);
    }
    
}