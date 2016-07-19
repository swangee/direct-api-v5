<?php
namespace vedebel\directv5\SitelinkSet;

use vedebel\directv5\Common\Object;
use vedebel\directv5\SitelinkSet\Properties\Sitelink;

/**
 * Class SitelinkSet
 * @package vedebel\directv5\SitelinkSet
 *
 * @property int|null $id
 * @property Sitelink[]|null $sitelinks
 */
class SitelinkSet extends Object
{
    const SITELINKS_LIMIT = 4;

    /**
     * SitelinkSet constructor.
     *
     * @param int|null $id
     * @param Sitelink[]|null $sitelinks
     */
    public function __construct(int $id = null, array $sitelinks = [])
    {
        parent::__construct([]);
        $this->setAttributes(func_get_args());
    }
}