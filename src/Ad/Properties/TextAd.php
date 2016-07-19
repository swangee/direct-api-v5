<?php
namespace vedebel\directv5\Ad\Properties;

use vedebel\directv5\Common\BoolValue;
use vedebel\directv5\Common\Object;

/**
 * Class TextAd
 * @package vedebel\directv5\Ad\Properties
 * 
 * @property string $text
 * @property string $title
 * @property string $href
 * @property BoolValue $mobile
 * @property string $displayDomain
 * @property string $displayUrlPath
 * @property int $vCardId
 * @property string $adImageHash
 * @property int $sitelinkSetId
 * @property ExtensionModeration $isplayUrlPathModeration
 * @property ExtensionModeration $vCardModeration
 * @property ExtensionModeration $sitelinksModeration
 * @property ExtensionModeration $adImageModeration
 * @property array $adExtensions
 */
class TextAd extends Object
{
    /**
     * TextAd constructor.
     * 
     * @param string $text
     * @param string $title
     * @param string $href
     * @param BoolValue $mobile
     * @param string $displayDomain
     * @param string $displayUrlPath
     * @param int $vCardId
     * @param string $adImageHash
     * @param int $sitelinkSetId
     * @param ExtensionModeration $isplayUrlPathModeration
     * @param ExtensionModeration $vCardModeration
     * @param ExtensionModeration $sitelinksModeration
     * @param ExtensionModeration $adImageModeration
     * @param array $adExtensions
     */
    public function __construct(
        string $text = null, string $title = null, string $href = null, BoolValue $mobile = null,
        string $displayDomain = null, string $displayUrlPath = null,int $vCardId = null, string $adImageHash = null,
        int $sitelinkSetId = null, ExtensionModeration $isplayUrlPathModeration = null, 
        ExtensionModeration $vCardModeration = null, ExtensionModeration $sitelinksModeration = null,
        ExtensionModeration $adImageModeration = null, array $adExtensions = null
    )
    {
        parent::__construct([]);

        $this->setAttributes(func_get_args());
    }
}