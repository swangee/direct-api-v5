<?php
namespace vedebel\directv5\Campaign\Properties\TextCampaign\BiddingStrategy;

use vedebel\directv5\Campaign\Properties\CampaignPlacementStrategyAdd;

class Network extends CampaignPlacementStrategyAdd
{
    const ALLOWED_STRATEGIES = [
        'AVERAGE_CPA', 'AVERAGE_ROI', 'AVERAGE_CPC', 'NETWORK_DEFAULT', 'SERVING_OFF', 'WB_MAXIMUM_CLICKS',
        'WB_MAXIMUM_CONVERSION_RATE', 'WEEKLY_CLICK_PACKAGE', 'MAXIMUM_COVERAGE'
    ];
}