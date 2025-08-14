<?php declare(strict_types=1);
namespace Budgetcontrol\Connector\Client;

use Budgetcontrol\Connector\Entities\HttpResponse;
use Budgetcontrol\Connector\Entities\Payloads\Notification\PushNotification;
use Budgetcontrol\Connector\Entities\Payloads\Notification\UsersPushNotification;
use Budgetcontrol\Connector\Service\Interfaces\ConnectorInterface;

final class StatsClient extends Client implements ConnectorInterface {
    
    /**
     * Sends notification when a budget has been exceeded.
     *
     * @return HttpResponse
     */
    public function getBudgetsStats($wsid): HttpResponse
    {
        return $this->get("/$wsid/budgets/stats");
    }

}