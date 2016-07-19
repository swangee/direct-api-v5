<?php
namespace vedebel\directv5\Ad;

use vedebel\directv5\Ad\Properties\AdCategories;
use vedebel\directv5\Ad\Properties\DynamicTextAd;
use vedebel\directv5\Ad\Properties\MobileAppAd;
use vedebel\directv5\Ad\Properties\TextAd;
use vedebel\directv5\Common\BoolValue;
use vedebel\directv5\Common\Object;

/**
 * Class AdGroup
 * @package vedebel\directv5\AdGroup
 *
 * @property int|null $id
 * @property int $campaignId
 * @property int $adGroupId
 * @property TextAd $textAd
 * @property DynamicTextAd $dynamicTextAd
 * @property MobileAppAd $mobileAppAd
 * @property string $status
 * @property string $state
 * @property string $statusClarification
 * @property AdCategories $adCategories
 * @property string $ageLabel
 * @property string $type
 */
class Ad extends Object
{
    /**
     * Ad constructor.
     *
     * @param int|null $id
     * @param int $campaignId
     * @param int $adGroupId
     * @param TextAd $textAd
     * @param DynamicTextAd $dynamicTextAd
     * @param MobileAppAd $mobileAppAd
     * @param string $status
     * @param string $state
     * @param string $statusClarification
     * @param AdCategories $adCategories
     * @param string $ageLabel
     * @param string $type
     */
    public function __construct
    (
        int $id = null, int $campaignId = null, int $adGroupId = null, TextAd $textAd = null, DynamicTextAd $dynamicTextAd = null,
        MobileAppAd $mobileAppAd =  null, string $status = null, string $state = null, string $statusClarification = null,
        AdCategories $adCategories = null, string $ageLabel = null, string $type = null
    )
    {
        parent::__construct([]);

        $this->setAttributes(func_get_args());
    }
}