<?php declare(strict_types=1);
namespace Budgetcontrol\Connector\Entities\Payloads\Notification;

use Budgetcontrol\Connector\Entities\Payloads\Payload;
use Budgetcontrol\Connector\Entities\Payloads\PayloadInterface;

final class UsersPushNotification extends Payload implements PayloadInterface
{
    public function __construct(
        public string $title,
        public string $body,
        public ?string $platform = null,
        public ?string $lang = null,
        public ?string $userId = null,
        public ?string $token = null,
    ) {
    }
}