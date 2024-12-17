<?php
declare(strict_types=1);

namespace Budgetcontrol\Connector\Entities;

class MsDomains {

    public readonly string $workspace;
    public readonly string $wallet;
    public readonly string $entry;
    public readonly string $stats;
    public readonly string $budget;
    public readonly string $saving;

    public function __construct(string $workspace, string $wallet, string $entry, string $stats, string $budget, string $saving)
    {
        $this->workspace = $workspace;
        $this->wallet = $wallet;
        $this->entry = $entry;
        $this->stats = $stats;
        $this->budget = $budget;
        $this->saving = $saving;
    }
    
}