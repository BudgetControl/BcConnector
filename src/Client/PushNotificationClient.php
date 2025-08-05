<?php declare(strict_types=1);
namespace Budgetcontrol\Connector\Client;

use Budgetcontrol\Connector\Entities\HttpResponse;
use Budgetcontrol\Connector\Entities\Payloads\Notification\PushNotification;
use Budgetcontrol\Connector\Entities\Payloads\Notification\UsersPushNotification;
use Budgetcontrol\Connector\Service\Interfaces\ConnectorInterface;

final class PushNotificationClient extends Client implements ConnectorInterface {
    
    /**
     * Sends notification when a budget has been exceeded.
     *
     * @param PushNotification $data The push notification data
     * @return HttpResponse
     */
    public function notificationMessageToUser(string $userUuid, PushNotification $data): HttpResponse
    {
        return $this->post("/notify/message/send/{$userUuid}", $data);
    }

    /**
     * Sends a push notification message.
     * @param PushNotification $data The push notification data
     * @return HttpResponse
     */
    public function notificationMessage(UsersPushNotification $data): HttpResponse
    {
        return $this->post('/notify/message/send', $data);
    }

}