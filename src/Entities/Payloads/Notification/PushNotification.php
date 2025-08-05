<?php declare(strict_types=1);
namespace Budgetcontrol\Connector\Entities\Payloads\Notification;

use Budgetcontrol\Connector\Entities\Payloads\Payload;
use Budgetcontrol\Connector\Entities\Payloads\PayloadInterface;

final class PushNotification extends Payload implements PayloadInterface
{
    public function __construct(
        public string $title,
        public string $body,
    ) {
    }
}