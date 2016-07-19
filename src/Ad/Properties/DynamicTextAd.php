<?php
namespace vedebel\directv5\Ad\Properties;

use vedebel\directv5\Common\Object;

class DynamicTextAd extends Object
{
    /**
     * DynamicTextAd constructor.
     * @param string $domainUrl
     */
    public function __construct(string $domainUrl = null)
    {
        parent::__construct(['domainUrl' => $domainUrl]);
    }
}