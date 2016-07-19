<?php
namespace vedebel\directv5\Keyword\Properties;

use vedebel\directv5\Common\Object;

/**
 * Class Productivity
 * @package vedebel\directv5\Keyword\Properties
 *
 * @property float|null $value
 * @property array|null $references
 */
class Productivity extends Object
{
    /**
     * Productivity constructor.
     * @param float|null $value
     * @param array|null $references
     */
    public function __construct(float $value = null, array $references = null)
    {
        parent::__construct([]);

        $this->setAttributes(func_get_args());
    }
}