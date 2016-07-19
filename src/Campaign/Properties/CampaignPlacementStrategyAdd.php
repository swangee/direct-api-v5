<?php
namespace vedebel\directv5\Campaign\Properties;

use vedebel\directv5\Campaign\Strategy\DirectStrategy;
use vedebel\directv5\Common\Object;

/**
 * Class CampaignPlacementStrategyAdd
 * @package vedebel\directv5\Campaign
 *
 * @property string $biddingStrategyType
 */
class CampaignPlacementStrategyAdd extends Object
{
    const ALLOWED_STRATEGIES = [
        'AVERAGE_CPA', 'AVERAGE_ROI', 'AVERAGE_CPC', 'HIGHEST_POSITION', 'IMPRESSIONS_BELOW_SEARCH',
        'LOWEST_COST', 'LOWEST_COST_GUARANTEE', 'LOWEST_COST_PREMIUM', 'SERVING_OFF', 'WB_MAXIMUM_CLICKS',
        'WB_MAXIMUM_CONVERSION_RATE', 'WEEKLY_CLICK_PACKAGE'
    ];

    /**
     * CampaignNetworkStrategyAdd constructor.
     * @param string $biddingStrategyType
     * @param DirectStrategy $strategy
     */
    public function __construct(string $biddingStrategyType, DirectStrategy $strategy = null)
    {
        if (!in_array($biddingStrategyType, static::ALLOWED_STRATEGIES)) {
            throw new \UnexpectedValueException('Invalid strategy provided');
        }

        $attributes = ['biddingStrategyType' => $biddingStrategyType];

        if ($strategy) {
            $attributes[lcfirst($strategy->getType())] = $strategy;
        }

        parent::__construct($attributes);
    }
}