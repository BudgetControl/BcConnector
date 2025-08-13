<?php 
namespace Budgetcontrol\Connector\Entities\Payloads\Mailer\Auth;

use Budgetcontrol\Connector\Entities\Payloads\Payload;
use Budgetcontrol\Connector\Entities\Payloads\PayloadInterface;

final class SignUp extends Payload implements PayloadInterface
{
    public string $to;
    public string $workspace_name;
    public string $username;
    public string $password;
    
    public function __construct(
        string $to,
        string $workspace_name,
        string $username,
        string $password
    ) {
        if (filter_var($to, FILTER_VALIDATE_EMAIL) === false) {
            throw new \InvalidArgumentException('Invalid email address provided for "to" field.');
        }

        $this->to = $to;
        $this->workspace_name = $workspace_name;
        $this->username = $username;
        $this->password = $password;
    }
}