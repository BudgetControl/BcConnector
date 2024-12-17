<?php
declare(strict_types=1);

namespace Budgetcontrol\Connector\Entities;

class MsDomains {

    public readonly string $workspace;
    public readonly string $wallet;
    public readonly string $entry;
    public readonly string $stats;
    public readonly string $budget;

    public function __construct(string $workspace, string $wallet, string $entry, string $stats, string $budget)
    {
        $this->workspace = $workspace;
        $this->wallet = $wallet;
        $this->entry = $entry;
        $this->stats = $stats;
        $this->budget = $budget;
    }

    
}