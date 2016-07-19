<?php
namespace vedebel\directv5\AdGroup\Properties;

use vedebel\directv5\Common\Object;

class DynamicTextAdGroup extends Object
{
    public function __construct(string $domainUrl)
    {
        parent::__construct(['domainUrl' => $domainUrl]);
    }
}