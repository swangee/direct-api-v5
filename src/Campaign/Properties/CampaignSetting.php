<?php
namespace vedebel\directv5\Campaign\Properties;

use vedebel\directv5\Common\BoolValue;

class CampaignSetting implements \JsonSerializable
{
    const OPTIONS = [
        'ADD_METRICA_TAG', 'ADD_OPENSTAT_TAG', 'ADD_TO_FAVORITES', 'ENABLE_AREA_OF_INTEREST_TARGETING', 
        'ENABLE_AUTOFOCUS', 'ENABLE_BEHAVIORAL_TARGETING', 'ENABLE_EXTENDED_AD_TITLE', 'ENABLE_RELATED_KEYWORDS', 
        'ENABLE_SITE_MONITORING', 'EXCLUDE_PAUSED_COMPETING_ADS', 'MAINTAIN_NETWORK_CPC', 'REQUIRE_SERVICING',
        'SHARED_ACCOUNT_ENABLED', 'DAILY_BUDGET_ALLOWED'
    ];

    /**
     * @var string
     */
    private $option;

    /**
     * @var BoolValue
     */
    private $value;

    /**
     * CampaignSetting constructor.
     * @param string $option
     * @param BoolValue $value
     */
    public function __construct(string $option, BoolValue $value)
    {
        if (!in_array($option, self::OPTIONS)) {
            throw new \UnexpectedValueException('Provided option is not permitted');
        }

        $this->option = $option;
        $this->value = $value;
    }

    /**
     * @return array
     */
    public function jsonSerialize()
    {
        return ['Option' => $this->option, 'Value' => (string) $this->value];
    }
}