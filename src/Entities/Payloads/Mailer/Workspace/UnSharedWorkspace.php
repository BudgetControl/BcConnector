<?php 
namespace Budgetcontrol\Connector\Entities\Payloads\Mailer\Workspace;

use Budgetcontrol\Connector\Entities\Payloads\Payload;
use Budgetcontrol\Connector\Entities\Payloads\PayloadInterface;

final class UnSharedWorkspace extends Payload implements PayloadInterface
{
    public string $to;
    public string $workspace_name;
    public string $shared_by;

    public function __construct(
        string $to,
        string $workspace_name,
        string $shared_by,
    ) {
        if (filter_var($to, FILTER_VALIDATE_EMAIL) === false) {
            throw new \InvalidArgumentException('Invalid email address provided for "to" field.');
        }

        $this->to = $to;
        $this->workspace_name = $workspace_name;
        $this->shared_by = $shared_by;
    }
}