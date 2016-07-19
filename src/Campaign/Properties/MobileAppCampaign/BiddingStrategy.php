<?php
namespace vedebel\directv5\Campaign\Properties\MobileAppCampaign;

use vedebel\directv5\Campaign\Properties\BiddingStrategyBase;

class BiddingStrategy extends BiddingStrategyBase
{
    public function __construct(BiddingStrategy\Search $search, BiddingStrategy\Network $network)
    {
        parent::__construct($search, $network);
    }
}