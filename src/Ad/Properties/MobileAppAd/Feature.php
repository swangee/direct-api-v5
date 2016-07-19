<?php
namespace vedebel\directv5\Ad\Properties\MobileAppAd;

use vedebel\directv5\Common\BoolValue;
use vedebel\directv5\Common\Object;

class Feature extends Object
{
    const SUPPORTED_FEATURES = [
        'PRICE', 'ICON', 'CUSTOMER_RATING', 'RATINGS'
    ];

    public function __construct(string $feature, BoolValue $enabled)
    {
        if (!in_array($feature, self::SUPPORTED_FEATURES)) {
            throw new \UnexpectedValueException('Invalid feature provided');
        }

        parent::__construct(['feature' => $feature, 'enabled' => $enabled]);
    }
}