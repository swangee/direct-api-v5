<?php
namespace vedebel\directv5\Campaign;

use vedebel\directv5\Common\Repository;
use vedebel\directv5\Common\SelectionCriteria;

/**
 * Class CampaignRepository
 * @package vedebel\directv5\Campaign
 *
 * @method CampaignCollection suspend(SelectionCriteria $criteria)
 * @method CampaignCollection resume(SelectionCriteria $criteria)
 * @method CampaignCollection delete(SelectionCriteria $criteria)
 * @method CampaignCollection archive(SelectionCriteria $criteria)
 * @method CampaignCollection unarchive(SelectionCriteria $criteria)
 */
class CampaignRepository extends Repository
{
    /**
     * 
     */
    const ENDPOINT = 'campaigns';

    /**
     *
     */
    const ALLOWED_ACTIONS = ['suspend', 'resume', 'archive', 'unarchive', 'delete'];
}