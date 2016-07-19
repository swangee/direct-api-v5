<?php
namespace vedebel\directv5\Campaign\Strategy;

/**
 * Class NetworkDefaultStrategy
 * @package vedebel\directv5\Campaign\Strategy
 *
 * @property int|null $limitPercent
 * @property int|null $bidPercent
 */
class NetworkDefaultStrategy extends DirectStrategy
{
    /**
     * NetworkDefaultStrategy constructor.
     * @param int|null $limitPercent
     * @param int|null $bidPercent
     */
    public function __construct(int $limitPercent = null, int $bidPercent = null)
    {
        parent::__construct([]);
        $this->setAttributes(func_get_args());
    }
}