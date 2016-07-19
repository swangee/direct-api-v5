<?php
namespace vedebel\directv5\Campaign\Properties;

use vedebel\directv5\Campaign\Properties\FundsParam\CampaignFundsParam;
use vedebel\directv5\Campaign\Properties\FundsParam\SharedAccountFundsParam;
use vedebel\directv5\Common\Object;

/**
 * Class FundsParam
 * @package vedebel\directv5\Campaign\Properties
 *
 * @property string $mode
 * @property CampaignFundsParam $campaignFunds
 * @property SharedAccountFundsParam $sharedAccountFunds
 */
class FundsParam extends Object
{
    /**
     * FundsParam constructor.
     *
     * @param string $mode
     * @param CampaignFundsParam $campaignFunds
     * @param SharedAccountFundsParam $sharedAccountFunds
     */
    public function __construct(string $mode, CampaignFundsParam $campaignFunds = null, SharedAccountFundsParam $sharedAccountFunds = null)
    {
        parent::__construct([]);
        $this->setAttributes(func_get_args());
    }
}