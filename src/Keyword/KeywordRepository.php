<?php
namespace vedebel\directv5\Keyword;

use vedebel\directv5\Common\Repository;
use vedebel\directv5\Common\SelectionCriteria;

/**
 * Class AdRepository
 * @package vedebel\directv5\Campaign
 *
 * @method KeywordCollection suspend(SelectionCriteria $criteria)
 * @method KeywordCollection resume(SelectionCriteria $criteria)
 */
class KeywordRepository extends Repository
{
    const ENDPOINT = 'keywords';
}