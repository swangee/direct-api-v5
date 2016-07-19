<?php
namespace vedebel\directv5\Campaign\Properties\TextCampaign\BiddingStrategy;

use vedebel\directv5\Campaign\Properties\CampaignPlacementStrategyAdd;

class Search extends CampaignPlacementStrategyAdd
{
    const ALLOWED_STRATEGIES = [
        'AVERAGE_CPA', 'AVERAGE_ROI', 'AVERAGE_CPC', 'HIGHEST_POSITION', 'IMPRESSIONS_BELOW_SEARCH',
        'LOWEST_COST', 'LOWEST_COST_GUARANTEE', 'LOWEST_COST_PREMIUM', 'SERVING_OFF', 'WB_MAXIMUM_CLICKS',
        'WB_MAXIMUM_CONVERSION_RATE', 'WEEKLY_CLICK_PACKAGE'
    ];
}