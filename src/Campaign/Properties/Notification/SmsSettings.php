<?php
namespace vedebel\directv5\Campaign\Properties\Notification;

use vedebel\directv5\Common\Object;

class SmsSettings extends Object
{
    public function __construct(array $events = null, string $timeFrom = null, string $timeTo = null)
    {
        parent::__construct(['events' => $events, 'timeFrom' => $timeFrom, 'timeTo' => $timeTo]);
    }
}