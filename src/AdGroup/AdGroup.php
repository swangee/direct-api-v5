<?php
namespace vedebel\directv5\AdGroup;

use vedebel\directv5\AdGroup\Properties\DynamicTextAdGroup;
use vedebel\directv5\AdGroup\Properties\MobileAppAdGroup;
use vedebel\directv5\Common\NegativeKeywords;
use vedebel\directv5\Common\Object;

/**
 * Class AdGroup
 * @package vedebel\directv5\AdGroup
 *
 * @property int|null $id
 * @property string|null $name
 * @property null $campaignId
 * @property array $regionIds
 * @property NegativeKeywords|null $negativeKeywords
 * @property string|null $trackingParams
 * @property MobileAppAdGroup|null $mobileAppAdGroup
 * @property DynamicTextAdGroup|null $dynamicTextAdGroup
 * @property string $status
 * @property string $type
 */
class AdGroup extends Object
{
    /**
     * AdGroup constructor.
     *
     * @param int|null $id
     * @param string|null $name
     * @param null $campaignId
     * @param array $regionIds
     * @param NegativeKeywords|null $negativeKeywords
     * @param string|null $trackingParams
     * @param MobileAppAdGroup|null $mobileAppAdGroup
     * @param DynamicTextAdGroup|null $dynamicTextAdGroup
     * @param string $status
     * @param string $type
     */
    public function __construct
    (
        int $id = null, string $name = null, $campaignId = null, array $regionIds = [],
        NegativeKeywords $negativeKeywords = null, string $trackingParams = null,
        MobileAppAdGroup $mobileAppAdGroup = null, DynamicTextAdGroup $dynamicTextAdGroup = null, string $status = null,
        string $type = null
    )
    {
        parent::__construct([]);

        $this->setAttributes(func_get_args());
    }
}