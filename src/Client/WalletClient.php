<?php
namespace Budgetcontrol\Connector\Client;

use Budgetcontrol\Connector\Service\Interfaces\ConnectorInterface;
use Budgetcontrol\Connector\Service\HttpClientService;
use Psr\Log\LoggerInterface;
use Budgetcontrol\Connector\Entities\HttpResponse;

/**
 * Class to connect to the Budget Control API of the microservice.
 */
class WalletClient extends Client implements ConnectorInterface {

    public function list($wsid)
    {
        return $this->get("/$wsid/list");
    }

    public function create($wsid, $data)
    {
        return $this->post("/$wsid/create", ['json' => $data]);
    }

    public function show($wsid, $uuid)
    {
        return $this->get("/$wsid/show/$uuid");
    }

    public function update($wsid, $uuid, $data)
    {
        return $this->put("/$wsid/update/$uuid", ['json' => $data]);
    }

    public function destroy($wsid, $uuid)
    {
        return $this->delete("/$wsid/$uuid");
    }

    public function archive($wsid, $uuid)
    {
        return $this->patch("/$wsid/archive/$uuid", ['archived' => true]);
    }

    public function updateBalance($wsid, $uuid, float $newBalance)
    {
        return $this->patch("/$wsid/$uuid", ['balance' => $newBalance]);
    }

    public function restore($wsid, $uuid)
    {
        return $this->patch("/$wsid/restore/$uuid", ['archived' => false]);
    }

    public function sorting($wsid, $uuid, $data)
    {
        return $this->patch("/$wsid/sorting/$uuid", ['json' => $data]);
    }

    public function balanceUpdate($wsid, $uuid, $data)
    {
        if(!isset($data['amount'])) {
            throw new \InvalidArgumentException('The amount is required');
        }
        
        return $this->patch("/$wsid/balance/$uuid", ['json' => $data]);
    }

    public function deleteEntryFromBalance($wsid, $uuid)
    {
        return $this->delete("/$wsid/balance/$uuid");
    }
}