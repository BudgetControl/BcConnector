<?php
namespace Budgetcontrol\Connector\Client;

use Budgetcontrol\Connector\Service\Interfaces\ConnectorInterface;
use HttpClientService;
use Psr\Log\LoggerInterface;
use Budgetcontrol\Connector\Entities\HttpResponse;

/**
 * Class to connect to the Budget Control API of the microservice.
 */
class EntryClient extends Client implements ConnectorInterface {

    public function getEntry($wsid)
    {
        return $this->get("/{$wsid}/entry");
    }

    public function getExpense($wsid)
    {
        return $this->get("/{$wsid}/expense");
    }

    public function showExpense($wsid, $uuid)
    {
        return $this->get("/{$wsid}/expense/{$uuid}");
    }

    public function createExpense($wsid, $data)
    {
        return $this->post("/{$wsid}/expense", $data);
    }

    public function updateExpense($wsid, $uuid, $data)
    {
        return $this->put("/{$wsid}/expense/{$uuid}", $data);
    }

    public function getIncome($wsid)
    {
        return $this->get("/{$wsid}/income");
    }

    public function showIncome($wsid, $uuid)
    {
        return $this->get("/{$wsid}/income/{$uuid}");
    }

    public function createIncome($wsid, $data)
    {
        return $this->post("/{$wsid}/income", $data);
    }

    public function updateIncome($wsid, $uuid, $data)
    {
        return $this->put("/{$wsid}/income/{$uuid}", $data);
    }

    public function getTransfer($wsid)
    {
        return $this->get("/{$wsid}/transfer");
    }

    public function showTransfer($wsid, $uuid)
    {
        return $this->get("/{$wsid}/transfer/{$uuid}");
    }

    public function createTransfer($wsid, $data)
    {
        return $this->post("/{$wsid}/transfer", $data);
    }

    public function updateTransfer($wsid, $uuid, $data)
    {
        return $this->put("/{$wsid}/transfer/{$uuid}", $data);
    }

    public function getDebit($wsid)
    {
        return $this->get("/{$wsid}/debit");
    }

    public function showDebit($wsid, $uuid)
    {
        return $this->get("/{$wsid}/debit/{$uuid}");
    }

    public function createDebit($wsid, $data)
    {
        return $this->post("/{$wsid}/debit", $data);
    }

    public function updateDebit($wsid, $uuid, $data)
    {
        return $this->put("/{$wsid}/debit/{$uuid}", $data);
    }

    public function getSaving($wsid)
    {
        return $this->get("/{$wsid}/saving");
    }

    public function showSaving($wsid, $uuid)
    {
        return $this->get("/{$wsid}/saving/{$uuid}");
    }

    public function createSaving($wsid, $data)
    {
        return $this->post("/{$wsid}/saving", $data);
    }

    public function updateSaving($wsid, $uuid, $data)
    {
        return $this->put("/{$wsid}/saving/{$uuid}", $data);
    }

    public function deleteDebit($wsid, $uuid)
    {
        return $this->delete("/{$wsid}/debit/{$uuid}");
    }

    public function deleteIncome($wsid, $uuid)
    {
        return $this->delete("/{$wsid}/income/{$uuid}");
    }

    public function deleteExpense($wsid, $uuid)
    {
        return $this->delete("/{$wsid}/expense/{$uuid}");
    }

    public function deleteTransfer($wsid, $uuid)
    {
        return $this->delete("/{$wsid}/transfer/{$uuid}");
    }

    public function deleteEntry($wsid, $uuid)
    {
        return $this->delete("/{$wsid}/entry/{$uuid}");
    }

    public function listModels($wsid)
    {
        return $this->get("/{$wsid}/models");
    }

    public function showModel($wsid, $uuid)
    {
        return $this->get("/{$wsid}/models/{$uuid}");
    }

    public function updateModel($wsid, $uuid, $data)
    {
        return $this->put("/{$wsid}/models/{$uuid}", $data);
    }

    public function createModel($wsid, $data)
    {
        return $this->post("/{$wsid}/models", $data);
    }

    public function deleteModel($wsid, $uuid)
    {
        return $this->delete("/{$wsid}/models/{$uuid}");
    }

    public function listPlannedEntries($wsid)
    {
        return $this->get("/{$wsid}/planned-entries");
    }

    public function createPlannedEntry($wsid, $data)
    {
        return $this->post("/{$wsid}/planned-entries", $data);
    }

    public function showPlannedEntry($wsid, $uuid)
    {
        return $this->get("/{$wsid}/planned-entries/{$uuid}");
    }

    public function updatePlannedEntry($wsid, $uuid, $data)
    {
        return $this->put("/{$wsid}/planned-entries/{$uuid}", $data);
    }

    public function deletePlannedEntry($wsid, $uuid)
    {
        return $this->delete("/{$wsid}/planned-entries/{$uuid}");
    }

    public function showEntry($wsid, $uuid)
    {
        return $this->get("/{$wsid}/entry/{$uuid}");
    }

    public function updateEntry($wsid, $uuid, $data)
    {
        return $this->put("/{$wsid}/entry/{$uuid}", $data);
    }
}
