<?php
namespace vedebel\directv5\Campaign\Properties;

use vedebel\directv5\Common\Object;

/**
 * Class BiddingStrategy
 * @package vedebel\directv5\Campaign
 *
 * @property CampaignPlacementStrategyAdd|null $search
 * @property CampaignPlacementStrategyAdd|null $network
 */
class BiddingStrategyBase extends Object
{
    /**
     * BiddingStrategy constructor.
     * @param CampaignPlacementStrategyAdd|null $search
     * @param CampaignPlacementStrategyAdd|null $network
     */
    public function __construct(CampaignPlacementStrategyAdd $search = null, CampaignPlacementStrategyAdd $network = null)
    {
        parent::__construct([
            'search' => $search,
            'network' => $network
        ]);
    }
}