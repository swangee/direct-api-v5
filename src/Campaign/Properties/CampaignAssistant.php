<?php
namespace vedebel\directv5\Campaign\Properties;

use vedebel\directv5\Common\Object;

/**
 * Class CampaignAssistant
 * @package vedebel\directv5\Campaign\Properties
 *
 * @property string|null $manager
 * @property string|null $agency
 */
class CampaignAssistant extends Object
{
    /**
     * CampaignAssistant constructor.
     *
     * @param string|null $manager
     * @param string|null $agency
     */
    public function __construct(string $manager = null, string $agency = null)
    {
        parent::__construct(['manager' => $manager, 'agency' => $agency]);
    }
}