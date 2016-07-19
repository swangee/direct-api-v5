<?php
namespace vedebel\directv5\Keyword;

use vedebel\directv5\Common\Object;
use vedebel\directv5\Common\Statistics;
use vedebel\directv5\Keyword\Properties\Productivity;

/**
 * Class AdGroup
 * @package vedebel\directv5\AdGroup
 * 
 * @property int $id
 * @property int $campaignId
 * @property int $adGroupId
 * @property string $keyword
 * @property int $bid
 * @property int $contextBid
 * @property string $strategyPriority
 * @property string $userParam1
 * @property string $userParam2
 * @property string $state
 * @property string $status
 * @property Productivity $productivity
 * @property Statistics $statisticsSearch
 * @property Statistics $statisticsNetwork
 *
 */
class Keyword extends Object
{
    /**
     * Keyword constructor.
     *
     * @param int $id
     * @param int $campaignId
     * @param int $adGroupId
     * @param string $keyword
     * @param int $bid
     * @param int $contextBid
     * @param string $strategyPriority
     * @param string $userParam1
     * @param string $userParam2
     * @param string $state
     * @param string $status
     * @param Productivity $productivity
     * @param Statistics $statisticsSearch
     * @param Statistics $statisticsNetwork
     */
    public function __construct
    (
        int $id = null, int $campaignId = null, int $adGroupId = null, string $keyword = null, int $bid = null,
        int $contextBid = null, string $strategyPriority = null, string $userParam1 = null, string $userParam2 = null,
        string $state = null, string $status = null, Productivity $productivity = null,
        Statistics $statisticsSearch = null, Statistics $statisticsNetwork = null
    )
    {
        parent::__construct([]);

        $this->setAttributes(func_get_args());
    }
}