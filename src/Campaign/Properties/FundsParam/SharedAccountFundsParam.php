<?php
namespace vedebel\directv5\Campaign\Properties\FundsParam;

use vedebel\directv5\Common\Money;
use vedebel\directv5\Common\Object;

/**
 * Class SharedAccountFundsParam
 * @package vedebel\directv5\Campaign\Properties\FundsParam
 *
 * @property Money|null $refund
 * @property Money|null $spend
 */
class SharedAccountFundsParam extends Object
{
    /**
     * SharedAccountFundsParam constructor.
     *
     * @param Money|null $refund
     * @param Money|null $spend
     */
    public function __construct(Money $refund = null, Money $spend = null)
    {
        parent::__construct([]);
        $this->setAttributes(func_get_args());
    }
}