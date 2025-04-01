<?php
namespace Budgetcontrol\Connector\Traits;

trait Triggers {
    /**
     * Trigger new entry webhook
     * Creates a new webhook entry.
     *
     * @param int $wsid The ID of the workspace
     * @param string $uuid The UUID of the wallet
     * @param array $data The data to be processed
     * @return void
     */
    protected function triggerUpdateBalance(int $wsid, string $uuid, array $data): void
    {
        $this->patch("/$wsid/balance/$uuid", ['json' => $data]);
    }

    /**
     * Trigger delete entry webhook
     * Creates a new webhook entry.
     *
     * @param int $wsid The ID of the workspace
     * @param string $uuid The UUID of the wallet
     * @return void
     */
    protected function triggerDeleteEntryFromBalance(int $wsid, string $uuid): void
    {
        $this->delete("/$wsid/balance/$uuid");
    }

}