<?php
namespace Budgetcontrol\Connector\Client;

use Budgetcontrol\Connector\Service\Interfaces\ConnectorInterface;
use HttpClientService;
use Psr\Log\LoggerInterface;
use Budgetcontrol\Connector\Entities\HttpResponse;

/**
 * Class to connect to the Budget Control API of the microservice.
 */
class SavingClient extends Client implements ConnectorInterface {
    /**
     * Get the list of savings.
     *
     * @return HttpResponse
     */
    public function list(): HttpResponse {
        return $this->get('/entry/saving');
    }

    /**
     * Get a specific saving entry by UUID.
     *
     * @param string $uuid
     * @return HttpResponse
     */
    public function getSaving(string $uuid): HttpResponse {
        return $this->get("/entry/saving/{$uuid}");
    }

    /**
     * Create a new saving entry.
     *
     * @param array $data
     * @return HttpResponse
     */
    public function create(array $data): HttpResponse {
        return $this->post('/entry/saving', $data);
    }

    /**
     * Update an existing saving entry by UUID.
     *
     * @param string $uuid
     * @param array $data
     * @return HttpResponse
     */
    public function updateSaving(string $uuid, array $data): HttpResponse {
        return $this->put("/entry/saving/{$uuid}", $data);
    }

    /**
     * Delete a saving entry by UUID.
     *
     * @param string $uuid
     * @return HttpResponse
     */
    public function deleteSaving(string $uuid): HttpResponse {
        return $this->delete("/entry/saving/{$uuid}");
    }
    
}