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

final class MicroserviceCLient {

    private WorkspaceClient $workspaceClient;
    private WalletClient $walletClient;
    private EntryClient $entryClient;
    private StatsClient $statsClient;
    private BudgetClient $budgetClient;
    private SavingClient $savingClient;

    private function __construct(MsDomains $domain, LoggerInterface $log)
    {
        $this->workspaceClient = new WorkspaceClient($domain->workspace, $log);
        $this->walletClient = new WalletClient($domain->wallet, $log);
        $this->entryClient = new EntryClient($domain->entry, $log);
        $this->statsClient = new StatsClient($domain->stats, $log);
        $this->budgetClient = new BudgetClient($domain->budget, $log);
        $this->savingClient = new SavingClient($domain->saving, $log);
    }

    public static function create(MsDomains $domains, LoggerInterface $log): MicroserviceCLient
    {
        return new self($domains, $log);
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

}