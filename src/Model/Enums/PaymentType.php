<?php
namespace Budgetcontrol\Connector\Model\Entity;

use Exception;

enum PaymentType: string {
    case cash = 'Cash';
    case creditCard = 'Credit Card';
    case transfer = 'Transfer';
    case debitCard = 'Debit Card';

    const cash_id = 1;
    const creditCard_id = 2;
    const transfer_id = 3;
    const debitCard_id = 4;

    public static function where(string $type): PaymentType
    {
        foreach(PaymentType::cases() as $case) {
            if($case->value == $type) {
                return $case;
            }
        }

        throw new Exception("Entity $type is not valid",500);
    }

    public static function getID(string $type): int
    {
        foreach(PaymentType::cases() as $case) {
            if($case->name == $type) {
                return self::${$case->name.'_id'};
            }
        }

        throw new Exception("Entity $type is not valid",500);
    }
}