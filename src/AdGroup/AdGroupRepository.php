<?php
namespace vedebel\directv5\AdGroup;

use vedebel\directv5\Common\Repository;
use vedebel\directv5\Common\SelectionCriteria;

/**
 * Class AdGroupRepository
 * @package vedebel\directv5\Campaign
 *
 * @method AdGroupCollection delete(SelectionCriteria $criteria)
 */
class AdGroupRepository extends Repository
{
    const ENDPOINT = 'adgroups';

    /**
     *
     */
    const ALLOWED_ACTIONS = ['delete'];
}