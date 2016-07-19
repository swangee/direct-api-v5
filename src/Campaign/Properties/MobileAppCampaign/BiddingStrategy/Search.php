<?php
namespace vedebel\directv5\Campaign\Properties\MobileAppCampaign\BiddingStrategy;

use vedebel\directv5\Campaign\Properties\CampaignPlacementStrategyAdd;

class Search extends CampaignPlacementStrategyAdd
{
    const ALLOWED_STRATEGIES = [
        'AVERAGE_CPC', 'AVERAGE_CPI', 'HIGHEST_POSITION', 'IMPRESSIONS_BELOW_SEARCH', 'LOWEST_COST', 
        'LOWEST_COST_GUARANTEE', 'LOWEST_COST_PREMIUM', 'SERVING_OFF', 'WB_MAXIMUM_APP_INSTALLS', 'UNKNOWN', 
        'WB_MAXIMUM_CLICKS', 'WEEKLY_CLICK_PACKAGE'
    ];
}