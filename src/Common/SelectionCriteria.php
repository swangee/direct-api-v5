<?php
namespace vedebel\directv5\Common;

class SelectionCriteria implements \JsonSerializable
{
    /**
     * @var
     */
    private $criteria;

    public function __construct(array $criteria)
    {
        $this->criteria = $criteria;
    }

    public function jsonSerialize()
    {
        return (object) $this->criteria;
    }
}