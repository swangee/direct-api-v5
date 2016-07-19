<?php
namespace vedebel\directv5\Bid;

use vedebel\directv5\Common\Money;
use vedebel\directv5\Common\Object;

/**
 * Class Bid
 * @package vedebel\directv5\Bid
 * 
 * @property int|null $campaignId
 * @property int|null $adGroupId
 * @property int|null $keywordId
 * @property Money|null $bid
 * @property Money|null $contextBid
 * @property string|null $strategyPriority
 */
class Bid extends Object
{
    /**
     * Bid constructor.
     * @param int|null $campaignId
     * @param int|null $adGroupId
     * @param int|null $keywordId
     * @param Money|null $bid
     * @param Money|null $contextBid
     * @param string|null $strategyPriority
     */
    public function __construct(
        int $campaignId = null, int $adGroupId = null, int $keywordId = null, Money $bid = null,
        Money $contextBid = null, string $strategyPriority = null
    )
    {
        parent::__construct([]);
        
        $this->setAttributes(func_get_args());
    }
}