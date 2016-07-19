<?php
namespace vedebel\directv5\Campaign\Properties;

use vedebel\directv5\Common\BoolValue;
use vedebel\directv5\Common\Object;

/**
 * Class CampaignSettings
 * @package vedebel\directv5\Campaign\Properties
 *
 * @property $settings CampaignSetting[]
 */
class CampaignSettings extends Object
{
    /**
     * CampaignSettings constructor.
     * @param CampaignSetting[] $settings
     */
    public function __construct(...$settings)
    {
        foreach ($settings as $key => $setting) {
            if (!($setting instanceof CampaignSetting)) {
                $settings[$key] = new CampaignSetting($setting['Option'], new BoolValue($setting['Value']));
            }
        }

        parent::__construct(['settings' => $settings]);
    }

    /**
     * @param CampaignSetting $setting
     */
    public function addSetting(CampaignSetting $setting)
    {
        $this->attributes['settings'][] = $setting;
    }

    /**
     * @return mixed
     */
    public function jsonSerialize()
    {
        return $this->settings;
    }
}