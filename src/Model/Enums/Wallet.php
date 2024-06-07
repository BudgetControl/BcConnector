<?php
namespace Budgetcontrol\Connector\Model\Entity;

use Exception;

enum Wallet: string {
    case bank = 'Bank';
    case cash = 'Cash';
    case creditCard = 'Credit Card';
    case creditCardRevolving = 'Credit Card Revolving';
    case investments = 'Investments';
    case savings = 'Savings';

    public static function where(string $type): Wallet
    {
        foreach(Wallet::cases() as $case) {
            if($case->value == $type) {
                return $case;
            }
        }

        throw new Exception("Entity $type is not valid",500);
    }
}