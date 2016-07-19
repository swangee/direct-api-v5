<?php
namespace vedebel\directv5\Campaign\Properties;

use vedebel\directv5\Campaign\Properties\MobileAppCampaign\BiddingStrategy;
use vedebel\directv5\Campaign\Properties\MobileAppCampaign\Settings;

class MobileAppCampaign extends CampaignType
{
    /**
     * TextCampaign constructor.
     * @param BiddingStrategy|null $biddingStrategy
     * @param null|Settings $settings
     * @throws \Exception
     */
    public function __construct(BiddingStrategy $biddingStrategy = null, Settings $settings = null)
    {
        $attributes = [];

        if (!is_null($biddingStrategy)) {
            $attributes['biddingStrategy'] = $biddingStrategy;
        }
        if (!is_null($settings)) {
            $attributes['settings'] = $settings;
        }

        parent::__construct($attributes);
    }
}