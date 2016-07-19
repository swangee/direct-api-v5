<?php
namespace vedebel\directv5\Campaign\Properties;
use vedebel\directv5\Campaign\Properties\TextCampaign\BiddingStrategy;
use vedebel\directv5\Campaign\Properties\TextCampaign\RelevantKeywords;

/**
 * Class TextCampaign
 * @package vedebel\directv5\Campaign
 *
 * @property BiddingStrategy|null $biddingStrategy
 * @property CampaignSettings|null $settings
 * @property CounterIdsBase|null $counterIds
 * @property RelevantKeywordsBase|null $relevantKeywords
 */
class TextCampaign extends CampaignType
{
    /**
     * TextCampaign constructor.
     * @param BiddingStrategy|null $biddingStrategy
     * @param CampaignSettings|null $settings
     * @param CounterIdsBase|null $counterIds
     * @param RelevantKeywords|null $relevantKeywords
     * @throws \Exception
     */
    public function __construct(BiddingStrategy $biddingStrategy = null, CampaignSettings $settings = null,
                                CounterIdsBase $counterIds = null, RelevantKeywords $relevantKeywords = null)
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
        if (!is_null($relevantKeywords)) {
            $attributes['relevantKeywords'] = $relevantKeywords;
        }
        
        parent::__construct($attributes);
    }
}