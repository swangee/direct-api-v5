<?php
namespace vedebel\directv5\Campaign\Properties;

use vedebel\directv5\Campaign\Properties\Notification\EmailSettings;
use vedebel\directv5\Campaign\Properties\Notification\SmsSettings;
use vedebel\directv5\Common\Object;

/**
 * Class Notification
 * @package vedebel\directv5\Campaign\Properties
 *
 * @property SmsSettings|null $smsSettings
 * @property EmailSettings|null $emailSettings
 */
class Notification extends Object
{
    /**
     * Notification constructor.
     *
     * @param SmsSettings|null $smsSettings
     * @param EmailSettings|null $emailSettings
     */
    public function __construct(SmsSettings $smsSettings = null, EmailSettings $emailSettings = null)
    {
        parent::__construct([]);
        $this->setAttributes(func_get_args());
    }
}