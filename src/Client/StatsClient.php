<?php
namespace Budgetcontrol\Connector\Client;

use Budgetcontrol\Connector\Service\Interfaces\ConnectorInterface;
use Budgetcontrol\Connector\Service\HttpClientService;
use Psr\Log\LoggerInterface;
use Budgetcontrol\Connector\Entities\HttpResponse;

/**
 * Class to connect to the Budget Control API of the microservice.
 */
class StatsClient extends Client implements ConnectorInterface {

    public function getIncomingOfCurrentMonth($wsid)
    {
        return $this->get("/$wsid/incoming");
    }

    public function getExpensesOfCurrentMonth($wsid)
    {
        return $this->get("/$wsid/expenses");
    }

    public function getTotalOfCurrentMonth($wsid)
    {
        return $this->get("/$wsid/total");
    }

    public function getWallets($wsid)
    {
        return $this->get("/$wsid/wallets");
    }

    public function getHealth($wsid)
    {
        return $this->get("/$wsid/health");
    }

    public function getTotalPlannedOfCurrentMonth($wsid)
    {
        return $this->get("/$wsid/planned");
    }

    public function getAverageExpenses($wsid)
    {
        return $this->get("/$wsid/average-expenses");
    }

    public function getAverageIncoming($wsid)
    {
        return $this->get("/$wsid/average-incoming");
    }

    public function getAverageSavings($wsid)
    {
        return $this->get("/$wsid/average-savings");
    }

    public function getTotalLoanInstallmentsOfCurrentMonth($wsid)
    {
        return $this->get("/$wsid/total-loan-installments");
    }

    public function getTotalPlannedRemainingOfCurrentMonth($wsid)
    {
        return $this->get("/$wsid/total/planned/remaining");
    }

    public function getTotalPlannedMonthlyEntry($wsid)
    {
        return $this->get("/$wsid/total/planned/monthly");
    }

    public function getIncomingExpensesByDate($wsid)
    {
        return $this->get("/$wsid/chart/line/incoming-expenses");
    }

    public function getExpensesCategoryByDateBar($wsid)
    {
        return $this->get("/$wsid/chart/bar/expenses/category");
    }

    public function getExpensesCategoryByDateTable($wsid)
    {
        return $this->get("/$wsid/chart/table/expenses/category");
    }

    public function getExpensesLabelsByDateBar($wsid)
    {
        return $this->get("/$wsid/chart/bar/expenses/label");
    }

    public function getExpensesLabelsByDateApplePie($wsid)
    {
        return $this->get("/$wsid/chart/apple-pie/expenses/label");
    }

    public function postEntries($wsid, $data)
    {
        return $this->post("/$wsid/stats/entries", $data);
    }
    
}