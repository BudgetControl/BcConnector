<?php declare(strict_types=1);

namespace Budgetcontrol\Connector\Entities\Payloads;

final class Payload implements PayloadInterface
{

    public function getData(): array
    {
        $objectVars = get_object_vars($this);
        return array_map(function ($value) {
            return is_object($value) ? $value->getData() : $value;
        }, $objectVars);
    }
}