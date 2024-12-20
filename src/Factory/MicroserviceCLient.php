<?php
declare(strict_types=1);

namespace Budgetcontrol\Connector\Factory;

use Psr\Log\LoggerInterface;
use Budgetcontrol\Connector\Client\EntryClient;
use Budgetcontrol\Connector\Client\StatsClient;
use Budgetcontrol\Connector\Client\BudgetClient;
use Budgetcontrol\Connector\Client\SavingClient;
use Budgetcontrol\Connector\Client\WalletClient;
use Budgetcontrol\Connector\Client\WorkspaceClient;
use Budgetcontrol\Connector\Entities\MsDomains;

final class MicroserviceClient {

    private WorkspaceClient $workspaceClient;
    private WalletClient $walletClient;
    private EntryClient $entryClient;
    private StatsClient $statsClient;
    private BudgetClient $budgetClient;
    private SavingClient $savingClient;

    public function __construct(MsDomains $domain, LoggerInterface $log)
    {
        $clients = [
            'workspaceClient' => WorkspaceClient::class,
            'walletClient' => WalletClient::class,
            'entryClient' => EntryClient::class,
            'statsClient' => StatsClient::class,
            'budgetClient' => BudgetClient::class,
            'savingClient' => SavingClient::class,
        ];

        foreach ($clients as $property => $class) {
            $this->$property = new $class($domain->{str_replace('Client', '', $property)}, $log);
        }
    }

    public function workspace(): WorkspaceClient
    {
        return $this->workspaceClient;
    }

    public function wallet(): WalletClient
    {
        return $this->walletClient;
    }

    public function entry(): EntryClient
    {
        return $this->entryClient;
    }

    public function stats(): StatsClient
    {
        return $this->statsClient;
    }

    public function budget(): BudgetClient
    {
        return $this->budgetClient;
    }

    public function saving(): SavingClient
    {
        return $this->savingClient;
    }
}