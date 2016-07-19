<?php
namespace vedebel\directv5\Ad\Properties;

use vedebel\directv5\Common\Object;

/**
 * Class ExtensionModeration
 * @package vedebel\directv5\Ad\Properties
 *
 * @property  string|null $status
 * @property string|null $statusClarification
 */
class ExtensionModeration extends Object
{
    /**
     * ExtensionModeration constructor.
     * @param string|null $status
     * @param string|null $statusClarification
     */
    public function __construct(string $status = null, string $statusClarification = null)
    {
        parent::__construct(['status' => $status, 'statusClarification' => $statusClarification]);
    }
}