<?php
namespace vedebel\directv5\Campaign\Properties;

use vedebel\directv5\Campaign\Properties\DynamicTextCampaign\BiddingStrategy;
use vedebel\directv5\Campaign\Properties\DynamicTextCampaign\CounterIds;
use vedebel\directv5\Campaign\Properties\DynamicTextCampaign\Settings;

class DynamicTextCampaign extends CampaignType
{
    /**
     * TextCampaign constructor.
     * @param BiddingStrategy|null $biddingStrategy
     * @param null|Settings $settings
     * @param null|CounterIds $counterIds
     * @throws \Exception
     */
    public function __construct(BiddingStrategy $biddingStrategy = null, Settings $settings = null, CounterIds $counterIds = null)
    {
        $attributes = [];

        if (!is_null($biddingStrategy)) {
            $attributes['biddingStrategy'] = $biddingStrategy;
        }
        if (!is_null($settings)) {
            $attributes['settings'] = $settings;
        }
        if (!is_null($counterIds)) {
            $attributes['counterIds'] = $counterIds;
        }
       
        parent::__construct($attributes);
    }
}