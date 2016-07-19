<?php
namespace vedebel\directv5\Campaign\Strategy;
use vedebel\directv5\Common\Money;

/**
 * Class AverageCpcStrategy
 * @package vedebel\directv5\Campaign\Strategy
 *
 * @property int|null $averageCpc
 * @property int|null $weeklySpendLimit
 */
class AverageCpcStrategy extends DirectStrategy
{
    /**
     * AverageCpcStrategy constructor.
     * @param Money|null $averageCpc
     * @param Money|null $weeklySpendLimit
     */
    public function __construct(Money $averageCpc = null, Money $weeklySpendLimit = null)
    {
        parent::__construct([]);

        $this->setAttributes(func_get_args());
    }
}