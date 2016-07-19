<?php
namespace vedebel\directv5\AdGroup\Properties;

use vedebel\directv5\Common\Object;

class MobileAppAdGroup extends Object
{
    const ALLOWED_CARRIER_VALUES = ['WI_FI_ONLY', 'WI_FI_AND_CELLULAR'];
    const ALLOWED_DEVICE_TYPE_VALUES = ['DEVICE_TYPE_MOBILE', 'DEVICE_TYPE_TABLET'];

    public function __construct(string $storeUrl = null, array $targetDeviceType = null, string $targetCarrier = null,
                                string $targetOperatingSystemVersion = null)
    {
        $attributes = [];

        if (!is_null($storeUrl)) {
            $attributes['storeUrl'] = $storeUrl;
        }
        if (!is_null($targetDeviceType)) {
            if (count(array_intersect($targetDeviceType, self::ALLOWED_DEVICE_TYPE_VALUES)) === 0) {
                throw new \UnexpectedValueException('Incorrect $targetDeviceType provided');
            }
            $attributes['targetDeviceType'] = $targetDeviceType;
        }
        if (!is_null($targetCarrier)) {
            if (!in_array($targetCarrier, self::ALLOWED_CARRIER_VALUES)) {
                throw new \UnexpectedValueException('Incorrect $targetCarrier provided');
            }
            $attributes['targetCarrier'] = $targetCarrier;
        }
        if (!is_null($targetOperatingSystemVersion)) {
            $attributes['targetOperatingSystemVersion'] = $targetOperatingSystemVersion;
        }

        parent::__construct($attributes);
    }
}