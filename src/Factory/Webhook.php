<?php declare(strict_types=1);

use Budgetcontrol\Connector\Client\WebHookClient;
use Monolog\Logger;

class WebHook {

    protected WebHookClient $service;
    private string $webhook;
    private string $hash;
    
    public function __construct(string $webhookEndPoint, string $webhook, string $hash, Logger $log)
    {
        $this->service = new WebHookClient($webhookEndPoint, $log);
        $this->webhook = $webhook;
        $this->hash = $hash;
    }

    /**
     * Trigger new entry webhook
     * Creates a new webhook entry.
     *
     * @param string $wsUuid The UUID of the workspace
     * @param string $walletUuid The UUID of the wallet
     * @param int|float $amount The amount to be processed
     * @return void
     */
    public function newEntry(string $wsUuid, string $walletUuid, int|float $amount): void
    {
        $endpoint = "/{$this->webhook}/$wsUuid/wallet/balance/$walletUuid";
        $payload = [
            'amount' => $amount
        ];

        $this->service->patch(
            $endpoint, $payload, [
                'X-HASH' => $this->hash
            ]
        );
    }

}