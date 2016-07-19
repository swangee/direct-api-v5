<?php
namespace vedebel\directv5\VCard\Properties;

use vedebel\directv5\Common\Object;

/**
 * Class PointOnMap
 * @package vedebel\directv5\VCard\Properties
 * 
 * @property float $x
 * @property float $y
 * @property float $x1
 * @property float $y1
 * @property float $x2
 * @property float $y2
 */
class PointOnMap extends Object
{
    /**
     * InstantMessenger constructor.
     * @param float $x
     * @param float $y
     * @param float $x1
     * @param float $y1
     * @param float $x2
     * @param float $y2
     */
    public function __construct(float $x, float $y, float $x1, float $y1, float $x2, float $y2)
    {
        $attributes = [
            'x' => $x,
            'y' => $y,
            'x1' => $x1,
            'y1' => $y1,
            'x2' => $x2,
            'y2' => $y2
        ];

        parent::__construct($attributes);
    }
}