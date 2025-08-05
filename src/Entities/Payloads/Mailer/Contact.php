<?php 
namespace Budgetcontrol\Connector\Entities\Payloads\Mailer;

use Budgetcontrol\Connector\Entities\Payloads\Payload;
use Budgetcontrol\Connector\Entities\Payloads\PayloadInterface;

final class Contact extends Payload implements PayloadInterface
{
    public string $to;
    public string $subject;
    public string $message;
    public string $name;
    public string $email;
    public bool $privacy;

    public function __construct(
        string $to,
        string $subject,
        string $message,
        string $name,
        string $email,
        bool $privacy
    ) {
        if(filter_var($to, FILTER_VALIDATE_EMAIL) === false) {
            throw new \InvalidArgumentException('Invalid email address provided for "to" field.');
        }

        $this->to = $to;
        $this->subject = $subject;
        $this->message = $message;
        $this->name = $name;
        $this->email = $email;
        $this->privacy = $privacy;
    }
}