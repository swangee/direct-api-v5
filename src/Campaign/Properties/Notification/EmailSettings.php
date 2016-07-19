<?php
namespace vedebel\directv5\Campaign\Properties\Notification;

use vedebel\directv5\Common\BoolValue;
use vedebel\directv5\Common\Object;

/**
 * Class EmailSettings
 * @package vedebel\directv5\Campaign\Properties\Notification
 * 
 * @property string|null $email
 * @property int|null $checkPositionInterval
 * @property int|null $warningBalance
 * @property BoolValue|null $sendAccountNews
 * @property BoolValue|null $sendWarnings
 *
 */
class EmailSettings extends Object
{
    /**
     * EmailSettings constructor.
     *
     * @param string|null $email
     * @param int|null $checkPositionInterval
     * @param int|null $warningBalance
     * @param null|BoolValue $sendAccountNews
     * @param null|BoolValue $sendWarnings
     */
    public function __construct(
        string $email = null, int $checkPositionInterval = null, int $warningBalance = null,
        BoolValue $sendAccountNews = null, BoolValue $sendWarnings = null
    )
    {
        parent::__construct([]);

        $this->setAttributes(func_get_args());
    }
}