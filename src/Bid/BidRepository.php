<?php
namespace vedebel\directv5\Bid;

use vedebel\directv5\Common\Repository;
/**
 * Class AdRepository
 * @package vedebel\directv5\Campaign
 *
 * @method BidCollection set(BidCollection $collection)
 * @method BidCollection setAuto(BidCollection $collection)
 */
class BidRepository extends Repository
{
    const ENDPOINT = 'bids';

    /**
     *
     */
    const ALLOWED_ACTIONS = ['set', 'setAuto'];
}