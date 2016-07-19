<?php
namespace vedebel\directv5\Campaign\Strategy;

use vedebel\directv5\Common\Money;

/**
 * Class WbMaximumClicksStrategy
 * @package vedebel\directv5\Campaign\Strategy
 *
 * @property Money $weeklySpendLimit
 * @property Money|null $bidCeiling
 */
class WbMaximumClicksStrategy extends DirectStrategy
{
    /**
     * WbMaximumClicksStrategy constructor.
     * @param Money $weeklySpendLimit
     * @param Money|null $bidCeiling
     */
    public function __construct(Money $weeklySpendLimit, Money $bidCeiling = null)
    {
        parent::__construct([]);

        $this->setAttributes(func_get_args());
    }
}