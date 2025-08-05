<?php 
namespace Budgetcontrol\Connector\Entities\Payloads\Mailer;

use Budgetcontrol\Connector\Entities\Payloads\Payload;
use Budgetcontrol\Connector\Entities\Payloads\PayloadInterface;

final class RecoveryPassword extends Payload implements PayloadInterface
{
    public string $to;
    public string $token;
    public string $url;
    public string $username;

    public function __construct(
        string $to,
        string $token,
        string $url,
        string $username
    ) {
        if (filter_var($to, FILTER_VALIDATE_EMAIL) === false) {
            throw new \InvalidArgumentException('Invalid email address provided for "to" field.');
        }

        $this->to = $to;
        $this->token = $token;
        $this->url = $url;
        $this->username = $username;
    }
}