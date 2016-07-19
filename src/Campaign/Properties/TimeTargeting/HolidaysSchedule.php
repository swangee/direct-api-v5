<?php
namespace vedebel\directv5\Campaign\Properties\TimeTargeting;

use vedebel\directv5\Common\Object;

class HolidaysSchedule extends Object
{
    public function __construct(string $suspendOnHolidays, int $bidPercent, int $startHour, int $endHour)
    {
        parent::__construct([
            'SuspendOnHolidays' => $suspendOnHolidays,
            'BidPercent' => $bidPercent,
            'StartHour' => $startHour,
            'EndHour' => $endHour
        ]);
    }
}