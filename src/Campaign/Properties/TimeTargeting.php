<?php
namespace vedebel\directv5\Campaign\Properties;

use vedebel\directv5\Campaign\Properties\TimeTargeting\HolidaysSchedule;
use vedebel\directv5\Campaign\Properties\TimeTargeting\Schedule;
use vedebel\directv5\Common\Object;

/**
 * Class TimeTargeting
 * @package vedebel\directv5\Campaign\Properties
 * 
 * @property Schedule|null $schedule
 * @property string|null $considerWorkingWeekends
 * @property HolidaysSchedule|null $holidaysSchedule
 */
class TimeTargeting extends Object
{
    /**
     * TimeTargeting constructor.
     *
     * @param Schedule|null $schedule
     * @param string|null $considerWorkingWeekends
     * @param HolidaysSchedule|null $holidaysSchedule
     */
    public function __construct(Schedule $schedule = null, string $considerWorkingWeekends = null, HolidaysSchedule $holidaysSchedule = null)
    {
        parent::__construct([]);

        $this->setAttributes(func_get_args());
    }
}