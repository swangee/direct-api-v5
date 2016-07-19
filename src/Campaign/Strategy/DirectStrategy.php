<?php
namespace vedebel\directv5\Campaign\Strategy;

use vedebel\directv5\Common\Object;

abstract class DirectStrategy extends Object
{
    final public function getType(){
        $name = $this->getName();

        $name[0] = strtolower($name[0]);

        $type = preg_replace_callback('/([A-Z])/', function($matches) {
            return ucfirst($matches[0]);
        }, $name);

        $type = lcfirst($type);

        return $type;
    }
    
    final public function getName()
    {
        $classNameParts = explode('\\', get_class($this));

        return end($classNameParts);
    }
}