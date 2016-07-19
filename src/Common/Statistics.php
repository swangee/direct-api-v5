<?php
namespace vedebel\directv5\Common;

/**
 * Class Statistics
 * @package vedebel\directv5\Campaign\Properties
 *
 * @property int $clicks
 * @property int $impressions
 */
class Statistics extends Object
{
    /**
     * Statistics constructor.
     * @param int $clicks
     * @param int $impressions
     */
    public function __construct(int $clicks, int $impressions)
    {
        parent::__construct(['clicks' => $clicks, 'impressions' => $impressions]);
    }
}