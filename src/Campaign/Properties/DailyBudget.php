<?php
namespace vedebel\directv5\Campaign\Properties;

use vedebel\directv5\Common\Money;
use vedebel\directv5\Common\Object;

class DailyBudget extends Object
{
    public function __construct(Money $amount, string $mode)
    {
        parent::__construct(['mount' => $amount, 'mode' => $mode]);
    }
}