<?php
namespace vedebel\directv5\Campaign\Properties;

use vedebel\directv5\Common\Object;

/**
 * Class RelevantKeywords
 * @package vedebel\directv5\Campaign
 *
 * @property int $budgetPercent
 * @property string $mode
 * @property int $optimizeGoalId
 */
class RelevantKeywordsBase extends Object
{
    /**
     * RelevantKeywords constructor.
     * @param int $budgetPercent
     * @param string $mode
     * @param int $optimizeGoalId
     */
    public function __construct(int $budgetPercent = null, string $mode = null, int $optimizeGoalId = 0)
    {
        parent::__construct([]);
        $this->setAttributes(func_get_args());
    }
}