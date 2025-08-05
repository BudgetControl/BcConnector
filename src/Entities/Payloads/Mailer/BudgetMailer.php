<?php 
namespace Budgetcontrol\Connector\Entities\Payloads\Mailer;

use Budgetcontrol\Connector\Entities\Payloads\Payload;
use Budgetcontrol\Connector\Entities\Payloads\PayloadInterface;

final class BudgetMailer extends Payload implements PayloadInterface
{
    public string $to;
    public string $budget_name;
    public string $current_amount;
    public string $budget_limit;
    public string $currency;
    public string $username;

    public function __construct(
        string $to,
        string $budget_name,
        string $current_amount,
        string $budget_limit,
        string $currency,
        string $username
    ) {
        $this->to = $to;
        $this->budget_name = $budget_name;
        $this->current_amount = $current_amount;
        $this->budget_limit = $budget_limit;
        $this->currency = $currency;
        $this->username = $username;
    }
}