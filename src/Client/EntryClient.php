<?php

namespace Budgetcontrol\Connector\Client;

use Budgetcontrol\Connector\Service\Interfaces\ConnectorInterface;
use Budgetcontrol\Connector\Traits\Triggers;

/**
 * Class to connect to the Budget Control API of the microservice.
 */
class EntryClient extends Client implements ConnectorInterface
{
    use Triggers;

    public function getEntry($wsid)
    {
        return $this->get("/$wsid/entry");
    }

    public function getExpense($wsid)
    {
        return $this->get("/$wsid/expense");
    }

    public function showExpense($wsid, $uuid)
    {
        return $this->get("/$wsid/expense/$uuid");
    }

    public function createExpense($wsid, $data)
    {
        $response = $this->post("/$wsid/expense", $data);
        if (true === $response->isSuccessful()) {
            $this->triggerUpdateBalance($wsid, $data['wallet_id'], $data);
        }
        return $response;
    }

    public function updateExpense($wsid, $uuid, $data)
    {
        $response = $this->put("/$wsid/expense/$uuid", $data);
        if (true === $response->isSuccessful()) {
            $this->triggerUpdateBalance($wsid, $data['wallet_id'], $data);
        }
        return $response;
    }

    public function getIncome($wsid)
    {
        return $this->get("/$wsid/income");
    }

    public function showIncome($wsid, $uuid)
    {
        return $this->get("/$wsid/income/$uuid");
    }

    public function createIncome($wsid, $data)
    {
        $response = $this->post("/$wsid/income", $data);
        if (true === $response->isSuccessful()) {
            $this->triggerUpdateBalance($wsid, $data['wallet_id'], $data);
        }
        return $response;
    }

    public function updateIncome($wsid, $uuid, $data)
    {
        $response = $this->put("/$wsid/income/$uuid", $data);
        if (true === $response->isSuccessful()) {
            $this->triggerUpdateBalance($wsid, $data['wallet_id'], $data);
        }
        return $response;
    }

    public function getTransfer($wsid)
    {
        return $this->get("/$wsid/transfer");
    }

    public function showTransfer($wsid, $uuid)
    {
        return $this->get("/$wsid/transfer/$uuid");
    }

    public function createTransfer($wsid, $data)
    {
        $response = $this->post("/$wsid/transfer", $data);
        if (true === $response->isSuccessful()) {
            $this->triggerUpdateBalance($wsid, $data['wallet_id'], $data);
        }
        return $response;
    }

    public function updateTransfer($wsid, $uuid, $data)
    {
        $response = $this->put("/$wsid/transfer/$uuid", $data);
        if (true === $response->isSuccessful()) {
            $this->triggerUpdateBalance($wsid, $data['wallet_id'], $data);
        }
        return $response;
    }

    public function getDebit($wsid)
    {
        return $this->get("/$wsid/debit");
    }

    public function showDebit($wsid, $uuid)
    {
        return $this->get("/$wsid/debit/$uuid");
    }

    public function createDebit($wsid, $data)
    {
        $response = $this->post("/$wsid/debit", $data);
        if (true === $response->isSuccessful()) {
            $this->triggerUpdateBalance($wsid, $data['wallet_id'], $data);
        }
        return $response;
    }

    public function updateDebit($wsid, $uuid, $data)
    {
        $response = $this->put("/$wsid/debit/$uuid", $data);
        if (true === $response->isSuccessful()) {
            $this->triggerUpdateBalance($wsid, $data['wallet_id'], $data);
        }
        return $response;
    }

    public function getSaving($wsid)
    {
        return $this->get("/$wsid/saving");
    }

    public function showSaving($wsid, $uuid)
    {
        return $this->get("/$wsid/saving/$uuid");
    }

    public function createSaving($wsid, $data)
    {
        $response = $this->post("/$wsid/saving", $data);
        if (true === $response->isSuccessful()) {
            $this->triggerUpdateBalance($wsid, $data['wallet_id'], $data);
        }
        return $response;
    }

    public function updateSaving($wsid, $uuid, $data)
    {
        $response = $this->put("/$wsid/saving/$uuid", $data);
        if (true === $response->isSuccessful()) {
            $this->triggerUpdateBalance($wsid, $data['wallet_id'], $data);
        }
        return $response;
    }

    public function deleteDebit($wsid, $uuid)
    {
        $response = $this->delete("/$wsid/debit/$uuid");
        if (true === $response->isSuccessful()) {
            $this->triggerDeleteEntryFromBalance($wsid, $uuid);
        }
        return $response;
    }

    public function deleteIncome($wsid, $uuid)
    {
        $response = $this->delete("/$wsid/income/$uuid");
        if (true === $response->isSuccessful()) {
            $this->triggerDeleteEntryFromBalance($wsid, $uuid);
        }
        return $response;
    }

    public function deleteExpense($wsid, $uuid)
    {
        $response = $this->delete("/$wsid/expense/$uuid");
        if (true === $response->isSuccessful()) {
            $this->triggerDeleteEntryFromBalance($wsid, $uuid);
        }
        return $response;
    }

    public function deleteTransfer($wsid, $uuid)
    {
        $response = $this->delete("/$wsid/transfer/$uuid");
        if (true === $response->isSuccessful()) {
            $this->triggerDeleteEntryFromBalance($wsid, $uuid);
        }
        return $response;
    }

    public function deleteEntry($wsid, $uuid)
    {
        $response = $this->delete("/$wsid/entry/$uuid");
        if (true === $response->isSuccessful()) {
            $this->triggerDeleteEntryFromBalance($wsid, $uuid);
        }
        return $response;
    }

    public function listModels($wsid)
    {
        return $this->get("/$wsid/models");
    }

    public function showModel($wsid, $uuid)
    {
        return $this->get("/$wsid/models/$uuid");
    }

    public function updateModel($wsid, $uuid, $data)
    {
        return $this->put("/$wsid/models/$uuid", $data);
    }

    public function createModel($wsid, $data)
    {
        return $this->post("/$wsid/models", $data);
    }

    public function deleteModel($wsid, $uuid)
    {
        return $this->delete("/$wsid/models/$uuid");
    }

    public function listPlannedEntries($wsid)
    {
        return $this->get("/$wsid/planned-entries");
    }

    public function createPlannedEntry($wsid, $data)
    {
        return $this->post("/$wsid/planned-entries", $data);
    }

    public function showPlannedEntry($wsid, $uuid)
    {
        return $this->get("/$wsid/planned-entries/$uuid");
    }

    public function updatePlannedEntry($wsid, $uuid, $data)
    {
        return $this->put("/$wsid/planned-entries/$uuid", $data);
    }

    public function deletePlannedEntry($wsid, $uuid)
    {
        return $this->delete("/$wsid/planned-entries/$uuid");
    }

    public function showEntry($wsid, $uuid)
    {
        return $this->get("/$wsid/entry/$uuid");
    }

    public function updateEntry($wsid, $uuid, $data)
    {
        $response = $this->put("/$wsid/entry/$uuid", $data);
        if (true === $response->isSuccessful()) {
            $this->triggerUpdateBalance($wsid, $data['wallet_id'], $data);
        }
        return $response;
    }
}
