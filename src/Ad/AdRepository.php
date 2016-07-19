<?php
namespace vedebel\directv5\Ad;

use vedebel\directv5\Common\Repository;
use vedebel\directv5\Common\SelectionCriteria;

/**
 * Class AdRepository
 * @package vedebel\directv5\Campaign
 *
 * @method AdCollection suspend(SelectionCriteria $criteria)
 * @method AdCollection resume(SelectionCriteria $criteria)
 * @method AdCollection delete(SelectionCriteria $criteria)
 * @method AdCollection archive(SelectionCriteria $criteria)
 * @method AdCollection unarchive(SelectionCriteria $criteria)
 * @method AdCollection moderate(SelectionCriteria $criteria)
 */
class AdRepository extends Repository
{
    /**
     * 
     */
    const ENDPOINT = 'ads';

    /**
     * 
     */
    const ALLOWED_ACTIONS = ['suspend', 'resume', 'archive', 'unarchive', 'moderate', 'delete'];
}