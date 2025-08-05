<?php
namespace Budgetcontrol\Connector\Entities\Payloads;

interface PayloadInterface
{
    public function getData(): array;
}