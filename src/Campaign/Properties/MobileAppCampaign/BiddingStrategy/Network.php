<?php
namespace vedebel\directv5\Campaign\Properties\MobileAppCampaign\BiddingStrategy;

use vedebel\directv5\Campaign\Properties\CampaignPlacementStrategyAdd;

class Network extends CampaignPlacementStrategyAdd
{
    const ALLOWED_STRATEGIES = [
        'AVERAGE_CPC', 'AVERAGE_CPI', 'NETWORK_DEFAULT', 'MAXIMUM_COVERAGE', 'SERVING_OFF', 'UNKNOWN',
        'WB_MAXIMUM_APP_INSTALLS', 'WB_MAXIMUM_CLICKS', 'WEEKLY_CLICK_PACKAGE'
    ];
}