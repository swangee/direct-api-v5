<?php
namespace vedebel\directv5\SitelinkSet\Properties;

use vedebel\directv5\Common\Object;

/**
 * Class Sitelink
 * @package vedebel\directv5\Sitelink
 *
 * @property string|null $title
 * @property string|null $href
 * @property string|null $description
 */
class Sitelink extends Object
{
    /**
     * Sitelink constructor.
     * @param string|null $title
     * @param string|null $href
     * @param string|null $description
     */
    public function __construct(string $title = null, string $href = null, string $description = null)
    {
        $attributes = [];

        if (!is_null($title)) {
            $attributes['title'] = $title;
        }
        if (!is_null($href)) {
            $attributes['href'] = $href;
        }
        if (!is_null($description)) {
            $attributes['description'] = $description;
        }
        
        parent::__construct($attributes);
    }
}