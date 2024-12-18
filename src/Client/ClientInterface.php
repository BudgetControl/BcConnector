<?php
declare(strict_types=1);

namespace Budgetcontrol\Connector\Client;

interface CLientInterface {

    public function setWorkSpaceId(string|int $wsid): void;
}